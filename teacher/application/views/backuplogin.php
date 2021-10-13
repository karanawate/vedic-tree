<?php $this->load->view('header');?>
    <body class="account-pages">

        <!-- Begin page -->
        <div class="accountbg" style="background: url('assets/images/bg.jpg');background-size: cover;background-position: center;"></div>

        <div class="wrapper-page account-page-full">

            <div class="card shadow-none">
                <div class="card-block">

                    <div class="account-box">
                        <div class="card-box shadow-none p-4">
                            <div class="p-2">
                                <div class="text-center mt-4">
                                    <a href="<?php echo base_url('welcome');?>"><img src="<?php echo base_url();?>assets/images/logo-dark.png" height="22" alt="logo"></a>
                                </div>
                                <h4 class="font-size-18 mt-5 text-center">Welcome Back !</h4>
                                <p class="text-muted text-center">Sign in to continue to Veltrix.</p>
                              <form class="mt-4" method="post" action="<?php echo base_url('welcome'); ?>">
                                <div class="form-group">
                                    <label for="username">Student Mobile Number</label>
                                    <input type="number" class="form-control" value="<?php if(isset($_COOKIE["studentMobile"])) { echo $_COOKIE["studentMobile"]; } else{ echo set_value('studentMobile'); } ?>" name="studentMobile" maxlength="10" id="studentMobile" placeholder="Enter  Mobile">
                                    <span style="color:red"><?php echo form_error('studentMobile');?></span>
                                </div>
    
                                <div class="form-group">
                                    <label for="userpassword">Student Password</label>
                                    <input type="password" class="form-control" value="<?php if(isset($_COOKIE["studentPass"])) { echo $_COOKIE["studentPass"]; }else { echo set_value('studentPass'); } ?>" name="studentPass" id="studentPass" placeholder="Enter password">
                                    <span style="color:red"><?php echo form_error('studentPass');?></span>
                                </div>
    
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"  name="remember" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Log In</button>
                                    </div>
                                </div>
                                <!-- Display login button / Facebook profile information -->
                                <?php if(!empty($authURL)){ ?>
                                    <a href="<?php echo $authURL; ?>">
                                        <img style="width:220px;" src="<?php echo base_url('assets/images/fb-login-btn.png'); ?>">
                                    </a>
                                        <a href="<?php echo $loginURL; ?>"><img style="width:220px;" src="<?php echo base_url('assets/images/google-sign-in-btn.png'); ?>" />
                                        </a>
                                <?php }else{ ?>
                                    <h2>Facebook Profile Details</h2>
                                    <div class="ac-data">
                                        <img src="<?php echo $userData['picture']; ?>"/>
                                        <p><b>Facebook ID:</b> <?php echo $userData['oauth_uid']; ?></p>
                                        <p><b>Name:</b> <?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
                                        <p><b>Email:</b> <?php echo $userData['email']; ?></p>
                                        <p><b>Gender:</b> <?php echo $userData['gender']; ?></p>
                                        <p><b>Logged in with:</b> Facebook</p>
                                        <p><b>Profile Link:</b> <a href="<?php echo $userData['link']; ?>" target="_blank">Click to visit Facebook page</a></p>
                                        <p><b>Logout from <a href="<?php echo $logoutURL; ?>">Facebook</a></p>
                                    </div>
                                <?php } ?>
                                <div class="form-group mt-2 mb-0 row">
                                    <div class="col-12 mt-3">
                                        <a href="<?php echo base_url('welcome/forgetpass')?>"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                    </div>
                                </div>

                            </form>

                            <div class="mt-5 pt-4 text-center">
                                <p>Don't have an account ? <a href="<?php echo base_url('welcome/reg')?>" class="font-weight-medium text-primary"> Signup now </a> </p>
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

<?php if(isset($check_exist_success)){ ?>
  <script type="text/javascript">
    color = Math.floor((Math.random() * 4) + 1);

      $.notify({
          icon: "tim-icons icon-bell-55",
          message: "<?php if(isset($check_exist_success)){ echo $check_exist_success['error']; } ?>"

        },{
            type: type[color],
            timer: 8000,
        });
      
      setTimeout(function() {
                    window.location.href = '<?php echo base_url('dashboard')?>';
       }, 2000);

  </script>

<?php } ?>

