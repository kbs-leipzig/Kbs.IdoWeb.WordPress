<?php /* Template Name: kbs_erleben_ordnung */ ?>
<?php get_header(); ?>

<main class="page-content">
<header class="entry-header">
</header>
<div class="page-content">
		<!-- RD Parallax-->
		<?php get_template_part('partials/kbs_parallax_header'); ?>

	<!-- CONTENT -->    
    <section class="section-80 section-md-110">
        <div class="shell">
				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
					<div class="range">
						<div class="cell-xs-12 cell-md-12 cell-lg-12 text-left">
							<div class="range">
								<div class="cell-xs-8 cell-md-8 cell-lg-8">
									<h2 class="page-title-heading"><?php the_title(); ?></h2>
								</div>
								<div class="cell-xs-4 cell-md-4 cell-lg-4 page-title-image">
									<div>
										<img style="max-width:100%" src="<?php echo the_field('page_title_image'); ?>">											
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="range">
						<div class="cell-xs-12 cell-md-12 cell-lg-12 text-left">
							<div class="post page">
							<?php the_content(); ?>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
				<?php endif; ?>
        </div>
    </section>
	
</div>
</main>
<?php get_footer();