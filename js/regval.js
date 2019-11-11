$(document).ready(function(){
	//Wysłanie danych do bazy danych
	$('#reg').on('click',function(){
		event.preventDefault();
		var name= $('#Name').val();
		var lname = $('#LName').val();
		var email = $('#Email').val();
		var password = $('#Password').val();
		var rpassword = $('#RPassword').val();
		$('#error').load('additionalPHP/regval.php',{
			name: name,
			lname: lname,
			email: email,
			password: password,
			rpassword: rpassword
		});
	});
});