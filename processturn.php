<?php

$con = mysql_connect("mysql0.db.koding.com","alanrgan_2d4098c","penguins666");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("alanrgan_2d4098c", $con);

$type = $_POST['type'];
$bet = $_POST['bet'];
$name = $_POST['name'];
$playernum = $_POST['playernum'];
$turn = $_POST['turn'];
$arr = array();

switch($type) {
	case "bet":
        $arr['pot'] = 0;
        $arr['money'] = 0;
        $arr['okay'] = 0;
        $arr['error'] = 0;
		$betnum = intval($bet);
        if($betnum != 0 || $bet == "all in" || $bet == "allin") {
    		$checknum = mysql_query("SELECT * FROM game_table WHERE player1='$name' OR player2='$name'") or die(mysql_error());
            
            while($row = mysql_fetch_array($checknum)) {
    			if($playernum == 1) {
    				$playermoney = $row['player1_money'];
    			} else {
    				$playermoney = $row['player2_money'];
    			}
    			$pot = $row['pot'];
    		}
            
    		if($betnum <= $playermoney && $betnum > 0 || $bet == "all in" || $bet == "allin") {
    			if($bet == "all in" || $bet == "allin") {
                    $pot += $playermoney;
                    $playermoney = 0;
                    $move = "went all in";
                    if($playernum == 1) {
        		        mysql_query("UPDATE game_table SET player1_money='$playermoney', pot='$pot', playermove='$move', turn='2' WHERE player1='$name'");
                    } else {
                        mysql_query("UPDATE game_table SET player2_money='$playermoney', pot='$pot', playermove='$move', turn='1' WHERE player2='$name'");
                    }
                    $arr['pot'] = $pot;
                    $arr['money'] = $playermoney;
                    $arr['okay'] = 1;
                    $arr['error'] = "";
                    echo json_encode($arr);
    	    	} else if ($betnum % 5 != 0) {
    				$arr['error'] = "Bet must be a multiple of 5";
    				$arr['okay'] = 0;
    				echo json_encode($arr);
    			} else {
    				$playermoney = $playermoney - $betnum;
    				$pot += $betnum;
                    $move = "bet " . $betnum;
                    if($playernum == 1) {
    				    mysql_query("UPDATE game_table SET pot='$pot', player1_money='$playermoney', playermove='$move', turn='2' WHERE player1='$name'") or die(mysql_error());
                    } else {
                        mysql_query("UPDATE game_table SET pot='$pot', player2_money='$playermoney', playermove='$move', turn='1' WHERE player2='$name'") or die(mysql_error());
                    }
                    $arr['pot'] = $pot;
    				$arr['money'] = $playermoney;
    				$arr['okay'] = 1;
                    $arr['error'] = "";
    				echo json_encode($arr);
    			}
    		} else {
        	    if($betnum > $playermoney) {
                    $arr['error'] = "Error: You cannot bet more than you have"; 
        	    } else if($betnum <= 0) {
                    $arr['error'] = "Error: Your bet has to be greater than zero";   
        	    }
                echo json_encode($arr);
    		}
    	} else {
            if($betnum != "") {
        		$arr['error'] = "Error: Value entered is not a number";
                echo json_encode($arr);
            }
    	}
		break;
	default:
		$arr['error'] = "Error";
        echo json_encode($arr);
}

mysql_close($con);
?>