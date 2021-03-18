$(document).ready(function () {
//	var serviceRoot = "https://corenet.kbs-leipzig.de/api/";
	var serviceRoot = "https://idoweb.bodentierhochvier.de/api";
	var status = $("#status");
	$.ajax({
		type: "POST",
		url: serviceRoot + "/ApplicationUser/Logout",
		crossDomain: true,
		xhrFields: {
			withCredentials: true
		},
		success: function (data) {
			if (data.succeeded){
				document.getElementById('status').className = "valid";
				document.getElementById('status').innerHTML = "Du wurdest erfolgreich abgemeldet.";
			}else{
				document.getElementById('status').className = "invalid";
				document.getElementById('status').innerHTML = "Ladefehler.";
			}
		},
		error: function (data) {
			document.getElementById('status').className = "invalid";
			document.getElementById('status').innerHTML = "Ladefehler.";
		}
	});
});