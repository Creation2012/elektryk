<?php
	include 'connect.php';
	$_POST['who'];
	$_POST['type'];
	$stmt = $pdo -> prepare('UPDATE user SET user_verifyEmail = :type WHERE user_id = :id;');
	$stmt -> execute([':type' => $_POST['type'],':id' => $_POST['who'],]);
	$test = $stmt -> rowCount();
	if($test){
		echo "Zmieniono typ użytkownika!";
	}else{
		echo "Coś poszło nie tak!";
	}
?>