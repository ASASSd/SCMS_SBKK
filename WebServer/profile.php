<!DOCTYPE HTML>
<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html: charset=utf-8">
	<link rel ="stylesheet" href="style.css">


</HEAD>
<body>
<?php
if($_COOKIE['user'] == ''):
  header('Location: ERROR_PAGE.php')
?>

<?php else: ?>
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

<h2 class="HeadText">Личный кабинет пользователя <?=$_COOKIE['user']?></h2>
<div class="imgcontainer">
    <img src="PhotoAuth/avatar.webp " alt = "Avatar" class="avatar">
</div>
<div class="HeadText">
  <p>Логин пользователя :

  <?php
    $host='localhost';
    $database = 'sbk';
    $user = 'postgres';
    $password = '12345'; 
    # Создаем соединение с базой PostgreSQL с указанными выше параметрами
    $cn = pg_connect("host=$host port=5432 dbname=$database user=$user password=$password")
        or die("Failed to create connection to database: ". pg_last_error(). "<br/>");
    
    $login=$_COOKIE['user'];
  //выборка данных
    $result = pg_query($cn,"SELECT * FROM operator WHERE login = '$login'");
    $user = pg_fetch_assoc($result);

   print_r($user["login"]);

  ?>
  </p>Имя пользователя : 
  <?php
    print_r($user["fullname"]);
  ?>
  </p>Почта пользователя : 
  <?php
    print_r($user["email"]);
  ?>
  <p>Роль пользователя :
  <?php
    print_r($user["role"]);
  ?>  
  </p>
  <p>Дата регистрации :
  <?php
    print_r($user["reg_date"]);
  ?>  
  </p>
</div>
<?php endif; ?>
</body>
<script language="javascript">
	$(".five li ul").hide();
	$(".five li:has('.submenu')").hover(
  	function(){
  		$(".five li ul").stop().fadeToggle(300);
  	}
);

</script>
</HTML>