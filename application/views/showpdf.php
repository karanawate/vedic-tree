<?php
$usersession    = $this->session->userdata('usersession');
if($usersession){
    $studentName    = $usersession[0]['studentName'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $studentClass   = $usersession[0]['studentClass'];
    $usr_state      = ucfirst($usersession[0]['usr_state']);
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp); 
    if($studentClass==1){
        $studClassName = "Nursery";
    }elseif ($studentClass==2) {
        $studClassName = "Junior";
    }elseif ($studentClass==3) {
        $studClassName = "Senior";
    }
}
$color = "";
$fess_structure = array();
if($payment_his_data){
    $fess_structure 		= feesstructre($payment_his_data[0]['planId']);
	$classid                = getclass($payment_his_data[0]['fk_studId']);
	$usr_firstname 			= $payment_his_data[0]['usr_firstname'];
	$usr_lastname 			= $payment_his_data[0]['usr_lastname'];
	$usr_email 				= $payment_his_data[0]['usr_email'];
	$usr_mobile_no 			= $payment_his_data[0]['usr_mobile_no'];
	$payAmount 				= $payment_his_data[0]['payAmount'];
	$paystatus 				= $payment_his_data[0]['paystatus'];
	$createDT 				= $payment_his_data[0]['createDT'];
	$razorpay_order_id 		= $payment_his_data[0]['razorpay_order_id'];
	$razorpay_payment_id 	= $payment_his_data[0]['razorpay_payment_id'];
	$razorpay_signature 	= $payment_his_data[0]['razorpay_signature'];
	$fk_monthId 			= $payment_his_data[0]['fk_monthId'];
	$reciept_no   			= $payment_his_data[0]['reciept_no'];
	$currentyear 			= date("Y");
	$currentDT 				= date("Y-m-d");
    $number = $payAmount;
    $no = floor($number);
    $point = round($number - $no, 2) * 100;
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        '0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety');
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_1) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
        } else $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);
    $points = ($point) ?
    "." . $words[$point / 10] . " " . 
    $words[$point = $point % 10] : '';
    $payAmountw =  $result . "Rupees  ";       
}else{
	$fess_structure         = array();
	$usr_firstname 			= "";
	$usr_lastname 			= "";
	$usr_email 				= "";
	$usr_mobile_no 			= "";
	$payAmount 				= "";
	$paystatus 				= "";
	$createDT 				= "";
	$razorpay_order_id 		= "";
	$razorpay_payment_id 	= "";
	$razorpay_signature 	= "";
	$fk_monthId 			= "";
	$currentDT	 			= "";
	$currentyear            = "";
    $payAmountw             = "";
    $classid                = "";
    $reciept_no              = "";
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
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
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/invoicestyle.css" />
</head>
<body>
<div class="page" size="A4">
    <div class="p-5">
        <section class="header_logo_text header-padding">
            <div class="header-logo">
                <div class="logo">
                    <img src="<?php echo base_url()?>assets/logo.png" alt="" class="img-fluid">
                </div>
                <div class="title-details">
                    <div class="app-text">Vedic Tree Kids  Pre School</div>
                    <div class="d-flex justify-content-center">
                        <p class=" address mb-0">Amrut Height, Plot No:23, Sec-4, Karanjade, Panvel.</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="contact-info">Phone: +91 9320067800</p>
                        <p class="contact-info">Email: info.vedictree@gmail.com</p>
                        <p class="contact-info">GST No : 27AAHCV4828M1ZP</p>
                    </div>
                </div>
            </div>
        </section>
        <hr class="mb-1">
        <hr class="m-0">
        <section class="body_section">
            <div class="reciept-title mb-2">Invoice</div>
            
            <div class="d-flex justify-content-between mb-2">
                <div><span class="font-text-size">Date: </span><span><?php echo date("d-m-Y");?></span></div>
                <div><span class="font-text-size">Academic Year: </span><span><?php 
                    date_default_timezone_set("Asia/Calcutta"); 
                    $currentyear = date('Y-');
                    $currentyear_increment = date('Y') + 1;
                    echo $currentyear.$currentyear_increment; ?></span></div>
                <div><span class="font-text-size">Receipt No: </span><span><?php if(empty($razorpay_payment_id)) {
                date_default_timezone_set("Asia/Calcutta");   
                $dateformat = date('Y-');
                $dateformat_increment = date('y') + 1;
                 echo  "VT".$dateformat.$dateformat_increment."/"."00".$reciept_no;
                 }else{
                 echo $razorpay_payment_id;
                 }?></span></div>
            </div>
            <div class="mb-3"><span class="font-text-size">Student's Name: </span><span class="font-text-main"><?php echo ucwords($usr_firstname." ".$usr_lastname);?></span></div>
            <div class="mb-3"><span class="font-text-size">Received with Thanks from: </span><span class="font-text-main"><?php echo "Vedic Tree Pre school";?></span></div>
            <div class="mb-3"><span  class="font-text-size">The sum of Rupees (in words): </span><span class="font-text-main"><?php echo ucwords($payAmountw); ?>/-</span></div>
            <div class="grid-box">
                <div class="grid-box1">
                    <span class="font-text-size">Paid by: </span><span><?php echo ucwords($usr_firstname." ".$usr_lastname);?></span>
                </div>
            </div>
            <div class="grid-box">
                <div class="grid-box1"><span class="font-text-size">Transaction No: </span><span><?php echo $razorpay_order_id;?></span></div>
                <div class="grid-box2"><span class="font-text-size">Date: </span></div>
            </div>
            <!--<div class="mb-3"><span class="font-text-size">Balanced Amount: </span><span class="font-text-main">₹ 10999/-</span></div>-->
            <!--<div class="mb-3"><span class="font-text-size">Due Date of Payment: </span><span class="font-text-main">05/02/2021</span></div>-->
            <div class="mb-3"><span class="font-text-size">Admission desired in: </span><span class="font-text-main"><?php echo $classid;?></span></div>
            <div class="pay-box">
                <div class="currency-details"><i class="fas fa-rupee-sign"></i></div>
                <div class="amount-details"><?php echo round($payAmount);?>/-</div>
            </div>
            <div><small>(Fees once paid will not be adjusted & refunded under any circumstance)</small></div>
        </section>
        <section class="body_section">
        	<div id="option15" class="super" style="background: <?php echo $color; ?>;color:black;">
                <div class="table">
                    <?php 
                    if($fess_structure){
                        foreach ($fess_structure as $key => $value){
                            $gst = ($value['book_fees'] + $value['school_fees']) / 100 * 18;
                    ?>
                    <div class="table-cell" >Tution Fees</div>
                    <div class="table-cell" >Rs <?php echo round($value['school_fees']); ?>/-</div>
                    <div class="table-cell">Books Charge</div>
                    <div class="table-cell">Rs <?php echo round($value['book_fees']); ?>/-</div>
                    <div class="table-cell">Total </div>
                    <div class="table-cell">Rs <?php echo round($value['total_fees']); ?>/-</div>
                    <div class="table-cell">Discounted Fees</div>
                    <div class="table-cell">Rs <?php echo round($value['discount_fees']); ?>/-</div>
                    <div class="table-cell cell-feature">Total Fees</div>
                    <div class="table-cell cell-amount">Rs <?php echo round($value['final_fees']); ?>/-</div>
                    <?php } } ?>
                </div>
                <div class="table">
                    <?php 
                    if($fess_structure){
                        foreach ($fess_structure as $key => $value){
                            $gst = ($value['book_fees'] + $value['school_fees']) / 100 * 18;
                    ?>
                    <div class="table-cell"><h3><?php echo ucfirst($value['packageName']); ?></h3></div>
                    <div class="table-cell plattform">
                        <h3 style="font-weight: 900">Rs <?php echo $value['final_fees']; ?>/-</h3>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </section>
        <section class="sign_box_section">
            <div class="sign-box">For Vedic Tree Pre School</div>
            <div style="text-align: center;">This is a Computer Generated Receipt</div>
        </section>
    </div>
</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
function openWin() {
    var w = window.open("<?php echo base_url('website/showpdf')?>","_self");
    window.focus();
    window.print();
}
</script>
