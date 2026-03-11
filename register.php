<?php
include("config.php");

$message="";

if(isset($_POST['register'])){

$nom=$_POST['nom'];
$email=$_POST['email'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);

$sql="INSERT INTO utilisateurs(nom,email,password)
VALUES('$nom','$email','$password')";

if(mysqli_query($conn,$sql)){
$message="Account Created!";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<link rel="stylesheet" href="auth.css">
</head>

<body>

<div class="container">

<div class="left-panel">

<h2>LALAPA</h2>

<img src="img/hero-img-2.png">

<div class="buttons">
<a href="login.php" class="btn-outline">LOG IN</a>
<a href="register.php" class="btn-white">SIGN UP</a>
</div>

</div>

<div class="right-panel">

<h2>Create Account</h2>

<form method="POST">

<label>Name</label>
<input type="text" name="nom" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<input type="password" name="password" required>

<p class="success"><?php echo $message;?></p>

<button name="register">SIGN UP</button>

</form>

</div>

</div>

</body>
</html>
