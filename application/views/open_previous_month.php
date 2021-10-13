<?php

    $usersession    = $this->session->userdata('usersession');
    $studId         = $usersession[0]['studId'];
    $studentName    = $usersession[0]['studentName'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $studentClass   = $usersession[0]['studentClass'];
    $unlockdayId     = $usersession[0]['unlockdayId'];
    $unlock_monthId  = $usersession[0]['unlock_monthId'];

    if($studentClass==1){
        $studClassName = "Nursery";
    }elseif ($studentClass==2) {
        $studClassName = "Junior";
    }elseif ($studentClass==3) {
        $studClassName = "Senior";
    }

    $color = "";
    $currentmonthLastDate = "";
    $tbl_calender_open_day = tbl_calender_open_day();
    $monthsId  = $tbl_calender_open_day['tbl_calender_open_day'][0]['Months'];
    $daysId    = $tbl_calender_open_day['tbl_calender_open_day'][0]['Days'];
    $monthdata = required_data();

    if($monthdata['paymentMonth']){
        $paymentDate          =  $monthdata['paymentMonth'][0]['createDT'];
        $paymentDate          =  date("Y-m-d",strtotime($paymentDate));
        $paymentDateData      =  tbl_batch_month($paymentDate);   
        $currentmonthLastDate =  date("Y-m-t", strtotime($paymentDate));
    }

?>
<!DOCTYPE html>
<html lang="">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#fe4b7b">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#fe4b7b">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#fe4b7b">
    <title>Vedic Tree</title>
    <link rel="icon" href="<?php echo base_url()?>assets/website/img/favicon.png">
    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/bootstrap.min.css" />-->
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/animate.css" />
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/fontawesome/css/all.min.css" />
    <!-- elegent icon CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/themefy_icon/themify-icons.css" />
    <!-- nice select CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/niceselect/css/nice-select.css" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/owl_carousel/css/owl.carousel.css" />
    <!-- magnify popup CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/magnify_popup/magnific-popup.css" />
    <!-- style CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/payment.css" />
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/81616633dd.js"></script>
    
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- ////////////////////////////////////////////////////////////////////// -->
    </head>

<body>
    
    <!-- Simulate a smartphone / tablet -->
    <?php $this->load->view('mobilemenus'); ?>
    <!-- End smartphone / tablet look -->

    <div class="boxes">
      <?php $this->load->view('websitesidebar'); ?>
      <div class="box11" style="background: #695FFE;">
        <div class="box-inside">
          <div class="desktop-mobile-view">
            <!-- //top header -->
            <?php $this->load->view('topheader'); ?>
            <!-- //end top header -->
        
                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="page-title-box">
                                    <h4 class="font-size-18">Unlock Months</h4>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
                        <?php

                        $currentDate = date("Y-m-d");
                        // $currentDate = "2021-09-01";
                        if($currentmonthLastDate > $currentDate){

                        if($unlocksession_data){
                            $unlocksession_data_monthId = $unlocksession_data[0]['unlock_monthId'];
                        }else{
                            $unlocksession_data_monthId = 0;
                        }

                        ?>
                        <div class="row">
                            <?php 

                            if($get_month_data){
                                // print_r($monthsId);
                                // print_r($fk_monthId);
                                foreach ($get_month_data as $key => $value) {
                                    // echo "<pre>";
                                    // print_r($value);
                                    if($monthsId >= $value['mId']) {

                                        if($fk_monthId == $value['mId']){
                                           $lockclass = "fas fa-unlock-alt";
                                        }else{
                                            $lockclass = "fas fa-lock";                                        
                                        }

                                     $rand = array('11476e', '960952', '54f6c4', 'd2be95', 'b48edc', '4a9e6b', '3826eb', 'e43963', '4c8c80', '39d8ca', '86b082', '38aed2', 'e30c3e', '357c78', 'dd13a7', '0b930f', '21afc8', '39c34e', '5d0f00', 'd552b5', '783045', '3122ba', 'fb48dd', '2b87f0', '4c51c8', 'd4205b', 'c48630', '5e7167', 'd7aa40', 'd6722a', '1a0012', '0c67ab');
                                     $color = '#'.$rand[rand(0,30)];
                                ?>
                            <div class="col-xl-3 col-md-6">
                                <div>
                                    
                                <form style="width:12px;"  method="POST" onclick="return check()" action="<?php echo base_url('website/unlocksession_month');?>">
                                <input type="hidden" value="<?php echo $value['mId'];?>" name="mId">
                                <input type="hidden" value="<?php echo $studId;?>" name="studId">
                                <input type="hidden" value="<?php echo $studentClass;?>" name="fk_classId">
                                <input type="hidden" value="<?php echo $value['mId'];?>" name="fk_monthId">
                                <button  type="submit" name="submit" value="submit" class="btn btn-sm">
                                    <p style="float:right;"><i style="font-size: 27px;position: relative;margin-left:240px;top:23px;" class="<?php echo $lockclass; ?>"></i></p></button>           
                                </form>
                                </div>                                
                                <a href="<?php echo base_url('website/unlockdays_student/'.$value['mId'].'/'.$studId)?>" class="gallery-popup" title="Open Imagination">
                                    <div class="project-item">
                                        <div class="overlay-container" style="height:100px;border-radius:100px;background-color:<?php echo $color;?>">
                                            <h1 class="ml-2" style="padding: 9% 18%;color: white;"><?php echo $value['monthName'];?></h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                                 } } }
                                }else{
                                    echo "Access Is Denied";
                                }
                         ?>
                    </div> 
                </div>
            </div>
         </div>
       </div>
      </div>
    </div>

     
<script src="<?php echo base_url()?>assets/js/bootstrap-notify.js"></script>
<script type="text/javascript">
        type = ['','info','success','warning','danger'];
</script>

    <script>
    function check() {
        if(confirm("Are You Sure You Want To Unlock the session")==true)
        {
            return true;
        }else{
            return false;
        }
    }
</script>

<?php if(isset($error)){ ?>
  <script type="text/javascript">
    color = Math.floor((Math.random() * 4) + 1);

      $.notify({
          icon: "tim-icons icon-bell-55",
          message: "<?php if(isset($error)){ echo $error['error']; } ?>"

        },{
            type: type[color],
            timer: 8000,
        });

  </script>

<?php } ?>

    


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
