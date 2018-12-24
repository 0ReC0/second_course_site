<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="report.css" />
</head>
<body>
<?php require_once("../../DataBase/connection.php");
session_start();?> 
<?php
    require_once("../../IpAddress/IpAddress.php");
    ?>
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
        <th class="leftSide" >
            Извещение
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="leftSide">
        </td>

        <td>
            ФИО: <?php echo $_SESSION['session_userFullname']; ?>
        </td>
    </tr>
    <tr>
        <td class="leftSide">
        </td>

        <td>
            Адрес: <?php echo $_SESSION['session_email']; ?>
        </td>
    </tr>
    <tr>
        <td class="leftSide">
        </td>

        <td>
            Период оплаты: <?php 
        setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');  
        echo strftime("%B, %Y", time());
        ?>
        </td>
        </tr>
        <tr>
            <td class="leftSide">
            </td>
    
            <td>
                Лицевой счёт: <?php echo $_SESSION['session_userid']; ?>
            </td>
        </tr>
        <tr>
            <td class="leftSide">
            </td>
    
            <td>
                Всего к оплате: <?php echo $summarycost ?> ₽
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td class="leftSide"></td>
            <td>Дата оплаты:</td>
            <td></td>
            <td>Подпись плательщика:</td>
            <td class="space"></td>
            <td>Дата формирования: <?php echo date("d.m.y") ?></td>
            <td class="space"></td>
        </tr>
        </tfoot>
    </table>

    <hr>

    <table id="utilities">
    <thead>
    <tr>
        <th class="leftSide">
            Квитанция
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="leftSide">
        </td>

        <td>
            ФИО: <?php echo $_SESSION['session_userFullname']; ?>
        </td>
    </tr>
    <tr>
        <td class="leftSide">
        </td>

        <td>
            Адрес: <?php echo $_SESSION['session_email']; ?>
        </td>
    </tr>
    <tr>
        <td class="leftSide">
            </td>
            
            <td>
                Период оплаты: <?php 
        setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');  
        echo strftime("%B, %Y", time());
        ?>
        </td>
    </tr>
    <tr>
        <td class="leftSide">
            </td>
            
            <td>
                Лицевой счёт: <?php echo $_SESSION['session_userid']; ?>
            </td>
        </tr>
        <tr>
            <td class="leftSide">
                </td>
                <td>
                    <table>
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
                         <tfoot >
                    <tr style="border:1px solid black;">
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
    <button id="btn" class="no-print" style="width:100%;height:40px;" 
    onclick="document.getElementById('btn').style.display = 'none';
    print();
    document.getElementById('btn').style.display = 'block';">
        Распечатать
    </button>
</body>
</html>