<?php
session_start();
include("config.php");

$user_id = $_SESSION['user_id'];
$animal_id = $_GET['id'];

mysqli_query($conn,
"INSERT INTO favoris(user_id,animal_id)
VALUES('$user_id','$animal_id')");
?>