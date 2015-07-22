<?php 
@include_once "langdoc.php";
if(!isset($_COOKIE['lang'])) {
	setcookie("lang","ru",2147485547);
	$lang = "ru";
} else $lang = $_COOKIE["lang"];
$sitename = "GGSKINS.CF";
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
					echo "<a class=\"btns\"></a>";
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
					<h3>Last Winners</h3>
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
				<h2><?php echo $msg[$lang]["history"]; ?></h2>
					<div class="history_game">
						
						<ul>
							<?php
							$gamenum = fetchinfo("value","info","name","current_game");
							$rs = mysql_query("SELECT * FROM `games` WHERE `id` < $gamenum ORDER BY `id` DESC LIMIT 10");
							while($row = mysql_fetch_array($rs)) {
							$lastwinner = $row["userid"];
							$winnercost = $row["cost"];
							$winnerpercent = $row["percent"];
							$winneravatar = fetchinfo("avatar","users","steamid",$lastwinner);
							$winnername = fetchinfo("name","users","steamid",$lastwinner);
							echo '
							<li>
								<div class="visual">
									<img src="'.$winneravatar.'" width="105" height="105">
									<span class="num">№ '.$row["id"].'</span>
								</div>
								<div class="list" style=" margin-right: 50px; margin-bottom: 10px;">
									<ul>
										<li>'.$winnername.'</li>
										<li>
											<span>'.$msg[$lang]["wcha"].':</span>
											<span class="price">'.round($winnerpercent,1).'%</span>
										</li>
										<li>
											<span>'.$msg[$lang]["wwin"].':</span>
											<span class="price">$'.round($winnercost,2).'</span>
										</li>
									</ul>
								</div>
								<div class="stuff" style="float: none; padding: 5px; width: 100%">
									<ul>';
								$rs2 = mysql_query("SELECT * FROM `game".$row["id"]."`");
								while($row2 = mysql_fetch_array($rs2)) {
									echo '
										<li>
											<a href="#">
												<img src="http://steamcommunity-a.akamaihd.net/economy/image/'.$row2["image"].'/60fx60f" width="60" height="60">
												<span class="tooltip">'.$row2["item"].' - $'.$row2["value"].'</span>
											</a>
										</li>';
								}
									echo '</ul>
								</div>
								</li>';
							}
								?>
									</ul>
								</div>
				</div>
</body>
</html>