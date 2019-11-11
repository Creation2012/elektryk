<?php
	$mysql_host = 'localhost'; //lub jakiś adres: np sql.nazwa_bazy.nazwa.pl
	$port = '3306'; //domyślnie jest to port 3306
    $username = 'root';
    $password = '';
    $database = 'bazatestowa'; //'produkty'
	$pdo = new PDO('mysql:host=' . $mysql_host . ';dbname=' . $database . ';port=' . $port, $username, $password);		
?>