<footer class="footer_section">
    <div class="container">
        <div class="footer-parts">
            <div class="footer-logo">
                <div class="single_footer_widget">
                    <a href="" class="footer_logo"><img class="footer-logo-img" src="<?php echo base_url()?>assets/website/img/register_logo.png" alt="#"></a>
                   
                </div>
            </div>
            <div class="footer-useful-links">
                <div class="single_footer_widget footer_nav">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="<?php echo base_url('website');?>">Home</a></li>
                        <li><a href="<?php echo base_url('about-us');?>">About Us</a></li>
                        <li><a href="<?php echo base_url('website');?>">Our Courses</a></li>
                        <li><a href="<?php echo base_url('blog');?>">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-quick-links">
                <div class="single_footer_widget footer_nav">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="<?php echo base_url('terms-conditions');?>">Terms and Conditions</a></li>
                        <li><a href="<?php echo base_url('privacy');?>">Privacy Policy</a></li>
                        <li><a href="<?php echo base_url('frequently-asked-questions');?>">FAQ's</a></li>
                        <li><a href="<?php echo base_url('shipment');?>">Shipment Policy</a></li>
                        <li><a href="<?php echo base_url('payment-refund');?>">Payment and Refunds</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-follow-us">
                <div class="single_footer_widget footer_nav">
                    <h4>Follow Us At</h4>
                    <div class="social-buttons">
                        <!--<a href="https://www.facebook.com/vedictreekidslearningapp/" target="_blank" class="fa fa-facebook" aria-label="facebook"></a>-->
                        <a href="https://www.facebook.com/vedictreekidslearning/" target="_blank" class="fa fa-facebook" aria-label="facebook"></a>
                        <a href="https://twitter.com/Vedictreekids/" target="_blank" class="fa fa-twitter" aria-label="twitter"></a> 
                        <a href="https://www.youtube.com/c/VedicTreeKidsLearningApp-VT/featured" target="_blank" class="fa fa-pinterest-p" aria-label="youtube"></a>
                        <a href="https://www.instagram.com/vedictreekidslearningapp/" target="_blank" class="fa fa-instagram" aria-label="instagram"></a>
                        <a href="https://www.linkedin.com/company/77918646/admin/" target="_blank" class="fa fa-linkedin" aria-label="linkedin"></a>
                        <a href="https://www.youtube.com/c/VedicTreeKidsLearningApp-VT/featured" target="_blank" class="fa fa-youtube-play" aria-label="youtube"></a>
                    </div>
                    <h4 style="margin-top: 30px;">App Available at</h4>
                    <a href="https://play.google.com/store/apps/details?id=com.vedictree.preschool" target="_blank">
                        <img class="google-play-img" src="<?php echo base_url()?>assets/website/img/google-play(2).png" alt="#">
                    </a>
                </div>
            </div>
            <div class="footer-mobile">
                <div class="single_footer_widget footer_nav">
                    <div class="google-play-mobile">
                        <img class="google-play-img" src="<?php echo base_url()?>assets/website/img/mobile-logo.png" alt="#">
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
<div style="background: #000;text-align: center;color: #FFF">© 2021 Vedic Tree Educare Private Limited. All Rights Reserved.</div>

   <!-- jquery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- popper js -->
    <script src="<?php echo base_url()?>assets/website/js/popper.min.js"></script>
    <!-- bootstarp js -->
    <script src="<?php echo base_url()?>assets/website/js/bootstrap.min.js"></script>
    <!-- nice select -->
    <script src="<?php echo base_url()?>assets/website/vendors/niceselect/js/jquery.nice-select.min.js"></script>
    <!-- owl carousel js -->
    <script src="<?php echo base_url()?>assets/website/vendors/owl_carousel/js/owl.carousel.min.js"></script>
    <!-- parallax js -->
    <script src="<?php echo base_url()?>assets/website/vendors/parallax/jquery.parallax-scroll.js"></script>
    <script src="<?php echo base_url()?>assets/website/vendors/parallax/parallax.js"></script>
    <!-- wow js -->
    <script src="<?php echo base_url()?>assets/website/vendors/wow/wow.min.js"></script>
    <!-- isotop js -->
    <script src="<?php echo base_url()?>assets/website/vendors/isotop/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo base_url()?>assets/website/vendors/isotop/isotope.pkgd.js"></script>
    <!-- magnify popup js -->
    <script src="<?php echo base_url()?>assets/website/vendors/magnify_popup/jquery.magnific-popup.js"></script>
    <!-- custom js -->
    <script src="<?php echo base_url()?>assets/website/js/custom.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap-notify.js"></script>
    
   <script src="<?php echo base_url()?>assets/website/js/push.js"></script>
   <script src="<?php echo base_url()?>assets/website/js/serviceWorker.min.js"></script>
   
<script type="text/javascript">
type = ['','info','success','warning','danger'];
$(document).ready(function() {
    $("img").on("contextmenu",function(){
        return false;
    }); 
});
$("#registerStudent").on("click", function () {
    if ($('#studentName').val() != '' && $('#studentEmail').val() != '' && $('#studentMobile').val() != '' && $('#selectClass option:selected').val() != '' && $('#promoCode').val() != '' && $('#password').val() != '' && $('#passwordConfirm').val() != ''){
        var classNameRegister = $('#selectClass option:selected').text();
        if(classNameRegister!=""){
            fbq('track', 'CompleteRegistration',{
              content_name: classNameRegister,
            });
        }
    }
});
$('#contact_email').on('click',function(){
    fbq('track', 'Contact');
});
$('#contact_phone').on('click',function(){
    fbq('track', 'Contact');
});
</script>
 