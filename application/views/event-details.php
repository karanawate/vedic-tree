<html lang="zxx">
<!-- Web Header starts -->
<?php $this->load->view('web_header'); ?>
<!-- Web Header starts -->
<body>
    <!-- event section part here -->
    <section class="event_section section_padding event_details">
        <div class="container custom_container">
            <div class="row justify-content-between align-items-center">
                <div class="col-sm-12">
                    <div class="event_details_wrapper">
                        <div class="event_details_thumb" style="border-radius: 10px;">
                            <!--<img src="img/event/event_details_02.jpg" alt="#" class="img-fluid">-->
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="<?php echo $events_info[0]['youtube_input_link']; ?>?autoplay=1&mute=0&enablejsapi=1"></iframe>
                            </div>
                        </div>
                        <?php echo $events_info[0]['description']; ?>
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
            <div data-parallax='{"x": 30, "y": -50, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/team_animation.png" alt="#" class="img-fluid"></div>
        </div>
    </section>
    <!-- event section part end -->
    <!-- out gallery part here -->
    <section class="our_gallery gallery_style_2 section_bg section_padding mb-5">
        <div class="container-fluid no-gutters">
            <div class="row wow fadeInDown" data-wow-delay=".5s">
                <div class="col-lg-12 p-0">
                    <div class="gallery_slider owl-carousel gallery_popup_img">
                         <?php foreach($events_info as $event) { ?>
                            <a href="<?php echo base_url('uploads/event_images/'.$event['allocated_file']); ?>">
                                <img src="<?php echo  base_url('uploads/event_images/'.$event['allocated_file']); ?>" style="height:360px">
                            </a>
                        <?php } ?>    
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- out gallery part end -->
    <!-- cta part here -->
    <section class="cta_part section_padding">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8">
                    <div class="cta_part_iner">
                        <h2>Enrollment Is Going On</h2>
                        <p>Gain access to over 1000 Premium resourses</p>
                        <a href="<?php echo base_url('website')?>" class="cu_btn white_bg font-weight-bold">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb_animation_1">
            <div data-parallax='{"x": 30, "y": -20}'>
                <img src="<?php echo base_url()?>assets/website/img/cta_img_1.png" alt="#">
            </div>
        </div>
        <div class="breadcrumb_animation_2" style="bottom: -13%;">
            <div data-parallax='{"x": 20, "y": -100}'>
                <img src="<?php echo base_url()?>assets/website/img/cta_img_2.png" alt="#">
            </div>
        </div>
    </section>
    <!-- cta part end -->
    <section class="event_list section_padding section_bg_1">       
        <div class="container custom_container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section_tittle_style_02">
                        <h2 class="title wow fadeInDown" data-wow-delay=".3s"> <span class="title_overlay_effect">Related Events</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial_slider owl-carousel">
                    <?php foreach($events as $event) { ?>
                        <div class="wow fadeInUp list-item" data-wow-delay=".2s">
                            <div class="single_event_list">
                                <div class="event_list_img">
                                    <img src="<?php echo $event['image_input_link']; ?>" class="video-btn" data-src="<?php echo $event['youtube_input_link']; ?>" data-target="#myModal" data-toggle="modal" title="YouTube Video" alt="YouTube Video" />
                                </div>
                                <div class="event_list_content">
                                    <h5>
                                        <?php 
                                        $getDate =  $event['date'];
                                        $dateAsUnixTimestamp = strtotime($getDate);
                                        $month =  date('M',$dateAsUnixTimestamp);
                                        $day   = date('d',$dateAsUnixTimestamp);
                                        echo $day." ".$month; 
                                        ?>
                                    </h5>
                                    <h3><a href="<?php echo base_url('events-students');?>"><?php echo $event['title']  ?></a></h3>
                                    <p style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;"><?php echo $event['description'];  ?></p>
                                    <ul class="mt-1">
                                        <li><i class="fas fa-clock"></i>Date: <span><?php echo $event['date'];  ?></span></li>
                                        <li><i class="fas fa-map-marker-alt"></i>Location: <span>India</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div> 
        </div>
        <div class="event_list_animation_1">
            <div data-parallax='{"x": 2, "y": 70, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/icon_5.png" alt="#"></div>
        </div>
        <div class="event_list_animation_3">
            <div data-parallax='{"x": 30, "y": 60, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/icon_7.png" alt="#"></div>
        </div>
        <div class="event_list_animation_4">
            <div data-parallax='{"x": 30, "y": -50, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/icon/icon_8.png" alt="#" class="img-fluid"></div>
        </div>
    </section>
    <!-- events students end -->
    
    <!-- footer part here -->
   <?php $this->load->view('web_footer'); ?>
</body>
</html>