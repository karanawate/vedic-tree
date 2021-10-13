<?php

    $usersession    = $this->session->userdata('usersession');
    $studentName    = $usersession[0]['studentName'];
    $studId         = $usersession[0]['studId'];
    $studentEmail   = $usersession[0]['studentEmail'];
    $studentMobile  = $usersession[0]['studentMobile'];
    $fk_classId     = $usersession[0]['studentClass'];
    $unlockdayId    = $usersession[0]['unlockdayId'];
    $unlock_monthId = $usersession[0]['unlock_monthId'];
    $fk_teachId = "";
    $check_authrization      = check_authrization();
    $getChatData             = getChatData();
    $tbl_teacher_data        = tbl_teacher_data($fk_classId);
    $payment_his_data        = payment_his_data($studId);
    if($payment_his_data){
        $planId = $payment_his_data[0]['planId'];        
    }else{
        $planId = 0;
    }

    if($check_authrization){

    $fk_teachId = $check_authrization[0]['fk_teachId'];
    }else{
    $fk_teachId = 0;

    }

?>
<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#fe4b7b">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#fe4b7b">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#fe4b7b">
<title>Vedic Tree</title>
<link rel="icon" href="<?php echo base_url()?>assets/website/img/favicon.png">
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/animate.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/vedicdash.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/themefy_icon/themify-icons.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/niceselect/css/nice-select.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/owl_carousel/css/owl.carousel.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/magnify_popup/magnific-popup.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/chat-window.css" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!-- ////////////////////////////////////////////////////////////////////// -->
<link href="<?php echo base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url()?>assets/website/css/chat.css" rel="stylesheet" />

<!-- ////////////////////////////////////////////////////////////////////// -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
    
<style>
     .myvideo{
            border:2px solid;
            width: 300px;
            height: 300px;
        }
        
</style>    
    
    
</head>


<body>
    <!-- Simulate a smartphone / tablet -->
    <?php $this->load->view('mobilemenus'); ?>
    <!-- End smartphone / tablet look -->
    <div class="boxes">
        <?php $this->load->view('websitesidebar'); ?>
        <div class="box11">
            <div class="box-inside">
                <div class="desktop-mobile-view">
                    <!-- //top header -->
                    <?php $this->load->view('topheader'); ?>
                    <!-- //end top header -->
                    <h2>Chat</h2>
                     <!--<div>Video Chat <video id="video" autoplay ></video></div>-->
                     
                    <!-- <div>Video Chat -->
                    <!--                <div id="video" class="myvideo" width="200px;" height="200px;" autoplay>ourvideo</div>-->
                    <!--                <div id="remoteVideo" class="myvideo" width="200px;" height="200px;" autoplay>remotevideo</div>-->
                    <!--    </div>-->
                    <!--    <span id="ShowPeerId"></span>-->
                    <!--<input type="text" id="peerId" name=""><button class="btn btn-primary" onclick="call()">Call</button>-->
                         
                    <div class="chat-window">
                        <div class="teacher-profile">
                            <div class="teacher-img"><img src="<?php echo base_url()?>assets/website/img/teacherimg.png" alt="Teacher Img"></div>
                            <?php if($tbl_teacher_data){
                                if($tbl_teacher_data[0]['logstatus']==1){ ?>
                                <div class="status" style="color:green">● <span>Online</span></div>
                            <?php }else{ ?>
                                <div class="status" style="color:red">● <span>Offline</span></div>
                            <?php } } ?>
                            <div class="teacher-details name">
                                <div class="name-label">Teacher Name:</div>
                                <div class="name"><?php if($tbl_teacher_data){ echo $tbl_teacher_data[0]['teacherName']; }else{ echo " No Name Found "; } ?></div>
                            </div>
                            <div class="teacher-details email">
                                <div class="email-label">Teacher Email:</div>
                                <div class="email"><i class="fa fa-envelope-o mr-2" aria-hidden="true"></i><?php if($tbl_teacher_data){ echo $tbl_teacher_data[0]['teacherEmail']; }else{ echo " No Name Found "; } ?></div>
                            </div>
                            <div class="teacher-details contact" style="display: none">
                                <div class="contact-label">Teacher Contact:</div>
                                <div class="contact"><i class="fa fa-mobile mr-2" aria-hidden="true"></i>+91 <span><?php if($tbl_teacher_data){ echo $tbl_teacher_data[0]['teacherMobile']; }else{ echo " No Name Found "; } ?></span></div>
                            </div>
                        </div>
                       
                        <div class="conversation-section">
                            <div class="title-area d-flex justify-content-between">
                                <div style="display: flex;align-items: center;">Chat with teacher</div>
                                
                                <div id="<?php echo $studId; ?>" class="clearchat" style="font-size: 16px; display: none;"><i class="fa fa-trash-o mr-2" style="font-size: 20px;" aria-hidden="true"></i>Clear Chat</div>
                            </div>
                            
                            <div class="msger-chat" id="message_area" >
                                <?php
                                $color="";
                                $me = "";
                                $side= "";
                                $img = "";
                                if(!empty($getChatData)) {
                                foreach ($getChatData as $key => $value) {
                                    if($usersession[0]['studId']==$value['fk_studId']){
                                        $me = "Me";
                                        $side = "right-msg";
                                        $margin = "margin:-12px";
                                        $color = "#".str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                                        $img =  base_url('uploads/chatimgup/'.$value['chatimgup']);
                                        $icon = "fa fa-check-circle-o";
                                    }else{
                                        $me="Teacher";
                                        $side = "left-msg";
                                        $margin = "margin:12px";
                                        $color = "#".str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                                        $img = base_url('teacher/uploads/chatimgup/'.$value['chatimgup']);
                                        $icon = "";
                                    }
                                ?>
                                <div class="msg <?php echo $side; ?>">
                                    <div class="msg-bubble">
                                        <?php if(!empty($value['chatimgup'])) { ?>
                                        <a download href="<?php echo $img; ?>">
                                            <img class='send-recieve-img' src="<?php echo $img; ?>">
                                        </a>
                                        <?php } ?>
                                        <div class="msg-text" style="color: black;">
                                            <?php echo $value['chatMsg'];?>
                                            <input type="hidden" id="chathistoryMessage" value="<?php echo $value['chatMsg'];?>">
                                        </div>
                                        <div class="mt-2 time-icon">
                                            <i class="<?php echo $icon;?>" aria-hidden="true"></i>
                                            <div class="ml-3 msg-info-time"><?php date_default_timezone_set("Asia/Kolkata"); echo date('H:i ',strtotime($value['currentDate']) );?></div>
                                        </div>
                                    </div>
                                </div>
                                <?php  } } else { echo "No Chat Found"; }?>
                            </div>
                            <form class="msger-inputsend-area" enctype="multipart/form-data"  id="chat_form" method="POST">
                                <textarea class="msger-input" id="emojionearea" placeholder="Enter your message..."></textarea>
                                <input type="hidden" value="<?php echo $studId; ?>" id="studId" name="studId">
                                <input type="hidden" value="<?php echo $planId; ?>" id="planId" name="planId">
                                <input type="hidden" value="<?php echo $fk_teachId; ?>" id="fk_teachId" name="fk_teachId">
                                <div style="padding: 5px 10px;font-size: 20px;">
                                    <input type="file" name="chatimgup" id="OpenImgUpload" style="display:none"/> 
                                    <i id="imgupload"  type="submit" class="fa fa-paperclip" aria-hidden="true" ></i>
                                </div>
                                <div><button type="submit" class="msger-sendbtn"><i class="fa fa-paper-plane p-0 mr-2" aria-hidden="true"></i>Send</button></div>
                            </form>
                            <span id="chat_messagerr" style="color:red;display:none;">Please Enter Message</span>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</body>
</html>


  
<script type="text/javascript">


$(document).ready(function(){
    
    $("#emojionearea1").emojioneArea({
  	pickerPosition: "top",
    toneStyle: "bullet",
    filtersPosition: "bottom",
    tones: false,
    autocomplete: false,
    search: false,
    hidePickerOnBlur: false
  });
    
    $(".clearchat").click(function(){
    var userid = $(this).attr('id');
    $.ajax({
        type:"POST",
        data :{userId:userid},
        url:"<?php echo base_url('website/Clearchat')?>",
        success:function(resp){
           if(resp==1){
             location.reload(); 
           }else{
             return false;
           }
          }
    });

  });

    $("#chat_form").on('submit',function(event){

        event.preventDefault();

            var studId        = $("#studId").val();
            var fk_teachId    = $("#fk_teachId").val();
            var planId        = $("#planId").val();
            var chat_message  = $(".msger-input").val();
            var flag          = "true";
            if( chat_message == "" ) {
              $("#chat_messagerr").show();
            }else{
            $("#chat_messagerr").hide();
            $.ajax({
            type:"POST",
            data :{studId:studId,message:chat_message,fk_teachId:fk_teachId,planId:planId },
            url:"<?php echo base_url('website/chat_with_teacher_msg'); ?>",
            success:function(resp){
                console.log(resp);
                $("#emojionearea").val('');
              var resp = JSON.parse(resp);
              currentTime = getDateTime();
              currentTime = time_ago(currentTime);
              var UserName="";
              $.each( resp, function( key, value ) {
                if(key=="studentName"){
                 UserName = value;
                }
    
              });
    
              if(studId==studId)
              {
                var me = "Me";
                var side = "right-msg";
                var image = "https://bootdey.com/img/Content/user_1.jpg";
                var margin = "margin:-12px";
                var color = Math.floor((Math.random() * 4) + 1);
    
              }else{
                var me = UserName;
                var side = "left-msg";
                var image = "https://bootdey.com/img/Content/user_3.jpg";
                var margin = "margin:12px";
                var color = Math.floor((Math.random() * 4) + 1);
    
              }
    
              var htmldata  = "<div class='msg "+side+"'><div class='msg-bubble'><div class='msg-text' style='color: black;'>"+chat_message+"</div><div class='mt-2 time-icon'><i class='fa fa-check-circle-o'></i><div class='ml-3 msg-info-time'>"+currentTime+"</div></div></div></div>";          
               $("#message_area").append(htmldata);
               
               
               
                // window.setTimeout(function () {
                //           window.location.reload();
                // }, 15000);
                        
              
            },
            error:function(error){
              console.log(error)
            }
          });

          }
        });

});

$(document).ready(function(){
    setInterval(function() { get_chat_messages(); } , 2500);
    $('#OpenImgUpload').change(function(e){ 
        $("#chat_form").submit();
    });
    $('#chat_form').submit(function(e){
        e.preventDefault(); 
        $("#chat_messagerr").html("");
        $.ajax({
            url:'<?php echo base_url();?>website/uploadchatimg',
            type:"POST",
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                
                var currentTime = getDateTime();
                currentTime = time_ago(currentTime);
                
                if(data!=""){
                    var resp = JSON.parse(data);
                    console.log(resp);
                    if(resp.error){
                        $("#chat_messagerr").html("Maximum 2MB OR Accept Only Image,pdf files only ").css({"color":"red","padding":"12px;"});
                    }else{
                        var fileExtension = resp.chatimgup.substring(resp.chatimgup.lastIndexOf('.') + 1); 
                        if(fileExtension=='pdf') {
                            var baseurl = "<div class='msg right-msg'><a download href='<?php echo base_url('uploads/chatimgup/'); ?>"+resp.chatimgup+"' ><img class='send-recieve-img' src='<?php echo base_url('assets/website/img/teacherimg.png'); ?>'></a></div>";
                        }else{
                            console.log(resp.chatimgup);
                            var baseurl = "<div class='msg right-msg'><div class='msg-bubble'><div><a download href='<?php echo base_url('uploads/chatimgup/'); ?>"+resp.chatimgup+"'><img class='send-recieve-img' src='<?php echo base_url('uploads/chatimgup/'); ?>"+resp.chatimgup +"'></a></div><div class='msg-text' style='color: black;'></div><div class='mt-2 time-icon'><i class='fa fa-check-circle-o'></i><div class='ml-3 msg-info-time'>"+currentTime+"</div></div></div></div>";
                            console.log(baseurl);
                        }
                        $("#message_area").append(baseurl);
                        $("#chat_messagerr").html("");
                         $("#emojionearea").val('');
                    }
                }   
            },
            error:function(error){ 
                console.log(error);
            }
        });
    });
    function get_chat_messages(){
        var studId        = $("#studId").val();
        var fk_teachId    = $("#fk_teachId").val();
        $.ajax({
            type:"POST",
            data :{studId:studId,fk_teachId:fk_teachId },
            url:"<?php echo base_url('website/ajax_get_chat_messages'); ?>",
            success:function(resp){
            
                if(resp!=""){    
                var resp = JSON.parse(resp);
                console.log(resp);
                var currentTime = getDateTime();
                currentTime = time_ago(currentTime);
                var UserName="";
                $.each( resp, function(key, value){
                    if(key=="studentName"){
                        UserName = value;
                    }
                });
                if(studId==studId){
                    var me = "Teacher";
                    var side = "left-msg";
                    var image = "https://bootdey.com/img/Content/user_1.jpg";
                    var margin = "margin:-12px";
                    var color = Math.floor((Math.random() * 4) + 1);
                }else{
                    var me = "Me";
                    var side = "right-msg";
                    var image = "https://bootdey.com/img/Content/user_3.jpg";
                    var margin = "margin:12px";
                    var color = Math.floor((Math.random() * 4) + 1);
                }
                var htmldata  = "<div class='msg "+side+" '><div class='msg-bubble'><div class='msg-info'><div class='msg-info-time'>"+currentTime+"</div></div><div class='msg-text' style='color: black;'>"+resp.chatMsg+"</div><span class='fa fa-check-circle' style='+color+'></span></div></div>";          
                $("#message_area").append(htmldata);
                
                $("#message_area").val('');
                Push.create(resp.chatMsg);
                 window.setTimeout(function () {
                  window.location.reload();
                }, 15000);
            }          
            }, 
            error:function(error){
                console.log(error)
            }
        });
    }
    get_chat_messages();
});
function getDateTime() {
        var now     = new Date(); 
        var year    = now.getFullYear();
        var month   = now.getMonth()+1; 
        var day     = now.getDate();
        var hour    = now.getHours();
        var minute  = now.getMinutes();
        var second  = now.getSeconds();
        if(month.toString().length == 1) {
             month = '0'+month;
        }
        if(day.toString().length == 1) {
             day = '0'+day;
        }   
        if(hour.toString().length == 1) {
             hour = '0'+hour;
        }
        if(minute.toString().length == 1) {
             minute = '0'+minute;
        }
        if(second.toString().length == 1) {
             second = '0'+second;
        }   
        var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;   
         return dateTime;
    }
    
function time_ago(time) {
        switch (typeof time) {
        case 'number':
          break;
        case 'string':
          time = +new Date(time);
          break;
        case 'object':
          if (time.constructor === Date) time = time.getTime();
          break;
        default:
          time = +new Date();
      }
        var time_formats = [
        [60, 'seconds', 1], // 60
        [120, '1 minute ago', '1 minute from now'], // 60*2
        [3600, 'minutes', 60], // 60*60, 60
        [7200, '1 hour ago', '1 hour from now'], // 60*60*2
        [86400, 'hours', 3600], // 60*60*24, 60*60
        [172800, 'Yesterday', 'Tomorrow'], // 60*60*24*2
        [604800, 'days', 86400], // 60*60*24*7, 60*60*24
        [1209600, 'Last week', 'Next week'], // 60*60*24*7*4*2
        [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
        [4838400, 'Last month', 'Next month'], // 60*60*24*7*4*2
        [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
        [58060800, 'Last year', 'Next year'], // 60*60*24*7*4*12*2
        [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
        [5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
        [58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
      ];
        var seconds = (+new Date() - time) / 1000,
        token = 'ago',
        list_choice = 1;
    
        if (seconds == 0) {
            return 'Just now'
        }
        if (seconds < 0) {
            seconds = Math.abs(seconds);
            token = 'from now';
            list_choice = 2;
         }
        var i = 0,
        format;
        while (format = time_formats[i++])
        if (seconds < format[0]) {
            if (typeof format[2] == 'string')
                return format[list_choice];
            else
                return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
        }
        return time;
    }

// window.setTimeout(function () {
//   window.location.reload();
// }, 60000);

$('#imgupload').click(function(){ $('#OpenImgUpload').trigger('click'); });
</script>

<?php
function get_time_ago( $time ){
    $time_difference = time() - $time;
    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str ){
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return  $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}
?>


<script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>

<!--<script type="text/javascript">-->
    
<!--    (function ()-->
<!--     {-->
      
<!--      var video = document.getElementById('video');-->
<!--      var vendorUrl = window.URL || window.webkitURL;-->
      
<!--      console.log(vendorUrl);-->
<!--      navigator.getMedia = navigator.getUserMedia || -->
<!--                           navigator.webkitGetUserMedia || -->
<!--                           navigator.mozGetUserMedia ||-->
<!--                           navigator.msGetUserMedia;-->
<!--      navigator.getMedia({-->
<!--        video:true,-->
<!--        audio:true-->
<!--      },function(stream){-->
<!--        console.log(stream);-->
<!--        video.srcObject = stream;-->
<!--        video.play();-->
<!--      },function(error){-->
<!--        console.log(error);-->

<!--      }-->

<!--      );-->


<!--     })();-->
<!--</script>-->


<script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>

<script type="text/javascript">
    var ids = "";
    var peer = new Peer(); 
    var myStream; 
    var peerList=[];
    peer.on('open',function(id){
        console.log(id);
        document.getElementById("ShowPeerId").innerHTML = id;
    });

    peer.on('call',function(call){

       navigator.mediaDevices.getUserMedia(
    { 
        video:true,
        audio:true
    }).then((stream)=>{
      myStream =  stream;
      addOurvideo(stream)

      call.answer(stream)
      call.on('stream',function(remotStream){

        if(!peerList.includes(call.peer)){
           addRemoteVideo(remotStream)
           peerList.push(call.peer)
        }
      })

}).catch((err)=>{ console.log(err +" unable to connect ") })



    });

function call(){
        var peerId = document.getElementById("peerId").value;
        callPeer(peerId);
    }

function callPeer(peerId) {
  navigator.mediaDevices.getUserMedia(
    { 
        video:true,
        audio:true
    }).then((stream)=>{
      myStream =  stream;
      addOurvideo(stream) 

      let call = peer.Call(peerId,stream)
       call.on('stream',function(remotStream){
        console.log(remotStream);

        // addRemoteVideo(remotStream);

        if(!peerList.includes(call.peer)){
           addRemoteVideo(remotStream)
           peerList.push(call.peer)
        }


      })  

}).catch((err)=>{ console.log(err +" unable to connect ") })



}


function addRemoteVideo(stream){
 let video = document.createElement('video');
 video.srcObject = stream;
 video.play();
 document.getElementById('remoteVideo').append(video);


}

function addOurvideo(stream){
 let video = document.createElement('video');
 video.srcObject = stream;
 video.play();
 document.getElementById('video').append(video);


}




    

</script>

<script type="text/javascript">
    
    (function ()
     {
      
      var video = document.getElementById("video"),
      vendorUrl = window.URL || window.webkitURL;
      navigator.getMedia = navigator.getUserMedia || 
                           navigator.webkitGetUserMedia || 
                           navigator.mozGetUserMedia ||
                           navigator.msGetUserMedia;
      navigator.getMedia({
        video:true,
        audio:true
      },function(stream){
        console.log(stream);
        video.srcObject = vendorUrl.createObjectURL(stream);
        video.play();
      },function(error){
        console.log(error);

      }

      );


     })();
</script>






