<?php /* Template Name: kbs_homepage_deprecated */ ?>
<?php get_header(); ?>
<!-- Page Content-->
<main class="page-content">
        <section>
          <!-- Swiper-->
          <div class="swiper-outer">
            <div data-simulate-touch="false" class="swiper-container swiper-slider">
              <div class="swiper-wrapper">
                <div data-slide-bg="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/index-01.jpg" class="swiper-slide">
                  <div data-caption-animate="fadeInUp" class="swiper-slide-caption">
                    <div class="shell">
                      <h1>ERLEBEN</h1>
                      <p>Informationen/ Wissenswertes/rausgehen und selbst suchen/entdecken.</p>
					  <a href="#" class="btn btn-white btn-sm">Mehr lernen</a>
                    </div>
                  </div>
                </div>
                <div data-slide-bg="<?php echo get_template_directory_uri(); ?>/images/index-02.jpg" class="swiper-slide">
                  <div data-caption-animate="fadeInUp" class="swiper-slide-caption">
                    <div class="shell">
                      <h1>ERKENNEN</h1>
                      <p>With our professional coaches, instructors, and choreographers, you will master the professional dancing techniques.</p>
					  <a href="#" class="btn btn-white btn-sm">Mehr lernen</a>
                    </div>
                  </div>
                </div>
                <div data-slide-bg="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/index-03.jpg" class="swiper-slide">
                  <div data-caption-animate="fadeInUp" class="swiper-slide-caption">
                    <div class="shell">
                      <h1>ERFASSEN</h1>
                      <p>Wie kannst du mitmachen.</p>
					  <a href="#" class="btn btn-white btn-sm">Mehr lernen</a>
                    </div>
                  </div>
                </div>
				<div data-slide-bg="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/index-04.jpg" class="swiper-slide">
                  <div data-caption-animate="fadeInUp" class="swiper-slide-caption">
                    <div class="shell">
                      <h1>ERFORSCHEN</h1>
                      <p>(Wissenschaftsbeitrag damit leisten.</p>
					  <a href="#" class="btn btn-white btn-sm">Mehr lernen</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Swiper Pagination-->
              <div class="swiper-pagination"></div>
              <!-- Swiper Navigation-->
              <div class="swiper-button-prev mdi mdi-chevron-left"></div>
              <div class="swiper-button-next mdi mdi-chevron-right"></div>
            </div>
          </div>
        </section>
        <!-- TEST START -->
		<section class="section-60 section-md-110">
			<div class="range">
			  <div class="cell-md-2" style="float: left;">
				<img src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/skorpion_600.png" />
				</div>
			  <div class="cell-md-8 bg-gray-light">
				<h2><?php the_title(); ?></h2>
				<hr class="divider divider-60 divider-primary offset-top-32">
				<div class="range text-md-left offset-top-52">
					<div class="cell-md-12 inset-left-20" style="float: left;">
					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
					<?php endif; ?>
									  <!-- h6 class="offset-md-top-22 offset-top-22">MÖGLICHKEITEN ZUR FUNDMELDUNG</h6>
									  <p class="offset-top-12">Darüber hinaus haben die Nutzer des Bodentier-Portals die Möglichkeit zur Fundmeldung. Das gefundene und mittels Portal bestimmte Bodentier wird zusammen mit Angaben zum Fundort, dessen Koordinaten und ggf. Fotos an das Portal übermittelt.</p>
							</div>
							<!-- div id="bild" class="cell-md-4" style="float: left;"><a>
								  <img src="<?php //echo get_template_directory_uri(); ?>/images/home-2-05.jpg" width="312" height="480" alt="" class="img-responsive center-block">
								  <span>Beispiel Beschreibung</span>
								  </a>
							</div -->
						</div>
					</div>
				</div>
			  <div class="cell-md-2" style="float: right;">
				<img src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/hundert_600.png" />
			  </div>
			</div>
        </section>
		<!-- TEST END -->
        <!-- RD Parallax-->
        	
		<!-- section class="section-60 section-md-110 bg-gray-light section-md-top-0">
          <div class="shell">
            <div class="range text-md-left">
              <div class="cell-md-4">
			  <img src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/icon-01.png" alt="" class="reveal-inline-block">
			  
                <h5 class="text-bold offset-top-18">Einsteiger</h5>
                <p class="offset-top-12 divider-text">[von Klasse zu Ordnung] Our Group Animals Classes are perfect for beginners who want to enjoy the dance.</p>
              </div>
              <div class="cell-md-4"><img src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/icon-02.png" alt="" class="reveal-inline-block">
                <h5 class="text-bold offset-top-18">Fortgeschritener</h5>
                <p class="offset-top-12 divider-text">[von Ordnung zu Familie] Receive individual, patient instruction in any of your favorite animals.</p>
              </div>
              <div class="cell-md-4"><img src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/icon-03.png" alt="" class="reveal-inline-block">
                <h5 class="text-bold offset-top-18">Experte</h5>
                <p class="offset-top-12 divider-text">[von Familie zu Art] Practice parties are the perfect way to practice your new animals.</p>
              </div>
            </div>
          </div>
        </section-->
		
        <!-- section class="section-top-60 section-md-top-0">
          <div class="shell">
            <div class="range text-md-left">
              <div class="cell-md-6 img-fullwidth-wrapper" id="bild"><a>
                <div style="background: url('<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/home-2-06.jpg') center; background-size: cover;" class="img-fullwidth img-fullwidth-left triangle">
				<span>Lorem ipsum dolor</span>
			  </a>
				</div>
              
			  </div>
              <div class="cell-md-5 cell-md-preffix-1 section-bottom-80 section-top-40 section-md-top-140 section-md-bottom-140 offset-top-0">
                <h2>Habitus</h2>
                <p class="divider-text divider-text-primary offset-top-16 offset-md-top-42">Discover the fascination of dance with our group and private lessons and activities!</p><a href="#" class="offset-md-top-26 offset-top-12 btn btn-primary btn-sm">mehr wissen</a>
              </div>
            </div>
          </div>
        </section>
        <section>
          <div class="shell">
            <div class="range text-md-left">
              <div class="cell-lg-preffix-1 cell-md-push-1 cell-md-6 img-fullwidth-wrapper">
                <div style="background: url('<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/home-2-07.jpg') center; background-size: cover;" class="img-fullwidth img-fullwidth-right triangle"></div>
              </div>
              <div class="cell-md-6 cell-lg-5 section-bottom-80 section-top-40 section-md-top-140 section-md-bottom-140 offset-top-0">
                <h2>Giftklauen</h2>
                <p class="divider-text divider-text-primary offset-top-16 offset-md-top-42">There are numerous benefits to partaking in dance classes ranging from exercising to making new friends.</p><a href="#" class="offset-md-top-26 offset-top-12 btn btn-primary btn-sm">mehr wissen</a>
              </div>
            </div>
          </div>
        </section>
        <section>
          <div class="shell">
            <div class="range text-md-left">
              <div class="cell-md-6 img-fullwidth-wrapper">
                <div style="background: url('<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/home-2-08.jpg') center; background-size: cover;" class="img-fullwidth img-fullwidth-left triangle"></div>
              </div>
              <div class="cell-md-5 cell-md-preffix-1 section-bottom-80 section-top-40 section-md-top-140 section-md-bottom-140 offset-top-0">
                <h2>Ocellen 2</h2>
                <p class="divider-text divider-text-primary offset-top-16 offset-md-top-42">A perfect opportunity for teenagers to plunge into the world of dance and learn new moves.</p><a href="#" class="offset-md-top-26 offset-top-12 btn btn-primary btn-sm">mehr wissen</a>
              </div>
            </div>
          </div>
        </section -->
                
        <section class="section-80 section-md-110 bg-gray-light">
          <div class="shell">
            <h2>Aktuelle Informationen</h2>
            <hr class="divider divider-60 divider-primary offset-top-32">
            <!-- Owl Carousel-->
            <div data-dots="true" data-items="1" data-sm-items="2" data-md-items="3" data-margin="30" class="text-md-left owl-carousel owl-dots-md offset-top-32 offset-md-top-60">
              <div>
                <div class="gallery-item"><a href="workshop-single.html" class="reveal-inline-block"><img src="<?php echo get_template_directory_uri(); ?>/images/home-2-13.jpg" width="370" height="273" alt="" class="img-responsive reveal-inline-block"></a></div>
                <h5 class="text-bold offset-top-8"><a href="workshop-single.html">Neueste Fundmeldungen</a></h5>
                <p class="offset-top-8"><span class="text-middle icon mdi mdi-calendar text-gray icon-lg"></span><span class="text-middle inset-left-5">September 2-5</span></p>
              </div>
              <div>
                <div class="gallery-item"><a href="workshop-single.html" class="reveal-inline-block"><img src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/home-2-14.jpg" width="370" height="273" alt="" class="img-responsive reveal-inline-block"></a></div>
                <h5 class="text-bold offset-top-8"><a href="workshop-single.html">Neue und aktualisierte Steckbriefe</a></h5>
                <p class="offset-top-8"><span class="text-middle icon mdi mdi-calendar text-gray icon-lg"></span><span class="text-middle inset-left-5">September 12-15</span></p>
              </div>
              <div>
                <div class="gallery-item"><a href="workshop-single.html" class="reveal-inline-block"><img src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/home-2-15.jpg" width="370" height="273" alt="" class="img-responsive reveal-inline-block"></a></div>
                <h5 class="text-bold offset-top-8"><a href="workshop-single.html">Neueste Fotos</a></h5>
                <p class="offset-top-8"><span class="text-middle icon mdi mdi-calendar text-gray icon-lg"></span><span class="text-middle inset-left-5">September 18-21</span></p>
              </div>
            </div>
            <div class="offset-top-32 offset-md-top-60"><a href="workshops.html" class="btn btn-primary btn-sm">Alle Informationen ansehen</a></div>
          </div>
        </section>
    </main>
<?php 
get_footer();