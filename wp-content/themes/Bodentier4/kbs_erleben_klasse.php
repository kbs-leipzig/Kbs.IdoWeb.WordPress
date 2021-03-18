<?php /* Template Name: kbs_erleben_klasse */ ?>
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
		<?php get_template_part('partials/kbs_parallax_header'); ?>
		
			<!-- CONTENT -->
            <section class="section-30 section-md-20">
                <div class="shell">
        				<?php if (have_posts()) : ?>
        					<?php while (have_posts()) : the_post(); ?>
							<div class="range">
        						<div class="cell-xs-12 cell-md-12 cell-lg-12 text-left">
        							<div class="range" style="position:relative;">
        								<div class="cell-xs-12 cell-md-6 cell-lg-6">
        									<h2 class="page-title-heading"><?php the_title(); ?></h2>
        								</div>
										<?php if(!empty(get_field('page_title_image'))) : ?>
        								<div class="cell-xs-12 cell-md-6 cell-lg-6 page-title-image">
        									<div>
												<figure>
	        										<img style="max-width:100%" src="<?php echo the_field('page_title_image'); ?>">
												</figure>
        									</div>
        								</div>
										<?php endif; ?>											
										<?php if(!empty(get_field('jump_text'))) : ?>
											<div class="jumpLinkContainer cell-xs-12 cell-md-4 cell-lg-4 cell-xs-preffix-2 cell-md-preffix-2 cell-lg-preffi-2">
												<a class="btn btn-green" href="#neugierig"><?php echo get_field('jump_text'); ?></a>
											</div>
										<?php endif; ?>
        							</div>
        						</div>
        					</div>
        					<div class="range">
        						<div class="cell-xs-12 cell-md-12 cell-lg-12 text-left">
        							<?php the_content(); ?>
        						</div>
        					</div>
        					<?php endwhile; ?>
        				<?php endif; ?>
                </div>
            </section>
            <!-- Interested? -->
        	<!-- section class="section-60 section-md-110 bg-gray-light section-md-top-0">
        		<div class="shell">
        			<div class="divider-text divider-text-primary">
        				<h2>Neugierig geworden? Dann lies hier mehr über die einzelnen Chilopoda-Ordnungen und all ihre speziellen Eigenheiten:</h2>
        			</div>
        		</div>
        	</section!-->

			<!-- CHILD PAGES -->
			<?php
			$children = get_children( array('post_parent' => get_the_ID(), 'post_type' => 'page'));?> 
			<?php if (sizeof($children) > 0) : ?>
				<div class="slick_container">
				<?php foreach ( $children as $child_id => $child ): ?>
					<section class="section-30 section-md-20 bg-gray-light">
						<div class="shell">
							<div class="range text-md-left">
								<!-- FIGURE/IMG -->
								<div class="cell-md-6 cell-lg-prefix-1 cell-md-push-1">
									<div class="img-wrap">
										<figure>
											<?php if(get_field('parallax_image', $child_id) != null) {
												echo'<img src="'.get_field("parallax_image", $child_id).'" width="570" height="320" alt="" class="img-responsive center-block">';
											} else {
												echo'<img src="'.get_field("parallax_image_1", $child_id).'" width="570" height="320" alt="" class="img-responsive center-block">';
											}?>
											
										</figure>
									</div>
								</div>
								<!-- TEXT -->
								<div class="cell-lg-5 cell-md-6">
									<h2><?php echo $child->post_title; ?></h2>
									<div class="divider-text divider-text-primary offset-top-26 offset-md-top-42">
										<p>
											<?php echo wp_trim_words( $child->post_content ); ?>
										</p>
										<div>
											<a href="<?php echo get_post_permalink($child_id); ?>" class="btn btn-green btn-sm offset-top-26 offset-md-top-42">Mehr Lesen</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				<?php endforeach; ?>
				</div>
			<?php endif; ?>
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