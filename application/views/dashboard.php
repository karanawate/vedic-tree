<?php

$usersession     = $this->session->userdata('usersession');

$adminRole = $usersession[0]['adminRole'];

$this->load->view('header');

$dataPoints = array();
  $date = array();
  $amount = array();
  if($get_all_month_revenue)
  {
    foreach ($get_all_month_revenue as $key => $value) {
      
        $month = "".date('M.d.Y',strtotime($value['createDT']))."";
        $dataPoints[] = array('label'=>$month,'y'=>$value['count']);
    }
  }
  
?>

        <!-- Begin page -->
        <div id="layout-wrapper">
            <?php $this->load->view('topbar');?>
            <?php $this->load->view('sidebar');?>
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="page-title-box">
                                    <h4 class="font-size-18">DASHBOARD</h4>
                                    <ol class="breadcrumb mb-0">
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Total Student Count</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                            <?php if(!empty($count_student)){ 
                                                    echo $count_student;
                                                    }else{
                                                     echo "0";
                                                }
                                            ?> 
                                            <i class="mdi mdi-arrow-up text-success ml-2"></i>
                                            <canvas width="80" height="40" style="display: inline-block; width: 80px; height: 40px; vertical-align: top;"></canvas>
                                            </h4>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Total Nursery Class Student</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                            <?php if(!empty($get_all_count_nursery)){ 
                                                    echo $get_all_count_nursery;
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
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Total Junior Class Student</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                            <?php if(!empty($get_all_count_junior)){ 
                                                    echo $get_all_count_junior;
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
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Total Senior Class Student</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                            <?php if(!empty($get_all_count_senior)){ 
                                                    echo $get_all_count_senior;
                                                    }else{
                                                     echo "0";
                                                }
                                            ?> 
                                            <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <?php if($adminRole==5){ ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Total Session</h5>
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
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Total Category</h5>
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
                            <?php } ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Active Student</h5>
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
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Count Female</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                                <?php if(!empty($get_all_count_female)){ 
                                                    echo $get_all_count_female;
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
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Count Male</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                                <?php if(!empty($get_all_count_male)){ 
                                                    echo $get_all_count_male;
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
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Paid Student Count</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                                <?php if(!empty($count_paid_student)){ 
                                                    echo $count_paid_student;
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
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important" >
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Paid Partial Student Count</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                                <?php if(!empty($count_partial_paid_student)){ 
                                                    echo $count_partial_paid_student;
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
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Total Budget  Count</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                                <?php if(!empty($count_paid_budget)){ 
                                                    echo $count_paid_budget[0]['payAmount'];
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
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Close Amount  Count</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                                <a href="<?php echo base_url('dashboard/closeaccountlist');?>" style="color:aliceblue;">
                                                    
                                                <?php if(!empty($get_all_count_closeAmount)){ 
                                                    echo $get_all_count_closeAmount[0]['payAmount'];
                                                    }else{
                                                     echo "0";
                                                }
                                            ?> </a>  <i
                                                    class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            
                                                <h5 class="font-size-16 text-uppercase mt-0 ">Total Discount  Count</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                                <a href="<?php echo base_url('dashboard/discountlist');?>" style="color:aliceblue;"><?php if(!empty($get_all_count_discount)){ 
                                                    echo $get_all_count_discount[0]['discount'];
                                                    }else{
                                                     echo "0";
                                                }
                                            ?> </a> <i
                                                    class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                                    
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(45deg , rgb(0 0 0), rgb(55 141 215))!important">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 ">Total Adjusted Amount  Count</h5>
                                            <h4 class="font-weight-medium font-size-24">
                                                <a href="<?php echo base_url('dashboard/adjustamountlist');?>" style="color:aliceblue;"><?php if(!empty($get_all_count_adjustedAmount)){ 
                                                    echo $get_all_count_adjustedAmount[0]['fk_adjustedAmount'];
                                                    }else{
                                                     echo "0";
                                                }
                                            ?>  </a> <i
                                                    class="mdi mdi-arrow-up text-success ml-2"></i>
                                            </h4>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>        
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                               <div id="chartContainer" style="height: 370px; width: 100%;"></div>
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
        
        <script>
        window.onload = function () {
         
        var dataPoints = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;
         
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            title:{
                text: "Months Of Revenue"
            },
            axisY: {
                title: "Rupees"
            },
            data: [{
                type: "column",
                toolTipContent: "{y} Rupees",
                dataPoints: dataPoints
            }]
        });
         
        $.get("https://canvasjs.com/data/gallery/php/tuna-production.csv", getDataPointsFromCSV);
        function getDataPointsFromCSV(csv) {
            chart.render();
         }
         
        
           
        }
        </script>
        <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        

        
</html>