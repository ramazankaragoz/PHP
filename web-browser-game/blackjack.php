<?php
	echo '<div class="middiv">';
	function differentcard($randomcard)
	{
		$cards = mysql_query("SELECT * FROM bjusercards WHERE userid=$_SESSION[id]");
		while($row = mysql_fetch_array($cards))
		{
			if($row[cardid] == $randomcard)
			{
				$i = rand(1,52);
				return differentcard($i);
			}
		}
		return $randomcard;
	}
	if( $_POST['play'] )
	{
		if( $_POST['bet'] < 50)
			echo 'You must play minimum 50$';
		else
		{
			$i=rand(1,52);
			$_SESSION[bjbet] = $_POST[bet];
			$_SESSION[money] -= $_SESSION[bjbet];
			mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
			echo '
			<div>';
			for($j=0;$j<2;$j++)
			{
			$hg = differentcard($i);
			$card = mysql_query("SELECT * FROM bjcards WHERE id=$hg");
			$fetchcard = mysql_fetch_array($card);
			mysql_query("INSERT INTO bjusercards (userid,cardid,value,img) VALUES 
			($_SESSION[id],$fetchcard[id],$fetchcard[value],'$fetchcard[img]')");
			echo '<img title='.$fetchcard[img].' src="cards/'.$fetchcard[img].'" height="100px" width="65px" />';
			if( $fetchcard[value] == 1 )
			{
				$total += ($fetchcard[value]+10);
				if($total == 22)
					$total = 12;
				else
					$total = $total;
			}
			else
				$total += $fetchcard[value];
			}
			if($total == 21)
			{
				$_SESSION[money] += ($_SESSION[bjbet]*2.5);
				mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
				mysql_query("DELETE FROM bjusercards WHERE userid=$_SESSION[id]");
				echo '<br><br>Blackjack! You won '.number_format($_SESSION[bjbet]*2.5).' $<br>
				<form method="post">
				<input class="sbutton" type="submit" name="leave" value="Leave" />
				<a class="sbutton" href="index.php?page=casino&game=blackjack">Play Again</a>
				</form>';
				$_SESSION[bjbet] = false;
			}
			else
			{
			echo '
			<form method="post">
			Total = '.$total.'<br>
			<input class="sbutton" type="submit" name="card" value="Card" />
			<input class="sbutton" type="submit" name="stop" value="Stop" />
			<input class="sbutton" type="submit" name="leave" value="Leave" />
			</form>';
			}
			echo'</div>';
		}
	}
	elseif($_POST[leave])
	{
		$cards = mysql_query("SELECT * FROM bjusercards WHERE userid=$_SESSION[id]");
		mysql_query("DELETE FROM bjusercards WHERE userid=$_SESSION[id]");
		$_SESSION[bjbet] = false;
		echo 'You left';
	}
	elseif($_POST[stop])
	{
		echo 'You stopped<br>';
		$cards = mysql_query("SELECT * FROM bjusercards WHERE userid=$_SESSION[id]");
		while($row = mysql_fetch_array($cards))
		{
		echo '<img title='.$row[img].' src="cards/'.$row[img].'" height="100px" width="65px" />';
		$totall += $row[value];
		}
		echo '<br>Your hand '.$totall.'<br>';
		$botTotal = 0;
		while($botTotal < 16)
		{
			$i = rand(1,52);
			$hg = differentcard($i);
			$card = mysql_query("SELECT * FROM bjcards WHERE id=$hg");
			$fetchcard = mysql_fetch_array($card);
			echo '<img title='.$fetchcard[img].' src="cards/'.$fetchcard[img].'" height="100px" width="65px" />';
			$botTotal += $fetchcard[value];
		}
		echo '<br>Croupier\'s hand '.$botTotal.'<br><br>';
		if( ($totall < 22 && $totall > $botTotal ) || ($totall < 22 && $botTotal > 21 ))
		{
			$_SESSION[money] += ($_SESSION[bjbet]*2);
			echo 'You won '.number_format($_SESSION[bjbet]).'$';
		}
		elseif( $totall < 22 && $totall == $botTotal )
		{
			$_SESSION[money] += $_SESSION[bjbet];
			echo 'You get your money back '.number_format($_SESSION[bjbet]).'$';
		}
		else
		{
			echo 'You lost '.number_format($_SESSION[bjbet]).'$';
		}
		mysql_query("UPDATE users SET money=$_SESSION[money] WHERE id=$_SESSION[id]");
		mysql_query("DELETE FROM bjusercards WHERE userid=$_SESSION[id]");
		$_SESSION[bjbet] = false;
		echo'<br><br><a class="sbutton" href="index.php?page=casino&game=blackjack">Play Again</a>';
	}
	elseif($_POST[card])
	{
		$i = rand(1,52);
		$hg = differentcard($i);
		$card = mysql_query("SELECT * FROM bjcards WHERE id=$hg");
		$fetchcard = mysql_fetch_array($card);
		mysql_query("INSERT INTO bjusercards (userid,cardid,value,img) VALUES ($_SESSION[id],$fetchcard[id],$fetchcard[value],'$fetchcard[img]')");
		$cards = mysql_query("SELECT * FROM bjusercards WHERE userid=$_SESSION[id]");
		echo '<div>';
		while($row = mysql_fetch_array($cards))
		{
		echo '<img title='.$row[img].' src="cards/'.$row[img].'" height="100px" width="65px" />';
		if( $row[value] == 1 )
		{
			if($totall < 11)
				$totall += ($row[value]+10);
			else
				$totall += $row[value];
		}
		else
			$totall += $row[value];
		}
		if($totall > 21)
		{
			echo '
			<form method="post">
			Total = '.$totall.' <br>You failed and lost '.number_format($_SESSION[bjbet]).'$<br>';
			$cards = mysql_query("SELECT * FROM bjusercards WHERE userid=$_SESSION[id]");
			mysql_query("DELETE FROM bjusercards WHERE userid=$_SESSION[id]");
			$_SESSION[bjbet] = false;
			echo'<input class="sbutton" type="submit" name="leave" value="Leave" />
			<a class="sbutton" href="index.php?page=casino&game=blackjack">Play Again</a>
			</form>';
		}
		else
		{
			echo '
			<form method="post">
			Total = '.$totall.'<br>
			<input class="sbutton" type="submit" name="card" value="Card" />
			<input class="sbutton" type="submit" name="stop" value="Stop" />
			<input class="sbutton" type="submit" name="leave" value="Leave" />
			</form>';
		}
		echo '</div>';
	}
	elseif($_SESSION[bjbet] == true)
	{
		$cards = mysql_query("SELECT * FROM bjusercards WHERE userid=$_SESSION[id]");
		while($row = mysql_fetch_array($cards))
		{
		echo '<img title='.$row[img].' src="cards/'.$row[img].'" height="100px" width="65px" />';
		$total += $row[value];
		}
		echo '
			<form method="post">
			Total = '.$total.'<br>
			<input class="sbutton" type="submit" name="card" value="Card" />
			<input class="sbutton" type="submit" name="stop" value="Stop" />
			<input class="sbutton" type="submit" name="leave" value="Leave" />
			</form>';
	}
	else
	{
	echo'<form method="post">
	Welcome '.$_SESSION['username'].'<br><br>Money : '.number_format($_SESSION[money]).'$<br><br>
	Bet : <input type="text" name="bet" size="5px" style="background-color:transparent"/>
	<input class="sbutton" class="sbutton" type="submit" name="play" value="Play" />
	</form>';
	}
	echo '</div>';
?>