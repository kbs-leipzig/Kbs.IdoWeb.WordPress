<?php /* Template Name: kbs_erleben_erfassen_erforschen */ ?>
<?php get_header(); ?>
<main role="main">
	<!-- TODO slick libs & custom styles -->
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
	<style>
		.slick-next, .slick-prev {
			font-size: 0;
			line-height: 0;
			position: absolute;
			top: calc(50%);
			display: block;
			width: 50px;
			height: 50px;
			padding: 0;
			-webkit-transform: translate(0,-50%);
			-ms-transform: translate(0,-50%);
			transform: translate(0,-50%);
			cursor: pointer;
			color: transparent;
			border: none;
			outline: 0;
			background: 0 0;
		}
		.slick-next:before, .slick-prev:before {
			font-family: slick;
			font-size: 50px;
			line-height: 50px;
			opacity: .75;
			color: #111;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
		.slick-prev {
			left: 3.5rem;
			z-index: 9;
		}
		.slick-next {
			right: 3.5rem;
		}
		
	</style>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
        </header>
        <div class="entry-content">
<!-- RD Parallax-->
			<!-- TODO: outsourcing -->
			<?php
				$parallax_arr = [];
				
				if(get_field('parallax_image')) { array_push($parallax_arr, get_field('parallax_image')); }
				if(get_field('parallax_image_2')) { array_push($parallax_arr, get_field('parallax_image_2')); }
				if(get_field('parallax_image_3')) { array_push($parallax_arr, get_field('parallax_image_3')); }
				if(get_field('parallax_image_4')) { array_push($parallax_arr, get_field('parallax_image_4')); }
				if(get_field('parallax_image_5')) { array_push($parallax_arr, get_field('parallax_image_5')); }
				if(get_field('parallax_image_6')) { array_push($parallax_arr, get_field('parallax_image_6')); }
				if(get_field('parallax_image_7')) { array_push($parallax_arr, get_field('parallax_image_7')); }
				if(get_field('parallax_image_8')) { array_push($parallax_arr, get_field('parallax_image_8')); }
				if(get_field('parallax_image_9')) { array_push($parallax_arr, get_field('parallax_image_9')); }
				if(get_field('parallax_image_10')) { array_push($parallax_arr, get_field('parallax_image_10')); }
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
										  echo the_title( '<h1>', '</h1>' );
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
						echo '<div data-speed="0.2" data-type="media" data-url="/wp-content/themes/Bodentier4/02_kbs_assets/images/index-01.jpg" class="rd-parallax-layer"></div>';
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
        	<!-- CONTENT -->
            <section class="section-30 section-md-20">
                <div class="shell">
        				<?php if (have_posts()) : ?>
        					<?php while (have_posts()) : the_post(); ?>
							<div class="range">
        						<div class="cell-xs-12 cell-md-12 cell-lg-10 cell-lg-preffix-1 text-left">
        							<div class="range" style="position:relative;">
        								<div class="cell-xs-6 cell-md-6 cell-lg-6">
        									<h2 class="page-title-heading"><?php the_title(); ?></h2>
        								</div>
										<?php if(!empty(get_field('page_title_image'))) : ?>
        								<div class="cell-xs-6 cell-md-6 cell-lg-6 page-title-image">
        									<div>
												<figure>
	        										<img style="max-width:100%" src="<?php echo the_field('page_title_image'); ?>">
												</figure>
        									</div>
        								</div>
										<?php endif; ?>											
										<?php if(!empty(get_field('jump_text'))) : ?>
											<div class="jumpLinkContainer cell-xs-4 cell-md-4 cell-lg-4 cell-xs-preffix-2 cell-md-preffix-2 cell-lg-preffi-2">
												<a class="btn" href="#neugierig"><?php echo get_field('jump_text'); ?></a>
											</div>
										<?php endif; ?>
        							</div>
        						</div>
        					</div>
        					<div class="range">
        						<div class="cell-xs-12 cell-md-12 cell-lg-10 cell-lg-preffix-1 text-left">
        							<?php the_content(); ?>
        						</div>
        					</div>
        					<?php endwhile; ?>
        				<?php endif; ?>
                </div>
            </section>
        </div>
    </article>
</main>
<script type="text/javascript">
  $(document).ready(function () {
	  var $slicky = $(".slick_container");
	  $slicky.slick({
      	mobileFirst: true,
      	infinite: true,
        slidesToScroll: 1,
        slide: 'section',
	    adaptiveHeight: true,
		dots: true,
      });
  })
</script>
<?php get_sidebar();
get_footer();