<html>
<script type="text/javascript">
      function toogle(btn){
         var chrproperties = document.getElementById('chrproperties');
		 var chrinventory = document.getElementById('chrinventory');
		 var chrtransport=document.getElementById('chrtransport');
		 
		 	switch(btn.value)
			{
				case 'Properties':
				chrinventory.style.display	=	'none';
				chrtransport.style.display  =	'none';
				chrproperties.style.display =   'block';
				break;
				case 'Inventory':
				chrproperties.style.display =   'none';
				chrtransport.style.display  =	'none';
				chrinventory.style.display	=	'block';
				break;
				case 'Transport':
				chrproperties.style.display =   'none';
				chrinventory.style.display	=	'none';
				chrtransport.style.display  =	'block';
				break;
				default:
				chrproperties.style.display =   'block';
				break;
			}
            

      }
   </script>
<?php

	$fetchreatthp = mysql_query("SELECT reattacknumber,hp from users WHERE id=$_SESSION[id]");
	$sessionreatthp = mysql_fetch_array($fetchreatthp);
	$_SESSION[reattacknumber] = $sessionreatthp[reattacknumber];
	$_SESSION[hp] = $sessionreatthp[hp];
	
	echo	'
		<div id="CharacterContent" > 
		<h1 class="PageTitle">Character</h1>
		<div class="character">
        <img src="userpictures/'.$_SESSION[userpicurl].'" />
		<div class="CharacterInf">
		 
        <div class="CharacterInfA">
		<table class="midtable">
			<tr><td>Character Name</td><td> : </td><td>'.$_SESSION[username].'</td></tr>
			<tr><td>'.($_SESSION["side"] == 'P' ? 'Team' : 'Gang').'</td><td> : </td><td>'.$_SESSION[team].'</td></tr>
			<tr><td>Level</td><td> : </td><td>'.$_SESSION[lvl].'</td></tr>
			<tr><td>Speciality</td><td> : </td><td>'.$_SESSION[spec].'</td></tr>
			<tr><td>Attacks</td><td> : </td><td>'.$_SESSION[attacknumber].'</td></tr>
			<tr><td>Received Attacks</td><td> : </td><td>'.$_SESSION[reattacknumber].'</td></tr>
			</table>
		</div>
		 
		<div class="charbutton">
		<table><tr>
		<td><input  class="sbutton" type="button" value="Properties" onclick="toogle(this)"/></td>
		  <td><input class="sbutton" type="button" value="Inventory" onclick="toogle(this)"/></td>
		  <td><input class="sbutton" type="button" value="Transport" onclick="toogle(this)"/></td>
		 </tr></table>
		 </div>
         <div class="CharacterInfB" id="chrproperties">
			<table class="midtable">
			<tr><td>Hp</td><td> : </td>
			<td>
			<div class="progress-bar" style=" width:100;">
			<div class="progress" style="width:'.$_SESSION[hp].'%;"><div class="progress-text">'.$_SESSION[hp].'%</div></div>
			</div></td></tr>
			
			<tr><td>Strength</td><td> : </td>
			<td>
			<div class="progress-bar-properties" style=" width:100;">
			<div class="progress-properties" style="width:'.$_SESSION[str].'%;"><div class="progress-text">'.$_SESSION[str].'%</div></div>
			</div>
			</td></tr>
			<tr><td>Agility</td><td> : </td><td><div class="progress-bar-properties" style=" width:100;">
			<div class="progress-properties" style="width:'.$_SESSION[agi].'%;"><div class="progress-text">'.$_SESSION[agi].'%</div></div>
			</div>
			</td></tr>
			<tr><td>Intelligence</td><td> : </td><td><div class="progress-bar-properties" style=" width:100;">
			<div class="progress-properties" style="width:'.$_SESSION[intg].'%;"><div class="progress-text">'.$_SESSION[intg].'%</div></div>
			</div></td></tr>
			</table>
		</div>
		<div class="inventory" id="chrinventory">';
		
		if($_SESSION['pistol'] == 'Deagle')
		{
			echo '<div>
			<img src="images/gun1.png" style="width:auto;height:auto" />
			</div>';
		}
		if($_SESSION['pistol'] == 'Glock')
		{
			echo '<div>
			<img src="images/gun2.png" style="width:auto;height:auto" />
			</div>';
		}
		
		if($_SESSION['rifle'] == 'Shotgun')
		{
			echo '<div>
			<img src="images/gun3.png" style="width:auto;height:auto" />
			</div>';
		}
		if($_SESSION['rifle'] == 'AK47')
		{
			if($_SESSION['side']=='M')
			{
			echo '<div>
			<img src="images/gun4.png" style="width:auto;height:auto" />
			</div>';
			}
			else
			{
			echo '<div>
			<img src="images/gun5.png" style="width:auto;height:auto" />
			</div>';	
			}
		}
		if($_SESSION['armor'] == 'HBV747')
		{
			echo '<div>
			<img src="images/vest1.png" style="width:auto;height:auto" />
			</div>';
		}
		if($_SESSION['armor'] == 'NTV500')
		{
			echo '<div>
			<img src="images/vest2.png" style="width:auto;height:auto" />
			</div>';
		}
		if($_SESSION['explosive'] == 'MCoctail')
		{
			echo '<div>
			<img src="images/molovcoctail.png" style="width:auto;height:auto" />
			</div>';
		}
		echo '<br>';
		if($_SESSION['explosive'] == 'grenade')
		{
			echo '<div>
			<img src="images/grenade.png" style="width:auto;height:auto" />
			</div>';
		}
		
		echo '</div>';      
      	
		echo '<div class="transport" id="chrtransport">';
		
		if($_SESSION['transport'] =='motorcycle')
		{
			if($_SESSION['side']=='M')
			{
			echo '<div>
			<img src="images/motorcycle.png" style="width:auto;height:auto" />
			</div>';
			}
			else
			{
			echo '<div>
			<img src="images/pmotorcycle.png" style="width:auto;height:auto" />
			</div>';	
			}
		}
		
		if($_SESSION['transport'] == 'car')
		{
			if($_SESSION['side']=='M')
			{
			echo '<div>
			<img src="images/car.png" style="width:auto;height:auto" />
			</div>';
			}
			else
			{
			echo '<div>
			<img src="images/pcar.png" style="width:auto;height:auto" />
			</div>';	
			}
		}
		
		if($_SESSION['transport'] == 'helicopter')
		{
			if($_SESSION['side']=='M')
			{
			echo '<div>
			<img src="images/helicopter.png" style="width:auto;height:auto" />
			</div>';
			}
			else
			{
			echo '<div>
			<img src="images/phelicopter.png" style="width:auto;height:auto" />
			</div>';	
			}
		}
		
		if($_SESSION['transport'] =='aircraft')
		{
			echo '<div>
			<img src="images/plane.png" style="width:auto;height:auto" />
			</div>';
		}
		
		if($_SESSION['transport'] =='cargoship')
		{
			echo '<div>
			<img src="images/cargoship.png" style="width:auto;height:auto" />
			</div>';
		}
		
		echo '</div>
		
		
		</div>
		
		</div>
		<div class="CharacterInfC"><br>
		<table cellpadding="30px" style="position:absolute;left:-29px;top:255px"><tr><td>
		<a class="editbutton" href="index.php?page=settings">Settings</a></td>
		<td>
        <a class="editbutton" href="index.php?page=edit">Edit</a></td></tr></table>
		</div>
		</div>';
		
		
?>
</html>