<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    
    
   
	public function __construct()
    {
        parent::__construct();
        
        $this->config->load("helperdata");
        $this->selectdemochoice   = $this->config->item('selectdemochoice');
        $usersession = $this->session->userdata('usersession');
        if(empty($usersession)){
            redirect('welcome','refresh');
        }
    }

	public function index()
	{
		
	  $usersession = $this->session->userdata('usersession');
	  

    if($usersession[0]['adminRole']==1 ||$usersession[0]['adminRole']==5 || $usersession[0]['adminRole']==6 || $usersession[0]['adminRole']== 7 || $usersession[0]['adminRole']== 8 || $usersession[0]['adminRole']== 9 || $usersession[0]['adminRole']== 10  ){

      if($this->session->userdata('usersession'))
      {

        $data['count_student']                = $this->regModel->count_student();
        $data['count_session']                = $this->regModel->count_session();
        $data['count_revenue']                = $this->regModel->count_revenue();
        $data['count_category']               = $this->regModel->count_category();
        $data['count_active_student']         = $this->regModel->count_active_student();
        $data['count_inactive_student']       = $this->regModel->count_inactive_student();
        $data['count_session_content']        = $this->regModel->count_session_content();
        $data['count_paid_student']           = $this->regModel->count_paid_student();
        $data['count_partial_paid_student']   = $this->regModel->count_partial_paid_student();
        $data['count_paid_budget']            = $this->regModel->count_paid_budget();
        $data['get_all_month_revenue']        = $this->regModel->get_all_month_revenue();
        $data['get_all_count_male']           = $this->regModel->get_all_count_male();
        $data['get_all_count_female']         = $this->regModel->get_all_count_female();
        $data['get_all_count_discount']       = $this->regModel->get_all_count_discount();
        $data['get_all_count_adjustedAmount'] = $this->regModel->adjustedAmount();
        $data['get_all_count_closeAmount']    = $this->regModel->get_all_count_closeAmount();
        $data['get_all_count_nursery']        = $this->regModel->get_all_count_nursery();
        $data['get_all_count_junior']         = $this->regModel->get_all_count_junior();
        $data['get_all_count_senior']         = $this->regModel->get_all_count_senior();
        

	    $this->load->view('dashboard',$data);
      } else {
      	redirect('welcome');
      }
    }

	}

	public function getstudlist()
	{

	 $usersession = $this->session->userdata('usersession');

     if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

     if(isset($_POST['submit']))
     {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim');
          $this->form_validation->set_rules('fromDT', 'fromDT', "trim");
          $this->form_validation->set_rules('toDT', 'toDT', "trim");
          $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|numeric|max_length[10]");
          $this->form_validation->set_rules('paystatusId', 'paystatusId', "trim|numeric");
          
          $result = array();
          if ($this->form_validation->run() == FALSE)
          {     
              $data['getnoticelist'] = $this->regModel->getnoticelist(); 
              $this->load->view('getstudlist',$data);
          }
          else
          {

              $fromDT         = $this->input->post('fromDT');
              $toDT           = $this->input->post('toDT');
              $studentEmail   = $this->input->post('studentEmail');
              $studentMobile  = $this->input->post('studentMobile');
              $paystatus      = $this->input->post('paystatus');
              $paystatusId    = $this->input->post('paystatusId');
              
              $data = array(  
                      'fromDT'        => $fromDT , 
                      'toDT'          => $toDT , 
                      'studentEmail'  => $studentEmail , 
                      'studentMobile' => $studentMobile , 
                      'paystatus'     => $paystatus , 
                      'paystatusId'   => $paystatusId , 
                  );
              
                $res = $this->regModel->filter_studlist($data);
                if(!empty($res)){
                    
                  $data['error'] = array('error' => "Data Filtered Successfully !");
                  $data['getstudlist'] = $res;
                  $this->load->view('getstudlist',$data);

                }else{
                    $data['error'] = array('error' => "Data not Filtered Successfully !");
                    $data['getstudlist']   = $res;
                    $data['getnoticelist'] = $this->regModel->getnoticelist();
                    $this->load->view('getstudlist',$data);
                }

          }

      } else {

    	   $usersession = $this->session->userdata('usersession');
          if($this->session->userdata('usersession'))
          {
              if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){
                  
              	$data['getClass'] 	 =  $this->regModel->getClass();
              	$data['getstudlist'] = $this->regModel->getstudlist(); 
        		$this->load->view('getstudlist',$data);
              } else {
              	redirect('welcome');
              }
          
         }else{ redirect('welcome'); }
       }

	}
}



 public function not_covert_to_admission()
  {

   $usersession = $this->session->userdata('usersession');

   if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

   if(isset($_POST['submit']))
    {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim');
          $this->form_validation->set_rules('fromDT', 'fromDT', "trim");
          $this->form_validation->set_rules('toDT', 'toDT', "trim");
          $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|numeric|max_length[10]");
          if ($this->form_validation->run() == FALSE)
          {     
              $data['getnoticelist'] = $this->regModel->getstudlist_filter_studlist_not_covert_to_admission(); 
              $this->load->view('not_covert_to_admission',$data);
          }
          else
          {

              $fromDT         = $this->input->post('fromDT');
              $toDT           = $this->input->post('toDT');
              $studentEmail   = $this->input->post('studentEmail');
              $studentMobile  = $this->input->post('studentMobile');
              $paystatus      = $this->input->post('paystatus');
              $paystatusId    = $this->input->post('paystatusId');
              $data           = array(  
                                'fromDT'        => $fromDT , 
                                'toDT'          => $toDT , 
                                'studentEmail'  => $studentEmail , 
                                'studentMobile' => $studentMobile 
                  );
              
                $res = $this->regModel->filter_studlist_not_covert_to_admission($data);
                if(!empty($res)){
                  $data['error']        = array('error' => "Data Filtered Successfully !");
                  $data['getstudlist']  = $res;
                  $this->load->view('not_covert_to_admission',$data);

                }else{
                    $data['error']         = array('error' => "Data not Filtered Successfully !");
                    $data['getstudlist']   = $res;
                    $data['getnoticelist'] = $this->regModel->getstudlist_filter_studlist_not_covert_to_admission();
                    $this->load->view('not_covert_to_admission',$data);
                }

          }

      } else {

         $usersession = $this->session->userdata('usersession');
          if($this->session->userdata('usersession'))
          {
            if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

              $data['getClass']    =  $this->regModel->getClass(); 
              $data['getstudlist'] = $this->regModel->getstudlist_filter_studlist_not_covert_to_admission();
              $this->load->view('not_covert_to_admission',$data);
            } else {
              redirect('welcome');
            }
        }else{
            redirect('welcome');
        }
      }

  }
 }

public function getstudlistina()
  {

   $usersession = $this->session->userdata('usersession');

   if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

   if(isset($_POST['submit']))
    {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim');
          $this->form_validation->set_rules('fromDT', 'fromDT', "trim");
          $this->form_validation->set_rules('toDT', 'toDT', "trim");
          $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|numeric|max_length[10]");
          $this->form_validation->set_rules('paystatus', 'paystatus', "trim|numeric");
          if ($this->form_validation->run() == FALSE)
          {     
              $data['getnoticelist'] = $this->regModel->getnoticelist(); 
              $this->load->view('getstudlistina',$data);
          }
          else
          {

              $fromDT         = $this->input->post('fromDT');
              $toDT           = $this->input->post('toDT');
              $studentEmail   = $this->input->post('studentEmail');
              $studentMobile  = $this->input->post('studentMobile');
              $paystatus      = $this->input->post('paystatus');
              $data = array(  
                      'fromDT'        =>$fromDT , 
                      'toDT'          =>$toDT , 
                      'studentEmail'  =>$studentEmail , 
                      'studentMobile' =>$studentMobile , 
                      'paystatus'     =>$paystatus , 
                  );
              
                $res = $this->regModel->filter_studlist($data);
                if(!empty($res)){
                  $data['error'] = array('error' => "Data Filtered Successfully !");
                  $data['getstudlist'] = $res;
                  $this->load->view('getstudlistina',$data);

                }else{
                    $data['error'] = array('error' => "Data not Filtered Successfully !");
                    $data['getstudlist']   = $res;
                    $data['getnoticelist'] = $this->regModel->getnoticelist();
                    $this->load->view('getstudlistina',$data);
                }

          }

      } else {

         $usersession = $this->session->userdata('usersession');
          if($this->session->userdata('usersession'))
          {
            $data['getClass']    =  $this->regModel->getClass();
            $data['getstudlist'] = $this->regModel->getstudlistina(); 
            $this->load->view('getstudlistina',$data);
          } else {
            redirect('welcome');
          }
      }

  }
}


public function getnoticelist()
{
  
    $usersession = $this->session->userdata('usersession');
  
  if($usersession[0]['adminRole']==1){

      if($this->session->userdata('usersession'))
      {
        $data['getnoticelist'] = $this->regModel->getnoticelist(); 
         $this->load->view('getnoticelist',$data);
      } else {
        redirect('welcome');
      }

  }
}

  public function change_status()
  {
      $usersession = $this->session->userdata('usersession');

     if($usersession[0]['adminRole']==1){

      if($this->session->userdata('usersession'))
      {

             $notId = $this->input->post('notId');
             $status = $this->input->post('status');

             $change_status = $this->regModel->change_status($status,$notId);
             if($change_status==1){
                echo "1";
              }else{
                echo "0";
           }  

      }
    }
     
  }

public function deletestudid()
{
  $usersession = $this->session->userdata('usersession');

	if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('studId', 'studId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['getstudlist'] = $this->regModel->getstudlist(); 
                   $this->load->view('getstudlist',$data);
              }
              else
              {
                $studId     = $this->input->post('studId');
                $result = $this->regModel->deletestudid($studId);
                 if($result==1){
                    $data['error'] = array('error' => "Student Id Deleted Successfully !");
                    $data['getstudlist'] = $this->regModel->getstudlist(); 
                    $this->load->view('getstudlist',$data);
                 }else{
                    $data['error'] = array('error' => "Student Id Not Deleted Successfully !");
                    $data['getstudlist'] = $this->regModel->getstudlist(); 
                    $this->load->view('getstudlist',$data);
                 }
              }         

        }else{  
                  $data['getstudlist'] = $this->regModel->getstudlist(); 
                  $this->load->view('getstudlist',$data);
        }
      }
}



public function deletenotid()
{
  
    $usersession = $this->session->userdata('usersession');

    if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

        if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('notId', 'notId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['getnoticelist'] = $this->regModel->getnoticelist(); 
                   $this->load->view('getnoticelist',$data);
              }
              else
              {
                $notId     = $this->input->post('notId');
                $result = $this->regModel->deletenotid($notId);
                 if($result==1){
                    $data['error'] = array('error' => "Notice Id Deleted Successfully !");
                    $data['getnoticelist'] = $this->regModel->getnoticelist(); 
                    $this->load->view('getnoticelist',$data);
                 }else{
                    $data['error'] = array('error' => "Notice Id Not Deleted Successfully !");
                    $data['getnoticelist'] = $this->regModel->getnoticelist(); 
                    $this->load->view('getnoticelist',$data);
                 }
              }         

        }else{  
                  $data['getnoticelist'] = $this->regModel->getnoticelist(); 
                  $this->load->view('getnoticelist',$data);
        }
    }

}



public function deletecatId()
{
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==5 ){

        if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('catId', 'catId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['list_category'] = $this->regModel->list_category();
                    $this->load->view('addcategory',$data);
              }
              else
              {
                $catId     = $this->input->post('catId');
                $result = $this->regModel->deletecatId($catId);
                 if($result==1){
                    $data['error'] = array('error' => "category Deleted Successfully !");
                    $data['list_category'] = $this->regModel->list_category();
                    $this->load->view('addcategory',$data);
                 }else{
                    $data['error'] = array('error' => "category Not Deleted Successfully !");
                    $data['list_category'] = $this->regModel->list_category();
                    $this->load->view('addcategory',$data);
                 }
              }         

        }else{
                  $data['list_category'] = $this->regModel->list_category();
                  $this->load->view('addcategory',$data);
        }
    }
    
}


public function delesessionId()
{

  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==5){

        if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('sessionId', 'sessionId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['listaddsession'] = $this->regModel->listaddsession(); 
                  $this->load->view('addsession',$data);
              }
              else
              {
                $sessionId     = $this->input->post('sessionId');
                $result = $this->regModel->delesessionId($sessionId);
                 if($result==1){
                  $data['listaddsession'] = $this->regModel->listaddsession(); 
                  $data['error'] = array('error' => "Session Deleted Successfully !");
                  $this->load->view('addsession',$data);
                 }else{
                  $data['listaddsession'] = $this->regModel->listaddsession(); 
                  $data['error'] = array('error' => "Session Not Deleted Successfully !");
                  $this->load->view('addsession',$data);
                 }
              }         

        }else{
                  $data['listaddsession'] = $this->regModel->listaddsession(); 
                  $this->load->view('addsession',$data);
        }
    }
}



public function edit()
{

 $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

	if(isset($_POST['submit']))
		{

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('studentName', 'Student Full Name', 'trim|required');
          $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim|required|valid_email');
          $this->form_validation->set_rules('studId', 'studId', "trim|required|numeric|greater_than[0]");
          $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|required|numeric|max_length[10]");
          $this->form_validation->set_rules('alternate_email', 'Altername Email', "trim|required|valid_email");
          $studId		     = $this->input->post('studId');
          if ($this->form_validation->run() == FALSE)
          {     
			   $data['updatedata'] =  $this->regModel->edit($studId);
               $this->load->view('update',$data);
          }
          else
          {

    		  $studentName     = $this->input->post('studentName');
              $studentEmail    = $this->input->post('studentEmail');
              $studentMobile   = $this->input->post('studentMobile');
              $usr_firstname   = $this->input->post('usr_firstname');
              $usr_lastname    = $this->input->post('usr_lastname');
              $studId		   = $this->input->post('studId');
              $alternate_email = $this->input->post('alternate_email');

              $data = array(	
              				'studentName' 	   => $studentName , 
              				'studentEmail' 	   => $studentEmail , 
              				'studentMobile'    => $studentMobile , 
              				'studId' 		   => $studId , 
                            'usr_firstname'    => $usr_firstname , 
                            'usr_lastname'     => $usr_lastname , 
                            'alternate_email'  => $alternate_email , 
          				);

                $res = $this->regModel->edit_reg($data);
                if($res==1){
                 $data['error']            = array('error' => "Information Updated Successfully !");
    			       $data['updatedata'] =  $this->regModel->edit($studId);
                 $this->load->view('update',$data);
                }else{
                    $data['error']      = array('error' => "Information Is not Updated Successfully !");
      				$data['updatedata'] =  $this->regModel->edit($studId);
                    $this->load->view('update',$data);
                }
                    
          }


		}else{
				$studId             = $this->uri->segment(3);
          		$data['updatedata'] =  $this->regModel->edit($studId);
		        $this->load->view('update',$data);
		}
  }
}

public function notedit()
{

  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ) {

  if(isset($_POST['submit']))
    {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('noticedesc', 'noticedesc', 'trim|required');
          $result = array();
          $notId  = $this->input->post('notId');
          if ($this->form_validation->run() == FALSE)
          {     
               $data['updatedata'] =  $this->regModel->edit_note_id($notId);
               $this->load->view('notedit',$data);
          }
          else
          {

              $noticedesc = $this->input->post('noticedesc');  
              $notId      = $this->input->post('notId');
              $data = array(  
                      'noticedesc' => $noticedesc , 
                      'notId'      => $notId 
              );

              $res = $this->regModel->edit_note($data);
              if($res==1){
                $data['error'] = array('error' => "Notice Updated Successfully !");
                $data['updatedata'] =  $this->regModel->edit_note_id($notId);
                $this->load->view('notedit',$data);

              }else{
                  $data['error'] = array('error' => "Notice Is not Updated Successfully !");
                  $data['updatedata'] =  $this->regModel->edit_note_id($notId);
                  $this->load->view('notedit',$data);
              }
                    
          }


    }else{
              $notedit = $this->uri->segment(3);
              $data['updatedata'] =  $this->regModel->edit_note_id($notedit);
              $this->load->view('notedit',$data);
    }
  }
}



public function notice()
{

$usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

  if(isset($_POST['submit']))
    {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('noticedesc', 'noticedesc', 'trim|required');
          $this->form_validation->set_rules('class_id', 'class name', 'trim|required');
          $result = array();
          if ($this->form_validation->run() == FALSE)
          {     
                     $this->load->view('notice');
          }
          else
          {

                  $noticedesc     = $this->input->post('noticedesc');
                  $class_id     = $this->input->post('class_id');
                  $data = array(  
                            'noticedesc'   =>$noticedesc, 
                            'class_id'     =>$class_id, 
                            'status'       =>1 
                          );
                  $res = $this->regModel->notice($data);
                  if($res==1){
                         $data['error'] = array('error' => "Notice Crerated Successfully !");
                         $this->load->view('notice',$data);
                  }else{
                          $data['error'] = array('error' => "Notice not Crerated Successfully !");
                          $this->load->view('notice',$data);
                  }

          }


    }else{
           $studId = $this->uri->segment(3);
           $data['updatedata'] =  $this->regModel->edit($studId);
           $this->load->view('notice',$data);
    }
  }
   
}


public function videouploading()
{
   
                
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==5 ) {
      
    if(isset($_POST['submit']))
    {
        
       
          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('fk_contentId', 'fk_contentId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|required');
          $this->form_validation->set_rules('content_title', 'content_title', 'trim|required');
          $this->form_validation->set_rules('vimeoId', 'vimeoId', 'trim|numeric');
          $this->form_validation->set_rules('youtubelink', 'youtubelink', 'trim');
          $this->form_validation->set_rules('fk_sessionId', 'fk_sessionId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_monthId', 'monthId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_catId', 'monthId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_dayId', 'dayId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_squenceId', 'squenceId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_upload_key', 'fk_upload_key', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('coursePeriod', 'coursePeriod', 'trim|integer|required');
          $this->form_validation->set_rules('relatedyoutubelink', 'relatedyoutubelink', 'trim');
          $data['param'] = $this->input->post('param');
          if ($this->form_validation->run() == FALSE)
          {     
            
              $data['error'] =  array();
              $this->load->view('videouploading',$data);
          }
          else
          {
              
                $fk_classId         = $this->input->post('fk_classId');
                $content_title      = $this->input->post('content_title');
                $fk_catId           = $this->input->post('fk_catId');
                $fk_contentId       = $this->input->post('fk_contentId');
                $vimeoId            = $this->input->post('vimeoId');
                $youtubelink        = $this->input->post('youtubelink');
                $fk_sessionId       = $this->input->post('fk_sessionId');
                $fk_monthId         = $this->input->post('fk_monthId');
                $fk_dayId           = $this->input->post('fk_dayId');
                $fk_squenceId       = $this->input->post('fk_squenceId');
               
                $relatedyoutubelink = $this->input->post('relatedyoutubelink');
                $fk_upload_key      = $this->input->post('fk_upload_key');
                $coursePeriod       = $this->input->post('coursePeriod');
                if(!empty($_FILES)){
                    $contentfile        = $_FILES['contentfile']['name'];
                }else{
                    $contentfile = "";
                }
                

                $config['upload_path']          = './uploads/contentfile';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|pps|ppsx|ppt|pptx|gz|tgz|zip';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('contentfile'))
                {
                        $data['error'] = array('contentfile' => $this->upload->display_errors());
                        $this->load->view('videouploading', $data);
                }
                else
                {
                        $data = array('contentfile' => $this->upload->data());
                        $contentfile = $data['contentfile']['file_name'];
                }

               
                $videouploadingdata = array(  
                          'fk_classId'            => $fk_classId , 
                          'content_title'         => $content_title , 
                          'fk_catId'              => $fk_catId , 
                          'fk_contentId'          => $fk_contentId, 
                          'vimeoId'               => $vimeoId , 
                          'youtubelink'           => $youtubelink , 
                          'fk_sessionId'          => $fk_sessionId , 
                          'fk_monthId'            => $fk_monthId , 
                          'fk_dayId'              => $fk_dayId, 
                          'contentfile'           => $contentfile, 
                          'fk_squenceId'          => $fk_squenceId, 
                          'fk_upload_key'         => $fk_upload_key, 
                          'coursePeriod'          => $coursePeriod, 
                          'relatedyoutubelink'    => $relatedyoutubelink,
                          
                          'status'                => 1, 
                        );
                        
                        

                $fk_monthId_exist = $this->regModel->fk_monthId_exist($fk_monthId,$fk_dayId,$fk_sessionId,$fk_classId,$fk_upload_key,$coursePeriod);
                if($fk_monthId_exist==1){
                  $data['error'] = array('error' => "Month and Day Or Course Period Id Already Exist !");
                   $this->load->view('videouploading',$data);
                }else{
                  $res = $this->regModel->videouploading($videouploadingdata);
                  if($res==1){
                         $data['error'] = array('error' => "Session Created Successfully !");
                         $this->load->view('videouploading',$data);
                   } else {
                          $data['error'] = array('error' => "Session not Created Successfully !");
                          $this->load->view('videouploading',$data);
                  }
                }

          }


    }else{

            $data['param'] = base64_decode($this->uri->segment(3));
            if(!empty($data['param'])){
                $data['getClass'] = $this->regModel->getClass();
              $this->load->view('videouploading',$data);
            }else{
              $data['error'] =  array();
              $data['getClass'] = $this->regModel->getClass();
              $this->load->view('videouploading',$data);
            }
    }
  }

}





public function generateBarcode()
{
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

    if(isset($_POST['submit']))
      {

            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('fk_contentId', 'fk_contentId', 'trim|required|numeric|greater_than[0]');

            if ($this->form_validation->run() == FALSE)
            {     
                      
                      $this->load->view('generateBarcode');
            }
            else
            {

                  $noticedesc     =  $this->input->post('noticedesc');
                  $data = array(  
                            'noticedesc'   =>$noticedesc , 
                            'status'       =>1 
                          );
                  $res = $this->regModel->generateBarcode($data);
                  if($res==1){
                         $data['error'] = array('error' => "Barcode Created Successfully !");
                         
                         $this->load->view('generateBarcode',$data);
                   } else {
                          $data['error'] = array('error' => "Barcode not Created Successfully !");
                          $this->load->view('generateBarcode',$data);
                  }

            }


      }else{
              $this->load->view('generateBarcode');
      }
  }


}



public function tempenquiry()
{
    $usersession = $this->session->userdata('usersession');
 
  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

    if($this->session->userdata('usersession'))
    {
       $data['getstudlist'] = $this->regModel->getstudlist(); 
       $this->load->view('tempenquiry',$data);
    } else {
      redirect('welcome');
    }
   }

}


public function listvideouploading()
{
  
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 ||$usersession[0]['adminRole']==5 ){

    if(isset($_POST['submit']))
      {

            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('fk_sessionId', 'fk_sessionId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('fk_dayId', 'fk_dayId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('fk_monthId', 'fk_monthId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('vimeoId', 'vimeoId', 'trim|numeric|greater_than[0]|numeric|max_length[9]');
            $this->form_validation->set_rules('fromDT', 'fromDT', 'trim');
            $this->form_validation->set_rules('toDT', 'toDT', 'trim');
             $fk_classId       =  $this->input->post('fk_classId');

            if ($this->form_validation->run() == FALSE)
            {     
                 $data['listvideouploading'] = $this->regModel->listvideouploading($fk_classId);     
                $this->load->view('listvideouploading',$data);
            }
            else
            {

                 
                  $fk_sessionId     =  $this->input->post('fk_sessionId');
                  $fk_dayId         =  $this->input->post('fk_dayId');
                  $fk_monthId       =  $this->input->post('fk_monthId');
                  $vimeoId          =  $this->input->post('vimeoId');
                  $fromDT           =  $this->input->post('fromDT');
                  $toDT             =  $this->input->post('toDT');
                  $data = array(  
                  'fk_classId'     => $fk_classId,
                  'fk_sessionId'   => $fk_sessionId,
                  'fk_dayId'       => $fk_dayId,
                  'fk_monthId'     => $fk_monthId,
                  'vimeoId'        => $vimeoId,
                  'fromDT'         => $fromDT,
                  'toDT'           => $toDT,
                  );
                  $filteredvideouploading = $this->regModel->filteredvideouploading($data);
                  if(!empty($filteredvideouploading)){
                         $data['error'] = array('error' => "Data Filtered Successfully !");
                         $data['listvideouploading'] = $filteredvideouploading;
                         $this->load->view('listvideouploading',$data);
                   } else {
                         $data['listvideouploading'] = $this->regModel->listvideouploading($fk_classId);
                          $data['error'] = array('error' => "Data not Filtered Successfully !");
                          $this->load->view('listvideouploading',$data);
                  }

            }


      }else{
          
            $usersession = $this->session->userdata('usersession');
            if($this->session->userdata('usersession'))
            {

                   $fk_classId = $this->uri->segment(3);
                   
                   $data['listvideouploading'] = $this->regModel->listvideouploading($fk_classId);
                   $data['get_month_data'] = $this->regModel->get_month_data_for_admin($fk_classId); 
                   $data['fk_classId'] = $fk_classId; 
                   $data['recap'] = 2; 
                   $this->load->view('listvideouploading',$data);
            } else {
              redirect('welcome');
            }
          }
      }
}


public function deletevideoId()
{
      $usersession = $this->session->userdata('usersession');
      
     

    if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==5 ) {

        if(isset($_POST['submit']))
        {
            
              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('vidId', 'vidId', "trim|required|numeric|greater_than[0]");
              $this->form_validation->set_rules('fk_monthId', 'monthId', "trim|numeric|required|greater_than[0]");
              $this->form_validation->set_rules('fk_dayId', 'fk_dayId', "trim|numeric|required|greater_than[0]");
              $this->form_validation->set_rules('fk_upload_key', 'fk_upload_key', "trim|numeric|required|greater_than[0]");
              $this->form_validation->set_rules('coursePeriod', 'coursePeriod', "trim|numeric|required");
              
              $fk_classId        = $this->input->post('fk_classId');
              $vidId             = $this->input->post('vidId');
              $fk_monthId        = $this->input->post('fk_monthId');
              $coursePeriod      = $this->input->post('coursePeriod');
              $fk_upload_key     = $this->input->post('fk_upload_key');
              $fk_dayId          = $this->input->post('fk_dayId');
                
              if ($this->form_validation->run() == FALSE)
              {     
                 
                    redirect('dashboard/add_next_to_next_step/'.$fk_classId.'/'.$fk_monthId.'/'.$fk_dayId.'/'.$coursePeriod.'/'.$fk_upload_key);
              }
              else
              {
 
                $result = $this->regModel->deletevideoId($vidId);
                
                 if($result==1){
                    $data['listvideouploading'] = $this->regModel->listvideouploading($fk_classId);
                    $data['error'] = array('error' => "Video Id Deleted Successfully !");
                      redirect('dashboard/add_next_to_next_step/'.$fk_classId.'/'.$fk_monthId.'/'.$fk_dayId.'/'.$coursePeriod.'/'.$fk_upload_key );
                 }else{
                    $data['listvideouploading'] = $this->regModel->listvideouploading($fk_classId);
                    $data['error'] = array('error' => "Video Id Deleted Successfully !");
                    redirect('dashboard/add_next_to_next_step/'.$fk_classId.'/'.$fk_monthId.'/'.$fk_dayId.'/'.$coursePeriod.'/'.$fk_upload_key );
                    
                 }
              }         

        }else{
            $data['listvideouploading'] = $this->regModel->listvideouploading();
            $this->load->view('listvideouploading',$data);
        }
    }

}


public function edit_video()
{
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==5 ){

  if(isset($_POST['submit']))
      {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('fk_contentId', 'fk_contentId', 'trim|numeric|greater_than[0]');
          // $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim');
          $this->form_validation->set_rules('content_title', 'content_title', 'trim');
          $this->form_validation->set_rules('vimeoId', 'vimeoId', 'trim|numeric');
          $this->form_validation->set_rules('youtubelink', 'youtubelink', 'trim');
          $this->form_validation->set_rules('fk_sessionId', 'fk_sessionId', 'trim|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_monthId', 'monthId', 'trim|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_catId', 'monthId', 'trim|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_dayId', 'dayId', 'trim|numeric|greater_than[0]');
          $this->form_validation->set_rules('vidId', 'vidId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_upload_key', 'fk_upload_key', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('coursePeriod', 'coursePeriod', 'trim|numeric');
          $this->form_validation->set_rules('relatedyoutubelink', 'relatedyoutubelink', 'trim');

          $vidId              = $this->input->post('vidId');
          $fk_classId         = $this->input->post('fk_classId');
          if ($this->form_validation->run() == FALSE)
          {     
                    $data['update_videouploading'] = $this->regModel->update_videouploading($vidId);
                    $data['fk_classId'] = $fk_classId;
                    $this->load->view('edit_video',$data);
          }
          else
          {

                $fk_classId         = $this->input->post('fk_classId');
                $content_title      = $this->input->post('content_title');
                $fk_catId           = $this->input->post('fk_catId');
                $fk_contentId       = $this->input->post('fk_contentId');
                $vimeoId            = $this->input->post('vimeoId');
                $youtubelink        = $this->input->post('youtubelink');
                $fk_sessionId       = $this->input->post('fk_sessionId');
                $fk_monthId         = $this->input->post('fk_monthId');
                $fk_dayId           = $this->input->post('fk_dayId');
                $fk_squenceId       = $this->input->post('fk_squenceId');
                $relatedyoutubelink = $this->input->post('relatedyoutubelink');
                $fk_upload_key      = $this->input->post('fk_upload_key');
                $coursePeriod       = $this->input->post('coursePeriod');
                if(!empty($_FILES)){
                    $contentfile        = $_FILES['contentfile']['name'];
                }else{
                    $contentfile = "";
                }

                $config['upload_path']          = './uploads/contentfile';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|pps|ppsx|ppt|pptx|gz|tgz|zip';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('contentfile'))
                {
                        $data['error'] = array('contentfile' => $this->upload->display_errors());
                        $data['update_videouploading'] = $this->regModel->update_videouploading($vidId);
                        $this->load->view('edit_video', $data);
                }
                else
                {
                        $data = array('contentfile' => $this->upload->data());
                        $contentfile = $data['contentfile']['file_name'];
                }

               
                $videouploadingdata = array(  
                          'fk_classId'          => $fk_classId , 
                          'content_title'       => $content_title , 
                          'fk_catId'            => $fk_catId , 
                          'fk_contentId'        => $fk_contentId, 
                          'vimeoId'             => $vimeoId , 
                          'youtubelink'         => $youtubelink , 
                          'fk_sessionId'        => $fk_sessionId , 
                          'fk_monthId'          => $fk_monthId , 
                          'fk_dayId'            => $fk_dayId, 
                          'contentfile'         => $contentfile,
                          'relatedyoutubelink'  => $relatedyoutubelink,
                          'fk_squenceId'        => $fk_squenceId, 
                          'fk_upload_key'       => $fk_upload_key, 
                          'coursePeriod'        => $coursePeriod, 
                          'vidId'               => $vidId, 
                          'status'              => 1 
                        );

                  $filteredvideouploading = $this->regModel->update_filteredvideouploading($videouploadingdata);

                  if($filteredvideouploading==1){
                         $data['error'] = array('error' => "Data Updated Successfully !");
                         $data['update_videouploading'] = $this->regModel->update_videouploading($vidId);
                         redirect('dashboard/add_next_to_next_step/'.$fk_classId.'/'.$fk_monthId.'/'.$fk_dayId.'/'.$coursePeriod.'/'.$fk_upload_key);
                   } else {
                          $data['update_videouploading'] = $this->regModel->update_videouploading($vidId);
                          $data['error'] = array('error' => "Data not Updated Successfully !");
                          $data['fk_classId'] = $fk_classId;
                          $this->load->view('edit_video',$data);
                  }

            }


      }else{
          
            $usersession = $this->session->userdata('usersession');    
            if($this->session->userdata('usersession'))
            {
                $vidId = $this->uri->segment(3);
                $fk_classId = $this->uri->segment(4);
                $data['update_videouploading'] = $this->regModel->update_videouploading($vidId); 
                $data['fk_classId'] = $fk_classId; 
                $this->load->view('edit_video',$data);
            } else {
              redirect('welcome');
            }
          }
    }

}


public function addcategory()
{
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==5 ) {
  if(isset($_POST['submit']))
      {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('catName', 'catName', 'trim|required');          

          $catName         = $this->input->post('catName');
          if ($this->form_validation->run() == FALSE)
          {     
                  $data['list_category'] = $this->regModel->list_category();
                  $this->load->view('addcategory',$data);
          }
          else
          {

                  $catName = $this->input->post('catName');
                  $addcategory = array('catName'=>$catName);
                  $res = $this->regModel->addcategory($addcategory);
                  if($res==1){

                           $data['error'] = array('error' => "category Added Successfully !");
                           $data['list_category'] = $this->regModel->list_category(); 
                           $this->load->view('addcategory',$data);
                         
                   } else { 

                          $data['list_category'] = $this->regModel->list_category(); 
                          $data['error'] = array('error' => "category not Added Successfully !");
                          $this->load->view('addcategory',$data);
                  }

            }


      }else{
          
            $usersession = $this->session->userdata('usersession');    
            if($this->session->userdata('usersession'))
            {
                $data['list_category'] = $this->regModel->list_category(); 
                $this->load->view('addcategory',$data);
            } else {
              redirect('welcome');
            }
          }
    }
          
}



public function addsession()
{

  $usersession = $this->session->userdata('usersession');
  
  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==5 )  {

  if(isset($_POST['submit']))
      {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('sessionName', 'sessionName', 'trim|required');          

          if ($this->form_validation->run() == FALSE)
          {     
                    $data['listaddsession'] = $this->regModel->listaddsession();
                    $this->load->view('addsession',$data);
          }
          else
          {

                $sessionName = $this->input->post('sessionName');
                $addsession = array('sessionName'=>$sessionName);
                  $res = $this->regModel->addsession($addsession);
                  if($res==1){
                         $data['error'] = array('error' => "Session Added Successfully !");
                         $data['listaddsession'] = $this->regModel->listaddsession(); 
                          $this->load->view('addsession',$data);
                         
                   } else {
                          $data['listaddsession'] = $this->regModel->listaddsession(); 
                          $data['error'] = array('error' => "Session not Added Successfully !");
                          $this->load->view('addsession',$data);
                  }
            }
      }else{
          
            $usersession = $this->session->userdata('usersession');    
            if($this->session->userdata('usersession'))
            {
                $data['listaddsession'] = $this->regModel->listaddsession(); 
                $this->load->view('addsession',$data);
            } else {
              redirect('welcome');
            }
          }
  }
          

}

public function days()
{
  
    $usersession = $this->session->userdata('usersession');    
    if($this->session->userdata('usersession'))
    {
        $monthId                = $this->uri->segment(3);
        $class_id               = $this->uri->segment(4);
        $recap                  = $this->uri->segment(5);
        $data['monthId']        = $monthId; 
        $data['class_id']       = $class_id;
        $data['recap']          = $recap;  
        $coursePeriod           = "";
        $data['get_month_data'] = $this->regModel->get_month_data($monthId,$class_id,$coursePeriod); 
        $this->load->view('days',$data);
    } else {
      redirect('welcome');
    }
  
      
}


public function dayscourse()
{
  
    $usersession = $this->session->userdata('usersession');    
    if($this->session->userdata('usersession'))
    {
        $monthId                = $this->uri->segment(3);
        $class_id               = $this->uri->segment(4);
        $coursePeriod           = $this->uri->segment(5);
        $data['monthId']        = $monthId; 
        $data['class_id']       = $class_id;
        $data['recap']          = "";
        $data['coursePeriod']   = $coursePeriod;  
        $data['get_month_data'] = $this->regModel->get_month_data($monthId,$class_id,$coursePeriod); 
        $this->load->view('days',$data);
    } else {
      redirect('welcome');
    }
  
      
}


public function get_day_sessions()
{
   
   $usersession = $this->session->userdata('usersession');    
    if($this->session->userdata('usersession'))
    {
        $dayId                    = $this->uri->segment(3);
        $monthId                  = $this->uri->segment(4);
        $fk_classId               = $this->uri->segment(5);
        $studId                   = "";
        $data['get_day_sessions'] = $this->regModel->get_day_sessions($dayId,$monthId,$fk_classId,$studId); 
        $data['dayId']            = $dayId; 
        $data['monthId']          = $monthId; 
        $this->load->view('get_day_sessions',$data);
    } else {
      redirect('welcome');
    }
  

}


public function get_day_sessions_recap()
{
   
   $usersession = $this->session->userdata('usersession');    
    if($this->session->userdata('usersession'))
    {
        $dayId                    = $this->uri->segment(3);
        $monthId                  = $this->uri->segment(4);
        $fk_classId               = $this->uri->segment(5);
        $recap                    = $this->uri->segment(6);
        $studId                   = "";
        $coursePeriod             = "";
        $data['get_day_sessions'] = $this->regModel->get_day_sessions_recap($dayId,$monthId,$fk_classId,$studId,$recap,$coursePeriod); 
        $data['dayId']            = $dayId; 
        $data['monthId']          = $monthId; 
        $this->load->view('get_day_sessions',$data);
    } else {
      redirect('welcome');
    }
}


public function classroom()
{

  if($this->session->userdata('usersession'))
    {
       $data['getClass'] = $this->regModel->getClass();
       $data['recap'] = 2;
       $this->load->view('classroom',$data);
    } else {
      redirect('welcome');
    }


}


public function add_fees()
{
$usersession = $this->session->userdata('usersession');
  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

   if(isset($_POST['submit']))
      {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('school_fees', 'school fees', 'trim|required|integer');          
          $this->form_validation->set_rules('book_fees', 'book fees', 'trim|required|integer');          
          $this->form_validation->set_rules('final_fees', 'Final fees', 'trim|required|integer');          
          $this->form_validation->set_rules('packageName', 'package Name ', 'trim|required');          
          $this->form_validation->set_rules('fk_discount', 'discount', 'trim|required|greater_than[0]');          
          $this->form_validation->set_rules('fk_classId[]', 'fk_classId', 'trim|required');          
          $this->form_validation->set_rules('coursePeriod', 'coursePeriod', 'trim|required|greater_than[0]');          

          if ($this->form_validation->run() == FALSE)
          {     
                  $data['list_Fees'] = $this->regModel->list_Fees();
                  $data['getpackage'] = $this->regModel->getpackage();
                  $this->load->view('add_fees',$data);
          }
          else
          {

                  $school_fees   = $this->input->post('school_fees');
                  $book_fees     = $this->input->post('book_fees');
                  $final_fees    = $this->input->post('final_fees');
                  $packageName   = $this->input->post('packageName');
                  $fk_discount   = $this->input->post('fk_discount');
                  $fk_classId    = $this->input->post('fk_classId');
                  $coursePeriod  = $this->input->post('coursePeriod');
                  $minusfees     = $final_fees - $book_fees ;    
                
                
                  $alreadpackageName = $this->regModel->alreadpackageName($packageName,$fk_classId);
                  
                 
                  if($alreadpackageName==1){
                     $data['error'] = array('error' => "Package Name Already Exist !");
                     $data['list_Fees'] = $this->regModel->list_Fees(); 
                     $data['getpackage'] = $this->regModel->getpackage();
                     $this->load->view('add_fees',$data);

                  }else{
                      
                      
                  $countfk_classId = count($fk_classId);
                      $res = "";
                      for($i=0 ; $i < $countfk_classId ; $i++)
                      {
                          if(isset($i))
                          {
                              $add_fees_data = array(
                                'book_fees'     => $book_fees,
                                'school_fees'   => $school_fees,
                                'fk_discount'   => $fk_discount,
                                'packageName'   => $packageName,
                                'coursePeriod'  => $coursePeriod,
                                'monthly_fees'  => $minusfees / $coursePeriod,
                                'fk_classId'    => $fk_classId[$i],
                                'final_fees'    => $final_fees
                              );
                             
                            $res = $this->regModel->add_fees_data($add_fees_data);
                          }
                    
                      }
                     
                    if($res==1){

                             $data['error'] = array('error' => "Fees Added Successfully !");
                             $data['list_Fees'] = $this->regModel->list_Fees(); 
                             $data['getpackage'] = $this->regModel->getpackage();
                             $this->load->view('add_fees',$data);
                           
                     } else { 

                            $data['list_Fees'] = $this->regModel->list_Fees(); 
                            $data['error'] = array('error' => "Fees not Added Successfully !");
                            $data['getpackage'] = $this->regModel->getpackage();
                            $this->load->view('add_fees',$data);
                    }
                  }

            }


      }else{
          
            $usersession = $this->session->userdata('usersession');    
            if($this->session->userdata('usersession'))
            {
                $data['list_Fees'] = $this->regModel->list_Fees();
                $data['getpackage'] = $this->regModel->getpackage();
                $this->load->view('add_fees',$data);
            } else {
              redirect('welcome');
            }
          }
    }
}



public function deletefeesId()
{
  $usersession = $this->session->userdata('usersession');
  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

       $usersession = $this->session->userdata('usersession');
        if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('feesId', 'feesId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['list_Fees'] = $this->regModel->list_Fees();
                   $this->load->view('add_fees',$data);
              }
              else
              {
                $feesId     = $this->input->post('feesId');
                $result = $this->regModel->deletefeesId($feesId);
                 if($result==1){
                    $data['error'] = array('error' => "Fees Id Deleted Successfully !");
                    $data['list_Fees'] = $this->regModel->list_Fees(); 
                    $this->load->view('add_fees',$data);
                 }else{
                    $data['error'] = array('error' => "Fees Id Not Deleted Successfully !");
                    $data['list_Fees'] = $this->regModel->list_Fees(); 
                    $this->load->view('add_fees',$data);
                 }
              }         

        }else{  
                  $data['list_Fees'] = $this->regModel->list_Fees(); 
                  $this->load->view('add_fees',$data);
        }
    }


}











////////Zoom Integration/////////////////////////////


public function add_class()
    {
$usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

      $usersession = $this->session->userdata('usersession');
        if(isset($_POST['submit']))
        {

        $response = array();
        $this->form_validation->set_rules('title', 'class_title', 'trim|xss_clean');
        $this->form_validation->set_rules('date', 'class_date', 'trim|xss_clean');
        $this->form_validation->set_rules('class_id', 'class', 'trim|xss_clean');
        $this->form_validation->set_rules('host_video', 'host_video', 'trim|xss_clean');
        $this->form_validation->set_rules('client_video', 'client_video', 'trim|xss_clean');
    
        $this->form_validation->set_rules('duration', 'class_duration_minutes', 'trim|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('add_class');
        } else {

            
                $params = array(
                    'zoom_api_key'    => "_ieBCVWtQqCYAN7jAqWEGg",
                    'zoom_api_secret' => "HlWQPIr6b6n2EqFm5e3VlqSkUlaqpT1OGYPS",
                );
            
         
            $this->load->library('zoom_api', $params);

           
            $timezone = "Asia/Kolkata";
            date_default_timezone_set($timezone);

            $insert_array = array(
                'staff_id'     => "1",
                'title'        => "Test",
                'date'         => "2021/12/21 12:45:45",
                'class_id'     => "1",
                'duration'     => "45",
                'password'     => '123456',
                'api_type'     => 'global',
                'host_video'   => "1",//1 or 2 enable or disable
                'description'  => "TEsting",
                'timezone'     => $timezone
            );

            $response = $this->zoom_api->createAMeeting($insert_array);

            if ($response) {
                if (isset($response->id)) {
                    $insert_array['return_response'] = json_encode($response);
                    $this->regModel->add_class($insert_array);
                    $sender_details = array('class_id' => "1", 'title' => "TEsting", 'date' => "2021/12/21 12:45:45", 'duration' => "45");
                    
                    $this->mailsmsconf->mailsms('online_classes', $sender_details);
                    $response = array('status' => 1, 'message' => "Successfully Send");
                } else {
                    $response = array('status' => 0, 'error' => array($response->message));
                }
            } else {
                $response = array('status' => 0, 'error' => array('Something went wrong.'));
            }
            echo "<pre>";
            print_r($response);
        }

       
    }else{
      $this->load->view('add_class');
    }

    }

    }


public function list_of_education()
{
$usersession = $this->session->userdata('usersession');
  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==5) {
    if($this->session->userdata('usersession'))
      {
         $fk_classId  = $this->uri->segment(3);
         $param       = 'valubasededucation';
         $data['list_of_education'] = $this->regModel->list_of_education($fk_classId,$param);
         $this->load->view('list_of_education',$data);
      } else {
        redirect('welcome');
      }
    }

}


public function classroom_for_edu()
{
   if($this->session->userdata('usersession'))
    {
       $data['getClass'] = $this->regModel->getClass();
       $this->load->view('classroom_for_edu',$data);
    } else {
      redirect('welcome');
    }
}


public function emi()
{
  $usersession = $this->session->userdata('usersession');
  if($this->session->userdata('usersession'))
  {
       $data['emi'] = $this->regModel->getemiByClass($usersession[0]['studId']);
       $this->load->view('emi',$data);
  } else {
      redirect('welcome');
  } 

}



public function assign_student()
{
    
        $usersession = $this->session->userdata('usersession');
          if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 )
          {
             $usersession = $this->session->userdata('usersession');
              if(isset($_POST['submit']))
              {
                  $this->form_validation->set_error_delimiters('<span>', '</span>');
                  $allocate = $this->input->post('allocate');
                  $fk_date  = $this->input->post('fk_date');
                  $batchId  = $this->input->post('batchId');

                  if($allocate=="allocate"){

                    $this->form_validation->set_rules('fk_classId', 'Class Name', 'trim|required');
                    $this->form_validation->set_rules('fk_teachId', 'Teacher Name', 'trim|required');
                    $this->form_validation->set_rules('fk_feesId', 'Sub Class Name', 'trim|required');

                  }elseif ($allocate=="search") {
                    
                    $this->form_validation->set_rules('fk_search_classId', 'Class Name', 'trim|required');
                    $this->form_validation->set_rules('fk_search_teachId', 'Teacher Name', 'trim|required');
                    $this->form_validation->set_rules('fk_search_sub_teachId', 'Sub Class Name', 'trim|required');
                  }
                 
                  if ($this->form_validation->run() == false) {

                        $data['assign_student']        =  $this->regModel->getstudlist();
                        $data['getClass']              =  $this->regModel->getClass();
                        $data['getTeacher']            =  $this->regModel->getTeacher();
                        $data['batch']                 =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();

                        $this->load->view('assign_student',$data);

                  } else {


                  
                      if($allocate=="allocate") {

                            $fk_classId = $this->input->post('fk_classId');
                            $fk_teachId = $this->input->post('fk_teachId');
                            $fk_feesId  = $this->input->post('fk_feesId');
                            $fk_date    = $this->input->post('fk_date');
                            $batchId    = $this->input->post('batchId');

                            $count_student_assign_teacher = $this->allocatemodel->tbl_allocate_teacher_to_student_count($fk_feesId,$fk_classId,$fk_teachId,$batchId);
                            $tbl_allocate_teacher_to_student_count = count($count_student_assign_teacher);
                             if( $tbl_allocate_teacher_to_student_count>=16 || $tbl_allocate_teacher_to_student_count>=30 || $tbl_allocate_teacher_to_student_count>=35 ){
                                $data['assign_student']        =  $this->allocatemodel->allocate_student_search_without_filter();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['error'] = array('error' => "Batch Size is fulled to this Teacher");
                                $this->load->view('assign_student',$data);

                            }else{

                              $res   = $this->allocatemodel->allocate_student($fk_classId,$fk_teachId,$fk_feesId,$fk_date,$batchId);

                              if($res==1){

                                $data['assign_student']        =  $this->allocatemodel->allocate_student_search_without_filter();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();

                                $data['error'] = array('error' => "Allocated Student Successfully !");
                                $this->load->view('assign_student',$data);

                              }else{

                                $data['assign_student']        =  $this->allocatemodel->allocate_student_search_without_filter();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();
                                $data['error'] = array('error' => "Not Allocated Student Successfully !");
                                $this->load->view('assign_student',$data);


                              }
                            }


                        } elseif ($allocate=="search") {

                            $fk_search_classId     = $this->input->post('fk_search_classId');
                            $fk_search_teachId     = $this->input->post('fk_search_teachId');
                            $fk_search_sub_teachId = $this->input->post('fk_search_sub_teachId');
                            $fk_date               = $this->input->post('fk_date');


                            $res   = $this->allocatemodel->allocate_student_search($fk_search_classId,$fk_search_teachId,$fk_search_sub_teachId,$fk_date);
                            if(!empty($res)){

                              $data['assign_student']        =  $res;
                              $data['getClass']              =  $this->regModel->getClass();
                              $data['getTeacher']            =  $this->regModel->getTeacher();
                              $data['batch']                 =  $this->regModel->getBatch();
                              $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();
                              $data['error'] = array('error' => " Data Filtered Successfully !");
                              $this->load->view('assign_student',$data);

                            }else{

                              $data['assign_student']        =  $res;
                              $data['getClass']              =  $this->regModel->getClass();
                              $data['getTeacher']            =  $this->regModel->getTeacher();
                              $data['batch']                 =  $this->regModel->getBatch();
                              $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();
                              $data['error'] = array('error' => "Data Not Filtered !");
                              $this->load->view('assign_student',$data);


                            }
                      
                     }


                  }

                }else{


                  $usersession = $this->session->userdata('usersession');

                  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ) {

                  if($this->session->userdata('usersession'))
                  {
                        $data['assign_student']      =   $this->allocatemodel->allocate_student_search_without_filter();
                        $data['getClass']            =  $this->regModel->getClass();
                        $data['getTeacher']          =  $this->regModel->getTeacher();
                        $data['batch']               =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']   =  $this->regModel->tab_add_fees_data();

                        $this->load->view('assign_student',$data);


                  } else {
                      redirect('welcome');
                  } 
              }
           }
        }

}

public function get_temp_enquiry()
{
  
        $usersession = $this->session->userdata('usersession');
          if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 || $usersession[0]['adminRole']==10 )
          {
            
            if(isset($_POST['submit'])){
               $this->form_validation->set_error_delimiters('<span>', '</span>');
               $this->form_validation->set_rules('studentName', 'studentName', 'trim');
               $this->form_validation->set_rules('studentEmail', 'studentEmail', 'trim|valid_email');
               $this->form_validation->set_rules('studentMobile', 'studentMobile', 'trim|integer|exact_length[10]');

                if ($this->form_validation->run() == false) {
                      $data['get_temp_enquiry'] = $this->regModel->get_temp_enquiry();
                        $this->load->view('get_temp_enquiry',$data);

                  } else {

                        $studentName   = $this->input->post('studentName'); 
                        $studentEmail  = $this->input->post('studentEmail');
                        $studentMobile = $this->input->post('studentMobile');
                        $data['get_temp_enquiry'] = $this->regModel->get_temp_enquiry_filter($studentName,$studentMobile,$studentEmail);
                        $this->load->view('get_temp_enquiry',$data);   
                  }

            }else{

                    $data['get_temp_enquiry'] = $this->regModel->get_temp_enquiry();
                    $data['selectdemochoice'] = $this->selectdemochoice;
                    $this->load->view('get_temp_enquiry',$data);       
            }

          } else {
            redirect(base_url('admin'));
          }
}






public function finaladmission()
  {

   $usersession = $this->session->userdata('usersession');

   if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

   if(isset($_POST['submit']))
    {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim');
          $this->form_validation->set_rules('fromDT', 'fromDT', "trim");
          $this->form_validation->set_rules('toDT', 'toDT', "trim");
          $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|numeric|max_length[10]");
          $this->form_validation->set_rules('paystatus', 'paystatus', "trim|numeric");
          $result = array();
          if ($this->form_validation->run() == FALSE)
          {     
              $data['getnoticelist'] = $this->regModel->getnoticelist(); 
              $this->load->view('finaladmission',$data);
          }
          else
          {

              $fromDT         = $this->input->post('fromDT');
              $toDT           = $this->input->post('toDT');
              $studentEmail   = $this->input->post('studentEmail');
              $studentMobile  = $this->input->post('studentMobile');
              $paystatus      = $this->input->post('paystatus');
              $data = array(  
                      'fromDT'        =>$fromDT , 
                      'toDT'          =>$toDT , 
                      'studentEmail'  =>$studentEmail , 
                      'studentMobile' =>$studentMobile , 
                      'paystatus'     =>$paystatus , 
                  );
              
                $res = $this->regModel->filter_studlist_final($data);
                if(!empty($res)){
                  $data['error'] = array('error' => "Data Filtered Successfully !");
                  $data['getstudlist'] = $res;
                  $this->load->view('finaladmission',$data);

                }else{
                    $data['error'] = array('error' => "Data not Filtered Successfully !");
                    $data['getstudlist']   = $res;
                    $data['getnoticelist'] = $this->regModel->getstudlist_final();
                    $this->load->view('finaladmission',$data);
                }

          }

      } else {

         $usersession = $this->session->userdata('usersession');
          if($this->session->userdata('usersession'))
          {
            $data['getClass']    =  $this->regModel->getClass();
            $data['getstudlist'] = $this->regModel->getstudlist_final(); 
            $this->load->view('finaladmission',$data);
          } else {
            redirect('welcome');
          }
      }

  }
}


public function downwebsite()
{

        $usersession = $this->session->userdata('usersession');
          if($this->session->userdata('usersession'))
          {
            if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

                $webstatus = $this->input->post('webstatus');
                $res = $this->regModel->updatestatuswebdown($webstatus);
                if($res==1){
                  echo "1";
                }else{
                  echo "0";
                }
           }else{
            redirect(base_url());
       }
    }
  
      
}

public function setemi()
{
  
  $usersession = $this->session->userdata('usersession');
  if($this->session->userdata('usersession'))
  {
    if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 )
    {

        if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('final_fees', 'final_fees', 'trim|required|integer');
              $this->form_validation->set_rules('emipercentage', 'emipercentage', "trim|required|integer");
              $this->form_validation->set_rules('emicharges', 'emicharges', "trim|required|integer");
              $this->form_validation->set_rules('monthlyFess', 'monthlyFess', "trim|numeric|required");
              $this->form_validation->set_rules('fk_feesId', 'fk_feesId', "trim|numeric|required");
              $this->form_validation->set_rules('fk_classId', 'fk_classId', "trim|numeric|required");
              $this->form_validation->set_rules('fk_tid', 'fk_tid', "trim|numeric|required");
              if ($this->form_validation->run() == FALSE)
              {     
                  $data['tab_add_fees_data'] = $this->regModel->tab_add_fees_data(); 
                  $data['tbl_tenure']        = $this->regModel->tbl_tenure(); 
                  $data['getemi']            = $this->regModel->getemi(); 
                  $data['getnoticelist']     = $this->regModel->getnoticelist(); 
                  $this->load->view('setemi',$data);
              }
              else
              {

                $final_fees     = $this->input->post('final_fees');
                $emipercentage  = $this->input->post('emipercentage');
                $emicharges     = $this->input->post('emicharges');
                $monthlyFess    = $this->input->post('monthlyFess');
                $fk_feesId      = $this->input->post('fk_feesId');
                $fk_classId     = $this->input->post('fk_classId');
                $fk_tid         = $this->input->post('fk_tid');

                $arraydata = array(

                  'final_fees_emi'=> $final_fees,
                  'emipercentage' => $emipercentage,
                  'emicharges'    => $emicharges,
                  'monthlyFess'   => $monthlyFess,
                  'fk_classId'    => $fk_classId,
                  'fk_tid'        => $fk_tid,
                  'fk_feesId'     => $fk_feesId
                );

                $res = $this->regModel->setemi($arraydata);
                if($res==1){

                  $data['getemi']             = $this->regModel->getemi(); 
                  $data['tab_add_fees_data']  = $this->regModel->tab_add_fees_data(); 
                  $data['tbl_tenure']         = $this->regModel->tbl_tenure(); 
                  $data['getnoticelist']      = $this->regModel->getnoticelist(); 
                  $data['error']              = array('error' => "Emi Added Successfully!");
                  $this->load->view('setemi',$data);

                }else{

                  $data['getemi'] = $this->regModel->getemi(); 
                  $data['tab_add_fees_data'] = $this->regModel->tab_add_fees_data(); 
                  $data['tbl_tenure'] = $this->regModel->tbl_tenure(); 
                  $data['error'] = array('error' => "Emi Not Added Successfully Or Already Exist !");
                  $data['getnoticelist'] = $this->regModel->getnoticelist(); 
                  $this->load->view('setemi',$data);

                }

              }

          }else{
                   $data['getemi'] = $this->regModel->getemi(); 
                   $data['tab_add_fees_data'] = $this->regModel->tab_add_fees_data();
                   $data['tbl_tenure'] = $this->regModel->tbl_tenure();
                   $data['getnoticelist'] = $this->regModel->getnoticelist(); 
                   $this->load->view('setemi',$data);
          }

   }else{
    redirect(base_url('admin'));
   }
  }else{
    redirect(base_url('admin'));
  }
  

}



public function deleteemifeesId()
{
  
  $usersession = $this->session->userdata('usersession');
  if($this->session->userdata('usersession'))
  {
    if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 )
    {
        if(isset($_POST['submit']))
        {

          

          $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('emi_Id', 'emi_Id', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['getemi'] = $this->regModel->getemi(); 
                   $data['tab_add_fees_data'] = $this->regModel->tab_add_fees_data();
                   $data['tbl_tenure'] = $this->regModel->tbl_tenure();
                   $data['getnoticelist'] = $this->regModel->getnoticelist(); 
                   $this->load->view('setemi',$data);
              }
              else
              {
                $emi_Id     = $this->input->post('emi_Id');
                $result = $this->regModel->deleteemifeesId($emi_Id);
                 if($result==1){
                    $data['error'] = array('error' => "Emi Id Deleted Successfully !");
                     $data['getemi'] = $this->regModel->getemi(); 
                     $data['tab_add_fees_data'] = $this->regModel->tab_add_fees_data();
                     $data['tbl_tenure'] = $this->regModel->tbl_tenure();
                     $data['getnoticelist'] = $this->regModel->getnoticelist(); 
                     $this->load->view('setemi',$data);
                 }else{
                     $data['error'] = array('error' => "Emi Id Not Deleted Successfully !");
                     $data['getemi'] = $this->regModel->getemi(); 
                     $data['tab_add_fees_data'] = $this->regModel->tab_add_fees_data();
                     $data['tbl_tenure'] = $this->regModel->tbl_tenure();
                     $data['getnoticelist'] = $this->regModel->getnoticelist(); 
                     $this->load->view('setemi',$data);
                 }
              }     

      }else{
                   $data['getemi'] = $this->regModel->getemi(); 
                   $data['tab_add_fees_data'] = $this->regModel->tab_add_fees_data();
                   $data['tbl_tenure'] = $this->regModel->tbl_tenure();
                   $data['getnoticelist'] = $this->regModel->getnoticelist(); 
                   $this->load->view('setemi',$data);
     }
  }else{
    redirect(base_url('admin'));
  }

 }else{
    redirect(base_url('admin'));
 }

}


public function list_of_demo()
{
  
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 ||$usersession[0]['adminRole']==5 ){

    if(isset($_POST['submit']))
      {

            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('fk_sessionId', 'fk_sessionId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('fk_dayId', 'fk_dayId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('fk_monthId', 'fk_monthId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('vimeoId', 'vimeoId', 'trim|numeric|greater_than[0]|numeric|max_length[9]');
            $this->form_validation->set_rules('fromDT', 'fromDT', 'trim');
            $this->form_validation->set_rules('toDT', 'toDT', 'trim');
             $fk_classId       =  $this->input->post('fk_classId');

            if ($this->form_validation->run() == FALSE)
            {     
                $data['listvideouploading'] = $this->regModel->listvideouploading_demo($fk_classId);     
                $this->load->view('listvideouploading',$data);
            }
            else
            {

                 
                  $fk_sessionId     =  $this->input->post('fk_sessionId');
                  $fk_dayId         =  $this->input->post('fk_dayId');
                  $fk_monthId       =  $this->input->post('fk_monthId');
                  $vimeoId          =  $this->input->post('vimeoId');
                  $fromDT           =  $this->input->post('fromDT');
                  $toDT             =  $this->input->post('toDT');
                  $data = array(  
                  'fk_classId'     => $fk_classId,
                  'fk_sessionId'   => $fk_sessionId,
                  'fk_dayId'       => $fk_dayId,
                  'fk_monthId'     => $fk_monthId,
                  'vimeoId'        => $vimeoId,
                  'fromDT'         => $fromDT,
                  'toDT'           => $toDT,
                  );
                  $filteredvideouploading = $this->regModel->filteredvideouploading_demo($data);
                  if(!empty($filteredvideouploading)){
                         $data['error'] = array('error' => "Data Filtered Successfully !");
                         $data['listvideouploading'] = $filteredvideouploading;
                         $this->load->view('listvideouploading',$data);
                   } else {
                         $data['listvideouploading'] = $this->regModel->listvideouploading_demo($fk_classId);
                          $data['error'] = array('error' => "Data not Filtered Successfully !");
                          $this->load->view('listvideouploading',$data);
                  }

            }


      }else{
          
            $usersession = $this->session->userdata('usersession');
            if($this->session->userdata('usersession'))
            {

                   $fk_classId = $this->uri->segment(3);
                   $recap = $this->uri->segment(4);
                   $data['listvideouploading'] = $this->regModel->listvideouploading_demo($fk_classId);
                   $data['get_month_data'] = $this->regModel->get_month_data_for_admin($fk_classId); 
                   $data['fk_classId'] = $fk_classId; 
                   $data['recap'] = $recap;
                   $this->load->view('listvideouploading',$data);
            } else {
              redirect('welcome');
            }
          }
      }
}


public function list_of_recap()
{
  
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 ||$usersession[0]['adminRole']==5 ){

    if(isset($_POST['submit']))
      {

            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('fk_sessionId', 'fk_sessionId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('fk_dayId', 'fk_dayId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('fk_monthId', 'fk_monthId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('vimeoId', 'vimeoId', 'trim|numeric|greater_than[0]|numeric|max_length[9]');
            $this->form_validation->set_rules('fromDT', 'fromDT', 'trim');
            $this->form_validation->set_rules('toDT', 'toDT', 'trim');
            $fk_classId  =  $this->input->post('fk_classId');

            if ($this->form_validation->run() == FALSE)
            {     
                 $data['listvideouploading'] = $this->regModel->listvideouploading_recap($fk_classId);     
                $this->load->view('listvideouploading',$data);
            }
            else
            {

                 
                  $fk_sessionId     =  $this->input->post('fk_sessionId');
                  $fk_dayId         =  $this->input->post('fk_dayId');
                  $fk_monthId       =  $this->input->post('fk_monthId');
                  $vimeoId          =  $this->input->post('vimeoId');
                  $fromDT           =  $this->input->post('fromDT');
                  $toDT             =  $this->input->post('toDT');
                  $data = array(  
                  'fk_classId'     => $fk_classId,
                  'fk_sessionId'   => $fk_sessionId,
                  'fk_dayId'       => $fk_dayId,
                  'fk_monthId'     => $fk_monthId,
                  'vimeoId'        => $vimeoId,
                  'fromDT'         => $fromDT,
                  'toDT'           => $toDT,
                  );
                  $filteredvideouploading = $this->regModel->filteredvideouploading($data);
                  if(!empty($filteredvideouploading)){
                         $data['error'] = array('error' => "Data Filtered Successfully !");
                         $data['listvideouploading'] = $filteredvideouploading;
                         $this->load->view('listvideouploading',$data);
                   } else {
                         $data['listvideouploading'] = $this->regModel->listvideouploading_recap($fk_classId);
                         $data['error'] = array('error' => "Data not Filtered Successfully !");
                         $this->load->view('listvideouploading',$data);
                  }

            }


      }else{
          
            $usersession = $this->session->userdata('usersession');
            if($this->session->userdata('usersession'))
            {

                   $fk_classId                 = $this->uri->segment(3);
                   $recap                      = $this->uri->segment(4);
                   $data['listvideouploading'] = $this->regModel->listvideouploading_recap($fk_classId);
                   $data['get_month_data']     = $this->regModel->get_month_data_for_admin($fk_classId); 
                   $data['fk_classId']         = $fk_classId; 
                   $data['recap']              = $recap; 
                   $this->load->view('listvideouploading',$data);
            } else {
              redirect('welcome');
            }
          }
      }
}



public function classroom_demo()
{

  if($this->session->userdata('usersession'))
    {
       $data['getClass'] = $this->regModel->getClass();
       $data['recap'] = 1;
       $this->load->view('classroom_demo',$data);
    } else {
      redirect('welcome');
    }


}


public function classroom_recap()
{

  if($this->session->userdata('usersession'))
    {
       $data['getClass'] = $this->regModel->getClass();
       $data['recap'] = 3;
       $this->load->view('classroom_recap',$data);
    } else {
      redirect('welcome');
    }


}


public function unlocksession()
{
  


if($this->session->userdata('usersession'))
{


  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 ||$usersession[0]['adminRole']==5 ||$usersession[0]['adminRole']==6){

    if(isset($_POST['submit']))
      {
          
          

            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('mId', 'mId', 'trim|required|numeric|greater_than[0]');
            $this->form_validation->set_rules('studId', 'studId', 'trim|required|integer|greater_than[0]');
            $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|required|integer|greater_than[0]');

            $studId  =  $this->input->post('studId');
            $fk_classId  =  $this->input->post('fk_classId');

            if ($this->form_validation->run() == FALSE)
            {     
                $data['studId'] = $studId;
                $data['fk_classId'] = $fk_classId;
                $data['get_month_data'] = $this->regModel->get_month_data_admin();
                $data['unlocksession_data'] = $this->regModel->unlocksession_data($studId);
                $this->load->view('unlocksession',$data);
            }
            else
            {

              $mId         =  $this->input->post('mId');
              $studId      =  $this->input->post('studId');
              $fk_classId  =  $this->input->post('fk_classId');
              $res = $this->regModel->unlocksession($mId,$studId,$fk_classId);
              if($res==1){

                $data['error'] = array('error'=>'Month Status Changed');
                $data['studId'] = $studId;
                $data['fk_classId'] = $fk_classId;
                $data['get_month_data'] = $this->regModel->get_month_data_admin();
                $data['unlocksession_data'] = $this->regModel->unlocksession_data($studId);
                $this->load->view('unlocksession',$data);

              }else{
                $data['error'] = array('error'=>'Student fees is pending');
                $data['studId'] = $studId;
                $data['fk_classId'] = $fk_classId;
                $data['get_month_data'] = $this->regModel->get_month_data_admin();
                $data['unlocksession_data'] = $this->regModel->unlocksession_data($studId);
                $this->load->view('unlocksession',$data);

              }

            }
      }else{

        $data['studId'] = $this->uri->segment(3);
        $data['fk_classId'] = $this->uri->segment(4);
        $data['get_month_data'] = $this->regModel->get_month_data_admin();
        $data['unlocksession_data'] = $this->regModel->unlocksession_data($data['studId']);
       $this->load->view('unlocksession',$data);
      }
       
    } else {
      redirect('welcome');
    }
  }else{
      redirect('welcome');
  }



}


public function onboarding()
{


if($this->session->userdata('usersession'))
{

  $usersession = $this->session->userdata('usersession');
  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){
    if(isset($_POST['submit']))
      {
       
            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('fk_monthId', 'fk_monthId', 'trim|required|integer|greater_than[0]');
            $this->form_validation->set_rules('studId', 'studId', 'trim|required|integer|greater_than[0]');
            $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|required|integer|greater_than[0]');
            $this->form_validation->set_rules('usr_firstname', 'usr_firstname', 'trim|required');
            $this->form_validation->set_rules('usr_lastname', 'usr_lastname', 'trim|required');
            $this->form_validation->set_rules('usr_email', 'usr_email', 'trim|required|valid_email');
            $this->form_validation->set_rules('usr_mobile_no', 'usr_mobile_no', 'trim|required|exact_length[10]|integer');
            $this->form_validation->set_rules('paymentType', 'paymentType', 'trim|required|integer');
            $this->form_validation->set_rules('planId', 'planId', 'trim|required|integer');
            $this->form_validation->set_rules('payAmount', 'payAmount', 'trim|integer|max_length[10]');
            $this->form_validation->set_rules('remarkReceipt', 'remarkReceipt', 'trim');
            $this->form_validation->set_rules('fk_coursePeriod', 'fk_coursePeriod', 'trim|integer');
            $this->form_validation->set_rules('fk_adjustedAmount', 'fk_adjustedAmount', 'trim|integer');
            $this->form_validation->set_rules('fk_adjustedRemark', 'fk_adjustedRemark', 'trim');
            
          
           
             $studId           =  $this->input->post('studId');
             $fk_classId       =  $this->input->post('fk_classId');
             $usr_email        =  $this->input->post('usr_email');
             $planId           =  $this->input->post('planId');

            if ($this->form_validation->run() == FALSE)
            {     
                $data['studId']                = $studId;
                $data['fk_classId']            = $fk_classId;
                $data['get_month_data']        = $this->regModel->get_month_data_admin();
                $data['list_Fees']             = $this->regModel->list_Fees();
                $data['Receiptpic']            = array('error' => "upload fees Receipt");
                $data['unlocksession_data']    = $this->regModel->unlocksession_data($studId);
                $data['get_studentid']         = $this->regModel->get_studentid($studId);
                $data['paiduntil']             = $this->regModel->paiduntil($studId);
                $data['checkremaining_amount'] = $this->regModel->checkremaining_amount($data['studId'],$planId);
                $data['selected_by_package']   = $this->regModel->selected_by_packages($data['studId']);
                $data['get_reciept_idwise']    = $this->regModel->get_reciept_idwise();
                $data['list_Fees_packagewise'] = $this->regModel->list_Fees_packagewise($data['fk_classId']);
                $data['get_reciept_idwise']    = $this->regModel->get_reciept_idwise();
                $this->load->view('onboarding',$data);
            }
            else
            {
              if(!empty($_FILES['Receiptpic']['name']))
              {
              
                   
                  $fk_monthId                     =  $this->input->post('fk_monthId');
                  $studId                         =  $this->input->post('studId');
                  $usr_firstname                  =  $this->input->post('usr_firstname');
                  $usr_lastname                   =  $this->input->post('usr_lastname');
                  $usr_email                      =  $this->input->post('usr_email');
                  $usr_mobile_no                  =  $this->input->post('usr_mobile_no');
                  $paymentType                    =  $this->input->post('paymentType');
                  $payAmount                      =  $this->input->post('payAmount');
                  $discount                       =  $this->input->post('discount');
                  $remarkReceipt                  =  $this->input->post('remarkReceipt');
                  $reciept_no                     =  $this->input->post('reciept_no');
                  $promoCode                      =  $this->input->post('promoCode');
                  $fk_coursePeriod                =  $this->input->post('fk_coursePeriod');
                  $fk_adjustedAmount              =  $this->input->post('fk_adjustedAmount');
                  $fk_adjustedRemark              =  $this->input->post('fk_adjustedRemark');
                  $roundOff                       =  $this->input->post('roundOff');
                  
                  $check_number                   =  $this->input->post('check_number');
                  $bank_name                      =  $this->input->post('bank_name');
                  $check_dated                    =  $this->input->post('check_dated');
                  $branch_name                    =  $this->input->post('branch_name');
                  
                  
                  $paymentMode                    = $this->input->post('paymentMode');
                  $tran_online_date               = $this->input->post('tran_online_date');
                  $transaction_no                 = $this->input->post('transaction_no');
                  $parents_name                   = $this->input->post('parents_name');
                  
                 
                  
                  $Receiptpic                     =  $_FILES['Receiptpic']['name'];
                  $config['upload_path']          = './uploads/Receiptpic';
                  $config['allowed_types']        = 'gif|jpg|png|jpeg';

                  $this->load->library('upload', $config);
                  $this->upload->initialize($config);

                  if ( ! $this->upload->do_upload('Receiptpic'))
                  {     
                          $data['error']                   = array('error' => $this->upload->display_errors());
                          $data['studId']                  = $studId;
                          $data['list_Fees']               = $this->regModel->list_Fees();
                          $data['fk_classId']              = $fk_classId;
                          $data['unlocksession_data']      = $this->regModel->unlocksession_data($studId);
                          $data['get_studentid']           = $this->regModel->get_studentid($studId);
                          $data['get_month_data']          = $this->regModel->get_month_data_admin();
                          $data['paiduntil']               = $this->regModel->paiduntil($studId);
                          $data['checkremaining_amount']   = $this->regModel->checkremaining_amount($data['studId'],$planId);
                          $data['selected_by_package']     = $this->regModel->selected_by_packages($data['studId']);
                          $data['list_Fees_packagewise']   = $this->regModel->list_Fees_packagewise($data['fk_classId']);
                          $data['get_reciept_idwise']      = $this->regModel->get_reciept_idwise();
                          $this->load->view('onboarding', $data);
                  }
                  else
                  {
                          $data = array('Receiptpic' => $this->upload->data());
                          $Receiptpic = $data['Receiptpic']['file_name'];
                  }
                
                  $checkremaining_amount = $this->regModel->checkremaining_amount($studId,$planId); 
                  $res = $this->regModel->onboarding($fk_monthId,$studId,$usr_firstname,$usr_lastname,$usr_email,$usr_mobile_no,$paymentType,$Receiptpic,$planId,$payAmount,$discount,$remarkReceipt,$reciept_no,$fk_adjustedAmount,$fk_adjustedRemark,$roundOff,$check_number,$bank_name,$check_dated,$branch_name,$paymentMode,$tran_online_date,$transaction_no,$parents_name);

                if($res==1){
                    
                    
                  $promocoderes                    = $this->regModel->promocodeUpdate($promoCode,$studId,$fk_coursePeriod);     
                  $data['error']                   = array('error'=>'Student On Board Successfully');
                  $data['studId']                  = $studId;
                  $data['list_Fees']               = $this->regModel->list_Fees();
                  $data['fk_classId']              = $fk_classId;
                  $data['unlocksession_data']      = $this->regModel->unlocksession_data($studId);
                  $data['get_studentid']           = $this->regModel->get_studentid($studId);
                  $data['get_month_data']          = $this->regModel->get_month_data_admin();
                  $data['paiduntil']               = $this->regModel->paiduntil($studId);
                  $data['checkremaining_amount']   = $this->regModel->checkremaining_amount($data['studId'],$planId);
                  $data['selected_by_package']     = $this->regModel->selected_by_packages($data['studId']);
                  $data['list_Fees_packagewise']   = $this->regModel->list_Fees_packagewise($data['fk_classId']);
                  $data['get_reciept_idwise']      = $this->regModel->get_reciept_idwise();
                  $this->load->view('onboarding',$data);
                  
                }else{
                
                  $data['error']                   = array('error'=>'Student Payment Already Successfully');
                  $data['studId']                  = $studId;
                  $data['list_Fees']               = $this->regModel->list_Fees();
                  $data['fk_classId']              = $fk_classId;
                  $data['paiduntil']               = $this->regModel->paiduntil($studId);
                  $data['get_month_data']          = $this->regModel->get_month_data_admin();
                  $data['get_studentid']           = $this->regModel->get_studentid($studId);
                  $data['unlocksession_data']      = $this->regModel->unlocksession_data($studId);
                  $data['checkremaining_amount']   = $this->regModel->checkremaining_amount($data['studId'],$planId);
                  $data['selected_by_package']     = $this->regModel->selected_by_packages($data['studId']);
                  $data['list_Fees_packagewise']   = $this->regModel->list_Fees_packagewise($data['fk_classId']);
                  $data['get_reciept_idwise']      = $this->regModel->get_reciept_idwise();
                  $this->load->view('unlocksession',$data);

                }
            }
            else
            {
              $data['studId']                = $studId;
              $data['fk_classId']            = $fk_classId;
              $data['get_month_data']        = $this->regModel->get_month_data_admin();
              $data['list_Fees']             = $this->regModel->list_Fees();
              $data['Receiptpic']            = array('error' => "upload fees Receipt");
              $data['unlocksession_data']    = $this->regModel->unlocksession_data($studId);
              $data['get_studentid']         = $this->regModel->get_studentid($studId);
              $data['paiduntil']             = $this->regModel->paiduntil($studId);
              $data['checkremaining_amount'] =   $this->regModel->checkremaining_amount($data['studId'],$planId);
              $data['selected_by_package']   = $this->regModel->selected_by_packages($data['studId']);
              $data['get_reciept_idwise']    = $this->regModel->get_reciept_idwise();
              $data['list_Fees_packagewise'] = $this->regModel->list_Fees_packagewise($data['fk_classId']);
              $this->load->view('onboarding',$data);
            }

          }
            
      }else{
        $data['studId']                  = $this->uri->segment(3);
        $data['fk_classId']              = $this->uri->segment(4);  
        $data['get_month_data']          = $this->regModel->get_month_data_admin();
        $data['list_Fees']               = $this->regModel->list_Fees();
        $data['unlocksession_data']      = $this->regModel->unlocksession_data($data['studId']);
        $planid = 0;
        $data['paiduntil']               = $this->regModel->paiduntil($data['studId']);
        $data['checkremaining_amount']   = $this->regModel->checkremaining_amount($data['studId'],$planid); 
        $data['get_studentid']           = $this->regModel->get_student_id($data['studId']);
        //check aprove by admin and status 
        $data['selected_by_package']     = $this->regModel->selected_by_packages($data['studId']);
        $data['list_Fees_packagewise']   = $this->regModel->list_Fees_packagewise($data['fk_classId']);
        $data['get_reciept_idwise']      = $this->regModel->get_reciept_idwise();
       $this->load->view('onboarding',$data);
      }
       
    } else {
      redirect('welcome');
    }
  }else{
      redirect('welcome');
  }



}



public function onboardinglist()
{

  if($this->session->userdata('usersession'))
  {
    $usersession = $this->session->userdata('usersession');
    if($usersession[0]['adminRole']==6 ){
      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('studId', 'studId', 'trim|required|integer|greater_than[0]');
              $this->form_validation->set_rules('paystatus', 'payment type', 'trim|required');
              $this->form_validation->set_rules('paymentSatusByadmin', 'paymentSatusByadmin', 'trim|required|integer|greater_than[0]');
            
              if ($this->form_validation->run() == FALSE)
              {      
                    $data['onboardinglist']     = $this->regModel->onboardinglist();
                    $this->load->view('onboardinglist',$data);
              }
              else
              {
                $paystatus            =  $this->input->post('paystatus');
                $studId               =  $this->input->post('studId');
                $paymentSatusByadmin  =  $this->input->post('paymentSatusByadmin');


                $res = $this->regModel->onboardinglistStatus($studId,$paymentSatusByadmin,$paystatus);
                if($res==1){

                  $data['error']              = array('error'=>'Student On Board Successfully');
                  $data['onboardinglist']     = $this->regModel->onboardinglist();
                  $this->load->view('onboardinglist',$data);

                }else{

                  $data['error']              = array('error'=>'Student Not On Board Successfully');
                  $data['onboardinglist']     = $this->regModel->onboardinglist();
                  $this->load->view('onboardinglist',$data);

                }



              }
          }else{

            $usersession = $this->session->userdata('usersession');
              if($usersession[0]['adminRole']==1 ||$usersession[0]['adminRole']==6 ||$usersession[0]['adminRole']==5 ){
                    $data['onboardinglist']     = $this->regModel->onboardinglist();
                    $this->load->view('onboardinglist',$data);
                }else{
                  redirect('welcome');
                }
          }
    
     }
  }
}




public function unlockdays()
{
  
  if($this->session->userdata('usersession'))
  {
    $usersession = $this->session->userdata('usersession');
    if($usersession[0]['adminRole']==1 ||$usersession[0]['adminRole']==5 ||$usersession[0]['adminRole']==6){
      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('dayId', 'dayId', 'trim|required|integer|greater_than[0]');
              $this->form_validation->set_rules('fk_monthId', 'fk_monthId', 'trim|required|integer|greater_than[0]');
              $this->form_validation->set_rules('studId', 'studId', 'trim|required|integer|greater_than[0]');
            
              $dayId       =  $this->input->post('dayId');
              $fk_monthId  =  $this->input->post('fk_monthId');
              $studId      =  $this->input->post('studId');

              if ($this->form_validation->run() == FALSE)
              {     
                  $data['unlockdays']  = $this->regModel->unlockdays();
                   $data['unlocksession_data'] = $this->regModel->unlocksession_day($studId);
                   $data['studId']  = $studId;
                    $data['fk_monthId']  = $fk_monthId;
                  $this->load->view('unlockdays',$data);

              }
              else
              {

                $dayId       =  $this->input->post('dayId');
                $fk_monthId  =  $this->input->post('fk_monthId');
                $studId      =  $this->input->post('studId');


                $res = $this->regModel->unlocksession_day_student($dayId,$studId,$fk_monthId);
                if($res==1){

                  $data['error']         = array('error'=>'Days unlock Successfully');
                  $data['unlockdays']    = $this->regModel->unlockdays();
                  $data['studId']  = $studId;
                  $data['fk_monthId']  = $fk_monthId;
                  $data['unlocksession_data'] = $this->regModel->unlocksession_day($studId);

                  $this->load->view('unlockdays',$data);

                }else{

                  $data['error'] = array('error'=>'Days not unlock Successfully because of payAmount is pending');
                  $data['unlockdays']  = $this->regModel->unlockdays();
                  $data['studId']  = $studId;
                    $data['fk_monthId']  = $fk_monthId;
                   $data['unlocksession_data'] = $this->regModel->unlocksession_day($studId);
                  $this->load->view('unlockdays',$data);

                }



              }
          }else{

            $usersession = $this->session->userdata('usersession');
              if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==5 ||$usersession[0]['adminRole']==6 ){

                    $fk_monthId = $this->uri->segment(3);
                    $studId     = $this->uri->segment(4);
                    $data['unlockdays']  = $this->regModel->unlockdays();
                    $data['unlocksession_data'] = $this->regModel->unlocksession_day($studId);
                    $data['studId']  = $studId;
                    $data['fk_monthId']  = $fk_monthId;
                    $this->load->view('unlockdays',$data);
                }else{
                  redirect('welcome');
                }
          }
    
     }
  }

}



public function emi_form_by_parents()
{
  
    $usersession = $this->session->userdata('usersession');
    if(!empty($usersession))
    {
      if($usersession[0]['adminRole']==6)
      {
          if(isset($_POST['submit']))
          {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('studentMobile', 'studentMobile', 'trim|integer|exact_length[10]');
              $this->form_validation->set_rules('studentEmail', 'studentEmail', "trim|valid_email");
              
              if ($this->form_validation->run() == FALSE)
              {     
                  $data['emi_form_by_parents'] = $this->regModel->emi_form_by_parents();
                  $this->load->view('emi_form_by_parents',$data);
              }
              else
              {

                 $studentMobile    = $this->input->post('studentMobile');
                 $studentEmail     = $this->input->post('studentEmail');
                 $result           = $this->regModel->get_emi_form_by_parents($studentMobile,$studentEmail);
                 if(!empty($result)){
                    $data['error'] = array('error' => "Emi Data Fetched Successfully !");
                     $data['emi_form_by_parents'] = $result;
                   $this->load->view('emi_form_by_parents',$data);
                 }else{
                    $data['error'] = array('error' => "Emi Data Not Fetched Successfully !");
                     $data['emi_form_by_parents'] = $this->regModel->emi_form_by_parents();
                   $this->load->view('emi_form_by_parents',$data);
                 }

              }

        } else {

                  $usersession = $this->session->userdata('usersession');
                  if($this->session->userdata('usersession'))
                  {
                    if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

                        $data['emi_form_by_parents'] = $this->regModel->emi_form_by_parents();
                        $this->load->view('emi_form_by_parents',$data);

                   }else{
                       redirect(base_url('admin'));
                      }
                  }

             }
          }
  }else{
    redirect(base_url('admin'));
  }

}



public function activatestud()
{
  

   $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('studId', 'studId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['getstudlist'] = $this->regModel->getstudlist(); 
                   $this->load->view('getstudlist',$data);
              }
              else
              {
                $studId     = $this->input->post('studId');
                $result = $this->regModel->activatestud($studId);
                 if($result==1){
                    $data['error'] = array('error' => "Student Id Activated Successfully !");
                    $data['getstudlist'] = $this->regModel->getstudlist(); 
                    $this->load->view('getstudlist',$data);
                 }else{
                    $data['error'] = array('error' => "Student Id Not Activated Successfully !");
                    $data['getstudlist'] = $this->regModel->getstudlist(); 
                    $this->load->view('getstudlist',$data);
                 }
              }         

        }else{  
                  $data['getstudlist'] = $this->regModel->getstudlist(); 
                  $this->load->view('getstudlist',$data);
        }
      }



}



public function onboardedstudent()
{
  
 $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6)
  {
       $fk_classId = $this->uri->segment(3);
       $data['onboardedstudent'] = $this->regModel->onboardedstudent($fk_classId); 
       $this->load->view('onboardedstudent',$data);
  }else{
      redirect('welcome');
  }

}







public function assign_student_manual()
{
    
        $usersession = $this->session->userdata('usersession');
          if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 )
          {
             $usersession = $this->session->userdata('usersession');
              if(isset($_POST['submit']))
              {
                  $this->form_validation->set_error_delimiters('<span>', '</span>');
                  $allocate   = $this->input->post('allocate');

                  if($allocate=="allocate"){

                    $this->form_validation->set_rules('fk_teachId', 'Teacher Name', 'trim|required');
                    $this->form_validation->set_rules('fk_feesId', 'Sub Class Name', 'trim|required');
                    $this->form_validation->set_rules('fk_studId', 'studId', 'trim|required');
                    $this->form_validation->set_rules('studentId', 'studentId', 'trim|required');

                  }elseif ($allocate=="search") {
                    
                    $this->form_validation->set_rules('studentEmail', 'studentEmail', 'trim');
                    $this->form_validation->set_rules('studentMobile', 'studentMobile', 'trim|max_length[10]');
                    $this->form_validation->set_rules('studentId', 'studentId', 'trim');
                  }
                 
                  if ($this->form_validation->run() == false) {

                        $data['assign_student']        =  $this->regModel->getstudlist();
                        $data['getClass']              =  $this->regModel->getClass();
                        $data['getTeacher']            =  $this->regModel->getTeacher();
                        $data['batch']                 =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_nursery();

                        $this->load->view('assign_student_manual',$data);

                  } else {


                  
                      if($allocate=="allocate") {

                            $fk_classId = 1;
                            $fk_teachId = $this->input->post('fk_teachId');
                            $fk_feesId  = $this->input->post('fk_feesId');
                            $fk_date    = $this->input->post('fk_date');
                            $batchId    = $this->input->post('batchId');
                            $studentId  = $this->input->post('studentId');
                            $fk_studId  = $this->input->post('fk_studId');
                            $updateStudentId = $this->allocatemodel->updateStudentId($fk_studId,$studentId);
                            $count_student_assign_teacher = $this->allocatemodel->tbl_allocate_teacher_to_student_count($fk_feesId,$fk_classId,$fk_teachId,$batchId);

                            if( $count_student_assign_teacher==1 ){
                              
                                $data['assign_student']        =  $this->allocatemodel->allocate_student_search_without_filter_nursery();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_nursery();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['error'] = array('error' => "Batch Size is fulled to this Teacher");
                                $this->load->view('assign_student_manual',$data);

                            }else{

                              $res   = $this->allocatemodel->allocate_student_manual($fk_classId,$fk_teachId,$fk_feesId,$fk_date,$batchId,$fk_studId,$studentId);

                              if($res==1){

                                $data['assign_student']        =  $this->allocatemodel->allocate_student_search_without_filter_nursery();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_nursery();
                                $data['error'] = array('error' => "Allocated Student Successfully !");

                              }else{

                                $data['assign_student']        =  $this->allocatemodel->allocate_student_search_without_filter_nursery();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_nursery();
                                $data['error'] = array('error' => "Not Allocated Student Successfully !");
                              }
                                $this->load->view('assign_student_manual',$data);


                            }


                        } elseif ($allocate=="search") {

                            $studentMobile      = $this->input->post('studentMobile');
                            $studentEmail       = $this->input->post('studentEmail');
                            $studentId          = $this->input->post('studentId');

                            $res   = $this->allocatemodel->allocate_student_search($studentMobile,$studentEmail,$studentId);
                            if(!empty($res)){

                              $data['assign_student']        =  $res;
                              $data['getClass']              =  $this->regModel->getClass();
                              $data['getTeacher']            =  $this->regModel->getTeacher();
                              $data['batch']                 =  $this->regModel->getBatch();
                              $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_nursery();
                              $data['error'] = array('error' => " Data Filtered Successfully !");

                            }else{

                              $data['assign_student']        =  $res;
                              $data['getClass']              =  $this->regModel->getClass();
                              $data['getTeacher']            =  $this->regModel->getTeacher();
                              $data['batch']                 =  $this->regModel->getBatch();
                              $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_nursery();
                              $data['error'] = array('error' => "Data Not Filtered !");
                            }
                              $this->load->view('assign_student_manual',$data);
                      
                     }


                  }

                }else{


                  $usersession = $this->session->userdata('usersession');

                  if($usersession[0]['adminRole']==1 ) {

                  if($this->session->userdata('usersession'))
                  {
                        $data['assign_student']      =   $this->allocatemodel->allocate_student_search_without_filter_nursery();
                        $data['getClass']            =  $this->regModel->getClass();
                        $data['getTeacher']          =  $this->regModel->getTeacher();
                        $data['batch']               =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']   =  $this->regModel->tab_add_fees_data_nursery();

                        $this->load->view('assign_student_manual',$data);


                  } else {
                      redirect('welcome');
                  } 
              }
           }
        }

}

public function assign_student_manual_junior()
{
    
        $usersession = $this->session->userdata('usersession');
          if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 )
          {
             $usersession = $this->session->userdata('usersession');
              if(isset($_POST['submit']))
              {
                  $this->form_validation->set_error_delimiters('<span>', '</span>');
                  $allocate   = $this->input->post('allocate');
                  $fk_date    = $this->input->post('fk_date');
                  $batchId    = $this->input->post('batchId');
                  $fk_studId  = $this->input->post('fk_studId');
                  $studentId  = $this->input->post('studentId');

                  if($allocate=="allocate"){

                    $this->form_validation->set_rules('fk_teachId', 'Teacher Name', 'trim|required');
                    $this->form_validation->set_rules('fk_feesId', 'Sub Class Name', 'trim|required');
                    $this->form_validation->set_rules('fk_studId', 'studId Name', 'trim|required');
                    $this->form_validation->set_rules('studentId', 'studentId', 'trim|required');

                  }elseif ($allocate=="search") {
                    
                    $this->form_validation->set_rules('studentEmail', 'studentEmail', 'trim');
                    $this->form_validation->set_rules('studentMobile', 'studentMobile', 'trim|max_length[10]');
                    $this->form_validation->set_rules('studentId', 'studentId', 'trim');
                  }
                 
                  if ($this->form_validation->run() == false) {

                        $data['assign_student']        =  $this->regModel->getstudlist();
                        $data['getClass']              =  $this->regModel->getClass();
                        $data['getTeacher']            =  $this->regModel->getTeacher();
                        $data['batch']                 =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_junior();

                        $this->load->view('assign_student_manual_junior',$data);

                  } else {


                  
                      if($allocate=="allocate") {

                            $fk_classId = 2;
                            $fk_teachId = $this->input->post('fk_teachId');
                            $fk_feesId  = $this->input->post('fk_feesId');
                            $fk_date    = $this->input->post('fk_date');
                            $batchId    = $this->input->post('batchId');
                            $studentId  = $this->input->post('studentId');
                            $fk_studId  = $this->input->post('fk_studId');
                            $updateStudentId = $this->allocatemodel->updateStudentId($fk_studId,$studentId);
                            $count_student_assign_teacher = $this->allocatemodel->tbl_allocate_teacher_to_student_count($fk_feesId,$fk_classId,$fk_teachId,$batchId);
                            
                            if( $count_student_assign_teacher==1  ){
                              
                                $data['assign_student']        =  $this->allocatemodel->allocate_student_search_without_filter_junior();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_junior();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['error'] = array('error' => "Batch Size is fulled to this Teacher");
                                $this->load->view('assign_student_manual_junior',$data);

                            }else{

                              $res   = $this->allocatemodel->allocate_student_manual($fk_classId,$fk_teachId,$fk_feesId,$fk_date,$batchId,$fk_studId,$studentId);

                              if($res==1){

                                $data['assign_student']        =  $this->allocatemodel->allocate_student_search_without_filter_junior();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_junior();
                                $data['error'] = array('error' => "Allocated Student Successfully !");

                              }else{

                                $data['assign_student']        =  $this->allocatemodel->allocate_student_search_without_filter_junior();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_junior();
                                $data['error'] = array('error' => "Not Allocated Student Successfully !");
                              }
                                $this->load->view('assign_student_manual_junior',$data);


                            }


                        } elseif ($allocate=="search") {

                            $studentMobile      = $this->input->post('studentMobile');
                            $studentEmail       = $this->input->post('studentEmail');
                            $studentId          = $this->input->post('studentId');

                            $res   = $this->allocatemodel->allocate_student_search($studentMobile,$studentEmail,$studentId);
                            if(!empty($res)){

                              $data['assign_student']        =  $res;
                              $data['getClass']              =  $this->regModel->getClass();
                              $data['getTeacher']            =  $this->regModel->getTeacher();
                              $data['batch']                 =  $this->regModel->getBatch();
                              $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_junior();
                              $data['error'] = array('error' => " Data Filtered Successfully !");

                            }else{

                              $data['assign_student']        =  $res;
                              $data['getClass']              =  $this->regModel->getClass();
                              $data['getTeacher']            =  $this->regModel->getTeacher();
                              $data['batch']                 =  $this->regModel->getBatch();
                              $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_junior();
                              $data['error'] = array('error' => "Data Not Filtered !");
                            }
                              $this->load->view('assign_student_manual_junior',$data);
                      
                     }


                  }

                }else{


                  $usersession = $this->session->userdata('usersession');

                  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ) {

                  if($this->session->userdata('usersession'))
                  {
                        $data['assign_student']      =   $this->allocatemodel->allocate_student_search_without_filter_junior();
                        $data['getClass']            =  $this->regModel->getClass();
                        $data['getTeacher']          =  $this->regModel->getTeacher();
                        $data['batch']               =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']   =  $this->regModel->tab_add_fees_data_junior();

                        $this->load->view('assign_student_manual_junior',$data);


                  } else {
                      redirect('welcome');
                  } 
              }
           }
        }

}


public function assign_student_manual_senior()
{
    
        $usersession = $this->session->userdata('usersession');
          if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 )
          {
             $usersession = $this->session->userdata('usersession');
              if(isset($_POST['submit']))
              {
                  $this->form_validation->set_error_delimiters('<span>', '</span>');
                  $allocate   = $this->input->post('allocate');
                  $fk_date    = $this->input->post('fk_date');
                  $batchId    = $this->input->post('batchId');
                  $fk_studId  = $this->input->post('fk_studId');
                  $studentId  = $this->input->post('studentId');

                  if($allocate=="allocate"){

                    $this->form_validation->set_rules('fk_teachId', 'Teacher Name', 'trim|required');
                    $this->form_validation->set_rules('fk_feesId', 'Sub Class Name', 'trim|required');
                    $this->form_validation->set_rules('fk_studId', 'studId Name', 'trim|required');
                    $this->form_validation->set_rules('studentId', 'studentId', 'trim|required');

                  }elseif ($allocate=="search") {
                    
                    $this->form_validation->set_rules('studentEmail', 'studentEmail', 'trim');
                    $this->form_validation->set_rules('studentMobile', 'studentMobile', 'trim|max_length[10]');
                    $this->form_validation->set_rules('studentId', 'studentId', 'trim');
                  }
                 
                  if ($this->form_validation->run() == false) {

                        $data['assign_student']        =   $this->allocatemodel->allocate_student_search_without_filter_senior();
                        $data['getClass']              =  $this->regModel->getClass();
                        $data['getTeacher']            =  $this->regModel->getTeacher();
                        $data['batch']                 =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_senior();

                        $this->load->view('assign_student_manual_senior',$data);

                  } else {


                  
                      if($allocate=="allocate") {

                            $fk_classId   = 3;
                            $fk_teachId = $this->input->post('fk_teachId');
                            $fk_feesId  = $this->input->post('fk_feesId');
                            $fk_date    = $this->input->post('fk_date');
                            $batchId    = $this->input->post('batchId');
                            $studentId  = $this->input->post('studentId');
                            $fk_studId  = $this->input->post('fk_studId');
                            $updateStudentId = $this->allocatemodel->updateStudentId($fk_studId,$studentId);
                            $count_student_assign_teacher = $this->allocatemodel->tbl_allocate_teacher_to_student_count($fk_feesId,$fk_classId,$fk_teachId,$batchId);

                            if( $count_student_assign_teacher==1 ){
                              
                                $data['assign_student']        =  $this->allocatemodel->allocate_student_search_without_filter_senior();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_senior();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['error'] = array('error' => "Batch Size is fulled to this Teacher");
                                $this->load->view('assign_student_manual_senior',$data);

                            }else{

                              $res  = $this->allocatemodel->allocate_student_manual($fk_classId,$fk_teachId,$fk_feesId,$fk_date,$batchId,$fk_studId,$studentId);

                              if($res==1){

                                $data['assign_student']        =  $this->allocatemodel->allocate_student_search_without_filter_senior();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_senior();
                                $data['error'] = array('error' => "Allocated Student Successfully !");

                              }else{

                                $data['assign_student']        =  $this->allocatemodel->allocate_student_search_without_filter_senior();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_senior();
                                $data['error'] = array('error' => "Not Allocated Student Successfully !");
                              }
                                $this->load->view('assign_student_manual_senior',$data);


                            }


                        } elseif ($allocate=="search") {

                            $studentMobile      = $this->input->post('studentMobile');
                            $studentEmail       = $this->input->post('studentEmail');
                            $studentId          = $this->input->post('studentId');

                            $res   = $this->allocatemodel->allocate_student_search($studentMobile,$studentEmail,$studentId);
                            if(!empty($res)){

                              $data['assign_student']        =  $res;
                              $data['getClass']              =  $this->regModel->getClass();
                              $data['getTeacher']            =  $this->regModel->getTeacher();
                              $data['batch']                 =  $this->regModel->getBatch();
                              $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_senior();
                              $data['error'] = array('error' => " Data Filtered Successfully !");

                            }else{

                              $data['assign_student']        =  $res;
                              $data['getClass']              =  $this->regModel->getClass();
                              $data['getTeacher']            =  $this->regModel->getTeacher();
                              $data['batch']                 =  $this->regModel->getBatch();
                              $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_senior();
                              $data['error'] = array('error' => "Data Not Filtered !");
                            }
                              $this->load->view('assign_student_manual_senior',$data);
                      
                     }


                  }

                }else{


                  $usersession = $this->session->userdata('usersession');

                  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ) {

                  if($this->session->userdata('usersession'))
                  {
                        $data['assign_student']      =   $this->allocatemodel->allocate_student_search_without_filter_senior();
                        $data['getClass']            =  $this->regModel->getClass();
                        $data['getTeacher']          =  $this->regModel->getTeacher();
                        $data['batch']               =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']   =  $this->regModel->tab_add_fees_data_senior();

                        $this->load->view('assign_student_manual_senior',$data);


                  } else {
                      redirect('welcome');
                  } 
              }
           }
        }else{
             redirect('welcome','refresh');
        }
}



public function promocode()
{
    if(isset($_POST['submit']))
      {

            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('promoCode', 'Promo Code', 'trim|required');
            $this->form_validation->set_rules('UserName', 'UserName', 'trim|required');
            $this->form_validation->set_rules('startDate', 'Start Date', 'trim|required');
            $this->form_validation->set_rules('endDate', 'End Date', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {     
                $data['promocodelist'] = $this->regModel->promocodelist(); 
                $this->load->view('promocode',$data);
            }
            else
            {

              $promoCode      = $this->input->post('promoCode');
              $startDate      = $this->input->post('startDate');
              $endDate        = $this->input->post('endDate');
              $UserName       = $this->input->post('UserName');
              $qrcode_data    = array(
                               'promoCode'      => $promoCode,
                               'endDate'        => $endDate,
                               'UserName'       => $UserName,
                               'startDate'      => $startDate
                              );
              $promocodeExist = $this->regModel->promocodeExist($promoCode);
              if($promocodeExist==1){
                    $data['error']         = array('error' => "Promo Code Already Exist !");
                    $data['promocodelist'] = $this->regModel->promocodelist();
                    $this->load->view('promocode',$data);
              }else{
                $res = $this->regModel->addpromocode($qrcode_data);
                if(!empty($res)){
                    $data['error']           = array('error' => "Promo Code Generated Successfully !");
                    $data['promocodelist']   = $this->regModel->promocodelist();
                  }else{
                    $data['error']         = array('error' => "Promo Code not Generated Successfully !");
                    $data['promocodelist'] = $this->regModel->promocodelist();
                  }
                    $this->load->view('promocode',$data);
              }

            }

         } else {
           $data['promocodelist'] = $this->regModel->promocodelist();
           $this->load->view('promocode',$data);
      }  
}
  

public function deletepromoId()
{
  
        $usersession = $this->session->userdata('usersession');
        if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('pmId', 'pmId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['promocodelist'] = $this->regModel->promocodelist(); 
                   $this->load->view('promocode',$data);
              }
              else
              {
                 $pmId     = $this->input->post('pmId');
                 $result   = $this->regModel->deletepromoId($pmId);
                 if($result==1){
                    $data['error']         = array('error' => "Promo Code Deleted Successfully !");
                    $data['promocodelist'] = $this->regModel->promocodelist();
                 }else{
                    $data['error']         = array('error' => "Promo Code Not Deleted Successfully !");
                    $data['promocodelist'] = $this->regModel->promocodelist();
                 }
                    $this->load->view('promocode',$data);
              }         

        }else{  
                $data['promocodelist'] = $this->regModel->promocodelist();
                $this->load->view('promocode',$data);
        }

}




public function apiresult()
{

  $usersession = $this->session->userdata('usersession');
  if(!empty($usersession)) {
      if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 || $usersession[0]['adminRole']==8){
           $fk_studId = $this->uri->segment(3);
           $data['apiresult'] = $this->regModel->apiresult(); 
           $this->load->view('apiresult',$data);
      }
  }else{
      redirect('welcome');
  }

}


public function statusChangedPromo()
{
  
        $usersession = $this->session->userdata('usersession');
        if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('pmId', 'pmId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['promocodelist'] = $this->regModel->promocodelist(); 
                   $this->load->view('promocode',$data);
              }
              else
              {
                 $pmId     = $this->input->post('pmId');
                 $status   = $this->input->post('status');
                
                 $result   = $this->regModel->statusChangedPromo($pmId,$status);
                 if($result==1){
                    $data['error']         = array('error' => "Promo Code Status Changed Successfully !");
                    $data['promocodelist'] = $this->regModel->promocodelist();
                 }else{
                    $data['error']         = array('error' => "Promo Code Status Not Changed !");
                    $data['promocodelist'] = $this->regModel->promocodelist();
                 }
                    $this->load->view('promocode',$data);
              }         

        } else {   
                $data['promocodelist'] = $this->regModel->promocodelist();
                $this->load->view('promocode',$data);
        }

}


public function promocode_list_student()
{

  
    $usersession = $this->session->userdata('usersession');
        if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('studentMobile', 'studentMobile', "trim|numeric|greater_than[0]");
              $this->form_validation->set_rules('studentEmail', 'studentEmail', "trim|valid_email");
              $this->form_validation->set_rules('promoCode', 'promoCode', "trim");
              
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['assign_student']        =  $this->regModel->promocode_list_student(); 
                   $data['getClass']              =  $this->regModel->getClass();
                   $data['getTeacher']            =  $this->regModel->getTeacher();
                   $data['batch']                 =  $this->regModel->getBatch();
                   $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();
                   $this->load->view('promocode_list_student',$data);
              }
              else
              {
                 $studentMobile     = $this->input->post('studentMobile');
                 $studentEmail      = $this->input->post('studentEmail');
                 $promoCode         = $this->input->post('promoCode');
                 
                 $result   = $this->regModel->promocode_list_student_filter($studentMobile,$studentEmail,$promoCode);
                 if($result){
                   $data['error']                 =  array('error' => "Data Filtered Successfully !");
                   $data['assign_student']        =  $result;
                   $data['getClass']              =  $this->regModel->getClass();
                   $data['getTeacher']            =  $this->regModel->getTeacher();
                   $data['batch']                 =  $this->regModel->getBatch();
                   $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();
                 }else{
                   $data['error']                 =  array('error' => "Data Not Filtered Successfully !");
                   $data['assign_student']        =  $this->regModel->promocode_list_student(); 
                   $data['getClass']              =  $this->regModel->getClass();
                   $data['getTeacher']            =  $this->regModel->getTeacher();
                   $data['batch']                 =  $this->regModel->getBatch();
                   $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();
                 }
                    $this->load->view('promocode_list_student',$data);
              }         

        }else{ 

              if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6){
                   $fk_studId                     = $this->uri->segment(3);
                   $data['assign_student']        = $this->regModel->promocode_list_student(); 
                   $data['getClass']              =  $this->regModel->getClass();
                   $data['getTeacher']            =  $this->regModel->getTeacher();
                   $data['batch']                 =  $this->regModel->getBatch();
                   $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();
                   $this->load->view('promocode_list_student',$data);
              }else{
                  redirect('welcome','refresh');
              }
        }

}


public function promocode_list_student_allocate()
{
    
        $usersession = $this->session->userdata('usersession');
          if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 )
          {
             $usersession = $this->session->userdata('usersession');
              if(isset($_POST['submit']))
              {
                  $this->form_validation->set_error_delimiters('<span>', '</span>');
                  $allocate   = $this->input->post('allocate');
                  $fk_date    = $this->input->post('fk_date');
                  $batchId    = $this->input->post('batchId');
                  $fk_studId  = $this->input->post('fk_studId');
                  $studentId  = $this->input->post('studentId');

                  if($allocate=="allocate"){

                    $this->form_validation->set_rules('fk_teachId', 'Teacher Name', 'trim|required');
                    $this->form_validation->set_rules('fk_feesId', 'Sub Class Name', 'trim|required');
                    $this->form_validation->set_rules('fk_studId', 'studId', 'trim|required');
                    $this->form_validation->set_rules('studentId', 'studentId', 'trim|required');

                  }elseif ($allocate=="search") {
                    
                    $this->form_validation->set_rules('fk_search_classId', 'Class Name', 'trim|required');
                    $this->form_validation->set_rules('fk_search_teachId', 'Teacher Name', 'trim|required');
                    $this->form_validation->set_rules('fk_search_sub_teachId', 'Sub Class Name', 'trim|required');
                  }
                 
                  if ($this->form_validation->run() == false) {

                        $data['assign_student']        =  $this->regModel->promocode_list_student();
                        $data['getClass']              =  $this->regModel->getClass();
                        $data['getTeacher']            =  $this->regModel->getTeacher();
                        $data['batch']                 =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_nursery();

                        $this->load->view('promocode_list_student',$data);

                  } else {


                  
                      if($allocate=="allocate") {

                            $fk_classId = 1;
                            $fk_teachId = $this->input->post('fk_teachId');
                            $fk_feesId  = $this->input->post('fk_feesId');
                            $fk_date    = $this->input->post('fk_date');
                            $batchId    = $this->input->post('batchId');


                            $updateStudentId = $this->allocatemodel->updateStudentId($fk_studId,$studentId);
                            $count_student_assign_teacher = $this->allocatemodel->tbl_allocate_teacher_to_student_count_free($fk_feesId,$fk_classId,$fk_teachId,$batchId,$fk_studId);

                            if($count_student_assign_teacher==1){
                              
                                $data['assign_student']        =  $this->regModel->promocode_list_student();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_nursery();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['error'] = array('error' => "Student Already Allocated to this Teacher");
                                $this->load->view('promocode_list_student',$data);

                            }else{

                              $res   = $this->allocatemodel->promocode_list_student_allocate($fk_classId,$fk_teachId,$fk_feesId,$fk_date,$batchId,$fk_studId,$studentId);

                              if($res==1){

                                $data['assign_student']        =  $this->regModel->promocode_list_student();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_nursery();
                                $data['error'] = array('error' => "Allocated Student Successfully !");

                              }else{

                                $data['assign_student']        =  $this->regModel->promocode_list_student();
                                $data['getClass']              =  $this->regModel->getClass();
                                $data['getTeacher']            =  $this->regModel->getTeacher();
                                $data['batch']                 =  $this->regModel->getBatch();
                                $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_nursery();
                                $data['error'] = array('error' => "Fees Is Not Paid by this Student !");
                              }
                                $this->load->view('promocode_list_student',$data);


                            }


                        } elseif ($allocate=="search") {

                            $fk_search_classId     = $this->input->post('fk_search_classId');
                            $fk_search_teachId     = $this->input->post('fk_search_teachId');
                            $fk_search_sub_teachId = $this->input->post('fk_search_sub_teachId');
                            $fk_date               = $this->input->post('fk_date');


                            $res   = $this->allocatemodel->allocate_student_search($fk_search_classId,$fk_search_teachId,$fk_search_sub_teachId,$fk_date);
                            if(!empty($res)){

                              $data['assign_student']        =  $res;
                              $data['getClass']              =  $this->regModel->getClass();
                              $data['getTeacher']            =  $this->regModel->getTeacher();
                              $data['batch']                 =  $this->regModel->getBatch();
                              $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_nursery();
                              $data['error'] = array('error' => " Data Filtered Successfully !");

                            }else{

                              $data['assign_student']        =  $res;
                              $data['getClass']              =  $this->regModel->getClass();
                              $data['getTeacher']            =  $this->regModel->getTeacher();
                              $data['batch']                 =  $this->regModel->getBatch();
                              $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data_nursery();
                              $data['error'] = array('error' => "Data Not Filtered !");
                            }
                              $this->load->view('promocode_list_student',$data);
                      
                     }


                  }

                }else{


                  $usersession = $this->session->userdata('usersession');

                  if($usersession[0]['adminRole']==1 ) {

                  if($this->session->userdata('usersession'))
                  {
                        $data['assign_student']      =   $this->allocatemodel->promocode_list_student();
                        $data['getClass']            =  $this->regModel->getClass();
                        $data['getTeacher']          =  $this->regModel->getTeacher();
                        $data['batch']               =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']   =  $this->regModel->tab_add_fees_data_nursery();

                        $this->load->view('promocode_list_student',$data);


                  } else {
                      redirect('welcome');
                  } 
              }
           }
        }

}



public function add_web_seo()
{
   
    $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole']==7  || $usersession[0]['adminRole']==6 )
       {
              if(isset($_POST['submit']))
              {
                
                    $this->form_validation->set_rules('web_Title', 'web_Title', 'trim|required');
                    $this->form_validation->set_rules('web_metaTitle', 'web_metaTitle', 'trim|required');
                    $this->form_validation->set_rules('web_metaDesc', 'web_metaDesc', 'trim|required');
                    $this->form_validation->set_rules('web_metaUrl', 'web_metaUrl', 'trim|required');
                    $this->form_validation->set_rules('web_pageKeyword', 'web_pageKeyword', 'trim|required');
                    $this->form_validation->set_rules('metaPageName', 'metaPageName', 'trim|required');

                    if ($this->form_validation->run() == false) {

                      // echo validation_errors();
                        $data['add_web_seo_list'] = $this->regModel->add_web_seo_list();
                        $data['weboggpic'] = array('error'=>'Please upload ogg Image ');
                        $this->load->view('add_web_seo',$data);

                        } else {

                        $web_Title         = $this->input->post('web_Title');
                        $web_metaTitle     = $this->input->post('web_metaTitle');
                        $web_metaDesc      = $this->input->post('web_metaDesc');
                        $web_metaUrl       = $this->input->post('web_metaUrl');
                        $web_pageKeyword   = $this->input->post('web_pageKeyword');
                        $metaPageName      = $this->input->post('metaPageName');
                        $weboggpic         =  $_FILES['weboggpic']['name'];
                        $config['upload_path']          = './uploads/weboggpic';
                        $config['allowed_types']        = 'gif|jpg|png|jpeg';

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('weboggpic'))
                        {     
                                $data['weboggpic']       = array('error' => $this->upload->display_errors());
                                $data['add_web_seo_list']   = $this->regModel->add_web_seo_list();
                                $this->load->view('add_web_seo', $data);
                        }
                        else
                        {
                            $data = array('weboggpic' => $this->upload->data());
                            $weboggpic = $data['weboggpic']['file_name'];
                        }

                        $arraydata = array( 
                                             'web_Title'        => $web_Title,
                                             'web_metaTitle'    => $web_metaTitle,
                                             'web_metaDesc'     => $web_metaDesc,
                                             'web_pageKeyword'  => $web_pageKeyword,
                                             'weboggpic'        => $weboggpic,
                                             'metaPageName'     => $metaPageName,
                                             'web_metaUrl'      => $web_metaUrl
                                          );

                        $res =  $this->regModel->add_web_seo_list_data($arraydata);
                        if($res==1){
                          $data['error'] = array("error"=>"Information Updated Successfully");
                        }else{
                          $data['error'] = array("error"=>"Information Not Updated ");
                        }
                        $data['add_web_seo_list'] = $this->regModel->add_web_seo_list();
                        $this->load->view('add_web_seo',$data);
                }
              }else{
                $data['add_web_seo_list'] = $this->regModel->add_web_seo_list();
                $this->load->view('add_web_seo',$data);
              }

        }else{
              redirect('welcome');
        }


}




public function deleteMetaweb()
{
  

  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==7 || $usersession[0]['adminRole']==6 ){

      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('webId', 'webId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['add_web_seo_list'] = $this->regModel->add_web_seo_list(); 
                   $this->load->view('add_web_seo',$data);
              }
              else
              {
                $webId     = $this->input->post('webId');
                $result     = $this->regModel->deleteMetaweb($webId);
                 if($result==1){
                    $data['error']       = array('error' => "Id Deleted Successfully !");
                    $data['add_web_seo_list'] = $this->regModel->add_web_seo_list();
                    $this->load->view('add_web_seo',$data);
                 }else{
                    $data['error']       = array('error' => "Id Not Deleted Successfully !");
                    $data['add_web_seo_list'] = $this->regModel->add_web_seo_list(); 
                    $this->load->view('add_web_seo',$data);
                 }
              }         

        }else{  
                  $data['add_web_seo_list'] = $this->regModel->add_web_seo_list();
                  $this->load->view('add_web_seo',$data);
        }
      }else{
          redirect('welcome','refresh');
      }

}


public function add_tbl_pdfcourse()
{
   
    $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole']==7 || $usersession[0]['adminRole']==6 )
       {
              if(isset($_POST['submit']))
              {
                
                    $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|required|greater_than[0]|integer');
                    $this->form_validation->set_rules('fk_planid', 'fk_planid', 'trim|required|greater_than[0]|integer');
                    if ($this->form_validation->run() == false) {

                      // echo validation_errors();
                        $data['add_tbl_pdfcourse_list'] = $this->regModel->add_tbl_pdfcourse_list();
                        $data['webpcoursePdf']          = array('error'=>'Please upload Pdf ');
                         $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();
                        $this->load->view('add_tbl_pdfcourse',$data);
                        } else {

                        $fk_classId                = $this->input->post('fk_classId');
                        $fk_planid                 = $this->input->post('fk_planid');
                        $weboggpic                 = $_FILES['webpcoursePdf']['name'];
                        $config['upload_path']     = './uploads/webpcoursePdf';
                        $config['allowed_types']   = 'gif|jpg|png|jpeg|pdf';

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('webpcoursePdf'))
                        {     
                                $data['webpcoursePdf']            = array('error' => $this->upload->display_errors());
                                $data['add_tbl_pdfcourse_list']   = $this->regModel->add_tbl_pdfcourse_list();
                                $this->load->view('add_tbl_pdfcourse', $data);
                        }
                        else
                        {
                            $data = array('webpcoursePdf' => $this->upload->data());
                            $webpcoursePdf = $data['webpcoursePdf']['file_name'];
                        }

                        $arraydata = array( 
                                             'fk_classId'      => $fk_classId,
                                             'fk_planid'       => $fk_planid,
                                             'webpcoursePdf'   => $webpcoursePdf,
                                          );

                        $res =  $this->regModel->add_tbl_pdfcourse($arraydata);
                        if($res==1){
                          $data['error'] = array("error"=>"Pdf Updated Successfully");
                        }else{
                          $data['error'] = array("error"=>"Pdf Not Updated ");
                        }
                        $data['tab_add_fees_data']      =  $this->regModel->tab_add_fees_data();
                        $data['add_tbl_pdfcourse_list'] = $this->regModel->add_tbl_pdfcourse_list();
                        $this->load->view('add_tbl_pdfcourse',$data);
                }
              }else{
                $data['add_tbl_pdfcourse_list'] = $this->regModel->add_tbl_pdfcourse_list();
                $data['tab_add_fees_data']      =  $this->regModel->tab_add_fees_data();
                $this->load->view('add_tbl_pdfcourse',$data);
              }

        }else{
              redirect('welcome');
        }


}




public function deletepdfcourse()
{
  

  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==7 || $usersession[0]['adminRole']==6 ){

      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('pdfId', 'pdfId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     

                   $data['add_tbl_pdfcourse_list'] = $this->regModel->add_tbl_pdfcourse_list(); 
                   $data['tab_add_fees_data']      =  $this->regModel->tab_add_fees_data();
                   $this->load->view('add_tbl_pdfcourse',$data);
              }
              else
              {

                $pdfId      = $this->input->post('pdfId');
                $result     = $this->regModel->deletepdfcourse($pdfId);
                 if($result==1){
                    $data['error']  = array('error' => "Id Deleted Successfully !");
                    $data['add_tbl_pdfcourse_list'] = $this->regModel->add_tbl_pdfcourse_list();
                    $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();
                    $this->load->view('add_tbl_pdfcourse',$data);
                 }else{
                    $data['error'] = array('error' => "Id Not Deleted Successfully !");
                    $data['add_tbl_pdfcourse_list'] = $this->regModel->add_tbl_pdfcourse_list(); 
                    $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();
                    $this->load->view('add_tbl_pdfcourse',$data);
                 }
              }         

        }else{  
                  $data['add_tbl_pdfcourse_list'] = $this->regModel->add_tbl_pdfcourse_list();
                  $data['tab_add_fees_data']     =  $this->regModel->tab_add_fees_data();
                  $this->load->view('add_tbl_pdfcourse',$data);
        }
      }



}




public function update_gallery()
{
   
    $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole']==7 || $usersession[0]['adminRole']==6 )
       {
              if(isset($_POST['submit']))
              {
                
                    $this->form_validation->set_rules('galleryImage', 'galleryImage', 'trim');
                    if ($this->form_validation->run() == false) {

                        $data['update_gallery_list'] = $this->regModel->update_gallery_list();
                        $data['webpcoursePdf'] = array('error'=>'Please upload Pdf ');
                        $this->load->view('update_gallery',$data);

                        } else {

                        $galleryImage                   =  $_FILES['galleryImage']['name'];
                        $config['upload_path']          = './uploads/galleryImage';
                        $config['allowed_types']        = 'gif|jpg|png|jpeg';

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('galleryImage'))
                        {     
                                $data['galleryImage']       = array('error' => $this->upload->display_errors());
                                $data['update_gallery_list']   = $this->regModel->update_gallery_list();
                                $this->load->view('update_gallery', $data);
                        }
                        else
                        {
                            $data = array('galleryImage' => $this->upload->data());
                            $galleryImage = $data['galleryImage']['file_name'];
                        }

                        $arraydata = array( 'galleryImage' => $galleryImage);
                        $res =  $this->regModel->update_gallery($arraydata);
                        if($res==1){
                          $data['error'] = array("error"=>"Gallery Images Updated Successfully");
                        }else{
                          $data['error'] = array("error"=>"Gallery Images Not Updated ");
                        }
                        $data['update_gallery_list'] =  $this->regModel->update_gallery_list();
                        $this->load->view('update_gallery',$data);
                }
              }else{
                $data['update_gallery_list'] = $this->regModel->update_gallery_list();
                $this->load->view('update_gallery',$data);
              }

        }else{
              redirect('welcome');
        }
}

public function deleteGalleryImage()
{
  
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==7 || $usersession[0]['adminRole']==6 ){

      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('gId', 'gId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     

                   $data['update_gallery_list'] = $this->regModel->update_gallery_list(); 
                   $this->load->view('update_gallery',$data);
              }
              else
              {

                $gId      = $this->input->post('gId');
                $result     = $this->regModel->deleteGalleryImage($gId);
                 if($result==1){
                    $data['error']       = array('error' => "Id Deleted Successfully !");
                    $data['update_gallery_list'] = $this->regModel->update_gallery_list(); 
                   $this->load->view('update_gallery',$data);
                 }else{
                    $data['error']       = array('error' => "Id Not Deleted Successfully !");
                    $data['update_gallery_list'] = $this->regModel->update_gallery_list(); 
                   $this->load->view('update_gallery',$data);
                 }
              }         

        }else{  
                  $data['update_gallery_list'] = $this->regModel->update_gallery_list(); 
                   $this->load->view('update_gallery',$data);
        }
      }

}



public function edit_gallery_image()
{
   
    $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole']==7 || $usersession[0]['adminRole']==6 )
       {
              if(isset($_POST['submit']))
              {
                
                    $this->form_validation->set_rules('gId', 'gId', 'trim|required|greater_than[0]|integer');
                    $this->form_validation->set_rules('galleryImage', 'galleryImage', 'trim');
                    if ($this->form_validation->run() == false) {

                        $data['update_gallery_list'] = $this->regModel->update_gallery_list();
                        $data['webpcoursePdf'] = array('error'=>'Please upload Pdf ');
                        $this->load->view('edit_gallery_image',$data);

                        } else {

                        $gId = $this->input->post('gId');
                        $galleryImage                   =  $_FILES['galleryImage']['name'];
                        $config['upload_path']          = './uploads/galleryImage';
                        $config['allowed_types']        = 'gif|jpg|png|jpeg';

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('galleryImage'))
                        {     
                                $data['galleryImage']       = array('error' => $this->upload->display_errors());
                                $data['update_gallery_list']   = $this->regModel->update_gallery_list();
                                $this->load->view('edit_gallery_image', $data);
                        }
                        else
                        {
                            $data = array('galleryImage' => $this->upload->data());
                            $galleryImage = $data['galleryImage']['file_name'];
                        }

                        $arraydata = array( 
                                             'galleryImage'   => $galleryImage,
                                          );

                        $res =  $this->regModel->edit_gallery_image($arraydata,$gId);
                        if($res==1){
                          $data['error'] = array("error"=>"Gallery Images Updated Successfully");
                        }else{
                          $data['error'] = array("error"=>"Gallery Images Not Updated ");
                        }
                        $data['update_gallery_list'] =  $this->regModel->update_gallery_list();
                        $this->load->view('edit_gallery_image',$data);
                }
              }else{
                $gid = $this->uri->segment(3);
                $data['update_gallery_list'] = $this->regModel->update_gallery_list_edit($gid);
                $this->load->view('edit_gallery_image',$data);
              }

        }else{
              redirect('welcome');
        }
}



public function parents_review_update()
{
   
    $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole']==7 || $usersession[0]['adminRole']==6 )
       {
              if(isset($_POST['submit']))
              {
                
                    $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|required|greater_than[0]|integer');
                    $this->form_validation->set_rules('parentName', 'parentName', 'trim|required');
                    $this->form_validation->set_rules('reviewDec', 'reviewDec', 'trim|required');
                    if ($this->form_validation->run() == false) {

                        $data['parents_review_update_list'] = $this->regModel->parents_review_update_list();
                        $data['parents_review_image'] = array('error'=>'Please upload Image ');
                        $this->load->view('parents_review_update',$data);

                        } else {
                           
                        $fk_classId              = $this->input->post('fk_classId');
                        $parentName              = $this->input->post('parentName');
                        $reviewDec               = $this->input->post('reviewDec');
                        $parents_review_image    =  $_FILES['parents_review_image']['name'];
                        $config['upload_path']   = './uploads/parents_review_image';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('parents_review_image'))
                        {     
                                $data['parents_review_image']       = array('error' => $this->upload->display_errors());
                                $data['parents_review_update_list'] = $this->regModel->parents_review_update_list();
                                $this->load->view('parents_review_update', $data);
                        }
                        else
                        {
                            $data = array('parents_review_image' => $this->upload->data());
                            $parents_review_image = $data['parents_review_image']['file_name'];
                        }

                        $arraydata = array( 
                                             'reviewDec'             => $reviewDec,
                                             'fk_classId'            => $fk_classId,
                                             'parentName'            => $parentName,
                                             'parents_review_image'  => $parents_review_image,
                                          );

                        $res =  $this->regModel->parents_review_update($arraydata);
                        if($res==1){
                          $data['error'] = array("error"=>"Parent Review Inserted Successfully");
                        }else{
                          $data['error'] = array("error"=>"Parent Review Inserted Not Updated ");
                        }
                        $data['parents_review_update_list'] =  $this->regModel->parents_review_update_list();
                        $this->load->view('parents_review_update',$data);
                }
              }else{
                $data['parents_review_update_list'] = $this->regModel->parents_review_update_list();
                $this->load->view('parents_review_update',$data);
              }

        }else{
              redirect('welcome');
        }
}

public function deleteParentsreview()
{
  
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==7 || $usersession[0]['adminRole']==6 ){

      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('reviwId', 'reviwId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     

                   $data['parents_review_update_list'] = $this->regModel->parents_review_update_list(); 
                   $this->load->view('parents_review_update',$data);
              }
              else
              {

                $reviwId      = $this->input->post('reviwId');
                $result       = $this->regModel->deleteParentsreview($reviwId);
                 if($result==1){
                    $data['error']       = array('error' => "Id Deleted Successfully !");
                    $data['parents_review_update_list'] = $this->regModel->parents_review_update_list(); 
                   $this->load->view('parents_review_update',$data);
                 }else{
                    $data['error']       = array('error' => "Id Not Deleted Successfully !");
                    $data['parents_review_update_list'] = $this->regModel->parents_review_update_list(); 
                   $this->load->view('parents_review_update',$data);
                 }
              }         

        }else{  
                  $data['parents_review_update_list'] = $this->regModel->parents_review_update_list(); 
                   $this->load->view('parents_review_update',$data);
        }
      }

}


public function update_seo()
{
   
    $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole']==7 || $usersession[0]['adminRole']==6)
       {
              if(isset($_POST['submit']))
              {
                
                    $this->form_validation->set_rules('web_Title', 'web_Title', 'trim|required');
                    $this->form_validation->set_rules('web_metaTitle', 'web_metaTitle', 'trim|required');
                    $this->form_validation->set_rules('web_metaDesc', 'web_metaDesc', 'trim|required');
                    $this->form_validation->set_rules('web_metaUrl', 'web_metaUrl', 'trim|required');
                    $this->form_validation->set_rules('web_pageKeyword', 'web_pageKeyword', 'trim|required');
                    $this->form_validation->set_rules('metaPageName', 'metaPageName', 'trim|required');

                    $webId = $this->input->post('webId');  
                    if ($this->form_validation->run() == false) {

                      // echo validation_errors();
                        $data['add_web_seo_list'] = $this->regModel->add_web_seo_list();
                        $data['weboggpic'] = array('error'=>'Please upload ogg Image ');
                        $data['update_web_seo_list'] = $this->regModel->update_web_seo_list($webId);
                        $this->load->view('update_seo',$data);

                        } else {

                        $web_Title         = $this->input->post('web_Title');
                        $web_metaTitle     = $this->input->post('web_metaTitle');
                        $web_metaDesc      = $this->input->post('web_metaDesc');
                        $web_metaUrl       = $this->input->post('web_metaUrl');
                        $web_pageKeyword   = $this->input->post('web_pageKeyword');
                        $metaPageName      = $this->input->post('metaPageName');
                        $oldweboggpic      = $this->input->post('oldweboggpic');
                        $weboggpic         =  $_FILES['weboggpic']['name'];
                        if(empty($weboggpic)){
                            $weboggpic = $oldweboggpic;
                        }else{

                            $config['upload_path']          = './uploads/weboggpic';
                            $config['allowed_types']        = 'gif|jpg|png|jpeg';

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            if ( ! $this->upload->do_upload('weboggpic'))
                            {     
                                    $data['weboggpic']       = array('error' => $this->upload->display_errors());
                                    $data['add_web_seo_list']   = $this->regModel->add_web_seo_list();
                                    $data['update_web_seo_list'] = $this->regModel->update_web_seo_list($webId);
                                    $this->load->view('update_seo', $data);
                            }
                            else
                            {
                                $data = array('weboggpic' => $this->upload->data());
                                $weboggpic = $data['weboggpic']['file_name'];
                            }
                        }


                        $arraydata = array( 
                                             'web_Title'        => $web_Title,
                                             'web_metaTitle'    => $web_metaTitle,
                                             'web_metaDesc'     => $web_metaDesc,
                                             'web_pageKeyword'  => $web_pageKeyword,
                                             'weboggpic'        => $weboggpic,
                                             'metaPageName'     => $metaPageName,
                                             'web_metaUrl'      => $web_metaUrl
                                          );

                        $res =  $this->regModel->update_seo_list_data($arraydata,$webId);
                        if($res==1){
                          $data['error'] = array("error"=>"Information Updated Successfully");
                        }else{
                          $data['error'] = array("error"=>"Information Not Updated ");
                        }
                        $data['add_web_seo_list'] = $this->regModel->add_web_seo_list();
                        $data['update_web_seo_list'] = $this->regModel->update_web_seo_list($webId);
                        $this->load->view('update_seo',$data);
                }
              }else{
                $webId = $this->uri->segment(3);
                $data['update_web_seo_list'] = $this->regModel->update_web_seo_list($webId);

                $this->load->view('update_seo',$data);
              }

        }else{
              redirect('welcome');
        }


}

// promo code backend start

public function checkpromocode_admin()
{
     $promoCode = $this->input->post('promoCode');
     $promoCode =  str_replace(' ', '', $promoCode);
     $promoCode = strtolower($promoCode);
     $res = $this->regModel->checkpromocode_admin($promoCode);
     echo $res;
}



public function deleteGalleryVid()
{
  
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('vgId', 'vgId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     

                   $data['videoGallery_list'] = $this->regModel->videoGallery_list(); 
                   $this->load->view('videoGallery',$data);
              }
              else
              {

                $vgId         = $this->input->post('vgId');
                $result       = $this->regModel->deleteGalleryVid($vgId);
                 if($result==1){
                    $data['error']       = array('error' => "Id Deleted Successfully !");
                    $data['videoGallery_list'] = $this->regModel->videoGallery_list(); 
                 }else{
                    $data['error']       = array('error' => "Id Not Deleted Successfully !");
                    $data['videoGallery_list'] = $this->regModel->videoGallery_list(); 
                 }
                   $this->load->view('videoGallery',$data);
              }         

        }else{  
              $data['videoGallery_list'] = $this->regModel->videoGallery_list(); 
              $this->load->view('videoGallery',$data);
        }
      }

}



public function videoGallery()
{
   
    $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 )
       {
              if(isset($_POST['submit']))
              {
                
                    $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|required|greater_than[0]|integer');
                    $this->form_validation->set_rules('eventDesc', 'eventDesc', 'trim|required');
                    $this->form_validation->set_rules('eventDate', 'eventDate', 'trim|required');
                    $this->form_validation->set_rules('videoGalleryVid', 'videoGalleryVid', 'trim|required');
                    $this->form_validation->set_rules('eventName', 'eventName', 'trim|required');
                    $this->form_validation->set_rules('eventThumbnail', 'eventThumbnail', 'trim|required');
                    if ($this->form_validation->run() == false) {

                        $data['videoGallery_list'] = $this->regModel->videoGallery_list();
                        $data['videoGalleryVid'] = array('error'=>'Please upload Image ');
                        $this->load->view('videoGallery',$data);

                        } else {
                           
                        $fk_classId              = $this->input->post('fk_classId');
                        $eventDesc               = htmlspecialchars($this->input->post('eventDesc'));
                        $eventDate               = $this->input->post('eventDate');
                        $eventName               = $this->input->post('eventName');
                        $eventThumbnail          = $this->input->post('eventThumbnail');
                        $videoGalleryVid         = $this->input->post('videoGalleryVid');
                        
                        
                        $arraydata = array( 
                                             'fk_classId'      => $fk_classId,
                                             'eventDate'       => $eventDate,
                                             'eventDesc'       => $eventDesc,
                                             'eventName'       => strtolower($eventName),
                                             'eventThumbnail'  => $eventThumbnail,
                                             'videoGalleryVid' => $videoGalleryVid,
                        );

                        $res =  $this->regModel->videoGallery($arraydata);
                        if($res==1){
                          $data['error'] = array("error"=>"Video Inserted Successfully");
                         }else{
                          $data['error'] = array("error"=>"Video  Not Updated ");
                        }
                        $data['videoGallery_list'] =  $this->regModel->videoGallery_list();
                        $this->load->view('videoGallery',$data);
                }
              }else{
                $data['videoGallery_list'] = $this->regModel->videoGallery_list();
                $this->load->view('videoGallery',$data);
              }

        }else{
              redirect('welcome');
        }
}




public function add_lead_facebook()
{
  
  $usersession  = $this->session->userdata('usersession');

  if(!empty($usersession))
  {

      if(isset($_POST['submit']))
      {

               $path = 'uploads/leads/';
               $config['upload_path'] = $path;
               $config['allowed_types'] = 'xlsx|xls|csv|CSV';
               $config['remove_spaces'] = TRUE;
               $this->load->library('upload', $config);
               $this->upload->initialize($config); 
               if (!$this->upload->do_upload('add_lead_facebook')) {
                $error         = array('error' => $this->upload->display_errors());
               } else {
                $data = array('add_lead_facebook' => $this->upload->data());
               }
               if(empty($error)){
                 if (!empty($data['add_lead_facebook']['file_name'])) {
                  $import_xls_file = $data['add_lead_facebook']['file_name'];
               } else {
                  $import_xls_file = 0;
               }
                  
               $inputFileName = $path . $import_xls_file;
              try {

                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i=0;
                    foreach ($allDataInSheet as $value) {
                    if($flag){
                    $flag =false;
                    continue;
                    }
                                 
                    $inserdata[$i]['studentName'] = $value['B'];
                    $inserdata[$i]['email'] = $value['C'];
                    $inserdata[$i]['mobile'] = $value['D'];

                    $i++;
                    }

                    foreach ($inserdata as $key => $valueData) {

                        $dataarrayapi = array('Childname' => $valueData['studentName'],'class'=>1,'mobileno' => $valueData['mobile'],'emailId' =>$valueData['email'],'source'=>'');
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
                          $result = $this->regModel->temp_enquiry_api($outputLMS); 
                        }else{
                          $result = $this->regModel->temp_enquiry_api($outputLMS); 
                       }

                    }

                    if($result == 1 ){
                          $data['error'] = array("error"=>"Lead Updated Successfully");
                        }else{
                          $data['error'] = array("error"=>"Lead Not Updated ");
                     }
                     $this->load->view('add_lead_facebook',$data);          
                       
              } catch (Exception $e) {
              die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
              . '": ' .$e->getMessage());
              }
              }else{
                echo $error['error'];
              }

               

         } else {
       
           $this->load->view('add_lead_facebook');

        }


   }

}


public function get_live_attendace()
{
  
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6){
      
       $data['get_live_attendace'] = $this->regModel->get_live_attendace(); 
       $this->load->view('get_live_attendace',$data);
  }

}



public function course_three()
{

  if($this->session->userdata('usersession'))
    {
       $data['getClass'] = $this->regModel->getClass();
       $data['coursePeriod'] = 3;
       $this->load->view('course_three',$data);
    } else {
      redirect('welcome');
    }

}


public function course_six()
{

  if($this->session->userdata('usersession'))
    {
       $data['getClass'] = $this->regModel->getClass();
       $data['coursePeriod'] = 7;
       $this->load->view('course_six',$data);
    } else {
      redirect('welcome');
    }


}


public function list_of_courseperiod()
{
  
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 ||$usersession[0]['adminRole']==5 ){

    if(isset($_POST['submit']))
      {

            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('fk_sessionId', 'fk_sessionId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('fk_dayId', 'fk_dayId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('fk_monthId', 'fk_monthId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('coursePeriod', 'coursePeriod', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('vimeoId', 'vimeoId', 'trim|numeric|greater_than[0]|numeric|max_length[9]');
            $this->form_validation->set_rules('fromDT', 'fromDT', 'trim');
            $this->form_validation->set_rules('toDT', 'toDT', 'trim');
            $fk_classId  =  $this->input->post('fk_classId');
            $coursePeriod  =  $this->input->post('coursePeriod');

            if ($this->form_validation->run() == FALSE)
            {     
                 $data['listvideouploading'] = $this->regModel->listvideo_uploading_coursePeriod($fk_classId,$coursePeriod);     
                $this->load->view('listvideouploading',$data);
            }
            else
            {

                  $fk_sessionId     =  $this->input->post('fk_sessionId');
                  $fk_dayId         =  $this->input->post('fk_dayId');
                  $fk_monthId       =  $this->input->post('fk_monthId');
                  $vimeoId          =  $this->input->post('vimeoId');
                  $fromDT           =  $this->input->post('fromDT');
                  $toDT             =  $this->input->post('toDT');
                  $coursePeriod     =  $this->input->post('coursePeriod');
                  $data = array(  
                  'fk_classId'     => $fk_classId,
                  'fk_sessionId'   => $fk_sessionId,
                  'fk_dayId'       => $fk_dayId,
                  'fk_monthId'     => $fk_monthId,
                  'vimeoId'        => $vimeoId,
                  'fromDT'         => $fromDT,
                  'toDT'           => $toDT,
                  'coursePeriod'   => $coursePeriod,
                  );
                  $filteredvideouploading = $this->regModel->filterlistvideo_uploading_coursePeriod($data);
                  if(!empty($filteredvideouploading)){
                         $data['error']              = array('error' => "Data Filtered Successfully !");
                         $data['listvideouploading'] = $filteredvideouploading;
                   } else {
                         $data['listvideouploading'] = $this->regModel->listvideo_uploading_coursePeriod($fk_classId,$coursePeriod);
                         $data['error']              = array('error' => "Data not Filtered Successfully !");
                  }
                         $this->load->view('listvideouploading',$data);

            }


      }else{
          
            $usersession = $this->session->userdata('usersession');
            if($this->session->userdata('usersession'))
            {

                   $fk_classId                 = $this->uri->segment(3);
                   $coursePeriod               = $this->uri->segment(4);
                   $data['listvideouploading'] = $this->regModel->listvideo_uploading_coursePeriod($fk_classId,$coursePeriod);
                   $data['get_month_data']     = $this->regModel->get_listvideo_uploading_coursePeriod($fk_classId,$coursePeriod); 
                   $data['fk_classId']         = $fk_classId; 
                   $data['coursePeriod']       = $coursePeriod; 
                   $this->load->view('listvideouploading',$data);
            } else {
              redirect('welcome');
            }
          }
      }
}


public function get_day_sessions_coursewise_data()
{
   
   $usersession = $this->session->userdata('usersession');    
    if($this->session->userdata('usersession'))
    {
        $dayId                    = $this->uri->segment(3);
        $monthId                  = $this->uri->segment(4);
        $fk_classId               = $this->uri->segment(5);
        $coursePeriod             = $this->uri->segment(6);
        $studId                   = "";
        $data['get_day_sessions'] = $this->regModel->get_day_sessions_coursewise_data($dayId,$monthId,$fk_classId,$studId,$coursePeriod); 
        $data['dayId']            = $dayId; 
        $data['monthId']          = $monthId; 
        $data['fk_classId']       = $fk_classId; 
        $data['recap']            = ""; 
        $data['coursePeriod']     = $coursePeriod; 
        $this->load->view('get_day_sessions',$data);
    } else {
      redirect('welcome');
    }
}

//admin homework approvel

 public function view_homework()
    {
       $fees_id             = $this->uri->segment(3);
       $data['homeworks'] = $this->regModel->homework_list($fees_id);
       $this->load->view('view_homework',$data);   
    }
    
        public function update_homework_status()
    {
       
        $home_id             = $this->input->post('home_id');
        $start_date_data     = $this->regModel->get_update_homework_status($home_id);
        $start_date          = $start_date_data[0]['start_time'];
        $get_datewise_data   = $this->regModel->get_update_work_date_wise_data($start_date);
        $get_datewise_startdate =$get_datewise_data[0]['start_time'];
        $update_status = $this->regModel->update_statusBy_admin($get_datewise_startdate);
        
        if($update_status==1){
             echo json_encode(array('success' => 'approve  successfully'));
          }
          else
          {
             echo json_encode(array('success' => 'approve  not  successfully'));
          }
         
    }


function add_value_based_video(){

 $usersession = $this->session->userdata('usersession');
  if($usersession[0]['adminRole']==5 )
  {

    if(isset($_POST['submit']))
      {

            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|numeric|greater_than[0]');
            $this->form_validation->set_rules('youtubelink', 'youtubelink', 'trim');
            $this->form_validation->set_rules('vimeoId', 'vimeoId', 'trim');
            $this->form_validation->set_rules('fromDT', 'fromDT', 'trim|required');
            $this->form_validation->set_rules('sessionName', 'sessionName', 'trim|required');
            $this->form_validation->set_rules('toDT', 'toDT', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {     
                $data['getClass']    =  $this->regModel->getClass();     
                $data['list_of_valuebased'] = $this->regModel->list_of_valuebased(); 
                $this->load->view('add_value_based_video',$data);
            }
            else
            {
              $fk_classId     =  $this->input->post('fk_classId');
              $youtubelink    =  $this->input->post('youtubelink');
              $vimeoId        =  $this->input->post('vimeoId');
              $fromDT         =  $this->input->post('fromDT');
              $toDT           =  $this->input->post('toDT');
              $dataarray      = array(
                                'fk_classId'    => $fk_classId,
                                'youtubelink'   => $youtubelink,
                                'vimeoId'       => $vimeoId,
                                'fromDT'        => date('Y-m-d', strtotime($fromDT)),
                                'toDT'          => date('Y-m-d', strtotime($toDT))
                              );

              // print_r($dataarray);die;

              $res    =  $this->regModel->add_value_based_video($dataarray);
              if($res==1){
                          $data['getClass']    =  $this->regModel->getClass(); 
                          $data['list_of_valuebased'] = $this->regModel->list_of_valuebased(); 
                          $data['error']              = array('error' => "Data Added Successfully !");
                   } else {
                          $data['getClass']    =  $this->regModel->getClass(); 
                          $data['error']              = array('error' => "Data not Added !");
                          $data['list_of_valuebased'] = $this->regModel->list_of_valuebased(); 
                   }
                         $this->load->view('add_value_based_video',$data);

            }

      }else{


              $usersession = $this->session->userdata('usersession');
                if($this->session->userdata('usersession'))
                {
                   $data['list_of_valuebased'] = $this->regModel->list_of_valuebased(); 
                   $data['getClass']    =  $this->regModel->getClass(); 
                   $this->load->view('add_value_based_video',$data);
                } else {
                  redirect('welcome');
                }
      }

    }else{
            redirect('welcome');
    }


}



public function deletevaluebasedId()
{
   $usersession = $this->session->userdata('usersession');

    if($usersession[0]['adminRole']==5 ) {

        if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('vbId', 'vbId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['list_of_valuebased'] = $this->regModel->list_of_valuebased(); 
                   $data['getClass']    =  $this->regModel->getClass(); 
                   $this->load->view('add_value_based_video',$data);
              }
              else
              {
                $vbId          = $this->input->post('vbId');
                $result = $this->regModel->deletevaluebasedId($vbId);
                 if($result==1){
                    $data['list_of_valuebased'] = $this->regModel->list_of_valuebased(); 
                    $data['getClass']    =  $this->regModel->getClass(); 
                    $data['error'] = array('error' => "Video Id Deleted Successfully !");
                 }else{
                    $data['list_of_valuebased'] = $this->regModel->list_of_valuebased(); 
                    $data['getClass']    =  $this->regModel->getClass(); 
                    $data['error'] = array('error' => "Video Id Deleted Successfully !");
                 }
                   $this->load->view('add_value_based_video',$data);
              }         

        }else{
            $data['listvideouploading'] = $this->regModel->listvideouploading();
            $this->load->view('listvideouploading',$data);
        }
    }

}

public function parents_review_update_edit()
{
   
    $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole']==7)
       {
              if(isset($_POST['submit']))
              {
                
                    $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|required|greater_than[0]|integer');
                    $this->form_validation->set_rules('parentName', 'parentName', 'trim|required');
                    $this->form_validation->set_rules('reviewDec', 'reviewDec', 'trim|required');

                    $reviwId              = $this->input->post('reviwId');

                    if ($this->form_validation->run() == false) {

                        $data['parents_review_update_list'] = $this->regModel->parents_review_update_list_edit($reviwId);
                        $data['parents_review_image'] = array('error'=>'Please upload Image ');
                        $this->load->view('parents_review_update_edit',$data);

                        } else {
                           
                        $fk_classId              = $this->input->post('fk_classId');
                        $parentName              = $this->input->post('parentName');
                        $reviewDec               = $this->input->post('reviewDec');
                        $reviwId                 = $this->input->post('reviwId');
                        $oldparents_review_image = $this->input->post('oldparents_review_image');
                        $parents_review_image    =  $_FILES['parents_review_image']['name'];
                        $config['upload_path']   = './uploads/parents_review_image';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('parents_review_image'))
                        {     
                                $data['parents_review_image']       = array('error' => $this->upload->display_errors());
                                $data['parents_review_update_list'] = $this->regModel->parents_review_update_list_edit($reviwId);
                                $this->load->view('parents_review_update_edit', $data);
                        }
                        else
                        {
                            $data = array('parents_review_image' => $this->upload->data());
                            $parents_review_image = $data['parents_review_image']['file_name'];
                        }

                        if(empty($parents_review_image)){
                          $parents_review_image = $oldparents_review_image;
                        }else{

                          $parents_review_image = $parents_review_image;
                        }

                        $arraydata = array( 
                                             'reviewDec'             => $reviewDec,
                                             'fk_classId'            => $fk_classId,
                                             'parentName'            => $parentName,
                                             'parents_review_image'  => $parents_review_image,
                                          );

                        $res =  $this->regModel->parents_review_update_edit($arraydata,$reviwId);
                        if($res==1){
                          $data['error'] = array("error"=>"Parent Review Updated Successfully");
                        }else{
                          $data['error'] = array("error"=>"Parent Review Updated Not Updated ");
                        }
                        $data['parents_review_update_list'] =  $this->regModel->parents_review_update_list_edit($reviwId);
                        $this->load->view('parents_review_update',$data);
                }
              }else{
                $reviwId = $this->uri->segment(3);
                $data['parents_review_update_list'] = $this->regModel->parents_review_update_list_edit($reviwId);
                $this->load->view('parents_review_update_edit',$data);
              }

        }else{
              redirect('welcome');
        }
}

public function partial_payment_students()
 {

   $usersession = $this->session->userdata('usersession');

   if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

   if(isset($_POST['submit']))
    {

        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim');
        $this->form_validation->set_rules('fromDT', 'fromDT', "trim");
        $this->form_validation->set_rules('toDT', 'toDT', "trim");
        $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|numeric|max_length[10]");
        if ($this->form_validation->run() == FALSE)
        {     
            $data['getnoticelist'] = $this->regModel->getstudlist_filter_studlist_partial_payment_students(); 
            $this->load->view('partial_payment_students',$data);
        }
        else
        {

          $fromDT         = $this->input->post('fromDT');
          $toDT           = $this->input->post('toDT');
          $studentEmail   = $this->input->post('studentEmail');
          $studentMobile  = $this->input->post('studentMobile');
          $paystatus      = $this->input->post('paystatus');
          $paystatusId    = $this->input->post('paystatusId');
          $data = array(  
                  'fromDT'        =>$fromDT , 
                  'toDT'          =>$toDT , 
                  'studentEmail'  =>$studentEmail , 
                  'studentMobile' =>$studentMobile , 
                );
          
            $res = $this->regModel->filter_studlist_partial_payment_students($data);
            if(!empty($res)){
              $data['error']        = array('error' => "Data Filtered Successfully !");
              $data['getstudlist']  = $res;
              $this->load->view('partial_payment_students',$data);

            }else{
                $data['error']         = array('error' => "Data not Filtered Successfully !");
                $data['getstudlist']   = $res;
                $data['getnoticelist'] = $this->regModel->getstudlist_filter_studlist_partial_payment_students();
                $this->load->view('partial_payment_students',$data);
            }

          }

      } else {

         $usersession = $this->session->userdata('usersession');
          if($this->session->userdata('usersession'))
          {
            if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

              $data['getClass']    =  $this->regModel->getClass(); 
              $data['getstudlist'] = $this->regModel->getstudlist_filter_studlist_partial_payment_students();
              $this->load->view('partial_payment_students',$data);
            } else {
              redirect('welcome');
            }
        }else{
            redirect('welcome');
        }
      }

  }
 }

public function full_payment_students()
  {

   $usersession = $this->session->userdata('usersession');

   if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

   if(isset($_POST['submit']))
    {

        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim');
        $this->form_validation->set_rules('fromDT', 'fromDT', "trim");
        $this->form_validation->set_rules('toDT', 'toDT', "trim");
        $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|numeric|max_length[10]");
        if ($this->form_validation->run() == FALSE)
        {     
            $data['getnoticelist'] = $this->regModel->getstudlist_filter_studlist_full_payment_students(); 
            $this->load->view('full_payment_students',$data);
        }
        else
        {

          $fromDT         = $this->input->post('fromDT');
          $toDT           = $this->input->post('toDT');
          $studentEmail   = $this->input->post('studentEmail');
          $studentMobile  = $this->input->post('studentMobile');
          $paystatus      = $this->input->post('paystatus');
          $paystatusId    = $this->input->post('paystatusId');
          $data = array(  
                  'fromDT'        =>$fromDT , 
                  'toDT'          =>$toDT , 
                  'studentEmail'  =>$studentEmail , 
                  'studentMobile' =>$studentMobile , 
                );
          
            $res = $this->regModel->filter_studlist_partial_payment_students($data);
            if(!empty($res)){
              $data['error']        = array('error' => "Data Filtered Successfully !");
              $data['getstudlist']  = $res;
              $this->load->view('full_payment_students',$data);

            }else{
                $data['error']         = array('error' => "Data not Filtered Successfully !");
                $data['getstudlist']   = $res;
                $data['getnoticelist'] = $this->regModel->getstudlist_filter_studlist_full_payment_students();
                $this->load->view('full_payment_students',$data);
            }

          }

      } else {

         $usersession = $this->session->userdata('usersession');
          if($this->session->userdata('usersession'))
          {
            if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

              $data['getClass']    =  $this->regModel->getClass(); 
              $data['getstudlist'] = $this->regModel->getstudlist_filter_studlist_full_payment_students();
              $this->load->view('full_payment_students',$data);
            } else {
              redirect('welcome');
            }
        }else{
            redirect('welcome');
        }
      }

  }
 }


public function updatePayment()
{
  
    $usersession = $this->session->userdata('usersession');
    
    if( $usersession[0]['adminRole']==6 )
    {

    if(isset($_POST['submit']))
    {

        $this->form_validation->set_error_delimiters('<span>', '</span>');
        
        $this->form_validation->set_rules('payAmount', 'payAmount', "trim|integer|required");
        $this->form_validation->set_rules('rowId', 'rowId', "trim|numeric|required");
        $this->form_validation->set_rules('planId', 'planId', "trim|numeric");
        $this->form_validation->set_rules('paystatusId', 'paystatusId', "trim|numeric");
        
        $rowId          = $this->input->post('rowId');
        $classId        = $this->input->post('classId');
        
        if ($this->form_validation->run() == FALSE)
        {     
            $data['updatePayment'] = $this->regModel->updatePayment($rowId); 
            $data['list_Fees']     = $this->regModel->getfees($classId);
            $this->load->view('updatePayment',$data);
        }
        else
        {

          $payAmount      = $this->input->post('payAmount');
          $rowId          = $this->input->post('rowId');
          $planId         = $this->input->post('planId');
          $paystatusId    = $this->input->post('paystatusId');
          
          if($paystatusId==1){
              $paystatus = "success";
          }else{
              $paystatus = "partial";
          }
          
          $data = array(  
                  'payAmount'      => $payAmount , 
                  'planId'         => $planId, 
                  'paystatusId'    => $paystatusId, 
                  'paystatus'      => $paystatus 
                );
          
            $res = $this->regModel->updatePaymentpartial($data,$rowId);
            if(!empty($res)){
              $data['error']         = array('error' => "Amount Updated Successfully !");
              $data['getstudlist']   = $res;
              $data['updatePayment'] = $this->regModel->updatePayment($rowId);
              $data['list_Fees']     = $this->regModel->getfees($classId);
              $this->load->view('updatePayment',$data);

            }else{
                $data['error']         = array('error' => "Amount not Updated Successfully !");
                $data['getstudlist']   = $res;
                $data['updatePayment'] = $this->regModel->updatePayment($rowId); 
                $data['list_Fees']     = $this->regModel->getfees($classId);
                $this->load->view('updatePayment',$data);
            }

          }

      } else {
    
    
          if($this->session->userdata('usersession'))
          {
             if($usersession[0]['adminRole']==6) {
               $rowId = $this->uri->segment(3);     
               $classId = $this->uri->segment(4);     
               $data['updatePayment'] = $this->regModel->updatePayment($rowId); 
               $data['list_Fees'] = $this->regModel->getfees($classId); 
               $this->load->view('updatePayment',$data);
             }else{
              redirect('welcome');
             }
          } else {
            redirect('welcome');
          }
      }
    }

  }
  
 public function delete_homework_admin(){
    
     $start_time   = $this->input->post('start_time');
     $end_time    = $this->input->post('end_time');
     $feesId    = $this->input->post('feesId');
     $home_title    = $this->input->post('home_title');
     
     $result = $this->regModel->delete_homework_admin_m($start_time,$end_time,$feesId,$home_title);
     
    if ($result == 1) {
        $this->session->set_flashdata('msg', 'homework deleted successfully');
        redirect('/dashboard/view_homework/'.$feesId);
   } else {
        $this->session->set_flashdata('msg', 'homework deleted successfully');
        redirect('/dashboard/view_homework/'.$feesId);

   }
    
}

public function update_status_homeworkk(){
    
    
     $start_time   = $this->input->post('start_time');
     $end_time    = $this->input->post('end_time');
     $feesId    = $this->input->post('feesId');
     $home_title    = $this->input->post('home_title');
       $result = $this->regModel->updatee_homework_admin_m($start_time,$end_time,$feesId,$home_title);
        if ($result == 1) {
        $this->session->set_flashdata('msg', 'homework updated successfully');
        redirect('/dashboard/view_homework/'.$feesId);
      } else {
           redirect('/dashboard/view_homework/'.$feesId);
      }
}


public function get_classroom_homework()
{

  if($this->session->userdata('usersession'))
    {
       $data['getClass'] = $this->regModel->getClass();
       $this->load->view('classroom_homework',$data);
    } else {
      redirect('welcome');
    }

}

public function homework_package()
{
   	if($this->session->userdata('usersession'))
    {
       $class_id             = $this->uri->segment(3);
       $data['getpackage_homework'] = $this->regModel->getpackage_homework($class_id);
       $this->load->view('package_homework',$data);
      
    } else {
      redirect('welcome');
    }
   	
}
  
  
  

public function updatefullpayment()
{
  
    $usersession = $this->session->userdata('usersession');
    
    if( $usersession[0]['adminRole']==6 )
    {

    if(isset($_POST['submit']))
    {
        
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('payAmount[]', 'PayAmount', "trim");
        $this->form_validation->set_rules('discount[]', 'Discount', "trim");
        $this->form_validation->set_rules('fk_adjustedAmount[]', 'Adjusted Amount', "trim");
        $this->form_validation->set_rules('fk_adjustedRemark[]', 'Adjusted Remark', "trim");
        $this->form_validation->set_rules('remarkReceipt[]', 'Remark Receipt', "trim");
        $this->form_validation->set_rules('planId[]', 'PlanId', "trim");
        $this->form_validation->set_rules('logId[]', 'LogId', "trim");
        $this->form_validation->set_rules('paystatusId[]', 'PaystatusId', "trim");
        $this->form_validation->set_rules('roundOff[]', 'roundOff', "trim");
        $this->form_validation->set_rules('augustoffer[]', 'augustoffer', "trim");
        $this->form_validation->set_rules('dueDate[]', 'dueDate', "trim");
        $this->form_validation->set_rules('dueRemark[]', 'dueRemark', "trim");
        $this->form_validation->set_rules('final_fees', 'final_fees', "trim");
        
        $studId         = $this->input->post('studId');
        
        if ($this->form_validation->run() == FALSE)
        {     
           
            $data['updatePayment'] = $this->regModel->updatefullpayment($studId); 
            $data['list_Fees']     = $this->regModel->list_Fees();
            $this->load->view('updatefullpayment',$data);
        }
        else
        {
        
          $payAmount            = $this->input->post('payAmount');
          $discount             = $this->input->post('discount');
          $logId                = $this->input->post('logId');
          $fk_adjustedAmount    = $this->input->post('fk_adjustedAmount');
          $fk_adjustedRemark    = $this->input->post('fk_adjustedRemark');
          $remarkReceipt        = $this->input->post('remarkReceipt');
          $planId               = $this->input->post('planId');
          $paystatusId          = $this->input->post('paystatusId');
          $roundOff             = $this->input->post('roundOff');
          $augustoffer          = $this->input->post('augustoffer');
          $dueRemark            = $this->input->post('dueRemark');
          $dueDate              = $this->input->post('dueDate');
          $final_fees           = $this->input->post('final_fees');
         
          
           $datas_amount             = array();
           $discount_amount          = array();
           $roundOff_amount          = array();
           $augustoffer_amount       = array();
           $fk_adjustedAmount_amount = array();
           $total_amount             = 0;
           
           
            for ($i = 0; $i < count($payAmount); $i++) 
            {
               $datas_amount[] = $payAmount[$i];
            }
            
            for ($i = 0; $i < count($discount); $i++) 
            {
               $discount_amount[] = $discount[$i];
            }
            
            for ($i = 0; $i < count($roundOff); $i++) 
            {
               $roundOff_amount[] = $roundOff[$i];
            }
            
            for ($i = 0; $i < count($augustoffer); $i++) 
            {
               $augustoffer_amount[] = $augustoffer[$i];
            }
            
            for ($i = 0; $i < count($fk_adjustedAmount); $i++) 
            {
               $fk_adjustedAmount_amount[] = $fk_adjustedAmount[$i];
            }
            
            
            $datas_amounts              = array_sum($datas_amount);
            $discount_amount            = array_sum($discount_amount);
            $roundOff_amount            = array_sum($roundOff_amount);
            $augustoffer_amount         = array_sum($augustoffer_amount);
            $fk_adjustedAmount_amount   = array_sum($fk_adjustedAmount_amount);
          
            $total_amount = $datas_amounts + $discount_amount + $augustoffer_amount + $fk_adjustedAmount_amount - $roundOff_amount;
            if($total_amount > round($final_fees) )
            {
                
                $data['updatePayment'] = $this->regModel->updatefullpayment($studId); 
                $data['list_Fees']     = $this->regModel->list_Fees();
                $data['errorpayment']  = "Total Amount is Greater Than Package Amount ";
                $this->load->view('updatefullpayment',$data);
            
                
            }else{
            
    
              
              $datas   = 
                      array(  
                      'payAmount'                => $payAmount , 
                      'planId'                   => $planId, 
                      'discount'                 => $discount, 
                      'fk_adjustedAmount'        => $fk_adjustedAmount, 
                      'fk_adjustedRemark'        => $fk_adjustedRemark,
                      'remarkReceipt'            => $remarkReceipt,
                      'paystatusId'              => $paystatusId,
                      'logId'                    => $logId,
                      'roundOff'                 => $roundOff,
                      'augustoffer'              => $augustoffer,
                      'dueRemark'                => $dueRemark,
                      'dueDate'                  => $dueDate,
                      
                    );
                $res = $this->regModel->updatefullpaymentStud($datas);
             
                if($res==1){
                  $data['error']         = array('error' => "Amount Updated Successfully !");
                  $data['getstudlist']   = $res;
                  $data['updatePayment'] = $this->regModel->updatefullpayment($studId);
                  $data['list_Fees']     = $this->regModel->list_Fees();
                  $this->load->view('updatefullpayment',$data);
    
                }else{
                    $data['error']         = array('error' => "Amount not Updated Successfully !");
                    $data['getstudlist']   = $res;
                    $data['updatePayment'] = $this->regModel->updatefullpayment($studId); 
                    $data['list_Fees']     = $this->regModel->list_Fees();
                    $this->load->view('updatefullpayment',$data);
                }
    
              }
          }

      } else {
    
    
          if($this->session->userdata('usersession'))
          {
             if($usersession[0]['adminRole']==6) {
               $studId = $this->uri->segment(3);     
               $data['updatePayment'] = $this->regModel->updatefullpayment($studId); 
               $data['list_Fees'] = $this->regModel->list_Fees(); 
               $this->load->view('updatefullpayment',$data);
             }else{
              redirect('welcome');
             }
          } else {
            redirect('welcome');
          }
      }
    }

  }




public function discountlist()
{

  if($this->session->userdata('usersession'))
    {
      $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole'] == 6)
      {
           $data['discountlist'] = $this->regModel->discountlist();
           $this->load->view('discountlist',$data);
        } else {
          redirect('welcome');
        }
    } else {
      redirect('welcome');
    }

}


public function adjustamountlist()
{

  if($this->session->userdata('usersession'))
    {
      $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole'] == 6)
      {
           $data['adjustamountlist'] = $this->regModel->adjustamountlist();
           $this->load->view('adjustamountlist',$data);
        } else {
          redirect('welcome');
        }
    }else{
          redirect('welcome');
    }


}

public function close_student_payment_status()
{

   $usersession = $this->session->userdata('usersession');

   if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

   if(isset($_POST['submit']))
    {

        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim');
        $this->form_validation->set_rules('fromDT', 'fromDT', "trim");
        $this->form_validation->set_rules('toDT', 'toDT', "trim");
        $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|numeric|max_length[10]");
        if ($this->form_validation->run() == FALSE)
        {     
            $data['getnoticelist'] = $this->regModel->getstudlist_filter_studlist_partial_payment_students(); 
            $this->load->view('close_student_payment_status',$data);
        }
        else
        {

          $fromDT         = $this->input->post('fromDT');
          $toDT           = $this->input->post('toDT');
          $studentEmail   = $this->input->post('studentEmail');
          $studentMobile  = $this->input->post('studentMobile');
          $paystatus      = $this->input->post('paystatus');
          $paystatusId    = $this->input->post('paystatusId');
          $data = array(  
                  'fromDT'        =>$fromDT , 
                  'toDT'          =>$toDT , 
                  'studentEmail'  =>$studentEmail , 
                  'studentMobile' =>$studentMobile , 
                );
          
            $res = $this->regModel->filter_studlist_close_student_payment_status($data);
            if(!empty($res)){
              $data['error']        = array('error' => "Data Filtered Successfully !");
              $data['getstudlist']  = $res;
              $this->load->view('close_student_payment_status',$data);

            }else{
                $data['error']         = array('error' => "Data not Filtered Successfully !");
                $data['getstudlist']   = $res;
                $data['getnoticelist'] = $this->regModel->getstudlist_filter_studlist_close_student_payment_status();
                $this->load->view('close_student_payment_status',$data);
            }

          }

      } else {

         $usersession = $this->session->userdata('usersession');
          if($this->session->userdata('usersession'))
          {
            if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

              $data['getClass']    =  $this->regModel->getClass(); 
              $data['getstudlist'] = $this->regModel->getstudlist_filter_studlist_close_student_payment_status();
              $this->load->view('close_student_payment_status',$data);
            } else {
              redirect('welcome');
            }
        }else{
            redirect('welcome');
        }
      }

  }
 }

public function updateFullPaymentStatus()
{
   $usersession = $this->session->userdata('usersession');
   if($this->session->userdata('usersession'))
   {
     if($usersession[0]['adminRole']==6) 
     {
       $rowId = $this->uri->segment(3);     
       $data['updatePayment'] = $this->regModel->updatefullpayment($rowId); 
       $data['list_Fees'] = $this->regModel->list_Fees(); 
       $this->load->view('updateFullPaymentStatus',$data);
     }else{
      redirect('welcome');
     }
    } else {
    redirect('welcome');
  } 

}

function  updatefinalpayment(){
    
    $usersession = $this->session->userdata('usersession');

   if($usersession[0]['adminRole']==6 ){

    if(isset($_POST['submit']))
    {
        $studId = $this->input->post('studId');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('studId', 'studId', "trim|required|integer");
        if ($this->form_validation->run() == FALSE)
        {     
            $data['updatePayment'] = $this->regModel->updatefullpayment($studId);  
            $this->load->view('updateFullPaymentStatus',$data);
        }
        else
        {
            
            $res = $this->regModel->updatefinalpayment($studId);
            
            if($res == 1)
            {
              $data['error']        = array('error' => "Close Payment Successfully !");
              $data['updatePayment'] = $this->regModel->updatefullpayment($studId); 
              $this->load->view('updateFullPaymentStatus',$data);

             } else {
                 
              $data['error']         = array('error' => "Close Payment Unsccessfully !");
              $data['updatePayment'] = $this->regModel->updatefullpayment($studId); 
              $this->load->view('updateFullPaymentStatus',$data);
            }
                
        }
        
     }
    
   }
    
}


public function closeaccountlist(){
    
     $usersession = $this->session->userdata('usersession');

       if(isset($_POST['submit']))
        {
            
            $studId = $this->input->post('studId');
            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('studentMobile', 'studentMobile', "trim|max_length[10]");
            $this->form_validation->set_rules('studentEmail', 'studentEmail', "trim|valid_email");
            $this->form_validation->set_rules('fromDT', 'fromDT', "trim");
            $this->form_validation->set_rules('toDT', 'toDT', "trim");
            if ($this->form_validation->run() == FALSE)
            {     
                $data['updatePayment'] = $this->regModel->updatefullpayment();  
                $this->load->view('closeaccountlist',$data);
            }
            else
            {
                
                $studentMobile = $this->input->post('studentMobile');
                $studentEmail  = $this->input->post('studentEmail');
                $fromDT        = $this->input->post('fromDT');
                $toDT          = $this->input->post('toDT');
                
                $res = $this->regModel->closeaccountlistfilter($studentMobile,$studentEmail,$fromDT,$toDT);
                if(!empty($res))
                {
                  $data['error']        = array('error' => "Data Filtered Successfully !");
                  $data['updatePayment'] = $res; 
                  
                 } else {
                     
                  $data['error']       = array('error' => "Data is not Filtered Successfully !");   
                  $data['getstudlist'] = $this->regModel->closeaccountlist();
                  
                }
                
                $this->load->view('closeaccountlist', $data);
                
            }
            
        }else{
      
              if($usersession[0]['adminRole']==6) {
        
                  if($this->session->userdata('usersession'))
                    {       $data['getstudlist'] = $this->regModel->closeaccountlist();
                            $this->load->view('closeaccountlist', $data);
                    } else {
                      redirect('welcome');
                    }
        
           }
       }
   
}
public function updateFinalPaymentStatus(){
    
    $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==6) {

         if($this->session->userdata('usersession'))
         {
                   $studId = $this->uri->segment(3);
                   $data['updatePayment'] = $this->regModel->updateFinalPaymentStatus($studId);
                   $this->load->view('updateFinalPaymentStatus', $data);
                   
            } else {
                
              redirect('welcome');
              
        }

   }
   
}


function add_video(){

 $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==5) {

          if($this->session->userdata('usersession'))
            {
               $classId         = $this->uri->segment(3); 
               $where_to_upload = $this->uri->segment(4);
               $whereupload     = $this->uri->segment(5); 
               $data['classId'] = $classId;
               $data['where_to_upload'] = $where_to_upload;
               $data['whereupload'] = $whereupload;
               $this->load->view('add_video', $data);
            } else {
              redirect('welcome');
            }
      }

}

function add_next_step(){

 $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==5) {

          if($this->session->userdata('usersession'))
            {
               $classId         = $this->uri->segment(3);             
               $monthId         = $this->uri->segment(4); 
               $where_to_upload = $this->uri->segment(5);    
               $whereupload     = $this->uri->segment(6); 
               $data['classId'] = $classId;
               $data['monthId'] = $monthId;
               $data['whereupload']     = $whereupload;
               $data['where_to_upload'] = $where_to_upload;
               $this->load->view('add_next_step', $data);
            } else {
              redirect('welcome');
            }
      }

}


public function add_next_to_next_step()
{
    
   $usersession = $this->session->userdata('usersession');
   if($usersession[0]['adminRole']==5 ) {

     if(isset($_POST['submit']))
     {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('fk_contentId', 'fk_contentId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|required');
          $this->form_validation->set_rules('content_title', 'content_title', 'trim|required');
          $this->form_validation->set_rules('vimeoId', 'vimeoId', 'trim|numeric');
          $this->form_validation->set_rules('youtubelink', 'youtubelink', 'trim');
          $this->form_validation->set_rules('fk_sessionId', 'fk_sessionId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_monthId', 'monthId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_catId', 'monthId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_dayId', 'dayId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_squenceId', 'squenceId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_upload_key', 'fk_upload_key', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('coursePeriod', 'coursePeriod', 'trim|numeric');
          $this->form_validation->set_rules('relatedyoutubelink', 'relatedyoutubelink', 'trim');

          $fk_classId = $this->input->post('fk_classId');
          $fk_monthId = $this->input->post('fk_monthId');
          $fk_dayId   = $this->input->post('fk_dayId');

          if ($this->form_validation->run() == FALSE)
          {     
            
              $data['error']                =  array();
              $data['fk_classId']           = $fk_classId;
              $data['monthId']              = $fk_monthId;
              $data['dayId']                = $fk_dayId;
              $data['fk_upload_key']        = $fk_upload_key;
              $data['where_to_upload']      = $coursePeriod;
              $data['get_day_sessions']     = $this->regModel->get_day_sessions_recap($dayId,$monthId,$fk_classId,$studId,$fk_upload_key,$coursePeriod);
              
          }
          else
          {

                $fk_classId         = $this->input->post('fk_classId');
                $content_title      = $this->input->post('content_title');
                $fk_catId           = $this->input->post('fk_catId');
                $fk_contentId       = $this->input->post('fk_contentId');
                $vimeoId            = $this->input->post('vimeoId');
                $youtubelink        = $this->input->post('youtubelink');
                $fk_sessionId       = $this->input->post('fk_sessionId');
                $fk_monthId         = $this->input->post('fk_monthId');
                $fk_dayId           = $this->input->post('fk_dayId');
                $fk_squenceId       = $this->input->post('fk_squenceId');
                $param              = $this->input->post('param');
                $relatedyoutubelink = $this->input->post('relatedyoutubelink');
                $fk_upload_key      = $this->input->post('fk_upload_key');
                $coursePeriod       = $this->input->post('coursePeriod');
                if(!empty($_FILES))
                {
                    $contentfile    = $_FILES['contentfile']['name'];
                }else{
                    $contentfile    = "";
                }

                $config['upload_path']          = './uploads/contentfile';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|pps|ppsx|ppt|pptx|gz|tgz|zip';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('contentfile'))
                {
                        $data['error']            = array('contentfile' => $this->upload->display_errors());
                        $data['fk_classId']       = $fk_classId;
                        $data['monthId']          = $fk_monthId;
                        $data['dayId']            = $fk_dayId;
                        $data['where_to_upload']  = $coursePeriod;
                        $data['fk_upload_key']    = $fk_upload_key;
                        $studId                    = ""; 
                        $data['get_day_sessions']  = $this->regModel->get_day_sessions_recap($fk_dayId,$fk_monthId,$fk_classId,$studId,$fk_upload_key,$coursePeriod);
                       
                }
                else
                {
                        $data = array('contentfile' => $this->upload->data());
                        $contentfile = $data['contentfile']['file_name'];
                        
                }

               
                $videouploadingdata = array(  
                          'fk_classId'         => $fk_classId , 
                          'content_title'      => $content_title , 
                          'fk_catId'           => $fk_catId , 
                          'fk_contentId'       => $fk_contentId, 
                          'vimeoId'            => $vimeoId , 
                          'youtubelink'        => $youtubelink , 
                          'fk_sessionId'       => $fk_sessionId , 
                          'fk_monthId'         => $fk_monthId , 
                          'fk_dayId'           => $fk_dayId, 
                          'contentfile'        => $contentfile, 
                          'fk_squenceId'       => $fk_squenceId, 
                          'fk_upload_key'      => $fk_upload_key, 
                          'coursePeriod'       => $coursePeriod, 
                          'status'             => 1, 
                        );

                $fk_monthId_exist = $this->regModel->fk_monthId_exist($fk_monthId,$fk_dayId,$fk_sessionId,$fk_classId,$fk_upload_key,$coursePeriod);
                if($fk_monthId_exist==1){
                  $data['error'] = array('error' => "Month and Day or Course Period Already Exist !");
                  $data['where_to_upload']   = $coursePeriod;
                  $data['fk_upload_key']     = $fk_upload_key;
                  $studId                    = ""; 
                  $data['get_day_sessions']  = $this->regModel->get_day_sessions_recap($fk_dayId,$fk_monthId,$fk_classId,$studId,$fk_upload_key,$coursePeriod);
                  $this->load->view('add_next_to_next_step',$data);
                }else{
                  $res = $this->regModel->videouploading($videouploadingdata);
                  if($res==1){
                         $data['error']            = array('error' => "Session Created Successfully !");
                         $data['fk_classId']       = $fk_classId;
                         $data['monthId']          = $fk_monthId;
                         $data['dayId']            = $fk_dayId;
                         $data['where_to_upload']  = $coursePeriod;
                         $data['fk_upload_key']    = $fk_upload_key;
                        $studId                    = ""; 
                        $data['get_day_sessions']  = $this->regModel->get_day_sessions_recap($fk_dayId,$fk_monthId,$fk_classId,$studId,$fk_upload_key,$coursePeriod);
                     } else {
                         $data['error']            = array('error' => "Session not Created Successfully !");
                         $data['fk_classId']       = $fk_classId;
                         $data['monthId']          = $fk_monthId;
                         $data['dayId']            = $fk_dayId;
                         $data['where_to_upload']  = $coursePeriod;
                         $data['fk_upload_key']    = $fk_upload_key;
                         $studId                    = ""; 
                         $data['get_day_sessions']  = $this->regModel->get_day_sessions_recap($fk_dayId,$fk_monthId,$fk_classId,$studId,$fk_upload_key,$coursePeriod);
                    }
                    $this->load->view('add_next_to_next_step',$data);
                }
          }

    }else{

         
              if($usersession[0]['adminRole']==5) {

                  if($this->session->userdata('usersession'))
                    {
                       $classId                  = $this->uri->segment(3);             
                       $monthId                  = $this->uri->segment(4);             
                       $dayId                    = $this->uri->segment(5); 
                       $where_to_upload          = $this->uri->segment(6); 
                       $whereupload              = $this->uri->segment(7);
                       $data['fk_classId']       = $classId;
                       $data['monthId']          = $monthId;
                       $data['dayId']            = $dayId;
                       $data['where_to_upload']  = $where_to_upload;
                       $data['fk_upload_key']    = $whereupload;
                       $studId = "";
                       $data['get_day_sessions'] = $this->regModel->get_day_sessions_recap($dayId,$monthId,$classId,$studId,$whereupload,$where_to_upload);
                       $this->load->view('add_next_to_next_step', $data);
                    } else {
                      redirect('welcome');
                    }
              }
      }

  }else{
    redirect('welcome');
  }
}



function where_to_upload(){

 $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==5) {

          if($this->session->userdata('usersession'))
            {
               $classId         = $this->uri->segment(3);             
               $data['classId'] = $classId;
               $data['where_to_upload'] = $this->regModel->where_to_upload();
               $this->load->view('where_to_upload', $data);
            } else {
              redirect('welcome');
            }
      }

}


function uploadwhere(){

 $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==5) {

          if($this->session->userdata('usersession'))
            {
               $classId                = $this->uri->segment(3);             
               $coursePeriodId         = $this->uri->segment(4);             
               $data['classId']        = $classId;
               $data['coursePeriodId'] = $coursePeriodId;
               $data['uploadwhere']    = $this->regModel->uploadwhere();
               $this->load->view('uploadwhere', $data);
            } else {
              redirect('welcome');
            }
      }

}


function edit_session(){


$usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==5 ) {
      
    if(isset($_POST['submit']))
    {
        
       
          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('sessionId', 'sessionId', 'trim|required|numeric|greater_than[0]');

          $sessionId  = $this->input->post('sessionId');
          if ($this->form_validation->run() == FALSE)
          {     
            
              $data['edit_session'] = $this->regModel->edit_session($sessionId);
              $this->load->view('edit_session',$data);
          }
          else
          {
                    
                   
                if(!empty($_FILES)){
                    $sessionImages        = $_FILES['sessionImages']['name'];
                }else{
                    $sessionImages = "";
                }
                
                $config['upload_path']          = './uploads/sessionImages';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('sessionImages'))
                {
                        $data['error'] = array('sessionImages' => $this->upload->display_errors());
                        $this->load->view('edit_session', $data);
                }
                else
                {
                        $data = array('sessionImages' => $this->upload->data());
                        $sessionImages = $data['sessionImages']['file_name'];
                }

               
                  $sessiondata = array('sessionImages'=> $sessionImages);
                
                  $res = $this->regModel->edit_session_update($sessiondata,$sessionId);
                  if($res==1){
                         $data['error'] = array('error' => "Session Updated Successfully !");
                         $data['edit_session'] = $this->regModel->edit_session($sessionId);
                   } else {
                          $data['error'] = array('error' => "Session not Updated Successfully !");
                          $data['edit_session'] = $this->regModel->edit_session($sessionId);

                  }
                 $this->load->view('edit_session',$data);      

          }


    }else{

              $sessionId = $this->uri->segment(3);
              $data['edit_session'] = $this->regModel->edit_session($sessionId);
              $this->load->view('edit_session',$data);
            
         }
  }


}



public function sendPaymentreminder()
{

  $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==6) {

          if($this->session->userdata('usersession'))
            {
               $studId   = $this->input->post('studId'); 
               $res      = $this->regModel->sendPaymentreminder($studId);       
              if($res==1){
                echo "1";
              }else{
                echo "0";
              }
            } else {
              redirect('welcome');
            }
      }
  
}





public function addpackage()
{

  $usersession = $this->session->userdata('usersession');
 
    if( $usersession[0]['adminRole']==1 ) {

       if(isset($_POST['submit']))
       {
        
          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('packageName', 'packageName', 'trim|required');
          
          if ($this->form_validation->run() == FALSE)
          {     
        
              $data['getpackage'] = $this->regModel->getpackage();
              $this->load->view('addpackage',$data);
          }
          else
          {

            $packageName   = $this->input->post('packageName'); 
            $data          = array('packageName'=>$packageName); 
            $res           = $this->regModel->addpackage($data);       
             if($res==1){
                $data['error'] = array('error' => "Packages Inserted Successfully !");
                $data['getpackage'] = $this->regModel->getpackage();
              }else{
                $data['error'] = array('error' => "Packages Not Inserted Successfully !");
                $data['getpackage'] = $this->regModel->getpackage();
              }
            $this->load->view('addpackage',$data);
          } 
      }else {

          $usersession = $this->session->userdata('usersession');
          if( $usersession[0]['adminRole']==1 ) {
          $data['getpackage'] = $this->regModel->getpackage();
          $this->load->view('addpackage',$data);
      }
             
    }       
  }

}

public function addAdmin()
{

  $usersession = $this->session->userdata('usersession');
 
    if( $usersession[0]['adminRole']==6 ) {

       if(isset($_POST['submit']))
       {
        
          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('studentName', 'studentName', 'trim|required');
          $this->form_validation->set_rules('studentEmail', 'studentEmail', 'trim|required|valid_email');
          $this->form_validation->set_rules('studentMobile', 'studentMobile', 'trim|required|max_length[10]');
          
          if ($this->form_validation->run() == FALSE)
          {     
        
              $data['adminlist'] = $this->regModel->get_tbl_admin_role();
              $this->load->view('addAdmin',$data);
          }
          else
          {

            $studentName     = $this->input->post('studentName'); 
            $studentEmail    = $this->input->post('studentEmail'); 
            $studentMobile   = $this->input->post('studentMobile'); 
            $adminRole       = $this->input->post('adminRole'); 
            $normalPass      = "admin@".rand(1111,9999);
            $randpass        = sha1($normalPass);
            $data            = array('studentName'=>$studentName,'studentEmail'=>$studentEmail,'studentMobile'=>$studentMobile,'adminRole'=>$adminRole,'studentPass'=>$randpass,'studentStatus'=>1); 
            $res             = $this->regModel->add_tbl_admin_role($data);       
            if($res==1){
                
                $message = trim("Your Admin Password is ".$normalPass."");
                $htmlContent =  $message;
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->to($studentEmail);
                $this->email->from('info.vedictree@gmail.com','Vedic Tree School');
                $this->email->subject('Password for Admin login');
                $this->email->message($htmlContent);
                $result = $this->email->send();
            
                $data['error'] = array('error' => "Sub Admin Inserted Successfully !");
                $data['adminlist'] = $this->regModel->get_tbl_admin_role();
                $data['adminlistRole'] = $this->regModel->get_tbl_admin_ved();
              } else {
                $data['error'] = array('error' => "Sub Admin Not Inserted Successfully !");
                $data['adminlist'] = $this->regModel->get_tbl_admin_role();
                $data['adminlistRole'] = $this->regModel->get_tbl_admin_ved();
            }
            $this->load->view('addAdmin',$data);
          } 
      }else {

          $usersession = $this->session->userdata('usersession');
          if( $usersession[0]['adminRole']==6 ) {
          $data['adminlistRole'] = $this->regModel->get_tbl_admin_ved();
          $data['adminlist'] = $this->regModel->get_tbl_admin_role();
          $this->load->view('addAdmin',$data);
      }
             
    }       
  }

}


public function showpdf_system()
{
    

    $usersession = $this->session->userdata('usersession');
    $logId = $this->uri->segment(3);
    $studId = $this->uri->segment(4);
    $data['payment_his_data'] = $this->regModel->payment_his_data_showpdf($studId,$logId);
    $this->load->view('showpdf_system',$data);
   
    

}


public function deleteroleId()
{
  $usersession = $this->session->userdata('usersession');

  if($usersession[0]['adminRole']==6){

      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('studId', 'studId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['adminlistRole'] = $this->regModel->get_tbl_admin_ved();
                   $data['adminlist'] = $this->regModel->get_tbl_admin_role(); 
                   $this->load->view('addAdmin',$data);
              }
              else
              {
                $studId     = $this->input->post('studId');
                $result     = $this->regModel->deleteroleId($studId);
                 if($result==1){
                    $data['error']       = array('error' => "Student Id Deleted Successfully !");
                    $data['adminlistRole'] = $this->regModel->get_tbl_admin_ved();
                    $data['adminlist'] = $this->regModel->get_tbl_admin_role(); 
                    $this->load->view('addAdmin',$data);
                 }else{
                    $data['error']       = array('error' => "Student Id Not Deleted Successfully !");
                    $data['adminlistRole'] = $this->regModel->get_tbl_admin_ved();
                    $data['adminlist'] = $this->regModel->get_tbl_admin_role();
                    $this->load->view('addAdmin',$data);
                 }
              }         

        }else{  
                  $data['adminlistRole'] = $this->regModel->get_tbl_admin_ved();
                  $data['adminlist'] = $this->regModel->get_tbl_admin_role();
                  $this->load->view('addAdmin',$data);
        }
      }


}


public function deleteAllocation()
{
  $usersession = $this->session->userdata('usersession');

	if($usersession[0]['adminRole']==1 || $usersession[0]['adminRole']==6 ){

      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('studId', 'studId', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                        $data['assign_student']      =  $this->allocatemodel->allocate_student_search_without_filter_nursery();
                        $data['getClass']            =  $this->regModel->getClass();
                        $data['getTeacher']          =  $this->regModel->getTeacher();
                        $data['batch']               =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']   =  $this->regModel->tab_add_fees_data_nursery();
                        $this->load->view('assign_student_manual',$data);
              }
              else
              {
                  
                $studId     = $this->input->post('studId');
                $result = $this->regModel->deleteAllocation($studId);
                 if($result==1){
                        $data['error'] = array('error' => "Student Id Deleted Successfully !");
                        $data['assign_student']      =   $this->allocatemodel->allocate_student_search_without_filter_nursery();
                        $data['getClass']            =  $this->regModel->getClass();
                        $data['getTeacher']          =  $this->regModel->getTeacher();
                        $data['batch']               =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']   =  $this->regModel->tab_add_fees_data_nursery();
                        $this->load->view('assign_student_manual',$data);
                 } else {
                        $data['error'] = array('error' => "Student Id Not Deleted Successfully !");
                        $data['assign_student']      =   $this->allocatemodel->allocate_student_search_without_filter_nursery();
                        $data['getClass']            =  $this->regModel->getClass();
                        $data['getTeacher']          =  $this->regModel->getTeacher();
                        $data['batch']               =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']   =  $this->regModel->tab_add_fees_data_nursery();
                        $this->load->view('assign_student_manual',$data);
                 }
              }         

        }else{  
            
                        $data['assign_student']      =  $this->allocatemodel->allocate_student_search_without_filter_nursery();
                        $data['getClass']            =  $this->regModel->getClass();
                        $data['getTeacher']          =  $this->regModel->getTeacher();
                        $data['batch']               =  $this->regModel->getBatch();
                        $data['tab_add_fees_data']   =  $this->regModel->tab_add_fees_data_nursery();
                        $this->load->view('assign_student_manual',$data);
        }
      }
}



//teacher access credentials 

public function teacher_inserted_info()
{
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 6){
         $this->load->view('teacher_register');
      }else{
          redirect('welcome');
      }
}

public function teacher_get_information()
{
   
      $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole'] == 6)
      {
           $data['teacher_information'] = $this->regModel->teacher_detail();
           $this->load->view('teacher_info', $data); 
           
      }else{
          
          redirect('welcome');
      }
}

public function registration_form()
{
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 6)
      {
            if (isset($_POST['submit'])) {
                
            $this->form_validation->set_error_delimiters("<span>", "</span>");
            $this->form_validation->set_rules("teacherName", "Teacher Name", "trim|required");
            $this->form_validation->set_rules("teacherMobile", "Teacher Mobile", "trim|required");
            $this->form_validation->set_rules("teacherEmail", "Teacher E-email", "trim|required");
            $this->form_validation->set_rules("teacherPass", "Teacher Password", "trim|required");
            $this->form_validation->set_rules("teacherClass", "Teacher Class", "trim|required");
            $this->form_validation->set_rules("teacherGender", "Teacher Gender", "trim|required");
            
            if ($this->form_validation->run() == false) {
                
                $this->load->view('teacher_register');
                
            } else {
                
                $teacher_name     = $this->input->post('teacherName');
                $teacher_mobile   = $this->input->post('teacherMobile');
                $teacher_email    = $this->input->post('teacherEmail');
                $teacher_password = $this->input->post('teacherPass');
                $teacherClass     = $this->input->post('teacherClass');
                $teacherGender    = $this->input->post('teacherGender');
                
                $data             = array(
                    
                    'teacherName'       => $teacher_name,
                    'teacherMobile'     => $teacher_mobile,
                    'teacherEmail'      => $teacher_email,
                    'teacherClass'      => $teacherClass,
                    'teacherGender'     => $teacherGender,
                    'teacherPass'       => sha1($teacher_password),
                    'adminRole'         => 1,
                    'teacherStatus'     => 1
                    
                );
                
                $res  = $this->regModel->teacher_registion($data);
                if ($res == 1) {
                    $data['error'] = array('error' => 'Registration Successfully');
                } else {
                    $data['error'] = array('error' => 'Registration Not successfully');
                }
                
                $this->load->view('teacher_register', $data);
            }
        } else {
            $this->load->view('teacher_register');
        }
      }else{
          redirect('welcome');
      }
}


public function deleteteach_id()
{
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 6)
      {
            $teach_id = $_POST['teacherId'];
            $res      = $this->regModel->teacher_delete($teach_id);
            if($res == 1)
            {
                 $this->session->set_flashdata('msg','Deleted Successfully');
                 redirect('dashboard/teacher_get_information');
            }
             
      } else {
           redirect('welcome');
      }
}




public function followupenquiry()
{
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 10)
      {
          if (isset($_POST['submit'])) {
            $this->form_validation->set_error_delimiters("<span>", "</span>");
            $this->form_validation->set_rules("admissionStatus", "Admission Status", "trim|required");
            $this->form_validation->set_rules("remark", "Message", "trim|required");
            $this->form_validation->set_rules("fk_studId", "fk_studId", "trim|required|integer");
            $this->form_validation->set_rules("democlassStatus", "democlassStatus", "trim|required");
            $this->form_validation->set_rules("nextflwDT", "nextflwDT", "trim");
            $this->form_validation->set_rules("demolcassTime", "demolcassTime", "trim");
            if ($this->form_validation->run() == false) {
                $data['get_temp_enquiry'] = $this->regModel->get_temp_enquiry();
                $data['selectdemochoice'] = $this->selectdemochoice;
                $this->load->view('get_temp_enquiry',$data);
            } else {
                date_default_timezone_set('Asia/Kolkata');
                $admissionStatus     = $this->input->post('admissionStatus');
                $remark              = $this->input->post('remark');
                $fk_studId           = $this->input->post('fk_studId');
                $nextflwDT           = $this->input->post('nextflwDT');
                $demolcassTime       = $this->input->post('demolcassTime');
                $democlassStatus     = $this->input->post('democlassStatus');
                $data                = array(
                    'remark'            => $remark,
                    'admissionStatus'   => $admissionStatus,
                    'fk_studId'         => $fk_studId,
                    'followupDT'        => date("Y-m-d h:i:s"),
                    'nextflwDT'         => date('Y-m-d', strtotime($nextflwDT)),
                    'democlassStatus'   => $democlassStatus,
                    'demolcassTime'     => $demolcassTime,
                    'fk_loginId'        => $usersession[0]['studId'],
                );
                $res  = $this->regModel->followupenquiry($data);
                if ($res == 1) {
                    $data['error'] = array('error' => 'Follow up data inserted Successfully');
                } else {
                    $data['error'] = array( 'error' => 'Follow up data Not Inserted successfully');
                }
                  $data['get_temp_enquiry'] = $this->regModel->get_temp_enquiry();
                 $data['selectdemochoice'] = $this->selectdemochoice;
                  $this->load->view('get_temp_enquiry',$data);
            }
        } else {
            $data['get_temp_enquiry'] = $this->regModel->get_temp_enquiry();
            $data['selectdemochoice'] = $this->selectdemochoice;
            $this->load->view('get_temp_enquiry',$data);
        }
        
      }else{
          redirect('welcome');
      }
}


public function leadfollowup()
{
    $usersession = $this->session->userdata('usersession');
    if($usersession[0]['adminRole'] == 6)
      {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_error_delimiters("<span>", "</span>");
            $this->form_validation->set_rules("studentName", "studentName", "trim");
            $this->form_validation->set_rules("studentEmail", "studentEmail", "trim|valid_email");
            $this->form_validation->set_rules("studentMobile", "studentMobile", "trim|integer|max_length[10]");
            if ($this->form_validation->run() == false) {
                 $data['leadfollowup']      = $this->regModel->leadfollowup();
                $this->load->view('leadfollowup',$data);
            } else {
                date_default_timezone_set('Asia/Kolkata');
                $studentName     = $this->input->post('studentName');
                $studentEmail    = $this->input->post('studentEmail');
                $studentMobile   = $this->input->post('studentMobile');
                $res  = $this->regModel->search_leadfollowup($studentName,$studentEmail,$studentMobile);
                if (!empty($res)) {
                    $data['error'] = array('error' => 'Follow up data fetch Successfully');
                } else {
                    $data['error'] = array( 'error' => 'Follow up data Not fetch successfully');
                }
                  $data['leadfollowup']  = $res ; 
                  $res      = $this->regModel->leadfollowup();
                  $this->load->view('leadfollowup',$data);
            }
        } else {
        
              if($usersession[0]['adminRole'] == 6)
              {
                    $data['leadfollowup']      = $this->regModel->leadfollowup();
                    $this->load->view('leadfollowup',$data);
              } else {
                   redirect('welcome');
              }
        }
          
      } else {
        redirect('welcome');
    }
}































}

?>