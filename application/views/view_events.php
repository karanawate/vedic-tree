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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Events List</h4>
                                         <?php
                                            $message = $this->session->flashdata('msg');
                                            if (isset($message)) {
                                                echo '<div class="alert alert-info successMessage ">' . $message . '</div>';
                                                $this->session->unset_userdata('msg');
                                            }

                                            ?>

                                        <table id="datatable" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">title</th>
                                                <th class="thclass">Image Link</th>
                                                <th class="thclass">Youtube link</th>
                                                <th class="thclass">date</th>
                                                <th class="thclass">Description</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($events){
                                                $i=1;
                                                foreach ($events as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td>
                                                    <a href="<?php echo base_url('adminseo/view_eventimages/'.$value['event_rand_id']) ?>">
                                                      <?php echo $value['title']; ?>
                                                     </a>
                                                </td>
                                                <td>
                                                    <a href="<?php echo $value['image_input_link']; ?>" />
                                                       <?php echo $value['image_input_link']; ?>
                                                     </a>
                                                </td>
                                                <td>
                                                    <a href="<?php $value['youtube_input_link']; ?>" />
                                                      <?php echo $value['youtube_input_link']; ?>
                                                    </a>
                                                </td>
                                                  <td><?php echo $value['date']; ?></td>
                                                <td><?php echo substr($value['description'], 0,20); ?></td>
                                                <td>
                                                     <form method="POST" action="<?php echo base_url('adminseo/delete_events'); ?>">
                                                         <input type="hidden" value="<?php echo  $value['event_rand_id'] ?>" name="event_rand_id" />        
                                                         <button  type="submit" name="submit"  class="btn btn-sm"><i style="font-size: 21px;position:    margin-left: 19px;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                     </form>
                                                     
                                                     <form method="POST" action="<?php echo base_url('adminseo/editEvents'); ?>">
                                                         <input type="hidden" value="<?php echo  $value['event_rand_id'] ?>" name="event_rand_id" />        
                                                         <button  type="submit" name="submit"  class="btn btn-sm"><i style="font-size: 21px;position:    margin-left: 19px;color:#626ed4;" class="mdi mdi-account-edit-outline"></i></button>
                                                     </form>
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
       
<script>
$(document).ready(function(){
    setTimeout(function() {
    $(".successMessage").hide(3000);
}, 3000); 
});
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
                    window.location.href = '<?php echo base_url('dashboard/getstudlist')?>';
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