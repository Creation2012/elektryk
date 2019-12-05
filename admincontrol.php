<?php
	include 'top.php';
?>
	<!-- Begin Page Content -->
	<div class="container-fluid" id="main-content">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				Użytkownicy bez aktywacji konta
			</div>
			<div class="card-body">
				<table class="table" style="text-align: center;">
					<thead class="thead-light">
						<tr>
							<th scope="col">ID:</th>
							<th scope="col">Typ użytkownika:</th>
							<th scope="col">Adres e-mail:</th>
							<th scope="col">Data założenia:</th>
							<th scope="col">Jak długo nieaktywowany:</th>
							<th scope="col">Usuń:</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$stmt = $pdo -> query('SELECT user_id,type_name,user_email,user_created, datediff(now(),user_created) as okres FROM user INNER JOIN user_type on user_verifyEmail = user_type.id WHERE user_verifyEmail = 0;');
						foreach($stmt as $row){
							echo '
							<tr class="'; if($row['okres']>2){echo "table-danger";}echo'" >
							<td>'.$row['user_id'].'</td>
							<td>'.$row['type_name'].'</td>
							<td>'.$row['user_email'].'</td>
							<td>'.$row['user_created'].'</td>
							<td>'.$row['okres'].'</td> 
							<td>'; if($row['okres']>2){echo '<button type="button" class="btn btn-danger dlspam" value="'.$row['user_id'].'"><i class="fas fa-user-slash"></i></button>';}
							echo '</td>
							</tr>';
						}
						$stmt -> closeCursor();
					?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				Zmień typ użytkownika
			</div>
			<div class="card-body">
				<table class="table" style="text-align: center;">
					<thead class="thead-light">
						<tr>
							<th scope="col">ID:</th>
							<th scope="col">Typ użytkownika:</th>
							<th scope="col">Adres e-mail:</th>
							<th scope="col">Data założenia:</th>
							<th scope="col">Ostatnia modyfikacja:</th
						</tr>
					</thead>
					<tbody>
					<?php
						$stmt = $pdo -> query('SELECT user_id,type_name,user_email,user_created,user_verifyEmail,user_modified FROM user INNER JOIN user_type on user_verifyEmail = user_type.id WHERE NOT user_verifyEmail = 0 ORDER BY user_verifyEmail;');
						foreach($stmt as $row){
							echo '
							<tr>	
							<td>'.$row['user_id'].'</td>
							<td> <button class="btn button-secondary dropdown-toggle editwho" style="width: 100%;"  name="'.$row['user_id'].'" type="button" id="'.$row['user_id'].'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$row['type_name'].'</button>
							<div class="dropdown-menu" aria-labelledby="'.$row['user_id'].'">
								<a class="dropdown-item" value="2" name="Design">Design</a>
								<a class="dropdown-item" value="3" name="Programista">Programista</a>
								<a class="dropdown-item" value="4" name="Tester">Tester</a>
								<a class="dropdown-item" value="6" name="Projektant">Projektant</a>
								<a class="dropdown-item" value="7" name="Lider">Lider</a>
								<a class="dropdown-item" value="5" name="Admin">Admin</a>
							</div>
							</td>
							<td>'.$row['user_email'].'</td>
							<td>'.$row['user_created'].'</td>
							<td>'.$row['user_modified'].'</td> 
							</tr>';
						}
						$stmt -> closeCursor();
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
<?php
	include 'bottom.php';
?>