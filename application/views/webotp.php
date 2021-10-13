<?php
$studentMobile = $this->session->userdata('studentMobile');
$usersession   = $this->session->userdata('usersession');
if($usersession){
// echo "<pre>";print_r($usersession);
$promoCode     = $usersession[0]['promoCode'];
}
?><!DOCTYPE html>
<html lang="zxx">
<head>
    <style>
        .login-address-view {
            display: grid;
            grid-template-columns: 0.8fr 1.2fr;
        }
        @media (min-width: 600px) and (max-width: 899px){
            .login-address-view { grid-template-columns: repeat(auto-fit, minmax(12rem,1fr)); display: flow-root;}
        }
        @media (min-width: 300px) and (max-width: 599px){
            .login-address-view { grid-template-columns: repeat(auto-fit, minmax(10rem,1fr)); display: flow-root;}
        }
        .login-address-view .login-view{

        }
        .login-address-view .address-view {
            padding: 0 30px;
        }
        @media (min-width: 600px) and (max-width: 899px){
            .login-address-view .address-view { 
                padding: 0;
            }
        }
        .login-address-view .login-view .login-box {
            padding: 40px;
            border-radius: 20px;
            box-shadow: 1px 1px 3px 1px rgb(0 0 0 / 20%);
        }
        .login-address-view .login-view .login-box .social-login{
            position: relative;
        }
        .login-address-view .login-view .login-box .or-text {
            display: block;
            width: 100%;
            height: 1px;
            background: #b2b2b2;
            margin: 29px 0;
            position: relative;
        }
        .login-address-view .login-view .login-box .or-text:before {
            content: "OR";
            position: absolute;
            left: 0;
            right: 0;
            top: -15px;
            text-align: center;
            margin: 0 auto;
            width: 30px;
            line-height: 30px;
            background: #fff;
            font-style: normal;
            color: #b2b2b2;
        }
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
    <!-- style CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />
</head>

<body>
    
    <?php $this->load->view('web_header'); ?>

    <section class="contact_page section_padding">
        <div class="container">
            <div class="login-address-view">
                <div class="login-view">
                    <h2 class="kid_title mb-4"> <span class="title_overlay_effect">Enter OTP Here</span></h2>
                    <form class="mt-4" method="post" action="<?php echo base_url('website/verifyotp')?>">
                                    <input type="hidden" class="mobno" value="<?php echo convert_uuencode($studentMobile); ?>" name="studentMobile">
                                    <div class="form-group">
                                        <label for="username">Enter OTP</label>
                                        <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP">
                                        <span style="color:red"><?php echo form_error('otp'); ?></span>
                                       <span style="color:red"><?php echo form_error('studentMobile'); ?></span> 
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <a  href="#" style="display: none;" class="Resentotp">Resent OTP </a>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Verify OTP</button>
                                        </div>
                                    </div>
                                 </form>
                </div>
                <div class="address-view">
                <div class="contact_sidebar">
                            <h2 class="kid_title mb-4"> <span class="title_overlay_effect">Address Info</span></h2>
                            <div class="single_contact_sidebar">
                                <i class="icon_pin"></i>
                                <div class="contact_sidevar_content">
                                    <h5>Location</h5>
                                    <p>Plot No 23, Amrut Heights, Sector 4,  Maharashtra 410206 <br>
                                        Karanjade, Panvel, Navi Mumbai,</p>
                                </div>
                            </div>
                            <div class="single_contact_sidebar">
                                <i class="icon_phone"></i>
                                <div class="contact_sidevar_content">
                                    <h5>Phone</h5>
                                    <p>+91 93200 67800</p>
                                </div>
                            </div>
                            <div class="single_contact_sidebar">
                                <i class="icon_mail"></i>
                                <div class="contact_sidevar_content">
                                    <h5>Email</h5>
                                    <p>Elearning.vedictree@gmail.com</p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact page end -->
<?php $this->load->view('web_footer'); ?>

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
                    window.location.href = '<?php echo base_url('website/web_login')?>';
       }, 2000);
       
  </script>

<?php } ?>

<?php if(isset($success)){ 

if($promoCode == "15august")
     {
        $url = base_url('website/skim') ;
     } else {
        $url = base_url('website/vedic_dash') ;
     } 
?>
  <script type="text/javascript">
    color = Math.floor((Math.random() * 4) + 1);

      $.notify({
          icon: "tim-icons icon-bell-55",
          message: "<?php if(isset($success)){ echo $success['error']; } ?>"

        },{
            type: type[color],
            timer: 8000,
        });

       setTimeout(function() {
                    window.location.href = '<?php echo $url; ?>';
       }, 2000);


  </script>

<?php } ?>


<script type="text/javascript">
  $('.Resentotp').delay(5000).show(0);   
</script>


<script type="text/javascript">
    $(document).ready(function(){

       $(".Resentotp").click(function(){

        var studentMobile = $(".mobno").val();
            // if(studentMobile.length==10){

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



</body>

</html>