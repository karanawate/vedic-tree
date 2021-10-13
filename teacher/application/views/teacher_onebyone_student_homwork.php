<?php
    $usersession    = $this->session->userdata('usersession');
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
  <style>
       .download-each { 
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(12rem, 1fr));
        grid-gap: 20px;
     }
     .download-each .download-file {
        position: relative;
    }
    .download-each .download-file i {
        position: absolute;
        color: #000;
        top: 30%;
        left: 40%;
        font-size: 40px;
    }
    .download-each .download-file img {
        width: 200px;
        height: 140px;
        border: 1px solid #ccc;
        box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.3);
        max-width: 100%;
        opacity: 0.3;
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
                    <h2>Homework Download </h2>
                    <!--<div class="container mt-5">-->
                    <!--    <div class="grid">-->
                    <!--        <?php foreach($homework_one_byone_download as $view_file) { ?>-->
                    <!--        <div  class="d-flex flex-row mb-3">-->
                    <!--            <a  download  href="https://www.vedictreeschool.com/uploads/homework_allocated_student/<?php echo str_replace(' ', '_', $view_file['allocated_file']) ?>"   >-->
                                    
                    <!--              <img download target="_blank"  class="img-rounded" width="80" src="https://www.vedictreeschool.com/uploads/homework_allocated_student/<?php echo str_replace(' ', '_', $view_file['allocated_file']) ?>" />-->
                    <!--            </a>-->
                    <!--       </div>-->
                    <!--       <?php  } ?>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="download-each">
                        <?php foreach($homework_one_byone_download as $view_file) { ?>
                        <div class="download-file">
                            <?php 
                                $info = new SplFileInfo($view_file['allocated_file']);
                                $pdfextension = $info->getExtension();
                            ?>
                            <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
                            <?php if($pdfextension =='pdf'){ ?>
                                <a download href="https://www.vedictreeschool.com/uploads/homework_allocated_student/<?php echo str_replace(' ', '_', $view_file['allocated_file']) ?>" title="ImageName">
                                    <img style="object-fit: contain;" class="img-rounded" src="https://www.vedictreeschool.com/uploads/homework_allocated_student/pdf-common-file.png" />
                                </a>
                            <?php } else { ?> 
                                <a download href="https://www.vedictreeschool.com/uploads/homework_allocated_student/<?php echo str_replace(' ', '_', $view_file['allocated_file']) ?>" title="ImageName">
                                    <img class="img-rounded" src="https://www.vedictreeschool.com/uploads/homework_allocated_student/<?php echo str_replace(' ', '_', $view_file['allocated_file']) ?>" />
                                </a>
                            <?php }?>
                        </div>
                        <?php }?>
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

<script>
     $(".upload-form-remark").submit(function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        $.ajax({
            url: '<?php echo site_url('teacher/teacher_remark_to_student'); ?>',
            type: 'POST',
            data: fd,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
            console.log(data);
            $("#resultDiv").html(data.success_msg).show();
            },
            error: function (data) {
                //  todo the logic
            }
        });
    });

</script>


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
<script>
$(document).ready(function() {
    $(".dates-loop:first").addClass('active');
    $(".dates-loop .fa:first").removeClass("fa-plus").addClass('fa-minus');
    $(".content").hide();
    $(".content").first().show();
    $(".hw-set > .dates-loop").on("click", function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).siblings(".content").slideUp(200);
            $(".hw-set > .dates-loop i").removeClass("fa-minus").addClass("fa-plus");
        } else {
            $(".hw-set > .dates-loop i").removeClass("fa-minus").addClass("fa-plus");
            $(this).find("i").removeClass("fa-plus").addClass("fa-minus");
            $(".hw-set > .dates-loop").removeClass("active");
            $(this).addClass("active");
            $(".content").slideUp(200);
            $(this).siblings(".content").slideDown(200);
        }
    });
});
</script>