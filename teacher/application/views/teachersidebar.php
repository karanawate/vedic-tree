<?php
   $usersession = $this->session->userdata('usersession');
   $adminRole = $usersession[0]['teacher_status'];
?>
<style>
    .arrow-dropdown {
        position: absolute;
        right: 0;
        margin: -3px 15px 0px 0;
    }
    .sub-liwebside {
        background: rgba (255, 255, 255, 0.1);
        /*display: none;*/
    }
    .rotate {
        transform: rotate(90deg);
    }
</style>
<div class="box1" style="background: #695FFE;">
   <div class="main-logo">
      <img src="<?php echo base_url()?>assets/website/img/register_logo.png" alt="">
   </div>
   <div class="menu">
      <ul style="list-style-type:none;padding: 0;">
         <li class="liwebside">
            <a href="<?php echo base_url("teacher/teacher_dash_view");?>" class="sidenav_btn btn1"> Dashboard</a>
         </li>
         <!-- <li class="liwebside">
            <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/studentlist');?>">Student list
            </a>
         </li> -->
         
         <?php if($adminRole == 4) {?>
           <li class="liwebside">
            <a href="<?php echo base_url("teacher/course_seven");?>" class="sidenav_btn btn1"> Learning Page</a>
         </li>
         <?php } else{ ?>
          <li class="liwebside">
            <a href="<?php echo base_url("vedic-dash/1");?>" class="sidenav_btn btn1"> Learning Page</a>
         </li>
         <?php  } ?>
         
         
        <li class="liwebside">
            <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/recap');?>">Recap Session</a>
         </li>
         <li class="liwebside">
            <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/substudentlist');?>">Student list</a>
         </li>
         <!--<li class="liwebside">-->
         <!--   <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/sub_att');?>">Batchwise Attendence</a>-->
         <!--</li>-->
         <!-- <li class="liwebside">
            <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/attendance');?>">Student Attendance
            </a>
         </li> -->
         <!--<li class="liwebside">-->
         <!--   <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/final_studentlist_attedence');?>">View Student Attendance-->
         <!--   </a>-->
         <!--</li>-->
         
         <!-- <li class="liwebside">
            <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/livesession');?>">Create  Live Session
            </a>
         </li> -->
         <!-- <li class="liwebside">
            <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/viewteacher');?>">Allocated Live Session
            </a>
         </li> -->
         <li class="liwebside">
            <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/teacher_attedence');?>">Teacher Attendance</a>
         </li>
         <li class="liwebside">
            <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/teacher_profile');?>">Profile</a>
         </li>
         <li class="liwebside">
            <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/chat_studentlist_package');?>">Chat</a>
         </li>

         <!--<li class="liwebside">-->
         <!--   <a class="sidenav_btn btn1"  href="<?php echo base_url('api_zoom/zoom_meetings');?>">Meetings</a>-->
         <!--</li>-->
         <!-- <li class="liwebside">
            <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/vedic_learn/1/1/1');?>">Learning Page
            </a>
         </li> -->
         <!-- <li class="liwebside">
            <a class="sidenav_btn btn1"  href="<?php echo base_url('teacher/vedic_learn');?>">Homework Allcocated</a>
         </li> -->
         
        <li class="liwebside">
            <a class="sidenav_btn btn1 sub-btn">Report-card <span class="fas fa-caret-right arrow-dropdown"></span></a>
            <ul style="list-style-type:none;padding: 0px;" class="sub-menu">
                <li class="sub-liwebside"><a href="<?php echo base_url("teacher/substudentlist_reportcard");?>" class="sidenav_btn btn1" style="padding-left: 20px;">Student list-reportcard</a></li>
                <li class="sub-liwebside"><a href="<?php echo base_url("teacher/teacher_signature");?>" class="sidenav_btn btn1" style="padding-left: 20px;">Teacher-signature</a></li>
               
            </ul>
        </li>

         <li class="liwebside">
            <a href="<?php echo base_url("teacher/view_locking_days");?>" class="sidenav_btn btn1"> View Unlocking Days</a>
         </li>
         
        
         
         
         <li class="liwebside">
            <a class="sidenav_btn btn1 sub-btn">Homework <span class="fas fa-caret-right arrow-dropdown"></span></a>
            <ul style="list-style-type:none;padding: 0px;" class="sub-menu">
                <li class="sub-liwebside"><a href="<?php echo base_url("teacher/homework_package_list");?>" class="sidenav_btn btn1" style="padding-left: 20px;">Homework Allocate</a></li>
                <li class="sub-liwebside"><a href="<?php echo base_url("teacher/homework_package_list_after_check_view");?>" class="sidenav_btn btn1" style="padding-left: 20px;">Homework list show</a></li>
                <!--<li class="sub-liwebside"><a href="#" class="sidenav_btn btn1" style="padding-left: 20px;">Hello 3</a></li>-->
            </ul>
        </li>
        

        
        <li class="liwebside" style="display:none">
            <a class="sidenav_btn btn1 sub-btn">Course Video <span class="fas fa-caret-right arrow-dropdown"></span></a>
            <ul style="list-style-type:none;padding: 0px;" class="sub-menu">
                <li class="sub-liwebside"><a href="<?php echo base_url("teacher/course_three");?>" class="sidenav_btn btn1" style="padding-left: 20px;">Course 3</a></li>
                <li class="sub-liwebside"><a href="<?php echo base_url("teacher/course_seven");?>" class="sidenav_btn btn1" style="padding-left: 20px;">Course 7</a></li>
                <!--<li class="sub-liwebside"><a href="#" class="sidenav_btn btn1" style="padding-left: 20px;">Hello 3</a></li>-->
            </ul>
        </li>
        
      </ul>
   </div>
</div>
<script>
    $('.sub-menu').hide();
    $('.sub-btn').click(function(){
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.arrow-dropdown').toggleClass('rotate');
       });
</script>