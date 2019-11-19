<!DOCTYPE html> 
<html> 
<?php
	$error = 0;
	$name = $_POST['name'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$rpassword = $_POST['rpassword'];
	$patternn = "/^[A-ZĘĄĆŻŹÓŁŃŚ]{1}[a-zęąćżźółńś]{1,}$/";
	$patterne = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
	$patternp = "/(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/";
	$patternpm = "/(?=^.{6,}$)(^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$)/";
	if(empty($name)||empty($lname)||empty($email)||empty($password)||empty($rpassword)){
		echo "Uzupełnij wszystkie pola!";
	}
	else{
		$namev = preg_match_all($patternn, $name);
		$lnamev = preg_match_all($patternn, $lname);
		$emailv = preg_match_all($patterne, $email);
		$passwordv = preg_match_all($patternp,$password);
		$rpasswordv = preg_match_all($patternp,$rpassword);
		$passwordvm = preg_match_all($patternpm,$password);
		$rpasswordvm = preg_match_all($patternpm,$rpassword);
		include ('connect.php');
		$stmt = $pdo -> prepare('SELECT user_email FROM user WHERE user_email = :email;');
		$stmt -> bindParam(':email',$email, PDO::PARAM_STR);
		if($stmt -> rowCount() != 0){
			$error = 1;
			echo "Ten email został już wykorzystany";
		}
	}
	
?>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript">
	// validation
	var namet = "<?php echo $namev; ?>";
	var lnamet = "<?php echo $lnamev; ?>"; 
	var emailt = "<?php echo $emailv; ?>"; 
	// strong password
	var pswt = "<?php echo $passwordv; ?>"; 
	var rpswt = "<?php echo $rpasswordv	; ?>";
	// medium strong password
	var pswmt = "<?php echo $passwordvm; ?>"; 
	var rpswmt = "<?php echo $rpasswordvm; ?>"; 	
	//remove notused classes
	$("#Name, #LName, #Email, #Password, #RPassword").removeClass("border-danger border-warning");
	//tests
	if(namet == 0){
		$('#Name').addClass("border-danger");
	}
	if(lnamet == 0){
		$('#LName').addClass("border-danger");
	}
	if(emailt == 0){
		$('#Email').addClass("border-danger");
	}
	if(pswt == 0 && pswmt == 0){
		$('#Password').addClass("border-danger");
	}
	else if (pswt == 0 && pswmt == 1){
		$('#Password').addClass("border-warning");
	}
	if("<?php if($password!=$rpassword){echo '1';}else{echo '0';}?>"==1){
		$('#RPassword').addClass("border-danger");
	}
	else if(rpswt == 0 && rpswmt == 1){
		$('#RPassword').addClass("border-warning");
	}
	else if(rpswt == 0 && rpswmt == 0){
		$('#RPassword').addClass("border-danger");
	}
	if("<?php if(!empty($name)&&!empty($lname)&&!empty($email)&&$error!=1&&!empty($password)&&!empty($rpassword)&&$namev&&$lnamev&&$emailv&&($passwordv||$passwordvm)&&($rpasswordv||$rpasswordvm)&&$password==$rpassword){echo "1";}else{echo "0";}?>"==1){
		//Variables for ajax
		var name = "<?php echo $name; ?>";
		var lname = "<?php echo $lname; ?>"; 
		var email = "<?php echo $email; ?>"; 
		var password = "<?php echo $password; ?>"; 
		$.ajax({		
				method: 'POST',  
				url: 'additionalPHP/new.php', 
				data: { 
					name: name,
					lname: lname,
					email: email,
					password: password,
				},
				success: function(msg){
				console.log("Działa!");
				$("body").load('conf.html');
				}
		});
	}
</script>
</html>