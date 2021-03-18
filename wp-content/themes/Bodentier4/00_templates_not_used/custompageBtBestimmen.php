<?php /* Template Name: CustomPageBtBestimmen */ ?>
<?php get_header(); ?>
<main role="main">
<?php
while ( have_posts() ) {
the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="entry-header">
<?php //bornholm_the_post_header( 'h1', $post ) ?>
</header>
<div class="entry-content">

<!-- h2>Блог работает на WordPress версии <?php bloginfo('version'); ?></h2><br/ !-->
<!-- RD Parallax-->
              <section class="rd-parallax">
                <div data-speed="0.2" data-type="media" data-url="<?php echo get_template_directory_uri(); ?>/images/breadcrumbs-01_.jpg" class="rd-parallax-layer"></div>
                <div data-speed="0" data-type="html" class="rd-parallax-layer">
                  <div class="breadcrumb-wrapper">
                    <div class="shell context-dark section-40 section-lg-top-158">
                      <h1>Bodentiere bestimmen</h1>
                      <ol class="breadcrumb">
                        <li><a href="./">Erkennen</a></li>
                        <li>Bodentiere bestimmen
                        </li>
                      </ol>
                    </div>
                  </div>
                </div>
              </section>

<section class="section-80 section-md-110 bg-gray-light">
          <div class="shell">
            <div class="range text-md-left">
              <div class="cell-md-6 cell-lg-preffix-1 cell-md-push-1">
                <div>
                  <div class="img-wrap">
                    <figure>
					<!-- span data-toggle="modal" data-target="#myModal" class="icon mdi mdi-play-circle-outline icon-sm"></span !-->
					<img src="<?php echo get_template_directory_uri(); ?>/images/bt_bestimmen.png" width="570" height="320" alt="" class="img-responsive center-block">
					</figure>
                  </div>
                </div>
				
              </div>
              <div class="cell-lg-5 cell-md-6">
                <h2>Bodentiere bestimmen</h2>
                <div class="divider-text divider-text-primary offset-top-26 offset-md-top-42">
                  <p>We are a group of professional dancers and teachers wishing to create a central home for all those involved in dancing.</p>
                  <p>We offer dance classes for all ages and for all levels of training, beginning through pre-professional. Learn everything from ballet to tap dance, jazz, hip-hop, break dance, and more. Sign up for classes today and make your wishes come true!</p>
                </div><a href="#" class="btn btn-default btn-sm offset-top-26 offset-md-top-42">Mehr Lesen</a>
              </div>
            </div>
          </div>
        </section>
<?php the_content(); ?>
</div>
</article>
<?php } ?>
</main>
<?php get_sidebar();
get_footer();