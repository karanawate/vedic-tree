<?php
$usersession = $this->session->userdata('usersession');
$adminRole = $usersession[0]['adminRole'];
?>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>
                <?php if($adminRole==1 || $adminRole==4){ ?>
                <li>
                    <a href="<?php echo base_url('dashboard');?>" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('dashboard/get_temp_enquiry');?>" class="waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>Temprory Enquiry  </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('dashboard/getstudlist');?>" class=" waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>Student List</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('dashboard/getstudlistina');?>" class=" waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>In Active Student List</span>
                    </a>
                </li>



                <li>
                    <a href="<?php echo base_url('dashboard/finaladmission');?>" class=" waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>Admissions</span>
                    </a>
                </li>


                <li>
                    <a href="<?php echo base_url('dashboard/notice');?>" class=" waves-effect">
                        <i class="mdi mdi-clipboard-list-outline"></i>
                        <span>Create Notice</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('dashboard/getnoticelist');?>" class=" waves-effect">
                        <i class="mdi mdi-clipboard-list"></i>
                        <span>Notice List</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('QrController');?>" class=" waves-effect">
                        <i class="mdi mdi-barcode-scan"></i>
                        <span>Barcode Generator </span>
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo base_url('dashboard/add_fees');?>" class="waves-effect">
                        <i class="fas fa-rupee-sign"></i>
                        <span>Fees Module</span>
                    </a>
                </li>

                 <li>
                    <a href="<?php echo base_url('dashboard/assign_student');?>" class="waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>Allocate Student  </span>
                    </a>
                </li>

                 <li>
                    <a href="<?php echo base_url('dashboard/setemi');?>" class="waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>Add Emi  </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('dashboard/offlinecharitable');?>" class="waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>Offline Student / charitable admmission  </span>
                    </a>
                </li>

    
            <?php

             }else if($adminRole == 5 ) { ?>

                <li>
                    <a href="<?php echo base_url('dashboard/addcategory');?>" class="waves-effect">
                        <i class="fas fa-address-book"></i>
                        <span>Add Category</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('dashboard/addsession');?>" class="waves-effect">
                        <i class="fas fa-address-book"></i>
                        <span>Add Session</span>
                    </a>
                </li>

                <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="ti-package"></i>
                        <span>Course Management</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false" style="height: 0px;">
                        <li>
                            <a href="<?php echo base_url('dashboard/videouploading');?>">Video uploading</a>
                        </li> 
                        <li>
                            <a href="<?php echo base_url('dashboard/classroom');?>">List of video uploading</a>
                        </li> 
                         <li>
                            <a href="<?php echo base_url('dashboard/videouploading/'.base64_encode('valubasededucation'));?>">Value based education</a>
                        </li> 

                        <li>
                            <a href="<?php echo base_url('dashboard/classroom_for_edu');?>">list Value based education</a>
                        </li> 

                        <li>
                            <a href="<?php echo base_url('dashboard/classroom_demo');?>">list Of Demo Video</a>
                        </li> 
                        <li>
                            <a href="<?php echo base_url('dashboard/classroom_recap');?>">list Of Recap Video</a>
                        </li> 

                    </ul>
                </li>
                <?php }else if($adminRole == 6 ) { ?>
                <li>
                    <a href="<?php echo base_url('dashboard');?>" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('dashboard/getstudlist');?>" class=" waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>Student List</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo base_url('dashboard/get_temp_enquiry');?>" class="waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>Temprory Enquiry  </span>
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url('dashboard/onboardinglist');?>" class="waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>Onrolled Student List </span>
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url('dashboard/emi_form_by_parents');?>" class="waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>Emi Forms Filled up by parents </span>
                    </a>
                </li>
                <?php } ?>

            </ul>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->