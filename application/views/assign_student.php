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

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">

                            <div class="col-md-12">
                                <div class="card">
                                      <div class="card-body">
                                        <h2>Allocate Student Here</h2>
                                        <form method="POST" action="<?php echo base_url('dashboard/assign_student'); ?>">
                                            <input type="hidden" name="allocate" value="allocate">
                                            <div class="row">
                                                <div class="col-md-12">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Class Name</label>
                                                        <select class="form-control" name="fk_classId">
                                                            <option value="">Select Class</option>
                                                            <?php 
                                                            if($getClass){
                                                                foreach($getClass as $value){
                                                            ?>
                                                            <option value="<?php echo $value['classId'];?>"><?php echo $value['className']; ?></option>
                                                            <?php } }  ?>
                                                        </select>
                                                        <span style="color:red"><?php echo form_error('fk_classId');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Assign Date</label>
                                                        <input type="date" class="form-control" name="fk_date">
                                                        <span style="color:red"><?php echo form_error('fk_date');?></span>
                                                    </div>
                                                </div> 
                                                <div class="col-xl-4 col-md-6">
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

                                                <div class="col-xl-4 col-md-6">
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

                                                 <div class="col-xl-4 col-md-6">
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
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card">
                                      <div class="card-body">
                                        <h2>Search Batch Here</h2>
                                        <form method="POST" action="<?php echo base_url('dashboard/assign_student'); ?>">
                                            <input type="hidden" name="allocate" value="search">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Class Name</label>
                                                        <select class="form-control" name="fk_search_classId">
                                                            <option value="">Select Class</option>
                                                            <?php 
                                                            if($getClass){
                                                                foreach($getClass as $value){
                                                            ?>
                                                            <option value="<?php echo $value['classId'];?>"><?php echo $value['className']; ?></option>
                                                            <?php } }  ?>
                                                        </select>
                                                        <span style="color:red"><?php echo form_error('fk_search_classId');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Assign Date</label>
                                                        <input type="date" class="form-control" name="fk_date">
                                                        <span style="color:red"><?php echo form_error('fk_date');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Teacher Name</label>
                                                        <select class="form-control" name="fk_search_teachId">
                                                            <option value="">Select Teacher</option>
                                                            <?php 
                                                            if($getTeacher){
                                                                foreach($getTeacher as $value){
                                                            ?>
                                                            <option value="<?php echo $value['teacherId'];?>"><?php echo $value['teacherName']; ?> (<?php echo $value['className']; ?> ) </option>
                                                            <?php } }  ?>
                                                        </select>
                                                        <span style="color:red"><?php echo form_error('fk_search_teachId');?></span>
                                                    </div>
                                                </div> 
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Select Sub Class Name</label>
                                                        <select class="form-control" name="fk_search_sub_teachId">
                                                            <option value="">Select Sub Class</option>
                                                            <?php 
                                                            if($tab_add_fees_data){
                                                                foreach($tab_add_fees_data as $value){
                                                            ?>
                                                            <option value="<?php echo $value['feesId'];?>"><?php echo $value['packageName']; ?> </option>
                                                            <?php } }  ?>
                                                        </select>
                                                        <span style="color:red"><?php echo form_error('fk_search_sub_teachId');?></span>
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
                                                <th class="thclass">student Gender</th>
                                                <th class="thclass">OTP</th>
                                                <th class="thclass">Status</th>
                                                <th class="thclass">Date</th>
                                                <th class="thclass">Action</th>
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
                                                <td><?php echo $value['studentGender']; ?></td>
                                                <td><?php echo $value['OTP']; ?></td>
                                                <td class="align-middle text-center text-sm">
                                                    <?php

                                                        if($value['studentStatus']==1){

                                                            $status = "<span class='badge badge-sm bg-gradient-success'>Active</span>";

                                                            } else {

                                                            $status = "<span class='badge badge-sm bg-gradient-secondary'>De-Active</span>";
                                                        }
                                                         echo $status; 
                                                     ?>
                                                         
                                                     </td>
                                                
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td>
                                                        <a href="<?php echo base_url('dashboard/edit/'.$value['studId'])?>"><i style="font-size:25px;" class="mdi mdi-account-edit-outline"></i></a>
                                                        <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deletestudid');?>">
                                                        <input type="hidden" value="<?php echo $value['studId'];?>" name="studId">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px;position: relative;top: -38px;   margin-left: 19px;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                    </form>
                                                   <a href="">View More</a>
                                                    
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
      
      // setTimeout(function() {
      //               window.location.href = '<?php // echo base_url('dashboard/assign_student')?>';
      //  }, 2000);

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