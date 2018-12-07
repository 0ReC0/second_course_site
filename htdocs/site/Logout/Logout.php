<?php
    require_once("../IpAddress/IpAddress.php");
	session_start();
	unset($_SESSION['session_email']);
	session_destroy();
	header("location: http://${IpAddress}/site/Login/Login.php");
	?>