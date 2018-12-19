<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="confirm.css" />
</head>
<body>
    <div class="Container">
<?php require_once("../../DataBase/connection.php");?> 
<?php

session_start();
require_once("../../IpAddress/IpAddress.php");
if(!isset($_SESSION["session_email"])){
    header("Location: http://${IpAddress}/site/Login/Login.php",true,301);
}
?>
        <?php
        $AllUsers = $mysqli->query("SELECT users.email as UserEmail FROM users");
        ?>
        <p><label>Выберите email пользователя
            <form method="post">
            <select name="selectUser">
                <option disabled selected>Выберите email</option>
                <?php
                while( $row = mysqli_fetch_assoc($AllUsers) ) {
                    echo '<option>'.$row["UserEmail"].'</option>';
                };
                ?>
            </select>
                <input type="submit"  value="Выбрать" >
            </form>
        </label><p>
        <span>Выбранный пользователь 
        <?php
                if(isset($_SESSION["selectedUser"])){
                    echo $_SESSION["selectedUser"];
                    $selectedUser = $mysqli->query("SELECT users.id as userID FROM users WHERE users.email = '{$_SESSION["selectedUser"]}' ");
                    $selectedUser=mysqli_fetch_assoc($selectedUser);
                    echo $selectedUser['userID'];
                }
        ?>
        </span>
        <?php
            if(isset($_POST["selectUser"])){
        $_SESSION['selectedUser']=$_POST["selectUser"];
        }
        if(isset($_SESSION['selectedUserID'])){
            if(isset($_POST['confirm'])){
                $mysqli->query("UPDATE `users` SET `confirmation` = '1' WHERE `users`.`id` = '{$_SESSION['selectedUserID']}'");
                printf(mysqli_error($mysqli));
                if(!mysqli_error($mysqli)){
                    echo "Пользователь успешно подтвержден";
                }
            }
        }
        ?>

<form method="post">
<button name="confirm" type="submit">Удалить пользователя</button>
</form>
<p ><a href="../selectAction.php">Вернуться</a> в меню выбора действия</p>
<p class="logout"><a href="../../Logout/Logout.php">Выйти</a> из системы</p>

</div>
</body>
</html>