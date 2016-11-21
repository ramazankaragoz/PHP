<?php
	
	session_start();
	ob_start();
	$conn = mysql_connect("phpmyadmin.domain","root","root","online") or die (mysql_error("Database connection error!"));
	$db = mysql_select_db("darkgaze_wbg",$conn) or die (mysql_error("Database not found"));
	$code = sha1(base64_encode(md5(base64_encode($_POST['password']))));
	$codedpass = substr($code,5,32);
	
?>