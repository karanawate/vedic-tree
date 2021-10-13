<?php
    $usersession    = $this->session->userdata('usersession');
    $teacherName    = $usersession[0]['teacherName'];
    $teacherEmail   = $usersession[0]['teacherEmail'];
    $teacherClass   = $usersession[0]['teacherClass'];
    
    $className      = "";
    if($teacherClass==1){
        $className =  "Nursery";
    }elseif($teacherClass==2){
        $className =  "Junior Kg";
    }elseif($teacherClass==3){
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
/* 
.form-control
{
        font-size: 13px;
        height: 35px;
} */
.name_profile{
    font-size: 40px;
    font-weight: 800;
    color: #f17373;
}
.date_profile{
    color: #f17373;
    font-weight: 500;
    font-size: 15px;
}
</style>
<div class="box2">
    <div class="profile-info">
        <div class="name_profile">Hello <span><?php echo ucwords($teacherName); ?></span></div>
        <div class="date_profile">Date:<span class="mx-2"><?php  echo date('d-m-Y');  ?></span></div>
        <div class="date_profile">Class:<span class="mx-2"><?php  echo ucwords($className);  ?></span></div>
    </div>
    <div class="important-actions">
        <div class="logout-view">
            <div class="navigation">
                <a class="button" href="<?php echo base_url('teacher/logout');?>"><img src="<?php echo base_url()?>assets/website/img/logout.jpg"><span class="logout">LOGOUT</span></a>
            </div>
        </div>
        <div class="notification">
            <div class="dropdown">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-bell-outline "></i>
                    <span class="badge badge-danger badge-pill blink_me ">
                        0
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
            <!-- <img  src="https://ui-avatars.com/api/?bold=true&background=random&name=<?php echo $teacherName ?>%22"  style="width:83px; height:83px; border-radius: 100px;"> -->
        </div>
    </div>
</div>
     
