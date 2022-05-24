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

	$email_new = filter_var(trim($_POST['mail_new']),
	FILTER_SANITIZE_STRING);

	$login_new = filter_var(trim($_POST['login_new']),
	FILTER_SANITIZE_STRING);	
	
	$res=pg_query($cn,"INSERT INTO operator(fullname, role, email, login,password) VALUES('$name_new', 'user', '$email_new', '$login_new', '$password_new')");


	
	header('Location: New_User.php');
	alert("Success!");
?>