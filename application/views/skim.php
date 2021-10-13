<?php

    $usersession    = $this->session->userdata('usersession');
    $studId         = $usersession[0]['studId'];
    $studentName    = $usersession[0]['studentName'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    // $usr_firstname  = $usersession[0]['usr_firstname'];
    // $usr_lastname   = $usersession[0]['usr_lastname'];
    $studentClass   = $usersession[0]['studentClass'];
     $promoCode     = $usersession[0]['promoCode'];
    $usr_lastname   = substr($studentName, strpos($studentName, " ") + 1); 
    $usr_firstname  = substr($studentName, 0, strpos($studentName, ' '));
    $paymentType    = 1;
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp);  
    $requested_tenure = "0";
    if($studentClass==1){
        $className = "Nursery";
        $planId    = 4; 
    }elseif ($studentClass==2) {
        $className = "Junior Kg";
        $planId    = 9; 
    }elseif ($studentClass==3) {
        $className = "Senior Kg";
        $planId    = 14; 
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
    <?php $this->load->view('mobilemenus'); ?>
    <div class="boxes">
      <?php $this->load->view('websitesidebar'); ?>
      <div class="box11 animated_hero" style="background: #695FFE;">
        <div class="box-inside">
          <div class="desktop-mobile-view">
             <!--top header -->
            <?php $this->load->view('topheader'); ?>
             <!--end top header -->
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

                <div class="tab-content">
                    <div id="student_info" class="tab-pane fade in active">
                        <div class="py-3 student-info">
                            <form id="" method="POST" enctype="multipart/form-data" action="<?php echo base_url('website/getpayment'); ?>" >
                                <input type="hidden" value="<?php echo $studId; ?>" name="studId">
                                <input type="hidden" value="<?php echo $planId; ?>" name="planId">
                                <input type="hidden" value="1" name="paymentType">
                                <input type="hidden" value="<?php echo $planId; ?>" name="planvalue"  class="form-control" id="planvalue" readonly>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_firstname">First Name:</label>
                                                    <input type="text" value="<?php echo $usr_firstname;?>"  name="usr_firstname" class="form-control" id="usr_firstname"  >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_firstname');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_lastname">Last Name:</label>
                                                    <input type="text" value="<?php echo $usr_lastname;?>"    name="usr_lastname" class="form-control" id="usr_lastname" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_lastname');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_email">Email:</label>
                                                    <input type="email" value="<?php echo $get_stud_data[0]['studentEmail'];?>"   name="usr_email" class="form-control" id="usr_email" >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_email');?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="usr_mobile_no">Mobile Number</label>
                                                    <input type="number" value="<?php echo $studentMobile;?>"  name="usr_mobile_no" class="form-control" id="usr_mobile_no"  >
                                                </div>
                                                <span style="color:red"><?php echo form_error('usr_mobile_no');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="payAmount">Amount</label>
                                                    <?php
                                                      $offervalue = "15000";
                                                    ?>
                                                    <input type="text" value="<?php echo $offervalue;?>" name="payAmount"  class="form-control" id="payAmount" readonly>
                                                 
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