<div class="container-fluid" id="main-content">

	<?php 
	
				echo '<div class="row float-left" style="width: 100%;">
				<div class="col-lg-6 col-sm-12">
					<div class="justify-content-center row mt-md-3 mb-md-3">
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
			
		</div>
		</div>
		</div>
		<div class="col-lg-6">
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-body">
			
		</div>
		</div>
		</div>
	<div class="col-lg-6">
		<div class="col-lg-12 card border-left-primary shadow py-2 MyLabel">
			<div class="card-body">
			
		</div>
		</div>
		</div>
	</div>
	<div class="col-lg-2">
	</div>
	<div class="col-lg-4 col-sm-12">
		<form name="f_modal">
					<div class="form-group">
						<label for="exampleFormControlInput1">Nazwa projektu:</label>
						<input type="text" class="form-control" id="Name" placeholder="Wprowadź nazwę projektu" required>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Kategoria:</label>
						<select class="form-control" id="Category" required>
						<option value=""> Wybierz </option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Wartość:</label>
						<input type="text" class="form-control" id="Income" placeholder="Wprowadź wartość projektu" required>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Start:</label>
						<input type="datetime" class="form-control" id="Start" placeholder="data" required>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Deadline:</label>
						<input type="datetime" class="form-control" id="End" placeholder="data" required>
					</div>
					<input type="button" id="add" class="btn btn-primary mb-2" value="Dodaj">
				</form>
		</div>
	</div>';
	?>
</div>