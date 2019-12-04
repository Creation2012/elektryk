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
	$('.editwho').click(function(){
		var who = $(this).attr('name');
		return $(this).attr('id');
	});
	
	$('a').click(function(){
		var type = $(this).attr('value');
		var newtype = $(this).attr('name');
		$(this).closest('button').html(newtype);
	});
	
	$('.edittype').click(function(){
		var who = $(this).attr('value');
		$.ajax({
			url: 'additionalPHP/admincontrolbaredit.php',
			type: 'POST',
			data: {who: who},
			success: function(msg){
				alert(msg);
			}
		});
	});

});