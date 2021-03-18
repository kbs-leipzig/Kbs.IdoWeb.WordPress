(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(document).ready(function () {
		$("#do_update_btn").on("click", function () {
			if(confirm("Update ausführen?")) {
				update_page_info();
			}
		});
		
		$("#do_init_btn").on("click", function () {
			if(confirm("Neu Seiten erstellen?")) {
				create_pages();
			}
		});
		
		$("#do_delete_btn").on("click", function () {
			if(confirm("Alle Steckbrief Seiten löschen?")) {
				delete_generated_pages();
			}
		});
		
	});
	
	function delete_generated_pages () {
		var answer = "Done.";
		$.ajax({
			beforeSend: function () {
				$("#loading").html("Please wait ..").show();
				$("input[id$=_btn]").addClass('disabled');
			},
			type: 'POST',
			url: ajaxurl,
			//timeout: 3000000,
			data: {
				action: 'delete_generated_pages',
				'data': 'sth'
			},
			success: function (data, textStatus, XMLHttpRequest) {
				console.log("Deleted " + data + " pages. Done.");
				answer = "<p>Deleted " + data + " pages</p>";
				$("#loading").append(answer);
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				answer = textStatus;
				alert(errorThrown);
			},
			complete: function () {
				$("#loading").append("Done.").delay(3000);
				$("input[id$=_btn]").removeClass('disabled');
			}
		});
	}
	
	function create_pages() {
		var answer = "Success.";
		//console.log("creating page ");
		try {
			$.ajax({
				beforeSend: function () {
					$("input[id$=_btn]").removeClass('disabled');
					$("#loading").append("<p>Creating pages</p>").show();
					$("#loading").append("<p>Please wait .. </p>");
				},
				type: 'POST',
				url: ajaxurl,
				timeout: 9999999,
				data: {
					action: 'create_page',
					//'data': taxonDetail,
					//'parent_id': parent_id
				},
				success: function (data, textStatus, XMLHttpRequest) {
					answer = "<p>Created " + data + " pages</p>";
					//console.log(answer);
					$("#loading").append(answer);
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
					answer = textStatus;
					$("#loading").append("<p>Failed: " + textStatus + " "+errorThrown + "</p>");
					console.log(errorThrown);
					console.log(textStatus);
				},
				complete: function () {
					$("#loading").append("Done.");
					$("input[id$=_btn]").removeClass('disabled');
				}
			});
		} catch (e) {
			$("#loading").append("Error: " + e);
		}
	}
		
	function update_page_info() {
		var answer = "Done.";
		$.ajax({
			beforeSend: function () {
				$("#loading").html("<p>Please wait ..</p>").show();
				$("input[id$=_btn]").addClass('disabled');
				$("#loading").append("<p>Getting infos from API ..</p>");
			},
			type: 'POST',
			url: ajaxurl,
			timeout: 300000,
			data: {
				action: 'init_page_generation',
			},
			success: function (data, textStatus, XMLHttpRequest) {
				$("#loading").append("<p>Got response from server. Success!</p>");
				//console.log(data);
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				answer = textStatus;
				console.log(errorThrown);
				console.log(textStatus);
				$("#loading").append("<p>Error getting infos: "+ errorThrown +"</p>");
			},
			complete: function () {
				$("#loading").append("Thank you. Bye!").delay(3000);
				$("input[id$=_btn]").removeClass('disabled');
			}
		});
	}

})( jQuery );
