<!DOCTYPE HTML>
<HTML>
<HEAD>
  <meta http-equiv="Content-Type" content="text/html: charset=utf-8">
  <link rel ="stylesheet" href="style.css">
<style>
      select {
      width: 255px;
      height: 35px;
      padding: 4px;
      border-radius:4px;

      background: white;
      border: 1px;
      outline: none;
      display: inline-block;
      -webkit-appearance:none;
      -moz-appearance: none;
      appearance: none;
      cursor: pointer;
      }
      button{
        margin-top: 10px;
      }
  .container {
    padding: 0 40% 0 40%;
    text-align: center;
  }
    </style>

</HEAD>
<body>

<nav class="bar">
  <ul class="topmenu">
    <li><a href="main.php">Сервер</a></li>
    <li><a href="#">Руководство пользователя<i class="fa fa-angle-down"></i></a>
      <ul class="submenu">
        <li><a href="user.php">Пользователь</a></li>
        <li><a href="admin_doc.html">Администратор</a></li>
      </ul>
    </li>
    <li><a href="contact.html">Контакты</a></li>
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
            if($_COOKIE['user'] != '' && $role=="admin"):
?>
<h2 class="HeadText">Создание нового сервера</h2>
<div class="imgcontainer">
    <img src="PhotoAuth/avatar.webp " alt = "Avatar" class="avatar">
</div>
<form action="create_server_app.php" method="post">
  <div class="container">
    <label>Ввести id оператора 
      <input placeholder="Enter id operator" type="text" name="name_op_new" required>
    </label>
    <label>Ввести инвентарный номер сервера
      <input placeholder="Enter number of server" type="text" name="inv_new" required>
    </label>
    <label>Ввести имя сервера
      <input placeholder="Enter name" type="text" name="name_new" required>
    </label>
    <label>Ввести модель сервера 
      <input placeholder="Enter model" type="text" name="model_new" required>
    </label>   
    <label>Ввести описание сервера
      <input placeholder="Enter description" type="text" name="desc_new" required>
    </label>       
    <button type="submit">Создать сервер</button>
  </form>
<?php else: ?>
  <p class="container">Ошибка доступа</p>
</body>
<script language="javascript">
  $(".five li ul").hide();
  $(".five li:has('.submenu')").hover(
    function(){
      $(".five li ul").stop().fadeToggle(300);
    }
);
  <?php endif; ?>

</script>
</HTML>