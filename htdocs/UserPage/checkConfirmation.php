<?php 
    session_start();
    if ($_SESSION['session_confirmation']){
        header("Location: /UserPage/Confirmed/confirmed.php");
    }else if (!$_SESSION['session_confirmation']){
        header("Location: /UserPage/NotConfirmed/notconfirmed.php");
    }
    
?>