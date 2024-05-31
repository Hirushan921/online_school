<?php
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edu-Web Registration</title>
    <link rel="icon" href="resources/elogo.png" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<!-- teacher and officers register form  -->

<body class="login-background">

    <div class="container-fluid ">

        <div class="row align-content-center">

            <div class="card card-outline card-primary col-10 offset-1 col-lg-6 offset-lg-3 mt-4 mb-3">
                <div class="card-header">
                    <!-- logo & title  -->
                    <div class="row">
                        <div class="logo col-5 col-lg-6"></div>
                        <label class="h1 col-7 col-lg-6 mt-4"><b>Edu-Web</b></label>
                    </div>
                </div>
                <div class="card-body">
                    <p class="login-box-msg"><b>Registration</b></p>

                    <p class="text-danger" id="rmsg"></p>
                    <div class="row">
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <input type="text" class="form-control" placeholder="First Name" id="fname">
                        </div>
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <input type="text" class="form-control" placeholder="Last Name" id="lname">
                        </div>
                        <div class="input-group mb-3 col-12">
                            <input type="text" class="form-control" placeholder="Name with initials" id="fullname">
                        </div>
                        <div class="form-group mb-3 col-12 col-lg-6">
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" placeholder="Birthday" class="form-control datetimepicker-input" data-target="#reservationdate" id="bdy" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <select class="form-control" id="title">
                                <option value="0">Title</option>
                                <?php
                        $tr = Database::search("SELECT * FROM `user_title`");
                        $trn = $tr->num_rows;
                        for ($x = 0; $x < $trn; $x++) {
                          $trd = $tr->fetch_assoc();
                        ?>
                          <option value="<?php echo $trd["id"]; ?>"><?php echo $trd["name"]; ?></option>
                        <?php
                        }
                        ?>
                        </select>
                        </div>
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <input type="text" class="form-control" placeholder="Address line 01" id="adline1">
                        </div>
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <input type="text" class="form-control" placeholder="Address line 02" id="adline2">
                        </div>
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <input type="text" class="form-control" placeholder="City" id="city">
                        </div>
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <input type="text" class="form-control" placeholder="NIC Number" id="nic">
                        </div>
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <input type="text" class="form-control" placeholder="Contact Number" id="contact">
                        </div>
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <input type="text" class="form-control" placeholder="Username" id="username">
                        </div>
                        <div class="input-group mb-3 col-12">
                            <input type="email" class="form-control" placeholder="Email" id="email">
                        </div>
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <input type="password" class="form-control" placeholder="Password" id="password">
                        </div>
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <input type="text" class="form-control" placeholder="Verification Code" id="vcode">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <button class="btn btn-primary btn-block" onclick="registerTandO();">Register & Log In</button>
                        </div>
                        <div class="col-12 mt-2">
                            <a href="entrance.php" type="submit" class="btn btn-danger btn-block">Edu-Web Home</a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-12 d-none d-lg-block">
                <p class="text-center foot_title">&copy; 2022 eduweb.lk All Right Reserved</p>
            </div>
        </div>

    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="script.js"></script>
</body>

</html>