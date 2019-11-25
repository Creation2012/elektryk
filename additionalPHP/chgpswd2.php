<?php
	include "connect.php";
	$hash = $_POST['hash'];
	$pswd = $_POST['password'];
	$email = $_POST['email'];
	$stmt -> prepare('UPDATE user SET user_password = :password , user_hash = null WHERE user_email = :email AND user_hash = :hash ;');
	$stmt -> bindParam(':password',$pswd, PDO::PARAM_STR);
	$stmt -> bindParam(':email',$email, PDO::PARAM_STR); 
	$stmt -> bindParam(':hash',$hash, PDO::PARAM_STR); 
	$stmt -> execute([
        'password'=>$pswd,
        'email'=>$email,
        'hash'=>$hash,
        ]);
	$stmt -> closeCursor();
	
?>