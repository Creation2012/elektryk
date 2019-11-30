<?php
require('connect.php');
var_dump($_POST);
if(isset($_POST["id"]))
{
 $query = "
 DELETE from project WHERE project_id=:id
 ";
 $stmt = $pdo->prepare($query);
 $stmt->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>