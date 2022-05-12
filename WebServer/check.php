<?php
//фильтр для полученных значений с полей
	$login = filter_var(trim($_POST['login']),
	FILTER_SANITIZE_STRING);

	$pass = filter_var(trim($_POST['password']),
	FILTER_SANITIZE_STRING);
//шифрование строки
	//$password = md5($password."gsgsdrtg234652");

//поля для подключения к бд
$host='localhost';
$database = 'sbk';
$user = 'postgres';
$password = '12345'; 
# Создаем соединение с базой PostgreSQL с указанными выше параметрами
$cn = pg_connect("host=$host port=5432 dbname=$database user=$user password=$password")
    or die("Failed to create connection to database: ". pg_last_error(). "<br/>");
echo "Successfully created connection to database";
	
//выборка данных
		$result = pg_query($cn, "SELECT * FROM operator where login='$login' and password='$pass'");
//проверка результата
		$user1=pg_fetch_assoc($result);
		if(empty($user1)){
			header('Location: AUTH.php');
		}
//создание куки на 1 день
		setcookie('user', $user1['login'],time()+3600,"/");
		pg_close($connection);
		header('Location: AUTH.php');
?>