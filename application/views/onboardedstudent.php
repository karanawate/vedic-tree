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

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                            <div class="col-md-12">
                                <div class="card">
                                      <div class="card-body">
                                        <form method="POST" action="<?php echo base_url('dashboard/getstudlist'); ?>">
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
                            </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Student List</h4>
                                        <table id="datatable" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Student Name</th>
                                                <th class="thclass">Student Email</th>
                                                <th class="thclass">Student Mobile</th>
                                                <th class="thclass">student Class</th>
                                                <th class="thclass">student Gender</th>
                                                <th class="thclass">Pay Amount</th>
                                                <th class="thclass">Adjust amount</th>
                                                <th class="thclass">Discount</th>
                                                <th class="thclass">Round Off</th>
                                                <th class="thclass">August Offer</th>
                                                <th class="thclass">Fees Status</th>
                                                <th class="thclass">Date</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php 
                                               
                                                $total_amount = array();
                                               if($onboardedstudent){
                                                $i=1;
                                                
                                                foreach ($onboardedstudent as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['studentName']; ?></td>
                                                <td><?php echo $value['usr_email']; ?></td>
                                                <td><?php echo $value['studentMobile']; ?></td>
                                                <td><?php echo $value['className']; ?></td>
                                                <td><?php echo $value['studentGender']; ?></td>
                                                <td><?php 
                                                
                                                 $total_amount[] = $value['payAmount'];
                                                echo round($value['payAmount']); ?></td>
                                               <td><?php echo $value['fk_adjustedAmount'];?></td>
                                               <td><?php echo $value['discount'];?></td>
                                               <td><?php echo $value['roundOff'];?></td>
                                               <td><?php echo $value['augustoffer'];?></td>
                                                <td>
                                                    <?php 
                                                        if($value['paymentType']==3) 
                                                         {

                                                        ?>    
                                                            <a target="_blank" href="<?php echo base_url('uploads/Receiptpic/'.$value['Receiptpic']);?>"><img style="position: relative; width: 50px;height: 50px;" src="<?php echo base_url()?>/assets/images/receipt.gif"></a>
                                                        <?php } else { ?>

                                                           <a target="_blank" href="<?php echo base_url('uploads/Receiptpic/'.$value['Receiptpic']);?>"><img style="position: relative;width: 50px;height: 50px;" src="<?php echo base_url()?>/assets/images/receipt.gif"></a>
                                                            
                                                         <?php
                                                                }
                                                        ?>
                                                    </td>
                                                <td><?php echo $value['createDT']; ?></td>
                                            </tr>
                                               <?php }} ?> 
                                                <tr>
                                                   <td>Total</td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td><?php echo array_sum($total_amount); ?></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                               </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
              <?php $this->load->view('footer'); ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

       <?php $this->load->view('footd');?>

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
                            }, 5000);

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
</script>