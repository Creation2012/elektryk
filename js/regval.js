$(document).ready(function(){
	//Sending data to server
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
	
	//Progress bar control 
	var pattern = /(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
	var patternm = /(?=^.{6,}$)(^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$)/;
	$('#Password').keyup(function(){
		var passwordPB = $('#Password').val();
		if(pattern.test(passwordPB)){
			$('#PB').html('<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>');
		}
		else if(patternm.test(passwordPB)){
			$('#PB').html('<div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: 66.6%" aria-valuenow="66.6" aria-valuemin="0" aria-valuemax="100"></div>');
		}
		else if(passwordPB==""){
			$('#PB').html('<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>');
		}
		else{
			$('#PB').html('<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 33.3%" aria-valuenow="33.3" aria-valuemin="0" aria-valuemax="100"></div>');
		}
	});
});