<?php
	$mysql_host = 'localhost'; //lub jakiś adres: np sql.nazwa_bazy.nazwa.pl
	$port = '3306'; //domyślnie jest to port 3306
    $username = 'id11549344_admin';
    $passworddb = 'admin';
    $database = 'id11549344_quartack'; //'produkty'
	
	try {
		$pdo = new PDO('mysql:host=' . $mysql_host . ';dbname=' . $database . ';port=' . $port, $username, $passworddb, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
	} catch (PDOException $e) {
		echo 'Error: '. $e->getMessage();
	}
?>