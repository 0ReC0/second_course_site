<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="CountUtilities.css" />
</head>
<body>
    <div class="Container">
<?php require_once("../DataBase/connection.php");?> 
<?php

session_start();
require_once("../IpAddress/IpAddress.php");
if(!isset($_SESSION["session_email"])){
    header("Location: http://${IpAddress}/site/Login/Login.php",true,301);
}
?>
        <?php
        $selectedUtilities = $mysqli->query("SELECT users.id as usersid , utilities.serviceid as serviceid,
        utilities.servicename as servicename, utilities.value as servicecost FROM utilities,
        users WHERE utilities.userid = '{$_SESSION['session_userid']}' AND users.email = '{$_SESSION['session_email']}'");
            printf(mysqli_error($mysqli));
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
            <?php
            if(isset($_POST["addUtiliti"])){
                $addingVar=$mysqli->query("SELECT servicelist.cost as addingcost 
                FROM servicelist WHERE servicelist.name = '{$_POST["addUtiliti"]}'");
                $servicename=$_POST["addUtiliti"];
                $userid = (integer) $_SESSION['session_userid'];
                $servicecost = mysqli_fetch_assoc($addingVar);
                $servicecost = (integer) $servicecost['addingcost'];
                $mysqli->query("INSERT INTO `utilities` ( `serviceid`, `value`, `userid`, `servicename`)
                 VALUES (NULL, '$servicecost', '$userid', '$servicename')");
                echo mysqli_error($mysqli);
                $selectedUtilities = $mysqli->query("SELECT users.id as usersid , utilities.serviceid as serviceid,
                utilities.servicename as servicename, utilities.value as servicecost FROM utilities,
                users WHERE utilities.userid = users.id AND users.email = '{$_SESSION['session_email']}'");
                    printf(mysqli_error($mysqli));
            }
            ?>

    </div>
    <!-- Counting Utilities -->
    <div id="Counting_Utilities" class="Counting_Utilities">
            <table>
            <thead>
                <tr>
                    <th>Ваши коммунальные услуги</th>
                    <th>Стоимость</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_POST["deleteUtiliti"])){
                    $id=htmlspecialchars($_POST['deleteUtiliti']);
                    $mysqli->query("DELETE FROM `utilities` WHERE `utilities`.`serviceid` = $id");
                    $selectedUtilities = $mysqli->query("SELECT users.id as usersid , utilities.serviceid as serviceid,
                    utilities.servicename as servicename, utilities.value as servicecost FROM utilities,
                    users WHERE utilities.userid = users.id AND users.email = '{$_SESSION['session_email']}'");
                        printf(mysqli_error($mysqli));
                }
                $summary_cost=0;
        while ($row = mysqli_fetch_assoc($selectedUtilities)) {
            echo '<tr>';
            echo '<td>'.$row["servicename"].'</td>';
            echo '<td>'.$row["servicecost"].'</td>';
            echo '<td>
            <form name="deleteUtiliti" method="post">
                <button type="submit" name="deleteUtiliti" value="'.$row["serviceid"].'">
                x
                </button>
            </form>
            </td>';
            echo '</tr>';
            $summary_cost=$summary_cost+$row["servicecost"];
        };
        ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <hr>
                        Стоимость к оплате
                    </td>
                <td> 
                    <hr>
                    <?php echo $summary_cost; ?> 
                </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- END Counting Utilities -->

<p class="logout"><a href="../Logout/Logout.php">Выйти</a> из системы</p>

</body>
</html>