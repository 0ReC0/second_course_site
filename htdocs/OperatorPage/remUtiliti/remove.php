<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="remove.css" />
            <title>Подсчёт коммунальных услуг</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/icons/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../assets/bootstrap-dist/css/bootstrap.min.css"crossorigin="anonymous">
</head>
<body>
<?php require_once("../../DataBase/connection.php");?> 

<?php
    $message='';
    $availableUtilities = $mysqli->query("SELECT servicelist.name as serviceName  FROM servicelist");
    if(isset($_POST["remUtiliti"]) && $_POST["remUtiliti"] != '' ){
        $remName=$_POST["remUtiliti"];
        $remId=$mysqli->query("SELECT servicelist.id as serviceId , servicelist.name as serviceName FROM servicelist WHERE servicelist.name='{$remName}'");
        $Id = mysqli_fetch_array($remId);
        $remId=$Id["serviceId"];
        $mysqli->query("DELETE FROM `servicelist` WHERE `servicelist`.`id` = $remId");
       if(!mysqli_error($mysqli)){
                $message="Услуга успешно удалена";   
            }else{
                $message="Услуга не удалена";     
            }
        $availableUtilities = $mysqli->query("SELECT servicelist.name as serviceName FROM servicelist");
    }

?>
<div class="actions">
            <div style="text-align:center;font-size:20px;" class="align-self-center">
                Выберите услугу
            </div>
            <div class="align-self-center"><?php echo $message;?></div>
            <form method="post">
            <div class="input-group">
                    <select class="custom-select"  name="remUtiliti" id="inputGroupSelect04" aria-label="Example select with button addon">
                        <option disabled selected>Выберите услугу</option>
                        <?php 
                        while( $row = mysqli_fetch_assoc($availableUtilities) ) {
                            echo '<option>'.$row["serviceName"].'</option>';
                        };
                        ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-danger" type="submit">Удалить</button>
                    </div>
            </div>
            </form>  
    <p style="grid-row:4;"><a href="/selectAction.php">Вернуться</a> в меню выбора действия</p>
    <p style="grid-row:5;"><a href="/Logout/Logout.php">Выйти</a> из системы</p>
            </div>
</body>
</html>