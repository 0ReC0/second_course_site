<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="CountUtilities.css" />
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
        $AllUsers = $mysqli->query("SELECT users.email as UserEmail FROM users WHERE users.rights = 'user'");
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
        </label></p>
        <?php
        $_SESSION['EditedUserId']='';
        $_SESSION['EditedUserUtilitiImportant']='';
            if(isset($_POST["selectUser"])){
        $_SESSION['selectedUser']=$_POST["selectUser"];
        $selectedUtilities = $mysqli->query("SELECT utilities.serviceid as serviceid, users.id as userId,
        utilities.servicename as servicename, utilities.important as serviceimportant FROM utilities,
        users WHERE users.email = '{$_SESSION['selectedUser']}' AND users.rights = 'user' AND users.id = utilities.userid");
        $selectedUtiliti=mysqli_fetch_assoc($selectedUtilities);
        $_SESSION['EditedUserId']=$selectedUtiliti["userId"];
        $_SESSION['EditedUserUtilitiImportant']=$selectedUtiliti["serviceimportant"];
            printf(mysqli_error($mysqli));
        }
        if(isset($_POST["addUtiliti"])){
            $addingVar=$mysqli->query("SELECT servicelist.rate as addingcost, servicelist.important as serviceimportant
                    FROM servicelist WHERE servicelist.name = '{$_POST["addUtiliti"]}'");
            $servicename=$_POST["addUtiliti"];
            $service = mysqli_fetch_assoc($addingVar);
            $serviceimportant = $service['serviceimportant'];
            $servicecost = (integer) $service['addingcost'];
            $editedUser=$mysqli->query("SELECT users.id as UserId FROM users WHERE users.email = '{$_SESSION['selectedUser']}' ");
            $editedUser=mysqli_fetch_assoc($editedUser);
           $mysqli->query("INSERT INTO `utilities` ( `serviceid`, `rate`, `userid`, `servicename`,`important`)
                VALUES (NULL, '$servicecost', '{$editedUser['UserId']}', '$servicename','$serviceimportant')");
            $selectedUtilities = $mysqli->query("SELECT utilities.serviceid as serviceid,
            utilities.servicename as servicename, utilities.important as serviceimportant FROM utilities,
            users WHERE users.email = '{$_SESSION['selectedUser']}' AND users.rights = 'user' AND users.id = utilities.userid");
            
        }
        ?>
        <?php
        $availableUtilities = $mysqli->query("SELECT servicelist.name as serviceName FROM servicelist");
        ?>
    <div class="Select_Utiliti">
        <p><label>Выберите услугу
            <form method="post">
            <select name="addUtiliti">
                <option disabled selected>Выберите услугу</option>
                <?php
                while( $row = mysqli_fetch_assoc($availableUtilities) ) {
                    echo '<option>'.$row["serviceName"].'</option>';
                };
                ?>
            </select>
                <input type="submit" value="Добавить" >
            </form>
        </label><p>

    </div>
    <!-- Counting Utilities -->
    <div id="Counting_Utilities" class="Counting_Utilities">
                <span>Выбранный пользователь <?php
                if(isset($_SESSION["selectedUser"])){
                    echo $_SESSION["selectedUser"];
                }
                 ?></span>
            <table>
            <thead>
                <tr>
                    <th>Все коммунальные услуги</th>
                    <th>Стоимость</th>
                    <th>Обязательная</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_POST["deleteUtiliti"])){
                    $id=htmlspecialchars($_POST['deleteUtiliti']);
                    $mysqli->query("DELETE FROM `utilities` WHERE `utilities`.`serviceid` = $id");
                    $selectedUtilities = $mysqli->query("SELECT utilities.serviceid as serviceid,
                        utilities.servicename as servicename, utilities.important as serviceimportant FROM utilities,
                        users WHERE users.email = '{$_SESSION['selectedUser']}' AND users.rights = 'user'");
                    printf(mysqli_error($mysqli));
                }
                if(isset($_SESSION['selectedUser']) && isset($selectedUtilities)){
                    $selectedUtilities = $mysqli->query("SELECT utilities.serviceid as serviceid,
                    utilities.servicename as servicename,utilities.rate as servicecost, utilities.important as serviceimportant FROM utilities,
                    users WHERE users.email = '{$_SESSION['selectedUser']}' AND users.rights = 'user' AND users.id = utilities.userid");
                    while ($row = mysqli_fetch_assoc($selectedUtilities)) {
                        echo '<tr>';
                        echo '<td>'.$row["servicename"].'</td>';
                        echo '<td>'.$row["servicecost"].'</td>';
                        if ($row["serviceimportant"] == '1'){
                            echo '<td>Да</td>';
                        }else{
                            echo '<td>Нет</td>';
                        }
                        echo '<td>
                        <form name="deleteUtiliti" method="post">
                            <button type="submit" name="deleteUtiliti" value="'.$row["serviceid"].'">
                            x
                            </button>
                        </form>
                        </td>';
                        echo '</tr>';
                    };
                }
        ?>
            </tbody>
        </table>
    </div>
    <!-- END Counting Utilities -->
<p ><a href="../selectAction.php">Вернуться</a> в меню выбора действия</p>
<p class="logout"><a href="../../Logout/Logout.php">Выйти</a> из системы</p>
</div>
</body>
</html>