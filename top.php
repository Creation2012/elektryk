<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>QUARTACK</title>
<?php 
	session_start();

	if(isset($_SESSION['login'])){
		require('connect.php');
		$stmt = $pdo -> query('SELECT user_firstname, user_lastname FROM user WHERE user_id = '.$_SESSION["login"].';');
		$row = $stmt -> fetch();
	}
	else{
		header("Location: https://quartak.000webhostapp.com/login.html");
	}
	
?>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Quartack</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Panel administracyjny</span></a>
      </li>

	  <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
	  
     <!-- Heading -->
      <div class="sidebar-heading">
        Użytkownicy
      </div>
	        <!-- Nav Item - Profiles -->
      <li class="nav-item">
        <a class="nav-link MyHand" href="index.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Profile użytkowników</span></a>
      </li>
	  
	<?php
	if($_SESSION['type']==5){
		echo '<li class="nav-item">
        <a class="nav-link MyHand" href="admincontrol.php">
          	<i class="fas fa-users-cog"></i>
          <span>Edycja użytkowników</span></a>
      </li>';
	}
	?>
	  
	  <!-- Heading -->
      <div class="sidebar-heading">
        Projekty
      </div>
	        <!-- Nav Item - Project -->
      <li class="nav-item">
        <a class="nav-link MyHand" id="project">
          <i class="fas fa-tasks"></i>
          <span>Lista projektów</span></a>
      </li>
	  
	  <!-- Heading -->
      <div class="sidebar-heading">
        Dodatki
      </div>
	  
	        <!-- Nav Item - calendar -->
      <li class="nav-item">
        <a class="nav-link MyHand" id="calendar2">
          <i class="fas fa-calendar-alt"></i>
          <span>Kalendarz</span></a>
      </li>
	  
	  
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small searchInput" placeholder="Szukaj..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary searchClick" id="submit1" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Szukaj..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary searchClick" type="button" id="submit2">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="profileUserDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php if($row['user_firstname']==""&&$row['user_lastname']==""){echo "To ja :P";}else{echo $row['user_firstname']." ".$row['user_lastname']; }?></span>
                <img class="img-profile rounded-circle" id="img-profilep" src=
					<?php
						$path = "img/avatar/".$_SESSION['login'].".jpg";
						if(file_exists($path)){echo '"img/avatar/'.$_SESSION['login'].'.jpg?='.filemtime($path).'"';}else{echo '"img/photo.png"';}
					?>
					>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="profileUserDropdown">
                <a class="dropdown-item MyHand" id="yoursite" val="<?php echo $_SESSION['login'];?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <a class="dropdown-item MyHand" id="settings">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Ustawienia
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item MyHand" id="logoutjs">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Wyloguj się
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->