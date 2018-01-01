/*
	Jethwa, Mittal
	Class Account #jadrn020
	Project #3
	Fall 2017
*/
$(document).ready(function () {
	$(':submit').bind('click',function(e) {
		e.preventDefault();

		var pass=$('input[name="pass"]').val();
		var formData = new FormData($('form')[0]);
		formData.append("pass",pass);

		$.ajax ({
			url: 'validate_roster_login.php',
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				if( $.trim(response) == "OK") {
					console.log('ok');
					var formData2 = new FormData($('form')[0]);
					formData2.append("valid","true");
					$.ajax ({
					url: 'report.php',
					type: "POST",
					data: formData2,
					processData: false,
					contentType: false,
					success: function(response) {
						console.log("report returned roster");
						$('#roster-content').html(response);
					},
					error: function(response) {
						console.log("report returned by error");
					}
					});
				}
				else {
					console.log('mismatch');
					$('#status').addClass('alert-danger');
					$('#status').html("Login Unsuccessful");
				}
			},
			error: function(response) {
				console.log('other error');
				$('#status').addClass('alert-danger');
				$('#status').html(response);	
			}

		});
	});
});