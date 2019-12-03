<?php
	include ('connect.php');
	session_start();
	$you = $_SESSION['login'];
	$notyou = $_POST['profile'];
	$date = $_POST['date'];
	echo 'SELECT datediff("'.$date.'",send_time) as diff, message FROM chat WHERE diff > 0 AND id_nadawca = '.$notyou.' AND id_odbiorca = '.$you.' ORDER BY diff DESC;';
	$stmt = $pdo -> prepare('SELECT datediff(:date,send_time) as diff, message FROM chat WHERE diff > 0 AND id_nadawca = :notyou AND id_odbiorca = :you ORDER BY diff DESC;');
	$stmt -> execute([
	':date' => $date,
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