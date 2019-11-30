$(document).ready(function(){
	
	function refreshImage(imgElement, imgURL){
       var timestamp = new Date().getTime();
	   var el = document.getElementById(imgElement);
	   var queryString = "?t=" + timestamp;
	   el.src = imgURL + queryString;    
	}
	
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
								$('#photo').css('border','gray');
								event.preventDefault();
								var file_data = $('#avatar').prop('files')[0];   
								var form_data = new FormData();
								form_data.append('file', file_data);
								if(typeof(file_data)!='undefined'){
									$.ajax({
										url: 'additionalPHP/pavatar.php',
										dataType: 'text',
										cache: false,
										contentType: false,
										processData: false,
										data: form_data,                         
										type: 'POST',
										success: function(data){
											errors = JSON.parse(data);
											if(errors["0"]=="1"){
												$('#photo').css('border', 'red');
												alert("Tylko plik typu .jpg!");
											}else if(errors["1"]=="1"){
												$('#photo').css('border', 'red');
												alert("Wystąpił błąd podczas ładowania pliku!");
											}else if(errors["2"]=="1"){
												$('#photo').css('border', 'red');
												alert("Za duży plik!!");
											}else{
												d = new Date();
												$('#photo').attr('src','img/avatar/'+profile+'.jpg?'+d.getTime());
												alert("Udało się załadować nowe zdjęcie!");
												document.getElementById('pavatarform').reset();
											}
										}
									 });
								}else{
									$('#photo').css('border', 'red');
									alert("Wybierz jakiś plik!");
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