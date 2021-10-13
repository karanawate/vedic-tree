<?php 
// echo "<pre>";
$usersession = $this->session->userdata('usersession'); 
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
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

    <!-- contact page -->
    <section class="contact_page section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact_form form_style">
                        <h2 class="kid_title mb-4"> <span class="title_overlay_effect">Update More Information</span></h2>
                        <form method="POST" action="<?php echo base_url('website/nextstep')?>">
                            <input type="hidden" value="<?php echo $usersession[0]['studId']?>" name="studId">
                            <div class="row">

                                <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Select Class </label>
                                        <select name="studentClass" class="form-control">
                                            <option value="">Select Class </option>
                                            <option value="1">Nursery</option>
                                            <option value="2">Junior</option>
                                            <option value="3">Senior</option>
                                        </select>
                                    </div>
                                    <span style="color:red"><?php echo form_error('studentClass');?></span>
                                </div>

                                    <div class="col-lg-6 ">
                                        <div class="form-group">
                                            <label>Enter Mobile </label>
                                            <input type="text" maxlength="10" class="form-control" name="studentMobile" value="<?php echo set_value('studentMobile');?>" required="" placeholder="Enter Phone">
                                        </div>
                                        <span style="color:red"><?php echo form_error('studentMobile');?></span>
                                    </div>

                                    <div class="col-lg-6 ">
                                        <div class="form-group">
                                            <label>Enter Password </label>
                                            <input type="Password" class="form-control" name="studentPass" value="<?php echo set_value('studentPass');?>" required="" placeholder="Enter Phone">
                                        </div>
                                        <span style="color:red"><?php echo form_error('studentPass');?></span>
                                    </div>
                                    <div class="col-lg-6 ">
                                        <div class="form-group">
                                            <label>Enter Confirm Password </label>
                                            <input type="Password" class="form-control" name="studentCPass" value="<?php echo set_value('studentCPass');?>" required="" placeholder="Enter Confirm Password">
                                        </div>
                                         <span style="color:red"><?php echo form_error('studentCPass');?></span>
                                    </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <div class="col-lg-6">
                                        <input type="radio" checked="" name="studentGender" value="Male" > Male
                                        <input type="radio" name="studentGender" value="Female"> Female
                                        </div>
                                    </div>
                                    <span style="color:red"><?php echo form_error('studentGender');?></span>
                                </div>

                                <a class="pc-button elementor-button" style="margin-top:2%;margin-left: 35px;" href="#">
                                    <div class="button-content-wrapper">
                                        <button  class="btn elementor-button-text" type="submit" value="submit" name="submit">Update</button>
                                        <svg class="pc-dashes inner-dashed-border animated-dashes">
                                            <rect x="5px" y="5px" rx="25px" ry="25px" width="0" height="0"></rect>
                                        </svg> 
                                    </div>
                                </a>
                            </form>
                            </div>
                        </div> 

                    </div>
                </div>
                <div class="col-lg-4 pl-lg-5">
                    <div class="blog_sidebar">
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
                        <div class="social_icon">
                            <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/"><i class="ti-instagram"></i></a>
                            <a href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://dribbble.com/"><i class="ti-dribbble"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact page end -->

    <!-- map part here -->
    <section class="map_part">
        <div class="container-fluid no-gutters">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="contactMap">
                        <div id="contactMap" data-lat="40.701083" data-lon="-74.1522848" data-zoom="10" data-info="9 Road, Mirpur Dohs, Dhaka." data-marker="<?php echo base_url()?>assets/website/img/map_icon.png" data-mlat="40.701083" data-mlon="-74.1522848">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- map part end -->

    <!-- footer part here -->
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
        window.location.href = '<?php echo base_url('website')?>';
       }, 2000);

  </script>

<?php } ?>

</body>

</html>
