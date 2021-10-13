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
                                        <h4 class="card-title">Youtube Review's List</h4>
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
                                                <th class="thclass">Title</th>
                                                <th class="thclass">Image</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($banner_details){
                                                $i=1;
                                                foreach ($banner_details as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['title']; ?></td>
                                                <td><img width="50" src="<?php echo base_url('uploads/web_banner/'.$value['banner']); ?>" /></td>
                                                <td>
                                                     <form method="POST" action="<?php echo base_url('adminseo/delete_banner_details'); ?>">
                                                         <input type="hidden" value="<?php echo  $value['bannerId']; ?>" name="bannerId" />        
                                                         <button  type="submit" name="submit"  class="btn btn-sm"><i style="font-size: 21px;position:    margin-left: 19px;color:#626ed4;" class="mdi mdi-delete"></i></button>
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
<script>
$(document).ready(function(){
    setTimeout(function() {
    $(".successMessage").hide(3000);
}, 3000); 
});
</script>


