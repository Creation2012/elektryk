<?php
	require ("connect.php");
	$hash = $_POST['hash'];
	$pswd = sha1($_POST['password']);
	$email = $_POST['email'];
	$stmt -> prepare('UPDATE user SET user_password = :password , user_hash = null WHERE user_email = :email AND user_hash = :hash;');
	$stmt -> execute([
        'password'=>$pswd,
        'email'=>$email,
        'hash'=>$hash,
        ]);
	$stmt -> closeCursor();
	
	header("Location: https://quartak.000webhostapp.com/login.html");
?>