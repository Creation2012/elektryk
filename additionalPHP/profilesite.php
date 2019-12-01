<?php
	session_start();
	$you = 0;
	if(isset($_POST['profile'])){
	$id = $_POST['profile'];
		if($_POST['profile']==$_SESSION['login']){
			$you = 1;
		}
	}else{
		$id = $_SESSION['login'];
		$you = 1;
	}
	include "connect.php";
	$stmt = $pdo -> query('SELECT user_firstname, user_lastname, user_email, user_phone FROM user WHERE user_id = '.$id.';');
	$row = $stmt -> fetch();
	$stmt -> closeCursor();
?>
<!-- Profiles Site DIV-->
<div class="row float-left" style="width: 100%;">
	<div class="col-lg-6 col-sm-12">
		<div class="justify-content-center row mt-md-3 mb-md-3">
			<?php 
				$path = "../img/avatar/".$id.".jpg";
				echo '<img class="border border-grey rounded-circle" src="img/';
				if(file_exists($path)){echo 'avatar/'.$id.'.jpg?='.filemtime($path).'"';}else{echo 'photo.png"';}echo ' alt="User" height="100" width="100">';
			?>
		</div>
	</div>
	<div class="col-lg-6  col-sm-12">
		<div class="bg-gradient-primary text-white text-right" style="font-size: 50px; padding-right: 50px; letter-spacing: 5px;">QUARTACK</div>
	</div>
</div>
<div class="row float-left" style="width: 100%;">
	<div class="col-lg-6">
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Imię
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php if($row['user_firstname']!=""){echo $row['user_firstname'];}else{echo "Brak Danych";}?>
						</div>
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Nazwisko:
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php if($row['user_lastname']!=""){echo $row['user_lastname'];}else{echo "Brak Danych";}?>
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
						<?php if($row['user_email']!=""){echo $row['user_email'];}else{echo "Brak Danych";}?>
						</div>
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Numer telefonu:
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php if($row['user_phone']!=""){echo $row['user_phone'];}else{echo "Brak Danych";}?>
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
						//Ta czesc jest do zmiany kiedy dostaniesz nowy skrypt bazy danych
						</div>
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Ostatni projekt:
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
						//Ta czesc jest do zmiany kiedy dostaniesz nowy skrypt bazy danych
						</div>
					</div>
					<div class="col-auto">
					<i class="fas fa-project-diagram"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-2">
	</div>
	<div class="col-lg-4 col-sm-12">
		<div <?php if($you){echo "style='display: none;' ";}?>class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-header py-3 justify-content-md-center row ml-md-1 mr-md-1 border-top">
				  <h6 class="m-0 font-weight-bold text-primary">Czat tekstowy:</h6>
			</div>
			<div class="MyTextWindow">
				<?php
					if(isset($_POST['profile'])){
						if($_POST['profile']!=$_SESSION['login']){
							$stmt = $pdo->query("SELECT message FROM chat WHERE id");
						}
					}
					else{
						echo '
						<div class="MyReciver">
							<div class="MyReciverBlock">
								Sam do siebie pisać nie będziesz chyba co?
							</div>
						</div>'
					}
				?>
			</div>
			<div class="card-footer text-muted">
				<textarea class="form-control" rows="1" maxlength="255" placeholder="Wyślij wiadomość" form="textchat" style="width: 75%; float: left; margin-right: 5%;"></textarea>
				<form id="textchat" style="width: 20%; float: left;">
					<input type="submit" class="btn btn-primary mb-2">
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row justify-content-center" style="width: 100%;">
	<?php
		if(isset($_POST['profile'])){
		$profile = $_POST['profile'];}
		else{$profile=$_SESSION['login'];}
		if($_SESSION['login']==$profile){
			echo ('<div id="personaldata" class="btn btn-primary btn-icon-split MyHand" value="'.$_SESSION['login'].'">
					<span class="icon text-white-50"><i class="fas fa-check"></i></span>
					<span class="text">Edytuj dane swojego konta</span>
				</div>');
		}
	?>
</div>