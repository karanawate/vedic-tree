<?php
$usersession    = $this->session->userdata('usersession');
$adminRole      = $usersession[0]['adminRole']; 

$monthdata      = required_data();
$adminRole      = $monthdata['open_monthdata'][0]['adminRole'];
$paymentMonth   = $monthdata['paymentMonth'];

$getChatData = getChatData_today_count();

?>
<style>
	@import url(https://fonts.googleapis.com/css?family=Nobile);
	.container {
		position: relative;
		overflow: hidden;
	}
	.container .mobile-header {
		position: absolute;
		display: block;
		top: 0;
		left: 0;
	}
	@media (max-width: 1024px) {
		.container {
			margin: 0 auto;
			width: 100%;
			height: 90px;
			box-shadow: none;
		}
		.container .mobile-header {
			position: fixed;
		}
		.content {
			overflow-y: hidden;
		}
	}
	/* End container/placeholder */

	/* Menu Header */
	.mobile-header {
		background: #fe4b7b;
		overflow: hidden;
		height: 90px;
		width: 100%;
		z-index: 9999;
		position: fixed;
		transition: all 0.4s ease-out, background 1s ease-out;
	}
	.mobile-header.menu-open {
		height: 100%;
		background: #fff;
		transition: all 0.45s ease-out, background 0.8s ease-out;
	}

	/* Menu List items */
	.mobile-menu {
		clear: both;
	}
	.mobile-header ul.menu {
		position: relative;
		display: block;
		padding: 0 10px;
		list-style: none;
	}
	.mobile-header ul.menu li.menu-item a {
		display: block;
		position: relative;
		color: #000;
		text-decoration: none;
		font-size: 18px;
		line-height: 2.8;
		width: 100%;
		-webkit-tap-highlight-color: transparent;
	}
	.mobile-header ul.menu li.menu-item {
		border-bottom: 1px solid #333;
		margin-top: 5px;
		opacity: 0;
		transition: opacity 0.6s cubic-bezier(0.4, 0.01, 0.165, 0.99), -webkit-transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99);
		transition: transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99), opacity 0.6s cubic-bezier(0.4, 0.01, 0.165, 0.99);
		transition: transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99), opacity 0.6s cubic-bezier(0.4, 0.01, 0.165, 0.99), -webkit-transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99);
	}
	.mobile-header ul.menu li.menu-item:nth-child(1) {
		transition-delay: 0.4s;
	}
	.mobile-header ul.menu li.menu-item:nth-child(2) {
		transition-delay: 0.35s;
	}
	.mobile-header ul.menu li.menu-item:nth-child(3) {
		transition-delay: 0.3s;
	}
	.mobile-header ul.menu li.menu-item:nth-child(4) {
		transition-delay: 0.25s;
	}
	.mobile-header ul.menu li.menu-item:nth-child(5) {
		transition-delay: 0.2s;
	}
	.mobile-header ul.menu li.menu-item:nth-child(6) {
		transition-delay: 0.15s;
	}
	.mobile-header ul.menu li.menu-item:nth-child(7) {
		transition-delay: 0.10s;
	}
	.mobile-header ul.menu li.menu-item:nth-child(7) {
		transition-delay: 0.05s;
	}
	.mobile-header.menu-open ul.menu li.menu-item {
		opacity: 1;
	}
	.mobile-header.menu-open ul.menu li.menu-item:hover {
		opacity: 1;
		background: #f7f7f7;
	}
	.mobile-header.menu-open ul.menu li.menu-item:nth-child(1) {
		transition-delay: 0.05s;
	}
	.mobile-header.menu-open ul.menu li.menu-item:nth-child(2) {
		transition-delay: 0.1s;
	}
	.mobile-header.menu-open ul.menu li.menu-item:nth-child(3) {
		transition-delay: 0.15s;
	}
	.mobile-header.menu-open ul.menu li.menu-item:nth-child(4) {
		transition-delay: 0.2s;
	}
	.mobile-header.menu-open ul.menu li.menu-item:nth-child(5) {
		transition-delay: 0.25s;
	}
	.mobile-header.menu-open ul.menu li.menu-item:nth-child(6) {
		transition-delay: 0.3s;
	}
	.mobile-header.menu-open ul.menu li.menu-item:nth-child(7) {
		transition-delay: 0.35s;
	}
	.mobile-header.menu-open ul.menu li.menu-item:nth-child(8) {
		transition-delay: 0.4s;
	}
	.mobile-logo-text-menu {
		display: grid;
		grid-template-columns: 0fr 1fr 0fr;
	}
	/* Menu Icon */
	.logo {
		
	}
	.logo img {
		width: 100px;
		padding: 10px 5px;
	}
	.title {
		display: flex;
		align-items: center;
		margin-left: 10px;
	}
	.title img {
		width: auto;
	}
	.icon-container {
		position: relative;
		display: inline-block;
		z-index: 2;
		/* Simply change property to float left to switch icon side :) */
		height: 90px;
		width: 55px;
		cursor: pointer;
		-webkit-tap-highlight-color: transparent;
		-webkit-transform: rotate(0deg);
		transform: rotate(0deg);
		transition: all 0.3s cubic-bezier(0.4, 0.01, 0.165, 0.99);
	}
	.icon-container #menuicon {
		width: 20px;
		height: 10px;
		position: relative;
		display: block;
		margin: 0 20px;
		top: 40%;
	}
	#menuicon .bar {
		width: 100%;
		height: 1px;
		display: block;
		position: relative;
		background: #fff;
		transition: all 0.3s cubic-bezier(0.4, 0.01, 0.165, 0.99);
	}
	#menuicon .bar.bar1 {
		-webkit-transform: translateY(0px) rotate(0deg);
		transform: translateY(0px) rotate(0deg);
	}
	#menuicon .bar.bar2 {
		-webkit-transform: translateY(6px) rotate(0deg);
		transform: translateY(6px) rotate(0deg);
	}
	#menuicon .bar.bar3 {
		-webkit-transform: translateY(12px) rotate(0deg);
		transform: translateY(12px) rotate(0deg);
	}
	.menu-open .icon-container {
		-webkit-transform: rotate(90deg);
		transform: rotate(90deg);
	}
	.menu-open .icon-container #menuicon .bar {
		background: #000;
	}
	.menu-open .icon-container #menuicon .bar {
		transition: all 0.4s cubic-bezier(0.4, 0.01, 0.165, 0.99);
		transition-delay: 0.1s;
	}
	.menu-open .icon-container #menuicon .bar.bar1 {
		-webkit-transform: translateY(4px) rotate(45deg);
		transform: translateY(4px) rotate(45deg);
	}
	.menu-open .icon-container #menuicon .bar.bar2 {
		-webkit-transform: translateY(3px) rotate(-45deg);
		transform: translateY(3px) rotate(-45deg);
	}
	.menu-open .icon-container #menuicon .bar.bar3 {
		display: none;
	}
</style>
<div class="container">
    <div class="mobile-header">
        <div class="mobile-logo-text-menu">
            <div class="logo"><img src="<?php echo base_url()?>assets/website/img/register_logo.png" alt="Vedic"></div>
            <div class="title"><img src="<?php echo base_url()?>assets/website/img/mobile-text-logo.png" alt="Vedic"></div>
            <div class="icon-container">
                <div id="menuicon">
                  <div class="bar bar1"></div>
                  <div class="bar bar2"></div>
                  <div class="bar bar3"></div>
                </div>
            </div>
        </div>
        <div class="mobile-menu">
            <ul class="menu">
                <?php if($adminRole==0){
                
               
                if(!empty($paymentMonth)){
                  $displayClass = "display:none";
                   }else{
                 $displayClass = "";
               }
               
               
               ?>
                <li class="menu-item"><a href="<?php echo base_url('vedic-dash/1');?>">Dashboard</a></li>
                <li class="menu-item">
                    <?php if(!empty($last_session_running)){ ?>
                    <a href="<?php echo base_url('website/vedic_learn/'.$last_session_running[0]['fk_monthId'].'/'.$last_session_running[0]['fk_dayId'].'/'.$last_session_running[0]['fk_classId'].'/0/his/2')?>">Learning Page</a>
                    <?php } else { ?>
                    <a href="<?php echo base_url('website/vedic_learn/1/1/'.$usersession[0]['studentClass'].'/3')?>">Learning Page</i>
                    <?php } ?>
                </li>
                <!--<li class="menu-item"><a href="<?php //echo base_url('website/recap/9')?>">Recap Sessions</a></li>-->
                
                <li class="menu-item" style="<?php echo $displayClass;  ?>"><a class="sidenav_btn btn1" href="<?php echo base_url('website/vedicpayment/6');?>">Payment</a></li>
                <li class="menu-item"><a class="sidenav_btn btn1"  href="<?php echo base_url('website/open_previous_month/14');?>"> Open Previous Month </i></a></li>
                <li class="menu-item"><a class="sidenav_btn btn1" href="<?php echo base_url('vedic-homework/16');?>">Homework</i></a></li>
                
                <?php } elseif($adminRole==1) { 
                
                    if(!empty($paymentMonth)){
                          $displayClass = "";
                         } else {
                         $displayClass = "display:none";
                     }
                ?>
               
                <li class="menu-item"><a href="<?php echo base_url('website/vedicprofile/4')?>">Profile Page</a></li>
                <li class="menu-item" style="display: none;"><a href="<?php echo base_url('website/vedicpayment/6');?>">Payment</a></li>
                <li class="menu-item"><a href="<?php echo base_url('website/payment_his/7');?>">Payment History</a></li>
				<li class="menu-item"><a href="<?php echo base_url('website/vedic_progress_tracker/8');?>">Progress Tracker</a></li>
				<li class="menu-item"><a class="sidenav_btn btn1"  href="<?php echo base_url('website/open_previous_month/14');?>"> Open Previous Month </i></a></li>
		    	<li class="menu-item"><a class="sidenav_btn btn1"  href="<?php echo base_url('chat-with-teacher/12')?>">chat with teacher <span class="badge badge-danger badge-pill"><?php echo count($getChatData); ?></span></a></li>
                <?php } ?>
                
                
            </ul>
        </div>
    </div>
</div>
<script>
    (function () {
      const header = document.querySelector('.mobile-header');
    	const icon = document.querySelector('.icon-container');
    	icon.onclick = function () {
    		header.classList.toggle('menu-open');
    	}
    }());
</script>