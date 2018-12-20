<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="confirmed.css" />
</head>
<body>
<?php require_once("../../DataBase/connection.php");
session_start();?> 
<?php
    require_once("../../IpAddress/IpAddress.php");
    ?>
    <?php
    $message='';
    	if(isset($_POST["UserInputs"])){
            if(!empty($_POST['electricity']) && !empty($_POST['heating']) && !empty($_POST['water']) && !empty($_POST['garbage'])) {
                $electricity= htmlspecialchars($_POST['electricity']);
                $heating=htmlspecialchars($_POST['heating']);
               $water=htmlspecialchars($_POST['water']);
               $garbage=htmlspecialchars($_POST['garbage']);
               echo "$electricity $heating $water $garbage";
            }
            else {
                $message="Все поля должны быть заполнены";
            }
        }
    ?>
    <form class="UserInputs" name="UserInputs" method="post">
    <span style="grid-row:1; font-size:20px;color:red;"><?php echo $message; ?></span>
    <span style="grid-row:2;font-size:20px;font-weight:bold;">Введите стостояния счётчиков</span>
    <div>
        <?php
        $selectedUtilities = $mysqli->query("SELECT utilities.serviceid as serviceid,
        utilities.servicename as servicename,utilities.value as utilitiValue , utilities.important as serviceimportant FROM utilities,
        users WHERE users.email = '{$_SESSION['session_email']}' AND users.rights = 'user' AND users.id = utilities.userid");

        while($Utiliti=mysqli_fetch_assoc($selectedUtilities)){
            echo '<form method="post" name="" class="utilitiValues">';
            echo '<div  class="utilitiValues">';
            echo '<input type="text" name="utilitiName" style="grid-column:1;" value="'.$Utiliti['servicename'].'">';
            echo '<input name="utilitiValue" style="grid-column:2;" value='.$Utiliti["utilitiValue"].' type="number">';
            echo '<input value="Подтвердить состояние" style="grid-column:3;" type="submit">';
            echo '</div>';
            echo '</form>';
        }
        if(isset($_POST['utilitiValue']) && isset($_POST['utilitiValue'])){
            echo $_POST['utilitiValue'];
            $mysqli->query("UPDATE `utilities` SET `value` = '{$_POST['utilitiValue']}' WHERE `utilities`.`servicename` = '{$_POST['utilitiName']}' AND utilities.userid = '{$_SESSION['session_userid']}'");
            echo mysqli_error($mysqli);
        $selectedUtilities = $mysqli->query("SELECT utilities.serviceid as serviceid,
        utilities.servicename as servicename,utilities.value as utilitiValue , utilities.important as serviceimportant FROM utilities,
        users WHERE users.email = '{$_SESSION['session_email']}' AND users.rights = 'user' AND users.id = utilities.userid");

        }
        ?>
    </div>

    <p style="grid-row:9;"><a href="../../Logout/Logout.php">Выйти</a> из системы</p>
    </form>
</body>
</html>