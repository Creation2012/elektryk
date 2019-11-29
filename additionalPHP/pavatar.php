<?php
	include 'connect.php';
	define('MB', 1048576);
	
	$errorNull = 0;
	$errorExt = 0;
	$errorError = 0;
	$errorSize = 0;
	
	if($_FILES['file']['name']!=""){
		$file = $_FILES['file'];
		
		$fileName = $file['name'];
		$fileTmpName = $file['tmp_name'];
		$fileError = $file['error'];
		$fileSize = $file['size'];
		
		$fileExt = explode('.',$fileName);
		$fileAExt = strtolower(end($fileExt));
		$allowed = array('jpg','jpeg','png','pdf');
		
		if(in_array($fileAExt,$allowed)){
			if($fileError === 0){
				if($fileSize < 5*MB){
					$fileNameNew = uniqid('',true).".".$fileAExt;
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
	}
	else{
		$errorNull = 1;
	}
?>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript">
	
</script>