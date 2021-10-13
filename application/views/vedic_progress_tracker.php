<?php

    $learnighours = 0;
    $percentage   = 0;
    $learnighours_count   = 0;
    $total = array();
?>
<!DOCTYPE html>
<html lang="">
<head>
    <style>
.progress-outer{
        background: #fff;
        border-radius: 50px;
        padding: 10px;
        /* margin: 10px 0; */
        box-shadow: 0 0  10px rgba(209, 219, 231,0.7);
    }
    .progress{
        height: 20px !important;
        margin: 0 !important;
        border-radius: 50px !important;
        background: #eaedf3;
    }
    .progress .progress-bar{
        border-radius: 50px;
    }
    .progress .progress-value{
        position: relative;
        left: -45px;
        top: 4px;
        font-size: 14px;
        font-weight: bold;
        color: #fff;
        letter-spacing: 2px;
    }
    .progress-bar.active{
        animation: reverse progress-bar-stripes 0.40s linear infinite !important;
    }
    @-webkit-keyframes animate-positive{
        0% { width: 0%; }
    }
    @keyframes animate-positive {
        0% { width: 0%; }
    }
    </style>
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
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/animate.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/themefy_icon/themify-icons.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/niceselect/css/nice-select.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/owl_carousel/css/owl.carousel.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/magnify_popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/progress-circle.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/81616633dd.js"></script>
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- ////////////////////////////////////////////////////////////////////// -->
</head>
<body>
    <!-- Simulate a smartphone / tablet -->
    <?php $this->load->view('mobilemenus'); ?>
    <!-- End smartphone / tablet look -->
    <div class="boxes">
        <?php $this->load->view('websitesidebar'); ?>
        <div class="box11" style="background: #695FFE;">
            <div class="box-inside">
                <div class="desktop-mobile-view">
                    <!-- //top header -->
                    <?php $this->load->view('topheader'); ?>
                    <!-- //end top header -->
                    <div class="box5">
                        <div class="progress-tracker">
                            <div class="progress-1">
                                <div class="progress-1-box">
                                    <div class="progress-header">
                                        <div class="text1">Students Progress</div>
                                        <div class="text2">*As per Sessions</div>
                                    </div>
                                    <div class="with-border"></div>
                                    <div class="progress-body">
                                    <?php
                                    if($student_daily_reports){
                                        $learnighours_count = count($student_daily_reports);
                                        foreach ($student_daily_reports as $key => $value) {
                                            // echo "<pre>";
                                            // print_r($value);

                                           $remaintime =  $value['trackDuration'] - $value['trackEndTime'];
                                           if($remaintime <= 20 )
                                           {
                                             $percentage = "100";
                                           }else{
                                             $percentage = ($value['trackEndTime'] / 60 ) ;
                                         }
                                         // * $learnighours_count
                                         $total[] = $percentage;
                                         $learnighours = $percentage / $learnighours_count;
                                    ?>  
                                        <div class="subject-progress">
                                            <div class="subject-img">
                                                <img src="<?php echo base_url()?>assets/website/img/subject/general-awareness.png" alt="">
                                            </div>
                                            <div class="subject-bar-progress">
                                                <div style="font-weight: 500;"><?php echo ucwords($value['sessionName']); ?></div>
                                                <div class="progress-outer">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($percentage); ?>%" style="width:<?php echo round($percentage); ?>%;"><?php echo round($percentage); ?>% Complete</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="percent-progress">
                                                <span><?php echo round($percentage); ?>%</span>
                                            </div>
                                        </div>
                                    <?php } } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-2">
                                <div class="progress-2-box">
                                    <div class="progress-header">
                                        <div>
                                            <div class="text1">Working Hours</div>
                                            <div class="text2">*As per Sessions</div>
                                        </div>
                                        <div style="align-self: center;">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger" style="font-size: 16px;padding: 2px 15px;font-weight: 500;">Filter</button>
                                                <button type="button" class="btn btn-danger dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" style="font-size: 14px;">
                                                    <form id="gettarckfilter" action="<?php echo base_url('website/vedic_progress_tracker'); ?>" method="post">
                                                        <input type="hidden" id="weekdata" value="" name="weekdata">
<!--                                                     <button class="dropdown-item today" type="button">Today</button>
 -->                                                    <button class="dropdown-item lastweek" type="button">Last Week</button>
                                                    <button class="dropdown-item lastmonth" type="button">Last Month</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="with-border"></div>
                                    <div class="progress-body">
                                        <div class="progress-cricle" data-percentage="<?php 
                                        if($learnighours_count > 1){
                                                 $totals = array_sum($total);
                                                $totals =  $totals / $learnighours_count.'00' * 100; 
                                                echo round($totals);

                                                }else{ echo "0"; } ?>" style="width: 230px;height: 230px;line-height: 140px;">
                                            <span class="progress-left">
                                                <span class="progress-bar" style="border-width: 20px;border-top-right-radius: 120px;border-bottom-right-radius: 120px;"></span>
                                            </span>
                                            <span class="progress-right">
                                                <span class="progress-bar" style="border-width: 20px;border-top-left-radius: 120px;border-bottom-left-radius: 120px;"></span>
                                            </span>
                                            <div class="progress-value">
                                                <div><?php
                                                if($learnighours_count > 1){
                                                 $totallearn = array_sum($total);
                                                 $totallearn =  $totallearn / $learnighours_count.'00' * 100; 
                                                echo round($totallearn);
                                                }else
                                                { echo "0"; }
                                                 ?>%<br><span>Completed</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-3">
                                <div class="progress-3-box">
                                    <div class="progress-header">
                                        <div class="text1">Live Session Attendance</div>
                                        <div class="text2">*As per daily basis</div>
                                    </div>
                                    <div class="with-border"></div>
                                    <div class="progress-body">
                                        <?php if($get_daily_live_session_presenty){ 

                                            foreach($get_daily_live_session_presenty as $value) {
                                        ?>
                                        <div class="live-attendance">
                                            <div class="live-session-details">
                                                <div>Topic Name : <?php echo $value['topicName']; ?></div>
                                                <div>Attend Time :<?php echo gmdate("H:i:s", $value['duration']); ?></div>
                                             
                                            </div>
                                            <div class="attendance">Present</div>
                                        </div>
                                        <?php } }else{ echo "No Live Attendace Available" ; }  ?>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-4">
                                <div class="progress-4-box">
                                    <div class="progress-header">
                                        <div class="text1">Categories</div>
                                        <div class="text2">*As per Sessions</div>
                                    </div>
                                    <div class="with-border"></div>
                                    <div class="progress-body ">
                                        <div>
                                            <div class="progress-cricle category-1" style="width: 140px;height: 140px;line-height: 140px;" data-percentage="<?php
                                            if($learnighours_count > 1){
                                                $totalcat1 = array_sum($total);
                                                $totalcat1 =  $totalcat1 / $learnighours_count.'00' * 100; 
                                                echo round($totalcat1);
                                            }else{ echo "0"; }
                                                 ?>">
                                                <span class="progress-left">
                                                    <span class="progress-bar" style="border-color: #cea5cb;"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar" style="border-color: #cea5cb;"></span>
                                                </span>
                                                <div class="progress-value" style="font-size: 2rem;">
                                                <div>
                                                <?php
                                                    if($learnighours_count > 1){
                                                    $totalcat = array_sum($total);
                                                    $totalcat =  $totalcat / $learnighours_count.'00' * 100; 
                                                    echo round($totalcat);
                                                }else{ echo "0"; }
                                                 ?>%<br><span style="font-size: 10px;">Completed</span></div>
                                                
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">Curricular</div>
                                        </div>
                                        <div>
                                            <div class="progress-cricle category-2" style="width: 140px;height: 140px;line-height: 140px;" data-percentage="78">
                                                <span class="progress-left">
                                                    <span class="progress-bar" style="border-color: #5ffebc;"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar" style="border-color: #5ffebc;"></span>
                                                </span>
                                                <div class="progress-value" style="font-size: 2rem;">
                                                    <div>78%<br><span style="font-size: 10px;">Completed</span></div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">Extra-Curricular</div>
                                        </div>
                                        <div>
                                            <div class="progress-cricle category-3" style="width: 140px;height: 140px;line-height: 140px;" data-percentage="78">
                                                <span class="progress-left">
                                                    <span class="progress-bar" style="border-color: #5fadfe;"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar" style="border-color: #5fadfe;"></span>
                                                </span>
                                                <div class="progress-value" style="font-size: 2rem;">
                                                    <div>78%<br><span style="font-size: 10px;">Completed</span></div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">Personality Development</div>
                                        </div>
                                        <div>
                                            <div class="progress-cricle category-4" style="width: 140px;height: 140px;line-height: 140px;" data-percentage="78">
                                                <span class="progress-left">
                                                    <span class="progress-bar" style="border-color: #fe5f5f;"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar" style="border-color: #fe5f5f;"></span>
                                                </span>
                                                <div class="progress-value" style="font-size: 2rem;">
                                                    <div>78%<br><span style="font-size: 10px;">Completed</span></div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">Value Based Education</div>
                                        </div>
                                    </div>
                                </div>
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
    $(document).ready(function(){

        $(".lastweek").click(function(){

            $("#weekdata").val('weeek');
            $("#gettarckfilter").submit();

        });

        $(".today").click(function(){

            $("#weekdata").val('today');
            $("#gettarckfilter").submit();

        });

        $(".lastmonth").click(function(){

            $("#weekdata").val('monthdata');
            $("#gettarckfilter").submit();

        });
    });
</script>