<?php
    $usersession    = $this->session->userdata('usersession');
    // echo '<pre>';print_r($usersession);
?>
<!DOCTYPE html>
<html lang="zxx">
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
    }
    .panel-footer {
        padding: 10px 15px;
        background-color: rgb(245 245 245);
        border-top: 1px solid rgb(221 221 221);
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
    }
</style>
<!-- Vedic Teacher header files Start -->
<?php $this->load->view('teacher_header'); ?>
<!-- Vedic Teacher header files End -->
</head>
<body>
<?php
$tbl_notification_live_class_teacher   = tbl_notification_live_class_teacher();
    //  echo '<pre>';print_r($tbl_notification_live_class_teacher);
$microsoft_link     = "";
$dbstart_time       = "";
$dbendtime          = "";
$time               = "";
$cuurentTime        = "";
if($tbl_notification_live_class_teacher){
    date_default_timezone_set('Asia/Kolkata');
    $time            = time();
    $start_date      = $tbl_notification_live_class_teacher[0]['start_date'];
    $end_date        = $tbl_notification_live_class_teacher[0]['end_date'];
    $remove_2_minite = $tbl_notification_live_class_teacher[0]['start_time'];
    $dbstart_time    = strtotime($tbl_notification_live_class_teacher[0]['start_time']);
    $dbendtime       = strtotime($tbl_notification_live_class_teacher[0]['end_time']);
    $cuurentTime     = strtotime(date("g:ia"));
    $microsoft_link = $tbl_notification_live_class_teacher[0]['microsoft_link'];
} else {
    $microsoft_link = "#"; 
}
if($cuurentTime!="" && $dbstart_time!="" ){
    if ($cuurentTime >= $dbstart_time &&  $cuurentTime <= $dbendtime) { ?>
    <div class="overlay">
       <div id="popup" class="popup panel panel-primary">
           <a href="<?php echo $microsoft_link; ?>" target="_blank">
               <img class="live-popup-img" src="<?php echo base_url()?>assets/website/img/live_sessions.png" alt="popup">
           </a>
           <div class="d-flex justify-content-between panel-footer" style="background: #fff; top:-9px;position: relative;">
               <button id="close" class="btn btn-lg btn-primary">Close</button>
               <div>From: <span class="mr-5" style="color: #626ed4;font-weight: 700;"><?php echo $tbl_notification_live_class_teacher[0]['start_time'] ; ; ?></span> To: <span style="color: #626ed4;font-weight: 700;"><?php echo $tbl_notification_live_class_teacher[0]['end_time'] ; ?></span></div>
           </div>
       </div>
    </div>
<?php } } ?>
<?php $this->load->view('mobilemenu'); ?>
    <div class="boxes">
    <?php $this->load->view('teachersidebar'); ?>
        <div class="box11 animated_hero" style="background: #695FFE;">
            <div class="box-inside">
                <div class="desktop-mobile-view">
                    <!-- //top header -->
                    <?php $this->load->view('teacher_topheader'); ?>
                    <!-- //end top header -->
                    <!-- <div class="d-flex justify-content-end mb-3">
                        <div class="create-session-button">
                            <a href="<?php echo base_url()?>teacher/livesession">
                                <i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Create Live Session
                            </a>
                        </div>
                    </div> -->
                    <div class="teacher-dash-view">
                        <div class="live-learning-notification-img">
                            <a href="#"><img class="live-session-img" src="<?php echo base_url()?>assets/website/img/live_sessions.png" alt="popup"></a>
                        </div>
                        <div class="sub-box-dash-view">
                            <div class="sub-box-view">
                                
                                <div class="details">
                                    <a href="<?php echo base_url()?>teacher/livesession">
                                        <div class="create-session"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Create Live Session</div>
                                    </a>
                                </div>
                                
                                <div class="details">
                                    <a href="<?php echo base_url()?>teacher/livesessionfree">
                                        <div class="create-session"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Create Live Stream</div>
                                    </a>
                                </div>
                            </div>
                               <div class="sub-box-view">
                                <div class="img">
                                    <div>
                                     <a href="<?php echo base_url('teacher/common_video/1/1/'.$usersession[0]['teacherClass'] ); ?> ">
                                            <img src="<?php echo base_url()?>assets/website/img/teacher_view/allocated-students.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="details">
                                    <a href="<?php echo base_url('teacher/common_video/1/1/'.$usersession[0]['teacherClass'] ); ?> ">
                                        <div class="create-session"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Welcome Videos</div>
                                    </a>
                                </div>
                            </div>
                             <div class="sub-box-view">
                                <div class="img">
                                    <div>
                                        <a href="">
                                            <img src="<?php echo base_url()?>assets/website/img/teacher_view/allocated-students.png" alt="">
                                        </a>
                                    </div>
                                </div>
                             <div class="details">
                                <a href="<?php echo base_url()?>api_zoom/zoom_meetings">
                                    <div class="create-session"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Meetings</div>
                                </a>
                            </div>
 
                            </div>
                            <div class="sub-box-view">
                                <div class="img">
                                    <div>
                                        <a href="<?php echo base_url('teacher/viewteacher');?>">
                                            <img src="<?php echo base_url()?>assets/website/img/teacher_view/allocated-students.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="details">
                                    <a href="<?php echo base_url('teacher/viewteacher');?>">
                                        <div class="create-session"><i class="fa fa-users mr-2" aria-hidden="true"></i>Allocated Session</div>
                                        <div class="number-allocated"><i class="mdi mdi-arrow-up text-success ml-2"></i>2</div>
                                    </a>
                                </div>
                            </div>
                           
                        </div>
                        <div class="bottom-box-dash-view">
                            <div class="bottom-box-view" style="pointer-events: none;">
                            <div class="img">
                                    <div>
                                        <a href="">
                                            <img src="<?php echo base_url()?>assets/website/img/teacher_view/allocated-students.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="details">
                                    <a href="">
                                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">ALLOCATED STUDENT</h5>
                                        <h4 class="font-weight-medium font-size-24"> 
                                            <?php if(!empty($count_student)){ 
                                                echo $count_student;
                                                }else{
                                                    echo "0";
                                            }?>  
                                            <i class="mdi mdi-arrow-down text-danger ml-2"></i>
                                        </h4>
                                    </a>
                                </div>
                            </div>
                            <div class="bottom-box-view" style="pointer-events: none;">
                                <div class="img">
                                    <div>
                                        <a href="">
                                            <img src="<?php echo base_url()?>assets/website/img/teacher_view/allocated-students.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="details">
                                    <a href="">
                                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">ALLOCATED STUDENT</h5>
                                        <h4 class="font-weight-medium font-size-24"> 
                                            <?php if(!empty($count_student)){ 
                                                echo $count_student;
                                                }else{
                                                    echo "0";
                                            }?>  
                                            <i class="mdi mdi-arrow-down text-danger ml-2"></i>
                                        </h4>
                                    </a>
                                </div>
                            </div>
                            <div class="bottom-box-view" style="pointer-events: none;">
                            <div class="img">
                                    <div>
                                        <a href="">
                                            <img src="<?php echo base_url()?>assets/website/img/teacher_view/allocated-students.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="details">
                                    <a href="">
                                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">ALLOCATED STUDENT</h5>
                                        <h4 class="font-weight-medium font-size-24"> 
                                            <?php if(!empty($count_student)){ 
                                                echo $count_student;
                                                }else{
                                                    echo "0";
                                            }?>  
                                            <i class="mdi mdi-arrow-down text-danger ml-2"></i>
                                        </h4>
                                    </a>
                                </div>
                            </div>
                            <div class="bottom-box-view" style="pointer-events: none;">
                            <div class="img">
                                    <div>
                                        <a href="">
                                            <img src="<?php echo base_url()?>assets/website/img/teacher_view/allocated-students.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="details">
                                    <a href="">
                                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">ALLOCATED STUDENT</h5>
                                        <h4 class="font-weight-medium font-size-24"> 
                                            <?php if(!empty($count_student)){ 
                                                echo $count_student;
                                                }else{
                                                    echo "0";
                                            }?>  
                                            <i class="mdi mdi-arrow-down text-danger ml-2"></i>
                                        </h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="<?php echo base_url()?>assets/js/bootstrap-notify.js"></script>
    
<script type="text/javascript">
        type = ['','info','success','warning','danger'];
</script>
<script>

$(document).ready( function () {
    $('#myTable').DataTable();
    stateSave: true
} );
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
        setTimeout(function() {
            window.location.href = '<?php echo base_url('website/vedicprofile/4')?>';
          }, 2000);
    </script>
<?php } ?>
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
    
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>
