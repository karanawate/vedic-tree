<?php

    $usersession    = $this->session->userdata('usersession');
    $studentName    = $usersession[0]['studentName'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp); 
    $fk_classId     = $usersession[0]['studentClass'];
    $className      = "";
    if($fk_classId==1){
        $className =  "Nursery";
    }elseif($fk_classId==2){
        $className =  "Junior Kg";
    }elseif($fk_classId==3){
        $className =  "Senior Kg";
    }else{
        $className = "No Class Allowed";
    }

?>
<style>
    .navigation {
  width: 100%;
  background-color: black;
}

img {
  width: 30px;
  float: left;
}

.logout {
    font-size: 14px;
    font-weight: 500;
    position: relative;
    color: black;
    right: -8px;
    bottom: -5px;
    overflow: hidden;
    letter-spacing: 3px;
    opacity: 1;
    transition: opacity .45s;
    -webkit-transition: opacity .35s;
  
}

.button {
    display: flex;
    float: right;
    padding: 5px;
    margin: 15px;
    width:120px;
    background-color: balck;
    transition: width .35s;
    -webkit-transition: width .35s;
    overflow: hidden;
    border-radius: 20px;
    box-shadow: 1px 1px 3px 1px rgb(0 0 0 / 20%);
}


a {
  text-decoration: none;
}
.important-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
}
.notifications {
    display: flex;
    justify-content: center;
}
</style>
<div class="box2">
    <div class="profile-info">
        <div class="username">Hello &nbsp;<span><?php echo ucwords($studentName); ?></span></div>
        <div class="date" style="font-family: 'Source Sans Pro', sans-serif;">Date:<span class="mx-2"><?php echo $newDate; ?></span></div>
        <div class="date" style="font-family: 'Source Sans Pro', sans-serif;">Class:<span class="mx-2"><?php echo $className; ?></span></div>
    </div>
    <div class="important-actions">
        <div class="logout-view">
            <div class="navigation">
                <a class="button" href="<?php echo base_url('website/logout');?>"><img src="<?php echo base_url()?>assets/website/img/logout.jpg"><span class="logout">LOGOUT</span></a>
            </div>
        </div>
        <div class="notification">
            <div class="dropdown">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-bell-outline "></i>
                    <span class="badge badge-danger badge-pill blink_me ">
                        <?php         
                             $notification = notification();
                             $tbl_notification_live_class = tbl_notification_live_class();

                             $combinearray = array();
                             if(!empty($tbl_notification_live_class) && !empty($notification)){
                                $mergrarray = array_merge($tbl_notification_live_class,$notification);
                             }else{
                                if($notification){

                                        $mergrarray = $notification;
                                    }else{
                                        $mergrarray = $tbl_notification_live_class;

                                    }
                             }

                             foreach ($mergrarray as $key => $value) {
                                 if(isset($value['microsoft_link'])){
                                    $microsoft_link = $value['microsoft_link']; 
                                 }else{
                                    $microsoft_link = "";
                                 }
                                 if(isset($value['noticedesc'])){
                                    $noticedesc = $value['noticedesc']; 
                                 }else{
                                    $noticedesc = "";
                                 }
                                $combinearray[] = array($value,'microsoft_link'=>$microsoft_link,'noticedesc'=> $noticedesc);
                             }

                                $notification_count = count($combinearray);

                                if(isset($notification_count))
                                {
                                     echo  $notification_count = $notification_count; 
                                }else{
                                      echo $notification_count = '0';
                                }
                        ?> 
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col ">
                                <?php 

                            $notification = notification();
                             $tbl_notification_live_class = tbl_notification_live_class();

                             $combinearray = array();
                             if(!empty($tbl_notification_live_class) && !empty($notification)){
                                $mergrarray = array_merge($tbl_notification_live_class,$notification);
                             }else{
                                if($notification){

                                        $mergrarray = $notification;
                                    }else{
                                        $mergrarray = $tbl_notification_live_class;

                                    }
                             }

                             foreach ($mergrarray as $key => $value) {
                                 if(isset($value['microsoft_link'])){
                                    $microsoft_link = $value['microsoft_link']; 
                                 }else{
                                    $microsoft_link = "";
                                 }
                                 if(isset($value['noticedesc'])){
                                    $noticedesc = $value['noticedesc']; 
                                 }else{
                                    $noticedesc = "";
                                 }
                                $combinearray[] = array($value,'microsoft_link'=>$microsoft_link,'noticedesc'=> $noticedesc);
                             }

                                $notification_count = count($combinearray);
                                if(isset($notification_count)){   $notification_count = $notification_count; } else { $notification_count = '0'; } ?>
                                <h5 class="m-0 font-size-16 "> Notifications (<?php echo $notification_count; ?>) </h5>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;overflow-y: scroll;">
                        <?php
                             $notification = notification();
                             $tbl_notification_live_class = tbl_notification_live_class();

                             $combinearray = array();
                             if(!empty($tbl_notification_live_class) && !empty($notification)){
                                $mergrarray = array_merge($tbl_notification_live_class,$notification);
                             }else{
                                if($notification){

                                        $mergrarray = $notification;
                                    }else{
                                        $mergrarray = $tbl_notification_live_class;

                                    }
                             }

                             foreach ($mergrarray as $key => $value) {
                                 if(isset($value['microsoft_link'])){
                                    $microsoft_link = $value['microsoft_link']; 
                                 }else{
                                    $microsoft_link = "";
                                 }
                                 if(isset($value['noticedesc'])){
                                    $noticedesc = $value['noticedesc']; 
                                 }else{
                                    $noticedesc = "";
                                 }
                                $combinearray[] = array($value,'microsoft_link'=>$microsoft_link,'noticedesc'=> $noticedesc);
                             }

                            if(!empty($combinearray)){
                                foreach ($combinearray as $key => $value) {
                        ?>
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="media-body" style="padding:12px;">
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1 "><?php echo $value['noticedesc']; ?></p>
                                        <p class="mb-1 "><a href="<?php echo $value['microsoft_link'];?>" target="_blank"> Click Here For Join Today Session</a></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-img">
        <div class="">
            <?php 

            if(!empty($usersession[0]['usr_profile'])){
                $usr_profile = $usersession[0]['usr_profile'];
            }else{
                $usr_profile = "about_img_3.png";
            }
            ?>
            <img src="<?php echo base_url('uploads/studetprofile/')?><?php echo $usr_profile;?>" style="width:100px; height:100px; border-radius: 100px;">
        </div>
    </div>
</div>
     
