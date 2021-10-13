<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="<?php echo base_url('dashboard'); ?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo base_url()?>assets/images/logo.png" alt="" style="margin-left: -10px;height:45px;" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url()?>assets/images/logo.png" style="height: 71px;" alt="" height="17">
                    </span>
                </a>

                <a href="<?php echo base_url('dashboard'); ?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo base_url()?>assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url()?>assets/images/logo-light.png" alt="" height="18">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>

        </div>

        <div class="d-flex">
             


            <div class="dropdown d-none d-lg-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>
         
                                 
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-bell-outline "></i>
                    <span class="badge badge-danger badge-pill blink_me ">
                        <?php         
                        $notification_count = notification_count();
                        if(isset($notification_count))
                        {
                          echo  $notification_count = $notification_count; 
                        }else{
                          echo $notification_count = '0';
                         }
                        ?> 
                     </span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col ">
                                <?php 
                                $notification_count = notification_count();
                                if(isset($notification_count)){   $notification_count = $notification_count; }else{ $notification_count = '0';} ?>
                                <h5 class="m-0 font-size-16 "> Notifications (<?php echo $notification_count; ?>) </h5>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <?php
                            $notification = notification();
                            if($notification){
                                foreach ($notification as $key => $value) {
                         ?>
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="mdi mdi-cart-outline"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Your order is placed</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1 "><?php echo $value['noticedesc']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } } ?>
                        
                    </div>
                    <div class="p-2 border-top">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                            View all
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?php echo base_url()?>assets/images/logo.png"
                        alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle font-size-17 align-middle mr-1"></i><?php $usersession = $this->session->userdata('usersession'); echo ucwords($usersession[0]['studentName']);  ?></a>
                    
                    <a class="dropdown-item text-danger" href="<?php echo base_url('welcome/logout');?>"><i class="bx bx-power-off font-size-17 align-middle mr-1 text-danger"></i> Logout </a>
                </div>
            </div>

            
        </div>
    </div>
</header>


