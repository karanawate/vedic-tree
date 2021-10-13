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
                        <div class="card">
                                      <div class="card-body">
                                        <form method="POST" action="<?php echo base_url('dashboard/closeaccountlist'); ?>">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Mobile Number</label>
                                                        <input type="number" class="form-control" value="<?php echo set_value('studentMobile');  ?>" name="studentMobile" maxlength="10" id="studentMobile" placeholder="Enter  Mobile">
                                                        <span style="color:red"><?php echo form_error('studentMobile');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Email Id</label>
                                                        <input type="text" class="form-control" value="<?php echo set_value('studentEmail');  ?>" name="studentEmail"  id="studentEmail" placeholder="Enter  Email">
                                                        <span style="color:red"><?php echo form_error('studentEmail');?></span>

                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> from Date</label>
                                                        <input type="date" class="form-control" value="<?php echo set_value('fromDT');  ?>" name="fromDT"  id="fromDT" >
                                                        <span style="color:red"><?php echo form_error('fromDT');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> To Date</label>
                                                        <input type="date" class="form-control" value="<?php echo set_value('toDT');  ?>" name="toDT"  id="toDT" >
                                                        <span style="color:red"><?php echo form_error('toDT');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">search</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </form>
                                      </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Student List</h4>
                                        <table id="datatables" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Student Name</th>
                                                <th class="thclass">Student Email</th>
                                                <th class="thclass">Student Mobile</th>
                                                <th class="thclass">student Class</th>
                                                <th class="thclass">student Gender</th>
                                                <th class="thclass">Payment</th>
                                                <th class="thclass">Package Name</th>
                                                <th class="thclass">Package Amount</th>
                                                <th class="thclass">Fees Status</th>
                                                <th class="thclass">Action</th>
                                                
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($getstudlist){
                                                $i=1;
                                                foreach ($getstudlist as $key => $value) { 
                                                    
                                                   
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['studentName']; ?></td>
                                                <td><?php echo $value['studentEmail']; ?></td>
                                                <td><?php echo $value['studentMobile']; ?></td>
                                                <td><?php echo $value['className']; ?></td>
                                                <td><?php echo $value['studentGender']; ?></td>
                                                <td><a href="#" class="waves-effect waves-light" data-toggle="modal" data-target="#exampleModal<?php echo $value['studId'];?>"><i class="mdi mdi-eye" style="font-size:18px;"> </i>View Payment </a></td>
                                                <td><?php echo $value['packageName']; ?></td>
                                                <td><?php echo $value['final_fees']; ?></td>
                                                
                                                    <td>
                                                      <?php if(empty($value['paystatus'])){ echo "<span  style='font-family: emoji;color: #ef2100;font-size: inherit;font-weight: bolder;padding: 7px;position: relative;'>No Payment </span>"; } elseif($value['paystatusId']=="3"){ echo "<span  style='font-family: emoji;color: red;font-size: large;font-weight: bolder;padding: 7px;position: relative;'>".$value['paystatus']."</span>"; }else{ echo "<span style='font-family: emoji;color: #ff652a;font-size: inherit;font-weight: bolder;padding: 7px;position: relative;'>".$value['paystatus']."</span>"; } ?>
                                                        
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url('dashboard/updateFinalPaymentStatus/'.$value['studId'])?>"><i style="font-size: 21px; color:#626ed4;" class="ion ion-md-save"></i></a>
                                                    </td>
                                                  
                                                    
                                            </tr>
                                               <?php }} ?> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                
                
                <?php if($getstudlist){
                $i=1;
                    foreach ($getstudlist as $key => $value) { 
            ?> 
                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?php echo $value['studId'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Deatails </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <table id="datatables" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;" >
                            <thead>
                            <th>Pay Amount</th>
                            <th>Discount</th>
                            <th>Round Off</th>
                            <th>Adjusted Amount</th>
                            <th>August Offer</th>
                            <th>Total Amount</th>
                            </thead>
                            <tbody>
                                <?php
                                
                                $get_total_Amount = updateFinalPaymentStatus($value['studId']);                                
                                if($get_total_Amount){
                                $i=1;
                                 $toatal = array();
                                foreach ($get_total_Amount as $key => $value) { 
                                    $toatal[] =  $value['payAmount'] + $value['discount'] + $value['fk_adjustedAmount'] + $value['augustoffer'] - $value['roundOff'] ;
                                ?> 
                                                
                                <tr>
                                    <td><?php echo $value['payAmount']; ?></td>
                                    <td><?php echo $value['discount']; ?></td>
                                    <td><?php echo $value['roundOff']; ?></td>
                                    <td><?php echo $value['fk_adjustedAmount']; ?></td>
                                    <td><?php echo $value['augustoffer']; ?></td>
                                    <td><?php echo $value['payAmount'] + $value['discount'] + $value['fk_adjustedAmount'] + $value['augustoffer'] - $value['roundOff'] ; ?></td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                            <td>Total Amount</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php if($toatal){ echo $toatal = array_sum($toatal); }else{ echo "0"; }?></td>
                        </table>  
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>

            <?php } } ?>
            
            

                
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
                        window.location.href = '<?php echo base_url('dashboard/closeaccountlist')?>';
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

