<?php

$con = mysql_connect("localhost","root","root123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("alanrgan", $con);

$type = $_POST['type'];
$bet = $_POST['bet'];
$name = $_POST['name'];
$playernum = $_POST['playernum'];

function bet() {
	$arr = Array();
	$betnum = intval($bet);
	if($betnum != 0 || $bet == "all in" || $bet == "allin") {
		$checknum = mysql_query("SELECT * FROM game_table WHERE player1='$name' OR player2='$name'");
		
		while($row = mysql_fetch_array($checknum)) {
			if($playernum = 1) {
				$player = "player1_money";
			} else {
				$player = "player2_money";
			}
			$pot = $row['pot'];
			$playermoney = $row[$player];
		}
		if($betnum <= $playermoney && $betnum > 0) {
			if($betnum % 5 != 0) {
				$arr['error'] = "Bet must be a multiple of 5";
				$arr['okay'] = 0;
				return json_encode($arr);
			} else {
				$playermoney = $playermoney - $betnum;
				$pot += $betnum;
				mysql_query("UPDATE game_table SET pot='$pot', '$player'='$playermoney'") or die(mysql_error);
				$arr['pot'] = $pot;
				$arr['money'] = $playermoney;
				$arr['okay'] = 1;
				return json_encode($arr);
			}
		}
	} else {
		$arr['error'] = "Error: Value entered is not a number";
	}
}

switch($type) {
	case "bet":
		bet();
		break;
	default:
		echo "Error";
}

mysql_close($con);
?>