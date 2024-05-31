<?php
session_start();

if (isset($_SESSION["uti"])) {
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edu-Web Login</title>
    <link rel="icon" href="resources/elogo.png" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="hold-transition login-page login-background">


    <div class="login-box">

        <!-- /.login-logo -->
        <div class="card card-outline card-primary outline-primary shadow">
            <div class="card-header ">
                <div class="row">
                    <div class="logo col-4"></div>
                    <label class="h1 col-8 mt-4"><b>Edu-Web</b></label>
                </div>
            </div>
            <div class="card-body">
                <!-- user type  -->
                <p class="login-box-msg title1">
                    <?php
                        if ($_SESSION["uti"] == 1) {
                        ?> Student<?php
                        }
                        if ($_SESSION["uti"] == 2) {
                        ?> Teacher<?php
                        }
                        if ($_SESSION["uti"] == 3) {
                        ?> Academic Officer<?php
                        }
                        if ($_SESSION["uti"] == 4) {
                        ?> Admin<?php
                        }
                        ?> Login</p>
                <?php
                    if ($_SESSION["uti"] == 4) {
                        ?>
                <!-- admin email  -->
                <p class="text-danger" id="lmsg"></p>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Email" id="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <?php
                    }else{
                        ?>
                <?php
                                // $u = "";
                                // $p = "";
                                // if (isset($_COOKIE["u"])) {
                                //     $u = $_COOKIE["u"];
                                // }
                                // if (isset($_COOKIE["p"])) {
                                //     $p = $_COOKIE["p"];
                                // }
                                ?>
                <!-- other user input  -->
                <p class="text-danger" id="lomsg"></p>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="User name" id="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    ?>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                  if ($_SESSION["uti"] != 4) {
                    ?>
                    <div class="col-12">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <?php
                  }
                  ?>
                    <div class="col-12 mt-2">
                        <?php
                  if ($_SESSION["uti"] == 4) {
                    ?>
                        <button class="btn btn-primary btn-block" onclick="adminLogin();">Sign In</button>
                        <?php
                  }else{
                    ?>
                        <button class="btn btn-primary btn-block"
                            onclick="userLogin('<?php echo $_SESSION['uti']; ?>');">Sign In</button>
                        <?php
                  }
                  ?>
                    </div>
                    <!-- /.col -->
                </div>

                <!-- student register bttn  -->
                <div class="social-auth-links text-center mt-2 mb-3">
                    <?php
                  if ($_SESSION["uti"] == 1) {
                    ?>
                    <a class="btn btn-block btn-danger" href="registerstudent.php">
                        <i class="fa fa-user-plus mr-2"></i> Register a new membership
                    </a>
                    <?php
                    }else if ($_SESSION["uti"] == 2 || $_SESSION["uti"] == 3) {
                        ?>
                    <!-- teacher and officer register bttn  -->
                    <button class="btn btn-block btn-danger" data-toggle="modal" onclick="sendmaindetailsmodal();">
                        <i class="fa fa-user-plus mr-2"></i> Register a new membership
                    </button>
                    <?php
                        }
                    ?>

                </div>

                <?php
                    require "sendmaindetailsmodal.php";
                    require "adminverifymodal.php";
                    require "firstloginverifymodal.php";
                    ?>

                <?php
                  if ($_SESSION["uti"] != 4) {
                    ?>
                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <?php
                  }
                  ?>
                <p class="mb-0">
                    <a href="entrance.php">Sign in from other user.</a>
                </p>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <div class="row">
        <div class="col-12 d-none d-lg-block">
            <p class="text-center foot_title">&copy; 2022 eduweb.lk All Right Reserved</p>
        </div>
    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- modal viewing -->
    <script src="script.js"></script>
</body>

</html>
<?php
} else {
?>
<!-- if not selected user go to entrane  -->
<script>
window.location = "entrance.php";
</script>
<?php
}
?>