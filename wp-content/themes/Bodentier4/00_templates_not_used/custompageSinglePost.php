<?php /* Template Name: CustomPageSinglePost */ ?>
<?php get_header(); ?>

<main class="page-content">
<header class="entry-header">
<?php //bornholm_the_post_header( 'h1', $post ) ?>
</header>
<div class="entry-content">

<!-- h2>Блог работает на WordPress версии <?php bloginfo('version'); ?></h2><br/ !-->
<!-- RD Parallax-->
              <section class="rd-parallax">
                <div data-speed="0.2" data-type="media" data-url="<?php echo get_template_directory_uri(); ?>/images/breadcrumbs-01.jpg" class="rd-parallax-layer"></div>
                <div data-speed="0" data-type="html" class="rd-parallax-layer">
                  <div class="breadcrumb-wrapper">
                    <div class="shell context-dark section-40 section-lg-top-158">
                      <h1>Hundertfüssler (Chilopoda)</h1>
                      <ol class="breadcrumb">
                        <li><a href="./">Home</a></li>
                        <li>Hundertfüßer (Chilopoda)
                        </li>
                      </ol>
                    </div>
                  </div>
                </div>
              </section>
<!-- LOOP --- !-->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php the_content(); ?>
<?php endwhile; endif; ?>
<!-- END LOOP --- !-->
</div>

</main>
<?php get_sidebar();
get_footer();