$(document).ready(function () {
	//var serviceRoot = "https://corenet.kbs-leipzig.de/api";
	var serviceRoot = "https://idoweb.bodentierhochvier.de/api";

	$("#grid").kendoGrid({
		type:"json",
		dataSource: {
			transport: {
    			read: {
					url: serviceRoot + "/UserProfile/AllUsers",
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					xhrFields: { withCredentials: true },
					crossDomain: true,
				},
    			update: {
					url: serviceRoot + "/UserProfile/UpdateUser",
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					method: "POST",
					crossDomain: true,
					xhrFields: { withCredentials: true },
				},
				parameterMap: function(data, type) {					
					return kendo.stringify(data);
               }
			},
			schema:
			{
				model: {
					id: "Id",
					fields: {
						UserRoles: {
							type: "string",
							validation: {
								notEmptyValidation: function (input) {
									if (input.is("[Name='UserRoles']")) {
										optionsChosen = 0 != input.prev().children().children().length;
										var listinput = input.prev().children("input[role=listbox]");
										if (optionsChosen) {
											listinput.hide();
										} else {
											listinput.show();
										}
										return optionsChosen;
									}
									return true;
								}
							}
						},
					}
				}
			}
		},
		sortable: true,
		filterable: true,
		serverPaging: true,
		pageable: {
			pageSize: 10
		},
		columns: [
			{ field: "Email", title: "E-Mailadresse", width: 300 },
			{ field: "FirstName", title: "Vorname", width: 200 },
			{ field: "LastName", title: "Nachname", width: 200 },
			{ field: "Comment", title: "Kommentar", width: 200 },
			{
				field: "UserRoles", title: "Rollen", width: 150, editor: function (container, options) {
					var input = $("<input name=\"UserRoles\" />");
					input.appendTo(container);
					var span = $("<div style=\"display:none\"><span data-for=\"UserRoles\" class=\"k-invalid-msg\"></span></div>");
					span.appendTo(container);
					input.kendoMultiSelect({
						dataSource: ["Admin", "User"],
						change: function (e) {
							options.model.UserRoles = options.model.UserRoles.split(",").sort().join(",");
						},
						noDataTemplate: "Rolle existiert nicht",
					});
					setTimeout(function () {
						var roles = options.model.UserRoles.split(",");
						input.data("kendoMultiSelect").value(roles);
						var listinput = input.prev().children("input[role=listbox]");
						listinput.attr("placeholder", "Wert benötigt");
						listinput.hide();
					}, 0)
				}
			},
			{
				field: "DataRestrictionId", title: "Lizenz", width: 300, values: [
					{ text: "keine Weitergabe", value: "1" },
					{ text: "Weitergabe an Dritte (Name, Tk25, Jahr)", value: "2" },
					{ text: "Weitergabe an Dritte (Name, Punktkoordinaten, Datum)", value: "3" }
				]
			},
			{ command: ["edit"], width: 150 },
			{
				command: [{
					name: "Funde anzeigen", click:
						function (e) {
							e.preventDefault();
							var tr = $(e.target).closest("tr");
							var data = this.dataItem(tr);
							window.location.href="/administration/funde?userId="+data.id;
						}
				}], width: 160
			},
			{
				command: [{
					name: "Fundorte anzeigen", click:
						function (e) {
							e.preventDefault();
							var tr = $(e.target).closest("tr");
							var data = this.dataItem(tr);
							window.location.href="/administration/fundorte?userId="+data.id;
						}
				}], width: 160
			}
		],
		editable: {
			mode: "inline"
		},
	});
});