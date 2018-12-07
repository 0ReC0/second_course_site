<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="SignUp.css" />
</head>
<body class="MainStyle">
<?php require_once("../DataBase/connection.php");?> 
<?php
		require_once("../IpAddress/IpAddress.php");
	$message= "";
    
	if(isset($_POST["register"])){
	
	if(!empty($_POST['FullName']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
  $FullName= htmlspecialchars($_POST['FullName']);
	$email=htmlspecialchars($_POST['email']);
 $username=htmlspecialchars($_POST['username']);
 $password=htmlspecialchars($_POST['password']);
 $query=$mysqli->query("SELECT * FROM users WHERE email='".$email."'");
  $numrows=mysqli_num_rows($query);

if($numrows==0)
   {
	$sql="INSERT INTO users
  (fullname, email, username,password)
	VALUES('$FullName','$email', '$username', '$password')";
  $result=$mysqli->query($sql);
 if($result){
    $message = "Account Successfully Created";
    header("Location: http://${IpAddress}/site/Login/Login.php",true,301);
} else {
 $message = "Failed to insert data information!";
  }
	} else {
	$message = "That Email already exists!";
   }
	} else {
	$message = "All fields are required!";
	}
	}
	?>
<div class="register">
 <h1>Регистрация</h1>
 <p class="error"><label for="error"><?php echo $message; ?></label></p>
<form action="SignUp.php" method="post"name="registerform">

 <p><label for="user_login">Полное имя<br>
 <input class="input" id="FullName" name="FullName"size="32"  type="text" value=""></label></p>

<p><label for="user_pass">E-mail<br>
<input class="input" id="email" name="email" size="32"type="email" value=""></label></p>

<p><label for="user_pass">Имя пользователя<br>
<input class="input" id="username" name="username"size="20" type="text" value=""></label></p>

<p><label for="user_pass">Пароль<br>
<input class="input" id="password" name="password" size="32" type="password" value=""></label></p>

<p class="submit"><input class="SignUpButton" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
	  <p class="regtext">Уже зарегистрированы? <a href= "../Login/Login.php">Введите имя пользователя</a>!</p>
 </form>
</div>

</body>
</html>