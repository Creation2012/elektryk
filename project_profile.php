<div class="container-fluid" id="main-content">

	<?php 
	
	$stmt = $pdo -> query("SELECT * FROM project INNER JOIN category ON project.category_id = category.category_id WHERE project_id =".$_GET['id']." ORDER BY project.project_id");
	$stmt2 = $pdo -> query("SELECT * FROM project INNER JOIN category ON project.category_id = category.category_id WHERE project_id =".$_GET['id']." ORDER BY project.project_id ");
	$stmt3 = $pdo -> prepare("SELECT user_id, task_name FROM task INNER JOIN project_handler ON task.task_id = project_handler.task_id WHERE project_id = :project_id");
	
	foreach($stmt as $row){
				$stmt3->execute([
					'project_id' => $row['project_id'],
				]);
				
				echo '<div class="row float-left" style="width: 100%;">
				<div class="col-lg-12  col-sm-12">
					<div class="bg-gradient-primary text-white text-center" style="font-size: 50px; padding-right: 50px; letter-spacing: 5px;">'.$row['project_name'].'</div>
				</div>
			</div>
			<div class="row float-left" style="width: 100%;">
	<div class="col-lg-8">
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-body">
				';
				foreach($stmt3 as $row3){
					echo '
					<div class="row float-left" style="width: 100%;">
					<div class="col-lg-8">
					<div class="h5 mb-0 font-weight-bold text-gray-800"> '
					.$row3['task_name'].' 
					</div>
					
					</div>
					<div class="col-lg-4 text-right"> 
					'; echo $row3['user_id']; echo '
					<img class="border border-grey rounded-circle" src="img/';
							if(file_exists($path)){echo 'avatar/'.$row3['user_id'].'.jpg?='.filemtime($path).'"';}else{echo 'photo.png"';}
							echo ' alt="User" height="50" width="50">';	
					echo '
					
					</div>
					</div>' ;
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
			<form name="f_modal1">
					<div class="form-group">
						<label for="exampleFormControlInput1">Nazwa tasku:</label>
						<input type="text" class="form-control" id="Name" placeholder="Wprowadź nazwę projektu" required>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Kategoria:</label>
						<select class="form-control" id="Category" required>
						<option value=""> Wybierz </option>';
						   
							$stmt = $pdo->query('SELECT task_category, category_name, category_color FROM task_category');
							foreach($stmt as $row)
							{
								echo '<option value='.$row['task_category'].'>'. $row['category_name'] .'</option>';
							}
							
							$stmt->closeCursor();
							
						  
						echo '</select>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Opis:</label>
						<input type="text" class="form-control" id="Desc" placeholder="Wprowadź opis" required>
						</select>
					</div>
					<input type="button" id="add" class="btn btn-primary mb-2" value="Dodaj">
			</form>
		</div>
		</div>
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-body">
					<div class="h5 mb-0 font-weight-bold text-gray-800">Szczegóły</div>
		</div>
		</div>
	</div>
	
		';
	}
	?>
</div>