<? header("Access-Control-Allow-Origin: *"); ?>
<?php /* Template Name: kbs_misc_map_test */ ?>
<?php get_header(); ?>
<main role="main">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
			<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/ol.css" rel="stylesheet" />
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/proj4.js"></script>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/ol.js"></script>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/olBiodiv.js"></script>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/defaultQueryMap.js"></script>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/js/kbs_map_phaeno/defaultQueryPhaeno.js"></script>
		</header>
        <div class="entry-content">
		<input type="hidden" name="ctl00$_mainContentPlaceHolder$_selectedSpecies" id="_selectedSpecies" value="57599">
		<!-- RD Parallax-->
		<?php get_template_part('partials/kbs_parallax_header'); ?>

        	<!-- CONTENT -->
            <section class="section-30 section-md-20">
                <div class="shell">
<h1 class="title_substitute"><em>Lamyctes africanus</em> (Porath, 1871)</h1>
<div class="steckbrief_content">
<div class="steckbrief_wrapper">
<h2><strong>Systematik</strong></h2>
<table class="steckbrief_table no_head">
<thead></thead>
<tbody>
<tr>
<td>Stamm</td>
<td>Gliederfüßer (Arthropoda)</td>
</tr>
<tr>
<td>Klasse</td>
<td>Hundertfüßer (Chilopoda)</td>
</tr>
<tr>
<td>Ordnung</td>
<td>Steinläufer (Lithobiomorpha)</td>
</tr>
<tr>
<td>Familie</td>
<td>Henicopidae</td>
</tr>
<tr>
<td>Genus</td>
<td><em>Lamyctes</em></td>
</tr>
</tbody>
</table>
</div>
<div class="steckbrief_wrapper section-30">
<h2><strong>Allgemeines</strong></h2>
<table class="steckbrief_table no_head">
<thead></thead>
<tbody>
<tr>
<td>Länge</td>
<td>7-10 mm</td>
</tr>
<tr>
<td>Verbreitung &amp; Häufigkeit</td>
<td>In offenen Lebensräumen, z.B. in Flußufere, Truppenübungsplätze, entlang von Bahngleisen oder Gärten, Parks und Brachen in Städten zu erwarten. Wahscheinlich wie Lamyctes emarginatus eine Pionierart.</td>
</tr>
<tr>
<td>Lebensräume &amp; Lebensweise</td>
<td>Verschleppte Art. Wahrscheinlich zerstreut über ganz Deutschland verbreitet.</td>
</tr>
</tbody>
</table>
</div>
<div class="steckbrief_wrapper section-30">
<div class="range">
<div id="content-wrapper" class="cell-xs-12 cell-md-12 cell-lg-12 text-left">
<div id="evidenceMapWrapper" style="height: 630px; overflow: hidden;">
<div id="evidenceMap" style="height: 600px;"></div>
<div style="left: 10px; top: -130px; position: relative; height: 0;"><img src="https://wms.kbs-leipzig.de/cgi-bin/lepi_de_get?SERVICE=WMS&amp;REQUEST=GetLegendGraphic&amp;VERSION=1.3.0&amp;FORMAT=image/png&amp;WIDTH=20&amp;HEIGHT=8&amp;LAYER=tk25specdist&amp;SLD_VERSION=1.1.0" /></div>
<div id="mapButtonBar"></div>
</div>
<!--Phaeno-->
<div class="p-1 m-2">
<div id="phaenogramView">
<h4>Phänogramm</h4>

<hr />

<div id="phaenogrammChart"></div>
</div>
</div>
</div>
<div id="descriptions" class="steckbrief_wrapper section-30 collapsed">
<h2><strong>Merkmalsausprägungen</strong></h2>
MerkmalAusprägung
<table class="steckbrief_table">
<thead></thead>
<tbody>
<tr>
<td>Biotop</td>
<td>
<ul>
 	<li>In der Stadt</li>
 	<li>Auf der Wiese und in der Heide</li>
</ul>
</td>
</tr>
<tr>
<td>Länge (mm)</td>
<td>
<ul>
 	<li>7 - 10</li>
</ul>
</td>
</tr>
<tr>
<td>Rückenplatten: dunkler Mittelstreifen vorhanden</td>
<td>
<ul>
 	<li>nein</li>
</ul>
</td>
</tr>
<tr>
<td>Rückenplatten: nach hinten gerichtete dreieckige Fortsätzen vorhanden</td>
<td>
<ul>
 	<li>fehlen</li>
</ul>
</td>
</tr>
<tr>
<td>Rückenplatten: Oberflächenstruktur</td>
<td>
<ul>
 	<li>glatt</li>
</ul>
</td>
</tr>
<tr>
<td>Beine: Tibia mit zahnartigen Fortsatz</td>
<td>
<ul>
 	<li>An Beinpaaren 1-12</li>
</ul>
</td>
</tr>
<tr>
<td>Beine: Verschmelzung der Tarsen 1-13(10) zu einem einzigen Glied</td>
<td>
<ul>
 	<li>nein</li>
</ul>
</td>
</tr>
<tr>
<td>Antenne: Anzahl Antennenglieder</td>
<td>
<ul>
 	<li>23 - 29</li>
</ul>
</td>
</tr>
<tr>
<td>Antenne: Färbung</td>
<td>
<ul>
 	<li>normal</li>
</ul>
</td>
</tr>
<tr>
<td>Kopfschild: Kopfspitze/Augenpartie dunkler gefärbt</td>
<td>
<ul>
 	<li>ja</li>
</ul>
</td>
</tr>
<tr>
<td>Kopfschild: Breite im Vergleich zu Rückenschild</td>
<td>
<ul>
 	<li>Kopfschild schmaler als das Rückenschild 5</li>
</ul>
</td>
</tr>
<tr>
<td>Einzelaugen: Anzahl Augen</td>
<td>
<ul>
 	<li>1 - 1</li>
</ul>
</td>
</tr>
<tr>
<td>Einzelaugen: Anzahl Reihen</td>
<td>
<ul>
 	<li>1</li>
</ul>
</td>
</tr>
<tr>
<td>Einzelaugen: Größe</td>
<td>
<ul>
 	<li>nur ein großes helles Einzelauge vorhanden</li>
</ul>
</td>
</tr>
<tr>
<td>Kieferfuß, Kieferfußplatte: Anzahl Zähne je Seite</td>
<td>
<ul>
 	<li>2 bis (selten) 3</li>
</ul>
</td>
</tr>
<tr>
<td>Kieferfuß, Kieferfußplatte: seitlich der Zähne Schulterbildung</td>
<td>
<ul>
 	<li>nein</li>
 	<li>ja, klein, Schulter schmaler als Abstand zwischen Zähnen</li>
</ul>
</td>
</tr>
<tr>
<td>Kieferfuß, Kieferfußplatte: Lage Zähne zueinander</td>
<td>
<ul>
 	<li>Zähne auf ca. gleichem Niveau</li>
</ul>
</td>
</tr>
<tr>
<td>Erstes Beinpaar</td>
<td>
<ul>
 	<li>normal, wie darauffolgende Beinpaare und bedornt</li>
</ul>
</td>
</tr>
<tr>
<td>Beine, Hüfte: Hüftporen Form</td>
<td>
<ul>
 	<li>kreisrund</li>
</ul>
</td>
</tr>
<tr>
<td>Letztes Beinpaar (15): Klaue an Endglied</td>
<td>
<ul>
 	<li>dreifach</li>
</ul>
</td>
</tr>
<tr>
<td>Letztes Beinpaar (15): Sonderbildungen</td>
<td>
<ul>
 	<li>Nein</li>
</ul>
</td>
</tr>
<tr>
<td>Gonopoden: Gonopodenklaue</td>
<td>
<ul>
 	<li>einzackig</li>
</ul>
</td>
</tr>
<tr>
<td>Gonopoden: Anzahl Sporen</td>
<td>
<ul>
 	<li>2</li>
</ul>
</td>
</tr>
<tr>
<td>Gonopoden: Sporen Form</td>
<td>
<ul>
 	<li>konisch</li>
</ul>
</td>
</tr>
<tr>
<td>Gonopoden: Beborstung auf der Oberseite Innenseitig</td>
<td>
<ul>
 	<li>keine Borsten innenseitig</li>
</ul>
</td>
</tr>
</tbody>
</table>
</div>
<button class="show_more btn btn-green btn-sm" type="button" data-target="#descriptions">Mehr</button>
<div class="steckbrief_wrapper section-30">
<h2><strong>Bilder</strong></h2>
<figure class="wp-block-gallery columns-4 is-cropped"></figure>
</div>
</div>
</div>
</div>
                </div>
            </section>
			<script type="text/javascript">
			function get_edapho_points(query, slug, debug = false) {
				console.log(query);
				console.log(slug);
				var action_name = 'call_edapho';
				var result;
				if(debug) {
					console.log("calling debug");
					action_name = 'call_edapho';
					var queryDup = query;
					query = JSON.stringify(queryDup);
 				}

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					async: false,
					timeout: 30000,
					data: {
						action: action_name,
						'slug': slug,
						'jsonParams': query,
					},
					success: function (response) {
						var data = response;
						if(typeof(data) !== 'undefined') {
							result = data;
							console.log(result);
							/**
							layer = create_evidence_layer(data);
							console.log(layer);
							add_layer_to_map(map, layer, 2);
							**/
						}
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						console.log("errorThrown");
						console.log(errorThrown);
					},
					complete: function () {
						console.log("done");
					}
				});	
				return result;
			}

				var style = new ol.style.Style({
  fill: new ol.style.Fill({
    color: 'rgba(255, 255, 255, 0.6)'
  }),
  stroke: new ol.style.Stroke({
    color: '#319FD3',
    width: 1
  }),
  text: new ol.style.Text({
    font: '12px Calibri,sans-serif',
    fill: new ol.style.Fill({
      color: '#000'
    }),
    stroke: new ol.style.Stroke({
      color: '#fff',
      width: 3
    })
  })
});

			function create_evidence_layer() {
				defaultQueryMap.query.taxon.positive.taxonById[0].id = $("#selectedSpecies").val();

				var geojsonObject = get_edapho_points(defaultQueryMap, "query/points");
				var vectorSource = new ol.source.Vector({
				  features: (new ol.format.GeoJSON()).readFeatures(geojsonObject),
				  projection: 'EPSG:3857',
				});
				
				var vectorLayer = new ol.layer.Vector({
					title: 'evidence',
  					source: vectorSource,
					style: styleFunction
				});				
				console.log(vectorSource);
				console.log(vectorLayer);
				return vectorLayer;			
			}

				
			function add_layer_to_map (mapInstance, layer, index) {
				console.log("add_layer_to_map");
				if(mapInstance && layer) {
					console.log("adding");
					mapInstance.getLayers().getArray().push(eval(layer));
					console.log(mapInstance);
				} else {
					console.log("not adding");
					console.log(mapInstance);
					console.log(layer);
				}
			}
				
				/**HELPERS**/
				var image = new ol.style.Circle({
				  radius: 10,
				  fill: null,
				  stroke: new ol.style.Stroke({color: 'blue', width: 1})
				});

				var styles = {
				  'Point': new ol.style.Style({
    				image: image
				  }),
				  'LineString': new ol.style.Style({
					stroke: new ol.style.Stroke({
					  color: 'green',
					  width: 1
					})
				  }),
				  'MultiLineString': new ol.style.Style({
					stroke: new ol.style.Stroke({
					  color: 'green',
					  width: 1
					})
				  }),
				  'MultiPoint': new ol.style.Style({
					image: image
				  }),
				  'MultiPolygon': new ol.style.Style({
					stroke: new ol.style.Stroke({
					  color: 'yellow',
					  width: 1
					}),
					fill: new ol.style.Fill({
					  color: 'rgba(255, 255, 0, 0.1)'
					})
				  }),
				  'Polygon': new ol.style.Style({
					stroke: new ol.style.Stroke({
					  color: 'blue',
					  lineDash: [4],
					  width: 3
					}),
					fill: new ol.style.Fill({
					  color: 'rgba(0, 0, 255, 0.1)'
					})
				  }),
				  'GeometryCollection': new ol.style.Style({
					stroke: new ol.style.Stroke({
					  color: 'magenta',
					  width: 2
					}),
					fill: new ol.style.Fill({
					  color: 'magenta'
					}),
					image: new ol.style.Circle({
					  radius: 10,
					  fill: null,
					  stroke: new ol.style.Stroke({
						color: 'magenta'
					  })
					})
				  }),
				  'Circle': new ol.style.Style({
					stroke: new ol.style.Stroke({
					  color: 'red',
					  width: 2
					}),
					fill: new ol.style.Fill({
					  color: 'rgba(255,0,0,0.2)'
					})
				  })
				};

				var styleFunction = function(feature) {
  					return styles[feature.getGeometry().getType()];
				};
												
				function getCategoryLabel(cat) {
				switch (cat) {
					case 2:
						return "Jan";
					case 5:
						return "Feb";
					case 8:
						return "Mrz";
					case 11:
						return "Apr";
					case 14:
						return "Mai";
					case 17:
						return "Jun";
					case 20:
						return "Jul";
					case 23:
						return "Aug";
					case 26:
						return "Sep";
					case 29:
						return "Okt";
					case 32:
						return "Nov";
					case 35:
						return "Dez";
				}

				return "";
			}

			var phaenogramData = [];
			var selectedStateId = null;

			function refreshPhaenogram() {
				var phaenogramData = buildSeriesScript(defaultQueryPhaeno);
				var chart = $("#phaenogrammChart").data("kendoChart");
				for (var j = 0; j < chart.options.series.length; j++) {
					chart.options.series[j].data = phaenogramData[j].ItemCount;
				}
				chart.refresh();
			}

				var selectedDateFrom = 0;
				var selectedDateTo = 9999;
				var tk25Features, evidenceLayer, adminVectorSource, adminEnvelopeLayer, interaction, natbsLayer;
				var tk25baseFeatures;

				var initMap=true;

				function initEvidenceMap() {
					if(!initMap)
					{
						return;
					}
			
					initMap=false;
					kendo.ui.progress($("#evidenceMapWrapper"), true);

					var tkGridStyles = new ol.style.Style({
						stroke: new ol.style.Stroke({ color: '#a0a0a0', width: 0.01 }),
					});

					adminVectorSource = new ol.source.Vector({
						format: new ol.format.WFS(),
						url: function (extent, resolution, projection) {

							return 'https://wms.kbs-leipzig.de/cgi-bin/lepi_de_get?' +
						'service=WFS&request=GetFeature&' +
						'version=1.1.0&typename=admin_envelopes&' +
						'srsname=EPSG:3857';// +
							//'bbox=' + projection.getExtent().join(',') + ',EPSG:3857';
						},
						projection: 'EPSG:3857'
					});
					/**
					var geoVector = new  = new VectorSource({
  						features: (new GeoJSON()).readFeatures(geojsonObject)
					});
					**/

					var vectorSource = new ol.source.Vector({
						format: new ol.format.WFS(),
						url: function (extent, resolution, projection) {
							return 'https://wms.kbs-leipzig.de/cgi-bin/lepi_de_get?' +
						'service=WFS&request=GetFeature&' +
						'version=1.1.0&typename=lepiKML&' +
						'srsname=EPSG:3857&' +
						'bbox=' + projection.getExtent().join(',') + ',EPSG:3857'
							},
							projection: 'EPSG:3857'
						});

						var tk25Source = new ol.source.Vector({
								format: new ol.format.WFS(),
								url: function (extent, resolution, projection) {

									return 'https://wms.kbs-leipzig.de/cgi-bin/lepi_de_get?' +
						'service=WFS&request=GetFeature&' +
						'version=1.1.0&typename=tk25KML&' +
						'srsname=EPSG:3857&' +
						'bbox=' + projection.getExtent().join(',') + ',EPSG:3857';
							},

							projection: 'EPSG:3857'
						});

							tk25Features = new ol.layer.Vector({
								title: 'tk25wfs',
								source: vectorSource,
								style: tkGridStyles
							});

							adminEnvelopeLayer = new ol.layer.Vector({
								title: 'adminenv',
								source: adminVectorSource,
								visible: true,
							});

							tk25baseFeatures = new ol.layer.Vector({
								title: 'tk25base',
								source: tk25Source,
								style: function (feature, resolution) {
									var dynWidth = 0.1 + ((1000 / resolution) * 0.25);
									return new ol.style.Style({
										stroke: new ol.style.Stroke({ color: '#a0a0a0', width: dynWidth }),
									});
								}
							});


							var tkLayer = new ol.layer.Image({
								title: 'tk25',
								source: new ol.source.ImageWMS({
									url: 'https://wms.kbs-leipzig.de/cgi-bin/lepi_de_get?',
									params: { 'LAYERS': 'tk25KML' },
									projection: 'EPSG:3857',
								}),
							});

					evidenceLayer = create_evidence_layer();
/**					
					evidenceLayer = new ol.layer.Image({
						title: 'evidence',
						source: new ol.source.Vector(get_edapho_points(defaultQuery, "query/points")),
						}),
					});
**/
					natbsLayer = new ol.layer.Image({
						title: 'natbs',
                        opacity: 0.55,
						source: new ol.source.ImageWMS({
							url: 'https://wms.kbs-leipzig.de/cgi-bin/lepi_de_get?',
							params: { 'LAYERS': 'natbs2009'},
							projection: 'EPSG:3857',
						}),
					});

					map = new ol.Map({
						target: "evidenceMap",
						interactions:
							ol.interaction.defaults(),
						controls: ol.control.defaults().extend([
							new ol.control.ScaleLine({
								units: 'metric'
							})
						]),
						layers: [
							new ol.layer.Tile({
							  	source: new ol.source.TileWMS({
							  		url: 'https://wms.kbs-leipzig.de/lepi?',
							  		params: { 'LAYERS': 'osm', 'SRS': 'EPSG:3857' },
							  		projection: 'EPSG:3857',
								})
							}), natbsLayer,tkLayer, evidenceLayer, tk25baseFeatures,/* tk25Features,*/ adminEnvelopeLayer
						],
						view: new ol.View({
							center: ol.proj.transform(["9.914486, 51.540484"], 'EPSG:4326', 'EPSG:3857'),
							zoom: 6,
							minZoom: 6,
							maxZoom: 10,
							extent: ol.proj.getTransform('EPSG:4326', 'EPSG:3857')("5.712891,47.159840,15.424805,55.128649"),
						}),
					});

					console.log(map);
					console.log(map.getLayers());
					
					interaction = new ol.interaction.Select({
						condition: ol.events.condition.click,
						style: function (feature, resolution) {
							//if (resolution < 500) {
							//	return tkSelectedStyle;
							//} else {
							//	return tkSelectedStyleLvl1;
							//}
							var maxWidth = 5;
							var dynWidth = 0.5 + (1000 / resolution);
							return new ol.style.Style({
								stroke: new ol.style.Stroke({ color: '#a00000', width: dynWidth }),
							});
						}
					});

					interaction.on("select", ol_featureSelected);

					map.addInteraction(interaction);
					//get_edapho_points(defaultQuery, "query/points");

					var listenerKey = adminVectorSource.on('change', function (e) {
						if (adminVectorSource.getState() == 'ready') {
							ol.Observable.unByKey(listenerKey);
							map.getView().fit(adminVectorSource.getExtent(), map.getSize());
							adminEnvelopeLayer.setVisible(false);					
						}
					});

				var basekey = tk25Source.on('change', function (e) {
					if (tk25Source.getState() == 'ready') {
						ol.Observable.unByKey(basekey);			
					}
				});

				map.on("pointermove", function (evt) {
					$("#tk25HoverSpan").text("");
					var hit = this.forEachFeatureAtPixel(evt.pixel,
							function (feature, layer) {

								if (feature.getId().startsWith("tk25KML")) {
									var tk25Name = feature.getProperties().tk25_name;
									var tk25Nr = feature.getProperties().tk25_id.substring(0, 4);
									$("#tk25HoverSpan").text(tk25Nr + " " + tk25Name);
									return true;
								}
							});

					if (hit) {
						this.getTargetElement().style.cursor = 'pointer';
					} else {
						this.getTargetElement().style.cursor = '';
					}
				});

					//tk25Features.on("postcompose", ol_featureSelected);
					kendo.ui.progress($("#evidenceMapWrapper"), false);
			}

			function showStateSelection(sender, args) {
				adminEnvelopeLayer.setVisible(true);
			}

			function resetStateSelection(sender, args) {

				var ia = map.getInteractions().getArray();

				for (var i = 1; i < 9; i++) {
					ia[i].setActive(true);
				}

				map.getView().fit(adminVectorSource.getExtent(), map.getSize());

		}

		function selectState(feature) {
			//var extent = map.getView().getExtent();
			map.getView().fit(feature.getGeometry().getExtent(), map.getSize());
			var extent = feature.getGeometry().getExtent();
			var zoomLevel = map.getView().getZoom();

			var ia = map.getInteractions().getArray();

			for (var i = 1; i < 9; i++) {
				ia[i].setActive(false);
			}

			var props = feature.getProperties();
			selectedStateId = props["id"];

			adminEnvelopeLayer.setVisible(false);
			interaction.getFeatures().clear();

		}

	function ol_featureSelected(e) {

		if (e.selected.length == 0) {
			$("#phaenogramView").show();
			return;
		}

		var props = e.selected[0].getProperties();

		if (e.selected[0].getId().startsWith("admin_envelope")) {
			selectState(e.selected[0]);
			e.selected.pop();
			refreshPhaenogram();
		} else if (e.selected[0].getId().startsWith("tk25KML")) {

			if ($("#_selectedSpecies").val() == "0") {
				interaction.getFeatures().clear();
				return;
			}
		}
	}

	function filterByDateTo(sender, args) {
		selectedDateTo = args.get_newValue();
		resetSelection();
		refreshMap();
		refreshPhaenogram();
	}

	function refreshMap() {

		var params = evidenceLayer.getSource().getParams();
		params.t = new Date().getMilliseconds();
		params.datefrom = selectedDateFrom;
		params.dateto = selectedDateTo;
		params.taxonid = (parseInt($("#_selectedSpecies").val())<0?"0":$("#_selectedSpecies").val());
		params.conceptid = (parseInt($("#_selectedSpecies").val())>0?"0":$("#_selectedSpecies").val().replace("-",""));
		evidenceLayer.getSource().updateParams(params);

		//params = tk25Features.getSource().getParams();
		//params.taxonid = $("#_selectedSpecies").val();
		//tk25Features.getSource().updateParams(params);

		tk25Features.getSource().clear(true);
		tk25Features.getSource().refresh();
	}

	function filterByDateFrom(sender, args) {
		selectedDateFrom = args.get_newValue();
		resetSelection();
		refreshPhaenogram();

		var params = evidenceLayer.getSource().getParams();
		params.t = new Date().getMilliseconds();
		params.datefrom = selectedDateFrom;
		evidenceLayer.getSource().updateParams(params);

		tk25Features.getSource().clear(true);
		tk25Features.getSource().refresh();
	}

	function resetSelection() {
		interaction.getFeatures().clear();
		$("#phaenogramView").show();
	}

	function nameLoaded() {

		resetSelection();
		refreshMap();
		refreshPhaenogram();
		kendo.ui.progress($("#evidenceMap"), false);
		// refreshes the ListView
		//$find("_speciesSelectionComboBox").clearSelection();
	}

	function nameLoading() {
		kendo.ui.progress($("#evidenceMap"), true);
	}

	function hideResetButton(sender) {
		sender.set_visible(false);
	}

	function _speciesSelectionComboBox_Change(sender, args) {
		args._item._text = "Lade ...";
	}

	function requestNames(sender, args) {
		args.get_context()["showall"] = 1;
	}
	
	$(document).ready(function () {

		initEvidenceMap();				

		$("#phaenogrammChart").kendoChart({
			title: {
				text: "Phänogrammchart",
				visible: false,
			},
			legend: {
				position: "bottom",
				visible: true,
			},
			seriesDefaults: {
				type: "column",
				stack: true,
			},
			//series: buildSeriesScript(defaultQueryPhaeno),
			series: buildSeriesScript(defaultQueryPhaeno),
			valueAxis: {
				minorGridLines: {
				},
			},
			categoryAxis: [{
				labels: {
					template: kendo.template("#= getCategoryLabel(value) #"),
					step: 3,
					skip: 1,
				},
				categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
				majorGridLines: {
					visible: true,
					step: 3,
					}
			}],
			tooltip: {
              visible: true,
              template: "#= series.name #: #= value #"
            }
			});

		//refreshPhaenogram();
	});
			
	function buildSeriesScript(query) {
		console.log(query);
		var result = get_edapho_points(query, "evaluation/ContingencyTable", true);
		console.log(result);
		resultObj = JSON.parse(result);
		if(resultObj.data) {
			console.log(resultObj.data[0]);
			//dataArr = JSON.parse(resultObj.data)
			console.log(resultObj.data[0].data[0]);
			var returnStr = "";
			/**{ type: "line", data: [1, 2, 3] },
				{ type: "bar", data: [4, 5, 6] }
			  ]
			**/
			var resres = [];
			var res = new Object();
			res.name = "Häufigkeit";
			console.log(resultObj.data[0].data);
			dataArr = [];
			//res.data = Object.values(resultObj.data[0].data[0]);
			var dataStr ="";
			for (const [key, value] of Object.entries(resultObj.data[0].data[0])) {
  				console.log(`${key}: ${value.n}`);
				returnStr += '{"name": "Häufigkeit", "data": '+ value.v+'},';//.data.push(value.n);
				dataArr.push(value.n);
			}
			res.data = dataArr;
			resres.push(res);
			return resres;
		}
	}
			</script>
        </div>
    </article>
</main>
<?php get_sidebar();
get_footer();