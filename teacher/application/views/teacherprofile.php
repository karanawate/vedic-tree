<?php
    $usersession    = $this->session->userdata('usersession');
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
<style>
    /** * Responsive Bootstrap Tabs by @hayatbiralem * 15 May 2015 */
 @media screen and (max-width: 479px) {
	 .nav-tabs-responsive > li {
		 display: none;
		 width: 23%;
	}
	 .nav-tabs-responsive > li > a {
		 max-width: 100%;
		 overflow: hidden;
		 text-overflow: ellipsis;
		 white-space: nowrap;
		 word-wrap: normal;
		 width: 100%;
		 width: 100%;
		 text-align: center;
		 vertical-align: top;
	}
	 .nav-tabs-responsive > li.active {
		 width: 54%;
	}
	 .nav-tabs-responsive > li.active:first-child {
		 margin-left: 23%;
	}
	 .nav-tabs-responsive > li.active, .nav-tabs-responsive > li.prev, .nav-tabs-responsive > li.next {
		 display: block;
	}
	 .nav-tabs-responsive > li.prev, .nav-tabs-responsive > li.next {
		 -webkit-transform: scale(0.9);
		 transform: scale(0.9);
	}
	 .nav-tabs-responsive > li.next > a, .nav-tabs-responsive > li.prev > a {
		 -webkit-transition: none;
		 transition: none;
	}
	 .nav-tabs-responsive > li.next > a .text, .nav-tabs-responsive > li.prev > a .text {
		 display: none;
	}
	 .nav-tabs-responsive > li.next > a:after, .nav-tabs-responsive > li.prev > a:after, .nav-tabs-responsive > li.next > a:after, .nav-tabs-responsive > li.prev > a:after {
		 position: relative;
		 top: 1px;
		 display: inline-block;
		 font-family: 'Glyphicons Halflings';
		 font-style: normal;
		 font-weight: 400;
		 line-height: 1;
		 -webkit-font-smoothing: antialiased;
		 -moz-osx-font-smoothing: grayscale;
	}
	 .nav-tabs-responsive > li.prev > a:after {
		 content: "\e079";
	}
	 .nav-tabs-responsive > li.next > a:after {
		 content: "\e080";
	}
	 .nav-tabs-responsive > li.dropdown > a > .caret {
		 display: none;
	}
	 .nav-tabs-responsive > li.dropdown > a:after {
		 content: "\e114";
	}
	 .nav-tabs-responsive > li.dropdown.active > a:after {
		 display: none;
	}
	 .nav-tabs-responsive > li.dropdown.active > a > .caret {
		 display: inline-block;
	}
	 .nav-tabs-responsive > li.dropdown .dropdown-menu.pull-xs-left {
		 left: 0;
		 right: auto;
	}
	 .nav-tabs-responsive > li.dropdown .dropdown-menu.pull-xs-center {
		 right: auto;
		 left: 50%;
		 -webkit-transform: translateX(-50%);
		 -moz-transform: translateX(-50%);
		 -ms-transform: translateX(-50%);
		 -o-transform: translateX(-50%);
		 transform: translateX(-50%);
	}
	 .nav-tabs-responsive > li.dropdown .dropdown-menu.pull-xs-right {
		 left: auto;
		 right: 0;
	}
}
/** * Demo Styles */
 .wrapper {
	 padding: 15px 0;
}
 .bs-example-tabs .nav-tabs {
	 margin-bottom: 15px;
}
 @media (max-width: 479px) {
	 #narrow-browser-alert {
		 display: none;
	}
}
 
        .nav>li>a {
            position: relative;
            display: block;
            padding: 10px 20px !important;
            width: auto !important;
        }
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
            color: #555;
            cursor: default;
            background-color: #fff;
            border: 1px solid #ddd;
            border-bottom-color: transparent;
            border-radius: 4px 4px 0 0;
        }
        .nav-tabs>li {
            float: left;
            margin-bottom: -1px;
        }
        .nav>li {
            position: relative;
            display: block;
        }
        /*Profile Pic Start*/
        .picture-container{
            position: relative;
            cursor: pointer;
            text-align: center;
        }
        .picture{
            width: 150px;
            height: 150px;
            background-color: #999999;
            border: 4px solid #CCCCCC;
            color: #FFFFFF;
            /*border-radius: 50%;*/
            margin: 0px auto;
            overflow: hidden;
            transition: all 0.2s;
            -webkit-transition: all 0.2s;
        }
        .picture:hover{
            border-color: #2ca8ff;
        }
        .content.ct-wizard-green .picture:hover{
            border-color: #05ae0e;
        }
        .content.ct-wizard-blue .picture:hover{
            border-color: #3472f7;
        }
        .content.ct-wizard-orange .picture:hover{
            border-color: #ff9500;
        }
        .content.ct-wizard-red .picture:hover{
            border-color: #ff3b30;
        }
        .picture input[type="file"] {
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }

        .picture-src{
            width: 100%;
            
        }
        /*Profile Pic End*/
        .example {
            margin-bottom: 20px;
            margin-top: 10px;
        }


        .nav-tabs {
            white-space: nowrap;
            overflow-x: auto;
            overflow-y: hidden;
        }
        .nav-tabs > li {
            float: none;
            display: inline-block;
        }

        @media (min-width: 769px) {
            .reset-credentials {
                display: grid;
                grid-template-columns: 0.5fr 0.5fr 0.5fr;
                column-gap: 50px;   
            }
        }
        @media (max-width: 768px) {
            .reset-credentials {
                display: grid;
                grid-template-rows: 1fr 1fr;
                row-gap: 50px;
            }
        }
        .error {
    color: red;
}

.picture {
    width: 150px;
    height: 150px;
    background-color: #999999;
    border: 4px solid #CCCCCC;
    color: #FFFFFF;
    /* border-radius: 50%; */
    margin: 0px auto;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
    display: hidden;
    display: none;
}
#successMessage
{
    display:none;
}
    </style>
    <!-- Vedic Teacher header files Start -->
    <?php $this->load->view('teacher_header'); ?>
    <!-- Vedic Teacher header files End -->
</head>
<body>
    <?php $this->load->view('mobilemenu'); ?>
    <div class="boxes">
    <?php $this->load->view('teachersidebar'); ?>
        <div class="box11 animated_hero" style="background: #695FFE;">
            <div class="box-inside">
                <div class="desktop-mobile-view">
                    <!-- //top header -->
                    <?php $this->load->view('teacher_topheader'); ?>
                    <div>
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a data-toggle="tab" class="active" href="#teacher_info">Teacher Information</a></li>
                            <!-- <li><a data-toggle="tab" href="#change_password">Reset Password and PIN</a></li> -->
                        </ul>
                        <div class="tab-content">
                            <div id="teacher_info" class="tab-pane active">
                                <div class="py-3 teacher-info">
                                    <form method="POST" enctype="multipart/form-data"  action="<?php echo base_url('teacher/teacher_update'); ?>">
                                        <div class="row">
                                            <div class="profile-img col-lg-3 d-block d-sm-block d-md-none">
                                                <div class="picture-container">
                                                <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?bold=true&background=random&name=%22" alt="">   
                                                </div>
                                            </div>
                                            <div class="profile-info col-lg-9">
                                            <!-- <?php if($this->session->flashdata('msg')): ?>
                                            <p id="successMessage" class="alert alert-success"><?php echo $this->session->flashdata('msg'); ?></p>
                                            <?php endif; ?> -->


                                                <?php
                                            $message = $this->session->flashdata('msg');
                                            if (isset($message)) {
                                                echo '<div class="alert alert-info successMessage ">' . $message . '</div>';
                                                $this->session->unset_userdata('msg');
                                            }

                                            ?>

                                                <div class="row">
                                                    <input type="hidden" name="teacher_id" value="<?php echo $teacher_info[0]['teacherId'] ?>" />
                                                    <input type="hidden" name="teacherPass" value="<?php echo $teacher_info[0]['teacherPass'] ?>" />
                                                    <input type="hidden" name="teacherClass" value="<?php echo $teacher_info[0]['teacherClass'] ?>" />
                                                    <input type="hidden" name="teacherGender" value="<?php echo $teacher_info[0]['teacherGender'] ?>" />
                                                    <input type="hidden" name="teacherName" value="<?php echo $teacher_info[0]['teacherName'] ?>" />
                                                    <div class="form-group col-sm-6">
                                                        <label for="usr_firstname">First Name</label>
                                                        <input type="text" value="<?php echo $teacher_info[0]['usr_firstname'] ?>"
                                                        name="usr_firstname" class="form-control" placeholder="Enter First Name" >
                                                        <span style="color:red"><?php //echo form_error('usr_firstname');?></span>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="usr_lastname">Last Name</label>
                                                        <input type="text" value="<?php  echo $teacher_info[0]['usr_lastname']?>" name="usr_lastname" value="<?php echo $teacher_info[0]['usr_lastname'] ?>" class="form-control" placeholder="Enter Last Name" >
                                                        <span style="color:red"><?php //echo form_error('usr_lastname');?></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label for="usr_email">Email</label>
                                                        <input type="email" value="<?php echo $teacher_info[0]['teacherEmail'] ?>" name="teacherEmail" class="form-control" placeholder="Enter Email">
                                                        <span style="color:red"><?php //echo form_error('usr_email');?></span>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="usr_mobile_no">Mobile Number</label>
                                                        <input type="number" name ="teacherMobile" value="<?php echo $teacher_info[0]['teacherMobile'] ?>" class="form-control" placeholder="Mobile Number" >
                                                        <span style="color:red"><?php //echo form_error('usr_mobile_no');?></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label for="usr_landline">Landline</label>
                                                        <input type="text" maxlength="10" name="usr_landline" value="<?php echo $teacher_info[0]['usr_landline'] ?>"
                                                         class="form-control" name="usr_landline" placeholder="Enter Landline">
                                                        <span style="color:red"><?php //echo form_error('usr_landline');?></span>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="usr_dob">Date of birth</label>
                                                        <input type="date"  name="usr_dob" value="<?php echo $teacher_info[0]['usr_dob'] ?>" class="form-control" id="usr_dob"  >
                                                        <span style="color:red"><?php //echo form_error('usr_dob');?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="profile-img col-lg-3 d-none d-sm-none d-md-block">
                                                <div class="picture-container">
                                                    <div class="picture">
                                                         <img style="width: 145px;height: 169px;margin-top: -11px;" src="<?php //echo base_url('uploads/studetprofile/')?><?php echo $userinfo[0]['usr_profile'];?>"  id="wizardPicturePreview" title=""> -->
                                                        <!-- <input type="file" name="usr_profile" id="wizard-picture" class="" > -->
                                                    <!-- </div> -->
                                                    <!-- <h6 class="">Choose Picture</h6>
                                                    <span style="color:red"><?php //echo form_error('usr_profile');?></span> -->
                                                <!-- </div> -->
                                            </div> 
                                        </div>
                                        <h2>Other Information</h2>
                                        <div class="row">
                                            <div class="form-group col-sm-3">
                                                <label for="usr_add1">Adhar Number</label>
                                                <input type="text" value="<?php echo $teacher_info[0]['adhar_name']?>" name="adhar_name" class="form-control" data-type="adhaar-number" maxLength="14"  placeholder="Enter Adhar Number">
                                                <span style="color:red"><?php //echo form_error('adharno');?></span>
                                                <span id="adharerror" style="color:red;display:none;">Please Enter Valid Adhar Number</span>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label for="usr_add1">Religion</label>
                                                <input type="text" value="<?php echo  $teacher_info[0]['religion'] ?>"  name="religion" class="form-control" placeholder="Enter Student Religion">
                                                <span style="color:red"><?php //echo form_error('studentReligion');?></span>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label for="usr_add1" >Caste</label>
                                                <input type="text" value="<?php echo $teacher_info[0]['caste'] ?>"  name="caste" class="form-control" placeholder="Enter Cast">
                                                <span style="color:red"><?php //echo form_error('studentCaste');?></span>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label for="" >Sub-Caste</label>
                                                <input type="text" value="<?php echo  $teacher_info[0]['sub_caste'] ?>" name="sub_caste" class="form-control" placeholder="Enter Sub cast 1">
                                                <span style="color:red"><?php //echo form_error('studentSubcast');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-3">
                                                <label for="" >Pre school</label>
                                                <input type="text" value="<?php echo $teacher_info[0]['pre_school'] ?>"  name="pre_school" class="form-control" placeholder="Enter Preschool">
                                                <span style="color:red"><?php //echo form_error('preschool');?></span>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label for="usr_city">Mother Tounge</label>
                                                <input type="text" value="<?php echo  $teacher_info[0]['mother_tounge'] ?>" name="mother_tounge" class="form-control" placeholder="Enter Mother Tongue">
                                                <span style="color:red"><?php //echo form_error('mothertoungue');?></span>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label for="usr_add1" >Address 1</label>
                                                <input type="text" value="<?php echo $teacher_info[0]['usr_add1'] ?>" 
                                                 name="usr_add1" class="form-control" placeholder="Enter Address 1" value="Hello">
                                                <span style="color:red"><?php //echo form_error('usr_add1');?></span>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label for="usr_add2">Address 2</label>
                                                <input type="text" value="<?php echo $teacher_info[0]['usr_add2'] ?>"  name="usr_add2" class="form-control" placeholder="Enter Address 2">
                                                <span style="color:red"><?php //echo form_error('usr_add2');?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="form-group col-sm-3">
                                                <label for="usr_country">Statee</label>
                                                <input type="text" value="<?php echo $teacher_info[0]['usr_state'] ?>"  name="usr_state" class="form-control" placeholder="usr_state">
                                                <span style="color:red"><?php // echo form_error('usr_country');?></span>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label for="usr_city">City</label>
                                                <input type="text" value="<?php echo $teacher_info[0]['usr_city'] ?>"  name="usr_city" class="form-control" placeholder="Enter City">
                                                <span style="color:red"><?php //echo form_error('usr_city');?></span>
                                            </div>

                                          
                                            <div class="form-group col-sm-3">
                                                <label for="usr_country">Country</label>
                                                <input type="text" value="<?php echo $teacher_info[0]['usr_country'] ?>"  name="usr_country" class="form-control" placeholder="Enter Country">
                                                <span style="color:red"><?php // echo form_error('usr_country');?></span>
                                            </div>

                                        </div>
                                        <div class="form-button student-info d-flex justify-content-center">
                                            <input  type="submit" name="submit" value="Submit" class="submitemi btn btn-primary px-5"></input>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="<?php echo base_url()?>assets/js/bootstrap-notify.js"></script>
    
<script type="text/javascript">
        type = ['','info','success','warning','danger'];
</script>
<script>
$(document).ready(function(){
    setTimeout(function() {
    $(".successMessage").hide(3000);
}, 3000); 
});
</script>
<script>
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

    //   setTimeout(function() {
    //                 window.location.href = '<?php echo base_url('website/vedicprofile/4')?>';
    //    }, 2000);

  </script>

<?php } ?>

<script>
$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>



