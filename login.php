<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">

<div class="d-flex justify-content-center align-items-center vh-100">
<div class="bg-secondary p-4 rounded" style="width:400px">

<form action="login_check.php" method="POST">
    <label class="text-white">Username</label>
    <input type="text" name="username" class="form-control" required>

    <label class="text-white mt-3">Password</label>
    <input type="password" name="password" class="form-control" required>

    <button class="btn btn-light w-100 mt-4">LOGIN</button>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger mt-3'>".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
    }
    ?>
</form>

<a href="reset.php" class="text-white d-block mt-3">Forgot password?</a>

</div>
</div>
</body>
</html>