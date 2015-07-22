<?php
$item = $_GET['item'];
$item = str_replace("\"", "", $item);
$item = str_replace("\'", "", $item);
$item = str_replace(" ", "%20", $item);
$item = str_replace("\\", "", $item);
@include_once ("set.php");
$rs = mysql_query("SELECT * FROM items WHERE name='$item'");
if(mysql_num_rows($rs) > 0) {
	$row = mysql_fetch_array($rs);
	if(time()-$row["lastupdate"] < 604800) die($row["cost"]);
}
$link = "http://steamcommunity.com/market/priceoverview/?currency=1&appid=730&market_hash_name=".$item;
$string = file_get_contents($link);
$obj = json_decode($string);
if($obj->{'success'} == "0") die("notfound");
$lowest_price = $obj->{'lowest_price'};
for($i = 5; $i < strlen($lowest_price); $i++) {
	$lowest_price[$i-5] = $lowest_price[$i];
}
$lowest_price[strlen($lowest_price)] = 0;
$lowest_price = (float)($lowest_price);
mysql_query("DELETE FROM items WHERE name='$item'");
mysql_query("INSERT INTO items (`name`,`cost`,`lastupdate`) VALUES ('$item','$lowest_price','".time()."')");
echo $lowest_price;
?>