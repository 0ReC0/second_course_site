<?php require_once("../../DataBase/connection.php");
session_start();?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="report.css" />
            <title>Подсчёт коммунальных услуг</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/icons/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../assets/bootstrap-dist/css/bootstrap.min.css"  crossorigin="anonymous">
</head>
<body>
    <?php
        $selectedUtilities = $mysqli->query("SELECT utilities.value as utilitiValue , utilities.rate as servicerate FROM utilities,
        users WHERE users.email = '{$_SESSION['session_email']}' AND users.id = utilities.userid");
        printf(mysqli_error($mysqli));
        $summarycost=0;
        while($Utiliti = mysqli_fetch_assoc($selectedUtilities)){
            $summarycost=$summarycost + ($Utiliti['utilitiValue']*$Utiliti['servicerate']);
        }
    ?>
    <table>
    <thead>
    <tr>
        <th style="border-right:1px solid black" >
            Извещение
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="border-right:1px solid black">
        </td>

        <td>
            ФИО: <?php echo $_SESSION['session_userFullname']; ?>
        </td>
    </tr>
    <tr>
        <td style="border-right:1px solid black">
        </td>

        <td>
            Адрес: <?php echo $_SESSION['session_email']; ?>
        </td>
    </tr>
    <tr>
        <td style="border-right:1px solid black">
        </td>

        <td>
            Период оплаты: <?php
            $_monthsList = array(
        "1"=>"Январь","2"=>"Февраль","3"=>"Март",
        "4"=>"Апрель","5"=>"Май", "6"=>"Июнь",
        "7"=>"Июль","8"=>"Август","9"=>"Сентябрь",
        "10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");
         
        $month = $_monthsList[date("n")].' '.date("Y");
         
        echo $month;
        ?>
        </td>
        </tr>
        <tr>
            <td style="border-right:1px solid black">
            </td>
    
            <td>
                Лицевой счёт: <?php echo $_SESSION['session_userid']; ?>
            </td>
        </tr>
        <tr>
            <td style="border-right:1px solid black">
            </td>
    
            <td>
                Всего к оплате: <?php echo $summarycost ?> ₽
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td style="border-right:1px solid black"></td>
            <td>Дата оплаты:</td>
            <td></td>
            <td>Подпись плательщика:</td>
            <td style="width: 100px;"></td>
            <td>Дата формирования: <?php echo date("d.m.y") ?></td>
            <td style="width: 100px;"></td>
        </tr>
        </tfoot>
    </table>

    <hr>

    <table id="utilities">
    <thead>
    <tr>
        <th style="border-right:1px solid black">
            Квитанция
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="border-right:1px solid black">
        </td>

        <td>
            ФИО: <?php echo $_SESSION['session_userFullname']; ?>
        </td>
    </tr>
    <tr>
        <td style="border-right:1px solid black">
        </td>

        <td>
            Адрес: <?php echo $_SESSION['session_email']; ?>
        </td>
    </tr>
    <tr>
        <td style="border-right:1px solid black">
            </td>
            
            <td>
                Период оплаты: <?php 
            $_monthsList = array(
        "1"=>"Январь","2"=>"Февраль","3"=>"Март",
        "4"=>"Апрель","5"=>"Май", "6"=>"Июнь",
        "7"=>"Июль","8"=>"Август","9"=>"Сентябрь",
        "10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");
         
        $month = $_monthsList[date("n")].' '.date("Y");
         
        echo $month;
        ?>
        </td>
    </tr>
    <tr>
        <td style="border-right:1px solid black">
            </td>
            
            <td>
                Лицевой счёт: <?php echo $_SESSION['session_userid']; ?>
            </td>
        </tr>
        <tr>
            <td style="border-right:1px solid black">
                </td>
                <td>
                    <table class="table">
                        <thead>
                            <th style="border:1px solid black;">Вид платежа</th>
                            <th style="border:1px solid black;">Конечн. обьём</th>
                            <th style="border:1px solid black;">Тариф</th>
                            <th style="border:1px solid black;">Всего</th>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($_SESSION['session_email'])){
                        $selectedUtilities = $mysqli->query("SELECT utilities.servicename as servicename,utilities.value as utilitiValue ,
                        utilities.rate as servicerate FROM utilities,users 
                        WHERE users.email = '{$_SESSION['session_email']}' AND users.id = utilities.userid");
                        printf(mysqli_error($mysqli));
                        while($Utiliti = mysqli_fetch_assoc($selectedUtilities)){
                            
                            echo '<tr>
                            <td style="border:1px solid black;">
                            '.$Utiliti['servicename'].'
                            </td>
                            
                            <td style="border:1px solid black;">
                            '.$Utiliti['utilitiValue'].'
                            </td>
                            
                            <td style="border:1px solid black;">
                            '.$Utiliti['servicerate'].' ₽
                            </td>
                            
                            <td style="border:1px solid black;">
                            '.$Utiliti['utilitiValue']*$Utiliti['servicerate'].' ₽
                            </td>
                            </tr>';
                    
                        }
                        }   
                ?>
                         </tbody>
                         <tfoot>
                    <tr>
                        <td>
                            Всего к оплате:
                        </td>
                        <td>
                        <?php echo $summarycost ?> ₽
                        </td>
                    </tr>
                </tfoot>
            </table>
            </td>
        </tr>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    <button id="btn" class="no-print btn btn-outline-info" style="width:100%;height:40px;" 
    onclick="document.getElementById('btn').style.display = 'none';
    print();
    document.getElementById('btn').style.display = 'block';">
        Распечатать
    </button>
</body>
</html>