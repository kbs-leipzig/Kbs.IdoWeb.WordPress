<?php /* Template Name: kbs_user_abmeldung */ ?>
<?php 
	 setcookie ( "JWTToken" , FALSE, time()-3600, "/", ".s193.goserver.host", FALSE , TRUE );
?>
<?php get_header(); ?>
<div id="menu_1" style="display:none"><?php echo wp_nav_menu(array('theme_location' => 'header-menu','menu' =>'headermenu-logged-out','container' => 'ul','menu_class' => 'rd-navbar-nav')) ?></div>
<div id="menu_2" style="display:none"><?php echo wp_nav_menu(array('theme_location' => 'user-menu','menu' =>'usermenu-logged-out','container' => 'ul','menu_class' => 'rd-navbar-nav')) ?></div>
<main>
    <section class="text-left section-110">
        <div class="shell">
			<dl class="list-terms">
				<dt class="h4">Abmeldung</dt>
				<dd id="status"></dd>
			</dl>
        </div>
		<script src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_fundmeldungen_kendo_js/logout.js"></script>
		<script>
			$("menu_2").replaceWith($("#menu_2"))
			$("#menu_2").css({"display":"","flex-basis":"50%","text-align":"right","padding-right":"10px","padding-top":"0px"});
			$("menu_1").replaceWith($("#menu_1"))
			$("#menu_1").css({"display":"","flex-basis":"50%","text-align":"left","padding-right":"10px","padding-top":"0px"});
		</script>
    </section>
</main>
<?php get_footer(); ?>