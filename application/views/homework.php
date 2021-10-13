<?php

    $usersession     = $this->session->userdata('usersession');
    $studentName     = $usersession[0]['studentName'];
    $studentEmail    = $usersession[0]['studentEmail'];
    $studentMobile   = $usersession[0]['studentMobile'];
    $fk_classId      = $usersession[0]['studentClass'];
    $studId          = $usersession[0]['studId'];
    $unloacdayFromdb = check_user_state($studId);
    $unlockdayId     = $unloacdayFromdb[0]['unlockdayId'];
    $unlock_monthId  = $unloacdayFromdb[0]['unlock_monthId'];
    $begin = new DateTime( "2021-09-01" );
    $end   = new DateTime( "2021-09-30" );
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
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/upload-file.css" />
    <!--<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/81616633dd.js"></script>
    
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
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
        }else{
            $microsoft_link = "#"; 
        }
        if($cuurentTime!="" && $dbstart_time!="" ){
            if ($cuurentTime >= $dbstart_time &&  $cuurentTime <= $dbendtime) {
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
    <?php } } if(!empty($getnotifictaion_for_after_free_month_complte)) { ?>
    <div class="overlay">
        <div id="popup" class="popup panel panel-primary">
            <div class="panel-footer" style="background: #fff">
                <div>
                Your Plan will  Expired Today For Continue Upgrade it.</div>
                <button id="close" class=" float-right btn btn-sm btn-primary">Close</button>
            </div>
        </div>
    </div>
    <?php } ?>
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
                    <h2>Homework</h2>
                    <div class="accordion-container">
                        <!--<?php  print_r($student_homeworks);?>-->
                        <div id="resultDiv" class="alert alert-success" role="alert" style="display:none">
                        </div>
                        <?php foreach($student_homeworks as $homework){ ?>
                        <div class="hw-set" >
                            <div id="<?php echo $homework['homework_id']; ?>" class="dates-loop form_open"><?php echo $homework['start_time'] ?><i class="fa fa-plus"></i></div>
                            <div class="content">
                                <div class="homework-grid">
                                    <div class="details-down">
                                        <div class="hw-dates">
                                            <div class="start-date">Start Date: <span><?php echo $homework['start_time'] ?></span></div>
                                            <div class="end-date">End Date: <span><?php echo $homework['end_time'] ?></span></div>
                                        </div>
                                        
                                        <form method="post" action="<?php echo base_url('website/download_homework_view'); ?>">
                                            <input type="hidden" value="<?php echo $homework['start_time'] ?>" name="start_time" />
                                            <input type="hidden" value="<?php echo $homework['fk_feesId'] ?>" name="fk_feesId" />
                                            <div class="hw-down"><button class="download">Download<i class="ml-3 fa fa-download" aria-hidden="true"></i><i class="ml-3 fa fa-arrow-circle-down" aria-hidden="true"></i></button></div>
                                        </form>
                                        
                                        <!--<form method="post" action="<?php echo base_url('website/download_homework'); ?>">-->
                                        <!--    <input type="hidden" value="<?php echo $homework['start_time'] ?>" name="start_time" />-->
                                        <!--    <div class="hw-down"><button class="download">Download<i class="ml-3 fa fa-download" aria-hidden="true"></i><i class="ml-3 fa fa-arrow-circle-down" aria-hidden="true"></i></button></div>-->
                                        <!--</form>-->
                                    </div>
                                    <div>
                                        <div>Title: <span><?php echo $homework['home_title'] ?></span></div>
                                        <div>Description: <span><?php echo $homework['description'] ?></span></div>
                                    </div>
                                    <div>
                                        <h4>Upload Homework</h4>
                                        <form class="upload-form"  id="upload-form" method="POST" enctype="multipart/form-data">
                                            <div><input type="file" name="file_allocated[]"  multiple class="filepond"  required data-max-file-size="3MB"/></div>
                                            <input type="hidden" value="<?php echo $homework['start_time'];  ?>" name="start_time" />
                                            <input type="hidden" value="<?php echo $homework['homework_id'];  ?>" name="homework_id" />
                                            <input type="hidden" value="<?php echo $homework['fk_feesId'];  ?>" name="fk_feesId" />
                                            <input type="hidden" value="<?php echo $homework['class_id'];  ?>" name="class_id" />
                                            <input type="hidden" value="<?php echo $homework['home_title'];  ?>" name="home_title" />
                                            <div class="hw-up"><button type="submit" class="upload">Upload<i class="ml-3 fa fa-upload" aria-hidden="true"></i><i class="ml-3 fa fa-arrow-circle-up" aria-hidden="true"></i></button></div>
                                        </form>
                                        
                                    </div>
                                    <div>
                                        <div>Teacher's Remark</div>
                                        <div id="resultDivvv"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</body>
</html>
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
<script>
    $(document).ready(function(){
        $(".upload-form").submit(function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        $.ajax({
            url: '<?php echo site_url('website/response_back_homework'); ?>',
            type: 'POST',
            data: fd,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
            console.log(data);
                $("#resultDiv").html(data.success).show();
                setTimeout(function(){
                   window.location.reload(1);
                }, 5000);
            },
            error: function (data) {
                
            }
        });
    });
    $(".form_open").click(function(){
        var homework_id = this.id;
        $.ajax({
            url: '<?php echo base_url('website/response_remark_studentt'); ?>',
            type: "post",
            cache: false,
            data: { 'homework_id' : homework_id},
            success: function (data) {
              $("#resultDivvv").html(data);
             console.log(data);
            },
            error: function (data) {
                //  todo the logic
            }
        });
    });
});
</script>

	