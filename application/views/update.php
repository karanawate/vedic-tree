<?php
 $this->load->view('header');
?>
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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-md-8">
                                            <h4>Edit Information</h4>
                                            <?php if(!empty($updatedata)){ ?>       
                                                <form class="mt-4" method="post" action="<?php echo base_url('dashboard/edit')?>" >
                                                    <input type="hidden" name="studId" value="<?php echo $updatedata[0]['studId']?>">
                                                    <div class="form-group">
                                                        <label for="username">Student Full  Name</label>
                                                        <input type="text" class="form-control" id="studentName" name="studentName" value="<?php echo $updatedata[0]['studentName'];?>" placeholder="Enter Full Name">
                                                        <span style="color:red"><?php echo form_error('studentName'); ?></span>
                                                    </div>
                    

                                                    <div class="form-group">
                                                        <label for="userpassword">Student First Name</label>
                                                        <input type="text" value="<?php echo $updatedata[0]['usr_firstname'];?>" class="form-control"   name="usr_firstname" placeholder="Enter First Name">
                                                        <span style="color:red"><?php echo form_error('usr_firstname'); ?></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="userpassword">Student Last Name</label>
                                                        <input type="text" value="<?php echo $updatedata[0]['usr_lastname'];?>" class="form-control"   name="usr_lastname" placeholder="Enter Last Name">
                                                        <span style="color:red"><?php echo form_error('usr_lastname'); ?></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="userpassword">Student Email Id</label>
                                                        <input type="email" value="<?php echo $updatedata[0]['studentEmail'];?>" class="form-control"  name="studentEmail" placeholder="Enter  Email">
                                                        <span style="color:red"><?php echo form_error('studentEmail'); ?></span>
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <label for="username">Student Gender</label>
                                                         <br>   
                                                    <?php
                                                     if($updatedata[0]['studentGender']=="Male"){
                                                            echo "<input type='radio' value='Male' checked=''  name='studentGender'> Male";
                                                        }else if($updatedata[0]['studentGender']=="Female"){
                                                            echo "<input type='radio' value='Female' checked=''  name='studentGender'> Female";
                                                        } 
                                                    ?>
                                                        <span style="color:red"><?php echo form_error('studentGender'); ?></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="username">Student Mobile</label>
                                                        <input type="number" value="<?php echo $updatedata[0]['studentMobile'];?>" class="form-control" id="studentMobile" name="studentMobile" placeholder="Enter Mobile ">
                                                        <span style="color:red"><?php echo form_error('studentMobile'); ?></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="username">Altername Email</label>
                                                        <input type="text" value="<?php echo $updatedata[0]['alternate_email'];?>" class="form-control" id="alternate_email" name="alternate_email" placeholder="Enter Email Id ">
                                                        <span style="color:red"><?php echo form_error('alternate_email'); ?></span>
                                                    </div>

                                                    
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            
                                                        </div>
                                                        <div class="col-sm-6 text-right">
                                                            <button name="submit" value="submit" class="btn btn-primary w-md waves-effect waves-light" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php } else {
                                                echo "Student Data Not Found ";
                                            } ?>
                                        </div>
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
                            window.location.href = '<?php echo base_url('dashboard/getstudlist')?>';
               }, 2000);

          </script>



        <?php } ?>