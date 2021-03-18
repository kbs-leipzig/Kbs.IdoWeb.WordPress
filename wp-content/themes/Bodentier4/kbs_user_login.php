<?php /* Template Name: kbs_user_anmeldung */ ?>
<?php get_header(); ?>
<main>
	<div class="entry-content">
		<section class="section-40 bg-gray-light">
			<div class="shell">
				<h2>Anmelden</h2>
				<hr class="divider divider-primary divider-60 divider-offset">
				<div class="range range-xs-center offset-top-32">
					<div class="cell-md-6 cell-md-preffix-6 cell-lg-4 cell-lg-preffix-4 cell-sm-8 cell-sm-preffix-2">
						<form id="form" class="text-left">
							<div class="form-group">
								<label for="email" class="form-label form-label-outside">E-Mail</label>
								<input id="email" type="email" data-bind="value:Email" class="form-control form-control-gray k-textbox" placeholder="E-Mail" required name="E-Mail" />
							</div>
							<div class="form-group">
								<label for="password" class="form-label form-label-outside">Kennwort</label>
								<input id="password" type="password" data-bind="value:Password" class="form-control form-control-gray k-textbox" placeholder="Kennwort" required name="Kennwort" />
							</div>
							<a data-role="button" id="submit" class="btn btn-primary btn-green btn-block btn-sm offset-top-22" name="button" data-bind="events:{click:loginUser}">Anmelden</a>
						</form>
						<br/>
						<a href="/passwort-vergessen">Passwort vergessen?</a>
					</div>
				</div>
			</div>
			<div class="offset-top-32">
				<span id="status" />
			</div>
		<script src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_fundmeldungen_kendo_js/login.js"></script>
		</section>
	</div>
</main>
<?php get_footer(); ?>