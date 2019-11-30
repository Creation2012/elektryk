<?php
require('connect.php');
$data = array();

$query = 'SELECT project_id,category_id,project_income,project_name,project_start,project_end FROM project ORDER BY project_id';

$stmt = $pdo->prepare($query);

$stmt -> execute();

$result = $stmt->fetchAll();

foreach($result as $row)
{
	$data[] = array(
		'id' => $row['project_id'],
		'title' => $row['project_name'],
		'start' => $row['project_start'],
		'end' => $row['project_end'],
		'income' => $row['project_income'],
		'category' => $row['category_id']
	);
}

echo json_encode($data);
?>