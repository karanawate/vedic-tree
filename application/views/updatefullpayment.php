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
                                      
                                  ?>
                                <form method="POST" action="<?php echo base_url('dashboard/updatefullpayment'); ?>">
                                    <input type="hidden" name="rowId" value="<?php echo $updatePayment[0]['logId']; ?>">
                                    <input type="hidden" name="studId" value="<?php echo $updatePayment[0]['fk_studId']; ?>">
                                  
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Payment List</h4>
                                                        <table id="datatables" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead>
                                                            <tr>
                                                                <th class="thclass">#Id</th>
                                                                <th class="thclass">Student Name</th>
                                                                <th class="thclass">Student Email</th>
                                                                <th class="thclass">Student Mobile</th>
                                                                <th class="thclass">student Class</th>
                                                                <th class="thclass">Payment</th>
                                                                <th class="thclass">Discount</th>
                                                                <th class="thclass">RoundOff</th>
                                                                <th class="thclass">Last year Adjusted Amount Fees</th>
                                                                <th class="thclass">Last year Adjusted Amount Remark</th>
                                                                <th class="thclass">15 August Offer</th>
                                                                <th class="thclass">Remark Receipt</th>
                                                                <th class="thclass">Payment Receipt</th>
                                                                <th class="thclass">Payment Status</th>
                                                                <th class="thclass">Package Name</th>
                                                                <th class="thclass">Package Amount</th>
                                                                <th class="thclass">Fees Status</th>
                                                                <th class="thclass">Due Date</th>
                                                                <th class="thclass">Due Remark</th>
                                                            </tr>
                                                            </thead>  
                                                            <tbody>
                                                               <?php if($updatePayment){
                                                                $i=1;
                                                                $toatal = array();
                                                                foreach ($updatePayment as $key => $value) { 
                                                                 
                                                                   $toatal[] =  $value['payAmount'];
                                                                ?> 
                                                                
                                                                
                                                            <tr>
                                                                <td><?php echo $i++;?></td>
                                                                <td><?php echo $value['studentName']; ?>   </td>
                                                                <td><?php echo $value['studentEmail']; ?>  </td>
                                                                <td><?php echo $value['studentMobile']; ?> </td>
                                                                <td><?php echo $value['className']; ?>     </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="payAmount[]" value="<?php echo round($value['payAmount']); ?>">
                                                                    <input type="hidden" name="logId[]" value="<?php echo $value['logId']; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="discount[]" value="<?php echo round($value['discount']); ?>">
                                                                    <span style="color:red"><?php echo form_error('discount[]'); ?></span>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="roundOff[]" value="<?php echo round($value['roundOff']); ?>">
                                                                    <span style="color:red"><?php echo form_error('roundOff[]'); ?></span>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="fk_adjustedAmount[]" value="<?php echo round($value['fk_adjustedAmount']); ?>">
                                                                    <span style="color:red"><?php echo form_error('fk_adjustedAmount[]'); ?></span>
                                                                    </td>
                                                                <td>
                                                                    <input type="text"   class="form-control" name="fk_adjustedRemark[]" value="<?php echo $value['fk_adjustedRemark']; ?>">
                                                                    <span style="color:red" ><?php echo form_error('fk_adjustedRemark[]'); ?></span>
                                                                </td>
                                                                <td>
                                                                    <input type="text"   class="form-control" name="augustoffer[]" value="<?php echo $value['augustoffer']; ?>">
                                                                    <span style="color:red" ><?php echo form_error('augustoffer[]'); ?></span>
                                                                </td>
                                                                <td>
                                                                    <input type="text"   class="form-control" name="remarkReceipt[]" value="<?php echo $value['remarkReceipt']; ?>">
                                                                </td>
                                                                <td>
                                                                    <a target="_blank"  href="<?php echo base_url('uploads/Receiptpic/'.$value['Receiptpic']);?>"><img width="50px" height="50px" src="<?php echo base_url()?>/assets/images/receipt.gif"></a>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="paystatusId[]">
                                                                    <option value="<?php echo $value['paystatusId'];?>"><?php echo $value['paystatus']; ?></option>
                                                                    <option value="1">Full Payment </option>
                                                                    <option value="3">Partial Payment </option>
                                                                    </select>
                                                                    <span style="color:red"><?php echo form_error('paystatusId[]');?></span>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="planId[]">
                                                                    <option value="<?php echo $value['planId'];?>"><?php echo $value['packageName']; ?></option>
                                                                    <?php 
                                                                    if($list_Fees){
                                                                        foreach($list_Fees as $values){
                                                                    ?>
                                                                    <option value="<?php echo $values['feesId'];?>"><?php echo $values['packageName']; ?> </option>
                                                                    <?php } }  ?>
                                                                    </select>
                                                                    <span style="color:red"><?php echo form_error('planId');?></span>
                                                                </td>
                                                                <td>
                                                                   <?php echo $value['final_fees']; ?>
                                                                </td>
                                                                <td>
                                                                  <?php if(empty($value['paystatus'])){ echo "<span  style='font-family: emoji;color: #ef2100;font-size: inherit;font-weight: bolder;padding: 7px;position: relative;'>No Payment </span>"; } elseif($value['paystatusId']=="3"){ echo "<span  style='font-family: emoji;color: red;font-size: large;font-weight: bolder;padding: 7px;position: relative;'>".$value['paystatus']."</span>"; }else{ echo "<span style='font-family: emoji;color: #ff652a;font-size: inherit;font-weight: bolder;padding: 7px;position: relative;'>".$value['paystatus']."</span>"; } ?>
                                                                </td>
                                                                <td>
                                                                    <input type="date"   class="form-control" name="dueDate[]" value="<?php echo $value['dueDate']; ?>">
                                                                    <span style="color:red" ><?php echo form_error('dueDate[]'); ?></span>
                                                                </td>
                                                                
                                                                <td>
                                                                    <input type="text"   class="form-control" name="dueRemark[]" value="<?php echo $value['dueRemark']; ?>">
                                                                    <span style="color:red" ><?php echo form_error('dueRemark[]'); ?></span>
                                                                </td>
                                                                <input type="hidden" value="<?php echo $value['final_fees']; ?>" name="final_fees">
                                                            </tr>
                                                               <?php }} ?> 
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button style="float:right" class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">update Amount</button>
                                                       <span style="color:red;font-size: x-large;"><?php if(isset($errorpayment)){ echo $errorpayment; }?></span>
                                                    </div>
                                                </div>
                                        </form>
                                        <?php }else{ echo " No Amount Found "; } ?>
                                      </div>
                                      </div>
                         </div>
                    </div> 
                </div>
                
              <?php $this->load->view('footer'); ?>
            </div>
        </div>
        
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
                        window.location.href = '<?php echo base_url('dashboard/close_student_payment_status')?>';
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
         "scrollX": true,
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
        
        

        $("#fk_adjustedRemark").blur(function(){
            
            var fk_adjustedRemark = $(this).val();
            var adjustedRemark = $("#remarktext").text(fk_adjustedRemark);
             $("#adjustedRemark").val(fk_adjustedRemark);
            
            
            
        });
        $("#fk_adjustedAmount").blur(function(){
            
            var fk_adjustedAmount = $(this).val();
            var adjustedAmount = $("#adjustedamount").text(fk_adjustedAmount);
            $("#adjustedAmountpaid").val(fk_adjustedAmount);
            
        });
        
               
     });
</script>

