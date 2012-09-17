<?php

$name = $_POST['name'];

$con = mysql_connect("localhost","root","root123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("alanrgan", $con);

if($name != "") {
    $checkthere = "SELECT * FROM game_table WHERE player1='$name' OR player2='$name'";
    $isthere = mysql_query($checkthere) or die (mysql_error());

    $exists = false;
    while ($row1 = mysql_fetch_assoc($isthere)) {
        $exists = true;
    }
    
    if ($exists == false) {
        $checkthere = "SELECT * FROM game_table WHERE open=1";
        $isthere = mysql_query($checkthere) or die (mysql_error());

        $exists = false;
        while ($row1 = mysql_fetch_assoc($isthere)) {
            $exists = true;
        }
        
        $i = 0;
        $getopen = mysql_query($checkthere);
        while($row = mysql_fetch_array($getopen)) {
            if($exists == true && $i < 1) {
                $openid = $row['id'];
                $i++;
            } else {
                break;
            }
        }
        
        if($openid != "") {
            mysql_query("UPDATE game_table SET player2='$name', open='0', pot='100', player2_money='4950' WHERE id='$openid'");
            echo "canstart";
        } else {
            $getmax = mysql_query("SELECT MAX(id) AS max_id FROM game_table");
            while($row = mysql_fetch_array($getmax)) {
                $max = $row['max_id'] + 1;
            }
            mysql_query("INSERT INTO game_table (id, player1, open) VALUES ('$max','$name','1')");
            echo "waiting";
        }
    } else {
        echo "no!";
    }
}

mysql_close($con);
?>