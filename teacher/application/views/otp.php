<?php $this->load->view('header');
$studentMobile = $this->session->userdata('studentMobile');
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
                                <h4 class="font-size-18 mt-5 text-center">Verify Otp Number !</h4>
                                <p class="text-muted text-center">.</p>
                                <form class="mt-4" method="post" action="<?php echo base_url('welcome/verifyotp')?>">
                                    <input type="hidden" class="mobno" value="<?php echo $studentMobile; ?>" name="studentMobile">
                                    <div class="form-group">
                                        <label for="username">Enter OTP</label>
                                        <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP">
                                        <span style="color:red"><?php echo form_error('otp'); ?></span>
                                       <span style="color:red"><?php echo form_error('studentMobile'); ?></span> 
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <a  href="#" style="display: none;" class="Resentotp">Resent OTP </a>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Verify OTP</button>
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

      setTimeout(function() {
                    window.location.href = '<?php echo base_url('welcome')?>';
       }, 2000);
  </script>

<?php } ?>

<script type="text/javascript">
  $('.Resentotp').delay(5000).show(0);   
</script>


<script type="text/javascript">
    $(document).ready(function(){

       $(".Resentotp").click(function(){

        var studentMobile = $(".mobno").val();
            if(studentMobile.length==10){

                $.ajax({

                    type:"POST",
                    data:{studentMobile:studentMobile},
                    url:"<?php echo base_url('welcome/resentotp')?>",
                    success:function(res){
                        if(res==1){

                            color = Math.floor((Math.random() * 4) + 1);

                              $.notify({
                                  icon: "tim-icons icon-bell-55",
                                  message: "OTP Sent On Your Mobile Number"

                                },{
                                    type: type[color],
                                    timer: 8000,
                                });
                        }else{

                            color = Math.floor((Math.random() * 4) + 1);

                              $.notify({
                                  icon: "tim-icons icon-bell-55",
                                  message: "Mobile Number not Exsit !"

                                },{
                                    type: type[color],
                                    timer: 8000,
                                });

                        }
                    },
                    error:function(error){
                        console.log(error);
                    }
                })

            }else{
                alert("Enter 10 Digit Number")
            }
       })
    });
</script>