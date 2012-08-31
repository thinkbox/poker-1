<?php

$con = mysql_connect("localhost","root","root123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("alanrgan", $con);

$deck = $_POST['deck'];
$hand = $_POST['hand'];
$name = $_POST['name'];

mysql_query("UPDATE game_table SET deck='$deck', player1hand='$hand' WHERE player1='$name'");
echo "success";

mysql_close($con);
?>