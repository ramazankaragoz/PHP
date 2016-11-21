<?php

include("config.php");
$h = $_GET['h'];
$result = mysql_query("SELECT username FROM users WHERE username='$h'");
if(empty($h))
	echo '';
elseif(mysql_num_rows( $result) > 0 )
	echo 'This username has been taken';
else
	echo 'Available';

?>