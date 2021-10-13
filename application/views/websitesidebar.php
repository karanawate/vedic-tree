<?php
 $usersession    = $this->session->userdata('usersession');
 $adminRole      = $usersession[0]['adminRole']; 
 $fk_coursePeriod  = $usersession[0]['fk_coursePeriod']; 
 $promoCode      = trim($usersession[0]['promoCode']);

 $background_color_1 = "";
 $background_color_2 = "";
 $background_color_3 = "";
 $background_color_4 = "";
 $background_color_5 = "";
 $background_color_6 = "";
 $background_color_7 = "";
 $background_color_8 = "";
 $background_color_9 = "";
 $background_color_10 = "";
 $background_color_11 = "";
 $background_color_12 = "";
 $background_color_13 = "";
 $background_color_14 = "";
 $background_color_15 = "";
 $background_color_16 = "";
 $background_color_19 = "";
 

 if(isset($data) && !empty($data['background_color_id'])){
    $background_color_id = $data['background_color_id'];
 }else{
  $background_color_id = $background_color_id;
 }
 $background_color = "background-color: #fff;color: deeppink;padding: 15px;border-radius: 0 20px 20px 0;";
 if (isset($background_color_id)  && $background_color_id==1 || $background_color_id=="vedic_dash")
  {
    $background_color_1 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==2) {
    $background_color_2 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==3) {
      $background_color_3 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==4) {
      $background_color_4 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==5) {
      $background_color_5 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==6) {
      $background_color_6 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==7) {
      $background_color_7 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==8) {
      $background_color_8 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==9) {
      $background_color_9 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==5) {
      $background_color_10 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==11) {
      $background_color_11 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==12) {
      $background_color_12 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==13) {
      $background_color_13 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==14) {
      $background_color_14 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==15) {
      $background_color_15 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==16) {
      $background_color_16 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==19) {
      $background_color_19 = $background_color;
  }elseif (isset($background_color_id)  && $background_color_id==0) {
      $background_color_2 = $background_color;
  }else{
    $background_color = "";
  }


$monthdata  = required_data();

$adminRole = $monthdata['open_monthdata'][0]['adminRole'];

$getChatData = getChatData_today_count();


  ?>
<div class="box1">
    <div class="main-logo">
        <img src="<?php echo base_url()?>assets/website/img/register_logo.png" alt="">
    </div>
    <?php if($adminRole==0){ ?>
    <div class="menu">
        <ul style="list-style-type:none;padding: 0;">
            
            <?php if($fk_coursePeriod > 0){?>
            <li class="liwebside"><a href="<?php echo base_url('website/vedicdashcourse');?>" style="<?php echo $background_color_1; ?>" class="sidenav_btn btn1">Dashboard</a></li>
            <?php }else{ ?>
             <li class="liwebside"><a href="<?php echo base_url('vedic-dash/1');?>" style="<?php echo $background_color_1; ?>" class="sidenav_btn btn1">Dashboard</a></li>
            <?php } ?>
            

        
            <?php
            
            if($promoCode!="freeeducation") {
            
            if(!empty($last_session_running)){ ?>
                <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_2; ?>" href="<?php echo base_url('website/vedic_learn/'.$last_session_running[0]['fk_monthId'].'/'.$last_session_running[0]['fk_dayId'].'/'.$last_session_running[0]['fk_classId'].'/0/his/2')?>">Learning Page</a></li>
            <?php }else{ ?>
                <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_2; ?>" href="<?php echo base_url('website/vedic_learn/1/1/'.$usersession[0]['studentClass'].'/3');?>"> Learning Page</i></a></li>
            <?php } ?>
            
            <?php 
            
                
            if($monthdata['paymentMonth']){
                $currentDate = $monthdata['paymentMonth'][0]['createDT'];
                $currentDate_add_ten_days = date('Y-m-d', strtotime($currentDate. ' + 10 days'));
                
                if($currentDate_add_ten_days <= date("Y-m-d")){
                    $hide = "display:none";
                }else{
                    $hide = "";
                }
            }else{
                $hide = "";
            }

            ?>
            <li class="liwebside" style="<?php echo $hide; ?>"><a class="sidenav_btn btn1" style="<?php echo $background_color_9; ?>" href="<?php echo base_url('website/recap/9');?>">Recap Sessions</a></li>
            <?php if(!empty($last_session_running)){ ?>
                <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_5; ?>" href="<?php echo base_url('website/vedic_value')?>">Value Based Education</a></li>
            <?php }else{ ?>
                <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_15; ?>" href="<?php echo base_url('website/vedic_value');?>"> Value Based Education</i></a></li>
            <?php } ?>
            <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_14; ?>" href="<?php echo base_url('website/open_previous_month/14');?>"> Open Previous Month </i></a></li>
            <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_16; ?>" href="<?php echo base_url('vedic-homework/16');?>">Homework</i></a></li>
            <?php } ?>
        </ul>
    </div>
    <?php } elseif($adminRole==1) { 
      if($promoCode !="freeEducation") {
    ?>
    <div class="menu">
        <ul style="list-style-type:none;padding: 0;">
            <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_6; ?>" href="<?php echo base_url('website/vedicpayment/6');?>">Payment </a></li>
            <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_7; ?>" href="<?php echo base_url('website/payment_his/7');?>">Payment History</a></li>
            <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_8; ?>" href="<?php echo base_url('vedic-progress-tracker/8');?>">Progress Tracker</a></li>
            <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_4; ?>" href="<?php echo base_url('website/vedicprofile/4')?>">Profile Page</a></li>
            <!--<li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_19; ?>" href="<?php echo base_url('website/viewreportcard/19')?>">Report Card</a></li>-->
            <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_12; ?>" href="<?php echo base_url('chat-with-teacher/12')?>">chat with teacher <span class="badge badge-danger badge-pill"><?php echo count($getChatData); ?></span></a></li>
        </ul>
    </div>
    <?php } } ?>
</div>


