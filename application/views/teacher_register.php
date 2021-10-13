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
                                        <div class="col-md-6">
                                        <form method="POST" action="<?php echo base_url("dashboard/registration_form") ?>" >
                                        <div class="signup-box">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="required-label">Enter Full Name</label>
                                                        <input type="text" name="teacherName" class="form-control" value="<?php echo set_value('teacherName');?>" placeholder="Enter  Full Name">
                                                    </div>
                                                    <span style="color:red"><?php echo form_error('teacherName');?></span>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="required-label">Enter Mobile</label>
                                                        <input type="number" value="<?php echo set_value('teacherMobile');?>"  name="teacherMobile" class="form-control" placeholder="Enter Phone">
                                                        <span style="color:red"><?php echo form_error('teacherMobile');?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="required-label">Enter Email</label>
                                                        <input type="text" value="<?php echo set_value('teacherEmail');?>" name="teacherEmail" class="form-control" placeholder="Enter Email">
                                                        <span style="color:red"><?php echo form_error('teacherEmail');?></span>
                                                    </div>
                                                </div>

                                                   <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="required-label">Enter Password</label>
                                                        <input type="Password" value="<?php echo set_value('teacherPass');?>" class="form-control" name="teacherPass" placeholder="Enter Password">
                                                        <span style="color:red"><?php echo form_error('teacherPass');?></span>
                                                    </div>
                                                </div>
                                               
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                    <label>Class Name</label>
                                                    <label class="required-label">Select Class</label>
                                                        <select name="teacherClass" class="form-control">
                                                            <option value="0">Select Class </option>
                                                            <option value="1" <?php echo set_select('teacherClass', '1'); ?>>Nursery</option>
                                                            <option value="2" <?php echo set_select('teacherClass', '2'); ?>>Jr. Kg</option>
                                                            <option value="3" <?php echo set_select('teacherClass', '3'); ?>>Sr. Kg</option>
                                                        </select>
                                                        <span style="color:red"><?php echo form_error('teacherClass');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Gender</label>
                                                        <div class="mt-2">
                                                            <label class="radio-inline mr-2"><input type="radio" name="teacherGender" value="Male" checked> Male</label>
                                                            <label class="radio-inline"><input type="radio" name="teacherGender" value="Female"> Female</label>
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('teacherGender');?></span>
                                                    </div>
                                                 </div>
                                             </div>

                                            <div class="d-flex justify-content-center">
                                                <a class="pc-button elementor-button" href="#">
                                                <div class="button-content-wrapper">
                                                    <button  class="btn btn-primary" type="submit" value="submit" name="submit">Submit</button> 
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
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
                    window.location.href = '<?php echo base_url('dashboard/teacher_get_information')?>';
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