<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php
	
	if(isset($_POST["register"])){
	
	if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
  $full_name= htmlspecialchars($_POST['full_name']);
	$email=htmlspecialchars($_POST['email']);
 $username=htmlspecialchars($_POST['username']);
 $password=htmlspecialchars($_POST['password']);
 $query=$con->query("SELECT * FROM users WHERE username='".$username."'");
  $numrows=mysqli_num_rows($query);

if($numrows==0)
   {
	$sql="INSERT INTO users
  (fullname, email, username,password)
	VALUES('$full_name','$email', '$username', '$password')";
  $result=$con->query($sql);
 if($result){
	$message = "Account Successfully Created";
} else {
 $message = "Failed to insert data information!";
  }
	} else {
	$message = "That username already exists! Please try another one!";
   }
	} else {
	$message = "All fields are required!";
	}
	}
	?>

	<?php if (!empty($message)) {echo "<p>" . "MESSAGE: ". $message . "</p>";} ?>
<div class="container mregister">
<div id="login">
 <h1>Регистрация</h1>
<form action="register.php" id="registerform" method="post"name="registerform">
 <p><label for="user_login">Полное имя<br>
 <input class="input" id="full_name" name="full_name"size="32"  type="text" value=""></label></p>
<p><label for="user_pass">E-mail<br>
<input class="input" id="email" name="email" size="32"type="email" value=""></label></p>
<p><label for="user_pass">Имя пользователя<br>
<input class="input" id="username" name="username"size="20" type="text" value=""></label></p>
<p><label for="user_pass">Пароль<br>
<input class="input" id="password" name="password"size="32"   type="password" value=""></label></p>
<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
	  <p class="regtext">Уже зарегистрированы? <a href= "login.php">Введите имя пользователя</a>!</p>
 </form>
</div>
</div>
<?php include("includes/footer.php"); ?>
