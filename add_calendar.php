<?php 
require('connect.php');

if(isset($_POST['title']))
{
	$query = "INSERT INTO project(category_id,max_user,project_income,project_name,project_start,project_end) VALUES (:category, :max, :income, :title, :start, :end)";
	$stmt = $pdo->prepare($query);
	$stmt -> execute(
		array(
			':title' => $_POST['title'], 
			':start' => $_POST['start'],
			':end' => $_POST['end'],
			':category' => $_POST['category'],
			':income' => $_POST['income'],
			':max' => $_POST['max']
 		)
	);
}

$stmt->closeCursor();
$pdo = null;

?>