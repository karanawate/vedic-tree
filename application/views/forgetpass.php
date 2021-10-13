<?php $this->load->view('header');?>

    <div class="home-btn d-none d-sm-block">
            <a href="<?php echo base_url('welcome'); ?>" class="text-dark"><i class="fas fa-home h2"></i></a>
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
                                        <div class="form-group">
                                            <label for="useremail">Enter Mobile</label>
                                            <input type="number" maxlength="10" class="form-control" id="studentMobile" name="studentMobile" placeholder="Enter Mobile">
                                            <span style="color:red"><?php echo form_error('studentMobile')?></span>
                                            <span style="color:red;display:none" id="error"> Mobile field is required.</span>
                                        </div>
                                        <div class="form-group row  mb-0">
                                            <div class="col-12 text-right">
                                                <button class="btn btn-primary forgetbtn w-md waves-effect waves-light" type="submit">Sent Opt</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                         <div class="mt-5 pt-4 text-center">
                                <p>Already have an account ? <a href="<?php echo base_url('welcome')?>" class="font-weight-medium text-primary"> Sign In </a> </p>
                                <p>© <script>document.write(new Date().getFullYear())</script> Veddic Tree.  <i class="mdi mdi-heart text-danger"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php $this->load->view("footd");?>

    <script type="text/javascript">
    $(document).ready(function(){
      $("#studentMobile").blur(function(){
        var flag = "true";
        var studentMobile = $(this).val();
        if(isNaN(studentMobile)){
          $("#error").show();
          $('.forgetbtn').attr('disabled', 'disabled');
          flag = "false";
        }else{
          $("#error").hide();
          $('.forgetbtn').removeAttr('disabled');
          flag = "true";
        }
        if(flag=="true")
        {
          $.ajax({

            type:"POST",
            data:{studentMobile:studentMobile},
            url:"<?php echo base_url('welcome/checkmobile')?>",
            success:function(data){
              console.log(data);
              if(data==1){
                color = Math.floor((Math.random() * 4) + 1);

                $.notify({
                    icon: "tim-icons icon-bell-55",
                    message: "Mobile Verify Successfully !"

                  },{
                      type: type[color],
                      timer: 8000,
                  });
              }else{
                color = Math.floor((Math.random() * 4) + 1);

                $.notify({
                    icon: "tim-icons icon-bell-55",
                    message: "Mobile Is Not Verify Successfully !"

                  },{
                      type: type[color],
                      timer: 8000,
                  });
                $('.forgetbtn').attr('disabled', 'disabled');
              }
            },
            error:function(error){

            }


          })
        }
        
      });


       $(".forgetbtn").click(function(){
        var flag = "true";
        var UserMobile = $("#studentMobile").val();
        if(isNaN(UserMobile) || UserMobile==""){
          $("#error").show();
          $('.forgetbtn').attr('disabled', 'disabled');
          flag = "false";
        }else{
          $("#error").hide();
          $('.forgetbtn').removeAttr('disabled');
          flag = "true";
        }

        });
        


    });
  </script>



