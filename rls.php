<?php 
@include_once "langdoc.php";
if(!isset($_COOKIE['lang'])) {
	setcookie("lang","ru",2147485547);
	$lang = "ru";
} else $lang = $_COOKIE["lang"];
$sitename = "FIRECSGO.RU";
$title = "$sitename - О сайте";
@include_once('set.php');
@include_once('steamauth/steamauth.php');
@include_once('steamauth/userInfo.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="fav.ico" type="image/x-icon">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
		<header id="header">
		<div style="  width: 1100px;  margin: auto;">
			<strong class="logo"><a href="/"><?php echo $title ?></a></strong>	 
			<div style="float: right;">
				<?php
				if(!isset($_SESSION["steamid"])) {
					steamlogin();
					//echo '<div style="display: inline-block; margin: 35px 90px 0 0; color: #eee; font-size: 12pt;"><a href=en.php><img src=img/en.gif></a><a href=ru.php><img src=img/ru.gif></a></div>';
					echo "<a class=\"btns\">ВОЙТИ С ПОМОЩЬЮ </a>";
					echo "<a class=\"btn\" href=\"?login\">".$msg[$lang]["login2"]."</a>";
					
				} else {
					//echo '<div style="display: inline-block; margin: 35px 90px 0 0; color: #eee; font-size: 12pt;"><a href=en.php><img src=img/en.gif></a><a href=ru.php><img src=img/ru.gif></a>    '.$msg[$lang]["loggedin"].' sf</div>';
					echo '<div style="display: inline-block; margin: 35px 110px 0 0; color: #eee; font-size: 12pt;">'.$msg[$lang]["loggedin"].' '.$steamprofile['personaname'].' </div><div style="display: inline-block; position: absolute; margin-top: 28px; margin-left: -100px "><img src="'.$steamprofile['avatar'].'"></div>';
					echo "<a class=\"btn\" href=\"steamauth/logout.php\">".$msg[$lang]["logout"]."</a>";
					mysql_query("UPDATE users SET name='".$steamprofile['personaname']."', avatar='".$steamprofile['avatarfull']."' WHERE steamid='".$_SESSION["steamid"]."'");
				}
				?>
    		</div>
		</div>
	    </header>
	<div id="wrapper">
			<div id="main">
				<div class="sidebar">
					<nav id="nav">
						<h2><?php echo $msg[$lang]["menu"]; ?></h2>
						<ul>
							<li><a href="/"><?php echo $msg[$lang]["mainpage"]; ?></a></li>
							<li><a href="/history"><?php echo $msg[$lang]["history"]; ?></a></li>
							<li><a href="/top"><?php echo $msg[$lang]["top"]; ?></a></li>
							<li><a href="/about"><?php echo $msg[$lang]["about"]; ?></a></li>
							<li><a href="http://vk.com/csgo_stf"><?php echo $msg[$lang]["support"]; ?></a></li>
						</ul>
					</nav>
					<?php 
					if(isset($_SESSION["steamid"])) {
						?>
					<nav id="nav">
						<h2><?php echo $msg[$lang]["pmenu"]; ?></h2>
						<ul>
							<li><a href="./settings.php"><?php echo $msg[$lang]["settings"]; ?></a></li>
							<li><a href="steamauth/logout.php"><?php echo $msg[$lang]["logout"]; ?></a></li>
						</ul>
					</nav>
					<?php } ?>
					<div class="bonus-block">
						<div class="box">
							<div class="visual">
								<img src="./img/img1.png" width="41" height="50">
							</div>
							<p style="text-align: center;"><?php echo $msg[$lang]["bonus"]; ?></p>
							
						</div>
						<div class="text-box">
								<p style=""><?php echo $msg[$lang]["fp"]; ?></p>
						</div>
					</div>
					
					<h3>Последний победитель</h3>
					<div class="last-winner">
						
						<?php 
							$lastgame = fetchinfo("value","info","name","current_game");
							$lastwinner = fetchinfo("userid","games","id",$lastgame-1);
							$winnercost = fetchinfo("cost","games","id",$lastgame-1);
							$winnerpercent = round(fetchinfo("percent","games","id",$lastgame-1),1);
							$winneravatar = fetchinfo("avatar","users","steamid",$lastwinner);
							$winnername = fetchinfo("name","users","steamid",$lastwinner);
						?>
						<div class="visual">
							<img src="<?php echo $winneravatar ?>" alt="image description" width="109" height="109">
						</div>
						<h3 style="border-radius: 0px 0px 0px 0px;"><?php echo $winnername ?></h3>
						<ul>
							<li>
								<span class="val"><?php echo $msg[$lang]["win"]; ?>:</span>
								<span class="price">$<?php echo round($winnercost,2); ?></span>
							</li>
							<li>
								<span class="val"><?php echo $msg[$lang]["chance"]; ?>:</span>
								<span class="price"><?php echo $winnerpercent ?>%</span>
							</li>
						</ul>
					</div>
					
					<h2><?php echo $msg[$lang]["online"]; ?></h2>
					<div class="online">
						<div class="box">
						  <span id='on_now'>
								<script type="text/javascript" src="http://indexsite.ru/online_user.php?site=ваш сайт"></script> 
								<p>игроков</p>
						  </span> 
						</div>
					</div>


				</div>	
				<div class="content">
					<h2>Правила</h2>
					<div class="lists">
						<div class="box">
							<h3><span>1.</span>ОБЩИЕ ПОЛОЖЕНИЯ</h3>
							<ul>
								<li>
									<p><span>1.1.</span>Зарегистрировавшись в проекте FIRECSGO, вы соглашаетесь с данными правилами в полном объеме. Запрещена регистрация и использование сервиса лицам, которые не согласны с этими Правилами.</p>
								</li>
								<li>
									<p><span>1.2.</span>Администрация проекта не несет никакой ответственности за возможный ущерб, нанесенный вам в результате использования данного сервиса.</p>
								</li>
								<li>
									<p><span>1.3.</span>Любой обман системы, попытки взлома, использование недостоверных данных при регистрации будут серьёзно наказываться Администрацией Csgo-Chance, вплоть до удаления всех аккаунтов, причастных к вышеуказанным действиям.</p>
								</li>
								<li>
									<p><span>1.4.</span>Любые обращения к Администрации FIRECSGO, имеющие нецензурное содержание или несущие оскорбительный характер будут проигнорированы. В случае повторения инцидента – БАН и удаление аккаунта.</p>
								</li>
								<li>
									<p><span>1.5.</span>Администрация имеет право вносить изменения в данные правила, уведомив об этом пользователей в Новостях.</p>
								</li>
								<li>
									<p><span>1.6.</span>Поскольку невозможно описать правилами все специфические области работы в проекте, любые рекомендации или требования Администрации проекта, следует воспринимать как дополнение к существующим правилам.</p>
								</li>
							</ul>
						</div>
						<div class="box">
							<h3><span>2.</span>ОБЯЗАННОСТИ ПОЛЬЗОВАТЕЛЕЙ</h3>
							<ul>
								<li>
									<p><span>2.1.</span>При регистрации указывать правильную информацию , а так же иметь открытый инвентарь</p>
								</li>
								<li>
									<p><span>2.2.</span>Запрещено использовать избыточную ненормативную лексику в переписке с другими пользователями, а так же шантаж, вымогание денег или бонусов. В случае поступления жалоб от пострадавших, аккаунт нарушителя будет забанен и удалён или же лишён права переписки.</p>
								</li>
								<li>
									<p><span>2.3.</span>При обнаружении неисправностей либо погрешностей в работе скрипта и сайта <br> пользователи обязаны вначале убедиться, что Администрация не знает о неисправности. Для этого необходимо проверить раздел «Новости». В случае, если новостей с описанием проблемы нет, сообщить о неисправности в службу технической поддержки.</p>
								</li>
								<li>
									<p><span>2.4.</span>Не проводить попыток взлома сайта и не использовать возможные ошибки в скриптах. Нарушители будут немедленно забанены.</p>
								</li>
								<li>
									<p><span>2.5.</span>Категорически запрещено размещение ссылок.</p>
									<ul>
										<li>содержащие вирусы и фишинговые сайты/ссылки</li>
										<li>ресурсы, нарушающие законодательство РФ и Украины</li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="box">
							<h3><span>3.</span>ОСНОВАНИЕ ДЛЯ УДАЛЕНИЯ И ВНЕСЕНИЯ В ЧЁРНЫЙ СПИСОК (БАН)</h3>
							<ul>
								<li>
									<p><span>3.1.</span>Все пользователи обязаны в полном объёме и беспрекословно следовать Правилам <br> Csgo-Chance. Несогласие или постоянное оспаривание Правил влечёт за собой БАН.</p>
								</li>
								<li>
									<p><span>3.2.</span>Обман системы, попытки взлома, проникновение в чужие аккаунты.</p>
								</li>
								<li>
									<p><span>3.3.</span>Шантаж пользователей, попытки и факты мошенничества..</p>
								</li>
								<li>
									<p><span>3.4.</span>Обращения к Администрации, имеющие нецензурное содержание или несущие оскорбительный характер.</p>
								</li>
								<li>
									<p><span>3.5.</span>Пособничество, соучастие в нарушении вышеуказанных пунктов Правил.</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
</body>
</html>