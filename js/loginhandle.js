$(document).ready(function(){
	function getCookie(name){
	   var value = "; " + document.cookie;
	   var parts = value.split("; " + name + "=");
	   if (parts.length == 2) return parts.pop().split(";").shift();
	}

	var cookiemail = getCookie('email');
	$('#Email').val(cookiemail);
	
	$('#log').click(function(event){
		event.preventDefault();
		if($('#Email').val()==""||$('#Password').val()==""){
			$('#Email, #Password').addClass("border-danger");
		}
		else{
			var email = $('#Email').val();
			var password = $('#Password').val();
			if(document.getElementById('customChecked').checked){
				var cookies = 1;
			}
			$('#gif').show();
			$('#Email, #Password').removeClass("border-danger");
			$.ajax({
			url : "login.php",
			type: "POST",
			data : {email: email, password: password, cookies: cookies},
			success: function(response) {
				if(response=="1"){
					window.location = "index.php";
				}else{
					$('#gif').hide();
					$('#Email, #Password').addClass("border-danger");
				}				
			}
			});
		}
	});	
});