<?php
/**
* AUTHOR: KBS ST 
**/

//CONSTANTS - Switch for local dev
//$API_URL = "http://corenet.kbs-leipzig.de/api/taxons/details";
//$API_URL = "https://127.0.0.2:5001/api/taxons/details";
$API_URL = "https://idoweb.bodentierhochvier.de/api/taxons/details";
$FILENAME = get_template_directory()."/01_kbs_theme_options/taxon_details.json";
$IMG_URL = "/wp-content/uploads/";

/**
* CREATE NEW PAGES BY CALLING CORENET API
**/
function init_page_generation () {
	// buffer all upcoming output
	ob_start();
	//$response = callApi();
	if(is_user_logged_in()) {
		try {
			$arrContextOptions=array(
			  "ssl"=>array(
					"verify_peer"=>false,
					"verify_peer_name"=>false,
				),
			);
			$payload = file_get_contents($GLOBALS['API_URL'], false, stream_context_create($arrContextOptions));
			file_put_contents($GLOBALS['FILENAME'], $payload);
			//$payload = json_decode($payload);
			//echo $payload;
			echo "success";
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	// get the size of the output
	$size = ob_get_length();

	// send headers to tell the browser to close the connection
	header("Content-Length: $size");
	header('Connection: close');

	// flush all output
	ob_end_flush();
	ob_flush();
	flush();
	die();
}

function delete_generated_pages () {
	if(is_user_logged_in()) {
		try {
			// buffer all upcoming output
			ob_start();

			//$pages = get_pages();
			//TODO 
			$counter = 0;
			$args = array(
				'post_type' => 'page',
				'numberposts'   => -1,
				'post_status' => 'publish',
				'page_template' => 'kbs_misc_steckbrief.php',
				'meta_key' => 'auto_generated',
				'meta_value' => true,
			);
			$query = get_posts($args);
			foreach($query as $page) {
				wp_trash_post($page->ID);
				$counter++;
			}
			$parent_page = get_page_by_title('Steckbrief', OBJECT, 'page');
			if($parent_page) {
				wp_trash_post($parent_page->ID);
				$counter++;
			}
			echo $counter;

		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	// get the size of the output
	$size = ob_get_length();

	// send headers to tell the browser to close the connection
	header("Content-Length: $size");
	header('Connection: close');

	// flush all output
	ob_end_flush();
	ob_flush();
	flush();
	die();
}

function createNewPages() {
	if(is_user_logged_in()) {
		// buffer all upcoming output
		ob_start();

		$counter = 0;
		$parent_post = array(
			'post_title' => 'Steckbrief',
			'post_type' => 'page',
			'post_status' => 'publish',
			'page_template' => 'kbs_misc_steckbrief.php',
		);

		$parent_post_id = wp_insert_post($parent_post);
		add_post_meta($parent_post->ID, 'auto_generated', true);
		wp_update_post($parent_post->ID);		
		$json_file_cont = file_get_contents($GLOBALS['FILENAME']);
		$jsonArr = json_decode($json_file_cont, JSON_UNESCAPED_UNICODE);

		if(!empty($jsonArr) && $parent_post_id != null) {
			//for($i = 0; $i < 20; $i++) {
			foreach($jsonArr as $taxonDetailObj) {
				//convert array to object 
				$taxonDetail = json_decode(json_encode($taxonDetailObj), FALSE);
				//$taxonDetail = json_decode(json_encode($jsonArr[$i]), FALSE);
				if($taxonDetail) {
					$content = createPageContent($taxonDetail);
					$new_post = array(
						'post_title' => $taxonDetail->taxonItem->TaxonName,
						'post_content' => $content['contentString'],
						'post_status' => 'publish',
						'post_date' => date('Y-m-d H:i:s'),
						'post_author' => $user_ID,
						'post_type' => 'page',
						'post_category' => array('type' => 'auto_generated'),
						'post_parent' => $parent_post_id,
						'page_template'  => 'kbs_misc_steckbrief.php',
						'post_excerpt' => $content['excerpt'],
					);
					$post_id = wp_insert_post($new_post);
					//add slider images from array to parallax header images
					//TODO correct json
					//$tItem = json_decode($taxonDetail->taxonItem, TRUE, JSON_UNESCAPED_SLASHES);

					//makes page available as link using ilj plugin
					$ilj_link_array = [];
					if($taxonDetail->taxonItem->Synonyms != null) {
						$synArray = json_decode(json_encode($taxonDetail->taxonItem->Synonyms, TRUE, JSON_UNESCAPED_SLASHES), TRUE, JSON_UNESCAPED_SLASHES);
						if(!empty($synArray)) {
							foreach($synArray as $synItem) {
								$synItem = str_replace("  ", ' ', $synItem);
								$synValArr = explode(' ', $synItem);
								$cleanSyn = trim($synValArr[0]) . " " . trim($synValArr[1]);
								array_push($ilj_link_array, $cleanSyn);
							}
						}
					}
					array_push($ilj_link_array, $taxonDetail->taxonItem->TaxonName);
					add_post_meta($post_id, 'ilj_linkdefinition', $ilj_link_array);
					add_post_meta($post_id, 'auto_generated', true);						

					if($taxonDetail->taxonItem->General->SliderImages != null) {
						$sliderImgArr = json_decode($taxonDetail->taxonItem->General->SliderImages);
						if($sliderImgArr) {
							$ix = 1;
							foreach($sliderImgArr as $sliderImg) {
								$sliderImg = trim($sliderImg, '"');
								$sliderImg = trim($sliderImg, ' ');
								$imgSrcStr = $GLOBALS['IMG_URL'] . $sliderImg . ".jpg";
								$image_id = attachment_url_to_postid($sliderImg.".jpg");
								if($image_id) {
									$parallax_str = "parallax_image_".$ix;
									update_post_meta($post_id, $parallax_str, $image_id);
									//TODO: replace field id with auto-generated id
									update_post_meta($post_id, "_".$parallax_str, 'field_5d7a169d080d6');										}
								$ix++;
							}
						}
					} else if(count($taxonDetail->taxonImages) > 0) {
						$imgSrcStr = $GLOBALS['IMG_URL'] . $taxonDetail->taxonImages[0][0]->ImagePath . ".jpg";
						$image_id = attachment_url_to_postid($taxonDetail->taxonImages[0][0]->ImagePath.".jpg");
						update_post_meta($post_id, 'parallax_image', $image_id);
						//TODO: replace field id with auto-generated id
						update_post_meta($post_id, '_parallax_image', 'field_5d7a169d080d6');
					}
					
					
					wp_update_post($post_id);
					if($post_id) {
						$counter++;
					}
				}
			}
			die();
		}
		echo $counter;
	}

	// get the size of the output
	$size = ob_get_length();

	// send headers to tell the browser to close the connection
	header("Content-Length: $size");
	header('Connection: close');

	// flush all output
	ob_end_flush();
	ob_flush();
	flush();
	die();

}

function createPageContent ($taxonDetail) {
	$excerpt = "";
	if($taxonDetail->taxonItem->TaxonName != null) {
		 if($taxonDetail->taxonItem->TaxonDescription != null) {
			$contentStr .= "<h1 class='title_substitute'><em>".$taxonDetail->taxonItem->TaxonName."</em>&nbsp;".$taxonDetail->taxonItem->TaxonDescription."</h1>";
		 } else {
		 	$contentStr .= "<h1 class='title_substitute'>".$taxonDetail->taxonItem->TaxonDescription."</h1>";
		 }
	}
	$contentStr .= "<div class='steckbrief_content'>";	

	//Allgemeines
	if($taxonDetail->taxonItem->General != null) {
		$added = false;
		$general = $taxonDetail->taxonItem->General;
		$tempCont .= "<div class='steckbrief_wrapper'>";
		$tempCont .= "<h2><strong>Allgemeines</strong></h2>";
		$tempCont .= '<table class="steckbrief_table no_head"><thead></thead><tbody>';
		if(!empty($general->I18nNames)){
			$tempCont .= "<tr><td>Trivialname</td><td>".implode(', ', json_decode($general->I18nNames))."</td></tr>";
			$added = true;
		}
		if(!empty($general->Diagnosis)){
			$tempCont .= "<tr><td>Diagnose & &auml;hnliche Arten</td><td>".$general->Diagnosis."</td></tr>";
			$added = true;
		}
		if(!empty($general->DisplayLength)){
			$tempCont .= "<tr><td>L&auml;nge</td><td>".$general->DisplayLength."</td></tr>";
			$added = true;
		}
		if(!empty($general->AdditionalInfo)){
			$tempCont .= "<tr><td>Beschreibung</td><td>".$general->AdditionalInfo."</td></tr>";
			$added = true;
		}
		if(!empty($general->DistributionEurope)){
			$tempCont .= "<tr><td>Verbreitung Europa</td><td>".$general->DistributionEurope."</td></tr>";
			$excerpt .= "<tr><td>Verbreitung Europa</td><td>".$general->DistributionEurope."</td></tr>";
			$added = true;
		}
		if(!empty($general->TaxonBiotopeAndLifestyle)){
			$tempCont .= "<tr><td>Verbreitung & Häufigkeit</td><td>".$general->TaxonBiotopeAndLifestyle."</td></tr>";
			$excerpt .= "<tr><td>Verbreitung & Häufigkeit</td><td>".$general->TaxonBiotopeAndLifestyle."</td></tr>";											   
			$added = true;
		}
		if(!empty($general->TaxonDistribution)){
			$tempCont .= "<tr><td>Lebensr&auml;ume & Lebensweise</td><td>".$general->TaxonDistribution."</td></tr>";
			$excerpt .= "<tr><td>Lebensr&auml;ume & Lebensweise</td><td>".$general->TaxonDistribution."</td></tr>";
			$added = true;
		}
		if(!empty($general->RedListTypeName)){
			$tempCont .= "<tr><td>Rote Liste Deutschland</td><td>".$general->RedListTypeName."</td></tr>";
			$added = true;
		}
		if(!empty($general->RedListSource)){
			$tempCont .= "<tr><td>Rote Liste Quelle</td><td>".$general->RedListSource."</td></tr>";
			$added = true;
		}
		if(!empty($general->LiteratureSource)){
			$tempCont .= "<tr><td>Literatur</td><td>".$general->LiteratureSource."</td></tr>";
			$added = true;
		}
		$tempCont .= '</tbody></table></div>';
		if($added) {
			$contentStr .= $tempCont;
		}
	}
	
	//Systematik Part	
	$synArray = [];
	if($taxonDetail->taxonItem->Taxonomy != null) {
		$taxonomy = $taxonDetail->taxonItem->Taxonomy;
		$contentStr .= "<div class='steckbrief_wrapper section-30'>";
		$contentStr .= "<h2><strong>Systematik</strong></h2>";
		$contentStr .= '<table class="steckbrief_table no_head"><thead></thead><tbody>';
		if(!empty($taxonomy->PhylumName)){$contentStr .= "<tr><td>Stamm</td><td>".$taxonomy->PhylumName."</td></tr>";}
		if(!empty($taxonomy->PhylumName)){$contentStr .= "<tr><td>Klasse</td><td>".$taxonomy->ClassName."</td></tr>";}
		if(!empty($taxonomy->PhylumName)){$contentStr .= "<tr><td>Ordnung</td><td>".$taxonomy->OrderName."</td></tr>";}
		if(!empty($taxonomy->PhylumName)){$contentStr .= "<tr><td>Familie</td><td>".$taxonomy->FamilyName."</td></tr>";}
		if(!empty($taxonomy->PhylumName)){$contentStr .= "<tr><td>Genus</td><td><em>".$taxonomy->GenusName."</em></td></tr>";}
		$contentStr .= '</tbody></table></div>';
	}
	
	//Synonyme
	if($taxonDetail->taxonItem->Synonyms != null) {
		$contentStr .= "<div id='synonyms' class='steckbrief_wrapper no_header section-30 collapsed'>";
		$contentStr .= "<h2><strong>Synonyme</strong></h2>";
		$contentStr .= "<p>Verschiedene meist ältere wissenschaftliche Namen, die sich auf die gleiche Art bzw. das gleiche Taxon beziehen.</p>";
		$contentStr .= '<table class="steckbrief_table no_head"><thead></thead><tbody>';
		$synArray = json_decode(json_encode($taxonDetail->taxonItem->Synonyms, TRUE, JSON_UNESCAPED_SLASHES), TRUE, JSON_UNESCAPED_SLASHES);
		foreach($synArray as $synKey => $synVal) {
			//Brachydesmus superus var. mosellanus Verhoeff, 1891
			//Brachydesmus superus subsp. scandinavius Attems, 1927
			if(strpos($synVal, "subsp.") || strpos($synVal, "var.")) {
				$synArr = explode(' ', $synVal);
				$synName = $synArr[0] . " " . $synArr[1];
				$synDesc = join(" ", array_slice($synArr, 2));
				$synEnd = join(" ", array_slice($synArr, 4, count($synArr) - 4));
				$contentStr .= "<tr><td><em>".$synName."</em>&nbsp;".$synArr[2]."&nbsp;<em>".$synArr[3]."</em>&nbsp;".$synEnd."</td></tr>";
			} else {
				$synArr = explode(' ', $synVal);
				$synName = $synArr[0] . " " . $synArr[1];
				$synDesc = join(" ", array_slice($synArr, 2));
				$contentStr .= "<tr><td><em>".$synName."</em>&nbsp;".$synDesc."</td></tr>";				
			}
		}
		$contentStr .= "</tbody></table>";
		$contentStr .= "</div>";
		if(sizeOf($synArray) > 5) {
			$contentStr .= "<button data-target='#synonyms' type='button' class='show_more btn btn-green btn-sm'>Mehr</button>";	
		}
	}

	//Karte & Phänologie
	if($taxonDetail->taxonItem->EdaphobaseId != null) {
		$contentStr .= "<div class='steckbrief_wrapper section-30'>";
		$contentStr .= '<input type="hidden" name="_selectedSpecies" data-name="'.$taxonDetail->taxonItem->TaxonName.'" id="_selectedSpecies" value="'.$taxonDetail->taxonItem->EdaphobaseId.'" >';
		$contentStr .= '<div class="range">						
        					<div id="content-wrapper" class="cell-xs-12 cell-md-12 cell-lg-12 text-left">
								<h2>Verbreitungskarte</h2>
								<p>Diese Verbreitungskarte wird live aus den Daten von <a href="https://www.senckenberg.de/de/wissenschaft/forschungsinfrastruktur/datenbanken-und-digitale-ressourcen/edaphobase-datenbank-bodenzoologie/" target="_blank">Edaphobase</a> generiert.</p>
								<div id="evidenceWrapper">
									<div id="evidenceMapWrapper" style="height: 630px; overflow: hidden;">
										<div id="evidenceMap" style="height: 600px"></div>
										<div id="legendWrapper" >
											<img src="'.get_template_directory_uri().'/02_kbs_assets/images/legend.jpg" />
										</div>
									</div>
									<div id="evidenceListWrapper"></div>
								</div>
								<div id="mapButtonBar">
									<span style="display: inline-block; text-align: right; min-width: 200px; height: 25px; float: right;" id="tk25HoverSpan"></span>
									<span style="clear: both"></span>
								</div>
							</div>
						<!--Phaeno-->
						<div class="p-1 m-2">
							<div id="phaenogramView">
								<h2>Phänologie</h2>
								<p>Auftreten der verschiedenen Geschlechter und Entwicklungsstadien im Jahresverlauf. Das Phänologie-Diagramm wird live aus den Daten von <a href="https://www.senckenberg.de/de/wissenschaft/forschungsinfrastruktur/datenbanken-und-digitale-ressourcen/edaphobase-datenbank-bodenzoologie/" target="_blank">Edaphobase</a> generiert.</p>
								<p>Zum Entfernen der Daten von bestimmten Geschlechtern oder Stadien aus dem Diagramm bitte die Legendeneinträge unter dem Diagramm anklicken.</p>
								<div id="phaenogrammChart"></div>
							</div>
						</div></div>';
		$contentStr .= "</div>";		
	}

	//Merkmale
	if(count($taxonDetail->taxonDescriptions) > 0) {
		$contentStr .= "<div id='descriptions' class='steckbrief_wrapper section-30 collapsed'>";
		$contentStr .= "<h2><strong>Merkmalsauspr&auml;gungen</strong></h2>";
		$contentStr .= '<table class="steckbrief_table"><thead><th colspan=2>wie in interaktivem Schlüssel verwendet</th></thead><tbody>';
		foreach($taxonDetail->taxonDescriptions[0] as $taxDescItem => $taxDescArray) {
			if(gettype($taxDescArray) == 'object' && !empty($taxDescArray)) {
				if($taxDescArray->KeyGroupName !== "Land" 
				   && $taxDescArray->KeyGroupName !== "Bundesland") {
					foreach($taxDescArray as $taxDescItemKey => $taxDescItemVal) {
						//KeyGroupName - Level
						if($taxDescItemKey == "KeyGroupName") {
							$contentStr .= "<tr><td>".$taxDescItemVal."</td>";
						//DescriptionKeys - Level
						} else if(gettype($taxDescItemVal) == "array") {
							$valuesArr = [];
							foreach($taxDescItemVal as $descKey) {
								if(!$descKey->MinValue) {
									array_push($valuesArr,$descKey->KeyName);
								} else {
									if(!$descKey->MaxValue) {
										//non-range value, simply output one of the values
										array_push($valuesArr,$descKey->MinValue);
									} else {
										array_push($valuesArr, $descKey->MinValue." - ".$descKey->MaxValue);
									}
								}
							}
							$contentStr .= "<td><ul><li>".implode("</li><li>", $valuesArr)."</li></ul></td>";
						}
					}
				}
			}
		}
		$contentStr .= '</tbody></table></div>';
		$contentStr .= "<button data-target='#descriptions' type='button' class='show_more btn btn-green btn-sm'>Mehr</button>";
	}

	//Bilder
	if(count($taxonDetail->taxonImages[0]) > 0 ) {
		$contentStr .= "<div class='steckbrief_wrapper section-30'>";
		$contentStr .= "<h2><strong>Bilder</strong></h2>";
		$contentStr .= "<figure class='wp-block-gallery columns-4 is-cropped'><ul class='blocks-gallery-grid'>";
		foreach($taxonDetail->taxonImages as $imgArray => $imgItemArray) {
			if(gettype($imgItemArray) == 'array' && !empty($imgItemArray)) {
				foreach($imgItemArray as $imgItem => $imgItemVal) {
					if(!empty($imgItemVal) && gettype($imgItemVal) == 'object') {
						if($imgItemVal->IsApproved == true) {
							$imgSrcStr = $GLOBALS['IMG_URL'] . $imgItemVal->ImagePath . '.jpg';
							$contentStr .= '<li class="blocks-gallery-item">';
							$contentStr .= '<figure><a class="swipeLink" href="'.$imgSrcStr.'">';
							$contentStr .= '<img width="112px" height="150px" src="' . $GLOBALS['IMG_URL'] . $imgItemVal->ImagePath . '.jpg" /></a>';	
							//$contentStr .= '<figcaption class="hidden_caption">' . $imgItemVal->TaxonName . " " . $imgItemVal->ImageDescription . ' ' . $imgItemVal->Author . ' ' . $imgItemVal->CopyrightText . '</figcaption>';
							$contentStr .= '</figure></li>';							
						}
					}
				}
			}
		}
		//EO wrapper
		$contentStr .= "</ul></figure></div>";
	}
	//EO content
	$contentStr .= "</div>";
	$resultArr = array("contentString" => $contentStr, "excerpt" => $excerpt);
	return $resultArr;
}

function search_page_by_title () {
	//var_dump($titleString);
	ob_start();
	$titleStr = $_POST['data'];
	if(!empty($titleStr)) {
		$titleClean = str_replace(" ", "-", $titleStr);
		$page = get_page_by_title($titleStr, OBJECT, 'page');
		$permalink = get_post_permalink($page->ID);
		//$permalink = get_the_guid($page);
		//$page_meta = get_post_meta($page->ID);
		//enable for debug
		//var_dump($page_meta);
		echo trim($permalink);
		ob_end_flush();
		ob_flush();
		flush();
		die();
	}
}

function do_edapho_login () {
	$username = "kbs.leipzig";
	$pw = "iLovePasswords1!";
		
	$url = 'https://api.edaphobase.org/user/login/'.$username;
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);    
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
	curl_setopt($ch, CURLOPT_POST, true);                                                                   
	curl_setopt($ch, CURLOPT_POSTFIELDS, $pw);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
		'Accept: application/json',
		)                                                           
	);             
	
	if(curl_exec($ch) === false)
	{
		echo 'Curl error: ' . curl_error($ch);
	}                                                                                        
	$errors = curl_error($ch);                                                                                                            
	$result = curl_exec($ch);	
	$returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$respArr = json_decode($result);
	curl_close($ch);

	return $respArr->key;
}

function call_edapho_debug () {
	$jsonParams = $_POST['jsonParams'];
	//SCREW YOU JQUERY!!!
	$jsonParams = str_replace('\"','"', $jsonParams);
	$slug = $_POST['slug'];
	if(!empty($jsonParams) && !empty($slug)) {
		$api_key = do_edapho_login();
		if(gettype($jsonParams) == 'string') {
			//SCREW YOU JQUERY!!!
			$jsonParams = json_decode(str_replace('\"','"', $jsonParams));
		}
		$username = "kbs.leipzig";   
		$password = "iLovePasswords1!";                                                                                                                 
		$url = 'https://api.edaphobase.org/'.$slug;
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);    
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		curl_setopt($ch, CURLOPT_POST, true);                                                                   
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(json_decode($jsonParams)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
			'Accept: application/json',
			'Content-Type: application/json',
			"api-key: " . $api_key,
			)                                                           
		);             

		if(curl_exec($ch) === false)
		{
			echo 'Curl error: ' . curl_error($ch);
		}                                                                                                      
		$errors = curl_error($ch);                                                                                                            
		$result = curl_exec($ch);
		$returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);  
		//echo $returnCode;
		//var_dump($errors);
		//print_r(json_decode($result, true));
		echo $result;
	}
	die();
}
function call_edapho () {
	$jsonParams = $_POST['jsonParams'];
	$slug = $_POST['slug'];
	if(!empty($jsonParams) && !empty($slug)) {
		if(gettype($jsonParams) == 'string') {
			//SCREW YOU JQUERY!!!
			$jsonParams = json_decode(str_replace('\"','"', $jsonParams));
		}
		$api_key = do_edapho_login();
		$username = "kbs.leipzig";   
		$password = "iLovePasswords1!";                                                                                                                 
		$url = 'https://api.edaphobase.org/'.$slug;
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);    
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		curl_setopt($ch, CURLOPT_POST, true);                                                                   
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonParams));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
			'Accept: application/json',
			'Content-Type: application/json',
			"api-key: " . $api_key,
		)                                                           
		);             

		if(curl_exec($ch) === false)
		{
			echo 'Curl error: ' . curl_error($ch);
		}                                                                                                      
		$errors = curl_error($ch);                                                                                                            
		$result = curl_exec($ch);
		$returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);  
		//echo $returnCode;
		//print_r(json_decode($result, true));
		echo $result;
	}
	die();
}

?>