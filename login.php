<?php
	require('connect.php');
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = sha1($password);
	
	$stmt = $pdo->prepare('SELECT user_id, user_email, user_password FROM user WHERE user_email = :email , user_password = :password, user_verifyEmail = 1;');

	echo "SELECT user_id, user_email, user_password FROM user WHERE user_email = :email , user_password = :password, user_verifyEmail = 1";
	
	$stmt -> execute([
		'email' => $email,
		'password' => $password,
	]);
	
	if($stmt->rowCount()==1){
		
		foreach($stmt as $row){
			$id = $row['user_id'];
		}
		session_start();
		$_SESSION['login']=$id;
		//header("Location: https://quartak.000webhostapp.com/index.php");
	}
	else{
		//header("Location: https://quartak.000webhostapp.com/login.html?error=1");
	}
?>