$(document).ready(function(){
	function getCookie(cname) {
	  var name = cname + "=";
	  var decodedCookie = decodeURIComponent(document.cookie);
	  var ca = decodedCookie.split(';');
	  for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
		  c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
		  return c.substring(name.length, c.length);
		}
	  }
	  return "";
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
			if(document.getElementById('customCheck').checked){
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