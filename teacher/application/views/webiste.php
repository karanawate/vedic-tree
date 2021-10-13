<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <title>Vedic Tree</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="<?php echo base_url()?>assets/website/img/favicon.png">
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
    <?php $this->load->view('web_header'); ?>

    <!-- banner part here -->
    <section class="banner_part banner_style_3" id="demo_section">
        <div class="single_banner_part">
            <div class="container custom_container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6">
                        <h1 class="headline-tag1">"Naye Zamane Ki Nayi School"</h1>
                    </div>
                </div>
                <div class="block-view">
                    <div class="register-block">
                        <div class="register-box">
                            <div class="form-wrapper-outer">
                                <div class="form-logo">
                                    <img src="<?php echo base_url()?>assets/website/img/register_logo.png" alt="logo">
                                </div>
                                <h2 class="register-text-demo">Register for Free Demo Class</h2>
                                <form id="log" method="POST" action="<?php echo base_url('website/temp_enquiry')?>">
                                    <div class="field-wrapper">
                                        <input type="text" name="studentName" id="" required="">
                                        <div class="field-placeholder"><span>Enter Name of your Child</span></div>
                                        <span style="color:red"><?php echo form_error('studentName'); ?></span>
                                    </div>
                                    <div class="field-wrapper">
                                        <input type="email" name="studentEmail" id="">
                                        <div class="field-placeholder" required="" ><span>Enter your Email</span></div>
                                        <span style="color:red"><?php echo form_error('studentEmail'); ?></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="field-wrapper">
                                                <input type="text" maxlength="10" name="studentMobile" required="">
                                                <div class="field-placeholder1"><span>Enter your Mobile Number</span></div>
                                                <span style="color:red"><?php echo form_error('studentMobile'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-4 pl-0">
                                            <div class="floating-label">  
                                                <select class="floating-select" name="studentClass" onclick="this.setAttribute('value', this.value);" value="">
                                                    <option value="" selected></option>
                                                    <option value="1" <?php echo set_select('studentClass', '1'); ?>>Nursery</option>
                                                    <option value="2" <?php echo set_select('studentClass', '2'); ?>>Jr. KG</option>
                                                    <option value="3"<?php echo set_select('studentClass', '3'); ?>>Sr. KG</option>
                                                </select>
                                                <span class="highlight"></span>
                                                <span style="color:red"><?php echo form_error('studentClass'); ?></span>
                                                <label class="select-label">Select</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-button d-flex justify-content-center">
                                        <button type="submit" name="submit" value="submit" class="register-now">Register Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <h1 class="headline-tag">
                            <span>"Naye Zamane Ki Nayi School"</span>
                        </h1>
                    </div>
                    <div class="empty-block"></div>
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
    <!-- banner part end -->
    <div class="register-box1 p-3">
        <div class="form-wrapper-outer">
            <div class="form-logo">
                <img src="<?php echo base_url()?>assets/website/img/logo.png" alt="logo">
            </div>
            <h2 style="font-size: 20px;text-align:center;">Register for Free Demo Class</h2>
            <form id="log" method="POST" action="<?php echo base_url('website/contact')?>">
                <div class="field-wrapper">
                    <input type="text" name="name" id="" required>
                    <div class="field-placeholder"><span>Enter Name of your Child</span></div>
                </div>
                <div class="field-wrapper">
                    <input type="email" name="email" id="" required>
                    <div class="field-placeholder"><span>Enter your Email</span></div>
                </div>
                <div class="row">
                    <div class="col-7">
                        <div class="field-wrapper">
                            <input type="number" name="number" id="" required>
                            <div class="field-placeholder1"><span>Enter your Mobile Number</span></div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="floating-label">  
                            <select class="floating-select" onclick="this.setAttribute('value', this.value);" value="">
                                <option value="" selected></option>
                                <option value="1">Nursery</option>
                                <option value="2">Jr. KG</option>
                                <option value="3">Sr. KG</option>
                            </select>
                            <span class="highlight"></span>
                            <label class="select-label">Select</label>
                        </div>
                    </div>
                </div>
                <div class="form-button d-flex justify-content-center">
                    <button type="submit" name="submit" value="submit" class="register-now">Register Now</button>
                </div>
            </form>
        </div>
    </div>

   <!-- event section part here -->
    <section class="event_section section_padding">
        <div class="container custom_container">
            <div class="row justify-content-between">
                <div class="col-lg-6">    
                    <div class="img_section">
                        <iframe class="responsive-iframe" src="https://www.youtube.com/embed/aIpA-V89SX4?autoplay=1&mute=0&enablejsapi=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-lg-6 pl-md-0">
                    <div class="event_section_content">
                        <h2 class="wow fadeInRight kid_title" style="font-size:42px;" data-wow-delay=".4s"> <span class="title_overlay_effect">Why Choose Vedic Tree ?</span></h2>
                        <?php 
                            $Topics  = array(
                                '1' =>'Interactive Topics',
                                '2' =>'Live and Animated Videos',
                                '3' =>'Conducive Online Learnings',
                                '4' =>'Balanced Curriculum for Overall Development',
                                '5' =>'Value Based Education',
                                '6' =>'Innovative Teachings Methods',
                                '7' =>'Extra-Curricular Activities Included',
                             );
    
                                ?>
                        <ul style="font-size:26px;font-weight: 700;">
                            <?php if($Topics) {
                                foreach ($Topics as $key => $value) {       
                                $color = '#013983';
                             ?>
                            <li style="color:<?php echo $color;?>"><?php echo $value;?></li>
                            <?php }} ?>
                            
                        </ul>
                        <div class="pc-button elementor-button button-link cu_btn button-content-wrapper" onclick="book_demo()">
                            <span class="elementor-button-text">Register Now</span>
                            <svg class="pc-dashes inner-dashed-border animated-dashes">
                                <rect x="5px" y="5px" rx="22px" ry="22px" width="0" height="0"></rect>
                            </svg>
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

    <!-- Packages part here -->
    <section class="fetures_part padding_bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle_style_02">
                        <h2 class="title wow fadeInDown" data-wow-delay=".3s"> <span class="title_overlay_effect"> Enroll in Vedic Tree Pre School Learning App</span></h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="single_fetures_part lightviolet_bg">
                        <div class="single_fetures_icon">
                            <img src="<?php echo base_url()?>assets/website/img/main_package/nursery.png" alt="#" class="img-fluid">
                        </div>
                        <h4> <a href="<?php echo base_url('course-one');?>"> Nursery</a></h4>
                        <h4> <a href="<?php echo base_url('course-one');?>"> Starting From</a></h4>
                        <h4> <a href="<?php echo base_url('course-one');?>"><strike>&#8377 9999/-</strike> &#8377 7999/-</a></h4>
                        <div class="enroll-now">
                            <a href="<?php echo base_url('course-one');?>" class="enroll-button">Enroll Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="single_fetures_part pink_bg">
                        <div class="single_fetures_icon">
                            <img src="<?php echo base_url()?>assets/website/img/main_package/jrkg.png" alt="#" class="img-fluid">
                        </div>
                        <h4> <a href="<?php echo base_url('course-two');?>"> Junior KG</a></h4>
                        <h4> <a href="<?php echo base_url('course-two');?>"> Starting From</a></h4>
                        <h4> <a href="<?php echo base_url('course-two');?>"><strike>&#8377 10499/-</strike> &#8377 8499/-</a></h4>
                        <div class="enroll-now">
                            <a href="<?php echo base_url('course-two');?>" class="enroll-button">Enroll Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay=".8s">
                    <div class="single_fetures_part">
                        <div class="single_fetures_icon">
                            <img src="<?php echo base_url()?>assets/website/img/main_package/srkg.png" alt="#" class="img-fluid">
                        </div>
                        <h4> <a href="<?php echo base_url('course-three');?>"> Senior KG</a> </h4>
                        <h4> <a href="<?php echo base_url('course-three');?>"> Starting From</a></h4>
                        <h4> <a href="<?php echo base_url('course-three');?>"> <strike>&#8377 10999/-</strike> &#8377 8999/-</a></h4>
                        <div class="enroll-now">
                            <a href="<?php echo base_url('course-three');?>" class="enroll-button">Enroll Now</a>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="d-flex justify-content-center mt-3" style="text-align: center;"><p style="font-size: 18px;color:#0748ef;font-weight:600">The above charges are all inclusive (Fees, Kit Charges & GST)</p></div>
            <div class="d-flex justify-content-center" style="text-align: center;"><p style="font-size: 18px;color:#0748ef;font-weight:600">EMI Options Available</p></div>
            </div>
        </div>
        <div class="feature_animation_1">
            <div data-parallax='{"x": 2, "y": 120, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/animation_shape/program_list_shape_01.png" alt="#"></div>
        </div>
        <div class="feature_animation_2">
            <div data-parallax='{"x": 10, "y": 100, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/animation_shape/program_list_shape_02.png" alt="#"></div>
        </div>
        <div class="feature_animation_3">
            <div data-parallax='{"x": 30, "y": 110, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/animation_shape/program_list_shape_03.png" alt="#"></div>
        </div>
        <div class="feature_animation_4">
            <div data-parallax='{"x": 5, "y": 105, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/animation_shape/program_list_shape_04.png" alt="#"></div>
        </div>
    </section>
    <!-- Packages part end -->

    <!-- Features part here -->
    <section class="testimonial_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section_tittle_style_02">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s"> <span class="title_overlay_effect">Features</span></h1>
                        <!-- <p class="description wow fadeInDown" data-wow-delay=".3s">Review From Happy Parents</p> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="our-features-section">
                        <div class="our-features-details border-orange"><img src="<?php echo base_url()?>assets/website/img/features/High-Quality-Emmersive-Sessions.jpg"><p class="yellow-color">HIGH QUALITY IMMERSIVE LIVE SESSIONS</p></div>
                        <div class="our-features-details border-yellow"><img src="<?php echo base_url()?>assets/website/img/features/Value-Based-Education.jpg"><p class="orange-color">VALUE BASED EDUCATION</p></div>
                        <div class="our-features-details border-blue"><img src="<?php echo base_url()?>assets/website/img/features/Blending-Curriculum.jpg "><p class="lightblue-color">BLENDED CURRICULUM</p></div>
                    </div>
                    <div class="our-feature-wrp">
                        <div class="our-features-details border-green"><img class="responsive" src="<?php echo base_url()?>assets/website/img/features/HD-Animated-Videos.jpg" alt="#"><p class="greenlight">HD ANIMATED VIDEOS</p></div>
                        <div class="our-features-details border-darkgreen"><img src="<?php echo base_url()?>assets/website/img/features/Life-Skill-Activities.jpg"><p class="green-color">LIFE SKILLS ACTIVITIES</p></div>
                    </div>
                </div>
            </div>
            <div class="book-now">
                <div onclick="book_demo()" class="book-button">Book Your Demo Session</div>
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
    <!-- Features part end -->
    
    <!-- cta part here -->
    <section class="cta_part section_padding">
        <div class="container">
            <div class="row align-items-center justify-content-start">
                <div class="col-lg-12">
                    <div class="cta_part_iner">
                        <p>Providing the Best Quality Education at the Most Affordable Fees.</p>
                        <h2 style="font-size: 50px;font-weight: 900;">Vedic Tree Stars</h2>
                        <h3>Enrollment Is Going On</h3>
                        <div onclick="book_demo()" class="cu_btn white_bg font-weight-bold book-button">Book Now</div>
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
            <div data-parallax='{"x": 40, "y": -30}'>
                <img src="<?php echo base_url()?>assets/website/img/cta_img_2.png" alt="#">
            </div>
        </div>
    </section>
    <!-- cta part end -->

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
                        <div class="single_testimonial_slider">
                            <div class="client_speech bg_1">
                                <img src="<?php echo base_url()?>assets/website/img/quote.png" alt="#">
                                <p>Dear Team, The learning sessions created with fantastic videos are imparting so much interest in mind of our child Veeha. 
                                She is picking up the content quickly and enjoying learning online. As we have got books for Jr. Kg. the learning process 
                                has become better with videos for same topics as given in books. Amazing performance by Vedic Tree ... Kudos. 
                                Thanking you, Swati and Bipin Shinde</p>
                                <img src="<?php echo base_url()?>assets/website/img/shape_1.png" alt="#" class="client_speech_shape">
                            </div>
                            <div class="client_info">
                                <img src="<?php echo base_url()?>assets/website/img/reviews/Veeha Shinde.png" alt="#">
                                <h4>Veeha Shinde <span class="color_1">Jr.kg</span></h4>
                            </div>
                        </div>
                        <div class="single_testimonial_slider">
                            <div class="client_speech bg_2">
                                <img src="<?php echo base_url()?>assets/website/img/quote.png" alt="#">
                                <p>Would Like to appreciate complete Vedic Tree Family for all the good efforts you are taking, my child Prachi is enjoying all
                                educational videos very much. The idea of uploading videos on Vedic Tree Mobile App & Website is highly appreciated so we may play the 
                                videos whenever our child is interested. During this Covid-19 situation you have come ahead with reduction in your fees which big-big 
                                Universities are failed to do it. Kudos to your whole team</p>
                                <img src="<?php echo base_url()?>assets/website/img/shape_2.png" alt="#" class="client_speech_shape">
                            </div>
                            <div class="client_info">
                                <img src="<?php echo base_url()?>assets/website/img/reviews/Prachi Chaudhary.png" alt="#">
                                <h4>Prachi Choudhary <span class="color_2">Sr.kg</span></h4>
                            </div>
                        </div>
                        <div class="single_testimonial_slider">
                            <div class="client_speech bg_1">
                                <img src="<?php echo base_url()?>assets/website/img/quote.png" alt="#">
                                <p>It takes immense pleasure to say that I am very happy about entire Vedic Tree Teachers & Team. Have seen very good improvement 
                                in Shreyansh overall well being. Teachers are very good, they handle kids very nicely and affectionately. My Child is enjoying alot 
                                in Rhymes, Stories, Dance, Yoga and Physical Educational Sessions on Vedic Tree
                                Learning App.</p>
                                <img src="<?php echo base_url()?>assets/website/img/shape_1.png" alt="#" class="client_speech_shape">
                            </div>
                            <div class="client_info">
                                <img src="<?php echo base_url()?>assets/website/img/reviews/Shreyans Awasare.jpg" alt="#">
                                <h4>Shreyansh Awasare <span class="color_1">Jr.kg</span></h4>
                            </div>
                        </div>
                        <div class="single_testimonial_slider">
                            <div class="client_speech bg_2">
                                <img src="<?php echo base_url()?>assets/website/img/quote.png" alt="#">
                                <p>Vedic Tree kids learning app is virtually a second home for our daughter. Everyday she is waiting to start her session which starts 
                                from mourning routine to the last topic. We found many positive changes in her. There is lot of work being done to help kids conceptually 
                                understand various things. She loves all animated sessions. Doing all the activities & enjoys learning. Thank you for providing quality 
                                education.</p>
                                <img src="<?php echo base_url()?>assets/website/img/shape_2.png" alt="#" class="client_speech_shape">
                            </div>
                            <div class="client_info">
                                <img src="<?php echo base_url()?>assets/website/img/reviews/Akshara Kashyap.jpg" alt="#">
                                <h4>Akshara Kashyap <span class="color_2">Jr.kg</span></h4>
                            </div>
                        </div>
                        <div class="single_testimonial_slider">
                            <div class="client_speech bg_1">
                                <img src="<?php echo base_url()?>assets/website/img/quote.png" alt="#">
                                <p>Heartfelt thanks for all the efforts and energy that you guys put in for the grooming of kids. It’s nice to see that Hriday takes keen 
                                interest in studies and also learned so many good manners through the Value Based Educational Stories and I can see the overall development 
                                in his understanding and cognitive capabilities. I have also seen the transformation in Hriday after joining Vedic Tree 
                                Kids Learning App.</p>
                                <img src="<?php echo base_url()?>assets/website/img/shape_1.png" alt="#" class="client_speech_shape">
                            </div>
                            <div class="client_info">
                                <img src="<?php echo base_url()?>assets/website/img/reviews/Hriday Thakkar.png" alt="#">
                                <h4>Hriday Thakkar <span class="color_1">Jr.kg</span></h4>
                            </div>
                        </div>
                        <div class="single_testimonial_slider">
                            <div class="client_speech bg_2">
                                <img src="<?php echo base_url()?>assets/website/img/quote.png" alt="#">
                                <p>We have been using Vedic tree online learning app and it has been a great tool for my four years old child. I have loved that I can keep 
                                track of how well he is doing. My child has learned with fun in this pandemic situation, we are very thankful for creating self discipline 
                                with morning routine like yoga, physical exercise and dance activities. Animated Academics Sessions, Art and Craft Activities are wonderful. 
                                I plan to continue for next academic year too!</p>
                                <img src="<?php echo base_url()?>assets/website/img/shape_2.png" alt="#" class="client_speech_shape">
                            </div>
                            <div class="client_info">
                                <img src="<?php echo base_url()?>assets/website/img/reviews/Ved Bagwe.jpg" alt="#">
                                <h4>Ved Bagwe <span class="color_2">Nursery</span></h4>
                            </div>
                        </div>
                        <div class="single_testimonial_slider">
                            <div class="client_speech bg_1">
                                <img src="<?php echo base_url()?>assets/website/img/quote.png" alt="#">
                                <p>First of all I would like to appreciate all the teaching staff for their sincere and excellent efforts for taking care of our kids in a 
                                beautiful manner and being so friendly with the children and treating them like their own kids. Teaching methodologies are excellent and 
                                I feel every kid of the school enjoys while learning. All the Academics Sessions are awesome, it helps the child to create more
                                interest in studies. Thank you so much Vedic Tree to be with Us at home.</p>
                                <img src="<?php echo base_url()?>assets/website/img/shape_1.png" alt="#" class="client_speech_shape">
                            </div>
                            <div class="client_info">
                                <img src="<?php echo base_url()?>assets/website/img/reviews/Navita Patil.jpg" alt="#">
                                <h4>Navita Patil <span class="color_1">Nursery</span></h4>
                            </div>
                        </div>
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

    <!-- out gallery part here -->
    <section class="our_gallery gallery_style_2 section_bg section_padding mb-5">
        <div class="container-fluid no-gutters">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle_style_02">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s"> <div class="title_overlay_effect">Our Gallery</div></h1>
                        <p class="description2 wow fadeInDown" data-wow-delay=".3s"><?php echo ucwords("Vedic Tree little stars  are enjoying online education at home. Parents and loved once are experiencing excellent development of child day by day.");?></p>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInDown" data-wow-delay=".5s">
                <div class="col-lg-12 p-0">
                    <div class="gallery_slider owl-carousel gallery_popup_img">
                        <a href="<?php echo base_url()?>assets/website/img/gallery/photo_1.png" class="grid-item bg_1">
                            <div class="grid_item_content">
                                <h3>Blended Curriculum</h3>
                                <p>Kids, Daycare, Kindergarten</p>
                            </div>
                        </a>
                        <a href="<?php echo base_url()?>assets/website/img/gallery/photo_2.png" class="grid-item bg_2">
                            <div class="grid_item_content">
                                <h3>Holistic Development</h3>
                                <p>Kids, Daycare, Kindergarten</p>
                            </div>
                        </a>
                        <a href="<?php echo base_url()?>assets/website/img/gallery/photo_3.png" class="grid-item bg_3">
                            <div class="grid_item_content">
                                <h3>Value Based Education</h3>
                                <p>Kids, Daycare, Kindergarten</p>
                            </div>
                        </a>    
                        <a href="<?php echo base_url()?>assets/website/img/gallery/photo_4.png" class="grid-item bg_4">
                            <div class="grid_item_content">
                                <h3>Animated Sessions</h3>
                                <p>Kids, Daycare, Kindergarten</p>
                            </div>
                        </a>
                        <a href="<?php echo base_url()?>assets/website/img/gallery/photo_5.png" class="grid-item bg_5">
                            <div class="grid_item_content">
                                <h3>Interative Sessions</h3>
                                <p>Kids, Daycare, Kindergarten</p>
                            </div>
                        </a>
                        <a href="<?php echo base_url()?>assets/website/img/gallery/photo_6.png" class="grid-item bg_6">
                            <div class="grid_item_content">
                                <h3>Flexible Learning Hours</h3>
                                <p>Kids, Daycare, Kindergarten</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="gallery_animation_1">-->
        <!--    <div data-parallax='{"x": 2, "y": 20, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/banner_two_1.png" alt="#"></div>-->
        <!--</div>-->
        <!--<div class="gallery_animation_2">-->
        <!--    <div data-parallax='{"x": 10, "y": 50, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/event_1.png" alt="#"></div>-->
        <!--</div>-->
    </section>
    <!-- out gallery part end -->

    <!-- team part here -->
    <section class="team_section section_padding">
        <div class="container custom_container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle_style_02">
                        <h2 class="title wow fadeInDown" data-wow-delay=".3s"> <span class="title_overlay_effect">Our Team of Professionals</span></h2>
                        <p class="description2 wow fadeInDown" data-wow-delay=".3s">Vedic Tree's mission is to provide High-quality, Affordable 
                        education for every child to ensure that the foundation remains Strong and Powerful which will help in creating a better tomorrow.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="single_team_section">
                        <div class="d-block teacher_profile_img">
                            <img src="<?php echo base_url()?>assets/website/img/teacher/Kajal Thakkar.png" alt="#" class="img-fluid">
                        </div>
                        <h4>Kajal Thakkar</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="single_team_section">
                        <div class="d-block teacher_profile_img">
                            <img src="<?php echo base_url()?>assets/website/img/teacher/Raina Thakkar.png" alt="#" class="img-fluid">
                        </div>
                        <h4>Raina Thakkar</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="single_team_section">
                        <div class="d-block teacher_profile_img">
                            <img src="<?php echo base_url()?>assets/website/img/teacher/Anna Miranda.png" alt="#" class="img-fluid">
                        </div>
                        <h4>Anna Miranda</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="team_animation_1">
            <div data-parallax='{"x": 2, "y": 120, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/story_animation_1.png" alt="#"></div>
        </div>
        <div class="team_animation_2">
            <div data-parallax='{"x": 10, "y": 100, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/story_animation_2.png" alt="#">
            </div>
        </div>
        <div class="team_animation_3">
            <div data-parallax='{"x": 30, "y": 110, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/story_animation_3.png" alt="#">
            </div>
        </div>
        <div class="team_animation_4">
            <div data-parallax='{"x": 5, "y": 105, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/team_animation.png" alt="#"></div>
        </div>
        <div class="team_animation_5">
            <div data-parallax='{"x": 8, "y": 110, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/story_animation_5.png" alt="#"></div>
        </div>
    </section>
    <!-- team part end -->
    
    <!-- blog part start -->
    <section class="event_list section_padding section_bg_1">
        <div class="container custom_container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                <div class="section_tittle_style_02">
                    <h1 class="title wow fadeInDown" data-wow-delay=".5s">Our Blogs</h1>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6 wow fadeInDown" data-wow-delay=".3s">
                    <div class="page_blog_section_wrapper">
                        <a href="#" class="blog_thumbnail">
                            <img src="<?php echo base_url()?>assets/website/img/blog/blog_3.png" alt="" class="img-fluid">
                        </a>
                        <div class="blog_meta_list">
                            <a class="blog_data">21 Aug, 2020</a>
                        </div>
                        <h4> <a>How Technology is effecting Education</a></h4>
                        <a href="<?php echo base_url('blog-one');?>" class="read_more_btn">Read More <img src="<?php echo base_url()?>assets/website/img/icon/arrow_left.svg" alt="#"> </a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 wow fadeInDown" data-wow-delay=".5s">
                    <div class="page_blog_section_wrapper">
                        <a href="" class="blog_thumbnail">
                            <img src="<?php echo base_url()?>assets/website/img/blog/blog_1.png" alt="#" class="img-fluid">
                        </a>
                        <div class="blog_meta_list">
                            <a class="blog_data">21 Aug, 2020</a>
                        </div>
                        <h4> <a>Why preschool is important for 2021</a></h4>
                        <a href="<?php echo base_url('blog-three');?>" class="read_more_btn">Read More <img src="<?php echo base_url()?>assets/website/img/icon/arrow_left.svg" alt="#"> </a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 wow fadeInDown" data-wow-delay=".7s">
                    <div class="page_blog_section_wrapper">
                        <a class="blog_thumbnail">
                            <img src="<?php echo base_url()?>assets/website/img/blog/blog_4.png" alt="#" class="img-fluid">
                        </a>
                        <div class="blog_meta_list">
                            <a class="blog_data">21 Aug, 2020</a>
                        </div>
                        <h4> <a>Top 5 healthy fruits for your child-Vedictreeschool.com</a></h4>
                        <a href="<?php echo base_url('blog-two');?>" class="read_more_btn">Read More <img src="<?php echo base_url()?>assets/website/img/icon/arrow_left.svg" alt="#"> </a>
                    </div>
                </div>
            </div>
            <div class="book-now">
                <div onclick="book_demo()" class="book-button">Book Your Demo Session</div>
            </div>
        </div>
        <div class="event_list_animation_1">
            <div data-parallax='{"x": 2, "y": 70, "rotateZ":0}'>
                <img width="68" height="48" src="https://preview.droitthemes.com/wp/kidzo/wp-content/uploads/2020/10/event_5.png" class="attachment-full size-full" alt="" loading="lazy" /> 
            </div>
        </div>
        <div class="event_list_animation_3">
            <div data-parallax='{"x": 30, "y": 60, "rotateZ":0}'>
                <img width="58" height="62" src="https://preview.droitthemes.com/wp/kidzo/wp-content/uploads/2020/10/event_6.png" class="attachment-full size-full" alt="" loading="lazy" />
            </div>
        </div>
        <div class="event_list_animation_4">
            <div data-parallax='{"x": 30, "y": -50, "rotateZ":0}'>
             <img width="57" height="56" src="https://preview.droitthemes.com/wp/kidzo/wp-content/uploads/2020/10/event_7.png" class="attachment-full size-full" alt="" loading="lazy" /> 
           </div>
        </div>
    </section>
    <!-- blog part end -->
    
    

    <!-- footer part here -->
    <?php $this->load->view('web_footer'); ?>
    
</body>
</html>

<script>
    $(".field-wrapper .field-placeholder").on("click", function () {
            $(this).closest(".field-wrapper").find("input").focus();
        });
        $(".field-wrapper input").on("keyup", function () {
            var value = $.trim($(this).val());
            if (value) {
                $(this).closest(".field-wrapper").addClass("hasValue");
            } else {
                $(this).closest(".field-wrapper").removeClass("hasValue");
            }
        });
        $(".field-wrapper .field-placeholder1").on("click", function () {
            $(this).closest(".field-wrapper").find("input").focus();
        });
        $(".field-wrapper input").on("keyup", function () {
            var value = $.trim($(this).val());
            if (value) {
                $(this).closest(".field-wrapper").addClass("hasValue");
            } else {
                $(this).closest(".field-wrapper").removeClass("hasValue");
            }
        });
        function book_demo() {
            $('html, body').animate({
                scrollTop: $("#demo_section").offset().top
            }, 1500);
        }
</script>

<script type="text/javascript">
        type = ['','info','success','warning','danger'];
</script>

<?php
 if(isset($error)){ ?>
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
<script src="https://player.vimeo.com/api/player.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
 if(isset($errorsweet)){ ?>
  <script type="text/javascript">
    swal("<?php if(isset($errorsweet)){ echo $errorsweet['error']; } ?>");
  </script>

<?php } ?>

