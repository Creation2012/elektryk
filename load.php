<?php
require('connect.php');
$data = array();

$query = 'SELECT project_id,project_name,project_start,project_end FROM project ORDER BY project_id';

$stmt = $pdo->prepare($query);

$stmt -> execute();

$result = $stmt->fetchAll();

foreach($result as $row)
{
	$data[] = array(
		'project_id' => $row['project_id'],
		'project_name' => $row['project_name'],
		'project_start' => $row['project_start'],
		'project_end' => $row['project_end']
	);
}

echo json_encode($data);
?>