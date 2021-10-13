<?php $usersession = $this->session->userdata('usersession'); ?>
<html lang="zxx">
<head>
    <style>
        .form-control {
            width:300px;
        }
        .assign-homework {
            display: grid;
            grid-template-columns: 0.5fr 1fr;
            grid-gap: 10px;
        }
        .filepond--root .filepond--credits[style] {
            display: none;
        }
        
        
    </style>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <!--<link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet" />-->
    <!--<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
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
                    <div class="d-flex justify-content-between my-4">
                        <h1 style="font-weight: 800;color:darkorange">Home Work Allocated</h1>
                    </div>
                    <div class="alert alert-primary"  role="alert" id='resultDiv' style="display:none"></div>
                    <form method="POST" id="upload_form"  enctype="multipart/form-data">
                        <input type ="hidden" name="fk_feesId" id="fk_feesId" value="<?php echo $fees_ids['feesId'] ?>" />
                        <div class="assign-homework">
                            <div class="upload-hm">
                                <div class="form-group">
                                    <label>File Upload</label><span style="color:red">*</span>
                                        <!--<input type="file" multiple="multiple" name="allocated_file[]" class="form-control" required>-->
                                      <input type="file" name="allocated_file[]" id="allocated_file" class="filepond"  data-max-file-size="3MB"/>
                                    <span style="color:red"><?php echo form_error('allocated_file');?></span>
                                </div>
                            </div>
                            <div class="detaile-hm">
                                <div class="form-group">
                                    <label>Title</label><span style="color:red">*</span>
                                     <input type="text" name="home_title" id="home_title" class="form-control " required>
                                    <span style="color:red"><?php echo form_error('title');?></span>
                                </div>
                                <div class="form-group">
                                    <label>Description</label><span style="color:red">*</span>
                                     <textarea type="text" name="description" id="home_title" class="form-control" required></textarea>
                                    <span style="color:red"><?php echo form_error('description');?></span>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="username">Start Time</label><span style="color:red">*</span>
                                        <input type="date" id="start_time" name="start_time" class="form-control" required>
                                        <span style="color:red"><?php echo form_error('start_time');?></span>
                                    </div>
                                    <div class="form-group col">
                                        <label for="username">End Time</label><span style="color:red">*</span>
                                        <input type="date"  id="end_time" name="end_time" class="form-control" required>
                                        <span style="color:red"><?php echo form_error('end_time');?></span>
                                    </div> 
                                </div>
                            </div>
                        </div>
                       <div><button class="btn btn-primary w-md waves-effect waves-light" value="Upload" type="submit">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('footd');?>
</body>
</html>
<script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>


<script>
    $(document).ready(function(){
        setTimeout(function() {
            $('#resultDiv').fadeOut('fast');
        }, 40000);
    });
</script>

<script type="text/javascript">
// FilePond.registerPlugin(FilePondPluginImageEdit,FilePondPluginImagePreview);
$(document).ready(function () {
    var inputElement = document.querySelector('#allocated_file');
    const pond = FilePond.create(inputElement, {
        maxFiles: 5,
        maxFileSize: '3MB',
        allowMultiple: true,
        allowProcess: false,
        // allowImageEdit: true,
        // instantUpload: false,
        // acceptedFileTypes: ['image/png', 'image/jpeg'],
        // fileValidateTypeLabelExpectedTypes: true,
    });
    $("#upload_form").submit(function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        // append files array into the form data
        pondFiles = pond.getFiles();
        for (var i = 0; i < pondFiles.length; i++) {
            fd.append('allocated_file[]', pondFiles[i].file);
        }
        $.ajax({
            url: '<?php echo site_url('teacher/multiple_files'); ?>',
            type: 'POST',
            data: fd,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
            console.log(data)
                $("#resultDiv").html(data.success).show();
                $("#upload_form")[0].reset();
                pond.removeFiles();
                setTimeout(function() {
                    $('#resultDiv').fadeOut('fast');
                }, 30000);

            },
            error: function (data) {
                //  todo the logic
            }
        });
    });
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
                window.location.href = '<?php echo base_url('teacher/teacher_attedence')?>';
    }, 2000);
    </script>
<?php } ?>





























