<?php
	include "connect.php";
	$_POST['profile'];
?>
<!-- Profiles Site DIV-->
<div class="row">
	<div class="col-lg-6 col-sm-12">
		<div class="justify-content-center row mt-md-3 mb-md-3">
			<img class="border border-grey rounded-circle" src="img/photo.png" alt="User" height="100" width="100">
		</div>
	</div>
	<div class="col-lg-1 col-sm-0">
	</div>
	<div class="col-lg-5  col-sm-12">
		<div class="bg-gradient-primary text-white text-right" style="font-size: 50px; padding-right: 50px; letter-spacing: 5px;">QUARTACK</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Imię:
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
						Jan
						</div>
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Nazwisko:
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
						Kowalski
						</div>
					</div>
					<div class="col-auto">
					<i class="fas fa-user"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 card border-left-danger shadow py-2 MyLabel">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Email:
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
						janeczek@jans.com
						</div>
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Numer telefonu:
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
						124523734
						</div>
					</div>
					<div class="col-auto">
					<i class="fas fa-envelope"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 card border-left-warning shadow py-2 MyLabel">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Etat:
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
						Tester
						</div>
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Ostatni projekt:
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
						produkcja tego pierdolonego gówna
						</div>
					</div>
					<div class="col-auto">
					<i class="fas fa-project-diagram"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-1">
	</div>
	<div class="col-lg-5 col-sm-12">
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-header py-3 justify-content-md-center row ml-md-1 mr-md-1 border-top">
				  <h6 class="m-0 font-weight-bold text-primary">Czat tekstowy:</h6>
			</div>
			<div class="card-body" style="height: 430px;">
				
			</div>
		</div>
	</div>
</div>
<div class="row justify-content-center">
	<div id="personaldata" class="btn btn-primary btn-icon-split" value="<?php echo $_POST['profile'];?>">
		<span class="icon text-white-50"><i class="fas fa-check"></i></span>
		<span class="text">Edytuj dane swojego konta</span>
	</div>
</div>