<?php
	include ('connect.php');
	session_start();
	$you = $_SESSION['login'];
	$notyou = $_POST['profile'];
	$date = $_POST['date'];
	$stmt = $pdo -> prepare('SELECT datediff(ms,FROM_UNIXTIME(:date/1000),send_time) as diff, message FROM chat WHERE diff > 0 AND id_nadawca = :notyou AND id_odbiorca = :you ORDER BY diff DESC;');
	$stmt -> execute([
	':date' => $date,
	':id_nadawca' => $notyou,
	':id_odbiorca' => $you,
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