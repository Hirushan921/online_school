<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edu-Web Entrance</title>
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

<body class="entranceimage">

    <div class="container-fluid">

        <div class="row">

            <!-- image and text -->
            <div class="col-lg-8 offset-lg-2 px-5 py-4 mt-5">
                <div class="row">
                    <!-- logo -->
                    <div class="col-6 entrancelogo ">
                    </div>
                    <div class="col-12 col-lg-6">
                        <h1 class="entrancetitle">Edu-Web</h1>
                        <h4 class="entrancetitle">The best & advanced online school for you..</h1><br />
                            <p class="entrancepara">Online education, then, can serve two goals. For 
                            students lucky enough to have access to great teachers, blended learning 
                            can mean even better outcomes at the same or lower cost. And for the 
                            millions here and abroad who lack access to good, in-person education, 
                            online learning can open doors that would otherwise remain closed.</p>
                    </div>
                </div>
            </div>
            <!-- image and text -->
            <div class="col-lg-4 offset-lg-4 col-10 offset-1">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="text-warning">Getting started at,</h3>
                            </div>
                            <!-- select buttons -->
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-2">
                                        <a class="btn btn-app bg-info" onclick="goToLogin(1);">
                                            <i class="fa fa-graduation-cap"></i> Student
                                        </a>
                                    </div>
                                    <div class="col-2 offset-1">
                                        <a class="btn btn-app bg-secondary" onclick="goToLogin(2);">
                                            <i class="fas fa-user"></i> Teacher
                                        </a>
                                    </div>
                                    <div class="col-2 offset-1">
                                        <a class="btn btn-app bg-success" onclick="goToLogin(3);">
                                            <i class="fa fa-cog"></i> A.Officer
                                        </a>
                                    </div>
                                    <div class="col-2 offset-1">
                                        <a class="btn btn-app bg-primary" onclick="goToLogin(4);">
                                            <i class="fa fa-user-secret"></i> Admin
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- footer -->
        <div class="row mt-5">
            <div class="col-12 mt-5">
            <h5 class="text-center"><i class="fa fa-phone-square" aria-hidden="true"></i> 0112481632 | 
            <i class="fa fa-envelope"></i> eduwebsch@gmail.com</h5>
                <h5 class="text-center foot_title">&copy; 2022 eduweb.lk All Right Reserved</h5>
            </div>
        </div>

    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>    
    <script src="script.js"></script>
</body>

</html>