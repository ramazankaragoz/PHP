<?php

$choosemap = mysql_query("SELECT * FROM map");

if($_GET[area])
{
	$areaquery = mysql_query("SELECT * FROM map WHERE id=$_GET[area]");
	$areafetch = mysql_fetch_array($areaquery);
	if($_SESSION['team'] == 'None')
		echo 'You must have a team for this';
	elseif($areafetch['owner'] != $_SESSION['team'] && $areafetch['owner'] != 'Ownerless')
		echo 'This area is not yours!';
	elseif($_SESSION[area] != 0)
		echo 'You have already have an area!';
	elseif($areafetch['owner'] == $_SESSION['team'])
		echo 'This area is incomes you '.$areafetch[income].'$ every hour.';
	else
	{
		if($_POST[buyarea])
		{
			if($_SESSION[money] < $areafetch[cost])
				echo 'You don\'t have enough money for this';
			else
			{
				$_SESSION[money] -= $areafetch[cost];
				$_SESSION[area] = $_GET[area];
				$incometime = mktime();
				$dateandtime = date("d/m/y & H:i:s");
				$news=$areafetch['name'].' area has been bought by '.$_SESSION['team'];
				mysql_query("INSERT INTO news (text,date) VALUES ('$news','$dateandtime')");
				mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
				mysql_query("UPDATE users SET area=$_SESSION[area] WHERE id=$_SESSION[id]");
				mysql_query("UPDATE map SET owner='$_SESSION[team]' WHERE id=$_GET[area]");
				mysql_query("UPDATE map SET incometime=$incometime WHERE id=$_GET[area]");
				echo 'You bought this area';
			}
		}
		else
		{
		echo 'You can buy this area for '.$areafetch[cost].'$
		<form method="post">
		<input class="sbutton" type="submit" name="buyarea" value="Buy Area" />
		</form>';
		}
	}
}
else
{
echo '<div style="position:relative;margin-top:-15%;margin-left:-15%;height:422px;width:750px;
background-image:url(images/map1.jpg);
background-size: 750px 422px;background-repeat: no-repeat;opacity:0.80">';
while($row = mysql_fetch_array($choosemap))
{
	 echo'
	 <a href="index.php?page=map&area='.$row[id].'" >
	 <div id="areas" title="'.$row[owner].'\'s area '.$row[name].'" style="height:'.$row[height].'px;
	 width:'.$row[width].'px;right:'.$row[mright].'px;bottom:'.$row[mbottom].'px;
	 border-radius:'.$row[r].'px;background-color:'.$row[color].';">
	 </div>
	 </a>';
}
echo '</div>';
}

?>