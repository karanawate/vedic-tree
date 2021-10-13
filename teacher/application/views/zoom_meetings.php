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
          <?php
            $message = $this->session->flashdata('msg');
            if (isset($message)) {
                echo '<div class="alert alert-info successMessage ">' . $message . '</div>';
                $this->session->unset_userdata('msg');
            }
          ?>
          <div class="">
            <table id="myTable">
              <thead>
                <tr>
                  <th class="thclass">#Id</th>
                  <th class="thclass">Topic Name</th>
                  <th class="thclass">PackageName</th>
                  <!--<th class="thclass">Email</th>        -->
                  <th class="thclass">Date</th>        
                  <th class="thclass">Start time</th>
                  <th class="thclass">End time</th>
                  <th class="thclass">Meeting Id</th>
                  <th class="thclass">Operation</th>
                </tr>
              </thead>
              <tbody>        
                <?php foreach($list_zoom_meeting as $meeting) { ?>
                <tr>
                  <?php if($meeting > 1) { ?>
                    <td><?php echo $meeting['id']; ?></td>
                    <td><?php echo $meeting['topic_name']; ?></td>
                    <td><?php echo $meeting['packageName']; ?></td>
                    <!--<td><?php  echo $usersession[0]['teacherEmail']; ?></td>-->
                    <td><?php echo $meeting['start_date']; ?></td>
                    <td><?php echo $meeting['start_time']; ?></td>
                    <td><?php echo $meeting['end_time']; ?></td>
                    <td><?php echo $meeting['meeting_id']; ?></td>
                    <!--<td style="display: inline;"><a style="width:150px;height:50px" class="btn btn-success" href="<?php echo site_url("api_zoom/report_parti/".$meeting['meeting_id']); ?>">Generate Report</td>-->
                    <td style="display: inline;"><a style="width:150px;height:50px" class="btn btn-success" href="<?php echo site_url("api_zoom/get_particular_meeting_wise/".$meeting['meeting_id']); ?>">View Report</td>
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
$(document).ready(function(){
    setTimeout(function() {
    $(".successMessage").hide(3000);
}, 3000); 
});
</script>

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