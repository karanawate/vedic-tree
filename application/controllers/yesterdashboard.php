<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  
  public function index()
  {
    
    $usersession = $this->session->userdata('usersession');
      if($this->session->userdata('usersession'))
      {

        $data['count_student']          = $this->regModel->count_student();
        $data['count_session']          = $this->regModel->count_session();
        $data['count_revenue']          = $this->regModel->count_revenue();
        $data['count_category']         = $this->regModel->count_category();
        $data['count_active_student']   = $this->regModel->count_active_student();
        $data['count_inactive_student']  = $this->regModel->count_inactive_student();
        $data['count_session_content']  = $this->regModel->count_session_content();


        $this->load->view('dashboard',$data);
      } else {
        redirect('welcome');
      }

  }

  public function getstudlist()
  {
   
   if(isset($_POST['submit']))
    {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim');
          $this->form_validation->set_rules('fromDT', 'fromDT', "trim");
          $this->form_validation->set_rules('toDT', 'toDT', "trim");
          $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|numeric|max_length[10]");
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
              $data = array(  
                      'fromDT'        =>$fromDT , 
                      'toDT'          =>$toDT , 
                      'studentEmail'  =>$studentEmail , 
                      'studentMobile' =>$studentMobile , 
                  );
              
                $res = $this->regModel->filter_studlist($data);
                if(!empty($res)){
                  $data['error'] = array('error' => "Data Filtered Successfully !");
                  $data['getstudlist'] = $res;
                  $this->load->view('getstudlist',$data);

                }else{
                    $data['error'] = array('error' => "Data not Filtered Successfully !");
                    $data['getstudlist'] = $this->regModel->getnoticelist();
                    $this->load->view('getstudlist',$data);
                }

          }

      } else {

         $usersession = $this->session->userdata('usersession');
          if($this->session->userdata('usersession'))
          {
            $data['getClass']    =  $this->regModel->getClass();
            $data['getstudlist'] = $this->regModel->getstudlist(); 
            $this->load->view('getstudlist',$data);
          } else {
            redirect('welcome');
          }
      }

  }

public function getnoticelist()
{
  
    $usersession = $this->session->userdata('usersession');
      if($this->session->userdata('usersession'))
      {
        $data['getnoticelist'] = $this->regModel->getnoticelist(); 
         $this->load->view('getnoticelist',$data);
      } else {
        redirect('welcome');
      }

  }

  public function change_status()
  {
      $usersession = $this->session->userdata('usersession');
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

public function deletestudid()
{
  
  $usersession = $this->session->userdata('usersession');
     
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
public function deletenotid()
{
  
   $usersession = $this->session->userdata('usersession');
     
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



public function deletecatId()
{
    $usersession = $this->session->userdata('usersession');
     
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


public function delesessionId()
{
    $usersession = $this->session->userdata('usersession');
     
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



public function edit()
{
  if(isset($_POST['submit']))
    {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('studentName', 'Student Full Name', 'trim|required');
          $this->form_validation->set_rules('studentEmail', 'Student Email', 'trim|required|valid_email');
          $this->form_validation->set_rules('studId', 'studId', "trim|required|numeric|greater_than[0]");
          $this->form_validation->set_rules('studentMobile', 'Student Mobile', "trim|required|numeric|max_length[10]");
          $studId        = $this->input->post('studId');
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
              $studId          = $this->input->post('studId');

              $data = array(  
                      'studentName'   => $studentName , 
                      'studentEmail'  => $studentEmail , 
                      'studentMobile' => $studentMobile , 
                      'studId'        => $studId , 
                  );

                $res = $this->regModel->edit_reg($data);
                if($res==1){
                 $data['error'] = array('error' => "Information Updated Successfully !");
                 $data['updatedata'] =  $this->regModel->edit($studId);
                 $this->load->view('update',$data);
                }else{
                    $data['error'] = array('error' => "Information Is not Updated Successfully !");
                   $data['updatedata'] =  $this->regModel->edit($studId);
                    $this->load->view('update',$data);
                }
                    
          }


    }else{
              $studId = $this->uri->segment(3);
              $data['updatedata'] =  $this->regModel->edit($studId);
          $this->load->view('update',$data);
    }
}

public function notedit()
{
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



public function notice()
{

  if(isset($_POST['submit']))
    {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('noticedesc', 'noticedesc', 'trim|required');
          $result = array();
          if ($this->form_validation->run() == FALSE)
          {     
                     $this->load->view('notice');
          }
          else
          {

                  $noticedesc     = $this->input->post('noticedesc');
                  $data = array(  
                            'noticedesc'   =>$noticedesc , 
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


public function videouploading()
{

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
                $param              = $this->input->post('param');
                $contentfile        = $_FILES['contentfile']['name'];

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
                          'fk_classId'      => $fk_classId , 
                          'content_title'   => $content_title , 
                          'fk_catId'        => $fk_catId , 
                          'fk_contentId'    => $fk_contentId, 
                          'vimeoId'         => $vimeoId , 
                          'youtubelink'     => $youtubelink , 
                          'fk_sessionId'    => $fk_sessionId , 
                          'fk_monthId'      => $fk_monthId , 
                          'fk_dayId'        => $fk_dayId, 
                          'contentfile'     => $contentfile, 
                          'fk_squenceId'    => $fk_squenceId, 
                          'param'           => $param, //valuebased_status
                          'status'          => 1, 
                        );

                $fk_monthId_exist = $this->regModel->fk_monthId_exist($fk_monthId,$fk_dayId,$fk_sessionId,$fk_classId,$param);
                if($fk_monthId_exist==1){
                  $data['error'] = array('error' => "Month and Day Already Exist !");
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
              $this->load->view('videouploading',$data);
            }else{
                $data['error'] =  array();
              $this->load->view('videouploading',$data);
            }
    }

}

public function generateBarcode()
{
  

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



public function tempenquiry()
{
    $usersession = $this->session->userdata('usersession');
    if($this->session->userdata('usersession'))
    {
       $data['getstudlist'] = $this->regModel->getstudlist(); 
       $this->load->view('tempenquiry',$data);
    } else {
      redirect('welcome');
    }

}


public function listvideouploading()
{
    

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
                   $fk_monthId = $this->uri->segment(4);
                   
                   $data['listvideouploading'] = $this->regModel->listvideouploading($fk_classId);
                   $data['get_month_data'] = $this->regModel->get_month_data($fk_monthId,$fk_classId); 
                   $data['fk_classId'] = $fk_classId; 
                   $data['fk_monthId'] =  $fk_monthId; 
                   $this->load->view('listvideouploading',$data);
            } else {
              redirect('welcome');
            }
          }
}


public function deletevideoId()
{
  
      $usersession = $this->session->userdata('usersession');
     
        if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('vidId', 'vidId', "trim|required|numeric|greater_than[0]");
              $this->form_validation->set_rules('monthId', 'monthId', "trim|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['listvideouploading'] = $this->regModel->listvideouploading();
                   $this->load->view('listvideouploading',$data);
              }
              else
              {
                $vidId          = $this->input->post('vidId');
                $monthId        = $this->input->post('monthId');
                $fk_classId     = $this->input->post('fk_classId');
                $result = $this->regModel->deletevideoId($vidId);
                 if($result==1){
                    $data['listvideouploading'] = $this->regModel->listvideouploading($fk_classId);
                    $data['error'] = array('error' => "Video Id Deleted Successfully !");
                    if( $monthId > 0 ) {
                      $data['get_month_data'] = $this->regModel->get_month_data($monthId);
                      $data['monthId'] = $monthId; 
                      $this->load->view('days',$data);
                    }else{
                      $this->load->view('listvideouploading',$data);
                    }
                 }else{
                    $data['listvideouploading'] = $this->regModel->listvideouploading($fk_classId);
                    $data['error'] = array('error' => "Video Id Deleted Successfully !");
                    $this->load->view('listvideouploading',$data);
                 }
              }         

        }else{
            $data['listvideouploading'] = $this->regModel->listvideouploading();
            $this->load->view('listvideouploading',$data);
        }

}


public function edit_video()
{
  

  if(isset($_POST['submit']))
      {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('fk_contentId', 'fk_contentId', 'trim|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim');
          $this->form_validation->set_rules('content_title', 'content_title', 'trim');
          $this->form_validation->set_rules('vimeoId', 'vimeoId', 'trim|numeric|max_length[9]');
          $this->form_validation->set_rules('youtubelink', 'youtubelink', 'trim');
          $this->form_validation->set_rules('fk_sessionId', 'fk_sessionId', 'trim|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_monthId', 'monthId', 'trim|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_catId', 'monthId', 'trim|numeric|greater_than[0]');
          $this->form_validation->set_rules('fk_dayId', 'dayId', 'trim|numeric|greater_than[0]');
          $this->form_validation->set_rules('vidId', 'vidId', 'trim|required|numeric|greater_than[0]');
          $this->form_validation->set_rules('fkclassId', 'fkclassId', 'trim|required|numeric|greater_than[0]');

          $vidId         = $this->input->post('vidId');
          if ($this->form_validation->run() == FALSE)
          {     
                    $data['update_videouploading'] = $this->regModel->update_videouploading($vidId);
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
                $fkclassId          = $this->input->post('fkclassId');
                $contentfile        = $_FILES['contentfile']['name'];

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
                          'fk_classId'      => $fk_classId , 
                          'content_title'   => $content_title , 
                          'fk_catId'        => $fk_catId , 
                          'fk_contentId'    => $fk_contentId, 
                          'vimeoId'         => $vimeoId , 
                          'youtubelink'     => $youtubelink , 
                          'fk_sessionId'    => $fk_sessionId , 
                          'fk_monthId'      => $fk_monthId , 
                          'fk_dayId'        => $fk_dayId, 
                          'contentfile'     => $contentfile, 
                          'fk_squenceId'    => $fk_squenceId, 
                          'vidId'           => $vidId, 
                          'status'          => 1 
                        );

                  $filteredvideouploading = $this->regModel->update_filteredvideouploading($videouploadingdata);

                  if($filteredvideouploading==1){
                         $data['error'] = array('error' => "Data Updated Successfully !");
                         $data['update_videouploading'] = $this->regModel->update_videouploading($vidId);
                         redirect('dashboard/listvideouploading/'.$fkclassId);
                   } else {
                          $data['update_videouploading'] = $this->regModel->update_videouploading($vidId);
                          $data['error'] = array('error' => "Data not Updated Successfully !");
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


public function addcategory()
{
  
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



public function addsession()
{
  
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

public function days()
{

    $usersession = $this->session->userdata('usersession');    
    if($this->session->userdata('usersession'))
    {
        $monthId = $this->uri->segment(3);
        $fk_classId = $this->uri->segment(4);
        $data['get_month_data'] = $this->regModel->get_month_data($monthId,$fk_classId); 
        $data['monthId'] = $monthId; 
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
        $dayId = $this->uri->segment(3);
        $monthId = $this->uri->segment(4);
        $fk_classId = $this->uri->segment(5);
        $adminRole=$usersession[0]['adminRole'];
        $data['get_day_sessions'] = $this->regModel->get_day_sessions($dayId,$monthId,$fk_classId,$adminRole); 
        $data['dayId'] = $dayId; 
        $data['monthId'] = $monthId; 
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
       $this->load->view('classroom',$data);
    } else {
      redirect('welcome');
    }


}


public function add_fees()
{


   if(isset($_POST['submit']))
      {

          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('school_fees', 'school fees', 'trim|required|integer');          
          $this->form_validation->set_rules('book_fees', 'book fees', 'trim|required|integer');          
          $this->form_validation->set_rules('monthly_fees', 'Monthly fees', 'trim|required|integer');          
          $this->form_validation->set_rules('final_fees', 'Final fees', 'trim|required|integer');          
          $this->form_validation->set_rules('packageName', 'package Name ', 'trim|required');          
          $this->form_validation->set_rules('gst', 'GST', 'trim|required|greater_than[0]');          
          $this->form_validation->set_rules('fk_classId', 'fk_classId', 'trim|required|greater_than[0]');          

          if ($this->form_validation->run() == FALSE)
          {     
                  $data['list_Fees'] = $this->regModel->list_Fees();
                  $this->load->view('add_fees',$data);
          }
          else
          {

                  $school_fees   = $this->input->post('school_fees');
                  $book_fees     = $this->input->post('book_fees');
                  $monthly_fees  = $this->input->post('monthly_fees');
                  $final_fees    = $this->input->post('final_fees');
                  $packageName   = $this->input->post('packageName');
                  $gst           = $this->input->post('gst');
                  $fk_classId    = $this->input->post('fk_classId');

                  $add_fees_data = array(
                    'gst'           => $gst,
                    'book_fees'     => $book_fees,
                    'school_fees'   => $school_fees,
                    'monthly_fees'  => $monthly_fees,
                    'packageName'   => $packageName,
                    'fk_classId'    => $fk_classId,
                    'final_fees'    => $final_fees
                  );

                  $alreadpackageName = $this->regModel->alreadpackageName($packageName);
                  if($alreadpackageName==1){
                     $data['error'] = array('error' => "Package Name Already Exist !");
                     $data['list_Fees'] = $this->regModel->list_Fees(); 
                     $this->load->view('add_fees',$data);

                  }else{
                    $res = $this->regModel->add_fees_data($add_fees_data);
                    if($res==1){

                             $data['error'] = array('error' => "Fees Added Successfully !");
                             $data['list_Fees'] = $this->regModel->list_Fees(); 
                             $this->load->view('add_fees',$data);
                           
                     } else { 

                            $data['list_Fees'] = $this->regModel->list_Fees(); 
                            $data['error'] = array('error' => "Fees not Added Successfully !");
                            $this->load->view('add_fees',$data);
                    }
                  }

            }


      }else{
          
            $usersession = $this->session->userdata('usersession');    
            if($this->session->userdata('usersession'))
            {
                $data['list_Fees'] = $this->regModel->list_Fees(); 
                $this->load->view('add_fees',$data);
            } else {
              redirect('welcome');
            }
          }

  

}



public function deletefeesId()
{
  
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











////////Zoom Integration/////////////////////////////


public function add_class()
    {

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

            // $insert_array = array(
            //     'staff_id'     => $this->customlib->getStaffID(),
            //     'title'        => $this->input->post('title'),
            //     'date'         => $this->input->post('date_time'),
            //     'class_id'     => $this->input->post('class_id'),
            //     'duration'     => $this->input->post('duration'),
            //     'password'     => $this->input->post('password'),
            //     'api_type'     => 'global',
            //     'host_video'   => $this->input->post('host_video'),//1 or 2 enable or disable
            //     'description'  => $this->input->post('description'),
            //     'timezone'     => $this->customlib->getTimeZone(),
            // );

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


public function list_of_education()
{

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
































}

?>