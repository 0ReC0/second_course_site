<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="remove.css" />
</head>
<body>
<?php require_once("../../DataBase/connection.php");?> 

<?php
    $availableUtilities = $mysqli->query("SELECT servicelist.name as serviceName  FROM servicelist");
    if(isset($_POST["remUtiliti"]) && $_POST["remUtiliti"] != '' ){
        $remName=$_POST["remUtiliti"];
        $remId=$mysqli->query("SELECT servicelist.id as serviceId , servicelist.name as serviceName FROM servicelist WHERE servicelist.name='{$remName}'");
        $Id = mysqli_fetch_array($remId);
        $remId=$Id["serviceId"];
        $mysqli->query("DELETE FROM `servicelist` WHERE `servicelist`.`id` = $remId");
        $availableUtilities = $mysqli->query("SELECT servicelist.name as serviceName FROM servicelist");
    }

?>
<div class="actions">Выберите услугу
            <form method="post">
            <select name="remUtiliti">
                <option disabled selected>Выберите услугу</option>
                <?php 
                while( $row = mysqli_fetch_assoc($availableUtilities) ) {
                    echo '<option>'.$row["serviceName"].'</option>';
                };
                ?>
            </select>
                <input type="submit" value="Удалить" >
            </form>
            
    <p style="grid-row:6;"><a href="../selectAction.php">Вернуться</a> в меню выбора действия</p>
    <p style="grid-row:7;"><a href="../../Logout/Logout.php">Выйти</a> из системы</p>
            </div>
</body>
</html>