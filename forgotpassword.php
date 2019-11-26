<!DOCTYPE html>
<html lang="pl-PL">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Zmiana hasła</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
					<?php 
					require('connect.php');
					if(isset($_GET['hash'])&&isset($_GET['email'])){
						$stmt = $pdo -> prepare("SELECT user_email, user_hash, user_verifyEmail FROM user WHERE user_email = :email AND user_hash = :hash AND user_verifyEmail = 1 ");
						$stmt -> execute([
						    'email'=>$_GET['email'],
						    'hash'=>$_GET['hash'],
						    ]);
						    
						if($stmt->rowCount()==1){
							echo '
							  <div class="text-center">
								<h1 class="h4 text-gray-900 mb-4">Udało się!</h1>
							  </div>
							  <form class="user" method="POST" action="additionalPHP/chgpswd.php">
								<div class="form-group">
									<p style="text-align: center">Siła hasła</p>
									<div class="progress" id="PB">
										<div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="form-group row">
								  <div class="col-sm-6 mb-3 mb-sm-0">
									<input type="password" class="form-control form-control-user" id="Password" placeholder="Hasło">
								  </div>
								  <div class="col-sm-6">
									<input type="password" class="form-control form-control-user" id="RPassword" placeholder="Powtórz hasło">
								  </div>
								</div>
								<div class="form-group row">
									<i id="vis" class="far fa-eye" style="margin-left: 48%"></i>
								</div>
								<input type="submit" id="reg" class="btn btn-primary btn-user btn-block" value="Zmień hasło">
								<hr>
								<div id="error"></div>
							  </form>';
						}
						else{
							echo '
							  <div class="text-center">
								<h1 class="h4 text-gray-900 mb-4">Aktywacja!</h1>
							  </div>
							  <div>
								Nie istnieje konto z podanym e-mailem!
							  </div>
							  <hr>
							  <div class="text-center">
								A może Cię tu wcale nie powinno być?
							  </div>';
						}
					}
					else{
							echo '
							  <div class="text-center">
								<h1 class="h4 text-gray-900 mb-4">Aktywacja!</h1>
							  </div>
							  <div>
								Nie istnieje konto z podanym e-mailem!
							  </div>
							  <hr>
							  <div class="text-center">
								A może Cię tu wcale nie powinno być?
							  </div>';
					}
					
					$stmt -> closeCursor();
					?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  
  <!-- Custom scripts for all pages-->
  <script src="js/chgpswd.js"></script>

</body>

</html>