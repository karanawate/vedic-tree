<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


class Website extends CI_Controller {



public function vedic_value()
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

       $data['background_color_id'] = $this->uri->segment(8);
       $data['get_day_sessions'] = $this->regModel->get_day_sessions_value_based($dayId,$monthId,$fk_classId,$studId);

       $last_session_running = $this->regModel->last_session_running_value_based($usersession[0]['studId'],$fk_classId,$studId);
       
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
        $data['background_color_id'] = $this->uri->segment(8);

        $get_day_sessions_vid = $this->regModel->get_day_sessions_vid_value_based($dayId,$monthId,$fk_classId,$vidId,$studId);
      }else{
        $data['background_color_id'] = $this->uri->segment(6);
        $get_day_sessions_vid = $this->regModel->get_day_sessions_vid_by_default_value_based($dayId,$monthId,$fk_classId,$studId);
      }

        $data['get_day_sessions'] = $this->regModel->get_day_sessions_value_based($dayId,$monthId,$fk_classId,$studId);


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
    

    $data['last_session_running'] = $this->regModel->last_session_running_value_based($usersession[0]['studId'],$fk_classId);
    
    $this->load->view('vedicvalue',$data);

   }else{

    redirect(base_url('website'));

   }
}


public function course_1()
{
  $this->load->view('course1');
}
public function course_2()
{
  $this->load->view('course2');
}
public function course_3()
{
  $this->load->view('course3');
}
public function blog()
{
  $this->load->view('blog');
}
public function blog_1()
{
  $this->load->view('blog1');
}
public function blog_2()
{
  $this->load->view('blog2');
}
public function blog_3()
{
  $this->load->view('blog3');
}
public function gallery()
{
  $this->load->view('gallery');
}



public function forget_password()
{

  if(isset($_POST['submit'])){
      
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|required|numeric|exact_length[10]");
        if ($this->form_validation->run() == FALSE)
        {     
          $this->load->view('forgetpassword');          
        }else{

           $studentMobile     = $this->input->post('studentMobile');
           $res = $this->regModel->check_mobile_exist_web($studentMobile);
            if($res==1){
              $data['error'] = array('error' => "Otp Sent on your mobile Successfully !");
              $this->load->view('forgetpassword',$data);
            }else{
              $data['error'] = array('error' => "Mobile is not Exist !");
              $this->load->view('forgetpassword',$data);
            }
        }
    }else{

      $this->load->view('forgetpassword');
    }
}



public function index()
{
    $usersession = $this->session->userdata('usersession');
    $this->load->view('website');
}

public function aboutus()
{
  $usersession = $this->session->userdata('usersession');
  $this->load->view('aboutus');
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
        $this->form_validation->set_rules('refferalCode', 'refferal Code', "trim");
        $this->form_validation->set_rules('studentCPass', 'Student confirm Password', "trim|required|matches[studentPass]");
        $result = array();
        if ($this->form_validation->run() == FALSE)
        {     

          // echo validation_errors();
                   $data['getClass'] =  $this->regModel->getClass();
                   $this->load->view('contact',$data);
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
                                'NewrefferalCode' => "VEDICREF-".rand(111111,999999) ,
                                'OTP'             => rand(111111,999999)
                            );

           $check_exist_number = $this->regModel->tbl_temp_enquiry($studentEmail,$studentMobile);
           if($check_exist_number==1){

              $data['error'] = array('error' => "Mobile And Email Already Exist !");
              $data['getClass'] =  $this->regModel->getClass();
              $this->load->view('contact',$data);

           }else{

            $res = $this->regModel->add_tbl_temp_enquiry($arraydata);
            if($res==1){
              $data['error'] = array('error' => "Register Successfully !");
              $data['getClass'] =  $this->regModel->getClass();
              // $this->load->view('contact',$data);
              redirect('website/webotp','refresh');
            }else{
              $data['error'] = array('error' => "Mobile And Email Already Exist !");
              $data['getClass'] =  $this->regModel->getClass();
              $this->load->view('contact',$data);
            }

           }

        }

    } else {

        $this->load->view('contact');
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

              $data['error'] = array('error' => "Mobile And Email Already Exist !");
              $data['getClass'] =  $this->regModel->getClass();
              $this->load->view('website',$data);

           }else{

            $res = $this->regModel->add_tbl_temp_enquiry($arraydata);
            if($res==1){
              $data['error'] = array('error' => "Register Successfully !");
              $data['getClass'] =  $this->regModel->getClass();
              $this->load->view('website',$data);
            }else{
              $data['error'] = array('error' => "Mobile And Email Already Exist !");
              $data['getClass'] =  $this->regModel->getClass();
              $this->load->view('website',$data);
            }

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

          $this->load->view('web_login');

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

           $result = $this->regModel->get_temp_enquiry_data($studentMobile,$studentPass);
            if(!empty($result)){

                $usersession = $this->session->userdata('usersession');
                $fk_monthId = $usersession[0]['studentClass'];
                redirect('website/vedic_dash');
            } else {
               $data['error'] = array('error' => "Mobile Number or Password is wrong !");
               $this->load->view('web_login',$data);
            }
        }

    }else{

      $usersession = $this->session->userdata('usersession');
      $this->load->view('web_login');
    }
}




public function dashobard()
{
      // $dayId,$monthId,$fk_classId

  $usersession = $this->session->userdata('usersession');
   $data['get_day_sessions'] = array();
   $this->load->view('demodashboard',$data);

}


public function logout()
{

      $usersession = $this->session->userdata('usersession');

      if($this->session->userdata('usersession'))
      {
            $data = array('logstatus'=>0);
            $this->db->where('studentEmail',$usersession[0]['studentEmail']);
            $res = $this->db->update('studentreg',$data);
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
           $duration    = $this->input->post('duration');
           $seconds     = $this->input->post('seconds');
           $studId      = $usersession[0]['studId'];
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




}

?>