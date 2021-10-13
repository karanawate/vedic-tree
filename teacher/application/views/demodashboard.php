<?php


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
    <style type="text/css">
    .sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

    </style>
</head>

<body>

  

    <!-- Preloader  -->
    <div class='preloder'>
        <div class='loader'>
            <div class='loader--dot'></div>
            <div class='loader--dot'></div>
            <div class='loader--dot'></div>
            <div class='loader--dot'></div>
            <div class='loader--dot'></div>
            <div class='loader--dot'></div>
            <div class='loader--text'></div>
        </div>
    </div>
    <!-- End Preloader  -->

    <?php $this->load->view('web_header'); ?>

    <section class="">
        <div id="wrapper">        
           
            <?php
            $usersession = $this->session->userdata('usersession');

            ?>
            <!-- Page Content -->
            <section class="contact_page section_padding">
              <div id="page-content-wrapper">
                <div class="container">
                    <div class="row">
                            <?php
                            if($get_day_sessions){
                              foreach ($get_day_sessions as $key => $value) {
                                $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
                               $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

                              if (preg_match($longUrlRegex, $value['youtubelink'], $matches)) {
                                  $youtube_id = $matches[count($matches) - 1];
                              }

                              if (preg_match($shortUrlRegex, $value['youtubelink'], $matches)) {
                                  $youtube_id = $matches[count($matches) - 1];
                              }
                              $youtubelink = 'https://www.youtube.com/embed/' . $youtube_id ;

                            ?>
                            <div class="col-lg-4" >
                              <h6 style="width:250px;padding: 6px;font-size: large;border-radius: 40px;"><?php echo $value['sessionName'];?></h6>
                              <iframe width="300" height="300" src="<?php echo $youtubelink;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <?php } }else{
                              echo "No Data Uploaded";
                            } ?>
                    </div>
                </div>
            </div>
            </section>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
    </section>

    


    <!-- footer part here -->
     <footer class="footer_section home_two_footer">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-3 col-sm-6 wow fadeInDown" data-wow-delay=".3s">
                    <div class="single_footer_widget">
                        <a href="index-2.html" class="footer_logo"><img src="<?php echo base_url()?>assets/website/img/logo.png" alt="#"></a>
                        <p>Lorem ipsum dolor sit consectetur sicing elit, sed do eitempor idunt ut labor omagn aliqua
                            sed do.
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 wow fadeInDown" data-wow-delay=".5s">
                    <div class="single_footer_widget footer_nav">
                        <h4>Class</h4>
                        <ul>
                            <li><a href="#">Master Mind</a></li>
                            <li><a href="#">Junior Lambs</a></li>
                            <li><a href="#">Happy Kiddo</a></li>
                            <li><a href="#">Master Mind</a></li>
                            <li><a href="#">Junior Lambs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 wow fadeInDown" data-wow-delay=".5s">
                    <div class="single_footer_widget footer_nav">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="index-2.html">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Our Classes</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInDown" data-wow-delay=".9s">
                    <div class="single_footer_widget instagram_feed">
                        <h4>Newsletter</h4>
                        <p>Lorem ipsum dolor sit consectetur sicing elit, sed do eitempor idunt ut labor elit, sed do
                            omagn aliqua</p>
                        <form action="#">
                            <div class="input-group">
                                <input type="Email" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <span class="input-group-text"> <i class="ti-arrow-right"></i> </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bg">
            <img src="<?php echo base_url()?>assets/website/img/footer_bg.png" alt="#" class="img-fluid">
        </div>
        <div class="footer_animation_3">
            <div data-parallax='{"x": 30, "y": 70, "rotateZ":0}'><img src="<?php echo base_url()?>assets/website/img/footer_img.png" alt="#"></div>
        </div>
    </footer>

    <!-- jquery slim -->
    <script src="<?php echo base_url()?>assets/website/js/jquery-3.5.1.min.js"></script>
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


<script type="text/javascript">
        type = ['','info','success','warning','danger'];
</script>


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


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

</script>


</body>

</html>