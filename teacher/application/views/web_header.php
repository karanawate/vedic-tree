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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" >

</head>
<?php
$usersession = $this->session->userdata('usersession');
?>
    <header class="header_part">
        <div class="sub_header section_bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-7 col-md-8">
                        <div class="header_contact_info">
                            <a href="mailto:Elearning.vedictree@gmail.com" target="_blank"><i
                                    class="fas fa-envelope"></i>Elearning.vedictree@gmail.com</a>
                            <a href="tel:+91 93200 67800"><i class="fas fa-phone"></i>+91 93200 67800</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-5 col-md-4">
                        <div class="header_social_icon">
                            <p>Follow Us:</p>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url()?>assets/website/img/logo.png"
                                    alt="Vedic Tree"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                                <ul class="navbar-nav">
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url();?>">Home</a>
                                    </li> 
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Courses
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?php echo base_url('course-one');?>">Nursery Course</a>
                                            <a class="dropdown-item" href="<?php echo base_url('course-two');?>">Junior Kg Course</a>
                                            <a class="dropdown-item" href="<?php echo base_url('course-three');?>">Senior Kg Course</a>
                                        </div>

                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url('about-us');?>">About Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url('blog');?>">Blog</a>
                                    </li>
                                </ul>
                                    <a href="<?php echo base_url('teacher/index');?>" class="cu_btn seagreen_btn mr-2">Login</a>
                                
                                <!--<a href="<?php // echo base_url('teacher/teacher_ragister'); ?>" class="cu_btn btn_1">Register</a>-->
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
