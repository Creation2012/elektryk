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
							$('#passwordnew').click(function(event){
								event.preventDefault();
								var Password = $('#Password').val();
								var RPassword = $('#RPassword').val();
								var what = this.id;
								$('#error').load("additionalPHP/pdataedition.php",{Password: Password, RPassword: RPassword, what: what, profile: profile});
							});
						});
					});
				});
			});
		});
	});
});