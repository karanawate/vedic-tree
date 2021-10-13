<?php

    $usersession    = $this->session->userdata('usersession');
    
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <style>
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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
      <?php $this->load->view('mobilemenu'); ?>
    <!-- Simulate a smartphone / tablet -->
    <div class="mobile-container">
        <!-- Top Navigation Menu -->
      
    </div>
    <!-- End smartphone / tablet look -->
    <div class="boxes">
      <?php $this->load->view('teachersidebar'); ?>
         <div class="box11 animated_hero" style="background: #695FFE;">
                    
            <div class="box-inside">
                <div class="desktop-mobile-view">
                    <!-- //top header -->
                        <?php $this->load->view('teacher_topheader'); ?>
                    <!-- //end top header -->
                    <div class="row">
                    <div class="col" style="padding:30px;">
                    <h1 style="font-weight: 800;color:darkorange"></h1>
                    </div>
                    </div>

                    <div class="">
                        <table id="myTable">
                          <thead>
                            <tr>
                                <th class="thclass">#Id</th>
                                <th class="thclass">Teacher Name</th>
                                <th class="thclass">Date</th>
                                <th class="thclass"> Package-name</th>
                                <th class="thclass">Batch-Name</th>
                                <th class="thclass">Created At</th>
                            </tr>
                            <tr>
                            <?php
                                foreach($teacher_attdence_logs as $logs)
                                {
                                ?>
                                <td><?php echo $logs['id'] ?></td>
                                <td><?php echo $logs['teacher_id'] ?></td>
                                <td><?php echo $logs['fk_batchId'] ?></td>
                                <td></td>
                                <td></td>
                                <td><?php echo $logs['created_at'] ?></td>
                                <?php 
                                }
                             ?>
                            </tr>
                          </thead>
                             <tbody>                  
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