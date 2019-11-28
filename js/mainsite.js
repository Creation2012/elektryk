$(document).ready(function(){
	$('#profiles').click(function(){
		$('#main-content').load("additionalPHP/profile.php",function(){
			$('.userprofile').click(function(){
				var profile = $(this).val();
				$('#main-content').load("additionalPHP/profilesite.php",{profile: profile},function(){
					$('#personaldata').click(function(){
						$('#main-content').load("additionalPHP/personalinfo.php",{profile: profile},function(){
							$('#photo').click(function(){
								$('input:file')[0].click();
							});
							$('#passwordnew').click(function(){
								alert("Cos");
								$(this).preventDefault();
								$('#Password #RPassword').removeClass('border-danger');
								if($('#Password').val()==""){
									$('#Password').addClass('border-danger'); 
								}
								if($('#RPassword').val()==""){
									$('#RPassword').addClass('border-danger'); 
								}
							});
						});
					});
				});
			});
		});
	});
});