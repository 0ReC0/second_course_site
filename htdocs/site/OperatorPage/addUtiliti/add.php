<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="add.css" />
</head>
<body>
    <?php require_once("../../DataBase/connection.php");?> 
    <?php
    $message='';
    session_start();
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
           echo "$name $rate $important";
           $mysqli->query("INSERT INTO `servicelist` ( `id`, `name`, `rate`, `important`)
           VALUES (NULL, '$name', '$rate', '$important')");
        }
        else {
            $message="Все поля должны быть заполнены";
        }
    }
    ?>
    <div class="actions">
    <span style="grid-row:1; font-size:20px;text-align:center;">Добавление услуги</span>
    <form class="OperatorInputs" name="OperatorInputs" method="post">
        <span style="grid-row:1; font-size:20px;color:red;"><?php echo $message; ?></span>
        <label style="grid-row:2;">Название<input type="text" name="name"></label>
        <label style="grid-row:3;">Коэф услуги<input type="number" name="rate"></label>
        <label style="grid-row:4;">Обязательна ли услуга ?<input type="checkbox" name="important"></label>
        <label style="grid-row:5;"><input type="submit" name="OperatorInputs" value="Добавить услугу"></label>
    </form>
    <p style="grid-row:6;"><a href="../selectAction.php">Вернуться</a> в меню выбора действия</p>
    <p style="grid-row:7;"><a href="../../Logout/Logout.php">Выйти</a> из системы</p>
    </div>
</body>
</html>