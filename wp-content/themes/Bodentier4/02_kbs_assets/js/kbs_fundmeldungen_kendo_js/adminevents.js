$(document).ready(function () {
	//var serviceRoot = "https://corenet.kbs-leipzig.de/api";
	var serviceRoot = "https://idoweb.bodentierhochvier.de/api";
	
	async function getApprovallStateAsync(){
		try {
			var approval = await $.ajax({
				url: serviceRoot + "/values/Obs/ApprovalState",
				contentType: "application/json; charset=utf-8;",
				crossDomain: true,
				xhrFields: {
					withCredentials: true
				}
			});        
			approval = approval.map(i => {i.text = i.ApprovalStateName; i.value=i.ApprovalStateId; return i;});
			return approval;
		} catch (err) {
		}
	}
		
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
	
	Promise.all([getAccuracyTypeAsync(),getApprovallStateAsync()]).then(function(resolve) {
		//resolve[0] == advices
		//resolve[1] == approval
	$("#grid").kendoGrid({
		type:"json",
		dataSource: {
			transport: {
    			read: {
					url: serviceRoot + "/Advice/Events/Admin",
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
				/**TODO: update: {} **/
				parameterMap: function(data, type) {					
					return kendo.stringify(data);
               }
			},
			schema:
			{
				model: {
					id: "EventId",
					fields: {
							EventId: { type: "number", editable:false },
							TkNr: { type: "number", editable:false },
							AuthorName: {type: "string"}
						}
				}
			},
			sort: {
                	field: 'LocalityName',
                    dir: 'asc'
			},
		},
		sortable: true,
		serverPaging: true,
		pageable: {
			pageSize: 20
		},
		filterable: true,
		columns: [
			{ field: "LocalityName", title: "Fundort", width: 200 },
			{ field: "HabitatDescription", title: "Fundortsbeschreibung", width: 200 },
			{ field: "LatitudeDecimal", title: "Breite", format: "{0:n3}", width: 150 },
			{ field: "LongitudeDecimal", title: "Länge", format: "{0:n3}", width: 150 },
			{ field: "TkNr", title: "Tk25Id", width: 150 },
			{ field: "AccuracyId", title: "Genauigkeit", values: resolve[0], width: 150},
			{ field: "AuthorName", title: "Autor", width: 200 },
			//{ field: "ApprovalStateId", title: "Status", values: resolve[1], width: 200},
			{
				command: [{
					iconClass: "k-icon k-i-edit",
					name: "Bearbeiten", click:
					function (e) {
						e.preventDefault();
						var tr = $(e.target).closest("tr");
						var data = this.dataItem(tr);
						window.location.href="/erfassen/fundort?eventId="+data.id+"&isadmin=1";
					}
				}], width: 200
			},
			{ command: ["destroy"], width: 230 },
			/**
			{
				command: [{
					name: "Funde anzeigen", click:
						function (e) {
							e.preventDefault();
							var tr = $(e.target).closest("tr");
							var data = this.dataItem(tr);
							window.location.href="/administration/funde?eventId="+data.id
						}
				}], width: 160
			},
			**/
		],
		editable: {
			mode: "inline"
		},
	})}).then(()=>{
		var urlParams = new URLSearchParams(location.search);
		var userId = urlParams.get('userId');
		if (userId != null){
			$("#grid").data().kendoGrid.dataSource.filter({field:"UserId",operator:"eq",value:userId});
		}
	}
	)
});