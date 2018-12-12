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
        $selectedUtilities = $mysqli->query("SELECT users.id as usersid , bill.serviceid as serviceid,
        bill.servicename as servicename, bill.value as servicecost FROM bill,
        users WHERE bill.userid = users.id AND users.email = '{$_SESSION['session_email']}'");
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
                // сделай так чтобы принимать int значение с бд
                $addingVar=$mysqli->query("SELECT servicelist.cost as addingcost 
                FROM servicelist WHERE servicelist.name = '{$_POST["addUtiliti"]}'");
                ///////\\
                echo $_POST["addUtiliti"];
                // echo $addingVar.addingcost;
                //servic
                $servicecost = mysqli_fetch_assoc($addingVar);
                // echo $servicecost['addingcost'];
                $userid = mysqli_fetch_assoc($selectedUtilities);
                echo $userid['usersid'];
                echo $_POST["addUtiliti"];
                echo "Запрос к бд с '{$_POST["addUtiliti"]}' '{$servicecost["addingcost"]}' '{$userid["usersid"]}'";
                $mysqli->query("INSERT INTO `bill` (`serviceid`, `value`, `userid`, `servicename`)
                 VALUES (NULL,'{$servicecost["addingcost"]}', '{$userid["usersid"]}', '{$_POST["addUtiliti"]}')");
                 echo "Конец запроса";
                echo mysqli_error($mysqli);
                // $servicecost["addingcost"]='';
                // $userid["usersid"]='';
                // $_POST["addUtiliti"]='';

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
                </tr>
            </thead>
            <tbody>
                <?php
                $summary_cost=0;
        while ($row = mysqli_fetch_assoc($selectedUtilities)) {
            echo '<tr>';
            echo '<td>'.$row["servicename"].'</td>';
            echo '<td>'.$row["servicecost"].'</td>';
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