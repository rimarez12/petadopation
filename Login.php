<?php
session_start();
include("config.php");

$message="";

if(isset($_POST['login'])){

$email=$_POST['email'];
$password=$_POST['password'];

$sql="SELECT * FROM utilisateurs WHERE email='$email'";
$result=mysqli_query($conn,$sql);
$user=mysqli_fetch_assoc($result);

if($user && password_verify($password,$user['password'])){

$_SESSION['user_id']=$user['id'];
$_SESSION['nom']=$user['nom'];

header("Location:index.php");

}else{
$message="Wrong email or password";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="auth.css">
</head>

<body>

<div class="container">

<!-- LEFT PANEL -->
<div class="left-panel">

<h2>LALAPA</h2>

<img src="img/login2.png" alt="pet">

<div class="buttons">
<a href="login.php" class="btn-outline">LOG IN</a>
<a href="register.php" class="btn-white">SIGN UP</a>
</div>

</div>

<!-- RIGHT PANEL -->
<div class="right-panel">



<form method="POST">

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<input type="password" name="password" required>

<p class="error"><?php echo $message;?></p>

<button name="login">LOG IN</button>

</form>

</div>

</div>

</body>
</html>
