<?php
 $this->load->view('header');
 $monthdata =  required_data();

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
                                          <h2>Add Seo Here</h2>
                                          <a href="<?php echo base_url('dashboard/assign_student_manual');?>"  style="float: right;top: -40px;position: relative;" class="btn btn-primary">Refresh</a>
                                        <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('dashboard/add_web_seo'); ?>">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Website Title </label>
                                                            <input type="text" class="form-control" value="<?php echo set_value('web_Title');?>" name="web_Title" placeholder="Website Title ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('web_Title');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Meta Title </label>
                                                            <input type="text" class="form-control" value="<?php echo set_value('web_metaTitle');?>" name="web_metaTitle" placeholder="website meta Title ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('web_metaTitle');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter website page Keyword </label>
                                                            <input type="text" class="form-control" value="<?php echo set_value('web_pageKeyword');?>" name="web_pageKeyword" placeholder="Enter website page Keyword ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('web_pageKeyword');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Meta  Description </label>
                                                            <textarea type="text" class="form-control" name="web_metaDesc"  value="<?php echo set_value('web_metaDesc');?>" ></textarea>
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('web_metaDesc');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Meta Image </label>
                                                            <input type="file" class="filestyle" name="weboggpic" placeholder="Meta Keywords ">
                                                        </div>
                                                        <span style="color:red"><?php if(isset($error['weboggpic'])){ echo $error['weboggpic']; } ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Canonical Url</label>
                                                            <input type="url" class="form-control" value="<?php echo set_value('web_metaUrl');?>" name="web_metaUrl" placeholder="Canonical Url ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('web_metaUrl');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Select Page For add Meta Tags</label>
                                                            <select class="form-control" name="metaPageName">
                                                                <option value="">Select Page Name</option>
                                                                <option value="1">Home</option>
                                                                <option value="2">About us</option>
                                                                <option value="3">Gallery Page</option>
                                                                <option value="4">Course 1</option>
                                                                <option value="5">Course 2</option>
                                                                <option value="6">Course 3</option>
                                                                <option value="7">Blog</option>
                                                                <option value="8">Blog 1</option>
                                                                <option value="9">Blog 2</option>
                                                                <option value="10">Blog 3</option>
                                                                <option value="11">Terms and Conditions</option>
                                                                <option value="12">Privacy Policy</option>
                                                                <option value="13">FAQ's</option>
                                                                <option value="14">Shipment Policy</option>
                                                                <option value="15">Payment and Refunds</option>
                                                                <option value="16">Landing Page</option>
                                                            </select>
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('metaPageName');?></span>
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
                                                <th class="thclass">Website Title</th>
                                                <th class="thclass">Website Meta Title </th>
                                                <th class="thclass">Website Description </th>
                                                <th class="thclass">Website Keyword </th>
                                                <th class="thclass">Website Pic </th>
                                                <th class="thclass">Website Url </th>
                                                <th class="thclass">Create Date </th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($add_web_seo_list){
                                                $i=1;
                                                foreach ($add_web_seo_list as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['web_Title']; ?></td>
                                                <td><?php echo $value['web_metaTitle']; ?></td>
                                                <td><?php echo $value['web_metaDesc']; ?></td>
                                                <td><?php echo $value['web_pageKeyword']; ?></td>
                                                <td> <img src="<?php echo base_url('uploads/weboggpic/'.$value['weboggpic']);?>" width="50px;" height="50px;"></td>
                                                <td><?php echo $value['web_metaUrl']; ?></td>
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('dashboard/update_seo/'.$value['webId'])?>"><i style="font-size:25px;" class="mdi mdi-account-edit-outline"></i></a>
                                                    <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deleteMetaweb');?>">
                                                        <input type="hidden" value="<?php echo $value['webId'];?>" name="webId">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px;color:#626ed4;" class="mdi mdi-delete"></i></button>
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
                    window.location.href = '<?php echo base_url('dashboard/add_web_seo')?>';
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
