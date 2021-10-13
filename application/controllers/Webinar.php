<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webinar extends CI_Controller
{
  

function index(){
    
    if(isset($_POST['submit']))
       {
        
          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('studentMobile', 'studentMobile', 'trim|required|max_length[10]');
          $this->form_validation->set_rules('studentName', 'studentName', 'trim|required');
          $this->form_validation->set_rules('studentEmail', 'studentEmail', 'trim|required|valid_email');
          $this->form_validation->set_rules('studentage', 'studentage', 'trim|required|integer');
          $this->form_validation->set_rules('studentParent', 'studentParent', 'trim|required');

          if ($this->form_validation->run() == FALSE)
          {     
            
              $this->load->view('webinar');
          }
          else
          {
              
              $studentMobile = $this->input->post('studentMobile'); 
              $studentName   = $this->input->post('studentName');
              $studentEmail  = $this->input->post('studentEmail');
              $studentage    = $this->input->post('studentage');
              $studentParent = $this->input->post('studentParent');
              
               $data =  array(
                        'studentMobile'   =>  $studentMobile,
                        'studentName'     =>  $studentName,
                        'studentEmail'    =>  $studentEmail,
                        'studentage'      =>  $studentage,
                        'studentParent'   =>  $studentParent,
                        );
                        
                $result =  $this->webinarModel->checkexist($studentMobile,$studentEmail);       
                if($result==1){
                    $data['error']                = array('error' => "Email or Mobile Number Already Exist ");
                }else{        
                    $res = $this->webinarModel->insertweb($data);        
                     if($res==1){
                    $htmlemail = '<html lang="en"><body><img src="https://www.vedictreeschool.com/assets/website/img/logo.png" alt="Vedic Tree"><p style="padding:10px;font-size:20px;">Hello '.$studentParent.',</p><div style="padding:4%;box-shadow:12px 5px 0px 0px;"><p style="padding:10px;font-size:20px;">Congratulations on your confirmation of our free Webinar. Vedic Tree Kids Learning App would like to appreciate the fact that you are taking time out for your child’s future.</p>
                        <p style="padding:10px;font-size:20px;">Now it is time to make a difference and be a part of your child’s success.</p><p style="padding:10px;font-size:20px;">Our live Webinar will be on 2nd October at 11 AM </p><p style="padding:10px;font-size:20px;">Link for the same will share with you soon on </p>
                        <p style="padding:10px;font-size:20px;">Regards</p><p style="padding:10px;font-size:20px;">Vedic Tree Kids Learning App</p></div></body></html>';
                        $message = trim(ucwords($htmlemail));
                        $htmlContent =  $message;
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->to($studentEmail);
                        $this->email->from('info.vedictree@gmail.com','Vedic Tree School');
                        $this->email->subject('Confirmation Email For Live Webinar');
                        $this->email->message($htmlContent);
                        $result = $this->email->send();
                        
                      $data['error']                = array('error' => "Thank you for register Webinar !");
                   }else{
                      $data['error']                = array('error' => "Oops Information Not Added !");
                   }
                }
               
               $this->load->view('webinar',$data);
              
          }
          
       }else{
           
           $this->load->view('webinar');
       }
    
    
}

public function getWebinardata()
{
    $usersession = $this->session->userdata('usersession');
    if($usersession[0]['adminRole'] == 8 || $usersession[0]['adminRole'] == 7 )
    {
       $data['webinars'] = $this->webinarModel->getwebinardata();
       $this->load->view('getWebinardata', $data);
    }else{
        redirect('welcome');
    }
}


























  
}



?>