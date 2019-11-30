<?php
	include 'connect.php';
	define('MB', 1048576);
	
	$errorExt = 0;
	$errorError = 0;
	$errorSize = 0;
	
	$file = $_FILES['file'];
	
	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileError = $file['error'];
	$fileSize = $file['size'];
	
	$fileExt = explode('.',$fileName);
	$fileAExt = strtolower(end($fileExt));
	$allowed = array('jpg','jpeg');
	
	if(in_array($fileAExt,$allowed)){
		if($fileError === 0){
			if($fileSize < 5*MB){
				session_start();
				$fileNameNew = $_SESSION['login'].".jpg";
				$fileDestination = '../img/avatar/'.$fileNameNew;
				move_uploaded_file($fileTmpName,$fileDestination);
			}
			else{
				$errorSize = 1;
			}
		}
		else{
			$errorError = 1;
		}
	}
	else{
		$errorExt = 1;
	}
	$errors = array($errorExt,$errorError,$errorSize);
	echo json_encode($errors);
?>