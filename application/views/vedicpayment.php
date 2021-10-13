<?php

    $usersession    = $this->session->userdata('usersession');
    $studId         = $usersession[0]['studId'];
    $studentName    = $usersession[0]['studentName'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $studentClass   = $usersession[0]['studentClass'];
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp); 
    $check_user_state = check_user_state($studId);
    $usr_state      = $check_user_state[0]['usr_state'];
    if($studentClass==1){
        $studClassName = "Nursery";
    }elseif ($studentClass==2) {
        $studClassName = "Junior";
    }elseif ($studentClass==3) {
        $studClassName = "Senior";
    }

    $color = "";

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

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
           
            <div class="payment">
                <form method="POST" id="regForm" action="<?php echo base_url('website/getpayment')?>" >
                    <input type="hidden" value="" id="planvalue" name="planvalue">
                    <input type="hidden" value="" id="paymentType" name="paymentType">
                    <input type="hidden" value="" id="loanemiId" name="loanemiId">
                    <h2>Payment Form</h2>
                    <div class="tab">
                        <div class="panel with-nav-tabs panel-default">
                            <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                            <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
                            <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1default" data-toggle="tab"><?php echo ucfirst($studClassName); ?></a></li>
                            </ul>
                            </div>
                            <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1default">
                                    <div class="radio-fees-select">
                                        <div class="fees-select">
                                            <input type="radio" id="radio_1" class="option-input radio list" data-id="option1" name="example" value="golden" />
                                            <label class="radio-option-label" for="">
                                            <?php 
                                                if($fess_structure){
                                                    foreach ($fess_structure as $key => $value)
                                                     {
                                                        
                                                        $gst = ($value['book_fees'] + $value['school_fees']) / 100 * 18;

                                                        $Totalamt = ($gst + $value['book_fees'] + $value['school_fees']);

                                                        if($value['packageName']==trim("Golden Star (".$studClassName.")") && $value['fk_classId']==$studentClass){
                                                 ?>
                                             <?php echo ucfirst($value['packageName']); ?>
                                             </label>
                                            <span class="fees-label ">Rs <?php echo round($value['final_fees']); ?></span>
                                            <?php }}} ?>
                                        </div>
                                        <div id="option1" class="golden show-hide main-color">
                                            <div class="table">
                                                <?php 
                                                if($fess_structure){
                                                    foreach ($fess_structure as $key => $value)
                                                     {

                                                       $gst = ($value['book_fees'] + $value['school_fees']) / 100 * 18;

                                                        if($value['packageName']==trim("Golden Star (".$studClassName.")") && $value['fk_classId']==$studentClass ){
                                                 ?>
                                                 <input type="hidden" class="feesId1" value="<?php echo $value['feesId']; ?>" name="feesId">
                                                <div class="table-cell"><h3><?php echo ucfirst($value['packageName']); ?></h3></div>
                                                <div class="table-cell plattform">
                                                    <h3 style="font-weight: 900">Rs <?php echo round($value['final_fees']); ?>/-</h3>
                                                </div>
                                                
                                                <div class="table-cell" >Tution Fees</div>
                                                <div class="table-cell" >
                                                    Rs <?php echo round($value['school_fees']); ?>/-
                                                </div>
                                                <div class="table-cell">Books Charge</div>
                                                <div class="table-cell">
                                                    Rs <?php echo round($value['book_fees']); ?>/-
                                                </div>
                                                <div class="table-cell">Total Fees</div>
                                                <div class="table-cell">
                                                    Rs <?php echo round($value['total_fees']); ?>/-
                                                </div>
                                                <div class="table-cell">Discounted Fees (50% Off)</div>
                                                <div class="table-cell">
                                                    Rs <?php echo round($value['discount_fees']); ?>/-
                                                </div>
                                                <!--<div class="table-cell">GST Charge</div>-->
                                                <!--<div class="table-cell">-->
                                                <!--    Rs <?php //echo round($gst); ?>/--->
                                                <!--</div>-->
                                                <div class="table-cell cell-feature total-color">Total </div>
                                                <div class="table-cell cell-amount total-color">
                                                    Rs <?php echo round($value['final_fees']); ?>/-
                                                </div>
                                                <?php
                                                 } }}
                                                ?>
                                            </div>
                                        </div>
                                        
                                        <div class="fees-select">
                                            <input type="radio" id="radio_2" class="option-input radio list" data-id="option2" name="example" value="twinkling" />
                                            <label class="radio-option-label" for="">
                                            <?php 
                                                if($fess_structure){
                                                    foreach ($fess_structure as $key => $value)
                                                     {
                                                        $gst = ($value['book_fees'] + $value['school_fees']) / 100 * 18;

                                                        $Totalamt = ($gst + $value['book_fees'] + $value['school_fees']);

                                                        if($value['packageName']==trim("Twinkling Star (".$studClassName.")") && $value['fk_classId']==$studentClass ){
                                                 ?>
                                             <?php echo ucfirst($value['packageName']); ?>
                                             </label>
                                            <span class="fees-label">Rs <?php echo round($value['final_fees']); ?></span>
                                            <?php }}} ?>
                                        </div>
                                        <div id="option2" class="twinkling show-hide main-color">
                                            <div class="table">
                                                <?php 
                                                if($fess_structure){
                                                    foreach ($fess_structure as $key => $value)
                                                     {

                                                       $gst = ($value['book_fees'] + $value['school_fees']) / 100 * 18;
                                                       $Totalamt = ($gst + $value['book_fees'] + $value['school_fees']);

                                                        if($value['packageName']==trim("Twinkling Star (".$studClassName.")") && $value['fk_classId']==$studentClass){
                                                 ?>
                                                 <input type="hidden" class="feesId3" value="<?php echo $value['feesId']; ?>" name="feesId">
                                                <div class="table-cell" ><h3><?php echo ucfirst($value['packageName']); ?></h3></div>
                                                <div class="table-cell plattform">
                                                    <h3 style="font-weight: 900">Rs <?php echo round($value['final_fees']); ?>/-</h3>
                                                </div>
                                                
                                                <div class="table-cell" >Tution Fees</div>
                                                <div class="table-cell" >
                                                    Rs <?php echo $value['school_fees']; ?>/-
                                                </div>
                                                <div class="table-cell">Books Charge</div>
                                                <div class="table-cell">
                                                    Rs <?php echo $value['book_fees']; ?>/-
                                                </div>
                                                <div class="table-cell">Total Fees</div>
                                                <div class="table-cell">
                                                    Rs <?php echo round($value['total_fees']); ?>/-
                                                </div>
                                                <div class="table-cell">Discounted Fees (50% Off)</div>
                                                <div class="table-cell">
                                                    Rs <?php echo round($value['discount_fees']); ?>/-
                                                </div>
                                                <!--<div class="table-cell">GST Charge</div>-->
                                                <!--<div class="table-cell">-->
                                                    <!--Rs <?php //echo round($gst); ?>/--->
                                                <!--</div>-->
                                                <div class="table-cell cell-feature total-color">Total</div>
                                                <div class="table-cell cell-amount total-color">
                                                    Rs <?php echo round($value['final_fees']); ?>/-
                                                </div>
                                                <?php
                                                 } } }
                                                ?>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="fees-select">
                                            <input type="radio" id="radio_3" class="option-input radio list" data-id="option3" name="example" value="shining" />
                                            <label class="radio-option-label" for="">
                                            <?php 
                                                if($fess_structure){
                                                    foreach ($fess_structure as $key => $value)
                                                     {
                                                        $gst = ($value['book_fees'] + $value['school_fees']) / 100 * 18;

                                                        $Totalamt = ($gst + $value['book_fees'] + $value['school_fees']);

                                                        if($value['packageName']==trim("Shining Star (".$studClassName.")") && $value['fk_classId']==$studentClass ){
                                                 ?>
                                             <?php echo ucfirst($value['packageName']); ?>
                                             </label>
                                            <span class="fees-label">Rs <?php echo round($value['final_fees']); ?></span>
                                            <?php }}} ?>
                                        </div>
                                        <div id="option3" class="shining show-hide main-color">
                                            <div class="table">
                                                <?php 
                                                if($fess_structure){
                                                    foreach ($fess_structure as $key => $value)
                                                     {

                                                       $gst = ($value['book_fees'] + $value['school_fees']) / 100 * 18;
                                                       $Totalamt = ($gst + $value['book_fees'] + $value['school_fees']);

                                                        if($value['packageName']==trim("Shining Star (".$studClassName.")") && $value['fk_classId']==$studentClass){
                                                 ?>
                                                 <input type="hidden" class="feesId3" value="<?php echo $value['feesId']; ?>" name="feesId">
                                                <div class="table-cell" ><h3><?php echo ucfirst($value['packageName']); ?></h3></div>
                                                <div class="table-cell plattform">
                                                    <h3 style="font-weight: 900">Rs <?php echo round($value['final_fees']); ?>/-</h3>
                                                </div>
                                                
                                                <div class="table-cell" >Tution Fees</div>
                                                <div class="table-cell" >
                                                    Rs <?php echo $value['school_fees']; ?>/-
                                                </div>
                                                <div class="table-cell">Books Charge</div>
                                                <div class="table-cell">
                                                    Rs <?php echo $value['book_fees']; ?>/-
                                                </div>
                                                <div class="table-cell">Total Fees</div>
                                                <div class="table-cell">
                                                    Rs <?php echo round($value['total_fees']); ?>/-
                                                </div>
                                                <div class="table-cell">Discounted Fees (50% Off)</div>
                                                <div class="table-cell">
                                                    Rs <?php echo round($value['discount_fees']); ?>/-
                                                </div>
                                                <!--<div class="table-cell">GST Charge</div>-->
                                                <!--<div class="table-cell">-->
                                                    <!--Rs <?php //echo round($gst); ?>/--->
                                                <!--</div>-->
                                                <div class="table-cell cell-feature total-color">Total</div>
                                                <div class="table-cell cell-amount total-color">
                                                    Rs <?php echo round($value['final_fees']); ?>/-
                                                </div>
                                                <?php
                                                 } } }
                                                ?>
                                            </div>
                                        </div>
                                        
                                        <div class="fees-select">
                                            <input type="radio" id="radio_4" class="option-input radio list" data-id="option4" name="example" value="rock" />
                                            <label class="radio-option-label" for="">
                                            <?php 
                                                if($fess_structure){
                                                    foreach ($fess_structure as $key => $value)
                                                     {
                                                        $gst = ($value['book_fees'] + $value['school_fees']) / 100 * 18;

                                                        $Totalamt = ($gst + $value['book_fees'] + $value['school_fees']);

                                                        if($value['packageName']==trim("Rock Star (".$studClassName.")") && $value['fk_classId']==$studentClass){
                                                 ?>
                                             <?php echo ucfirst($value['packageName']); ?>
                                             </label>
                                            <span class="fees-label">Rs <?php echo round($value['final_fees']); ?></span>
                                            <?php }}} ?>
                                        </div>
                                        <div id="option4" class="rock show-hide main-color">
                                            <div class="table">
                                                <?php 
                                                if($fess_structure){
                                                    foreach ($fess_structure as $key => $value)
                                                     {

                                                       $gst = ($value['book_fees'] + $value['school_fees']) / 100 * 18;
                                                       $Totalamt = ($gst + $value['book_fees'] + $value['school_fees']);


                                                        if($value['packageName']==trim("Rock Star (".$studClassName.")") && $value['fk_classId']==$studentClass){
                                                 ?>
                                                 <input type="hidden" class="feesId4" value="<?php echo $value['feesId']; ?>" name="feesId">
                                                <div class="table-cell" ><h3><?php echo ucfirst($value['packageName']); ?></h3></div>
                                                <div class="table-cell plattform">
                                                    <h3 style="font-weight: 900">Rs <?php echo round($value['final_fees']); ?>/-</h3>
                                                </div>
                                                
                                                <div class="table-cell" >Tution Fees</div>
                                                <div class="table-cell" >
                                                    Rs <?php echo $value['school_fees']; ?>/-
                                                </div>
                                                <div class="table-cell">Books Charge</div>
                                                <div class="table-cell">
                                                    Rs <?php echo $value['book_fees']; ?>/-
                                                </div>
                                                <div class="table-cell">Total Fees</div>
                                                <div class="table-cell">
                                                    Rs <?php echo round($value['total_fees']); ?>/-
                                                </div>
                                                <div class="table-cell">Discounted Fees (50% Off)</div>
                                                <div class="table-cell">
                                                    Rs <?php echo round($value['discount_fees']); ?>/-
                                                </div>
                                                <!--<div class="table-cell">GST Charge</div>-->
                                                <!--<div class="table-cell">-->
                                                <!--    Rs <?php //echo round($gst); ?>/--->
                                                <!--</div>-->
                                                <div class="table-cell cell-feature total-color">Total</div>
                                                <div class="table-cell cell-amount total-color">
                                                    Rs <?php echo round($value['final_fees']); ?>/-
                                                </div>
                                                <?php
                                                 } }}
                                                ?>
                                            </div>
                                        </div>
                                        
                                        <div class="fees-select">
                                            <input type="radio" id="radio_5" class="option-input radio list" data-id="option5" name="example" value="super" />
                                            <label class="radio-option-label" for="">
                                            <?php 
                                                if($fess_structure){
                                                    foreach ($fess_structure as $key => $value)
                                                     {
                                                        $gst = ($value['book_fees'] + $value['school_fees']) / 100 * 18;

                                                        $Totalamt = ($gst + $value['book_fees'] + $value['school_fees']);
                                                        if($value['packageName']==trim("Super Star (".$studClassName.")") && $value['fk_classId']==$studentClass){
                                                 ?>
                                             <?php echo ucfirst($value['packageName']); ?>
                                             </label>
                                            <span class="fees-label">Rs <?php echo round($value['final_fees']); ?></span>
                                            <?php }}} ?>
                                        </div>
                                        <div id="option5" class="super show-hide main-color">
                                            <div class="table">
                                                <?php 
                                                if($fess_structure){
                                                    foreach ($fess_structure as $key => $value)
                                                     {

                                                       $gst = ($value['book_fees'] + $value['school_fees']) / 100 * 18;

                                                       $Totalamt = ($gst + $value['book_fees'] + $value['school_fees']);

                                                        if($value['packageName']==trim("Super Star (".$studClassName.")") && $value['fk_classId']==$studentClass){
                                                 ?>
                                                 <input type="hidden" class="feesId5" value="<?php echo $value['feesId']; ?>" name="feesId">
                                                <div class="table-cell" ><h3><?php echo ucfirst($value['packageName']); ?></h3></div>
                                                <div class="table-cell plattform">
                                                    <h3 style="font-weight: 900">Rs <?php echo round($value['final_fees']); ?>/-</h3>
                                                </div>
                                                
                                                <div class="table-cell" >Tution Fees</div>
                                                <div class="table-cell" >
                                                    Rs <?php echo $value['school_fees']; ?>/-
                                                </div>
                                                <div class="table-cell">Books Charge</div>
                                                <div class="table-cell">
                                                    Rs <?php echo $value['book_fees']; ?>/-
                                                </div>
                                                <div class="table-cell">Total Fees</div>
                                                <div class="table-cell">
                                                    Rs <?php echo round($value['total_fees']); ?>/-
                                                </div>
                                                <div class="table-cell">Discounted Fees (50% Off)</div>
                                                <div class="table-cell">
                                                    Rs <?php echo round($value['discount_fees']); ?>/-
                                                </div>
                                                <!--<div class="table-cell" >GST Charge</div>-->
                                                <!--<div class="table-cell">-->
                                                <!--    Rs <?php //echo round($gst); ?>/--->
                                                <!--</div>-->
                                                <div class="table-cell cell-feature total-color">Total</div>
                                                <div class="table-cell cell-amount total-color">
                                                    Rs <?php echo round($value['final_fees']); ?>/-
                                                </div>
                                                <?php
                                                 } }}
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <h2>Payment Mode</h2>
                        <div class="radio-payment-select">
                            <div class="payment-select">
                                <input type="radio" id="radio1" class="option-input radio" data-id="option13" name="payment" />
                                <label class="radio-option-label" for="radio1">Full Payment</label>
                            </div>
                            <div class="payment-select">
                                <input type="radio" id="radio2" class="option-input radio list" data-id="option" name="payment" value="emi-fees" />
                                <label class="radio-option-label" for="radio2">EMI</label>
                            </div>
                            <div id="option6" class="emi-fees show-hide">
                                <div class="emi-part">
                                    <?php  if($tbl_emi){ 

                                            foreach ($tbl_emi as $key => $value) {
                                                                            
                                            if($value['packageName']==trim("Golden Star (".$studClassName.")")){
                                     ?>
                                    <div class="emi-columns-1 emi1" id="emi1" style="display: none;">
                                        <div class="price">
                                            <div class="header" style="background-color: #00a79d"><?php echo $value['tenureName']; ?> Months
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319"><path fill="#fff" fill-opacity="10" d="M0,224L48,218.7C96,213,192,203,288,170.7C384,139,480,85,576,101.3C672,117,768,203,864,208C960,213,1056,139,1152,106.7C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                                            </div>
                                            <div class="table m-0 p-0">
                                                <div class="table-cell cell-feature">Tution Fees (A)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi']); ?></div>
                                                <div class="table-cell cell-feature">Processing Charges (%)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;"><?php echo $value['emipercentage']; ?>%</div>
                                                <div class="table-cell cell-feature">Processing Charges (Rs) (B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">Total (Rs) (A + B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi'] + $value['emicharges']); ?></div>   
                                                <div class="table-cell cell-feature">EMI Amount</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['monthlyFess']); ?></div>
                                            </div>
                                            <div class="d-flex justify-content-center grey"><input type="radio" id="emi_golden3" value="<?php echo $value['emi_Id'];?>" class="option-input radio emi" data-id="emi_3" name="emi_golden" /></div>
                                        </div>     
                                    </div>
                                    <?php  } } } 
                                    
                                    if($tbl_emi){ 
                                            foreach ($tbl_emi as $key => $value) {
                                                 $emipercentage = round($value['fk_tid']);
                                            if($value['packageName']==trim("Golden Star (".$studClassName.")") && $value['fk_classId']==$studentClass && $emipercentage==2){

                                       ?>
                                    <div class="emi-columns-2 emi11" id="emi11" style="display: none;">
                                        <div class="price">
                                            <div class="header" style="background-color:#f8931c"><?php echo $value['tenureName']; ?> Months
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319"><path fill="#fff" fill-opacity="10" d="M0,224L48,218.7C96,213,192,203,288,170.7C384,139,480,85,576,101.3C672,117,768,203,864,208C960,213,1056,139,1152,106.7C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                                            </div>
                                            <div class="table m-0 p-0">
                                                <div class="table-cell cell-feature">Tution Fees (A)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi']); ?></div>
                                                <div class="table-cell cell-feature">Processing Charges (%)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;"><?php echo $value['emipercentage']; ?>%</div>
                                                <div class="table-cell cell-feature">Processing Charges (Rs) (B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">Total (Rs) (A + B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi'] + $value['emicharges']); ?></div>   
                                                <div class="table-cell cell-feature">EMI Amount</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['monthlyFess']); ?></div>
                                            </div>
                                            <div class="d-flex justify-content-center grey"><input type="radio" id="emi_golden6" class="option-input radio emi" data-id="emi_6" name="emi_golden" value="<?php echo $value['emi_Id'];?>" /></div>
                                        </div>
                                    </div> 

                                     <?php  } } } ?>
                                     

                                    <?php  if($tbl_emi) { 

                                             foreach ($tbl_emi as $key => $value) {
                                                $emipercentage = round($value['fk_tid']);
                                            if($value['packageName']==trim("Twinkling Star (".$studClassName.")") && $value['fk_classId']==$studentClass && $emipercentage==1){
                                     ?>

                                    <div class="emi-columns-1 emi2" id="emi2" style="display: none;">
                                        <div class="price">
                                            <div class="header" style="background-color: #00a79d"><?php echo $value['tenureName']; ?> Months
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319"><path fill="#fff" fill-opacity="10" d="M0,224L48,218.7C96,213,192,203,288,170.7C384,139,480,85,576,101.3C672,117,768,203,864,208C960,213,1056,139,1152,106.7C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                                            </div>
                                            <div class="table m-0 p-0">
                                                <div class="table-cell cell-feature">Tution Fees (A)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi']); ?></div>
                                                <div class="table-cell cell-feature">Processing Charges (%)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;"><?php echo $value['emipercentage']; ?>%</div>
                                                <div class="table-cell cell-feature">Processing Charges (Rs) (B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['emicharges']); ?></div>    
                                                <div class="table-cell cell-feature">Total (Rs) (A + B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi'] + $value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">EMI Amount</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['monthlyFess']); ?></div>
                                            </div>
                                            <div class="d-flex justify-content-center grey"><input type="radio" id="emi_twinkling3" value="<?php echo $value['emi_Id'];?>" class="option-input radio emi" data-id="emi_3" name="emi_twinkling3" /></div>
                                        </div>     
                                    </div>
                                      <?php   } } }

                                      if($tbl_emi){ 

                                            foreach ($tbl_emi as $key => $value) {
                                                $emipercentage = round($value['fk_tid']);
                                            if($value['packageName']==trim("Twinkling Star (".$studClassName.")") && $value['fk_classId']==$studentClass  && $emipercentage==2 ){

                                       ?>
                                    <div class="emi-columns-2 emi21" id="emi21" style="display: none;">
                                        <div class="price">
                                            <div class="header" style="background-color:#f8931c">6 Months
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319"><path fill="#fff" fill-opacity="10" d="M0,224L48,218.7C96,213,192,203,288,170.7C384,139,480,85,576,101.3C672,117,768,203,864,208C960,213,1056,139,1152,106.7C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                                            </div>
                                            <div class="table m-0 p-0">
                                                <div class="table-cell cell-feature">Tution Fees (A)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi']); ?></div>
                                                <div class="table-cell cell-feature">Processing Charges (%)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;"><?php echo $value['emipercentage']; ?>%</div>
                                                <div class="table-cell cell-feature">Processing Charges (Rs) (B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">Total (Rs) (A + B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi'] + $value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">EMI Amount</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['monthlyFess']); ?></div>
                                            </div>
                                            <div class="d-flex justify-content-center grey"><input type="radio" id="emi_twinkling6" class="option-input radio emi" data-id="emi_6" name="emi_twinkling3" value="<?php echo $value['emi_Id'];?>" /></div>
                                        </div>
                                    </div> 

                                     <?php  } } } ?>
                                    <!-- /3/ -->

                                    <?php  if($tbl_emi){ 
                                        foreach ($tbl_emi as $key => $value) {
                                            $emipercentage = round($value['fk_tid']);
                                            if($value['packageName']==trim("Shining Star (".$studClassName.")") && $value['fk_classId']==$studentClass && $emipercentage==1 ){
                                     ?>

                                    <div class="emi-columns-1 emi3" id="emi3" style="display: none;">
                                        <div class="price">
                                            <div class="header" style="background-color: #00a79d"><?php echo $value['tenureName']; ?> Months
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319"><path fill="#fff" fill-opacity="10" d="M0,224L48,218.7C96,213,192,203,288,170.7C384,139,480,85,576,101.3C672,117,768,203,864,208C960,213,1056,139,1152,106.7C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                                            </div>
                                            <div class="table m-0 p-0">
                                                <div class="table-cell cell-feature">Tution Fees (A)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi']); ?></div>
                                                <div class="table-cell cell-feature">Processing Charges (%)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;"><?php echo $value['emipercentage']; ?>%</div>
                                                <div class="table-cell cell-feature">Processing Charges (Rs) (B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">Total (Rs) (A + B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi'] + $value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">EMI Amount</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['monthlyFess']); ?></div>
                                            </div>
                                            <div class="d-flex justify-content-center grey"><input type="radio" id="emi_shining3" class="option-input radio emi" data-id="emi_3" name="emi_shining3" value="<?php echo $value['emi_Id'];?>" /></div>
                                        </div>     
                                    </div>
                                      <?php   } } }

                                      if($tbl_emi){ 
                                            foreach ($tbl_emi as $key => $value) {
                                                 $emipercentage = round($value['fk_tid']);
                                            if($value['packageName']==trim("Shining Star (".$studClassName.")") && $value['fk_classId']==$studentClass && $emipercentage==2){

                                       ?>
                                    <div class="emi-columns-2 emi31" id="emi31" style="display: none;">
                                        <div class="price">
                                            <div class="header" style="background-color:#f8931c"><?php echo $value['tenureName']; ?> Months
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319"><path fill="#fff" fill-opacity="10" d="M0,224L48,218.7C96,213,192,203,288,170.7C384,139,480,85,576,101.3C672,117,768,203,864,208C960,213,1056,139,1152,106.7C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                                            </div>
                                            <div class="table m-0 p-0">
                                                <div class="table-cell cell-feature">Tution Fees (A)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi']); ?></div>
                                                <div class="table-cell cell-feature">Processing Charges (%)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;"><?php echo $value['emipercentage']; ?>%</div>
                                                <div class="table-cell cell-feature">Processing Charges (Rs) (B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['emicharges']); ?></div>  
                                                <div class="table-cell cell-feature">Total (Rs) (A + B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi'] + $value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">EMI Amount</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['monthlyFess']); ?></div>
                                            </div>
                                            <div class="d-flex justify-content-center grey"><input type="radio" id="emi_shining6" class="option-input radio emi" data-id="emi_6" name="emi_shining3" value="<?php echo $value['emi_Id'];?>" /></div>
                                        </div>
                                    </div> 

                                     <?php  } } } ?>
                                    <!-- /4/ -->
                                        <?php  if($tbl_emi){ 
                                            foreach ($tbl_emi as $key => $value) {
                                                $emipercentage = round($value['fk_tid']);
                                            if($value['packageName']==trim("Rock Star (".$studClassName.")") && $value['fk_classId']==$studentClass && $emipercentage==1 ){
                                     ?>

                                    <div class="emi-columns-1 emi4" id="emi4" style="display: none;">
                                        <div class="price">
                                            <div class="header" style="background-color: #00a79d"><?php echo $value['tenureName']; ?> Months
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319"><path fill="#fff" fill-opacity="10" d="M0,224L48,218.7C96,213,192,203,288,170.7C384,139,480,85,576,101.3C672,117,768,203,864,208C960,213,1056,139,1152,106.7C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                                            </div>
                                            <div class="table m-0 p-0">
                                                <div class="table-cell cell-feature">Tution Fees (A)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi']); ?></div>
                                                <div class="table-cell cell-feature">Processing Charges (%)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;"><?php echo $value['emipercentage']; ?>%</div>
                                                <div class="table-cell cell-feature">Processing Charges (Rs) (B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">Total (Rs) (A + B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi'] + $value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">EMI Amount</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['monthlyFess']); ?></div>
                                            </div>
                                            <div class="d-flex justify-content-center grey"><input type="radio" id="emi_rock3" class="option-input radio emi" data-id="emi_3" name="emi_rock3" value="<?php echo $value['emi_Id'];?>" /></div>
                                        </div>     
                                    </div>
                                      <?php   } } }
                                      if($tbl_emi){ 
                                        foreach ($tbl_emi as $key => $value) {
                                            $emipercentage = round($value['fk_tid']);
                                            if($value['packageName']==trim("Rock Star (".$studClassName.")") && $value['fk_classId']==$studentClass && $emipercentage==2 ){

                                       ?>
                                    <div class="emi-columns-2 emi41" id="emi41" style="display: none;">
                                        <div class="price">
                                            <div class="header" style="background-color:#f8931c"><?php echo $value['tenureName']; ?> Months
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319"><path fill="#fff" fill-opacity="10" d="M0,224L48,218.7C96,213,192,203,288,170.7C384,139,480,85,576,101.3C672,117,768,203,864,208C960,213,1056,139,1152,106.7C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                                            </div>
                                            <div class="table m-0 p-0">
                                                <div class="table-cell cell-feature">Tution Fees (A)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi']); ?></div>
                                                <div class="table-cell cell-feature">Processing Charges (%)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;"><?php echo $value['emipercentage']; ?>%</div>
                                                <div class="table-cell cell-feature">Processing Charges (Rs) (B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">Total (Rs) (A + B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi'] + $value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">EMI Amount</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['monthlyFess']); ?></div>
                                            </div>
                                            <div class="d-flex justify-content-center grey"><input type="radio" id="emi_rock6" class="option-input radio emi" data-id="emi_6" name="emi_rock3" value="<?php echo $value['emi_Id'];?>" /></div>
                                        </div>
                                    </div> 

                                     <?php  } } } ?>
                                    
                                    <!-- /5/ -->
                                     <?php  if($tbl_emi){ 
                                            foreach ($tbl_emi as $key => $value) {
                                                $emipercentage = round($value['fk_tid']);
                                            if($value['packageName']==trim("Super Star (".$studClassName.")") && $value['fk_classId']==$studentClass && $emipercentage==1){
                                     ?>

                                    <div class="emi-columns-1 emi5" id="emi5" style="display: none;">
                                        <div class="price">
                                            <div class="header" style="background-color: #00a79d"><?php echo $value['tenureName']; ?> Months
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319"><path fill="#fff" fill-opacity="10" d="M0,224L48,218.7C96,213,192,203,288,170.7C384,139,480,85,576,101.3C672,117,768,203,864,208C960,213,1056,139,1152,106.7C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                                            </div>
                                            <div class="table m-0 p-0">
                                                <div class="table-cell cell-feature">Tution Fees (A)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi']); ?></div>
                                                <div class="table-cell cell-feature">Processing Charges (%)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;"><?php echo $value['emipercentage']; ?>%</div>
                                                <div class="table-cell cell-feature">Processing Charges (Rs) (B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">Total (Rs) (A + B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi'] + $value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">EMI Amount</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['monthlyFess']); ?></div>
                                            </div>
                                            <div class="d-flex justify-content-center grey"><input type="radio" id="emi_super3"  class="option-input radio emi" data-id="emi_3" name="emi_super3" value="<?php echo $value['emi_Id'];?>" /></div>
                                        </div>     
                                    </div>
                                      <?php   } } }
                                      if($tbl_emi){ 
                                            foreach ($tbl_emi as $key => $value) {
                                                $emipercentage = round($value['fk_tid']);
                                            if($value['packageName']==trim("Super Star (".$studClassName.")") && $value['fk_classId']==$studentClass && $emipercentage ==2) {

                                       ?>
                                    <div class="emi-columns-2 emi51" id="emi51" style="display: none;">
                                        <div class="price">
                                            <div class="header" style="background-color:#f8931c"><?php echo $value['tenureName']; ?> Months
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319"><path fill="#fff" fill-opacity="10" d="M0,224L48,218.7C96,213,192,203,288,170.7C384,139,480,85,576,101.3C672,117,768,203,864,208C960,213,1056,139,1152,106.7C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                                            </div>
                                            <div class="table m-0 p-0">
                                                <div class="table-cell cell-feature">Tution Fees</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi']); ?></div>
                                                <div class="table-cell cell-feature">Processing Charges (%)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;"><?php echo $value['emipercentage']; ?>%</div>
                                                <div class="table-cell cell-feature">Processing Charges (Rs) (B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">Total (Rs) (A + B)</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['final_fees_emi'] + $value['emicharges']); ?></div>
                                                <div class="table-cell cell-feature">EMI Amount</div>
                                                <div class="table-cell" style="color: #00a79d;font-weight: 700;">Rs <?php echo round($value['monthlyFess']); ?></div>
                                            </div>
                                            <div class="d-flex justify-content-center grey"><input type="radio" id="emi_super6" class="option-input radio emi" data-id="emi_6" name="emi_super3" value="<?php echo $value['emi_Id'];?>" /></div>
                                        </div>
                                    </div> 

                                     <?php  } } } ?>


                                </div> 
                            </div>
                            <div class="payment-select" style="display: none">
                                <input type="radio" id="radio3" class="option-input radio" data-id="option" name="payment">
                                <label class="radio-option-label" for="radio3">Offline Paid</label>
                            </div>

                            
                        </div>
                    </div>
                    
                    
                    <div style="overflow:auto;">
                        <div style="float:right;">
                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button type="submit" id="nextBtn" onclick="nextPrev(1)">Pay</button>
                        </div>
                    </div>
                    <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
                </form>
            </div>
          </div>
        </div>   
      </div>
    </div>
  </body>
</html>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
$(document).ready(function() {
    $(".option-input.radio.list").click(function() {
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".show-hide").not(targetBox).hide();
        $(targetBox).show();
    });
});
</script>
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Pay";
  } else {
    document.getElementById("nextBtn").innerHTML = "Pay";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

$(document).ready(function(){
    $("#radio_1").click(function(){
        var amt = $(".feesId1").val();
        $("#planvalue").val(amt);
    });

    $("#radio_2").click(function(){

        var amt = $(".feesId2").val();
        $("#planvalue").val(amt);

    });

    $("#radio_3").click(function(){

        var amt = $(".feesId3").val();
        $("#planvalue").val(amt);

    });

    $("#radio_4").click(function(){

        var amt = $(".feesId4").val();
        $("#planvalue").val(amt);

    });
    $("#radio_5").click(function(){

        var amt = $(".feesId5").val();
        $("#planvalue").val(amt);

    });
    $("#radio1").click(function(){
        $("#option6").hide();
        $("#paymentType").val("1");

    });

    $("#radio2").click(function(){
        $("#option6").show();
        $("#paymentType").val("2");

    });
    $("#radio3").click(function(){
        $("#option6").hide();
        $("#paymentType").val("3");

    });

    $("#nextBtn").click(function(){

        var planvalue = $("#planvalue").val();
        var paymentType = $("#paymentType").val();
        if(planvalue=="" && paymentType==""){
            alert("Please Choose Plan And Payment Type");   
            return false;
        }else{
            $("#regForm").submit();
        }

    })


    ////////emi///////////

    $("#emi_golden3").click(function(){

        var emiId = $(this).val(); 
        $("#loanemiId").val(emiId);
    });
    $("#emi_golden6").click(function(){

        var emiId = $(this).val(); 
        $("#loanemiId").val(emiId);
    });
    $("#emi_twinkling3").click(function(){

        var emiId = $(this).val(); 
        $("#loanemiId").val(emiId);
    });
    $("#emi_twinkling6").click(function(){

        var emiId = $(this).val(); 
        $("#loanemiId").val(emiId);
    });
    $("#emi_shining3").click(function(){

        var emiId = $(this).val(); 
        $("#loanemiId").val(emiId);
    });
    $("#emi_shining6").click(function(){

        var emiId = $(this).val(); 
        $("#loanemiId").val(emiId);
    });
    $("#emi_rock3").click(function(){

        var emiId = $(this).val(); 
        $("#loanemiId").val(emiId);
    });
    $("#emi_rock6").click(function(){

        var emiId = $(this).val(); 
        $("#loanemiId").val(emiId);
    });
    $("#emi_super3").click(function(){

        var emiId = $(this).val(); 
        $("#loanemiId").val(emiId);
    });

    $("#emi_super6").click(function(){

        var emiId = $(this).val(); 
        $("#loanemiId").val(emiId);
    });


})

$("#radio_1").change(function(){ //golden
  $("#emi1").show();
  $("#emi11").show();
  $("#emi5").hide();
  $("#emi51").hide();
  $("#emi4").hide();
  $("#emi41").hide();
  $("#emi3").hide();
  $("#emi31").hide();
  $("#emi2").hide();
  $("#emi21").hide();
});

$("#radio_2").change(function(){ //twinkim
  $("#emi2").show();
  $("#emi21").show();
  $("#emi1").hide();
  $("#emi11").hide();
  $("#emi5").hide();
  $("#emi3").hide();
  $("#emi31").hide();
  $("#emi4").hide();
  $("#emi41").hide();
  $("#emi51").hide();
});

$("#radio_3").change(function(){ //shining
  $("#emi3").show();
  $("#emi31").show();
  $("#emi2").hide();
  $("#emi21").hide();
  $("#emi1").hide();
  $("#emi11").hide();
  $("#emi5").hide();
  $("#emi51").hide();
});

$("#radio_4").change(function(){ //rock
  $("#emi4").show();
  $("#emi41").show();
  $("#emi3").hide();
  $("#emi31").hide();
  $("#emi2").hide();
  $("#emi21").hide();
  $("#emi1").hide();
  $("#emi11").hide();
  $("#emi5").hide();
  $("#emi51").hide();
});

$("#radio_5").change(function(){ //super
  $("#emi5").show();
  $("#emi51").show();
  $("#emi4").hide();
  $("#emi41").hide();
  $("#emi3").hide();
  $("#emi31").hide();
  $("#emi2").hide();
  $("#emi21").hide();
  $("#emi1").hide();
  $("#emi11").hide();
});


</script>