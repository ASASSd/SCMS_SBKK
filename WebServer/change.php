<?php
//поля для подключения к бд
	$host='localhost';
	$database = 'sbk';
	$user = 'postgres';
	$password = '12345'; 
	# Создаем соединение с базой PostgreSQL с указанными выше параметрами
	$cn = pg_connect("host=$host port=5432 dbname=$database user=$user password=$password")
	    or die("Failed to create connection to database: ". pg_last_error(). "<br/>");
    //фильтр для полученных значений с полей
	$name_new = filter_var(trim($_POST['name_new']),
	FILTER_SANITIZE_STRING);

	$password_new = filter_var(trim($_POST['password_new']),
	FILTER_SANITIZE_STRING);

	$email_new = filter_var(trim($_POST['Mail_new']),
	FILTER_SANITIZE_STRING);
	$login=$_COOKIE["user"];

	if($name_new!=""){
		pg_query($cn,"UPDATE operator SET fullname='$name_new' WHERE login='$login'");
		echo "1";
	}
	if($password_new!=""){
		pg_query($cn,"UPDATE operator SET password='$password_new' WHERE login='$login'");
		echo "2";
	}
	if($email_new!=""){
		pg_query($cn,"UPDATE operator SET email='$email_new' WHERE login='$login'");
		echo "3";
	}
	
	header('Location: setting.php');
	alert("Success!");
?>