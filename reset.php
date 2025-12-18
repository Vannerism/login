<?php
session_start();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['current_user'] === $_SESSION['login_user']) {
        $_SESSION['login_user'] = $_POST['new_user'];
        $_SESSION['login_pass'] = $_POST['new_pass'];
        $message = "Credentials updated";
    } else {
        $message = "Incorrect current username";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Reset</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="d-flex justify-content-center align-items-center vh-100">
<div style="width:400px">

<form method="POST">
    <label>Current Username</label>
    <input name="current_user" class="form-control" required>

    <label class="mt-2">New Username</label>
    <input name="new_user" class="form-control" required>

    <label class="mt-2">New Password</label>
    <input name="new_pass" type="password" class="form-control" required>

    <button class="btn btn-light w-100 mt-3">Save</button>
</form>

<?php if ($message) echo "<div class='alert alert-info mt-3'>$message</div>"; ?>

<a href="login.php" class="btn btn-secondary w-100 mt-3">Back</a>

</div>
</div>
</body>
</html>