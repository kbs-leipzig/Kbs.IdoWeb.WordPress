$(document).ready(function () {
	
	var serviceRoot_cn = "https://corenet.kbs-leipzig.de/api";
	var serviceRoot = "https://idoweb.bodentierhochvier.de/api";
	const COMMENTREQUIREDOPTION = 5;

	/* Validierung */
	var status = $("#status");

	var eventValidator = $("#form").kendoValidator({
		errorTemplate: "<span class='invalid form-validation' >#=message#</span>"
	}).data("kendoValidator"),
		eventStatus = $("#eventStatus");

	/*** Event ***/

	/* Fundort */
	$("#localityName").kendoAutoComplete({
		dataSource: {
			transport: {
				read: {
					url: serviceRoot + "/Location/OsmCoordinates",
					contentType: "application/json; charset=utf-8",
					type: "POST",
				},
				parameterMap: function (data, type) {
					return kendo.stringify({ "SearchText": $("#localityName").val() });
				}
			},
			serverFiltering: true,
			schema: {
				parse: function (data) {
					return data;
				}
			}
		},
		dataTextField: 'Name',
		minLength: 3,
		select: locality_onSelect,
		noDataTemplate: "Ort unbekannt"
	}).data("kendoDropDownList");

	/* Aktualisierung Fundort */
	function locality_onSelect(e) {
		var item = this.dataItem(e.item.index());
		setPositionFields(item.Lat, item.Lon);
		centerMap(item.Order == 3 ? 13 : 12);
	}
	function setPositionFields(lat, lon) {
		vm.set("LatitudeDecimal", lat);
		eventValidator.validateInput($("input[name=Breite]"));
		vm.set("LongitudeDecimal", lon);
		eventValidator.validateInput($("input[name=Länge]"));
	}

	/* Land */
	$("#localityCountry").kendoDropDownList({
		optionLabel: "Wähle das Land",
		dataTextField: "LocalisationJson",
		dataValueField: "RegionId",
		dataSource: {
			transport: {
				read:
					function (options) {
						$.ajax({
							url: serviceRoot + "/values/Inf/Region",
							contentType: "application/json; charset=utf-8;",
							crossDomain: true,
							xhrFields: {
								withCredentials: true
							},
							success: function (result) {
								var lang = kendo.culture().name.toLowerCase().split('-')[0];
								result.map(i => i.LocalisationJson = JSON.parse(i.LocalisationJson).filter(e => e.lang.toLowerCase().includes(lang))[0].text);
								result = result.filter(i => i.RegionId < 1000);
								options.success(result);
							}
						});
					}
			}
		},
		select: localityCountry_onSelect,
	}).data("kendoDropDownList");

	/* Aktualisierung Land */
	function localityCountry_onSelect(e) {
		//check if SubRegion exist
		$.ajax({
			url: serviceRoot + "/values/Inf/Region",
			contentType: "application/json; charset=utf-8;",
			crossDomain: true,
			xhrFields: {
				withCredentials: true
			},
			success: function (result) {
				var lang = kendo.culture().name.toLowerCase().split('-')[0];
				result.map(i => i.LocalisationJson = JSON.parse(i.LocalisationJson).filter(e => e.lang.toLowerCase().includes(lang))[0].text);
				result = result.filter(i => i.SubRegionOfId == vm.CountryId);
				if (result.length > 0) {
					/* Bundesland */
					$("#localityRegionDiv").show();
					$("#localityRegion").kendoDropDownList({
						optionLabel: "Wähle das Bundesland",
						dataTextField: "LocalisationJson",
						dataValueField: "RegionId",
						dataSource: { data: result },
						filter: "startswith",
						noDataTemplate: "Bundesland unbekannt"
					}).data("kendoDropDownList");
				} else {
					$("#localityRegionDiv").hide();
				}
			}
		});

	}
	localityCountry_onSelect(this);

	/* Karte */
	var panning = false;
	$("#map").kendoMap({
		controls: {
			attribution: false
		},
		center: [51, 10.3333],
		zoom: 6,
		minZoom: 6,
		layers: [{
			type: "bing",
			imagerySet: "AerialWithLabels",
			culture: "de-DE",
			// IMPORTANT: This key is locked to schmetterlinge-d.de
			// Please replace with own Bing Key
			key: "Ao6t2AoyERNdB5Vn8O9j7UkVa65GKdBkAFXa5rB-CMym6RMQRIaRn2e9HrFqWyFt"
		}],
		markerActivate: function (e) {
			$(e.marker.element.context).css("color", "orange")
		},
		pan: function (e) {
			panning = true;
		},
		panEnd: function (e) {
			panning = false;
		},
		click: function (e) {
			if (!panning) {
				e.sender.markers.clear();
				e.sender.markers.add({
					location: e.location,
					tooltip: {
						content: "Fundort"
					}
				});
				setPositionFields(e.location.lat, e.location.lng);
				setPlaces(e.location.lat, e.location.lng);
				setAccuracyByZoom(e.sender.zoom());
			}
		},
		reset: function (e) {
			showScale(e.sender);
		}
	});

	function setPlaces(lat, lon) {
		$.get({
			url: `${serviceRoot}/Location/OsmLocation?lat=${lat}&lon=${lon}`,
			contentType: "application/json; charset=utf-8;",
			crossDomain: true,
			success: function (result) {
				vm.set("LocalityName", result.Name);
				eventValidator.validateInput($("input[name=Ort]"));
			}
		});
	}

	function setAccuracyByZoom(zoom) {
		if (zoom > 15) {
			vm.set("AccuracyId", 0)
		} else if (zoom == 15) {
			vm.set("AccuracyId", 1)
		} else if (zoom == 14) {
			vm.set("AccuracyId", 2)
		} else {
			vm.set("AccuracyId", 3)
		}
		eventValidator.validateInput($("input[name=Genauigkeit]"));
	}
	function showScale(map) {
		var Location = kendo.dataviz.map.Location;

		// Indicator size in px
		var SIZE = 100;

		var extent = map.extent();
		var center = map.center();

		// Calculate distance across the middle of the map
		// North and South distances can differ significantly at lower zoom levels
		var eastCenter = new Location(center.lat, extent.nw.lng);
		var westCenter = new Location(center.lat, extent.se.lng);
		var distance = eastCenter.distanceTo(westCenter);

		// Calculate scale in meters / pixel
		var width = map.element.width();
		var scale = Math.round(distance * 10 / width) / 10;

		// Add a top-level div for the scale indicator
		var wrap = $(".indicator-wrap", map.element);
		if (wrap.length === 0) {
			wrap = $("<div class='indicator-wrap' />").appendTo($("#map"));
		}

		// Render template        
		var template = kendo.template($("#scaleTemplate").html());
		var data = {
			size: SIZE,
			scale: scale
		};

		wrap.html(template(data));
	}

	/* Breite */
	$("#latitudeDecimal").kendoNumericTextBox({
		min: -90,
		max: 90,
		decimals: 3,
		format: "0.###"
	}).on("keydown", convertPointToComma).blur(()=>centerMap());

	/* Länge */
	$("#longitudeDecimal").kendoNumericTextBox({
		min: -180,
		max: 180,
		decimals: 3,
		format: "0.###"
	}).on("keydown", convertPointToComma).blur(()=>centerMap());

	function convertPointToComma(e) {
		if (e.key == ".") {
			e.preventDefault();
			$(this).val($(this).val() + ',');
		}else if(e.key == "Enter"){
			centerMap();
		}
	}
	function centerMap(zoom=0){
		console.log(0)
		var map = $("#map").data("kendoMap");
		map.center([vm.LatitudeDecimal, vm.LongitudeDecimal]);
		if (zoom!=0){
			console.log(1,zoom)
			map.zoom(zoom);
		}
		map.markers.clear();
		map.markers.add({
			location: map.center(),
			tooltip: {
				content: "Fundort"
			}
		});
	}
	
	/* Genauigkeit */
	$("#accuracy").kendoDropDownList({
		optionLabel: "Wähle die Genauigkeit",
		dataTextField: "LocalisationJson",
		dataValueField: "AccuracyTypeId",
		dataSource: {
			transport: {
				read:
					function (options) {
						$.ajax({
							url: serviceRoot + "/values/Obs/AccuracyType",
							contentType: "application/json; charset=utf-8;",
							crossDomain: true,
							xhrFields: {
								withCredentials: true
							},
							success: function (result) {
								var lang = kendo.culture().name.toLowerCase().split('-')[0];
								result.map(i => i.LocalisationJson = JSON.parse(i.LocalisationJson).filter(e => e.lang.toLowerCase().includes(lang))[0].text);
								options.success(result);
							}
						});
					}
			}
		}
	}).data("kendoDropDownList");

	/* Biotop */
	var habitatData;
	habitatDropDown("#habitat1").bind("change", function (e) {
		var habitatTypeId1 = this.value();
		vm.set("HabitatTypeId", habitatTypeId1);
		$("#habitat3Div").hide();
		var openHabitat2 = habitatTypeId1 != "" && getHabitatCode() != 999;
		$("#habitat2Div").toggle(openHabitat2);
		if (openHabitat2) {
			habitatDropDown("#habitat2").bind("change", function (e) {
				var habitatTypeId2 = this.value();
				var openHabitat3 = habitatTypeId2 != "";
				$("#habitat3Div").toggle(openHabitat3);
				vm.set("HabitatTypeId", openHabitat3?habitatTypeId2:habitatTypeId1);
				if (openHabitat3) {
					habitatDropDown("#habitat3").bind("change", function (e) {
						var habitatTypeId3 = this.value();
						vm.set("HabitatTypeId", habitatTypeId3 != ""?habitatTypeId3:habitatTypeId2);
					}).setDataSource(getHabitatData());
				}
			}).setDataSource(getHabitatData());
		}
	}).setDataSource(new kendo.data.DataSource({
		transport: {
			read:
				function (options) {
					$.ajax({
						url: serviceRoot + "/values/Obs/HabitatType",
						contentType: "application/json; charset=utf-8;",
						crossDomain: true,
						xhrFields: {
							withCredentials: true
						},
						success: function (result) {
							var lang = kendo.culture().name.toLowerCase().split('-')[0];
							result.map(i => i.LocalisationJson = JSON.parse(i.LocalisationJson).filter(e => e.lang.toLowerCase().includes(lang))[0].text);
							habitatData = result;
							options.success(result.filter(r => r.Code < 10 || r.Code == 999));
						}
					});
				}
		}
	}));

	function habitatDropDown(habitatId) {
		return $(habitatId).kendoDropDownList({
			optionLabel: habitatId == "#habitat1" ? "Wähle das Biotop" : "Biotop genauer bestimmen",
			dataTextField: "LocalisationJson",
			dataValueField: "HabitatTypeId",
			value: ""
		}).data("kendoDropDownList");
	}

	function getHabitatCode() {
		return habitatData.filter(i => i.HabitatTypeId == vm.get("HabitatTypeId"))[0].Code;
	}
	function getHabitatData() {
		return habitatData.filter(r => r.Code > getHabitatCode() * 10 && r.Code < (getHabitatCode() + 1) * 10);
	}
	
	/* Vorbelegung bei Bearbeitung */
	(function presetValues(){
		var urlParams = new URLSearchParams(location.search);
		var eventId = urlParams.get('eventId');
		if (eventId != null){
			$("main>section>h2").text("Fundort bearbeiten");
			document.title = document.title.replace("erfassen","bearbeiten");
			$.get({
				url: `${serviceRoot}/Advice/Event/`+eventId,
				contentType: "application/json; charset=utf-8;",
				crossDomain: true,
				xhrFields: {
					withCredentials: true
				},
				success: function (result) {
					var event = JSON.parse(result).filter(e => e.EventId == eventId)[0];
					if (event != undefined){
						console.log(event);
						vm.set("EventId", eventId);
						vm.set("HabitatTypeId", event.HabitatTypeId);
						vm.set("LocalityName", event.LocalityName);
						vm.set("CountryId", event.CountryId);
						vm.set("RegionId", event.RegionId);
						vm.set("LongitudeDecimal", event.LongitudeDecimal);
						vm.set("LatitudeDecimal", event.LatitudeDecimal);
						vm.set("AccuracyId", event.AccuracyId);
						centerMap(13);
						vm.set("HabitatDescription", event.HabitatDescription);
						vm.set("HabitatTypeId", event.HabitatTypeId);
						if (event.HabitatTypeId){
							setHabitatType();
							$("#habitat1").trigger("change");
							$("#habitat2").trigger("change");
							$("#habitat3").trigger("change");
						}
						eventValidator.validate();
					}
				}
			});
		}
	})();
		
	
	function setHabitatType(){
		var habitatCodeArray = `${getHabitatCode()}`.split('');
		var habitatCode = parseInt(habitatCodeArray.shift());
		var habitatDropdown = $("#habitat1").data("kendoDropDownList");
		if (habitatCode==9){
			habitatDropdown.select(6);
			habitatDropdown.trigger("change");
		}else{
			habitatDropdown.select(habitatCode);
			habitatDropdown.trigger("change");
			if (habitatCodeArray[0]){
				habitatCode = parseInt(habitatCodeArray.shift());
				habitatDropdown = $("#habitat2").data("kendoDropDownList");
				habitatDropdown.select(habitatCode);
				habitatDropdown.trigger("change");
				if (habitatCodeArray[0]){
					habitatCode = parseInt(habitatCodeArray.shift());
					habitatDropdown = $("#habitat3").data("kendoDropDownList");
					habitatDropdown.select(habitatCode);
					habitatDropdown.trigger("change");
				}
			}
		}
	}
	/* Absenden */
	function saveLocality() {
		self = this;
		var urlParams = new URLSearchParams(location.search);
		var eventId = urlParams.get('eventId');
		//if new event remove empty eventId
		var apiEndpoint = serviceRoot + "/Advice/SaveEvent/";
		if (eventId != null && self.EventId !== ""){
			self.EventId = eventId;
			apiEndpoint = serviceRoot + "/Advice/UpdateEvent/"+eventId;
		} else {
			self.EventId = -1;
		}
		if (eventValidator.validate()) {
			//save data
  			$.ajax({
  				method: "POST",
  				url: apiEndpoint,
  				data: JSON.stringify(self),
  				contentType: "application/json; charset=utf-8;",
  				dataType: "json",
  				crossDomain: true,
  				xhrFields: {
  					withCredentials: true
  				},
  				success: function (data) {
  					if (data.succeeded) {
  						showMsg(status, "Daten erfolgreich gesendet!", true);
  						window.location.href="/mein-bereich/fundorte/";
  					}
  					else {
  						var errors = data.errors;
  						var str = "";
  						errors.forEach(error => {
  							str += error.description + "<br />";
  						});
  						showMsg(status, str, false);
  					}
  				},
  				error: function () {
  					showMsg(status, "Fehler beim Senden der Daten", false);
  				}
  			});
		}
	}
	var obsStatus;
	function showMsg(div, msg, valid) {
		status.hide();
		eventStatus.hide();
		if (obsStatus) {
			obsStatus.hide();
		}
		div.show();
		div.text(msg);
		if (valid) {
			div.removeClass("invalid");
			div.addClass("valid");
		} else {
			div.removeClass("valid");
			div.addClass("invalid");
		}
	}

	/* ViewModel */
	var vm = new LocalityViewModel();
	kendo.bind($("#form"), vm);
	function LocalityViewModel() {
		var self = new kendo.data.ObservableObject();
		self.EventId = "";
		/* Event */
		self.LocalityName = "";
		self.CountryId = 276;
		self.RegionId = "";
		self.LongitudeDecimal = "";
		self.LatitudeDecimal = "";
		self.AccuracyId = "";
		self.HabitatDescription = "";
		self.HabitatTypeId = "";

		/* Observation List */
		self.ObservationList = [];

		/* Functions */
		self.saveLocality = saveLocality;
		return self;
	}
});