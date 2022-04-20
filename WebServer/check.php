<?php
//фильтр для полученных значений с полей
	$login = filter_var(trim($_POST['login']),
	FILTER_SANITIZE_STRING);

	$password = filter_var(trim($_POST['password']),
	FILTER_SANITIZE_STRING);
//шифрование строки
	//$password = md5($password."gsgsdrtg234652");

//поля для подключения к бд
	$mysql = new mysqli('localhost','root','Korotkov@10','base');

//проверка на подключение
	if (!$mysql) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	
//выборка данных
	$result = $mysql->query("SELECT * FROM `operator` WHERE `login` = '$login' AND `password`='$password'");
//проверка результата
		$user = $result->fetch_assoc();
		if(empty($user)){
			header('Location: AUTH.php');
		}
		print_r($user);
//создание куки на 1 день
		
		setcookie('user', $user['login'],time()+3600,"/");
		$mysql->close();
		header('Location: AUTH.php');
?>