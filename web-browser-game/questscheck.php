<?php
	include("config.php"); include("datadriven.php");
	$qtime = mysql_query("SELECT qtime FROM mquests WHERE id=$_SESSION[lastquest]");
	$qtim = mysql_fetch_array($qtime);
	$questime = mysql_query("SELECT questtime FROM users WHERE id=$_SESSION[id]");
	$questtime = mysql_fetch_array($questime);
	$timenow = mktime();
	$remainder = ( $questtime[questtime] + $qtim[qtime] ) - mktime();
	if($remainder <= 0)
	{
		?>
	<script language="JavaScript">
	if (self == top) {
	self.location.href = 'index.php?page=quests';
	}
	</script><?php
	}
	else
		echo $remainder;
	
?>