<?php
	include ('connect.php');
	session_start();
	$you = $_SESSION['login'];
	$notyou = $_POST['profile'];
	$message = $_POST['message'];
	if(strlen($message)>0 AND strlen($message)<256){
	$stmt = $pdo -> prepare('INSERT INTO chat (id_nadawca,id_odbiorca,message) VALUES (:you,:notyou,:message);');
	$stmt -> execute([
	':you' => $you,
	':notyou' => $notyou,
	':message' => $message,
	]);
	echo '
		<div class="MySender">
			<div class="MySenderBlock">
				'.$message.'
			</div>
		</div>';
	}
	
?>