<?php

$usersession    = $this->session->userdata('usersession');
$studentName    = $usersession[0]['studentName'];
$studentEmail   = $usersession[0]['studentEmail'];
$studentMobile  = $usersession[0]['studentMobile'];
$timestamp      = strtotime(date("Y-m-d"));
$newDate        = date('l jS  F-Y', $timestamp);  
// $youtubelink    = "";
if(!empty($usersession) && !empty($studentEmail) &&  !empty($studentMobile)) { 
if($youtubelinks!=""){
?>
<iframe  id="ifrm" class="responsive-iframe-2x" style="border:0-moz-border-radius: 10px;border-radius: 10px;" src="<?php echo $youtubelinks; ?>" frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe>
<?php }else{ ?>
<div class='' style="padding:0px;">No Videos Found!</div>  
<?php 
} }else{ ?>
<iframe  id="ifrm" class="responsive-iframe-2x" style="border:0-moz-border-radius: 10px;border-radius: 10px;" src="<?php echo $youtubelinks; ?>" frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe>
<?php } ?>