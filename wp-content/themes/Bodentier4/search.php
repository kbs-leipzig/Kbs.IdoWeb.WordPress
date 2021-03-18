<?php get_header(); ?>
<!-- Page Content-->
<!-- index.php -->
<main class="page-content">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
        </header>
			<!-- CONTENT -->
			<?php ?>
            <section class="section-30 section-md-20">
				<h2>
					Suchergebnis:
				</h2>
                <div class="shell">
        				<?php if (have_posts()) : ?>
							<?php $count = 1; ?>
        					<?php while (have_posts()) : the_post(); ?>
							<div class="range section-lg-10 section-md-10 section-xs-10 section-sm-10">
        						<div class="cell-xs-12 cell-sm-12 cell-md-8 cell-md-preffix-2 cell-lg-10 cell-lg-preffix-1 text-left">
        							<div class="range" style="position:relative;">
										<div class="cell-xs-2 cell-sm-2 cell-md-2 cell-lg-2">
											<?php echo "<h4 class='badge badge_large'>".$count."</h4>"; ?>
										</div>
        								<div style='margin-top:5px;' class="cell-xs-10 cell-sm-10 cell-md-10 cell-lg-10">
        									<h3><?php the_title();?></h3>
											<?php 
											$parent_post = get_post($post->post_parent);
    										$parent_post_title = $parent_post->post_title;
											if(!empty($parent_post_title)) {
												echo "<h4>- ".$parent_post_title."</h4>";
											}
											echo "<a style='margin-top:1rem;' class='btn btn-green btn-sm' href='".get_the_permalink($post)."'>Zur Seite</a>";
											?>
        								</div>
										<div style="margin-top: 1rem;" class="cell-xs-9 cell-xs-preffix-2 cell-sm-9 cell-sm-preffix-2 cell-md-preffix-1 cell-md-10 cell-lg-10 cell-lg-preffix-2">
											<?php the_excerpt(25); ?>
										</div>
        							</div>
        						</div>
        					</div>
							<?php $count++; ?>
        					<?php endwhile; ?>
        				<?php endif; ?>
                </div>
            </section>
	</article>
	</main>
<?php 
get_footer();