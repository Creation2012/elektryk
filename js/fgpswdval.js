$(document).ready(function(){
	$('#fgpswd').click(function(event){
		event.preventDefault();
		var email = $('#Email').val();
		$('#error').load('fgpswd.php',{
			email: email
		});
	});
});