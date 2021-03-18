<?php /* Template Name: kbs_misc_steckbrief */ ?>
<?php get_header(); ?>
<main role="main">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
			<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/ol.css" rel="stylesheet" />
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/proj4.js"></script>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/ol.js"></script>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/olBiodiv.js"></script>
			
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/edapho_tk25_data.js"></script>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/defaultQueryMap_v2.js"></script>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/defaultQueryPhaeno.js"></script>
			<style>
				#evidenceMapWrapper {width: 66%;}
				#mapButtonBar {width: 66%;}
				#evidenceMap { width: 100%; height:100%; margin:0; }
				#legendWrapper {left: 10px; top: -130px; position: relative; height: 0;}
				#tk25HoverSpan {height:30px;}
				#evidenceWrapper {display: flex; align-items: flex-start;}
				#evidenceListWrapper { padding: 0 15px;}
			</style>
        </header>
        <div class="entry-content">
		<!-- RD Parallax-->
		<?php get_template_part('kbs_parallax_header'); ?>

        	<!-- CONTENT -->
            <section class="section-30 section-md-20">
                <div class="shell">
        				<?php if (have_posts()) : ?>
        					<?php while (have_posts()) : the_post(); ?>
							<div class="range">
        						<div class="cell-xs-12 cell-md-12 cell-lg-12 text-left">
        							<div class="range" style="position:relative;">
        								<div class="cell-xs-6 cell-md-6 cell-lg-6">
        								</div>
        								<div class="cell-xs-6 cell-md-6 cell-lg-6 page-title-image">
        									<div>
												<figure>
	        										<img style="max-width:100%" src="<?php echo the_field('page_title_image'); ?>">
												</figure>
        									</div>
        								</div>
										<?php if(!empty(get_field('jump_text'))) : ?>
											<div class="jumpLinkContainer">
												<a class="btn" href="#neugierig"><?php echo get_field('jump_text'); ?></a>
											</div>
										<?php endif; ?>
        							</div>
        						</div>
        					</div>
        					<div class="range">
								<input id="taxName" name="taxName" type="hidden" value="<?php echo $tax; ?>"/>
        						<div id="content-wrapper-inner" class="cell-xs-12 cell-md-12 cell-lg-12 text-left">
        							<?php the_content(); ?>
        						</div>
        					</div>
        					<?php endwhile; ?>
        				<?php endif; ?>
                </div>
            </section>
			<style>
				/*@TODO: improve markup and remove below*/
				#content-wrapper>ol {
					display:none;
				}
			</style>
			<script type="text/javascript">

				$("#content-wrapper>ol").hide();

				var legendYears = [1900, 1901, 1951, 2001];

				function mapYearToLegendStyle(feature, resolution) {
					var incoming_yearString = feature.get("date");
					if(typeof(incoming_yearString) !== 'undefined') {
						console.log(incoming_yearString);
						var y = incoming_yearString.split('/');
						var year = y[y.length-1];
						if(year >= legendYears[3]) {
							return evidence_styles["2001"];
						} else if(year >= legendYears[2]) {
							return evidence_styles["1951"];
						} else if(year >= legendYears[1]) {
							return evidence_styles["1901"];
						} else if(year <= legendYears[0]) {
							console.log("applying 1900");
							return evidence_styles["1900"];
						}						
					}					
					return evidence_styles["default"];
				}
				
				function get_edapho_points(query, slug, debug = false) {
					var action_name = 'call_edapho';
					var result;
					try {
						if(debug) {
							action_name = 'call_edapho';
							var queryDup = query;
							query = JSON.stringify(queryDup);
						}

						$.ajax({
							type: 'POST',
							url: ajaxurl,
							async: false,
							timeout: 30000,
							data: {
								action: action_name,
								'slug': slug,
								'jsonParams': query,
							},
							success: function (response) {
								var data = response;
								if(typeof(data) !== 'undefined') {
									console.log("success");
									var arr = JSON.parse(response);
									//console.log(response);
									//console.log(arr.totalfeatures);
									result = data;
								}
							},
							error: function (XMLHttpRequest, textStatus, errorThrown) {
								console.log("errorThrown");
								console.log(errorThrown);
								console.log(XMLHttpRequest);
								console.log(textStatus);
								result = null;
							},
							complete: function () {
							}
						});
					} catch (e) {
						console.log("couldnt build series from edapho data: " + e);
						return null;
					}
					return result;
				}

				var style = new ol.style.Style({
				  fill: new ol.style.Fill({
					color: 'rgba(255, 255, 255, 0.6)'
				  }),
				  stroke: new ol.style.Stroke({
					color: '#319FD3',
					width: 1
				  }),
				  text: new ol.style.Text({
					font: '12px Calibri,sans-serif',
					fill: new ol.style.Fill({
					  color: '#000'
					}),
					stroke: new ol.style.Stroke({
					  color: '#fff',
					  width: 3
					})
				  })
				});

			function create_evidence_layer() {
				defaultQueryMap.query.taxon.positive.taxonById[0].id = $("#_selectedSpecies").val();
				defaultQueryMap.query.taxon.positive.taxonById[0].name = $("#_selectedSpecies").data("name");
				console.log(defaultQueryMap.query.taxon.positive.taxonById[0].id);
				var groupings_geojson = get_edapho_points(defaultQueryMap, "evaluation/classification/points");
				//var geojsonObject = get_edapho_points(defaultQueryMap, "query/points");
				var tkMap = {};
				groupings_geojson = JSON.parse(groupings_geojson);
				if(groupings_geojson == null) {
					return null;
				}
				if(groupings_geojson.groups == null) {
					return null;
				}
				
				if(groupings_geojson.groups[0].layer.features[0].properties.display.columns["475"] && tk25DataLayer) {					
					groupings_geojson.groups.forEach(function (group) {
						group.layer.features.forEach(function (point) {
							if(typeof(point.properties.display.columns)!=='undefined') {
								if(tkMap[group.label] == null) {								
									tkMap[group.label] = point.properties.display.columns["475"][0]["en"];
								} else if (point.properties.display.columns["475"] > tkMap[group.label]) {
									tkMap[group.label] = point.properties.display.columns["475"][0]["en"];
								}								
							}
						})
					})
					console.log("tkMap creation done");

					tk25DataLayer.features.forEach(function (feat) {
						feat.properties.date = tkMap[feat.properties.de];
					})
					console.log("tk25DataLayer creation done");
					
					var vectorSource = new ol.source.Vector({
					  features: (new ol.format.GeoJSON()).readFeatures(tk25DataLayer),
					  projection: 'EPSG:3857',
					});

					var vectorLayer = new ol.layer.Vector({
						title: 'evidenceLayer',
						source: vectorSource,
						style: mapYearToLegendStyle
					});
					return vectorLayer;			
				} else {
					return null;
				}
			}

				
			function add_layer_to_map (mapInstance, layer, index) {
				console.log("add_layer_to_map");
				if(mapInstance && layer) {
					mapInstance.getLayers().getArray().push(eval(layer));
				} else {
					console.log("not adding");
				}
			}
				
				/**HELPERS**/
				var evidence_styles = {
					'1900': new ol.style.Style({
						fill: new ol.style.Fill({
						  color: 'rgb(237,27,36)'
						})
					  }),
					'1901': new ol.style.Style({
						fill: new ol.style.Fill({
						  color: 'rgb(255,127,36)'
						})
					  }),
					'1951': new ol.style.Style({
						fill: new ol.style.Fill({
						  color: 'rgb(254,242,2)'
						})
					  }),
					'2001': new ol.style.Style({
						fill: new ol.style.Fill({
						  color: 'rgb(34,176,81)'
						})
					  }),
					'default': new ol.style.Style({
						stroke: new ol.style.Stroke({
						  color: 'rgba(0,0,0,0.1)'
						})
					})
				};
												
				function getCategoryLabel(cat) {
					switch (cat) {
						case 0:
							return "Jan";
						case 1:
							return "Feb";
						case 2:
							return "Mrz";
						case 3:
							return "Apr";
						case 4:
							return "Mai";
						case 5:
							return "Jun";
						case 6:
							return "Jul";
						case 7:
							return "Aug";
						case 8:
							return "Sep";
						case 9:
							return "Okt";
						case 10:
							return "Nov";
						case 11:
							return "Dez";
					}
					return "";
				}

			var phaenogramData = [];
			var selectedStateId = null;
			$("#content-wrapper>ol").hide();

			function refreshPhaenogram() {
				var phaenogramData = buildSeriesScript(defaultQueryPhaeno);
				var chart = $("#phaenogrammChart").data("kendoChart");
				for (var j = 0; j < chart.options.series.length; j++) {
					chart.options.series[j].data = phaenogramData[j].ItemCount;
				}
				chart.refresh();
			}

			var selectedDateFrom = 0;
			var selectedDateTo = 9999;
			var tk25Features, evidenceLayer, interaction, natbsLayer;
			var the_extent = ["5.712891,47.159840,15.424805,55.128649"];
			var initMap=false;

			function initEvidenceMap() {
				if(initMap)
				{
					return;
				}
				initMap=true;
				kendo.ui.progress($("#_selectedSpecies").parent('.steckbrief_wrapper'), true);
				
				evidenceLayer = create_evidence_layer();
				
				if(!evidenceLayer) {
					kendo.ui.progress($("#_selectedSpecies").parent('.steckbrief_wrapper'), false);
					return false;
				}
				
				if(evidenceLayer != null) {
					console.log("evidenceLayer != null");
					console.log(evidenceLayer);
					var tkGridStyles = new ol.style.Style({
						stroke: new ol.style.Stroke({ color: '#a7aa00', width: 0.01 }),
					});

						var vectorSource = new ol.source.Vector({
							format: new ol.format.WFS(),
							url: function (extent, resolution, projection) {
								return 'https://wms.kbs-leipzig.de/cgi-bin/lepi_de_get?' +
									'service=WFS&request=GetFeature&' +
									'version=1.1.0&typename=lepiKML&' +
									'srsname=EPSG:3857&'
									'bbox=' + projection.getExtent().join(',') + ',EPSG:3857'
							},
							projection: 'EPSG:3857'
						});

						var tk25Source = new ol.source.Vector({
								format: new ol.format.WFS(),
								url: function (extent, resolution, projection) {
									return 'https://wms.kbs-leipzig.de/cgi-bin/lepi_de_get?' +
										'service=WFS&request=GetFeature&' +
										'version=1.1.0&typename=tk25KML&' +
										'srsname=EPSG:3857&' +
										'bbox=' + projection.getExtent().join(',') + ',EPSG:3857';
								},
							projection: 'EPSG:3857'
						});

						map = new ol.Map({
							target: "evidenceMap",
							interactions: ol.interaction.defaults(),
							controls: ol.control.defaults().extend([
								new ol.control.ScaleLine({
									units: 'metric'
								})
							]),
							layers: [
								new ol.layer.Tile({
									source: new ol.source.TileWMS({
										url: 'https://wms.kbs-leipzig.de/lepi?',
										params: { 'LAYERS': 'osm', 'SRS': 'EPSG:3857'},
										projection: 'EPSG:3857',
									})
								}), evidenceLayer/**, tk25baseFeatures, tk25Features, adminEnvelopeLayer**/
							],
							view: new ol.View({
								center: ol.proj.transform([9.914486, 51.540484], 'EPSG:4326', 'EPSG:3857'),
								zoom: 6,
								minZoom: 6,
								maxZoom: 14,
								showFullExtent: true,
								extent: ol.proj.getTransform('EPSG:4326', 'EPSG:3857')([5.712891,47.159840,15.424805,55.128649]),
							}),
						});

						interaction = new ol.interaction.Select({
							condition: ol.events.condition.click,
							style: function (feature, resolution) {
								/**
								var maxWidth = 5;
								var dynWidth = 0.5 + (1000 / resolution);
								**/
								return new ol.style.Style({
									stroke: new ol.style.Stroke({ color: '#003964', width: 1 }),
									fill: new ol.style.Fill({color:'#003964'})								
								});
							}
						});

						interaction.on("select", ol_featureSelected);

						map.addInteraction(interaction);

						var basekey = tk25Source.on('change', function (e) {
							if (tk25Source.getState() == 'ready') {
								ol.Observable.unByKey(basekey);			
							}
						});

						map.on("pointermove", function (evt) {
							$("#tk25HoverSpan").text("");
							var hit = this.forEachFeatureAtPixel(evt.pixel,
								function (feature, layer) {
									$("#tk25HoverSpan").text(feature.getProperties().de);
								}
							);
						});

						//tk25Features.on("postcompose", ol_featureSelected);
						kendo.ui.progress($("#_selectedSpecies").parent('.steckbrief_wrapper'), false);
						return true;
					} else {
						//tidy up paragraphs
						console.log("removing paragraph");
						$("#content-wrapper > p:nth-child(1)").remove();
					}
				}

				function ol_featureSelected(e) {

					var props = e.selected[0].getProperties();
					if(typeof(props.element_id) != 'undefined') {
						var detailsQuery = defaultQueryMap;
						detailsQuery.query.place.positive.placeById[0].id = props.element_id;						
						var t = setTimeout(function () {
							var detailsGeoJson = get_edapho_points(detailsQuery, "query/data");
							createEvidenceList(detailsGeoJson, props.de);							
						},10);
					}
				}
				
				function createEvidenceList (detailsGeoJson, tkName) {
					detailsGeoJson = JSON.parse(detailsGeoJson);					
					$("#evidenceListWrapper").html("<h4>"+tkName+"</h4>");
					
					if(detailsGeoJson != null) {
						$evList = jQuery('<ul></ul>', {
							id: 'evidenceList',
							"class": 'list',
						});
						jQuery('<li/>', {"class":"li"}).html("<strong>"+detailsGeoJson[0]["descriptions"][11464][0][475].label.de+"</strong>").appendTo($evList);

						detailsGeoJson.forEach(function (evidence) {
							var $sub_li = $('<li/>').html(evidence["descriptions"][11464][0][475].value.de);
							$evList.append($sub_li);
						});
						$evList.appendTo($("#evidenceListWrapper"));						
					}
				}

		function refreshMap() {
			console.log("refreshing map");
			var params = evidenceLayer.getSource().getParams();
			params.t = new Date().getMilliseconds();
			params.taxonid = (parseInt($("#_selectedSpecies").val())<0?"0":$("#_selectedSpecies").val());
			params.conceptid = (parseInt($("#_selectedSpecies").val())>0?"0":$("#_selectedSpecies").val().replace("-",""));
			evidenceLayer.getSource().updateParams(params);

			tk25Features.getSource().clear(true);
			tk25Features.getSource().refresh();
		}

		$(document).ready(function () {
			//Mehr & Weniger Buttons
			$("#descriptions>table.steckbrief_table>tbody>tr:gt(4)").addClass('hidden');
			$("#synonyms>table.steckbrief_table>tbody>tr:gt(2)").addClass('hidden');

			//Map & Phaeno
			var selectedSpecies = $("#_selectedSpecies").val();
			if(typeof(selectedSpecies) !== 'undefined') {
				defaultQueryPhaeno.query.taxon.positive.taxonById[0].id = selectedSpecies;
				if(!initEvidenceMap()) {
					//@TODO: improve selector thru html markup
					$("#Verbreitungskarte").remove();
					$("#evidenceMapWrapper").remove();
					$("#content-wrapper>p").remove();
					$("ol>li>a[href='#Verbreitungskarte']").parent('li').remove();
				}
				if(!initPhaeno()) { 
					$("#phaenogramView").remove();
					$("ol>li>a[href='#Phänologie']").parent('li').remove();
				}
				if(!initPhaeno && !initEvidenceMap) {
					$(".range>#content-wrapper").closest(".steckbrief_wrapper.section-30").remove();					
				}
			}
			$("#content-wrapper>ol").show();

		});
				
		function initPhaeno() {
			var phaeno = $("#phaenogrammChart").kendoChart({
				title: {
					text: "Phänogrammchart",
					visible: false,
				},
				legend: {
					position: "bottom",
					visible: true,
				},
				seriesDefaults: {
					type: "column",
					stack: true,
				},
				series: buildSeriesScript(defaultQueryPhaeno),
				valueAxis: {
					minorGridLines: {
					},
				},
				categoryAxis: [{
					labels: {
						template: kendo.template("#= getCategoryLabel(value) #"),
						step: 1,
					},
				categories: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ],
				majorGridLines: {
						visible: true,
					}
				}],
				tooltip: {
				  visible: true,
				  template: "#= series.name #: #= value #"
				}
			});

			//console.log(phaeno.data("kendoChart").get("series"));
			//console.log(phaeno.get("series"));
			
			if($("#phaenogrammChart").data("kendoChart").options.series.length < 1) {
				return false;
			}
			return true;
			//refreshPhaenogram();
		}
			
		function buildSeriesScript(query) {
			var result = get_edapho_points(query, "evaluation/ContingencyTable", true);
			try {
				resultObj = JSON.parse(result);
				if(resultObj.data) {
					var returnStr = "";
					//console.warn(resultObj.data);
					/**{ type: "line", data: [1, 2, 3] },
					   { type: "bar", data: [4, 5, 6] }
					**/
					var resres = [];
					var res = new Object();
					res.name = "Häufigkeit";
					res.color = "rgb(0,99,180)";
					var res1 = new Object();
					var res2 = new Object();
					var res3 = new Object();
					var res4 = new Object();
					var res5 = new Object();
					res1.name = "Adult, männlich";
					res1.color = "#2875BA";
					res2.name = "Adult, weiblich";
					res2.color = "#FF6663";
					res3.name = "Adult, nicht diff.";
					res3.color = "#CC99C9";
					res4.name = "Juvenil";
					res4.color = "#FEB144";
					res5.name = "Sonstige";
					res5.color = "lightgrey";
					dataArrMaleAdult = [];
					dataArrFemaleAdult = [];
					dataArrAdultND = [];
					dataArrJuvenile = [];
					dataArrMisc = [];
					//res.data = Object.values(resultObj.data[0].data[0]);
					/* 
					 1.	Adult, männlich (blau)
					 2.	Adult, weiblich (rot)
					 3.	Adult, nicht differenziert (lila)
					 4.	Juvenil = subadult, juvenil, männlich, weiblich, Geschlecht nicht differenziert (gelb)
					 5.	Sonstige = Entwicklungsstadium nicht differenziert , männlich, weiblich, Geschlecht nicht differenziert nicht differenziert (grau)
					*/					
					//parse header for juvenile,adult,sex
					//y sort data tho
					/**
					* [0].de
					* Weibchen
					* Männchen
					* (nicht differenzierbar / k.A.)
					* nicht differenziert
					**/
					var dataArrMaleAdult_key = "";
					var dataArrFemaleAdult_key = "";
					var dataArrAdultND_key = "";
					var dataArrJuvenile_key = "";
					var dataArrMisc_key = "";
					var dataArrMisc_key_nd = "";
					//console.log(resultObj.header.col[0]);
					//of course one has to switch between 0- and 1-indexed arrays, y not tho
					for (const [key, value] of Object.entries(resultObj.header.col[0])) {
						if(value["de"].indexOf("Männchen") > -1) {
							dataArrMaleAdult_key += ""+key;
						}
						if(value["de"].indexOf("Weibchen") > -1) {
							dataArrFemaleAdult_key += ""+key;
						}
						if(value["de"].indexOf("nicht differenziert") > -1) {
							dataArrMisc_key += ""+key;
						}
					}
					
					/**
					* [1].de
					* juvenil
					* (nicht differenzierbar / k.A.)
					* nicht differenziert
					* adult
					**/
					for (const [key, value] of Object.entries(resultObj.header.col[1])) {
						//console.log("key " + key);
						if(value["de"].indexOf("adult") > -1 && value["de"].indexOf("subadult") == -1) {
							dataArrMaleAdult_key += ","+key;
							dataArrFemaleAdult_key += ","+key;
							dataArrAdultND_key += ","+key;
						}
						if(value["de"].indexOf("juvenil") > -1) {
							dataArrJuvenile_key += ""+key;
						}
						if(value["de"].indexOf("nicht differenziert") > -1) {
							dataArrMisc_key += ""+key;
						}
						if(value["de"].indexOf("nicht differenzierbar") > -1) {
							dataArrMisc_key_nd += ""+key;
						}
					}
					
					//y sort by date tho
					var indexMonthMap = new Map();
					var dataStr = "";
					var monthCount = 1;
					var ix = 0;
					//var header_regx = new RegExp(/Sammeldatum \\\/ Nachweisdatum zwischen 1\.(\d+)\S*/g);
					var header_regex = /Sammeldatum (?:\\\/|\/) Nachweisdatum zwischen 1\.(\d+)\S*/i;
					//key-val for correct Month
					for (const [key, value] of Object.entries(resultObj.header.row[0])) {
						//key == index; value.de == "Sammeldatum \/ Nachweisdatum zwischen 1.12.-31.12."
						var match = value.de.match(header_regex);
						if(typeof(match) !== 'undefined' && match != null) {
							if(match[1]) {
								indexMonthMap.set(parseInt(key), parseInt(match[1]));
							}				
						}
					}
					
					//fill up rest up to 12 because data might be incomplete of course
					for(i = 1; i<13; i++) {
						if(!indexMonthMap.get(i)) {
							indexMonthMap.set(i, 0);
						}
					}

					//great success!
					for (const [key, value] of Object.entries(resultObj.data[0].data)) {
						//key 1-13 for sure
						dataArrMaleAdult[indexMonthMap.get(monthCount)] = 0;
						dataArrFemaleAdult[indexMonthMap.get(monthCount)] = 0;
						dataArrAdultND[indexMonthMap.get(monthCount)] = 0;
						dataArrJuvenile[indexMonthMap.get(monthCount)] = 0;
						dataArrMisc[indexMonthMap.get(monthCount)] = 0;
						var one = false;
						var two = false;
						var three = false;
						var four = false;
						var five = false;
						if(key < 13) {
							for (const [key_2, value_2] of Object.entries(value)) {
								//2,4 male adult
								//if(key_2 == "2,4") {
								if(key_2 == dataArrMaleAdult_key) {
									one = true;
									dataArrMaleAdult[indexMonthMap.get(monthCount)] += parseInt(value_2.v, 10);
								}
								//4,4 female adult
								//if(key_2 == "4,4") {
								if(key_2 == dataArrFemaleAdult_key) {
									two = true;
									dataArrFemaleAdult[indexMonthMap.get(monthCount)] += parseInt(value_2.v);
								}
								//1,4+2,4 nd adult
								//if(key_2 == "3,4") {
								if(key_2 == dataArrAdultND_key) {
									three = true;
									dataArrAdultND[indexMonthMap.get(monthCount)] += parseInt(value_2.v);
								}
								//x,3
								//if(key_2.includes(",3")) {
								if(key_2.includes(dataArrJuvenile_key)) {
									four = true;						
									dataArrJuvenile[indexMonthMap.get(monthCount)] += parseInt(value_2.v);
								}
								//x,1+x,2 all others
								//if(key_2.includes(",1") || key_2.includes(",2")) {
								if(key_2.includes(dataArrMisc_key) || key_2.includes(dataArrMisc_key_nd)) {
									dataArrMisc[indexMonthMap.get(monthCount)] += parseInt(value_2.v);
									five = true;
								}
							}
							monthCount++;
						}
					}

					dataArrMaleAdult.shift();
					dataArrFemaleAdult.shift();
					dataArrAdultND.shift();
					dataArrJuvenile.shift();
					dataArrMisc.shift();
					res1.data = dataArrMaleAdult;
					res2.data = dataArrFemaleAdult;
					res3.data = dataArrAdultND;
					res4.data = dataArrJuvenile;
					res5.data = dataArrMisc;
					//res.data = dataArr;
					resres.push(res1,res2,res3,res4,res5);
					return resres;
					}
			} catch (e) {
				console.warn("couldnt build series from edapho data: ");
				return null;
			}
		} 
				
		var site_links = [];
		parse_headlines(site_links);

		function parse_headlines (site_links) {	
			$("h2:not([id])").attr("id", function (i, attr) {
				site_links.push($(this).text());
				return $(this).text();
			});
			create_ul(site_links);
		}	

			 $(".show_more").on("click", function() {
				var that = $(this);
				var target = $(this).data('target');
				 var length = 4;
				 if(target !== "#descriptions") {
					 length = 2;
				 }
				//if($(target+">table.steckbrief_table>tbody>tr:gt(5)").hasClass('hidden')){
				if($(target+">table.steckbrief_table>tbody>tr:gt("+length+")").hasClass('hidden')){
					$($(target+">table.steckbrief_table>tbody>tr:gt("+length+")")).removeClass('hidden');
					$(this).html("Weniger");
				} else {
					$($(target+">table.steckbrief_table>tbody>tr:gt("+length+")")).addClass('hidden');
					$(this).html("Mehr");
				}
			})	

		function create_ul(site_links) {	
			var listView = document.createElement('ol');
			for (let i=0; i < site_links.length; i++) {
				var lItem = document.createElement('li');
				var link = document.createElement('a');
				//var textnode = document.createTextNode(site_links[i]);
				//lItem.appendChild(textnode);
				var linkText = "#"+site_links[i];
				link.href = linkText;
				link.text = site_links[i];
				lItem.appendChild(link);
				listView.appendChild(lItem);
			}
			sContent = $("div.steckbrief_content")[0];
			pNode = $("div.steckbrief_content").closest("div#content-wrapper-inner");
			pNode[0].insertBefore(listView, sContent);
		}
	
	</script>
      </div>
    </article>
</main>

<?php get_sidebar();
get_footer();