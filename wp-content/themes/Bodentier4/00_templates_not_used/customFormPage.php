<?php /* Template Name: CustomFormPage */ ?>
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
                      <h1>Neue Fundmeldung</h1>
                      <ol class="breadcrumb">
                        <li><a href="./">Home</a></li>
                        <li>Erfgassen
                        </li>
                      </ol>
                    </div>
                  </div>
                </div>
              </section>
    <div class="section-top-80 section-md-top-110">
<h4>auswahl der art</h4>
              <h4>persönliche Angaben</h4>
              <div class="offset-md-top-36 offset-top-22 range range-xs-center">
                <div class="cell-md-8">
                  <!-- RD Mailform-->
                  <form data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php" class="range rd-mailform text-left">
                    <div class="cell-sm-6">
                      <div class="form-group">
                        <label for="contact-name" class="form-label form-label-outside">Vorname</label>
                        <input id="contact-name" type="text" name="name" data-constraints="@Required" class="form-control form-control-gray">
                      </div>
                    </div>
                    <div class="cell-sm-6 offset-top-12 offset-sm-top-0">
                      <div class="form-group">
                        <label for="contact-surname" class="form-label form-label-outside">Nachname</label>
                        <input id="contact-surname" type="text" name="surname" data-constraints="@Required" class="form-control form-control-gray">
                      </div>
                    </div>
                    <div class="cell-sm-6 offset-top-12">
                      <div class="form-group">
                        <label for="contact-email" class="form-label form-label-outside">E-Mail</label>
                        <input id="contact-email" type="email" name="email" data-constraints="@Required @Email" class="form-control form-control-gray">
                      </div>
                    </div>
                    <div class="cell-sm-6 offset-top-12">
                      <div class="form-group">
                        <label for="contact-phone" class="form-label form-label-outside">Telefon</label>
                        <input id="contact-phone" type="text" name="phone" data-constraints="@Required @Integer" class="form-control form-control-gray">
                      </div>
                    </div>

                    <div class="cell-md-12 offset-top-12">
<h4>Angaben zum Fundort</h4>
<div class="cell-sm-6">
                      <div class="form-group">
                        <label for="contact-name" class="form-label form-label-outside">Landkreis</label>
                        <input id="contact-name" type="text" name="name" data-constraints="@Required" class="form-control form-control-gray">
                      </div>
                    </div>
                    <div class="cell-sm-6 offset-top-12 offset-sm-top-0">
                      <div class="form-group">
                        <label for="contact-surname" class="form-label form-label-outside">Ort/nächstgelegener Ort*</label>
                        <input id="contact-surname" type="text" name="surname" data-constraints="@Required" class="form-control form-control-gray">
                      </div>
                    </div>
                      <div class="form-group">
                        <label for="contact-message" class="form-label form-label-outside">Genaue Lage und Lebensraum 
(z.B. Oststrand, Cospudener See nahe Leipzig) </label>
                        <textarea id="contact-message" name="message" data-constraints="@Required" class="form-control form-control-gray"></textarea>
                      </div>
<h4>Angabe von Koordinaten</h4>
                      <div class="offset-top-12 text-center text-md-left">
                        <button type="submit" class="btn btn-primary btn-sm">absenden</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
</div>

</main>
<?php get_footer();