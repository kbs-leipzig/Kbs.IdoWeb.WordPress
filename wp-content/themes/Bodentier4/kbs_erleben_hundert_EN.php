<?php /* Template Name: kbs_erleben_hundert_EN */ ?>
<?php get_header(); ?>
<main role="main">
<?php
while ( have_posts() ) {
the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="entry-header">
<?php //kbs_the_post_header( 'h1', $post ) ?>
</header>
<div class="entry-content">

<!-- h2>Блог работает на WordPress версии <?php bloginfo('version'); ?></h2><br/ !-->
<!-- RD Parallax-->
              <section class="rd-parallax">
                <div data-speed="0.2" data-type="media" data-url="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/hundert_header.jpg" class="rd-parallax-layer"></div>
                <div data-speed="0" data-type="html" class="rd-parallax-layer">
                  <div class="breadcrumb-wrapper">
                    <div class="shell context-dark section-40 section-lg-top-158">
                      <h1>CENTIPEDES (Chilopoda)</h1>
                      <ol class="breadcrumb">
                        <li><a href="./">Erleben</a></li>
                        <li>Centipedes (Chilopoda)
                        </li>
                      </ol>
                    </div>
                  </div>
                </div>
              </section>
<section class="section-80 section-md-110 bg-gray-light">
          <div class="shell">
            <div class="range text-md-left">
				<div class="cell-md-6">
                <h2>What do centipedes look like?</h2>
                <div class="divider-text divider-text-primary offset-top-26 offset-md-top-42">
                  <p>The centipedes, in science also called Chilopoda, owe their name to the plate-shaped adhesion of their hips (coxa) of 
				  the jawfeet, the jawfoot plate (coxosternum), which lay like a second lower lip over the other mouth parts from below. 
				  The body of the chilopods is rather long-stretched and slim and usually has a length of 1 to 10 cm. Some tropical species 
				  can even reach lengths of up to 30 cm!</p>
                </div><a href="#" class="btn btn-default btn-sm offset-top-26 offset-md-top-42">Read more</a>
              </div>
              <div class="cell-md-3">
                  <div class="img-wrap" style="float: left;">
                    <figure>
					<!-- span data-toggle="modal" data-target="#myModal" class="icon mdi mdi-play-circle-outline icon-sm"></span !-->
					<img src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/home-2-05.jpg" width="300" alt="" class="img-responsive center-block">
					</figure>
                  </div>
              </div>
			  <div class="cell-md-3">
                  <div class="img-wrap" style="float: right;">
                    <figure>
					<!-- span data-toggle="modal" data-target="#myModal" class="icon mdi mdi-play-circle-outline icon-sm"></span !-->
					<img src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/hundert_600.png" width="300" alt="" class="img-responsive center-block">
					</figure>
                  </div>
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