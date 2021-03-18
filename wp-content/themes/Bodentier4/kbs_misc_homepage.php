<?php /* Template Name: kbs_misc_homepage */ ?>
<?php get_header(); ?>
<!-- Page Content-->
<main class="page-content">
		<!-- RD Parallax-->
		<?php get_template_part('partials/kbs_parallax_header'); ?>
		<?php $upload_dir = wp_upload_dir(); ?>
        <!-- Content START -->
		<section class="section-60 section-md-110">
			<div class="range">
			  <div class="cell-md-3 cell-md-preffix-0 cell-xs-6 cell-sm-4 cell-sm-preffix-4 cell-xs-preffix-3">
				  <div class="left_side_wrap" style="display:flex;flex-direction:column;align-items:center;">
					<img style="width:100%;margin-bottom: 15px;" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/skorpion_600.png" />
					  <a href="https://www.buergerschaffenwissen.de/" target="_blank"><img style="width:66%; margin-bottom: 15px;" src="<?php echo $upload_dir['url'];?>/Buergerschaffenwissen.png" /></a>
					  <img style="width:66%;margin-bottom: 15px;" src="<?php echo $upload_dir['url'];?>/bundesfoerderung.jpg"/>
					  <a href="https://www.museum4punkt0.de" target="_blank"><img style="width:66%;" src="<?php echo $upload_dir['url'];?>/museum4punkt0.jpg" /></a>
				  </div>				
				</div>
			  <div class="cell-md-6 cell-md-preffix-0 cell-sm-10 cell-sm-preffix-1 cell-xs-12 padded_on_mobile">
				<h2><?php the_title();?></h2>
				<hr class="divider divider-60 divider-primary offset-top-32">
				<div class="range text-md-left offset-top-52">
					<div class="cell-md-12">
					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
					<?php endif; ?>
					</div>
				 </div>
			  </div>
			  <div class="cell-md-3 cell-md-preffix-0 cell-xs-6 cell-sm-4 cell-sm-preffix-4 cell-xs-preffix-3">
				<img  style="width:100%;" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/hundert_600.png" />
			  </div>
			</div>
        </section>
	<!-- 28.04.20 deleted, for original content see custompageHundert_Deprecated.php
    </main>
<?php 
get_footer();