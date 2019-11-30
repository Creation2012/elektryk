$(document).ready(function(){
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
	
	if(getUrlParameter('error')==1){
			$('#Email').addClass("border-danger");
			$('#Password').addClass("border-danger");
			$('#error').load("Podałeś błędne dane!");
		}
		
	$('#log').click(function(event){
		event.preventDefault();
		if($('#Email').val()==""||$('#Password').val()==""){
			$('#Email, #Password').addClass("border-danger");
		}
		else{
			var email = $('#Email').val();
			var password = $('#Password').val();
			$('#gif').show();
			$('#Email, #Password').removeClass("border-danger");
			$.ajax({
			url : "login.php",
			type: "POST",
			data : {email: email, password: password},
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