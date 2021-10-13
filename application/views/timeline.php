<?php

    $usersession    = $this->session->userdata('usersession');
    $studentName    = $usersession[0]['studentName'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $timestamp = strtotime(date("Y-m-d"));
    $newDate = date('l jS  F-Y', $timestamp); 

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
<style>


</style>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Vedic Tree</title>
    <link rel="icon" href="img/favicon.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/bootstrap.min.css" />
    
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
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/timeline.css" />
    <!-- style CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- ////////////////////////////////////////////////////////////////////// -->

        <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/favicon.ico">
        <!-- Bootstrap Css -->
        <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

  <!-- ////////////////////////////////////////////////////////////////////// -->

  
    </head>

<body>
    
    <!-- End Preloader  -->
    <div class="banner_part banner_style_3">
        <div class="dashimage">
        </div>
    </div>
    <!-- Simulate a smartphone / tablet -->
    <div class="mobile-container">
        <!-- Top Navigation Menu -->
        <div class="topnav">
            <a href="#home" class="active">Logo</a>
            <div id="myLinks">
                <a href="<?php echo base_url('vedic-dash');?>">Dashboard</a>
                <a href="<?php echo base_url('vedic-learn');?>">Learning Page</a>
                <a href="#about">Profile Page</a>
                <a href="#about">Value Based Ed</a>
                <a href="#about">Live Session</a>
                <a href="#about">Timeline</a>
                <a href="<?php echo base_url('vedic-tracking');?>">Video Tracking</a>
            </div>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </div>
    <!-- End smartphone / tablet look -->
    <div class="boxes">
        <?php $this->load->view('websitesidebar'); ?>
        <div class="box11 animated_hero" style="background: #695FFE;">
            
            <div class="box-inside">
                <div class="p-5">
                    <!-- //top header -->
                    <?php $this->load->view('topheader'); ?>
                    <!-- //end top header -->
                    <div class="row">
                        <h1>Daily Student Activity</h1>
                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                            <div class="timeline">
                                <?php if($studenttimeline){
                                    foreach ($studenttimeline as $key => $value) {

                                    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                                    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                                    $date = date('Y-m-d', strtotime($value['createDT']));
                                    if($date>=date('Y-m-d')){
                                    if($value['studTid'] % 2==0 ){
                                        $position = "left";
                                    }else{
                                        $position = "right";
                                    }
                                ?>
                                <div class="containers <?php echo $position; ?>">
                                 <div class="content" style="background-color: <?php echo $color;?>">
                                  <h2><?php echo $value['createDT'];?></h2>
                                  <p style="color:black"><?php echo $value['timlelinedesc'];?></p>
                                </div>
                                </div>
                                <?php } } } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
  </body>
</html>
<script>
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>