<!DOCTYPE HTML>
<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html: charset=utf-8">
	<link rel ="stylesheet" href="style.css">


</HEAD>
<style type = "text/css">
  .userdoc {
    padding-left: 35%;
    padding-right: 35%;
    text-align: center;
    margin: 0;
  }
  .userdoc_low{
    padding-left: 70px;
  }

  button{
    background-color: #5bc0be;
    font-size: 20px;

    width: 400px;
  }

  p{
    font-size: 30px;
  }
  .b1{
    margin: 0;
    padding: 0;}
</style>
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
<h2 class="HeadText">Руководство по эксплуатации</h2>
<div class="userdoc">
  <p>Рандомный текст</p>
  <form action="master_setting.php">
    <button type="submit">Мастер быстрой настройки</button>
  </form>
  <p href="">Разделы документации: </p>
  <div class="b1">
    <form action="user_func.html">
      <button type="submit">Руководство по пользовательским функциям веб-интерфейсам</button>
    </form>
    <form action="func_contr.php">
      <button type="submit">Руководство по функциям управления серверами</button>
  </form>
</div>
<p></p>
<form action="FAQ.html">
  <button type="submit">FAQ</button>
</form>
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