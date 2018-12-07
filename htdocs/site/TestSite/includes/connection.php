<?php
	require("constants.php");
	// $con = mysql_connect(DB_SERVER,DB_USER, DB_PASS) or die(mysql_error());
	// mysql_select_db(DB_NAME) or die("Cannot select DB");
	// $con = new PDO('mysql:host=DB_SERVER;dbname=DB_NAME;', DB_USER, DB_PASS);
	$con = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	?>