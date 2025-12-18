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
<style>
    body.bg-dark {
        background: linear-gradient(135deg, #1c1c1c, #2a2a2a) !important;
    }
    .bg-secondary {
        background-color: #2f2f2f !important;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    label {
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    .form-control {
        background-color: #1e1e1e;
        border: 1px solid #444;
        color: #fff;
    }
    .form-control:focus {
        background-color: #1e1e1e;
        color: #fff;
        border-color: #adb5bd;
        box-shadow: none;
    }
    .btn-light {
        border-radius: 25px;
        font-weight: 500;
        transition: 0.3s;
    }
    .btn-light:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.4);
    }
    a.text-white:hover {
        color: #adb5bd !important;
    }

    h1 {
    color: #fff;
    text-align: center;
    font-weight: 600;
    letter-spacing: 1px;
    margin-bottom: 20px;
}
</style>
</head>
<body class="bg-dark">

<div class="d-flex justify-content-center align-items-center vh-100">
<div class="bg-secondary p-4 rounded" style="width:400px">

<h1>ADMIN</h1>

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
