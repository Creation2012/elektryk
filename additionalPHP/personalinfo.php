<?php
	include "connect.php";
?>
<!-- Change data form DIV-->
<div class="row">
	<!-- Form for personal data-->
	<div class="col-lg-6">
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-header py-3 justify-content-md-center row ml-md-1 mr-md-1 border-top">
				<h6 class="m-0 font-weight-bold text-primary">Dane osobowe</h6>
			</div>
			<div class="card-body">
				<form class="col-lg-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Imię:</label>
						<input type="text" class="form-control" id="Name" placeholder="Wprowadź swoje imię / Nick">
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Nazwisko:</label>
						<input type="text" class="form-control" id="Surname" placeholder="Wprowadź swoje nazwisko / Nick">
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Adres e-mail:</label>
						<input type="email" class="form-control" id="Email" placeholder="Twój nowy e-mail">
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Numer telefonu:</label>
						<input type="text" class="form-control" id="Phone" placeholder="Wprowadź swój numer telefonu">
					</div>
					<input type="submit" id="pdata" class="btn btn-primary mb-2" value="Zmień dane">
				</form>
			</div>
		</div>
		<!-- Form for passwords-->
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-header py-3 justify-content-md-center row ml-md-1 mr-md-1 border-top">
				<h6 class="m-0 font-weight-bold text-primary">Zmień hasło</h6>
			</div>
			<div class="card-body">
				<form class="col-lg-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Nowe hasło:</label>
						<input type="text" class="form-control" id="Password" placeholder="Hasło">
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Powtórz hasło:</label>
						<input type="text" class="form-control" id="RPassword" placeholder="Powtórz hasło">
					</div>
					<input type="submit" id="passwordnew" class="btn btn-primary mb-2" value="Zmień hasło">
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-1">
	</div>
	<!-- Form to change photo-->
	<div class="col-lg-5">
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-header py-3 justify-content-md-center row ml-md-1 mr-md-1 border-top">
				<h6 class="m-0 font-weight-bold text-primary">Zdjęcie</h6>
			</div>
			<div class="card-body">
				<form class="col-lg-12">
					<div class="col-lg-6" style="margin-left: 41.3%;">
						<div class="row mt-md-3 mb-md-3"><img id="photo" class="border border-grey rounded-circle" src="img/photo.png" alt="User" height="100" width="100"></div>
					</div>
					<input type="file" style="display: none;">
					<div class="row justify-content-md-center">
						<input type="submit" id="pphoto" class="btn btn-primary mb-2" value="Zmień dane">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>