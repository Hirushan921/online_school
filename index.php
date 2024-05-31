<?php
session_start();
require "connection.php";
if (isset($_SESSION["user"])) {
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edu-Web Home</title>
    <link rel="icon" href="resources/elogo.png" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="style.css">
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="resources/elogo.png" height="80" width="80">
      </div>

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>

          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-comments"></i>
            </a>
          </li>
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a> -->
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
          <img src="resources/elogo.png" class="brand-image img-circle elevation-3 bg-white" style="opacity: .8">
          <span class="brand-text font-weight-light"><b>Edu-Web</b></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <?php
            // profile img 
              $profileimg = Database::search("SELECT * FROM `images` WHERE `user_id`='" . $_SESSION["user"]["id"] . "'");
              $pn = $profileimg->num_rows;
              if ($pn == 1) {
                $p = $profileimg->fetch_assoc();
              ?>
              <img src="<?php echo $p["path"]; ?>" class="img-circle elevation-2" alt="User Image">
              <?php
              } else {
              ?>
              <img src="resources/demouserimg.jpg" class="img-circle elevation-2" alt="User Image">
              <?php
              }
              ?>
            </div>
            <!-- user name  -->
            <div class="info">
              <a href="#" class="d-block"><?php echo $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"];  ?></a>
            </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>

          <?php
          if ($_SESSION["user"]["user_type_id"] == 1) {
          ?>
            <!--student sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                  <a href="index.php" class="nav-link" >
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" onclick="loadStudentProfile();">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                      My Profile
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-book"></i>
                    <p>
                      Lesson Notes
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-file"></i>
                    <p>
                      Exam & Assignments
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-credit-card"></i>
                    <p>
                      Payments
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-key"></i>
                    <p>
                      Security
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-clipboard"></i>
                    <p>
                      Notices
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-question-circle"></i>
                    <p>
                      Help & Contacts
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" onclick="logoutModal();">
                    <i class="nav-icon fa fa-arrow-circle-left"></i>
                    <p>
                      Log out
                    </p>
                  </a>
                </li>
              </ul>
            </nav>
            <!-- student sidebar-menu -->
          <?php
          }
          if ($_SESSION["user"]["user_type_id"] == 2) {
          ?>
            <!--Teacher sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                  <a href="index.php" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" onclick="loadUserProfile();">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                      My Profile
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" >
                    <i class="nav-icon fa fa-address-book"></i>
                    <p>
                      Lesson Notes
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-file"></i>
                    <p>
                      Exam & Assignments
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" >
                    <i class="nav-icon fa fa-address-book"></i>
                    <p>
                      Answer Sheets & Marks
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-key"></i>
                    <p>
                      Security
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-clipboard"></i>
                    <p>
                      Notices
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-question-circle"></i>
                    <p>
                      Help & Contacts
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" onclick="logoutModal();">
                    <i class="nav-icon fa fa-arrow-circle-left"></i>
                    <p>
                      Log out
                    </p>
                  </a>
                </li>
              </ul>
            </nav>
            <!-- A.officer sidebar-menu -->
          <?php
          }
          if ($_SESSION["user"]["user_type_id"] == 3) {
          ?>
            <!--A.officer sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                  <a href="index.php" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" onclick="loadUserProfile();">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                      My Profile
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" onclick="loadRegisterStudents();">
                    <i class="nav-icon fa fa-address-book"></i>
                    <p>
                      Register Students
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-file"></i>
                    <p>
                      Exam & Assignments
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-key"></i>
                    <p>
                      Security
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-clipboard"></i>
                    <p>
                      Notices
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-question-circle"></i>
                    <p>
                      Help & Contacts
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" onclick="logoutModal();">
                    <i class="nav-icon fa fa-arrow-circle-left"></i>
                    <p>
                      Log out
                    </p>
                  </a>
                </li>
              </ul>
            </nav>
            <!-- A.officer sidebar-menu -->
          <?php
          }
          if ($_SESSION["user"]["user_type_id"] == 4) {
          ?>
            <!--Admin sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                  <a href="index.php" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" id="mp" onclick="loadAdminProfile();">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                      My Profile
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" id="ar" onclick="loadAOfficerRegistration();">
                    <i class="nav-icon fa fa-address-book"></i>
                    <p>
                      A.Oficcer Registration
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" id="tr" onclick="loadTeacherRegistration();">
                    <i class="nav-icon fa fa-address-card"></i>
                    <p>
                      Teacher Registration
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" onclick="loadManageAOfficers();">
                    <i class="nav-icon fa fa-university"></i>
                    <p>
                      Manage A.Officers
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" onclick="loadManageTeachers();">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                      Manage Teachers
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-graduation-cap"></i>
                    <p>
                      Manage Students
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" >
                    <i class="nav-icon fa fa-check-square"></i>
                    <p>
                      Check Results
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" onclick="logoutModal();">
                    <i class="nav-icon fa fa-arrow-circle-left"></i>
                    <p>
                      Log out
                    </p>
                  </a>
                </li>
              </ul>
            </nav>
            <!-- Admin sidebar-menu -->
          <?php
          }
          ?>



        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" id="content">


        <!-- ///////
        /////// -->

        
      </div>
      <!-- /.content-wrapper -->
      <?php
        require "logoutmodal.php";
        ?>

      <footer class="main-footer">
        <strong>Copyright &copy; 2022 eduweb.lk</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 1.0
        </div>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->



    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
    <script src="script.js"></script>

  </body>

  </html>

<?php
} else {
  // if user not signin 
?>
  <script>
    window.location = "entrance.php";
  </script>
<?php
}
?>