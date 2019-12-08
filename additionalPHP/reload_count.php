<?php
require('connect.php');
echo '<i class="fas fa-tasks m-2" id="reload_count"></i>';
$stmt9 = $pdo -> query('SELECT COUNT(completed) as ile FROM project_handler WHERE project_id = '.$_POST['project'].' AND completed = 1;');
$stmt8 = $pdo -> query("SELECT COUNT(DISTINCT task_id) as ile, project_id FROM project_handler WHERE project_id = ".$_POST['project']." GROUP BY project_id");
$task_ile = $stmt8->fetchAll();
foreach($stmt9 as $row9){
	echo $row9['ile'];
}
echo '/';
if(isset($task_ile[0]['ile'])){
if($task_ile[0]['ile']>0){
	echo $task_ile[0]['ile'];
}
else {echo '0';}
} 
else {echo '0';}	
						
?>