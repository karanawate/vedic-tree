<!DOCTYPE html>
<html lang="zxx">
<!-- Web Header starts -->
<?php $this->load->view('web_header'); ?>
<!-- Web Header starts -->
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WMSPB64"
    height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- contact page -->
<section class="contact_page section_padding">
    <div class="container">
        <div class="login-rainbow-bg">
            <h2 class="d-flex justify-content-center kid_title mb-4" style="padding-top: 50px;"><span class="title_overlay_effect">Register Here</span></h2>
            <form method="POST" action="<?php echo base_url('website/contact')?>">
                <div class="login-kids-bg">
                    <div class="signup-box">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="required-label">Enter Child's Full Name</label>
                                    <input type="text" id="studentName" name="studentName" class="form-control" value="<?php echo set_value('studentName');?>" placeholder="Enter Full Child Name" required>
                                </div>
                                <span style="color:red"><?php echo form_error('studentName');?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="required-label">Enter Email</label>
                                    <input type="email" id="studentEmail" value="<?php echo set_value('studentEmail');?>" name="studentEmail" class="form-control" placeholder="Enter Email" required>
                                    <span style="color:red"><?php echo form_error('studentEmail');?></span>
                                    <span  id="studentEmailErr"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="required-label">Enter Mobile</label>
                                    <input type="text" id="studentMobile" value="<?php echo set_value('studentMobile');?>" maxlength="10" name="studentMobile" class="form-control" placeholder="Enter Mobile" required>
                                    <span style="color:red"><?php echo form_error('studentMobile');?></span>
                                    <span id="studentMobileErr"></span>
                                </div>
                            </div>
                        </div>
                        
                        <?php if($promoCode!="freeEducation"){ ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Enter Promo Code (Optional) </label>
                                    <input type="text" id="promoCode" value="<?php if($prcode){ echo $prcode; }else{ echo set_value('promoCode'); } ?>" class="form-control" name="promoCode" placeholder="Enter Promo Code">
                                    <span style="color:red"><?php echo form_error('promoCode');?></span>
                                    <span  id="promoCodeErr"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Enter Referral Code (Optional) </label>
                                    <input type="text" id="refferalCode" value="<?php echo set_value('refferalCode'); ?>" class="form-control" name="refferalCode" placeholder="Enter Refferal Code">
                                    <span style="color:red"><?php echo form_error('refferalCode');?></span>
                                    <span  id="refferalCodeErr"></span>
                                </div>
                            </div>
                        </div>
                        <?php }else{ ?>

                            <input type="hidden" id="promoCode" value="<?php if($prcode){ echo $prcode; }else{ echo set_value('promoCode'); } ?>" class="form-control" name="promoCode" placeholder="Enter Promo Code">

                        <?php } ?>
                        
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="required-label">Enter Password</label>
                                    <input type="password" id="password" value="<?php echo set_value('studentPass');?>" class="form-control" name="studentPass" placeholder="Enter Password" autocomplete="on" required>
                                    <span class="far fa-eye password-toggle" id="togglePassword"></span>
                                    <span style="color:red"><?php echo form_error('studentPass');?></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="required-label">Enter Confirm Password</label>
                                    <input type="password" id="passwordConfirm" value="<?php echo set_value('studentCPass');?>" class="form-control" name="studentCPass" placeholder="Enter Confirm Password" autocomplete="on" required>
                                    <span class="far fa-eye password-toggle" id="togglePasswordConfirm"></span>
                                    <span style="color:red"><?php echo form_error('studentCPass');?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="required-label">Enter Age</label>
                                    <input type="number" id="agecal" maxlength="1" value="<?php echo set_value('age');?>" class="form-control" name="age" placeholder="Enter Age Between 2.5 to 6 Year" required>
                                    <span style="color:red"><?php echo form_error('age');?></span>
                                    <span  id="agecalErr"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="required-label" >Enter City</label>
                                    <input type="text" id="" value="<?php echo set_value('usr_city');?>" class="form-control" name="usr_city" placeholder="Enter City Name" required >
                                    <span style="color:red"><?php echo form_error('usr_city');?></span>
                                    <span  id="promoCodeErr"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="required-label">Select Class</label>
                                    <select name="studentClass" class="form-control" id="selectClass" required>
                                        <option value="0" disabled selected>Select Class </option>
                                        <option value="1" <?php echo set_select('studentClass', '1'); ?>>Nursery</option>
                                        <option value="2" <?php echo set_select('studentClass', '2'); ?>>Junior Kg</option>
                                        <option value="3" <?php echo set_select('studentClass', '3'); ?>>Senior Kg</option>
                                    </select>
                                    <span style="color:red"><?php echo form_error('studentClass');?></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <div class="mt-2">
                                        <label class="radio-inline mr-2"><input type="radio" id="genderMale" name="studentGender" value="Male" checked> Male</label>
                                        <label class="radio-inline"><input type="radio" id="genderFemale" name="studentGender" value="Female"> Female</label>
                                    </div>
                                    <span style="color:red"><?php echo form_error('studentGender');?></span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a class="pc-button elementor-button" href="#">
                            <div class="button-content-wrapper">
                                <button class="btn elementor-button-text" type="submit" value="submit" name="submit" id="registerStudent">Submit</button>
                                <svg class="pc-dashes inner-dashed-border animated-dashes">
                                    <rect x="5px" y="5px" rx="25px" ry="25px" width="0" height="0"></rect>
                                </svg> 
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- footer part here -->
<?php $this->load->view('web_footer'); ?>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
    $("#promoCode").blur(function(){
        var promoCode = $(this).val();
        $.ajax({
            type:"POST",
            data:{promoCode:promoCode},
            url:"<?php echo base_url('website/checkpromocode'); ?>",
            success:function(res){
                if(res==0){
                    $("#promoCodeErr").html('Promo Code Does Not Exist !').css('color', 'red');
                    // $(".elementor-button-text").prop('disabled', false);
                }else if(res==2){
                    $("#promoCodeErr").html('Promo Code Expired !').css('color', 'red');
                }else{
                    $("#promoCodeErr").html('Promo Code Exist !').css('color', 'green');
                }
            },
            error:function(error){
                console.log(error);
            }
        });
    });

    $("#refferalCode").blur(function(){
        var refferalCode = $(this).val();
        $.ajax({
            type:"POST",
            data:{refferalCode:refferalCode},
            url:"<?php echo base_url('website/checkrefferalCode'); ?>",
            success:function(res){
                if(res==0){
                    $("#refferalCodeErr").html('Reffreal Code Does Not Exist !').css('color', 'red');
                    
                }else if(res==2){
                    $("#refferalCodeErr").html('Reffreal Code Expired !').css('color', 'red');
                   
                }else{
                    $("#refferalCodeErr").html('Reffreal Code Exist !').css('color', 'green');

                }
            },
            error:function(error){
                console.log(error);
            }
        });
    });
    
    $("#studentMobile").blur(function(){
        var studentMobile = $(this).val();
        if(studentMobile=="" || studentMobile==null){
            $("#studentMobileErr").html('Please Enter Mobile Number !').css('color', 'red');
        }else{
            $.ajax({
                type:"POST",
                data:{studentMobile:studentMobile},
                url:"<?php echo base_url('website/checkstudentMobile'); ?>",
                success:function(res){
                    if(res==1){
                        $("#studentMobileErr").html('Mobile Number Already Exist !').css('color', 'red');
                        $(".elementor-button-text").prop('disabled', true);
                    }else{
                        $("#studentMobileErr").html('');
                        $(".elementor-button-text").prop('disabled', false);
                    }
                },
                error:function(error){
                    console.log(error);
                }
            });
        }
    });
    
    $("#agecal").blur(function(){
        var agecal = $(this).val();
        console.log(agecal);
        if(agecal=="" || agecal==null || agecal < 2.5 || agecal > 6 ){
            $("#agecalErr").html('Please Enter Valid Age ').css('color', 'red');
            $(".elementor-button-text").prop('disabled', true);
        }else{
            $("#agecalErr").html('');
            $(".elementor-button-text").prop('disabled', false);
        }
    });
        
    $("#studentEmail").blur(function(){
        var studentEmail = $(this).val();
        if(studentEmail=="" || studentEmail==null){
            $("#studentEmailErr").html('Please Enter Email !').css('color', 'red');
        }else{
            $.ajax({
                type:"POST",
                data:{studentEmail:studentEmail},
                url:"<?php echo base_url('website/checkstudentEmail'); ?>",
                success:function(res){
                    if(res==1){
                        $("#studentEmailErr").html('Email Already Exist !').css('color', 'red');
                        $(".elementor-button-text").prop('disabled', true);

                    }else{
                        $("#studentEmailErr").html('');
                        $(".elementor-button-text").prop('disabled', false);
                    }
                },
                error:function(error){
                    console.log(error);
                }
            });
        }
    });
    
    $("#registerStudent").on("click", function () {
        if ($('#studentName').val() != '' && $('#studentEmail').val() != '' && $('#studentMobile').val() != '' && $('#selectClass option:selected').val() != '' && $('#password').val() != '' && $('#passwordConfirm').val() != ''){
            var classNameR = $('#selectClass option:selected').text();
            if (classNameR!="") {
                fbq('track', 'CompleteRegistration',{
                    content_name: classNameR,
                });
            }
        }
    });
});
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

  </script>
<?php } ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
 if(isset($errorsweet)){ ?>
  <script type="text/javascript">
    swal("<?php if(isset($errorsweet)){ echo nl2br($errorsweet['error']); } ?>");
    // setTimeout(function() {
    //                 window.location.href = '<?php echo base_url('register')?>';
    //   }, 5000);
  </script>
<?php } ?>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const passwordConfirm = document.querySelector('#passwordConfirm');
    const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');

    togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
    });

    togglePasswordConfirm.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordConfirm.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
    });
</script>

<script src="https://accounts.google.com/gsi/client" async defer /></script>


<script type="text/javascript">
window.onload = function () {
    google.accounts.id.initialize({
      client_id: '1008356199904-g9rhhgaq7ioh7nu4d7qn81dah91s6mom.apps.googleusercontent.com',
      callback: handleOnetapResponse
    });
    google.accounts.id.prompt();

}

function handleOnetapResponse(response) {
    // console.log(response);
    var credential = JSON.stringify(parseJwt(response.credential));
    $.ajax({
        type:"POST",
        data:{credential:credential},
        url:"<?php echo base_url('website/one_tap_google_login');?>",
        success:function(res){
            console.log(res);
            if(res==2){
                window.location.href = "website/vedic_dash";
            }else if(res==1){
                window.location.href = "website/nextstep";
            }else if(res==3){
                // window.location.href = "website/web_login";
            }
        },
        error:function(error){
        }
    })
}

function parseJwt (token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
}).join(''));
    return JSON.parse(jsonPayload);
};

</script>


