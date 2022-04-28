<?php
	$mysql = new mysqli('localhost','root','Korotkov@10','base');
	  //проверка на подключение
    if (!$mysql) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //фильтр для полученных значений с полей
	$name_new = filter_var(trim($_POST['name_new']),
	FILTER_SANITIZE_STRING);

	$password_new = filter_var(trim($_POST['password_new']),
	FILTER_SANITIZE_STRING);

	$email_new = filter_var(trim($_POST['Mail_new']),
	FILTER_SANITIZE_STRING);
	$login=$_COOKIE["user"];

	if($name_new!=""){
		$mysql->query("UPDATE `operator` SET `fullname`='$name_new' WHERE `login`='$login'");
		echo "1";
	}
	if($password_new!=""){
		$mysql->query("UPDATE `operator` SET `password`='$password_new' WHERE `login`='$login'");
		echo "2";
	}
	if($email_new!=""){
		$mysql->query("UPDATE `operator` SET `email`='$email_new' WHERE `login`='$login'");
		echo "3";
	}
	
	header('Location: setting.php');
?>