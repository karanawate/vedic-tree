<?php
 $this->load->view('header');
?>
<style type="text/css">
    .thclass{
        width:400px;
    }
    
    .btn_download{
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 12px 30px;
  cursor: pointer;
  font-size: 20px;
  border-radius:5px;
}

.badge-success {
    color: #fff;
    background-color: #02a4997a;
    height: 25px;
    width: 94px;
    padding-top: 9px;
}

.badge-danger {
    color: #fff;
    background-color: #ec4561a6;
    height: 25px;
    width: 94px;
    padding-top: 9px;
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
                        <div class="row">
                            <div class="col-12">
                                <div class="card"  style="overflow-x: auto">
                                    <div class="card-body">
                                        <h4 class="card-title">Allocated Homework List</h4>
                                        <?php
                                            $message = $this->session->flashdata('msg');
                                            if (isset($message)) {
                                                echo '<div class="alert alert-info successMessage ">' . $message . '</div>';
                                                $this->session->unset_userdata('msg');
                                            }

                                            ?>
                                        <table id="datatables" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                               <!--<?php echo '<pre>'; print_r($homeworks) ?>;-->
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Title</th>
                                                <th class="thclass">Description</th>
                                                <th class="thclass">Start Time</th>
                                                <th class="thclass">End Time</th>
                                                <th class="thclass">Package Name</th>
                                                <th class="thclass">Class id</th>
                                                <th class="thclass">Status</th>
                                                <th class="thclass">Download</th>
                                                <th class="thclass">Active-Operation</th>
                                                <th class="thclass">Operation</th>
                                            </tr>
                                            </thead> 
                                            <tbody>
                                               
                                            <?php  foreach($homeworks as $homework) {?>
                                                <tr>
                                                    <td><?php echo $homework['homework_id']; ?></td>
                                                    <td><?php echo $homework['home_title']; ?></td>
                                                    <td><?php echo $homework['description']; ?></td>
                                                    <td><?php echo $homework['start_time']; ?></td>
                                                    <td><?php echo $homework['end_time']; ?></td>
                                                    <td><?php echo $homework['packageName']; ?></td>
                                                    <td>
                                                        <?php
                                                                if($homework['class_id']      == 1){
                                                                    echo "Nursary";
                                                                }elseif($homework['class_id'] == 2){
                                                                    echo "Juniar";
                                                                }elseif($homework['class_id'] == 3){
                                                                    echo "senior";
                                                                }
                                                         ?>
                                                     </td>
                                                     <td>
                                                         <?php
                                                                if($homework['admin_approv_status'] ==2){ ?>
                                                                    <span class="badge badge-success">Active</span>
                                                                <?php }elseif($homework['admin_approv_status'] ==1){ ?>
                                                                    <span class="badge badge-danger">Dective</span>
                                                                <?php 
                                                                    
                                                                }
                                                             ?>
                                                     </td>
                                                     <td>
                                                         <?php if(!empty($homework['allocated_file'])){
                                                                
                                                               ?>
                                                        <form method="post" action="<?php echo base_url('website/download_homeworkbyadmin'); ?>">
                                                        <input type="hidden" value="<?php echo $homework['start_time'] ?>" name="start_time" />
                                                        <input type="hidden" value="<?php echo $homework['end_time'] ?>"   name="end_time" />
                                                        <input type="hidden" value="<?php echo $homework['feesId'] ?>"     name="feesId" />
                                                        <button  style="background-color:color: #fff;border: none;border-style: none;"><i class="ml-3 fa fa-download btn_download" aria-hidden="true"></i></button>
                                                        </form>
                                                            <?php } else{ ?>
                                                           
                                                            <?php }  ?>
                                                        
                                                     </td>
                                                    
                                                    <td>
                                                        <form method="post" action="<?php echo base_url('dashboard/update_status_homeworkk'); ?>">
                                                            <input type="hidden" value="<?php echo $homework['start_time'] ?>" name="start_time" />
                                                            <input type="hidden" value="<?php echo $homework['end_time'] ?>" name="end_time" />
                                                            <input type="hidden" value="<?php echo $homework['feesId'] ?>" name="feesId" />
                                                            <input type="hidden" value="<?php echo $homework['home_title'] ?>" name="home_title" />
                                                            <input  class="btn btn-primary" type="submit" value="Active" />
                                                            </form>
                                                        <!--<button  id="<?php echo $homework['homework_id'];?>" class="btn btn-primary homework_allocated_btn">active</button>-->
                                                    </td>
                                                    
                                                    <td>
                                                        <form method="post" action="<?php echo base_url('dashboard/delete_homework_admin'); ?>">
                                                            <input type="hidden" value="<?php echo $homework['start_time'] ?>" name="start_time" />
                                                            <input type="hidden" value="<?php echo $homework['end_time'] ?>" name="end_time" />
                                                            <input type="hidden" value="<?php echo $homework['feesId'] ?>" name="feesId" />
                                                            <input type="hidden" value="<?php echo $homework['home_title'] ?>" name="home_title" />
                                                            <input  class="btn btn-danger" type="submit" value="delete" />
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
        
        
        
        
            
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>        
              <?php $this->load->view('footer'); ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

       <?php $this->load->view('footd');?>
       
       
       
            <script type="text/javascript">
           $(document).ready(function() {
                $(".homework_allocated_btn").click(function(){
                    let home_id = this.id;
                    $.ajax({
                        type:"POST",
                        data:{home_id:home_id},
                        url:"<?php echo base_url('dashboard/update_homework_status')?>",
                        success:function(res){
                            swal("Homework Approved Successfully!");
                        },
                        error:function(error){
                            console.log(error);
                        }
                    })

                })
            } );

       </script>
       
<script>
$(document).ready(function(){
    setTimeout(function() {
    $(".successMessage").hide(3000);
}, 3000); 
});
</script>

       <script type="text/javascript">
       
        $(document).ready(function() {
         $('#datatables').dataTable( {
            "iDisplayLength": 10,
             "deferRender": true ,
             stateSave: true
         }
             );
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
                    window.location.href = '<?php echo base_url('dashboard/view_homework')?>';
       }, 2000);
       
       
  </script>

<?php } ?>

<script>
    
</script>



