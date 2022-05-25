<!DOCTYPE HTML>
<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html: charset=utf-8">
	<link rel ="stylesheet" href="style.css">
<style>
p.speech {
  position: relative;
  text-align: center;
  padding: 10px;
  margin-right: 25%;
  margin-left: 25%;
  background-color: #FAE996;
  border-radius: 30px;
}
img{
  border: 3px solid #FAE996;  
  width: 70%;
  border-radius: 30px;
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

<p class="speech">Вкладка пользователь содержит 3 раздела: “Страница пользователя”, ”Настройки”, ”Выход”. </p>
<div class="imgcontainer">
<img src="PhotoAuth/menu1.jpg">
<p class="speech">На странице пользователя выводится информация о пользователе, а именно: логин, имя, почта, роль и дата регистрации. </p>
<div class="imgcontainer">
<img src="PhotoAuth/user.jpg">
<p class="speech">На странице настроек в соответствующих полях вы можете изменить свои данные: имя, пароль или почту. Для подтверждения изменений нажмите на кнопку “Подтвердить изменения”. </p>
<div class="imgcontainer">
<img src="PhotoAuth/change.jpg">
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