<?php
	
	$stats = mysql_query("SELECT * FROM users ORDER BY lvl DESC, expr DESC");
	
	if(!isset($_GET['users']))
	{
		$userpage = 1;
		$statss = mysql_query("SELECT * FROM users ORDER BY lvl DESC, expr DESC LIMIT 0,10");
	}
	else
	{
		$userpage = (int)$_GET['users'];
		if($userpage == 0)
			$statss = mysql_query("SELECT * FROM users ORDER BY lvl DESC, expr DESC LIMIT 0,10");
		else
		{
			$limit = $userpage * 10;
			$statss = mysql_query("SELECT * FROM users ORDER BY lvl DESC, expr DESC LIMIT $limit,10");
		}
	}
	
	
	echo '<div class="statsdiv" ><table>';
	echo  '<tr align="center"><td><b>Username</b></td><td><b>Side</b></td><td><b>Level</b></td></tr>';
	while($row = mysql_fetch_array($statss))
	{
		echo  '<tr align="center"><td>'.$row[username].'</td><td>'.($row[side] == 'P' ? 'Police' : 'Mafia').'
	</td><td>'.$row[lvl].'</td></tr>';
	}
	echo '</table><br>';
	$per_page = 10;

	$pages_query = mysql_query("SELECT COUNT(id) FROM users");
	$pages = ceil(mysql_result($pages_query, 0) / $per_page);

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$start = ($page - 1) * $per_page;

	if ($pages >=1 && $page <=$pages) {
	  for ($x=1; $x<=$pages; $x++) {
		echo ($x == $page) ? '<strong>
		<a class="sbutton" href="index.php?page=statistics&users='.($x-1).'">'.$x.'</a></strong> ' : '<a  class="sbutton" href="index.php?page=statistics&users='.($x-1).'">'.$x.'</a> ';
	  }
	}
		echo '</div>';
?>

