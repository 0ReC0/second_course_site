<?php

    if ($_SESSION['session_rights'] == 'admin'){
         header("Location: /AdminPage/selectAction.php");
        $message="admin";
     }
     else if ($_SESSION['session_rights'] == 'operator'){
         header("Location: /OperatorPage/selectAction.php");
        $message="operator";
     }
     else if($_SESSION['session_rights'] == 'user'){
        $message="user";
        header("Location: /UserPage/checkConfirmation.php");
     }
     else{
      header("Location: /Login/Login.php",true,301);

     }
?>