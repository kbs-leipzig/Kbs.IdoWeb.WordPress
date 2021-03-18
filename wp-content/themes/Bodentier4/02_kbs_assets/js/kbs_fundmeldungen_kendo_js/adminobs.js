$(document).ready(function () {
	//var serviceRoot = "https://corenet.kbs-leipzig.de/api";
	var serviceRoot = "https://idoweb.bodentierhochvier.de/api";

	var getTable = async function(schema,type){
		try {
			var result = await $.ajax({
				url: serviceRoot + (schema!=""?"/values/"+schema:"")+"/"+type,
				contentType: "application/json; charset=utf-8;",
				crossDomain: true,
				xhrFields: { withCredentials: true },
			});
			return result;
		} catch (err) {
		}
	}

	function getLocalisation(jsonResult, type){
		var lang = kendo.culture().name.toLowerCase().split('-')[0];
		jsonResult.map(i => {i.text = JSON.parse(i.LocalisationJson).filter(e => e.lang.toLowerCase().includes(lang))[0].text; i.value=i[type+"Id"]});
		return jsonResult;
	}
	Promise.all([getTable("Obs","DiagnosisType"),getTable("Obs","LocalityType"),getTable("Obs","SizeGroup"),getTable("","taxons"),getTable("Obs","ApprovalState"),getTable("Inf","Region")]).then(function([diagnosis,locality,sizegroup, taxonData,approval,region]){
		diagnosis = getLocalisation(diagnosis,"DiagnosisType");
		locality = getLocalisation(locality, "LocalityType");
		region = getLocalisation(region, "Region");
		sizegroup = sizegroup.map(i => {i.text = i.SizeGroupName; i.value=i.SizeGroupId; return i;});
		approval = approval.map(i => {i.text = i.ApprovalStateName; i.value=i.ApprovalStateId; return i;});
		//region = region.map(i => {i.text = i.LocalisationJson.text; i.value=i.RegionId; return i;});
		function getTaxonByTaxonId(taxonId){
			var result = taxonData.filter(t => t.TaxonId==taxonId)[0];
			//console.log(typeof(result.TaxonName) !== 'undefined');
			if(typeof(result) !== 'undefined') {
				return taxonData.filter(t => t.TaxonId==taxonId)[0].TaxonName;				
			} else {
				return taxonId;
			}
		}
		$("#grid").kendoGrid({
			dataBound: onDataBound,
			type:"json",
			headerAttributes: {
			  "class": "table-header-cell",
			  style: "text-align: right; font-size: 14px; background-color:#eee;"
			},
			dataSource: {
				transport: {
					read: {
						//url: serviceRoot + "/values/Obs/Observation",
						url: serviceRoot + "/Advice/Observations/Admin",
						contentType: "application/json; charset=utf-8",
						dataType: "json",
						xhrFields: { withCredentials: true },
						crossDomain: true,
					},
					update: {
						url: serviceRoot + "/Advice/Observation/Update",
						contentType: "application/json; charset=utf-8",
						dataType: "json",
						type: "post",
						xhrFields: { withCredentials: true },
						crossDomain: true,						
					},
					destroy: {
						url: serviceRoot + "/Advice/Observation/Delete",
						contentType: "application/json; charset=utf-8",
						dataType: "json",
						type: "post",
						xhrFields: { withCredentials: true },
						crossDomain: true,												
					},
					parameterMap: function(data, type) {					
						return kendo.stringify(data);
				}
				},
				sort: {
                	field: 'HabitatDate',
                    dir: 'desc'
				},
				schema:
				{
					model: {
						id: "ObservationId",
						fields: {
							ObservationId: {type: "number", editable: false},
							AdviceCount: { type: "number" },
							MaleCount: { type: "number" },
							FemaleCount: { type: "number" },
							JuvenileCount: { type: "number" },
							ObservationComment: { type: "string" },
							HabitatDate: { type: "date", editable: false },
							AuthorName: {type: "string", editable:false},
							RegionId: {type: "number", editable: false},
							LocalityName: {type: "string", editable: false},
						}
					}
				},
				pageSize: 20
			},
			sortable: true,
			filterable: true,
			serverPaging: true,
			pageable: {
				pageSize: 20
			},
			columns: [
				{ field: "ObservationId", title: "FundId", editor:readOnly, editable: false, width:75 },
				{ field: "ApprovalStateId", title: "Status", values: approval,  width: 100},
				{ field: "ObservationComment", title: "Kommentar",  width: 150 },
				{ field: "RegionId", title: "Bundesland", values:region,  width: 100, editable:false },
				{ field: "LocalityName", title: "Fundort",  width: 125, editable:false },
				{ field: "AuthorName", title: "Autor",  width: 125, editable:false },
				{ field: "HabitatDate", title: "Funddatum", editable:false, format:"{0:dd.MM.yyyy}", width:125, sortable: {initialSortDirection: 'desc'} },
				{ field: "DiagnosisTypeId", title: "Bestimmungsmethode", values: diagnosis,  width: 300 },
				{ field: "TaxonId", title: "Taxon", width: 220,
				 template: function(dataItem) { return getTaxonByTaxonId(dataItem.TaxonId) }, editor: function (container, options) {
					 var input = $("<input name=\"TaxonId\" />");
					 input.appendTo(container);
					 input.kendoDropDownList({
						 optionLabel: "Wähle die Art",
						 dataTextField: "TaxonName",
						 dataValueField: "TaxonId",
						 dataSource: taxonData.filter(t => t.TaxonomyStateId == 301),
						 noDataTemplate: "Art unbekannt",
						 filter: "contains",
						 //filtering: taxon_filtering,
						 //change: taxon_onchange
					 }).data("kendoDropDownList");
				 }
				},
				{ field: "AdviceCount", title: "#", format: "{0:d}",  width: 66 },
				{ field: "MaleCount", title: "M", format: "{0:d}",  width: 66 },
				{ field: "FemaleCount", title: "W", format: "{0:d}",  width: 66 },
				{ command: ["edit", "destroy"], width: 230 },
				{ field: "ObservationId", title: "Bearbeiten", template: '<a href="/administration/details-zu-fundmeldung?oid=#=ObservationId#">Details</a>', width:75},
				{
					command: [{
						iconClass: "k-icon k-i-edit",
						name: "Zum Fundort", click:
						function (e) {
							e.preventDefault();
							var tr = $(e.target).closest("tr");
							var data = this.dataItem(tr);
							window.location.href="/erfassen/fundort?eventId="+data.EventId;
						}
					}], width: 200
				},
				{ field: "Image", title: "Bilder", editor: readOnly, width:200,
				 	template: function(obs) {
						var images = obs.Image;
						var contentString = "<div class='image_wrapper'>";
						images.forEach(function(imageItem) {
							contentString += "<figure class='table_image'><a data-width='800' data-height='600' class='swipeLink' target='_blank' href='/wp-content/uploads/" + imageItem.ImagePath + "'><img src='/wp-content/uploads/" + imageItem.ImagePath + "'></a></figure>";
						})
						contentString += "</div>";
						return contentString;

        			}
				},
			],
			editable: {
				mode: "inline"
			},
		});
	}).then(()=>{
		var urlParams = new URLSearchParams(location.search);
		var userId = urlParams.get('userId');
		if (userId != null){
			$("#grid").data().kendoGrid.dataSource.filter({field:"UserId",operator:"eq",value:userId});
		}
		var eventId = urlParams.get('eventId');
		if (eventId != null){
			$("#grid").data().kendoGrid.dataSource.filter({field:"EventId",operator:"eq",value:eventId});
		}
	});
});

      function onDataBound() {
        var wrapper = this.wrapper,
            header = wrapper.find(".k-grid-header");

        function resizeFixed() {
          var paddingRight = parseInt(header.css("padding-right"));
          header.css("width", wrapper.width() - paddingRight);
        }

        function scrollFixed() {
          var offset = $(this).scrollTop(),
              tableOffsetTop = wrapper.offset().top,
              tableOffsetBottom = tableOffsetTop + wrapper.height() - header.height();
          if(offset < tableOffsetTop || offset > tableOffsetBottom) {
            header.removeClass("fixed-header");
          } else if(offset >= tableOffsetTop && offset <= tableOffsetBottom && !header.hasClass("fixed")) {
            header.addClass("fixed-header");
          }
        }

        resizeFixed();
        $(window).resize(resizeFixed);
        $(window).scroll(scrollFixed);
      }

function readOnly(container, options) {
	console.log(container);
	console.log(options);
	container.removeClass("k-edit-cell");
	container.text("Nicht editierbar");
}