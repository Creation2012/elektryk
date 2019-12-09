<style>
	
	.none:hover{
		text-decoration: none;
	}
</style>

<div class="container-fluid" id="main-content">
		
	<div class="col-lg-12">

  <div class="card shadow mb-4">
	<div class="card-header py-3">
	<div class="row">
	  <div class="col-11"> <h6 class="m-0 font-weight-bold text-primary">Projekty</h6> </div> 
	  <?php
	  //jesli user to ldier, to moøe dodaÊ projekt
		/*if()
		{
		echo '<div class="col-1 text-right"> 
		<button class="btn alert-primary justify-content-end" id="add_project"> <i class="fas fa-user-plus"></i> </button> 
		</div>';
		}*/
		?>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="text-center margin-auto">
				<h2 class="m-0 font-weight-bold text-primary"> Ostatnio zako≈Ñczone projekty </h2>
				<?php //query z 10 ostatnimi projektami ?>
			</div>
		</div>
		<hr>
		<div class="row">
			<?php
			$stmt = $pdo -> query("SELECT * FROM project INNER JOIN category ON project.category_id = category.category_id ORDER BY project.project_id");
			$stmt2 = $pdo -> prepare("SELECT * FROM project_handler WHERE project_id = :project_id ORDER BY start_time DESC LIMIT 3");
			$stmt22 = $pdo -> prepare("SELECT DISTINCT user_id FROM project_handler WHERE project_id = :project_id;");
			$stmt3 = $pdo -> prepare("SELECT user_id, user_firstname, user_lastname, user_email, user_verifyEmail FROM user WHERE user_id = :user_id");
			$stmt4 = $pdo -> prepare("SELECT task_id, task_name, task_description, task_start, task_end FROM task WHERE task_id = :task_id");
			
			foreach($stmt as $row){
				$date = date_create($row['project_end']);
				$converted_date = date_format($date,"Y/m/d");
				
				$stmt2->execute([
					'project_id' => $row['project_id'],
				]);
				
				$stmt22->execute([
					'project_id' => $row['project_id'],
				]);
				
				echo '<a class="none" href="?id='.$row['project_id'].'"> <div class="btn-grad col-lg-4 col-md-6 col-sm-12 none"> 
				<div class="card-header py-3 justify-content-md-center row ml-md-1 mr-md-1 border-top">
				  <h6 class="m-0 font-weight-bold text-primary">'.$row['project_name'].'</h6>
				</div>
				<div class="card-body">
					<div class="row justify-content-md-center">
						<div class="col-15">
						<div class="justify-content-md-center row mb-md-3">
						<div class="btn alert-'.$row['color_name'].' btn-block pl-lg-1 pl-md-1" style="font-size: 14px; white-space: nowrap; border: 1px solid #C6CECE;">'.$row['category_name'].'
						</div>
						</div>';
						foreach($stmt2 as $row2){
							$stmt4->execute([
								'task_id' => $row2['task_id'],
							]);
							$count = $stmt4 -> rowCount();
							if($count == 0)
							{
								echo '<div>';
								echo '<div class="justify-content-md-center row mb-md-3"> Nie ma zadnych taskow </div>';
								echo '</div>';
							}
							else
							{
							foreach($stmt4 as $row4){
								
								echo '<div>';
								echo '<div class="justify-content-md-center row mb-md-3">'.$row4['task_name'].'</div>';
								echo '</div>';
							}
							}
							
						}
						echo '
						<div class="justify-content-md-center row mb-md-3">
						<div class="col-15">
						';
						foreach($stmt22 as $row22){
							$stmt3->execute([
								'user_id' => $row22['user_id'],
							]);
							
							foreach($stmt3 as $row3){
							$path = "img/avatar/".$row3['user_id'].".jpg";
							echo'
							<img data-toggle="tooltip" title="'.$row3['user_firstname'].' '.$row3['user_lastname'].'" data-placement="bottom" class="border border-grey rounded-circle" src="img/';
							if(file_exists($path)){echo 'avatar/'.$row3['user_id'].'.jpg?='.filemtime($path).'"';}else{echo 'photo.png"';}
							echo ' alt="User" height="75" width="75">
							';
							}
						}
						echo '</div> </div>';
						echo '
							<div class="justify-content-md-center row mb-md-3 mt-md-3 dupa2"><i class="fas fa-calendar-times dupa"></i> Deadline: '.$converted_date.' </div>
							
						</div>
					</div>
				</div></a> 
				</div>';
			}
			
			$stmt -> closeCursor();
			$stmt2 -> closeCursor();
			$stmt22 -> closeCursor();
			$stmt3 -> closeCursor();
			$stmt4 -> closeCursor();
			
			?>
		</div>
	</div>
  </div>
</div>
 </div>
 
