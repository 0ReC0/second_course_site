<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="Login.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../bootstrap-dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body class="MainStyle">
<?php
    session_start();
    $message=''
	?>

    <?php require_once("../DataBase/connection.php");?> 
    <?php
    require_once("../IpAddress/IpAddress.php");
    if(isset($_SESSION["session_email"])){
        require_once("checkRights.php");
    }

	if(isset($_POST["login"])){

        $message = 'Неожиданная ошибка';
        if(!empty($_POST['email']) && !empty($_POST['password'])) {
            $email=htmlspecialchars($_POST['email']);
            $password=htmlspecialchars($_POST['password']);
            // Запрос на существование данных аккаунта с такими email и паролем в системе
            $query =$mysqli->query("SELECT * FROM users WHERE email='".$email."' AND password='".$password."'");
            $numrows=mysqli_num_rows($query);
            if($numrows!=0)
            {
                while($row=mysqli_fetch_assoc($query))
                {
                    $dbemail=$row['email'];
                    $dbfullname=$row['fullname'];
                    $dbid=$row['id'];
                    $dbpassword=$row['password'];
                    $dbrights=$row['rights'];
                    $dbconfirmation=$row['confirmation'];
                }
                if($email == $dbemail && $password == $dbpassword)
                {
                    $_SESSION['session_email']=$email;	 
                    $_SESSION['session_userid']=$dbid;
                    $_SESSION['session_userFullname']=$dbfullname;
                    $_SESSION['session_rights']=$dbrights;
                    $_SESSION['session_confirmation']=$dbconfirmation;

                    require_once("checkRights.php");
                }
            } else {
                $message = "Неправильный Email или пароль!";
            }
        } else {
        $message = "Все поля обязательны для заполнения!";
        }
	}
    ?>
        
    <form action='' name="login" class="LoginArea" method="post">
        <h2 class="LoginTitle">
            Войдите в систему
        </h2>
        <p class="error">
            <?php
            echo $message;
            ?>
        </p>
        <div class="UserEmailArea">
            <h5 class="EmailTitle">
                Email
            </h5>
            <input id="email" name="email" value="" size="32" class="EmailInput" placeholder="Введите Email" type="email">
        </div>
        <div class="UserPasswordArea">
            <h5 class="PasswordTitle">
                Пароль
            </h5>
            <input id="password" name="password" value="" size="32" class="PasswordInput" placeholder="Введите Пароль" type="password">
        </div>
        <div class="LoginButtons">
            <button class="SignInButton btn btn-outline-primary" name="login" type="submit">
                Войти
            </button>
            <button class="SignUpButton btn btn-outline-primary" formaction="../SignUp/SignUp.php">
                Зарегистрироваться
            </button>
        </div>
    </form>
</body>
</html>