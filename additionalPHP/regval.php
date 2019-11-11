<!DOCTYPE html> 
<html> 
<?php
	$name = $_POST['name'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$rpassword = $_POST['rpassword'];
	$patternn = "/^[A-ZĘĄĆŻŹÓŁŃŚ]{1}[a-zęąćżźółńś]{1,}$/";
	$patterne = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
	$patternp = "/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/";
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
	}
?>
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
	if("<?php if($password!=$rpassword){echo "1";}else{echo "0";}?>"==1){
		$('#RPassword').addClass("border-danger");
	}
	else if(rpswt == 0 && rpswmt == 1){
		$('#RPassword').addClass("border-warning");
	}
	else if(rpswt == 0 && rpswmt == 0){
		$('#RPassword').addClass("border-danger");
	}
</script>
</html>