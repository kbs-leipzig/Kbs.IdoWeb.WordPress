$(document).ready(function () {
	//var serviceRoot = "https://corenet.kbs-leipzig.de/api";
	var serviceRoot = "https://idoweb.bodentierhochvier.de/api";

	var validator = $("#form").kendoValidator(
		{
			rules: {
				checkEmail: function (input) {
					if (input.is("[name=E-Mail]")) {
						var re = /^.+@.+\...+$/;
						return re.test($(input).val());
					}
					return true;
				},
				checkPassword: function (input) {
					if (input.is("[name=Kennwort]")&&$(input).val()!="") {
						var re = /^(?=.*\d)(?=.*[a-z]).{8,}$/;
						return re.test($(input).val());
					}
					return true;
				},
				confirmPassword: function (input) {
					if (input.is("[name=Bestätigung des Kennworts]")) {
						return input.val() == $("#password").val();
					}
					return true;
				}

			},
			messages: {
				email: "E-Mail ist ungültig",
				checkEmail: "E-Mail ist ungültig",
				checkPassword: "Passwort muss Kleinbuchstaben und Zahlen enthalten und aus mindestens 8 Zeichen bestehen",
				confirmPassword: "Das Passwort und das Bestätigungskennwort müssen übereinstimmen.",
			},
			errorTemplate: "<span class='invalid' >#=message#</span>",
		}
		).data("kendoValidator"),
		status = $("#status");

		$("#dataRestriction").kendoDropDownList({
			dataTextField: "text",
			dataValueField: "value",
			dataSource: [
				{ text: "keine Weitergabe", value: "1" },
				{ text: "Name, Tk25, Jahr weitergeben", value: "2" },
				{ text: "Name, Koordinaten, Datum weitergeben", value: "3" }
			]
		});
	var vm = new UserProfileViewModel();
	kendo.bind($("#form"), vm);
	
	function UserProfileViewModel() {
		var self = new kendo.data.ObservableObject();
		$.ajax({
			method: "GET",
			url: serviceRoot + "/UserProfile",
			xhrFields: { withCredentials: true },
			crossDomain: true,
			success: function (result) {
				self.set("FirstName", result.FirstName);
				self.set("LastName", result.LastName);
				self.set("Email", result.Email);
				self.set("Comment", result.Comment);
				self.set("DataRestrictionId", result.DataRestrictionId);
				self.set("Id", result.Id);
			}
		});
		self.updateUser = function () {
			if (validator.validate()) {
				$.ajax({
					url: serviceRoot + "/UserProfile/UpdateUser",
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					method: "POST",
					data: JSON.stringify(self),
					crossDomain: true,
					xhrFields: { withCredentials: true },
					success: function (result) {
							status.addClass("valid");
							status.text("Änderung gespeichert");
					},
					error: function () {
						status.addClass("invalid");
						status.text("Fehler beim Ändern.");
					}
				});
			} else {
				status.addClass("invalid");
				status.text("Bitte überprüfe die Angaben.");
			}
			return true;
		}
		return self;
	}
});