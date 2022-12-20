<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start</p>
            <form action="controller/login/LoginController.php" method="post">
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <?php if (isset($_SESSION['error_message']['email_error'])): ?>
                    <span style="color:red"><?php echo $_SESSION['error_message']['email_error']; ?><br></span>
                <?php endif; ?>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?php if (isset($_SESSION['error_message']['password_error'])): ?>
                    <span style="color:red"><?php echo $_SESSION['error_message']['password_error']; ?><br></span>
                <?php endif; ?>
                <?php if (isset($_SESSION['loginFaild_msg'])): ?>
                    <span style="color:red"><?php echo $_SESSION['loginFaild_msg']; ?><br></span>
                <?php endif; ?>
                <div class="row">
<!--                    <div class="col-8">-->
<!--                        <div class="icheck-primary">-->
<!--                            <input type="checkbox" id="remember">-->
<!--                            <label for="remember">-->
<!--                                Remember Me-->
<!--                            </label>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- /.col -->
                    <div class="col-4">
                        <input type="hidden" name="page_source" value="login_page">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
<!--            <p class="mb-1">-->
<!--                <a href="forgot-password.html">I forgot my password</a>-->
<!--            </p>-->
<!--            <p class="mb-0">-->
<!--                <a href="register.html" class="text-center">Register a new membership</a>-->
<!--            </p>-->
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
