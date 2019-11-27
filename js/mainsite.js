$(document).ready(function(){
	$('#profiles').click(function(){
		$('#main-content').load("additionalPHP/profile.php",function(){
			$('.userprofile').click(function(){
				var profile = $(this).val();
				$('#main-content').load("additionalPHP/profilesite.php",{profile: profile},function(){
					$('#personaldata').click(function(){
						$('#main-content').load("additionalPHP/personalinfo.php",{profile: profile});
					});
				});
			});
		});
	});
});