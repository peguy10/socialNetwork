
<li class="nav-item dropdown">
    <a href="#" class="   d-flex align-items-center dropdown-toggle" id="drop-down-arrow" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="<?php echo $_SESSION['photo'];?>" class="img-fluid rounded-circle me-3" alt="user">
        <div class="caption">
            <h6 class="mb-0 line-height"><?php echo $_SESSION['user_name'];?></h6>
        </div>
    </a>
    <div class="sub-drop dropdown-menu caption-menu" aria-labelledby="drop-down-arrow">
        <div class="card shadow-none m-0">
            <div class="card-header  bg-primary">
                <div class="header-title">
                    <h5 class="mb-0 text-white">Hello <?php echo $_SESSION['user_name'];?></h5>
                    <span class="text-white font-size-12">Available</span>
                </div>
            </div>
            <div class="card-body p-0 ">
                <a href="profil.php" class="iq-sub-card iq-bg-primary-hover">
                    <div class="d-flex align-items-center">
                        <div class="rounded card-icon bg-soft-primary">
                            <i class="ri-file-user-line"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 ">Mon Profil</h6>
                            <p class="mb-0 font-size-12">Voir mes details personnels.</p>
                        </div>
                    </div>
                </a>
                <!-- <a href="app/profile-edit.html" class="iq-sub-card iq-bg-warning-hover">
                    <div class="d-flex align-items-center">
                        <div class="rounded card-icon bg-soft-warning">
                            <i class="ri-profile-line"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 ">Edit Profile</h6>
                            <p class="mb-0 font-size-12">Modify your personal details.</p>
                        </div>
                    </div>
                </a> -->
                <!-- <a href="app/account-setting.html" class="iq-sub-card iq-bg-info-hover">
                    <div class="d-flex align-items-center">
                        <div class="rounded card-icon bg-soft-info">
                            <i class="ri-account-box-line"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 ">Account settings</h6>
                            <p class="mb-0 font-size-12">Manage your account parameters.</p>
                        </div>
                    </div>
                </a>
                <a href="app/privacy-setting.html" class="iq-sub-card iq-bg-danger-hover">
                    <div class="d-flex align-items-center">
                        <div class="rounded card-icon bg-soft-danger">
                            <i class="ri-lock-line"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 ">Privacy Settings</h6>
                            <p class="mb-0 font-size-12">Control your privacy parameters.
                            </p>
                        </div>
                    </div>
                </a> -->
                <div class="d-inline-block w-100 text-center p-3">
                    <a class="btn btn-primary iq-sign-btn" href="logout.php" role="button">Sign
                        out<i class="ri-login-box-line ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</li>