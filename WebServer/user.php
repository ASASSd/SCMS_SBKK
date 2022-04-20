<?php
//поля для подключения к бд
	$mysql = new mysqli('localhost','root','Korotkov@10','base');

//проверка на подключение
	if (!$mysql) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	$login=$_COOKIE['user'];
//выборка данных
	$result = $mysql->query("SELECT * FROM `operator` WHERE `login` = '$login'");
//проверка результата
		$user = $result->fetch_assoc();
		print_r($user);

?>