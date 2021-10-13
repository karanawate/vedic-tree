<?php

    $usersession      = $this->session->userdata('usersession');
    $studentName      = $usersession[0]['studentName'];
    $usr_firstname    = $usersession[0]['usr_firstname'];
    $usr_lastname     = $usersession[0]['usr_lastname'];
    $studId           = $usersession[0]['studId'];
    if($usr_firstname==""){
      $studentName = $studentName;
    }else{
      $studentName = $usr_firstname.' '.$usr_lastname;
    }
    
    $payment_his_data        = payment_his_data($studId);
    
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F Y', $timestamp); 
    $fk_classId     = $usersession[0]['studentClass'];
    $className      = "";
    if($fk_classId==1){
        $className =  "Nursery";
    }elseif($fk_classId==2){
        $className =  "Junior Kg";
    }elseif($fk_classId==3){
        $className =  "Senior Kg";
    }else{
        $className = "No Class Allowed";
    }


    $monthdata      = required_data();
    $adminRole = $monthdata['open_monthdata'][0]['adminRole'];
    $getChatData = getChatData_today_count();
    
?>
<style>
body {
        font-family: Roboto,sans-serif !important;
    }
    .navigation {
  width: 100%;
  background-color: black;
}

img {
  width: 30px;
}

.logout {
    font-size: 14px;
    font-weight: 500;
    position: relative;
    color: black;
    right: -8px;
    bottom: -5px;
    overflow: hidden;
    letter-spacing: 3px;
    opacity: 1;
    transition: opacity .45s;
    -webkit-transition: opacity .35s;
  
}

.logout-button {
    display: flex;
    float: right;
    padding: 5px;
    margin: 15px 15px 0 0;
    width:120px;
    background-color: balck;
    transition: width .35s;
    -webkit-transition: width .35s;
    overflow: hidden;
    border-radius: 20px;
    box-shadow: 1px 1px 3px 1px rgb(0 0 0 / 20%);
}


a {
  text-decoration: none;
}
.important-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
}
.notifications {
    display: flex;
    justify-content: center;
}


.switch {
        position: relative;
        display: inline-block;
        width: 105px;
        height: 40px;
    }

    .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        z-index: 2;
        height: 30px;
        width: 30px;
        left: 5px;
        bottom: 5px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }
    input:checked + .slider .slide-text {
        display: none;
    }
    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(65px);
        -ms-transform: translateX(65px);
        transform: translateX(65px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .slide-text {
        position: absolute;
        right: 5px;
        top: 10px;
        width: 65px;
        color: #695ffe;
        line-height: 1;
        font-size: 10px;
        text-align: center;
    }
    .header-item {
        height: 60px !important;
        width: 50px !important;
    }
    .box2 .class-time {
        display: grid;
        grid-template-columns: 1fr auto;
        grid-gap: 5px;
        font-family: 'Source Sans Pro', sans-serif;
    }
</style>

<?php if($monthdata['open_monthdata'][0]['dob_certificate']=="" || $monthdata['open_monthdata'][0]['usr_add1']=="" || $monthdata['open_monthdata'][0]['usr_add2']=="" || $monthdata['open_monthdata'][0]['usr_state']=="" ){ ?>

<div class="overlay">
       <div id="profileUpdate" class="popup panel panel-primary">
           <div class="d-flex justify-content-between panel-footer" style="">
               <div><i class="fa fa-exclamation-triangle mr-2" style="color: red;" aria-hidden="true"></i>Please Update Profile Page<a style="font-size: 12px;" href="<?php echo base_url('website/vedicprofile/4'); ?>">  Click here!</a></div>
               <div id="close"><i class="far fa-times-circle" aria-hidden="true"></i></div>
           </div>
       </div>
   </div>


    <?php } ?>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<?php  $getChatData = count($getChatData); 
if($getChatData > 0 ){
?>
 <input type="hidden" id="countmessgae" value="<?php  echo "You have ".$getChatData." Message ";  ?>">
<?php } ?>
        
        
<div class="box2">
    <div class="profile-info">
        <div class="username">Hello <span><?php echo ucwords($studentName); ?></span></div>
        <div class="date">Date:<span class="ml-1"><?php date_default_timezone_set('Asia/Kolkata'); echo $newDate ?></span></div>
        <div class="date class-time">
            <div class="">Class:<span class="ml-1"><?php if($payment_his_data){ echo $payment_his_data[0]['packageName']; }else{ echo $className; } ?></span></div>
            <div id="ct71"><?php  date("H:i:s" , time()); ?></div>
        </div>
    </div>
    <div class="important-actions">
        <div class="logout-view">
            <div class="navigation">
                <a class="logout-button" href="<?php echo base_url('website/logout');?>"><img src="<?php echo base_url()?>assets/website/img/logout.jpg" style="width: 30px;" alt="logout"><span class="logout">LOGOUT</span></a>
            </div>
        </div>
        <div class="toggle-parent-mode">
            <label class="switch">
                <input type="checkbox" id="toggleMode" class="toggle-mode" />
                <span class="slider round">
                    <?php if($adminRole==0){ ?>
                    <span class="slide-text">Slide to Parent Mode</span>
                    <?php } elseif($adminRole==1){ ?>
                    <span class="slide-text">Slide to Student Mode</span>
                    <?php } ?>
                </span>
            </label>
        </div>
        
        <div class="notification">
            <div class="dropdown">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-bell-outline" style="font-size: 34px;"></i>
                    <span class="badge badge-danger badge-pill blink_me" style="position: relative;top: -20px;right: 25px;background: red;">
                        <?php         
                             $notification = notification();
                             $tbl_notification_live_class = tbl_notification_live_class();

                             $combinearray = array();
                             if(!empty($tbl_notification_live_class) && !empty($notification)){
                                $mergrarray = array_merge($tbl_notification_live_class,$notification);
                             }else{
                                if($notification){

                                        $mergrarray = $notification;
                                    }else{
                                        $mergrarray = $tbl_notification_live_class;

                                    }
                             }

                             foreach ($mergrarray as $key => $value) {
                                 if(isset($value['microsoft_link'])){
                                    $microsoft_link = $value['microsoft_link']; 
                                 }else{
                                    $microsoft_link = "";
                                 }
                                 if(isset($value['noticedesc'])){
                                    $noticedesc = $value['noticedesc']; 
                                 }else{
                                    $noticedesc = "";
                                 }
                                $combinearray[] = array($value,'microsoft_link'=>$microsoft_link,'noticedesc'=> $noticedesc);
                             }

                                $notification_count = count($combinearray);

                                if(isset($notification_count))
                                {
                                     echo  $notification_count = $notification_count; 
                                }else{
                                      echo $notification_count = '0';
                                }
                        ?> 
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col ">
                                <?php 

                            $notification = notification();
                             $tbl_notification_live_class = tbl_notification_live_class();

                             $combinearray = array();
                             if(!empty($tbl_notification_live_class) && !empty($notification)){
                                $mergrarray = array_merge($tbl_notification_live_class,$notification);
                             }else{
                                if($notification){

                                        $mergrarray = $notification;
                                    }else{
                                        $mergrarray = $tbl_notification_live_class;

                                    }
                             }

                             foreach ($mergrarray as $key => $value) {
                                 if(isset($value['microsoft_link'])){
                                    $microsoft_link = $value['microsoft_link']; 
                                 }else{
                                    $microsoft_link = "";
                                 }
                                 if(isset($value['noticedesc'])){
                                    $noticedesc = $value['noticedesc']; 
                                 }else{
                                    $noticedesc = "";
                                 }
                                $combinearray[] = array($value,'microsoft_link'=>$microsoft_link,'noticedesc'=> $noticedesc);
                             }

                                $notification_count = count($combinearray);
                                if(isset($notification_count)){   $notification_count = $notification_count; } else { $notification_count = '0'; } ?>
                                <h5 class="m-0 font-size-16 "> Notifications (<?php echo $notification_count; ?>) </h5>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;overflow-y: auto;">
                        <?php
                             $notification = notification();
                             $tbl_notification_live_class = tbl_notification_live_class();

                             $combinearray = array();
                             if(!empty($tbl_notification_live_class) && !empty($notification)){
                                $mergrarray = array_merge($tbl_notification_live_class,$notification);
                             }else{
                                if($notification){

                                        $mergrarray = $notification;
                                    }else{
                                        $mergrarray = $tbl_notification_live_class;

                                    }
                             }

                             foreach ($mergrarray as $key => $value) {
                                 if(isset($value['microsoft_link'])){
                                    $microsoft_link = $value['microsoft_link']; 
                                 }else{
                                    $microsoft_link = "";
                                 }
                                 if(isset($value['noticedesc'])){
                                    $noticedesc = $value['noticedesc']; 
                                 }else{
                                    $noticedesc = "";
                                 }
                                $combinearray[] = array($value,'microsoft_link'=>$microsoft_link,'noticedesc'=> $noticedesc);
                             }

                            if(!empty($combinearray)){
                                foreach ($combinearray as $key => $value) {
                        ?>
                        <a href="" class="text-reset notification-item">
                            <div class="media mt-0">
                                <div class="media-body" style="padding:12px;background: aliceblue;">
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1 "><?php echo $value['noticedesc']; ?></p>
                                        <p class="mb-1 "><a href="<?php echo $value['microsoft_link'];?>" target="_blank"> Click Here For Join Today Session</a></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-img">
        <div class="">
            <?php 

            if(!empty($usersession[0]['usr_profile'])){
                $usr_profile = $usersession[0]['usr_profile'];
            }else{
                $usr_profile = "about_img_3.png";
            }
            ?>
            <img src="<?php echo base_url('uploads/studetprofile/')?><?php echo $usr_profile;?>" style="width:100px; height:100px; border-radius: 100px;">
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="dummyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered parent-pin-input" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">PARENT PIN Input</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form name="form-pin" id="form_pin" method="POST">
            <div class="modal-body d-flex">
                <div>
                    <input type="password" id="current_pin" onkeypress="return isNumberKey(event)" value="" name="current_pin" class="form-control" maxlength="4" placeholder="Enter PIN" required>
                    <span onclick="show('current_pin')" class="far fa-eye eye-toggle"></span>
                    <span style="color:red" id="current_pin_error"></span>
                </div>
                
            </div>
        </form>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary pinbtn">Enter<i class="fa fa-long-arrow-right ml-3" aria-hidden="true"></i></button>
        </div>
    </div>
  </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

function display_ct7() {
var x = new Date()
var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
hours = x.getHours( ) % 12;
hours = hours ? hours : 12;
hours=hours.toString().length==1? 0+hours.toString() : hours;

var minutes=x.getMinutes().toString()
minutes=minutes.length==1 ? 0+minutes : minutes;

var seconds=x.getSeconds().toString()
seconds=seconds.length==1 ? 0+seconds : seconds;

var month=(x.getMonth() +1).toString();
month=month.length==1 ? 0+month : month;

var dt=x.getDate().toString();
dt=dt.length==1 ? 0+dt : dt;

var x1=month + "/" + dt + "/" + x.getFullYear(); 
x1 =  hours + ":" +  minutes + ":" +  seconds + " " + ampm;
document.getElementById('ct7').innerHTML = x1;
display_c7();
 }
 function display_c7(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct7()',refresh)
}
display_c7()
</script>


<script>
$("#toggleMode").click(function(){
    if($('input[type="checkbox"]').is(':checked')) {
        $('#dummyModal').modal('show');
        $("#dummyModal").appendTo("body");
        $("#dummyModal").on('hide.bs.modal', function(){
            $(this).find('#form_pin')[0].reset();
            $('.toggle-mode').prop('checked', false);
        });
    } else {
        $('#dummyModal').modal('hide');
    }
});


$( document ).ready(function() {
    $(".digit").keyup(function(event){
        if ($(this).next('[type="password"]').length > 0){
            $(this).next('[type="password"]')[0].focus();
        }else{
            if ($(this).parent().next().find('[type="password"]').length > 0){
                $(this).parent().next().find('[type="password"]')[0].focus();
            }
        }
    });
});

function show(eventName) {
  var password = document.getElementById(eventName);
  var viewpassword = password.nextElementSibling
  if (password.getAttribute('type') == "password") {
    viewpassword.removeAttribute("class");
    viewpassword.setAttribute("class","far fa-eye-slash eye-toggle");
  password.removeAttribute("type");
  password.setAttribute("type","text");
  } else {
    password.removeAttribute("type");
    password.setAttribute('type','password');
    viewpassword.removeAttribute("class");
    viewpassword.setAttribute("class","far fa-eye eye-toggle");
  }
}

function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
  return false;

  return true;
}

</script>

<script type="text/javascript">
  

$(document).ready(function(){


  $(".pinbtn").click(function(){

    var current_pin = $("#current_pin").val(); 

     if(current_pin=="" || current_pin ==null){

        $("#current_pin_error").html('Please Enter Pin Number');
         return false;
    }else{

          $("#current_pin_error").html('');
        $.ajax({
          type:"POST",
          data:{current_pin:current_pin},
          url:"<?php echo base_url('website/change_pin'); ?>",
          success:function(res){
            console.log(res);

            if(res==1){
               swal("Pin Set successfully");
              window.location.href = "vedic_dash/1";
            }else{
               location.reload();
               window.location.replace = "<?php echo base_url('website/vedic_dash/1'); ?>";
            }
            
          },
          error:function(error){

          }
         });
    };

});


$('#current_pin').keydown(function (e) {

 if (e.keyCode == 13) {

    var current_pin = $("#current_pin").val(); 

     if(current_pin=="" || current_pin ==null){

        $("#current_pin_error").html('Please Enter Pin Number');
         return false;
    }else{

          $("#current_pin_error").html('');
        $.ajax({
          type:"POST",
          data:{current_pin:current_pin},
          url:"<?php echo base_url('website/change_pin'); ?>",
          success:function(res){
            console.log(res);
            if(res==1){
               swal("Pin Number Set successfully");
              window.location.href = "vedic_dash/1";
            }else if(res==2){
                 swal("Pin Number Verify successfully");
               window.location.replace("<?php echo base_url('website/vedic_dash/1'); ?>");
            }
            
          },
          error:function(error){

          }
         });
    };

}
});



});


$(document).ready(function () {
    //select the POPUP FRAME and show it
var  messge = $("#countmessgae").val();
   if(typeof(messge)  === "undefined") 
   {
       
   }else{
    Push.create(messge);  
  }
   
   
    $("#profileUpdate").hide().fadeIn(1000);
    //close the POPUP if the button with id="close" is clicked
    $("#close").on("click", function (e) {
        e.preventDefault();
        $(".overlay").hide();
        $("#profileUpdate").fadeOut(1000);
    });
});

</script>


