<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="CountUtilities.css" />
</head>
<body>
<?php

session_start();
require_once("../IpAddress/IpAddress.php");
if(!isset($_SESSION["session_email"])){
    header("Location: http://${IpAddress}/site/Login/Login.php",true,301);
}
?>
    Utilities
    <p><a href="../Logout/Logout.php">Выйти</a> из системы</p>

</body>
</html>