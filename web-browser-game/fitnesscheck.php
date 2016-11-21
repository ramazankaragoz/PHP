<?php
	include("config.php"); include("datadriven.php");
	$wtime = mysql_query("SELECT worktime FROM users WHERE id=$_SESSION[id]");
	$timefetch = mysql_fetch_array($wtime);
	$remainder = ( $timefetch[worktime] + 30 ) - mktime();
	if($remainder <= 0)
	{
		?>
	<script language="JavaScript">

	if (self == top) {
	self.location.href = 'index.php?page=fitness';
	}

	</script>
	<?php
	}
	else
		echo $remainder;
	
?>