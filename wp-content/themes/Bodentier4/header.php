<? header("Access-Control-Allow-Origin: *"); ?>
<!DOCTYPE html>
<html lang="en" class="wide wow-animation smoothscroll">
  <head>
    <!-- Site Title-->
	<title><?php wp_title('|', true, 'right'); ?>Bodentier⁴</title>
	<script type="text/javascript">var ajaxurl=<?="\"".admin_url('admin-ajax.php') ."\""?></script>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/favicon.png" type="image/x-icon">
    <!-- Stylesheets-->
    <!-- Kendo UI -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_kendo_src/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_kendo_src/js/kendo.all.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_kendo_src/js/messages/kendo.messages.de-DE.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_kendo_src/js/cultures/kendo.culture.de.js"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_kendo_src/styles/web/kendo.common.css" rel="stylesheet" />
	<link href="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_kendo_src/styles/web/kendo.material.css" rel="stylesheet" />
	<!-- Dancing -->
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald:300,400,700%7CRoboto:300,300italic,400,700,700italic">
  	<!-- Font awesome 5 to replace dancing-theme's built-in 4.7.0 -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/fonts/fontawesome-5.12.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/styles/senck.css">
		<!--[if &lt; IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_fundmeldungen_kendo_js/html5shiv.min.js"></script>
		<![endif]-->
  </head>
  <body>
    <!-- Page-->
    <div class="page text-center">
      <!-- Page Header-->
      <header class="page-header">
	    <!-- RD Navbar-->
        <div class="rd-navbar-wrap">
          <nav data-layout="rd-navbar-sidebar" data-xs-layout="rd-navbar-sidebar" data-sm-layout="rd-navbar-sidebar" data-md-layout="rd-navbar-static" data-md-device-layout="rd-navbar-static" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-md-stick-up-offset="36px" data-lg-stick-up-offset="136px" class="rd-navbar-base rd-navbar">
            <div class="rd-navbar-inner">
              <!-- RD Navbar Panel-->
              <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button data-rd-navbar-toggle=".rd-navbar-sub-panel" class="rd-navbar-toggle"><span></span></button>
                <!-- RD Navbar Brand-->
                <div class="rd-navbar-brand"><a href="<?php echo get_home_url(); ?>" class="reveal-inline-block"><img src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/logo.png" width="301" height="71" alt=""></a></div>
                
                <div class="rd-navbar-contacts">
                  <div class="media p">
                    <div class="rd-navbar-brand"><a href="<?php echo get_template_directory_uri(); ?>" class="reveal-inline-block">
						<a class="no_deco" href="https://www.senckenberg.de/de/" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/images/senckenberg_logo.jpg" width="150" height="35" alt="Sencknberg Museum"></a></div>
						</a>
                  </div>
                </div>
              </div>
              <div class="rd-navbar-sub-panel" >
                <div class="rd-navbar-sub-panel-inner" >

				<div class="rd-navbar-nav-wrap" id="menu">

<!-- Menübereich START !-->
				<menu_1>
				<?php 
				wp_nav_menu( 
					array(
						'theme_location' => 'header-menu', 
						'container' => 'ul', 
						'menu_class' => 'rd-navbar-nav',
						'menu' => is_php_user_logged_in()?'headermenu':'headermenu-logged-out'
					)
				);
				?>
				</menu_1>
				<menu_2>
				<?php
				wp_nav_menu( 
					array(
						'theme_location' => 'user-menu', 
						'container' => 'ul', 
						'menu_class' => 'rd-navbar-nav',
						'menu' => is_php_user_logged_in()?get_php_user_role()=="Admin"?'usermenu-admin':'usermenu-logged-in':'usermenu-logged-out'
					)
				);
				?>
				  <!--div class="search_wrapper">
					<?php //get_search_form(); ?>
				  </div-->					
				</menu_2>					
<!-- Menübereich END !-->

                    <!-- RD Navbar Nav-->
              
                  </div>
                <!--RD Navbar Search                    
                <div class="rd-navbar-search">
                    <div data-custom-toggle=".rd-search" data-custom-toggle-disable-on-blur="false" class="rd-navbar-search-toggle"><span class="mdi mdi-magnify icon"></span></div>
                    <form action="http://localhost/wp/?page_id=209" data-search-live="rd-search-results-live" class="rd-search">
                      <div class="form-group">
                        <label for="rd-navbar-search-form-input" class="form-label">Suche</label>
                        <input id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off" class="rd-navbar-search-form-input form-control form-control-gray-lightest">
                        <button class="mdi mdi-magnify btn icon"></button>
                      </div>
                      <div id="rd-search-results-live" class="rd-search-results-live"></div>
                    </form>
                  </div>
                    -->  
                </div>
              </div>
            </div>
          </nav>
        </div>
     </header>
<style>

@media all {
      #menu {
         display: flex;
         flex-wrap: wrap;
      }
      menu_1 {
         flex-grow: 0;
         flex-shrink: 1;
         flex-basis: 100%;
      }
      menu_2 {
         flex-grow: 0;
         flex-shrink: 1;
         padding-top: 20px;
         flex-basis: 100%;
      }
}
   @media only screen and (min-width: 768px) {
      menu_1, menu_2 {
         flex-basis: 100%;
      }
   }
   
   @media (min-width: 992px) {
	   	menu_1 {
			flex-basis: 60%;
			padding-top: 0px;
	   	}
	   	menu_2 {
			flex-basis: 40%;
			padding-top: 0px;
	   	}
	   	menu_2 {
			text-align: right!important;
		}
   }
   @media (min-width: 1200px) {
      menu_1 {
         flex-basis: 60%;
         text-align: left;
         padding-top: 0px;          
       }
   }

   @media (min-width: 1200px) {
      menu_2 {
         flex-basis: 40%;
         text-align: right;
         padding-right: 10px;
         padding-top: 0px;          
      }
   }

</style>