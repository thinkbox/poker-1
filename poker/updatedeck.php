<?php

$name = $_POST['name'];

$con = mysql_connect("localhost","root","root123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("alanrgan", $con);

$deck = $_POST['deck'];
$name = $_POST['name'];

if($name != "") {
    if($deck != "") {
        mysql_query("UPDATE game_table SET deck='$deck' WHERE player2='$name' OR player1='$name'");
    } else {
        
    }
}

mysql_close($con);
?>