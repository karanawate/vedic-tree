<?php
 $this->load->view('header');
?>
<style type="text/css">
    .thclass{
        width:400px;
    }
</style>
 <!-- Begin page -->
        <div id="layout-wrapper">
            <?php $this->load->view('topbar'); ?>
            <?php $this->load->view('sidebar'); ?>
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                                                <div class="card card-signin my-5">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-center">Paid Fees</h5>
                                                        <form action="<?php echo base_url().'Razor/pay'; ?>" method="post" class="form-signin">
                                                            <div class="form-label-group">
                                                                <label for="name">Name <span style="color: #FF0000">*</span></label>
                                                                <input type="text" name="name" id="name" class="form-control" placeholder="Name"  required >
                                                            </div> <br/>
                                                            <div class="form-label-group">
                                                                <label for="email">Email <span style="color: #FF0000">*</span></label>
                                                                <input type="text" name="email" id="email" class="form-control" placeholder="Email address" required>
                                                            </div> <br/>
                                                            <label for="contact">Contact <span style="color: #FF0000">*</span></label>
                                                            <div class="form-label-group">
                                                                <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact" required>
                                                            </div><br/>

                                    					<label for="subject">Amount <span style="color: #FF0000">*</span></label>
                                                            <div class="form-label-group">
                                                                <input type="text" id="amount" name="amount" value="1" readonly class="form-control" placeholder="Amount" required>
                                                            </div><br/>
                                                           <br/>
                                                            <button type="submit" name="sendMailBtn" class="btn btn-lg btn-primary btn-block text-uppercase" >Pay Now</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>                                   
        </div>                                   
<?php $this->load->view('footd');?>
