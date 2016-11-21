<?php
	echo '<div class="middiv">';
	if($_SESSION['team']!='None')
	{
		$selectTeam = mysql_query("SELECT * FROM teams WHERE name='$_SESSION[team]'");
		$fetchTeam = mysql_fetch_array($selectTeam);
		$hgf = $_SESSION[spec];
		if($_POST['invite'])
		{
			$gunman = mysql_query("SELECT spec FROM users WHERE username='$_POST[Gunman]'");
			if(mysql_num_rows($gunman) > 0)
				mysql_query("INSERT INTO teams (gunman) VALUES ('$_POST[Gunman]')");
		}
		echo 'You are in '.$_SESSION[team].' team<br>
		you can invite your friends to join your team<br><br>
		<form method="post">
		<table>
		<tr><td>Assault</td><td> : </td><td><input type="text" name="Gunman" style="background-color:transparent" /></td></tr>
		<tr><td>Cyber Crimes</td><td> : </td><td><input type="text" name="Cyber" style="background-color:transparent" /></td></tr>
		<tr><td>Bomb Expert</td><td> : </td><td><input type="text" name="Bomb" style="background-color:transparent" /></td></tr>
		<tr><td align="center" colspan="3"><br><input type="submit" class="sbutton" name="invite" value="Invite" /></td><tr>
		</table>
		</form>
		';
		
	}
	elseif($_POST[createTeam])
	{
		$selectTeams = mysql_query("SELECT * FROM teams WHERE name='$_POST[teamname]'");
		if(mysql_num_rows($selectTeams) > 0)
			echo 'There is a team with this name';
		elseif($_POST[teamname]=='')
			echo 'Please type some words';
		elseif($_POST[teamname]=='None')
			echo 'You can\'t do that';
		elseif($_SESSION[money] < 10000)
			echo 'You don\'t have enough money for that';
		else
		{
			$_SESSION['team'] = $_POST[teamname];
			$_SESSION[money] -= 10000;
			mysql_query("UPDATE users SET team='$_SESSION[team]' WHERE id=$_SESSION[id]");
			mysql_query("UPDATE users SET money='$_SESSION[money]' WHERE id=$_SESSION[id]");
			if($_SESSION['spec'] == 'Hacker' || $_SESSION['spec'] == 'Cyber')
				mysql_query("INSERT INTO teams (name,leader,hacker) VALUES ('$_SESSION[team]','$_SESSION[username]','$_SESSION[username]') ");
			elseif($_SESSION['spec'] == 'Assault' || $_SESSION['spec'] == 'Gunman')
				mysql_query("INSERT INTO teams (name,leader,assault) VALUES ('$_SESSION[team]','$_SESSION[username]','$_SESSION[username]') ");
			elseif($_SESSION['spec'] == 'BombDisposal' || $_SESSION['spec'] == 'BombExpert')
				mysql_query("INSERT INTO teams (name,leader,bomber) VALUES ('$_SESSION[team]','$_SESSION[username]','$_SESSION[username]') ");
			else
				mysql_query("INSERT INTO teams (name,leader,sniper) VALUES ('$_SESSION[team]','$_SESSION[username]','$_SESSION[username]') ");
				
				echo 'You created team '.$_SESSION[team];
	
					$news = $_SESSION['team'].' '.($_SESSION['side'] == 'P' ? 'team' : 'gang').' created by '.$_SESSION['username'];	
				
				mysql_query("INSERT INTO news (text,date) VALUES ('$news','$dateandtime')");
		}
	}
	elseif($_SESSION['team']=='None' && $_SESSION['spec']!='Beginner')
	{
		echo '
		<div>
		You can create a team by 10.000 $<br><br>
		<form method="post">
		<input type="text" name="teamname" size="10" style="background-color:transparent" /><br><br>
		<input class="sbutton" type="submit" name="createTeam" value="Create" />
		</form>
		</div>';
	}
	else
		echo 'You must choose a speciality first !';
	echo '</div>';
?>