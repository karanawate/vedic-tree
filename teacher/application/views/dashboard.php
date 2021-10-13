<?php

$this->load->view('header');

?>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php $this->load->view('topbar');?>
            <?php $this->load->view('sidebar');?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="page-title-box">
                                    <h4 class="font-size-18">Dashboard</h4>
                                    <ol class="breadcrumb mb-0">
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Student Count</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                            <?php if(!empty($count_student)){ 
                                                    echo $count_student;
                                                    }else{
                                                     echo "0";
                                                }
                                            ?> 
                                            <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Session</h5>
                                            <h4 class="font-weight-medium font-size-24"><?php if(!empty($count_session)){ 
                                                    echo $count_session;
                                                    }else{
                                                     echo "0";
                                                }
                                            ?>  <i
                                                    class="mdi mdi-arrow-down text-danger ml-2"></i></h4>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Category</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                                <?php if(!empty($count_category)){ 
                                                    echo $count_category;
                                                    }else{
                                                     echo "0";
                                                }
                                            ?>  
                                            <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Active Student</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                                <?php if(!empty($count_active_student)){ 
                                                    echo $count_active_student;
                                                    }else{
                                                     echo "0";
                                                }
                                            ?>  <i
                                                    class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">InActive Student</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                                <?php if(!empty($count_inactive_student)){ 
                                                    echo $count_inactive_student;
                                                    }else{
                                                     echo "0";
                                                }
                                            ?>  <i
                                                    class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>                       


                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <?php $this->load->view('footer');?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
        <?php $this->load->view('footd');?>

        
</html>