<?php
	//RD Parallax
	$parallax_arr = [];
	$parallax_headl_arr = [];
	$parallax_text_arr = [];
	$parallax_link_arr = [];
				
	if(get_field('parallax_image_1')) { array_push($parallax_arr, get_field('parallax_image_1')); }
	if(get_field('parallax_image_headline_1')) { array_push($parallax_headl_arr, get_field('parallax_image_headline_1')); }
	if(get_field('parallax_image_text_1')) { array_push($parallax_text_arr, get_field('parallax_image_text_1')); }
	if(get_field('parallax_image_link_1')) { array_push($parallax_link_arr, get_field('parallax_image_link_1')); }
	if(get_field('parallax_image_2')) { array_push($parallax_arr, get_field('parallax_image_2')); }
	if(get_field('parallax_image_headline_2')) { array_push($parallax_headl_arr, get_field('parallax_image_headline_2')); }
	if(get_field('parallax_image_text_2')) { array_push($parallax_text_arr, get_field('parallax_image_text_2')); }
	if(get_field('parallax_image_link_2')) { array_push($parallax_link_arr, get_field('parallax_image_link_2')); }
	if(get_field('parallax_image_3')) { array_push($parallax_arr, get_field('parallax_image_3')); }
	if(get_field('parallax_image_headline_3')) { array_push($parallax_headl_arr, get_field('parallax_image_headline_3')); }
	if(get_field('parallax_image_text_3')) { array_push($parallax_text_arr, get_field('parallax_image_text_3')); }
	if(get_field('parallax_image_link_3')) { array_push($parallax_link_arr, get_field('parallax_image_link_3')); }
	if(get_field('parallax_image_4')) { array_push($parallax_arr, get_field('parallax_image_4')); }
	if(get_field('parallax_image_headline_4')) { array_push($parallax_headl_arr, get_field('parallax_image_headline_4')); }
	if(get_field('parallax_image_text_4')) { array_push($parallax_text_arr, get_field('parallax_image_text_4')); }
	if(get_field('parallax_image_link_4')) { array_push($parallax_link_arr, get_field('parallax_image_link_4')); }
	if(get_field('parallax_image_5')) { array_push($parallax_arr, get_field('parallax_image_5')); }
	if(get_field('parallax_image_headline_5')) { array_push($parallax_headl_arr, get_field('parallax_image_headline_5')); }
	if(get_field('parallax_image_text_5')) { array_push($parallax_text_arr, get_field('parallax_image_text_5')); }
	if(get_field('parallax_image_link_5')) { array_push($parallax_link_arr, get_field('parallax_image_link_5')); }
	if(get_field('parallax_image_6')) { array_push($parallax_arr, get_field('parallax_image_6')); }
	if(get_field('parallax_image_headline_6')) { array_push($parallax_headl_arr, get_field('parallax_image_headline_6')); }
	if(get_field('parallax_image_text_6')) { array_push($parallax_text_arr, get_field('parallax_image_text_6')); }
	if(get_field('parallax_image_link_6')) { array_push($parallax_link_arr, get_field('parallax_image_link_6')); }
	if(get_field('parallax_image_7')) { array_push($parallax_arr, get_field('parallax_image_7')); }
	if(get_field('parallax_image_headline_7')) { array_push($parallax_headl_arr, get_field('parallax_image_headline_7')); }
	if(get_field('parallax_image_text_7')) { array_push($parallax_text_arr, get_field('parallax_image_text_7')); }
	if(get_field('parallax_image_link_7')) { array_push($parallax_link_arr, get_field('parallax_image_link_7')); }
	if(get_field('parallax_image_8')) { array_push($parallax_arr, get_field('parallax_image_8')); }
	if(get_field('parallax_image_headline_8')) { array_push($parallax_headl_arr, get_field('parallax_image_headline_8')); }
	if(get_field('parallax_image_text_8')) { array_push($parallax_text_arr, get_field('parallax_image_text_8')); }
	if(get_field('parallax_image_link_8')) { array_push($parallax_link_arr, get_field('parallax_image_link_8')); }
	if(get_field('parallax_image_9')) { array_push($parallax_arr, get_field('parallax_image_9')); }
	if(get_field('parallax_image_headline_9')) { array_push($parallax_headl_arr, get_field('parallax_image_headline_9')); }
	if(get_field('parallax_image_text_9')) { array_push($parallax_text_arr, get_field('parallax_image_text_9')); }
	if(get_field('parallax_image_link_9')) { array_push($parallax_link_arr, get_field('parallax_image_link_9')); }
	if(get_field('parallax_image_10')) { array_push($parallax_arr, get_field('parallax_image_10')); }
	if(get_field('parallax_image_headline')) { array_push($parallax_headl_arr, get_field('parallax_image_headline_10')); }
	if(get_field('parallax_image_text_10')) { array_push($parallax_text_arr, get_field('parallax_image_text_10')); }
	if(get_field('parallax_image_link_10')) { array_push($parallax_link_arr, get_field('parallax_image_link_10')); }
	$par_count = count($parallax_arr);
	if($par_count > 1) {
		echo '<section>';
			echo '<div class="swiper-outer">';
				echo '<div data-simulate-touch="false" class="swiper-container swiper-slider">';
					echo '<div class="swiper-wrapper">';
					for($i=0;$i < $par_count; $i++) {
						echo '<div data-slide-bg="'.$parallax_arr[$i].'" class="swiper-slide">';
						  echo '<div data-caption-animate="fadeInUp" class="swiper-slide-caption">';
							echo '<div class="shell">';
							  if(!empty($parallax_headl_arr[$i])) { 
								echo "<h1>".$parallax_headl_arr[$i]."</h1>";
							  }
							  if(!empty($parallax_text_arr[$i])) { 
							    echo '<p>'.$parallax_text_arr[$i].'</p>';
							  }
							  if(!empty($parallax_link_arr[$i])) {
								echo '<a class="btn btn-green btn-sm" href="'.esc_url($parallax_link_arr[$i]['url']).'" target="'.esc_attr($parallax_link_arr[$i]['target']).'">'.$parallax_link_arr[$i]['title'].'</a>';
							  }
							  //var_dump($parallax_link_arr[$i]);
							echo '</div>';
						  echo '</div>';
						echo '</div>';
					}
					echo '</div>';
					echo '<div class="swiper-pagination"></div>';
					echo '<div class="swiper-button-prev mdi mdi-chevron-left"></div>';
					echo '<div class="swiper-button-next mdi mdi-chevron-right"></div>';
				echo '</div>';
			echo '</div>';
		echo '</section>';
	} else if($par_count == 1) {
		echo '<section class="rd-parallax">';
			echo '<div data-speed="0.2" data-type="media" data-url="'.get_field('parallax_image').'" class="rd-parallax-layer"></div>';
				echo '<div class="breadcrumb-wrapper">';
					echo '<div class="shell context-dark section-40 section-lg-top-158">';
						echo the_title( '<h1>', '</h1>' );
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</section>';
	} else {
		echo '<section class="rd-parallax">';
			echo '<div data-speed="0.2" data-type="media" data-url="/wp-content/uploads/index-01.jpg" class="rd-parallax-layer"></div>';
			echo '<div data-speed="0" data-type="html" class="rd-parallax-layer">';
				echo '<div class="breadcrumb-wrapper">';
					echo '<div class="shell context-dark section-40 section-lg-top-158">';
						echo the_title( '<h1>', '</h1>' );
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</section>';
	}
?>
