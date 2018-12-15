<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="Login.css" />
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
	// вывод "Session is set"; // в целях проверки
    header("Location: http://${IpAddress}/site/CountUtilities/CountUtilities.php",true,301);
}

	if(isset($_POST["login"])){

    $message = 'Unexpected error';
	if(!empty($_POST['email']) && !empty($_POST['password'])) {
	$email=htmlspecialchars($_POST['email']);
	$password=htmlspecialchars($_POST['password']);
	$query =$mysqli->query("SELECT * FROM users WHERE email='".$email."' AND password='".$password."'");
	$numrows=mysqli_num_rows($query);
	if($numrows!=0)
 {
while($row=mysqli_fetch_assoc($query))
 {
    $dbemail=$row['email'];
    $dbid=$row['id'];
    $dbpassword=$row['password'];
    $dbrights=$row['rights'];
    $dbconfirmation=$row['confirmation'];
 }
  if($email == $dbemail && $password == $dbpassword)
 {
	 $_SESSION['session_email']=$email;	 
     $_SESSION['session_userid']=$dbid;
     $_SESSION['session_rights']=$dbrights;
     $_SESSION['session_confirmation']=$dbconfirmation;

     require_once("checkRights.php");
    }
	} else {
	 $message = "Invalid email or password!";
 }
	} else {
    $message = "All fields are required!";
	}
	}
    ?>
        
    <form action='' name="login" class="LoginArea" method="post">
        <h1 class="LoginTitle">
            Войдите в систему
        </h1>
        <p class="error">
            <?php
            echo $message;
            ?>
        </p>
        <div class="UserEmailArea">
            <h3 class="EmailTitle">
                Email
            </h3>
            <input id="email" name="email" value="" size="32" class="EmailInput" placeholder="Введите Email" type="email">
        </div>
        <div class="UserPasswordArea">
            <h3 class="PasswordTitle">
                Пароль
            </h3>
            <input id="password" name="password" value="" size="32" class="PasswordInput" placeholder="Введите Пароль" type="password">
        </div>
        <div class="LoginButtons">
            <button class="SignInButton" name="login" type="submit">
                Войти
            </button>
            <button class="SignUpButton" formaction="../SignUp/SignUp.php">
                Зарегистрироваться
            </button>
        </div>
    </form>
</body>
</html>