<html>
<style>
#attackcontent {
	position:relative;
	width:auto;
	height:auto;
	margin-top:-15%;
	margin-left:-25%;
}
.attackbar {
	background:#333;
	width:80%;
	height:3%;
	border:1px solid #000;
	border-radius:3%;
	padding:7px;
	color:#FFF;
}
.attack {
	background:#333;
	width:80%;
	height:auto;
	margin-right:-25%;
	border:1px solid #000;
	border-radius:1%;
	padding:7px;
	color:#FFF;
	text-align:center;
}
.attack img {
	width:340px;
	height:195px;
	opacity:0.8;
	border:1px solid #000;
}
.kill {
	background:#333;
	width:100%;
	height:auto;
	margin-left:-25%;
	border:1px solid #000;
	border-radius:1%;
	padding:7px;
	color:#FFF;
	opacity: 0.95;
	text-align:center;
}
.inputa {
	background:#000;
	color:#FFF;
	border:1px solid #000;
	border-radius:2px;
}
.inputb {
	background:#000;
	color:#FFF;
	border:1px solid #000;
	border-radius:2px;
}
</style>
<body>
<div id="attackcontent">
  <div class="attackbar"><b>ATTACK</b></div>
  <div class="attack"><img src="images/attack.jpg"/></div>
</div>
<div class="kill">
  <?php
if ($_SESSION[hp] < 100)
{
    echo 'You have to heal the wounds before !';
}
else {
?>
  <form method="post">
    <table align="center">
      <tr>
        <td><label style="color:#FFF">Nick Name :</label></td>
        <td><input class="inputa" type="text" name="killname"/></td>
        <td><input class="inputb" type="submit" name="killbtn" value="Attack"/></td>
      </tr>
    </table>
  </form>
  <?php
    /*Player_A is shotter*/
    /*Player B is target*/
    
    $player_B       = $_POST['killname'];
    $player_B_query = mysql_query("SELECT * FROM users WHERE username='$player_B'");
    $player_B_fetch = mysql_fetch_array($player_B_query);
    if ($_POST['killbtn']) 
	{
        if (mysql_num_rows($player_B_query) > 0) 
		{
            if ($_SESSION[username] != $player_B) 
			{
                if ($_SESSION[energy] >= 25) 
				{
                    if ($_SESSION[side] != $player_B_fetch[side]) 
					{
                        if ($player_B_fetch[lvl] == $_SESSION[lvl] || $player_B_fetch[lvl] == ($_SESSION[lvl] - 1) || $player_B_fetch[lvl] == ($_SESSION[lvl] + 1)) 
						{
                            if ($player_B_fetch[hp] >= 50) 
							{
								$_SESSION[attacknumber]++;
								mysql_query("UPDATE users SET attacknumber=$_SESSION[attacknumber] WHERE id=$_SESSION[id]");
								mysql_query("UPDATE users SET reattacknumber=reattacknumber+1 WHERE username='$player_B'");
								
                                $player_A_propatt = (($_SESSION[str] * 0.6) + ($_SESSION[agi] * 0.3) + ($_SESSION[intg] * 0.1));
                                $player_A_propdef = (($_SESSION[str] * 0.1) + ($_SESSION[agi] * 0.3) + ($_SESSION[intg] * 0.6));
                                
                                $player_B_propatt = (($player_B_fetch[str] * 0.6) + ($player_B_fetch[agi] * 0.3) + ($player_B_fetch[intg] * 0.1));
                                $player_B_propdef = (($player_B_fetch[str] * 0.1) + ($player_B_fetch[agi] * 0.3) + ($player_B_fetch[intg] * 0.6));
                                
                                $player_A_attack   = $_SESSION[att] + $player_A_propatt;
                                $player_A_deffence = $_SESSION[def] + $player_A_propdef;
                                
                                $player_B_attack   = $player_B_fetch[att] + $player_B_propatt;
                                $player_B_deffence = $player_B_fetch[def] + $player_B_propdef;
                                
                                $player_A_power = (($player_A_attack + $player_A_deffence) / 100)*$_SESSION[lvl];
                                $player_B_power = (($player_B_attack + $player_B_deffence) / 100)*$player_B_fetch[lvl];
                                echo $player_A_power . '<br>';
                                echo $player_B_power . '<br>';
								
								$_SESSION[energy] -= 25;
								$_SESSION[energytime] = mktime();
								$_SESSION[hptime] = mktime();
								
								mysql_query("UPDATE users SET energytime=$_SESSION[energytime] WHERE id=$_SESSION[id]");
								mysql_query("UPDATE users SET energytime=$_SESSION[energytime] WHERE username='$player_B'");
								
								mysql_query("UPDATE users SET hptime=$_SESSION[hptime] WHERE id=$_SESSION[id]");
								mysql_query("UPDATE users SET hptime=$_SESSION[hptime] WHERE username='$player_B'");
								
								mysql_query("UPDATE users SET energy='$_SESSION[energy]' WHERE id='$_SESSION[id]'");
								mysql_query("UPDATE users SET energy='$_SESSION[energy]' WHERE username='$player_B'");
								
                                if ($player_A_power > $player_B_power) 
								{
                                    $player_B_hp = $player_B_fetch[hp] - $player_A_power;
                                    mysql_query("UPDATE users SET hp=$player_B_hp WHERE username='$player_B'");
                                    $_SESSION[hp]-= $player_B_power;
                                    mysql_query("UPDATE users SET hp=$_SESSION[hp] WHERE username='$_SESSION[username]'");
                                    
                                    if ($player_B_hp <= 0)
									{
										if($player_B_fetch[area]!=0)
										{
											mysql_query("UPDATE map set owner='Ownerless' WHERE owner='$player_B_fetch[team]'");
											mysql_query("UPDATE users SET area=0 WHERE username='$player_B'");
											
										}
										$_SESSION[money] += $player_B_fetch[money];
										mysql_query("UPDATE users SET money=$_SESSION[money] WHERE username='$_SESSION[username]'");
										$attack_message_playerB=$_SESSION[username]." attacked you.You was seriosly wounded and can not do nothing.You lose all the money.";
										$attack_message_playerA=$player_B.' was seriously wounded.He had '.number_format($player_B_fetch[money]).' $ in her pocket.All is yours.';
										$dateandtime=date("d/m/y & H:i:s");
										mysql_query("UPDATE users SET money=0 WHERE username='$player_B'");
                                        mysql_query("UPDATE users SET hp=0 WHERE username='$player_B'");
										mysql_query("INSERT INTO messages (sender,receiver,topic,message,time) VALUES ('System','$player_B','ATTACK','$attack_message_playerB','$dateandtime')");
										mysql_query("INSERT INTO messages (sender,receiver,topic,message,time) VALUES ('System','$_SESSION[username]','ATTACK','$attack_message_playerA','$dateandtime')");
                                        echo $player_B_fetch[username] . ' was seriously wounded.You can check the inbox.';
                                    }
									else 
									{
                                        echo 'You injured target but you could not do much damage !';
                                    }
                                    
                                } 
								else 
								{
                                    $_SESSION[hp]-= $player_B_power;
                                    mysql_query("UPDATE users SET hp=$_SESSION[hp] WHERE username='$_SESSION[username]'");
                                    $player_B_hp = $player_B_fetch[hp] - $player_A_power;
                                    mysql_query("UPDATE users SET hp=$player_B_hp WHERE username='$player_B'");
                                    
                                    if ($_SESSION[hp] <= 0)
								    {
										if($_SESSION[area]!=0)
										{
											mysql_query("UPDATE map set owner='Ownerless' WHERE owner='$_SESSION[team]'");
											mysql_query("UPDATE users SET area=0 WHERE username='$_SESSION[username]'");
											
										}
										
										$_SESSION[money]=0;
										mysql_query("UPDATE users SET money=money+$_SESSION[money] WHERE username='$player_B'");
										$attack_message_playerB=$_SESSION['username'].' attacked you and was seriously wounded.He had '.number_format($_SESSION[money]).' in her pocket.All is yours.';
										$attack_message_playerA='You was seriosly wounded and can not do nothing.You lose all the money.';
										$dateandtime=date("d/m/y & H:i:s");
										mysql_query("UPDATE users SET money=0 WHERE username='$_SESSION[username]'");
                                        mysql_query("UPDATE users SET hp=0 WHERE username='$_SESSION[username]'");
										mysql_query("INSERT INTO messages (sender,receiver,topic,message,time) VALUES ('System','$player_B','ATTACK','$attack_message_playerB','$dateandtime')");
										mysql_query("INSERT INTO messages (sender,receiver,topic,message,time) VALUES ('System','$_SESSION[username]','ATTACK','$attack_message_playerA','$dateandtime')");
                                        echo 'You was seriously wounded.You can check the inbox.';
                                    }
                                    
                                    else 
									{
                                        echo 'You injured target but you could not do much damage !';
                                    }
                                    
                                }
								
							
                            } 
							else
                                {echo 'Your target is trying to heal';}
                        } 
						else
                            {echo 'This player is not suitable for you !!';}
                    } 
					else
                        {echo 'You can not attack your side !';}
                } 
				else
                    {echo 'You are too tired !';}
            } 
			else
                {echo 'You can not attack yourself !';}
        } 
		else
            {echo 'Username is not exist !';}
    }
}
?>
</div>
</div>
</body>
</html>