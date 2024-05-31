<?php
session_start();
require "connection.php";
if (isset($_SESSION["user"])) {
?>

    <!-- academic officer side approval register  -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student Registration</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Stuent Registration</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">

            <!-- send verification email table  -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-info"><b>Approve & Send Verification Code</b> </h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered  table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Fullname</th>
                                        <th>Birthday</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th class="text-danger">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $puserrs = Database::search("SELECT * FROM `user` WHERE `user_type_id`='1' AND `email_status_id`='2' AND `login_status_id`='2'");
                                    $pusern = $puserrs->num_rows;
                                    $no = "0";
                                    if ($pusern > 0) {
                                        for ($x = 0; $x < $pusern; $x++) {
                                            $puserd = $puserrs->fetch_assoc();
                                            $no = $no + 1;

                                            $genderq = Database::search("SELECT * FROM `gender` WHERE `id`='" . $puserd["gender_id"] . "'");
                                            $genderd = $genderq->fetch_assoc();
                                            $addq = Database::search("SELECT * FROM `address` WHERE `id`='" . $puserd["address_id"] . "'");
                                            $add = $addq->fetch_assoc();
                                            $cityq = Database::search("SELECT * FROM `city` WHERE `id`='" . $add["city_id"] . "'");
                                            $city = $cityq->fetch_assoc();

                                    ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $puserd["id"]; ?></td>
                                                <td><?php echo $puserd["fullname"]; ?></td>
                                                <td><?php echo $puserd["birthday"]; ?></td>
                                                <td><?php echo $genderd["name"]; ?></td>
                                                <td><?php echo $puserd["email"]; ?></td>
                                                <td><?php echo $puserd["mobile"]; ?></td>
                                                <td><?php echo $add["line1"]; ?>,<br /><?php echo $add["line2"]; ?>,<br /><?php echo $city["name"]; ?></td>
                                                <td>
                                                    <button class="btn btn-primary" onclick="sendRegisterEmailS('<?php echo $puserd['id']; ?>');">Send Email</button>
                                                    <button class="btn btn-dark">Remove</button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                <p>No Pending Students.</p>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>


            <!-- email sent but not login  yet  -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-success"><b>Email Sent & Not Verified Yet</b></h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered  table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Fullname</th>
                                        <th>Birthday</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>User name</th>
                                        <th>Verification Code</th>
                                        <th>Registered Date</th>
                                        <th class="text-danger">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $suserrs = Database::search("SELECT * FROM `user` WHERE `user_type_id`='1' AND `email_status_id`='1' AND `login_status_id`='2'");
                                    $susern = $suserrs->num_rows;
                                    $no2 = "0";
                                    if ($susern > 0) {
                                        for ($y = 0; $y < $susern; $y++) {
                                            $suserd = $suserrs->fetch_assoc();
                                            $no2 = $no2 + 1;

                                            $genderq2 = Database::search("SELECT * FROM `gender` WHERE `id`='" . $suserd["gender_id"] . "'");
                                            $genderd2 = $genderq2->fetch_assoc();
                                            $addq2 = Database::search("SELECT * FROM `address` WHERE `id`='" . $suserd["address_id"] . "'");
                                            $add2 = $addq2->fetch_assoc();
                                            $cityq2 = Database::search("SELECT * FROM `city` WHERE `id`='" . $add2["city_id"] . "'");
                                            $city2 = $cityq2->fetch_assoc();

                                    ?>
                                            <tr>
                                                <td><?php echo $no2; ?></td>
                                                <td><?php echo $suserd["id"]; ?></td>
                                                <td><?php echo $suserd["fullname"]; ?></td>
                                                <td><?php echo $suserd["birthday"]; ?></td>
                                                <td><?php echo $genderd2["name"]; ?></td>
                                                <td><?php echo $suserd["email"]; ?></td>
                                                <td><?php echo $suserd["mobile"]; ?></td>
                                                <td><?php echo $add2["line1"]; ?>,<br /><?php echo $add2["line2"]; ?>,<br /><?php echo $city2["name"]; ?>.</td>
                                                <td><?php echo $suserd["username"]; ?></td>
                                                <td><?php echo $suserd["verification_code"]; ?></td>
                                                <td>
                                                    <?php
                                                    $urdrslt = Database::search("SELECT * FROM `registration` WHERE `user_id`='" . $suserd["id"] . "' ");
                                                    $urd = $urdrslt->fetch_assoc();
                                                    echo $urd["reg_date"];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $as = $suserd["active_status_id"];
                                                    if ($as == "1") {
                                                    ?>
                                                        <button class="btn btn-dark" onclick="blockuserRS('<?php echo $suserd['id']; ?>')">Block</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn btn-dark" onclick="blockuserRS('<?php echo $suserd['id']; ?>')">Unblock</button>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="12" class="text-center">
                                                <p>No Non Verified Students.</p>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </section>

<?php
}
?>