<?php
$usersession = $this->session->userdata('usersession');
$adminRole = $usersession[0]['adminRole'];
?>
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>
                <?php if($adminRole==1 || $adminRole==4){ ?>
            <li>
                <a href="<?php echo base_url('dashboard');?>" class="waves-effect">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <span>List Of Students</span>
                    </a>

                    <ul class="sub-menu mm-collapse" aria-expanded="false" >
                            
                            <li>
                                <a href="<?php echo base_url('dashboard/get_temp_enquiry');?>" class="waves-effect">
                                    <i style="font-size:large;" class="fas fa-users"></i>
                                    <span>Temprory Enquiry  </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('dashboard/getstudlist');?>" class=" waves-effect">
                                    <i style="font-size:large;" class="fas fa-users"></i>
                                    <span>Student List</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('dashboard/getstudlistina');?>" class=" waves-effect">
                                    <i style="font-size:large;" class="fas fa-users"></i>
                                    <span>In Active Student List</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('dashboard/promocode_list_student');?>" class=" waves-effect">
                                    <i style="font-size:large;" class="fas fa-users"></i>
                                    <span>Promo Code Student List</span>
                                </a>
                            </li>
                        </ul>
                </li>

                 <li class="">
                        <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <span> Allocation </span>
                        </a>
                        <ul class="sub-menu mm-collapse" aria-expanded="false" >
                            <li>
                                <a href="<?php echo base_url('dashboard/assign_student_manual');?>" class="waves-effect">
                                    <i style="font-size:large;" class="fas fa-users"></i>
                                    <span>Allocate Student  Manually Nursery</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('dashboard/assign_student_manual_junior');?>" class="waves-effect">
                                    <i style="font-size:large;" class="fas fa-userse"></i>
                                    <span>Allocate Student  Manually Junior</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('dashboard/assign_student_manual_senior');?>" class="waves-effect">
                                    <i style="font-size:large;" class="fas fa-users"></i>
                                    <span>Allocate Student  Manually Senior</span>
                                </a>
                            </li>
                            <li>
                               <a href="<?php echo base_url('dashboard/get_classroom_homework');?>" class="waves-effect">
                                    <i style="font-size:large;" class="fas fa-users"></i>
                                    <span>Homework checkup</span>
                                </a>
                            </li>
                      </ul>
                </li>

                <li class="">
                        <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                            <i class="fas fa-money-bill-alt"></i>
                            <span> Fees </span>
                        </a>
                        <ul class="sub-menu mm-collapse" aria-expanded="false" >
                            <li>
                                <a href="<?php echo base_url('dashboard/add_fees');?>" class="waves-effect">
                                    <i class="fas fa-rupee-sign"></i>
                                    <span>Fees Module</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('dashboard/addpackage');?>" class="waves-effect">
                                    <i class="fas fa-address-book"></i>
                                    <span>Add Package</span>
                                </a>
                            </li>
                            
                        </ul>
                </li>

                <li class="">
                        <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                            <i class="far fa-sticky-note"></i>
                            <span> Notice </span>
                        </a>

                        <ul class="sub-menu mm-collapse" aria-expanded="false" >

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

                        </ul>
                </li>
              
                <li class="">
                        <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                            <i class="ti-package"></i>
                            <span> Leads </span>
                        </a>

                        <ul class="sub-menu mm-collapse" aria-expanded="false" >

                            <li>
                                <a href="<?php echo base_url('dashboard/not_covert_to_admission');?>" class="waves-effect">
                                    <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                                    <span>Registered Student ( but not enrolled )</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="<?php echo base_url('dashboard/add_lead_facebook');?>" class="waves-effect">
                                    <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                                    <span>Add Leads Facebook </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('dashboard/apiresult');?>" class=" waves-effect">
                                    <i class="mdi mdi-clipboard-list-outline"></i>
                                    <span>Api Result</span>
                                </a>
                            </li>

                
                        </ul>
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
                    <ul class="sub-menu mm-collapse" aria-expanded="false" >
                        <li>
                            
                            <a href="<?php echo base_url('dashboard/videouploading');?>"><i class="fas fa-address-book"></i> Video uploading</a>
                        </li> 
                        <!--<li>-->
                        <!--    <a href="<?php echo base_url('dashboard/classroom');?>"> List of video uploading </a>-->
                        <!--</li> -->
                        
                        <li>
                           
                            <a href="<?php echo base_url('dashboard/classroom_for_edu');?>"><i class="fas fa-address-book"></i> list Value based Education</a>
                        </li> 

                        <!--<li>-->
                        <!--    <a href="<?php echo base_url('dashboard/classroom_demo');?>">list Of Demo Video</a>-->
                        <!--</li> -->
                        <!--<li>-->
                        <!--    <a href="<?php echo base_url('dashboard/classroom_recap');?>">list Of Recap Video</a>-->
                        <!--</li> -->
                        
                        <!--<li>-->
                        <!--    <a href="<?php echo base_url('dashboard/course_three');?>">list Of course 3 Video</a>-->
                        <!--</li>-->
                        <!--<li>-->
                        <!--    <a href="<?php echo base_url('dashboard/course_six');?>">list Of course 7 Video</a>-->
                        <!--</li> -->
                        
                        <li>
                            
                            <a href="<?php echo base_url('dashboard/add_value_based_video');?>"><i class="fas fa-address-book"></i> Add Value Based Video</a>
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
                    <a href="<?php echo base_url('dashboard/addAdmin');?>" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Add Admins</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('dashboard/leadfollowup');?>" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>leads follow up</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('dashboard/teacher_get_information');?>" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Add Teachers</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('adminseo/presipal_sign');?>" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Add Presipal-sign</span>
                    </a>
                </li>

            <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="ti-package"></i>
                        <span>List Of Students</span>
                    </a>
                <ul class="sub-menu mm-collapse" aria-expanded="false" >
                
                <li>
                    <a href="<?php echo base_url('dashboard/getstudlist');?>" class=" waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>Student List</span>
                    </a>
                </li>
                
                

                <li>
                    <a href="<?php echo base_url('dashboard/promocode');?>" class=" waves-effect">
                        <i class="mdi mdi-clipboard-list-outline"></i>
                        <span>Create Promo Code</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('dashboard/getstudlistina');?>" class=" waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>In Active Student List</span>
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

            </ul>
        </li>

        
         <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="ti-package"></i>
                        <span> Fees </span>
                    </a>

                    <ul class="sub-menu mm-collapse" aria-expanded="false" >
                        <li>
                            <a href="<?php echo base_url('dashboard/emi_form_by_parents');?>" class="waves-effect">
                                <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                                <span>Emi Forms Filled up by parents </span>
                            </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url('dashboard/not_covert_to_admission');?>" class="waves-effect">
                                <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                                <span>Registered Student ( but not enrolled )</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('dashboard/partial_payment_students');?>" class="waves-effect">
                                <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                                <span>Registered Student With Partial Payment</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('dashboard/full_payment_students');?>" class="waves-effect">
                                <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                                <span>Registered Student With Full Payment</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('dashboard/discountlist');?>" class="waves-effect">
                                <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                                <span>Registered Student Discount</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('dashboard/closeaccountlist');?>" class="waves-effect">
                                <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                                <span>Close Account Student List</span>
                            </a>
                        </li>
                 
                    </ul>
                </li>
                
                      <?php }else if($adminRole == 7) { ?>
                
                    <li>
                            <a href="<?php echo base_url('adminseo/index');?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                   <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="ti-package"></i>
                        <span>Blogs</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false" >
                        <li>
                            <a href="<?php echo base_url('adminseo/createlogs');?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>Create-Blogs</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('adminseo/view_blogs');?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>View-Blogs</span>
                            </a>
                        </li>
                    </ul>
                </li>
                   <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="ti-package"></i>
                        <span>Events</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false" >
                        <li>
                            <a href="<?php echo base_url('adminseo/create_events');?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>Create Events</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('adminseo/view_events');?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>View Event</span>
                            </a>
                        </li>
                    </ul>
                </li>
                   <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="ti-package"></i>
                        <span>Youtube-reviews</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false" >
                        <li>
                            <a href="<?php echo base_url('adminseo/create_youtube_review');?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>Youtube Review</span>
                            </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url('adminseo/view_youtube_review');?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>View Youtube Review</span>
                            </a>
                        </li>
                    </ul>
                </li>
                   <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="ti-package"></i>
                        <span>Web Banner</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false" >
                        <li>
                            <a href="<?php echo base_url('adminseo/website_banner');?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>website Banner</span>
                            </a>
                        </li>   
                        <li>
                            <a href="<?php echo base_url('adminseo/view_website_banner');?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>View website Banner</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="">
                        <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                            <i class="ti-package"></i>
                            <span> Website Additions </span>
                        </a>

                        <ul class="sub-menu mm-collapse" aria-expanded="false" >

                            <li>
                                <a href="<?php echo base_url('dashboard/add_web_seo');?>" class="waves-effect">
                                    <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                                    <span>Add Website SEO </span>
                                </a>
                            </li>
                            
                             <li>
                                <a href="<?php echo base_url('dashboard/add_tbl_pdfcourse');?>" class="waves-effect">
                                    <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                                    <span>Add pdfcourse</span>
                                </a>
                            </li>
                            
                             <li>
                                <a href="<?php echo base_url('dashboard/update_gallery');?>" class="waves-effect">
                                    <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                                    <span>Add Gallery</span>
                                </a>
                             </li>
                             
                            <li>
                                <a href="<?php echo base_url('dashboard/parents_review_update');?>" class="waves-effect">
                                    <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                                    <span>parents review update</span>
                                </a>
                            </li>
                        </ul>
                </li>
                

             
               <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="ti-package"></i>
                        <span>Webinar Content</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false" >
                        <li>
                            <a href="<?php echo base_url('adminseo/webinar_banner');?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>webinar Banner</span>
                            </a>
                        </li> 
                        <li>
                            <a href="<?php echo base_url('adminseo/view_webinar_banner');?>" class=" waves-effect">
                                <i class="mdi mdi-clipboard-list-outline"></i>
                                <span>View Webinar</span>
                            </a>
                         </li>
                        <li>
                            <a href="<?php echo base_url('webinar/getWebinardata');?>" class=" waves-effect">
                                <i class="mdi mdi-clipboard-list-outline"></i>
                                <span>Webinar Leads</span>
                            </a>
                         </li>
                         
                        <li>
                            <a href="<?php echo base_url('adminseo/webinar_timetbl');?>" class=" waves-effect">
                                <i class="mdi mdi-clipboard-list-outline"></i>
                                <span>Webinar Timetable</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?php echo base_url('adminseo/webinar_features_speckers');?>" class=" waves-effect">
                                <i class="mdi mdi-clipboard-list-outline"></i>
                                <span>Features Speckers</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('adminseo/view_feature_speckers');?>" class=" waves-effect">
                                <i class="mdi mdi-clipboard-list-outline"></i>
                                <span>ViewFeatures Speckers</span>
                            </a>
                        </li>
                        
                        
                    </ul>
                </li>
             
             <?php }else if($adminRole == 9){ ?>
              <li>
               <a href="<?php echo base_url('dashboard/get_classroom_homework');?>" class="waves-effect">
                    <i style="font-size:large;" class="fas fa-users"></i>
                    <span>Homework checkup</span>
                </a>
                </li>
             
                <?php }else if($adminRole == 8) { ?>
              <li>
                <a href="<?php echo base_url('dashboard/apiresult');?>" class=" waves-effect">
                    <i class="mdi mdi-clipboard-list-outline"></i>
                    <span>Api Result</span>
                </a>
             </li>
              <li>
                <a href="<?php echo base_url('webinar/getWebinardata');?>" class=" waves-effect">
                    <i class="mdi mdi-clipboard-list-outline"></i>
                    <span>Webinar Leads</span>
                </a>
             </li>
                <?php }else if($adminRole==10){ ?>
                 <li>
                    <a href="<?php echo base_url('dashboard/get_temp_enquiry');?>" class="waves-effect">
                        <i style="font-size:large;" class="typcn typcn-group-outline"></i>
                        <span>Temprory Enquiry  </span>
                    </a>
                </li>
                
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
