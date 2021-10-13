<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-T3FX7LW');</script>
    <!-- End Google Tag Manager -->
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php if($metainfo){ ?>
    <title><?php echo $metainfo[0]['web_Title']; ?></title>
    <meta name="description" content="<?php echo $metainfo[0]['web_metaDesc']; ?>" />
    <meta name="keywords" content="<?php echo $metainfo[0]['web_pageKeyword']; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#fe4b7b">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#fe4b7b">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#fe4b7b">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $metainfo[0]['web_metaTitle']; ?>" />
    <meta property="og:url" content="<?php echo $metainfo[0]['web_metaUrl']; ?>" />
    <meta property="og:description" content="<?php echo $metainfo[0]['web_metaDesc']; ?>" />
    <meta property="og:image" itemprop="image" content="<?php echo base_url()?>uploads/weboggpic/<?php echo $metainfo[0]['weboggpic']; ?>" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="300" />
    <!-- Canonical Url -->
    <link rel="canonical" href="<?php echo $metainfo[0]['web_metaTitle']; ?>" />
    <?php } else { ?>
    <title>Vedic Tree</title>
    <?php } ?>
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
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.min.css" />
    <!--<script src="https://use.fontawesome.com/d1eef018a8.js"></script>-->
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" >
</head>
<?php $usersession = $this->session->userdata('usersession');?>
<header class="header_part">
    <div class="sub_header section_bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="header_contact_info">
                        <a id="contact_email" href="mailto:admissions.vedictree@gmail.com" target="_blank"><i class="fas fa-envelope"></i>admissions.vedictree@gmail.com</a>
                        <a id="contact_phone" href="tel:+91 93200 67800"><i class="fas fa-phone"></i>+91 93200 67800</a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5 col-md-4">
                    <div class="header_social_icon">
                        <p>Follow Us:</p>
                        
                        <!--<a href="https://www.facebook.com/vedictreekidslearningapp/" target="_blank" aria-label="facebook"><i class="fab fa-facebook"></i></a>-->
                        <a href="https://www.facebook.com/vedictreekidslearning/" target="_blank" aria-label="facebook"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/vedictreekidslearningapp/" target="_blank" aria-label="instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.twitter.com/Vedictreekids/" target="_blank" aria-label="twitter"><i class="fab fa-twitter"></i></a> 
                        <!--<a href="https://www.pinterest.com/livevedictree/vedic-tree-kids-learning-app/" aria-label="pinterest"><i class="fab fa-pinterest-p"></i></a>-->
                        <a href="https://www.youtube.com/c/VedicTreeKidsLearningApp-VT/featured" target="_blank" aria-label="youtube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="container">
            <!--<div class="mobile-title-heading" style="position: absolute;"><h1 style="display: none;">PreSchool</h1><h2>Admissions <br> Open</h2></div>-->
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand mr-0" href="<?php echo base_url();?>"><img src="<?php echo base_url()?>assets/website/img/logo.png" alt="Vedic Tree"></a>
                <div class="header-text"><span class="header-one">India's Best</span><span class="header-two">Online Preschool</span></div>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--<div><span>No.1 </span><br><span>Online Preschool</span></div>-->
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
                                <a class="dropdown-item" href="<?php echo base_url('nursery-preschoolapp');?>">Nursery Course</a>
                                <a class="dropdown-item" href="<?php echo base_url('educational-app-kids-4-5-year-olds');?>">Junior Kg Course</a>
                                <a class="dropdown-item" href="<?php echo base_url('online-learning-app-kids-5-6-year-olds');?>">Senior Kg Course</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('about-us');?>">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('gallery');?>">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('blog');?>">Blog</a>
                        </li>
                    </ul>
                        <a href="<?php echo base_url('login');?>" class="cu_btn seagreen_btn mr-2">Login</a>
                    
                    <a href="<?php echo base_url('register'); ?>" class="cu_btn btn_1">Register</a>
                </div>
            </nav>
        </div>
    </div>
</header>
