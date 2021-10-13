<?php

    $usersession    = $this->session->userdata('usersession');
    $studentName    = $usersession[0]['studentName'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp);  

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <style>
    </style>
    <!-- Required meta tags -->
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/bootstrap.min.css" />
   
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/niceselect/css/nice-select.css" />
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">  
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"> 
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

  <!-- ////////////////////////////////////////////////////////////////////// -->

        <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

  <!-- ////////////////////////////////////////////////////////////////////// -->
  
</head>

<body>
    <!-- Simulate a smartphone / tablet -->
    <?php $this->load->view('mobilemenus'); ?>
    <!-- End smartphone / tablet look -->
    <div class="boxes">
        <?php $this->load->view('websitesidebar'); ?>
         <div class="box11 animated_hero" style="background: #695FFE;">
                    
            <div class="box-inside">
                <div class="desktop-mobile-view">
                    <!-- //top header -->
                        <?php $this->load->view('topheader'); ?>
                    <!-- //end top header -->
                    <div class="row">
                    <div class="col" style="padding:30px;">
                    <h1 style="font-weight: 800;color:darkorange">Payment History</h1>
                    </div>
                    </div>

                    <div class="">
                        <table id="myTable">
                          <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Payment Amount</th>
                                <th>Payment status</th>
                                <th>Payment Date</th>
                                <th>Payment Receipt</th>
                                <th>Payment Month</th>
                                <th>Download Receipt</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if($payment_his_data){

                                foreach($payment_his_data as $value) {
                                    

                                    if($value['paystatusId']==1){
                                        $paystatus = "<span style='color:green;font-size:large;'>Success</span>";
                                    }else if($value['paystatusId']==3){
                                        $paystatus = "<span style='color:green;font-size:large;'>Partial Paid</span>";
                                    }else{
                                        $paystatus = "<span style='color:red;font-size:large;'>Pending</span>";
                                    }
                             ?>
                            <tr>
                                <td>
                                <?php echo ucfirst($value['usr_firstname']." ".$value['usr_lastname']);?></td>
                                
                                <td><i class="fas fa-rupee-sign"></i>
                                <?php echo round($value['payAmount']);?>
                                </td>
                                <td>
                                 <?php echo $paystatus;?>
                                </td>
                                <td>
                                <?php echo $value['createDT'];?>   
                                </td>
                                <td>
                                <?php 
                                if($value['paymentType']==3) 
                                 {

                                ?>    
                                    <a target="_blank" href="<?php echo base_url('uploads/Receiptpic/'.$value['Receiptpic']);?>"><img src="<?php echo base_url()?>/assets/images/receipt.gif"></a>
                                <?php } else { ?>

                                   <a target="_blank" href="#"><img src="<?php echo base_url()?>/assets/images/receipt.gif"></a>
                                    
                                 <?php
                                        }
                                ?>
                                </td>
                                <td>
                                <?php echo $value['fk_monthId'];?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('website/showpdf/'.$value['logId'])?>"><i style="font-size: 28px;" class="far fa-file-pdf"></i></a>
                                </td>
                            </tr>
                            <?php } } ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<script>
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

$(document).ready( function () {
    $('#myTable').DataTable();
    stateSave: true
} );

</script>