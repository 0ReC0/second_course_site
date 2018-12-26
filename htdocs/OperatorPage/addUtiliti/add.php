<?php 
    session_start();
    require_once("../../DataBase/connection.php");
    $message='';
    require_once("../../IpAddress/IpAddress.php");
    if($_SESSION['session_rights'] != 'operator'){
        require_once("../../Login/checkRights.php");
    }
    if(isset($_POST["OperatorInputs"])){
        if(!empty($_POST['name']) && !empty($_POST['rate'])) {
            $name= htmlspecialchars($_POST['name']);
            $rate=htmlspecialchars($_POST['rate']);
            if(isset($_POST["important"]) && $_POST["important"] == "on"){
                $important = 1;
            }
            else{
                $important = 0;
            }
           $mysqli->query("INSERT INTO `servicelist` ( `id`, `name`, `rate`, `important`)
           VALUES (NULL, '$name', '$rate', '$important')");
           if(!mysqli_error($mysqli)){
                $message="Услуга успешно добавлена";   
            }else{
                $message="Услуга не добавлена";   
            }
        }
        else {
            $message="Все поля должны быть заполнены";
        }
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="add.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Подсчёт коммунальных услуг</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/icons/favicon.png"/>
    <link rel="stylesheet" href="../../assets/bootstrap-dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

</head>
<body>
    <div class="actions">
    <span style="grid-row:1; font-size:24px;text-align:center;">Добавление услуги</span>
    <form class="OperatorInputs" name="OperatorInputs" method="post">
        <span style="grid-row:1; font-size:20px;color:red;"><?php echo $message; ?></span>
        <div style="grid-row:2;" class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Название</span>
            </div>
            <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div style="grid-row:3;" class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Коэф услуги</span>
            </div>
            <input type="number" name="rate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <label style="grid-row:4;">Обязательна ли услуга ? <input type="checkbox" name="important"></label>
        <label style="grid-row:5;justify-self:center;"><input type="submit" class="btn btn-outline-success" name="OperatorInputs" value="Добавить услугу"></label>
    </form>
    <p style="grid-row:6;"><a href="../selectAction.php">Вернуться</a> в меню выбора действия</p>
    <p style="grid-row:7;"><a href="../../Logout/Logout.php">Выйти</a> из системы</p>
    </div>

</body>
</html>