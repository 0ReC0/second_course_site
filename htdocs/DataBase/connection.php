<?php
	require("constants.php");
	//connect
	$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	//set working encoding
	$mysqli->set_charset('utf8');

?>