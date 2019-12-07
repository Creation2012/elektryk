<?php
	include 'connect.php';
	$_POST['who'];
	$_POST['type'];
	$stmt = $pdo -> prepare('UPDATE user SET user_verifyEmail = :type WHERE user_id = :id;');
	$stmt -> execute([':type' => $_POST['type'],':id' => $_POST['who'],]);
	$test = $stmt -> rowCount();
	$stmt -> closeCursor();
	if($test){
		echo "Zmieniono typ użytkownika! ;";
		$stmt = $pdo -> prepare('SELECT user_modified FROM user WHERE user_id = :id;');
		$stmt -> execute([':id' => $_POST['who'],]);
		$row = $stmt -> fetch();
		echo $row['user_modified'];
	}else{
		echo "Coś poszło nie tak!";
	}
?>