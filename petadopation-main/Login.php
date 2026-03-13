<?php
session_start();
include("config.php");

$message="";

if(isset($_POST['login'])){

$email=$_POST['email'];
$password=$_POST['password'];

$stmt = mysqli_prepare($conn, "SELECT * FROM utilisateurs WHERE email = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = $result ? mysqli_fetch_assoc($result) : null;

if($user && (int)($user['actif'] ?? 1) === 1 && password_verify($password,$user['password'])){

$_SESSION['user_id']=$user['id'];
$_SESSION['nom']=$user['nom'];
$_SESSION['role']=$user['role'];

if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
  header("Location: admin/index.php");
} else {
  header("Location: user/index.php");
}

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
<img src="img/logoblanc.png" alt="loog" width="50px" height="70px"> 

<img src="img/login2.png" alt="pet">

<div class="buttons">
<a href="Login.php" class="btn-outline">LOG IN</a>
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
