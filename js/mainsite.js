$(document).ready(function(){
	$('#submit2,#submit1').click(function(){
		var lookfor = $(this).closest('div').siblings('input').val();
		$('#main-content').load("search.php",{lookfor: lookfor},function(){
			$('tr.users, tr.projects').hover(
				function(){ $(this).addClass('MyHand MyTableSelect') },
				function(){ $(this).removeClass('MyHand MyTableSelect') }
			);
			$('tr.users').click(function(){
				var userID = $(this).attr('value');
				$('#main-content').load("additionalPHP/profilesite.php",{profile: userID},function(){
					var now = new Date();
					var date = "'"+now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate()+' '+now.getHours()+':'+now.getMinutes()+':'+(now.getSeconds()-1)+"'";
					setInterval(function(){
							$.ajax({
								url: 'additionalPHP/returnMessage.php',
								type: 'POST',
								data: {profile: userID, date: date},
								success: function(msg){
								$('.MyTextWindow').append(msg);								
								}
							});
							now = new Date();
							date = "'"+now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate()+' '+now.getHours()+':'+now.getMinutes()+':'+(now.getSeconds()-1)+"'";
						}, 5000);
					
					$('#messagearea').bind('keyup', function(e) {
						if(e.keyCode === 13){ 
							var message = $('#messagearea').val();
							if(message==""||message=='\n'){
								alert("Uzupełnij najpierw pole wiadomości!");
							}
							else{
								$.ajax({
									url: 'additionalPHP/addMessage.php',
									type: 'POST',
									data: {profile: userID, message: message},
									success: function(msg){
										$('.MyTextWindow').append(msg);
									}
								});
							}
							document.getElementById('messagearea').value = '';
						}
					});
					
					$('#sendmessage').click(function(event){
						event.preventDefault();
						var message = $('#messagearea').val();
						if(message==""){
							alert("Uzupełnij najpierw pole wiadomości!");
						}
						else{
							$.ajax({
								url: 'additionalPHP/addMessage.php',
								type: 'POST',
								data: {profile: userID, message: message},
								success: function(msg){
									$('.MyTextWindow').append(msg);
								}
							});
						}
					});
					$('#personaldata').click(function(){
						$('#main-content').load("additionalPHP/personalinfo.php",{profile: userID},function(){
							$('#photo, .MyOverlay').click(function(){
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
												alert("Tylko plik typu .jpg!");
											}else if(errors["1"]=="1"){;
												alert("Wystąpił błąd podczas ładowania pliku!");
											}else if(errors["2"]=="1"){
												alert("Za duży plik!!");
											}else{
												d = new Date();
												$('#photo, #img-profilep').attr('src','img/avatar/'+userID+'.jpg?'+d.getTime());
												alert("Udało się załadować nowe zdjęcie!");
												document.getElementById('pavatarform').reset();
											}
										}
									 });
								}else{
									alert("Wybierz jakiś plik!");
								}
							});
							$('#passwordnew').click(function(event){
								event.preventDefault();
								var Password = $('#Password').val();
								var RPassword = $('#RPassword').val();
								var what = this.id;
								$('#error').load("additionalPHP/pdataeditionpswd.php",{Password: Password, RPassword: RPassword, what: what, profile: userID});
							});
							$('#pdata').click(function(event){
								event.preventDefault();
								var name = $('#Name').val();
								var surname = $('#Surname').val();
								var email = $('#Email').val();
								var phone = $('#Phone').val();
								var what = this.id;
								$('#error').load("additionalPHP/pdataedition.php",{name: name, surname: surname, email: email, phone: phone, what: what, profile: userID});
							});
						});
					});
				});
			});
			$('tr.projects').click(function(){
				var projectid = $(this).attr('value');
				window.location = "https://quartak.000webhostapp.com/project-2.php?id="+projectid;
			});
		});
	});
	
	$('#logoutjs').click(function(){
		if(confirm("Czy na pewno chcesz się wylogować?")){
				window.location = "additionalPHP/logout.php";
		}
	});
	
	$('.userprofile').click(function(){
		var profile = $(this).val();
		$('#main-content').load("additionalPHP/profilesite.php",{profile: profile},function(){
			var now = new Date();
			var date = "'"+now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate()+' '+now.getHours()+':'+now.getMinutes()+':'+(now.getSeconds()-1)+"'";
			setInterval(function(){
					$.ajax({
						url: 'additionalPHP/returnMessage.php',
						type: 'POST',
						data: {profile: profile, date: date},
						success: function(msg){
						$('.MyTextWindow').append(msg);								
						}
					});
					now = new Date();
					date = "'"+now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate()+' '+now.getHours()+':'+now.getMinutes()+':'+(now.getSeconds()-1)+"'";
				}, 5000);
			
			$('#messagearea').bind('keyup', function(e) {
				if(e.keyCode === 13){ 
					var message = $('#messagearea').val();
					if(message==""||message=='\n'){
						alert("Uzupełnij najpierw pole wiadomości!");
					}
					else{
						$.ajax({
							url: 'additionalPHP/addMessage.php',
							type: 'POST',
							data: {profile: profile, message: message},
							success: function(msg){
								$('.MyTextWindow').append(msg);
							}
						});
					}
					document.getElementById('messagearea').value = '';
				}
			});
			
			$('#sendmessage').click(function(event){
				event.preventDefault();
				var message = $('#messagearea').val();
				if(message==""){
					alert("Uzupełnij najpierw pole wiadomości!");
				}
				else{
					$.ajax({
						url: 'additionalPHP/addMessage.php',
						type: 'POST',
						data: {profile: profile, message: message},
						success: function(msg){
							$('.MyTextWindow').append(msg);
						}
					});
				}
			});
			$('#personaldata').click(function(){
				$('#main-content').load("additionalPHP/personalinfo.php",{profile: profile},function(){
					$('#photo, .MyOverlay').click(function(){
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
										alert("Tylko plik typu .jpg!");
									}else if(errors["1"]=="1"){;
										alert("Wystąpił błąd podczas ładowania pliku!");
									}else if(errors["2"]=="1"){
										alert("Za duży plik!!");
									}else{
										d = new Date();
										$('#photo, #img-profilep').attr('src','img/avatar/'+profile+'.jpg?'+d.getTime());
										alert("Udało się załadować nowe zdjęcie!");
										document.getElementById('pavatarform').reset();
									}
								}
							 });
						}else{
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
	
	$('#yoursite').click(function(){
		var profile = $(this).attr('val');
		$('#main-content').load("additionalPHP/profilesite.php",function(){
			$('#personaldata').click(function(){
				$('#main-content').load("additionalPHP/personalinfo.php",function(){
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
										alert("Tylko plik typu .jpg!");
									}else if(errors["1"]=="1"){
										alert("Wystąpił błąd podczas ładowania pliku!");
									}else if(errors["2"]=="1"){
										alert("Za duży plik!!");
									}else{
										d = new Date();
										$('#photo, #img-profilep').attr('src','img/avatar/'+profile+'.jpg?'+d.getTime());
										alert("Udało się załadować nowe zdjęcie!");
										document.getElementById('pavatarform').reset();
									}
								}
							 });
						}else{
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
						$('#error').load("additionalPHP/pdataedition.php",{name: name, surname: surname, email: email, phone: phone, what: what});
					});
				});
			});
		});
	});
	
	$('#settings').click(function(){
		var profile = $('#yoursite').attr('val');
		$('#main-content').load("additionalPHP/personalinfo.php",function(){
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
								alert("Tylko plik typu .jpg!");
							}else if(errors["1"]=="1"){
								alert("Wystąpił błąd podczas ładowania pliku!");
							}else if(errors["2"]=="1"){
								alert("Za duży plik!!");
							}else{
								d = new Date();
								$('#photo, #img-profilep').attr('src','img/avatar/'+profile+'.jpg?'+d.getTime());
								alert("Udało się załadować nowe zdjęcie!");
								document.getElementById('pavatarform').reset();
							}
						}
					 });
				}else{
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
				$('#error').load("additionalPHP/pdataedition.php",{name: name, surname: surname, email: email, phone: phone, what: what});
			});
		});
	});
	
	$('#project').click(function(){
		window.location.href='project-2.php';
	});
	
	$('#calendar2').click(function(){
		window.location.href='calendar.php';
	});
});