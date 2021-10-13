<!DOCTYPE html>
<html lang="zxx">
<head>
    <style>
        @media (min-width: 769px) {
        .reset-password-box {
                padding: 40px;
                border-radius: 20px;
                box-shadow: 1px 1px 3px 1px rgb(0 0 0 / 20%);
                max-width: 500px;
                margin: auto;
            }
        }
        @media (max-width: 768px) {
        .reset-password-box {
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
            <h2 class="d-flex justify-content-center kid_title mb-4"> <span class="title_overlay_effect">Reset Password</span></h2>
            <form method="POST" action="<?php echo base_url('website/forget_password')?>">
                <div class="reset-password-box">
                    <div class="form-group">
                        <label>Enter Mobile No.</label>
                        <input type="text" maxlength="10"  class="form-control" name="studentMobile" value="<?php if(isset($_COOKIE["studentMobile"])) { echo $_COOKIE["studentMobile"]; } else{ echo set_value('studentMobile'); } ?>" placeholder="Enter Mobile Number" required>
                        <span style="color:red"><?php echo form_error('studentMobile');?></span>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="pc-button elementor-button" href="#">
                            <div class="button-content-wrapper">
                                <button class="btn elementor-button-text"type="submit" value="submit" name="submit">Send</button>
                                <svg class="pc-dashes inner-dashed-border animated-dashes">
                                    <rect x="5px" y="5px" rx="25px" ry="25px" width="0" height="0"></rect>
                                </svg> 
                            </div>
                        </div>
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
</body>
<?php $this->load->view('web_footer'); ?>
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
      
      setTimeout(function() {
                    window.location.href = '<?php echo base_url('website/verifyotpweb')?>';
       }, 2000);

  </script>

<?php } ?>
