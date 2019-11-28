<?php
	include 'connect.php';
	if($_POST['what']=="passwordnew"){
		if($_POST['Password']==""||$_POST['RPassword']==""){			
			$errorpswd = 1;
			echo "Uzupełnij wszystkie pola!!!";
		}
		else{
			$errorpswd = 0;
			$patternp = "/(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/";
			$patternpm = "/(?=^.{6,}$)(^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$)/";
			$passwordv = preg_match_all($patternp,$_POST['Password']);
			$rpasswordv = preg_match_all($patternp,$_POST['RPassword']);
			$passwordvm = preg_match_all($patternpm,$_POST['Password']);
			$rpasswordvm = preg_match_all($patternpm,$_POST['RPassword']);
		}
	}
	else if($_POST['what']=="pdata"){
		
	}
	else if($_POST['what']=="pphoto"){
		
	}
?>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript">
		
	var what = "<?php echo $_POST['what'];?>";
	if(what=="passwordnew"){
		var pswt = "<?php echo $passwordv; ?>"; 
		var rpswt = "<?php echo $rpasswordv	; ?>";
		var pswmt = "<?php echo $passwordvm; ?>"; 
		var rpswmt = "<?php echo $rpasswordvm; ?>"; 
		$('#Password, #RPassword').removeClass('border-danger border-warning');
		if("<?php echo $errorpswd;?>"==1){
			$('#Password, #RPassword').addClass('border-danger');
		}
		if(pswt == 0 && pswmt == 0){
		$('#Password').addClass("border-danger");
		}
		else if (pswt == 0 && pswmt == 1){
			$('#Password').addClass("border-warning");
		}
		if("<?php if($_POST['Password']!=$_POST['RPassword']){echo 1;}else{echo 0;}?>"==1){
			$('#RPassword').addClass("border-danger");
		}
		else if(rpswt == 0 && rpswmt == 1){
			$('#RPassword').addClass("border-warning");
		}
		else if(rpswt == 0 && rpswmt == 0){
			$('#RPassword').addClass("border-danger");
		}
		var start = "<?php if($_POST['Password']==$_POST['RPassword']&&($passwordv||$passwordvm)){
			try {
			$password = sha1($_POST['Password']);
			$stmt = $pdo -> prepare('UPDATE user SET user_password = :password WHERE user_id = :id');
			$stmt -> execute([
			':password'=>$password,
			':id'=>$_POST['profile'],
			]);
			echo $password." ".$_POST['profile'];
			}
			catch(Exception $e){
				echo 0;
			}
		}?>"
		alert(start);
	}
</script>