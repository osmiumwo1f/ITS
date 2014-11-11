$(function() {
	$('#upload_file').submit(function(event) {
		event.preventDefault();
		$.ajax({
			cache: false,
			type: 'POST',
			url: 'http://localhost:8080/its/events/upload_file',
			dataType: 'json',
			data: {'name': $('#name').val()},
			success	: function (data, status)
			{
				if(data.status != 'error')
				{
					$('#files').html('<p>Reloading files...</p>');
					refresh_files();
					$('#title').val('');
				}
				alert('...'+data.msg);
			}
		});
		return false;
	});
});

/*$(document).ready(function(){
	$('div.content').on('click', 'button.add', function(event){
		$('#modal').show();
		$('#shade').show();
	});

	$('div.content').on('click', 'button.close', function(event){
		$('#modal').hide();
		$('#shade').hide();
	});

	$('div.content').on('click', 'button.upload', function(event){
		event.preventDefault();
		alert('upload');
		var file = $('input#file').val();
		var name = $('input#name').val();
		var des = $('textarea#des').val();
		console.log('name: '+name+' des: '+des+' file: '+file);
	});
});

function upload(){

	$.ajax({
			cache: false,
			type: 'POST',
			url: 'http://localhost:8080/its/events/upload_file',
			type: 'post',
			data: {},
			success: function (data) {
				data
			}
		});
}*/