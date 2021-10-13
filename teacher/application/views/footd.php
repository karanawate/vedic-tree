    <script type="text/javascript">
        type = ['','info','success','warning','danger'];
    </script>

   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url()?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/pages/form-editor.init.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap-notify.js"></script>
    <script src="<?php echo base_url()?>assets/js/app.js"></script>
     <script src="<?php echo base_url()?>assets/js/file-upload.js"></script>

    <!-- Required datatable js -->
    <script src="<?php echo base_url()?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
     <script src="<?php echo base_url()?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
     <script src="<?php echo base_url()?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
     <!-- Responsive examples -->
    <script src="<?php echo base_url()?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/pages/datatables.init.js"></script> 
    <script src="<?php echo base_url()?>assets/libs/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url()?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/jquery.repeater/jquery.repeater.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/pages/form-repeater.int.js"></script>
    <script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
  </body>
</html>

 <script type="text/javascript">
    $(document).ready(function(){

        var webstatus="";
        $("#switch1").click(function(){

           if($(this).prop("checked") == true){
// 1
             webstatus = 1;                    

            }
            else if($(this).prop("checked") == false){
                // console.log("Checkbox is unchecked.");2
                webstatus = 2;
            }


            $.ajax({

                    type:"POST",
                    data:{webstatus:webstatus},
                    url:"<?php echo base_url('dashboard/downwebsite')?>",
                    success:function(res){
                        console.log(res);
                    },
                    error:function(error){
                        console.log(res);
                    }
                 }) ;     


        });
        // switch1
    })
    </script>