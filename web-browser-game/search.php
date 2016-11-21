<?php
	echo '<div class="middiv">';
	if($_POST['searchuser'])
	{
		$srcusercheck = mysql_query("SELECT username FROM users WHERE username='$_POST[usersearch]'");
		$usernumrows = mysql_num_rows($srcusercheck);
		if($usernumrows > 0)
		{
			$srcuser = mysql_query("SELECT * FROM users WHERE username='$_POST[usersearch]'");
			$fsrcuser = mysql_fetch_array($srcuser);
			echo '
			<div style="position:absolute;top:-100px">
			<table class="middiv">
			<tr><td colspan="3"><img src="userpictures/'.$fsrcuser[userpicurl].'" /></td></tr>
			<tr><td>Username</td><td> : </td></td><td>'.$fsrcuser[username].'</td></tr>
			<tr><td>Side</td><td> : </td><td>'.($fsrcuser[side] == 'P' ? "Police" : "Mafia").'</td></tr>
			<tr><td>Level</td><td> : </td></td><td>'.$fsrcuser[lvl].'</td></tr>
			<tr><td>Team</td><td> : </td></td><td>'.$fsrcuser[team].'</td></tr>
			</table></div>
			';
		}
		else
			echo 'This username doesn\'t exist';
	}
	else
	{
		echo '
		<form method="post">
		Search User : <input style="background-color:transparent" type="text" name="usersearch" />
		<input class="sbutton" type="submit" name="searchuser" value="Search" />
		</form>
		';
	}
	echo '</div>';
?>