<!DOCTYPE HTML>
<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html: charset=utf-8">
	<link rel ="stylesheet" href="style.css">
 <style type = "text/css">
p.speech_left {
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

<p class="speech_left">Здравствуйте! Данная инструкция покажет, как выполнять основные операции, доступные в системе.  <br/> Выберите пункт «Сервер» на панели главного меню. </p>
<div class="imgcontainer">
<img src="PhotoAuth/server_info1.jpg">
</div>
<p class="speech_left">Далее откроется список всех доступных серверов.</p>
<div class="imgcontainer">
<img src="PhotoAuth/server_test.jpg">
</div>
<p class="speech_left">В нём можно получать телеметрию с серверов, а также выполнять основные действия – включить сервер, выключить сервер, перезагрузить сервер.</p>
<div class="imgcontainer">
<img src="PhotoAuth/master_setting.jpg">
</div>
<p class="speech_left">Для того, чтобы изменить данные пользователя, требуется развернуть пункт «Пользователь» в панели главного меню и выбрать в нём подпункт «Настройки»</p>
<div class="imgcontainer">
<img src="PhotoAuth/settings.jpg">
</div>
<p class="speech_left">На этом инструкция по базовым действиям завершается. Настоятельно советуем ознакомиться со всеми разделами пользовательской документации. </p>
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