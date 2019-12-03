<?php
require('connect.php');
var_dump($_POST);
if(isset($_POST['id']))
{
 $query = "
 UPDATE project 
 SET project_start = :start, project_end = :end 
 WHERE project_id=:id;
 ";
 $stmt = $pdo->prepare($query);
 $stmt->execute(
  array(
		':start' => $_POST['start'],
		':end' => $_POST['end'],
		':id' => $_POST['id'],
 		)
 );
}

?>