$(document).ready(function () {
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
					if (input.is("[name=Kennwort]")) {
						var re = /^(?=.*\d)(?=.*[a-z]).{8,}$/;
						return re.test($(input).val());
					}
					return true;
				},
				confirmPassword: function (input) {
					var ret = true;
					if (input.is("[name=Bestätigungskennwort]")) {
						ret = input.val() === $("#password").val();
					}
					return ret;
				},
				checkPolice: function (input) {
					if (input.is("[name=Datenschutz]")) {
						return $(input).prop("checked");
					}
					return true;
				}

			},
			messages: {
				email: "E-Mail ist ungültig",
				checkEmail: "E-Mail ist ungültig",
				checkPolice: "Die Einwilligung zur Datenschutzerklärung und den Nutzungshinweisen fehlt.",
				checkPassword: "Kennwort muss aus 8 oder mehr Zeichen, Kleinbuchstaben und Zahlen bestehen",
				confirmPassword: "Kennwort und Bestätigungskennwort stimmen nicht überein",
			},
			errorTemplate: "<span class='invalid form-validation' >#=message#</span>"
		}
	).data("kendoValidator"),
	status = $("#status");
	$("#buttonRegister").kendoButton({enable: false});
	$("#police").prop("checked", false);
	$("#police").change(function () {
		$("#buttonRegister").data("kendoButton").enable($(this).is(":checked"));
	});
	
	$("#dataRestriction").kendoDropDownList({
		dataTextField: "text",
		dataValueField: "value",
		dataSource: [
			{ text: "keine Weitergabe", value: "1" },
			{ text: "Name, Tk25, Jahr weitergeben", value: "2" },
			{ text: "Name, Koordinaten, Datum weitergeben", value: "3" }
		],
		index: 3
	});
	var vm = new UserRegistrationViewModel();
	kendo.bind($("#form"), vm);

	function UserRegistrationViewModel() {

		var self = new kendo.data.ObservableObject();
		//var baseUrl = "https://corenet.kbs-leipzig.de/";
		var baseUrl = "https://idoweb.bodentierhochvier.de/";
		var serviceRoot = baseUrl + "api/ApplicationUser";
		var defaultAjaxDataType = "json";
		var defaultAjaxContentType = "application/json; charset=utf-8";
		
		self.isChecked = false;
		self.FirstName = "";
		self.LastName = "";
		self.Email = "";
		self.Password = "";
		self.DataRestrictionId = 3;
		self.Comment = "";
		self.registerUser = function () {
			if (validator.validate()) {
				delete self.isChecked;
				//status.text(JSON.stringify(self));
				$.ajax({
					type: "POST",
					url: serviceRoot + "/Register",
					data: JSON.stringify(self),
					contentType: defaultAjaxContentType,
					dataType: defaultAjaxDataType,
					success: function (data) {
						if (data.succeeded) {
							status.addClass("valid");
							status.text("Erfolgreich registriert!");
						}
						else {
							var errors = data.errors;
							var errorText = "";
							errors.forEach(error => {
								errorText += error.description + '<br>';
							});
							status.addClass("invalid");
							status.html(errorText);
						}
					},
					error: function (data) {
						status.addClass("invalid");
						//status.text("Fehler beim Registrieren.");
					}
				});
			}
			return true;
		}
		return self;
	}
});