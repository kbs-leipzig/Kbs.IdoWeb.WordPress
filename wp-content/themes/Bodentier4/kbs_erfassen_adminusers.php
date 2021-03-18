<?php /* Template Name: kbs_erfassen_benutzer_verwalten */ ?>
<?php get_header(); ?>
<?php redirect_if_not_admin(); ?>
<style>
	input[role=listbox]{
		width: auto!important;
	}
</style>
<main class="page-content">
		<section class="section-40 bg-gray-light">
		<div class="shell-wide">
			<h2>Benutzer verwalten</h2>
			<hr class="divider divider-primary divider-60 divider-offset">
			<div class="offset-md-top-12 offset-top-12 range range-xs-center">
				<div class="cell-md-10 cell-md-preffix-1">
					<div class="col-md-12 offset-top-20">
						<div id="grid" />
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<script src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_fundmeldungen_kendo_js/adminusers.js"></script>
<?php get_footer(); ?>