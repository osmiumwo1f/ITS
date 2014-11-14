$(document).ready(function(){
	$('div.content').on('click', 'button.add', function(event){
		$('#modal').show();
		$('#shade').show();
	});

	$('div.content').on('click', 'button.close', function(event){
		$('#modal').hide();
		$('#shade').hide();
	});

	$('div.content').on('click', '#upload', function(event){
		event.preventDefault();
		alert('upload');
	});
});

function upload(){

	$.ajax({
		url: 'submit.php?files',
		type: 'POST',
		data: data,
		cache: false,
		dataType: 'json',
		processData: false, // Don't process the files
		contentType: false, // Set content type to false as jQuery will tell the server its a query string request
		success: function(data, textStatus, jqXHR){
			if(typeof data.error === 'undefined'){
			// Success so call function to process the form
				submitForm(event, data);
			}
			else{
			// Handle errors here
				console.log('ERRORS: ' + data.error);
			}
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log('ERRORS: ' + textStatus);
		}
	});
}