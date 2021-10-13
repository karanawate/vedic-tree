<?php $this->load->view('header');
   $studentMobile = $this->session->userdata('studentMobile'); 
?>

    <div class="home-btn d-none d-sm-block">
            <a href="<?php echo base_url();?>" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div>
        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary">
                                <div class="text-primary text-center p-4">
                                    <h5 class="text-white font-size-20 p-2">Reset Password</h5>
                                    <a href="index.html" class="logo logo-admin">
                                        <img src="<?php echo base_url()?>assets/images/logo-sm.png" height="24" alt="logo">
                                    </a>
                                </div>
                            </div>
    
                            <div class="card-body p-4">
                                
                                <div class="p-3">
                                    <form class="form-horizontal mt-4" method="post" action="<?php echo base_url('welcome/updatepass')?>">
                                        <input type="hidden" value="<?php echo $studentMobile;?>" name="studentMobile">
                                        <div class="form-group">
                                            <label for="useremail">Enter Otp</label>
                                            <input type="text"  class="form-control " id="otp" name="otp" placeholder="Enter Otp">
                                            <span style="color:red"><?php echo form_error('otp'); ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="useremail">Enter New Password</label>
                                            <input type="password" maxlength="10" class="form-control " id="newpass" name="newpass" placeholder="Enter New Password">
                                            <span style="color:red"><?php echo form_error('newpass'); ?></span>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="useremail">Enter Confirm Password</label>
                                            <input type="password" maxlength="10" class="form-control " id="cnewpass" name="cnewpass" placeholder="Enter Confirm Password">
                                            <span style="color:red"><?php echo form_error('cnewpass'); ?></span>
                                        </div>
                                        

                                        <div class="form-group row  mb-0">
                                            <div class="col-12 text-right">
                                                <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Update Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
    
                        </div>
    
                        <div class="mt-5 text-center">
                            <p>Remember It ? <a href="<?php echo base_url('welcome')?>" class="font-weight-medium text-primary"> Sign In here </a> </p>
                            <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Veltrix. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>

    <?php $this->load->view("footd");?>

    <script type="text/javascript">
        
        $(document).ready(function(){

            $(".studentMobile").blur(function(){

                var studentMobile = $(".studentMobile").val();

                if(studentMobile.length!=10){
                    alert("Enter 10 digit no")
                }

            })

        })

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
                    window.location.href = '<?php echo base_url('welcome')?>';
       }, 2000);
  </script>

<?php } ?>

