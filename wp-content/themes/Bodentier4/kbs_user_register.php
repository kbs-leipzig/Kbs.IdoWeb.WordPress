<?php /* Template Name: kbs_user_registrierung */ ?>
<?php get_header(); ?>
<header class="entry-header">
</header>
<div class="entry-content">
<!-- Page Content-->
	<main class="page-content">
		<section class="section-40 bg-gray-light">
			<div class="shell">
				<h2>Registrieren</h2>
				<hr class="divider divider-primary divider-60 divider-offset">
				<div class="range range-xs-center offset-top-32">
					<div class="cell-md-6 cell-md-preffix-6 cell-lg-4 cell-lg-preffix-4 cell-sm-8 cell-sm-preffix-2">
						<form id="form" class="text-left">
							<div class="form-group">
								<label for="firstname" class="form-label form-label-outside">Vorname</label>
								<input id="firstname" type="text" data-bind="value:FirstName" class="form-control form-control-gray k-textbox" name="Vorname" />
							</div>
							<div class="form-group">
								<label for="lastname" class="form-label form-label-outside">Nachname</label>
								<input id="lastname" type="text" data-bind="value:LastName" class="form-control form-control-gray k-textbox" name="Nachname" />
								</div>
							<div class="form-group">
								<label for="password" class="form-label form-label-outside">Kennwort</label>
								<input id="password" type="password" data-bind="value:Password" class="form-control form-control-gray k-textbox" required name="Kennwort" />
							</div>
							<div class="form-group">
								<label for="confirmPassword" class="form-label form-label-outside">Kennwort wiederholen</label>
								<input id="confirmPassword" type="password" class="form-control form-control-gray k-textbox" required name="Bestätigung des Kennworts" />
							</div>
							<div class="form-group">
								<label for="email" class="form-label form-label-outside">E-Mail</label>
								<input id="email" type="email" data-bind="value:Email" class="form-control form-control-gray k-textbox" required name="E-Mail" />
							</div>
							<div class="form-group">
								<label for="dataRestriction" class="form-label form-label-outside">Weitergabe von Fundmeldungen an Dritte</label>
								<input id="dataRestriction" class="form-control form-control-gray" data-bind="value:DataRestrictionId" style="height: 100%;" required name="Weitergabe" />
							</div>
							<div class="form-group">
								<label for="comment" class="form-label form-label-outside">Kommentar</label>
								<textarea id="comment" type="text" data-bind="value:Comment" class="form-control form-control-gray k-textarea" name="Kommentar"></textarea>
							</div>
							<div class="form-group">
								<input type="checkbox" id="police" class="k-checkbox" data-bind="checked:isChecked">
								<label id="policedetails_open" for="police" class="k-checkbox-label">Ich erkläre mich mit der <a href="#wow-modal-id-1">Datenschutzerklärung und den Nutzungshinweisen</a> einverstanden.</label>
							</div>
							<div id="buttonRegister" data-role="button" data-bind="events:{click:registerUser}" class="btn btn-primary btn-block btn-green btn-sm offset-top-22" name="Registrieren">Registrieren</div>
						</form>
					</div>
				</div>
				<div class="offset-top-32">
					<span id="status" />
				</div>
			</div>
		</section>
		<script src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_fundmeldungen_kendo_js/register.js"></script>
	</main>
</div>
<?php get_footer(); ?>