<?php 
require('connect.php');

if(isset($_POST['title']))
{
	$query = "INSERT INTO project(category_id,project_income,project_name,project_start,project_end) VALUES (:category, :income, :title, :start, :end)";
	$stmt = $pdo->prepare($query);
	$stmt -> execute(
		array(
			':title' => $_POST['title'], 
			':start' => $_POST['start'],
			':end' => $_POST['end'],
			':category' => $_POST['category'],
			':income' => $_POST['income']
 		)
	);
}

$stmt->closeCursor();
$pdo = null;

?>