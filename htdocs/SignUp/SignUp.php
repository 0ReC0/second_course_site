<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="SignUp.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		        <title>Подсчёт коммунальных услуг</title>
    <link rel="shortcut icon" type="image/png" href="../assets/icons/favicon.png"/>
    <link rel="stylesheet" href="../assets/bootstrap-dist/css/bootstrap.min.css"crossorigin="anonymous">
</head>
<body class="MainStyle">
<?php require_once("../DataBase/connection.php"); ?> 
<?php
$message = "";

if (isset($_POST["register"])) {

	if (!empty($_POST['FullName']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
		$FullName = htmlspecialchars($_POST['FullName']);
		$FullName=addslashes($FullName);
		$email = htmlspecialchars($_POST['email']);
		$email=addslashes($email);
		$username = htmlspecialchars($_POST['username']);
		$username=addslashes($username);
		$password = htmlspecialchars($_POST['password']);
		$query = $mysqli->query("SELECT * FROM users WHERE email='" . $email . "'");
		$numrows = mysqli_num_rows($query);

		if ($numrows == 0) {
			$sql = "INSERT INTO users
				(fullname, email, username,password)
				VALUES('$FullName','$email', '$username', '$password')";
			$result = $mysqli->query($sql);
			if ($result) {
				$message = "Аккаунт успешно создан";
				header("Location: /Login/Login.php", true, 301);
			} else {
				$message = "Ошибка вставки информации!";
			}
		} else {
			$message = "Данный Email уже существует!";
		}
	} else {
		$message = "Все поля обязательны для заполнения!";
	}
}
?>
<div class="register">
	<h1>Регистрация</h1>
	<p class="error"><label for="error"><?php echo $message; ?></label></p>
	<form action="SignUp.php" method="post"name="registerform">

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text" id="inputGroup-sizing-default">Полное имя</span>
			</div>
			<input type="text" class="form-control" name="FullName"size="32"  type="text" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text" id="inputGroup-sizing-default">E-mail</span>
			</div>
			<input type="text" class="form-control" name="email" size="32"type="email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text" id="inputGroup-sizing-default">Имя пользователя</span>
			</div>
			<input type="text" class="form-control" name="username"size="20" type="text" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text" id="inputGroup-sizing-default">Пароль</span>
			</div>
			<input type="text" class="form-control" name="password" size="32" type="password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
		</div>

		<p class="submit"><input class="SignUpButton btn btn-outline-info" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
		<p class="regtext">Уже зарегистрированы? <a href= "https://utilities-count.000webhostapp.com/Login/Login.php">Войти</a></p>
	</form>
</div>

</body>
</html>