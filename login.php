<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        h1 { font-size: 2.3em; font-weight: bold; }
        .myform {
            padding: 2em; max-width: 420px; width: 100%;
            background: #222; color: #fff;
            box-shadow: 10px 10px 10px rgba(192,192,192,0.5); border-radius: 8px;
        }
        .form-control:focus { box-shadow: inset 0 -1px 0 #7e7e7e; }
        .form-control { background-color: inherit; color: #fff; padding-left:0; border:0; border-radius:0; border-bottom:1px solid #fff; }
        .btn { width:100%; font-weight:800; border-radius:0; padding:0.5em 0; }
        .btn:hover { background-color:inherit; color:#fff; border-color:#fff; }
        p { text-align:center; padding-top:2em; color:grey; }
        p a { color:#e1e1e1; text-decoration:none; }
        p a:hover { color:#fff; }
    </style>
</head>
<body class="bg-dark">
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="myform">
        <h1 class="text-center">ADMIN</h1>

        <form action="login_check.php" method="POST">
            <div class="mb-3 mt-4">
                <label class="form-label">User</label>
                <input type="text" class="form-control" name="username" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button type="submit" class="btn btn-light mt-3">LOGIN</button>
            <p class="text-center mt-3"><a href="reset.php">Forgot your Password?</a></p>
        </form>

        <?php
        if (isset($_SESSION['error'])) {
            echo "
            <script>
                var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
                myModal.show();
            </script>";
            unset($_SESSION['error']);
        }
        ?>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Login Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php if(isset($_SESSION['error'])) echo $_SESSION['error']; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>