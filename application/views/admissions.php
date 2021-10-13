<!DOCTYPE html>
<html lang="zxx">
<head>
<style>
    @media (min-width: 576px) {
    .modal-dialog {
        max-width: 700px !important;
    }
}
</style>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T3FX7LW');</script>
<!-- End Google Tag Manager -->
<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Vedic Tree Free Class</title>
<link rel="icon" href="<?php echo base_url()?>assets/website/img/favicon.png">
<!-- Bootstrap CSS & JS-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
<!-- Custom Style -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/landing/css/style.min.css">
<!-- animate CSS -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/animate.css" />
<!-- magnify popup CSS -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/magnify_popup/magnific-popup.css" />
<!-- owl carousel CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T3FX7LW"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="header" id="myHeader">
        <div class="d-flex container">
            <div style="width: 100px; height: 100px">
                <a class="navbar-brand mr-0" href="<?php echo base_url()?>admissions">
                    <img src="<?php echo base_url()?>assets/website/landing/img/logo/logo.png" class="landing-logo" alt="Vedic Tree">
                </a>
            </div>
            <div class="title-heading1">
                <h1 style="display: none;">PreSchool</h1>
                <div class="desktop-head-text">
                    <h2 style="text-align: center;">Admission Open For 2021-2022</h2>
                    <!--<div class="free-edu">Real Education is now Free!</div>-->
                </div>
                <div class="mobile-head-text">
                    <!--<div class="header-text"><span class="header-one">India's Best</span><span class="header-two">Online Preschool</span></div>-->
                     <h2 style="text-align: center;"><span class="header-one">India's Best</span><br><span class="header-two">Online Preschool</span></h2>
                    <!--<div class="free-edu">Real Education is now <span>Free!</span></div>-->
                </div>
            </div>
            <div class="home-shortcut">
                <a href="<?php echo base_url()?>" style="text-decoration: none;">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <div>Home</div>
                </a>
            </div>
        </div>
    </div>
    <div class="student-count">
        <div class="count">
            <span>Students Enrolled</span>
            <div class="enrolled"><?php echo $fakecount;?></div>
        </div>
        <div class="home-shortcut1">
            <a href="<?php echo base_url()?>" style="text-decoration: none;">
                <i class="fa fa-home" aria-hidden="true"></i>
                <div>Home</div>
            </a>
        </div>
    </div>
    <!-- Desktop view banner part here -->
    <section class="banner_part banner_style_3 desktop-tablet-view" id="demo_section">
        <div class="single_banner_part freeclass">
            <div class="container custom_container">
                <div class="block-view">
                    <div class="empty-block"></div>
                    <div class="register-block">
                        <div class="register-box">
                            <div class="form-wrapper-outer">
                                <div class="form-logo">
                                    <img src="<?php echo base_url()?>assets/website/landing/img/logo/register_logo_landing.png" alt="logo">
                                </div> 
                                <h2 class="demo-class-text-1"><span class="font-size-text1">Register for </span><span class="free-class-text">FREE </span>Demo Class</h2>
                                <form id="log" method="POST" action="<?php echo base_url('website/temp_enquiry')?>">
                                <input type="hidden" name="promoCode" value="freeEducation">
                                    <div class="field-wrapper">
                                        <input type="text" name="studentName" id="studentName" autocomplete="off" required>
                                        <div class="field-placeholder"><span>Enter Name of your Child</span></div>
                                    </div>
                                    <div class="field-wrapper">
                                        <input type="email" name="studentEmail" id="studentEmail" autocomplete="off" required>
                                        <div class="field-placeholder"><span>Enter your Email</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="field-wrapper">
                                                <input type="text" maxlength="10" name="studentMobile" id="studentMobile" autocomplete="off" required>
                                                <div class="field-placeholder1"><span>Enter your Mobile Number</span></div>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="floating-label">  
                                                <select class="floating-select" name="studentClass" onclick="this.setAttribute('value', this.value);" value="" id="selectClassD">
                                                    <option value="" selected disabled></option>
                                                    <option value="1">Nursery</option>
                                                    <option value="2">Junior Kg</option>
                                                    <option value="3">Senior Kg</option>
                                                </select>
                                                <span class="highlight"></span>
                                                <label class="select-label">Select</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-button d-flex justify-content-center">
                                        <button type="submit" name="submit" value="submit" id="admissionsD" class="register-now">Register Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <h1 class="headline-tag">
                            <span>"Naye Zamane Ki Nayi School"</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="banner_animation_1">
                <div data-parallax='{"x": 20, "y": 200, "rotateZ": 360}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_19.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_3">
                <div data-parallax='{"x": 0, "y": 200, "rotateZ":0}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_3.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_4">
                <div data-parallax='{"x": 30, "y": 250, "rotateZ":0}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_16.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_5">
                <div data-parallax='{"x": 20, "y": 150, "rotateZ": 180}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_5.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_7">
                <div data-parallax='{"x": 100, "y": 250, "rotateZ":0}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_15.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_9">
                <div data-parallax='{"x": 20, "y": 200, "rotateZ":0}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_18.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_10">
                <div data-parallax='{"x": 15, "y": 150, "rotateZ":0}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_10.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_12">
                <div data-parallax='{"x": 20, "y": 150, "rotateZ":180}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_20.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_13">
                <div data-parallax='{"x": 10, "y": 250, "rotateZ": 180}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_21.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_15">
                <div data-parallax='{"x": 10, "y": 200, "rotateZ":0}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_17.png" alt="#">
                </div>
            </div>
        </div>
    </section>
    <!-- Desktop view banner part end -->
    <div class="register-box1 p-3">
        <div class="form-wrapper-outer">
            <h2 class="demo-class-text-1"><span class="font-size-text1">Register For </span><span class="free-class-text">FREE</span> Demo Class</h2>
            <form id="log" method="POST" action="<?php echo base_url('website/temp_enquiry')?>">
            <input type="hidden" name="promoCode" value="freeEducation">
                <div class="field-wrapper">
                    <input type="text" name="studentName" id="studentNameMobile" autocomplete="off" required>
                    <div class="field-placeholder"><span>Enter Name of your Child</span></div>
                        <span style="color:red"><?php echo form_error('studentName'); ?></span>
                    </div>
                <div class="field-wrapper">
                <input type="email" name="studentEmail" id="studentEmailMobile" autocomplete="off" required>
                    <div class="field-placeholder"><span>Enter your Email</span></div>
                    <span style="color:red"><?php echo form_error('studentEmail'); ?></span>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="field-wrapper">
                            <input type="text" maxlength="10" name="studentMobile" id="studentMobileMobile" autocomplete="off" required>
                            <div class="field-placeholder1"><span>Enter your Mobile Number</span></div>
                            <span style="color:red"><?php echo form_error('studentMobile'); ?></span>
                        </div>
                    </div>
                    <div class="col-4 pl-0">
                        <div class="floating-label">  
                            <select class="floating-select" name="studentClass" onclick="this.setAttribute('value', this.value);" value="" id="selectClassM">
                                <option value="" selected disabled></option>
                                <option value="1" <?php echo set_select('studentClass', '1'); ?>>Nursery</option>
                                <option value="2" <?php echo set_select('studentClass', '2'); ?>>Junior KG</option>
                                <option value="3"<?php echo set_select('studentClass', '3'); ?>>Senior KG</option>
                            </select>
                            <span class="highlight"></span>
                            <span style="color:red"><?php echo form_error('studentClass'); ?></span>
                            <label class="select-label">Select Class</label>
                        </div>
                    </div>
                </div>
                <div class="form-button d-flex justify-content-center">
                    <button type="submit" name="submit" value="submit" id="registerDemoMobile" class="register-now">Register Now</button>
                </div>
            </form>
        </div>
    </div>
    <div class="apk-mobile-view">
        <a href="https://play.google.com/store/apps/details?id=com.vedictree.preschool" target="_blank">
            <div style="margin: 10px 0;background: #e3f0d4;padding: 10px;">
                <img style="width: 100%;" src="<?php echo base_url()?>assets/website/landing/img/mobile-google-play.png">
            </div>
        </a>
    </div>
    <h2 class="headline-tag mt-1">"Naye Zamane Ki Nayi School"</h2>
    <!-- Mobile view banner part here -->
    <section class="banner_part banner_style_3 mobile-view" id="demo_section">
        <div class="single_banner_part">
            <div class="banner_animation_1">
                <div data-parallax='{"x": 20, "y": 200, "rotateZ": 360}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_19.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_3">
                <div data-parallax='{"x": 0, "y": 200, "rotateZ":0}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_3.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_4">
                <div data-parallax='{"x": 30, "y": 250, "rotateZ":0}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_16.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_5">
                <div data-parallax='{"x": 20, "y": 200, "rotateZ": 180}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_5.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_7">
                <div data-parallax='{"x": 100, "y": 250, "rotateZ":0}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_15.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_9">
                <div data-parallax='{"x": 20, "y": 200, "rotateZ":0}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_18.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_10">
                <div data-parallax='{"x": 15, "y": 150, "rotateZ":0}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_10.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_12">
                <div data-parallax='{"x": 20, "y": 150, "rotateZ":180}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_20.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_13">
                <div data-parallax='{"x": 10, "y": 250, "rotateZ": 180}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_21.png" alt="#">
                </div>
            </div>
            <div class="banner_animation_15">
                <div data-parallax='{"x": 10, "y": 200, "rotateZ":0}'>
                    <img src="<?php echo base_url()?>assets/website/img/icon/banner_icon/animated_banner_17.png" alt="#">
                </div>
            </div>
        </div>
    </section>
    <!-- Mobile view banner part end -->
    <!--<section class="event_section section_padding">-->
    <!--    <div class="container-timer">-->
    <!--        <div id="countdown">-->
    <!--        <div id="headline1" class="headline">Enroll now we are just</div>-->
    <!--            <ul class="p-0 mb-0">-->
    <!--                <li class="timer"><span id="days"></span>Days</li>-->
    <!--                <li class="timer"><span id="hours"></span>Hours</li>-->
    <!--                <li class="timer"><span id="minutes"></span>Minutes</li>-->
    <!--                <li class="timer"><span id="seconds"></span>Seconds</li>-->
    <!--            </ul>-->
    <!--            <div class="headline">away from launching</div>-->
    <!--        </div>-->
    <!--        <div id="content" class="emoji">-->
    <!--            <span>Daily Live Session is LIVE</span>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- event section part here -->
    <section class="event_section section_padding" style="background: #fcf9f4;">
        <div class="container custom_container">
            <div class="row justify-content-between">
                <div class="col-lg-6">    
                    <div class="img_section">
                        <iframe class="responsive-iframe-welcome" src="https://www.youtube.com/embed/PuF2pSWlLt4?autoplay=1&mute=0&enablejsapi=1&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="event_section_content mt-3">
                        <h2 class="wow fadeInRight kid_title" data-wow-delay=".4s"> <span class="title_overlay_effect">Why Vedic Tree is the Best Online Preschool ?</span></h2>
                        <?php 
                            $Topics  = array(
                                '1' =>'High level Online Education with Animations',
                                '2' =>'Valuable Online Classes',
                                '3' =>'Online e-books for overall development',
                                '4' =>'Daily preschool activities',
                                '5' =>'Extra-Curricular Activities Included',
                                '6' =>'Innovative Teaching Methods',
                                '7' =>'Best early learning app available in the market',
                            );
                        ?>
                        <ul class="points-text">
                            <?php if($Topics) {
                                foreach ($Topics as $key => $value) {       
                                $color = '#013983';
                             ?>
                            <li style="color:<?php echo $color;?>"><?php echo $value;?></li>
                            <?php }} ?>
                        </ul>
                        <div class="register-mobile">
                            <div class="pc-button elementor-button button-link cu_btn button-content-wrapper" onclick="book_demo()" >
                                <div class="button-content-wrapper"> 
                                    <span class="elementor-button-text">Register Now</span>
                                    <svg class="pc-dashes inner-dashed-border animated-dashes">
                                        <rect x="5px" y="5px" rx="22px" ry="22px" width="0" height="0"></rect>
                                    </svg>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <!-- event section part end -->
    <a href="https://play.google.com/store/apps/details?id=com.vedictree.preschool" target="_blank">
        <div class="download-apk"></div>
    </a>
    <!-- services part here -->
    <section class="cta_section section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-sm-8 wow fadeInUp" data-wow-delay=".3s">
                    <div class="cta_section_wrapper">
                        <img src="<?php echo base_url()?>assets/website/img/cta_img.png" alt="#" class="img-fluid">
                        <h2 class="wow fadeInRight" data-wow-delay=".4s"><span class="title_overlay_effect">What makes us unique?</span></h2>
                        <p><span style="color:green; font-weight: 900;">VEDIC TREE</span> believes that Value Based Education is the key to success and Education is baseless if there are no values embedded in it. Hence at Vedic Tree the Curriculum has been designed in such a manner that <span style="color: red;font-weight: 900;"> VALUES & LIFE SKILL ACTIVITIES</span> are included in the day to day learning. Value based learning happens in a <span style="color:goldenrod;font-weight: 900;"> PLAY & LEARN Method.</span></p>
                        <!--<p>Our motive is to provide free basic education to every child as it is the start of their journey and core foundations of their values. We are providing nursery live classes with animated video free for whole Academic Education. Vedic Tree the curriculum has been designed in such a manner that values & life skill activities are included in the day to day learning. Value based learning happens in a play & learn method.</p>-->
                        
                        <div class="pc-button elementor-button button-link cu_btn" onclick="book_demo()">
                            <div class="button-content-wrapper ">
                                <span class="elementor-button-text">Register Now</span>
                                <svg class="pc-dashes inner-dashed-border animated-dashes">
                                    <rect x="5px" y="5px" rx="22px" ry="22px" width="0" height="0"></rect>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cta_animation_1">
            <div data-parallax='{"x": 2, "y": 120, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/cta_1.png" alt="#"></div>
        </div>
        <div class="cta_animation_2">
            <div data-parallax='{"x": 10, "y": 100, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/event_7.png" alt="#">
            </div>
        </div>
        <div class="cta_animation_3">
            <div data-parallax='{"x": 30, "y": 110, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/cta_3.png" alt="#">
            </div>
        </div>
        <div class="cta_animation_4">
            <div data-parallax='{"x": 5, "y": 105, "rotateZ":0}'><img src="img/icon/banner_two_3.png" alt="#"></div>
        </div>
    </section>
    <!-- services part end -->
    <!-- cta part here -->
    <section class="cta_part section_padding">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-9">
                    <div class="cta_part_iner">
                        <p>Providing the Best Quality Education at the Most Affordable Fees</p>
                        <h2>Vedic Tree Stars</h2>
                        <h3>Admissions Open</h3>
                        <h3>Book your  Free Demo Now</h3>
                        <div onclick="book_demo()" class="cu_btn white_bg font-weight-bold book-button">Book Now</div>
                        <!-- <div id="book_demo" class="font-weight-bold">Book Now</div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb_animation_1">
            <div data-parallax='{"x": -30, "y": -20}'>
                <img src="<?php echo base_url()?>assets/website/img/cta_img_1.png" alt="#">
            </div>
        </div>
        <div class="breadcrumb_animation_2">
            <div data-parallax='{"x": 20, "y": -50}'>
                <img src="<?php echo base_url()?>assets/website/img/cta_img_2.png" alt="#">
            </div>
        </div>
    </section>
    <!-- cta part end -->
    <!--parent video review here -->
    <section class="event_list section_padding section_bg_1">       
        <div class="container custom_container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section_tittle_style_02">
                        <h2 class="title wow fadeInDown" data-wow-delay=".3s"> <span class="title_overlay_effect">Parent Video Review</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="review_slider owl-carousel">
                        <?php if($reviews){ foreach($reviews as $review){ ?>
                        <div class="wow fadeInUp review-item" style="position: relative;" data-wow-delay=".2s">
                            <div class="review_list_img video-btn" data-src="<?php echo $review['youtube_input_link']; ?>" data-target="#myModal" data-toggle="modal">
                                <i class="fa fa-play-circle-o" style="position: absolute;top: 40%;left: 40%;font-size: 80px;z-index: 2;" aria-hidden="true"></i>
                                <img src="<?php echo $review['image_input_link']; ?>" style="opacity: 0.9;" title="YouTube Video" alt="YouTube Video" />
                            </div>
                        </div>
                        <?php } }?>
                    </div>
                </div>
            </div> 
        </div>
        <!--<div class="event_list_animation_1">-->
        <!--    <div data-parallax='{"x": 2, "y": 70, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/icon_5.png" alt="#"></div>-->
        <!--</div>-->
        <!--<div class="event_list_animation_3">-->
        <!--    <div data-parallax='{"x": 30, "y": 60, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/icon_7.png" alt="#"></div>-->
        <!--</div>-->
        <!--<div class="event_list_animation_4">-->
        <!--    <div data-parallax='{"x": 30, "y": -50, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/icon_8.png" alt="#" class="img-fluid"></div>-->
        <!--</div>-->
    </section>
    <!-- parent video review end -->
    <!-- testimonial part here -->
    <section class="testimonial_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section_tittle_style_02">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s"> <span class="title_overlay_effect">What Parents Say</span></h1>
                        <!-- <p class="description wow fadeInDown" data-wow-delay=".3s">Review From Happy Parents</p> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial_slider owl-carousel">
                        <?php if($parents_review_update_list) { 
                            foreach ($parents_review_update_list as $key => $value) {
                        ?>
                        <div class="single_testimonial_slider">
                            <div class="client_speech">
                                <div class="date-right"><?php echo date("Y-m-d", strtotime($value['createDT']));?></div>
                                <img src="<?php echo base_url()?>assets/website/img/quote.png" alt="#">
                                <p><?php echo $value['reviewDec']; ?></p>
                                <img src="<?php echo base_url()?>assets/website/img/shape_1.png" alt="#" class="client_speech_shape">
                            </div>
                            <div class="client_info">
                                <img src="<?php echo base_url('uploads/parents_review_image/'.$value['parents_review_image'])?>" alt="#">
                                <h4><?php echo $value['parentName']; ?><span class="color_1"><?php echo $value['className']; ?>.Kg</span></h4>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial_animation_1">
            <div data-parallax='{"x": 2, "y": 120, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/feature_5.png" alt="#"></div>
        </div>
        <div class="testimonial_animation_2">
            <div data-parallax='{"x": 10, "y": 100, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/event_4.png" alt="#"></div>
        </div>
        <div class="testimonial_animation_3">
            <div data-parallax='{"x": 30, "y": 110, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/event_6.png" alt="#"></div>
        </div>
        <div class="testimonial_animation_4">
            <div data-parallax='{"x": 30, "y": -110, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/event_7.png" alt="#"></div>
        </div>
    </section>
    <!-- testimonial part end -->
    <!-- ad-banner area start  -->
    <section class="ad-banner-container mt-5">
        <div class="header-ad-banner">
            <div class="header-ad-text">
                <div class="demo-ad-text">
                    <span>
                        <p class="bold-text">Experience Vedic Tree</p>
                        <!--<div class="small-font">For Absolutely Free</div>-->
                    </span>
                    <div class="book-now">
                        <div onclick="book_demo()" class="book-button">Book 1 Week Free Demo Now</div>
                    </div>
                </div>
            </div>
            <div class="image-container"></div>
        </div>
    </section>
    <!-- ad-banner area end  -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: relative;top: -10px;right: 0px;">
                        <span aria-hidden="true"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer class="footer_section footer_style_3">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-3 col-sm-6 wow fadeInDown" data-wow-delay=".3s">
                <div class="single_footer_widget">
                    <a href="#" class="footer_logo"><img src="<?php echo base_url()?>assets/website/img/register_logo.png" alt="#"></a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInDown" data-wow-delay=".5s">
                <div class="single_footer_widget footer_nav">
                    <h4>Follow Us At</h4>
                    <div class="social-buttons">
                        <!--<a href="https://www.facebook.com/vedictreekidslearningapp/" target="_blank" class="fa fa-facebook"></a>-->
                        <a href="https://www.facebook.com/vedictreekidslearning/" target="_blank" class="fa fa-facebook"></a>
                        <a href="https://twitter.com/Vedictreekids/" target="_blank" class="fa fa-twitter"></a>
                        <a href="https://www.instagram.com/vedictree_kidslearning_app/" target="_blank" class="fa fa-instagram"></a>
                        <a href="https://www.linkedin.com/company/77918646/admin/" target="_blank" class="fa fa-linkedin"></a>
                        <a href="https://www.youtube.com/c/VedicTreeKidsLearningApp-VT/featured" target="_blank" class="fa fa-youtube-play"></a>
                    </div>
                    <h4 style="margin-top: 10px;">App Available at</h4>
                    <a href="https://play.google.com/store/apps/details?id=com.vedictree.preschool" target="_blank">
                        <img src="<?php echo base_url()?>assets/website/landing/img/google-play.png" style="width: 160px;" alt="#">
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4 col-sm-6 wow fadeInDown" data-wow-delay=".7s">
                <div class="single_footer_widget footer_nav">
                    <h4>Reach Us At</h4>
                    <div class="footer_contact_info">
                        <div><a href="mailto:admissions.vedictree@gmail.com" target="_blank"><i class="fa fa-envelope mr-3"></i>admissions.vedictree@gmail.com</a></div>
                        <div><a href="tel:+91 93200 67800"><i class="fa fa-phone mr-3"></i>+91 93200 67800</a></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6 wow fadeInDown" data-wow-delay=".9s">
                <div class="single_footer_widget footer_nav">
                    <div class="google-app-mobile">
                        <img src="<?php echo base_url()?>assets/website/img/mobile-logo.png" style="height: 230px;" alt="#"> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_animation_1">
        <div data-parallax='{"x": 2, "y": 60, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/footer_icon_1.png" alt="#"></div>
    </div>
    <div class="footer_animation_2">
        <div data-parallax='{"x": 10, "y": 70, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/footer_icon_2.png" alt="#"></div>
    </div>
    <div class="footer_animation_3">
        <div data-parallax='{"x": 30, "y": 80, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/footer_icon_3.png" alt="#"></div>
    </div>
</footer>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>

<!-- wow js -->
<script src="<?php echo base_url()?>assets/website/vendors/wow/wow.min.js"></script>
<!-- magnify popup js -->
<script src="<?php echo base_url()?>assets/website/vendors/magnify_popup/jquery.magnific-popup.js"></script>
<!-- parallax js -->
<script src="<?php echo base_url()?>assets/website/vendors/parallax/jquery.parallax-scroll.js"></script>
<script src="<?php echo base_url()?>assets/website/vendors/parallax/parallax.js"></script>
<!-- nice select -->
<script src="<?php echo base_url()?>assets/website/vendors/niceselect/js/jquery.nice-select.min.js"></script>
<!-- magnify popup js -->
<script src="<?php echo base_url()?>assets/website/vendors/magnify_popup/jquery.magnific-popup.js"></script>
<!-- custom js -->
<script src="<?php echo base_url()?>assets/website/js/custom.js"></script>
<script>
$(document).ready(function() {
    // Gets the video src from the data-src on each button
    var $videoSrc;
    $(".video-btn").click(function() {
        $videoSrc = $(this).attr("data-src");
        console.log("button clicked" + $videoSrc);
    });
    // when the modal is opened autoplay it
    $("#myModal").on("shown.bs.modal", function(e) {
        console.log("modal opened" + $videoSrc);
        $("#video").attr("src",$videoSrc + "?autoplay=1&showinfo=0&modestbranding=1&rel=0&mute=1");
    });
    // stop playing the youtube video when I close the modal
    $("#myModal").on("hide.bs.modal", function(e) {
        // a poor man's stop video
        $("#video").attr("src", $videoSrc);
    });
});
$(".field-wrapper .field-placeholder").on("click",function(){$(this).closest(".field-wrapper").find("input").focus()}),
$(".field-wrapper input").on("keyup",function(){$.trim($(this).val())?$(this).closest(".field-wrapper").addClass("hasValue"):$(this).closest(".field-wrapper").removeClass("hasValue")}),
$(".field-wrapper .field-placeholder1").on("click",function(){$(this).closest(".field-wrapper").find("input").focus()}),
$(".field-wrapper input").on("keyup",function(){$.trim($(this).val())?$(this).closest(".field-wrapper").addClass("hasValue"):$(this).closest(".field-wrapper").removeClass("hasValue")}),
$(".owl-carousel").owlCarousel({loop:!0,margin:20,nav:!1,autoplay:!0,autoplayTimeout:5e3,items:2,responsive:{0:{items:1,nav:!1},600:{items:1,nav:!1},1000:{items:2,nav:!1}}}),window.onscroll=function()
{myFunction()};var header=document.getElementById("myHeader"),sticky=header.offsetTop;function myFunction(){window.pageYOffset>sticky?header.classList.add("sticky"):header.classList.remove("sticky")}
function book_demo(){$("html, body").animate({scrollTop:$("#demo_section").offset().top},1500)}function off50_fees(){$("html, body").animate({scrollTop:$("#50off_fees_section").offset().top-120},1500)}
function off50_fees_mobile(){$("html, body").animate({scrollTop:$("#50off_fees_section").offset().top-120},1500)}$("#admissionsD").on("click",function()
{if(""!=$("#studentName").val()&&""!=$("#studentEmail").val()&&""!=$("#studentMobile").val()&&""!=$("#selectClassD option:selected").val())
{var e=$("#selectClassD option:selected").text();""!=e&&fbq("track","Lead",{content_name:e})}}),$("#admissionsM").on("click",function()
{if(""!=$("#studentNameMobile").val()&&""!=$("#studentEmailMobile").val()&&""!=$("#studentMobileMobile").val()&&""!=$("#selectClassM option:selected").val())
{var e=$("#selectClassM option:selected").text();""!=e&&fbq("track","Lead",{content_name:e})}});
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
 if(isset($errorsweet)){ ?>
  <script type="text/javascript">
    swal("<?php if(isset($errorsweet)){ echo $errorsweet['error']; } ?>");
    setTimeout(function() {
        window.location.href = '<?php echo base_url('register')?>';
    }, 5000);
  </script>

<?php } ?>
<script>
// !function(){
//     let e=new Date("Oct 02, 2021 00:00:00").getTime();
//     setInterval(function(){
//         let t=(new Date).getTime(),
//         n=e-t;
//         if(document.getElementById("days").innerText=Math.floor(n/864e5),
//         document.getElementById("hours").innerText=Math.floor(n%864e5/36e5),
//         document.getElementById("minutes").innerText=Math.floor(n%36e5/6e4),
//         document.getElementById("seconds").innerText=Math.floor(n%6e4/1e3),n<0){
//             document.getElementById("headline");
//             let e=document.getElementById("countdown"),
//             t=document.getElementById("content");
//             e.style.display="none",
//             t.style.display="block",
//             clearInterval(x);
//         }
//     },0)
// }();
</script>
<script type="text/javascript">
$(document).ready(function(){$.ajax({type:"POST",url:"<?php echo base_url('website/countupdate');?>",success:function(o){1==o?console.log(".."):console.log("...")},error:function(o){console.log(o)}})});
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6109468ed6e7610a49ae5ea8/1fc63n7v4';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->