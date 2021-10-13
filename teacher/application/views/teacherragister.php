<!DOCTYPE html>
<html lang="zxx">
<head>
<style>
    @media (min-width: 769px) {
        .signup-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 1px 1px 3px 1px rgb(0 0 0 / 20%);
        }
    }
    @media (max-width: 768px) {
        .signup-box {
            background: white;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 1px 1px 3px 1px rgb(0 0 0 / 20%);
        }
    }
    .required-label::after {
        content: "*";
        color: red;
        margin-left: 2px;
    }
    .password-toggle {
        cursor: pointer;
        float: right;
        margin-top: -27px;
        padding-right: 10px
    }
    .signup-box {
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 1px 1px 3px 1px rgb(0 0 0 / 20%);
    width: 500px;
    margin-left: 367px;
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
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WMSPB64');
    </script>
    <!-- End Google Tag Manager -->
    <!--Start Facebook Pixel Code-->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '480185576358026');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=480185576358026&ev=PageView&noscript=1"/></noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WMSPB64"
        height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- End Preloader  -->
    <?php $this->load->view('web_header'); ?>
    <!-- contact page -->
    <section class="contact_page section_padding">
        <div class="container">
            <h2 class="d-flex justify-content-center kid_title mb-4"> <span class="title_overlay_effect">Teacher Register Here</span></h2>
            <form method="POST" action="<?php echo base_url("teacher/registration_form") ?>" >
                <div class="signup-box">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="required-label">Enter Full Name</label>
                                <input type="text" name="teacherName" class="form-control" value="<?php echo set_value('teacherName');?>" placeholder="Enter  Full Name">
                            </div>
                            <span style="color:red"><?php echo form_error('teacherName');?></span>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="required-label">Enter Mobile</label>
                                <input type="number" value="<?php echo set_value('teacherMobile');?>"  name="teacherMobile" class="form-control" placeholder="Enter Phone">
                                <span style="color:red"><?php echo form_error('teacherMobile');?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="required-label">Enter Email</label>
                                <input type="text" value="<?php echo set_value('teacherEmail');?>" name="teacherEmail" class="form-control" placeholder="Enter Email">
                                <span style="color:red"><?php echo form_error('teacherEmail');?></span>
                            </div>
                        </div>

                           <div class="col-sm-6">
                            <div class="form-group">
                                <label class="required-label">Enter Password</label>
                                <input type="Password" value="<?php echo set_value('teacherPass');?>" class="form-control" name="teacherPass" placeholder="Enter Password">
                                <span class="far fa-eye password-toggle" id="togglePassword"></span>
                                <span style="color:red"><?php echo form_error('teacherPass');?></span>
                            </div>
                        </div>
                       
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label>Class Name</label>
                            <label class="required-label">Select Class</label>
                                <select name="teacherClass" class="form-control">
                                    <option value="0">Select Class </option>
                                    <option value="1" <?php echo set_select('teacherClass', '1'); ?>>Nursery</option>
                                    <option value="2" <?php echo set_select('teacherClass', '2'); ?>>Jr. Kg</option>
                                    <option value="3" <?php echo set_select('teacherClass', '3'); ?>>Sr. Kg</option>
                                </select>
                                <span style="color:red"><?php echo form_error('teacherClass');?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <div class="mt-2">
                                    <label class="radio-inline mr-2"><input type="radio" name="teacherGender" value="Male" checked> Male</label>
                                    <label class="radio-inline"><input type="radio" name="teacherGender" value="Female"> Female</label>
                                </div>
                                <span style="color:red"><?php echo form_error('teacherGender');?></span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a class="pc-button elementor-button" href="#">
                        <div class="button-content-wrapper">
                            <button  class="btn elementor-button-text" type="submit" value="submit" name="submit">Submit</button>
                            <svg class="pc-dashes inner-dashed-border animated-dashes">
                                <rect x="5px" y="5px" rx="25px" ry="25px" width="0" height="0"></rect>
                            </svg> 
                        </div>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="about_page_animation_1">
            <div data-parallax='{"x": 2, "y": 70, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/icon_7.png" alt="#"></div>
        </div>
        <div class="about_page_animation_2">
            <div data-parallax='{"x": 10, "y": 80, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/event_6.png" alt="#"></div>
        </div>
        <div class="about_page_animation_3">
            <div data-parallax='{"x": 30, "y": 60, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/banner_two_2.png" alt="#"></div>
        </div>
        <div class="about_page_animation_4">
            <div data-parallax='{"x": 30, "y": 50, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/team_animation.png" alt="#" class="img-fluid"></div>
        </div>
    </section>
    <!-- footer part here -->
<?php $this->load->view('web_footer'); ?>

</body>
</html>

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

<?php if(isset($check_exist_success)){ ?>
  <script type="text/javascript">
    color = Math.floor((Math.random() * 4) + 1);

      $.notify({
          icon: "tim-icons icon-bell-55",
          message: "<?php if(isset($check_exist_success)){ echo $check_exist_success['error']; } ?>"

        },{
            type: type[color],
            timer: 8000,
        });
      
      setTimeout(function() {
                    window.location.href = '<?php echo base_url('/teacher-login')?>';
       }, 2000);

  </script>

<?php } ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const passwordConfirm = document.querySelector('#passwordConfirm');
    const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');

    togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
    });

    togglePasswordConfirm.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordConfirm.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
    });
    
</script>


