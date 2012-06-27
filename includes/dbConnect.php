<?php
	require_once("includes/constants.php");
	$dbConnect = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die ( "Can't connect to the Server" );
	mysql_select_db(DB_NAME, $dbConnect ) or die ("Unable to open database");


?>