<?php
	include 'connect.php';
	if(is_uploaded_file($_FILES['avatar']['tmp_name'])){
		move_uploaded_file($_FILES['avatar']['tmp_name'],'./img/'.$_FILES['avatar']['name']);
	}
	else{
		echo "Wybierz plik!";
	}
?>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript">
	
	var avatar = '<?php echo "./img/".$_FILES["avatar"]["name"];?>';
	switch(avatar.substring(avatar.lastIndexOf('.') + 1).toLowerCase()){
	case 'jpg': case 'png':
		alert("xd");
		break;
	default:
		$(this).val('');
		alert("Wybierz zdjęcie z rozszerzeniem .jpg lub .png");
		break;
	}
</script>