<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../Login.php");
    exit;
}

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../index.php");
    exit;
}
?>
