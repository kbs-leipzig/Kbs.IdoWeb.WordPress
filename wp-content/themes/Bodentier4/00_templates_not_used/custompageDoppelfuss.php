<?php /* Template Name: CustomPageDoppelfuss */ ?>
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
                <div data-speed="0.2" data-type="media" data-url="<?php echo get_template_directory_uri(); ?>/images/index-02.jpg" class="rd-parallax-layer"></div>
                <div data-speed="0" data-type="html" class="rd-parallax-layer">
                  <div class="breadcrumb-wrapper">
                    <div class="shell context-dark section-40 section-lg-top-158">
                      <h1>Doppelfüßer</h1>
                      <ol class="breadcrumb">
                        <li><a href="./">Erleben</a></li>
                        <li>Doppelfüßer</li>
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
					<img src="<?php echo get_template_directory_uri(); ?>/images/home-2-05_.jpg" width="570" height="320" alt="" class="img-responsive center-block">
					</figure>
                  </div>
                </div>
				<br/>
				<div>
                  <div class="img-wrap">
                    <figure>
					<!-- span data-toggle="modal" data-target="#myModal" class="icon mdi mdi-play-circle-outline icon-sm"></span !-->
					<img src="<?php echo get_template_directory_uri(); ?>/images/home-2-05.jpg" width="570" height="320" alt="" class="img-responsive center-block">
					</figure>
                  </div>
                </div>
              </div>
              <div class="cell-lg-5 cell-md-6">
                <h2>Wie sehen Doppelfüßer aus?</h2>
                <div class="divider-text divider-text-primary offset-top-26 offset-md-top-42">
				<p>
				Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, 
				sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem 
				ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore 
				magna aliquyam erat, sed diam voluptua.
				</p>
                </div><a href="#" class="btn btn-default btn-sm offset-top-26 offset-md-top-42">Mehr Lesen</a>
              </div>
            </div>
          </div>
        </section>
<?php //the_content(); ?>
</div>
</article>
<?php } ?>
</main>
<?php //get_sidebar();
get_footer();