<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container-fluid">
            <!-- Logo container-->
            <div class="logo">
                <!-- Text Logo -->
                    <!--<a href="index.html" class="logo">-->
                    <!--<span class="logo-small"><i class="mdi mdi-radar"></i></span>-->
                    <!--<span class="logo-large"><i class="mdi mdi-radar"></i> Adminto</span>-->
                    <!--</a>-->
                    <!-- Image Logo -->
                <a href="/national-logistic" class="logo">
                    <img src="<?php echo base_url('assets/images/logo.png')?>" alt="" height="26" class="logo-small">
                    <img src="<?php echo base_url('assets/images/logo.png')?>" alt="" height="70" style="padding: 8px 0px 10px 0px" class="logo-large">
                </a>
            </div>
            <!-- End Logo container-->
            <div class="menu-extras topbar-custom">
                <ul class="list-unstyled topbar-right-menu float-right mb-0" style="height: 70px;">
                    <li class="dropdown notification-list" style="display: flex; flex-direction: row; align-content: center; align-items: center; justify-content: center;">
                        <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" style="cursor: default; color: #fff; font-size: 15px;">
                            <?php 
                                echo $this->session->userdata('username');
                            ?>
                        </a>
                        <span style="color: #fff; font-size: 15px; font-weight: 500;">|</span>
                        <a href="<?php echo base_url() ?>index.php/C_auth/logout" class="dnav-link dropdown-toggle nav-user">
                            <i class="ti-power-off m-r-5" style="font-size: 15px; font-weight: 700; color: #b3e5fc;"></i> <span style="font-size: 15px; color: #fff;">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- end menu-extras -->
            <div class="clearfix"></div>
        </div>
        <!-- end container -->
    </div>
    <!-- end topbar-main -->    
</header>
<!-- End Navigation Bar-->