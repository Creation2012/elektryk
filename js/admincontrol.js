$(document).ready(function(){
	
	//Deleting spam accounts
	$('.dlspam').click(function(){
		var who = $(this).attr('value');
		$.ajax({
			url: 'additionalPHP/admincontrolbardel.php',
			type: 'POST',
			data: {who: who},
			success: function(msg){
				alert(msg);
			}
		});
	});

});