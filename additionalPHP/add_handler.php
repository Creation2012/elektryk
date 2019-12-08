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
	$stmt3 = $pdo -> query("SELECT user_id, task_name FROM task INNER JOIN project_handler ON task.task_id = project_handler.task_id WHERE project_id = ".$_POST['project']."");
	echo '<div class="card-body">
				';
				foreach($stmt3 as $row3){
					
					$path = "img/avatar/".$row3['user_id'].".jpg";
					echo '<div class="row float-left mt-2 mb-2" style="width: 100%; height: 50px;">
					<div class="col-lg-1">
					<label class="containter-check">
					<input type="checkbox">
					<span class="checkmark"></span>
					</label>
					</div>
					
					<div class="col-lg-8">
					<div class="h5 mb-0 font-weight-bold text-gray-800"> 
					
					'
					.$row3['task_name'].' 
					</div>
					
					</div> ';
					
					echo '<div class="col-lg-3 text-right"> 
					'; 
					if($row3['user_id']!=NULL && $row3['user_id'] != '')
					{
					echo '
					<img class="border border-grey rounded-circle" src="img/';
							if(file_exists($path)){echo 'avatar/'.$row3['user_id'].'.jpg?='.filemtime($path).'"';}else{echo 'photo.png"';}
							echo ' alt="User" height="50" width="50">';	
					}		
					echo ' </div>  ';
					
					echo '</div> ' ; 
				}
				echo '
			</div>';
	
?>