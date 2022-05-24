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
	$name_new = filter_var(trim($_POST['name_op_new']),
	FILTER_SANITIZE_STRING);

	$inv_new = filter_var(trim($_POST['inv_new']),
	FILTER_SANITIZE_STRING);

	$name_serv_new = filter_var(trim($_POST['name_new']),
	FILTER_SANITIZE_STRING);

	$model_new = filter_var(trim($_POST['model_new']),
	FILTER_SANITIZE_STRING);

	$desc_new = filter_var(trim($_POST['desc_new']),
	FILTER_SANITIZE_STRING);			
	
	$res=pg_query($cn,"INSERT INTO server(id_operator, invent_num, name, description,model) VALUES('$name_new', '$inv_new', '$name_serv_new', '$model_new', '$desc_new')");


	
	header('Location: create_server.php');
	alert("Success!");
?>