<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="confirm.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../bootstrap-dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
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
        $AllUsers = $mysqli->query("SELECT users.email as UserEmail FROM users WHERE users.rights != 'admin'");
        ?>
        <p><label>Выберите email пользователя
            <form method="post">
                <div class="input-group">
                    <select class="custom-select" name="selectUser" id="inputGroupSelect04" aria-label="Example select with button addon">
                        <option disabled selected>Выберите email</option>
                        <?php 
                        while( $row = mysqli_fetch_assoc($AllUsers) ) {
                            echo '<option>'.$row["UserEmail"].'</option>';
                        };
                        ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Выбрать</button>
                    </div>
                </div>
            </form>
        </label><p>
        <span>Выбранный пользователь 
        <?php
                if(isset($_POST["selectUser"])){
                    echo $_POST["selectUser"];
                    $selectedUser = $mysqli->query("SELECT users.id as userID FROM users WHERE users.email = '{$_POST["selectUser"]}' ");
                    $selectedUser=mysqli_fetch_assoc($selectedUser);
                    $_SESSION['selectedUserID']= $selectedUser['userID'];
                }
        ?>
        </span>
        <?php
        if(isset($_SESSION['selectedUserID'])){
            if(isset($_POST['delete'])){
                $selectedUser = $mysqli->query("SELECT * FROM users WHERE users.id = '{$_SESSION["selectedUserID"]}' ");
                $selectedUser=mysqli_fetch_assoc($selectedUser);
                printf(mysqli_error($mysqli));
                if (isset($selectedUser['fullname'])){
                    $mysqli->query("INSERT INTO `delusers` (`id`, `fullname`, `email`, `username`, `password`)
                    VALUES (NULL, '{$selectedUser['fullname']}', '{$selectedUser['email']}',
                     '{$selectedUser['username']}', '{$selectedUser['password']}');");
                   printf(mysqli_error($mysqli));
                    $mysqli->query("DELETE FROM `users` WHERE `users`.`id` = '{$_SESSION['selectedUserID']}'");
                   printf(mysqli_error($mysqli));
                   $AllUsers = $mysqli->query("SELECT users.email as UserEmail FROM users WHERE users.rights != 'admin'");
                   if(!mysqli_error($mysqli)){
                       echo "Пользователь успешно удалён";
                   }
                }

            }
        }
        ?>
        <?php
if(isset($_POST["selectUser"])){
    echo '
<form method="post">
<button name="delete" class="btn btn-outline-danger" type="submit">Удалить пользователя</button>
</form>
';
}
?>
<p ><a href="../selectAction.php">Вернуться</a> в меню выбора действия</p>
<p class="logout"><a href="../../Logout/Logout.php">Выйти</a> из системы</p>

</div>
</body>
</html>