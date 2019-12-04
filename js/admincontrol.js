$(document).ready(function(){
	
	//Deleting spam accounts
	$('.dlspam').click(function(){
		$(this).closest("tr").remove();
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
	
	//Editing accounts type
	$('td a').click(function(){
		var type = $(this).attr('value');
		var newtype = $(this).attr('name');
		$(this).closest('div').siblings('button').html(newtype);
		var who = $(this).closest('div').attr('aria-labelledby');
		$.ajax({
			url: 'additionalPHP/admincontrolbaredit.php',
			type: 'POST',
			data: {who: who,type: type},
			success: function(msg){
				alert(msg);
			}
		});
	});
	
	$('.edittype').click(function(){
		
	});

});