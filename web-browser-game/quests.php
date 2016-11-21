<script>
	
	$(document).ready(function() {
		quests();
		var int=self.setInterval("quests()",750);
	});
	
	function quests(){
		$.ajax({
			type:'POST',
			url:'questscheck.php',
			success: function (msg) {
				$("#questscheck").html(msg);
			}
		});
	}
	
</script>

<?php
	$qtime = mysql_query("SELECT qtime FROM mquests WHERE id=$_SESSION[lastquest]");
	$qtim = mysql_fetch_array($qtime);
	$questime = mysql_query("SELECT questtime FROM users WHERE id=$_SESSION[id]");
	$questtime = mysql_fetch_array($questime);
	$timenow = mktime();
	$remainder = ( $questtime[questtime] + $qtim[qtime] ) - mktime();
	if($timenow <= $questtime[questtime] + $qtim[qtime])
	{
		echo '<div class="middiv">';
		echo 'You must wait <span id="questscheck">'.$remainder.'</span> seconds';
	}
	else
	{
		if($_GET[questid])
		{
			echo '<div class="middiv">';
			if($_SESSION[energy]<=5)
				echo 'You need more energy for this';
			else
			{
				if($_SESSION[side]=='P')
					$quest = mysql_query("SELECT * FROM pquests WHERE id=$_GET[questid]");
				else
					$quest = mysql_query("SELECT * FROM mquests WHERE id=$_GET[questid]");
						
				$getQuest = mysql_fetch_array($quest);
				
				$_SESSION[energy] -= 5;
				$_SESSION[questtime] = mktime();
				$_SESSION[energytime] = mktime();
				$_SESSION[lastquest] = $_GET[questid];
				
				mysql_query("UPDATE users SET energy=$_SESSION[energy] WHERE id=$_SESSION[id]");
				mysql_query("UPDATE users SET energytime=$_SESSION[energytime] WHERE id=$_SESSION[id]");
				mysql_query("UPDATE users SET questtime=$_SESSION[questtime] WHERE id=$_SESSION[id]");
				mysql_query("UPDATE users SET lastquest=$_SESSION[lastquest] WHERE id=$_SESSION[id]");
				
				$randpercent = rand(1,100);
				
				if( $randpercent <= $getQuest[percent] )
				{
					$_SESSION[expr] += $getQuest[qtime] / 100;
					$earnmoney = round($getQuest[qtime] * $getQuest[qtime]);
					$_SESSION[money] += $earnmoney;
					mysql_query("UPDATE users SET expr=$_SESSION[expr] WHERE id=$_SESSION[id]");
					mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
					echo 'You successed it and earned '.$earnmoney.'$ !';
				}
				else
				{
					echo 'You have failed!';
				}
			}
		}
		else
		{
			echo '
			<div style="position:absolute;left:6%">
			<form method="post">
			<table width="90%">
			<tr>
			';
			if($_SESSION[side]=='P')
				$quests = mysql_query("SELECT * FROM pquests");
			else
				$quests = mysql_query("SELECT * FROM mquests");
			
			while($row = mysql_fetch_array($quests))
				echo '
				<td>
				<a title="'.$row[subject].'" class="quests" href="index.php?page=quests&questid='.$row[id].'">
				<img title="'.$row[subject].'" src="images/'.$row[img].'" />
				</a>
				</td>';
				
			echo '</tr></table></form>';
					
		}
	}
	echo '</div>';
?>