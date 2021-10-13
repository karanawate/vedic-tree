<?php
  $usersession    = $this->session->userdata('usersession');
 
  

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
  
  <!-- Vedic Main header files Start -->
  <?php $this->load->view('teacher_header'); ?>
  <!-- Vedic Main header files End -->
  <style>
  .link_studentref{
    margin-top: 9px;
    margin-left: 10px;
}
  </style>  
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
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          <!-- //end top header -->
          <button style="background: #695ffe;border-radius: 30px;color: #fff;" onclick="history.back()"><i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Go Back</button>
          <h1 class="my-4" style="font-weight: 800;color:darkorange">Studentlist of Report-card</h1>
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
                  <th class="thclass">Student Name</th>
                  <th class="thclass">Student Mobile</th>
                  <th class="thclass">Student Package</th>
                  
                  <th class="thclass">Created at </th>
                  <th class="thclass">Action </th>
                  <th class="thclass"> </th>
                </tr>
              </thead>
              <tbody>   
              
              <!--<?php  //echo '<pre>';  print_r($student_list_response); ?>-->
                <?php foreach($student_list_response as $studentlistvisevise) { ?>
                <tr>
                   
                  <?php  if($studentlistvisevise > 1) { ?>
                    <td><?php echo $studentlistvisevise['techid']; ?></td>
                    <!--<td><?php echo $studentlistvisevise['pnamae']; ?></td>-->
                    <input type="hidden" name="" value="<?php $fullname =  $studentlistvisevise['pnamae']; ?>" />
                    <?php   
                            $firstName     = substr($fullname, 0, strpos($fullname, ' ')); 
                            $lastName      = substr($fullname, strpos($fullname, " ") + 0);
                            $wholename     = $firstName.$lastName;
                           
                    ?>
                    <td>
                     <div  class="wrapper"><img style="width: 45px;border-radius:22px;" class="h-12 w-12 rounded-full" src="https://ui-avatars.com/api/?bold=true&background=random&name=<?php echo $wholename ?>" alt=""><a class="link_studentref" href="<?php echo site_url("teacher/children_report_profile/".$studentlistvisevise['studId']); ?>" ><?php echo  $studentlistvisevise['pnamae'];?>
                     </div>
                    </td>
                    <td><?php echo "+91 ".$studentlistvisevise['studentMobile']; ?></td>
                    <td>Batch <?php echo $studentlistvisevise['packageName']; ?></td>
                   
                    <td><?php echo  $studentlistvisevise['createDT']; ?></td>
                    <td>
                        <?php if($studentlistvisevise['status_ch'] == 2){?>
                          <!--<span style="color:blue">Already Report</span>-->
                           <form action="<?php echo base_url('teacher/create_reportcard'); ?>" method="POST" >
                          <input type="hidden" value="<?php  echo  $studentlistvisevise['className']      ?>"   name="className" />
                          <input type="hidden" value="<?php  echo  $studentlistvisevise['pstud_id'];     ?>"    name="fk_studId" />
                          <input type="hidden" value="<?php  echo  $studentlistvisevise['pnamae'];   ?>"        name="studentName" />
                          <input type="hidden" value="<?php  echo  $studentlistvisevise['usr_dob'];       ?>"   name="usr_dob" />
                          <input type="hidden" value="<?php  echo  $studentlistvisevise['packageName'];   ?>"   name="packageName" />
                          <input type="hidden" value="<?php  echo  $studentlistvisevise['feesId'];   ?>"        name="feesId" />
                          <input type="submit" value="Create-Reportcard" class="btn btn-primary btn-sm " />
                        </form>
                         <?php }else{ ?>
                         <form action="<?php echo base_url('teacher/create_reportcard'); ?>" method="POST" >
                          <input type="hidden" value="<?php  echo  $studentlistvisevise['className']      ?>"   name="className" />
                          <input type="hidden" value="<?php  echo  $studentlistvisevise['pstud_id'];     ?>"    name="fk_studId" />
                          <input type="hidden" value="<?php  echo  $studentlistvisevise['pnamae'];   ?>"        name="studentName" />
                          <input type="hidden" value="<?php  echo  $studentlistvisevise['usr_dob'];       ?>"   name="usr_dob" />
                          <input type="hidden" value="<?php  echo  $studentlistvisevise['packageName'];   ?>"   name="packageName" />
                          <input type="hidden" value="<?php  echo  $studentlistvisevise['feesId'];   ?>"        name="feesId" />
                          <input type="submit" value="Create-Reportcard" class="btn btn-primary btn-sm " />
                        </form>
                         <?php }?>

                    </td>
                    
                    <td>
                        <?php if($studentlistvisevise['reportcard'] == 1 || $studentlistvisevise['reportcard'] == 2){?>
                         <a class="btn btn-primary btn-sm"  href="<?php echo site_url("teacher/children_report_profile/".$studentlistvisevise['pstud_id']."/".$studentlistvisevise['feesId']); ?>" />View</a>
                         <?php }else{ ?>
                         <span >
                          <!--if no entry found view-->
                          
                         </span>
                         <?php }?>
                         
                         
                    </td>
                    
                  
                    
                    
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


<?php if(isset($error)){ ?>
    <script type="text/javascript">
        color = Math.floor((Math.random() * 4) + 1);

        $.notify({
        icon: "tim-icons icon-bell-55",
        message: "<?php if(isset($error)){ echo $error['error']; } ?>"
        },{ type: type[color],
            timer: 8000,
        });
    </script>
<?php } ?>