<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    $_SESSION['login_user'] = "admin";
    $_SESSION['login_pass'] = "admin";
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === $_SESSION['login_user'] && $password === $_SESSION['login_pass']) {
    header("Location: index.php");
    exit;
}

$_SESSION['error'] = "Incorrect username or password";
header("Location: login.php");
exit;