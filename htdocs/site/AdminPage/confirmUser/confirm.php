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
        $selectedUtilities = $mysqli->query("SELECT users.id as usersid , utilities.serviceid as serviceid,
        utilities.servicename as servicename, utilities.important as serviceimportant FROM utilities,
            users WHERE users.email = '{$_SESSION['selectedUser']}' AND users.rights = 'user'");
        $selectedUtiliti=mysqli_fetch_assoc($selectedUtilities);
        $_SESSION['EditedUserId']=$selectedUtiliti["usersid"];
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
            $mysqli->query("INSERT INTO `utilities` ( `serviceid`, `value`, `userid`, `servicename`,`important`)
                VALUES (NULL, '$servicecost', '{$_SESSION['EditedUserId']}', '$servicename','$serviceimportant')");
            echo mysqli_error($mysqli);
            $selectedUtilities = $mysqli->query("SELECT users.id as usersid , utilities.serviceid as serviceid,
            utilities.servicename as servicename, utilities.important as serviceimportant FROM utilities,
                users WHERE users.email = '{$_SESSION['selectedUser']}' AND users.rights = 'user'");
            printf(mysqli_error($mysqli));
            
        }
        ?>
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
                </tr>
            </thead>
            <tbody>
                <?php
            if(isset($_SESSION['selectedUser']) && isset($selectedUtilities)){
                $selectedUtilities = $mysqli->query("SELECT utilities.serviceid as serviceid,
                utilities.servicename as servicename,utilities.value as servicecost,
                 utilities.important as serviceimportant,users.id as userId FROM utilities,
                users WHERE users.email = '{$_SESSION['selectedUser']}' AND users.rights = 'user'");
                $selectedUtiliti = mysqli_fetch_assoc($selectedUtilities);
                $_SESSION['selectedUserID'] = $selectedUtiliti["userId"];
            while ($row = mysqli_fetch_assoc($selectedUtilities)) {
                echo '<tr>';
                echo '<td>'.$row["servicename"].'</td>';
                echo '<td>'.$row["servicecost"].'</td>';
                if($row["serviceimportant"] == '1'){
                    echo '<td>Да</td>';
                }
                else {
                    echo '<td>Нет</td>';
                }
                echo '<td>
                </td>';
                echo '</tr>';

            };
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
            </tbody>
        </table>
    </div>
    <!-- END Counting Utilities -->

<form method="post">
<button name="confirm" type="submit">Подтвердить пользователя</button>
</form>
<p ><a href="../selectAction.php">Вернуться</a> в меню выбора действия</p>
<p class="logout"><a href="../../Logout/Logout.php">Выйти</a> из системы</p>
</div>
</body>
</html>