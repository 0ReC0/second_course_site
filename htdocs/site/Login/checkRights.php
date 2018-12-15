<?php 
require_once("IpAddress.php");
?>
<?php
    if ($_SESSION['session_rights'] == 'admin'){
        //  header("Location: http://${IpAddress}/site/CountUtilities/CountUtilities.php");
        $message="admin";
     }
     else if ($_SESSION['session_rights'] == 'operator'){
         header("Location: http://${IpAddress}/site/OperatorPage/selectAction.php",true,301);
        $message="operator";
     }
     else if($_SESSION['session_rights'] == 'user'){
        $message="user";
         header("Location: http://${IpAddress}/site/UserPage/checkConfirmation.php",true,301);
     }
     else{
      header("Location: http://${IpAddress}/site/Login/Login.php",true,301);

     }
?>