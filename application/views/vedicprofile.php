<?php

    $usersession    = $this->session->userdata('usersession');
    $studId         = $usersession[0]['studId'];
    $studentName    = $usersession[0]['studentName'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp); 
    $monthdata      = required_data();
    $paymentMonth = $monthdata['paymentMonth'];
    
     

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Vedic Tree</title>
    <link rel="icon" href="<?php echo base_url()?>assets/website/img/favicon.png">
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/bootstrap.min.css" /> -->
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

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- ////////////////////////////////////////////////////////////////////// -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <style>
        .nav>li>a {
            position: relative;
            display: block;
            padding: 10px 20px !important;
            width: auto !important;
        }
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
            color: #555;
            cursor: default;
            background-color: #fff;
            border: 1px solid #ddd;
            border-bottom-color: transparent;
            border-radius: 4px 4px 0 0;
        }
        .nav-tabs>li {
            float: left;
            margin-bottom: -1px;
        }
        .nav>li {
            position: relative;
            display: block;
        }
        
        /*Profile Pic Start*/
        .picture-container{
            position: relative;
            cursor: pointer;
            text-align: center;
        }
        .picture{
            width: 150px;
            height: 150px;
            background-color: #999999;
            border: 4px solid #CCCCCC;
            color: #FFFFFF;
            /*border-radius: 50%;*/
            margin: 0px auto;
            overflow: hidden;
            transition: all 0.2s;
            -webkit-transition: all 0.2s;
        }
        .picture:hover{
            border-color: #2ca8ff;
        }
        .content.ct-wizard-green .picture:hover{
            border-color: #05ae0e;
        }
        .content.ct-wizard-blue .picture:hover{
            border-color: #3472f7;
        }
        .content.ct-wizard-orange .picture:hover{
            border-color: #ff9500;
        }
        .content.ct-wizard-red .picture:hover{
            border-color: #ff3b30;
        }
        .picture input[type="file"] {
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }

        .picture-src{
            width: 100%;
            
        }
        .required-label::after {
            content: "*";
            color: red;
            margin-left: 2px;
        }
        /*Profile Pic End*/
        .example {
            margin-bottom: 20px;
            margin-top: 10px;
        }
        input {
            font-size: 14px;
        }
        textarea {
            font-size: 14px;
        }
        input[readonly] {
            border: 2px solid rgba(0,0,0,0);
        }
        textarea[readonly] {
            border: 2px solid rgba(0,0,0,0);
        }

        @media (min-width: 769px) {
            .reset-credentials {
                display: grid;
                grid-template-columns: 0.5fr 0.5fr 0.5fr;
                column-gap: 50px;   
            }
        }
        @media (max-width: 768px) {
            .reset-credentials {
                display: grid;
                grid-template-rows: 1fr 1fr;
                row-gap: 50px;
            }
        }

    </style>
</head>

<body>
    <?php $this->load->view('mobilemenus'); ?>
    <div class="boxes">
      <?php $this->load->view('websitesidebar'); ?>
      <div class="box11 animated_hero" style="background: #695FFE;">
        <div class="box-inside">
          <div class="desktop-mobile-view">
            <!-- //top header -->
            <?php $this->load->view('topheader'); ?>
            <!-- //end top header -->
            
            <div class="profile">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab"  class="active" href="#student_info">Student Information</a></li>
                    <li><a data-toggle="tab" href="#father_info">Father's Information</a></li>
                    <li><a data-toggle="tab" href="#mother_info">Mother's Information</a></li>
                    <li><a data-toggle="tab" href="#bank_info">My Refferal Information</a></li>
                    <li><a data-toggle="tab" href="#change_password">Reset Password and PIN </a></li>
                </ul>
                <div class="tab-content">
                    <div id="student_info" class="tab-pane fade in active">
                        <div class="py-3 student-info">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('website/vedicprofile')?>">
                                <input type="hidden" value="<?php echo $studId; ?>" name="studId">
                                <input type="hidden" value="student" name="role">
                                <div class="row">
                                    <div class="profile-img col-lg-3 d-block d-sm-block d-md-none">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img style="width: 145px;height: 169px;margin-top: -11px;" src="<?php echo base_url('uploads/studetprofile/')?><?php echo $userinfo[0]['usr_profile'];?>"  id="wizardPicturePreview" title="">
                                                <input type="file" name="usr_profile" value="<?php if(empty($userinfo[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    } else {
                                                        echo $userinfo[0]['usr_profile'];}
                                                ?>" id="wizard-picture" class="">
                                                <input type="hidden" name="old_user_profile" class="form-control" value="<?php  if(empty($userinfo[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    }else{
                                                        echo $userinfo[0]['usr_profile'];}
                                                ?>">
                                            </div>
                                            <h6 class="">Choose Picture</h6>
                                            <span class="form-error-text"><?php echo form_error('usr_profile');?></span>
                                        </div>
                                    </div>
                                    <div class="profile-info col-lg-9">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label class="required-label" for="usr_firstname">First Name</label>
                                                <input type="text" value="<?php if(empty($userinfo[0]['usr_firstname']))
                                                {
                                                    echo set_value('usr_firstname');
                                                }else{
                                                    echo $userinfo[0]['usr_firstname'];
                                                }?>" name="usr_firstname" class="form-control" placeholder="Enter First Name" >
                                                <span class="form-error-text"><?php echo form_error('usr_firstname');?></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="required-label" for="usr_lastname">Last Name</label>
                                                <input type="text" value="<?php if(empty($userinfo[0]['usr_lastname']))
                                                {
                                                    echo set_value('usr_lastname');
                                                }else{
                                                    echo $userinfo[0]['usr_lastname'];
                                                }?>" name="usr_lastname" class="form-control" placeholder="Enter Last Name" >
                                                <span class="form-error-text"><?php echo form_error('usr_lastname');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label class="required-label" for="usr_email">Email</label>
                                                <input type="email" value="<?php 
                                                if(empty($userinfo[0]['studentEmail']))
                                                {
                                                    echo set_value('usr_email');
                                                }else{
                                                    echo $userinfo[0]['studentEmail'];
                                                }?>" name="usr_email" class="form-control" placeholder="Enter Email">
                                                <span class="form-error-text"><?php echo form_error('usr_email');?></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="required-label" for="usr_mobile_no">Mobile Number</label>
                                                <input type="number" value="<?php 
                                                if(empty($userinfo[0]['studentMobile']))
                                                {
                                                    echo set_value('usr_mobile_no');
                                                }else{
                                                    echo $userinfo[0]['studentMobile'];
                                                }?>" name="usr_mobile_no" class="form-control" placeholder="Mobile Number">
                                                <span class="form-error-text"><?php echo form_error('usr_mobile_no');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="usr_landline">Landline</label>
                                                <input type="text" maxlength="10" name="usr_landline" value="<?php if(empty($userinfo[0]['usr_landline']))
                                                {
                                                    echo set_value('usr_landline');
                                                }else{
                                                    echo $userinfo[0]['usr_landline'];}
                                                ?>" class="form-control" placeholder="Enter Landline">
                                                <span class="form-error-text"><?php echo form_error('usr_landline');?></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="required-label" for="usr_dob">Date of birth</label>
                                                <input type="date" id="usr_dob" name="usr_dob" value="<?php 
                                                if(empty($userinfo[0]['usr_dob']))
                                                {
                                                    echo set_value('usr_dob');
                                                }else{
                                                    echo $userinfo[0]['usr_dob'];
                                                }
                                                ?>" class="form-control" id="usr_dob"  >
                                                <span class="form-error-text"><?php echo form_error('usr_dob');?></span>
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label class="required-label" for="usr_dob">Alternate Email Id</label>
                                                <input type="text" id="alternate_email" placeholder="Enter Email" name="alternate_email" value="<?php 
                                                if(empty($userinfo[0]['alternate_email']))
                                                {
                                                    echo set_value('alternate_email');
                                                }else{
                                                    echo $userinfo[0]['alternate_email'];}
                                                ?>" class="form-control" id="alternate_email"  >
                                                <span class="form-error-text"><?php echo form_error('alternate_email');?></span>
                                            </div>
                                            <?php 
                                            if(!empty($paymentMonth)){
                                            ?>
                                            <div class="form-group col-sm-6">
                                                <!--<label class="required-label" for="usr_dob">Update Promocode </label>-->
                                                  <label for="">Update Promocode</label>
                                                <?php 

                                                if(empty($userinfo[0]['promoCode']))
                                                {
                                                    $readDataOnly = "";
                                                }else{
                                                    $readDataOnly = "readonly";
                                                }

                                            ?>
                                                <input type="text" id="promoCode" class="form-control" name="promoCode" <?php echo $readDataOnly; ?> placeholder="Enter Promocode" value="<?php 
                                                if(empty($userinfo[0]['promoCode']))
                                                {
                                                    echo set_value('promoCode');
                                                }else{
                                                    echo $userinfo[0]['promoCode'];}
                                                ?>"  id="promoCode"  >
                                                <span class="form-error-text"><?php echo form_error('promoCode');?></span>
                                                <span  id="promoCodeErr"></span>
                                            </div>
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <div class="profile-img col-lg-3 d-none d-sm-none d-md-block">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img style="width: 145px;height: 169px;margin-top: -11px;" src="<?php echo base_url('uploads/studetprofile/')?><?php echo $userinfo[0]['usr_profile'];?>"  id="wizardPicturePreview" title="">
                                                <input type="file" name="usr_profile" value="<?php  if(empty($userinfo[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    }else{
                                                        echo $userinfo[0]['usr_profile'];}
                                                        
                                                        ?>" id="wizard-picture" class="" >
                                                        <input type="hidden" name="old_user_profile" class="form-control" value="<?php  if(empty($userinfo[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    }else{
                                                        echo $userinfo[0]['usr_profile'];}
                                                        
                                                ?>">
                                            </div>
                                            <h6 class="">Choose Picture</h6>
                                            <span style="color:red"><?php echo form_error('usr_profile');?></span>
                                        </div>
                                    </div>
                                </div>
                                <h2>Other Information</h2>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="usr_add1">Aadhar Number</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo[0]['adharno']))
                                            {
                                                echo set_value('adharno');
                                            }else{
                                            echo $userinfo[0]['adharno'];}
                                        ?>" name="adharno" class="form-control" data-type="adhaar-number" maxLength="14"  placeholder="Enter Aadhar Number">
                                        <span class="form-error-text"><?php echo form_error('adharno');?></span>
                                        <span id="adharerror" style="color:red;display:none;">Please Enter Valid Adhar Number</span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_religion">Religion</label>
                                        <input type="text" id="usr_religion" value="<?php
                                        if(empty($userinfo[0]['studentReligion']))
                                            {
                                                echo set_value('studentReligion');
                                            }else{
                                            echo $userinfo[0]['studentReligion'];}
                                        ?>" name="studentReligion" class="form-control" placeholder="Enter Student Religion">
                                        <span class="form-error-text"><?php echo form_error('studentReligion');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_caste" >Caste</label>
                                        <input type="text" id="usr_caste" value="<?php
                                        if(empty($userinfo[0]['studentCaste']))
                                            {
                                                echo set_value('studentCaste');
                                            }else{
                                             echo $userinfo[0]['studentCaste'];}
                                        ?>" name="studentCaste" class="form-control" placeholder="Enter Cast">
                                        <span class="form-error-text"><?php echo form_error('studentCaste');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="usr_subcaste" >Sub-Caste</label>
                                        <input type="text" id="usr_subcaste" value="<?php
                                        if(empty($userinfo[0]['studentSubcast']))
                                            {
                                                echo set_value('studentSubcast');
                                            }else{
                                             echo $userinfo[0]['studentSubcast'];}
                                        ?>" name="studentSubcast" class="form-control" placeholder="Enter Sub Caste">
                                        <span class="form-error-text"><?php echo form_error('studentSubcast');?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="" >Pre school</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo[0]['preschool']))
                                            {
                                                echo set_value('preschool');
                                            }else{
                                             echo $userinfo[0]['preschool'];}
                                        ?>" name="preschool" class="form-control" placeholder="Enter Preschool">
                                        <span class="form-error-text"><?php echo form_error('preschool');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_city">Mother Tongue</label>
                                        <input type="text" value="<?php 
                                        if(empty($userinfo[0]['mothertoungue']))
                                            {
                                                echo set_value('mothertoungue');
                                            }else{
                                                echo $userinfo[0]['mothertoungue'];}
                                        ?>" name="mothertoungue" class="form-control" placeholder="Enter Mother Tongue">
                                        <span class="form-error-text"><?php echo form_error('mothertoungue');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_add1" >Address 1</label>
                                        <input type="text" id="usr_add1" value="<?php
                                        if(empty($userinfo[0]['usr_add1']))
                                            {
                                                echo set_value('usr_add1');
                                            }else{
                                             echo $userinfo[0]['usr_add1'];}
                                        ?>" name="usr_add1" class="form-control" placeholder="Enter Address 1">
                                        <span class="form-error-text"><?php echo form_error('usr_add1');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="usr_add2">Address 2</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo[0]['usr_add2']))
                                            {
                                                echo set_value('usr_add2');
                                            }else{ 
                                             echo $userinfo[0]['usr_add2'];}
                                        ?>" name="usr_add2" class="form-control" placeholder="Enter Address 2">
                                        <span class="form-error-text"><?php echo form_error('usr_add2');?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_city">City</label>
                                        <input type="text" value="<?php 
                                        if(empty($userinfo[0]['usr_city']))
                                            {
                                                echo set_value('usr_city');
                                            }else{
                                             echo $userinfo[0]['usr_city'];}
                                        ?>" name="usr_city" class="form-control" placeholder="Enter City">
                                        <span class="form-error-text"><?php echo form_error('usr_city');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_state">State:</label>
                                        <select name="usr_state" id="usr_state" class="form-control">
                                            <option value="<?php 
                                            if(empty($userinfo[0]['stateName']))
                                                {
                                                    echo "";
                                                }else{
                                                    echo $userinfo[0]['stateId'];}?>"><?php 
                                            if(empty($userinfo[0]['stateName']))
                                                {
                                                    echo "Select State";
                                                }else{
                                                    echo $userinfo[0]['stateName'];}?>
                                            </option>
                                            <?php if($user_state){ 
                                             foreach ($user_state as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value['stateId']; ?>"><?php echo $value['stateName']; ?></option>
                                            <?php }} ?>
                                        </select>
                                        <span class="form-error-text"><?php echo form_error('usr_state');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_country">Country</label>
                                        <input type="text" id="usr_country" value="<?php 
                                        if(empty($userinfo[0]['usr_country']))
                                            {
                                                echo set_value('usr_country');
                                            }else{
                                                echo $userinfo[0]['usr_country'];}
                                        ?>" name="usr_country" class="form-control" placeholder="Enter Country">
                                        <span class="form-error-text"><?php echo form_error('usr_country');?></span>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_country">DOB Certificate</label>
                                        <?php if(empty($userinfo[0]['dob_certificate']))
                                            { ?>

                                                <input type="file" name="dob_certificate" value="<?php if(empty($userinfo[0]['dob_certificate']))
                                            {
                                                echo set_value('dob_certificate');
                                            }else{
                                                echo $userinfo[0]['dob_certificate'];}
                                                
                                                ?>" id="wizard-picture" style="width:100%">
                                                <input type="hidden" name="old_dob_certificate" class="form-control" value="<?php  if(empty($userinfo[0]['dob_certificate']))
                                            {
                                                echo set_value('dob_certificate');
                                            }else{
                                                echo $userinfo[0]['dob_certificate'];}
                                        ?>">
                                        <?php } else { ?>                                           
                                        <div style="margin-top: 5px;">
                                            <a href="<?php echo base_url('uploads/studetprofile/')?><?php echo $userinfo[0]['dob_certificate']; ?>" download="" value="<?php if(empty($userinfo[0]['dob_certificate']))
                                                    {
                                                        echo set_value('dob_certificate');
                                                    }else{
                                                        echo  $userinfo[0]['dob_certificate'];
                                                    }
                                                    ?>">
                                            <i class="fa fa-download mr-2" aria-hidden="true"></i>Download DOB Certificate</a>
                                        </div>
                                         <?php } ?>                                           
                                       
                                        <span class="form-error-text"><?php echo form_error('dob_certificate');?></span>
                                    </div>


                                </div>
                                <div class="form-button student-info d-flex justify-content-center">
                                    <input  type="submit" name="submit" value="Submit" class="submitemi btn btn-primary px-5"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="father_info" class="tab-pane fade">
                        <div class="py-3 father-info">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('website/vedicprofile')?>">
                                <input type="hidden" value="<?php echo $studId; ?>" name="studId">
                                <input type="hidden" value="father" name="role">
                                <div class="row">
                                    <div class="profile-img col-lg-3 d-block d-sm-block d-md-none">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img style="width: 145px;height: 169px;margin-top: -11px;" src="<?php echo base_url('uploads/fatherprofile/')?><?php if($userinfo_father){ echo trim($userinfo_father[0]['usr_profile']);}?>" id="wizardPicturePreview" title="">
                                                <input type="file" name="usr_profile" value="<?php if(empty($userinfo_father[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    }else{
                                                        echo $userinfo_father[0]['usr_profile'];}
                                                        
                                                        ?>" id="wizard-picture" class="" >
                                                        <input type="hidden" name="old_user_profile" class="form-control" value="<?php  if(empty($userinfo_father[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    }else{
                                                        echo $userinfo_father[0]['usr_profile'];}
                                                ?>">
                                            </div>
                                            <h6 class="">Choose Picture</h6>
                                            <span style="color:red"><?php echo form_error('usr_profile');?></span>
                                        </div>
                                    </div>
                                    <div class="profile-info col-lg-9">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="usr_firstname">First Name</label>
                                                <input type="text" value="<?php if($userinfo_father){
                                                    if(empty($userinfo_father[0]['usr_firstname']))
                                                {
                                                    echo set_value('usr_firstname');
                                                }else{
                                                    echo $userinfo_father[0]['usr_firstname'];
                                                }
                                                } ?>" name="usr_firstname" class="form-control" placeholder="Enter First Name">
                                                <span class="form-error-text"><?php echo form_error('usr_firstname');?></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="usr_lastname">Last Name</label>
                                                <input type="text" value="<?php 
                                                if($userinfo_father){
                                                    if(empty($userinfo_father[0]['usr_lastname']))
                                                {
                                                    echo set_value('usr_lastname');
                                                }else{
                                                    echo $userinfo_father[0]['usr_lastname']; }
                                                } ?>" name="usr_lastname" class="form-control" placeholder="Enter Last Name">
                                                <span class="form-error-text"><?php echo form_error('usr_lastname');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="usr_email">Email</label>
                                                <input type="email" value="<?php 
                                                if($userinfo_father){
                                                    if(empty($userinfo_father[0]['studentEmail']))
                                                {
                                                    echo set_value('studentEmail');
                                                }else{
                                                    echo $userinfo_father[0]['studentEmail'];
                                                } } ?>" name="usr_email" class="form-control"  placeholder="Enter Email">
                                                <span class="form-error-text"><?php echo form_error('usr_email');?></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="usr_mobile_no">Mobile Number</label>
                                                <input type="number" value="<?php
                                                if($userinfo_father){
                                                    if(empty($userinfo_father[0]['studentAltMobile']))
                                                {
                                                    echo set_value('studentAltMobile');
                                                }else{
                    
                                                    echo $userinfo_father[0]['studentAltMobile'];
                                                }} ?>" name="usr_mobile_no" class="form-control" placeholder="Enter Mobile">
                                                <span class="form-error-text"><?php echo form_error('usr_mobile_no');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="usr_landline">Landline</label>
                                                <input type="text" maxlength="10" name="usr_landline" value="<?php if($userinfo_father){
                                                    if(empty($userinfo_father[0]['usr_landline']))
                                                {
                                                    echo set_value('usr_landline');
                                                }else{
                                                    echo $userinfo_father[0]['usr_landline'];}
                                                } ?>" class="form-control" placeholder="Enter Landline">
                                                <span class="form-error-text"><?php echo form_error('usr_landline');?></span>
                                            </div>
                                            <div class="col-sm-6"></div>
                                        </div>
                                    </div>
                                    <div class="profile-img col-lg-3 d-none d-sm-none d-md-block">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img style="width: 145px;height: 169px;margin-top: -11px;" src="<?php echo base_url('uploads/fatherprofile/')?><?php if($userinfo_father){ echo trim($userinfo_father[0]['usr_profile']);}?>" id="wizardPicturePreview" title="">
                                                <input type="file" name="usr_profile" value="<?php  if(empty($userinfo_father[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    }else{
                                                        echo $userinfo_father[0]['usr_profile'];}
                                                        
                                                        ?>" id="wizard-picture" class="" >
                                                        <input type="hidden" name="old_user_profile" class="form-control" value="<?php  if(empty($userinfo_father[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    }else{
                                                        echo $userinfo_father[0]['usr_profile'];}
                                                ?>">
                                            </div>
                                            <h6 class="">Choose Picture</h6>
                                            <span style="color:red"><?php echo form_error('usr_profile');?></span>
                                        </div>
                                    </div>
                                </div>
                                <h2>Other Information</h2>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="usr_add1" >Adhar Number</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_father[0]['adharno']))
                                            {
                                                echo set_value('adharno');
                                            }else{
                                                echo $userinfo_father[0]['adharno'];}
                                        ?>" name="adharno" class="form-control" data-type="adhaar-number" maxLength="14"  placeholder="Enter Adhar Number">
                                        <span class="form-error-text"><?php echo form_error('adharno');?></span>
                                        <span id="adharerror" style="color:red;display:none;">Please Enter Valid Adhar Number</span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="usr_add1" >Religion</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_father[0]['studentReligion']))
                                            {
                                                echo set_value('studentReligion');
                                            }else{
                                                echo $userinfo_father[0]['studentReligion'];}
                                        ?>" name="studentReligion" class="form-control" placeholder="Enter Student Religion">
                                        <span class="form-error-text"><?php echo form_error('studentReligion');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="usr_add1">Caste</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_father[0]['studentCaste']))
                                            {
                                                echo set_value('studentCaste');
                                            }else{
                                                echo $userinfo_father[0]['studentCaste'];}
                                        ?>" name="studentCaste" class="form-control" placeholder="Enter Cast">
                                        <span class="form-error-text"><?php echo form_error('studentCaste');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="" >Sub-Caste</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_father[0]['studentSubcast']))
                                            {
                                                echo set_value('studentSubcast');
                                            }else{
                                                echo $userinfo_father[0]['studentSubcast'];}
                                        ?>" name="studentSubcast" class="form-control" placeholder="Enter Sub cast 1">
                                        <span class="form-error-text"><?php echo form_error('studentSubcast');?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="">Pre school</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_father[0]['preschool']))
                                            {
                                                echo set_value('preschool');
                                            }else{
                                                echo $userinfo_father[0]['preschool'];}
                                        ?>" name="preschool" class="form-control" placeholder="Enter Preschool">
                                        <span class="form-error-text"><?php echo form_error('preschool');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="usr_city">Mother Tounge</label>
                                        <input type="text" value="<?php 
                                        if(empty($userinfo_father[0]['mothertoungue']))
                                            {
                                                echo set_value('mothertoungue');
                                            }else{
                                                echo $userinfo_father[0]['mothertoungue'];}
                                        ?>" name="mothertoungue" class="form-control" placeholder="Enter City">
                                        <span class="form-error-text"><?php echo form_error('mothertoungue');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="usr_add1" >Address 1</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_father[0]['usr_add1']))
                                            {
                                                echo set_value('usr_add1');
                                            }else{
                                                echo $userinfo_father[0]['usr_add1'];}
                                        ?>" name="usr_add1" class="form-control" placeholder="Enter Address 1" value="Hello">
                                        <span class="form-error-text"><?php echo form_error('usr_add1');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="usr_add2">Address 2</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_father[0]['usr_add2']))
                                            {
                                                echo set_value('usr_add2');
                                            }else{ 
                                                echo $userinfo_father[0]['usr_add2'];}
                                        ?>" name="usr_add2" class="form-control" placeholder="Enter Address 2">
                                        <span class="form-error-text"><?php echo form_error('usr_add2');?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="usr_city">City</label>
                                        <input type="text" value="<?php 
                                        if(empty($userinfo_father[0]['usr_city']))
                                            {
                                                echo set_value('usr_city');
                                            }else{
                                            echo $userinfo_father[0]['usr_city'];}
                                        ?>" name="usr_city" class="form-control" placeholder="Enter City">
                                        <span class="form-error-text"><?php echo form_error('usr_city');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="usr_state">State</label>
                                        <select  value="" name="usr_state" class="form-control">
                                            <option value="<?php 
                                            if(empty($userinfo_father[0]['stateName']))
                                                {
                                                    echo "";
                                                }else{
                                                    echo $userinfo_father[0]['stateId'];}?>"><?php 
                                            if(empty($userinfo_father[0]['stateName']))
                                                {
                                                    echo "Select State";
                                                }else{
                                                    echo $userinfo_father[0]['stateName'];}?>
                                            </option>
                                            <?php if($user_state){ 
                                                foreach ($user_state as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value['stateId']; ?>"><?php echo $value['stateName']; ?></option>
                                            <?php }} ?>
                                        </select>
                                        <span class="form-error-text"><?php echo form_error('usr_state');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="usr_country">Country</label>
                                        <input type="text" value="<?php 
                                        if(empty($userinfo_father[0]['usr_country']))
                                            {
                                                echo set_value('usr_country');
                                            }else{
                                                echo $userinfo_father[0]['usr_country'];
                                        }?>" name="usr_country" class="form-control" placeholder="Enter Country">
                                        <span class="form-error-text"><?php echo form_error('usr_country');?></span>
                                    </div>
                                    <div class="col-sm-3"></div>                                        
                                </div>
                                <div class="form-button student-info d-flex justify-content-center">
                                    <input  type="submit" name="submit" value="Submit" class=" submitemi btn btn-primary px-5"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="mother_info" class="tab-pane fade">
                        <div class="py-3 mother-info">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('website/vedicprofile')?>">
                                <input type="hidden" value="<?php echo $studId; ?>" name="studId">
                                <input type="hidden" value="mother" name="role">
                                <div class="row">
                                    <div class="profile-img col-lg-3 d-block d-sm-block d-md-none">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img style="width: 145px;height: 169px;margin-top: -11px;" src="<?php echo base_url('uploads/motherprofile/')?><?php 
                                                if($userinfo_mother){
                                                echo $userinfo_mother[0]['usr_profile'
                                            ];}?>" width="300px" height="150px;" id="wizardPicturePreview" title="">
                                                <input type="file" name="usr_profile" value="<?php  if(empty($userinfo_mother[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    }else{
                                                        echo $userinfo[0]['usr_profile'];}
                                                        
                                                        ?>" id="wizard-picture" class="" >
                                                        <input type="hidden" name="old_user_profile" class="form-control" value="<?php  if(empty($userinfo_mother[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    }else{
                                                        echo $userinfo_mother[0]['usr_profile'];}
                                                        
                                                ?>">
                                            </div>
                                            <h6 class="">Choose Picture</h6>
                                            <span style="color:red"><?php echo form_error('usr_profile');?></span>
                                        </div>
                                    </div>
                                    <div class="profile-info col-lg-9">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label class="required-label" for="usr_firstname">First Name</label>
                                                <input type="text" value="<?php 
                                                    if($userinfo_mother){
                                                        if(empty($userinfo_mother[0]['usr_firstname']))
                                                    {
                                                        echo set_value('usr_firstname');
                                                    }else{
                                                    echo $userinfo_mother[0]['usr_firstname'];}}
                                                ?>" name="usr_firstname" class="form-control" placeholder="Enter First Name">
                                                <span class="form-error-text"><?php echo form_error('usr_firstname');?></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="required-label" for="usr_lastname">Last Name</label>
                                                <input type="text" value="<?php 
                                                    if($userinfo_mother)
                                                    {
                                                        if(empty($userinfo_mother[0]['usr_lastname']))
                                                    {
                                                        echo set_value('usr_lastname');
                                                    }else{
                                                    echo $userinfo_mother[0]['usr_lastname'];} } 
                                                ?>" name="usr_lastname" class="form-control" placeholder="Enter Last Name">
                                                <span class="form-error-text"><?php echo form_error('usr_lastname');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label class="required-label" for="usr_email">Email</label>
                                                <input type="email" value="<?php 
                                                    if($userinfo_mother){
                                                        if(empty($userinfo_mother[0]['studentEmail']))
                                                    {
                                                        echo set_value('studentEmail');
                                                    }else{
                                                    echo $userinfo_mother[0]['studentEmail'];}} 
                                                ?>" name="usr_email" class="form-control" placeholder="Enter Email">
                                                <span class="form-error-text"><?php echo form_error('usr_email');?></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="required-label" for="usr_mobile_no">Mobile Number</label>
                                                <input type="number" value="<?php 
                                                    if($userinfo_mother)
                                                    {
                                                        if(empty($userinfo_mother[0]['studentAltMobile']))
                                                    {
                                                        echo set_value('studentAltMobile');
                                                    }else{
                    
                                                    echo $userinfo_mother[0]['studentAltMobile'];}} 
                                                ?>" name="usr_mobile_no" class="form-control" placeholder="Enter Mobile Number" onkeypress="if(this.value.length==10) return false;">
                                                <span class="form-error-text"><?php echo form_error('usr_mobile_no');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="usr_landline">Landline</label>
                                                <input type="number" name="usr_landline" value="<?php 
                                                if($userinfo_mother){
                                                    if(empty($userinfo_mother[0]['usr_landline']))
                                                {
                                                    echo set_value('usr_landline');
                                                }else{
                    
                                                echo $userinfo_mother[0]['usr_landline'];} } ?>" class="form-control" placeholder="Enter Landline">
                                                <span class="form-error-text"><?php echo form_error('usr_landline');?></span>
                                            </div>
                                            <div class="col-sm-6"></div>
                                        </div>
                                    </div>
                                    <div class="profile-img col-lg-3 d-none d-sm-none d-md-block">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img style="width: 145px;height: 169px;margin-top: -11px;" src="<?php echo base_url('uploads/motherprofile/')?><?php 
                                                if($userinfo_mother){
                                                echo $userinfo_mother[0]['usr_profile'
                                            ];}?>" width="300px" height="150px;" id="wizardPicturePreview" title="">
                                                <input type="file" name="usr_profile" value="<?php  if(empty($userinfo_mother[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    }else{
                                                        echo $userinfo[0]['usr_profile'];}
                                                        
                                                        ?>" id="wizard-picture" class="" >
                                                        <input type="hidden" name="old_user_profile" class="form-control" value="<?php  if(empty($userinfo_mother[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    }else{
                                                        echo $userinfo_mother[0]['usr_profile'];}
                                                        
                                                ?>">
                                            </div>
                                            <h6 class="">Choose Picture</h6>
                                            <span style="color:red"><?php echo form_error('usr_profile');?></span>
                                        </div>
                                    </div>
                                </div>
                                <h2>Other Information</h2>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="usr_add1">Adhar Number</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_mother[0]['adharno']))
                                            {
                                                echo set_value('adharno');
                                            }else{
                                                echo $userinfo_mother[0]['adharno'];}
                                        ?>" name="adharno" class="form-control" data-type="adhaar-number" maxLength="14"  placeholder="Enter Adhar Number">
                                        <span class="form-error-text"><?php echo form_error('adharno');?></span>
                                        <span id="adharerror" style="color:red;display:none;">Please Enter Valid Adhar Number</span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_add1">Religion</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_mother[0]['studentReligion']))
                                            {
                                                echo set_value('studentReligion');
                                            }else{
                                                echo $userinfo_mother[0]['studentReligion'];}
                                        ?>" name="studentReligion" class="form-control" placeholder="Enter Student Religion">
                                        <span class="form-error-text"><?php echo form_error('studentReligion');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_add1">Caste</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_mother[0]['studentCaste']))
                                            {
                                                echo set_value('studentCaste');
                                            }else{
                                                echo $userinfo_mother[0]['studentCaste'];}
                                        ?>" name="studentCaste" class="form-control" placeholder="Enter Cast">
                                        <span class="form-error-text"><?php echo form_error('studentCaste');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="">Sub-Caste</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_mother[0]['studentSubcast']))
                                            {
                                                echo set_value('studentSubcast');
                                            }else{
                                                echo $userinfo_mother[0]['studentSubcast'];}
                                        ?>" name="studentSubcast" class="form-control" placeholder="Enter Sub cast 1">
                                        <span ><?php echo form_error('studentSubcast');?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_city">Mother Tongue</label>
                                        <input type="text" value="<?php 
                                        if(empty($userinfo_mother[0]['mothertoungue']))
                                            {
                                                echo set_value('mothertoungue');
                                            }else{
                                        echo $userinfo_mother[0]['mothertoungue'];}?>" name="mothertoungue" class="form-control" placeholder="Enter Mother Tongue">
                                        <span class="form-error-text"><?php echo form_error('mothertoungue');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_add1">Address 1</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_mother[0]['usr_add1']))
                                            {
                                                echo set_value('usr_add1');
                                            }else{
                                                echo $userinfo_mother[0]['usr_add1'];}
                                        ?>" name="usr_add1" class="form-control" placeholder="Enter Address 1">
                                        <span class="form-error-text"><?php echo form_error('usr_add1');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="usr_add2">Address 2</label>
                                        <input type="text" value="<?php
                                        if(empty($userinfo_mother[0]['usr_add2']))
                                            {
                                                echo set_value('usr_add2');
                                            }else{ echo $userinfo_mother[0]['usr_add2'];}
                                        ?>" name="usr_add2" class="form-control" placeholder="Enter Address 2">
                                        <span class="form-error-text"><?php echo form_error('usr_add2');?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_city">City</label>
                                        <input type="text" value="<?php 
                                        if(empty($userinfo_mother[0]['usr_city']))
                                            {
                                                echo set_value('usr_city');
                                            }else{
                                                echo $userinfo_mother[0]['usr_city'];}
                                        ?>" name="usr_city" class="form-control" placeholder="Enter City">
                                        <span class="form-error-text"><?php echo form_error('usr_city');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_state">State</label>
                                        <select  value="" name="usr_state" class="form-control">
                                            <option value="<?php 
                                            if(empty($userinfo_mother[0]['stateName']))
                                                {
                                                    echo "";
                                                }else{
                                                    echo $userinfo_mother[0]['stateId'];}?>"><?php 
                                            if(empty($userinfo_mother[0]['stateName']))
                                                {
                                                    echo "Select State";
                                                }else{
                                                    echo $userinfo_mother[0]['stateName'];}?>
                                            </option>
                                            <?php if($user_state){ 
                                                foreach ($user_state as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value['stateId']; ?>"><?php echo $value['stateName']; ?></option>
                                            <?php }} ?>
                                        </select>
                                        <span class="form-error-text"><?php echo form_error('usr_state');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_country">Country</label>
                                        <input type="text" value="<?php 
                                        if(empty($userinfo_mother[0]['usr_country']))
                                            {
                                                echo set_value('usr_country');
                                            }else{
                                                echo $userinfo_mother[0]['usr_country'];}
                                        ?>" name="usr_country" class="form-control" placeholder="Enter Country">
                                        <span class="form-error-text"><?php echo form_error('usr_country');?></span>
                                    </div>
                                    <div class="col-sm-3"></div>                                        
                                </div>
                                <div class="form-button student-info d-flex justify-content-center">
                                    <input  type="submit" name="submit" value="Submit" class="submitemi btn btn-primary px-5"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="bank_info" class="tab-pane fade">
                        <div class="py-3 bank-info">
                            <div class="d-flex justify-content-between">
                                <h3 class="bankinfoh1">My Refferals List</h3>
                                <div class="bankinfoh1">Refferal ID : <?php echo $usersession[0]['NewrefferalCode']; ?></div>
                            </div>
                            <div class="table-responsive">
                                <table id="myTable">
                                  <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email Id</th>
                                        <th>Mobile Number</th>
                                        <th>My refferal Number</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    if($myrefferals){

                                        foreach($myrefferals as $value) {
                                            

                                     ?>
                                    <tr>
                                        <td>
                                        <?php echo ucfirst($value['usr_firstname']." ".$value['usr_lastname']);?>
                                            
                                        </td>
                                        <td>
                                        <?php echo round($value['studentMobile']);?>
                                        </td>
                                        
                                        <td>
                                        <?php echo $value['studentEmail'];?>   
                                        </td>
                                        
                                        <td>
                                        <?php echo $value['NewrefferalCode'];?>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="change_password" class="tab-pane">
                        <div class="change-credentials">
                            <div class="change-password"></div>
                            <div class="chnage-pin"></div>
                        </div>
                        <div class="py-3 reset-credentials">
                            <div class="reset-password">
                                <h3 class="my-3">Change Password</h3>
                                <form id="changePasswordForm" name="changePasswordForm" method="POST" action="<?php echo base_url('website/changePasswordUser'); ?>">
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" id="current_password" value=""  name="current_password" class="form-control" placeholder="Enter Old Password" required>
                                        <!-- <i  class="fas fa-eye-slash" id="display"></i> -->
                                        <span onclick="show('current_password')" class="far fa-eye eye-toggle"></span>
                                        <span style="color:red"><?php echo form_error('current_password');?></span>
                                        <span id="current_passworderr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" id="new_password" value="" name="new_password"  onChange="onChangePassword()" class="form-control" placeholder="Enter New Password" required>
                                        <span onclick="show('new_password')" class="far fa-eye eye-toggle"></span>
                                        <span style="color:red"><?php echo form_error('new_password');?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="cnf_new_password">Confirm New Password</label>
                                        <input type="password" id="cnf_new_password" value="" name="cnf_new_password" onChange="onChangePassword()" class="form-control" placeholder="Enter Confirm New Password" required>
                                        <span onclick="show('cnf_new_password')" class="far fa-eye eye-toggle"></span>
                                        <span style="color:red"><?php echo form_error('cnf_new_password');?></span>
                                    </div>
                                    <!-- <div id="CheckPasswordMatch"></div> -->
                                    <div class="form-button">
                                        <input type="submit" name="submit" value="Submit" class="submitemi btn btn-primary px-5"></input>
                                    </div>
                                </form>
                            </div> 
                            <div class="reset-pin">
                                <h3 class="my-3">Reset PIN</h3>
                                <form id="changePinForm" name="changePinForm" method="POST" action="<?php echo base_url('website/changePinUser')?>">
                                    <div class="form-group">
                                        <label for="old_pin">Current PIN</label>
                                        <input type="password" onkeypress="return isNumberKey(event)" id="old_pin" value="" name="pin-input" class="form-control old-pin" maxlength="4" placeholder="Enter Old PIN" required>
                                        <span onclick="show('old_pin')" class="far fa-eye eye-toggle"></span>
                                        <span style="color:red"><?php echo form_error('old_pin');?></span>
                                        <span id="old_pinerr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_pin">New PIN</label>
                                        <input type="password" id="new_pin" onkeypress="return isNumberKey(event)" value="" onChange="onChangePin()" name="new_pin" class="form-control new-pin" maxlength="4" placeholder="Enter New PIN" required>
                                        <span onclick="show('new_pin')" class="far fa-eye eye-toggle"></span>
                                        <span style="color:red"><?php echo form_error('new_pin');?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="cnf_new_pin">Confirm New PIN</label>
                                        <input type="password" id="cnf_new_pin" onkeypress="return isNumberKey(event)" value="" onChange="onChangePin()" name="cnf_new_pin" class="form-control cnf-new-pin" maxlength="4" placeholder="Enter Confirm New PIN" required>
                                        <span onclick="show('cnf_new_pin')" class="far fa-eye eye-toggle"></span>
                                        <span style="color:red"><?php echo form_error('cnf_new_pin');?></span>
                                    </div>
                                    <div class="form-button">
                                        <input type="submit" name="submit" value="Submit" class="submitpinemi btn btn-primary px-5"></input>
                                    </div>`
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
<script src="<?php echo base_url()?>assets/js/bootstrap-notify.js"></script>
    
<script type="text/javascript">
        type = ['','info','success','warning','danger'];
</script>
<script>
$(document).ready(function(){
// Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
        readURL(this);
    });
});

$(document).ready( function () {
    $('#myTable').DataTable();
    stateSave: true
} );

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
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

      setTimeout(function() {
                    window.location.href = '<?php echo base_url('website/vedicprofile/4')?>';
       }, 2000);

  </script>

<?php } ?>


<script type="text/javascript">
    $('[data-type="adhaar-number"]').keyup(function() {
              var value = $(this).val();
              value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
              $(this).val(value);
            });

            $('[data-type="adhaar-number"]').on("change, blur", function() {
              var value = $(this).val();
              var maxLength = $(this).attr("maxLength");
              if (value.length != maxLength) {
                $(this).addClass("highlight-error");
                  $(".submitemi").attr("disabled", true);
                   $("#adharerror").show();
              } else {
                $(this).removeClass("highlight-error");
                $(".submitemi").removeAttr("disabled", true);
                   $("#adharerror").hide();
              }
            });

</script>

<script>
$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }


        $("#promoCode").blur(function(){
            var promoCode = $(this).val();
            $.ajax({
                type:"POST",
                data:{promoCode:promoCode},
                url:"<?php echo base_url('website/checkpromocode'); ?>",
                success:function(res){
                    if(res==0){
                        $("#promoCodeErr").html('Promo Code Does Not Exist !').css('color', 'red');
                        //  $(".submitemi").attr("disabled", false);
                    }else if(res==2){
                        $("#promoCodeErr").html('Promo Code Expired !').css('color', 'red');
                        //  $(".submitemi").attr("disabled", true);
                    }else{
                        $("#promoCodeErr").html('Promo Code Exist !').css('color', 'green');
                        //   $(".submitemi").attr("disabled", false);
                    }
                },
                error:function(error){
                    console.log(error);
                }
            });

        });


    $("#current_password").blur(function(){

        var current_password = $(this).val();

        if(current_password=="" || current_password == null){
            $("#current_passworderr").html("Please Enter Password ").css('color','red');
            $(".submitemi").attr("disabled", true);
        }else{
            $.ajax({

                    type:"POST",
                    data:{current_password:current_password},
                    url:"<?php echo base_url('website/check_password_ex'); ?>",
                    success:function(res){
                             if(res==0){
                                $("#current_passworderr").html('Password Does Not Exist !').css('color', 'red');
                                $(".submitemi").attr("disabled", true);
                            }else{
                                $("#current_passworderr").html('Password Exist !').css('color', 'green');
                                $(".submitemi").attr('disabled', false);
                            }
                    },
                    error:function (error){ 
                    }
            });
        }


    });


    $("#old_pin").blur(function(){

        var old_pin = $(this).val();

        if(old_pin=="" || old_pin == null){
            $("#old_pinerr").html("Please Enter Pin Number ").css('color','red');
            $(".submitpinemi").attr("disabled", true);
        }else{
            $.ajax({

                    type:"POST",
                    data:{old_pin:old_pin},
                    url:"<?php echo base_url('website/check_old_pin'); ?>",
                    success:function(res){
                             if(res==0){
                                $("#old_pinerr").html('Pin Number Does Not Exist !').css('color', 'red');
                                $(".submitpinemi").attr("disabled", true);
                            }else{
                                $("#old_pinerr").html('Pin Number Exist !').css('color', 'green');
                                $(".submitpinemi").attr('disabled', false);
                            }
                    },
                    error:function (error){ 
                    }
            });
        }


    });



});
</script>