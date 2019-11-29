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
							$('#pphoto').click(function(event){
								event.preventDefault();
								if($('#avatar').val()==""){
									alert("Wybierz plik do wysłania");
								}
								else{
									var avatar = $('#avatar').val();
									$('#error').load("additionalPHP/pavatar.php",{avatar: avatar, profile: profile});
								}
							});
							$('#passwordnew').click(function(event){
								event.preventDefault();
								var Password = $('#Password').val();
								var RPassword = $('#RPassword').val();
								var what = this.id;
								$('#error').load("additionalPHP/pdataeditionpswd.php",{Password: Password, RPassword: RPassword, what: what, profile: profile});
							});
							$('#pdata').click(function(event){
								event.preventDefault();
								var name = $('#Name').val();
								var surname = $('#Surname').val();
								var email = $('#Email').val();
								var phone = $('#Phone').val();
								var what = this.id;
								$('#error').load("additionalPHP/pdataedition.php",{name: name, surname: surname, email: email, phone: phone, what: what, profile: profile});
							});
						});
					});
				});
			});
		});
	});
});