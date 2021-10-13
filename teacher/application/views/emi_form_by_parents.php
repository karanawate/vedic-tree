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
                                        <form method="POST" action="<?php echo base_url('dashboard/emi_form_by_parents'); ?>">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Mobile Number</label>
                                                        <input type="number" class="form-control" value="<?php echo set_value('studentMobile');  ?>" name="studentMobile" maxlength="10" id="studentMobile" placeholder="Enter  Mobile">
                                                        <span style="color:red"><?php echo form_error('studentMobile');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Email Id</label>
                                                        <input type="text" class="form-control" value="<?php echo set_value('studentEmail');  ?>" name="studentEmail"  id="studentEmail" placeholder="Enter  Email">
                                                        <span style="color:red"><?php echo form_error('studentEmail');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">search</button>
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
                                                <th class="thclass">Student DOB</th>
                                                <th class="thclass">student Class</th>
                                                <th class="thclass">Applicant Name</th>
                                                <th class="thclass">Emi Tenure</th>
                                                <th class="thclass">Requested Amount</th>
                                                <th class="thclass">Adhaar No</th>
                                                <th class="thclass">Pan No</th>
                                                <th class="thclass">Date</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($emi_form_by_parents){
                                                $i=1;
                                                foreach ($emi_form_by_parents as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['student_name']; ?></td>
                                                <td><?php echo $value['email']; ?></td>
                                                <td><?php echo $value['mobile']; ?></td>
                                                <td><?php echo $value['student_dob']; ?></td>
                                                <td><?php echo $value['course_id']; ?></td>
                                                <td><?php echo $value['applicant_name']; ?></td>
                                                <td><?php echo $value['requested_tenure']; ?></td>
                                                <td><?php echo $value['requested_amount']; ?></td>
                                                <td><?php echo $value['aadhar_no']; ?></td>
                                                <td><?php echo $value['pan_no']; ?></td>
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td>
                                                        <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deleteemiappId');?>">
                                                        <input type="hidden" value="<?php echo $value['emiId'];?>" name="emiId">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 31px;position: relative;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                    
                                                    </form>
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
                    // window.location.href = '<?php echo base_url('dashboard/emi_form_by_parents')?>';
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