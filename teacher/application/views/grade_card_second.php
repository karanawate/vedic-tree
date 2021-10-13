<!DOCTYPE html>
<html lang="zxx">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Vedic Tree Invoice</title>
    <!-- Bootstrap CSS -->
    <link rel="icon" href="img/favicon.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/bootstrap.min.css" />
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/fontawesome/css/all.min.css" />
    <!-- style CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/payment.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/reportcard.css" />
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>
<body>
    <div class="page main-report" size="A4" style="position: relative;">
        <div class="p-5">
            <div style="position: absolute;bottom: 22%;left: 44%;font-size: 22px;">2021-2022</div>
            <div style="position: absolute;bottom: 18%;left: 44%;font-size: 22px;"><?php echo $userreport_detail_second[0]['studentName'] ?></div>
            
             <?php if($userreport_detail_second[0]['className'] == 1){ ?>
                <div style="position: absolute;bottom: 14%;left: 44%;font-size: 22px;">Nursary kg</div>
            <?php  }elseif($userreport_detail_second[0]['className'] == 2) {?>
                 <div style="position: absolute;bottom: 14%;left: 44%;font-size: 22px;">Juniar kg</div>
               <?php }elseif($userreport_detail_second[0]['className'] == 3){?>
                  <div style="position: absolute;bottom: 14%;left: 44%;font-size: 22px;">Senior kg</div>
            <?php } ?>
            
        </div>
    </div>
    <div class="mb-2"></div>
    <div class="page background-report-1" size="A4">
        <div class="p-5">
            <div class="headline-one">
                <div id="triangle-left"></div>
                <div class="text-one">SOCIO-EMOTIONAL DEVELOPMENT</div>
                <div id="triangle-right"></div>
            </div>
            <div class="mt-3 text-two">MY TEACHER SAYS...</div>
            <div>
            <div class="report-grid mt-3">
                <div class="first-row-one">
                    <div class="first">
                        <img src="<?php echo base_url()?>assets/website/img/report/enjoy-work.png" alt="">
                    </div>
                    <div class="second">
                        <div class="grade-grid">
                            <div>1st</div>
                            <div class="d-flex justify-content-center">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['first_que'] ?>" readonly>
                            </div>
                        </div>
                        <div class="grade-grid">
                            <div class="d-flex justify-content-center">2nd</div>
                            <div class="justify-self-center">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['sefirst_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="third">
                        I enjoy my work
                    </div>
                </div>
                <div class="first-row-two">
                    <div class="first">
                        <img src="<?php echo base_url()?>assets/website/img/report/play.png" alt="">
                    </div>
                    <div class="second">
                        <div class="grade-grid">
                            <div>1st</div>
                            <div class="d-flex justify-content-center">
                                <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['second_que'] ?>" readonly>
                            </div>
                        </div>
                        <div class="grade-grid">
                            <div class="d-flex justify-content-center">2nd</div>
                            <div class="justify-self-center">
                                <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['sesecond_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="third">
                        I love to play
                    </div>
                </div>
            </div>
            <hr>
            <div class="report-grid mt-3">
                <div class="first-row-one">
                    <div class="first">
                        <img src="<?php echo base_url()?>assets/website/img/report/freely.png" alt="">
                    </div>
                    <div class="second">
                        <div class="grade-grid">
                            <div>1st</div>
                            <div class="d-flex justify-content-center">
                                <input type="text" class="ip3" value="<?php echo $userreport_detail_second[0]['third_que'] ?>" readonly>
                            </div>
                        </div>
                        <div class="grade-grid">
                            <div class="d-flex justify-content-center">2nd</div>
                            <div class="justify-self-center">
                                <input type="text" class="ip3" value="<?php echo $userreport_detail_second[0]['sethird_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="third">
                        I do physical exercise everday
                    </div>
                </div>
                <div class="first-row-two">
                    <div class="first">
                        <img src="<?php echo base_url()?>assets/website/img/report/independent.png" alt="">
                    </div>
                    <div class="second">
                        <div class="grade-grid">
                            <div>1st</div>
                            <div class="d-flex justify-content-center">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['four_que'] ?>" readonly>
                            </div>
                        </div>
                        <div class="grade-grid">
                            <div class="d-flex justify-content-center">2nd</div>
                            <div class="justify-self-center">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['sefour_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="third">
                        I am independent
                    </div>
                </div>
            </div>
            <hr>
            <div class="report-grid mt-3">
                <div class="first-row-one">
                    <div class="first">
                        <img src="<?php echo base_url()?>assets/website/img/report/intructions.png" alt="">
                    </div>
                    <div class="second">
                        <div class="grade-grid">
                            <div>1st</div>
                            <div class="d-flex justify-content-center">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['five_que'] ?>" readonly>
                            </div>
                        </div>
                        <div class="grade-grid">
                            <div class="d-flex justify-content-center">2nd</div>
                            <div class="justify-self-center">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['sefive_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="third">
                        I listen to instructions
                    </div>
                </div>
                <div class="first-row-two">
                    <div class="first" style="text-align: center;">
                        <img src="<?php echo base_url()?>assets/website/img/report/manners.png" alt="">
                    </div>
                    <div class="second">
                        <div class="grade-grid">
                            <div>1st</div>
                            <div class="d-flex justify-content-center">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['six_que'] ?>" readonly>
                            </div>
                        </div>
                        <div class="grade-grid">
                            <div class="d-flex justify-content-center">2nd</div>
                            <div class="justify-self-center">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['sesix_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="third">
                        I know my tabble manners
                    </div>
                </div>
            </div>
            <hr>
            <div class="report-grid mt-3">
                <div class="first-row-one">
                    <div class="first">
                        <img src="<?php echo base_url()?>assets/website/img/report/sing-dance.png" alt="">
                    </div>
                    <div class="second">
                        <div class="grade-grid">
                            <div>1st</div>
                            <div class="d-flex justify-content-center">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['seven_que'] ?>" readonly>
                            </div>
                        </div>
                        <div class="grade-grid">
                            <div class="d-flex justify-content-center" style="color: #fff;">2nd</div>
                            <div class="justify-self-center">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['seseven_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="third" style="color: #fff;">
                        I can sing and dance
                    </div>
                </div>
                <div class="first-row-two">
                    <div class="first">
                        <img src="<?php echo base_url()?>assets/website/img/report/draw-colour.png" alt="">
                    </div>
                    <div class="second">
                        <div class="grade-grid">
                            <div>1st</div>
                            <div class="d-flex justify-content-center">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['eight_que'] ?>" readonly>
                            </div>
                        </div>
                        <div class="grade-grid">
                            <div class="d-flex justify-content-center" style="color: #fff;">2nd</div>
                            <div class="justify-self-center">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['seeight_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="third" style="color: #fff;">
                        I can draw and colour
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="mb-2"></div>
    <div class="page background-report-2" size="A4">
        <div class="p-5">
            <div class="headline-one">
                <div id="triangle-left"></div>
                <div class="text-one">COGNITIVE AND LANGUAGE DEVELOPMENT</div>
                <div id="triangle-right"></div>
            </div>
            <div>
                <div class="grid-work-one">
                    <div class="sub-grid-work">
                        <div class="one">READING</div>
                        <div class="two">
                            <div class="d-flex justify-content-end">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['nine_que'] ?>" readonly>
                            </div>
                            <div style="font-size: 30px;align-self: center;">1st</div>
                        </div>
                        <div class="three">
                            <div class="d-flex justify-content-end" style="font-size: 30px;align-self: center;">2nd</div>
                            <div class="">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['senine_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="sub-grid-work">
                        <div class="one">E.V.S</div>
                        <div class="two">
                            <div class="d-flex justify-content-end">
                                <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['ten_que'] ?>" readonly>
                            </div>
                            <div style="font-size: 30px;align-self: center;">1st</div>
                        </div>
                        <div class="three">
                            <div class="d-flex justify-content-end" style="font-size: 30px;align-self: center;">2nd</div>
                            <div class="">
                                <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['seten_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="sub-grid-work">
                        <div class="one">RECITATION</div>
                        <div class="two">
                            <div class="d-flex justify-content-end">
                                <input type="text" class="ip3" value="<?php echo $userreport_detail_second[0]['eleven_que'] ?>" readonly>
                            </div>
                            <div style="font-size: 30px;align-self: center;">1st</div>
                        </div>
                        <div class="three">
                            <div class="d-flex justify-content-end" style="font-size: 30px;align-self: center;">2nd</div>
                            <div class="">
                                <input type="text" class="ip3" value="<?php echo $userreport_detail_second[0]['seeleven_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid-work-two">
                    <div class="sub-grid-work">
                        <div class="one">STORY NARRATION</div>
                        <div class="two">
                            <div class="d-flex justify-content-end">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['tweele_que'] ?>" readonly>
                            </div>
                            <div style="font-size: 30px;align-self: center;">1st</div>
                        </div>
                        <div class="three">
                            <div class="d-flex justify-content-end" style="font-size: 30px;align-self: center;">2nd</div>
                            <div class="">
                                <input type="text" class="ip1" value="<?php echo $userreport_detail_second[0]['setweele_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="sub-grid-work">
                        <div class="one">CONVERSATION</div>
                        <div class="two">
                            <div class="d-flex justify-content-end">
                                <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['threen_que'] ?>" readonly>
                            </div>
                            <div style="font-size: 30px;align-self: center;">1st</div>
                        </div>
                        <div class="three">
                            <div class="d-flex justify-content-end" style="font-size: 30px;align-self: center;">2nd</div>
                            <div class="">
                                <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['sethreen_que'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="headline-two">IN WRITING MY SCORE IS...</div>
                <div class="grid-work-three">
                    <div class="sub-grid-work">
                        <div class="one">ENGLISH</div>
                        <div class="two">
                            <div class="d-flex justify-content-end">
                                <input type="text" class="ip3" value="<?php echo $userreport_detail_second[0]['english'] ?>" readonly>
                            </div>
                            <div style="font-size: 30px;align-self: center;justify-self: center;">1st</div>
                        </div>
                        <div class="three">
                            <div class="">
                                <input type="text" class="ip3" value="<?php echo $userreport_detail_second[0]['seenglish'] ?>" readonly>
                            </div>
                            <div class="d-flex justify-content-end" style="font-size: 30px;align-self: center;">2nd</div>
                        </div>
                    </div>
                    <div class="sub-grid-work">
                        <div class="one">MATHS</div>
                        <div class="two">
                            <div class="d-flex justify-content-end">
                                <input type="text" class="ip3" value="<?php echo $userreport_detail_second[0]['maths'] ?>" readonly>
                            </div>
                            <div style="font-size: 30px;align-self: center;justify-self: center;">1st</div>
                        </div>
                        <div class="three">
                            
                            <div class="">
                                <input type="text" class="ip3" value="<?php echo $userreport_detail_second[0]['semaths'] ?>" readonly>
                            </div>
                            <div class="d-flex justify-content-end" style="font-size: 30px;align-self: center;justify-self: center;">2nd</div>
                        </div>
                    </div>
                    <div class="sub-grid-work">
                        <div class="one">HINDI</div>
                        <div class="two">
                            <div class="d-flex justify-content-end">
                                <input type="text" class="ip3" value="<?php echo $userreport_detail_second[0]['hindi'] ?>" readonly>
                            </div>
                            <div style="font-size: 30px;align-self: center;justify-self: center;">1st</div>
                        </div>
                        <div class="three">
                            <div class="">
                                <input type="text" class="ip3" value="<?php echo $userreport_detail_second[0]['sehindi'] ?>" readonly>
                            </div>
                            <div class="d-flex justify-content-end" style="font-size: 30px;align-self: center;justify-self: center;">2nd</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="headline-one">
                <div id="triangle-left"></div>
                <div class="text-one">PHYSICAL / PERSONALITY DEVELOPMENT</div>
                <div id="triangle-right"></div>
            </div>
            <div class="grid-work-four">
                <div class="headline-three">I AM...</div>
                <div class="one">
                    <img src="<?php echo base_url()?>assets/website/img/report/i-am.png">
                </div>
                <div class="two">
                    <div class="report-text">HEALTHY</div>
                    <div class="" style="align-self: center;">
                        <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['dev_three'] ?>" readonly>
                    </div>
                        <!--<div style="font-size: 30px;align-self: center;">1st</div>-->
                        <!--<div class="d-flex justify-content-end" style="font-size: 30px;align-self: center;">2nd</div>-->
                    <div class="" style="align-self: center;">
                        <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['sedev_three'] ?>" readonly>
                    </div>
                </div>
                <div class="three">
                    <div class="report-text">ACTIVE</div>
                    <div class="" style="align-self: center;">
                        <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['dev_two'] ?>" readonly>
                    </div>
                        <!--<div style="font-size: 30px;align-self: center;">1st</div>-->
                        <!--<div class="d-flex justify-content-end" style="font-size: 30px;align-self: center;">2nd</div>-->
                    <div class="" style="align-self: center;">
                        <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['sedev_two'] ?>" readonly>
                    </div>
                </div>
                <div class="four">
                    <div class="report-text" style="color: #fff;">NEAT & TIDY</div>
                    <div class="" style="align-self: center;">
                        <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['dev_one'] ?>" readonly>
                    </div>
                        <!--<div style="font-size: 30px;align-self: center;">1st</div>-->
                        <!--<div class="d-flex justify-content-end" style="font-size: 30px;align-self: center;">2nd</div>-->
                    <div class="" style="align-self: center;">
                        <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['sedev_one'] ?>" readonly>
                    </div>
                </div>
                <div class="five">
                    <div class="report-text" style="color: #fff;">A GOOD CO-ORDINATOR</div>
                    <div class="" style="align-self: center;">
                        <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['dev_four'] ?>" readonly>
                    </div>
                        <!--<div style="font-size: 30px;align-self: center;">1st</div>-->
                        <!--<div class="d-flex justify-content-end" style="font-size: 30px;align-self: center;">2nd</div>-->
                    <div class="" style="align-self: center;">
                        <input type="text" class="ip2" value="<?php echo $userreport_detail_second[0]['sedev_four'] ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-2"></div>
     <div class="page background-report-3" size="A4">
        <div class="p-5">
        </div>
    </div>
    
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
    // window.print();
</script>
