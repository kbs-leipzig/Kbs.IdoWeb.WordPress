<?php /* Template Name: kbs_erfassen_funde_erfassen */ ?>
<?php redirect_if_logged_out(); ?>
<?php get_header(); ?>
<main class="page-content">
	<section class="section-40 bg-gray-light">
		<h2 class="text-center">Funde erfassen</h2>
		<div class="shell-wide offset-top-12">
			<div class="cell-sm-10 cell-xs-10">
				<form id="form" class="range text-left">
					<div class="cell-12 text-center offset-top-12 h4">Angaben zum Fundort</div>
					<div id="fundortLink" class="cell-12 text-center offset-top-12 h4" style="display:none;">Editieren des Fundorts bitte über <a href="/administration/fundorte">Fundorte verwalten</a></div>
					<div class="cell-sm-4 cell-xs-12 offset-top-0">
						<div class="offset-top-20">
							<div class="form-group">
								<label for="localityName" class="form-label form-label-outside">Fundort</label>
								<input id="localityName" type="text" data-bind="value:LocalityName" placeholder="Ort bzw. nächstgelegener Ort des Fundes" class="form-control form-control-gray k-textbox required" name="Ort" required />
							</div>
						</div>
						<div class="offset-top-20">
							<div class="form-group">
								<label for="CountryId" class="form-label form-label-outside">Land</label>
								<input id="CountryId" type="text" data-bind="value:CountryId" placeholder="Land" class="form-control form-control-gray k-textbox" name="Land" />
							</div>
						</div>
						<div class="offset-top-20">
							<div class="form-group" id="RegionIdDiv">
								<label for="RegionId" class="form-label form-label-outside">Bundesland</label>
								<input id="RegionId" type="text" data-bind="value:RegionId" placeholder="Bundesland" class="form-control form-control-gray k-textbox" name="Bundesland" />
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
					<style>
						.indicator-wrap {
							position: absolute;
							bottom: 20px;
							left: 5px;
						}

						.indicator {
							background: #fff;
							height: 5px;
						}

						.indicator-text {
							color: #fff;
							text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
							text-align: center;
						}
					</style>
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
							<label for="accuracy" class="form-label form-label-outside">Genauigkeit</label>
							<input id="accuracy" class="form-control form-control-gray required" data-bind="value:AccuracyTypeId" name="Genauigkeit" required />
						</div>
					</div>
					<div class="cell-sm-12 cell-xs-12 offset-top-20">
						<a href="https://www.umweltbundesamt.de/themen/boden-landwirtschaft/flaechensparen-boeden-landschaften-erhalten/corine-land-cover-clc" target="_blank">Biotoptypen nach Klassifikation von CORINE Land Cover </a>
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
					<div class="cell-12 text-center offset-top-32 h4">persönliche Angaben</div>
					<div id="author" class="cell-sm-6 cell-xs-12 offset-top-12">
						<div class="form-group">
							<label for="authorName" class="form-label form-label-outside">Name(n)</label>
							<input id="authorName" type="text" data-bind="value:AuthorName" name="Name" placeholder="Als Finder anzugebende Person(en)" class="form-control form-control-gray k-textbox required" required>
						</div>
					</div>
					<div class="cell-12 text-center offset-top-32 h4">Auswahl der Art</div>
					<div class="cell-sm-6 cell-xs-12 offset-top-20">
						<div class="form-group">
							<label for="taxon" class="form-label form-label-outside">Auswahl aus Artenliste</label>
							<input id="taxon" class="form-control form-control-gray required" data-bind="value:TaxonId" name="Art" required />
						</div>
					</div>
					<div class="cell-sm-3 cell-xs-12 offset-top-36">
						<div class="form-group text-center">
							<div data-role="button" id="addObsForm" name="Datenerfassung" data-bind="events:{click:addObsForm}" disabled="true" class="btn btn-secondary btn-green btn-sm">Daten zur Art erfassen</div>
						</div>
					</div>
					<div class="cell-sm-3 cell-xs-12 offset-top-48">
						<div id="eventStatus"></div>
					</div>
					<div id="observationPlaceholder" data-template="observationTemplate"></div>
					<script id="observationTemplate" type="text/x-kendo-template">
						<div class="cell-12 text-center offset-top-32 h4">Angaben zum Fund</div>
						<div class="col-sm-4 col-xs-12 offset-top-20">
							<div class="form-group">
								<label for="habitatDate" class="form-label form-label-outside">Datum</label>
								<input id="habitatDate" data-bind="value:HabitatDate" class="form-control form-control-gray" name="Datum" />
							</div>
						</div>
						<div class="col-sm-4 col-xs-12 offset-top-20">
							<div class="form-group">
								<label for="localityType" class="form-label form-label-outside">Sammelmethode</label>
								<input id="localityType" data-bind="value:LocalityTypeId" class="form-control form-control-gray required" name="Sammelmethode" required />
							</div>
						</div>
						<div class="col-sm-4 col-xs-12 offset-top-20">
							<div class="form-group">
								<label for="diagnosisType" class="form-label form-label-outside">Bestimmungsmethode</label>
								<input id="diagnosisType" data-bind="value:DiagnosisTypeId" class="form-control form-control-gray required" name="Bestimmungsmethode" required />
							</div>
						</div>
						<div class="col-sm-12 col-xs-12 offset-top-20">
							<label for="optionSelection" class="form-label form-label-outside col-sm-12">Art der Anzahl</label>
							<div class="col-sm-6 cell-xs-12 offset-xs-top-12 offset-sm-top-12">
								<div class="form-group">
									<input id="adviceCountOption" type="radio" class="k-radio" name="Art der Anzahl" />
									<label for="adviceCountOption" data-bind="value:AdviceCountOption" class="k-radio-label">Genaue Anzahl der gefundenen Exemplare</label>
								</div>
							</div>
							<div class="col-sm-6 cell-xs-12 offset-top-12">
								<div class="form-group">
									<input id="sizeGroupOption" type="radio" class="k-radio" name="Art der Anzahl" />
									<label for="sizeGroupOption" data-bind="value:SizeGroupOption" class="k-radio-label">Schätzung der gefundenen Exemplare</label>
								</div>
							</div>
						</div>
						<div class="container row">			
							<div id="adviceCountDiv" class="col-sm-3 col-xs-12 offset-top-20">
								<div class="form-group">
									<label for="adviceCount" class="form-label form-label-outside">Anzahl der gefundenen Exemplare</label>
									<input id="adviceCount" type="number" data-bind="value:AdviceCount" class="form-control form-control-gray required" name="Anzahl" />
								</div>
							</div>
						</div>
						<div id="maleCountDiv" class="col-sm-3 col-xs-12 offset-top-20">
							<div class="form-group">
								<label for="maleCount" class="form-label form-label-outside">Anzahl der männlichen Exemplare</label>
								<input id="maleCount" type="number" data-bind="value:MaleCount" class="form-control form-control-gray" name="Anzahl der Männchen" />
							</div>
						</div>
						<div id="femaleCountDiv" class="col-sm-3 col-xs-12 offset-top-20">
							<div class="form-group">
								<label for="femaleCount" class="form-label form-label-outside">Anzahl der weiblichen Exemplare</label>
								<input id="femaleCount" type="number" data-bind="value:FemaleCount" class="form-control form-control-gray" name="Anzahl der Weibchen" />
							</div>
						</div>
						<div id="juvenileCountDiv" class="col-sm-3 col-xs-12 offset-top-20">
							<div class="form-group">
								<label for="juvenileCount" class="form-label form-label-outside">Anzahl der juvenilen Exemplare</label>
								<input id="juvenileCount" type="number" data-bind="value:JuvenileCount" class="form-control form-control-gray" name="Anzahl der Juvenile" />
							</div>
						</div>
						<div id="undivCountDiv" class="col-sm-3 col-xs-12 offset-top-20">
							<div class="form-group">
								<label for="undivCount" class="form-label form-label-outside">Anzahl der undifferenzierten Exemplare</label>
								<input id="undivCount" type="number" data-bind="value:UndivCount" class="form-control form-control-gray" name="Anzahl undifferenzierter Exemplare" />
							</div>
						</div>
						<div id="sizeGroupDiv" class="col-sm-3 col-xs-12 offset-top-20">
							<div class="form-group">
								<label for="sizeGroup" class="form-label form-label-outside">Häufigkeitsklasse des Fundes</label>
								<input id="sizeGroup" data-bind="value:SizeGroupId" class="form-control form-control-gray required" name="Häufigkeitsklasse" />
							</div>
						</div>
						<div class="col-sm-12 col-xs-12 offset-top-20">
							<div class="form-group">
								<label for="observationComment" class="form-label form-label-outside">Kommentar an die Taxonexpert*innen</label>
								<textarea id="observationComment" type="text" placeholder="Kommentar an den Taxonexperten" data-bind="value:ObservationComment" class="form-control form-control-gray k-textbox" name="Kommentar"></textarea>
							</div>
						</div>
						<div class="col-sm-12 col-xs-12 offset-top-20">
							<div class="form-group">
								<label for="files" class="form-label form-label-outside">Bilder</label>
								<input id="files" type="file" name="files"/>
							</div>
						</div>
						<div class="col-sm-3 col-xs-12 offset-top-20">
							<div class="form-group">
								<div data-role="button" id="addObsToList" name="Speichern" data-bind="events:{click:addObsToList}" class="btn btn-secondary btn-green btn-sm">Weitere Art zum Fundort hinzufügen</div>
							</div>
						</div>
						<div class="col-sm-3 col-xs-12 offset-top-20">
							<div class="form-group">
								<div data-role="button" id="cancelObs" name="Abbrechen" data-bind="events:{click:cancelObservation}" class="btn btn-secondary btn-green btn-sm">Abbrechen</div>
							</div>
						</div>
						<div class="col-sm-6 col-xs-12 offset-top-32">
							<div id="obsStatus"></div>
						</div>
					</script>
					<div class="cell-12 range range-sm-center  range-xs-center offset-top-20" id="listDiv"> 
						<div class="form-group text-center">
							<div id="list"></div>
						</div>
					</div>
					<div class="cell-sm-12 cell-xs-12 offset-top-20 text-center">
						<div id="status"></div>	
					</div>
					<div class="cell-sm-12 cell-xs-12 text-center offset-top-20">
						<div data-role="button" name="Absenden" data-bind="events:{click:saveLocality}" class="btn btn-primary btn-green btn-sm">Unter Meine Fundmeldungen speichern</div>
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
<script src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_fundmeldungen_kendo_js/newobs.js"></script>
<?php get_footer(); ?>