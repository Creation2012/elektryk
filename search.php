<div class="card shadow mb-4">
	<div class="card-header py-3 font-weight-bold text-primary">
		Użytkownicy zawierający wpisany ciąg znaków
	</div>
	<div class="card-body">
		<table class="table" style="text-align: center;">
			<thead class="thead-light">
				<tr>
					<th scope="col">ID:</th>
					<th scope="col">Typ użytkownika:</th>
					<th scope="col">Adres e-mail:</th>
					<th scope="col">Data założenia:</th>
					<th scope="col">Imię:</th>
					<th scope="col">Nazwisko:</th>
				</tr>
			</thead>
			<tbody>
			<?php
				include 'connect.php';
				$lookfor = $_POST['lookfor'];
				$stmt = $pdo -> prepare('SELECT user_id,type_name,user_email,user_created, user_firstname, user_lastname FROM user INNER JOIN user_type on user_verifyEmail = user_type.id WHERE user_email like :lookfor 
								OR user_firstname like :lookfor OR user_lastname like :lookfor;');
				$stmt -> execute([':lookfor' => '%'.$lookfor.'%']);
				foreach($stmt as $row){
					echo '
					<tr class="users" value="'.$row['user_id'].'">
					<td>'.$row['user_id'].'</td>
					<td>'.$row['type_name'].'</td>
					<td>'.$row['user_email'].'</td>
					<td>'.$row['user_created'].'</td>
					<td>'.$row['user_firstname'].'</td> 
					<td>'.$row['user_lastname'].'</td>
					</tr>';
				}
				$stmt -> closeCursor();
			?>
			</tbody>
		</table>
	</div>
</div>
<div class="card shadow mb-4">
	<div class="card-header py-3 font-weight-bold text-primary">
		Projekty zawierające wpisany ciąg znaków
	</div>
	<div class="card-body">
		<table class="table" style="text-align: center;">
			<thead class="thead-light">
				<tr>
					<th scope="col">ID:</th>
					<th scope="col">Nazwa projektu:</th>
					<th scope="col">Opis projektu:</th>
					<th scope="col">Początek projektu:</th>
					<th scope="col">Koniec projektu:</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$stmt = $pdo -> prepare('SELECT project_id,project_name,project_description,project_start,project_end FROM project WHERE project_name like :lookfor OR project_description like :lookfor;');
				$stmt -> execute([':lookfor' => '%'.$lookfor.'%']);
				foreach($stmt as $row){
					echo '
					<tr class="projects" value="'.$row['project_id'].'">
					<td>'.$row['project_id'].'</td>
					<td>'.$row['project_name'].'</td>
					<td>'.$row['project_description'].'</td>
					<td>'.$row['project_start'].'</td>
					<td>'.$row['project_end'].'</td> 
					</tr>';
				}
				$stmt -> closeCursor();
			?>
			</tbody>
		</table>
	</div>
</div>