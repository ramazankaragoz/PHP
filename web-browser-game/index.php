<?php include("config.php"); include("datadriven.php");  ?>
<html>
<head>
<title>Polices vs Gangsters</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<?php
if($_SESSION['user'] == false)
{
?>
<script>
function usercheck(user){
	if(window.XMLHttpRequest)
		xmlhttp=new XMLHttpRequest();
	else
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("usercheck").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET","usercheck.php?h="+user,true);
	xmlhttp.send();
}
function passcheck(pass){
	if(pass == "")
		document.getElementById("passcheck").innerHTML = "";
	else if(pass.length<6)
		document.getElementById("passcheck").innerHTML = "At least 6 characters";
	else
		document.getElementById("passcheck").innerHTML = "Ok";
}
</script>
</head>

<?php

echo'
<body class="badi">
<div id="login">
		<form method="post">
		<table>
			<tr>
				<td>
					<label class="loginLabel">Username: </label><input type="text" name="username" value="*****" 
					onfocus=if(this.value=="*****")this.value="" onblur=if(this.value=="")this.value="*****" />
				</td>
				<td>
					<label class="loginLabel">Password: </label><input type="password" name="password" value="*****" 
					onfocus=if(this.value=="*****")this.value="" onblur=if(this.value=="")this.value="*****" />
				</td>
				<td>
					<input class="lgnrgstr" type="submit" name="login" value="Login"/>
				</td>
			</tr>
		</table></form>';
	
	if($_POST['login'])
		{
			$query = mysql_query("SELECT * FROM users WHERE username='$_POST[username]' and password='$codedpass'");
			$take = mysql_fetch_array($query);
			$queryuser = mysql_query("SELECT * FROM users WHERE username='$_POST[username]'");
			$count = mysql_num_rows($query);
			$countuser = mysql_num_rows($queryuser);
			if($countuser == 0)
				echo '<center><label>Username is not exist !</label></center>';
			elseif($count == true)
			{
				$_SESSION['user'] = true;
				$sql = mysql_query("SHOW COLUMNS FROM users");
				while($row = mysql_fetch_array($sql))
				{
					$field = $row['Field'];
					$usersql = mysql_query("SELECT $field FROM users WHERE username='$_POST[username]'");
					$userfetch = mysql_fetch_array($usersql);
					$_SESSION[$field] =  $userfetch[$field];
				}
				header("location:index.php");
				
			}
			
			else
				echo '<center><label>Username or password is wrong !</label></center>';
		}
echo '</div><div class="indexmid"><label class="indexmidlabel">Prepare yourself to fight!</label></div>';
	
	
echo'<div id="register">
	<form method="post"><table>
		<tr>
			<td>
				<label class="registerLabel">Username: </label>
			</td>
			<td>
				<input type="text" name="username" value="*****" onkeyup="usercheck(this.value)" 
				onfocus=if(this.value=="*****")this.value="" onblur=if(this.value=="")this.value="*****" />
			</td>
			<td>
				<span id="usercheck"></span>
			</td>
		</tr>
		<tr>
			<td>
				<label class="registerLabel">Password: </label>
			</td>
			<td>
				<input type="password" name="password" value="*****" onkeyup="passcheck(this.value)" 
				onfocus=if(this.value=="*****")this.value="" onblur=if(this.value=="")this.value="*****" />
			</td>
			<td>
				<span id="passcheck"></span>
			</td>
		</tr>
		<tr>
			<td>
				<label class="registerLabel">E-Mail: </label>
			</td>
			<td>
				<input type="text" name="email" value="example@url.com" 
				onfocus=if(this.value=="example@url.com")this.value="" onblur=if(this.value=="")this.value="example@url.com" />
			</td>
			<td>
				<span id="emailcheck"></span>
			</td>
		</tr>
		<tr>
			<td>
				<label class="registerLabel">Side: </label>
			</td>
			<td>
				<input type="radio" name="side" value="P" /><label class="registerLabel">Police</label>
				<input type="radio" name="side" value="M" /><label class="registerLabel">Mafia</label>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<br><center><input class="lgnrgstr" type="submit" name="register" value="Register"/></center>
			</td>
		</tr>
	</table></form>';
if($_POST['register'])
		{
			$queryuser = mysql_query("SELECT * FROM users WHERE username='$_POST[username]'");
			$countuser = mysql_num_rows($queryuser);
			if($_POST['username']=="" || $_POST['password']=="" ||
				$_POST['email']=="" || $_POST['side']=="" )
				echo '<center><label>Please fill all fields</label></center>';
			elseif($_POST['username']=="*****" || $_POST['password']=="*****")
				echo '<center><label>You can\'t do that</label></center>';
			elseif(strlen($_POST['password']) < 6)
				echo '<center><label>You must type minimum <br>6 characters for password</label></center>';	
			elseif($countuser > 0)
				echo'<center><label>This username has  been taken</label></center>';
			else
			{
				mysql_query("INSERT INTO users (username,password,email,side) VALUES ('$_POST[username]','$codedpass','$_POST[email]','$_POST[side]')");
				echo'<center><label>Register succesful please login</label></center>';
			}
		}
echo '</div>';
}else{
	?>
	<script>
	function startTime()
	{
	var today=new Date();
	var h=today.getHours();
	var m=today.getMinutes();
	var s=today.getSeconds();
	// add a zero in front of numbers<10
	h=checkTime(h);
	m=checkTime(m);
	s=checkTime(s);
	document.getElementById("userclock").innerHTML = h+":"+m+":"+s;
	setTimeout("startTime()",750);
	}
	function checkTime(i)
	{
	if (i<10)
	  {
	  i="0" + i;
	  }
	return i;
	}
	
	$(document).ready(function() {
		energycheck();
		var int=self.setInterval("energycheck()",13000);
	});

	});
	function energycheck(){
		$.ajax({
			type:'POST',
			url:'energycheck.php',
			success: function (msg) {
				$("#energycheck").html(msg);
			}
		});
	}
	
	
	</script>
	</head>

	<body onLoad="startTime();energycheck()" >';
	<?php
		
		if(mktime() >= ($_SESSION[hptime] + ($hprestime*$_SESSION[lvl])) )
		{
			if($_SESSION[hp] < 100)
			{
			$cominghp = ( mktime() - $_SESSION[hptime] ) / ($hprestime*$_SESSION[lvl]) + 3;
			$_SESSION[hp] += round($cominghp);
			$_SESSION[hptime] = mktime();
			mysql_query("UPDATE users SET hp=$_SESSION[hp] WHERE id=$_SESSION[id]");
			mysql_query("UPDATE users SET hptime=$_SESSION[hptime] WHERE id=$_SESSION[id]");
				if($_SESSION[hp] > 100)
				{
					$_SESSION[hp] = 100;
					mysql_query("UPDATE users SET hp=$_SESSION[hp] WHERE id=$_SESSION[id]");
				}
			}
		}
		
		if($_SESSION[area] != 0)
		{
			$qarea = mysql_query("SELECT incometime,income FROM map WHERE id=$_SESSION[area]");
			$farea = mysql_fetch_array($qarea);
			if( mktime() >= ( $farea[incometime] + $incomerestime ) )
			{
			$comingmoney = (( mktime() - $farea[incometime] ) / $incomerestime) * $farea[income];
			
			$_SESSION[money] += $comingmoney;
			$farea[incometime] = mktime();
			
			mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
			mysql_query("UPDATE map SET incometime=$farea[incometime] WHERE id=$_SESSION[area]");
			}
			
		}
	
	if($_SESSION[expr] >= 100)
	{
		$_SESSION[expr] -= 100;
		mysql_query("UPDATE users SET expr=$_SESSION[expr] WHERE id=$_SESSION[id]");
		$_SESSION[lvl]+=1;
		mysql_query("UPDATE users SET lvl=$_SESSION[lvl] WHERE id=$_SESSION[id]");
	}
	
	if($_POST['logout'])
	{
		session_destroy();
		header("location:index.php");
	}
	echo '
	
	
	<div id="left">
	<a style="position:absolute;top:2%;left:6%" href="index.php?page=profile" title="Your stats in here"><img src="images/ricoimggg.png" /></a>
		<div id="menu">
			<table>
				<tr><td><a class="menu" href="index.php?page=profile" title="Your stats in here">Character</a></td></tr>
				<tr><td><a class="menu" style="top:8%;" href="index.php?page=messages">Messages</a></td></tr>
				<tr><td><a class="menu" style="top:16%;" href="index.php?page=quests" title="You must do these jobs for gainning money and experience">'.($_SESSION["side"] == 'P' ? 'Duties' : 'Crimes').'</a></td></tr>
				<tr><td><a class="menu" style="top:24%;" href="index.php?page=spec">Speciality</a></td></tr>
				<tr><td><a class="menu" style="top:32%;" href="index.php?page=multiple" title="You must do these jobs for gainning money and experience">'.($_SESSION["side"] == 'P' ? 'Group Duties' : 'Group Crimes').'</a></td></tr>
				<tr><td><a class="menu" style="top:40%;" href="index.php?page=smuggling">Smuggling</a></td></tr>
				<tr><td><a class="menu" style="top:48%;" href="index.php?page=fitness" title="You can improve your attributes in here">Sport Center</a></td></tr>
				<tr><td><a class="menu" style="top:56%;" href="index.php?page=house">House</a></td></tr>
				<tr><td><a class="menu" style="top:64%;" href="index.php?page=team" title="You can create Gang or Duties">'.($_SESSION["side"] == 'P' ? 'Team' : 'Gang').'</a></td></tr>
				<tr><td><a class="menu" style="top:72%;" href="index.php?page=shop" title="You will buy some neccessary stuff in here">Shop</a></td></tr>
				<tr><td><a class="menu" style="top:80%;" href="index.php?page=map" title="This is your map">Map</a></td></tr>
				<tr><td><a class="menu" style="top:88%;" href="index.php?page=attack">Attack</a></td></tr>
				<tr><td><a class="menu" style="top:96%;" href="index.php?page=casino">Casino</a></td></tr>
				<tr><td><a class="menu" style="top:104%;" href="index.php?page=search">Search</a></td></tr>
				<tr><td><a class="menu" style="top:112%;" href="index.php?page=statistics">Statistics</a></td></tr>
			</table>
		</div>
	</div>
	<div id="'.($_SESSION[side] == 'P' ? 'midpolice' : 'midmafia').'">
		<div class="mid">
	';
	$page = $_GET['page'];
	switch($page)
	{
		case profile:
		include("character.php");
		break;
		case messages:
			include("messages.php");
		break;
		case quests:
			include("quests.php");
		break;
		case spec:
			include("spec.php");
		break;
		case multiple:
			include("multicrimes-duties.php");
		break;
		case map:
			include("map.php");
		break;
		case shop:
			include("shop.php");
		break;
		case smuggling:
			include("smuggling.php");
		break;
		case fitness:
			include("fitness.php");
		break;
		case house:
			include("house.php");
		break;
		case team:
			include("team.php");
		break;
		case settings:
			include("settings.php");
		break;
		case edit:
			include("edit.php");
		break;
		case casino:
		include("casino.php");
		break;
		case search:
			include("search.php");
		break;
		case attack:
			include("attack.php");
		break;
		case statistics:
			include("statistics.php");
		break;
		 /*case createquest:
			echo '
			<form method="post">
			<table>
			<tr><td>Side</td></tr>
			<tr><td>
			<input type="radio" name="side" value="pquests" />Police
			<input type="radio" name="side" value="mquests" />Mafia
			</td></tr>
			<tr><td>Quest Name</td></tr>
			<tr><td><input type="text" name="questName" /></td></tr>
			<tr><td>Subject</td></tr>
			<tr><td><textarea rows="7" cols="30" name="subject"></textarea></td></tr>
			<tr><td><input type="submit" name="createQuest" value="Create" /></td></tr>
			<tr><td>';
			if($_POST[createQuest])
			{
				$addQuest = mysql_query("INSERT INTO $_POST[side] (name,subject) VALUES ('$_POST[questName]','$_POST[subject]')");
				if($addQuest == true)
					echo $_POST[questName].' quest created successfully.';
				else
					echo 'There is a problem!';
			}
			echo'</td></tr>
			</table>
			</form>
			';
		break; */
		default:
			include("character.php");
		break;
	}
	echo '</div></div>
	
	
	<div id="right"><br>
		<form method="post">
		<table align="center">
		<tr><td><center><label style="color:white">'.$_SESSION[username].'</label></center></td></tr>
		<tr><td ><center><input class="sbutton" type="submit" name="logout" value="LogOut" /></center></td></tr>
		<tr><td><br><br><center>
		<a href="index.php?page=messages&act=inbox"><img src="images/mail-icon.png" height="25%" width="25%" /></a>
		</center></td></tr>
		</table></form>
	</div>
	
	<div id="top">
		<label class="welcome">Welcome '.($_SESSION["side"] == 'P' ? 'Police' : 'Gangster').'</label>
		<span id="userclock"></span>
			<table class="energy">
				<tr><td style="color:green">Money</td><td> : </td><td style="color:green">'.number_format($_SESSION[money]).' $</td>
				<td></td>
				<td style="color:yellow">Experience</td><td> : </td><td style="color:yellow">'.$_SESSION[expr].' %</td>
				<td></td>
				<td><img src="images/energy2.png" /></td><td>  </td><td style="color:blue"><span id="energycheck">'.$_SESSION[energy].'</span> %</td></tr>
			</table>
	</div>
	
	<div id="bottom">
	<img src="images/news.png" height="30px" width="30px" />
	<div id="news">';
	$newsquery=mysql_query("SELECT * FROM news ORDER BY id DESC LIMIT 0,3");
	while($newsfetch=mysql_fetch_array($newsquery))
	{
	echo $newsfetch['text'].' '.$newsfetch['date'];
	echo '<br>';
	}
	echo '</div>
	</div>
	';
}
?>
</body>
</html>