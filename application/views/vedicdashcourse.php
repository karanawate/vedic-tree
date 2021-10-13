<?php

$usersession     = $this->session->userdata('usersession');
$studentName     = $usersession[0]['studentName'];
$studentEmail    = $usersession[0]['studentEmail'];
$studentMobile   = $usersession[0]['studentMobile'];
$fk_classId      = $usersession[0]['studentClass'];
$promoCode       = $usersession[0]['promoCode'];
$studId          = $usersession[0]['studId'];
$unloacdayFromdb = check_user_state($studId);
$unlockdayId     = $unloacdayFromdb[0]['unlockdayId'];
$unlock_monthId  = $unloacdayFromdb[0]['unlock_monthId'];

date_default_timezone_set('Asia/Kolkata');
$currentDate    = date("Y-m-d");

$timestamp      = strtotime(date("Y-m-d"));
$newDate        = date('l jS  F-Y', $timestamp); 
$monthdata      = required_course_data();
$open_month     = 0;
$open_Day       = 0;
$calFlag        = 0;
// echo "<pre>";
// print_r($monthdata);
$planId         = "";   
if($monthdata['paymentMonth']){
    $planId = $monthdata['paymentMonth'][0]['planId'];
    foreach ($monthdata['tbl_calender_open_day'] as $key => $value) {
        if($currentDate == $value['calDate']){
            if($unlock_monthId > 0 ){
             $open_month =  $unlock_monthId;    
            }else{
                $open_month =  $value['Months'];
            }
            
           if($unlockdayId > 0 ){
             $open_Day =  $unlockdayId;    
            }else{
                $open_Day   =  $value['Days'];
            }
            
            $calFlag    =  $value['calFlag'];
        }  
    }
} else {
    $planId = "0";
}

$monthdatacount = count($monthdata['monthdata']);
if($calFlag==2){
    $get_open_previous_day = get_open_previous_course_day();
    //remianig logic here for previious day wise date
    $open_Day = $get_open_previous_day[0]['Days'];
} else {
    $open_Day = $open_Day;
}
// print_r($open_month);
// print_r($open_Day);  
// print_r($calFlag);
// print_r($planId);
// die;
// $open_Day = 10;
// $open_month = 2;
    
///////////////////////////////// locked previous day //////////////////////////////////////

$paymentMonth = $monthdata['paymentMonth'];
if($paymentMonth) {
    $DatePaid     = date("Y-m-d",strtotime($paymentMonth[0]['createDT']));
    if($DatePaid > "2021-06-24"){
        $add_six_days_from_day_admission = date('Y-m-d', strtotime($DatePaid. ' + 6 days'));
        if($add_six_days_from_day_admission==date("Y-m-d")){
            $open_Day_closed =  $open_Day - 12 ;
        } else {
            $open_Day_closed =  0; 
        } 
    }else{
        $open_Day_closed = $open_Day - 12;
    }
} ?>
<!DOCTYPE html>
<html lang="">
<head>
    <style>
    @media (max-width: 768px) {
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
        .todays-learning {
            position: absolute;
            color: #fff;
            left: 16%;
            bottom: 10px;
            font-size: 12px;
            font-family: 'Nunito';
            font-weight: 800;
            padding: 5px 10px;
            background: #f17373;
            border-radius: 25px;
            cursor: pointer;
        }
    }
    @media (min-width: 769px) {
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
        .todays-learning {
            position: absolute;
            color: #fff;
            left: 20%;
            bottom: 20px;
            font-size: 24px;
            font-family: 'Nunito';
            font-weight: 800;
            padding: 5px 10px;
            background: #f17373;
            border-radius: 25px;
            box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;
            cursor: pointer;
        }
        .todays-learning:hover {
            transform: scale(1.1);
        }
    }
    .sub-box2 {
        display: grid;
        grid-template-rows: 1fr 1fr;
        background: antiquewhite;
        padding: 15px;
        cursor: pointer;
    }
    .sub-box2 img {
        width: 80%;
    }
    </style>
    <!-- Vedic Main header files Start -->
    <?php $this->load->view('vedic_header'); ?>
    <!-- Vedic Main header files End -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T3FX7LW"
    height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
$notification                  = notification();
$tbl_notification_live_class   = tbl_notification_live_class();
$microsoft_link                = "";
$dbstart_time                  = "";
$dbendtime                     = "";
$time                          = "";
$cuurentTime  ="";
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
    if ($cuurentTime >= $dbstart_time &&  $cuurentTime <= $dbendtime) { ?>
    <div class="overlay">
        <div id="popup" class="popup panel panel-primary">
            <a href="<?php if($promoCode=="freeEducation"){ echo $microsoft_link; }else{ echo $microsoft_link; } ?>" class="<?php if($promoCode=="freeEducation"){ echo "attendance"; }?>" target="_blank">
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
        <div class="box11">
            <div class="box-inside">
                <div class="desktop-mobile-view">
                    <!-- //top header -->
                    <?php $this->load->view('topheader'); ?>
                    <!-- //end top header -->
                    <div class="box3">
                        <div class="video-part" style="position: relative;">
                            <a href="<?php echo base_url('website/vedic_learn/'.$unlock_monthId.'/'.$unlockdayId.'/'.$fk_classId);?>"><?php if($monthdata['paymentMonth']){ ?> 
                            <?php if($unlock_monthId > 0 ) { ?>
                            <div class="todays-learning"><span class="mr-2">Month <?php echo $unlock_monthId ?></span>|<span class="ml-2">Day <?php echo $unlockdayId; ?></span></div></a> <?php } } ?>
                            <?php  
                                if($cuurentTime!="" && $time!="" ){
                                    if ($cuurentTime >= $dbstart_time &&  $cuurentTime <= $dbendtime) {?>
                                    <a href="<?php echo $microsoft_link; ?>"><img class="live-session-img" src="<?php echo base_url()?>assets/website/img/live_sessions.png" alt="popup"></a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('website/vedic_learn/'.$unlock_monthId.'/'.$unlockdayId.'/'.$fk_classId);?>"><img class="learning-session-img" src="<?php echo base_url()?>assets/website/img/livesesion2.png" alt="popup"></a>
                            <?php } } else { ?>
                                <a href="<?php echo base_url('website/vedic_learn/'.$unlock_monthId.'/'.$unlockdayId.'/'.$fk_classId);?>"><img class="learning-session-img" src="<?php echo base_url()?>assets/website/img/livesesion2.png" alt="popup"></a>
                            <?php } ?>
                        </div>
                        <div class="month-day-scroll">
                            <div class="month">
                                <input type="hidden" value="" id="monthid" name="">
                                <input type="hidden" value="<?php echo $fk_classId;?>" id="fk_classId" name="">
                                <div class="month-select">
                                    <?php

                                    if(empty($monthdata['monthdata'])){ ?>
                                    <select class="selectMonth" value="<?php echo set_value('fk_monthId'); ?>" name="fk_monthId">
                                        <option value="<?php echo set_value('fk_monthId'); ?>" selected disabled>Select Month</option>
                                        <option value="1"><?php 
                                             echo "Demo Month";
                                            ?>  
                                         </option>
                                    </select>
                                    <?php
                                        }else{
                                    ?>
                                    <select class="selectMonth" value="<?php echo set_value('fk_monthId'); ?>" name="fk_monthId">
                                        <option value="<?php echo set_value('fk_monthId'); ?>" selected disabled>Select Month</option>
                                        <?php
                                            if($monthdata['monthdata']){
                                            foreach ($monthdata['monthdata'] as $key => $monthvalue) {
                                        ?>
                                        <option value="<?php 

                                            if($monthdatacount >= 1 ){ 

                                                if($planId==1 && $calFlag==1 || $planId==6 && $calFlag==1 || $planId==11 && $calFlag==1 ||$planId==1 && $calFlag==2 ||$planId==6 && $calFlag==2 || $planId==11 && $calFlag==2 )
                                                { 
                                                 if($open_month == $monthvalue['mId'])
                                                 {   
                                                    echo $monthvalue['mId'];
                                                 }
                                                
                                                } else if($planId > 1 && $calFlag==1 || $planId > 1 && $calFlag==2){  
                                                    if($unlock_monthId == $monthvalue['mId'])
                                                    { 
                                                        echo $monthvalue['mId']; 
                                                    } 
                                            
                                                }
                                           }else{ echo "Demo Month"; } 
                                           
                                           ?>
                                        
                                        ">
                                        
                                        <?php 

                                            if($monthdatacount >= 1 ){ 

                                            if($planId==1 && $calFlag==1 || $planId==1 && $calFlag==2 ) { 
                                                if($open_month == $monthvalue['mId']){
                                                    echo $monthvalue['monthName'];
                                                 }else
                                                 {
                                                    echo $monthvalue['monthName']." Locked";
                                                 }
                                              }else if($planId > 1 && $calFlag==1 || $planId > 1 && $calFlag==2){ 
                                                if($open_month == $monthvalue['mId']){
                                                       echo $monthvalue['monthName'];
                                                 }else{
                                                    echo $monthvalue['monthName']." Locked";
                                                 } 
                                             }
                                            }else{   echo "Demo Month"; }
                                        ?>
                                        </option>
                                        <?php }} ?>
                                    </select>
                                <?php } ?>
                                </div>
                            </div>
                            <div class="dash-scrollbar" id="style-2">
                                <div class="days-list force-overflow">
                                    <?php 

                                     //automate open month

                                    if($monthdatacount >= 1 ) {

                                    if($planId==1 && $calFlag==1 || $planId==6 && $calFlag==1 || $planId==11 && $calFlag==1 ||$planId==1 && $calFlag==2 ||$planId==6 && $calFlag==2 || $planId==11 && $calFlag==2){ 
                                        if($monthdata['daydata']){
                                         foreach ($monthdata['daydata'] as $key => $value) {
                                            $rand = array('11476e', '960952', '54f6c4', 'd2be95', 'b48edc', '4a9e6b', '3826eb', 'e43963', '4c8c80', '39d8ca', '86b082', '38aed2', 'e30c3e', '357c78', 'dd13a7', '0b930f', '21afc8', '39c34e', '5d0f00', 'd552b5', '783045', '3122ba', 'fb48dd', '2b87f0', '4c51c8', 'd4205b', 'c48630', '5e7167', 'd7aa40', 'd6722a', '1a0012', '0c67ab');
                                            $color = '#'.$rand[rand(0,30)];
                                            
                                            if($open_Day >= $value['dayId']){
                                                
                                            if($open_Day_closed >= $value['dayId']) {
                                                $open_Day_closed_class = "fa fa-lock";
                                                $unlock_day_class = "lock-day";
                                            }else{
                                                $unlock_day_class = "unlock-day days";
                                                $open_Day_closed_class = "fa fa-unlock-alt";
                                            }
                                            
                                        ?>
                                        <div style="background-color:<?php echo $color; ?>" class="<?php echo $unlock_day_class;?> days<?php echo $value['dayId']; ?>" id="<?php echo $value['dayId']; ?>">
                                            <div class="day-value"><?php echo $value['dayName']; ?></div>
                                            <div class="lock-unlock"><i class="<?php echo $open_Day_closed_class; ?>" aria-hidden="true"></i></div>
                                        </div>
                                        <?php } else { ?>
                                        <div style="background-color:<?php echo $color; ?>" class="lock-day days<?php echo $value['dayId']; ?>" id="">
                                            <div class="day-value"><?php echo "Day ".$value['dayId']; ?></div>
                                            <div class="lock-unlock"><i class="fa fa-lock" aria-hidden="true"></i></div>
                                        </div>
                                        <?php } } } } 
                                    
                                         if($planId==2 && $calFlag==1  || $planId==3 && $calFlag==1  || $planId==4  && $calFlag==1 || 
                                            $planId==2 && $calFlag==2  || $planId==3 && $calFlag==2  || $planId==4  && $calFlag==2 || 
                                            $planId==5 && $calFlag==1  || $planId==7 && $calFlag==1  || $planId==8  && $calFlag==1 || 
                                            $planId==5 && $calFlag==2  || $planId==7 && $calFlag==2  || $planId==8  && $calFlag==2 || 
                                            $planId==9 && $calFlag==1  || $planId==10 && $calFlag==1 || $planId==12 && $calFlag==1 || 
                                            $planId==9 && $calFlag==2  || $planId==10 && $calFlag==2 || $planId==12 && $calFlag==2 || 
                                            $planId==13 && $calFlag==1 || $planId==14 && $calFlag==1 || $planId==15 && $calFlag==1 || 
                                            $planId==13 && $calFlag==2 || $planId==14 && $calFlag==2 || $planId==15 && $calFlag==2 || 
                                            $planId==16 && $calFlag==1 || $planId==17 && $calFlag==1 || $planId==17 && $calFlag==2 ||
                                            $planId==18 && $calFlag==1 || $planId==18 && $calFlag==2 || $planId==19 && $calFlag==1 ||
                                            $planId==19 && $calFlag==2 || $planId==20 && $calFlag==1 || $planId==20 && $calFlag==2 ||
                                            $planId==16 && $calFlag==2 
                                        )
                                    {
                                        if($monthdata['daydata']){

                                        foreach ($monthdata['daydata'] as $key => $value) {
                                            $rand = array('11476e', '960952', '54f6c4', 'd2be95', 'b48edc', '4a9e6b', '3826eb', 'e43963', '4c8c80', '39d8ca', '86b082', '38aed2', 'e30c3e', '357c78', 'dd13a7', '0b930f', '21afc8', '39c34e', '5d0f00', 'd552b5', '783045', '3122ba', 'fb48dd', '2b87f0', '4c51c8', 'd4205b', 'c48630', '5e7167', 'd7aa40', 'd6722a', '1a0012', '0c67ab');
                                            $color = '#'.$rand[rand(0,30)];
                                            if($unlockdayId >= $value['dayId']){
                                                
                                            if($open_Day_closed >= $value['dayId']) {
                                                $open_Day_closed_class = "fa fa-lock";
                                                $unlock_day_class = "lock-day";
                                            }else{
                                                $unlock_day_class = "unlock-day days";
                                                $open_Day_closed_class = "fa fa-unlock-alt";
                                            }
                                            
                                        ?>
                                        <div style="background-color:<?php echo $color; ?>" class="<?php echo $unlock_day_class;?> days<?php echo $value['dayId']; ?>" id="<?php echo $value['dayId']; ?>">
                                            <div class="day-value"><?php echo $value['dayName']; ?></div>
                                            <div class="lock-unlock"><i class="<?php echo $open_Day_closed_class; ?>" aria-hidden="true"></i></div>
                                        </div>
                                        
                                        <?php } else{ ?>
                                        <div style="background-color:<?php echo $color; ?>" class="lock-day days<?php echo $value['dayId']; ?>" id="" data-toggle="tooltip" data-placement="top" title="Locked">
                                            <div class="day-value"><?php echo "Day ".$value['dayId']; ?></div>
                                            <div class="lock-unlock"><i class="fa fa-lock" aria-hidden="true"></i></div>
                                        </div>
                                    <?php }
                                     } } 
                                      }
                                    } else { 
                                    if($monthdata['daydata']){   
                                    for ($i=0; $i < 5 ; $i++) {
                                        $rand = array('11476e', '960952', '54f6c4', 'd2be95', 'b48edc', '4a9e6b', '3826eb', 'e43963', '4c8c80', '39d8ca', '86b082', '38aed2', 'e30c3e', '357c78', 'dd13a7', '0b930f', '21afc8', '39c34e', '5d0f00', 'd552b5', '783045', '3122ba', 'fb48dd', '2b87f0', '4c51c8', 'd4205b', 'c48630', '5e7167', 'd7aa40', 'd6722a', '1a0012', '0c67ab');
                                        $color = '#'.$rand[rand(0,30)];
                                    ?>
                                    <div  style="background-color:<?php echo $color; ?>" class="days days<?php echo $monthdata['daydata'][$i]['dayId']; ?>" id="<?php echo $monthdata['daydata'][$i]['dayId']; ?>">
                                        <?php echo $monthdata['daydata'][$i]['dayName']; ?>
                                    </div>

                                 <?php } } }  ?>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="box4">
                        <h2>Your Learning Part</h2>
                        <div class="sub-box">
                            <div class="sub-box1">    
                                <iframe class="responsive-iframe" frameBorder="0" style="border:0-moz-border-radius: 10px;border-radius: 10px;"
                                    src="https://www.youtube.com/embed/DeBQNPeBj6k">
                                </iframe>
                            </div>
                            <a href="<?php echo base_url('vedic-homework/11');?>">
                            <div class="sub-box2">
                                <div class="d-flex justify-content-center">
                                    <img src="<?php echo base_url()?>assets/website/img/homework.png" alt="Homework">
                                </div>
                                <div class="d-flex justify-content-center" style="font-size: 25px;align-self: center;">Student Homework</div>
                            </div>
                            </a>
                            <div class="sub-box3">
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

<script type="text/javascript">
$(document).ready(function(){$(".selectMonth").click(function(){let t=$(this).val();t=t.trim(),$("#monthid").val(t)}),$(".days").click(function()
{var t=$(this).attr("id"),e=$("#monthid").val();e=""==e||null==e?$(".selectMonth").val():(e=$(".selectMonth").val()).trim();var n=$("#fk_classId").val();
if(""==e||null==e)return swal("Please Select Month !"),!1;var o="<?php echo base_url(); ?>website/vedic_learn/"+e+"/"+t+"/"+n;$(location).attr("href",o)})}),
$(document).ready(function(){$(".panner-left").click(function(){$(".month-box").animate({scrollLeft:"-=250"})}),$(".panner-right").click(function()
{$(".month-box").animate({scrollLeft:"+=250"})})}),$(document).ready(function(){$("#popup").hide().fadeIn(1e3),$("#close").on("click",function(t)
{t.preventDefault(),$(".overlay").hide(),$("#popup").fadeOut(1e3)})}),$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip()});
</script>

<script>
    $(document).ready(function(){
       
       $(".attendance").click(function(){
           
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('website/attendace')?>",
            success:function(res){
                if(res==1){
                    console.log('attend live class');
                }else{
                    console.log('already attend live class');
                }
            },
            error:function(error){
                console.log(error);
            }
        }) ;    
           
       })
       
      
    });
</script>