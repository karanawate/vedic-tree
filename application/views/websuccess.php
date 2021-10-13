<?php

    $usersession    = $this->session->userdata('usersession');
    $studentName    = $usersession[0]['studentName'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $promoCode     = $usersession[0]['promoCode'];
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp);  

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
    <!-- animate CSS -->
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
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/receipt.css" />
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
              
            <div class="card-body">
              <center>
                <div class="my-5 page" size="A4" style="height:auto;">
                  <div class="bg">
            
                      <div class="card">
                        
                        <span class="card__success"><i class="fas fa-check"></i></span>
                        <h1 class="card__msg">Payment Complete</h1>
                        <h2 class="card__submsg">Thank you for your transfer</h2>
                         <div class="card__body">
                          <div class="card__recipient-info">
                            <p class="card__recipient"><?php echo ucwords($studentName); ?></p>
                            <p class="card__email"><?php echo ucwords($studentEmail);?></p>
                          </div>
                          <?php if($paymentdata){ ?>
                          <h1 class="card__price"><span class="mr-2"><i class="fas fa-rupee-sign rupee"></i></span>
                            <?php 
                            if($promoCode=="15august"){
                                $payAmount = 15000;
                            }else{

                            $payAmount = round($paymentdata[0]['payAmount']);
                            }
                            echo $payAmount ; ?></h1>
                          <?php } ?>
                          <p class="card__method">Payment method</p>
                          <div class="card__payment">
                            <img src="https://seeklogo.com/images/V/VISA-logo-F3440F512B-seeklogo.com.png" class="card__credit-card">
                            <div class="card__card-details">
                              <p class="card__card-type">Credit / debit card</p>
                              <p class="card__card-number">Visa ending in **89</p>          
                            </div>
                          </div>
                          
                        </div> 
                        
                        <div class="card__tags">
                            <span class="card__tag">completed</span>
                            <span class="card__tag">#<?php echo $_SESSION['razorpay_order_id'];?></span>        
                        </div>
                        
                      </div>
                      
                    </div>
              </div>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
