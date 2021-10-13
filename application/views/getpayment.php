<?php

    $usersession    = $this->session->userdata('usersession');
    $studId         = $usersession[0]['studId'];
    $studentName    = $usersession[0]['studentName'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    // $usr_firstname  = $usersession[0]['usr_firstname'];
    // $usr_lastname   = $usersession[0]['usr_lastname'];
    $usr_lastname   = substr($studentName, strpos($studentName, " ") + 1); 
    $usr_firstname  = substr($studentName, 0, strpos($studentName, ' '));
    
    $studentClass   = $usersession[0]['studentClass'];
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp);  
    $requested_tenure = "0";

    if($studentClass==1){
        $className = "Nursery";
    }elseif ($studentClass==2) {
        $className = "Junior Kg";
    }elseif ($studentClass==3) {
        $className = "Senior Kg";
    }

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

   .highlight-error {
  border-color: red;
}
/*Profile Pic End*/
.example {
    margin-bottom: 20px;
    margin-top: 10px;
}
input {
    font-size: 14px;
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
    <?php $this->load->view('mobilemenus'); ?>
    <!-- End smartphone / tablet look -->
    <div class="boxes">
      <?php $this->load->view('websitesidebar'); ?>
      <div class="box11 animated_hero" style="background: #695FFE;">
        <div class="box-inside">
          <div class="desktop-mobile-view">
            <!-- //top header -->
            <?php $this->load->view('topheader'); ?>
            <!-- //end top header -->
            <div class="profile">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <?php if($paymentType==2){ ?>
                        <a data-toggle="tab" href="#student_info">Emi Form Filling Details</a>
                        <?php }else{ ?>
                        <a data-toggle="tab" href="#student_info">Payment Information</a>
                    <?php } ?>
                    </li>
                </ul>

                <?php if($paymentType==1){ ?>
                <div class="tab-content">
                    <div id="student_info" class="tab-pane fade in active">
                        <div class="p-3 student-info">
                            <form id="" method="POST" enctype="multipart/form-data" action="<?php echo base_url('website/getpayment')?>">
                                <input type="hidden" value="<?php echo $studId; ?>" name="studId">
                                <input type="hidden" value="<?php echo $planId; ?>" name="planId">
                                <input type="hidden" value="<?php echo $paymentType; ?>" name="paymentType">
                                <input type="hidden" value="<?php if($planvalue){ echo round($planvalue[0]['feesId']);
                                                     }else{ echo "0"; }?>" name="planvalue"  class="form-control" id="planvalue" readonly>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_firstname">First Name:</label>
                                                    <input type="text" value="<?php echo $usr_firstname;?>"  name="usr_firstname" class="form-control" id="usr_firstname">
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_firstname');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_lastname">Last Name:</label>
                                                    <input type="text" value="<?php echo $usr_lastname; ?>"    name="usr_lastname" class="form-control" id="usr_lastname">
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_lastname');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_email">Email:</label>
                                                    <input type="email" value="<?php echo $get_stud_data[0]['studentEmail'];?>"   name="usr_email" class="form-control" id="usr_email" readonly>
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_email');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_mobile_no">Mobile Number</label>
                                                    <input type="number" value="<?php echo $studentMobile;?>"  name="usr_mobile_no" class="form-control" id="usr_mobile_no" readonly>
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_mobile_no');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="payAmount">Amount</label>
                                                    <input type="text" value="<?php if($planvalue){ echo round($planvalue[0]['final_fees']);
                                                     }else{ echo "0"; }?>" name="payAmount"  class="form-control" id="payAmount" readonly>
                                                </div>
                                                <span style="color:red"><?php echo form_error('payAmount');?></span>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <div class="form-button student-info d-flex">
                                    <input  type="submit" name="submit" value="submit" class="btn btn-primary px-5">
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            <?php }else if($paymentType==2){ ?>
                <div class="tab-content">
                    <div id="student_info" class="tab-pane fade in active">
                        <div class="py-3 student-info">
                            <form id="" method="POST" enctype="multipart/form-data" action="<?php echo base_url('website/emiprocess')?>">
                                <input type="hidden" value="<?php echo $studId; ?>" name="studId">
                                <input type="hidden" value="<?php echo $planId; ?>" name="planId">
                                <input type="hidden" value="<?php echo $paymentType; ?>" name="paymentType">
                                <input type="hidden" value="<?php 
                                if($planvalue){ echo round($planvalue[0]['emi_Id']);} else { echo set_value('planvalue'); } ?>" name="loanemiId" >
                                <?php
                                if($planvalue){ 
                                    $requested_tenure = round($planvalue[0]['emipercentage']);
                                     if($requested_tenure==3){
                                        $requested_tenure==3;
                                         }elseif ($requested_tenure==5) {
                                         $requested_tenure=6;
                                     }
                                 }
                                ?>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_firstname">First Name</label>
                                        <input type="text" value="<?php echo $usr_firstname; ?>" name="usr_firstname" class="form-control" id="usr_firstname" readonly>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('usr_firstname');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_lastname">Last Name</label>
                                        <input type="text" value="<?php echo $usr_lastname; ?>" name="usr_lastname" class="form-control" id="usr_lastname" readonly>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('usr_lastname');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="mobile">Mobile Number</label>
                                        <input type="number" value="<?php echo $studentMobile;?>" name="mobile" class="form-control" id="mobile" readonly>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('mobile');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="email">Email</label>
                                        <input type="email" value="<?php echo $get_stud_data[0]['studentEmail'];?>" name="email" class="form-control" id="email" readonly>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('email');?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="student_dob">Date Of Birth</label>
                                        <input type="date" value="<?php echo set_value('student_dob');?>" name="student_dob" class="form-control" id="student_dob" required>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('student_dob');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="course_id">Class</label>
                                        <input type="text" value="<?php echo $className;?>" name="course_id" class="form-control" id="course_id" readonly>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('course_id');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="requested_tenure">Select Tenure</label>
                                        <input type="number" class="form-control" name="requested_tenure" value="<?php echo $requested_tenure; ?>" readonly>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('requested_tenure');?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="applicant_name">Applicant Name</label>
                                        <input type="text" value="<?php echo set_value('applicant_name');?>" name="applicant_name" class="form-control" id="applicant_name" placeholder="Enter Applicant Name" required>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('applicant_name');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="applicant_dob">Applicant DOB</label>
                                        <input type="date" value="<?php echo set_value('applicant_dob');?>" name="applicant_dob" class="form-control" id="applicant_dob" required> 
                                        <span class="form-error-text" style="color:red"><?php echo form_error('applicant_dob');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="aadhar_no">Applicant Adhar No</label>
                                        <input type="text" value="<?php echo set_value('aadhar_no')?>" data-type="adhaar-number" maxLength="14" name="aadhar_no" class="form-control" placeholder="Enter Adhar No" id="aadhar_no" required>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('aadhar_no');?></span>
                                        <span id="adharerror" class="form-error-text" style="color:red;display:none;">Please Enter Valid Adhar Number</span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="pan_no">Applicant Pan No</label>
                                        <input type="text" value="<?php echo set_value('pan_no')?>" name="pan_no" class="form-control" placeholder="Enter Pan No" id="pan_no" required>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('pan_no');?></span>
                                        <span id="panerror" class="form-error-text" style="color:red;display:none;">Please Enter Valid Pan No</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="usr_marital_status">Select Marital Status</label>
                                        <select class="form-control" name="marital_status" required>
                                            <option value="<?php echo set_value('marital_status')?>">Select Marital Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('marital_status');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="pan_no">Applicant Professsion</label>
                                        <input type="text" value="<?php echo set_value('profession')?>" name="profession"  class="form-control" placeholder="Enter Professsion" id="profession" required>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('profession');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="employer_name">Firm Name</label>
                                        <input type="text" value="<?php  echo set_value('employer_name')?>" name="employer_name"  class="form-control" placeholder="Enter Company Name" id="employer_name" required>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('employer_name');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="employer_name">Annual income</label>
                                        <input type="number" value="<?php  echo set_value('annual_income')?>" name="annual_income"  class="form-control" placeholder="Enter Annual income" id="annual_income" required>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('employer_name');?></span>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="relationship_with_student">Relationship with student</label>
                                        <input type="text" value="<?php  echo set_value('relationship_with_student')?>" name="relationship_with_student" class="form-control" placeholder="Enter Relation with Student" id="relationship_with_student" required>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('relationship_with_student');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="applicant_gender">Applicant Gender</label>
                                        <div style="margin-top: 5px;">  
                                            <input type="radio" name="applicant_gender" class="mr-2" value="M" id="applicant_gender" checked><span class="mr-2">Male</span>
                                            <input type="radio" value="<?php echo $studentMobile;?>" name="applicant_gender" class="mr-2" value="F" id="applicant_gender">Female
                                        </div>
                                        <span class="form-error-text" style="color:red"><?php echo form_error('applicant_gender');?></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label class="required-label" for="payAmount">Amount</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" name="payAmount" class="form-control" id="payAmount"  
                                            value="<?php if($planvalue){ echo round($planvalue[0]['checkout_emi_amt']);
                                                    }else{ echo set_value('payAmount'); }?>" readonly>
                                        </div>
                                        <span style="color:red"><?php echo form_error('payAmount');?></span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center form-button student-info">
                                    <input type="submit" name="submit" value="Submit" class="btn btn-primary px-5 submitemi">
                                </div>
                            </form>
                        </div>
                    </div>    
                </div>

            <?php }else if($paymentType==3){ 
                ?>

                <div class="tab-content">
                    <div id="student_info" class="tab-pane fade in active">
                        <div class="p-3 student-info">
                            <form id="" method="POST" enctype="multipart/form-data" action="<?php echo base_url('website/getpayment')?>">
                                <input type="hidden" value="<?php echo $studId; ?>" name="studId">
                                <input type="hidden" value="<?php echo $planId; ?>" name="planId">
                                <input type="hidden" value="<?php echo $paymentType; ?>" name="paymentType">
                                <input type="hidden" value="<?php if($planvalue){ echo round($planvalue[0]['feesId']);
                                                     }else{ echo "0"; }?>" name="planvalue"  class="form-control" id="planvalue" readonly>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_firstname">First Name:</label>
                                                    <input type="text" value="<?php echo $get_stud_data[0]['usr_firstname'];?>"  name="usr_firstname" class="form-control" id="usr_firstname"  readonly >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_firstname');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_lastname">Last Name:</label>
                                                    <input type="text" value="<?php echo $get_stud_data[0]['usr_lastname'];?>"    name="usr_lastname" class="form-control" id="usr_lastname" readonly >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_lastname');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_email">Email:</label>
                                                    <input type="email" value="<?php echo $get_stud_data[0]['studentEmail'];?>"   name="usr_email" class="form-control" id="usr_email" readonly >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_email');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_mobile_no">Mobile Number</label>
                                                    <input type="number" value="<?php echo $studentMobile;?>"  name="usr_mobile_no" class="form-control" id="usr_mobile_no" readonly >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_mobile_no');?></span>
                                            </div>
                                            <div class="col">
                                            <div class="form-group">
                                                <label>Upload Receipt Photo </label>
                                                <input type="file" name="Receiptpic" class="filestyle">
                                                <span><?php ?></span>
                                            </div>
                                            <span style="color:red"><?php if(isset($error['Receiptpic'])){ echo $error['Receiptpic']; } ?></span>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="payAmount">Amount</label>
                                                    <input type="text" value="<?php if($planvalue){ echo round($planvalue[0]['final_fees']);
                                                     }else{ echo "0"; }?>" name="payAmount"  class="form-control" id="payAmount" readonly>
                                                </div>
                                                <span style="color:red"><?php echo form_error('payAmount');?></span>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <div class="form-button student-info d-flex">
                                    <input  type="submit" name="submit" value="submit" class="btn btn-primary px-5">
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>

            <?php } ?>
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


  </script>

<?php } ?>


<script type="text/javascript">
    $(document).ready(function(){

        $("#pan_no").blur(function(){
        var panVal = $(this).val();
        var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
        var flag="false";
        if(regpan.test(panVal)){
           flag = "true";
           $(".submitemi").removeAttr("disabled", true);
           $("#panerror").hide("");
        } else {

           flag = "false";
            $(".submitemi").attr("disabled", true);
            $("#panerror").show();
        }

        if(flag=="true"){

        }else{
            $(".submitemi").attr("disabled", true);
        }

        });



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


    });
</script>