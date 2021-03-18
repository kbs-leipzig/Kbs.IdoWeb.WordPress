<?php /* Template Name: kbs_erfassen_fundort_erfassen */ ?>
<?php redirect_if_logged_out(); ?>
<?php get_header(); ?>
<main class="page-content">
	<section class="section-40 bg-gray-light">
		<h2>Fundort erfassen</h2>
		<div class="shell-wide offset-top-12">
			<div class="cell-sm-10 cell-xs-10">
				<form id="form" class="range text-left">
					<div class="cell-sm-4 cell-xs-12 offset-top-0">
						<div class="offset-top-20">
							<div class="form-group">
								<label for="localityName" class="form-label form-label-outside">Fundort</label>
								<input id="localityName" type="text" data-bind="value:LocalityName" placeholder="Ort bzw. nächstgelegener Ort des Fundes" class="form-control form-control-gray k-textbox required" name="Ort" required />
							</div>
						</div>
						<div class="offset-top-20">
							<div class="form-group">
								<label for="localityCountry" class="form-label form-label-outside">Land</label>
								<input id="localityCountry" type="text" data-bind="value:CountryId" placeholder="Land" class="form-control form-control-gray k-textbox" name="Land" />
							</div>
						</div>
						<div class="offset-top-20">
							<div class="form-group" id="localityRegionDiv">
								<label for="localityRegion" class="form-label form-label-outside">Bundesland</label>
								<input id="localityRegion" type="text" data-bind="value:RegionId" placeholder="Bundesland" class="form-control form-control-gray k-textbox" name="Bundesland" />
							</div>
						</div>
						<div class="offset-top-20">
							<div class="form-group">
								<label for="habitatDescription" class="form-label form-label-outside">Lage und Lebensraum</label>
								<textarea id="habitatDescription" type="text" placeholder="Genaue Beschreibung des Fundortes und Lebensraumes" data-bind="value:HabitatDescription" class="form-control form-control-gray k-textbox" name="Lebensraum"></textarea>
							</div>
						</div>
					</div>
					<div class="cell-sm-8 cell-xs-12 offset-top-20">
						<div class="form-group">
							<label for="map" class="form-label form-label-outside">Karte</label>
							<div id="map" name="Karte"></div>
						</div>
					</div>
					<script id="scaleTemplate" type="text/x-kendo-template">
						<div class="indicator-text">#= size * scale # m</div>
						<div class="indicator" style="width: #= size #px;"></div>
					</script>
					<div class="cell-sm-4 cell-xs-12 offset-top-20">
						<div class="form-group">
							<label for="accuracy" class="form-label form-label-outside">Genauigkeit</label>
							<input id="accuracy" class="form-control form-control-gray required" data-bind="value:AccuracyId" name="Genauigkeit" required />
						</div>
					</div>	
					<div class="cell-sm-4 cell-xs-12 offset-top-20">
						<div class="form-group">
							<label for="latitudeDecimal" class="form-label form-label-outside">Breite</label>
							<input id="latitudeDecimal" type="number" data-bind="value:LatitudeDecimal" placeholder="Geographische Breite nach WGS84" class="form-control form-control-gray required" name="Breite" required>
						</div>
					</div>
					<div class="cell-sm-4 cell-xs-12 offset-top-20">
						<div class="form-group">
							<label for="longitudeDecimal" class="form-label form-label-outside">Länge</label>
							<input id="longitudeDecimal" type="number" data-bind="value:LongitudeDecimal" placeholder="Geographische Länge nach WGS84" class="form-control form-control-gray required" name="Länge" required>
						</div>
					</div>
					
					<div class="cell-sm-4 cell-xs-12 offset-top-20">
						<div class="form-group">
							<label for="habitat1" class="form-label form-label-outside">Biotop (Ebene 1)</label>
							<input id="habitat1" class="form-control form-control-gray" name="Biotop" />
						</div>
					</div>	
					<div id="habitat2Div" style="display:none;" class="cell-sm-4 cell-xs-12 offset-top-20">
						<div class="form-group">
							<label for="habitat2" class="form-label form-label-outside">Biotop (Ebene 2)</label>
							<input id="habitat2" class="form-control form-control-gray" name="Biotop" />
						</div>
					</div>
					<div id="habitat3Div" style="display:none;" class="cell-sm-4 cell-xs-12 offset-top-20">
						<div class="form-group">
							<label for="habitat3" class="form-label form-label-outside">Biotop (Ebene 3)</label>
							<input id="habitat3" class="form-control form-control-gray" name="Biotop" />
						</div>
					</div>
					<div class="cell-sm-12 cell-xs-12 offset-top-20 text-center">
						<div id="status"></div>	
					</div>
					<div class="cell-sm-12 cell-xs-12 text-center offset-top-20">
						<div data-role="button" name="Absenden" data-bind="events:{click:saveLocality}" class="btn btn-primary btn-green btn-sm">Absenden</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</main>
<style>
	@media only screen and (max-width: 768px) {
		#map {
			height: 300px!important;
		}
	}
</style>
<script src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_fundmeldungen_kendo_js/newevents.js"></script>
<?php get_footer(); ?>