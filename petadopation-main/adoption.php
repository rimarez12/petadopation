<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id'])){
    header("Location: Login.php");
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$animal_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($animal_id <= 0){
    header("Location: pets.php?error=invalid_animal");
    exit;
}

$check = mysqli_prepare($conn, "SELECT id FROM demandes_adoption WHERE user_id = ? AND animal_id = ? LIMIT 1");
mysqli_stmt_bind_param($check, "ii", $user_id, $animal_id);
mysqli_stmt_execute($check);
$existing = mysqli_stmt_get_result($check);

if($existing && mysqli_fetch_assoc($existing)){
    header("Location: pets.php?info=already_requested");
    exit;
}

$stmt = mysqli_prepare($conn, "INSERT INTO demandes_adoption(user_id, animal_id) VALUES(?, ?)");
mysqli_stmt_bind_param($stmt, "ii", $user_id, $animal_id);
mysqli_stmt_execute($stmt);

header("Location: pets.php?success=request_sent");
exit;
?>