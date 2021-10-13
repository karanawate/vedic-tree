<?php

    $usersession    = $this->session->userdata('usersession');
    $studId         = $usersession[0]['studId'];
    $studentName    = $usersession[0]['studentName'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp); 
     

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
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
        .fade:not(.show) {
            opacity: 1 !important;
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
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Vedic Tree</title>
    <link rel="icon" href="<?php echo base_url()?>assets/website/img/favicon.png">
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
    <!-- style CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />
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

    </head>

<body>
   
    <?php $this->load->view('mobilemenus'); ?>
    
    <div class="boxes">
      <?php $this->load->view('websitesidebar'); ?>
      <div class="box11 animated_hero" style="background: #695FFE;">
        <div class="box-inside">
          <div class="p-5">
            <!-- //top header -->
            <?php $this->load->view('topheader'); ?>
            <!-- //end top header -->
            <div class="profile">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" class="active" href="#student_info">Student Information</a></li>
                    <li><a data-toggle="tab" href="#father_info">Father's Information</a></li>
                    <li><a data-toggle="tab" href="#mother_info">Mother's Information</a></li>
                    <li><a data-toggle="tab" href="#bank_info">My Refferal Information</a></li>
                </ul>

                <div class="tab-content">
                    <div id="student_info" class="tab-pane fade in active">
                        <div class="p-3 student-info">
                            <form id="" method="POST" enctype="multipart/form-data" action="<?php echo base_url('website/vedicprofile')?>">
                                <input type="hidden" value="<?php echo $studId; ?>" name="studId">
                                <input type="hidden" value="student" name="role">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_firstname">First Name:</label>
                                                    <input type="text" value="<?php if(empty($userinfo[0]['usr_firstname']))
                                                    {
                                                        echo set_value('usr_firstname');
                                                    }else{
                                                        echo $userinfo[0]['usr_firstname'];
                                                    }?>" name="usr_firstname" class="form-control" id="usr_firstname" placeholder="Enter First Name" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_firstname');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_lastname">Last Name:</label>
                                                    <input type="text" value="<?php if(empty($userinfo[0]['usr_lastname']))
                                                    {
                                                        echo set_value('usr_lastname');
                                                    }else{
                                                        echo $userinfo[0]['usr_lastname'];
                                                    }
                                                        ?>"  name="usr_lastname" class="form-control" id="usr_lastname" placeholder="Enter Last Name" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_lastname');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_email">Email:</label>
                                                    <input type="email" value="<?php 
                                                    if(empty($userinfo[0]['studentEmail']))
                                                    {
                                                        echo set_value('usr_email');
                                                    }else{
                                                        echo $userinfo[0]['studentEmail'];
                                                    }?>" name="usr_email" class="form-control" placeholder="Enter Email" id="usr_email"  >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_email');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_mobile_no">Mobile Number</label>
                                                    <input type="number" value="<?php 
                                                    if(empty($userinfo[0]['studentMobile']))
                                                    {
                                                        echo set_value('usr_mobile_no');
                                                    }else{
                                                        echo $userinfo[0]['studentMobile'];
                                                    }?>" name="usr_mobile_no" class="form-control" id="usr_mobile_no" placeholder="Mobile Number" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_mobile_no');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_landline">Landline</label>
                                                    <input type="text" maxlength="10" name="usr_landline" value="<?php if(empty($userinfo[0]['usr_landline']))
                                                    {
                                                        echo set_value('usr_landline');
                                                    }else{
                                                        echo $userinfo[0]['usr_landline'];}
                                                        ?>" class="form-control" id="usr_landline" placeholder="Enter Landline" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_landline');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_dob">Date of birth</label>
                                                    <input type="date"  name="usr_dob" value="<?php 
                                                    if(empty($userinfo[0]['usr_dob']))
                                                    {
                                                        echo set_value('usr_dob');
                                                    }else{
                                                        echo $userinfo[0]['usr_dob'];}
                                                        ?>" class="form-control" id="usr_dob"  >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_dob');?></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-4">
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
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add1" >Adhar Number</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo[0]['adharno']))
                                                    {
                                                        echo set_value('adharno');
                                                    }else{
                                                     echo $userinfo[0]['adharno'];}
                                                     ?>" name="adharno" class="form-control" id="adharno" data-type="adhaar-number" maxLength="14"  placeholder="Enter Adhar Number"  >
                                            </div>
                                            <span style="color:red"><?php echo form_error('adharno');?></span>
                                            <span id="adharerror" style="color:red;display:none;">Please Enter Valid Adhar Number</span>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add1" >Student Religion</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo[0]['studentReligion']))
                                                    {
                                                        echo set_value('studentReligion');
                                                    }else{
                                                     echo $userinfo[0]['studentReligion'];}
                                                     ?>" name="studentReligion" class="form-control" id="studentReligion"  placeholder="Enter Student Religion"  >
                                            </div>
                                            <span style="color:red"><?php echo form_error('studentReligion');?></span>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add1" >Student Cast</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo[0]['studentCaste']))
                                                    {
                                                        echo set_value('studentCaste');
                                                    }else{
                                                     echo $userinfo[0]['studentCaste'];}
                                                     ?>" name="studentCaste" class="form-control" id="studentCaste"  placeholder="Enter Cast"  >
                                            </div>
                                            <span style="color:red"><?php echo form_error('studentCaste');?></span>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" >Student Subcast</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo[0]['studentSubcast']))
                                                    {
                                                        echo set_value('studentSubcast');
                                                    }else{
                                                     echo $userinfo[0]['studentSubcast'];}
                                                     ?>" name="studentSubcast" class="form-control" id="studentSubcast"  placeholder="Enter Sub cast 1"  >
                                            </div>
                                            <span style="color:red"><?php echo form_error('studentSubcast');?></span>
                                        </div>
                                        </div>
                                      <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" >Pre school</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo[0]['preschool']))
                                                    {
                                                        echo set_value('preschool');
                                                    }else{
                                                     echo $userinfo[0]['preschool'];}
                                                     ?>" name="preschool" class="form-control" id="preschool"  placeholder="Enter Preschool" >
                                            </div>
                                            <span style="color:red"><?php echo form_error('preschool');?></span>
                                        </div>
                                         <div class="col">
                                            <div class="form-group">
                                                <label for="usr_city">Mother Tounge</label>
                                                <input type="text" value="<?php 
                                                if(empty($userinfo[0]['mothertoungue']))
                                                    {
                                                        echo set_value('mothertoungue');
                                                    }else{
                                                        echo $userinfo[0]['mothertoungue'];}?>" name="mothertoungue" class="form-control" id="mothertoungue" placeholder="Enter City" >
                                            </div>
                                            <span style="color:red"><?php echo form_error('mothertoungue');?></span>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add1" >Address 1</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo[0]['usr_add1']))
                                                    {
                                                        echo set_value('usr_add1');
                                                    }else{
                                                     echo $userinfo[0]['usr_add1'];}
                                                     ?>" name="usr_add1" class="form-control" id="usr_add1"  placeholder="Enter Address 1" value="Hello" >
                                            </div>
                                            <span style="color:red"><?php echo form_error('usr_add1');?></span>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add2">Address 2</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo[0]['usr_add2']))
                                                    {
                                                        echo set_value('usr_add2');
                                                    }else{ echo $userinfo[0]['usr_add2'];}?>" name="usr_add2" class="form-control" id="usr_add2" placeholder="Enter Address 2" >
                                            </div>
                                            <span style="color:red"><?php echo form_error('usr_add2');?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_city">City</label>
                                                    <input type="text" value="<?php 
                                                    if(empty($userinfo[0]['usr_city']))
                                                        {
                                                            echo set_value('usr_city');
                                                        }else{
                                                            echo $userinfo[0]['usr_city'];}?>" name="usr_city" class="form-control" id="usr_city" placeholder="Enter City" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_city');?></span>
                                            </div>
                                           
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_state">State:</label>
                                                    <select   name="usr_state" class="form-control" id="usr_state" >
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
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_state');?></span>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_country">Country</label>
                                                    <input type="text" value="<?php 
                                                    if(empty($userinfo[0]['usr_country']))
                                                        {
                                                            echo set_value('usr_country');
                                                        }else{
                                                            echo $userinfo[0]['usr_country'];
                                                        }?>" name="usr_country" class="form-control" placeholder="Enter Country" id="usr_country"  >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_country');?></span>
                                            </div>
                                            <div class="col"></div>                                        
                                    </div>
                                
                                <div class="form-button student-info d-flex justify-content-center">
                                    <input  type="submit" name="submit" value="submit" class="submitemi btn btn-primary px-5"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="father_info" class="tab-pane fade">
                        <div class="p-3 father-info">
                            <form id="" method="POST" enctype="multipart/form-data" action="<?php echo base_url('website/vedicprofile')?>">
                                <input type="hidden" value="<?php echo $studId; ?>" name="studId">
                                <input type="hidden" value="father" name="role">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_firstname">First Name:</label>
                                                    <input type="text" value="<?php if($userinfo_father){
                                                        if(empty($userinfo_father[0]['usr_firstname']))
                                                    {
                                                        echo set_value('usr_firstname');
                                                    }else{
                                                        echo $userinfo_father[0]['usr_firstname'];
                                                    }
                                                    } ?>" name="usr_firstname" class="form-control" id="usr_firstname" placeholder="Enter First Name" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_firstname');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_lastname">Last Name:</label>
                                                    <input type="text" value="<?php 
                                                    if($userinfo_father){
                                                        if(empty($userinfo_father[0]['usr_lastname']))
                                                    {
                                                        echo set_value('usr_lastname');
                                                    }else{
                                                        echo $userinfo_father[0]['usr_lastname']; }
                                                    } ?>"  name="usr_lastname" class="form-control" id="usr_lastname" placeholder="Enter Last Name" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_lastname');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_email">Email:</label>
                                                    <input type="email" value="<?php 
                                                    if($userinfo_father){
                                                        if(empty($userinfo_father[0]['studentEmail']))
                                                    {
                                                        echo set_value('studentEmail');
                                                    }else{
                                                        echo $userinfo_father[0]['studentEmail'];
                                                    } } ?>" name="usr_email" class="form-control" id="usr_email"  placeholder="Enter Email ">
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_email');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_mobile_no">Mobile Number</label>
                                                    <input type="number" value="<?php
                                                    if($userinfo_father){
                                                        if(empty($userinfo_father[0]['studentAltMobile']))
                                                    {
                                                        echo set_value('studentAltMobile');
                                                    }else{

                                                     echo $userinfo_father[0]['studentAltMobile'];
                                                 }} ?>" name="usr_mobile_no" class="form-control" id="usr_mobile_no" placeholder="Enter Mobile" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_mobile_no');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_landline">Landline</label>
                                                    <input type="number" name="usr_landline" value="<?php if($userinfo_father){
                                                        if(empty($userinfo_father[0]['usr_landline']))
                                                    {
                                                        echo set_value('usr_landline');
                                                    }else{
                                                        echo $userinfo_father[0]['usr_landline'];}
                                                    } ?>" class="form-control" id="usr_landline" placeholder="Enter Landline" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_landline');?></span>
                                            </div>
                                            <div class="col"></div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-4">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img style="width: 145px;height: 169px;margin-top: -11px;" src="<?php echo base_url('uploads/fatherprofile/')?><?php if($userinfo_father){ echo trim($userinfo_father[0]['usr_profile']);}?>" id="wizardPicturePreview" title="">
                                                <input type="file" name="usr_profile" id="wizard-picture" class="">
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
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add1" >Adhar Number</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_father[0]['adharno']))
                                                    {
                                                        echo set_value('adharno');
                                                    }else{
                                                     echo $userinfo_father[0]['adharno'];}
                                                     ?>" name="adharno" class="form-control" id="adharno" data-type="adhaar-number" maxLength="14"  placeholder="Enter Adhar Number"  >
                                            </div>
                                            <span style="color:red"><?php echo form_error('adharno');?></span>
                                            <span id="adharerror" style="color:red;display:none;">Please Enter Valid Adhar Number</span>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add1" >Father Religion</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_father[0]['studentReligion']))
                                                    {
                                                        echo set_value('studentReligion');
                                                    }else{
                                                     echo $userinfo_father[0]['studentReligion'];}
                                                     ?>" name="studentReligion" class="form-control" id="studentReligion"  placeholder="Enter Student Religion"  >
                                            </div>
                                            <span style="color:red"><?php echo form_error('studentReligion');?></span>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add1" >Father Cast</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_father[0]['studentCaste']))
                                                    {
                                                        echo set_value('studentCaste');
                                                    }else{
                                                     echo $userinfo_father[0]['studentCaste'];}
                                                     ?>" name="studentCaste" class="form-control" id="studentCaste"  placeholder="Enter Cast"  >
                                            </div>
                                            <span style="color:red"><?php echo form_error('studentCaste');?></span>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" >Father Subcast</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_father[0]['studentSubcast']))
                                                    {
                                                        echo set_value('studentSubcast');
                                                    }else{
                                                     echo $userinfo_father[0]['studentSubcast'];}
                                                     ?>" name="studentSubcast" class="form-control" id="studentSubcast"  placeholder="Enter Sub cast 1"  >
                                            </div>
                                            <span style="color:red"><?php echo form_error('studentSubcast');?></span>
                                        </div>
                                        </div>
                                      <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" >Pre school</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_father[0]['preschool']))
                                                    {
                                                        echo set_value('preschool');
                                                    }else{
                                                     echo $userinfo_father[0]['preschool'];}
                                                     ?>" name="preschool" class="form-control" id="preschool"  placeholder="Enter Preschool" >
                                            </div>
                                            <span style="color:red"><?php echo form_error('preschool');?></span>
                                        </div>
                                         <div class="col">
                                            <div class="form-group">
                                                <label for="usr_city">Mother Tounge</label>
                                                <input type="text" value="<?php 
                                                if(empty($userinfo_father[0]['mothertoungue']))
                                                    {
                                                        echo set_value('mothertoungue');
                                                    }else{
                                                        echo $userinfo_father[0]['mothertoungue'];}?>" name="mothertoungue" class="form-control" id="mothertoungue" placeholder="Enter City" >
                                            </div>
                                            <span style="color:red"><?php echo form_error('mothertoungue');?></span>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add1" >Address 1</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_father[0]['usr_add1']))
                                                    {
                                                        echo set_value('usr_add1');
                                                    }else{
                                                     echo $userinfo_father[0]['usr_add1'];}
                                                     ?>" name="usr_add1" class="form-control" id="usr_add1"  placeholder="Enter Address 1" value="Hello" >
                                            </div>
                                            <span style="color:red"><?php echo form_error('usr_add1');?></span>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add2">Address 2</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_father[0]['usr_add2']))
                                                    {
                                                        echo set_value('usr_add2');
                                                    }else{ echo $userinfo_father[0]['usr_add2'];}?>" name="usr_add2" class="form-control" id="usr_add2" placeholder="Enter Address 2" >
                                            </div>
                                            <span style="color:red"><?php echo form_error('usr_add2');?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_city">City</label>
                                                    <input type="text" value="<?php 
                                                    if(empty($userinfo_father[0]['usr_city']))
                                                        {
                                                            echo set_value('usr_city');
                                                        }else{
                                                            echo $userinfo_father[0]['usr_city'];}?>" name="usr_city" class="form-control" id="usr_city" placeholder="Enter City" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_city');?></span>
                                            </div>
                                           
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_state">State:</label>
                                                    <select  value="" name="usr_state" class="form-control" id="usr_state" >
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
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_state');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_country">Country</label>
                                                    <input type="text" value="<?php 
                                                    if(empty($userinfo_father[0]['usr_country']))
                                                        {
                                                            echo set_value('usr_country');
                                                        }else{
                                                            echo $userinfo_father[0]['usr_country'];
                                                        }?>" name="usr_country" class="form-control" placeholder="Enter Country" id="usr_country"  >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_country');?></span>
                                            </div>
                                            <div class="col"></div>                                        
                                    </div>
                                <div class="form-button student-info d-flex justify-content-center">
                                    <input  type="submit" name="submit" value="submit" class=" submitemi btn btn-primary px-5"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="mother_info" class="tab-pane fade">
                        <div class="p-3 mother-info">
                            <form id="" method="POST" enctype="multipart/form-data" action="<?php echo base_url('website/vedicprofile')?>">
                                <input type="hidden" value="<?php echo $studId; ?>" name="studId">
                                <input type="hidden" value="mother" name="role">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_firstname">First Name:</label>
                                                    <input type="text" value="<?php 
                                                    if($userinfo_mother){
                                                        if(empty($userinfo_mother[0]['usr_firstname']))
                                                    {
                                                        echo set_value('usr_firstname');
                                                    }else{
                                                    echo $userinfo_mother[
                                                0]['usr_firstname'];}
                                                }
                                                ?>" name="usr_firstname" class="form-control" id="usr_firstname" placeholder="Enter First Name" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_firstname');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_lastname">Last Name:</label>
                                                    <input type="text" value="<?php 
                                                    if($userinfo_mother)
                                                    {
                                                        if(empty($userinfo_mother[0]['usr_lastname']))
                                                    {
                                                        echo set_value('usr_lastname');
                                                    }else{

                                                    echo $userinfo_mother[0]['usr_lastname'];} } ?>"  name="usr_lastname" class="form-control" id="usr_lastname" placeholder="Enter Last Name" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_lastname');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_email">Email:</label>
                                                    <input type="email" value="<?php 
                                                    if($userinfo_mother){
                                                        if(empty($userinfo_mother[0]['studentEmail']))
                                                    {
                                                        echo set_value('studentEmail');
                                                    }else{

                                                    echo $userinfo_mother[0]['studentEmail'];}} ?>" name="usr_email" class="form-control" id="usr_email" placeholder="Enter Email" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_email');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_mobile_no">Mobile Number</label>
                                                    <input type="number" value="<?php 
                                                    if($userinfo_mother)
                                                    {
                                                        if(empty($userinfo_mother[0]['studentAltMobile']))
                                                    {
                                                        echo set_value('studentAltMobile');
                                                    }else{

                                                    echo $userinfo_mother[0]['studentAltMobile'];
                                                }} ?>" name="usr_mobile_no" class="form-control" id="usr_mobile_no" placeholder="Enter Mobile" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_mobile_no');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_landline">Landline</label>
                                                    <input type="number" name="usr_landline" value="<?php 
                                                    if($userinfo_mother){
                                                        if(empty($userinfo_mother[0]['usr_landline']))
                                                    {
                                                        echo set_value('usr_landline');
                                                    }else{

                                                    echo $userinfo_mother[0]['usr_landline'];} } ?>" class="form-control" id="usr_landline" placeholder="Enter Landline" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_landline');?></span>
                                            </div>
                                            <div class="col"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-4">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img style="width: 145px;height: 169px;margin-top: -11px;" src="<?php echo base_url('uploads/motherprofile/')?><?php 
                                                if($userinfo_mother){
                                                echo $userinfo_mother[0]['usr_profile'
                                            ];}?>" width="300px" height="150px;" id="wizardPicturePreview" title="">
                                                <input type="file" name="usr_profile" id="wizard-picture" class="">
                                                <input type="text" name="old_user_profile" class="form-control" value="<?php  if(empty($userinfo_mother[0]['usr_profile']))
                                                    {
                                                        echo set_value('usr_profile');
                                                    }else{
                                                     echo $userinfo_mother[0]['usr_profile'];}
                                                     
                                                     ?>"
                                                    >

                                            </div>
                                            <h6 class="">Choose Picture</h6>
                                            <span style="color:red"><?php echo form_error('usr_profile');?></span>
                                        </div>

                                    </div>
                                </div>
                                <h2>Other Information</h2>
                                <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add1" >Adhar Number</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_mother[0]['adharno']))
                                                    {
                                                        echo set_value('adharno');
                                                    }else{
                                                     echo $userinfo_mother[0]['adharno'];}
                                                     ?>" name="adharno" class="form-control" id="adharno" data-type="adhaar-number" maxLength="14"  placeholder="Enter Adhar Number"  >
                                            </div>
                                            <span style="color:red"><?php echo form_error('adharno');?></span>
                                            <span id="adharerror" style="color:red;display:none;">Please Enter Valid Adhar Number</span>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add1" >Mother Religion</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_mother[0]['studentReligion']))
                                                    {
                                                        echo set_value('studentReligion');
                                                    }else{
                                                     echo $userinfo_mother[0]['studentReligion'];}
                                                     ?>" name="studentReligion" class="form-control" id="studentReligion"  placeholder="Enter Student Religion"  >
                                            </div>
                                            <span style="color:red"><?php echo form_error('studentReligion');?></span>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add1" >Mother Cast</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_mother[0]['studentCaste']))
                                                    {
                                                        echo set_value('studentCaste');
                                                    }else{
                                                     echo $userinfo_mother[0]['studentCaste'];}
                                                     ?>" name="studentCaste" class="form-control" id="studentCaste"  placeholder="Enter Cast"  >
                                            </div>
                                            <span style="color:red"><?php echo form_error('studentCaste');?></span>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" >Mother Subcast</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_mother[0]['studentSubcast']))
                                                    {
                                                        echo set_value('studentSubcast');
                                                    }else{
                                                     echo $userinfo_mother[0]['studentSubcast'];}
                                                     ?>" name="studentSubcast" class="form-control" id="studentSubcast"  placeholder="Enter Sub cast 1"  >
                                            </div>
                                            <span style="color:red"><?php echo form_error('studentSubcast');?></span>
                                        </div>
                                        </div>
                                      <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" >Pre school</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_mother[0]['preschool']))
                                                    {
                                                        echo set_value('preschool');
                                                    }else{
                                                     echo $userinfo_mother[0]['preschool'];}
                                                     ?>" name="preschool" class="form-control" id="preschool"  placeholder="Enter Preschool" >
                                            </div>
                                            <span style="color:red"><?php echo form_error('preschool');?></span>
                                        </div>
                                         <div class="col">
                                            <div class="form-group">
                                                <label for="usr_city">Mother Tounge</label>
                                                <input type="text" value="<?php 
                                                if(empty($userinfo_mother[0]['mothertoungue']))
                                                    {
                                                        echo set_value('mothertoungue');
                                                    }else{
                                                        echo $userinfo_mother[0]['mothertoungue'];}?>" name="mothertoungue" class="form-control" id="mothertoungue" placeholder="Enter City" >
                                            </div>
                                            <span style="color:red"><?php echo form_error('mothertoungue');?></span>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add1" >Address 1</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_mother[0]['usr_add1']))
                                                    {
                                                        echo set_value('usr_add1');
                                                    }else{
                                                     echo $userinfo_mother[0]['usr_add1'];}
                                                     ?>" name="usr_add1" class="form-control" id="usr_add1"  placeholder="Enter Address 1" value="Hello" >
                                            </div>
                                            <span style="color:red"><?php echo form_error('usr_add1');?></span>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="usr_add2">Address 2</label>
                                                <input type="text" value="<?php
                                                if(empty($userinfo_mother[0]['usr_add2']))
                                                    {
                                                        echo set_value('usr_add2');
                                                    }else{ echo $userinfo_mother[0]['usr_add2'];}?>" name="usr_add2" class="form-control" id="usr_add2" placeholder="Enter Address 2" >
                                            </div>
                                            <span style="color:red"><?php echo form_error('usr_add2');?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_city">City</label>
                                                    <input type="text" value="<?php 
                                                    if(empty($userinfo_mother[0]['usr_city']))
                                                        {
                                                            echo set_value('usr_city');
                                                        }else{
                                                            echo $userinfo_mother[0]['usr_city'];}?>" name="usr_city" class="form-control" id="usr_city" placeholder="Enter City" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_city');?></span>
                                            </div>
                                           
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_state">State:</label>
                                                    <select  value="" name="usr_state" class="form-control" id="usr_state" >
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
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_state');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_country">Country</label>
                                                    <input type="text" value="<?php 
                                                    if(empty($userinfo_mother[0]['usr_country']))
                                                        {
                                                            echo set_value('usr_country');
                                                        }else{
                                                            echo $userinfo_mother[0]['usr_country'];
                                                        }?>" name="usr_country" class="form-control" placeholder="Enter Country" id="usr_country"  >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_country');?></span>
                                            </div>
                                            <div class="col"></div>                                        
                                    </div>
                                <div class="form-button student-info d-flex justify-content-center">
                                    <input  type="submit" name="submit" value="submit" class="submitemi btn btn-primary px-5"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="bank_info" class="tab-pane fade">
                        <div class="p-3 bank-info">
                            <h1 class="bankinfoh1">My Refferal Id : <?php echo $usersession[0]['NewrefferalCode']; ?>
                                
                            </h1>

                            <h3 class="bankinfoh1">My Refferals List</h3>

                            <div class="">
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
    
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}


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
});
</script>
