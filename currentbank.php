<?php
@include_once ("set.php");
$game = fetchinfo("value","info","name","current_game");
echo round(fetchinfo("cost","games","id",$game),2);
?>