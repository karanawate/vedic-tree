<?php
 $usersession    = $this->session->userdata('usersession');
 $adminRole      = $usersession[0]['adminRole']; 
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
  }elseif (isset($background_color_id)  && $background_color_id==0) {
      $background_color_2 = $background_color;
  }
  else
  {
     $background_color = "";
  }


  ?>
<div class="box1" style="background: #695FFE;">
<div class="main-logo">
        <img src="<?php echo base_url()?>assets/website/img/register_logo.png" alt="">
</div>
    <div class="menu">
        <ul style="list-style-type:none;padding: 0;">
            <li class="liwebside"><a href="<?php echo base_url('vedic-dash/1');?>" style="<?php echo $background_color_1; ?>" class="sidenav_btn btn1"> Dashboard</a></li>
            <?php if(!empty($last_session_running)){ ?>
                <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_2; ?>" href="<?php echo base_url('website/vedic_learn/'.$last_session_running[0]['fk_monthId'].'/'.$last_session_running[0]['fk_dayId'].'/'.$last_session_running[0]['fk_classId'].'/0/his/2')?>">
                Learning Page</a></li>
            <?php }else{ ?>
                <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_3; ?>" href="<?php echo base_url('website/vedic_learn/1/1/'.$usersession[0]['studentClass'].'/3');?>"> Learning Page</i>
                </a></li>
            <?php } ?>

            <?php if($adminRole!=2){ ?>
            <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_9; ?>" href="<?php echo base_url('website/recap/9');?>">Recap Sessions</a></li>
            <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_4; ?>" href="<?php echo base_url('website/vedicprofile/4')?>">Profile Page</a></li>

            <?php if(!empty($last_session_running)){ ?>
                <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_5; ?>" href="<?php echo base_url('website/vedic_value/'.$last_session_running[0]['fk_monthId'].'/'.$last_session_running[0]['fk_dayId'].'/'.$last_session_running[0]['fk_classId'].'/0/his/5')?>">
                Value Based Education</a></li>
            <?php }else{ ?>
                <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_10; ?>" href="<?php echo base_url('website/vedic_value/1/1/'.$usersession[0]['studentClass'].'/5');?>"> Value Based Education</i>
                </a></li>
            <?php } ?>
            <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_6; ?>" href="<?php echo base_url('website/vedicpayment/6');?>"> Payment </a></li>
            <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_7; ?>" href="<?php echo base_url('website/payment_his/7');?>"> Payment History</a></li>
            <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_8; ?>" href="<?php echo base_url('vedic-progress-tracker/8');?>"> Progress Tracker</a></li>
           <?php }elseif($adminRole==2){ ?>           
           <li class="liwebside"><a class="sidenav_btn btn1" style="<?php echo $background_color_9; ?>" href="<?php echo base_url('website/recap/9');?>">Recap Sessions</a></li>
           <?php } ?>
        </ul>
    </div>
</div>


