<?php
	$choosepoker = mysql_query("SELECT * FROM poker");
	if($_GET['seat'])
	{
		$goka = mysql_query("SELECT * FROM poker WHERE id=$_SESSION[poker]");
		mysql_query("UPDATE poker SET $_GET[seat]=$_SESSION[id] WHERE id=$_SESSION[poker]");
		$_SESSION[seat] = $_GET[seat];
		mysql_query("UPDATE users SET pokerseat=$_SESSION[seat] WHERE id=$_SESSION[id]");
		echo 'You sat to seat '.$_GET[seat];
	}
	elseif($_GET[table])
	{
		$_SESSION["poker"] = $_GET[table];
		mysql_query("UPDATE users SET poker=$_SESSION[poker] WHERE id=$_SESSION[id]");
		$goka = mysql_query("SELECT * FROM poker WHERE id=$_SESSION[poker]");
		$gtg = mysql_fetch_array($goka);
		echo 'You have joined table '.$_GET[table].'
		<div style="border-radius: 100px;background: darkgreen;padding: 20px;width: 500px;height: 150px">
		<img src="cards/backofcard.png" style="padding-left: 220px;padding-top: 115px;width: 30px;height: 50px" />
		<img src="cards/backofcard.png" style="width: 30px;height: 50px" /><br>
		<a href="index.php?page=casino&game=poker&seat=p2">Sit</a>
		<a href="index.php?page=casino&game=poker&seat=p3">Sit</a>
		<input type="submit" name="leave" value="Leave" />
		</div>';
	}
	elseif($_POST[leave])
	{
		$goka = mysql_query("SELECT * FROM poker WHERE id=$_SESSION[poker]");
		$gtg = mysql_fetch_array($goka);
		mysql_query("UPDATE poker SET $_SESSION[seat]=0 WHERE id=$_SESSION[poker]");
		if($gtg[players] < 2)
			mysql_query("DELETE FROM poker WHERE id=$_SESSION[poker]");
		$_SESSION[poker] = 0;
		mysql_query("UPDATE users SET poker=$_SESSION[poker] WHERE id=$_SESSION[id]");
		echo 'You left from table';
	}
	elseif($_SESSION["poker"] == true)
	{
		echo '
			You are in table '.$_SESSION["poker"].' and seat '.$_SESSION[seat].'
			<form method="post">
			<div style="border-radius: 100px;background: darkgreen;padding: 20px;width: 500px;height: 150px">
			<img src="cards/backofcard.png" style="padding-left: 220px;padding-top: 115px;width: 30px;height: 50px" />
			<img src="cards/backofcard.png" style="width: 30px;height: 50px" /><br>
			<input type="submit" name="leave" value="Leave" />
			</div>
			</form>
			';
	}
	elseif(mysql_num_rows($choosepoker) > 0)
	{
			while($row = mysql_fetch_array($choosepoker))
			{
				echo '
				Table '.$row[id].' - Players '.$row[players].'<a href="index.php?page=casino&game=poker&table='.$row[id].'">Join</a><br>
				';
			}
	}
	else
	{
			if($_POST[cpoker])
			{
				$ggg = mysql_query("INSERT INTO poker (minbet,p1) VALUES ($_POST[min],$_SESSION[id])");
				$qwe = mysql_query("SELECT * FROM poker");
				$jjj = mysql_num_rows($qwe);
				$hhh = mysql_fetch_array($qwe);
				$_SESSION["poker"] = $jjj;
				mysql_query("UPDATE users SET poker=$jjj WHERE id=$_SESSION[id]");
				echo 'You created table '.$jjj;
				echo '
				<div style="border-radius: 100px;background: darkgreen;padding: 20px;width: 500px;height: 150px">
				<img src="cards/backofcard.png" style="padding-left: 220px;padding-top: 115px;width: 30px;height: 50px" />
				<img src="cards/backofcard.png" style="width: 30px;height: 50px" />
				</div>
				';
			}
			else
			{
			echo'
			<form method="post">
			Minimum Bet : <input type="text" name="min" size="3" /><br>
			<input type="submit" name="cpoker" value="Create Table" />
			</form>';
			}
	}
?>