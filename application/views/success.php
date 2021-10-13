<?php
 $this->load->view('header');
?>
<style type="text/css">
    .thclass{
        width:400px;
    }
</style>

<div id="layout-wrapper">
    <?php $this->load->view('topbar'); ?>
    <?php $this->load->view('sidebar'); ?>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
				<div class="card-body">
					<center>
						<!-- <img src="<?php // echo base_url().'assets/icons/payment-success.png'?>">
						<h5 class="card-title text-center">Payment successful !</h5>
						<p>Your order ID : <?php  // echo $_SESSION['razorpay_order_id'];?></p> -->

						<div class="my-5 page" size="A4" style="height:auto;">
					        <div class="bg">
					  
					            <div class="card">
					              
					              <span class="card__success"><i class="fas fa-check"></i></span>
					              <h1 class="card__msg">Payment Complete</h1>
					              <h2 class="card__submsg">Thank you for your transfer</h2>
					              <!-- <div class="card__body">
					                <div class="card__recipient-info">
					                  <p class="card__recipient">Recipient Name</p>
					                  <p class="card__email">Recipient Email</p>
					                </div>
					                
					                <h1 class="card__price"><span class="mr-2"><i class="fas fa-rupee-sign rupee"></i></span>8999<span>.00</span></h1>
					                
					                <p class="card__method">Payment method</p>
					                <div class="card__payment">
					                  <img src="https://seeklogo.com/images/V/VISA-logo-F3440F512B-seeklogo.com.png" class="card__credit-card">
					                  <div class="card__card-details">
					                    <p class="card__card-type">Credit / debit card</p>
					                    <p class="card__card-number">Visa ending in **89</p>          
					                  </div>
					                </div>
					                
					              </div> -->
					              
					              <div class="card__tags">
					                  <span class="card__tag">completed</span>
					                  <span class="card__tag">#<?php echo $_SESSION['razorpay_order_id'];?></span>        
					              </div>
					              
					            </div>
					            
					          </div>
					    </div>

					</center>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('footd');?>
