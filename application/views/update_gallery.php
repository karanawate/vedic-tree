<?php
 $this->load->view('header');
 $monthdata =  required_data();

?>
<style type="text/css">
    .thclass{
        width:400px;
    }
    .gallery-image-size {
        height: 200px;
        width: 300px;
        object-fit: contain;
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
                                          <h2>Add Gallery Here</h2>
                                            <a href="<?php echo base_url('dashboard/update_gallery');?>"  style="float: right;top: -40px;position: relative;" class="btn btn-primary">Refresh</a>
                                        <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('dashboard/update_gallery'); ?>">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Upload Gallery Photos </label>
                                                            <input type="file" class="filestyle" name="galleryImage" placeholder="Meta Keywords ">
                                                        </div>
                                                        <span style="color:red"><?php if(isset($error['galleryImage'])){ echo $error['galleryImage']; } ?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">submit</button>
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
                                        <h4 class="card-title">Session List</h4>
                                        <table id="datatable" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">galleryImage Name</th>
                                                <th class="thclass">Create Date </th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($update_gallery_list){
                                                $i=1;
                                                foreach ($update_gallery_list as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td> <img class="gallery-image-size" src="<?php echo base_url('uploads/galleryImage/'.$value['galleryImage']);?>"> </img> </td>
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td>
                                                     <a href="<?php echo base_url('dashboard/edit_gallery_image/'.$value['gId'])?>"><i style="font-size:25px;" class="mdi mdi-account-edit-outline"></i></a>
                                                     
                                                    <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deleteGalleryImage');?>">
                                                        <input type="hidden" value="<?php echo $value['gId'];?>" name="gId">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm">
                                                        <i style="font-size: 21px;color:#626ed4;" class="mdi mdi-delete"></i>
                                                        </button>
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

        <!-- END layout-wrapper -->

       <?php $this->load->view('footd');?>

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
                    window.location.href = '<?php echo base_url('dashboard/update_gallery')?>';
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
