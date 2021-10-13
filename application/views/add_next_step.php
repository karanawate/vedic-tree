<?php
 $this->load->view('header');
 $monthdata =  required_data_admin();


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

                        <h1>
                             <?php
                             
                             if($where_to_upload==0){
                                $where_to_upload_name = "Live";
                            }else{
                                $where_to_upload_name = $where_to_upload;
                            }
                            
                            if($whereupload==1){
                                    $whereuploadName = "Demo";
                                }else if($whereupload==2){
                                    $whereuploadName = "Live";
                                }else if($whereupload==3){
                                    $whereuploadName = "Recap";
                                }else{
                                    $whereuploadName = "Common";
                                }
                                
                                            
                             
                               if($classId==1) 
                                {
                                 echo "Nursery Class Upload Video in ".$where_to_upload_name." Course / ".$whereuploadName ;
                                } else if($classId==2)
                                {
                                 echo "Junior Class Upload Video in ".$where_to_upload_name." Course / ".$whereuploadName ;
                                }else{
                                 echo "Senior Class Upload Video in ".$where_to_upload_name." Course / ".$whereuploadName ;
                                } 
                                
                                ?>
                            </h1>
                            <h1>
                                <?php echo " Month ".$monthId; ?>
                            </h1>
                        <div class="row" style="padding:75px;" >
                            <?php 

                            if($monthdata){
                                foreach ($monthdata['daydata'] as $key => $value) {
                                 
                                $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                                 $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                                ?>
                            <div class="col-xl-3 col-md-6">
                                
                                 <a href="<?php echo base_url('dashboard/add_next_to_next_step/'.$classId.'/'.$monthId.'/'.$value['dayId'].'/'.$where_to_upload.'/'.$whereupload)?>" class="gallery-popup" title="Open Imagination">
                                    <div class="project-item">
                                        <div class="overlay-container" style="height:100px;background-color:<?php echo $color;?>">
                                            <h1 class="ml-2" style="padding: 9% 22%;color: white;"><?php echo $value['dayName'];?></h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <i data-toggle="modal" data-target="#basicExampleModal<?php echo $value['dayId']; ?>" class="fas fa-address-book"></i>
                            

                                <?php }} ?>
                            </div>
                        
                    </div> <!-- container-fluid -->
                </div>
            </div>
        </div>
    </div>


      <?php 

        if($monthdata){
        foreach ($monthdata['daydata'] as $key => $value) { 
            $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
            $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

            $getcountuploadvideo = getcountuploadvideo1($classId,$value['dayId'],$monthId); 
            
        ?>

            <div class="modal fade" id="basicExampleModal<?php echo $value['dayId']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Info About uploaded Video</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <ol>
                          <li style="font-size:large; color:<?php echo $color; ?>">Demo Video   = <?php echo $getcountuploadvideo['demo'];?></li>
                          <li style="font-size:large; color:<?php echo $color; ?>">Live Video   = <?php echo $getcountuploadvideo['live'];?></li>
                          <li style="font-size:large; color:<?php echo $color; ?>">Course Three Video  = <?php echo $getcountuploadvideo['three'];?></li>
                          <li style="font-size:large; color:<?php echo $color; ?>">Course Seven Video  = <?php echo $getcountuploadvideo['seven'];?> </li>
                      </ol>
                      
                      
                      <div class="row">


                        <table id="datatables" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th class="thclass">#Id</th>
                                <th class="thclass">Session Name</th>
                                <th class="thclass">Session Count</th>    
                                <th class="thclass">Course Period</th>    
                            </tr>
                            </thead>  
                            <tbody>
                               <?php if($getcountuploadvideo){
                                $i=1;
                                foreach ($getcountuploadvideo['allcourse'] as $key => $value) { 
                                    
                                ?> 
                            <tr>
                                <td><?php echo $i++;?></td>
                                
                                <td><?php echo $value['sessionName']; ?></td>
                                <td><?php echo $value['sessioncount']; ?></td>
                                <td><?php echo $value['coursePeriod']; ?></td>
                            </tr>
                            <?php }} ?>
                             </tbody>
                        </table>                  
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

           

<?php }} ?>

        <!-- END layout-wrapper -->

       <?php $this->load->view('footd');?>

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
                    window.location.href = '<?php echo base_url('dashboard/days/'.$monthId)?>';
       }, 2000);


  </script>

<?php } ?>

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
