<?php

    $usersession    = $this->session->userdata('usersession');
    
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <style>
    </style>
    <!-- Vedic Teacher header files Start -->
    <?php $this->load->view('teacher_header'); ?>
    <!-- Vedic Teacher header files End -->
</head>

<body>
  <!-- Simulate a smartphone / tablet -->
  <?php $this->load->view('mobilemenu'); ?>
  <!-- End smartphone / tablet look -->
  <div class="boxes">
    <?php $this->load->view('teachersidebar'); ?>
    <div class="box11 animated_hero" style="background: #695FFE;">
      <div class="box-inside">
        <div class="desktop-mobile-view">
          <!-- //top header -->
          <?php $this->load->view('teacher_topheader'); ?>
          <!-- //end top header -->
          <button style="background: #695ffe;border-radius: 30px;color: #fff;" onclick="history.back()"><i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Go Back</button>
          <h1 class="my-4" style="font-weight: 800;color:darkorange">View Student Attendance</h1>
          <table id="myTable">
            <thead>
              <tr>
                <th class="thclass">#Student Id</th>
                <th class="thclass">Student Name</th>
                <th class="thclass">Student Attendace Date</th>
                <th class="thclass">Presenty mark</th>
              </tr>
            </thead>
            <tbody>
            <?php if($final_student_abb_present) {
              $i=1;
              foreach ($final_student_abb_present as $key=> $value){
                  ?>
                  <tr>
                  
                      <td>
                      <?php
                          $jd = json_decode($value['student_id']);
                          $countsid = count($jd);
                            
                          for($i=0;$i<$countsid;$i++){

                              echo "<ul><li style='
                              list-style: none;
                          '>".$jd[$i]."</ul></li>";
                              
                          }
                          
                      ?>
                      </td>
                      <td >
                      <?php
                      
                            $jd1 = json_decode($value['student_name']);
                          $countsid = count($jd1);

                          for($i=0;$i<$countsid;$i++){

                            echo "<ul><li style='
                            list-style: none;
                        '>".$jd1[$i]."</ul></li>";
                          }
                        ?>
                      </td>

                      <td >
                      <?php
                            $jd4 = json_decode($value['date']);
                            $countsid = count($jd4);

                            for($i=0;$i<$countsid;$i++){

                              echo "<ul><li style='
                              list-style: none;
                          ' >".$jd4[$i]."</ul></li>";
                            }
                      ?>
                      </td>
                      <td >
                      <?php 
                      
                      $jd3 = json_decode($value['remark']);
                      $countsid = count($jd3);

                      for($i=0;$i<$countsid;$i++){

                        echo "<ul><li style='
                        list-style: none;
                    '>".ucfirst($jd3[$i])."</ul></li>";
                      }
                      
                        ?></td>
                  </tr>
                
                <?php } 
              } else { 
              echo "No data"; 
            }?>
            </tbody>
          </table>
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