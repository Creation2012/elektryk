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
		require('connect.php');
		$stmt = $pdo -> prepare("SELECT user_email FROM user WHERE user_email = :email AND user_verifyEmail = 1");
		$stmt -> execute([
        'email'=>$email,
        ]);
		$var = $stmt-> rowCount();
		$stmt -> closeCursor();
		if($var != 1){
			echo "Nie mogliśmy znaleźć podanego przez ciebie adresu e-mail";
		}
		else{
			//declaring new hash
			$stmt = $pdo -> prepare("UPDATE user SET user_hash= :rand WHERE user_email = :email;");
			$rand = sha1(mt_rand());
			
			try{
			$stmt -> execute([
            'rand'=>$rand,
            'email'=>$email,
            ]);
            
			$to      = $email; // Send email to our user
			$subject = 'Zapomniane Hasło | E-mail'; // Give the email a subject 
			$message = '
			 
			Zostało nam zgłoszone, że hasło zostało zapomniane!
			Jeżeli to nie ty wysłałeś zgłoszenie, zignoruj ten e-mail.
			 
			Jeżeli jednak to ty jesteś autorem żądania
			proszę kliknij na ten link aby przejść do panelu zmiany hasła:
			http://quartak.000webhostapp.com/forgotpassword.php?email='.$email.'&hash='.$rand.'
			 
			'; // Our message above including the link
								 
			$headers = 'From:noreply@quartack.com' . "\r\n"; // Set from headers
			mail($to, $subject, $message, $headers); // Send our email
			}
			catch(Exception $e){
			    echo 'Błąd: '.$e->getMessage();
			}
	    	$stmt -> closeCursor();
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
		
		$("body").load("conf2.html");
</script>
</html>
