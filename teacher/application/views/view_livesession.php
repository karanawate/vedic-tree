<?php

    $usersession    = $this->session->userdata('usersession');
    
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <style>
    </style>
    <!-- Vedic Teacher header files Start -->
    <?php $this->load->view('teacher_header'); ?>
    <!-- Vedic Teacher header files End -->
</head>
<body>
    <!-- Simulate a smartphone / tablet -->
    <?php $this->load->view('mobilemenu'); ?>
    <!-- End smartphone / tablet look -->
    <div class="boxes">
      <?php $this->load->view('teachersidebar'); ?>
        <div class="box11 animated_hero" style="background: #695FFE;">
            <div class="box-inside">
                <div class="desktop-mobile-view">
                    <!-- //top header -->
                    <?php $this->load->view('teacher_topheader'); ?>
                    <!-- //end top header -->
                    <h1 class="my-4" style="font-weight: 800;color:darkorange">Allocated Live Session</h1>
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th class="thclass">Id</th>
                                <!-- <th class="thclass">Class Name</th> -->
                                <th class="thclass">Package Name</th>
                                <th class="thclass">Batch</th>
                                <th class="thclass">Microsoft Link</th>
                                <th class="thclass">Start Date</th>
                                <th class="thclass">Start Time</th>
                                <th class="thclass">End Date</th>
                                <th class="thclass">End Time</th>
                                <th class="thclass">Created At</th>
                                <th class="thclass">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        <?php foreach($view_live_session as $live) { ?>
                            <tr>
                                <td><?php echo $live['id'] ?></td>
                                <!-- <td><?php echo $live['className'] ?></td> -->
                                <td><?php  echo $live['packageName']?></td>
                                <td><?php  echo $live['batchName']?></td>
                                <td><a  id="<?php echo $live['id']?>" class="linkclick" data-value="<?php echo $live['id']?>" href="<?php echo base_url('teacher/teacherfinalform/'.$live['id'])?>">Live link</a></td>
                                <td><?php  echo $live['start_date']?></td>
                                <td><?php  echo $live['start_time']?></td>
                                <td><?php  echo $live['end_date']?></td>
                                <td><?php  echo $live['end_time']?></td>
                                <td><?php  echo $live['created_at']?></td>
                                <td>
                                    <div class="d-flex">
                                        <!--<div class="mr-2"><a href="<?php echo base_url('teacher/liveedit/'.$live['id'])?>"><i style="font-size:25px;" class="mdi mdi-account-edit-outline"></i></a></div>-->
                                        <div>
                                            <form class="" method="POST" onclick="return check();" action="<?php echo base_url('Api_zoom/deleteliveid');?>">
                                                <input type="hidden" value="<?php echo $live['id'];?>" name="live_id">
                                                <button  type="submit" name="submit" value="submit" class="btn btn-sm p-0"><i style="font-size:25px;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                            </form> 
                                        </div> 
                                    </div>  
                                </td>
                            </tr>
                        <?php } ?>                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>

</script>
<script type="text/javascript">
$(document).ready( function () {
    $('#myTable').DataTable();
    stateSave: true
});
$('.linkclick').click(function(event) {
    event.preventDefault();
    let id =  $(this).attr('id');
    //alert(id);
    $.ajax({
    type:"POST",
    data:{ id:id },
    url:"<?php echo base_url('teacher/teacherfinalform')?>",
        success:function(res){
            var data = $.parseJSON(res);
            console.log(data);
            // $("#test3").val(id);
                location.href = (data[0]?.microsoft_link);
        },
        error:function(error){
            console.log(error);
        }
    })
});
$(document).ready(function() {
    $(".mdi-delete").click(function(){
        var live_id =  $(this).attr('id');
        $.ajax({
            type:"POST",
            data:{
                live_id:live_id
                },
            url:"<?php echo base_url('Api_zoom/deleteliveid')?>",
            success:function(res){
                if(res==1){
                    swal({
                            title: "Notice is Deleted!",
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
});
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
        },{ type: type[color],
            timer: 8000,
        });
    </script>
<?php } ?>

