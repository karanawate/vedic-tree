<?php $this->load->view('header');

?>

    <body class="account-pages">

        <!-- Begin page -->
        <div class="accountbg" style="background: url('<?php echo base_url();?>assets/images/bg.jpg');background-size: cover;background-position: center;"></div>

        <div class="wrapper-page account-page-full">

            <div class="card shadow-none">
                <div class="card-block">

                    <div class="account-box">

                        <div class="card-box shadow-none p-4">
                            <div class="p-2">
                                <div class="text-center mt-4">
                                    <a href="index.html"><img src="<?php echo base_url();?>assets/images/logo-dark.png" height="22" alt="logo"></a>
                                </div>

                                <h4 class="font-size-18 mt-5 text-center">Welcome Back !</h4>
                                <p class="text-muted text-center">Sign in to continue to Veltrix.</p>

                              <form class="mt-4" method="post" action="<?php echo base_url('welcome/reg')?>" >

                                <div class="form-group">
                                    <label for="username">Student Name</label>
                                    <input type="text" class="form-control" id="studentName" name="studentName" value="<?php echo set_value('studentName');?>" placeholder="Enter Full Name">
                                    <span style="color:red"><?php echo form_error('studentName'); ?></span>
                                </div>
    

                                <div class="form-group">
                                    <label for="userpassword">Student Email Id</label>
                                    <input type="email" value="<?php echo set_value('studentEmail');?>" class="form-control" id="studentEmail"  name="studentEmail" placeholder="Enter  Email">
                                    <span style="color:red"><?php echo form_error('studentEmail'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="username">Student Mobile</label>
                                    <input type="number" value="<?php echo set_value('studentMobile');?>" class="form-control" id="studentMobile" name="studentMobile" placeholder="Enter Mobile ">
                                    <span style="color:red"><?php echo form_error('studentMobile'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="username">Student Class</label>
                                    <select class="form-control" name="studentClass" >
                                        <option value="">Select Class</option>
                                        <?php if($getClass){
                                            foreach ($getClass as $key => $value) {
                                         ?>
                                        <option value="<?php echo $value['classId'];?>"><?php echo $value['className'] ?></option>

                                        <?php } } ?>
                                    </select>
                                    <span style="color:red"><?php echo form_error('studentClass'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="username">Student Gender</label>
                                    <input type="radio" value="Male"   checked="" name="studentGender">Male
                                    <input type="radio" value="Female"  name="studentGender" >Female
                                    <span style="color:red"><?php echo form_error('studentGender'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="username">Refferal Code</label>
                                    <input type="text" value="<?php echo set_value('refferalCode');?>" class="form-control" id="refferalCode" name="refferalCode" placeholder="Enter refferal Code ">
                                    <span style="color:red"><?php echo form_error('refferalCode'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="username">Student Password</label>
                                    <input type="password" value="<?php echo set_value('studentPass');?>" class="form-control" id="studentPass" name="studentPass" placeholder="Enter Password ">
                                    <span style="color:red"><?php echo form_error('studentPass'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="username">Confirm Password</label>
                                    <input type="password" value="<?php echo set_value('studentCPass');?>" class="form-control" name="studentCPass" id="studentCPass" placeholder="Confirm Password ">
                                    <span style="color:red"><?php echo form_error('studentCPass'); ?></span>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <button name="submit" value="submit" class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </div>

                                <div class="form-group mt-2 mb-0 row">
                                    <div class="col-12 mt-3">
                                        <a href="<?php echo base_url('welcome/forgetpass')?>"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                    </div>
                                </div>

                            </form>

                            <div class="mt-5 pt-4 text-center">
                                <p>Already have an account ? <a href="<?php echo base_url('welcome')?>" class="font-weight-medium text-primary"> Sign In </a> </p>
                                <p>© <script>document.write(new Date().getFullYear())</script> Veddic Tree.  <i class="mdi mdi-heart text-danger"></i></p>
                            </div>

                        </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    <?php $this->load->view("footd");?>


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
  </script>

<?php } ?>

