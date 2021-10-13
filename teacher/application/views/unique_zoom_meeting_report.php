<?php
  $usersession    = $this->session->userdata('usersession');
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
  <style>
  </style>
  <!-- Vedic Main header files Start -->
  <?php $this->load->view('teacher_header'); ?>
  <!-- Vedic Main header files End -->
</head>
<body>
  <!-- Simulate a smartphone / tablet -->
  <?php $this->load->view('mobilemenu'); ?>
  <!-- Top Navigation Menu -->
  <!-- End smartphone / tablet look -->
  <div class="boxes">
    <?php $this->load->view('teachersidebar'); ?>
    <div class="box11 animated_hero" style="background: #695FFE;">
      <div class="box-inside">
        <div class="desktop-mobile-view">
          <!-- //top header -->
          <?php $this->load->view('teacher_topheader'); ?>
          <!-- //end top header --> 
          <h1 class="my-4" style="font-weight: 800;color:darkorange">Total Meetings</h1>
          <div class="">
            <table id="myTable">
              <thead>
                <tr>
                  <th class="thclass">#Id</th>
                  <th class="thclass">name</th>
                  <!--<th class="thclass">StudentName</th>-->
                  <th class="thclass">User Email</th>
                  <th class="thclass">topicName</th>
                  <th class="thclass">Start Time</th>
                  <th class="thclass">End Time</th>
                  <th class="thclass">Duration</th>
                </tr>
              </thead>
              <tbody>
             
                <?php foreach($unique_zoom_meeting as $meeting) { ?>
                <tr>
                  <?php if($meeting > 1) { ?>
                    <td><?php echo $meeting['id']; ?></td>
                    <td><?php echo $meeting['name']; ?></td>
                    <!--<td><?php echo $meeting['studentName']; ?></td>-->
                    <td><?php echo $meeting['user_email']; ?></td>
                    <td><?php echo $meeting['topicName']; ?></td>
                    <td><?php echo $meeting['fk_start_time']; ?></td>
                   <td><?php echo $meeting['fk_end_time']; ?></td>
                  
                    <?php

                        $init = $meeting['duration'];
                        $hours = floor($init / 3600);
                        $minutes = floor(($init / 60) % 60);
                        $seconds = $init % 60;
                        ?>
                          <td><?php echo "$hours:$minutes:$seconds";  ?></td>
                         
                  
                  <?php } else {
                    echo "No data"; 
                  } ?>
                </tr>
                <?php } ?>
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
$(document).ready( function () {
    $('#myTable').DataTable();
    stateSave: true
});
</script>

<script>
    $(document).ready(function(){
        $('.bs-timepicker').timepicker();
    });
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
                    window.location.href = '<?php echo base_url('teacher/viewteacher')?>';
        }, 2000);
        

    </script>



<?php } ?>