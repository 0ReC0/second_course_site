<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="confirmed.css" />
</head>
<body>
    <?php
    $message='';
    	if(isset($_POST["UserInputs"])){
            if(!empty($_POST['electricity']) && !empty($_POST['heating']) && !empty($_POST['water']) && !empty($_POST['garbage'])) {
                $electricity= htmlspecialchars($_POST['electricity']);
                $heating=htmlspecialchars($_POST['heating']);
               $water=htmlspecialchars($_POST['water']);
               $garbage=htmlspecialchars($_POST['garbage']);
               echo "$electricity $heating $water $garbage";
            }
            else {
                $message="Все поля должны быть заполнены";
            }
        }
    ?>
    <form class="UserInputs" name="UserInputs" method="post">
    <span style="grid-row:1; font-size:20px;color:red;"><?php echo $message; ?></span>
    <span style="grid-row:2;font-size:20px;font-weight:bold;">Введите стостояния счётчиков</span>
    <label style="grid-row:3;">Электроэнергия<input type="number" name="electricity"></label>
    <label style="grid-row:4;">Отопление<input name="heating" type="number"></label>
    <label style="grid-row:5;">Водоснабжение<input name="water" type="number"></label>
    <span style="grid-row:6;font-size:20px;font-weight:bold;">Введите количество кв м вашей жил площади</span>
    <label style="grid-row:7;">Вывод ТБО<input name="garbage" type="number"></label>
    <label style="grid-row:8;"><input type="submit" name="UserInputs" value="Показать отчёт"></label>
    <p style="grid-row:9;"><a href="../../Logout/Logout.php">Выйти</a> из системы</p>
    </form>
</body>
</html>