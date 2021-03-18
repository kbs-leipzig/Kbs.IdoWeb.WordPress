<?php /* Template Name: CustomPageBestimmung */ ?>
<?php get_header(); ?>

<main class="page-content">
<header class="entry-header">
<?php //bornholm_the_post_header( 'h1', $post ) ?>
</header>
<div class="entry-content">

<!-- h2>Блог работает на WordPress версии <?php bloginfo('version'); ?></h2><br/ !-->
<!-- RD Parallax-->
    <section class="rd-parallax">
                <div data-speed="0.2" data-type="media" data-url="<?php echo get_template_directory_uri(); ?>/images/fundmeldung.jpg" class="rd-parallax-layer"></div>
                <div data-speed="0" data-type="html" class="rd-parallax-layer">
                  <div class="breadcrumb-wrapper">
                    <div class="shell context-dark section-40 section-lg-top-158">
                      <h1>Bestimmung</h1>
                      <ol class="breadcrumb">
                        <li><a href="./">Erkennen</a></li>
                        <li>Bestimmung</li>
                      </ol>
                    </div>
                  </div>
                </div>
    </section>
    <section class="text-md-left section-80 section-md-110">
        <div class="shell">
            <div class="range">
                <div class="cell-md-11">
                    <!-- Terms-list-->
                    <dl class="list-terms">
                        <dt class="h4">Bestimmung</dt>
                        <dd>
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. 
							irmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.   This is important; we hope you will take time to read it carefully.
                            Remember, you can find controls to manage your information and protect your privacy and
                            security. We’ve tried
                            to keep it as simple as possible.
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </section> 
</div>
</main>
<?php get_footer();