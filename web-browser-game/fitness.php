<?php
		echo '<div class="middiv">';
		$userWorkTime = mysql_query("SELECT worktime FROM users WHERE id=$_SESSION[id]");
		$fetchasd = mysql_fetch_array($userWorkTime);
		if( mktime() < $fetchasd[worktime]+30)
			echo 'You can do this again after '.(($fetchasd[worktime]+30)-mktime()).' seconds';
		else
		{
			if( $_POST[workStr] )
			{
				if($_SESSION[energy] <= 4)
						echo 'You need more energy for this';
				else{
				$_SESSION[str]++;
				$_SESSION[energy] -= 5;
				$_SESSION[worktime] = mktime();
				mysql_query("UPDATE users SET str=$_SESSION[str] WHERE id=$_SESSION[id]");
				mysql_query("UPDATE users SET energy=$_SESSION[energy] WHERE id=$_SESSION[id]");
				mysql_query("UPDATE users SET worktime=$_SESSION[worktime] WHERE id=$_SESSION[id]");
				echo 'Your strength increased to '.$_SESSION[str];
				}
			}
			elseif( $_POST[workAgi] )
			{
				if($_SESSION[energy] <= 4)
						echo 'You need more energy for this';
				else{
				$_SESSION[agi]++;
				$_SESSION[energy] -= 5;
				$_SESSION[worktime] = mktime();
				mysql_query("UPDATE users SET agi=$_SESSION[agi] WHERE id=$_SESSION[id]");
				mysql_query("UPDATE users SET energy=$_SESSION[energy] WHERE id=$_SESSION[id]");
				mysql_query("UPDATE users SET worktime=$_SESSION[worktime] WHERE id=$_SESSION[id]");
				echo 'Your agility increased to '.$_SESSION[agi];
				}
			}
			elseif( $_POST[playChess] )
			{
				if($_SESSION[energy] <= 4)
						echo 'You need more energy for this';
				else{
				$_SESSION[intg]++;
				$_SESSION[energy] = $_SESSION[energy] - 5;
				$_SESSION[worktime] = mktime();
				mysql_query("UPDATE users SET intg=$_SESSION[intg] WHERE id=$_SESSION[id]");
				mysql_query("UPDATE users SET energy=$_SESSION[energy] WHERE id=$_SESSION[id]");
				mysql_query("UPDATE users SET worktime=$_SESSION[worktime] WHERE id=$_SESSION[id]");
				echo 'Your intelligent increased to '.$_SESSION[intg];
				}
			}
			else
			{
			echo '
			<form method="post">
			<table>
			<tr><td><center><img src="images/dumbbell.png" /></center></td>
			<td><img src="images/running.png" /></td>
			<td><center><img src="images/chess.png" /></center></td>
			</tr>
			<tr><td><input class="sbutton" type="submit" name="workStr" value="Work with dumbells" /></td>
			<td><input class="sbutton" type="submit" name="workAgi" value="Running band" /></td>
			<td><input class="sbutton" type="submit" name="playChess" value="Play Chess" /></td></tr>
			</table>
			</form>';
			}
		}
		echo '</div>';
?>