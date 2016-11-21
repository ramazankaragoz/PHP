<?php
	echo '<div class="middiv">';
	if($_SESSION[lvl] < 5)
	{
		echo 'You must be Level 5 for choosing a speciallity.!';
	}
	else
	{
		if($_SESSION['spec']=='Beginner')
		{
			$choiceSpec = $_GET["choice"];
			if($choiceSpec)
			{
				if($_POST["specyes"])
				{
					$_SESSION['spec']=$choiceSpec;
					mysql_query("UPDATE users SET spec='$_SESSION[spec]' WHERE id=$_SESSION[id]");
					echo 'Your speciallity is '.$choiceSpec.' now!';
				}
				elseif($_POST["specno"])
				{
					header("location:index.php?page=spec");
				}
				else
				{
					echo 'Are you sure for choosing '.$choiceSpec.'?<br>
					<form method="post">
					<input type="submit" name="specyes" value="Yes" />
					<input type="submit" name="specno" value="No" />
					</form>
					';
				}
			}
			else
			{
				if($_SESSION["side"] == 'P')
				{
					echo '
					<a href="index.php?page=spec&choice=Assault">Assault</a><br>
					<a href="index.php?page=spec&choice=CyberCrimes">Cyber Crimes</a><br>
					<a href="index.php?page=spec&choice=BombDisposal">Bomb Disposal</a><br>
					<a href="index.php?page=spec&choice=Sniper">Sniper</a>';
				}
				else
				{
					echo '
					<a href="index.php?page=spec&choice=Gunman">Gunman</a><br>
					<a href="index.php?page=spec&choice=Hacker">Hacker</a><br>
					<a href="index.php?page=spec&choice=BombExpert">Bomb Expert</a><br>
					<a href="index.php?page=spec&choice=DeadShot">Dead Shot</a>';
				}
			}
		}
		else
		{
			if($_SESSION[specexp] >= $_SESSION[speclvl] * ($_SESSION[speclvl]/2) * 250)
			{
				$_SESSION[speclvl]++;
				mysql_query("UPDATE users SET speclvl=$_SESSION[speclvl] WHERE id=$_SESSION[id]");
			}
			if($_POST['spec1'])
				{
					$_SESSION[energy] -= 5;
					$_SESSION[money] -= ($_SESSION[speclvl] * ($_SESSION[speclvl]/2) * 50);
					$_SESSION[specexp] += 50;
					mysql_query("UPDATE users SET energy=$_SESSION[energy] WHERE id=$_SESSION[id]");
					mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
					mysql_query("UPDATE users SET specexp=$_SESSION[specexp] WHERE id=$_SESSION[id]");
					header("location:index.php?page=spec");
				}
			echo 'Your spec '.$_SESSION["spec"].' and you can do some quests for improving your speciality level<br><br>
			Your Speciality level is '.$_SESSION[speclvl].' now and experience is '.$_SESSION[specexp];
			echo '<br><br><form method="post">';
			if($_SESSION['spec']=='BombExpert' || $_SESSION['spec']=='BombDisposal')
			{
					echo ($_SESSION['side'] == 'M'? 'Make' : 'Disposal').' some bombs and improve your speciality '.($_SESSION[speclvl] * ($_SESSION[speclvl]/2) * 50).' $!
					<br><br><center><input class="sbutton" type="submit" name="spec1" value="'.($_SESSION['side'] == 'M'? 'Make' : 'Disposal').' Bomb" /></center>
					';
			}
			elseif($_SESSION['spec']=='Assault' || $_SESSION['spec']=='Gunman')
			{
					echo  'Shoot some target and improve your speciality '.($_SESSION[speclvl] * ($_SESSION[speclvl]/2) * 50).' $!
					<br><br><center><input class="sbutton" type="submit" name="spec1" value="Shoot" /></center>
					';
			}
			elseif($_SESSION['spec']=='Cybercrimes' || $_SESSION['spec']=='Hacker')
			{
					echo ($_SESSION['side'] == 'M'? 'Hack' : 'Defend').' some systems and improve your speciality '.($_SESSION[speclvl] * ($_SESSION[speclvl]/2) * 50).' $!
					<br><br><center><input class="sbutton" type="submit" name="spec1" value="'.($_SESSION['side'] == 'M'? 'Hack' : 'Defend').' system" /></center>
					';
			}
			else
			{
					echo 'Shoot some target from far away and improve your speciality for '.($_SESSION[speclvl] * ($_SESSION[speclvl]/2) * 50).' $!
					<br><br><center><input class="sbutton" type="submit" name="spec1" value="Shoot" /></center>
					';
			}
		}
			echo'</form>';
	}
	echo '</div>';
?>