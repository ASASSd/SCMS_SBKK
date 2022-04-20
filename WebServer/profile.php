<!DOCTYPE HTML>
<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html: charset=utf-8">
	<link rel ="stylesheet" href="style.css">


</HEAD>
<body>

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
  //поля для подключения к бд
    $mysql = new mysqli('localhost','root','Korotkov@10','base');

  //проверка на подключение
    if (!$mysql) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $login=$_COOKIE['user'];
  //выборка данных
    $result = $mysql->query("SELECT * FROM `operator` WHERE `login` = '$login'");
      $user = $result->fetch_assoc();

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