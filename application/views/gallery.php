<!DOCTYPE html>
<html lang="zxx">
<!-- Web Header starts -->
<?php $this->load->view('web_header'); ?>
<!-- Web Header starts -->
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T3FX7LW"
        height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- out gallery part here -->
    <section class="our_gallery gallery_style_2 section_bg section_padding mb-5">
        <div class="parallax">
            <div class="row justify-content-center pt-4">
                <div class="col-lg-8">
                    <div class="section_tittle_style_02">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s"> <div class="title_overlay_effect">Our Gallery</div></h1>
                        <p class="description3 wow fadeInDown" data-wow-delay=".3s"><?php echo ucwords("Vedic Tree little stars are enjoying online education at home. Parents and loved one's are experiencing excellent development of child day by day.");?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row wow fadeInDown" data-wow-delay=".5s">
                <div class="col-lg-12 p-0">
                    <div class="gallery_popup_img">
                        <?php if($update_gallery_list){ 
                            foreach($update_gallery_list as $value){
                        ?>
                        <div class="single-view">
                            <a href="<?php echo base_url('uploads/galleryImage/'.$value['galleryImage']); ?>">
                                <img src="<?php echo base_url('uploads/galleryImage/'.$value['galleryImage']); ?>" class="grid-image">
                            </a>
                        </div>
                        <?php }}  ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- out gallery part end -->
    <!-- testimonial part here -->
    <section class="testimonial_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section_tittle_style_02">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s"> <span class="title_overlay_effect">Parent's Review</span></h1>
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
                            <div class="client_speech"><span style="float:right"><?php echo date("Y-m-d", strtotime($value['createreviewDT']));?></span>
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
   <!-- footer part here -->
   <?php $this->load->view('web_footer'); ?>
   
</body>


</html>