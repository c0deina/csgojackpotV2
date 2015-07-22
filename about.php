<?php 
@include_once "langdoc.php";
if(!isset($_COOKIE['lang'])) {
	setcookie("lang","ru",2147485547);
	$lang = "ru";
} else $lang = $_COOKIE["lang"];
$sitename = "FIRECSGO.RU";
$title = "$sitename";
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
					<h2>О сайте</h2>
					<div class="lists">
						<div class="box">
							<h4>Приветствуем вас, посетители сайта FIRECSGO.RU</h4>
							<h6>Что такое FIRECSGO?</h6>
							<p>Это комплекс мини-игр, где каждый желающий может заработать вещи CS:GO. <br> Какие игры доступны на данный момент? <br> На данный момент работает Jackpot-лотерея. <br> Как работает Jackpot-лотерея?</p>
							<h5>Особенности:</h5>
							<ul>
								<li>
									<p><span class="user">1.</span>Первому вступившему в игру игроку, шанс победы увеличивается на 10%.</p>
									<p><span class="user">2.</span>Если добавить к нику в steam "FIRECSGO.RU", то комиссия уменьшается в 2 раза.</p>
									<!--p><span class="user">3.</span>За победу каждого приглашенного (см. раздел "реферальная ссылка") игрока вам начисляется 0,05% от стоимости полученных им предметов. Если приглашенный вами игрок выиграл 100$, то вы получите 5 центов (0,05$).</p-->
								</li>
							</ul>
							<h5>Всё очень просто:</h5>
							<p>Вы вносите в депозит свои вещи.(максимум 10 вещей за игру). Далее вы получаете определённый шанс на победу. Чем дороже ваши вещи, тем выше шанс на победу. Ваш шанс на победу зависит от % внесённого в общую сумму в одну игру. Шанс изменяется в зависимости от суммы, которая изменяется с новыми вложениями игроков. Как только в одной игре, мы собираем 50 предметов мы выбираем случайного победителя.</p>
							<h5>Принцып работы:</h5>
							<p>Чем больше и дороже скины Вы ставите, тем больше шанс сорвать джекпот! Но даже вкладывая 1$, у Вас есть возможность сорвать весь куш!</p>
							<h5>Стоит знать:</h5>
							<p>Максимальное вложение - 10 предметов за игру. Мы не ограничиваем максимальную сумму ставки. Минимальная сумма будет изменяться в зависимости от нагрузки на сайт. Для развития сайта, рекламы и конкурсов удерживается комиссия в размере 10% от общей суммы каждой игры. Все вложения и выводы производятся очень быстро в автоматизированном режиме. Если вы играете на сайте, то вы принимаете правила поведения на сайте. Перед началом игры удостоверьтесь, что ваш инвентарь открыт. Игра длится 2 минуты или до достижения 50 предметов. После этого, случайным образом, будет выбран победитель и наш бот отправит ему приз, удерживая комиссию. Для лотереи кс:го будут считываться вещи только кс:го. Цены берутся в реальном времени с торговой площадки стима. Запрещено ставить сувенирные предметы и сувенирные наборы для cs:go, такие трейды отменяются. Вы имеете гарантию получения ваших вещей в течении получаса с момента закрытия пула. По истечении этого времени мы не несем ответственности за утерянные вещи. Если вы отменили обмен или отправили контр-предложение после победы, то ваши вещи возвращены вам не будут, так как бот не рассчитан на повторную отправку вещей Если вы ставите в течении 30 секунд до окончания матча, то есть возможность что ваши скины попадут на следующую игру . Мы не несем за это ответственность, стим не всегда обрабатывает обмены вовремя.</p>
						</div>
						<div class="box">
							<h5>F.A.Q:</h5>
							<ul class="chat2">
								<li>
									<p><span class="user">Q:</span>Пришли не все вещи после моей победы.</p>
									<p><span>A:</span>Сайт забирает комиссию в размере 10%.</p>
								</li>
								<li>
									<p><span class="user">Q:</span>Меня кинули! Забрали больше 10%.</p>
									<p><span>A:</span>Бот не забирает более 10% от общей суммы.</p>
								</li>
								<li>
									<p><span class="user">Q:</span>Моя вещь на засчиталась, что делать?</p>
									<p><span>A:</span>Все поставленые вещи засчитываются. Если ваша вещь действительно не отображается, или не оцениваеться, не стоит волноваться. Напишите в тех.поддержку на сайте, и мы вам вернём вашу вещь!</p>
								</li>
								<li>
									<p><span class="user">Q:</span>Я поставил, а вещи попали в другую игру.</p>
									<p><span>A:</span>Такое случается часто, когда к боту приходит много трейдов, мы стараемся обрабатывать их как можно быстрее, но иногда не успеваем это сделать до конца игры. Ничего страшного, Ваши вещи попадут в следующую игру через пару секунд!</p>
								</li>
								<li>
									<p><span class="user">Q:</span>Вы меня не взломаете?</p>
									<p><span>A:</span>Мы не получаем данные от вашего аккаунта. Авторизация проходит через сервер Steam.</p>
								</li>
							</ul>
						</div>
						<div class="btn_holder">
							<a class="btn" href="/">Внеси депозит и сорви куш!</a>
						</div>
					</div>
				</div>
</body>
</html>