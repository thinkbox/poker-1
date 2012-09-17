<?php

$con = mysql_connect("mysql0.db.koding.com","alanrgan_2d4098c","penguins666");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("alanrgan_2d4098c", $con);

$deck = $_POST['deck'];
$hand = $_POST['hand'];
$name = $_POST['name'];

mysql_query("UPDATE game_table SET deck='$deck', player1hand='$hand', turn='1', player1_money='4950', pot='50', stage='betting' WHERE player1='$name'") or die(mysql_error());
if($name == "") {
    echo "hsdgs";
} else {
    echo "success";
}

mysql_close($con);
?>