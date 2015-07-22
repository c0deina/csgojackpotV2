<?php
@include_once "langdoc.php";
if(!isset($_COOKIE['lang'])) {
	setcookie("lang","en",2147485547);
	$lang = "en";
} else $lang = $_COOKIE["lang"];
$sitename = "GGSKINS.CF";
$title = "$sitename";
@include_once('set.php');
require('steamauth/steamauth.php');
	if(isset($_SESSION["steamid"])) {
include_once('steamauth/userInfo.php');}
?>
<html lang="en">
<head>
	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="fav.ico" type="image/x-icon">
    <link href='http://fonts.googleapis.com/css?family=Exo+2:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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
					echo "<a class=\"btns\"> </a>";
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
							<li><a href="/"><i class="fa fa-play" style="padding-right: 15px;"></i> <?php echo $msg[$lang]["mainpage"]; ?></a></li>
							<li><a href="/history"><i class="fa fa-history" style="padding-right: 15px;"></i><?php echo $msg[$lang]["history"]; ?></a></li>
							<li><a href="/top"><i class="fa fa-star" style="padding-right: 15px;"></i><?php echo $msg[$lang]["top"]; ?></a></li>
						</ul>
					</nav>
					<?php 
					if(isset($_SESSION["steamid"])) {
						?>
					<nav id="nav">
						<h2><?php echo $msg[$lang]["pmenu"]; ?></h2>
						<ul>
							<li><a href="./settings.php"><i class="fa fa-cogs" style="padding-right: 15px;"></i><?php echo $msg[$lang]["settings"]; ?></a></li>
							<li><a href="steamauth/logout.php"><i class="fa fa-sign-out" style="padding-right: 15px;"></i><?php echo $msg[$lang]["logout"]; ?></a></li>
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
					<h3>Last winners</h3>
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
				

				</div>	
				<div class="content">
				<header class='head'>
						<?php 
						$result = mysql_query("SELECT MAX(cost) AS cost FROM games");
						$row = mysql_fetch_assoc($result);
						$maxcost =  $row["cost"];
						?>
							<h3 style="text-align: left;"><?php echo $msg[$lang]["mjack"]; ?>: <span style="float: right; font-size: 16px;  background: rgba(255,0,0,0.8);  padding: 15px 40px 15px 40px;  margin-top: -15px;  border-radius: 0px 3px 0px 0px;  margin-right: -16px;  font-weight: 700;">$<?php echo round($maxcost,2); ?></span></h3>
						</header>
						
						

					<div class="items">
							<ul>
								<li>
									<?php echo $msg[$lang]["gtd"]; ?>
									<div class="text">
										<strong><?php
											$result = mysql_query("SELECT id FROM games WHERE `starttime` > ".(time()-86400));
											echo mysql_num_rows($result);
										?></strong>
									</div>
								</li>
								<li>
									<?php echo $msg[$lang]["ptd"]; ?>
									<div class="text">
										<strong><?php
										$row = mysql_fetch_array($result);
										$pls = 0;
										$itms = 0;
										for($i=$row["id"]; $i <= $lastgame; $i++) {
											$rst = mysql_query("SELECT id FROM game".$i." GROUP BY userid");
											$pls += mysql_num_rows($rst);
										}
										echo $pls;
										?></strong>
									</div>								
								</li>
								<li>
									<?php echo $msg[$lang]["itd"]; ?>
									<div class="text">
									<strong><?php
									$result = mysql_query("SELECT SUM(itemsnum) AS itemsnum FROM games WHERE `starttime` > ".(time()-86400));
									$row = mysql_fetch_assoc($result);
									echo $row["itemsnum"];
									?></strong>
									</div>
								</li>
								<li>
									<?php echo $msg[$lang]["mwin"]; ?>
									<div class="text">
										<strong><?php echo round($maxcost,2); ?>$</strong>
									</div>
								</li>
							</ul>
						</div>
						
						
						
						<h3 style="text-align: left;"><?php echo $msg[$lang]["game"]; ?>: <?php  $lastgame; ?></h3>
						<div class="game">
						<div class="progress">
							<div class="stuffs promo-cover">Play with us!</div>
							<div class="visual">
								<div class="progressb">
									<div class="ghbfv" style="color: #fff;    font-size: 15px;    text-align: center;padding-top: 9px;font-weight: 800;">0/50</div>
									<div style="color: #fff;    font-size: 15px;    text-align: center;"> items</div>
									<span id="meter" style="width: 0px"></span>
								</div>
							</div>
							<span id="end_game1" class="end_game"><span id="timeleft">0</span></span>
							<div class="amount">
								<p style="width: 100;"><?php echo $msg[$lang]["winsum"]; ?></p>
								<p id="money_round" style="">0.01$</p>
							</div>
						</div>
						<div class="rate">
							<div class="count" style="margin-right: 270px;padding: 15px 20px;">
								<div class="chance rcol" style="float: left;font-size: 17px;width: 150px;margin-top: 10px;">
									<p style="font: 400 25px/25px 'Roboto', sans-serif;  margin: 0;  width: 100px;  float: left;  color: #474747;"><?php echo $msg[$lang]["chance"]; ?></p>
									<div class="count" style="margin-top: 2px;">
										<span id="mychance" style="font-size: 25px; width: 80px;  color: #f64141;">0%</span>
									</div>
								</div>
								<span id="mychance"></span>
								<br>
								<span id="mychance"></span>
								<img src="./img/arrow.png" width="18" height="58" style="margin-left: 40px;  margin-top: -30;">
							</div>
						</div>
						<?php
						if(!isset($_SESSION["steamid"])) echo '<div id="add_game"><a class="btwn_game" href="?login">'.$msg[$lang]["ingame"].'!</a></div>';
						else {
							$token = fetchinfo("tlink","users","steamid",$_SESSION["steamid"]);
							if(strlen($token) < 2) echo '<div id="add_game"><a class="btwn_game" href="#" onclick="alert2(\'Enter your trade link.\')">'.$msg[$lang]["ingame"].'!</a></div>';
							else echo '<div id="add_game"><a class="btwn_game" href="STEAM TRADE LINK HERE" target=_blank>'.$msg[$lang]["ingame"].'!</a></div>';
						}
						?>
						<div class="stuffs promo-cover">
							<ul id="game-sts" style="display: block;">
								<div class="rounditems"></div>
							</ul>
						</div>
						
				
</body>
</html>
