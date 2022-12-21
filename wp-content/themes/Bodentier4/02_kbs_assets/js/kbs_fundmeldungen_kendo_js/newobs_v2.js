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

	var observationValidator = $("#form").kendoValidator(
		{
			rules: {
				adviceCountRequired: function (input) {
					if (input.is("[name=Anzahl]")) {
						if ($("#adviceCountOption").prop("checked")) {
							return vm.AdviceCount != 0;
						}
					}
					return true;
				},
				sizeGroupRequired: function (input) {
					if (input.is("[name=Häufigkeitsklasse]")) {
						if ($("#sizeGroupOption").prop("checked")) {
							return vm.SizeGroupId != "";
						}
					}
					return true;
				},
				commentRequired: function (input) {
					if (input.is("[name=Kommentar]")) {
						if (vm.LocalityTypeId == COMMENTREQUIREDOPTION) {
							return vm.ObservationComment != "";
						}
					}
					return true;
				},
				dateFormat: function (input) {
					if (input.is("[name=Datum]")) {
						dateRegex = new RegExp("\\d{2}\\.\\d{2}\\.\\d{4}");
						return dateRegex.test(input.val());
					}
					return true;
				},
				attachmentsOrNoAttachmentsChecked: function (input) {
					if (input.is("[name=noAttachmentsCheckbox]")) {
						if(!$("#noAttachmentsCheckbox").is(':checked')) {
							return (vm.get("Image").length > 0);
						}
					}
					return true;
				}
			},
			messages: {
				adviceCountRequired: "Anzahl ist notwendig",
				sizeGroupRequired: "Häufigkeitsklasse ist notwendig",
				commentRequired: "Kommentar ist notwendig",
				dateFormat: "Datum ist ungültig",
				attachmentsOrNoAttachmentsChecked: "Bitte prüfen Sie die Bilder oder wählen Sie 'ohne Bildnachweis'"
			},
			errorTemplate: "<span class='invalid form-validation' >#=message#</span>"
		}
	).data("kendoValidator");

	/*** Event ***/

	/* Fundort */
	/** TODO: rewrite to idoweb.bodentierhochvier **/
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
		dataTextField: "Name",
		minLength: 3,
		select: locality_onSelect,
		noDataTemplate: "Ort unbekannt"
	}).data("kendoDropDownList");

	/* Aktualisierung Fundort */
	function locality_onSelect(e) {
		var item = this.dataItem(e.item.index());		
		var map = $("#map").data("kendoMap");
		console.log(item);
		console.log(map);
		console.log(map.markers);
		map.markers.clear();
		map.center([item.Lat, item.Lon]).zoom(item.Order == 3 ? 13 : 12);
		map.markers.add({
			location: [item.Lat, item.Lon],
			tooltip: {
				content: "Fundort"
			}
		});
		setPositionFields(item.Lat, item.Lon);
		//Set Marker
		
	}
	function setPositionFields(lat, lon) {
		vm.set("LatitudeDecimal", lat);
		eventValidator.validateInput($("input[name=Breite]"));
		vm.set("LongitudeDecimal", lon);
		eventValidator.validateInput($("input[name=Länge]"));
	}

	/* Land */
	$("#CountryId").kendoDropDownList({
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
		select: CountryId_onSelect,
	}).data("kendoDropDownList");

	/* Aktualisierung Land */
	function CountryId_onSelect(e) {
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
					$("#RegionIdDiv").show();
					$("#RegionId").kendoDropDownList({
						optionLabel: "Wähle das Bundesland",
						dataTextField: "LocalisationJson",
						dataValueField: "RegionId",
						dataSource: { data: result },
						filter: "startswith",
						noDataTemplate: "Bundesland unbekannt"
					}).data("kendoDropDownList");
				} else {
					$("#RegionIdDiv").hide();
				}
			}
		});

	}
	CountryId_onSelect(this);

	/* Karte */
	var panning = false;
	var smallMap = $("#map").height()==300;
	$("#map").kendoMap({
		center: [51, 10.3333],
		zoom: smallMap?5:6,
		minZoom: 5,
		layers: [{
			type: "bing",
			imagerySet: "AerialWithLabels",
			culture: "de-DE",
			// IMPORTANT: This key is locked to schmetterlinge-d.de
			// Please replace with own Bing Key
			key: "Ao6t2AoyERNdB5Vn8O9j7UkVa65GKdBkAFXa5rB-CMym6RMQRIaRn2e9HrFqWyFt"
		}],
		markerActivate: function (e) {
			$(e.marker.element.context).css("color", "rgb(210, 213, 110)")
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
				if(vm.get("LocalityName") == "") {
					vm.set("LocalityName", result.Name);
					eventValidator.validateInput($("input[name=Ort]"));					
				}
			}
		});
		// $.get({
		// 	//url: `${serviceRoot}/Location/OsmLocation?lat=${lat}&lon=${lon}&order=8`,
		// 	url: `https://idoapi.kbs-leipzig.de/api/Location/OsmLocation?lat=${lat}&lon=${lon}&order=8`,
		// 	contentType: "application/json; charset=utf-8;",
		// 	crossDomain: true,
		// 	success: function (result) {
		// 		var regionId = $("#RegionId").data("kendoDropDownList").dataSource.data().filter(i => i.LocalisationJson==result.Name)[0].RegionId;
		// 		vm.set("RegionId", regionId);
		// 		}
		// });
	}

	function setAccuracyByZoom(zoom) {
		if (zoom > 15) {
			vm.set("AccuracyTypeId", 0)
		} else if (zoom == 15) {
			vm.set("AccuracyTypeId", 1)
		} else if (zoom == 14) {
			vm.set("AccuracyTypeId", 2)
		} else {
			vm.set("AccuracyTypeId", 3)
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
	}).on("keydown", convertPointToComma);

	/* Länge */
	$("#longitudeDecimal").kendoNumericTextBox({
		min: -180,
		max: 180,
		decimals: 3,
		format: "0.###"
	}).on("keydown", convertPointToComma);

	function convertPointToComma(e) {
		if (e.key == ".") {
			e.preventDefault();
			$(this).val($(this).val() + ',');
		}
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

	/*** Observation ***/
	/* Art */
	$("#taxon").kendoDropDownList({
		optionLabel: "Wähle die Art",
		dataTextField: "TaxonName",
		dataValueField: "TaxonId",
		dataSource: {
			transport: {
				read:
					function (options) {
						$.ajax({
							url: serviceRoot + "/Taxons",
							contentType: "application/json; charset=utf-8;",
							crossDomain: true,
							xhrFields: {
								withCredentials: true
							},
							success: function (allTaxa) {
								result = allTaxa.filter(t => t.TaxonomyStateId == 301);
								options.success(result);
							}
						});
					}
			}
		},
		noDataTemplate: "Art unbekannt",
		filter: "contains",
		template: "<span><i>#:data.TaxonName#</i>&nbsp;#:data.TaxonDescription#</span>",
		filtering: taxon_filtering,
		change: taxon_onchange
	}).data("kendoDropDownList");

	/** if whitespace -> filter for separate values **/
	function taxon_filtering(ev){
		var filterValue = ev.filter != undefined ? ev.filter.value : "";
		if(filterValue.indexOf(" ") > 0) {
        	ev.preventDefault();
			var mainFilter = { logic: "and", filters: [] };
			filterValArr = filterValue.split(" ");
			filterValArr.forEach(function(filterItem){
				mainFilter.filters.push({ field: "TaxonName", operator: "contains", value: filterItem })
			});
			this.dataSource.filter(mainFilter);
		}
	}
	
	/* Aktualisierung Art */
	function taxon_onchange() {
		//if no observation form and taxon set
		if (!$("#observationPlaceholder").html() && vm.TaxonId) {
			$("#addObsForm").data("kendoButton").enable(true);
			var taxonName = $("#taxon").data("kendoDropDownList").text();
			vm.set("TaxonName", taxonName);
		} else {
			$("#addObsForm").data("kendoButton").enable(false);
		}
	}

	/* Daten zur Art erfassen */
	function addObsForm() {
		if (eventValidator.validate()) {
			disableListButtons();
			eventStatus.hide();
			status.hide();
			var template = kendo.template($("#observationTemplate").html());
			$("#observationPlaceholder").html(template(""));
			obsStatus = $("#obsStatus");

			/* Datum */
			$("#habitatDate").kendoDatePicker({
				format: "dd.MM.yyyy",
				max: new Date()
			});

			/* Sammelmethode */
			$("#localityType").kendoDropDownList({
				optionLabel: "Wähle die Sammelmethode",
				dataTextField: "LocalisationJson",
				dataValueField: "LocalityTypeId",
				dataSource: {
					transport: {
						read:
							function (options) {
								$.ajax({
									url: serviceRoot + "/values/Obs/LocalityType",
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
				},
				change: localityTypeChanged
			}).data("kendoDropDownList");

			/* Aktualisierung Sammelmethode */
			function localityTypeChanged() {
				if (vm.LocalityTypeId == COMMENTREQUIREDOPTION) {
					$("#observationComment").addClass("required");
				} else {
					$("#observationComment").removeClass("required");
				}
			}

			/* Bestimmungsmethode */
			$("#diagnosisType").kendoDropDownList({
				optionLabel: "Wähle die Bestimmungsmethode",
				dataTextField: "LocalisationJson",
				dataValueField: "DiagnosisTypeId",
				dataSource: {
					transport: {
						read:
							function (options) {
								$.ajax({
									url: serviceRoot + "/values/Obs/DiagnosisType",
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

			/* Aktualisierung Art der Anzahl */
			$("#adviceCountOption").change(showAdviceCount);
			$("#sizeGroupOption").change(showSizeGroup);
			$("#adviceCountOption").prop("checked", true);
			showAdviceCount();

			/* Anzahl */
			$("#adviceCount").kendoNumericTextBox({
				decimals: 0,
				format: "#",
				min: 0,
				change: calculateCounts
			});

			/* Anzahl der Männchen */
			$("#maleCount").kendoNumericTextBox({
				decimals: 0,
				format: "#",
				min: 0,
				change: calculateCounts
			});

			/* Anzahl der Weibchen */
			$("#femaleCount").kendoNumericTextBox({
				decimals: 0,
				format: "#",
				min: 0,
				change: calculateCounts
			});

			/* Anzahl der Juvenile */
			$("#juvenileCount").kendoNumericTextBox({
				decimals: 0,
				format: "#",
				min: 0,
				change: calculateCounts
			});

			/* Anzahl undifferenzierter Exemplare */
			$("#undivCount").kendoNumericTextBox({
				decimals: 0,
				format: "#",
				min: 0
			}).data("kendoNumericTextBox").readonly();

			/* Aktualisierung Anzahl */
			function calculateCounts() {
				var allCount = vm.MaleCount + vm.FemaleCount + vm.JuvenileCount;
				if (vm.AdviceCount < allCount) {
					var adviceCount = allCount;
					vm.set("AdviceCount", adviceCount);
				}
				var undivCount = vm.AdviceCount - allCount;
				vm.set("UndivCount", undivCount);
			}

			/* Häufigkeitsklasse */
			$("#sizeGroup").kendoDropDownList({
				optionLabel: "Wähle die Häufigkeitsklasse",
				dataTextField: "SizeGroupName",
				dataValueField: "SizeGroupId",
				dataSource: {
					transport: {
						read:
							function (options) {
								$.ajax({
									url: serviceRoot + "/values/Obs/SizeGroup",
									contentType: "application/json; charset=utf-8;",
									crossDomain: true,
									xhrFields: {
										withCredentials: true
									},
									success: function (result) {
										sizeGroupData = result;
										options.success(result);
									}
								});
							}
					}
				}
			}).data("kendoDropDownList");

			/* Bilder */
			/** Pictures in Wordpress will be saved through kendo Upload
			 * Pictues in Database will be saved through form submit **/
			$("#files").kendoUpload({
				async: {
					saveUrl: "/image-api?image-upload",
					removeUrl: "/image-api?image-delete",
					//saveUrl: "https://corenet.kbs-leipzig.de/api/Images/UploadImage",
					//removeUrl: "https://corenet.kbs-leipzig.de/api/Images/RemoveImage",
					removeVerb: "GET"
				},
				files: vm.get("Image"),
				validation: {
					allowedExtensions: [".jpg"]
				},
				localization: {
					select: "Bilder auswählen",
					invalidFileExtension: "Dateityp nicht erlaubt"
				},
				remove: onRemove,
				success: onSuccess,
				error: onError,
				upload: onUpload,
				select: function(e) {
				$.each(e.files, function(index, value) {
					  if(value.extension != ".jpg") {
						e.preventDefault();
						alert("Bitte nur .jpg Dateien hochladen");
					  }
					});
				},
				autoUpload: true,
			});
			
			//rebind
			$("#addObsForm").data("kendoButton").enable(false);
			kendo.bind($("#form"), vm);
		} else {
			showMsg(eventStatus, "Bitte überprüfe die eingegebenen Daten.", false)
		}
	}
	
	function onError (e) {
		var files = e.files;
        if (e.operation == "upload") {			
			var filename = files[0].name;
			var t = setTimeout(function () {
				$.ajax({
					beforeSend: function () {
					},
					type: 'POST',
					url: ajaxurl,
					timeout: 30000,
					data: {
						action: 'image_upload_error_cleanup',
						'data': filename
					},
					success: function (data, textStatus, XMLHttpRequest) {
						console.log("Deleted " + data + " pages. Done.");
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						answer = textStatus;
						console.log(errorThrown);
					},
					complete: function () {
						console.log("Done cleanup");
					}
				});
			},900);
        }
	}
	
function onRemove(e) {
		console.log(e);
		var that = this;
		var filesArr = e.files;
		console.log(e.data);
		filesArr.forEach(function (file_item) {
			var oldName = file_item.name;
			console.log(oldName);
			var cmsId = file_item.CmsId;
			var uid = file_item.uid;
			var listItem = that.wrapper.find("[title='" + oldName + "']").closest("li.k-file");
			if(typeof(listItem) == 'undefined') {
				listItem = that.wrapper.find("[title='" + name + "']").remove();
			}
			var att_id = listItem[0].dataset.att_id;
			var widget = kendo.widgetInstance($("#files"));
			const regex = /(\&att_id=\d{0,10})/gm;
			widget.options.async.removeUrl.replace(regex,"");
			if(typeof(cmsId) !== 'undefined') {
				widget.options.async.removeUrl += "&att_id="+cmsId;
				console.log(widget.options.async.removeUrl);
				//remove from Image object
				var images = vm.get("Image");
				console.log(images);
				console.log(vm.get("Image"));
				console.log(vm);
				if(images.length > 0) {
					images.forEach(function (image_item, index) {
						if(typeof(image_item) !== 'undefined') {
							if(typeof(image_item.originalName) !== 'undefined') {
								if(image_item.originalName == file_item.name) {
									let dataItem = vm.get("Image").at(index);
									vm.get("Image").splice(index,1);
									delete images[index];		
									listItem.remove();
								}				
							}
						}
					});
				}
			}
		})
		observationValidator.validate();
	}
		
	function onUpload (e) {
		console.log(e);
		var widget = kendo.widgetInstance($("#files"));
		var taxonName = $("#taxon").data("kendoDropDownList").text();
		var authorName = vm.get("AuthorName");
		var date = $("#habitatDate").data("kendoDatePicker").value();
		var dateString = new Date(date).toISOString();
		e.data = {"taxonName": taxonName, "authorName": authorName, "dateString": dateString};
		if(typeof(taxonName) !== 'undefined') {
			e.files.forEach(function (element) {
			  	element.rawFile.taxonName = taxonName;
				element.rawFile.date = dateString;
				element.rawFile.authorName = authorName;
			});
		}
	}

	function onSuccess (e) {
   		var images = vm.get("Image") || [];
		var filesArr = e.files;
		var that = this;
		filesArr.forEach(function (file_item) {
			var oldName = file_item.name;
    		var att_id = e.response.attach_id;
			var newName = decodeURIComponent(e.response.filename);
			file_item.internal_name = newName;

			if(att_id !== "error") {
    			var listItem = that.wrapper.find("[title='" + oldName + "']").closest("li.k-file");
				listItem[0].dataset.att_id = att_id;
				listItem[0].dataset.new_name = oldName;
				listItem[0].title = newName;
			}
			
			if(typeof(file_item.internal_name !== 'undefined')) {
				//var img = {ImagePath: file_item.internal_name, CmsId: att_id, originalName: oldName};
				file_item.ImagePath = file_item.internal_name;
				file_item.CmsId = att_id;
				file_item.originalName = oldName;
				images.push(file_item);
				$("#noAttachmentsCheckbox").prop("checked", false);
			} else {
				console.log(file_item);
			}
		})
		//console.log(images);
		observationValidator.validate();
		vm.set("Image", images);
		
	}

	/* Fundliste */
	var obsListKendo = $("#list").kendoListView({
		template: '<div>${HabitatDate}: ${TaxonName} ('
		+ '# if (AdviceCountOption){ #'
			+ '${AdviceCount}'
		+ '# }else{ #'
			+ '${getSizeGroupName(SizeGroupId)}'
		+ '#};#)'
			+ '<a class="k-button k-edit-button" href="\\#authorName" style="margin:10px"><span class="k-icon k-i-edit" />&nbsp;Bearbeiten</a>'
			+ '<a class="k-button k-delete-button" href="\\#authorName" style="margin:10px"><span class="k-icon k-i-close" />&nbsp;Löschen</a></div>'
	});
	$('#listDiv').hide();

	/* Speichern */
	function addObsToList() {
		if (observationValidator.validate()) {
			enableListButtons();
			$('#listDiv').show();

			/* hacky solution because kendoUpload adds weird items to list? TODO: fix **/
			var images = vm.get("Image");
			if(typeof(images) !== 'undefined') {
				images.forEach(function (image_item, index) {
					if(typeof(image_item) !== 'undefined') {
						if(image_item.ImagePath == "undefined") {
							images.splice(index,1);
						}
						if(typeof(image_item.originalName !== 'undefined')) {
							delete image_item.originalName;						
						}
					}
				})
			}

			var currentTaxon = {
				TaxonName: $("#taxon").data("kendoDropDownList").text(),
				TaxonId: vm.get("TaxonId"),
				HabitatDate: $("#habitatDate").val(),
				LocalityTypeId: vm.get("LocalityTypeId"),
				DiagnosisTypeId: vm.get("DiagnosisTypeId"),
				AdviceCountOption: vm.get("AdviceCountOption"),
				SizeGroupOption: vm.get("SizeGroupOption"),
				ObservationComment: vm.get("ObservationComment"),
				Image: images
			};
					
			//add count data based on chosen option 
			if (currentTaxon.AdviceCountOption) {
				currentTaxon.AdviceCount = vm.get("AdviceCount");
				currentTaxon.MaleCount = vm.get("MaleCount");
				currentTaxon.FemaleCount = vm.get("FemaleCount");
				currentTaxon.JuvenileCount = vm.get("JuvenileCount");
				currentTaxon.UndivCount = vm.get("UndivCount");
				currentTaxon.SizeGroupId = "";
			} else {
				currentTaxon.SizeGroupId = vm.get("SizeGroupId");
				currentTaxon.AdviceCount = 0;
				currentTaxon.MaleCount = 0;
				currentTaxon.FemaleCount = 0;
				currentTaxon.JuvenileCount = 0;
				currentTaxon.UndivCount = 0;
			}
			if (editedTaxonUid != null) {
				var result = $('#list').data("kendoListView").dataSource.data().filter(i => { return i.uid === editedTaxonUid })[0];
				$('#list').data("kendoListView").dataSource.data().remove(result);
				editedTaxonUid = null;
			}
			sizeGroupText = $("#sizeGroup").data("kendoDropDownList").text();
			$('#list').data("kendoListView").dataSource.add(currentTaxon);			
			
			//close observation
			$("#observationPlaceholder").empty();
			vm.set("TaxonId", "");
			vm.set("AdviceCount", 0);
			vm.set("MaleCount", 0);
			vm.set("FemaleCount", 0);
			vm.set("JuvenileCount", 0);
			vm.set("UndivCount", 0);
			vm.set("Image", []);
			vm.set("ObservationComment", "");

			$("#addObsForm").data("kendoButton").enable(false);

			$(".k-edit-button").click(editTaxon);
			$(".k-delete-button").click(deleteTaxon);
			
		} else {
			showMsg(obsStatus, "Bitte überprüfe die eingegebenen Daten.", false);
		}
	}

	/* Abbrechen */
	function cancelObservation() {
		if (confirm("Achtung, die " + ((editedTaxonUid == null) ? "eingegebenen Daten" : "Änderungen") + " werden verworfen.")) {
			$("#observationPlaceholder").empty();
			vm.set("TaxonId", "");
			vm.set("AdviceCount", 0);
			vm.set("MaleCount", 0);
			vm.set("FemaleCount", 0);
			vm.set("JuvenileCount", 0);
			vm.set("UndivCount", 0);
			vm.set("Image", []);
			$("#addObsForm").data("kendoButton").enable(false);
			enableListButtons();
			if (editedTaxonUid != null) {
				$("[data-uid=" + editedTaxonUid + "]").show();
			}
			editedTaxonUid = null;
		}
	}

	/* Bearbeiten */
	var editedTaxonUid;
	function editTaxon(e) {
		e.preventDefault();
		if (!e.target.classList.contains("k-state-disabled")) {
			editedTaxonUid = e.target.parentNode.getAttribute("data-uid");
			var result = $('#list').data("kendoListView").dataSource.data().filter(i => { return i.uid === editedTaxonUid })[0];
			vm.set("TaxonId", result.TaxonId);
			vm.set("TaxonName", result.TaxonName);
			vm.set("HabitatDate", result.HabitatDate);
			vm.set("LocalityTypeId", result.LocalityTypeId);
			vm.set("DiagnosisTypeId", result.DiagnosisTypeId);
			vm.set("AdviceCountOption", result.AdviceCountOption);
			vm.set("SizeGroupOption", result.SizeGroupOption);
			vm.set("AdviceCount", result.AdviceCount);
			vm.set("MaleCount", result.MaleCount);
			vm.set("FemaleCount", result.FemaleCount);
			vm.set("JuvenileCount", result.JuvenileCount);
			vm.set("UndivCount", result.UndivCount);
			vm.set("SizeGroupId", result.SizeGroupId);
			vm.set("ObservationComment", result.ObservationComment);
			vm.set("Image", result.Image)
			updateImageMeta(result.Image);
			//var widget = kendo.widgetInstance($("#files"));
			//widget.set("files", vm.get("Image"));
			addObsForm();
			if (result.AdviceCountOption) {	
				showAdviceCount();
			} else {
				showSizeGroup();
				$("#sizeGroupOption").prop("checked", true);
			}
			$("[data-uid=" + editedTaxonUid + "]").hide();
			disableListButtons();
		}
	}
	
	function updateImageMeta (imageArr) {
		vm.set("Image", imageArr);
		console.log(vm.get("Image"));
		console.log(imageArr);
	}

	/* Löschen */
	function deleteTaxon(e) {
		if (!e.target.classList.contains("k-state-disabled")) {
			var uid = e.target.parentNode.getAttribute("data-uid");
			var result = $('#list').data("kendoListView").dataSource.data().filter(i => { return i.uid === uid })[0];
			$('#list').data("kendoListView").dataSource.data().remove(result);
			$("[data-uid=" + editedTaxonUid + "]").remove();

			$(".k-delete-button").click(deleteTaxon);
			$(".k-edit-button").click(editTaxon);
		}
	}

	/* Absenden */
	function saveLocality() {
		self = this;
		if ($("#observationPlaceholder").html()) {
			showMsg(obsStatus, "Fundmeldung wird hinzugefügt.", false);
			addObsToList();
		}
		
			if (self.ObservationList.length != 0) {
				var optimisedDS = optimiseDataStructure(self);

				//save data
				$.ajax({
					method: "POST",
					url: serviceRoot + "/Advice/SaveAdvice",
					data: optimisedDS,
					contentType: "application/json; charset=utf-8;",
					dataType: "json",
					crossDomain: true,
					xhrFields: {
						withCredentials: true
					},
					success: function (data) {
						if (data.succeeded) {
							showMsg(status, "Daten erfolgreich gesendet!", true);
							//move images from temp folder to user_uploads
							moveUploadImages(self);
							var t = setTimeout (function () {
								window.location.href="/mein-bereich/funde/";								
							},300);
						} else {
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
			} else {
				showMsg(status, "Bitte lege einen Fund an.", false);
				//or: save only Event?
				return true;
			}
	}
	
	/**Helper to move uploaded images**/
	function moveUploadImages(data) {
		console.log(data);
		var cmsId_arr = [];
		data.ObservationList.forEach(function (obs) {
			if(typeof(obs.Image) !== 'undefined') {
				obs.Image.forEach(function (img) {
					console.log(img);
					cmsId_arr.push(img.CmsId);
				})
			}
		});
		$.ajax({
			beforeSend: function () {
			},
			type: 'POST',
			url: ajaxurl,
			timeout: 30000,
			data: {
				action: 'image_upload_move',
				'data': JSON.stringify(cmsId_arr)
			},
			success: function (data, textStatus, XMLHttpRequest) {
				console.log("Moved " + data + " images. Done.");
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				answer = textStatus;
				console.log(errorThrown);
			},
			complete: function () {
				console.log("Done Movement");
			}
		});
	}
	
	/* Helper Methods */
	function optimiseDataStructure(data) {
		//delete temp observation values
		var copy = JSON.parse(JSON.stringify(data));
		delete copy.TaxonId;
		delete copy.HabitatDate;
		delete copy.LocalityTypeId;
		delete copy.DiagnosisTypeId;
		delete copy.AdviceCountOption;
		delete copy.SizeGroupOption;
		delete copy.AdviceCount;
		delete copy.MaleCount;
		delete copy.FemaleCount;
		delete copy.JuvenileCount;
		delete copy.UndivCount;
		delete copy.SizeGroupId;
		delete copy.ObservationComment;

		//delete helper data
		copy.ObservationList.forEach(i => {
			i.HabitatDate = kendo.toString(kendo.parseDate(i.HabitatDate), "yyyy-MM-dd");
			i.Images = vm.get("Image");
			for(j = 0; j < i.Images.length; j++) {
				if(i.Images[j] === null) {
					console.log("deleting " + i.Images[j]);
					delete i.Images[j];
				}
			}
			delete i.AdviceCountOption;
			delete i.SizeGroupOption;
			delete i.UndivCount;
		});

		delete copy.Image;
		
		return JSON.stringify(copy);
	}

	function enableListButtons() {
		$(".k-edit-button").prop("disabled", false).removeClass("k-state-disabled");
		$(".k-delete-button").prop("disabled", false).removeClass("k-state-disabled");
	}

	function disableListButtons() {
		$(".k-edit-button").prop("disabled", true).addClass("k-state-disabled");
		$(".k-delete-button").prop("disabled", true).addClass("k-state-disabled");
	}

	function showAdviceCount() {
		$("#sizeGroupDiv").hide();
		$("#adviceCountDiv").show();
		$("#femaleCountDiv").show();
		$("#maleCountDiv").show();
		$("#juvenileCountDiv").show();
		$("#undivCountDiv").show();
		vm.set("AdviceCountOption", true);
		vm.set("SizeGroupOption", false);
	}

	function showSizeGroup() {
		$("#adviceCountDiv").hide();
		$("#femaleCountDiv").hide();
		$("#maleCountDiv").hide();
		$("#juvenileCountDiv").hide();
		$("#undivCountDiv").hide();
		$("#sizeGroupDiv").show();
		vm.set("AdviceCountOption", false);
		vm.set("SizeGroupOption", true);
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

		/* Event */
		self.LocalityName = "";
		self.CountryId = 276;
		self.RegionId = "";
		self.LongitudeDecimal = "";
		self.LatitudeDecimal = "";
		self.AccuracyTypeId = "";
		self.HabitatDescription = "";
		self.HabitatTypeId = "";

		$.ajax({
			url: serviceRoot + "/userprofile",
			crossDomain: true,
			xhrFields: {
				withCredentials: true
			},
			success: function (result) {
				if (result.FirstName && result.LastName) {
					vm.set("AuthorName", result.FirstName + " " + result.LastName);
				}
			}
		});

		/* Observation Help Data */
		self.TaxonId = "";
		self.HabitatDate = new Date();
		self.LocalityTypeId = "";
		self.DiagnosisTypeId = "";
		self.AdviceCountOption = true;
		self.SizeGroupOption = false;
		self.AdviceCount = 0;
		self.MaleCount = 0;
		self.FemaleCount = 0;
		self.JuvenileCount = 0;
		self.UndivCount = 0;
		self.SizeGroupId = "";
		self.ObservationComment = "";
		self.TaxonName = "";
		self.Image = [];

		/* Observation List */
		self.ObservationList = $('#list').data("kendoListView").dataSource.data();

		/* Functions */
		self.addObsForm = addObsForm;
		self.addObsToList = addObsToList;
		self.cancelObservation = cancelObservation;
		self.saveLocality = saveLocality;
		return self;
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
	
	/* Vorbelegung bei Bearbeitung */
	(function presetValues(){
		var urlParams = new URLSearchParams(location.search);
		var eventId = urlParams.get('eventId');
		if (eventId != null){
			$("main>section>h2").text("Fund hinzufügen");
			document.title = "Fund hinzufügen";
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
						vm.set("AccuracyTypeId", event.AccuracyId);
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
						disableInput();
					}
				}
			});
		}
	})();	
});

function disableInput() {
	$("#fundortLink").show();
	$("#localityName").data("kendoAutoComplete").readonly(true);
	$("#localityName").attr("disabled", "disabled");
	$("#CountryId").data("kendoDropDownList").readonly(true);
	$("#CountryId").attr("disabled", "disabled");
	if($("#RegionId").data("kendoDropDownList")) {
		$("#RegionId").data("kendoDropDownList").readonly(true);
		$("#RegionId").attr("disabled", "disabled");		
	}
	$("#habitatDescription").attr("disabled", "disabled");
	$("#latitudeDecimal").data("kendoNumericTextBox").readonly(true);
	$("#longitudeDecimal").data("kendoNumericTextBox").readonly(true);
	$("#latitudeDecimal").attr("disabled", "disabled");
	$("#longitudeDecimal").attr("disabled", "disabled");
	$("#accuracy").data("kendoDropDownList").readonly(true);
	$("#accuracy").attr("disabled", "disabled");
	$("#habitat1").data("kendoDropDownList").readonly(true);
	$("#habitat1").data("kendoDropDownList").readonly(true);
	$("#habitat2").data("kendoDropDownList").readonly(true);
	$("#habitat2").attr("disabled", "disabled");
	$("#habitat3").data("kendoDropDownList").readonly(true);
	$("#habitat3").attr("disabled", "disabled");
}

//template function
var sizeGroupData;

function getSizeGroupName(sizeGroupId) {
	return sizeGroupData.filter(i => i.SizeGroupId==sizeGroupId)[0].SizeGroupName;
}