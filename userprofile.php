<?php
// teacher or oficer profile 
session_start();
require "connection.php";
if (isset($_SESSION["user"])) {
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                        <!-- profileimg  -->
                            <div class="text-center">
                            <?php
                                $profileimg = Database::search("SELECT * FROM `images` WHERE `user_id`='" . $_SESSION["user"]["id"] . "'");
                                $pn = $profileimg->num_rows;
                                if ($pn == 1) {
                                    $p = $profileimg->fetch_assoc();
                                ?>
                                    <img class="profile-user-img img-fluid img-circle" src="<?php echo $p["path"]; ?>" alt="User profile picture" id="view">
                                <?php
                                } else {
                                ?>
                                 <img class="profile-user-img img-fluid img-circle" src="resources/userupdate.jpg" alt="User profile picture" id="view">
                                <?php
                                }
                                ?>
                                <!-- update image  -->
                                <input type="file" id="profileimg" accept="img/*" class="d-none" />
                                <label class="btn btn-sm btn-secondary mt-3" for="profileimg" onclick="updateImage();">Update Profile Image</label>
                                
                            </div>

                            <?php
                            $uti = $_SESSION["user"]["user_title_id"];
                            $usertitlers = Database::search("SELECT * FROM `user_title` WHERE `id`='" . $uti . "'");
                            $utitle = $usertitlers->fetch_assoc();

                            $utypei = $_SESSION["user"]["user_type_id"];
                            $usertypers = Database::search("SELECT * FROM `user_type` WHERE `id`='" . $utypei . "'");
                            $utype = $usertypers->fetch_assoc();
                            $utypename = $utype["name"];

                            $adi = $_SESSION["user"]["address_id"];
                            $addressrs = Database::search("SELECT * FROM `address` WHERE `id`='" . $adi . "'");
                            $address = $addressrs->fetch_assoc();
                            $city_id = $address["city_id"];
                            $cityrs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
                            $city = $cityrs->fetch_assoc();
                            ?>

                            <h3 class="profile-username text-center"><?php echo $utitle["name"] . ". " . $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"]; ?></h3>

                            <p class="text-muted text-center"><?php echo $utypename; ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <a class="float-left"><i class="fa fa-user"></i> <?php echo $_SESSION["user"]["fullname"]; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <a class="float-left"><i class="fa fa-map-marker"></i> <?php echo $address["line1"] . ", " . $address["line2"] . ", " . $city["name"]; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <a class="float-left"><i class="fa fa-envelope"></i> <?php echo $_SESSION["user"]["email"]; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <a class="float-left"><i class="fa fa-phone-square"></i> <?php echo $_SESSION["user"]["mobile"]; ?></a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>

                <!-- update details card  -->

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2 text-center">
                            <h4>Update Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <p class="text-danger" id="uumsg"></p>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" value="<?php echo $_SESSION["user"]["fname"]; ?>" id="fname">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" value="<?php echo $_SESSION["user"]["lname"]; ?>" id="lname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php echo $_SESSION["user"]["fullname"]; ?>" id="fullname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="title"> 
                                            <?php
                                            $titleid = $_SESSION["user"]["user_title_id"];
                                            $tr = Database::search("SELECT * FROM `user_title` WHERE `id`='" . $titleid . "'");
                                            $td = $tr->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $td["id"]; ?>"><?php echo $td["name"]; ?></option>
                                            <?php
                                            $trr = Database::search("SELECT * FROM `user_title` WHERE `id`!='" . $td["id"] . "'");
                                            $trrn = $trr->num_rows;
                                            for ($x = 0; $x < $trrn; $x++) {
                                                $tdd = $trr->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $tdd["id"]; ?>"><?php echo $tdd["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-4">
                                        <?php
                                        $gen_id = $_SESSION["user"]["gender_id"];
                                        $gen = Database::search("SELECT * FROM `gender` WHERE `id`='" . $gen_id . "'");
                                        $gender = $gen->fetch_assoc();
                                        ?>
                                        <input type="text" class="form-control" value="<?php echo $gender["name"]; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Birthday</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" value="<?php echo $_SESSION["user"]["birthday"]; ?>" readonly>
                                    </div>
                                    <label class="col-sm-2 col-form-label">NIC</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" value="<?php echo $_SESSION["user"]["nic"]; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Address line 01</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" value="<?php echo $address["line1"]; ?>" id="adline1">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Line 02</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" value="<?php echo $address["line2"]; ?>" id="adline2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" value="<?php echo $city["name"]; ?>" id="city">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Mobile</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" value="<?php echo $_SESSION["user"]["mobile"]; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" value="<?php echo $_SESSION["user"]["email"]; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button class="btn btn-danger" onclick="updateUserProfile();">Save</button>
                                    </div>
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