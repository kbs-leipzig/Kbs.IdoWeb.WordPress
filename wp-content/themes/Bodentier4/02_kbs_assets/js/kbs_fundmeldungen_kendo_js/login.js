$(document).ready(function () {
	//var serviceRoot = "https://corenet.kbs-leipzig.de/api/";
	//var serviceRoot = "https://127.0.0.2:5001/api/";
	//var serviceRoot = "https://185.15.246.2:8081/api/";
	var serviceRoot = "https://idoweb.bodentiere.de/api/";
    //Validator
    var validator = $("#form").kendoValidator({
		rules: {
			checkEmail: function (input) {
				if (input.is("[name=E-Mail]")) {
					return /.+@.+\...+/.test($(input).val());
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
	function temporaryPHPLogin(token){
		$.ajax({
			method: "POST",
			url: "/wp-content/themes/Bodentier4/wp_login.php",
			data: JSON.stringify({token}),
			success: function (result) {
				if (result ="ok")
				window.location.href="/";
			}
		});
	}
	function UserLoginViewModel() {
		var self = new kendo.data.ObservableObject();
		var defaultAjaxContentType = "application/json; charset=utf-8;";
		self.Email = "";
		self.Password = "";
		self.loginUser = function () {
			if (validator.validate()) {
				$.ajax({
					method: "POST",
					url: serviceRoot + "ApplicationUser/Login",
					crossDomain: true,
					xhrFields: {
						withCredentials: true
					 },
					data: JSON.stringify(self),
					contentType: defaultAjaxContentType,
					success: function (data) {
						//if (data.succeeded) {
						//	window.location.href="/listenerfassung/";
						//	status.removeClass("invalid");
						//	status.addClass("valid");
						//	status.text("Erfolgreich angemeldet");
						//}
						//else
						//{
						//	status.removeClass("valid"),
						//	status.addClass("invalid");
						//	status.text("Anmeldefehler.");
						//}
						if (data.token){
							status.removeClass("invalid");
							status.addClass("valid");
							status.text("Erfolgreich angemeldet");
							temporaryPHPLogin(data.token);
						}
						else
						{
							status.removeClass("valid"),
							status.addClass("invalid");
							status.text("Anmeldefehler.");
						}
					},
					error: function (data) {
						status.removeClass("valid");
						status.addClass("invalid");
						status.text("Anmeldefehler.");
					}
				});
			}
			return true;
		}
		return self;
	}
});