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
						<input type="text" class="form-control" id="Name" placeholder="Hasło">
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Powtórz hasło:</label>
						<input type="text" class="form-control" id="Surname" placeholder="Powtórz hasło">
					</div>
					<input type="submit" id="password" class="btn btn-primary mb-2" value="Zmień hasło">
				</form>
			</div>
		</div>
	</div>
</div>