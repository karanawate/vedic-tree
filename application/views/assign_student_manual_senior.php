<?php
 $this->load->view('header');
?>
<style type="text/css">
    .thclass{
        width:400px;
    }
</style>
        <!-- Begin page -->
        <div id="layout-wrapper">
            <?php $this->load->view('topbar'); ?>
            <?php $this->load->view('sidebar'); ?>

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                                <div class="card">
                                      <div class="card-body">
                                        <h2>Search Batch Here</h2>
                                        <a href="<?php echo base_url('dashboard/assign_student_manual_senior');?>" style="float: right;top: -40px;position: relative;" class="btn btn-primary">Refresh</a>
                                        <form method="POST" action="<?php echo base_url('dashboard/assign_student_manual_senior'); ?>">
                                            <input type="hidden" name="allocate" value="search">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Enter Mobile Number </label>
                                                        <input type="text" class="form-control" maxlength="10" value="<?php echo set_value('studentMobile'); ?>" name="studentMobile" placeholder="Enter Mobile Number ">
                                                        <span style="color:red"><?php echo form_error('studentMobile');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Enter Email Id </label>
                                                        <input type="email" class="form-control" value="<?php echo set_value('studentEmail'); ?>" name="studentEmail" placeholder="Enter Email Id ">
                                                        <span style="color:red"><?php echo form_error('studentEmail');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Enter Student Id </label>
                                                        <input type="text" class="form-control" value="<?php echo set_value('studentId'); ?>" name="studentId" placeholder="Enter Student Id ">
                                                        <span style="color:red"><?php echo form_error('studentId');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Search</button>
                                                    </div>
                                                </div>
    
                                            </div>
                                        </form>
                                      </div>
                                </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Student List</h4>
                                        <table id="datatable" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Student Name</th>
                                                <th class="thclass">Student Email</th>
                                                <th class="thclass">Student Mobile</th>
                                                <th class="thclass">student Class</th>
                                                <th class="thclass">Teacher Name</th>
                                                <th class="thclass">student Id</th>
                                                <th class="thclass">Action</th>
                                                <th class="thclass">Delete</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($assign_student){
                                                $i=1;
                                                foreach ($assign_student as $key => $value) { 
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['studentName']; ?></td>
                                                <td><?php echo $value['studentEmail']; ?></td>
                                                <td><?php echo $value['studentMobile']; ?></td>
                                                <td><?php echo $value['className']; ?></td>
                                                <td><?php if($value['teacherName']!=""){ echo $value['teacherName']; }else{ echo " <span style='color:red'>No Assigned Teacher</span>"; } ?></td>
                                                <td><?php echo $value['studentId']; ?></td>                                                
                                                <td>
                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $value['studId'];?>">Allocate Student</button>
                                                </td>
                                                <td>
                                                   <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deleteAllocation');?>">
                                                      <input type="hidden" value="<?php echo $value['studId'];?>" name="studId">
                                                      <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                    </form>
                                                </td>
                                                
                                            </tr>
                                               <?php }} ?> 
                                         
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

            <?php if($assign_student){
                $i=1;
                    foreach ($assign_student as $key => $value) { 
            ?> 
                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?php echo $value['studId'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Allocate Teacher <?php echo $value['packageName'];?> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="<?php echo base_url('dashboard/assign_student_manual_senior'); ?>">
                            <input type="hidden" name="allocate" value="allocate">
                            <input type="hidden" name="fk_studId" value="<?php echo $value['studId']; ?>">
                              <div class="row">
                                 <div class="col-md-12">
                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label for="username"> Enter Student Id</label>
                                        <input type="text" value="" placeholder="Ex:SG0001" class="form-control" name="studentId">
                                        <span style="color:red"><?php echo form_error('studentId');?></span>
                                    </div>
                                </div>

                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label for="username"> Assign Date</label>
                                        <input type="date" class="form-control" name="fk_date">
                                        <span style="color:red"><?php echo form_error('fk_date');?></span>
                                    </div>
                                </div> 
                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label for="username"> Teacher Name</label>
                                        <select class="form-control" name="fk_teachId">
                                            <option value="">Select Teacher</option>
                                            <?php 
                                            if($getTeacher){
                                                foreach($getTeacher as $value){
                                            ?>
                                            <option value="<?php echo $value['teacherId'];?>"><?php echo $value['teacherName']; ?> (<?php echo $value['className']; ?> ) </option>
                                            <?php } }  ?>
                                        </select>
                                        <span style="color:red"><?php echo form_error('fk_teachId');?></span>
                                    </div>
                                </div> 

                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label for="username"> Select Sub Class Name</label>
                                        <select class="form-control" name="fk_feesId">
                                            <option value="">Select Sub Class</option>
                                            <?php 
                                            if($tab_add_fees_data){
                                                foreach($tab_add_fees_data as $value){
                                            ?>
                                            <option value="<?php echo $value['feesId'];?>"><?php echo $value['packageName']; ?> </option>
                                            <?php } }  ?>
                                        </select>
                                        <span style="color:red"><?php echo form_error('fk_feesId');?></span>
                                    </div>
                                </div>
                                 <div class=" col-md-12">
                                    <div class="form-group">
                                        <label for="username"> Select Batch Name</label>
                                        <select class="form-control" name="batchId">
                                            <option value="">Select Batch Name</option>
                                            <?php 
                                            if($batch){
                                                foreach($batch as $value){
                                            ?>
                                            <option value="<?php echo $value['batchId'];?>"><?php echo $value['batchName']; ?> </option>
                                            <?php } }  ?>
                                        </select>
                                        <span style="color:red"><?php echo form_error('batchId');?></span>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                    <div class="form-group" >
                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Allocate Student</button>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        
                      </div>
                    </div>
                  </div>
                </div>

            <?php } } ?>
                
              <?php $this->load->view('footer'); ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->





       <?php $this->load->view('footd');?>

       <script type="text/javascript">
           $(document).ready(function() {

                $(".mdi-delete").click(function(){

                    var studId =  $(this).attr('id');
                    $.ajax({
                        type:"POST",
                        data:{studId:studId},
                        url:"<?php echo base_url('dashboard/deletestudid')?>",
                        success:function(res){

                            if(res==1){
                                swal({
                                      title: "Student Id is Deleted!",
                                      text: "You clicked the button!",
                                      icon: "success",
                                      button: "ok",
                                    });
                            }
                            setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);

                        },
                        error:function(error){
                            console.log(error);
                        }
                    })



                })
            } );

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
                     window.location.href = '<?php  echo base_url('dashboard/assign_student_manual_senior')?>';
        }, 2000);

  </script>

<?php } ?>

<script>
    function check() {
        if(confirm("Are You Sure You Want To Delete")==true)
        {
            return true;
        }else{
            return false;
        }
    }
</script>