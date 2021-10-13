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
                        <div class="card">
                                      <div class="card-body">
                                        <?php 
                                      
                                          if($updatePayment) {
                                              
                                            //   echo "<pre>";
                                            //   print_r($updatePayment);
                                          
                                          ?>
                                        <form method="POST" action="<?php echo base_url('dashboard/updatePayment'); ?>">
                                            <input type="hidden" name="rowId" value="<?php echo $updatePayment[0]['logId']; ?>">
                                            <div class="row">
                                                <ul style="list-style:none">
                                                    <li style="padding:12px" >First Name   : <?php echo $updatePayment[0]['usr_firstname']; ?> </li>
                                                    <li style="padding:12px">Last  Name    : <?php echo $updatePayment[0]['usr_lastname']; ?> </li>
                                                    <li style="padding:12px">Student Email : <?php echo $updatePayment[0]['usr_email']; ?> </li>
                                                    <li style="padding:12px">Mobile Number : <?php echo $updatePayment[0]['usr_mobile_no']; ?> </li>
                                                </ul>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Package Fees </label>
                                                        <input type="number" class="form-control" value="<?php echo $updatePayment[0]['final_fees'];  ?>" id="final_fees" readonly name="final_fees" >
                                                        <span style="color:red"><?php echo form_error('studentMobile');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Paid untill Amount</label>
                                                        <input type="text" class="form-control" value="<?php echo $updatePayment[0]['payAmount'];  ?>" name="paidamount" readonly id="paidamount" >
                                                        <span style="color:red"><?php echo form_error('studentEmail');?></span>

                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Enter for update Amount </label>
                                                        <input type="text" class="form-control" value="" id="payAmount" name="payAmount" >
                                                        <span style="color:red"><?php echo form_error('payAmount');?></span>
                                                    </div>
                                                </div>
                                                 <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Update Discount Amount </label>
                                                        <input type="text" class="form-control" value="<?php echo $updatePayment[0]['discount']?>" id="discount" name="discount" >
                                                        <span style="color:red"><?php echo form_error('discount');?></span>
                                                    </div>
                                                </div>
                                                
                                                 <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Update Adjusted Amount </label>
                                                        <input type="text" class="form-control" value="<?php echo $updatePayment[0]['fk_adjustedAmount']?>" id="fk_adjustedAmount" name="fk_adjustedAmount" >
                                                        <span style="color:red"><?php echo form_error('fk_adjustedAmount');?></span>
                                                    </div>
                                                </div>
                                                
                                                 <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Update Adjusted Remark </label>
                                                        <input type="text" class="form-control" value="<?php echo $updatePayment[0]['fk_adjustedRemark']?>" id="fk_adjustedRemark" name="fk_adjustedRemark" >
                                                        <span style="color:red"><?php echo form_error('fk_adjustedRemark');?></span>
                                                    </div>
                                                </div>
                                
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Class Name</label>
                                                        <select class="form-control" name="planId">
                                                            <option value="<?php echo $updatePayment[0]['planId']; ?>"><?php echo $updatePayment[0]['packageName']; ?></option>
                                                            <?php 
                                                            if($list_Fees){
                                                                foreach($list_Fees as $value){
                                                            ?>
                                                            <option value="<?php echo $value['feesId'];?>"><?php echo $value['packageName']; ?></option>
                                                            <?php } }  ?>
                                                        </select>
                                                        <span style="color:red"><?php echo form_error('list_Fees');?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Payment Status</label>
                                                        <select class="form-control" name="paystatusId">
                                                            <option value="<?php echo $updatePayment[0]['paystatusId']; ?>"><?php echo $updatePayment[0]['paystatus']; ?></option>
                                                            <option value="1">Full Payment</option>
                                                            <option value="3">Partially Payment</option>
                                                        </select>
                                                        <span style="color:red"><?php echo form_error('list_Fees');?></span>
                                                    </div>
                                                </div>
                                                

                                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">update Amount</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </form>
                                        <?php }else{ echo " No Amount Found "; } ?>
                                      </div>
                                      </div>
                        </div>
                       

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
              <?php $this->load->view('footer'); ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->



     

       <?php $this->load->view('footd');?>
       
    
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
      <script type="text/javascript">
           $(document).ready(function() {

                $(".mdi-delete").click(function(){

                    var studId =  $(this).attr('id');
                    $.ajax({
                        type:"POST",
                        data:{studId:studId},
                        url:"<?php echo base_url('dashboard/deletestudid')?>",
                        success:function(res){

                            if(res==1){
                                swal({
                                      title: "Student Id is Deleted!",
                                      text: "You clicked the button!",
                                      icon: "success",
                                      button: "ok",
                                    });
                            }
                            setTimeout(function(){
                               window.location.reload(1);
                            }, 2000);

                        },
                        error:function(error){
                            console.log(error);
                        }
                    })



                })
            } );

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
          
          setTimeout(function() {
                        window.location.href = '<?php echo base_url('dashboard/partial_payment_students')?>';
           }, 2000);

      </script>

    <?php } ?>

<script>
    function check() {
        if(confirm("Are You Sure You Want To Delete")==true)
        {
            return true;
        }else{
            return false;
        }
    }

     function checkstu() {
        if(confirm("Are You Sure You Want Activate Student ? ")==true)
        {
            return true;
        }else{
            return false;
        }
    }
    
    $(document).ready( function() {
    $('#datatables').DataTable( {
        dom: 'Bfrtip',
        buttons: [ {
            extend: 'excelHtml5',
            customize: function( xlsx ) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
 
                $('row c[r^="C"]', sheet).attr( 's', '2' );
            }
        } ]
    } );
} );

</script>



 <script type="text/javascript">
    $(document).ready(function()
    {
        
        $("#payAmount").change(function(){
            
            var final_fees = $("#final_fees").val();
            var payAmount = $(this).val();
            var paidamount = $("#paidamount").val();
            var finalAmount = parseInt(final_fees - paidamount);
            var totalfinalAmount = parseInt(finalAmount - payAmount);
            
            $("#showremaining").val(totalfinalAmount);
            
            
        });
        
        
        $("#payAmount").blur(function(){
            
            var final_fees = $("#final_fees").val();
            var payAmount = $(this).val();
            var paidamount = $("#paidamount").val();
            var finalAmount = parseInt(final_fees - paidamount);
            var totalfinalAmount = parseInt(finalAmount - payAmount);
            
            $("#showremaining").val(totalfinalAmount);
            
            
        });
        
               
     });
</script>

