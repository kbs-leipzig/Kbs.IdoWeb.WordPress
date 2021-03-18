<?php
/**
 * The template for displaying 404 pages (not found)
 *
 */

get_header();
?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops!', 'Bodentier4' ); ?></h1>
				</header><!-- .page-header -->

      	<!-- CONTENT -->
            <section class="section-30 section-md-20">
                <div class="shell">
							<div class="range">
        						<div class="cell-xs-12 cell-md-12 cell-lg-12 text-left">
        							<div class="range" style="position:relative;">
        								<div class="cell-xs-6 cell-md-6 cell-lg-6">
        									<h2 class="page-title-heading"><?php the_title(); ?></h2>
        								</div>
        							</div>
        						</div>
        					</div>
        					<div class="range">
        						<div class="cell-xs-12 cell-md-12 cell-lg-12 text-left">
<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentynineteen' ); ?></p>
					<?php get_search_form(); ?>
        						</div>
        					</div>
                </div>
            </section>				
			</div><!-- .error-404 -->
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
