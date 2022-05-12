<?php
$host='localhost';
$database = 'sbk';
$user = 'comrade';
$password = '12345';
echo "ds"; 
# Создаем соединение с базой PostgreSQL с указанными выше параметрами
$connection = pg_connect("host=$host port=5432 dbname=$database user=$user password=$password") 
    or die("Failed to create connection to database: ". pg_last_error(). "<br/>");
echo "Successfully created connection to database";
?>