<?php
session_start();
require "connection.php";
if (isset($_SESSION["user"])) {
?>

<!-- user dashboard  -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

            <!-- main card  -->
                <div class="col-md-12">
                    <div class="card card-outline card-primary outline-primary shadow">
                        <!-- <div class="card-header p-2 text-center">
                            
                        </div> -->
                        <div class="card-body">
                            <div class="tab-content">

                            <!-- logo and texts -->
                                <div class="row">
                                    <div class="col-md-6 dashboardlogo">
                                    </div>
                                    <div class="col-md-6">
                                    <h4><b>WELLCOME!</b></h4>
                                        <h3 class="text-info"><b>EDU-WEB</b></h3>
                                        <h4>Best & Advanced Online School..</h4>
                                        <h5><i class="fa fa-phone-square" aria-hidden="true"></i> 0112481632</h5>
                                        <h5><i class="fa fa-envelope"></i> eduwebsch@gmail.com</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- image  -->
                                <div class="col-md-12 dashimg d-md-block d-none">
                                </div>

                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


<?php
}
?>