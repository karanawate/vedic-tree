<?php

    $usersession    = $this->session->userdata('usersession');
    $studentName    = $usersession[0]['studentName'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp);  
    $newDateformat  = "";
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Vedic Tree</title>
    <link rel="icon" href="<?php echo base_url()?>assets/website/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/bootstrap.min.css" />
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- ////////////////////////////////////////////////////////////////////// -->


        <!-- Bootstrap Css -->
        <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

  <!-- ////////////////////////////////////////////////////////////////////// -->

    </head>

<body>
   
    <!-- Simulate a smartphone / tablet -->
    <?php $this->load->view('mobilemenus'); ?>
    <!-- End smartphone / tablet look -->
    </div>
    <div class="boxes">
      <?php $this->load->view('websitesidebar'); ?>
      <div class="box11 animated_hero" style="background: #695FFE;">
        <div class="box-inside">
          <div class="p-5">
            <!-- //top header -->
            <?php $this->load->view('topheader'); ?>
            <!-- //end top header -->
            
            <div class="video-related-learning">
              <div class="video-frame-learning">
                  <?php
                      $today_date = date('Y-m-d');
                       $newDate    = "";
                       $endDate    = "";
                        if($list_of_valuebased) {
                           foreach ($list_of_valuebased as $key => $value) {
                               
                              $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
                              $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

                              if(preg_match($longUrlRegex, $value['youtubelink'], $matches)) {
                                  $youtube_id = $matches[count($matches) - 1];
                              }
                              if(preg_match($shortUrlRegex, $value['youtubelink'], $matches)) {
                                  $youtube_id = $matches[count($matches) - 1];
                              }
                            
                              $youtubelink = 'https://www.youtube.com/embed/' . $youtube_id ;
                            
                            $youtubelink = "https://player.vimeo.com/video/".$value['vimeoId'] ;

                                    $newDate = date('Y-m-d', strtotime($value['fromDT']));
                                    $endDate = date('Y-m-d', strtotime($value['toDT']));
                                    $newDate = $newDate ;
                                }
                            }

                            if($today_date >= $newDate && $today_date <= $endDate )
                            {
                                ?>
                                <iframe class="responsive-iframe-2x" style="border:0-moz-border-radius: 20px;border-radius: 20px;"
                                src="<?php echo $youtubelink; ?>">
                            </iframe>
                            <?php }else{ ?>
                                <iframe class="responsive-iframe-2x" style="border:0-moz-border-radius: 20px;border-radius: 20px;"
                                    src="https://www.youtube.com/embed/VoI6e-iL7Rg">
                                </iframe>
                            <?php } ?>
              </div>
              
              <div class="related-video-learning">
                <h2>Related Videos</h2>
                <div class="scrollbar" id="style-2">
                  <div class="related-video">
                    <?php 

                     if($list_of_valuebased) 
                     {

                      foreach ($list_of_valuebased as $key => $value) {
                      $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
                      $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

                      if(preg_match($longUrlRegex, $value['youtubelink'], $matches)) {
                         $youtube_id = $matches[count($matches) - 1];
                      }
                      if(preg_match($shortUrlRegex, $value['youtubelink'], $matches)) {
                          $youtube_id = $matches[count($matches) - 1];
                      }
                      $youtubelink = 'https://www.youtube.com/embed/' . $youtube_id ;
                    $youtubelink = "https://player.vimeo.com/video/".$value['vimeoId'] ;

                      $newDateformat = date('l jS  F-Y', strtotime($value['fromDT']));
                    ?>
                    <div class="sub-related-videos">
                      <a href="<?php echo $youtubelink; ?>" target="_blank">
                      <div class="video-thumbnail">
                        <iframe class="responsive-iframe-youtube-related-video" src="<?php echo $youtubelink; ?>" frameborder="0" allowfullscreen allow="autoplay; encrypted-media">
                        </iframe>
                      </div>
                      </a>
                      <div class="video-title">
                         <a href="<?php echo $youtubelink; ?>"  target="_blank"><?php echo $value['sessionName'];?></a>
                      </div>
                    </div>
                    <?php } } else{ echo "<div class='related-video1'>No Videos Found!</div>"; } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script src="https://player.vimeo.com/api/player.js"></script>

<script>
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}



$(document).ready(function(){
    $(".panner-left").click(function(){
        $(".topic-box").animate({scrollLeft: "-="+100});
    });
    $(".panner-right").click(function(){
        $(".topic-box").animate({scrollLeft: "+="+100});
    });        
});
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
