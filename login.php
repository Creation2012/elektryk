<?php
	include 'connect.php';
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = sha1($password);
	$stmt = $pdo->query('SELECT user_id, user_email, user_password FROM user WHERE user_email = "'.$email.'", user_password = "'.$password.'", user_verifyEmail = 1');
	if($stmt->rowCount()==1){
		foreach($stmt as $row){
			$id = $row['user_id'];
		}
		session_start();
		$_SESSION['login']=$id;
		header("Location: https://quartak.000webhostapp.com/index.php");
	}
	else{
		header("Location: login.html?error=1");
	}
?>