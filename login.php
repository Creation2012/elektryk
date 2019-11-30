<?php
	require('connect.php');
	
	
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = sha1($password);
	
	$stmt = $pdo->prepare('SELECT user_id FROM user WHERE user_email = :email AND user_password = :password AND user_verifyEmail = 1;');
	
	$stmt -> execute([
		'email' => $email,
		'password' => $password,
	]);
	session_start();
	session_destroy();
	if($stmt->rowCount()==1){
		
		session_start();
		session_regenerate_id();
		$row = $stmt -> fetch();
			$id = $row['user_id'];

		
		$_SESSION['login']=$id;
		echo "1";
		//header("Location: https://quartak.000webhostapp.com/index.php");
	}
	else{
		//slowing down brutforce attack
		sleep(3);
		echo "0";
	}
?>
