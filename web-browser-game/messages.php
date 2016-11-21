<?php
		$getmsg = $_GET['act'];
		$msgquery = mysql_query("SELECT * FROM messages WHERE receiver='$_SESSION[username]'");
		$fetchmsg = mysql_fetch_array($msgquery);
		if( $_GET['msgid'] )
		{
			echo '<div class="middiv">';
			if($_POST[deletemsg])
			{
				mysql_query("DELETE FROM messages WHERE id=$_GET[msgid]");
				header("location:index.php?page=messages&act=inbox");
			}
			$message = mysql_query("SELECT * FROM messages WHERE receiver='$_SESSION[username]' and id='$_GET[msgid]'");
			$msgfetch = mysql_fetch_array($message);
			if($msgfetch['receiver'] =! $_SESSION['username'])
				echo 'This is speciality of someone what a shame :)';
			else
				echo '
			<table><tr><td>
			Sender: <b>'.$msgfetch['sender'].'</b></td></tr>
			<tr><td style="padding:50px">'.$msgfetch['message'].'</td></tr>
			<tr><td>
			<form method="post">
			<input class="sbutton" type="submit" name="deletemsg" value="Delete" />
			<a class="sbutton" href="index.php?page=messages&act=type">Reply</a>
			</form>
			</td></tr></table>';
		}
		elseif( $_GET['omsgid'] )
		{
			echo '<div class="middiv">';
			if($_POST[deletemsg])
			{
				mysql_query("DELETE FROM messages WHERE id=$_GET[omsgid]");
				header("location:index.php?page=messages&act=outbox");
			}
			$message = mysql_query("SELECT * FROM messages WHERE sender='$_SESSION[username]' and id='$_GET[omsgid]'");
			$msgfetch = mysql_fetch_array($message);
			if($msgfetch['receiver'] =! $_SESSION['username'])
				echo 'This is speciality of someone what a shame :)';
			else
				echo '
			<table><tr><td>
			Receiver: <b>'.$msgfetch['receiver'].'</b></td></tr>
			<tr><td style="padding:50px">'.$msgfetch['message'].'</td></tr>
			<tr><td>
			<form method="post">
			<input class="sbutton" type="submit" name="deletemsg" value="Delete" />
			</form>
			</td></tr></table>';
		}
		elseif( $_POST['send'] )
		{
			echo '<div class="middiv">';
			$receivercheck = mysql_query("SELECT username FROM users WHERE username='$_POST[receiver]'");
			$receivernum = mysql_num_rows($receivercheck);
			if($receivernum > 0)
			{
				$dateandtime = date("d/m/y & H:i:s");
				$insmsg = mysql_query("INSERT INTO messages (sender,receiver,topic,message,time) VALUES ('$_SESSION[username]','$_POST[receiver]','$_POST[topic]','$_POST[message]','$dateandtime')");
				if($insmsg == true)
					echo 'Message sent to '.$_POST[receiver];
				else
					echo 'Failed';
			}
			else
				echo 'This username doesn\'t exist!';
		}
		elseif($_GET['act'] == 'type')
		{
			echo '
			<div class="middiv">
			<table><form method="post">
			<tr><td><label>Receiver : </label></td><td><input style="border:solid 2px;background:transparent" type="text" name="receiver" /></td></tr>
			<tr><td><label>Topic : </label></td><td><input style="border:solid 2px;background:transparent" type="text" name="topic" /></td></tr>
			<tr><td><label>Message : </label></td><td><textarea style="border:solid 2px;background:transparent" name="message" rows="5" cols="25"></textarea></td></tr>
			<tr><td colspan="2"><br><center><input class="sbutton" type="submit" value="Send" name="send" /></center></td></tr>
			</form></table>
			';
		}
		elseif($_GET['act'] == 'outbox')
		{
				$msgid = $_GET['omsgid'];
				$msgquery = mysql_query("SELECT * FROM messages WHERE sender='$_SESSION[username]'");
				echo '
				<div style="position:absolute;top:20%;left:15%">
				<form method="post">
				<table class="msgdiv">
				<tr><td><a class="mailicons" href="index.php?page=messages&act=type">
				<img src="images/writemail.png" /></a></td>
				<td width="200px"><center><b>Subject</b></center></td><td width="200px">
				<center><b>To</b></center></td><td><center><b>Date & Time</b></center></td>
				<td><a class="mailicons" href="index.php?page=messages&act=inbox"><img src="images/mailb.png" /></a></td>
				</tr>
				';
				while($row = mysql_fetch_array($msgquery))
				{
					echo
					'
					<tr><td></td><td><a class="inbox" href="index.php?page=messages&act=inbox&omsgid='.$row[id].'"><center>'.$row[topic].'</center></a></td>
					<td><center>'.$row[receiver].'</center></td><td>'.$row["time"].'</td></tr>
					';
				}
				echo '</table></form></div>';
		}
		else
		{
				$msgid = $_GET['msgid'];
				$msgquery = mysql_query("SELECT * FROM messages WHERE receiver='$_SESSION[username]'");
				echo '
				<div style="color:white;position:absolute;top:20%;left:15%">
				<form method="post">
				<table class="msgdiv">
				<tr><td><a class="mailicons" href="index.php?page=messages&act=type"><img src="images/writemail.png" /></a></td>
				<td width="200px"><center><b>Subject</b></center></td><td width="200px">
				<center><b>From</b></center></td><td><center><b>Date & Time</b></center></td>
				<td><a class="mailicons" href="index.php?page=messages&act=outbox"><img src="images/Mail-Outbox-icon.png" /></a></td>
				</tr>
				';
				while($row = mysql_fetch_array($msgquery))
				{
					echo
					'
					<tr><td></td><td>
					<a class="inbox" href="index.php?page=messages&act=inbox&msgid='.$row[id].'">
					<center>'.$row[topic].'</center></a></td>
					<td><center>'.$row[sender].'</center></td><td>'.$row["time"].'</td></tr>
					';
				}
				echo '</table></form></div>';
		}
		echo '</div>';
?>