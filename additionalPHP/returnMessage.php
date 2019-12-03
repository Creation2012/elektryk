<?php
	include ('connect.php');
	session_start();
	$you = $_SESSION['login'];
	$notyou = $_POST['profile'];
	$date = $_POST['date'];
	$stmt = $pdo -> prepare("SELECT message FROM chat WHERE send_time > cast(".$date." as datetime) AND id_nadawca = :notyou AND id_odbiorca = :you ORDER BY send_time;");
	$stmt -> execute([
	':notyou' => $notyou,
	':you' => $you,
	]);
	foreach($stmt as $row){
		echo '
			<div class="MyReciver">
				<div class="MyReciverBlock">
					'.$row['message'].'
				</div>
			</div>'; 
	}
?>