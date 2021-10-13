<!DOCTYPE html>
<html lang="zxx">
<head>
    <style>
        @media (min-width: 769px) {
        .login-box {
                background: #fff;
                padding: 40px;
                border-radius: 20px;
                box-shadow: 1px 1px 3px 1px rgb(0 0 0 / 20%);
                max-width: 500px;
                margin: auto;
            }
        }
        @media (max-width: 768px) {
        .login-box {
                background: #fff;
                padding: 20px;
                border-radius: 20px;
                box-shadow: 1px 1px 3px 1px rgb(0 0 0 / 20%);
                max-width: 500px;
                margin: auto;
            }
        }
        .login-box .social-login{
            position: relative;
        }
        .login-box .or-text {
            display: block;
            width: 100%;
            height: 1px;
            background: #b2b2b2;
            margin: 29px 0;
            position: relative;
        }
        .login-box .or-text:before {
            content: "OR";
            position: absolute;
            left: 0;
            right: 0;
            top: -15px;
            text-align: center;
            margin: 0 auto;
            width: 30px;
            line-height: 30px;
            background: #fff;
            font-style: normal;
            color: #b2b2b2;
        }
        .btn.elementor-button-text {
            opacity: 1;
        }
        .forgot-password a {
            color: #fe4b7b;
        }
        .forgot-password a:hover {
            color: #fe4b7b;
        }
        .password-toggle {
            cursor: pointer;
            float: right;
            margin-top: -27px;
            padding-right: 10px
        }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Vedic Tree</title>
    <link rel="icon" href="<?php echo base_url()?>assets/website/img/favicon.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/bootstrap.min.css" />
    <!-- animate CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/animate.css" />
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/fontawesome/css/all.min.css" />
    <!-- elegent icon CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/themefy_icon/themify-icons.css" />
    <!-- nice select CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/niceselect/css/nice-select.css" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/owl_carousel/css/owl.carousel.css" />
    <!-- magnify popup CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/magnify_popup/magnific-popup.css" />
    <!-- style CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />
</head>

<body>
    
    <?php $this->load->view('web_header'); ?>

    <section class="otp_verify_section section_padding">
        <div class="container">
            <div class="login-rainbow-bg">
                <h2 class="d-flex justify-content-center kid_title mb-4" style="padding-top: 50px;"> <span class="title_overlay_effect">Login Here</span></h2>
                <form method="POST" action="<?php echo base_url('website/web_login')?>">
                    <div class="login-kids-bg">
                            <div class="login-box">
                            <div class="d-flex justify-content-center social-login">
                                <a href="<?php echo base_url()?>website/login"><img style="width: 200px;" src="<?php echo base_url()?>assets/website/img/google.png"></a>
                                <a href="#" onclick="fbLogin();" id="fbLink" >
                                            <img style="width:220px;margin-top: 15px;" src="<?php echo base_url('assets/images/fb-login-btn.png'); ?>">
                                </a> 
                            </div>
                            <span class="or-text">
                            </span>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Enter Mobile </label>
                                        <input type="text" maxlength="10"  class="form-control" name="studentMobile" value="<?php if(isset($_COOKIE["studentMobile"])) { echo $_COOKIE["studentMobile"]; } else{ echo set_value('studentMobile'); } ?>" required="" placeholder="Enter Phone">
                                        <span style="color:red"><?php echo form_error('studentMobile');?></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Enter Password</label>
                                        <input type="password" id="password" class="form-control" name="studentPass" value="<?php if(isset($_COOKIE["studentPass"])) { echo $_COOKIE["studentPass"]; }else { echo set_value('studentPass'); } ?>" required="" placeholder="Enter password">
                                        <span class="far fa-eye password-toggle" id="togglePassword"></span>
                                        <span style="color:red"><?php echo form_error('studentPass');?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline">Remember me</label>
                                </div>
                                <div class="forgot-password"><a href="<?php echo base_url()?>forget-password">Forgot Password?</a></div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="pc-button elementor-button" href="#">
                                    <div class="button-content-wrapper">
                                        <button class="btn elementor-button-text"type="submit" value="submit" name="submit">Login</button>
                                        <svg class="pc-dashes inner-dashed-border animated-dashes">
                                            <rect x="5px" y="5px" rx="25px" ry="25px" width="0" height="0"></rect>
                                        </svg> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- contact page end -->
    <?php $this->load->view('web_footer'); ?>
</body>
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

<?php if(isset($social)){ ?>
<script type="text/javascript">
    color = Math.floor((Math.random() * 4) + 1);
    $.notify({
        icon: "tim-icons icon-bell-55",
        message: "<?php if(isset($social)){ echo $error['error']; } ?>"
    },{
        type: type[color],
        timer: 8000,
    });
    setTimeout(function() {
                window.location.href = '<?php echo base_url('website/nextstep')?>';
    }, 2000);
</script>

<?php } ?>
</html>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
    });
    
</script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



<script>



window.fbAsyncInit = function() {
    // FB JavaScript SDK configuration and setup
    FB.init({
      appId      : '941432073065365', // FB App ID
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v3.2' // use graph api version 2.8
    });
    
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            getFbUserData();
        }
    });
};

// Load the JavaScript SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));





function fbLogin() {
    FB.login(function (response) {
        if (response.authResponse) {
            // Get and display the user profile data
            getFbUserData();
        } else {
            document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
        }
    }, {scope: 'email'});
}




function getFbUserData(){
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
    function (response) {
        console.log(response);
        return false;
        var email = response.email;
        var first_name = response.first_name;
        var last_name = response.last_name;
        $.ajax({
            type:"POST",
            data:{email:email,first_name:first_name,last_name:last_name},
            url:"<?php echo base_url('website/fblogin')?>",
            success:function(res){
                console.log(res);
                if(res==1){
                    window.location.href = '<?php echo base_url('website/nextstep')?>';
                }else if(res==2){
                    window.location.href = '<?php echo base_url('website/vedic_dash')?>';
                }else{
                    console.log("i am not going anywhere");
                }
            },
            error:function(error){
                console.log(error);
            }
        })
    });
}



function fbLogout() {
    FB.logout(function() {
    });
}


</script>