<?php
@include_once('set.php');
@include_once('steamauth/steamauth.php');
if(!isset($_SESSION["steamid"])) {
	Header("Location: index.php");
	exit;
}
$link = $_POST["link"];
$link = mysql_real_escape_string($link);
$steam = $_SESSION["steamid"];
mysql_query("UPDATE users SET `tlink`='$link' WHERE `steamid`='$steam'");
Header("Location: settings.php");
exit;
?>