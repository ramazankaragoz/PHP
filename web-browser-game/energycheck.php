<?php
include("config.php"); include("datadriven.php");
if( mktime() >= ($_SESSION[energytime] + $energyrestime) )
		{
			if($_SESSION[energy] < 100)
			{
			$comingenergy = ( mktime() - $_SESSION[energytime] ) / $energyrestime;
			$_SESSION[energy] += $comingenergy;
			$_SESSION[energytime] = mktime();
			mysql_query("UPDATE users SET energy=$_SESSION[energy] WHERE id=$_SESSION[id]");
			mysql_query("UPDATE users SET energytime=$_SESSION[energytime] WHERE id=$_SESSION[id]");
				if($_SESSION[energy] > 100)
				{
					$_SESSION[energy] = 100;
					mysql_query("UPDATE users SET energy=$_SESSION[energy] WHERE id=$_SESSION[id]");
				}
			}
		}
echo floor($_SESSION[energy]);

?>