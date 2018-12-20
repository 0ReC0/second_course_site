<?php 
    session_start();
    require_once("../IpAddress/IpAddress.php");
    if ($_SESSION['session_confirmation']){
        header("Location: http://${IpAddress}/site/UserPage/Confirmed/confirmed.php");
        // header("Location: http://${IpAddress}/site/UserPage/Confirmed/report.php");
    }else if (!$_SESSION['session_confirmation']){
        header("Location: http://${IpAddress}/site/UserPage/NotConfirmed/notconfirmed.php");
    }
    
?>