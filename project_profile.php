<div class="container-fluid" id="main-content">

<style>
/* The container */
.containter-check {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.containter-check input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.containter-check:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.containter-check input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.containter-check input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.containter-check .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>



	<?php 
	$stmt = $pdo -> query("SELECT * FROM project INNER JOIN category ON project.category_id = category.category_id WHERE project_id =".$_GET['id']." ORDER BY project.project_id");
	$stmt2 = $pdo -> query("SELECT * FROM project INNER JOIN category ON project.category_id = category.category_id WHERE project_id =".$_GET['id']." ORDER BY project.project_id ");
	$stmt3 = $pdo -> prepare("SELECT user_id, task_name FROM task INNER JOIN project_handler ON task.task_id = project_handler.task_id WHERE project_id = :project_id");
	$stmt5 = $pdo -> prepare("SELECT user_id, task_name FROM task INNER JOIN user ON task.task_id = project_handler.task_id WHERE project_id = :project_id");
	$stmt6 = $pdo -> query("SELECT distinct project_handler.user_id,  user.user_firstname, user.user_lastname FROM project_handler INNER JOIN user ON project_handler.user_id = user.user_id WHERE project_id = ".$_GET['id']."");
	$stmt7 = $pdo -> query("SELECT COUNT(DISTINCT user_id) as ile FROM project_handler  WHERE project_id = ".$_GET['id']." GROUP BY project_id;");
	$stmt8 = $pdo -> query("SELECT COUNT(DISTINCT task_id) as ile, project_id FROM project_handler WHERE project_id = ".$_GET['id']." GROUP BY project_id");
	
	$ile = $stmt7->fetchAll();
	$task_ile = $stmt8->fetchAll();
	
	foreach($stmt as $row){
				$stmt3->execute([
					'project_id' => $row['project_id'],
				]);
				$date = date_create($row['project_end']);
				$converted_date = date_format($date,"Y/m/d");
				
				
				echo '<div class="row float-left" style="width: 100%;">
				<div class="col-lg-12  col-sm-12">
					<div class="bg-gradient-primary text-white text-center" style="font-size: 50px; padding-right: 50px; letter-spacing: 5px;">'.$row['project_name'].'</div>
				</div>
			</div>
			<div class="row float-left" style="width: 100%;">
	<div class="col-lg-8">
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel" id="reload_task">
			<div class="card-body">
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
			</div>
		</div>
		</div>
		<div class="col-lg-4">
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-body">
			<div class="h5 mb-0 font-weight-bold text-gray-800">Dodaj task</div>
			<hr>
			<form id="add_task" name="add_task" action="additionalPHP/add_task.php" method="POST">
					<div class="form-group">
						<label for="exampleFormControlInput1">Nazwa tasku:</label>
						<input type="text" class="form-control" id="Name" placeholder="Wprowadź nazwę projektu" required>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Kategoria:</label>
						<select class="form-control" id="Category" required>
						<option value=""> Wybierz </option>';
						   
							$stmt4 = $pdo->query('SELECT task_category, category_name, category_color FROM task_category');
							foreach($stmt4 as $row4)
							{
								echo '<option value='.$row4['task_category'].'>'. $row4['category_name'] .'</option>';
							}
							
							$stmt->closeCursor();
							
						  
						echo '</select>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Opis:</label>
						<input type="text" class="form-control" id="Desc" placeholder="Wprowadź opis" required>
						</select>
					</div>';
					if(isset($ile[0]['ile'])){
						if($ile[0]['ile']>0){
						echo '<div class="form-group">
						<label for="exampleFormControlInput1">Pracownik:</label>
						<select class="form-control" id="Pracownik" required>
						<option value=""> Wybierz </option>';
						   
							$stmt4 = $pdo->query('SELECT DISTINCT user.user_id, user.user_firstname, user.user_lastname FROM user INNER JOIN project_handler ON user.user_id = project_handler.user_id WHERE user_type IN (2,3,4,7) AND project_id = '.$_GET['id'].'');
							foreach($stmt4 as $row4)
							{
								echo '<option value='.$row4['user_id'].'>'. $row4['user_firstname'] .' '.$row4['user_lastname'].'</option>';
							}
							
							$stmt->closeCursor();
							
						  
						echo '</select>
						</select>
					</div>';
						}
					}
					echo '<input type="button" id="add" class="btn btn-primary mb-2" value="Dodaj">
			</form>
		</div>
		</div>
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-body">
					<div class="h5 mb-0 font-weight-bold text-gray-800">Szczegóły</div>
					<hr>
				
					<div class="row justify-content-center">
						
						<div class="justify-content-center row">
						<div class="btn alert-'.$row['color_name'].' btn-block">'.$row['category_name'].'
						</div>
						</div>						
					</div>
					</div>
					<div class="card-body">
					<div class="row justify-content-center">
					<div class="col-lg-4">
						<i class="fas fa-tasks m-2"></i>';
						$stmt9 = $pdo -> query('SELECT COUNT(completed) as ile FROM project_handler WHERE project_id = '.$_GET['id'].' AND completed = 1;');
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
						echo '
					</div>
					<div class="col-lg-4">
						<i class="fas fa-calendar-alt m-2"></i>'.$converted_date.'
						
					</div>
					<div class="col-lg-4">
						<i class="fas fa-money-bill m-2"></i>'.$row['project_income'].'
					</div>
					</div>
					</div>
	</div>
	<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-body">
					<div class="h5 mb-0 font-weight-bold text-gray-800">Pracownicy (';
					if(isset($ile[0]['ile'])){
						if($ile[0]['ile']>0){
							echo $ile[0]['ile'];
						}else {echo '0';}
					}else {echo '0';}
					
					echo '/'.$row['max_user'].')</div>
					<hr>
					<div class="row justify-content-center">					
					</div>
					</div>
					<div class="card-body">';
					
						foreach($stmt6 as $row6){
						echo '<div class="row justify-content">';
						$path = "img/avatar/".$row6['user_id'].".jpg";
						echo'
						<img class="border border-grey rounded-circle" src="img/';
						if(file_exists($path)){echo 'avatar/'.$row6['user_id'].'.jpg?='.filemtime($path).'"';}else{echo 'photo.png"';}
						echo ' alt="User" height="75" width="75">
						' ;
						echo $row6['user_firstname'].' '.$row6['user_lastname'].'</div>';
						}
						
					echo '</div>
					</div>
					</div>
		';
	}
	?>
	
	<script src="js/add_task.js"> </script>
</div>