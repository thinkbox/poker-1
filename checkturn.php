<?php

$con = mysql_connect("mysql0.db.koding.com","localhost","root123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("localhost", $con);

$name = $_POST['name'];

if($name != "") {
    $checkturn = mysql_query("SELECT * FROM game_table WHERE player1='$name' OR player2='$name'") or die(mysql_error());
    
    while($row = mysql_fetch_array($checkturn)) {
        $turn = $row['turn'];
        $move = $row['playermove'];
        $stage = $row['stage'];
        $pot = $row['pot'];
        $deck = $row['deck'];
    }
    $arr = array();
    $arr['turn'] = $turn;
    $arr['move'] = $move;
    $arr['stage'] = $stage;
    $arr['pot'] = $pot;
    $arr['deck'] = $deck;
    echo json_encode($arr);
}

?>