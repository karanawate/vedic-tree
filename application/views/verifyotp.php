<!DOCTYPE html>
<html lang="zxx">
<head>
    <style>
        @media (min-width: 769px) {
        .reset-password-box {
                background: #fff;
                padding: 40px;
                border-radius: 20px;
                box-shadow: 1px 1px 3px 1px rgb(0 0 0 / 20%);
                max-width: 500px;
                margin: auto;
            }
        }
        @media (max-width: 768px) {
        .reset-password-box {
                background: #fff;
                padding: 20px;
                border-radius: 20px;
                box-shadow: 1px 1px 3px 1px rgb(0 0 0 / 20%);
                max-width: 500px;
                margin: auto;
            }
        }
        .btn.elementor-button-text {
            opacity: 1;
        }
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;

        }
        .password-toggle {
            cursor: pointer;
            float: right;
            margin-top: -27px;
            padding-right: 10px
        }
        
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Vedic Tree</title>
    <link rel="icon" href="<?php echo base_url()?>assets/website/img/favicon.png" type="image/png">
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
    <!-- style CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />
</head>

<body>
    <?php $this->load->view('web_header'); ?>
    <section class="otp_verify_section section_padding">
        <div class="container">
            <div class="login-rainbow-bg">
                <h2 class="d-flex justify-content-center kid_title mb-4" style="padding-top: 50px;"> <span class="title_overlay_effect">Update Password</span></h2>
                <form method="POST" action="<?php echo base_url('website/verifyotpweb'); ?>">
                    <?php
                    
                    $forgetmobile = convert_uuencode($this->session->userdata('forgetmobile'));
    
                    if(isset($forgetmobile) || !empty($forgetmobile)){
    
                        $studentMobile = $forgetmobile;
                    }else{
                        $studentMobile = "0";
                    }
                    ?>
                    <input type="hidden" name="studentMobile" id="studentMobile" value="<?php echo $studentMobile; ?>">
                    <div class="login-kids-bg">
                        <div class="reset-password-box">
                            <div class="form-group">
                                <label>Enter OTP</label>
                                <input type="number" maxlength="6" class="form-control" name="otp" value="" placeholder="Enter OTP" autocomplete="off" required>
                                <span style="color:red"><?php echo form_error('otp');?></span>
                            </div>
                            <div class="form-group">
                                <label>Enter New Password</label>
                                <input type="password" id="new_password" class="form-control" name="newpass" value="" placeholder="Enter New Password" autocomplete="off" required>
                                <span class="far fa-eye password-toggle" id="toggleNewPassword"></span>
                                <span style="color:red"><?php echo form_error('newpass');?></span>
                            </div>
                            <div class="form-group">
                                <label>Enter Confirm Password</label>
                                <input type="password" id="confirm_password" class="form-control" name="cnewpass" value="" placeholder="Enter Confirm Password" autocomplete="off" required>
                                <span class="far fa-eye password-toggle" id="toggleConfirmPassword"></span>
                                <span style="color:red"><?php echo form_error('cnewpass');?></span>
                            </div>  
                            <div class="d-flex justify-content-center mb-2">
                                <div id="regenerateOTP" ><a href="#" class="Resentotp">Resend OTP </a></div> 
                            </div>    
                            <div class="d-flex justify-content-center">
                                <div class="pc-button elementor-button" href="#">
                                    <div class="button-content-wrapper">
                                        <button class="btn elementor-button-text"type="submit" value="submit" name="submit">Update</button>
                                        <svg class="pc-dashes inner-dashed-border animated-dashes">
                                            <rect x="5px" y="5px" rx="25px" ry="25px" width="0" height="0"></rect>
                                        </svg> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
<?php $this->load->view('web_footer'); ?>
</html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        type = ['','info','success','warning','danger'];
    </script>
        <script src="<?php echo base_url()?>assets/js/bootstrap-notify.js"></script>

<script type="text/javascript">
    $(document).ready(function(){


       $(".Resentotp").click(function(){

        var studentMobile = $("#studentMobile").val();
        console.log(studentMobile);
            // if(studentMobile==""){

                $.ajax({

                    type:"POST",
                    data:{studentMobile:studentMobile},
                    url:"<?php echo base_url('welcome/resentotp')?>",
                    success:function(res){
                        if(res==1){

                            color = Math.floor((Math.random() * 4) + 1);

                              $.notify({
                                  icon: "tim-icons icon-bell-55",
                                  message: "OTP Sent On Your Mobile Number"

                                },{
                                    type: type[color],
                                    timer: 8000,
                                });
                        }else{

                            color = Math.floor((Math.random() * 4) + 1);

                              $.notify({
                                  icon: "tim-icons icon-bell-55",
                                  message: "Mobile Number not Exsit !"

                                },{
                                    type: type[color],
                                    timer: 8000,
                                });

                        }
                    },
                    error:function(error){
                        console.log(error);
                    }
                })

            // }else{
            //     alert("Enter 10 Digit Number")
            // }
       })
    });
</script>


<script>
    const toggleNewPassword = document.querySelector('#toggleNewPassword');
    const newPassword = document.querySelector('#new_password');
    const confirmPassword = document.querySelector('#confirm_password');
    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');

    toggleNewPassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        newPassword.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

    let timerOn = true;
    function timer(remaining) {
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;
        
        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        document.getElementById('timer').innerHTML = m + ':' + s;
        remaining -= 1;
        
        if(remaining >= 0 && timerOn) {
            setTimeout(function() {
                timer(remaining);
            }, 1000);
            return;
        }

        if(!timerOn) {
            // Do validate stuff here
            return;
        }
    }

    function disableResend() {
        $("#regenerateOTP").attr("disabled", true);
        timer(60);
        //$('.regenerateOTP').prop('disabled', true);
        setTimeout(function() {
            // enable click after 1 second
        $('#regenerateOTP').removeAttr("disabled");
            //$('.disable-btn').prop('disabled', false);
        }, 60000); // 1 second delay
    }

    $('#regenerateOTP').on('click', function () {
        $("#in").show();
        disableResend();
        timer(30);
        $.ajax({
            url: "",
            type: 'post',
            data: {},
            // success: function (data) {
            //     swal({ title: "Sweet!", text: "One time password Message is sent again", timer: 2000, imageUrl: "../images/thumbs-up.jpg" });
            // },
            // error: function () {
            //     swal({ title: "Error!", text: "We are facing technical error!", type: "error", timer: 2000, confirmButtonText: "Ok" });
            //     return false;
            // }
        });
        $("#regenerateOTP").attr('disabled','disabled');
    });
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
                    window.location.href = '<?php echo base_url('login')?>';
       }, 2000);

  </script>

<?php } ?>




