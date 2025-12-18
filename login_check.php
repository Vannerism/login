<?php
session_start();
include "config.php";

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === $_SESSION['login_user'] && $password === $_SESSION['login_pass']) {
    header("Location: index.php"); 
    exit();
} else {
    $_SESSION['error'] = "Incorrect username or password.";
    header("Location: login.php");
    exit();
}