<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
  		if(isset($_POST['submit']))
      {

            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('studentMobile', 'Student Mobile', 'trim|required|numeric|greater_than[0]|max_length[10]');
            $this->form_validation->set_rules('studentPass', 'Student Password', "trim|required");
            $this->form_validation->set_rules('remember', 'remember', "trim");
            if ($this->form_validation->run() == FALSE)
            {     

                       $this->load->view('login');
            }
            else
            {
                      $studentMobile   = $this->input->post('studentMobile');
                      $studentPass     = $this->input->post('studentPass');
                      $data = array(  
                              'studentMobile'  =>$studentMobile , 
                              'studentPass'    =>sha1($studentPass),
                              );

                     
                      if(!empty($this->input->post("remember"))) {
                        setcookie ("studentMobile", $studentMobile, time()+ (10 * 365 * 24 * 60 * 60));  
                        setcookie ("studentPass", $studentPass,  time()+ (10 * 365 * 24 * 60 * 60));
                      } else {
                        setcookie ("studentMobile",""); 
                        setcookie ("studentPass","");
                      }

                       $result = $this->regModel->check_login_data($data);
                       if($result)
                       {
                           $usercheck   = $result[0]['adminRole'];
                            if($usercheck == 7){
                                $data['check_exist_success'] = array('error' => "Login Successfully !");
                                $this->load->view('login_seo',$data);
                            }else{
                                $data['check_exist_success'] = array('error' => "Login Successfully !");
                                $this->load->view('login',$data);
                            }
                       }else{
                                $data['error'] = array('error' => "you entered wrong password or mobile number !");
                                $this->load->view('login',$data);
                       }
                       
            }
  	}else{

          $this->load->view('login');
    }
}

public function reg()
{

		if(isset($_POST['submit']))
		{

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('studentName', 'Student Full Name', 'trim|required');
          $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim|required|valid_email');
          $this->form_validation->set_rules('studentClass', 'Student Class', 'trim|required');
          $this->form_validation->set_rules('studentGender', 'Student Gender', 'trim|required');
          $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|required|numeric|max_length[10]");
          $this->form_validation->set_rules('studentPass', 'Student Password', "trim|required");
          $this->form_validation->set_rules('refferalCode', 'refferal Code', "trim");
          $this->form_validation->set_rules('studentCPass', 'Student confirm Password', "trim|required|matches[studentPass]");
          $result = array();
          if ($this->form_validation->run() == FALSE)
          {     

           
                     $data['getClass'] =  $this->regModel->getClass();
                     $this->load->view('reg',$data);
          }
          else
          {

          			$studentName     = $this->input->post('studentName');
                    $studentEmail    = $this->input->post('studentEmail');
                    $studentGender   = $this->input->post('studentGender');
                    $studentClass    = $this->input->post('studentClass');
                    $studentMobile   = $this->input->post('studentMobile');
                    $refferalCode    = $this->input->post('refferalCode');
                    $studentPass     = $this->input->post('studentPass');


                    $data = array(	
                    				'studentName' 	   => $studentName , 
                    				'studentEmail' 	   => $studentEmail , 
                    				'studentGender'    => $studentGender , 
                    				'studentClass' 	   => $studentClass , 
                    				'studentMobile'    => $studentMobile , 
                                    'refferalCode'     => $refferalCode , 
                                    'NewrefferalCode'  => "VEDICREF-".rand(111111,999999) , 
                    				'studentPass' 	   => sha1($studentPass),
                    				'OTP' 			   => rand(111111,999999)
                				);

                     
                       $result = $this->regModel->check_reg_data($studentEmail,$studentMobile);
                        if($result==1)
                        {

                            $data['error'] = array('error' => "Email And Mobile Number Already Exist !");
                            $data['getClass'] =  $this->regModel->getClass();
                            $this->load->view('reg',$data);

                        } else {
                             
                          $res = $this->regModel->add_reg($data);
                          if($res==1){

                           $data['getClass'] =  $this->regModel->getClass();
                           $data['error'] = array('error' => "Opt Sent On Your Mobile !");
                           $this->regModel->getClass();
                           redirect('welcome/otp','refresh');

                          }else{
                            $data['error'] = array('error' => "Opt is not Sent On Your Mobile !");
                          	$data['getClass'] =  $this->regModel->getClass();
                              $this->load->view('reg',$data);
                          }
                      }
                    
          }

		}else{
          $data['getClass'] =  $this->regModel->getClass();
	      $this->load->view('reg',$data);
	}
}

  

  public function otp()
  {
     $this->load->view('otp');
  }


  public function verifyotp()
  {
    
      if(isset($_POST['submit']))
      {

          $this->form_validation->set_error_delimiters('<span>', '</span>');                  
          $this->form_validation->set_rules('otp', 'otp Number', 'trim|required');
          $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|required|numeric|max_length[10]");
          $result = array();
          if ($this->form_validation->run() == FALSE)
          {
            $this->load->view('otp');
          }else{

              $studentMobile      = $this->input->post('studentMobile');
              $otp                = $this->input->post('otp');
              $check_exist_number =  $this->regModel->check_exist_number($studentMobile);
              if($check_exist_number==1) {
                  $res = $this->regModel->verifyOTP($studentMobile,$otp);
                  if($res==1){
                    $data['error'] = array('error' => "OTP Is Verify Successfully ! ");
                    $this->load->view('otp',$data);
                  }else{
                    $data['error'] = array('error' => "OTP Is not Verify Successfully ! ");
                    $this->load->view('otp',$data);
                  }
              } else {
                  $data['error'] = array('error' => "Mobile Number Is not Exist !");
                  $this->load->view('otp',$data); 
              }

          }

    }

}


public function resentotp()
{

    $studentMobile = convert_uudecode($this->input->post('studentMobile'));
    $otp =  rand(1111,9999);
    $res = $this->regModel->resentotp($studentMobile,$otp);
    if($res==1){
      echo "1";
    }else {
      echo "0";
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
            $this->session->unset_userdata('usersession');
            $this->session->sess_destroy();
             redirect('welcome','refresh');
      }else{
            redirect('welcome','refresh');
      }
      
}


public function forgetpass()
{
  
  if(isset($_POST['submit']))
      {

          $this->form_validation->set_error_delimiters('<span>', '</span>');                  
          $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|required|numeric|max_length[10]");
          $result = array();
          if ($this->form_validation->run() == FALSE)
          {
            $this->load->view('forgetpass');

          }else{

            $studentMobile = $this->input->post('studentMobile');


          }
      }else{

          $this->load->view('forgetpass');
      }


}

public function checkmobile()
{

    $studentMobile = $this->input->post('studentMobile');
    $res    = $this->regModel->checkmobile($studentMobile);
    if ($res==1) {
          echo "1";
    }else{
          echo "0";
    }

}

  public function updatepass()
  {

    if(isset($_POST['submit']))
      {
          $this->form_validation->set_error_delimiters('<span>', '</span>');                  
          $this->form_validation->set_rules('otp', 'Otp Number', "trim|required");
          $this->form_validation->set_rules('studentMobile', 'studentMobile', "trim|required|numeric|max_length[10]");
          $this->form_validation->set_rules('newpass', 'New Password', "trim|required");
          $this->form_validation->set_rules('cnewpass', 'Confirm Password', "trim|required|matches[newpass]");
          if ($this->form_validation->run() == FALSE)
          {
            $this->load->view('updatepass');

          }else{

            $otp      = $this->input->post('otp');
            $newpass  = $this->input->post('newpass');
            $studentMobile  = $this->input->post('studentMobile');
            $res    = $this->regModel->updatepass($otp,$newpass,$studentMobile);
            if ($res==1) {
                  $data['error'] = array('error' => "Password updated Successfully ! ");
                    $this->load->view('updatepass',$data);
            }else{
                  $data['error'] = array('error' => "Password Is not updated ! ");
                    $this->load->view('updatepass',$data);
            }
          }
      }else{

          $this->load->view('updatepass');
      }


    

  }






































}
?>