<?php require_once("../../DataBase/connection.php");
    session_start();
    if(isset($_SESSION['session_confirmation'])){
    if($_SESSION['session_confirmation'] == '0'){
    header("Location: /UserPage/NotConfirmed/notconfirmed.php",true,301);
    }
    }
    if(!isset($_SESSION['session_email'])){
    header("Location: /Login/Login.php",true,301);
    }
?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="confirmed.css" />
            <title>Подсчёт коммунальных услуг</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/icons/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../assets/bootstrap-dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
<div class="actions">
    <?php
    $message='';
        $selectedUtilities = $mysqli->query("SELECT utilities.servicename as servicename,utilities.value as utilitiValue  
        FROM utilities,users WHERE users.email = '{$_SESSION['session_email']}' AND users.rights = 'user' AND users.id = utilities.userid");
    ?>
    <form class="UserInputs" name="UserInputs" method="post">
    <div style="grid-template-rows:repeat(5,1fr);">
    <div style="grid-row:1; font-size:20px;color:red;"><?php echo $message; ?></div>
    <div style="grid-row:2;font-size:20px;font-weight:bold;text-align:center" class="mb-3">Введите стостояния счётчиков</div>
    <?php
            if(isset($_POST['utilitiValue']) && isset($_POST['utilitiName'])){
                $mysqli->query("UPDATE `utilities` SET `value` = '{$_POST['utilitiValue']}' WHERE `utilities`.`servicename` = '{$_POST['utilitiName']}' AND utilities.userid = '{$_SESSION['session_userid']}'");
                if(!mysqli_error($mysqli)){
                    $message="Значение '{$_POST['utilitiValue']}' услуги '{$_POST['utilitiName']}' подтвержедно";
                }
                $selectedUtilities = $mysqli->query("SELECT utilities.servicename as servicename,utilities.value as utilitiValue  
                FROM utilities,users WHERE users.email = '{$_SESSION['session_email']}' AND users.rights = 'user' AND users.id = utilities.userid");
    
            }
            echo '<div style="grid-row:3;">'.$message.'</div>';
            while($Utiliti=mysqli_fetch_assoc($selectedUtilities)){
                if ($Utiliti["utilitiValue"] == 0){
                    $error="Введите значение '{$Utiliti['servicename']}' != 0 и подтвердите его";
                }
                echo '<form method="post" name="">';
                echo '<div class="utilitiValues">';
                echo '<input type="text" name="utilitiName" style="grid-column:1;" readonly value="'.$Utiliti['servicename'].'">';
                echo '<input name="utilitiValue" style="grid-column:2;" value='.$Utiliti["utilitiValue"].' type="number">';
                echo '<input value="Подтвердить состояние" style="grid-column:3;" class="btn btn-outline-success" type="submit">';
                echo '</div>';
                echo '</form>';
            }
            if(isset($error)){
                echo $error;
            }else{
                echo '
                <form target="_blank" action="./report.php" class="d-flex justify-content-center">
                    <button class="btn btn-outline-info mt-3 mb-3">
                        Показать отчёт
                    </button>
                </form>';

            }
        ?>
    </div>

    <p style="grid-row:5;"><a target="_self" href="/Logout/Logout.php">Выйти</a> из системы</p>
    </form>
</div>
</body>
</html>