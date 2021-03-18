<?php /* Template Name: kbs_erfassen_fundorte */ ?>
<?php redirect_if_logged_out(); ?>
<?php get_header(); ?>
	<main class="page-content">
		<section class="section-40 bg-gray-light">
			<div class="shell-wide">
				<h2 class="text-center">Meine Fundorte</h2>
				<div class="offset-md-top-12 offset-top-12 range range-xs-center">
					<div class="cell-md-10 cell-md-preffix-1">
						<div class="col-xs-12 offset-top-20">
							<div class="form-group">
								<div id="grid"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<script src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_fundmeldungen_kendo_js/userevents.js"></script>
	</main>
<?php get_footer(); ?>