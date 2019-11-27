<?php
	include "connect.php";
?>
<!-- Profiles DIV-->
<div class="col-lg-12">

  <!-- Custom Text Color Utilities -->
  <div class="card shadow mb-4">
	<div class="card-header py-3">
	  <h6 class="m-0 font-weight-bold text-primary">Profile pracowników firmy Quartack</h6>
	</div>
	<div class="card-body">
		<div class="row">
			<?php
			$stmt = $pdo -> query("SELECT user_id,user_firstname, user_lastname FROM user;");
			foreach($stmt as $row){
				echo '<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="card-header py-3 justify-content-md-center row ml-md-1 mr-md-1 border-top">
				  <h6 class="m-0 font-weight-bold text-primary">'.$row['user_firstname'].' '.$row['user_lastname'].'</h6>
				</div>
				<div class="card-body">
					<div class="row justify-content-md-center">
						<div class="col-6">
							<div class="justify-content-md-center row mt-md-3 mb-md-3"><img class="border border-grey rounded-circle" src="img/photo.png" alt="User" height="100" width="100"></div>
							<div class="justify-content-md-center row mb-md-3"><div class="btn alert-danger btn-block pl-lg-1 pl-md-1" style="font-size: 14px; white-space: nowrap;">Debugowanie</div></div>
							<div class="justify-content-md-center row"><button type="button" value="'.$row['user_id'].'" class="btn btn-primary userprofile btn-block" style="font-size: 14px;">Przejdź do profilu</button></div>
						</div>
					</div>
				</div>
				</div>';
			}
			?>
		</div>
	</div>
  </div>

</div>