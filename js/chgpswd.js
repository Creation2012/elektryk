$(document).ready(function(){
	//Sending data to server
	
    var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;
    for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split('=');
    
    if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
    }
    	}
    }; 
	
	$('#reg').on('click',function(event){
		event.preventDefault();
		
		var password = $('#Password').val();
		var rpassword = $('#RPassword').val();
		var hash = getUrlParameter("hash");
		var email = getUrlParameter("email");
		$('#error').load('additionalPHP/chgpswd.php',{
			password: password,
			rpassword: rpassword,
			hash: hash,
			email: email
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
	
	//Password visibility
	$('#vis').click(function(){
		if($('#vis').hasClass("fa-eye")){
			$('#vis').removeClass("fa-eye");
			$('#vis').addClass("fa-eye-slash");
			document.getElementById('Password').type = "text";
			document.getElementById('RPassword').type = "text";
		}
		else if($('#vis').hasClass("fa-eye-slash")){
			$('#vis').addClass("fa-eye");
			$('#vis').removeClass("fa-eye-slash");
			document.getElementById('Password').type = "password";
			document.getElementById('RPassword').type = "password";
		}
	});
});