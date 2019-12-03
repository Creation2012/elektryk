<?php
	include 'top.php';
?>

<style>
	.dupa{
		margin: 3px;
	}
	.left{
		
	}
	.right{
		float: left;
	}
	.dupa2{
		clear: both;
	}
  </style>

  <!-- Begin Page Content -->
        <div class="container-fluid" id="main-content">
		
<div class="col-lg-12">

  <div class="card shadow mb-4">
	<div class="card-header py-3">
	  <h6 class="m-0 font-weight-bold text-primary">Projekty</h6>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="text-center margin-auto">
				<h2 class="m-0 font-weight-bold text-primary"> Ostatnio zakończone projekty </h2>
				<?php //query z 10 ostatnimi projektami ?>
			</div>
		</div>
		<hr>
		<div class="row">
			<?php
			$stmt = $pdo -> query("SELECT * FROM project;");
			$stmt2 = $pdo -> prepare("SELECT * FROM project_handler WHERE project_id = :project_id");
			$stmt3 = $pdo -> prepare("SELECT user_id, user_verifyEmail, user_type, user_firstname, user_lastname, user_email, user_password, user_hash, user_phone, user_created, user_modified FROM user WHERE user_id = :user_id");
			$stmt4 = $pdo -> prepare("SELECT task_id, complete, task_name, task_description, task_start, task_end FROM task WHERE task_id = :task_id");
			
			$stmt5 = $pdo -> prepare("SELECT count(project_id) FROM project_handler");
			
			$project = $stmt5->fetchAll();
			
			foreach($stmt as $row){
				$date = date_create($row['project_end']);
				$converted_date = date_format($date,"Y/m/d");
				$stmt2->execute([
					'project_id' => $row['project_id'],
				]);
				echo '<div class="col-lg-4 col-md-6 col-sm-12"> <a value='.$row['project_id'].'>
				<div class="card-header py-3 justify-content-md-center row ml-md-1 mr-md-1 border-top">
				  <h6 class="m-0 font-weight-bold text-primary">'.$row['project_name'].'</h6>
				</div>
				<div class="card-body">
					<div class="row justify-content-md-center">
						<div class="col-6">'; 
						foreach($stmt2 as $row2){
							$stmt3->execute([
								'user_id' => $row2['user_id'],
							]);
							foreach($stmt3 as $row3){
								echo '<div class="left">';
								echo '<div class="justify-content-md-center row mb-md-3 dupa">'.$row3['user_id']." ".$row3['user_firstname']." ".$row3['user_lastname'].'</div>';
								echo '</div>';
							}
							$stmt4->execute([
								'task_id' => $row2['task_id'],
							]);
							
							foreach($stmt4 as $row4){
								echo '<div class="right">';
								echo '<div class="justify-content-md-center row mb-md-3 dupa2">'.$row4['task_name'].'</div>';
								echo '</div>';
							}
							
						} 
						echo '
							<div class="justify-content-md-center row mb-md-3 dupa2"><i class="fas fa-calendar-times dupa3"></i> Deadline: '.$converted_date.' </div>
							
						</div>
					</div>
				</div> </a>
				</div>';
			}
			?>
		</div>
	</div>
  </div>

</div>


		
        </div>
        <!-- /.container-fluid -->

     
<?php
	include 'bottom.php';
?>