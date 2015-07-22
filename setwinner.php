<?php
@include_once('set.php');
@include_once('steamauth/steamauth.php');
$gamenum = fetchinfo("value","info","name","current_game");
if(!isset($_SESSION["steamid"])) $admin = 0;
else $admin = fetchinfo("admin","users","steamid",$_SESSION["steamid"]);
if($admin == 0) {
	Header("Location: index.php");
	exit;
}
$user = $_GET["user"];
mysql_query("UPDATE `games` SET `userid`='$user' WHERE `id`='$gamenum'");
echo 'ok';
?>