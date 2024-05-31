<?php
session_start();
require "connection.php";
if (isset($_SESSION["user"])) {
?>
<!-- admin side manage officers  -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Academic Officers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Manage A.Officers</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">

        <!-- verified officers table  -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-success"><b>Verified Academic Officers</b></h3>
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
                                        <th>Name</th>
                                        <th>Birthday</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>User name</th>
                                        <th>Registered Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $luserrs = Database::search("SELECT * FROM `user` WHERE `user_type_id`='3' AND `email_status_id`='1' AND `login_status_id`='1'");
                                    $lusern = $luserrs->num_rows;
                                    $no = "0";
                                    if ($lusern > 0) {
                                        for ($y = 0; $y < $lusern; $y++) {
                                            $luserd = $luserrs->fetch_assoc();
                                            $no = $no + 1;

                                            $titleq = Database::search("SELECT * FROM `user_title` WHERE `id`='" . $luserd["user_title_id"] . "'");
                                            $titled = $titleq->fetch_assoc();
                                            $genderq = Database::search("SELECT * FROM `gender` WHERE `id`='" . $titled["gender_id"] . "'");
                                            $genderd = $genderq->fetch_assoc();
                                            $addq = Database::search("SELECT * FROM `address` WHERE `id`='" . $luserd["address_id"] . "'");
                                            $add = $addq->fetch_assoc();
                                            $cityq = Database::search("SELECT * FROM `city` WHERE `id`='" . $add["city_id"] . "'");
                                            $city = $cityq->fetch_assoc();
                                    ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $luserd["id"]; ?></td>
                                                <td><?php echo $titled["name"] . ". " . $luserd["fullname"]; ?></td>
                                                <td><?php echo $luserd["birthday"]; ?></td>
                                                <td><?php echo $genderd["name"]; ?></td>
                                                <td><?php echo $add["line1"]; ?>,<br /><?php echo $add["line2"]; ?>,<br /><?php echo $city["name"]; ?>.</td>
                                                <td><?php echo $luserd["email"]; ?></td>
                                                <td><?php echo $luserd["mobile"]; ?></td>
                                                <td><?php echo $luserd["username"]; ?></td>
                                                <td>
                                                    <?php
                                                    $urdrslt = Database::search("SELECT * FROM `registration` WHERE `user_id`='" . $luserd["id"] . "' ");
                                                    $urd = $urdrslt->fetch_assoc();
                                                    echo $urd["reg_date"];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $as = $luserd["active_status_id"];
                                                    if ($as == "1") {
                                                    ?>
                                                        <button class="btn btn-dark" onclick="blockuserMO('<?php echo $luserd['id']; ?>')">Block</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn btn-dark" onclick="blockuserMO('<?php echo $luserd['id']; ?>')">Unblock</button>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <!-- if no verified officers  -->
                                        <tr>
                                            <td colspan="11" class="text-center">
                                                <p>No Verified Officers.</p>
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