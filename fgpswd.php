<!DOCTYPE html> 
<html> 
<?php
	$email = $_POST['email'];
	$pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
	if(empty($email)){
		$error = 1;
	}
	else if(preg_match_all($pattern, $email)==0){
		$error = 1;
	}
	else{
		include ('connect.php');
		$stmt = $pdo -> prepare("SELECT user_email FROM user WHERE user_email = :email AND user_verifyEmail = 1;");
		$stmt -> bindParam(':email',$email, PDO::PARAM_STR);
		$stmt -> execute();
		$var = $stmt-> rowCount();
		$stmt -> closeCursor();
		if($var != 1){
			echo "Nie mogliśmy znaleźć podanego przez ciebie adresu e-mail";
		}
		else{
			//declaring new hash
			$stmt = $pdo -> prepare("UPDATE user SET user_hash= :rand WHERE user_email = :email;");
			$rand = sha1(mt_rand());
			$stmt -> bindParam(':rand',$rand, PDO::PARAM_STR);
			$stmt -> bindParam(':email',$email, PDO::PARAM_STR); 
			$to      = $email; // Send email to our user
			$subject = 'Forgot Password | E-mail'; // Give the email a subject 
			$message = '
			 
			Zostało nam zgłoszone, że zapomniałeś swoje hasło!
			Jeżeli to nie ty wysłałeś zgłoszenie, zignoruj ten e-mail.
			 
			Jeżeli jednak to ty zapomniałeś swoje hasło
			proszę kliknij na ten link aby przejść do panelu zmiany hasła:
			http://www.quartak.000webhostapp.com/forgotpassword.php?email='.$email.'&hash='.$rand.'
			 
			'; // Our message above including the link
								 
			$headers = 'From:noreply@quartack.com' . "\r\n"; // Set from headers
			mail($to, $subject, $message, $headers); // Send our email
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
		var error = "<?php echo $error ?>";
		if(error==1){
			$('#Email').addClass('border-danger');
		}
</script>
</html>
