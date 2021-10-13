<?php

    $usersession    = $this->session->userdata('usersession');
    
    $studentName    = $usersession[0]['teacherName'];
    $studentEmail   = $usersession[0]['teacherEmail'];
    $studentMobile  = $usersession[0]['teacherMobile'];
    $fk_classId     = $usersession[0]['teacherClass'];
    $adminRole      = $usersession[0]['teacher_status'];
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp);  
    // $youtubelink    = "";
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#fe4b7b">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#fe4b7b">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#fe4b7b">
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
    <?php $this->load->view('mobilemenu'); ?>
    <!-- End smartphone / tablet look -->
    </div>
    <div class="boxes">
    <?php $this->load->view('teachersidebar'); ?>
      <div class="box11 animated_hero" style="background: #695FFE;">
        <div class="box-inside">
          <div class="desktop-mobile-view">
            <!-- //top header -->
            <?php $this->load->view('teacher_topheader'); ?>
            <!-- //end top header -->
            
            <div style="position: relative; padding: 0 55px;">
              <div class="topic-box">
                <?php if($get_day_sessions){ 
                  $class = "";
                   foreach ($get_day_sessions as $key => $value) {
                    if(strlen($vidId)>8){
                      if($vidId == $value['vimeoId']){
                        $class = "style='background:white;color: #fe4b7b;border: 1px solid #fe4b7b;'";
                      }else{
                        $class="";
                      }
                    }elseif($vidId == $value['vidId']){
                      $class = "style='background:white;color: #fe4b7b;border: 1px solid #fe4b7b;'";
                    }else{
                      $class="";
                    }
                  ?>
                  <a  id="<?php echo $value['vidId']; ?>" <?php echo $class;?> class="topic-box1 topiclink"><?php echo $value['sessionName']; ?></a>
                <?php } } ?>
              </div>
              <div>
                <span class="panner-left" data-scroll-modifier='-1'><i class="fa fa-chevron-circle-left icons-left" aria-hidden="true"></i></span>
                <span class="panner-right" data-scroll-modifier='1'><i class="fa fa-chevron-circle-right icons-right" aria-hidden="true"></i></span>
              </div>
            </div>
            <div class="video-related-learning">
              <div class="video-frame-learning">
               <?php

             
               $data['youtubelinks'] = $youtubelinks;
               $this->load->view('vimeovideolink',$data);
               ?>
              </div>
              <input type="hidden" id="monthId" value="<?php echo $monthId ?>" name="monthId">
              <input type="hidden" id="dayId" value="<?php echo $dayId;?>" name="dayId">
              <input type="hidden" id="fk_classId" value="<?php echo $fk_classId;?>" name="fk_classId">
              <input type="hidden" id="durations" name="duration">
              <input type="hidden" id="secondss" name="seconds">
              <input type="hidden" id="videoId" value="<?php echo $youtubelinks; ?>" name="videoId" style="width:500px;">
              <input type="hidden" id="fk_sessionId" value="<?php  if($vidId>0){ echo $vidId = $vidId; }else{ echo $vidId = 0; } ?>" name="fk_sessionId" >

              <div class="related-video-learning">
                <h2>Next Session Videos</h2>
                <div class="scrollbar" id="style-2">
                  <div class="related-video">
                    <?php if($get_day_sessions){ 
                        foreach ($get_day_sessions as $key => $value) { 
                    ?>
                    <div class="sub-related-videos">
                        <a href="#" id="<?php echo $value['vidId']; ?>" class="topiclink">
                        <div class="video-thumbnail">
                            <iframe class="responsive-iframe-youtube-related-video" src="<?php echo "https://player.vimeo.com/video/".$value['vimeoId']; ?>" frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe>
                        </div>
                        </a>
                        <div class="video-title">
                            <a href="#" id="<?php echo $value['vidId']; ?>" class="topiclink"><?php echo $value['content_title'];?></a> 
                        </div>
                    </div>
                    <?php }  }else{ echo "<div class='related-video1'>No Videos Found!</div>"; } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-end mt-2">
                
                 <?php 
                 
                 
                 if($adminRole == 4) {?>
                   
                   <a href="<?php echo base_url('teacher/course_seven')?>" style="font-weight: 500;font-size: x-large;border-radius: 40px;font-family: 'Source Sans Pro', sans-serif;" class="btn btn-primary" >For Next Session</a>
                 <?php } else{ ?>
                 
                    <a href="<?php echo base_url('vedic-dash/1')?>" style="font-weight: 500;font-size: x-large;border-radius: 40px;font-family: 'Source Sans Pro', sans-serif;" class="btn btn-primary" >For Next Session</a>
              
                 <?php  } ?>
        
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script src="https://player.vimeo.com/api/player.js"></script>

<script>

$(document).ready(function(){
    $(".topiclink").click(function(){
    var vidId = $(this).attr('id'); 
    console.log(vidId);
    var vidId = btoa(vidId);

    window.location.href= "<?php echo base_url('teacher/vedic_learn_three/'.$monthId.'/'.$dayId.'/'.$fk_classId.'/')?>"+vidId;

  });
});

$(document).ready(function(){
    $(".panner-left").click(function(){
        $(".topic-box").animate({scrollLeft: "-="+270});
    });
    $(".panner-right").click(function(){
        $(".topic-box").animate({scrollLeft: "+="+270});
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
