<?php

$con = mysql_connect("mysql0.db.koding.com","alanrgan_2d4098c","penguins666");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("alanrgan_2d4098c", $con);

$name = $_POST['name'];

$checkopp = mysql_query("SELECT * FROM game_table WHERE player1='$name'");

while($row = mysql_fetch_array($checkopp)) {
    $opp = $row['player2'];
    if($opp != "") {
        echo $opp;
    } else {
        echo "checkopponentfailed";
    }
}

mysql_close($con);
?>