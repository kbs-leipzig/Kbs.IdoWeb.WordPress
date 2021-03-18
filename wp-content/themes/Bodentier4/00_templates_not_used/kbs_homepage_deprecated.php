<?php /* Template Name: kbs_homepage_deprecated*/ ?>
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
                      <h1>Neue Fundmeldung</h1>
                      <ol class="breadcrumb">
                        <li><a href="./">Home</a></li>
                        <li>Erfassen</li>
                      </ol>
                    </div>
                  </div>
                </div>
    </section>
    <section class="section-40 section-md-40 bg-gray-light"> 
    
    <div class="offset-md-top-12 offset-top-12 range range-xs-center">
    <div class="cell-md-8">
    <!-- RD Mailform-->
    <form data-form-output="form-output-global" data-form-type="contact" method="post" action="#" class="range rd-mailform text-left">
        
        <div class="range range-xs-center"> 
        <h4>Auswahl der Art</h4>
            
        </div>
        <div class="cell-md-12 offset-top-12">
            <div class="form-group">
                        <select data-placeholder="Players" data-minimum-results-for-search="Infinity" data-constraints="@Required" class="form-control form-control-gray-base select-filter">
                                <option>Auswahl aus Artenliste</option>
                                <option value="2">1</option>
                                <option value="3">2</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                              </select>
                      </div>
            </div>
		<div class="cell-sm-4 offset-top-12">&nbsp;</div>
		<div class="cell-sm-4 offset-top-12">&nbsp;</div>
		<div class="range range-xs-center offset-top-32">
        <h4>persönliche Angaben</h4>
        </div>
                    <div class="cell-sm-6 offset-top-12">
                      <div class="form-group">
                        <label for="contact-name" class="form-label form-label-outside">Vorname</label>
                        <input id="contact-name" type="text" name="name" data-constraints="@Required" class="form-control form-control-gray">
                      </div>
                    </div>
                    <div class="cell-sm-6 offset-top-12">
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
        <!-- start -->
        <div class="range range-xs-center offset-top-32"> 
        <h4>Angaben zum Fundort</h4>        
        </div>
                <div class="cell-sm-6 offset-top-20">
                      <div class="form-group">
                        <select data-placeholder="Players" data-minimum-results-for-search="Infinity" data-constraints="@Required" class="form-control form-control-gray-base select-filter">
                                <option>Land</option>
                                <option value="2">Deutschland</option>
                                <option value="3">Schweiz</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                              </select>
                      </div>
                    </div>
                    <div class="cell-sm-6 offset-top-20">
                      <div class="form-group">
                        <select data-placeholder="Players" data-minimum-results-for-search="Infinity" data-constraints="@Required" class="form-control form-control-gray-base select-filter">
                                <option>Bundesland</option>
                                <option value="2">1</option>
                                <option value="3">2</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                              </select>
                      </div>
                    </div>
        <!-- ende -->
                    
                    <div class="cell-sm-6 offset-top-12">
                      <div class="form-group">
                        <label for="contact-surname" class="form-label form-label-outside">Ort/nächstgelegener Ort*</label>
                        <input id="contact-surname" type="text" name="surname" data-constraints="@Required" class="form-control form-control-gray">
                      </div>
                    </div>
        <div class="cell-md-12 offset-top-12">
                      <div class="form-group">
                        <label for="contact-message" class="form-label form-label-outside">Genaue Lage und Lebensraum 
(z.B. Oststrand, Cospudener See nahe Leipzig) </label>
                        <textarea id="contact-message" name="message" data-constraints="@Required" class="form-control form-control-gray"></textarea>
                      </div>
 </div>         
        
                    <div class="cell-sm-6 offset-top-20">
                      <select data-placeholder="Players" data-minimum-results-for-search="Infinity" data-constraints="@Required" class="form-control form-control-gray-base select-filter">
                                <option>Biotoptyp</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                              </select>
                            </div>
                    <div class="cell-sm-6 offset-top-20 ">
                            <!--Select 2-->
                            <div class="form-group">
                              <label for="date" class="form-label">Datum</label>
                              <input id="date" data-time-picker="date" type="text" name="date" data-constraints="@Required" class="form-control form-control-gray-base">
                            </div>
                          </div>
            <!-- -->
        <div class="cell-sm-6 offset-top-8">
                      <div class="form-group">
                        <label for="contact-phone" class="form-label form-label-outside">Anzahl der gefundenen Exemplare gesamt</label>
                        <input id="contact-phone" type="text" name="phone" data-constraints="@Required @Integer" class="form-control form-control-gray">
                      </div>
                    </div>
        <div class="cell-sm-6 offset-top-36">
                      <select data-placeholder="Players" data-minimum-results-for-search="Infinity" data-constraints="@Required" class="form-control form-control-gray-base select-filter">
                                <option>Stadium</option>
                                <option value="2">Männlich</option>
                                <option value="3">Weiblich</option>
                                <option value="4">Juvenil</option>
                                <option value="5">nicht differenziert</option>
                            </select>
                            </div>
                    
        <!-- -->
        
        <div class="cell-sm-6 offset-top-20">
                      <select data-placeholder="Players" data-minimum-results-for-search="Infinity" data-constraints="@Required" class="form-control form-control-gray-base select-filter">
                                <option>Sammelmethode</option>
                                <option value="2">Beobachtung</option>
                                <option value="3">Handfang (Pinzette etc.)</option>
                                <option value="4">Käfersieb</option>
                                <option value="5">Barberfalle</option>
                                <option value="6">Extraktion</option>
                                <option value="7">7</option>
                              </select>
                            </div>
        <div class="cell-sm-6 offset-top-20">
                      <select data-placeholder="Players" data-minimum-results-for-search="Infinity" data-constraints="@Required" class="form-control form-control-gray-base select-filter">
                                <option>Bestimmungsmethode</option>
                                <option value="2">Beobachtung lebend (ohne opt. Hilfmittel)</option>
                                <option value="3">Beobachtung lebend (Foto/Lupe)</option>
                                <option value="4">Bestimmung lebend (Mikroskop)</option>
                                <option value="5">Bestimmung tot</option>
                                <option value="6">äußere Merkmale (Mikroskop)</option>
                                <option value="7">Präparation (Mikroskop)</option>
                                <option value="8">DNA-Untersuchung</option>
                              </select>
                            </div>
        <!-- -->
                <div class="cell-md-12 offset-top-12">
                      <div class="form-group">
                        <label for="contact-message" class="form-label form-label-outside">sonstige Methoden </label>
                        <textarea id="contact-message" name="message" data-constraints="@Required" class="form-control form-control-gray"></textarea>
                      </div>
 </div> 
<!-- -->
        <div class="range range-xs-center offset-top-32"> 
        <h4>Angabe von Koordinaten</h4>        
        </div>
        <div class="cell-sm-6 offset-top-8">
                      <div class="form-group">
                        <label for="contact-phone" class="form-label form-label-outside">Breite/Länge</label>
                        <input id="contact-phone" type="text" name="phone" data-constraints="@Required @Decimal" class="form-control form-control-gray">
                      </div>
                    </div>
        <div class="cell-sm-6 offset-top-36">
                      <select data-placeholder="Players" data-minimum-results-for-search="Infinity" data-constraints="@Required" class="form-control form-control-gray-base select-filter">
                                <option>Ungenauigkeit</option>
                                <option value="2">0-100 m</option>
                                <option value="3">100-500</option>
                                <option value="4">500-1000 m</option>
                                <option value="5">1000-2000 m</option>
                                <option value="6">>2000 m</option>
                            </select>
                            </div>
                    
        <!-- -->
        
                      <div class="cell-md-12 offset-top-20">
                        <button type="submit" class="btn btn-primary btn-sm">absenden</button>
                      </div>
                    
                       
    </form>
    </div>
    </div>
    
</section>    
</div>
</main>
<?php get_footer();