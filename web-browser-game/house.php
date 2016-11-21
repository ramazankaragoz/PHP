<html>
<style>
#housecontent
{
	position:relative;
	width:auto;
	height:auto;
	margin-top:-15%;
	margin-left:-25%;	
}
.housebar
{
	background:#333;
	width:80%;
	height:3%;
	border:1px solid #000;
	border-radius:3%;
	padding:7px;
	color:#FFF;	
}
.house
{
	background:#333;
	width:80%;
	height:70%;
	margin-right:-25%;
	border:1px solid #000;
	border-radius:1%;
	padding:7px;
	color:#FFF;
	text-align:center;
}
.house img
{
	width:100%;
	height:100%;
}
.houseobjects
{
	background:#333;
	width:80%;
	height:auto;
	margin-right:-25%;
	border:1px solid #000;
	border-radius:1%;
	padding:7px;
	color:#FFF;
	text-align:center;
}
a 
{
    color: red;
    text-align: center;
    text-decoration: none;
}
</style>
<body>
	<div id="housecontent">
    <div class="housebar"><b>House</b></div>
    <div class="house"><img src="images/house.png"/></div>
    <br><div class="housebar"><b>Objects</b></div>
	<div class="houseobjects">
    <form method="post">
		<table style="color:#FFF;text-align:left;">
		<tr><td><img src="images/watchdog.png" /></td>
		<td><label>Watchdog: Protects you from enemies! Giving two attack and five deffence.</label></td>
		<td><label>10.000 $ </label></td>
		<td><a href="index.php?page=house&buyitem=watchdog" class="diswatchdog">Buy</a></td>
        <?php 
						if($_SESSION[watchdog] == 1)
			{
			?>
            	<td><a href="index.php?page=house&sellitem=watchdog">Sell</a></td>
                <style type="text/css">
				.diswatchdog
				{
				cursor: default;
				pointer-events: none;
				color: #c0c0c0;
				background-color: #ffffff;
				}
				
				</style>
            <?php
			}
			?>
		</tr>
        <tr><td><img src="images/scamera.png" /></td>
		<td><label>Security Cameras: Deter enemies! Giving ten deffence.</label></td>
		<td><label>25.000 $ </label></td>
		<td><a href="index.php?page=house&buyitem=scamera" class="disscamera">Buy</a></td>
        <?php 
						if($_SESSION[scamera] == 1)
			{
			?>
            	<td><a href="index.php?page=house&sellitem=scamera">Sell</a></td>
                <style type="text/css">
				.disscamera
				{
				cursor: default;
				pointer-events: none;
				color: #c0c0c0;
				background-color: #ffffff;
				}
				
				</style>
            <?php
			}
			?>
		</tr>
        <tr><?php if($_SESSION[side] == 'M'){?>
		<td><img src="images/mguard.png" /></td>
        <?php } else { ?><td><img src="images/pguard.png" /></td><?php } ?>
		<td><label>Security Guard: Protects you from enemies! Giving twenty deffence and five attack.</label></td>
		<td><label>100.000 $ </label></td>
		<td><a href="index.php?page=house&buyitem=guard" class="disguard">Buy</a></td>
        <?php 
						if($_SESSION[guard] == 1)
			{
			?>
            	<td><a href="index.php?page=house&sellitem=guard">Sell</a></td>
                <style type="text/css">
				.disguard
				{
				cursor: default;
				pointer-events: none;
				color: #c0c0c0;
				background-color: #ffffff;
				}
				
				</style>
            <?php
			}
			?>
		</tr>
		</table>
	</form>
    </div>
    <br />
    <br />
    <br />	
    </div>

<?php
	 
	 $getitem = $_GET[buyitem];
	 $sellitem = $_GET[sellitem];			 
	 if(isset($_GET[buyitem]))
	 {
		 $selectitem = mysql_query("SELECT * FROM shop WHERE name='$_GET[buyitem]'");
		 $fetchitem = mysql_fetch_array($selectitem);
		 if($_SESSION[money] >= $fetchitem[value])
		 {
		 $_SESSION[money]-=$fetchitem[value];
		 mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
		 $_SESSION[def]-=$fetchitem[def];
		 $_SESSION[att]-=$fetchitem[att];
		 mysql_query("UPDATE users SET def=$_SESSION[def] WHERE id=$_SESSION[id]");
		 mysql_query("UPDATE users SET att=$_SESSION[att] WHERE id=$_SESSION[id]");
		 $_SESSION[$getitem]=1;
		 mysql_query("UPDATE users SET $getitem=$_SESSION[$getitem] WHERE id=$_SESSION[id]");
		 header("refresh:0;url=index.php?page=house");
		 }
		 else
		 {
			 echo 'You do not have enough money.';
		 }
	 }
	 
	 if(isset($_GET[sellitem]))
	 {
		 $selectitem = mysql_query("SELECT * FROM shop WHERE name='$_GET[sellitem]'");
		 $fetchitem = mysql_fetch_array($selectitem);
		 
		 $_SESSION[money]+=($fetchitem[value]*0.75);
		 mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
		 $_SESSION[def]-=$fetchitem[def];
		 $_SESSION[att]-=$fetchitem[att];
		 mysql_query("UPDATE users SET def=$_SESSION[def] WHERE id=$_SESSION[id]");
		 mysql_query("UPDATE users SET att=$_SESSION[att] WHERE id=$_SESSION[id]");
		 $_SESSION[$sellitem]=0;
		 mysql_query("UPDATE users SET $sellitem=$_SESSION[$sellitem] WHERE id=$_SESSION[id]");
		 header("refresh:0;url=index.php?page=house");
	 }
	 
?>
</body>
</html>