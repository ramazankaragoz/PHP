<html>
<style>
a
{
	color: red;
    text-align: center;
    text-decoration: none;
}
ul, li 
{
	padding:0;
 	list-style:none; 
	font-weight:bold;
	}
ul  li 
{
	position:relative;
	width:100%;
	height:8%;
	color:white;
	text-decoration:none;
	cursor:pointer;
	
}
ul li:hover
{
	color:black;
	background-color:white;
}
ul li:active {
    color: red;
}
ol
{
	padding:0;
 	list-style:none; 
}
.la
{
	padding:0;
 	list-style:none; 
	font-weight:normal;
	margin-top:5px;
	
}
.smallarms
{
	position:relative;
	width:auto;
	height:auto;
	margin: -20% auto;
	display:flex;
	justify-content: center;
	margin-left:25%	;
}
.weaponsh
{
	display:none;
	position:relative;
	width:auto;
	height:auto;
	margin: -20% auto;
	justify-content: center;
	margin-left:25%	;

}
.weaponss
{
	display:none;
	position:relative;
	width:auto;
	height:auto;
	margin: -20% auto;
	justify-content: center;
	margin-left:25%	;

}
.vests
{
	display:none;
	position:relative;
	width:auto;
	height:auto;
	margin: -20% auto;
	justify-content: center;
	margin-left:25%	;

}
.granadef
{
	display:none;
	position:relative;
	width:auto;
	height:auto;
	margin: -20% auto;
	justify-content: center;
	margin-left:25%	;

}
.molotovc
{
	display:none;
	position:relative;
	width:auto;
	height:auto;
	margin: -20% auto;
	justify-content: center;
	margin-left:25%	;
}
</style>
<script type="text/javascript">

      function toogle(btn){
       
		 		var equipmentshop = document.getElementById('equipmentshop');
		 		var requisitesshop = document.getElementById('requisitesshop');
		 		var transportshop=document.getElementById('transportshop');
			    var bodyguardsshop=document.getElementById('bodyguardsshop');
		 		var supportteamshop=document.getElementById('supportteamshop');
				
				var armssmall=document.getElementById('armssmall');
				var hweapons=document.getElementById('hweapons');
				var	sweapons=document.getElementById('sweapons');
				var svest=document.getElementById('svest');
				var fgrenade=document.getElementById('fgrenade');
				var molotov=document.getElementById('molotov');
				
		 	switch(btn.value)
			{
				case 'Equipment':
				requisitesshop.style.display ='none';
				transportshop.style.display  =	'none';
				bodyguardsshop.style.display =	'none';
				supportteamshop.style.display  ='none';
				equipmentshop.style.display =   'block';
				armssmall.style.display =   'flex';
				break;
				case 'Requisites':
					hweapons.style.display =   'none';
					sweapons.style.display =   'none';
					svest.style.display =   'none';
					fgrenade.style.display =   'none';
					molotov.style.display =   'none';
					armssmall.style.display =   'none';
				transportshop.style.display  =	'none';
				bodyguardsshop.style.display  =	'none';
				supportteamshop.style.display  =	'none';
				equipmentshop.style.display =   'none';
				requisitesshop.style.display	=	'block';
				break;
				case 'Transport':
					hweapons.style.display =   'none';
					sweapons.style.display =   'none';
					svest.style.display =   'none';
					fgrenade.style.display =   'none';
					molotov.style.display =   'none';
					armssmall.style.display =   'none';
				bodyguardsshop.style.display  =	'none';
				supportteamshop.style.display  =	'none';
				equipmentshop.style.display =   'none';
				requisitesshop.style.display	=	'none';
				transportshop.style.display  =	'block';
				break;
				case 'Support Team':
					hweapons.style.display =   'none';
					sweapons.style.display =   'none';
					svest.style.display =   'none';
					fgrenade.style.display =   'none';
					molotov.style.display =   'none';
					armssmall.style.display =   'none';
				bodyguardsshop.style.display  =	'none';
				equipmentshop.style.display =   'none';
				requisitesshop.style.display	=	'none';
				transportshop.style.display  =	'none';
				supportteamshop.style.display  =	'block';
				break;
				case 'Bodyguards':
					hweapons.style.display =   'none';
					sweapons.style.display =   'none';
					svest.style.display =   'none';
					fgrenade.style.display =   'none';
					molotov.style.display =   'none';
					armssmall.style.display =   'none';
				equipmentshop.style.display =   'none';
				requisitesshop.style.display	=	'none';
				transportshop.style.display  =	'none';
				supportteamshop.style.display  =	'none';
				bodyguardsshop.style.display  =	'block';
				break;
				default:
				equipmentshop.style.display =   'block';
				break;
			}
			
	  }
			
			function equipment(str)
			{
				var armssmall=document.getElementById('armssmall');
				var hweapons=document.getElementById('hweapons');
				var	sweapons=document.getElementById('sweapons');
				var svest=document.getElementById('svest');
				var fgrenade=document.getElementById('fgrenade');
				var molotov=document.getElementById('molotov');
				
				switch(str.id)
				{
					case 'SmallArms':
					hweapons.style.display =   'none';
					sweapons.style.display =   'none';
					svest.style.display =   'none';
					fgrenade.style.display =   'none';
					molotov.style.display =   'none';
					armssmall.style.display =   'flex';
					break;
					case 'HeavyWeapons':
					sweapons.style.display =   'none';
					svest.style.display =   'none';
					fgrenade.style.display =   'none';
					molotov.style.display =   'none';
					armssmall.style.display =   'none';
					hweapons.style.display =   'flex';
					break;
					case 'SpecialWeapons':
					hweapons.style.display =   'none';
					svest.style.display =   'none';
					fgrenade.style.display =   'none';
					molotov.style.display =   'none';
					armssmall.style.display =   'none';
					sweapons.style.display =   'flex';
					break;
					case 'SteelVest':
					hweapons.style.display =   'none';
					svest.style.display =   'none';
					fgrenade.style.display =   'none';
					molotov.style.display =   'none';
					armssmall.style.display =   'none';
					sweapons.style.display =   'none';
					svest.style.display =   'flex';
					break;
					case 'Frag':
					hweapons.style.display =   'none';
					svest.style.display =   'none';
					molotov.style.display =   'none';
					armssmall.style.display =   'none';
					sweapons.style.display =   'none';
					fgrenade.style.display =   'flex';
					break;
					case 'Molotov':
					hweapons.style.display =   'none';
					svest.style.display =   'none';
					fgrenade.style.display =   'none';
					armssmall.style.display =   'none';
					sweapons.style.display =   'none';
					molotov.style.display =   'flex';
					break;
					default:
					armssmall.style.display =   'flex';
					break;
					
				}
				
			}
            
 </script>
   
<body>
<!--/*Shop Content*/ 
--><div id="shopcontent">
	  <h1 class="PageTitle">Shop</h1>
<!--	  /*Shop*/
-->		<div id="shop">
<!--	  /*Shop Menu İtems*/		
-->		<div class="shopmenu">
	  <table><tr>
		  <td><input type="button" value="Equipment" onClick="toogle(this)"/></td>
		  <td><input type="button" value="Transport" onClick="toogle(this)"/></td>
		  <td><input type="button" value="<?php echo($_SESSION["side"] == 'P' ? 'Support Team' : 'Bodyguards'); ?>" onClick="toogle(this)"/></td>
		 </tr></table>
	  </div>
	  
	  <div class="shopequipment"   id="equipmentshop">
	  <table>
	  <tr><td><ul>Weapons
	  <li  id="SmallArms"      onclick="equipment(this)">Small Arms</li>
	  <li  id="HeavyWeapons"   onclick="equipment(this)">Heavy Weapons</li>
	  </ul></td></tr>
	  
	  <tr><td><ul>Body Armour 
	  <li id="SteelVest" onClick="equipment(this)">Steel Vest</li>
	  </ul></td></tr>
	  
	  <tr><td><ul>Explosives
	  <li id="Frag" onClick="equipment(this)">Fragmentation Grenade</li>
	  <li id="Molotov" onClick="equipment(this)">Molotov cocktail</li>
	  </ul></td></tr>
	  
	  </table>
	  </div>
	  
	  <div class="shoprequisites"  id="requisitesshop">
	  <table>
	  <tr><td></td></tr>
	  <tr><td></td></tr>
	  <tr><td> </td></tr>
	  </table>
	  </div>
	  
<!--	  /* Transport Section */
-->	  
	  <div class="shoptransport"   id="transportshop">
	  <div>
      <br />
	  <form method="post">
	  <table class="midtable">
	  <td ><img <?php if($_SESSION['side']=='M') echo 'src="images/motorcycle.png"'; else echo 'src="images/pmotorcycle.png"';?> /></td>
	  <td><li class="la">Name:VX-8</li>
      <li class="la">Type:<?php if($_SESSION['side']=='M') echo 'Motorcycle'; else echo 'Police Motorcycle';?> </li>
      <li class="la">Speed:120 km</li></td>
      <td> </td>
	  <td>50.000 $</td>
	  <td><a  href="index.php?page=shop&item=motorcycle" class="dismtr">Buy</a><td>
      <?php 
						if($_SESSION['transport']=='motorcycle')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=motorcycle">Sell</a></td>
                <style type="text/css">
				.dismtr,.discar,.dishel,.disair,.discargo
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
	  
	  <div>
	  <form method="post">
	  <table class="midtable">
	  <td><img <?php if($_SESSION['side']=='M') echo 'src="images/car.png"'; else echo 'src="images/pcar.png"';?> /></td>
	  <td><li class="la">Name:<?php if($_SESSION['side']=='M') echo 'X7 Jeep'; else echo 'Mustang';?> </li>
      <li class="la">Type:<?php if($_SESSION['side']=='M') echo 'Car'; else echo 'Police Car';?> </li>
      <li class="la">Speed:240 km</li></td>
      <td> </td>
	  <td>100.000 $</td>
	  <td><a href="index.php?page=shop&item=car" class="discar">Buy</a><td>
      <?php 
						if($_SESSION['transport']=='car')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=car">Sell</a></td>
                <style type="text/css">
				.dismtr,.discar,.dishel,.disair,.discargo
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
	  
	  <div>
	  <form method="post">
	  <table class="midtable">
	  <td><img <?php if($_SESSION['side']=='M') echo 'src="images/helicopter.png"'; else echo 'src="images/phelicopter.png"';?> /></td>
	  <td><li class="la">Name:F-240x </li>
      <li class="la">Type:<?php if($_SESSION['side']=='M') echo 'Helicopter'; else echo 'Police Helicopter';?> </li>
      <li class="la">Speed:350 km</li></td>
      <td> </td>
	  <td>250.000 $</td>
	  <td><a href="index.php?page=shop&item=helicopter" class="dishel">Buy</a><td>
      <?php 
						if($_SESSION['transport']=='helicopter')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=helicopter">Sell</a></td>
                <style type="text/css">
				.dismtr,.discar,.dishel,.disair,.discargo
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
	  
	  <div>
	  <form method="post">
	  <table class="midtable">
	  <td><img src="images/plane.png" /></td>
	  <td><li class="la">Name:B-47 </li>
      <li class="la">Type:Aircraft </li>
      <li class="la">Speed:550 km</li></td>
      <td> </td>
	  <td>500.000 $</td>
	  <td><a href="index.php?page=shop&item=aircraft" class="disair">Buy</a><td>
      <?php 
						if($_SESSION['transport']=='aircraft')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=aircraft">Sell</a></td>
                <style type="text/css">
				.dismtr,.discar,.dishel,.disair,.discargo
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
	  
	  <div>
	  <form method="post">
	  <table class="midtable">
	  <td><img src="images/cargoship.png" /></td>
	  <td><li class="la">Name:Rico-7 </li>
      <li class="la">Type:Cargoship </li>
      <li class="la">Speed:950 sm</li></td>
      <td> </td>
	  <td>1.000.000 $</td>
	  <td><a href="index.php?page=shop&item=cargoship" class="discargo">Buy</a><td>
      <?php 
						if($_SESSION['transport']=='cargoship')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=cargoship">Sell</a></td>
                <style type="text/css">
				.dismtr,.discar,.dishel,.disair,.discargo
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
	  
	  </div>
<!--	  /* end Transport...*/
-->	  
		<!--Bodyguard Section-->
	  <div class="shopbodyguards"  id="bodyguardsshop">
      <form method="post">
	  <table class="midtable">
	  <tr><td><img src="images/bd3.png" style="width:40%;height:40%" /></td>
      <td><label>Name:AliChan</label></td>
      <td></td>
	  <td><label>50.000 $ </label></td>
	  <td><a href="index.php?page=shop&item=AliChan" class="disali">Buy</a></td>
      <?php 
						if($_SESSION['bg']=='AliChan')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=AliChan">Sell</a></td>
                <style type="text/css">
				.disali,.disveli,.dispolat
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
      
	  <tr><td><img src="images/bd1.png" style="width:50%;height:50%" /></td>
      <td><label>Name:VeliChan</label></td>
      <td></td>
	  <td><label>250.000 $ </label></td>
	  <td><a href="index.php?page=shop&item=VeliChan" class="disveli">Buy</a></td>
      <?php 
						if($_SESSION['bg']=='VeliChan')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=VeliChan">Sell</a></td>
                <style type="text/css">
				.disali,.disveli,.dispolat
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
      
	  <tr><td><img src="images/bd2.png" style="width:50%;height:50%" /></td>
      <td><label>Name:PolatChan</label></td>
      <td></td>
	  <td><label>1.000.000 $ </label></td>
	  <td><a href="index.php?page=shop&item=PolatChan" class="dispolat">Buy</a></td>
      <?php 
						if($_SESSION['bg']=='PolatChan')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=PolatChan">Sell</a></td>
                <style type="text/css">
				.disali,.disveli,.dispolat
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
	  
	  <div class="shopsupportteam" id="supportteamshop">
	  <form method="post">
	  <table class="midtable">
	  <tr><td><img src="images/p1.png" style="width:40%;height:40%" /></td>
      <td><label>Name:Police1</label></td>
      <td></td>
	  <td><label>50.000 $ </label></td>
	  <td><a href="index.php?page=shop&item=AliChan" class="disali">Buy</a></td>
      <?php 
						if($_SESSION['bg']=='AliChan')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=AliChan">Sell</a></td>
                <style type="text/css">
				.disali,.disveli,.dispolat
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
      
	  <tr><td><img src="images/p2.png" style="width:50%;height:50%" /></td>
      <td><label>Name:Police2</label></td>
      <td></td>
	  <td><label>250.000 $ </label></td>
	  <td><a href="index.php?page=shop&item=VeliChan" class="disveli">Buy</a></td>
      <?php 
						if($_SESSION['bg']=='VeliChan')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=VeliChan">Sell</a></td>
                <style type="text/css">
				.disali,.disveli,.dispolat
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
      
	  <tr><td><img src="images/p3.png" style="width:50%;height:50%" /></td>
      <td><label>Name:Police3</label></td>
      <td></td>
	  <td><label>1.000.000 $ </label></td>
	  <td><a href="index.php?page=shop&item=PolatChan" class="dispolat">Buy</a></td>
      <?php 
						if($_SESSION['bg']=='PolatChan')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=PolatChan">Sell</a></td>
                <style type="text/css">
				.disali,.disveli,.dispolat
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
	<!--Bodyguard Section Endd..-->
	 </div>
	 
	    <div id="armssmall" class="smallarms">
		<tr><form method="post">
		<table class="midtable">
		<tr><td><img src="images/gun1.png" style="width:70%;height:70%" /></td>
		<td><label><ol>
        <li class="la">Name:Deagle </li>
        <li class="la">Type:Semi-Automatic Pistol </li>
        <li class="la">Weigh:1,766 g (3.9 lb) (357 MAGNUM)</li>
        <li class="la">Length:10.6 in (269.2 mm) (6in barrel) </li>
        <li class="la">Barrel length:6 in (152.4 mm) </li>
        </ol></label></td>
		<td></td>
		<td><label>5.000 $ </label></td>
		<td><a href="index.php?page=shop&item=Deagle" class="disdeag">Buy</a></td>
        <?php 
						if($_SESSION['pistol']=='Deagle')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=Deagle">Sell</a></td>
                <style type="text/css">
				.disdeag,.disglock
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
	
		<tr><td><img src="images/gun2.png" style="width:100%;height:100%" /></td>
		<td><label><ol>
        <li class="la">Name:Glock </li>
        <li class="la">Type:Semi-Automatic Pistol </li>
        <li class="la">Weigh:390 g / 13.76 </li>
        <li class="la">Length:250 mm / 9.84 in. </li>
        <li class="la">Barrel length:82.5 mm / 3.25 in </li>
        </ol></label></td>
		<td></td>
		<td><label>10.000 $ </label></td>
		<td><a href="index.php?page=shop&item=Glock" class="disglock">Buy</a></td>
        <?php 
						if($_SESSION['pistol']=='Glock')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=Glock">Sell</a></td>
                <style type="text/css">
				.disdeag,.disglock
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
		
	 <div id="hweapons" class="weaponsh">
	 <tr><form method="post">
		<table class="midtable">
		<tr><td><img src="images/gun3.png" style="width:100%;height:100%" /></td>
		<td><label><ol>
        <li class="la">Name:Shotgun </li>
        <li class="la">Type:Semi-Automatic Shotgun </li>
        <li class="la">Weigh:8 lb (3.6 kg) (28" barrel)</li>
        <li class="la">Length:Varies with model </li>
        <li class="la">Barrel length:18 in (460 mm) to 30 in (760 mm) </li>
        </ol></label></td>
		<td></td>
		<td><label>20.000 $ </label></td>
		<td><a href="index.php?page=shop&item=Shotgun" class="disshot">Buy</a></td>
        <?php 
						if($_SESSION['rifle']=='Shotgun')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=Shotgun">Sell</a></td>
                <style type="text/css">
				.disshot,.disak47
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
	
		<tr><td><img <?php if($_SESSION['side']=='M') echo 'src="images/gun4.png"'; else echo 'src="images/gun5.png"';?> style="width:100%;height:100%" /></td>
		<td><label><ol>
        <li class="la">Name:<?php if($_SESSION['side']=='M') echo 'AK47'; else echo 'MG-5';?> </li>
        <li class="la">Type:Assault rifle </li>
        <li class="la">Weigh:3.47 kg (7.7 lb)</li>
        <li class="la">Length:875 mm (34.4 in) folding stock </li>
        <li class="la">Barrel length:415 mm (16.3 in) </li>
        </ol></label></td>
		<td></td>
		<td><label>30.000 $ </label></td>
		<td><a href="index.php?page=shop&item=AK47" class="disak47">Buy</a></td>
        <?php 
						if($_SESSION['rifle']=='AK47')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=AK47">Sell</a></td>
                <style type="text/css">
				.disshot,.disak47
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
	 
	 <div id="sweapons" class="weaponss"><b>Special Weapons</b>
	 	<form method="post">
	 	<table class="midtable">
		<tr><td><img src="images/gun5.png" style="width:80%;height:80%" /></td>
		<td><label>Gun: Made in Turkey :)</label></td>
		<td></td>
		<td><label>40.000 $ </label></td>
		<td><input type="submit" name="buygunv" value="Buy it!" class="disablegunv" /></td>
		</tr>
		</table>
		</form>
	 
	 </div>
	 <div id="svest"    class="vests">
     <form method="post">
	 	<table class="midtable">
		<tr><td><img src="images/vest1.png" style="width:80%;height:80%" /></td>
		<td><label><ol>
        <li class="la">Name:Hidden bullet vest </li>
        <li class="la">Weigh:2.1 kg</li>
        </ol></label></td>
		<td></td>
		<td><label>10.000 $ </label></td>
		<td><a href="index.php?page=shop&item=HBV747" class="disvest1">Buy</a></td>
        <?php 
						if($_SESSION['armor']=='HBV747')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=HBV747">Sell</a></td>
                <style type="text/css">
				.disvest2,.disvest1
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
        
		<tr><td><img src="images/vest2.png" style="width:80%;height:80%" /></td>
		<td><label><ol>
        <li class="la">Name:Nano technology vest </li>
        <li class="la">Weigh:1.2 kg</li>
        </ol></label></td>
		<td></td>
		<td><label>25.000 $ </label></td>
		<td><a href="index.php?page=shop&item=NTV500" class="disvest2">Buy</a></td>
        <?php 
						if($_SESSION['armor']=='NTV500')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=NTV500">Sell</a></td>
                <style type="text/css">
				.disvest2,.disvest1
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
	 <div id="fgrenade"  class="granadef">
     <form method="post">
     <table class="midtable">
     <tr><td><img src="images/grenade.png" style="width:80%;height:80%" /></td>
		<td><label><ol>
        <li class="la">Name:World War II Mk 2 grenade </li>
        <li class="la">Type:Time-fused grenade </li>
        <li class="la">Weigh:1 lb 5 oz [595 grams]</li>
        <li class="la">Length:3 5/6" [111mm] </li>
        </ol></label></td>
		<td></td>
		<td><label>10.000 $ </label></td>
		<td><a href="index.php?page=shop&item=grenade" class="disgrenade">Buy</a></td>
        <?php 
						if($_SESSION[explosive]=='grenade')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=grenade">Sell</a></td>
                <style type="text/css">
				.disgrenade,.dismc
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
	 <div id="molotov"  class="molotovc">
     <form method="post">
     <table class="midtable">
     <tr><td><img src="images/molotovcoctail.png" style="width:80%;height:80%" /></td>
		<td><li class="la">Name:Molotov Coctail </li>
        <li class="la">Type:Caustic </li>
        <li class="la">Weigh:1 kg</li>
        <li class="la">Length:35 cm</li></td>
		<td></td>
		<td><label>5.000 $ </label></td>
		<td><a href="index.php?page=shop&item=MCoctail" class="dismc">Buy</a></td>
        <?php 
						if($_SESSION['explosive']=='MCoctail')
			{
			?>
            	<td><a href="index.php?page=shop&sellitem=MCoctail">Sell</a></td>
                <style type="text/css">
				.disgrenade,.dismc
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
	 </div>
     
     <?php
	 	$getitem = $_GET[item];
		$sellitem = $_GET[sellitem];
	 	if(isset($_GET[item]))
	 	{
			 $selectitem = mysql_query("SELECT * FROM shop WHERE name='$_GET[item]'");
			 $fetchitem = mysql_fetch_array($selectitem);
			 if($_SESSION[money] >= $fetchitem[value])
			 {
				 $_SESSION[money] -= $fetchitem[value];
				 mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
				 $_SESSION[att] += $fetchitem[att];
				 mysql_query("UPDATE users SET att=$_SESSION[att] WHERE id=$_SESSION[id]");
				 $_SESSION[def] += $fetchitem[def];
				 mysql_query("UPDATE users SET def=$_SESSION[def] WHERE id=$_SESSION[id]");
					 $_SESSION[speed] += $fetchitem[speed];
					 mysql_query("UPDATE users SET speed=$_SESSION[speed] WHERE id=$_SESSION[id]");
				 	$itemtype = $fetchitem[type];
				
				 	$_SESSION[$itemtype] = $fetchitem['name'];
				 	mysql_query("UPDATE users SET $itemtype='$_SESSION[$itemtype]' WHERE id=$_SESSION[id]");
					header("refresh:0;url=index.php?page=shop");
			  }
			 else
			 {
				 echo "<script>alert('You do not have enough money..')</script>";
			 }
		 }
		 
		 if(isset($_GET[sellitem]))
			 {
			     $selectitem = mysql_query("SELECT * FROM shop WHERE name='$_GET[sellitem]'");
				 $fetchitem = mysql_fetch_array($selectitem);
				 	
					 $_SESSION[money] += ( $fetchitem[value] * 0.75 );
					 mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
					 $_SESSION[att] -= $fetchitem[att];
					 mysql_query("UPDATE users SET att=$_SESSION[att] WHERE id=$_SESSION[id]");
					 $_SESSION[def] -= $fetchitem[def];
					 mysql_query("UPDATE users SET def=$_SESSION[def] WHERE id=$_SESSION[id]");
					 $_SESSION[speed] -= $fetchitem[speed];
					 mysql_query("UPDATE users SET speed=$_SESSION[speed] WHERE id=$_SESSION[id]");
					 $itemtype = $fetchitem[type];
					
						$_SESSION[$itemtype] = 'None';
						mysql_query("UPDATE users SET $itemtype='$_SESSION[$itemtype]' WHERE id=$_SESSION[id]");
						header("refresh:0;url=index.php?page=shop");
			 }
	 ?>
</body>
</html>