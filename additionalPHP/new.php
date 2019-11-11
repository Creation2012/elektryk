<?php
	$name = $_POST['name'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$hash = sha1($email);
	$password = sha1($password);
	include('connect.php');
	$pdo -> exec("INSERT INTO user (user_firstname, user_lastname, user_email, user_password, user_hash) values 
	('".$name."','".$lname."','".$email."','".$password."','".$hash."');");
	
	$to      = $email; // Send email to our user
	$subject = 'Signup | Verification'; // Give the email a subject 
	$message = '
	 
	Thanks for signing up!
	Your account has been created, you can login after you have activated your account by pressing the url below.
	 
	Please click this link to activate your account:
	http://www.quartak.000webhostapp.com/verify.php?email='.$email.'&hash='.$hash.'
	 
	'; // Our message above including the link
						 
	$headers = 'From:noreply@quartak.com' . "\r\n"; // Set from headers
	mail($to, $subject, $message, $headers); // Send our email
?>