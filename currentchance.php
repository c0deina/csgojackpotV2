<?php
@include_once('set.php');
@include_once('steamauth/steamauth.php');
if(!isset($_SESSION["steamid"])) {
	die("0%");
}
$lastgame = fetchinfo("value","info","name","current_game");
$steam = $_SESSION["steamid"];
$bank = fetchinfo("cost","games","id",$lastgame);
if($bank == 0) die("0%");
$result = mysql_query("SELECT SUM(value) AS value FROM `game$lastgame` WHERE `userid`='$steam'");
$row = mysql_fetch_assoc($result);
die(round($row["value"]*100/$bank,1)."%");
?>