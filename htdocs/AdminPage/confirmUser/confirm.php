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
    <link rel="stylesheet" type="text/css" media="screen" href="confirm.css" />
            <title>Подсчёт коммунальных услуг</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/icons/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../assets/bootstrap-dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    <div class="actions">
                <?php
                $AllUsers = $mysqli->query("SELECT users.email as UserEmail FROM users WHERE users.rights = 'user'");
                ?>
                <p><label>Выберите email пользователя
                    <form method="post">
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
                </label></p>
                <?php
                $_SESSION['EditedUserId']='';
                $_SESSION['EditedUserUtilitiImportant']='';
                    if(isset($_POST["selectUser"])){
                $_SESSION['selectedUser']=$_POST["selectUser"];
                $selectedUtilities = $mysqli->query("SELECT users.id as usersid , utilities.serviceid as serviceid,
                utilities.servicename as servicename, utilities.important as serviceimportant FROM utilities,
                    users WHERE users.email = '{$_SESSION['selectedUser']}' AND users.rights = 'user' AND users.id = utilities.userid");
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
                        users WHERE users.email = '{$_SESSION['selectedUser']}' AND users.rights = 'user' AND users.id = utilities.userid");
                    printf(mysqli_error($mysqli));
                    
                }
                ?>
            <!-- Counting Utilities -->
            <div id="Counting_Utilities" class="Counting_Utilities">
                        <div class="mb-3">Выбранный пользователь <?php
                        if(isset($_SESSION["selectedUser"])){
                            echo $_SESSION["selectedUser"];
                        }
                        ?></div>
                    <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>Название услуги</th>
                            <th>Стоимость</th>
                            <th>Обязательность</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if(isset($_SESSION['selectedUser']) && isset($selectedUtilities)){
                        $selectedUtilities = $mysqli->query("SELECT utilities.serviceid as serviceid,
                        utilities.servicename as servicename,utilities.rate as servicerate,
                        utilities.important as serviceimportant,users.id as userId FROM utilities,
                        users WHERE users.email = '{$_SESSION['selectedUser']}' AND users.rights = 'user' AND users.id = utilities.userid");
                        $selectedUtiliti = mysqli_fetch_assoc($selectedUtilities);
                        $_SESSION['selectedUserID'] = $selectedUtiliti["userId"];
                    while ($row = mysqli_fetch_assoc($selectedUtilities)) {
                        echo '<tr>';
                        echo '<td>'.$row["servicename"].'</td>';
                        echo '<td>'.$row["servicerate"].'</td>';
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
                        }else{
                            echo "Пользователь не подтвержден";
                        }
                    }
                }
                ?>
                    </tbody>
                </table>
            </div>
            <!-- END Counting Utilities -->

        <form method="post" class="d-flex justify-content-center">
        <button type="submit" class="btn btn-outline-success mb-3" name="confirm" type="submit">Подтвердить пользователя</button>
        </form>
        <p ><a href="../selectAction.php">Вернуться</a> в меню выбора действия</p>
        <p class="logout"><a href="../../Logout/Logout.php">Выйти</a> из системы</p>
    </div>
</body>
</html>