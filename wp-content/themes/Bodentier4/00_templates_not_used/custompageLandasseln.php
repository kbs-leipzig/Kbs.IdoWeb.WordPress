<?php /* Template Name: CustomPageLandasseln */ ?>
<?php get_header(); ?>
<main role="main">
<?php
while ( have_posts() ) {
the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="entry-header"></header>
<div class="entry-content" >

<!-- h2>Блог работает на WordPress версии <?php bloginfo('version'); ?></h2><br/ !-->
<!-- RD Parallax-->
        <section class="rd-parallax">
        <div data-speed="0.2" data-type="media" data-url="<?php echo get_template_directory_uri(); ?>/images/home-2-05.jpg" class="rd-parallax-layer"></div>
        <div data-speed="0" data-type="html" class="rd-parallax-layer">
            <div class="breadcrumb-wrapper">
            <div class="shell context-dark section-40 section-lg-top-158">
                <h1>Landasseln – Oniscidea</h1>
                <ol class="breadcrumb">
                <li><a href="./">Erleben</a></li>
                <li>Landasseln</li>
                </ol>
            </div>
            </div>
        </div>
        </section>
		<section class="section-80 bg-gray-light">
          <div class="cell-md-1" style="float: left; width: 10%;"><img src="<?php echo get_template_directory_uri(); ?>/images/collembola_gruen_r.png" /></div>
          <div class="shell">
            <div class="range text-md-left">
              <div class="cell-md-6 cell-lg-preffix-1 cell-md-push-1">
                <div>
                  <div class="img-wrap">
                    <figure>
					<img src="<?php echo get_template_directory_uri(); ?>/images/home-2-05_.jpg" width="570" height="320" alt="" class="img-responsive center-block">
					</figure>
                  </div>
                </div>
				<br/>
				<div>
                  <div class="img-wrap">
                    <figure>
					<img src="<?php echo get_template_directory_uri(); ?>/images/home-2-05.jpg" width="570" height="320" alt="" class="img-responsive center-block">
					</figure>
                  </div>
                </div>
              </div>
              <div class="cell-lg-5 cell-md-6" style="background-color: white;">
                <h2>Wie sehen Landasseln aus?</h2>
                <div class="divider-text divider-text-primary offset-top-26 offset-md-top-42">
                  <p>Die meisten Landasseln werden zwischen 2 und 20 mm groß und haben eine abgeflachte, ovale Körperform. Der Körper kann in drei Teile gegliedert werden: 
				  den Kopf, 
				  das Brustteil (Thorax) und den Hinterleib (Abdomen). Der Thorax besteht aus sieben und das Abdomen aus sechs Segmenten. An jedem der Segmente des Thorax 
				  sitzt ein siebengliedriges Beinpaar. Die einzelnen Segmente des Thorax und des Abdomens können mit Schuppen, Haaren oder Stacheln besetzt sein</p>
                  <p>Die Augen der meisten Isopoden bestehen aus einer Vielzahl von Einzelaugen (Ommatidien), dabei kann sich die Anzahl innerhalb der einzelnen Familien 
				  stark unterscheiden und natürlich gibt es auch Ausnahmen. Die Vertreter der Familie Trichoniscidae beispielsweise haben sehr einfache Augen, die aus bis zu 
				  drei Ocellen bestehen, innerhalb der Familie Platyarthridae sind die Augen stark reduziert oder fehlen gänzlich. Der Kopf ist meist einfach geformt, wobei 
				  der vordere Kopfteil entweder gleichmäßig rund oder in Form eines Frontallappens gestaltet ist.</p>
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