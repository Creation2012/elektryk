<?php
	include 'connect.php';
	$_POST['who'];
	$stmt = $pdo -> prepare('DELETE FROM user WHERE user_id = :id AND user_verifyEmail = 0 AND datediff(now(),user_created) > 2;');
	$stmt -> execute([':id' => $_POST['who']]);
	$test = $stmt -> rowCount();
	if($test){
		echo "Pomyślnie usunięto użytkownika z bazy danych!";
	}else{
		echo "Coś poszło nie tak!";
	}
	
?>