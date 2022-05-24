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
<form action="change.php" method="post">
  <div class="container">
    <label>Изменить имя пользователя 
      <input placeholder="Enter name" type="text" name="name_new">
    </label>
    <label>Изменить пароль пользователя 
      <input placeholder="Enter Password" type="password" name="password_new">
    </label>    
    <label>Изменить почту пользователя 
      <input placeholder="Enter Email" type="text" name="Mail_new">
    </label> 
    <button type="submit">Подтвердить изменения</button>
  </form>
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
    $role = $user["role"];
    if ($role=="admin"): ?>
    <form action="New_User.php">
      <button type="submit">Создать нового пользователя</button>
    </form>
</div>
</form>
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