<?php
	include 'connect.php';
	$patternn = "/^[A-ZĘĄĆŻŹÓŁŃŚ]{1}[a-zęąćżźółńś]{1,}$/";
	$patterne = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
	$patternp = "/^[0-9]{9}$/";
	$namev = 1; $name = 0;
	$surnamev = 1; $surname = 0;
	$emailv = 1; $email = 0;
	$phonev = 1; $phone = 0;
	if($_POST['name']!=""){$namev = preg_match_all($patternn,$_POST['name']);$name=1;}
	if($_POST['surname']!=""){$surnamev = preg_match_all($patternn,$_POST['surname']);$surname=1;}
	if($_POST['email']!=""){$emailv = preg_match_all($patterne,$_POST['email']);$email=1;}
	if($_POST['phone']!=""){$phonev = preg_match_all($patternp,$_POST['phone']);$phone=1;}
?>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript">
	var namet = "<?php echo $namev; ?>";
	var surnamet = "<?php echo $surnamev	; ?>";
	var emailt = "<?php echo $emailv; ?>";
	var phonet = "<?php echo $phonev; ?>";
	$('#Name, #Surname, #Email, #Phone').removeClass('border-danger');
	if(namet == 0){
		$('#Name').addClass("border-danger");
	}
	if(surnamet == 0){
		$('#Surname').addClass("border-danger");
	}
	if(emailt == 0){
		$('#Email').addClass("border-danger");
	}
	if(phonet == 0){
		$('#Phone').addClass("border-danger");
	}
	var start = "";
	start = "<?php
		if(($namev&&$surnamev&&$emailv&&$phonev)&&($name||$surname||$email||$phone)){
		try {
		session_start();
		$id = $_SESSION['login'];
		if($namev&&$name){$stmt = $pdo -> prepare('UPDATE user SET user_firstname = :name WHERE user_id = :id;');$stmt -> execute([':name'=>$_POST['name'],':id'=>$id,]);}
		if($surnamev&&$surname){$stmt = $pdo -> prepare('UPDATE user SET user_lastname = :surname WHERE user_id = :id;');$stmt -> execute([':surname'=>$_POST['surname'],':id'=>$id,]);}
		if($emailv&&$email){$stmt = $pdo -> prepare('UPDATE user SET user_email = :email WHERE user_id = :id;');$stmt -> execute([':email'=>$_POST['email'],':id'=>$id,]);}
		if($phonev&&$phone){$stmt = $pdo -> prepare('UPDATE user SET user_phone = :phone WHERE user_id = :id;');$stmt -> execute([':phone'=>$_POST['phone'],':id'=>$id,]);}
		echo "Dokonano zmian!!!";
		}
		catch(Exception $e){
			echo 'Wystąpił wyjątek nr '.$e->getCode().', jego komunikat to:'.$e->getMessage();
		}
		}?>";
	if(start!=""){
		document.getElementById("pdataform").reset();
		alert(start);
	}
</script>