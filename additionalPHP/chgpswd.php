<!DOCTYPE html> 
<html> 
<?php
	$hash = $_POST['hash'];
	$email = $_POST['hash'];
	$password = $_POST['password'];
	$rpassword = $_POST['rpassword'];
	$patternp = "/(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/";
	$patternpm = "/(?=^.{6,}$)(^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$)/";
	if(empty($password)||empty($rpassword)){
		echo "Uzupełnij wszystkie pola!";
	}
	else{
		$passwordv = preg_match_all($patternp,$password);
		$rpasswordv = preg_match_all($patternp,$rpassword);
		$passwordvm = preg_match_all($patternpm,$password);
		$rpasswordvm = preg_match_all($patternpm,$rpassword);
	}
?>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript">
	// validation 
	// strong password
	var pswt = "<?php echo $passwordv; ?>"; 
	var rpswt = "<?php echo $rpasswordv	; ?>";
	// medium strong password
	var pswmt = "<?php echo $passwordvm; ?>"; 
	var rpswmt = "<?php echo $rpasswordvm; ?>"; 	
	//remove notused classes
	$("#Password, #RPassword").removeClass("border-danger border-warning");
	//tests
	if(pswt == 0 && pswmt == 0){
		$('#Password').addClass("border-danger");
	}
	else if (pswt == 0 && pswmt == 1){
		$('#Password').addClass("border-warning");
	}
	if("<?php if($password!=$rpassword){echo 1;}else{echo 0;}?>"==1){
		$('#RPassword').addClass("border-danger");
	}
	else if(rpswt == 0 && rpswmt == 1){
		$('#RPassword').addClass("border-warning");
	}
	else if(rpswt == 0 && rpswmt == 0){
		$('#RPassword').addClass("border-danger");
	}
	if("<?php if(!empty($password)&&!empty($rpassword)&&($passwordv||$passwordvm)&&($rpasswordv||$rpasswordvm)&&$password==$rpassword){echo "1";}else{echo "0";}?>"==1){
		//Variables for ajax
		var password = "<?php echo $password; ?>";
		var hash = "<?php echo $hash; ?>";
		var email = "<?php echo $email; ?>";
		$.ajax({				
				method: 'POST',  
				url: 'additionalPHP/chgpswd2.php', 
				data: { 
					password: password,
					hash: hash
				},
				success: function(msg){
				$("body").load('login.html');
				}
		});
	}
</script>
</html>