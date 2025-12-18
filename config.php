<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    $_SESSION['login_user'] = "admin"; // default username
}
if (!isset($_SESSION['login_pass'])) {
    $_SESSION['login_pass'] = "admin"; // default password
}
?>