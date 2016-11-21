  <html>
  <style>
  #multiplecontent
  {
    position:relative;
    width:auto;
    height:auto;
    margin-top:-15%;
    margin-left:-25%;
  }
  .multiplebar
  {
    background:#333;
    width:80%;
    height:3%;
    border:1px solid #000;
    border-radius:3%;
    padding:7px;
    color:#FFF;
  }
  .heist
  {
    background:#333;
    width:80%;
    height:auto;
    border:1px solid #000;
    border-radius:1%;
    padding:7px;
    color:#FFF;
    opacity:0.91;
    text-align:center;
  }
  #preparejewelry
  {
    background:#333;
    width:auto;
    height:auto;
    border:2px solid #000;
    border-radius:1%;
    padding:7px;
    color:#FFF;
    opacity:0.91;
    display:none;
  }
  #preparebank
  {
    background:#333;
    width:auto;
    height:auto;
    border:2px solid #000;
    border-radius:1%;
    padding:7px;
    color:#FFF;
    opacity:0.91;
    display:none;
  }
  .sendheist
  {
    color:#F00;
    font-weight:bold;
  }
  </style>
  <script type="text/javascript">
  function prepareheist(btn)
    {
        var preparejw=document.getElementById('preparejewelry');
        var preparebank=document.getElementById('preparebank');
        var yesorno=document.getElementById('yesorno');
        
        switch(btn.id)
        {
            case 'raidjw':
                preparejw.style.display='block';
            break;
            case 'raidbank':
                preparebank.style.display='block';
            break;
        }
        
    }
  </script>
  <body>
  <div id="multiplecontent">
  <h1 class="PageTitle"><?php if($_SESSION["side"] == 'P') echo 'Group Duties'; else echo 'Group Crimes'; ?></h1>
  <!--Jevelry Store Section-->
  <div class="multiplebar"><?php if($_SESSION["side"] == 'P') echo 'Stop '; ?>Jewelry Store Heist</div>
  <div class="heist">
  <?php
  				$gquery= mysql_query( "SELECT * from users WHERE id=$_SESSION[id]");
				$takegquery=mysql_fetch_array($gquery);
				$_SESSION['jwheistsender']=$takegquery['jwheistsender'];
				$_SESSION[jwheist]=$takegquery[jwheist];
				$_SESSION['jwheisttime']=$takegquery['jwheisttime'];
				$_SESSION['bankheistsender']=$takegquery['bankheistsender'];
				$_SESSION[bankheist]=$takegquery[bankheist];
				$_SESSION['bankheisttime']=$takegquery['bankheisttime'];
				
  				$jhtotaltime=7200;
				$jwheisttim = mysql_query("SELECT jwheisttime FROM users WHERE id=$_SESSION[id]");
				$jwheisttime = mysql_fetch_array($jwheisttim);
				$timenow = mktime();
				$remaindersecond = $jwheisttime[jwheisttime] +$jhtotaltime - $timenow;
				$remainderminute = $remaindersecond/60;
				$remainderhour = $remainderminute/60;
				$jminute=$remainderminute%60;
				$jsecond=$remaindersecond%60;
				
 if($timenow <= $_SESSION['jwheisttime'] + $jhtotaltime)
	{
		echo 'You must wait '.floor($remainderhour).':'.floor($jminute).':'.floor($jsecond).'';
	}
 else if($_SESSION[jwheist]==2)
 	{
	 	echo 'begin heist when everyone ready.';
?>
<form method="post">
<input type="submit" value="cancel" name="canceljw"/>
</form>
<?php
	if($_POST['canceljw'])
	{
		echo 'Jewelry heist has been canceled.';
		$_SESSION[jwheist]=0;
        mysql_query("UPDATE users SET jwheist=0 WHERE id='$_SESSION[id]'");
		mysql_query("UPDATE users SET jwheist=0 WHERE username='$_SESSION[jwheistsender]'");
		header("refresh:0;url=index.php?page=multiple");
	}
	}
 else if($_SESSION[jwheist]==1)
            {
                echo '<font color="#F00"><b>'.$_SESSION[jwheistsender].' has commissioned you for this heist.Do you want to join?</b></font>'; 
				if($_SESSION["side"]=='M')
				{
                ?>
  <div id="yesorno" style="text-align:center;color:#F00;">
  <form method="post"><br/>
  <select name="jwbags">
  <option value="0_bags">You have to choose a bag.</option>
  <option value="1_sbag">Small bag (10.000$)</option>
  <option value="2_bbag">Big bag (25.00$)</option>
  </select>
  <input type="submit" value="Yes" name="yesjw"/><input type="submit" name="nojw" value="No"/>
  </form>
  </div>
  <?php
   }
   else
   {
  ?>
  <div id="yesorno" style="text-align:center;color:#F00;">
  <form method="post"><br/>
  <select name="jwbags">
  <option value="0_bags">You have to choose a grenade.</option>
  <option value="1_sbag">Flash grenade (10.000$)</option>
  <option value="2_bbag">Three flash grenade (25.00$)</option>
  </select>
  <input type="submit" value="Yes" name="yesjw"/><input type="submit" name="nojw" value="No"/>
  </form>
  </div>
                <?php
   }
			    function jwpostyes()
				{
					$_SESSION[energy] -= 25;
					$_SESSION[energytime] = mktime();
					mysql_query("UPDATE users SET energytime=$_SESSION[energytime] WHERE id=$_SESSION[id]");
					mysql_query("UPDATE users SET energy='$_SESSION[energy]' WHERE id='$_SESSION[id]'");
					
                    $_SESSION[jwheist]=0;
                    mysql_query("UPDATE users SET jwheist=0 WHERE id='$_SESSION[id]'");
					$_SESSION[jwheisttime] =mktime();
					mysql_query("UPDATE users SET jwheisttime='$_SESSION[jwheisttime]' WHERE id='$_SESSION[id]'");
					mysql_query("UPDATE users SET jwheisttime='$_SESSION[jwheisttime]' WHERE username='$_SESSION[jwheistsender]'");
					mysql_query("UPDATE users SET jwheist=0 WHERE username='$_SESSION[jwheistsender]'");
					
					$jwmoney=(rand(15000,20000))*$_SESSION[lvl];
					mysql_query("UPDATE users SET money=money+'$jwmoney' WHERE id='$_SESSION[id]'");
					mysql_query("UPDATE users SET money=money+'$jwmoney' WHERE username='$_SESSION[jwheistsender]'");
					
				    $expjw =20 / $_SESSION[lvl];
					mysql_query("UPDATE users SET expr=expr+'$expjw' WHERE id='$_SESSION[id]'");
					mysql_query("UPDATE users SET expr=expr+'$expjw' WHERE username='$_SESSION[jwheistsender]'");
					
					$dateandtime = date("d/m/y & H:i:s");
					$jwmessagge='Congratulations.You got '.$jwmoney.' $.';
					mysql_query("INSERT INTO messages (sender,receiver,topic,message,time) VALUES ('System','$_SESSION[username]','JEWELRY HEİST','$jwmessagge','$dateandtime')");
					mysql_query("INSERT INTO messages (sender,receiver,topic,message,time) VALUES ('System','$_SESSION[jwheistsender]','JEWELRY HEİST','$jwmessagge','$dateandtime')");
				}
				
                if($_POST['yesjw'])
                {
					$bagoption = explode("_",$_POST['jwbags']);
					$bagoption_id = $bagoption[0];
					
					if($bagoption_id==1)
					{
						if($_SESSION[money]>=10000)
						{
							$_SESSION[money]-=10000;
							mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE id='$_SESSION[id]'");
							echo "Jewelry Heist is SUCCESSFULL.You can check the inbox.";
							jwpostyes();
						    header("refresh:3;url=index.php?page=messages");

						}
						else {echo'You have not enough money.';}
					}
					else if($bagoption_id==2)
					{
						if($_SESSION[money]>=25000)
						{
							$_SESSION[money]-=25000;
							mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE id='$_SESSION[id]'");
							echo "Jewelry Heist is SUCCESSFULL.You can check the inbox.";
							jwpostyes();
						    header("refresh:3;url=index.php?page=messages");
						}
						else {echo'You have not enough money.';}
					}
					else{echo 'You can choose a bag.';}
                }
				
                else if($_POST['nojw'])
                {
                    $_SESSION[jwheist]=0;
                    mysql_query("UPDATE users SET jwheist=0 WHERE id='$_SESSION[id]'");
					mysql_query("UPDATE users SET jwheist=0 WHERE username='$_SESSION[jwheistsender]'");
					header("refresh:0;url=index.php?page=multiple");
                }
            }		
 else
 {
  ?>
  <!--remainderminute else statment start section-->
  <div><?php 
  if($_SESSION[lvl]>=2)
  { 
	  if($_SESSION["side"] == 'P') 
	  {
		  echo 'You can raid jewelry.'; 
		  echo '<input type="button" value="Prepare the raid." id="raidjw" onclick="prepareheist(this)"/>';
	  }
	  else 
	  {
		   echo 'You can heist jewelry.';
		   echo '<input type="button" value="Prepare the heist." id="raidjw" onclick="prepareheist(this)"/>';
	  }
  }
  else
  {
	  if($_SESSION["side"] == 'P') 
	  {
		  echo 'You must be level 2 for the raid jewelry.';
	  }
	  else 
	  {
		   echo 'You must be level 2 for the heist jewelry.';
	  }
   	  
  }
  ?>
  </div><br/>
  <div id="preparejewelry">
  <form method="post">
  <table style="color:#FFF;text-align:left">
  <tr><td>Leader:</td><td></td><td><?php echo $_SESSION[username]; ?></td></tr>
  <?php
  if ($_SESSION["side"] == 'P')
  {
  ?>
  <tr><td>Partner:</td><td></td><td><input type="text" name="bagman"/></td></tr>
  <?php  
  }
  else
  {
  ?>
  <tr><td>Bagman:</td><td></td><td><input type="text" name="bagman"/></td></tr>
  <?php  
  }
  ?>
  <tr><td>Guns:</td><td></td><td><select name="jwguns"><option value="0_gun">Select Weapon</option><option value="1_gun1">M204-ATP(20.000$)</option><option value="2_gun2">AK-47(30.000$)</option></select></td></tr>
  <tr><td></td><td></td><td></td><td><input type="submit" value="Start" name="startjw"/></td></tr>
  </table>
  </form>
  </div>
  <div class="sendheist">
  <?php
  		function jwpoststart()
		{
			$_SESSION[energy] -= 25;
			$_SESSION[energytime] = mktime();
			mysql_query("UPDATE users SET energytime=$_SESSION[energytime] WHERE id=$_SESSION[id]");
			mysql_query("UPDATE users SET energy='$_SESSION[energy]' WHERE id='$_SESSION[id]'");
			mysql_query("UPDATE users SET jwheist=2 WHERE username='$_SESSION[username]'");
           
		}
        if($_POST['startjw'])
        {
            $jwusercheck = mysql_query("SELECT * from users WHERE username='".mysql_real_escape_string($_POST['bagman'])."'");
            $usernumrows = mysql_num_rows($jwusercheck);
			$gunsoption = explode("_",$_POST['jwguns']);
			$gunsoption_id = $gunsoption[0];
            if($usernumrows>0)
            {
			 	$ftchuser=mysql_fetch_array($jwusercheck);
				if($_POST['bagman'] != $_SESSION['username'])
				{
					if($_SESSION['side'] == $ftchuser['side'])
					{
						if($gunsoption_id != 0)
							{
							if($ftchuser[lvl] >= 2)
							{
								if($ftchuser['jwheist'] == 0)
								{
									if($gunsoption_id==1)
									{
										if($_SESSION[money]>=20000)
										{
											$_SESSION[money]-=20000;
											mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE username='$_SESSION[username]'");
											jwpoststart();
											mysql_query("UPDATE users SET jwheist=1 WHERE username='$ftchuser[username]'");
											mysql_query("UPDATE users SET jwheistsender='$_SESSION[username]' WHERE username='$ftchuser[username]'");
            								mysql_query("UPDATE users SET jwheistsender='$ftchuser[username]' WHERE username='$_SESSION[username]'");
											header("refresh:0;url=index.php?page=multiple");	
										}
										else echo 'You have not enough money';
									}
									if($gunsoption_id==2)
									{
										if($_SESSION[money]>=30000)
										{
											$_SESSION[money]-=30000;
											mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE username='$_SESSION[username]'");
											jwpoststart();
											mysql_query("UPDATE users SET jwheist=1 WHERE username='$ftchuser[username]'");
											mysql_query("UPDATE users SET jwheistsender='$_SESSION[username]' WHERE username='$ftchuser[username]'");
            								mysql_query("UPDATE users SET jwheistsender='$ftchuser[username]' WHERE username='$_SESSION[username]'");
											header("refresh:0;url=index.php?page=multiple");
										}
										else echo 'You have not enough money';
									}
								}
								else echo $ftchuser[username].' is tired now.';
							}
								else echo $ftchuser[username].' must be level 2.';
							}
							else echo 'You have to choose a weapon.';
					}
					else
					{
						echo $ftchuser[username].' should be from your side.';
					}
				}
				else
				{
					echo 'You can not write yourself.';
				}
                }
            else
            {
                echo 'This username doesn\'t exist.';				
            }
        }
        
           
  ?>
  </div>
  <?php } ?><!--remainder minute else statment end section-->
  </div>
  <!--Jevelry Store Section end...-->
  <br/>
  <!--Bank Heist Section-->
  <div class="multiplebar"><?php if($_SESSION["side"] == 'P') echo 'Stop '; ?>Bank Heist</div>
  <div class="heist">  
  <?php
  				$heistbanksender=array();
				$bankheist=array();
				$bankheistusers=array();
  				$bhtotaltime=18000;
				$bheisttim = mysql_query("SELECT bankheisttime FROM users WHERE id=$_SESSION[id]");
				$bankheisttime = mysql_fetch_array($bheisttim);
				$timenow = mktime();
				
				$remaindersecond = $bankheisttime[bankheisttime] + $bhtotaltime - $timenow;
				$remainderminute =$remaindersecond / 60;
				$remainderhour = $remainderminute / 60 ;
				$minute=$remainderminute%60;
				$second=$remaindersecond%60;
								
	for($j=0;$j<4;$j++)
		{
		$queryb=mysql_query("SELECT * FROM users WHERE bankheistsender='$_SESSION[username]'");
		$bquery=mysql_fetch_array($queryb);
		$bankheist[$j]=$bquery[bankheist];
		}
	function startbank()
	{
					$_SESSION[bankheist]=0;
					mysql_query("UPDATE users SET bankheist=0 WHERE id='$_SESSION[id]'");
					
					$_SESSION[bankheisttime]=mktime();
					$_SESSION[energy] -= 25;
					$_SESSION[energytime] = mktime();
					mysql_query("UPDATE users SET energytime=$_SESSION[energytime] WHERE id=$_SESSION[id]");
					mysql_query("UPDATE users SET energy='$_SESSION[energy]' WHERE id='$_SESSION[id]'");
					mysql_query("UPDATE users SET bankheisttime='$_SESSION[bankheisttime]' WHERE id='$_SESSION[id]'");
					mysql_query("UPDATE users SET bankheistsender='x' WHERE id='$_SESSION[id]'");
					$heisttime=mktime();
					$bankmoney=(rand(15000,20000))*$_SESSION[lvl];
					mysql_query("UPDATE users SET money=money+'$bankmoney' WHERE id='$_SESSION[id]'");
					$expbank =50 / $_SESSION[lvl];
					mysql_query("UPDATE users SET expr=expr+'$expbank' WHERE id='$_SESSION[id]'");
					$dateandtime = date("d/m/y & H:i:s");
					$bankmessagge='Congratulations.You got '.$bankmoney.' $.';
					mysql_query("INSERT INTO messages (sender,receiver,topic,message,time) VALUES ('System','$_SESSION[username]','BANK HEİST','$bankmessagge','$dateandtime')");
					
					$queryb=mysql_query("SELECT * FROM users WHERE bankheistsender='$_SESSION[username]' AND bankheist=3");
					while($row = mysql_fetch_array($queryb))
					{
						$expbank =50 / $row[lvl];
						mysql_query("UPDATE users SET bankheist=0 WHERE username='$row[username]'");
						mysql_query("UPDATE users SET energytime='$heisttime' WHERE username='$row[username]'");
						mysql_query("UPDATE users SET energy=energy-25 WHERE username='$row[username]'");
						mysql_query("UPDATE users SET bankheisttime='$heisttime' WHERE username='$row[username]'");
						mysql_query("UPDATE users SET bankheistsender='x' WHERE username='$row[username]'");
						mysql_query("UPDATE users SET money=money+'$bankmoney' WHERE id='$row[id]'");
						mysql_query("UPDATE users SET expr=expr+'$expbank' WHERE id='$row[id]'");
						mysql_query("INSERT INTO messages (sender,receiver,topic,message,time) VALUES ('System','$row[username]','BANK HEİST','$bankmessagge','$dateandtime')");
					}
					
	}
				
 if($timenow <= $_SESSION['bankheisttime'] + $bhtotaltime)
	{
		echo 'You must wait '.floor($remainderhour).':'.floor($minute).':'.floor($second).'';
	}
 else if($_SESSION[bankheist]==3)
 	{
	 	echo 'expected to start by leader.';
	}
 else if($bankheist[0]==3 && $bankheist[1]==3 && $bankheist[2]==3 && $bankheist[3]==3)
 	{
	 	echo 'Everyone is ready.';
?>
<form method="post">
<input type="submit" value="Lets start" name="start"/>
</form>
<?php
	if ($_POST['start'])
	{
		startbank();
		header("refresh:0;url=index.php?page=multiple");
	}
	}
 else if ($_SESSION[bankheist]==2)
 {
	 	 	echo 'expected to be ready for everyone.';
?>
<form method="post">
<input type="submit" value="cancel" name="cancelbank"/>
</form>
<?php
if($_POST['cancelbank'])
	{
		echo 'Bank heist has been canceled.';
		$_SESSION[bankheist]=0;
        mysql_query("UPDATE users SET bankheist=0 WHERE id='$_SESSION[id]'");
		mysql_query("UPDATE users SET bankheistsender='x' WHERE id='$_SESSION[id]'");
		for($i=0;$i<4;$i++)
		{
		mysql_query("UPDATE users SET bankheist=0 WHERE username='$bankheistusers[$i]'");
		mysql_query("UPDATE users SET bankheistsender='x' WHERE username='$bankheistusers[$i]'");
		}
		header("refresh:0;url=index.php?page=multiple");
	}
 }
 else if ($_SESSION[bankheist]==1)
{
	echo '<font color="#F00"><b>'.$_SESSION[bankheistsender].' has commissioned you for this heist.Do you want to join?</b></font>';
	
	if($_SESSION['spec'] == 'Assault' || $_SESSION['spec'] == 'Gunman')
	{
?>
<div id="yesorno" style="text-align:center;color:#F00;">
  <form method="post"><br/>
  <select name="bankselect">
  <option value="0_gun">You have to choose a weapon.</option>
  <option value="1_gun">AK-47 (30.000$)</option>
  <option value="2_gun">MG3 (50.000$)</option>
  </select>
  <input type="submit" value="Yes" name="yesbank"/><input type="submit" name="nobank" value="No"/>
  </form>
  </div>
<?php
		if($_POST['yesbank'])
		{
			$bankoption = explode("_",$_POST['bankselect']);
			$bankoption_id = $bankoption[0];
			if($bankoption_id==1)
			{
				if($_SESSION[money]>=30000)
						{
							$_SESSION[money]-=30000;
							mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE id='$_SESSION[id]'");
							mysql_query("UPDATE users SET bankheist=3 WHERE username='$_SESSION[username]'");
							header("refresh:0;url=index.php?page=multiple");
						}
						else {echo'You have not enough money.';}
			}
			else if($bankoption_id==2)
			{
				if($_SESSION[money]>=50000)
						{
							$_SESSION[money]-=50000;
							mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE id='$_SESSION[id]'");
							mysql_query("UPDATE users SET bankheist=3 WHERE username='$_SESSION[username]'");
							header("refresh:0;url=index.php?page=multiple");
						}
						else {echo'You have not enough money.';}
			}
			else{echo 'You can choose a weapon.';}

		}
		if($_POST['nobank'])
		{
			$_SESSION[bankheist]=0;
			mysql_query("UPDATE users SET bankheist=0 WHERE id='$_SESSION[id]'");
			mysql_query("UPDATE users SET bankheistsender='x' WHERE id='$_SESSION[id]'");
			header("refresh:0;url=index.php?page=multiple");
		}
	}
	else if($_SESSION['spec'] == 'Cyber' || $_SESSION['spec'] == 'Hacker')
	{
?>
<div id="yesorno" style="text-align:center;color:#F00;">
  <form method="post"><br/>
  <select name="bankselect">
  <option value="0_pc">You have to choose a computer.</option>
  <option value="1_pc">PC-2130 (3.000$)</option>
  <option value="2_pc">PC-2760 (8.000$)</option>
  </select>
  <input type="submit" value="Yes" name="yesbank"/><input type="submit" name="nobank" value="No"/>
  </form>
  </div>
<?php
	if($_POST['yesbank'])
		{
			$bankoption = explode("_",$_POST['bankselect']);
			$bankoption_id = $bankoption[0];
			if($bankoption_id==1)
			{
				if($_SESSION[money]>=3000)
						{
							$_SESSION[money]-=3000;
							mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE id='$_SESSION[id]'");
							mysql_query("UPDATE users SET bankheist=3 WHERE username='$_SESSION[username]'");
							header("refresh:0;url=index.php?page=multiple");
						}
						else {echo'You have not enough money.';}
			}
			else if($bankoption_id==2)
			{
				if($_SESSION[money]>=8000)
						{
							$_SESSION[money]-=8000;
							mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE id='$_SESSION[id]'");
							mysql_query("UPDATE users SET bankheist=3 WHERE username='$_SESSION[username]'");
							header("refresh:0;url=index.php?page=multiple");
						}
						else {echo'You have not enough money.';}
			}
			else{echo 'You can choose a computer.';}

		}
		if($_POST['nobank'])
		{
			$_SESSION[bankheist]=0;
			mysql_query("UPDATE users SET bankheist=0 WHERE id='$_SESSION[id]'");
			mysql_query("UPDATE users SET bankheistsender='x' WHERE id='$_SESSION[id]'");
			header("refresh:0;url=index.php?page=multiple");
		}
	}
	else if($_SESSION['spec'] == 'BombDisposal' || $_SESSION['spec'] == 'BombExpert')
	{
?>
<div id="yesorno" style="text-align:center;color:#F00;">
  <form method="post"><br/>
  <select name="bankselect">
  <option value="0_bomb">You have to choose a bomb.</option>
  <option value="1_bomb">TNT (25.000$)</option>
  <option value="2_bomb">C4 (50.000$)</option>
  </select>
  <input type="submit" value="Yes" name="yesbank"/><input type="submit" name="nobank" value="No"/>
  </form>
  </div>
<?php
	if($_POST['yesbank'])
		{
			$bankoption = explode("_",$_POST['bankselect']);
			$bankoption_id = $bankoption[0];
			if($bankoption_id==1)
			{
				if($_SESSION[money]>=25000)
						{
							$_SESSION[money]-=25000;
							mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE id='$_SESSION[id]'");
							mysql_query("UPDATE users SET bankheist=3 WHERE username='$_SESSION[username]'");
							header("refresh:0;url=index.php?page=multiple");	
						}
						else {echo'You have not enough money.';}
			}
			else if($bankoption_id==2)
			{
				if($_SESSION[money]>=50000)
						{
							$_SESSION[money]-=50000;
							mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE id='$_SESSION[id]'");
							mysql_query("UPDATE users SET bankheist=3 WHERE username='$_SESSION[username]'");
							header("refresh:0;url=index.php?page=multiple");
						}
						else {echo'You have not enough money.';}
			}
			else{echo 'You can choose a bomb.';}

		}
		if($_POST['nobank'])
		{
			$_SESSION[bankheist]=0;
			mysql_query("UPDATE users SET bankheist=0 WHERE id='$_SESSION[id]'");
			mysql_query("UPDATE users SET bankheistsender='x' WHERE id='$_SESSION[id]'");
			header("refresh:0;url=index.php?page=multiple");
		}
	}
	else if($_SESSION['spec'] == 'Sniper' || $_SESSION['spec'] == 'DeadShot')
	{
?>
<div id="yesorno" style="text-align:center;color:#F00;">
  <form method="post"><br/>
  <select name="bankselect">
  <option value="0_gun">You have to choose a rifle.</option>
  <option value="1_gun">MK-21 (45.000$)</option>
  <option value="2_gun">AWM (70.000$)</option>
  </select>
  <input type="submit" value="Yes" name="yesbank"/><input type="submit" name="nobank" value="No"/>
  </form>
  </div>
<?php
	if($_POST['yesbank'])
		{
			$bankoption = explode("_",$_POST['bankselect']);
			$bankoption_id = $bankoption[0];
			if($bankoption_id==1)
			{
				if($_SESSION[money]>=45000)
						{
							$_SESSION[money]-=45000;
							mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE id='$_SESSION[id]'");
							mysql_query("UPDATE users SET bankheist=3 WHERE username='$_SESSION[username]'");
							header("refresh:0;url=index.php?page=multiple");

						}
						else {echo'You have not enough money.';}
			}
			else if($bankoption_id==2)
			{
				if($_SESSION[money]>=70000)
						{
							$_SESSION[money]-=70000;
							mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE id='$_SESSION[id]'");
							mysql_query("UPDATE users SET bankheist=3 WHERE username='$_SESSION[username]'");
							header("refresh:0;url=index.php?page=multiple");

						}
						else {echo'You have not enough money.';}
			}
			else {echo 'You can choose a rifle.';}

		}
		
		if($_POST['nobank'])
		{
			$_SESSION[bankheist]=0;
			mysql_query("UPDATE users SET bankheist=0 WHERE id='$_SESSION[id]'");
			mysql_query("UPDATE users SET bankheistsender='x' WHERE id='$_SESSION[id]'");
			header("refresh:0;url=index.php?page=multiple");
		}
	}
	
 }
	
 else
 {
	 ?>
  <div>
  <?php 
  if($_SESSION[lvl]>=5)
  { 
	  if($_SESSION["side"] == 'P') 
	  {
		  echo 'You can raid bank.'; 
		  echo '<input type="button" value="Prepare the raid." id="raidbank" onclick="prepareheist(this)"/>';
	  }
	  else 
	  {
		   echo 'You can heist bank.';
		   echo '<input type="button" value="Prepare the heist." id="raidbank" onclick="prepareheist(this)"/>';
	  }
  }
  else
  {
	  if($_SESSION["side"] == 'P') 
	  {
		  echo 'You must be level 5 for the raid bank.';
	  }
	  else 
	  {
		   echo 'You must be level 5 for the heist bank.';
	  }
   	  
  }
  ?>
   </div><br/>
  <div id="preparebank">
  <form method="post">
  <table style="color:#FFF;text-align:left">
  <tr><td>Leader:</td><td></td><td><?php echo $_SESSION[username]; ?></td></tr>
  <tr><td>Gunman / Assault</td><td></td><td><input type="text" name="input0"/></td></tr>
  <tr><td>Hacker / Cyber Crime:</td><td></td><td><input type="text" name="input1"/></td></tr>
  <tr><td>Death Shot / Sniper:</td><td></td><td><input type="text" name="input2"/></td></tr>
  <tr><td>Bomb Expert / Bomb Disposal:</td><td></td><td><input type="text" name="input3"/></td></tr>
  <tr><td>Guns:</td><td></td><td><select name="bankgunsoption"><option value="0_gun">Select Weapon</option><option value="1_gun1">AK-47(30.000$)</option><option value="2_gun2">Machine Weapons(50.000$)</option></select></td></tr>
  <tr><td></td><td></td><td></td><td><input type="submit" value="Start" name="startbank"/></td></tr>
  </table>
  </form>
  </div>
  <div class="sendheist">
  	<?php
	function bankpoststart()
		{
			$_SESSION[energy] -= 25;
			$_SESSION[energytime] = mktime();
			mysql_query("UPDATE users SET energytime=$_SESSION[energytime] WHERE id=$_SESSION[id]");
			mysql_query("UPDATE users SET energy='$_SESSION[energy]' WHERE id='$_SESSION[id]'");
			mysql_query("UPDATE users SET bankheist=2 WHERE username='$_SESSION[username]'");
		}
		
		if($_POST['startbank'])
		{
			for($j=0;$j<4;$j++)
			{
			$bankusername=$_POST["input$j"];
			$jwusercheck = mysql_query("SELECT * from users WHERE username='".mysql_real_escape_string($bankusername)."'");
            $usernumrows = mysql_num_rows($jwusercheck);
			
			$bannkgunsoption = explode("_",$_POST['bankgunsoption']);
			$bankgunsoption_id = $bannkgunsoption[0];
			if($usernumrows>0)
			{
				$ftchuser=mysql_fetch_array($jwusercheck);
				if($bankusername != $_SESSION['username'])
				{
					if($_SESSION['side'] == $ftchuser['side'])
					{
						if($bankgunsoption_id != 0)
						{
							if($ftchuser[lvl] >= 5)
							{
								if($ftchuser['bankheist'] == 0)
								{
									if($_SESSION[energy]>=25 and $ftchuser[energy]>=25)
									{
										if($bankgunsoption_id==1)
									{
										if($_SESSION[money]>=30000)
										{
											$heistbanksender[$j]=$ftchuser[username];
											$_SESSION[money]-=30000;
											mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE username='$_SESSION[username]'");
											bankpoststart();
											mysql_query("UPDATE users SET bankheist=1 WHERE username='$ftchuser[username]'");
											mysql_query("UPDATE users SET bankheistsender='$_SESSION[username]' WHERE username='$ftchuser[username]'");
											header("refresh:0;url=index.php?page=multiple");
										}
										else
										{
											echo 'You have not enough money.<br>';
										}
									}
									else
									{
										if($_SESSION[money]>=50000)
										{
											$_SESSION[money]-=50000;
											mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE username='$_SESSION[username]'");
											bankpoststart();
											mysql_query("UPDATE users SET bankheist=1 WHERE username='$ftchuser[username]'");
											mysql_query("UPDATE users SET bankheistsender='$_SESSION[username]' WHERE username='$ftchuser[username]'");
											header("refresh:0;url=index.php?page=multiple");
										}
										else
										{
											echo 'You have not enough money.<br>';
										}
									}
									}
									else
									{
										echo 'you or your friend energy is low.';
									}
								}
								else
								{
									echo $ftchuser[username].' is tired now.';
								}
							}
							else
							{
								echo $ftchuser[username].' must be level 5.<br>';
							}

						}
						else
						{
							echo 'You have to choose a weapon.<br>';
						}
					}
					else
					{
						echo $bankusername.' should be from your side.<br>';
					}
				}
				else
				{
					echo 'You can not write yourself.<br>';
				}
				
			}
			else
			{
				echo $_POST["input$j"].' doesn\'t exist.<br>';
			}
			}
		}
	?>
  </div>
<?php } ?>
  </div>
  <!--Bank Heist Section end...-->
  </div>
  </body>
  </html>