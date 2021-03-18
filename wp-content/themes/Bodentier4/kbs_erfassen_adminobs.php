<?php /* Template Name: kbs_erfassen_funde_verwalten */ ?>
<?php redirect_if_not_admin(); ?>
<?php get_header(); ?>
	<main class="page-content">
		<section class="section-40 bg-gray-light">
			<h2 id="kapitel" class="text-center">Funde verwalten</h2>
			<div class="offset-md-top-12 offset-top-12 range range-xs-center">
				<div class="cell-md-10 cell-md-preffix-1">
					<div class="col-xs-12 offset-top-20">
						<div class="form-group">
							<div id="grid"></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<script src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_fundmeldungen_kendo_js/adminobs.js"></script>
	</main>
<style>
	.k-grid  .k-grid-header  .k-header  .k-link {
		height: auto;
		vertical-align: top;
	}
	.k-filterable,.k-header {
		vertical-align: top!important;
	}
	.k-grid  .k-grid-header  .k-header {
		white-space: normal;
		word-wrap: break-word;
	}
</style>
<?php get_footer(); ?>