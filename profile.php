<?php require_once "assets/php/header.php"; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card rounded-0 mt-3 border-success">
                <div class="card-header border-success">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#profile" class="nav-link active font-weight-bold" data-toggle="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#editProfile" class="nav-link font-weight-bold" data-toggle="tab">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#changePass" class="nav-link font-weight-bold" data-toggle="tab">Change Password</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Inicio Tab Content Profile -->
                        <div class="tab-pane container active" id="profile">
                            <div id="verifyEmailAlert"></div>
                            <div class="card-deck">
                                <div class="card border-success">
                                    <div class="card-header bgexito text-light text-center lead">
                                        User ID: <?= $cid; ?>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text p-2 mt-2 rounded" style="border:1px solid #62c479;"><b>Name: </b><?= $cname; ?></p>

                                        <p class="card-text p-2 mt-2 rounded" style="border:1px solid #62c479;"><b>E-mail: </b><?= $cemail; ?></p>

                                        <p class="card-text p-2 mt-2 rounded" style="border:1px solid #62c479;"><b>Gender: </b><?= $cgender; ?></p>

                                        <p class="card-text p-2 mt-2 rounded" style="border:1px solid #62c479;"><b>Date of Birth: </b><?= $cdob; ?></p>

                                        <p class="card-text p-2 mt-2 rounded" style="border:1px solid #62c479;"><b>Phone: </b><?= $cphone; ?></p>

                                        <p class="card-text p-2 mt-2 rounded" style="border:1px solid #62c479;"><b>Registered On: </b><?= $reg_on; ?></p>

                                        <p class="card-text p-2 mt-2 rounded" style="border:1px solid #62c479;"><b>E-Mail verified: </b> <span class="<?php echo ($verified == 'Verified!') ? 'text-info' : 'text-danger' ?>"><?= $verified; ?></span>
                                            <?php if ($verified == "Not Verified!") : ?>
                                                <a href="#" id="verify-email" class="float-right">Verify Now</a>
                                            <?php endif; ?>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="card border-success align-self-center">
                                    <?php if (!$cphoto) : ?>
                                        <img src="assets/img/avatar2.png" class="img-thumbnail img-fluid" alt="photo profile" width="408px" />
                                    <?php else : ?>
                                        <img src="<?= 'assets/php/' . $cphoto; ?>" alt="photo profile" class="img-thumbnail img-fluid" width="408px" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Tab Content Profile -->

                        <!-- Inicio Tab Content Edit Profile -->
                        <div class="tab-pane container fade" id="editProfile">
                            <div class="card-deck">
                                <div class="card border-danger align-self-center">
                                    <?php if (!$cphoto) : ?>
                                        <img src="assets/img/avatar2.png" class="img-thumbnail img-fluid" alt="photo profile" width="408px" />
                                    <?php else : ?>
                                        <img src="<?= 'assets/php/' . $cphoto; ?>" alt="photo profile" class="img-thumbnail img-fluid" width="408px" />
                                    <?php endif; ?>
                                </div>
                                <div class="card border-danger">
                                    <form action="" method="post" class="px-3 mt-2" enctype="multipart/form-data" id="profile-update-form">
                                        <input type="hidden" name="oldimage" value="<?= $cphoto; ?>">
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="profilePhoto">
                                                <label class="custom-file-label" for="profilePhoto" aria-describedby="profilePhoto">Upload Image</label>
                                            </div>
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="name" class="m-1">Name</label>
                                            <input type="text" name="name" id="name" placeholder="Your Name" class="form-control" value="<?= $cname; ?>">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="gender" class="m-1">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="" disabled <?php if ($cgender == null) {
                                                                                echo 'selected';
                                                                            } ?>>Select</option>
                                                <option value="Male" <?php if ($cgender == 'Male') {
                                                                            echo 'selected';
                                                                        } ?>>Male</option>
                                                <option value="Female" <?php if ($cgender == 'Female') {
                                                                            echo 'selected';
                                                                        } ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="dob" class="m-1">Date of Birth</label>
                                            <input type="date" id="dob" name="dob" value="<?= $cdob; ?>" class="form-control">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="phone" class="m-1">Phone</label>
                                            <input type="tel" id="phone" name="phone" value="<?= $cphone; ?>" class="form-control" placeholder="Phone">
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="submit" value="Update Profile" name="profile_update" class="btn btn-danger btn-block" id="profileUpdatedBtn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Tab Content Edit Profile -->

                        <!-- Inicio Tab Content Change Password -->
                        <div class="tab-pane container fade" id="changePass">
                            <div id="changePassAlert"></div>
                            <div class="card-deck">
                                <div class="card border-warning">
                                    <div class="card-header bgadvert text-center text-white lead">
                                        Change Password
                                    </div>
                                    <form action="#" method="post" class="px-3 mt-2" id="change-pass-form">
                                        <div class="form-group">
                                            <label for="curpass">Enter Your Current Password</label>
                                            <input type="password" name="curpass" placeholder="Current Password" class="form-control form-control-lg" id="curpass" required minlength="6">
                                        </div>
                                        <div class="form-group">
                                            <label for="newpass">Enter New Password</label>
                                            <input type="password" name="newpass" placeholder="New Password" class="form-control form-control-lg" id="newpass" required minlength="6">
                                        </div>
                                        <div class="form-group">
                                            <label for="cnewpass">Enter New Password</label>
                                            <input type="password" name="cnewpass" placeholder="Confirm New Password" class="form-control form-control-lg" id="cnewpass" required minlength="6">
                                        </div>
                                        <div class="form-group">
                                            <p id="changePassError" class="text-danger"></p>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Change Password" name="changepass" class="btn btn-warning btn-block btn-lg" id="changePassBtn">
                                        </div>
                                    </form>
                                </div>
                                <div class="card border-warning align-self-center">
                                    <img src="assets/img/changepass.jpg" alt="change password" class="img-thumbnail img-fluid" width="408px">
                                </div>
                            </div>
                        </div>
                        <!-- Fin Tab Content Change Password -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CDN JQUERY.MIN.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<!-- CDN BOOTSTRAP.BUNDLE.MIN.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha512-kBFfSXuTKZcABVouRYGnUo35KKa1FBrYgwG4PAx7Z2Heroknm0ca2Fm2TosdrrI356EDHMW383S3ISrwKcVPUw==" crossorigin="anonymous"></script>
<!-- CDN JS FONTAWESOME -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js" integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg==" crossorigin="anonymous"></script>
<!-- CUSTOM JS -->
<script type="text/javascript" src="assets/js/profile.js"></script>
</body>

</html>