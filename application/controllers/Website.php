<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


class Website extends CI_Controller {

public function __construct()
{
     parent::__construct();
     require_once APPPATH.'third_party/src/Google_Client.php';
     require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
     $usersession = $this->session->userdata('usersession');
     if($usersession){
         $logstatus = $this->regModel->autologoutStatus($usersession[0]['studId']);
         if($logstatus){
             if($logstatus[0]['logstatus']==2){
                 $this->logout();
             }
         }
     }
     
}



public function notification(){

   $usersession = $this->session->userdata('usersession');
   if(isset($usersession) || !empty($usersession)){
    $data['background_color_id'] = "";
    $this->load->view('notification',$data);
    }else{
     redirect(base_url('website'));
   }

}


public function vedicprofile()
{

      $usersession      = $this->session->userdata('usersession');
      $NewrefferalCode  = $usersession[0]['NewrefferalCode'];
      $fk_classId       = $usersession[0]['studentClass'];

      if(isset($_POST['submit'])){
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('usr_mobile_no', 'Mobile No', "trim|required|numeric|exact_length[10]");
        $this->form_validation->set_rules('usr_landline', 'Landline', "trim|numeric|exact_length[10]");
        $this->form_validation->set_rules('studId', 'studId', "trim|required|numeric|greater_than[0]");
        $this->form_validation->set_rules('usr_firstname', 'First Name', "trim|required");
        $this->form_validation->set_rules('usr_lastname', 'Last Name', "trim|required");
        $this->form_validation->set_rules('usr_add1', 'Address First', "trim");
        $this->form_validation->set_rules('usr_add2', 'Address Second', "trim");
        $this->form_validation->set_rules('usr_city', 'City', "trim");
        $this->form_validation->set_rules('usr_state', 'State', "trim|integer|greater_than[0]");
        $this->form_validation->set_rules('usr_country', 'Country', "trim");
        $this->form_validation->set_rules('usr_dob', 'Date of birth', "trim");
        ///extra 
        $this->form_validation->set_rules('adharno', 'Adhar Number', "trim");
        $this->form_validation->set_rules('studentReligion', 'studentReligion', "trim");
        $this->form_validation->set_rules('studentCaste', 'studentCaste', "trim");
        $this->form_validation->set_rules('studentSubcast', 'studentSubcast', "trim");
        $this->form_validation->set_rules('preschool', 'preschool', "trim");
        $this->form_validation->set_rules('mothertoungue', 'mother toungue', "trim");
        $this->form_validation->set_rules('promoCode', 'promo Code', "trim");
        $this->form_validation->set_rules('alternate_email', 'mother toungue', "trim|valid_email");
        

        $this->form_validation->set_rules('usr_email', 'Email', "trim|required|valid_email|is_unique[studentreg.studentEmail]");
        $studId             = $this->input->post('studId');

        if ($this->form_validation->run() == FALSE)
        { 
        // echo validation_errors();  
          $data['userinfo']             = $this->regModel->userinfo($studId);
          $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
          $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
          $data['userinfo_mother']      = $this->regModel->userinfo_mother($studId);  
          $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
          $data['bank_info']            = $this->regModel->bank_info($studId); 
          $data['background_color_id']  = 4;
          $data['user_state']           = $this->regModel->user_state();
          $this->load->view('vedicprofile',$data);

        }else{

              $usr_mobile_no      = $this->input->post('usr_mobile_no'); 
              $usr_landline       = $this->input->post('usr_landline');
              $usr_firstname      = $this->input->post('usr_firstname');
              $usr_lastname       = $this->input->post('usr_lastname');
              $user_abt_info      = $this->input->post('user_abt_info');
              $usr_add1           = $this->input->post('usr_add1');
              $usr_add2           = $this->input->post('usr_add2');
              $usr_city           = $this->input->post('usr_city');
              $usr_state          = $this->input->post('usr_state');
              $usr_country        = $this->input->post('usr_country');
              $usr_email          = $this->input->post('usr_email');
              $studId             = $this->input->post('studId');
              $role               = $this->input->post('role');
              $usr_dob            = $this->input->post('usr_dob');
              $adharno            = $this->input->post('adharno');
              $studentReligion    = $this->input->post('studentReligion');
              $studentCaste       = $this->input->post('studentCaste');
              $studentSubcast     = $this->input->post('studentSubcast');
              $preschool          = $this->input->post('preschool');
              $mothertoungue      = $this->input->post('mothertoungue');
              $usr_profile        = $_FILES['usr_profile']['name'];
              $old_user_profile   = $this->input->post('old_user_profile');
              $old_dob_certificate = $this->input->post('old_dob_certificate');
              $alternate_email    = $this->input->post('alternate_email');
              $promoCode          = $this->input->post('promoCode');
              if(!empty($_FILES['dob_certificate'])){
               $dob_certificate    = $_FILES['dob_certificate']['name'];
              }else{
                  $dob_certificate = "no certificate";
              }

            

              if($role=="student"){

                $config['upload_path']          = './uploads/studetprofile/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['quality']              = 60;
              }elseif ($role=="father") {
                $config['upload_path']          = './uploads/fatherprofile/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['quality']              = 60;
              }else{
                $config['upload_path']          = './uploads/motherprofile/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['quality']              = 60;
              
              }

              $this->load->library('upload', $config);
              $this->upload->initialize($config);

              if($role=="student"){
                if ( ! $this->upload->do_upload('usr_profile'))
                  {
                          $data['error']                = array('error' => $this->upload->display_errors());
                          $data['userinfo']             = $this->regModel->userinfo($studId);
                          $data['bank_info']            = $this->regModel->bank_info($studId); 
                          $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
                          $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
                          $data['userinfo_mother']      = $this->regModel->userinfo_mother($studId);
                          $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                          $data['background_color_id']  = 4;
                          $data['user_state']           = $this->regModel->user_state();
                          $this->load->view('vedicprofile', $data);
                  }
                  else
                  {
                          $data = array('usr_profile' => $this->upload->data());
                          $usr_profile = $data['usr_profile']['file_name'];
                  }
                  
                  if ( ! $this->upload->do_upload('dob_certificate'))
                  {
                          $data['error']                = array('dob_certificate' => $this->upload->display_errors());
                          $data['userinfo']             = $this->regModel->userinfo($studId);
                          $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
                          $data['userinfo_mother']      = $this->regModel->userinfo_mother($studId);
                          $data['bank_info']            = $this->regModel->bank_info($studId); 
                          $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
                          $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                          $data['background_color_id']  = 4;
                          $data['user_state']           = $this->regModel->user_state();
                          $this->load->view('vedicprofile', $data);
                  }
                  else
                  {
                          $data = array('dob_certificate' => $this->upload->data());
                          $dob_certificate = $data['dob_certificate']['file_name'];
                  }
              
              }elseif ($role=="father") {
                    if ( ! $this->upload->do_upload('usr_profile'))
                  {
                          $data['error']                = array('error' => $this->upload->display_errors());
                          $data['userinfo']             = $this->regModel->userinfo($studId);
                          $data['bank_info']            = $this->regModel->bank_info($studId); 
                          $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
                          $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
                          $data['userinfo_mother']      = $this->regModel->userinfo_mother($studId);
                          $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                          $data['background_color_id']  = 4;
                          $data['user_state']           = $this->regModel->user_state();
                          $this->load->view('vedicprofile', $data);
                  }
                  else
                  {
                          $data = array('usr_profile' => $this->upload->data());
                          $usr_profile = $data['usr_profile']['file_name'];
                  }
              }elseif($role=="mother"){
                if ( ! $this->upload->do_upload('usr_profile'))
                {
                        $data['error']                  = array('error' => $this->upload->display_errors());
                        $data['userinfo']               = $this->regModel->userinfo($studId);
                        $data['bank_info']              = $this->regModel->bank_info($studId); 
                        $data['myrefferals']            = $this->regModel->myrefferals($NewrefferalCode);
                        $data['userinfo_father']        = $this->regModel->userinfo_father($studId);
                        $data['userinfo_mother']        = $this->regModel->userinfo_mother($studId);
                        $data['last_session_running']   = $this->regModel->last_session_running($studId,$fk_classId);
                        $data['background_color_id']    = 4;
                        $data['user_state']             = $this->regModel->user_state();
                        $this->load->view('vedicprofile', $data);
                }
                else
                {
                        $data = array('usr_profile' => $this->upload->data());
                        $usr_profile = $data['usr_profile']['file_name'];
                }
              
              }

              if(!empty($usr_profile)){
                $usr_profile = $usr_profile;;
              }else{
                $usr_profile = $old_user_profile;
              }
              
              if(!empty($dob_certificate)){
                $dob_certificate = $dob_certificate;;
              }else{
                $dob_certificate = $old_dob_certificate;
              }
              

               $data =  array(
                        'studentAltMobile' =>  $usr_mobile_no,
                        'usr_landline'     =>  $usr_landline,
                        'usr_firstname'    =>  $usr_firstname,
                        'usr_lastname'     =>  $usr_lastname,
                        'user_abt_info'    =>  $user_abt_info,
                        'usr_add1'         =>  $usr_add1,
                        'usr_add2'         =>  $usr_add2,
                        'usr_city'         =>  $usr_city,
                        'usr_state'        =>  $usr_state,
                        'usr_country'      =>  $usr_country,
                        'studentEmail'     =>  $usr_email,
                        'studId'           =>  $studId,
                        'usr_dob'          =>  $usr_dob,
                        'adharno'          =>  $adharno,
                        'studentReligion'  =>  $studentReligion,
                        'studentCaste'     =>  $studentCaste,
                        'studentSubcast'   =>  $studentSubcast,
                        'preschool'        =>  $preschool,
                        'mothertoungue'    =>  $mothertoungue,
                        'usr_profile'      =>  $usr_profile,
                        'dob_certificate'  =>  $dob_certificate,
                        'alternate_email'  =>  $alternate_email,
                        'promoCode'        =>  $promoCode,
                        
                      );

                              

               $res = $this->regModel->updateinfo($data,$role);
               if($res==1){
                  $data['error']                = array('error' => "Information Updated Successfully !");
                  $data['userinfo']             = $this->regModel->userinfo($studId);
                  $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
                  $data['bank_info']            = $this->regModel->bank_info($studId); 
                  $data['userinfo_mother']      = $this->regModel->userinfo_mother($studId);
                  $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
                  $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                  $data['background_color_id']  = 4;
                  $data['user_state']           = $this->regModel->user_state();
                  $this->load->view('vedicprofile',$data);
               }else{
                  $data['error']                = array('error' => "Information Not Updated Successfully !");
                  $data['bank_info']            = $this->regModel->bank_info($studId); 
                  $data['userinfo']             = $this->regModel->userinfo($studId);
                  $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
                  $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
                  $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                  $data['background_color_id']  = 4;
                  $data['user_state']           = $this->regModel->user_state();
                  $data['userinfo'] = $this->regModel->userinfo($studId);
                  $this->load->view('vedicprofile',$data);
               }

        }
      }else{

         $usersession = $this->session->userdata('usersession');
         if(isset($usersession) || !empty($usersession)) {
           $studId                       = $usersession[0]['studId'];
           $NewrefferalCode              = $usersession[0]['NewrefferalCode'];
           $fk_classId                   = $usersession[0]['studentClass'];
           $data['userinfo']             = $this->regModel->userinfo($studId);
           $data['user_state']           = $this->regModel->user_state();
           $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
           $data['userinfo_mother']      = $this->regModel->userinfo_mother($studId);
           $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
           $data['bank_info']            = $this->regModel->bank_info($studId); 
           $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
           $data['background_color_id']  = $this->uri->segment(3);
           $this->load->view('vedicprofile',$data);
          } else {
           $this->load->view('website');
          } 
      }

}




public function vedic_dash()
{
   $usersession = $this->session->userdata('usersession');

   if(isset($usersession) || !empty($usersession))
   {

    $fk_classId = $usersession[0]['studentClass'];
    $data['listvideouploading']   = $this->regModel->listvideouploading($fk_classId);
    $data['fk_classId']           = $fk_classId; 
    $data['background_color_id']  = $this->uri->segment(2);
    $vidcreateDT                  = date("Y-m-d h:i:s");
    $vidcreateDT                  = date('Y-m-01 h:i:s', strtotime($vidcreateDT));
    $param                        = 'valubasededucation';
    $fk_classId                   = $usersession[0]['studentClass']; 
    $endvidcreateDT               = date("Y-m-t", strtotime($vidcreateDT));
    $data['gmdovbe']              =  $this->regModel->get_month_data_of_value_based_eductaion($vidcreateDT,$param,$endvidcreateDT,$fk_classId);
    $data['last_session_running'] = $this->regModel->last_session_running($usersession[0]['studId'],$fk_classId);
    $this->load->view('vedicdash',$data);

   }else{

    redirect(base_url('website'));

   }
}

public function timeline()
{
   $usersession = $this->session->userdata('usersession');

   if(isset($usersession) || !empty($usersession)){

    $fk_classId = $usersession[0]['studentClass'];
    $studId = $usersession[0]['studId'];
    $data['listvideouploading'] = $this->regModel->listvideouploading($fk_classId);
    $data['fk_classId'] = $fk_classId; 
    $data['studenttimeline'] = $this->regModel->studenttimeline($studId);
    $this->load->view('timeline',$data);

   }else{

    redirect(base_url('website'));

   }
}


public function vedic_learn()
{

  $usersession = $this->session->userdata('usersession');

   if(isset($usersession) || !empty($usersession)){

    $monthId     = $this->uri->segment(3); 
    $dayId       = $this->uri->segment(4);
    $fk_classId  = $this->uri->segment(5);
    $vidId       = base64_decode($this->uri->segment(6));
    $his         = $this->uri->segment(7);
    $studId      = $usersession[0]['studId'];
  
    if($his!=""){
          

       $data['get_day_sessions'] = $this->regModel->get_day_sessions($dayId,$monthId,$fk_classId,$studId);
       $data['background_color_id'] = $this->uri->segment(8);
       $last_session_running = $this->regModel->last_session_running($usersession[0]['studId'],$fk_classId);
       if(!empty($last_session_running)){
        $data['youtubelinks'] = $last_session_running[0]['videoId'];   
         $string = $last_session_running[0]['videoId'];
       }else{
           $data['youtubelinks'] = "";
            $string = "";
       }
       
        $vidId = (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);
        $data['vidId']      = $vidId;
        $data['monthId']    = $monthId;
        $data['dayId']      = $dayId;
        $data['fk_classId'] = $fk_classId;

    }else{
       
        if($vidId > 0 ){

            //tbl_calender_open_coursewise_day
            
            
            $currentDate = date("Y-m-d");
            $check_day_calender_wise = $this->regModel->check_day_calender_wise($dayId,$currentDate,$monthId,$studId);
            
            if(!empty($check_day_calender_wise) && $check_day_calender_wise[0]['calDate'] <= $currentDate ){

                $get_day_sessions_vid = $this->regModel->get_day_sessions_vid($dayId,$monthId,$fk_classId,$vidId,$studId);
                
            }else{
            
                if(!empty($check_day_calender_wise)){
                    if($check_day_calender_wise[0]['Days'] >= $dayId && $check_day_calender_wise[0]['Months'] >= $monthId ){
                      $data['background_color_id'] = $this->uri->segment(8);
                      $get_day_sessions_vid = $this->regModel->get_day_sessions_vid($dayId,$monthId,$fk_classId,$vidId,$studId);
                    }else{
                      $data['background_color_id'] = $this->uri->segment(8);
                      $get_day_sessions_vid = array();
                    }
                }else{
                     $data['background_color_id'] = $this->uri->segment(8);
                     $get_day_sessions_vid = array();
                }
            }

         }else{
          
            //check day calender wise
            $currentDate = date("Y-m-d");
            $check_day_calender_wise = $this->regModel->check_day_calender_wise($dayId,$currentDate,$monthId,$studId);
            
           
             if(!empty($check_day_calender_wise) && $check_day_calender_wise[0]['calDate'] <= $currentDate ){
                
                $get_day_sessions_vid = $this->regModel->get_day_sessions_vid($dayId,$monthId,$fk_classId,$vidId,$studId);
            }else{
               
            if($check_day_calender_wise){
               
                if($check_day_calender_wise[0]['Days'] >= $dayId && $check_day_calender_wise[0]['Months'] >= $monthId   ){
                         $data['background_color_id'] = $this->uri->segment(6);
                         $get_day_sessions_vid = $this->regModel->get_day_sessions_vid_by_default($dayId,$monthId,$fk_classId,$studId);
                    }else{
                        $data['background_color_id'] = $this->uri->segment(6);
                        $get_day_sessions_vid = array();
    
                    }
                }else{
                   
                   $data['background_color_id'] = $this->uri->segment(6);
                   $get_day_sessions_vid = array();
        
                }
            }
         }

        $data['get_day_sessions'] = $this->regModel->get_day_sessions($dayId,$monthId,$fk_classId,$studId);


        if($vidId=="" || empty($vidId))
        {
          if(!empty($get_day_sessions_vid)){
            $vidId = $get_day_sessions_vid[0]['fk_sessionId'];
          }
        }else{
          $vidId = $vidId;
        }

        $data['monthId']    = $monthId;
        $data['dayId']      = $dayId;
        $data['fk_classId'] = $fk_classId;
        $data['vidId']      = $vidId;
        if($vidId > 0 ){
          // echo "i am here............";
          if(!empty($get_day_sessions_vid)){
            $data['youtubelinks'] = "https://player.vimeo.com/video/".$get_day_sessions_vid[0]['vimeoId'];
          }else{

            $data['youtubelinks'] ="";
          }
        }else{
          // echo "i am here..";
          if(!empty($get_day_sessions_vid)){

            $data['youtubelinks'] = "https://player.vimeo.com/video/".$get_day_sessions_vid[0]['vimeoId'];

         }else{
          
            $data['youtubelinks'] = "";
          }
        }
    }
    

    $data['last_session_running'] = $this->regModel->last_session_running($usersession[0]['studId'],$fk_classId);
   
    $data['background_color_id'] = 2;
    
   
    $this->load->view('vediclearn',$data);

   }else{

    redirect(base_url('website'));

   }

}

public function admissions()
{
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $data['fakecount'] = $this->regModel->fakecount();
  $data['reviews']   = $this->regModel->getReviews();
  $data['parents_review_update_list'] = $this->regModel->parents_review_update_list();
  $this->load->view('admissions',$data);
}
public function webinar_admissions()
{
  $segmentId                       = $this->uri->segment(1);
  $data['metainfo']                = $this->regModel->metainfo($segmentId);
  $data['webinar_banners']         = $this->regModel->show_webinar_banners();
  $data['get_features']            = $this->seoModel->get_view_features();
  $data['get_webinar_timetbl']     = $this->seoModel->get_webinartimetbl_details();
  $this->load->view('webinar',$data);
}
public function course_1()
{

  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('course1',$data);
}
public function course_2()
{
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('course2',$data);
}
public function course_3()
{
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('course3',$data);
}
public function blog()
{
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('blog',$data);
}
public function blog_1()
{
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('blog1',$data);
}
public function blog_2()
{
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('blog2',$data);
}
public function blog_3()
{
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('blog3',$data);
}
public function blog_4()
{
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('blog4',$data);
}
public function gallery()
{
  $segmentId                          = $this->uri->segment(1);
  $data['metainfo']                   = $this->regModel->metainfo($segmentId);
  $data['update_gallery_list']        = $this->regModel->update_gallery_list();
  $data['parents_review_update_list'] = $this->regModel->parents_review_update_list();
  $this->load->view('gallery',$data);
}



public function privacy()
{
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('privacy',$data);
}
public function shipment()
{
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('shipment',$data);
}
public function payment_refund()
{
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('payment_refund',$data);
}
public function terms_conditions()
{
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('terms_conditions',$data);
}
public function faq(){
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('faq',$data);
}
public function maintenance()
{
   $segmentId        = $this->uri->segment(1);
   $data['metainfo'] = $this->regModel->metainfo($segmentId);
   $this->load->view('maintenance',$data);
}



public function index()
{
  $usersession       = $this->session->userdata('usersession');
  $segmentId         = $this->uri->segment(1);
  $data['metainfo']  = $this->regModel->metainfo($segmentId);
  $data['fakecount'] = $this->regModel->fakecount();
  $data['events']    =  $this->regModel->getEvents();
  $data['reviews']   = $this->regModel->getReviews();
  $data['parents_review_update_list'] = $this->regModel->parents_review_update_list();
  $this->load->view('website',$data);
}

public function aboutus()
{
  $usersession      = $this->session->userdata('usersession');
  $segmentId        = $this->uri->segment(1);
  $data['metainfo'] = $this->regModel->metainfo($segmentId);
  $this->load->view('aboutus',$data);
}


public function contact()
{
 
    if(isset($_POST['submit'])){
      
      $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('studentName', 'Student Full Name', 'trim|required');
        $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('studentClass', 'Student Class', 'trim|required');
        $this->form_validation->set_rules('studentGender', 'Student Gender', 'trim|required');
        $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|required|numeric|exact_length[10]");
        $this->form_validation->set_rules('studentPass', 'Student Password', "trim|required");
        $this->form_validation->set_rules('promoCode', 'Promo Code', "trim");
        $this->form_validation->set_rules('age', 'Age', "trim|required");
        $this->form_validation->set_rules('usr_city', 'City Name', "trim|required");
        $this->form_validation->set_rules('refferalCode', 'refferal Code', "trim");
        
        $this->form_validation->set_rules('studentCPass', 'Student confirm Password', "trim|required|matches[studentPass]");
        $result = array();
        if ($this->form_validation->run() == FALSE)
        {     

           $data['getClass'] =  $this->regModel->getClass();
           $segmentId = $this->uri->segment(1);
           $data['metainfo'] = $this->regModel->metainfo($segmentId);
           $data['prcode'] = "";
           $data['promoCode'] = "";
           $this->load->view('contact',$data);
        }
        else
        {

           $studentName     = strtolower($this->input->post('studentName'));
           $studentEmail    = $this->input->post('studentEmail');
           $studentClass    = $this->input->post('studentClass');
           $studentGender   = $this->input->post('studentGender');
           $studentMobile   = $this->input->post('studentMobile');
           $studentPass     = $this->input->post('studentPass');
           $promoCode       = $this->input->post('promoCode');
           $usr_city        = $this->input->post('usr_city');
           $age             = $this->input->post('age');
           $refferalCode    = $this->input->post('refferalCode');
           if($refferalCode==""){
               $refferalCode = "Not found";
           }else{
               $refferalCode = $refferalCode;
           }
           $unlockdayId   = 0 ;
           $unlock_monthId   = 0 ;
           if(!empty($promoCode)){
            $effectiveDate = date("Y-m-d");
            
            $checkherepromocode = $this->regModel->checkherepromocode($promoCode);
            if($checkherepromocode==1){
              $freemonthDT    = date('Y-m-d', strtotime("+10 months", strtotime($effectiveDate)));  
              $unlockdayId    = 20;
              $unlock_monthId = 1; 
            }else{
              $freemonthDT = date('Y-m-d', strtotime("+1 months", strtotime($effectiveDate)));
              $unlockdayId    = 20;
              $unlock_monthId = 1; 
            }
           }else{
            $freemonthDT = "";
           }
           $promoCode   =  str_replace(' ', '', $promoCode);
           
           $promoCode =  strtolower($promoCode);
           
           if($promoCode=="freeeducation"){
               
               $unlockdayId    = 0;
               $unlock_monthId = 0;
              
           }
           
           
           $otpNumber   = rand(1111,9999);
           $arraydata   = array(
                                'studentName'     => htmlspecialchars($studentName) ,
                                'studentEmail'    => $studentEmail ,
                                'studentGender'   => $studentGender ,
                                'studentClass'    => $studentClass ,
                                'studentMobile'   => $studentMobile ,
                                'studentPass'     => sha1($studentPass),
                                'promoCode'       => $promoCode ,
                                'refferalCode'    => $refferalCode ,
                                'NewrefferalCode' => "VEDICREF-".rand(111111,999999) ,
                                'OTP'             => $otpNumber,
                                'freemonthDT'     => $freemonthDT ,
                                'usr_city'        => $usr_city ,
                                'unlockdayId'     => $unlockdayId ,
                                'unlock_monthId'  => $unlock_monthId ,
                                'age'             => $age ,
                                'promoCodeExp'    => 1
                            );

           $check_exist_number = $this->regModel->tbl_temp_enquiry($studentEmail,$studentMobile);
           if($check_exist_number==1){

              $data['error'] = array('error' => "Mobile And Email Already Exist !");
              $data['getClass'] =  $this->regModel->getClass();
              $segmentId = $this->uri->segment(1);
              $data['metainfo'] = $this->regModel->metainfo($segmentId);
              $data['promoCode'] = "";
              $this->load->view('contact',$data);

           }else{
              $leadfrom   = "vedic Website";
              $dataarrayapi = array('Childname' => $studentName,'class'=>$studentClass,'mobileno' => $studentMobile,'emailId' =>$studentEmail,'source'=>$leadfrom);
              $datarrayData = json_encode($dataarrayapi); 
              $url = "https://vedictreelms.altius.cc/vedictreeLMS/api/getLead";
              $ch = curl_init();
              $getUrl = $url;
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              curl_setopt($ch, CURLOPT_POSTFIELDS, $datarrayData);
              curl_setopt($ch, CURLOPT_URL, $getUrl);
              curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                  'webServiceName:getWebData',
                  'token:vwCc4oGTyt8vg1QR',
                  'Content-Type:application/json'

              ));
              curl_setopt($ch, CURLOPT_TIMEOUT, 80);
              $outputLMS = curl_exec($ch);
              curl_close($ch);
              $outputLMS  = json_decode($outputLMS);
              
              if($outputLMS->status=="Success"){
                 $result = $this->regModel->temp_enquiry_api($outputLMS,$leadfrom); 
                }else{
                 $result = $this->regModel->temp_enquiry_api($outputLMS,$leadfrom); 
            }
                 
               
            $htmlemail1 = '<html lang="en"><body><img src="https://www.vedictreeschool.com/assets/website/img/logo.png" alt="Vedic Tree"><p>Your OTP for VEDIC TREE KIDS LEARNING APP login is '.$otpNumber.' For further details please visit our website www.vedictreeschool.com</p></body></html>';    
            $message = trim($htmlemail1);
            $htmlContent =  $message;
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->to($studentEmail);
            $this->email->from('info.vedictree@gmail.com','Vedic Tree School');
            $this->email->subject('OTP for VEDIC TREE KIDS LEARNING APP login');
            $this->email->message($htmlContent);
            $result = $this->email->send();
            
            //send reg email//
            
            $htmlemail = '<html lang="en"><body><img src="https://www.vedictreeschool.com/assets/website/img/logo.png" alt="Vedic Tree"><p style="padding:10px;font-size:20px;">Hello '.$studentName.',</p><div style="padding:4%;box-shadow:12px 5px 0px 0px;"><p style="padding:10px;font-size:20px;">Congratulations on showing interest in our courses. Vedic Tree Kids Learning App would like to appreciate the fact that you are taking the right steps towards your child’s future.
.</p><p style="padding:10px;font-size:20px;">Now it is time to make a difference and be a part of your child’s success.</p><p style="padding:10px;font-size:20px;">Our experts will shortly get back to you with all your queries and doubts </p><p style="padding:10px;font-size:20px;">Link for the same will share with you soon on </p>
                        <p style="padding:10px;font-size:20px;">Regards</p><p style="padding:10px;font-size:20px;">Vedic Tree Kids Learning App</p></div></body></html>';
            $message = trim(ucwords($htmlemail));
            $htmlContent =  $message;
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->to($studentEmail);
            $this->email->from('info.vedictree@gmail.com','Vedic Tree School');
            $this->email->subject('Confirmation Email For Live Webinar');
            $this->email->message($htmlContent);
            $this->email->send();
                        
            
            $res = $this->regModel->add_tbl_temp_enquiry($arraydata);
            if($res==1){
              $data['error'] = array('error' => "Register Successfully !");
              $data['getClass'] =  $this->regModel->getClass();
              // $this->load->view('contact',$data);
              
              redirect('website/webotp','refresh');
            }else{
              $data['error'] = array('error' => "Mobile And Email Already Exist !");
              $data['getClass'] =  $this->regModel->getClass();
              $segmentId = $this->uri->segment(1);
              $data['promoCode'] = "";
              $data['metainfo'] = $this->regModel->metainfo($segmentId);
              $this->load->view('contact',$data);
            }

           }

        }

    } else {
    
        
        $segmentId = $this->uri->segment(1);
        if(isset($_GET['prcode'])){
          $data['prcode'] = $_GET['prcode'];
        }else{
            $data['prcode'] = "";
        }
        $data['metainfo'] = $this->regModel->metainfo($segmentId);
        $data['promoCode'] = "";
        $this->load->view('contact',$data);
    } 
}

public function webotp()
{
     $segmentId = $this->uri->segment(1);
     $data['metainfo'] = $this->regModel->metainfo($segmentId);
     $data['promoCode'] = "";
     $this->load->view('webotp',$data);
}

 public function verifyotp()
  {
    
      if(isset($_POST['submit']))
      {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('otp', 'otp Number', 'trim|required');
          $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|required");
          $result = array();
          if ($this->form_validation->run() == FALSE)
          {
             $segmentId        = $this->uri->segment(1);
             $data['metainfo'] = $this->regModel->metainfo($segmentId);
             $this->load->view('webotp',$data);
          }else{

              $studentMobile      = convert_uudecode($this->input->post('studentMobile'));
              $otp                = $this->input->post('otp');
              $check_exist_number =  $this->regModel->check_exist_number($studentMobile);
              if($check_exist_number==1) {
                  $res = $this->regModel->webverifyOTP($studentMobile,$otp);
                  if($res==1){
                    $data['success']  = array('error' => "OTP Is Verify Successfully ! ");
                    $segmentId        = $this->uri->segment(1);
                    $data['metainfo'] = $this->regModel->metainfo($segmentId);
                  }else{
                    $data['error']    = array('error' => "OTP Is not Verify Successfully ! ");
                    $segmentId        = $this->uri->segment(1);
                    $data['metainfo'] = $this->regModel->metainfo($segmentId);
                  }
                   $this->load->view('webotp',$data);
              } else {
                  $data['error']    = array('error' => "Mobile Number Is not Exist !");
                  $segmentId        = $this->uri->segment(1);
                  $data['metainfo'] = $this->regModel->metainfo($segmentId);
                  $this->load->view('webotp',$data); 
              }

          }

    }

}


public function webreg()
{
 
    if(isset($_POST['submit'])){
      
      $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('studentName', 'Student Full Name', 'trim|required');
        $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('studentClass', 'Student Class', 'trim|required');
        $this->form_validation->set_rules('studentGender', 'Student Gender', 'trim|required');
        $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|required|numeric|exact_length[10]");
        $this->form_validation->set_rules('studentPass', 'Student Password', "trim|required");
        $this->form_validation->set_rules('refferalCode', 'refferal Code', "trim");
        $this->form_validation->set_rules('studentCPass', 'Student confirm Password', "trim|required|matches[studentPass]");
        $result = array();
        if ($this->form_validation->run() == FALSE)
        {     

          // echo validation_errors();
                   $data['getClass'] =  $this->regModel->getClass();
                   $this->load->view('website',$data);
        }
        else
        {

           $studentName     = $this->input->post('studentName');
           $studentEmail    = $this->input->post('studentEmail');
           $studentClass    = $this->input->post('studentClass');
           $studentGender   = $this->input->post('studentGender');
           $studentMobile   = $this->input->post('studentMobile');
           $studentPass     = $this->input->post('studentPass');
           $refferalCode    = $this->input->post('refferalCode');

           $arraydata = array(
                                'studentName'     => $studentName ,
                                'studentEmail'    => $studentEmail ,
                                'studentGender'   => $studentGender ,
                                'studentClass'    => $studentClass ,
                                'studentMobile'   => $studentMobile ,
                                'studentPass'     => sha1($studentPass),
                                'refferalCode'    => $refferalCode ,
                                 );

           $check_exist_number = $this->regModel->tbl_temp_enquiry($studentEmail,$studentMobile);
           if($check_exist_number==1){
              $data['error']    = array('error' => "Mobile And Email Already Exist !");
              $data['getClass'] =  $this->regModel->getClass();
              $this->load->view('website',$data);
           }else{
            $res = $this->regModel->add_tbl_temp_enquiry($arraydata);
            if($res==1){
              $data['error']    = array('error' => "Register Successfully !");
              $data['getClass'] =  $this->regModel->getClass();
            }else{
              $data['error']    = array('error' => "Mobile And Email Already Exist !");
              $data['getClass'] =  $this->regModel->getClass();
            }
             $this->load->view('website',$data);

           }

        }

    } else {

        $this->load->view('website');
    } 
}

public function web_login()
{
    if(isset($_POST['submit'])){

        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|required|numeric|exact_length[10]");
        $this->form_validation->set_rules('studentPass', 'Student Password', "trim|required");
        if ($this->form_validation->run() == FALSE)
        {
           $segmentId = $this->uri->segment(1);
           $data['metainfo'] = $this->regModel->metainfo($segmentId);
           $this->load->view('web_login',$data);

        } else {

        
           $studentMobile     = $this->input->post('studentMobile');
           $studentPass       = $this->input->post('studentPass');

           // remember me
              if(!empty($this->input->post("remember"))) {
                $this->input->set_cookie("studentMobile", $studentMobile, time()+ (10 * 365 * 24 * 60 * 60));  
                $this->input->set_cookie("studentPass", $studentPass,  time()+ (10 * 365 * 24 * 60 * 60));
              } else {
                $this->input->set_cookie("studentMobile",""); 
                $this->input->set_cookie("studentPass","");
              }
              
                    $ip = $_SERVER['REMOTE_ADDR'];               
                         $denied = $this->regModel->denied_from_login($studentMobile,$ip);
                         if($denied==2){
                            $get_two_ip_adrdess_check = $this->regModel->get_two_ip_adrdess($studentMobile,$ip);
                            if($get_two_ip_adrdess_check[0]['ip']==$ip || $get_two_ip_adrdess_check[1]['ip']==$ip || $get_two_ip_adrdess_check[2]['ip']==$ip )
                            {
                                $result = $this->regModel->get_temp_enquiry_data($studentMobile,$studentPass);
                                if(!empty($result)){
                                    $usersession = $this->session->userdata('usersession');
                                    $fk_studId = $usersession[0]['studId'];
                                    $promoCode = $usersession[0]['promoCode'];
                                    $logstatus = $usersession[0]['logstatus'];
                                    
                                    $check_payment_done = $this->regModel->check_payment_done($fk_studId);
                                    $check_payement_status = $this->regModel->check_payement_status($fk_studId);
                                    
                                    if($promoCode=="15august" && empty($check_payment_done) || $check_payement_status==1 ) {
                                       redirect('website/skim');
                                    }else if(!empty($check_payment_done)){
                                        
                                        $checkcoursestudent = $this->regModel->checkcoursestudent($fk_studId);
                                      
                                       if($checkcoursestudent==1){
                                         redirect('website/vedicdashcourse');
                                       }else{
                                         redirect('website/vedic_dash');
                                       }
                                    //   redirect('website/vedic_dash');
                                    }else{
                                      // echo "string";die;
                                      redirect('website/vedicpayment');
                                    }
                                    
                                    
                                } else {
                                   $data['error'] = array('error' => "Mobile Number or Password is wrong !");
                                   $segmentId = $this->uri->segment(1);
                                   $data['metainfo'] = $this->regModel->metainfo($segmentId);
                                   $this->load->view('web_login',$data);
                                }
                            }else{
                              $data['error'] = array('error' => "You dont have access on many device");
                              $segmentId = $this->uri->segment(1);
                              $data['metainfo'] = $this->regModel->metainfo($segmentId);
                              $this->load->view('web_login',$data);
                            }
            
                       }else{
            
                          $result = $this->regModel->get_temp_enquiry_data($studentMobile,$studentPass);
                          if(!empty($result)){
                              $usersession = $this->session->userdata('usersession');
                              $fk_studId = $usersession[0]['studId'];
                              $promoCode = $usersession[0]['promoCode'];
                              $check_payment_done = $this->regModel->check_payment_done($fk_studId);
                              if($promoCode=="15august" && empty($check_payment_done)){
                                redirect('website/skim');
                              }else if(!empty($check_payment_done)){
                                   $checkcoursestudent = $this->regModel->checkcoursestudent($fk_studId);
                                   if($checkcoursestudent==1){
                                     redirect('website/vedicdashcourse');
                                   }else{
                                     redirect('website/vedic_dash');
                                   }
                              }else{
                                redirect('website/vedicpayment');
                              }
                              
                          } else {
                             $data['error'] = array('error' => "Mobile Number or Password is wrong !");
                             $segmentId = $this->uri->segment(1);
                             $data['metainfo'] = $this->regModel->metainfo($segmentId);
                             $this->load->view('web_login',$data);
                          }
                       }
              
        }

    }else{

      $usersession = $this->session->userdata('usersession');
      $segmentId = $this->uri->segment(1);
      $data['metainfo'] = $this->regModel->metainfo($segmentId);
      $this->load->view('web_login',$data);
    }
}

public function skim()
{
   $usersession = $this->session->userdata('usersession');
   if(isset($usersession) || !empty($usersession)){

    $fk_classId                        = $usersession[0]['studentClass'];
    $data['listvideouploading']        = $this->regModel->listvideouploading($fk_classId);
    $data['fk_classId']                = $fk_classId; 
    $data['background_color_id']       = 6;
    $data['opdayId']                   = $this->uri->segment(3);
    $vidcreateDT                       = date("Y-m-d h:i:s");
    $vidcreateDT                       = date('Y-m-01 h:i:s', strtotime($vidcreateDT));
    $param                             = 'valubasededucation';
    $fk_classId                        = $usersession[0]['studentClass']; 
    $endvidcreateDT                    = date("Y-m-t", strtotime($vidcreateDT));
    $data['get_stud_data']             = $this->regModel->get_stud_data($usersession[0]['studId']);
    $data['tbl_unlock_days']           = $this->regModel->tbl_unlock_days();
    $data['last_session_running']      = $this->regModel->last_session_running($usersession[0]['studId'],$fk_classId);
    $data['day_open_for_next_session'] = $this->regModel->day_open_for_next_session();
    $data['gmdovbe']                   = $this->regModel->get_month_data_of_value_based_eductaion($vidcreateDT,$param,$endvidcreateDT,$fk_classId);

    $this->load->view('skim',$data);

   }else{

    redirect(base_url('website'));

   }
}

public function login()
  {
  

    $clientId     = '816237651586-qb5tu96mv07sf8vqj4ntvoue9d3vcql0.apps.googleusercontent.com'; //Google client ID
    $clientSecret = 'o4-AP2lQpIrpaGBwRYhawp1h'; //Google client secret
    $redirectURL  = 'https://vedictreeschool.com/website/login';
    
    //Call Google API
    $gClient = new Google_Client();
    $gClient->setApplicationName('testing vedic tree');
    $gClient->setClientId($clientId);
    $gClient->setClientSecret($clientSecret);
    $gClient->setRedirectUri($redirectURL);
    $google_oauthV2 = new Google_Oauth2Service($gClient);

    if(isset($_GET['code']))
    {
      $gClient->authenticate($_GET['code']);
      $_SESSION['token'] = $gClient->getAccessToken();
      header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
    }

    if (isset($_SESSION['token'])) 
    {
      $gClient->setAccessToken($_SESSION['token']);
    }
    
    if ($gClient->getAccessToken()) {
      $userProfile = $google_oauthV2->userinfo->get();

      $studentEmail = $userProfile['email'];
      $studentName = $userProfile['name'];
      $studentStatus = $userProfile['verified_email'];
      $oauth_uid = $userProfile['id'];
      // $studentpicture = $userProfile['picture'];
      $data =  array(
                        'studentEmail'     => $studentEmail,
                        'studentName'      => $studentName,
                        'studentStatus'    => $studentStatus,
                        'oauth_uid'        => $oauth_uid,
                        'NewrefferalCode'  => "VEDICREF-".rand(111111,999999)
                      );
      $result = $this->regModel->check_reg_email_data($studentEmail);
        if($result==1){

            $data['error'] = array('error' => "Login Successfully !");
            $usersession = $this->session->userdata('usersession');
            $fk_monthId = $usersession[0]['studentClass'];

            $checkpass = $this->regModel->checkpass($studentEmail);

            if($checkpass){
              if($checkpass[0]['studentPass']==""){
              redirect('website/nextstep');
            }else{
              redirect('website/vedic_dash');
            }
            
            }
            // $this->load->view('web_login',$data);

         }else{

           $res = $this->regModel->add_reg_social($data);
            if($res==1){
              $data['social'] = array('error' => "Login Successfully !");
              $usersession = $this->session->userdata('usersession');
              $segmentId = $this->uri->segment(1);
              $data['metainfo'] = $this->regModel->metainfo($segmentId);
              $this->load->view('nextstep',$data);
           }else{
            $data['error'] = array('error' => "Some Techinical issues Faced !");
            $segmentId = $this->uri->segment(1);
            $data['metainfo'] = $this->regModel->metainfo($segmentId);
            $this->load->view('web_login',$data);
           } 
        }
    } 
    else 
    {
        // $this->load->view('web_login');
      $url = $gClient->createAuthUrl();
        header("Location: $url");
        exit;
    }
  }


public function dashobard()
{
      // $dayId,$monthId,$fk_classId

  $usersession = $this->session->userdata('usersession');
   $data['get_day_sessions'] = array();
   $this->load->view('demodashboard',$data);

}


public function nextstep()
{
  if(isset($_POST['submit'])){


        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|required|numeric|exact_length[10]");
        $this->form_validation->set_rules('studentClass', 'Student Class', "trim|required|integer|greater_than[0]");
        $this->form_validation->set_rules('studentGender', 'Student Gender', "trim|required");
        $this->form_validation->set_rules('studentPass', 'student Password', "trim|required");
        $this->form_validation->set_rules('studentCPass', 'student Confirm Password', "trim|required|matches[studentPass]");
        $this->form_validation->set_rules('studId', 'Student studId', "trim|required|greater_than[0]");
        if ($this->form_validation->run() == FALSE)
        { 
            $segmentId = $this->uri->segment(1);
            $data['metainfo'] = $this->regModel->metainfo($segmentId);
          $this->load->view('nextstep',$data);

        }else{

              $studentGender = $this->input->post('studentGender'); 
              $studentMobile = $this->input->post('studentMobile');
              $studentClass  = $this->input->post('studentClass');
              $studId        = $this->input->post('studId');
              $studentPass   = $this->input->post('studentPass');
              $studentPass   = $studentPass;
               $data =  array(
                        'studentGender'    => $studentGender,
                        'studentMobile'    => $studentMobile,
                        'studentClass'     => $studentClass,
                        'studId'           => $studId,
                        'studentPass'      => sha1($studentPass),
                        'logstatus'        => 1,
                      );
               $check_mobile_exist = $this->regModel->check_mobile_exist($studentMobile);
               if($check_mobile_exist==0){
                 $res = $this->regModel->updatesudeInfo($data);
                 if($res==1){
                    $data['error'] = array('error' => "Information Updated Successfully !");
                    $segmentId = $this->uri->segment(1);
                    $data['metainfo'] = $this->regModel->metainfo($segmentId);
                    $this->load->view('nextstep',$data);
                 }else{
                    $data['error'] = array('error' => "Information Not Updated Successfully !");
                    $segmentId = $this->uri->segment(1);
                    $data['metainfo'] = $this->regModel->metainfo($segmentId);
                    $this->load->view('nextstep',$data);
                 }
               }else{
                    $data['error'] = array('error' => "Mobile Number Already Exist !");
                    $segmentId = $this->uri->segment(1);
                    $data['metainfo'] = $this->regModel->metainfo($segmentId);
                    $this->load->view('nextstep',$data);
               }

        }
      }else{
        $segmentId = $this->uri->segment(1);
        $data['metainfo'] = $this->regModel->metainfo($segmentId);
        $this->load->view('nextstep',$data);
      }


}
public function getdaydata()
{
  
   $usersession = $this->session->userdata('usersession');
   $studId      = $usersession[0]['studId'];
   $dayId       = $this->uri->segment(3);
   $monthId     = $this->uri->segment(4);
   $fk_classId  = $this->uri->segment(5);
   $data['get_day_sessions'] = $this->regModel->get_day_sessions($dayId,$monthId,$fk_classId,$studId);
   $res = $this->regModel->get_studentid($usersession[0]['studentEmail']); 
   if($res){
      if($res[0]['studentClass']=="0"){
          $this->load->view('nextstep',$data);
        }else{
          $this->load->view('demodashboard',$data);
      }
    }else{
    $this->load->view('demodashboard',$data);
   }

}



public function logout()
{

      $usersession = $this->session->userdata('usersession');

      if($this->session->userdata('usersession'))
      {
            $data = array('logstatus'=>0);
            $this->db->where('studentEmail',$usersession[0]['studentEmail']);
            $res = $this->db->update('studentreg',$data);
            
            $this->db->where('studentMobile',$usersession[0]['studentMobile']);
            $res = $this->db->delete('tbl_check_here_multiple_browser_not_open');
            
            $this->session->unset_userdata('usersession');
            $this->session->sess_destroy();
             redirect('website','refresh');
      }else{
            redirect('website','refresh');
      }
      
}





function tracking_video(){
  if(isset($_POST['submit'])){
      
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('duration', 'Duration', 'trim|required');     
        $this->form_validation->set_rules('seconds', 'seconds', "trim|required");
        $result = array();
        if ($this->form_validation->run() == FALSE)
        {     
            $this->load->view('test');
        }
        else
        {

           $usersession = $this->session->userdata('usersession');
           $duration   = $this->input->post('duration');
           $seconds    = $this->input->post('seconds');
           $studId    = $usersession[0]['studId'];
           $dataarray = array(
                              'trackStartTime' =>$duration ,
                              'trackEndTime'   =>$seconds ,
                              'trackDuration'  =>$duration ,
                              'fk_user_id'     =>$studId 
                        );
            $res = $this->regModel->tbl_tracking_watch_video($dataarray);
            if($res==1){
               $data['error'] = array('error' => "Tracking Data Stored Successfully !");
                redirect('website/test');
             }else{
               $data['error'] = array('error' => "Tracking Data Is not Stored !");
                redirect('website/test');
             }
         }
       }else{

        $this->load->view('test');

       }
}

public function livestream()
{
  
  $this->load->view('livestream');

}


public function vedicpayment()
{

      $usersession = $this->session->userdata('usersession');
      if($this->session->userdata('usersession'))
      {
            $fk_classId = $usersession[0]['studentClass'];
            $data['fess_structure'] = $this->regModel->fess_structure($fk_classId);
            $data['tbl_emi'] = $this->regModel->getemi();
            $data['last_session_running'] = $this->regModel->last_session_running($usersession[0]['studId'],$fk_classId);
            $data['background_color_id'] = $this->uri->segment(3);
            if($data['background_color_id']==""){
              $data['background_color_id'] = 6;
            }else{
              $data['background_color_id'] = $data['background_color_id'];
            }
            
            $this->load->view('vedicpayment',$data);
      }else{
            redirect('website','refresh');
      }
 
}

public function bank_info()
{
  
  $usersession = $this->session->userdata('usersession');
  $fk_classId = $usersession[0]['studentClass'];
  if(isset($_POST['submit'])){

        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('bank_acc_number', 'Bank Account Number', "trim|required|numeric");
        $this->form_validation->set_rules('bank_name', 'Bank Name', "trim|required");
        $this->form_validation->set_rules('bank_ifsc', 'Bank IFSC Code', "trim|required");
        $this->form_validation->set_rules('bank_type', 'Bank Type', "trim|required");
        $studId = $this->input->post('studId');
        $bank_info_tab = $this->input->post('bank_info_tab');

        if ($this->form_validation->run() == FALSE)
        { 

        // echo validation_errors();  
          $data['userinfo']        = $this->regModel->userinfo($studId);
          $data['bank_info']       = $this->regModel->bank_info($studId);
          $data['userinfo_father'] = $this->regModel->userinfo_father($studId);
          $data['userinfo_mother'] = $this->regModel->userinfo_mother($studId);  
           $data['last_session_running'] = $this->regModel->last_session_running($studId);
          $this->load->view('vedicprofile',$data);

        } else {

              $bank_acc_number  = $this->input->post('bank_acc_number'); 
              $bank_name        = $this->input->post('bank_name');
              $bank_ifsc        = $this->input->post('bank_ifsc');
              $bank_type        = $this->input->post('bank_type');
              $studId           = $this->input->post('studId');
              $data = array(
                        'bank_acc_number' => $bank_acc_number,
                        'bank_name'       => $bank_name,
                        'bank_ifsc'       => $bank_ifsc,
                        'bank_type'       => $bank_type,
                        'studId'          => $studId
                      ); 
               $res   = $this->regModel->bank_info_update($data);
               if($res==1){

                  $this->regModel->bank_info_insert($data);
                  $data['error'] = array('error' => "Bank Information Updated Successfully !");
                  $data['userinfo']         = $this->regModel->userinfo($studId);
                  $data['userinfo_father']  = $this->regModel->userinfo_father($studId);
                  $data['bank_info']        = $this->regModel->bank_info($studId);
                  $data['userinfo_mother']  = $this->regModel->userinfo_mother($studId);
                  $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                  
               }else{
                  $data['error'] = array('error' => "Bank Information Not Updated Successfully !");
                  $data['userinfo'] = $this->regModel->userinfo($studId);
                  $data['userinfo_father'] = $this->regModel->userinfo_father($studId);
                  $data['userinfo_mother'] = $this->regModel->userinfo_mother($studId);
                  $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                  $data['bank_info'] = $this->regModel->bank_info($studId);
                  
               }
               
               $this->load->view('vedicprofile',$data);
            }

          }

}



public function getpayment(){
  $usersession = $this->session->userdata('usersession');
  $fk_classId = $usersession[0]['studentClass'];
  $promoCode     = $usersession[0]['promoCode'];
  
  if(isset($_POST['submit']))
  {

        $this->form_validation->set_error_delimiters('<span>', '</span>');
         $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('usr_firstname', 'First Name', "trim|required");
        
        $this->form_validation->set_rules('usr_lastname', 'Last Name', "trim|required");
        $this->form_validation->set_rules('usr_email', 'Email', "trim|required|valid_email");
        $this->form_validation->set_rules('usr_mobile_no', 'Enter Mobile Number', "trim|required|integer|exact_length[10]");
        $this->form_validation->set_rules('payAmount', 'payAmount', "trim|required");
        $this->form_validation->set_rules('planId', 'planId', "trim|required");
        $this->form_validation->set_rules('paymentType', 'paymentType', "trim|required");
        $studId = $this->input->post('studId');
        $planId = $this->input->post('planId');
        $paymentType = $this->input->post('paymentType');
        $planvalue = $this->input->post('planvalue');
         $loanemiId = $this->input->post('loanemiId');

        if ($this->form_validation->run() == FALSE)
        { 
            
            if($paymentType==2 && $loanemiId > 0){

              $data['planvalue']    = $this->regModel->getplanvalue_emi($loanemiId); 
            }else{

                $data['planvalue']    = $this->regModel->getplanvalue($planvalue); 
            }
            $data['background_color_id'] = 6;
           $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
           $data['planId']       = $planId;
           $data['paymentType']  = $paymentType;
           $data['get_stud_data'] = $this->regModel->get_stud_data($usersession[0]['studId']);
           
          $this->load->view('getpayment',$data);

        }else{
            
              $usr_firstname    = $this->input->post('usr_firstname'); 
              $usr_lastname     = $this->input->post('usr_lastname'); 
              $usr_email        = $this->input->post('usr_email');
              $usr_mobile_no    = $this->input->post('usr_mobile_no');
              $payAmount        = $this->input->post('payAmount');
              $studId           = $this->input->post('studId');
              $planId           = $this->input->post('planId');
              $paymentType      = $this->input->post('paymentType');
              $fk_monthId       = 10;
              $name             = $usr_firstname."".$usr_lastname;
              if(!empty($_FILES)){  
              $Receiptpic       = $_FILES['Receiptpic']['name'];
              
               $config['upload_path']          = './uploads/Receiptpic/';
               $config['allowed_types']        = 'jpg|png|jpeg';
               $this->load->library('upload', $config);
               $this->upload->initialize($config);

               if ( ! $this->upload->do_upload('Receiptpic'))
              {
                  $data['error'] = array('error' => $this->upload->display_errors());
                  $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                  $data['planId']       = $planId;
                  $data['paymentType']  = $paymentType;
                  $data['planvalue']    = $this->regModel->getplanvalue($planvalue);
                  $data['get_stud_data'] = $this->regModel->get_stud_data($usersession[0]['studId']);
                  $data['background_color_id'] = 6;
                  $this->load->view('getpayment',$data);
              }

              $data = array('Receiptpic' => $this->upload->data());
               $Receiptpic = $data['Receiptpic']['file_name'];
              }else{
               $Receiptpic = "Direct Payment";

              }
              
              if($promoCode=="15august"){
                $payAmount = 15000;
               }else{
                $payAmount = $payAmount;
               }
               
              $data = array(
                        'usr_firstname'   => $usr_firstname,
                        'usr_lastname'    => $usr_lastname,
                        'usr_email'       => $usr_email,
                        'usr_mobile_no'   => $usr_mobile_no,
                        'payAmount'       => $payAmount,
                        'fk_studId'       => $studId,
                        'paystatusId'     => 2,
                        'planId'          => $planId,
                        'paymentType'     => $paymentType,
                        'fk_monthId'      => $fk_monthId,
                        'Receiptpic'      => $Receiptpic,
                        'paystatus'       => "Pending"
                      ); 
               // $res   = $this->regModel->log_payment_data($data);

               if($paymentType==1 || $paymentType==2){

                $res   = $this->regModel->log_payment_data($data);
            
                if($res==1){
                    
                  $get_real_data_from_database = $this->regModel->get_real_data_from_database($studId);
                  $planId   = $this->regModel->get_real_data_from_database_planId($planId);
                  
                  if($get_real_data_from_database && $planId){
                    if($promoCode=="15august"){
                      $payAmount = 15000;
                     }else{
                      $payAmount = $planId[0]['final_fees'];
                     }

                    $payAmount      = $payAmount; 
                    $planId         = $planId[0]['feesId']; 
                    $usr_email      = $get_real_data_from_database[0]['studentEmail']; 
                    $usr_mobile_no  = $get_real_data_from_database[0]['studentMobile']; 

                    }else{

                    $payAmount      = 0; 
                    $planId         = 0; 
                    $usr_email      = ""; 
                    $usr_mobile_no  = ""; 

                  }
                  
                  
                  $res = $this->pay($payAmount,$name,$usr_email,$usr_mobile_no);  
                }else{
                    
                    
                  $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                  $data['error'] = array('error' => "Already payment by offline or online");
                  $data['planId']       = $planId;
                  $data['paymentType']  = $paymentType;
                  $data['planvalue']    = $this->regModel->getplanvalue($planvalue);
                  $data['get_stud_data'] = $this->regModel->get_stud_data($usersession[0]['studId']);
                  $data['background_color_id'] = 6;
                  $this->load->view('getpayment',$data);
                  
                }
              }else{


                  $res   = $this->regModel->log_payment_data($data);
                  // print_r($res);die;
                  if($res==1){
                    $data['error'] = array('error' => "We will confirm you soon Thank You For Choosing Vedic Tree Pre School");
                  }else{
                    $data['error'] = array('error' => "Already Uploaded Payment receipt");
                  }
                  $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                  
                  $data['planId']       = $planId;
                  $data['paymentType']  = $paymentType;
                  $data['planvalue']    = $this->regModel->getplanvalue($planvalue);
                  $data['get_stud_data'] = $this->regModel->get_stud_data($usersession[0]['studId']);
                  $data['background_color_id'] = 6;
                  $this->load->view('getpayment',$data);

              }

        }

      } else {
            $usersession = $this->session->userdata('usersession');
            $fk_classId = $usersession[0]['studentClass'];
            $planvalue   = $this->input->post('planvalue');
            $paymentType = $this->input->post('paymentType');
            $loanemiId = $this->input->post('loanemiId');
              if(isset($usersession) || !empty($usersession)) {
                if($planvalue > 0 && $paymentType > 0 ){
                if($paymentType==2 && $loanemiId > 0){
                    $data['planvalue']    = $this->regModel->getplanvalue_emi($loanemiId); 
                   }else{
                    $data['planvalue']    = $this->regModel->getplanvalue($planvalue); 
            }
                  
            $data['planId']       = $planvalue; 
            $data['paymentType']  = $paymentType; 
            $data['last_session_running'] = $this->regModel->last_session_running($usersession[0]['studId'],$fk_classId);
            $data['get_stud_data'] = $this->regModel->get_stud_data($usersession[0]['studId']);
            $data['background_color_id'] = 6;
            $this->load->view('getpayment',$data);
    
           } else {
    
            redirect('website/vedicpayment');
          }
    } else {
    
            redirect('website','refresh');
          }
      }


}

public function pay($payAmount,$name,$usr_email,$usr_mobile_no)
{
        
       
        $usersession = $this->session->userdata('usersession');
       
       if(!empty($usersession)) {
      // rzp_live_Pc8AytwKySZ9P7  MrYda1FGF2IpNaOfdZ6TKcBh
        $api = new Api("rzp_live_x90EawgbGwgJ18", "ZJyP9F00ZY1PkOrP7NYcPjIW");

        $_SESSION['payable_amount'] = $payAmount;

        $razorpayOrder = $api->order->create(array(
            'receipt'         => rand(),
            'currency'        => 'INR',
            'amount'          => $payAmount * 100,
            // 'amount'          => 1 * 100,
            'payment_capture' => 1 // auto capture
        ));

        $amount = $razorpayOrder['amount'];

        $razorpayOrderId = $razorpayOrder['id'];

        $_SESSION['razorpay_order_id'] = $razorpayOrderId;

        $data = $this->prepareData($payAmount,$razorpayOrderId,$name,$usr_email,$usr_mobile_no); 
        $usersession = $this->session->userdata('usersession');
        $fk_classId = $usersession[0]['studentClass'];
        $data['last_session_running'] = $this->regModel->last_session_running($usersession[0]['studId'],$fk_classId);
        $data['background_color_id'] = 6;
        $this->load->view('rezorpayweb',array('data' => $data));
       }else{
          redirect('website','refresh');
        }
}

    /**
     * This function verifies the payment,after successful payment
     */
    public function verify()
    {
       $usersession = $this->session->userdata('usersession');

       if(!empty($usersession)) {
           
            $success = true;
            $error = "payment_failed";
            if (empty($_POST['razorpay_payment_id']) === false) {
                $api = new Api("rzp_live_x90EawgbGwgJ18", "ZJyP9F00ZY1PkOrP7NYcPjIW");
            try {
                    $attributes = array(
                        'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                        'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                        'razorpay_signature' => $_POST['razorpay_signature']
                    );
                    $api->utility->verifyPaymentSignature($attributes);
                } catch(SignatureVerificationError $e) {
                    $success = false;
                    $error = 'Razorpay_Error : ' . $e->getMessage();
                }
            }
            if ($success === true) {
               
                // $this->setRegistrationData();
                  $paystatus = "success";
                  $res = $this->regModel->update_log_payment($usersession[0]['studId'],$paystatus,$_SESSION['razorpay_order_id'],$_POST['razorpay_payment_id'],$_POST['razorpay_signature']); 
                  redirect(base_url().'website/success');
            }
            else {
              // not success
              $paystatus = "Failed";
                $res = $this->regModel->update_log_payment($usersession[0]['studId'],$paystatus,$_SESSION['razorpay_order_id'],$_POST['razorpay_payment_id'],$_POST['razorpay_signature']);
                redirect(base_url().'website/paymentFailed');
            }
       }else{
            redirect('website','refresh');
          }
    }

    
    public function prepareData($payAmount,$razorpayOrderId,$name,$usr_email,$usr_mobile_no)
    {
        $usersession = $this->session->userdata('usersession');
       if(!empty($usersession)) {
        $data = array(
            "key" => "rzp_live_x90EawgbGwgJ18",//"rzp_test_ixEBlZ7eeTSmwi", "lZ1BNrv5k7ORMc31kGB97kBr"
            "amount" => $payAmount,
            "name" => "Vedic Tree Payment",
            "description" => "Pay the fees",
            "image" => "https://demo.codingbirdsonline.com/website/img/coding-birds-online/coding-birds-online-favicon.png",
               "prefill" => array(
                "name"  => $name,
                "email"  => $usr_email,
                "contact" => $usr_mobile_no,
            ),
            "notes"  => array(
                "address"  => "Hello World",
                "merchant_order_id" => rand(),
            ),
            "theme"  => array(
                "color"  => "#F37254"
            ),
            "order_id" => $razorpayOrderId,
        );
        return $data;
        }else{
        redirect('website','refresh');
      }
    }

    
    public function success()
    {
      $usersession = $this->session->userdata('usersession');
      $fk_classId  = $usersession[0]['studentClass'];
      if($this->session->userdata('usersession'))
      {
        $usersession = $this->session->userdata('usersession');
        $data['last_session_running'] = $this->regModel->last_session_running($usersession[0]['studId'],$fk_classId);
        $data['paymentdata'] = $this->regModel->get_payment_data($usersession[0]['studId']);
        $data['background_color_id'] = 6;
        $this->load->view('websuccess',$data);
      }else{
          redirect('website','refresh');
      }
    }
    
    public function paymentFailed()
    {
      $usersession = $this->session->userdata('usersession');
      $fk_classId  = $usersession[0]['studentClass'];
      if($this->session->userdata('usersession'))
      {
        $usersession = $this->session->userdata('usersession');
        $data['last_session_running'] = $this->regModel->last_session_running($usersession[0]['studId'],$fk_classId);
        $data['background_color_id'] = 6;
        $this->load->view('weberror',$data);
      }else{
           redirect('website','refresh');
      }
    }


public function get_trac()
{
  
     $usersession = $this->session->userdata('usersession');
     if(isset($usersession) || !empty($usersession)) {
         
     $duration    = $this->input->post('durations');
     $seconds     = $this->input->post('secondss');
     $videoId     = $this->input->post('videoId');
     $monthId     = $this->input->post('monthId');
     $dayId       = $this->input->post('dayId');
     $fk_classId  = $this->input->post('fk_classId');
     $fk_sessionId  = $this->input->post('fk_sessionId');
     $studId      = $usersession[0]['studId'];
     date_default_timezone_set('Asia/Kolkata');
     $createTrackDT = date("Y-m-d h:i:s");
     $dataarray   = array(
                        'trackStartTime'   =>$duration ,
                        'trackEndTime'     =>$seconds ,
                        'trackDuration'    =>$duration ,
                        'videoId'          =>$videoId, 
                        'fk_monthId'       =>$monthId, 
                        'fk_dayId'         =>$dayId, 
                        'fk_classId'       =>$fk_classId, 
                        'createTrackDT'  => $createTrackDT,
                        'fk_sessionId'     =>$fk_sessionId, 
                        'fk_user_id'       =>$studId 
                  );
      $res = $this->regModel->tbl_tracking_watch_video($dataarray);
      if($res==1){
         $data['error'] = array('error' => "Tracking Data Stored Successfully !");
       }else{
         $data['error'] = array('error' => "Tracking Data Is not Stored !");
       }

       echo json_encode($data);
     }else{
      redirect('website','refresh');
     }
}



public function payment_his()
{
  
     $usersession = $this->session->userdata('usersession');
     $fk_classId  = $usersession[0]['studentClass'];
      if($this->session->userdata('usersession'))
      {
        $usersession = $this->session->userdata('usersession');
        $data['last_session_running'] = $this->regModel->last_session_running($usersession[0]['studId'],$fk_classId);
        $data['background_color_id'] = $this->uri->segment(3);
        $data['payment_his_data'] = $this->regModel->payment_his_data($usersession[0]['studId']);

        $this->load->view('payment_his',$data);
      }else{
          redirect('website','refresh');
      }

}



public function showpdf()
{
    

    $usersession = $this->session->userdata('usersession');
    $logId = $this->uri->segment(3);
    $studId = $usersession[0]['studId'];
    $data['payment_his_data'] = $this->regModel->payment_his_data_showpdf($studId,$logId);
    $fk_classId = $usersession[0]['studentClass'];
    
    $this->load->view('showpdf',$data);
    $html = $this->output->get_output();
    $this->load->library('pdf');
    $this->pdf->loadHtml($html);
    // print_r($html);
    $this->pdf->setPaper('A4', 'portrait');
    $this->pdf->render();
    

}



  public function emiprocess()
  {
   
      $usersession = $this->session->userdata('usersession');
      $fk_classId = $usersession[0]['studentClass'];
      if(isset($usersession) || !empty($usersession)) {
      if(isset($_POST['submit'])){


        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('usr_firstname', 'Student First Name', "trim|required");
        $this->form_validation->set_rules('usr_lastname', 'Student Last Name', "trim|required");
        $this->form_validation->set_rules('student_dob', 'Student Date Of Birth', "trim|required");
        $this->form_validation->set_rules('email', 'Email', "trim|required|valid_email");
        $this->form_validation->set_rules('course_id', 'course id', "trim|required");
        $this->form_validation->set_rules('studId', 'studId', "trim|required|integer|greater_than[0]");
        $this->form_validation->set_rules('planId', 'planId', "trim|required|integer|greater_than[0]");
        $this->form_validation->set_rules('paymentType', 'paymentType', "trim|required");
        $this->form_validation->set_rules('requested_tenure', 'Requested tenure', "trim|required|integer");
        $this->form_validation->set_rules('student_reference_no', 'student reference number', "trim");
        $this->form_validation->set_rules('applicant_name', 'Applicant Name', "trim|required");
        $this->form_validation->set_rules('applicant_gender', 'Applicant gender', "trim|required");
        $this->form_validation->set_rules('applicant_dob', 'Applicant Date Of Birth', "trim|required");
        $this->form_validation->set_rules('mobile', 'mobile', "trim|required|integer|exact_length[10]");
        $this->form_validation->set_rules('aadhar_no', 'Aadhar number', "trim|required|max_length[20]");
        $this->form_validation->set_rules('pan_no', 'Pan number', "trim|required|exact_length[10]");
        $this->form_validation->set_rules('marital_status', 'Marital status', "trim|required");
        $this->form_validation->set_rules('profession', 'profession', "trim|required");
        $this->form_validation->set_rules('employer_name', 'Employer Name', "trim|required");
        $this->form_validation->set_rules('annual_income', 'Annual Income', "trim|required");
        $this->form_validation->set_rules('payAmount', 'pay Amount', "trim|required|integer");
        $this->form_validation->set_rules('relationship_with_student', 'Relationship with student', "trim|required");

        $student_name     = $this->input->post('usr_firstname')."".$this->input->post('usr_lastname');
        $studId           = $this->input->post('studId');
        $planId           = $this->input->post('planId');
        $paymentType      = $this->input->post('paymentType');
        $payAmount        = $this->input->post('payAmount');
        $planvalue        = $this->input->post('planvalue');
        $loanemiId        = $this->input->post('loanemiId');
        $redirect_enabled = "False";

        if ($this->form_validation->run() == FALSE)
        { 
           $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
           $data['planId']        = $planId;
           $data['paymentType']   = $paymentType;
           $data['get_stud_data'] = $this->regModel->get_stud_data($usersession[0]['studId']);
           if($paymentType==2 && $loanemiId > 0 ){
           $data['planvalue']    = $this->regModel->getplanvalue_emi($loanemiId);
           }else{

           $data['planvalue']     = $this->regModel->getplanvalue($planvalue);
           }
           $data['background_color_id'] = 6;
           $this->load->view('getpayment',$data);

        }else{

            $student_dob                = $this->input->post('student_dob');
            $course_id                  = $this->input->post('course_id');
            $payAmount                  = $this->input->post('payAmount');
            $requested_tenure           = $this->input->post('requested_tenure');
            $applicant_name             = $this->input->post('applicant_name');
            $applicant_gender           = $this->input->post('applicant_gender');
            $applicant_dob              = $this->input->post('applicant_dob');
            $mobile                     = $this->input->post('mobile');
            $email                      = $this->input->post('email');
            $aadhar_no                  = $this->input->post('aadhar_no');
            $marital_status             = $this->input->post('marital_status');
            $pan_no                     = $this->input->post('pan_no');
            $profession                 = $this->input->post('profession');
            $employer_name              = $this->input->post('employer_name');
            $annual_income              = $this->input->post('annual_income');
            $relationship_with_student  = $this->input->post('relationship_with_student');
            $redirect_url               = base_url('website/vedic_dash');

            $paymentdata = array(
                'student_name'              => $student_name,
                'student_dob'               => date("d-m-Y", strtotime($student_dob)),
                'course_id'                 => $course_id,
                'branch_id'                 => 4547,
                'requested_amount'          => $payAmount,
                'requested_tenure'          => $requested_tenure,
                'student_reference_no'      => 1111,
                'applicant_name'            => $applicant_name,
                'applicant_gender'          => $applicant_gender, 
                'applicant_dob'             => date("d-m-Y", strtotime($applicant_dob)),
                'mobile'                    => $mobile,
                'email'                     => $email,
                'aadhar_no'                 => $aadhar_no,
                'marital_status'            => $marital_status,
                'pan_no'                    => $pan_no,
                'profession'                => $profession,
                'employer_name'             => $employer_name,
                'annual_income'             => $annual_income,
                'relationship_with_student' => $relationship_with_student,
                'redirect_url'              => $redirect_url,
                'instituteId'               => 1895,
                'redirect_enabled'          => $redirect_enabled,
                'fk_studId'                 => $studId,
                'planId'                    => $planId,
                'paymentType'               => $paymentType,
              );

              $res = $this->regModel->emiapplicationform($paymentdata);
              if($res ==1){
              $paymentdata = http_build_query($paymentdata);
              $url = "https://pay.financepeer.co/uat/partner/pay/lead-create/";

              $ch = curl_init();
              $getUrl = $url."?".$paymentdata;
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              curl_setopt($ch, CURLOPT_URL, $getUrl);
              curl_setopt($ch, CURLOPT_TIMEOUT, 80);
              $output = curl_exec($ch);
              curl_close($ch);
              $output  = json_decode($output);
              if($output){
              if($output->Status=="SUCCESS"){
                $applicationStatus = array(
                  'applicationStatus'=>1
                );
                $this->regModel->update_applicationStatus($applicationStatus,$studId);

                $insert_log_payment_data = array(
                  'usr_firstname'   => $this->input->post('usr_firstname'),
                  'usr_lastname'    => $this->input->post('usr_lastname'),
                  'usr_email'       => $this->input->post('email'),
                  'usr_mobile_no'   => $this->input->post('mobile'),
                  'payAmount'       => $this->input->post('payAmount'),
                  'fk_studId'       => $studId,
                  'paystatus'       => "pending",
                  'planId'          => $planId,
                  'paystatusId'     => 2, //success if 1
                  'paymentType'     => $paymentType,
                  'fk_monthId'      => 11
                );

                $res = $this->regModel->insert_log_payment_data($insert_log_payment_data);
                if($res==1){
                  $redirectUrl = $output->redirectUrl;
                  redirect($redirectUrl);
                }else{

                 $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                 $data['planId']        = $planId;
                 $data['paymentType']   = $paymentType;
                 $data['get_stud_data'] = $this->regModel->get_stud_data($usersession[0]['studId']);
                 if($paymentType==2 && $loanemiId > 0 ){
                   $data['planvalue']    = $this->regModel->getplanvalue_emi($loanemiId);
                   }else{

                   $data['planvalue']     = $this->regModel->getplanvalue($planvalue);
                   }
                   $data['background_color_id'] = 6;
                 $data['error'] = array('error' => "redirect_url Failed !");
                 $this->load->view('getpayment',$data);

                }
                
              }else{

                 $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                 $data['planId']        = $planId;
                 $data['paymentType']   = $paymentType;
                 $data['get_stud_data'] = $this->regModel->get_stud_data($usersession[0]['studId']);
                 if($paymentType==2 && $loanemiId > 0 ){
                   $data['planvalue']    = $this->regModel->getplanvalue_emi($loanemiId);
                   }else{

                   $data['planvalue']     = $this->regModel->getplanvalue($planvalue);
                   }
                   $data['background_color_id'] = 6;
                 $data['error'] = array('error' => "redirect_url Failed !");
                 $this->load->view('getpayment',$data);
              }
            }
          }else{

                 $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
                 $data['planId']        = $planId;
                 $data['paymentType']   = $paymentType;
                 $data['get_stud_data'] = $this->regModel->get_stud_data($usersession[0]['studId']);
                 if($paymentType==2 && $loanemiId > 0 ){
                   $data['planvalue']    = $this->regModel->getplanvalue_emi($loanemiId);
                   }else{

                   $data['planvalue']     = $this->regModel->getplanvalue($planvalue);
                   }
                   $data['background_color_id'] = 6;
                 $data['error'] = array('error' => "You already Applied for EMI for same package !");
                 $this->load->view('getpayment',$data);

          }
        }
     }
    }else{
        redirect('website','refresh');
      }
  }



public function temp_enquiry()
{
            
         $usersession = $this->session->userdata('usersession');
          if(isset($_POST['submit']))
          {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('studentName', 'studentName', 'trim|required');
              $this->form_validation->set_rules('studentEmail', 'student Email', 'trim|required|valid_email');
              $this->form_validation->set_rules('studentMobile', 'student Mobile', 'trim|required|exact_length[10]');
              $this->form_validation->set_rules('studentClass', 'student Class', 'trim|required');
              $this->form_validation->set_rules('promoCode', 'promoCode', 'trim');
          
              if ($this->form_validation->run() == false) {
                    $segmentId = $this->uri->segment(1);
                  $data['metainfo'] = $this->regModel->metainfo($segmentId);
                  $data['prcode']="";
                  $this->load->view('website',$data);
                  
              } else {

                  $studentName            = $this->input->post('studentName');
                  $studentEmail           = $this->input->post('studentEmail');
                  $studentMobile          = $this->input->post('studentMobile');
                  $studentClass           = $this->input->post('studentClass');
                  $promoCode              = $this->input->post('promoCode');

                  $dataarray = array(

                      'studentName'   => $studentName,
                      'studentEmail'  => $studentEmail,
                      'studentMobile' => $studentMobile,
                      'studentClass'  => $studentClass

                  );
                  $leadfrom   = "facebook";
                  
                  $dataarrayapi = array('Childname' => $studentName,'class'=>$studentClass,'mobileno' => $studentMobile,'emailId' =>$studentEmail,'source'=>$leadfrom);
                    $datarrayData = json_encode($dataarrayapi); 
                    $url = "https://vedictreelms.altius.cc/vedictreeLMS/api/getLead";
                    $ch = curl_init();
                    $getUrl = $url;
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $datarrayData);
                    curl_setopt($ch, CURLOPT_URL, $getUrl);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'webServiceName:getWebData',
                        'token:vwCc4oGTyt8vg1QR',
                        'Content-Type:application/json'

                    ));
                    curl_setopt($ch, CURLOPT_TIMEOUT, 80);
                    $outputLMS = curl_exec($ch);
                    curl_close($ch);
                    $outputLMS  = json_decode($outputLMS);
                    
                    if($outputLMS->status=="Success"){
                      $result = $this->regModel->temp_enquiry_api($outputLMS,$leadfrom); 
                    }else{
                      $result = $this->regModel->temp_enquiry_api($outputLMS,$leadfrom); 
                    }
                  

                  $res = $this->regModel->temp_enquiry($dataarray); 
                  if($res==1){
                    
                    $message_mobile = "Lead Message Email - ".$studentEmail."  studentMobile- ".$studentMobile." studentClass -".$studentClass;
                      $res = sendsms('9833544019', $message_mobile);
                      if($res=="fail" || $res=="InsufficientBalance")
                      {
                         $data['errorsweet'] = "Api Not Working";
                      }else{
                          
                            $data['errorsweet'] = array('error' => "Congratulations, You have been registered for Live Demo Sessions. Our team will contact you soon. Please continue with registration to watch Our Animated Sessions!");
                      }
                      $segmentId = $this->uri->segment(1);
                      $data['metainfo'] = $this->regModel->metainfo($segmentId);
                      $data['prcode']="";
                      $data['promoCode'] = $promoCode;
                    $this->load->view('contact',$data);
                  }else{
                    $data['errorsweet'] = array('error' => "Your Email or Mobile Number Already Exist !");
                    $segmentId = $this->uri->segment(1);
                    $data['metainfo'] = $this->regModel->metainfo($segmentId);
                    $data['prcode']="";
                    $data['promoCode'] = $promoCode;
                     $this->load->view('contact',$data);
                  }

              }
           }else{
               $data['metainfo'] = array();
               $this->load->view('errorpage',$data);
           }

          
}



public function showpdfapp()
{
    

    $studId = $this->uri->segment(3);
    $logId = $this->uri->segment(4);
    $data['payment_his_data'] = $this->regModel->payment_his_data_showpdf($studId,$logId);
    $this->load->view('showpdf',$data);
  
}

public function vedic_progress_tracker()
{
 
  $usersession = $this->session->userdata('usersession');
  $fk_studId = $usersession[0]['studId'];
  $studentEmail = $usersession[0]['alternate_email'];
  
  if(isset($_POST['weekdata']))
  {
     $this->form_validation->set_error_delimiters('<span>', '</span>');
     $this->form_validation->set_rules('weekdata', 'weekdata', 'trim|required');
     if ($this->form_validation->run() == false) {
        $data['background_color_id'] = 8; 
        $fk_studId  = $usersession[0]['studId'];
        $Current_datetime = date("Y-m-d 00:00:00");
        $End_datetime = date("Y-m-d 23:59:59");
        $data['get_daily_live_session_presenty'] = $this->regModel->get_daily_live_session_presenty($studentEmail);
        $data['student_daily_reports'] = $this->regModel->student_daily_reports_mob($fk_studId,$Current_datetime,$End_datetime);
        $this->load->view('vedic_progress_tracker',$data);
    } else {

        $weekdata = $this->input->post('weekdata');
        $Current_datetime = date("Y-m-d 00:00:00");
        $lastWeek = "";
        if($weekdata=="weekdata"){
          $lastWeek = date("Y-m-d", strtotime("-7 days"));
        }else if ($weekdata=="monthdata") {
          $lastWeek = date("Y-m-d", strtotime("-30 days"));
        }elseif ($weekdata=="today") {
          $lastWeek = date("Y-m-d 23:59:59");
        }

        $data['student_daily_reports'] = $this->regModel->student_daily_reports_filter_mob($fk_studId,$Current_datetime,$lastWeek,$weekdata);
        $data['get_daily_live_session_presenty'] = $this->regModel->get_daily_live_session_presenty($studentEmail);
        $data['background_color_id']   = 8;
        $this->load->view('vedic_progress_tracker',$data);


    }

  }else{

  $usersession = $this->session->userdata('usersession');

   if(isset($usersession) || !empty($usersession)){

      $data['background_color_id'] = $this->uri->segment(2);
      $fk_studId = $usersession[0]['studId'];
      $studentEmail = $usersession[0]['alternate_email'];
      $Current_datetime = date("Y-m-d 00:00:00");
      $End_datetime = date("Y-m-d 23:59:59");
      $data['get_daily_live_session_presenty'] = $this->regModel->get_daily_live_session_presenty($studentEmail);
      $data['student_daily_reports'] = $this->regModel->student_daily_reports_mob($fk_studId,$Current_datetime,$End_datetime);
   
      $this->load->view('vedic_progress_tracker',$data);

   }
  }
}




public function recap()
{
   $usersession = $this->session->userdata('usersession');

   if(isset($usersession) || !empty($usersession)){

    $fk_classId = $usersession[0]['studentClass'];
    $data['listvideouploading'] = $this->regModel->listvideouploading($fk_classId);
    $data['fk_classId'] = $fk_classId; 
    $data['background_color_id'] = $this->uri->segment(3);
    $vidcreateDT     = date("Y-m-d h:i:s");
    $vidcreateDT     = date('Y-m-01 h:i:s', strtotime($vidcreateDT));
    $param           = 'valubasededucation';
    $fk_classId      = $usersession[0]['studentClass']; 
    $endvidcreateDT  = date("Y-m-t", strtotime($vidcreateDT));
    $data['gmdovbe'] =  $this->regModel->get_month_data_of_value_based_eductaion($vidcreateDT,$param,$endvidcreateDT,$fk_classId);

    $this->load->view('recap',$data);

   }else{

    redirect(base_url('website'));

   }
}

public function vedic_learn_recap()
{

  $usersession = $this->session->userdata('usersession');

   if(isset($usersession) || !empty($usersession)){

    $monthId     = $this->uri->segment(3); 
    $dayId       = $this->uri->segment(4);
    $fk_classId  = $this->uri->segment(5);
    $vidId       = base64_decode($this->uri->segment(6));
    $his         = $this->uri->segment(7);
    $studId      = $usersession[0]['studId'];
    
      
        if($vidId > 0 ){

        $get_day_sessions_vid = $this->regModel->get_day_sessions_vid_recap_vidId($dayId,$monthId,$fk_classId,$vidId,$studId);
      }else{
        $get_day_sessions_vid = $this->regModel->get_day_sessions_vid_by_default_recap($dayId,$monthId,$fk_classId,$studId);
      }

        $data['get_day_sessions'] = $this->regModel->get_day_sessions_vid_recap($dayId,$monthId,$fk_classId,$studId);


        if($vidId=="" || empty($vidId))
        {
          if(!empty($get_day_sessions_vid)){
            $vidId = $get_day_sessions_vid[0]['vidId'];
          }
        }else{
          $vidId = $vidId;
        }

        $data['monthId']    = $monthId;
        $data['dayId']      = $dayId;
        $data['fk_classId'] = $fk_classId;
        $data['vidId']      = $vidId;
        if($vidId > 0 ){
          
          if(!empty($get_day_sessions_vid)){
            $data['youtubelinks'] = "https://player.vimeo.com/video/".$get_day_sessions_vid[0]['vimeoId'];
          }else{

            $data['youtubelinks'] ="";
          }
        }else{
          
          if(!empty($get_day_sessions_vid)){

            $data['youtubelinks'] = "https://player.vimeo.com/video/".$get_day_sessions_vid[0]['vimeoId'];

         }else{
          
            $data['youtubelinks'] = "";
          }
        }

      $data['background_color_id'] = 9;
  
    $data['last_session_running'] = $this->regModel->last_session_running($usersession[0]['studId'],$fk_classId);
    
    $this->load->view('vedic_learn_recap',$data);

   }else{

    redirect(base_url('website'));

   }

}


 public function verifyotpweb()
{
    
      if(isset($_POST['submit']))
      {
          $this->form_validation->set_error_delimiters('<span>', '</span>');                  
          $this->form_validation->set_rules('otp', 'Otp Number', "trim|required");
          $this->form_validation->set_rules('studentMobile', 'studentMobile', "trim|required");
          $this->form_validation->set_rules('newpass', 'New Password', "trim|required");
          $this->form_validation->set_rules('cnewpass', 'Confirm Password', "trim|required|matches[newpass]");
          if ($this->form_validation->run() == FALSE)
          {
              $segmentId = $this->uri->segment(1);
              $data['metainfo'] = $this->regModel->metainfo($segmentId);
            $this->load->view('verifyotp',$data);
          }else{

            $otp      = $this->input->post('otp');
            $newpass  = $this->input->post('newpass');
            $studentMobile  = convert_uudecode($this->input->post('studentMobile'));
            
            $res    = $this->regModel->updateforgetpass($otp,$newpass,$studentMobile);
            if ($res==1) {
                  $data['error'] = array('error' => "Password updated Successfully ! ");
                  $segmentId = $this->uri->segment(1);
                  $data['metainfo'] = $this->regModel->metainfo($segmentId);
                  $this->load->view('verifyotp',$data);
            }else{
                  $data['error'] = array('error' => "User does not exist ! ! ");
                  $segmentId = $this->uri->segment(1);
                  $data['metainfo'] = $this->regModel->metainfo($segmentId);
                  $this->load->view('verifyotp',$data);
            }
          }
      }else{
            $segmentId = $this->uri->segment(1);
            $data['metainfo'] = $this->regModel->metainfo($segmentId);
            $this->load->view('verifyotp',$data);
      }

}

public function forget_password()
{

  if(isset($_POST['submit'])){
      
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|required|numeric|exact_length[10]");
        if ($this->form_validation->run() == FALSE)
        {     
            
            $segmentId = $this->uri->segment(1);
            $data['metainfo'] = $this->regModel->metainfo($segmentId);
            $this->load->view('forgetpassword',$data);          
        }else{

           $studentMobile     = $this->input->post('studentMobile');
           $res = $this->regModel->check_mobile_exist_web($studentMobile);
            if($res==1){
              $data['error'] = array('error' => "Otp Sent on your mobile Successfully !");
              $segmentId = $this->uri->segment(1);
              $data['metainfo'] = $this->regModel->metainfo($segmentId);
              $this->load->view('forgetpassword',$data);
            }else{
              $data['error'] = array('error' => "Mobile is not Exist !");
              $segmentId = $this->uri->segment(1);
              $data['metainfo'] = $this->regModel->metainfo($segmentId);
              $this->load->view('forgetpassword',$data);
            }
        }
    }else{
      $segmentId = $this->uri->segment(1);
      $data['metainfo'] = $this->regModel->metainfo($segmentId);
      $this->load->view('forgetpassword',$data);
    }
}


public function resentotp()
{

    $studentMobile = convert_uudecode($this->input->post('studentMobile'));
    $otp = rand(1111,9999);
    $res = $this->regModel->resentotp($studentMobile,$otp);
    if($res==1){
      echo "1";
    }else {
      echo "0";
    }

}


public function fblogin()
{
  

        $studentEmail = $this->input->post('email');
        $studentName = $this->input->post('first_name')." ".$this->input->post('last_name');
        $data =  array(
                        'studentEmail'     => $studentEmail,
                        'studentName'      => $studentName,
                        'studentStatus'    => 1,
                        'NewrefferalCode'  => "VEDICREF-".rand(111111,999999)
                  );
        $result = $this->regModel->check_reg_email_data($studentEmail);
        if($result==1){
            $data['error'] = array('error' => "Login Successfully !");
            $usersession = $this->session->userdata('usersession');
            $fk_monthId = $usersession[0]['studentClass'];
            $checkpass = $this->regModel->checkpass($studentEmail);
            if($checkpass)
            {
              if($checkpass[0]['studentPass']==""){
             
                echo "1";
            }else{
              echo "2";
            }
            }
         }else{

           $res = $this->regModel->add_reg_social($data);
            if($res==1){
               echo "1";
           }else{
              echo "3";
           } 
        }

}



public function checkpromocode(){
    $promoCode = $this->input->post('promoCode');
    $promoCode =  str_replace(' ', '', $promoCode);
    $promoCode = strtolower($promoCode);
    $res = $this->regModel->checkpromocode($promoCode);
    echo $res;
}


public function checkrefferalCode(){
    $refferalCode = $this->input->post('refferalCode');       
    $res = $this->regModel->checkrefferalCode($refferalCode);
    echo $res;
}

public function checkstudentMobile(){
    $studentMobile = $this->input->post('studentMobile');       
    $res = $this->regModel->checkstudentMobile($studentMobile);
    echo $res;
}

public function checkstudentEmail(){
    $studentEmail = $this->input->post('studentEmail');       
    $res = $this->regModel->checkstudentEmail($studentEmail);
    echo $res;
}

public function one_tap_google_login()
{
  
      $credential       = $this->input->post('credential');
      $credential       = json_decode($credential);
      $studentEmail     = $credential->email;
      $studentName      = $credential->name;
      $studentStatus    = $credential->email_verified;
      $oauth_uid        = $credential->sub;
      $data =  array(
                        'studentEmail'     => $studentEmail,
                        'studentName'      => $studentName,
                        'studentStatus'    => $studentStatus,
                        'oauth_uid'        => $oauth_uid,
                        'NewrefferalCode'  => "VEDICREF-".rand(111111,999999)
                      );
        $result = $this->regModel->check_reg_email_data($studentEmail);
        if($result==1){

            $data['error'] = array('error' => "Login Successfully !");
            $usersession = $this->session->userdata('usersession');
            $fk_monthId = $usersession[0]['studentClass'];

            $checkpass = $this->regModel->checkpass($studentEmail);

            if($checkpass){
              if($checkpass[0]['studentPass']==""){
              //redirect('website/nextstep');
                echo 1;
            }else{
              echo 2;
              //redirect('website/vedic_dash');
            }
            
            }

         }else{

           $res = $this->regModel->add_reg_social($data);
            if($res==1){
              $data['social'] = array('error' => "Login Successfully !");
              $usersession = $this->session->userdata('usersession');
              echo 1;
           }else{
              $data['error'] = array('error' => "Some Techinical issues Faced !");
              echo 3;
           } 
        }

}




public function homework()
{
  
   $usersession    = $this->session->userdata('usersession');
   if(!empty($usersession)) {
        $studId = $usersession[0]['studId'];       
        $data['background_color_id'] = $this->uri->segment(2);
        $data['gmdovbe'] = array();
        
        $get_course_info = $this->regModel->get_course_infomation($studId);
        if($get_course_info){
            $class_id = $get_course_info[0]['fk_classId'];
            $plan_id  = $get_course_info[0]['fk_feesId'];
            $data['student_homeworks'] = $this->regModel->get_student_homeworks($class_id,$plan_id);
        }else{
            $data['student_homeworks'] =  array();
        }
        $this->load->view('homework',$data);
   } else {
      redirect('website');
  }

}


public function change_pin()
{

  $usersession    = $this->session->userdata('usersession');
  if(!empty($usersession)){
      $studId = $usersession[0]['studId'];       
      $current_pin        = $this->input->post('current_pin');
      $res = $this->regModel->change_pin($current_pin,$studId);
      echo $res;
   }else{
      redirect('website');
  }

}


public function check_password_ex(){
  $usersession    = $this->session->userdata('usersession');
  if(!empty($usersession)){
    $usersession    = $this->session->userdata('usersession');
    $studId = $usersession[0]['studId'];   
    $current_password = $this->input->post('current_password');       
    $res = $this->regModel->check_password_ex($current_password,$studId);
    echo $res;
  }else{
    redirect('website','refresh');
  }
}


public function check_old_pin(){
  $usersession    = $this->session->userdata('usersession');
  if(!empty($usersession)){
    $usersession    = $this->session->userdata('usersession');
    $studId = $usersession[0]['studId'];   
    $old_pin = $this->input->post('old_pin');       
    $res = $this->regModel->check_old_pin($old_pin,$studId);
    echo $res;
  }else{
    redirect('website','refresh');
  }
}


public function changePinUser()
{
  
  $usersession    = $this->session->userdata('usersession');
  $studId = $usersession[0]['studId'];
  $NewrefferalCode  = $usersession[0]['NewrefferalCode'];
  $fk_classId       = $usersession[0]['studentClass'];

   if(!empty($usersession)) {
    if(isset($_POST['submit']))
      {
          $this->form_validation->set_error_delimiters('<span>', '</span>');                  
          $this->form_validation->set_rules('new_pin', 'new pin', "trim|required");
          $this->form_validation->set_rules('cnf_new_pin', 'Confirm Password', "trim|required|matches[new_pin]");
          if ($this->form_validation->run() == FALSE)
          {

            $data['userinfo']             = $this->regModel->userinfo($studId);
            $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
            $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
            $data['userinfo_mother']      = $this->regModel->userinfo_mother($studId);  
            $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
            $data['bank_info']            = $this->regModel->bank_info($studId); 
            $data['background_color_id']  = 4;
            $data['user_state']           = $this->regModel->user_state();
            $this->load->view('vedicprofile',$data);

          }else{

            $new_pin  = $this->input->post('new_pin');
            $res      = $this->regModel->changePinUser($studId,$new_pin);
            if ($res==1) {
                  $data['error'] = array('error' => "Pin Number updated Successfully ! ");
                    
            }else{
                  $data['error'] = array('error' => "Pin Number Is not updated ! ");
            }
             $data['userinfo']             = $this->regModel->userinfo($studId);
             $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
             $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
             $data['userinfo_mother']      = $this->regModel->userinfo_mother($studId);  
             $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
             $data['bank_info']            = $this->regModel->bank_info($studId); 
             $data['background_color_id']  = 4;
             $data['user_state']           = $this->regModel->user_state();
             $this->load->view('vedicprofile',$data);
          }
      }else{

          $data['userinfo']             = $this->regModel->userinfo($studId);
          $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
          $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
          $data['userinfo_mother']      = $this->regModel->userinfo_mother($studId);  
          $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
          $data['bank_info']            = $this->regModel->bank_info($studId); 
          $data['background_color_id']  = 4;
          $data['user_state']           = $this->regModel->user_state();
          $this->load->view('vedicprofile',$data);
      }

    } else {
      redirect('website');
  }

}

public function changePasswordUser()
{
  
  $usersession      = $this->session->userdata('usersession');
  $studId           = $usersession[0]['studId'];
  $NewrefferalCode  = $usersession[0]['NewrefferalCode'];
  $fk_classId       = $usersession[0]['studentClass'];

   if(!empty($usersession)) {
    if(isset($_POST['submit']))
      {
          $this->form_validation->set_error_delimiters('<span>', '</span>');                  
          $this->form_validation->set_rules('new_password', 'new pin', "trim|required");
          $this->form_validation->set_rules('cnf_new_password', 'Confirm Password', "trim|required|matches[new_password]");
          if ($this->form_validation->run() == FALSE)
          {

            $data['userinfo']             = $this->regModel->userinfo($studId);
            $data['bank_info']            = $this->regModel->bank_info($studId); 
            $data['user_state']           = $this->regModel->user_state();
            $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
            $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
            $data['userinfo_mother']      = $this->regModel->userinfo_mother($studId);  
            $data['background_color_id']  = 4;
            $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
            $this->load->view('vedicprofile',$data);
          }else{
            $new_password  = $this->input->post('new_password');
            $res           = $this->regModel->changePasswordUser($studId,$new_password);
            if ($res==1) {
                  $data['error'] = array('error' => "Password updated Successfully ! ");
            }else{
                  $data['error'] = array('error' => "Password Is not updated ! ");
            }
            $data['userinfo']             = $this->regModel->userinfo($studId);
            $data['bank_info']            = $this->regModel->bank_info($studId); 
            $data['user_state']           = $this->regModel->user_state();
            $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
            $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
            $data['userinfo_mother']      = $this->regModel->userinfo_mother($studId);  
            $data['background_color_id']  = 4;
            $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
            $this->load->view('vedicprofile',$data);
          }
      }else{

            $data['userinfo']             = $this->regModel->userinfo($studId);
            $data['bank_info']            = $this->regModel->bank_info($studId); 
            $data['user_state']           = $this->regModel->user_state();
            $data['myrefferals']          = $this->regModel->myrefferals($NewrefferalCode);
            $data['userinfo_father']      = $this->regModel->userinfo_father($studId);
            $data['userinfo_mother']      = $this->regModel->userinfo_mother($studId);  
            $data['background_color_id']  = 4;
            $data['last_session_running'] = $this->regModel->last_session_running($studId,$fk_classId);
            $this->load->view('vedicprofile',$data);
      }

    } else {
      redirect('website');
  }

}




public function open_previous_month()
{
  
  $usersession    = $this->session->userdata('usersession');
  if(!empty($usersession)){
      $data['background_color_id']  = 14;
      $get_updated_month_data =  $this->regModel->get_updated_month_data($usersession[0]['studId']);
      $data['fk_monthId']  = $get_updated_month_data[0]['unlock_monthId'];
      $data['get_month_data'] = $this->regModel->get_month_data_admin();
      $data['unlocksession_data']  = $this->regModel->unlocksession_data($usersession[0]['studId']);
      $this->load->view('open_previous_month',$data); 
  }else{
    redirect('website','refresh');
  }


}


public function unlockdays_student()
{
    $usersession = $this->session->userdata('usersession'); 
    if($this->session->userdata('usersession'))
    {
    
      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('dId', 'dId', 'trim|required|integer|greater_than[0]');
              $this->form_validation->set_rules('fk_monthId', 'fk_monthId', 'trim|required|integer|greater_than[0]');
              $this->form_validation->set_rules('studId', 'studId', 'trim|required|integer|greater_than[0]');
            
              $dayId       =  $this->input->post('dayId');
              $fk_monthId  =  $this->input->post('fk_monthId');
              $studId      =  $this->input->post('studId');

              if ($this->form_validation->run() == FALSE)
              {     
                  $data['studId']                   = $studId;
                  $data['unlockdays']               = $this->regModel->unlockdays();
                  $data['fk_monthId']               = $fk_monthId;
                  $data['unlocksession_data']       = $this->regModel->unlocksession_day($usersession[0]['studId']);
                  $data['background_color_id']      = 14;
                  $data['check_month_exist_or_not'] = $this->regModel->check_month_exist_or_not($fk_monthId);
                  $this->load->view('unlockdays_student',$data);

              }
              else
              {

                $dayId       =  $this->input->post('dId');
                $fk_monthId  =  $this->input->post('fk_monthId');
                $studId      =  $this->input->post('studId');
                $res         = $this->regModel->unlocksession_day_student($dayId,$studId,$fk_monthId);
                if($res==1){
                  $data['error']                    = array('error'=>'Days unlock Successfully');
                  $data['studId']                   = $studId;
                  $data['unlockdays']               = $this->regModel->unlockdays();
                  $data['fk_monthId']               = $fk_monthId;
                  $data['unlocksession_data']       = $this->regModel->unlocksession_day($studId);
                  $data['background_color_id']      = 14;
                  $data['check_month_exist_or_not'] = $this->regModel->check_month_exist_or_not($fk_monthId);
                }else{

                  $data['error']                    = array('error'=>'Days not unlock Successfully because of payAmount is pending');
                  $data['studId']                   = $studId;
                  $data['unlockdays']               = $this->regModel->unlockdays();
                  $data['fk_monthId']               = $fk_monthId;
                  $data['unlocksession_data']       = $this->regModel->unlocksession_day($studId);
                  $data['background_color_id']      = 14;
                  $data['check_month_exist_or_not'] = $this->regModel->check_month_exist_or_not($fk_monthId);
                }
                  $this->load->view('unlockdays_student',$data);

              }
          }else{

                  $usersession                      = $this->session->userdata('usersession');
                  $fk_monthId                       = $this->uri->segment(3);
                  $data['studId']                   = $usersession[0]['studId'];
                  $data['unlockdays']               = $this->regModel->unlockdays();
                  $data['fk_monthId']               = $fk_monthId;
                  $data['unlocksession_data']       = $this->regModel->unlocksession_day($usersession[0]['studId']);
                  $data['background_color_id']      = 14;
                  $data['check_month_exist_or_not'] = $this->regModel->check_month_exist_or_not($fk_monthId);
                  $this->load->view('unlockdays_student',$data);
                
          }
     }

}


public function unlocksession_month()
{
  
  $usersession = $this->session->userdata('usersession');
  if($this->session->userdata('usersession'))
  {

    if(isset($_POST['submit']))
      {

            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('mId', 'mId', 'trim|required|numeric|greater_than[0]');
            $this->form_validation->set_rules('studId', 'studId', 'trim|required|integer|greater_than[0]');
            $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|required|integer|greater_than[0]');

            $studId      =  $this->input->post('studId');
            $fk_classId  =  $this->input->post('fk_classId');
            $fk_monthId  =  $this->input->post('fk_monthId');

            if ($this->form_validation->run() == FALSE)
            {     
                $data['studId'] = $studId;
                $data['fk_classId'] = $fk_classId;
                $data['get_month_data'] = $this->regModel->get_month_data_admin();
                $data['background_color_id']  = 14;
                $data['unlocksession_data'] = $this->regModel->unlocksession_data($usersession[0]['studId']);
                $this->load->view('open_previous_month',$data);
            }
            else
            {

              $mId         =  $this->input->post('mId');
              $studId      =  $this->input->post('studId');
              $fk_classId  =  $this->input->post('fk_classId');
              $fk_monthId  =  $this->input->post('fk_monthId');
              $res = $this->regModel->unlocksession($mId,$studId,$fk_classId);
              if($res==1){

                $data['error'] = array('error'=>'Month Status Changed');
                $data['studId'] = $studId;
                $data['fk_classId'] = $fk_classId;
                $data['background_color_id']  = 14;
                $data['fk_monthId']  = $fk_monthId;
                $data['get_month_data'] = $this->regModel->get_month_data_admin();
                $data['unlocksession_data'] = $this->regModel->unlocksession_data($usersession[0]['studId']);
                $this->load->view('open_previous_month',$data);

              }else{
                  
                $data['error'] = array('error'=>'Student fees is pending');
                $data['studId'] = $studId;
                $data['fk_monthId']  = $fk_monthId;
                $data['fk_classId'] = $fk_classId;
                $data['background_color_id']  = 14;
                $data['get_month_data'] = $this->regModel->get_month_data_admin();
                $data['unlocksession_data'] = $this->regModel->unlocksession_data($usersession[0]['studId']);
                $this->load->view('open_previous_month',$data);

              }

            }
      }else{

        $data['studId'] = $this->uri->segment(3);
        $data['fk_classId'] = $this->uri->segment(4);
        $data['background_color_id']  = 14;
        $data['get_month_data'] = $this->regModel->get_month_data_admin();
        $data['unlocksession_data'] = $this->regModel->unlocksession_data($usersession[0]['studId']);
       $this->load->view('open_previous_month',$data);
      }
       
    
  }else{
      redirect(base_url());
  }


}


public function assign_homework()
{
   $data['background_color_id']  = 15;
 $this->load->view('assignments',$data);
}

public function upload_assignment()
{

   $this->load->view('upload');
}
public function load_assignment()
{
   $this->load->view('load');
}
public function delete_assignment()
{
   $data = array('op' =>$this->input->post('op'),'filename'=>$this->input->post('name'));
   $this->load->view('delete',$data);
}
public function download_assignment()
{
   $this->load->view('download');
}


public function errorpage()
{
   $data['metainfo']  = array();
   $this->load->view('errorpage',$data);
}




public function chat_with_teacher()
{
  $usersession    = $this->session->userdata('usersession');
  if(!empty($usersession)){
  $data['background_color_id']  = 12;
  $studId = $usersession[0]['studId'];
  $readMsg = 1;
  $this->chatModel->readMessage($studId,$readMsg);
  $this->load->view('chat_with_teacher',$data); 
  }else{
    redirect('website','refresh');
  }
}

public function chat_with_teacher_msg()
{
  

  $usersession    = $this->session->userdata('usersession');

  if(!empty($usersession)){

    $studId        = $this->input->post('studId');
    $planId        = $this->input->post('planId');
    $msg           = $this->input->post('message');
    $fk_teachId    = $this->input->post('fk_teachId');
    date_default_timezone_set('Asia/Kolkata');
    $currentDate   = date('Y-m-d h:i:s');
    $res = $this->chatModel->start_chat($fk_teachId,$studId,$planId,$msg,$currentDate);
   
    foreach ($res as $key => $value) {
                $dataArray = $value;
    }
    echo json_encode($dataArray);


}


}


public function uploadchatimg()
{
  
  $usersession    = $this->session->userdata('usersession');

  if(!empty($usersession)){

       $chatimgup     = $_FILES['chatimgup']['name'];

        if(!empty($chatimgup)){

        $studId        = $this->input->post('studId');
        $planId        = $this->input->post('planId');
        $msg           = $this->input->post('message');
        $fk_teachId    = $this->input->post('fk_teachId');
        
         $config['upload_path']          = './uploads/chatimgup/';
         $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|PNG|JPEG';
         $config['max_size']             = 2084;

         $this->load->library('upload', $config);
         $this->upload->initialize($config);

         if (!$this->upload->do_upload('chatimgup'))
          {
                  $data = array('error'=>$this->upload->display_errors());
                  echo json_encode($data);
          }
          else
          {
               $data = array('chatimgup' => $this->upload->data());  
               $chatimgup = $data['chatimgup']['file_name'];
         
          date_default_timezone_set('Asia/Kolkata');
          $currentDate   = date('Y-m-d h:i:s');
          $res = $this->chatModel->start_chat_with_img($fk_teachId,$studId,$msg,$planId,$currentDate,$chatimgup);

          foreach ($res as $key => $value) {
                      $dataArray = $value;
          }
          echo json_encode($dataArray);
        }
      
    }

  }else{

    redirect('website','refresh');
  } 

}


public function Clearchat()
{
  
        $usersession    = $this->session->userdata('usersession');
        if(!empty($usersession)){
          $studId        = $this->input->post('userId');
          $res = $this->chatModel->Clearchat($studId);
          if($res==1){
            echo "1";
          }else{
            echo "0";
          }
      }

}




public function ajax_get_chat_messages()
{
  
  $usersession    = $this->session->userdata('usersession');
  if(!empty($usersession)){

    date_default_timezone_set('Asia/Kolkata');
    $studId        = $this->input->post('studId');
    $fk_teachId    = $this->input->post('fk_teachId');
    $currentDate   = date('Y-m-d h:i:s');
    $res = $this->chatModel->ajax_get_chat_messages($fk_teachId,$studId,$currentDate);
    $dataArray = array();
    if(!empty($res)){
    foreach ($res as $key => $value) {
      $dataArray = $value;
    }
     echo json_encode($dataArray);
    }

  }else{
    redirect('welcome','refresh');
  }

}


public function addPeerId(){

  $usersession = $this->session->userdata('usersession');
  $fk_studId = $usersession[0]['studId'];
  if(!empty($usersession)){
    $peerId = $this->input->post('peerId');
    $res = $this->regModel->addPeerId($peerId,$fk_studId);
    echo $res;
  }else{
    redirect(base_url('website'));
  }

}


public function vedicdashcourse()
{
   $usersession = $this->session->userdata('usersession');
   if(isset($usersession) || !empty($usersession)){

    $fk_classId                        = $usersession[0]['studentClass'];
    $data['listvideouploading']        = $this->regModel->listvideouploading($fk_classId);
    $data['fk_classId']                = $fk_classId; 
    $data['opdayId']                   = $this->uri->segment(3);
    $data['background_color_id']       = $this->uri->segment(2);
    $vidcreateDT                       = date("Y-m-d h:i:s");
    $vidcreateDT                       = date('Y-m-01 h:i:s', strtotime($vidcreateDT));
    $param                             = 'valubasededucation';
    $fk_classId                        = $usersession[0]['studentClass']; 
    $endvidcreateDT                    = date("Y-m-t", strtotime($vidcreateDT));
    $data['gmdovbe']                   =  $this->regModel->get_month_data_of_value_based_eductaion($vidcreateDT,$param,$endvidcreateDT,$fk_classId);
    $data['last_session_running']      = $this->regModel->last_session_running($usersession[0]['studId'],$fk_classId);
    $data['day_open_for_next_session'] = $this->regModel->day_open_for_next_session();
    $data['tbl_unlock_days']           = $this->regModel->tbl_unlock_days();
    $this->load->view('vedicdashcourse',$data);

   }else{

    redirect(base_url('website'));

   }
}

public function download_homework()
{
       
      $start_time  = $this->input->post('start_time');
      
      $res = $this->regModel->get_download_homework($start_time);
      $dowloadData = array();
     
        if($res){
              foreach($res as $download_homewok)
              {
                   
                     $filepath1 =  base_url('teacher/uploads/multiple_pics_loading/').str_replace(' ', '_', $download_homewok['allocated_file']);
                 
                    $zipp =  $this->zip->add_data($filepath1);
               
                
              }
            //   $filename = "backup.zip";
               $this->zip->download(''.time().'.zip');
                    
          }
          
           
        
           
         
      
}



public function response_back_homework()
{
        
       
          $usersession = $this->session->userdata('usersession');
          $this->load->library('upload');
          $image = array();
          $ImageCount = count($_FILES['file_allocated']['name']);
       
        for($i = 0; $i < $ImageCount; $i++){
           $FILENAMES =  $_FILES['file']['name']       = $_FILES['file_allocated']['name'][$i];
            $_FILES['file']['type']       = $_FILES['file_allocated']['type'][$i];
            $_FILES['file']['tmp_name']   = $_FILES['file_allocated']['tmp_name'][$i];
            $_FILES['file']['error']      = $_FILES['file_allocated']['error'][$i];
            $_FILES['file']['size']       = $_FILES['file_allocated']['size'][$i];
             $config['encrypt_name'] = TRUE;
            // File upload configuration
             $studId = $usersession[0]['studId']; 
             $usersession               = $this->session->userdata('usersession');
             $start_time                =  $this->input->post('start_time');
             $homework_id               = $this->input->post('homework_id');
             $fk_feesId                 = $this->input->post('fk_feesId');
             $class_id                  = $this->input->post('class_id');
             $home_title                = $this->input->post('home_title');
              
             
        
            $uploadPath = './uploads/homework_allocated_student/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|PNG|JPEG';

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
             $res = 0;
            
            // Upload file to server
            // Upload file to server
            if($this->upload->do_upload('file')){
                // Uploaded file data
                $imageData = $this->upload->data();
                //  $uploadImgData[$i]['allocated_file'] = $imageData['allocated_file'];

            }
              $res = $this->regModel->back_reposense_homework($start_time,$homework_id,$fk_feesId,$class_id,$imageData['file_name'],$home_title,$studId);
        }
          
          if($res==1){
             echo json_encode(array('success' => 'Homework Upload  successfully'));
          }
          else
          {
             echo json_encode(array('success' => 'Homework not Uploaded '));
          }
          
      
         if(!empty($uploadImgData)){
            // Insert files data into the database
            // $this->pages_model->multiple_images($uploadImgData);              
        }
}

public function response_remark_studentt()
{
        $homework_id  = $this->input->post('homework_id');
        $result = $this->regModel->student_homeworks_remarks_reponsetbl($homework_id);
        echo json_encode(!empty($result[0]['remark']) ? $result[0]['remark']:'');
}


public function attendace()
{
    
      $usersession    = $this->session->userdata('usersession');
      if(!empty($usersession)){
    
        date_default_timezone_set('Asia/Kolkata');
        $studId        = $usersession[0]['studId'];
        $currentDate   = date('Y-m-d');
        $res = $this->regModel->attendace($studId,$currentDate);
        if($res==1){
            echo "1";
        }else if($res==2){
            echo "2";
        }else{
            echo "0";
        }
    
      }else{
        redirect('welcome','refresh');
      }
  
}


public function countupdate()
{
  $res = $this->regModel->countupdate(1);
  if($res==1){
    echo "1";
   }else{
    echo "0";
  }

}



public function vedic_value()
{
   
    $usersession = $this->session->userdata('usersession');    
    if($this->session->userdata('usersession'))
    {
        $data['list_of_valuebased'] = $this->regModel->list_of_valuebased_class($usersession[0]['studentClass']); 
        $data['background_color_id'] = 15;
        $this->load->view('vedicvalue',$data);
    } else {
      redirect('website');
    }
}


public function download_homework_view()
{   
    $start_time  = $this->input->post('start_time');
    $fk_feesId  = $this->input->post('fk_feesId');
    $data['background_color_id']       = $this->uri->segment(2);
    $data['homowork_view_files'] = $this->regModel->get_download_homework($start_time,$fk_feesId);
    $data['background_color_id']  = 16;
    $this->load->view('homework_view_files',$data);
}

public function download_homeworkbyadmin()
{
       
      $start_time  = $this->input->post('start_time');
      $end_time  = $this->input->post('end_time');
      $feesId  = $this->input->post('feesId');
      
      $data['admin_view_files'] = $this->regModel->get_download_homework_admin($start_time,$end_time,$feesId);
      
      $this->load->view('admin_homework_files', $data);
      
      
}

public function event_details()
{
     $event_generated_id = $this->uri->segment(2);
     $segmentId = $this->uri->segment(1);
     $data['metainfo'] = $this->regModel->metainfo($segmentId);
     $data['events_info'] = $this->regModel->get_events_info($event_generated_id);
     $data['events']    =  $this->regModel->getEvents();
     $this->load->view('event-details', $data);
}

// report card //

public function report_card()
{ 
    $segmentId                  = $this->uri->segment(1);
    $data['metainfo']           = $this->regModel->metainfo($segmentId);
    $usersession                = $this->session->userdata('usersession');
    $studId                     = $usersession[0]['studId'];
    $data['userreport_detail']  = $this->regModel->get_reportcardDetail($studId);
    $data['signs']              = $this->regModel->getPresipalData();
    $this->load->view('report_card',$data);
}

public function finalreport_card()
{
    $segmentId                         = $this->uri->segment(1);
    $data['metainfo']                  = $this->regModel->metainfo($segmentId);
    $usersession                       = $this->session->userdata('usersession');
    $studId                            = $usersession[0]['studId'];
    $data['userreport_detail_second']  = $this->regModel->get_reportcardDetail_second($studId);
    $data['signs']                     = $this->regModel->getPresipalData();
     $this->load->view('finalreport_card',$data);
}

public function viewreportcard()
{
    $data['background_color_id']        = $this->uri->segment(2);
    $data['background_color_id']        = 19;
    $this->load->view('viewreportcard', $data);
}



















































}

?>