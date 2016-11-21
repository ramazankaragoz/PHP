<?php

	$game = $_GET[game];
	
	switch($game)
	{
		case poker:
		include("poker.php");
		break;
		case roulette:
		include("roulette.php");
		break;
		case blackjack:
		include("blackjack.php");
		break;
		default:
		echo '<a class="general" href=index.php?page=casino&game=poker><img src="images/poker.jpg" /></a>
		<a class="general" href=index.php?page=casino&game=roulette><img src="images/roulette.jpg" /></a>
		<a class="general" href=index.php?page=casino&game=blackjack><img src="images/blackjack.jpg" /></a>';
		break;
	}

?>