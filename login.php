<?php
	require('connect.php');
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = sha1($password);
	
	$stmt = $pdo->prepare('SELECT user_id, user_verifyEmail FROM user WHERE user_email = :email AND user_password = :password AND NOT user_verifyEmail = 0;');
	
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
			$type = $row['user_verifyEmail'];
		
		$_SESSION['login']=$id;
		$_SESSION['type']=$type;
		if(isset($_POST['cookies'])){
			if($_POST['cookies']=='1'){
				setcookie('email',$email,time()+86400*30);
			}
		}
		echo "1";
	}
	else{
		//slowing down brutforce attack
		sleep(3);
		echo "0";
	}
?>
