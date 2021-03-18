<?php /* Template Name: kbs_user_passwort_vergessen */ ?>
<?php get_header(); ?>
<main>
	<div class="entry-content">
		<section class="section-40 bg-gray-light">
			<div class="shell">
				<h2>Passwort zur&uuml;cksetzen</h2>
				<hr class="divider divider-primary divider-60 divider-offset">
				<div class="range range-xs-center offset-top-32">
					<div class="cell-md-6 cell-md-preffix-6 cell-lg-4 cell-lg-preffix-4 cell-sm-8 cell-sm-preffix-2">
						<form id="form" class="text-left">
							<div class="form-group">
								<label for="EMail" class="form-label form-label-outside">E-Mail</label>
								<input id="email" type="email" data-bind="value:Email" class="form-control form-control-gray k-textbox" placeholder="E-Mail" required name="EMail" />
							</div>
							<div id="passwordContainer" style="display:none;" class="form-group">
								<label for="password" class="form-label form-label-outside">Kennwort</label>
								<input id="password" type="password" data-bind="value:NewPassword" class="form-control form-control-gray k-textbox" placeholder="Neues Kennwort" name="Kennwort" />
							</div>
							<div id="tokenContainer" style="display:none;" class="form-group">
								<label for="token" class="form-label form-label-outside">Token</label>
								<input id="token" type="text" data-bind="value:Token" class="form-control form-control-gray k-textbox" placeholder="Token (aus E-Mail)" name="Token" />
							</div>

							<a data-role="button" id="requestTokenButton" class="btn btn-primary btn-green btn-block btn-sm offset-top-22" name="button" data-bind="events:{click:requestToken}">E-Mail prüfen</button>
							<a data-role="button" id="updatePasswordButton" style="display:none;" class="btn btn-primary btn-green btn-block btn-sm offset-top-22" name="button" data-bind="events:{click:updatePassword}">Passwort erneuern</a>
						</form>
					</div>
				</div>
			</div>
			<div class="offset-top-32">
				<span id="status" />
			</div>
		<script src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_fundmeldungen_kendo_js/password_reset.js"></script>
		</section>
	</div>
</main>
<?php get_footer(); ?>