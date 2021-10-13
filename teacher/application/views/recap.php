<?php

    $usersession    = $this->session->userdata('usersession');
    $studentName    = $usersession[0]['teacherName'];
    $studentEmail   = $usersession[0]['teacherEmail'];
    $studentMobile  = $usersession[0]['teacherMobile'];
    $fk_classId     = $usersession[0]['teacherClass'];
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp); 
    $monthdata      = required_month();

    $monthdatacount = count($monthdata['monthdata']);



?>
<!DOCTYPE html>
<html lang="">
<head>
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
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/bootstrap.min.css" />    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/animate.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/vedicdash.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/themefy_icon/themify-icons.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/niceselect/css/nice-select.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/owl_carousel/css/owl.carousel.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/magnify_popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/81616633dd.js"></script>
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <style type="text/css">
        .disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}

    </style>
</head>
<body>
    <!-- Simulate a smartphone / tablet -->
    <?php $this->load->view('mobilemenu'); ?>
    <!-- End smartphone / tablet look -->
    <div class="boxes">
        <?php $this->load->view('teachersidebar'); ?>
        <div class="box11" style="background: #695FFE;">
            <div class="box-inside">
                <div class="desktop-mobile-view">
                    <!-- //top header -->
                    <?php $this->load->view('teacher_topheader'); ?>
                    <!-- //end top header -->
                    <div class="box3">
                        <div class="video-part">
                            <iframe class="responsive-iframe" frameBorder="0" style="border:0-moz-border-radius: 10px;border-radius:10px;" src="https://player.vimeo.com/video/549604571"></iframe>
                        </div>
                        <div class="month-day-scroll">
                            <div class="month">
                                <input type="hidden" value="" id="monthid" name="">
                                <input type="hidden" value="<?php echo $fk_classId;?>" id="fk_classId" name="">
                                <div class="month-select">
                                    <select class="selectMonth" value="<?php echo set_value('fk_monthId'); ?>" name="fk_monthId">
                                        <option value="<?php echo set_value('fk_monthId'); ?>" selected disabled>Select Month</option>
                                        <?php
                                            if($monthdata['monthdata']){
                                        ?>
                                        <option value="1"><?php 
                                        if($monthdatacount > 1 ){ 
                                                echo "Recap Session";
                                              }else{
                                                echo "Recap Session";
                                              }
                                            ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="scrollbar" id="style-2">
                                <div class="days-list force-overflow">
                                    <?php 
                                        if($monthdatacount > 1 ){  
                                        for ($i=0; $i < 13 ; $i++) {
                                        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                                        $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                                        ?>
                                    
                                        <div  style="background-color:<?php echo $color; ?>" class="days days<?php echo $monthdata['daydata'][$i]['dayId']; ?>" id="<?php echo $monthdata['daydata'][$i]['dayId']; ?>">
                                        <?php echo $monthdata['daydata'][$i]['dayName']; ?>
                                        </div>
                                    <?php } } else { ?>
                                    <div class="recapdiv" >
                                        Recap Session Will Open After Subscription
                                    </div>
                                    <?php }  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box4">
                        <h2>Your Learning Part</h2>
                        <div class="sub-box">
                            <div class="sub-box1">    
                                <iframe class="responsive-iframe"  frameBorder="0" style="border:0-moz-border-radius: 10px;border-radius: 10px;" src="https://www.youtube.com/embed/DeBQNPeBj6k"></iframe>
                            </div>
                            
                            <div class="sub-box2">
                            <?php
                            $today_date = date('Y-m-d');
                            $newDate    = "";
                             if($gmdovbe) {
                                foreach ($gmdovbe as $key => $value) {

                                $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
                               $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

                              if(preg_match($longUrlRegex, $value['youtubelink'], $matches)) {
                                  $youtube_id = $matches[count($matches) - 1];
                              }
                              if(preg_match($shortUrlRegex, $value['youtubelink'], $matches)) {
                                  $youtube_id = $matches[count($matches) - 1];
                              }
                              $youtubelink = 'https://www.youtube.com/embed/' . $youtube_id ;

                                    $newDate = date('Y-m-d', strtotime($value['vidcreateDT']));
                                    $newDate = $newDate ;
                                }
                            }

                                if($today_date==$newDate){
                                ?>
                            <iframe class="responsive-iframe" frameBorder="0" style="border:0-moz-border-radius: 10px;border-radius: 10px;" src="<?php echo $youtubelink; ?>"></iframe>
                            <?php }else{ ?>
                                <iframe class="responsive-iframe" frameBorder="0" style="border:0-moz-border-radius: 10px;border-radius:10px;" src="https://www.youtube.com/embed/6-u0nG6uiGU"></iframe>
                            <?php } ?>
                            </div>
                            <div class="sub-box3">
                                <!--<div class='datepicker'><div class="datepicker-header"></div></div> -->
                                <img src="<?php echo base_url()?>assets/website/img/live_coming_soon.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
  </body>
</html>
<script>
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script type="text/javascript">

$(document).ready(function(){


 $(".selectMonth").click(function(){
        var selectMonth = $(this).val();
        $("#monthid").val(selectMonth);
 });


 $(".days").click(function(){
    var daysId     = $(this).attr('id');
    var monthid    = $("#monthid").val();

    if(monthid=="" || monthid==null){
        monthid = $(".selectMonth").val();
    }else{
        monthid = $(".selectMonth").val();
    }
    var fk_classId = $("#fk_classId").val();


    if(monthid=="" || monthid==null ){
        // alert("Please Select Month");
        swal("Please Select Month !");
        return false;
    }else{

        var url = "<?php echo base_url(); ?>teacher/vedic_learn_recap/"+monthid+"/"+daysId+"/"+fk_classId+"/9";  
         $(location).attr('href',url);
    }

 });
});

$(document).ready(function(){
    $(".panner-left").click(function(){
        $(".month-box").animate({scrollLeft: "-="+250});
    });
    $(".panner-right").click(function(){
        $(".month-box").animate({scrollLeft: "+="+250});
    });        
});


</script>