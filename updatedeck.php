<?php

$name = $_POST['name'];

$con = mysql_connect("mysql0.db.koding.com","alanrgan_2d4098c","penguins666");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("alanrgan_2d4098c", $con);

$deck = $_POST['deck'];
$name = $_POST['name'];
$hand = $_POST['hand'];
$playernum = $_POST['playernum'];

if($name != "") {
    if($deck != "") {
        if($hand == "") {
            mysql_query("UPDATE game_table SET deck='$deck' WHERE player2='$name' OR player1='$name'");
        } else {
            if($playernum == 2) {
                mysql_query("UPDATE game_table SET deck='$deck', player2hand='$hand' WHERE player2='$name' OR player1='$name'");
            } else {
                mysql_query("UPDATE game_table SET deck='$deck', player1hand='$hand' WHERE player2='$name' OR player1='$name'");
            }
        }
    } else {
        $getdeck = mysql_query("SELECT * FROM game_table WHERE name='$name'");
        
        $row = mysql_fetch_array($getdeck);
        
        echo json_encode($row);
    }
}

mysql_close($con);
?>