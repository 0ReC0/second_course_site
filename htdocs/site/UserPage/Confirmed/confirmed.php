<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="confirmed.css" />
</head>
<body>
<?php require_once("../../DataBase/connection.php");
    session_start();
    require_once("../../IpAddress/IpAddress.php");
    if(!isset($_SESSION['session_email'])){
    header("Location: http://${IpAddress}/site/Login/Login.php",true,301);
    }
?> 
    <?php
    $message='';
        $selectedUtilities = $mysqli->query("SELECT utilities.servicename as servicename,utilities.value as utilitiValue  
        FROM utilities,users WHERE users.email = '{$_SESSION['session_email']}' AND users.rights = 'user' AND users.id = utilities.userid");
    ?>
    <form class="UserInputs" name="UserInputs" method="post">
    <span style="grid-row:1; font-size:20px;color:red;"><?php echo $message; ?></span>
    <span style="grid-row:2;font-size:20px;font-weight:bold;">Введите стостояния счётчиков</span>
    <div>
    <?php
            if(isset($_POST['utilitiValue']) && isset($_POST['utilitiName'])){
                $mysqli->query("UPDATE `utilities` SET `value` = '{$_POST['utilitiValue']}' WHERE `utilities`.`servicename` = '{$_POST['utilitiName']}' AND utilities.userid = '{$_SESSION['session_userid']}'");
                if(!mysqli_error($mysqli)){
                    $message="Значение '{$_POST['utilitiValue']}' услуги '{$_POST['utilitiName']}' подтвержедно";
                }
                $selectedUtilities = $mysqli->query("SELECT utilities.servicename as servicename,utilities.value as utilitiValue  
                FROM utilities,users WHERE users.email = '{$_SESSION['session_email']}' AND users.rights = 'user' AND users.id = utilities.userid");
    
            }
            echo $message;
            while($Utiliti=mysqli_fetch_assoc($selectedUtilities)){
                if ($Utiliti["utilitiValue"] == 0){
                    $error="Введите значение '{$Utiliti['servicename']}' != 0 и подтвердите его";
                }
                echo '<form method="post" name="" class="utilitiValues">';
                echo '<div  class="utilitiValues">';
                echo '<input type="text" name="utilitiName" style="grid-column:1;" readonly value="'.$Utiliti['servicename'].'">';
                echo '<input name="utilitiValue" style="grid-column:2;" value='.$Utiliti["utilitiValue"].' type="number">';
                echo '<input value="Подтвердить состояние" style="grid-column:3;" type="submit">';
                echo '</div>';
                echo '</form>';
            }
            if(isset($error)){
                echo $error;
            }else{
                echo '<button>
                <a target="_blank" href="./report.php">
                Показать отчёт
                </a>
                </button>';

            }
        ?>
    </div>

    <p style="grid-row:9;"><a target="_self" href="../../Logout/Logout.php">Выйти</a> из системы</p>
    </form>
</body>
</html>