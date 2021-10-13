<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Updateinfomation extends REST_Controller 
{


 public function index_post()
  {
      
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
              $adharno            = $this->input->post('adharno');
              $studentReligion    = $this->input->post('studentReligion');
              $studentCaste       = $this->input->post('studentCaste');
              $studentSubcast     = $this->input->post('studentSubcast');
              $preschool          = $this->input->post('preschool');
              $usr_middlename     = $this->input->post('usr_middlename');
              $mothertoungue      = $this->input->post('mothertoungue');
              $usr_dob            = $this->input->post('usr_dob');
              $role               = $this->input->post('role');
              
              if(isset($_FILES) && !empty($_FILES)){
                   $usr_profile        = $_FILES['usr_profile']['name'];
              }
              else
              {
                    $usr_profile        = $this->input->post('old_user_profile');
              }
              
              if(isset($_FILES) && !empty($_FILES)){
                   $dob_certificate        = $_FILES['dob_certificate']['name'];
              }
              else
              {
                    $dob_certificate        = $this->input->post('old_dob_certificate');
              }
              
              

              if($role=="student"){

                $config['upload_path']          = './uploads/studetprofile/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
              }elseif ($role=="father") {
                $config['upload_path']          = './uploads/fatherprofile/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
              }else{
                $config['upload_path']          = './uploads/motherprofile/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
              
              }

              $this->load->library('upload', $config);
              $this->upload->initialize($config);

              if ( ! $this->upload->do_upload('usr_profile'))
              {
                      $data['error'] = array('usr_profile' => $this->upload->display_errors());
                      $data['userinfo'] = $this->regModel->userinfo($studId);
                      $data['userinfo_father'] = $this->regModel->userinfo_father($studId);
                      $data['userinfo_mother'] = $this->regModel->userinfo_mother($studId);
              }
              else
              {
                      $data = array('usr_profile' => $this->upload->data());
                      $usr_profile = $data['usr_profile']['file_name'];
              }

              if($role=="student"){
                if ( ! $this->upload->do_upload('usr_profile'))
                  {
                          $data['error'] = array('usr_profile' => $this->upload->display_errors());
                          $data['userinfo'] = $this->regModel->userinfo($studId);
                          $data['userinfo_father'] = $this->regModel->userinfo_father($studId);
                          $data['userinfo_mother'] = $this->regModel->userinfo_mother($studId);
                  }
                  else
                  {
                          $data = array('usr_profile' => $this->upload->data());
                          $usr_profile = $data['usr_profile']['file_name'];
                  }
                  
                  
                  if ( ! $this->upload->do_upload('dob_certificate'))
                  {
                          $data['error']                = array('dob_certificate' => $this->upload->display_errors());
                          $data['userinfo'] = $this->regModel->userinfo($studId);
                          $data['userinfo_father'] = $this->regModel->userinfo_father($studId);
                          $data['userinfo_mother'] = $this->regModel->userinfo_mother($studId);
                  }
                  else
                  {
                          $data = array('dob_certificate' => $this->upload->data());
                          $dob_certificate = $data['dob_certificate']['file_name'];
                  }
                  
              
              }elseif($role=="father") {
                    if ( ! $this->upload->do_upload('usr_profile'))
                  {
                          $data['error'] = array('usr_profile' => $this->upload->display_errors());
                          $data['userinfo'] = $this->regModel->userinfo($studId);
                          $data['userinfo_father'] = $this->regModel->userinfo_father($studId);
                          $data['userinfo_mother'] = $this->regModel->userinfo_mother($studId);
                  }
                  else
                  {
                          $data = array('usr_profile' => $this->upload->data());
                          $usr_profile = $data['usr_profile']['file_name'];
                  }
              }elseif($role=="mother"){
                if ( ! $this->upload->do_upload('usr_profile'))
                {
                        $data['error'] = array('usr_profile' => $this->upload->display_errors());
                        $data['userinfo'] = $this->regModel->userinfo($studId);
                        $data['userinfo_father'] = $this->regModel->userinfo_father($studId);
                        $data['userinfo_mother'] = $this->regModel->userinfo_mother($studId);
                }
                else
                {
                        $data = array('usr_profile' => $this->upload->data());
                        $usr_profile = $data['usr_profile']['file_name'];
                }
              
              }
              
              if(!empty($dob_certificate)){
                $dob_certificate = $dob_certificate;;
              }else{
                $dob_certificate = $dob_certificate;
              }
              

            $strlenmob   = strlen($usr_mobile_no);
            $strlenadhar = strlen($adharno);
            
    
                
                      $datas =  array(
                                'studentAltMobile' => $usr_mobile_no,
                                'usr_landline'     => $usr_landline,
                                'usr_firstname'    => $usr_firstname,
                                'usr_middlename'   => $usr_middlename,
                                'usr_lastname'     => $usr_lastname,
                                'user_abt_info'    => $user_abt_info,
                                'usr_add1'         => $usr_add1,
                                'usr_add2'         => $usr_add2,
                                'usr_city'         => $usr_city,
                                'usr_state'        => $usr_state,
                                'usr_country'      => $usr_country,
                                'studentEmail'     => $usr_email,
                                'studId'           => $studId,
                                'adharno'          => $adharno,
                                'usr_dob'          => $usr_dob,
                                'studentReligion'  => $studentReligion,
                                'studentCaste'     => $studentCaste,
                                'studentSubcast'   => $studentSubcast,
                                'preschool'        => $preschool,
                                'mothertoungue'    => $mothertoungue,
                                'usr_profile'      => $usr_profile,
                                'dob_certificate'  => $dob_certificate,
                              );
        
                      $res = $this->regModel->updateinfo($datas,$role);
                      if($res==1){
                          $data['error'] = array('error' => "Information Updated Successfully !");
                         
                      }else{
                          $data['error'] = array('error' => "Information Not Updated Successfully !");
                         
                      } 
                      
            
          $this->response($data, REST_Controller::HTTP_OK);
          

}

   



}

?>