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

mysql_query("UPDATE game_table SET deck='$deck', player1hand='$hand' WHERE player1='$name'");
echo "success";

mysql_close($con);
?>