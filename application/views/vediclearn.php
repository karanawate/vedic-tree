<?php

    $usersession       = $this->session->userdata('usersession');
    $studentName       = $usersession[0]['studentName'];
    $studentEmail      = $usersession[0]['studentEmail'];
    $studentMobile     = $usersession[0]['studentMobile'];
    $fk_coursePeriod   = $usersession[0]['fk_coursePeriod'];
    $timestamp         = strtotime(date("Y-m-d"));
    $newDate           = date('l jS  F-Y', $timestamp);  
    // $youtubelink    = "";
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <style>
    @media (max-width: 1024px) {
        .overlay {
            position:absolute;
            z-index: 999;
            /* color with alpha transparency */
            background-color: rgba(0, 0, 0, 0.7);
            /* stretch to screen edges */
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }
        #popup {
            display:none;
            position:absolute;
            margin:0 auto;
            top: 18%;
            left: 50%;
            z-index: 9999;
            transform: translate(-50%, -50%);
            box-shadow: 0px 0px 50px 2px #000;
        }
        .learning-session-img {
            width: 100%;
            border-radius: 10px;
        }  
        .live-session-img {
            width: 100%;
        }
        .live-popup-img {
            width: 350px
        }
    }
    @media (min-width: 1025px) {
        .overlay {
            position:absolute;
            z-index: 999;
            /* color with alpha transparency */
            background-color: rgba(0, 0, 0, 0.7);
            /* stretch to screen edges */
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }
        #popup {
            display:none;
            position:absolute;
            margin:0 auto;
            top: 50%;
            left: 50%;
            z-index: 9999;
            transform: translate(-50%, -50%);
            box-shadow: 0px 0px 50px 2px #000;
        }
        .learning-session-img {
            width: 100%;
            border-radius: 10px;
            height: 398px;
        }
        .live-session-img {
            width: 100%;
            height: 398px;
        }
        .live-popup-img {
            width: 600px;
        }
    }
    </style>
    <!-- Vedic Main header files Start -->
    <?php $this->load->view('vedic_header'); ?>
    <!-- Vedic Main header files End -->
    </head>
<body>
<?php
    $notification                  = notification();
    $tbl_notification_live_class   = tbl_notification_live_class();
    $microsoft_link                = "";
    $dbstart_time                  = "";
    $dbendtime                     = "";
    $time                          = "";
    $cuurentTime                   = "";
    if($tbl_notification_live_class){
        date_default_timezone_set('Asia/Kolkata');
        $time           = time();
        $start_date     = $tbl_notification_live_class[0]['start_date'];
        $end_date       = $tbl_notification_live_class[0]['end_date'];
        $dbstart_time   = strtotime($tbl_notification_live_class[0]['start_time']);
        $dbendtime      = strtotime($tbl_notification_live_class[0]['end_time']);
        $cuurentTime    = strtotime(date("g:ia"));
        $microsoft_link = $tbl_notification_live_class[0]['microsoft_link'];
    } else {
        $microsoft_link = "#"; 
    }
    if($cuurentTime!="" && $dbstart_time!="" ){
        if ($cuurentTime > $dbstart_time &&  $cuurentTime < $dbendtime) {
?>
<div class="overlay">
    <div id="popup" class="popup panel panel-primary">
        <a href="<?php echo $microsoft_link; ?>" target="_blank">
            <img class="live-popup-img" src="<?php echo base_url()?>assets/website/img/live_sessions.png" alt="popup">
        </a>
        <div class="d-flex justify-content-between panel-footer" style="background: #fff">
            <button id="close" class="btn btn-lg btn-primary">Close</button>
            <div>From: <span class="mr-5" style="color: #626ed4;font-weight: 700;"><?php echo $tbl_notification_live_class[0]['start_time'] ; ; ?></span> To: <span style="color: #626ed4;font-weight: 700;"><?php echo $tbl_notification_live_class[0]['end_time'] ; ?></span></div>
        </div>
    </div>
</div>
<?php } } ?>
<!-- Simulate a smartphone / tablet -->
<?php $this->load->view('mobilemenus'); ?>
<!-- End smartphone / tablet look -->
    <div class="boxes">
      <?php $this->load->view('websitesidebar'); ?>
      <div class="box11 animated_hero" style="background: #695FFE;">
        <div class="box-inside">
          <div class="desktop-mobile-view">
            <!-- //top header -->
            <?php $this->load->view('topheader'); ?>
            <!-- //end top header -->
            <div style="position: relative; padding: 0 55px;">
                <div class="topic-box" style="white-space: nowrap;">
                    <ul style="padding-left: 0px;">
                    <?php if($get_day_sessions){ 
                        $class = "";
                        foreach ($get_day_sessions as $key => $value) {
                            if(strlen($vidId)>8){
                                if($vidId == $value['vimeoId']){
                                    $class = "style='width:250px;background:white;color: #fe4b7b;border: 1px solid #fe4b7b;'";
                                }else{
                                    $class="";
                                }
                            }elseif($vidId == $value['vidId']){
                                $class = "style='width:250px;background:white;color: #fe4b7b;border: 1px solid #fe4b7b;'";
                            }else{
                                $class="";
                            }
                        ?>
                        <li style="display:inline-table;">
                            <a id="<?php echo $value['vidId']; ?>" <?php echo $class;?> style="width: 250px;" class="topic-box1 topiclink"><?php echo $value['sessionName']; ?></a>
                        </li>
                    <?php } } ?>
                    </ul>
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
                <div class="learn-scrollbar" id="style-2">
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
                <?php if($fk_coursePeriod > 0){ ?>
                 <a href="<?php echo base_url('website/vedicdashcourse')?>" style="font-weight: 500;font-size: x-large;border-radius: 40px;font-family: 'Source Sans Pro', sans-serif;" class="btn btn-primary" >For Next Session</a>
                <?php }else{ ?>
                 <a href="<?php echo base_url('vedic-dash/1')?>" style="font-weight: 500;font-size: x-large;border-radius: 40px;font-family: 'Source Sans Pro', sans-serif;" class="btn btn-primary" >For Next Session</a>
                <?php } ?>
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
    //select the POPUP FRAME and show it
    $("#popup").hide().fadeIn(1000);
    //close the POPUP if the button with id="close" is clicked
    $("#close").on("click", function (e) {
        e.preventDefault();
        $(".overlay").hide();
        $("#popup").fadeOut(1000);
    });
    
    $(".topiclink").click(function(){
        var vidId = $(this).attr('id'); 
        // console.log(vidId);
        var vidId = btoa(vidId);
        window.location.href= "<?php echo base_url('website/vedic_learn/'.$monthId.'/'.$dayId.'/'.$fk_classId.'/')?>"+vidId;
    });
    
    $(".panner-left").click(function(){
        $(".topic-box").animate({scrollLeft: "-="+255});
    });
    
    $(".panner-right").click(function(){
        $(".topic-box").animate({scrollLeft: "+="+255});
    });  
});
</script>
<script>
var iframe    = document.querySelector('iframe');
var player    = new Vimeo.Player(iframe);
var secondss  = 0;
var durations = 0;
var paused    = [];

player.on('progress', function() {
    player.getCurrentTime().then(function(seconds) {
        secondss = seconds;
    });
    player.getDuration().then(function(duration) {
        durations = duration;
    });
    $("#durations").val(durations);
    $("#secondss").val(secondss);
    var videoId     = $("#videoId").val();
    var monthId     = $("#monthId").val();
    var fk_classId  = $("#fk_classId").val();
    var dayId       = $("#dayId").val();
    var fk_sessionId   = $("#fk_sessionId").val();
    $.ajax({
        type:"POST",
        data:{durations:durations,secondss:secondss,videoId:videoId,monthId:monthId,fk_classId:fk_classId,dayId:dayId,fk_sessionId:fk_sessionId},
        url:"<?php echo base_url('website/get_trac')?>",
        success:function(success){  
            console.log(success);
        },
        error:function(error){
            console.log(error);
        }
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