<!DOCTYPE HTML>
<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html: charset=utf-8">
	<link rel ="stylesheet" href="style.css">
   <style type = "text/css">
    .container_server {
      margin: 20px 375px 5px 375px;
      text-align: center;
      background: #E4EFD1;
    -webkit-column-width: 200px;
    -moz-column-width: 200px;
    column-width: 200px;
    -webkit-column-count: 2;
    -moz-column-count: 2;
    column-count: 2;
    -webkit-column-gap: 30px;
    -moz-column-gap: 30px;
    column-gap: 30px;
    -webkit-column-rule: 1px solid #ccc;
    -moz-column-rule: 1px solid #ccc;
    column-rule: 1px solid #ccc;      
    }

</style>

<script>
onload = function () {setTimeout ('location.reload (true)', 60000)}
</script>

</HEAD>
<body>


<?php
$login=$_COOKIE['user'];
$host='localhost';
$database = 'sbk';
$user = 'postgres';
$password = '12345'; 
# Создаем соединение с базой PostgreSQL с указанными выше параметрами
$cn = pg_connect("host=$host port=5432 dbname=$database user=$user password=$password")
    or die("Failed to create connection to database: ". pg_last_error(). "<br/>");
$result = pg_query($cn, "SELECT * FROM operator where login='$login'");
//проверка результата
$user1=pg_fetch_assoc($result);
$role=$user1["role"];

$result_user_id = pg_query($cn, "SELECT id_operator FROM operator WHERE login='$login'");
$user_id=pg_fetch_assoc($result_user_id);
$id=$user_id["id_operator"];

if($_COOKIE['user'] == ''):
  header('Location: ERROR_PAGE.php');
?>
<?php
elseif ($role=="admin"):
  ?>
  <nav class="bar">
  <ul class="topmenu">
    <li><a href="main.php">Сервер</a>
        <ul class="submenu">
          <li><a href="main.php">Список серверов</a></li>
          <li><a href="create_server.php">Создать сервер</a></li>
      </ul>
    </li>
    <li><a href="#">Руководство пользователя<i class="fa fa-angle-down"></i></a>
      <ul class="submenu">
        <li><a href="user.php">Пользователь</a></li>
        <li><a href="">Администратор</a></li>
      </ul>
    </li>
    <li><a href="#">Контакты</a></li>
    <li><a href="#">Пользователь</a>
        <ul class="submenu">
          <li><a href="profile.php">Страница пользователя</a></li>
          <li><a href="setting.php">Настройки</a></li>
          <li><a href="exit.php">Выход</a></li>
      </ul>
    </li>
  </ul>
</nav>


<?php
    $result_admin = pg_query($cn, "SELECT * FROM server");
    while ($server_admin=pg_fetch_assoc($result_admin)){ ?>
      <div class="container_server">
      <a> Сервер № <?php 
      $server_id=$server_admin["id_server"];
      echo $server_id;?></a> 
      <a > Модель сервера: <?php echo $server_admin["model"]?> </a>
      <a> Имя сервера: <?php echo $server_admin["name"];?> </a>
      <a> Инвентарный номер: <?php echo $server_admin["invent_num"];?> </a>
      <a>Описание сервера: <?php echo $server_admin["description"];?> </a>
      <?php    
        $result_data = pg_query($cn, "SELECT * FROM server_state WHERE id_server='$server_id'"); 
        $data_res=pg_fetch_array($result_data);
      ?>
      <a >Статус сервера: <?php echo $data_res["status"] ?></a>
      <a>Наличие дыма: <?php echo $data_res["smoke"] ?></a>
      <a>Температура: <?php echo $data_res["temperature"] ?></a>
      <a>Нагрузка CPU: <?php echo $data_res["cpu_load"] ?></a>   
      <a>Дата телеметрии: <?php echo $data_res["date"] ?></a>
      </div>

<?php
    }
?>

<?php 
else: {
?>

  <nav class="bar">
  <ul class="topmenu">
    <li><a href="main.php">Сервер</a></li>
    <li><a href="#">Руководство пользователя<i class="fa fa-angle-down"></i></a>
      <ul class="submenu">
        <li><a href="user.php">Пользователь</a></li>
        <li><a href="">Администратор</a></li>
      </ul>
    </li>
    <li><a href="#">Контакты</a></li>
    <li><a href="#">Пользователь</a>
        <ul class="submenu">
          <li><a href="profile.php">Страница пользователя</a></li>
          <li><a href="setting.php">Настройки</a></li>
          <li><a href="exit.php">Выход</a></li>
      </ul>
    </li>
  </ul>
</nav>
<?php
    $result_user = pg_query($cn, "SELECT * FROM server WHERE id_operator='$id'");
    while ($server_admin=pg_fetch_assoc($result_user)){ ?>
      <div class="container_server">
      <a> Сервер № <?php 
      $server_id=$server_admin["id_server"];
      echo $server_id;?></a> 
      <a > Модель сервера: <?php echo $server_admin["model"]?> </a>
      <a> Имя сервера: <?php echo $server_admin["name"];?> </a>
      <a> Инвентарный номер: <?php echo $server_admin["invent_num"];?> </a>
      <a>Описание сервера: <?php echo $server_admin["description"];?> </a>
      <?php    
        $result_data = pg_query($cn, "SELECT * FROM server_state WHERE id_server='$server_id'"); 
        $data_res=pg_fetch_array($result_data);
      ?>
      <a >Статус сервера: <?php echo $data_res["status"] ?></a>
      <a>Наличие дыма: <?php echo $data_res["smoke"] ?></a>
      <a>Температура: <?php echo $data_res["temperature"] ?></a>
      <a>Нагрузка CPU: <?php echo $data_res["cpu_load"] ?></a>   
      <a>Дата телеметрии: <?php echo $data_res["date"] ?></a>
      </div>
<?php
    }
?>

<?php
}
?>

<?php endif; ?>


</body>
<script language="javascript">
	$(".five li ul").hide();
	$(".five li:has('.submenu')").hover(
  	function(){
  		$(".five li ul").stop().fadeToggle(300);
  	}
);
setTimeout(function(){

  location.reload();

}, 30000);  

</script>
</HTML>