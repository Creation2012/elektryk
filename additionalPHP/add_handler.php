<?php
require('connect.php');
	$query3 = "INSERT INTO project_handler(project_id,user_id,task_id) VALUES(:project,:worker,:task);";
	$stmt3 = $pdo ->prepare($query3);
	if(isset($_POST['worker'])){
		if($_POST['worker'] != '' && $_POST['worker'] != NULL){
			$pracownik = $_POST['worker'];
		}
		else
		{
			$pracownik = NULL;
		}
	}
	else
	{
		$pracownik = NULL;
	}
	$stmt3 -> execute(
		array(
		':project' => $_POST['project'],
		':worker' => $pracownik,
		':task' => $_POST['task']
		)
	);
	
	$stmt3 -> closeCursor();
	
?>