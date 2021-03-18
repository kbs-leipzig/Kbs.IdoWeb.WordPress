$(document).ready(function () {
	//var serviceRoot = "https://corenet.kbs-leipzig.de/api";
	var serviceRoot = "https://idoweb.bodentierhochvier.de/api";
	
	async function getAccuracyTypeAsync(){
		try {
			var advices = await $.ajax({
				url: serviceRoot + "/values/Obs/AccuracyType",
				contentType: "application/json; charset=utf-8;",
				crossDomain: true,
				xhrFields: {
					withCredentials: true
				}
			});        
			var lang = kendo.culture().name.toLowerCase().split('-')[0];
			advices.map(i => {i.text = JSON.parse(i.LocalisationJson).filter(e => e.lang.toLowerCase().includes(lang))[0].text; i.value=i.AccuracyTypeId});
			return advices;
		} catch (err) {
		}
	}
	getAccuracyTypeAsync().then(advices =>
	$("#grid").kendoGrid({
		type:"json",
		dataSource: {
			transport: {
    			read: {
					url: serviceRoot + "/Advice/Events/User",
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					xhrFields: { withCredentials: true },
					crossDomain: true,
				},
				destroy: {
						url: serviceRoot + "/Advice/Event/Delete",
						contentType: "application/json; charset=utf-8",
						dataType: "json",
						type: "post",
						xhrFields: { withCredentials: true },
						crossDomain: true,												
				},
				parameterMap: function(data, type) {					
					return kendo.stringify(data);
               },
			},
			schema:
			{
				model: {
					id: "EventId",
				}
			},			
			sort: {
                	field: 'LocalityName',
                    dir: 'asc'
			},
		},
		sortable: true,
		filterable: true,
		serverPaging: true,
		pageable: {
			pageSize: 20
		},
		columns: [
			{ field: "LocalityName", title: "Fundort",  width: 200 },
			{ field: "HabitatDescription", title: "Fundortsbeschreibung", width: 200 },
			{ field: "LatitudeDecimal", title: "Breite", format: "{0:n3}" },
			{ field: "LongitudeDecimal", title: "Länge", format: "{0:n3}" },
			{ field: "TkNr", title: "Tk25Id" },
			{ field: "AccuracyId", title: "Genauigkeit", values: advices,  width: 200},
			{ field: "AuthorName", title: "Autor", width: 200 },
			{
				command: [{
					iconClass: "k-icon k-i-edit",
					name: "Bearbeiten", click:
					function (e) {
						e.preventDefault();
						var tr = $(e.target).closest("tr");
						var data = this.dataItem(tr);
						window.location.href="/erfassen/fundort?eventId="+data.id;
					}
				}], width: 200
			},
			{
				command: [{
					name: "Fund hinzufügen", click:
					function (e) {
						e.preventDefault();
						var tr = $(e.target).closest("tr");
						var data = this.dataItem(tr);
						window.location.href="/erfassen/funde?eventId="+data.id;
					}
				}], width: 200
			},
			{ command: ["destroy"], width: 230 },
		],
	}));
});