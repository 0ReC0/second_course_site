<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="report.css" />
</head>
<body>
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
            ФИО: пол_фио
        </td>
    </tr>
    <tr>
        <td class="leftSide">
        </td>

        <td>
            Адрес: пол_почта
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
                Лицевой счёт: пол_id
            </td>
        </tr>
        <tr>
            <td class="leftSide">
            </td>
    
            <td>
                Всего к оплате: util_summary рублей
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
            <td>Дата формирования:</td>
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
            ФИО: пол_фио
        </td>
    </tr>
    <tr>
        <td class="leftSide">
        </td>

        <td>
            Адрес: пол_почта
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
                Лицевой счёт: пол_id
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
                            <tr>
                                <td style="border:1px solid black;">
                                    ut_name
                                </td>
                                
                                <td style="border:1px solid black;">
                                    user_value
                                </td>
                                
                                <td style="border:1px solid black;">
                                    ut_rate
                        </td>

                        <td style="border:1px solid black;">
                        user_value * ut_rate
                        </td>
                    </tr>
                </tbody>
                <tfoot >
                    <tr style="border:1px solid black;">
                        <td>
                            Всего к оплате:
                        </td>
                        <td>
                            ut_summary
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
    <button id="btn" class="no-print" style="width:100%;height:40px;" onclick="document.getElementById('btn').style.display = 'none';print()">
        Распечатать
    </button>
</body>
</html>