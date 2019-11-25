<?php
	$name = $_POST['name'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$pswd = $_POST['password'];
	$hash = sha1($email);
	$password = sha1($pswd);
	include('connect.php');
	
    $stmt = $pdo -> prepare("INSERT INTO user (user_firstname, user_lastname, user_email, user_password, user_hash) values (:fname,:lname,:email,:password,:hash);");
    
    $stmt -> execute([
        'fname'=>$name,
        'lname'=>$lname,
        'email'=>$email,
        'password'=>$password,
        'hash'=>$hash,
        ]);
	
	$stmt -> closeCursor();
	
    $to      = $email; // Send email to our user
	$subject = 'Rejestracja | Weryfikacja'; // Give the email a subject 
	$message = '
	 
	Dziękujęmy za zarejestrowanie się!
	Twoje konto zostało utworzone, aby się zalogować mmusisz aktywować konto klikając poniższy link.
	 
	Proszę kliknij na link aby aktytować konto:
	http://quartak.000webhostapp.com/verify.php?email='.$email.'&hash='.$hash.'
	 
	'; // Our message above including the link
						 
	$headers = 'From:noreply@quartack.com'; // Set from headers
	mail($to, $subject, $message, $headers); // Send our email

?>