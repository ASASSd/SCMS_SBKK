 <?php
        $host='localhost';
        $database = 'sbk';
        $user = 'postgres';
        $password = '12345'; 
        # Создаем соединение с базой PostgreSQL с указанными выше параметрами
        $cn = pg_connect("host=$host port=5432 dbname=$database user=$user password=$password")
            or die("Failed to create connection to database: ". pg_last_error(). "<br/>");
          //фильтр для полученных значений с полей  
            $test=$_POST["server"];
        	$result_state = pg_query($cn, "INSERT INTO server_commands(id_server, command) VALUES ($test, '1') "); 
        header('Location: main.php');
     ?> 