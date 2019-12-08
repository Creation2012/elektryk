<?php 
require('connect.php');
if(isset($_POST['title'])&&isset($_POST['category'])&&isset($_POST['project'])){
	$query = "INSERT INTO task(task_category,task_name,task_description) VALUES (:category, :title, :desc);";
	$stmt = $pdo->prepare($query);
	$stmt -> execute(
		array(
			':category' => $_POST['category'], 
			':title' => $_POST['title'],
			':desc' => $_POST['desc']
 		));
	$stmt2 = $pdo ->query("SELECT task_id as ile FROM task ORDER BY task_id DESC");
	$ile = $stmt2 -> fetchAll();
	
	echo $ile[0]['ile'];
		
	$stmt->closeCursor();
	$stmt2->closeCursor();
}
?>