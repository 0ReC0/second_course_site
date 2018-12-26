<?php
session_start();
if(!isset($_SESSION["session_email"])){
    header("Location: /Login/Login.php",true,301);
}
?>
<?php require_once("../../DataBase/connection.php");?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="delete.css" />
            <title>Подсчёт коммунальных услуг</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/icons/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../assets/bootstrap-dist/css/bootstrap.min.css"  crossorigin="anonymous">
</head>
<body>
    <div class="actions">
                <?php
                $AllUsers = $mysqli->query("SELECT users.email as UserEmail FROM users WHERE users.rights != 'admin'");
                ?>
                <p><label> <p style="text-align:center;font-size:20px;">Выберите email пользователя</p>
                    <form method="post" class="mt-3">
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
                <div class="mb-3">Выбранный пользователь 
                <?php
                        if(isset($_POST["selectUser"])){
                            echo $_POST["selectUser"];
                            $selectedUser = $mysqli->query("SELECT users.id as userID FROM users WHERE users.email = '{$_POST["selectUser"]}' ");
                            $selectedUser=mysqli_fetch_assoc($selectedUser);
                            $_SESSION['selectedUserID']= $selectedUser['userID'];
                        }
                ?>
                </div>
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
                            unset($_SESSION['selectedUserID']);
                            echo '<div class="mb-3">Пользователь успешно удалён</div>';
                        }
                        }

                    }
                }
                ?>
                <?php
        if(isset($_POST["selectUser"])){
            echo '
        <form method="post" class="d-flex justify-content-center">
        <button name="delete" class="btn btn-outline-danger mb-3" type="submit">Удалить пользователя</button>
        </form>
        ';
        }
        ?>
        <p ><a href="../selectAction.php">Вернуться</a> в меню выбора действия</p>
        <p class="logout"><a href="../../Logout/Logout.php">Выйти</a> из системы</p>

    </div>
</body>
</html>