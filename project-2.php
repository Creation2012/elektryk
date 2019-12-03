<?php
	include 'top.php';
?>

<style type="text/css">
	.dupa{
		margin: 3px;
	}
	.left{
		
	}
	.right{
		float: left;
	}
	.dupa2{
		clear: both;
	}
	a{
		text-decoration: none;
	}
  </style>

<!-- Begin Page Content -->
	
	<?php 
		if(isset($_GET['id']) || isset($_GET['id'])!=NULL ){
			include 'project_profile.php';
		}
		else{
			include 'project_list.php';
		}
	?>
     
<!-- /.container-fluid -->

     
<?php
	include 'bottom.php';
?>