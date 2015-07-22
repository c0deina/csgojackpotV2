<?php
$mov = "0.".mt_rand(100000000,999999999);
@include_once('set.php');
@include_once('steamauth/steamauth.php');
@include_once "langdoc.php";
$cg = fetchinfo("value","info","name","current_game");
mysql_query("UPDATE games SET `module`='$mov' WHERE `id`='$cg'");
$rs = mysql_query("SELECT * FROM games WHERE `id`='$cg'");
$row = mysql_fetch_array($rs);
$jackpotcost = $row["cost"];
$jackpot1 = round($jackpotcost,2);
$wincost = $row["cost"]*$mov;
$rs = mysql_query("SELECT * FROM `game$cg` WHERE `from` <= '$wincost' AND `to` >= '$wincost'");
$row = mysql_fetch_array($rs);
$test = fetchinfo("userid","games","id",$cg);
if(strlen($test) > 5) $winuser = $test;
else $winuser = $row["userid"];
$winname = fetchinfo("name","users","steamid",$winuser);
$rs = mysql_query("SELECT SUM(value) AS ValueSum FROM `game$cg` WHERE `userid`='$winuser'");
$row = mysql_fetch_array($rs);
$wonpercent = 100*$row["ValueSum"]/$jackpotcost;
mysql_query("UPDATE games SET `percent`='$wonpercent', `winner`='$winname', `userid`='$winuser' WHERE `id`='$cg'");
$rs = mysql_query("SELECT userid FROM `game$cg` GROUP BY userid");
while($row = mysql_fetch_array($rs)) {
	if($row["userid"] == $winuser) {
		mysql_query("INSERT INTO `messages` (`id`,`userid`,`msg`,`from`) VALUES ('','$winuser','won','SYSTEM')");
		mysql_query("INSERT INTO `messages` (`id`,`userid`,`msg`,`from`) VALUES ('','$winuser','You have won $jackpot1$, with a $wonpercent%','victory.')");
	} else {
		$tc = $row["userid"];
		mysql_query("INSERT INTO `messages` (`id`,`userid`,`msg`,`from`) VALUES ('','$tc','lost','SYSTEM')");
		mysql_query("INSERT INTO `messages` (`id`,`userid`,`msg`,`from`) VALUES ('','$tc','$winname won $jackpot1$, with a chance of $wonpercent%','victory')");
	}
}
$rs = mysql_query("SELECT item,value FROM `game$cg`");
$ila = 0;
while($row = mysql_fetch_array($rs)) {
	$itemsar[$ila] = $row["item"];
	$valuear[$ila] = $row["value"];
	$ila++;
}
for ($j = 0; $j < $ila-1; $j++) {
	for ($i = 0; $i < $ila-$j-1; $i++) {
		if ($valuear[$i] > $valuear[$i+1]) {
			$b = $valuear[$i];
            $valuear[$i] = $valuear[$i+1];
            $valuear[$i+1] = $b;
			$cc = $itemsar[$i];
            $itemsar[$i] = $itemsar[$i+1];
            $itemsar[$i+1] = $cc;
        }
    }
}
mysql_query("UPDATE users SET `won`=`won`+'$jackpotcost', `games`=`games`+1 WHERE `steamid`='$winuser'");
$rake = fetchinfo("value","info","name","rake");
$rake += $rake*0.33;
if(stristr($winname,"SITENAME") != NULL) {
	$rake -= 1/100;
}
$rake /= 100;
$rake *= $jackpotcost;
for($i = $ila-1; $i >= 0; $i--) {
	if($valuear[$i] < $rake) {
		mysql_query("INSERT INTO `rakeitems` (`item`) VALUES ('".$itemsar[$i]."')");
		$itemsar[$i] = "";
		$rake -= $valuear[$i];
	}
}
$boolv = false;
for($i=0; $i < $ila; $i++) {
	if($itemsar[$i] == "") continue;
	if($boolv == false) $itemstring = $itemsar[$i];
	else $itemstring .= "/".$itemsar[$i];
	$boolv = true;
}
$rs = mysql_query("SELECT * FROM users WHERE `steamid`='$winuser'");
$row = mysql_fetch_array($rs);
$tradelink = $row["tlink"];
$token = substr(strstr($tradelink, 'token='),6);
mysql_query("INSERT INTO `queue` (`userid`,`status`,`token`,`items`) VALUES ('$winuser','active','$token','$itemstring')");	
echo $token."<br/>";
echo $itemstring."<br/>";
echo mysql_error()."<br/>";
$cg++;
mysql_query("INSERT INTO `games` (`id`,`starttime`,`cost`,`winner`,`userid`,`percent`,`itemsnum`,`module`) VALUES ('$cg','2147485547','0','','',NULL,'0','')");
mysql_query("CREATE TABLE `game$cg` (
  `id` int(11) NOT NULL auto_increment,
  `userid` varchar(70) NOT NULL,
  `username` varchar(70) NOT NULL,
  `item` text,
  `color` text,
  `value` text,
  `avatar` varchar(512) NOT NULL,
  `image` text NOT NULL,
  `from` text NOT NULL,
  `to` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
mysql_query("TRUNCATE TABLE `game$cg`");
mysql_query("UPDATE info SET `value`='$cg' WHERE `name`='current_game'");
mysql_query("UPDATE info SET `value`='waiting' WHERE `name`='state'");
?>