<?php

 $usersession    = $this->session->userdata('usersession');
 $adminRole      =$usersession[0]['adminRole'];
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
                      <div class="card">
                                      <div class="card-body">
                                        <h2>Search Enquiry Here</h2>
                                        <span style="float:right;top: -45px;position: relative;"><a class="btn btn-primary" href="<?php echo base_url('dashboard/leadfollowup');?>">Refresh</a></span>
                                        <form method="POST" action="<?php echo base_url('dashboard/leadfollowup'); ?>">
                                            <input type="hidden" name="allocate" value="search">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Student Name</label>
                                                       <input type="text" name="studentName" placeholder="Enter Name" value="<?php echo set_value('studentName'); ?>" class="form-control">
                                                        <span style="color:red"><?php echo form_error('studentName');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Student Email</label>
                                                        <input type="email" name="studentEmail" placeholder="Enter Email" value="<?php echo set_value('studentEmail'); ?>" class="form-control">
                                                        <span style="color:red"><?php echo form_error('studentEmail');?></span>
                                                    </div>
                                                </div> 
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Student Mobile </label>
                                                       <input type="text" name="studentMobile" placeholder="Enter Mobile" value="<?php echo set_value('studentMobile'); ?>" class="form-control">
                                                        <span style="color:red"><?php echo form_error('studentMobile');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Search</button>
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
                                        <h4 class="card-title">Follow up List</h4>
                                        <table id="datatables" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Followup by Name</th>
                                                <th class="thclass">Student Mobile</th>
                                                <th class="thclass">follow up remark</th>
                                                <th class="thclass">Admission Status</th>
                                                <th class="thclass">Demo Class Status</th>
                                                <th class="thclass">Demo Class Time</th>
                                                <th class="thclass">Follow up Date</th>
                                               
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($leadfollowup){
                                                $i=1;
                                                foreach ($leadfollowup as $key => $value) { 
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['studentName']; ?></td>
                                                <td><?php echo $value['studentMobile']; ?></td>
                                                <td><?php echo $value['remark']; ?></td>
                                                <td><?php if($value['admissionStatus']=="Pending"){ echo "<span style='color:red'>".$value['admissionStatus']."</span>" ;}else if( $value['admissionStatus']=="Approved" ){ echo "<span style='color:green'>".$value['admissionStatus']."</span>"; }else{ echo $value['admissionStatus']; }  ?></td>
                                                <td><?php if(isset($value['democlassStatus'])){ echo $value['democlassStatus']; }else { echo "No Data Found"; } ?></td>
                                                <td><?php if(isset($value['demolcassTime'])){ echo $value['demolcassTime']; }else { echo "No Data Found"; } ?></td>
                                                <td><?php echo $value['nextflwDT']; ?></td>
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
                            }, 5000);

                        },
                        error:function(error){
                            console.log(error);
                        }
                    })



                });
                
                
                
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
                    window.location.href = '<?php echo base_url('dashboard/leadfollowup')?>';
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
    

</script>