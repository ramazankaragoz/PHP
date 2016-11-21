<style>
#smugglingcontent
{
	position:relative;
	width:auto;
	height:auto;
	margin-top:-15%;
	margin-left:-25%;	
}
.smugglingbar
{
	background:#333;
	width:80%;
	height:3%;
	border:1px solid #000;
	border-radius:3%;
	padding:7px;
	color:#FFF;
	
	
}
.narcotictop
{
	background:#333;
	width:10%;
	height:10%;
	border:1px solid #000;
	float:left;
	
}
.narcoticalt:hover
{
	cursor:default;
	color:white;
	background-color:black;
	
}
.narcoticalt
{
	background:#333;
	width:10%;
	height:10%;
	border:1px solid #000;
	float:left;
	color:#FFF;
	text-align:center;
	opacity: 0.91;
	

}
.narcoclear
{	
	width:10%;
	height:10%;
	border:1px solid #999;
	
	
}
.narcospan
{
	background:#666;
	width:80%;
	height:80%;
	margin-top:5%;
	margin-bottom:5%;
	margin-right:5%;
	margin-left:5%;
	border-radius:20%;
	border:1px solid #999;
	text-align:center;
	color:#FFF;
	line-height:-10px;
	
}
.inputnarco
{
	background:#000;
	width:80%;
	margin-top:5%;
	margin-bottom:5%;
	margin-right:5%;
	margin-left:5%;
	border-radius:15%;
	border:1px solid #999;
	text-align:center;
	color:#FFF;
}
.submitnarco
{
	background:#666;
	margin-left:40%;
	width:20%;
	height:130%;
	border-radius:25%;
	border:1px solid #000;
	text-align:center;
	color:#FFF;
	cursor:pointer;
}
.warehousebar
{
	background:#333;
	width:100%;
	height:3%;
	margin-left:-25%;
	border:1px solid #000;
	border-radius:3%;
	padding:7px;
	color:#FFF;
}
.smuggtransport
{
	background:#333;
	width:100%;
	height:auto;
	margin-left:-25%;
	border:1px solid #000;
	border-radius:1%;
	padding:7px;
	color:#FFF;
	opacity: 0.91;
	text-align:center;
}
.policesmugg
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
.policesmugg img
{
	opacity:0.8;
	border:1px solid #000;
}
</style>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    sendsmugg();
    var int=self.setInterval("sendsmugg()",1000);
});
 
function sendsmugg(){
    $.ajax({
        type:'POST',
        url:'smugglingcheck.php',
        success: function (msg) {
            $("#smugg").html(msg);
        }
    });
}

</script>
<?php

?>
<div id="smugglingcontent">
		 <h1 class="PageTitle">Smuggling</h1>
		 <div class="smugglingbar"><b>Narcotic And Alcohol Smuggling</b></div>
		 <div class="policesmugg"><img src="images/drug.jpg"/></div>
</div>
<br><div class="warehousebar"><b>Transport</b></div>
<div class="smuggtransport">		
<?php
		$vehiclesoption = explode("_",$_POST['vehicles']);
		$vehiclesoption_id = $vehiclesoption[0];

		$squery = mysql_query("SELECT * FROM smuggling WHERE name='$_SESSION[transport]'");
		$sfetch = mysql_fetch_array($squery);
		$timenow = mktime();
		$stotaltime=$sfetch[transtime]+($sfetch[carry]*$sfetch[speed]);
		
		$remaindersecond = $_SESSION[smuggtime] + $stotaltime - $timenow;
		$remainderminute =$remaindersecond / 60;
		$remainderhour = $remainderminute / 60 ;
		$minute=$remainderminute%60;
		$second=$remaindersecond%60;
		
		if($timenow <= $_SESSION[smuggtime] + $stotaltime)
		{
			echo 'You must wait '.floor($remainderhour).':'.floor($minute).':'.floor($second).'';
		}
		else
		{
		?>

        <form method="post">
		<label > Vehicle : </label>
 	    <select name="vehicles">
    	<option value="0_vehicle">Select Vehicle</option>
     	<option value="1_motor">Motorcycle</option>
     	<option value="2_car">Car</option>
        <option value="3_hel">Helicopter</option>
		<option value="4_air">Aircraft</option>
		<option value="5_cargo">Cargoship</option>
		</select>
		<input type="submit" value="Send" name="submitsmugg" class="submitsmugg"/><br><br>
		</form>
        	
		
		<?php
		if($_POST["submitsmugg"])
		 {
			 	$randomitem=rand(1,16);
				$smuggitemquery=mysql_query("SELECT * FROM smugglingitems WHERE id=$randomitem");
				$itemfetch=mysql_fetch_array($smuggitemquery);
				
				if($vehiclesoption_id)
				{
					$selectitem = mysql_query("SELECT * FROM smuggling WHERE id=$vehiclesoption_id");
			 		$fetchitem = mysql_fetch_array($selectitem);
					if($_SESSION['transport']==$fetchitem['name'])
					{
						if($_SESSION[energy]>25)
						{
							if($_SESSION[money]>= $fetchitem[cost])
							{
								$_SESSION[smuggtime]=mktime();
								$_SESSION[energy] -= 25;
								$_SESSION[energytime] = mktime();
								mysql_query("UPDATE users SET energytime=$_SESSION[energytime] WHERE id=$_SESSION[id]");
								mysql_query("UPDATE users SET energy='$_SESSION[energy]' WHERE id='$_SESSION[id]'");
								mysql_query("UPDATE users SET smuggtime='$_SESSION[smuggtime]' WHERE id='$_SESSION[id]'");
								$_SESSION[expr] +=($expsmugg) / $_SESSION[lvl];
								mysql_query("UPDATE users SET expr='$_SESSION[expr]' WHERE id='$_SESSION[id]'");
								$_SESSION[money] -= $fetchitem[cost];
								mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
								$income=$fetchitem[carry]*$itemfetch[income];
								if($_SESSION[side]=='M')
								{
									$smessagge='You sold '.$fetchitem[carry].' unit '.$itemfetch[name].' and your income is '.number_format($income).' $';	
								}
								else
								{
									$smessagge='You busted '.$fetchitem[carry].' unit '.$itemfetch[name].' from raid.Congratulations you earned '.number_format($income).' $';
								}
								$dateandtime = date("d/m/y & H:i:s");
								mysql_query("INSERT INTO messages (sender,receiver,topic,message,time) VALUES ('System','$_SESSION[username]','SMUGGLİNG','$smessagge','$dateandtime')");
								$_SESSION[money]+=$income;
								mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
								header("refresh:3;url=index.php?page=messages");
								
							}
							else
								echo $fetchitem[cost].'$ required for this';
						}
						
						else
							echo 'You are too tired.';							
					}
					else
						echo $fetchitem[name].' required for this';
				}
		 }
		}
					
?>	
</div>	