$(document).ready(function () {
	var serviceRoot = "https://idoweb.bodentiere.de/api/";
    //Validator
    var validator = $("#form").kendoValidator({
		rules: {
			checkEmail: function (input) {
				if (input.is("[name=EMail]")) {
					return true;
					console.log(/\S+@\S+\.\S+/.test($(input).val()));
					return /\S+@\S+\.\S+/.test($(input).val());
				}
				return true;
			}
		},
		messages: {
			email: "E-Mail ist ungültig",
			checkEmail: "E-Mail ist ungültig"
		},
		errorTemplate: "<span class='invalid form-validation' >#=message#</span>"
	}).data("kendoValidator"),
	status = $("#status");
	
    //Anmeldung
    var ulvm = new UserLoginViewModel();
    kendo.bind($("#form"), ulvm);
	function UserLoginViewModel() {
		var self = new kendo.data.ObservableObject();
		var defaultAjaxContentType = "application/json; charset=utf-8;";
		self.Email = "";
		self.Token = "";
		self.NewPassword = "";
		self.requestToken = function () {
			if (validator.validate()) {
				$.ajax({
					method: "POST",
					url: serviceRoot + "ApplicationUser/ResetToken",
					crossDomain: true,
					xhrFields: {
						withCredentials: true
					 },
					data: JSON.stringify(self),
					contentType: defaultAjaxContentType,
					success: function (data) {
						if (data == "success") {
							console.log(data);
							//self.Token = data.token;
							status.removeClass("invalid");
							status.addClass("valid");
							status.html("Überprüfung erfolgreich, bitte überprüfen Sie Ihren Posteingang.<br/>Bitte kopieren Sie das Token aus der E-Mail und vergeben Sie ein neues Passwort.");
							$("#passwordContainer").show();
							$("#tokenContainer").show();
							$("#requestTokenButton").hide();
							$("#updatePasswordButton").show();
						} else {
							status.removeClass("valid");
							status.addClass("invalid");
							status.text("Passwort zurücksetzen fehlgeschlagen.");						
						}
					},
					error: function (data) {
						status.removeClass("valid");
						status.addClass("invalid");
						status.text("Passwort zurücksetzen fehlgeschlagen.");
					}
				});
			} else {
				status.removeClass("valid");
				status.addClass("invalid");
				status.text("Bitte überprüfen Sie die E-Mail");	
			}
			return true;
		}
		
		self.updatePassword = function () {
			//send 2nd request for sending mails
			$.ajax({
				method: "POST",
				url: serviceRoot + "ApplicationUser/PasswordReset",
				crossDomain: true,
				xhrFields: {
					withCredentials: true
				},
				data: JSON.stringify(self),
				contentType: defaultAjaxContentType,
				success: function (data) {
					console.log(data);
					if(data.succeeded) {
						status.removeClass("invalid");
						status.addClass("valid");
						status.html("Passwort erfolgreich erneuert. Hier kommen Sie zum <a href='/anmeldung'>Login</a>");
					}
					else
					{
						status.removeClass("valid"),
						status.addClass("invalid");
						var txt = "<strong>Passwort zurücksetzen fehlgeschlagen.</strong>";
						if(data.errors.length > 0) {
							for(i = 0; i < data.errors.length; i++) {
								txt += "<br/> " + data.errors[i].description;
							}
						}
						status.html(txt);
					}
				},
				error: function (data) {
					status.removeClass("valid");
					status.addClass("invalid");
					status.text("Passwort zurücksetzen fehlgeschlagen.");
				}
			});
		}
		return self;
	}
});