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
	
	if(isset(getUrlParameter('error'))&&getUrlParameter==1){
			$('#Email').addClass("border-danger");
			$('#Password').addClass("border-danger");
		}
	
	$('#log').click(function(){
		$('#log').preventDefault();
		if($('#Email').val()==""||$('#Password').val()==""){
			$('#Email').addClass("border-danger");
			$('#Password').addClass("border-danger");
		}
		else{
			$('form').submit();
		}
	});	
});