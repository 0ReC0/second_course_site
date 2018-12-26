<?php
session_start();
    if(isset($_SESSION['selectedUser'])){
        unset($_SESSION['selectedUser']);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="selectAction.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/bootstrap-dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    <div class="actions">
    <span style="grid-row:1; font-size:20px;text-align:center;">Выберите действие</span>
    <label style="grid-row:2;"><form action="addUtiliti/add.php"><button type="submit" class="btn btn-outline-primary btn-lg btn-block">Добавить коммунальную услугу</button></form></label>
    <label style="grid-row:3;"><form action="remUtiliti/remove.php"><button type="submit" class="btn btn-outline-primary btn-lg btn-block">Удалить коммунальную услугу</button></form></label>
    <label style="grid-row:4;"><form action="attachUtiliti/attach.php"><button type="submit" class="btn btn-outline-primary btn-lg btn-block">Добавление / Удаление услуги конкретного пользователя</button></form></label>
    <p style="grid-row:6;"><a href="../Logout/Logout.php">Выйти</a> из системы</p>
    </div>
</body>
</html>