<?php
 $this->load->view('header');
 $monthdata =  required_data_admin();

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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Videos</h4>
                                        <div class="col-lg-6">
                                            <form class="" enctype="multipart/form-data;charset=utf-8"  method="post" action="<?php echo base_url('dashboard/add_value_based_video');?>">
                                                <input type="hidden" value="<?php if(!empty($param)){ echo $param; }else{ echo ''; }?>" name="param">
                                                <div class="outer">
                                                    <div data-repeater-item class="outer">
                                                        <div class="form-group">
                                                            <label for="formemail">Class Name</label>
                                                            <select class="form-control" name="fk_classId" >
                                                                <option value="">Select Class</option>
                                                                <?php
                                                                 if($monthdata['getClass']){
                                                                 foreach ($monthdata['getClass'] as $key => $value) {
                                                                 ?>
                                                                <option value="<?php echo $value['classId']?>"><?php echo $value['className']?></option>
                                                                <?php }} ?>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('fk_classId'); ?></span>
                                                        </div>
                                                        
                                                        <div class="form-group" >
                                                            <div class="form-group">
                                                                <label>Title Name </label>
                                                                <input type="text" class="form-control" name="sessionName" placeholder="Title Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group" >
                                                            <div class="form-group">
                                                                <label>Vimeo Video Id </label>
                                                                <input type="number" class="form-control" name="vimeoId" placeholder="Vimeo Video Id">
                                                            </div>
                                                        </div>

                                                        <div class="form-group" >
                                                            <div class="form-group">
                                                                <label>Youtube Link </label>
                                                               <input type="url" class="form-control" name="youtubelink" placeholder="Youtube Link">
                                                            </div>
                                                            <span style="color:red"><?php echo form_error('youtubelink');?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Enter From Date</label>
                                                            <input type="date" class="form-control" name="fromDT" placeholder="Enter From Date" >
                                                            <span style="color:red"><?php echo form_error('fromDT');?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Enter To Date</label>
                                                            <input type="date" class="form-control" name="toDT" placeholder="Enter To Date" >
                                                            <span style="color:red"><?php echo form_error('toDT');?></span>
                                                        </div>
                                                        

                                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Value Based Video List</h4>
                                        <table id="datatables" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Class Name</th>
                                                <th class="thclass">Title Name</th>
                                                <th class="thclass">Youtube Link</th>
                                                <th class="thclass">vimeoId</th>
                                                <th class="thclass">From Date</th>
                                                <th class="thclass">To Date</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($list_of_valuebased){
                                                $i=1;
                                                foreach ($list_of_valuebased as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['className']; ?></td>
                                                <td><?php echo $value['sessionName']; ?></td>
                                                <td><?php echo $value['youtubelink']; ?></td>
                                                <td><?php echo $value['vimeoId']; ?></td>
                                                <td><?php echo $value['fromDT']; ?></td>
                                                <td><?php echo $value['toDT']; ?></td>
                                                <td><form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deletevaluebasedId');?>">
                                                        <input type="hidden" value="<?php echo $value['vbId'];?>" name="vbId">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                        </form> </td>
                                                
                                            </tr>
                                               <?php }} ?> 
                                         
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        

                    </div> 
                </div>
              <?php $this->load->view('footer'); ?>
            </div>
        </div>
       <?php $this->load->view('footd');?>
        

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
                    window.location.href = '<?php echo base_url('dashboard/add_value_based_video')?>';
       }, 2000);

          </script>



        <?php } ?>
