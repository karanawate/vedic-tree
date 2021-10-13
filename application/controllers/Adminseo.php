<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminseo extends CI_Controller
{

	public function index()
	{
		
    	  $usersession = $this->session->userdata('usersession');
    
          if($usersession[0]['adminRole']== 7 ){
    
          if($this->session->userdata('usersession'))
          {
                $data['count_blogs']   = $this->seoModel->count_blog();
                $data['count_event']   = $this->seoModel->count_event();
                $data['count_youtube'] = $this->seoModel->count_youtube();
    		    $this->load->view('seodashboard', $data);
          } else{
          	redirect('welcome');
          }
        }

	}


public function createlogs()
{
    $usersession = $this->session->userdata('usersession');
 
    if($usersession[0]['adminRole']== 7){

          if($this->session->userdata('usersession'))
            {
              $this->load->view('createlogs');  
            } else {
              redirect('welcome');
            }
   }
}



public function insert_blogs()
{
          $this->form_validation->set_rules('title','Title','trim|required');
          $this->form_validation->set_rules('date','Date','trim|required');
          $this->form_validation->set_rules('description','Description','trim|required');
        //   $this->form_validation->set_rules('file_upload','File Upload','required');
          if($this->form_validation->run() == FALSE){
            $this->load->view('createlogs');    
          }else
          {
            $usersession = $this->session->userdata('usersession');
            $this->load->library('upload');
            $image = array();
            $FILENAMES =  $_FILES['file']['name']       = $_FILES['file_upload']['name'];
            $_FILES['file']['type']       = $_FILES['file_upload']['type'];
            $_FILES['file']['tmp_name']   = $_FILES['file_upload']['tmp_name'];
            $_FILES['file']['error']      = $_FILES['file_upload']['error'];
            $_FILES['file']['size']       = $_FILES['file_upload']['size'];
             $config['encrypt_name'] = TRUE;
            // File upload configuration
            $usersession               = $this->session->userdata('usersession');
            $title                     = $this->input->post('title');
            $date                      = $this->input->post('date');
            $description               = $this->input->post('description');
              
             
        
            $uploadPath = './uploads/blogs_images/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|PNG|JPEG';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $res = 0;
            if($this->upload->do_upload('file')){
                // Uploaded file data
                $imageData = $this->upload->data();
            }
            
            $arraydata = array( 
                                             'title'                  => $title,
                                             'date'                   => $date,
                                             'description'            => $description,
                                             'file_upload'            => $imageData['file_name'],
                                          );
            $res = $this->seoModel->inserts_blogs($arraydata);
            if($res == 1) {
                $this->session->set_flashdata('msg', 'blogs Inserted successfully');
                redirect('/adminseo/createlogs/');
              }else{
                   redirect('/adminseo/createlogs/');
              }
          }

              
}


public function view_blogs()
{
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 7){
            if($this->session->userdata('usersession')){
                $data['blogs'] = $this->seoModel->get_blogs();
                $this->load->view('view_blogs', $data);
            }else{
                redirect('welcome');
            }
      }
}

public function delete_blogs(){
    
    $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==7){

          if($this->session->userdata('usersession'))
            {
              $blog_id = $this->input->post('blog_id');
              $res = $this->seoModel->delete_blogs($blog_id);
              
                if($res == 1) {
                    $this->session->set_flashdata('msg', 'Delete Blog successfully');
                    redirect('/adminseo/view_blogs');
                }else{
                    redirect('/adminseo/view_blogs');
                }
            } else {
              redirect('welcome');
            }
   }
   
} 


public function edit_blogs()
{
     $usersession = $this->session->userdata('usersession');
     if($usersession[0]['adminRole']==7)
     {
         $blog_id = $this->input->post('blog_id');
         $data['blogs_edit'] = $this->seoModel->edit_blogss($blog_id);
         $this->load->view('edit_blogs',$data);
     } else {
      redirect('welcome');
    }

}

public function updates_blogs(){
  $usersession = $this->session->userdata('usersession');
          $this->load->library('upload');
          $image = array();
          $home_id                   = $this->input->post('home_id'); 
            $usersession               = $this->session->userdata('usersession');
            $title                     = $this->input->post('title');
            $date                      = $this->input->post('date');
            $description               = $this->input->post('description');
                    if($_FILES['file_upload']['name']!=""){
                    $FILENAMES =  $_FILES['file']['name']       = $_FILES['file_upload']['name'];
                    $_FILES['file']['type']       = $_FILES['file_upload']['type'];
                    $_FILES['file']['tmp_name']   = $_FILES['file_upload']['tmp_name'];
                    $_FILES['file']['error']      = $_FILES['file_upload']['error'];
                    $_FILES['file']['size']       = $_FILES['file_upload']['size'];
                     $config['encrypt_name'] = TRUE;
                    // File upload configuration
                    $uploadPath = './uploads/blogs_images/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|PNG|JPEG';
        
                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $res = 0;
                    if($this->upload->do_upload('file')){
                        
                        $imageData = $this->upload->data();
                    }
                    
                      
                    $arraydata = array( 
                                         'title'                  => $title,
                                         'date'                   => $date,
                                         'description'            => $description,
                                         'file_upload'            => $imageData['file_name'],
                                      );
                                                  
                    $res = $this->seoModel->updates_blogs($arraydata,$home_id);
                     if($res == 1) {
                        $this->session->set_flashdata('msg', 'blogs updated successfully');
                        redirect('/adminseo/view_blogs');
                      }else {
                          redirect('/adminseo/view_blogs');
                      }  
            }else
            {
                
             $arraydata = array( 
                                 'title'                  => $title,
                                 'date'                   => $date,
                                 'description'            => $description
                                
                              );
             $res = $this->seoModel->updates_blogs($arraydata,$home_id);
            }
            if($res == 1) {
                $this->session->set_flashdata('msg', 'blogs updated successfully');
                redirect('/adminseo/view_blogs');
              } else {
                  redirect('/adminseo/view_blogs');
              }  
}


public function create_events(){
    
    $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==7)
       {
          $this->load->view('create_events');
       } else {
          redirect('welcome');
       }
} 


public function insert_events()
{
    $this->form_validation->set_rules('image_input_link', 'Image Link', 'trim|required');
    $this->form_validation->set_rules('youtube_input_link', 'Youtube Link', 'trim|required');
    $this->form_validation->set_rules('description', 'Description', 'trim|required');
    $this->form_validation->set_rules('date', 'Date', 'trim|required');
    $this->form_validation->set_rules('alt_tg', 'Alg tag', 'trim|required');
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    if ($this->form_validation->run() == false) {
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        } else {
          $usersession = $this->session->userdata('usersession');
          $this->load->library('upload');
          $image = array();
          $ImageCount = count($_FILES['allocated_file']['name']);
            for($i = 0; $i < $ImageCount; $i++){
                $FILENAMES = $_FILES['file']['name'] = $_FILES['allocated_file']['name'][$i];
                $_FILES['file']['type']       = $_FILES['allocated_file']['type'][$i];
                $_FILES['file']['tmp_name']   = $_FILES['allocated_file']['tmp_name'][$i];
                $_FILES['file']['error']      = $_FILES['allocated_file']['error'][$i];
                $_FILES['file']['size']       = $_FILES['allocated_file']['size'][$i];
                $config['encrypt_name'] = TRUE;
                // File upload configuration
                 $usersession                = $this->session->userdata('usersession');
                 $image_input_link           = $this->input->post('image_input_link');
                 $youtube_input_link         = $this->input->post('youtube_input_link');
                 $description                = $this->input->post('description');
                 $date                       = $this->input->post('date');
                 $alt_tg                     = $this->input->post('alt_tg');
                 $title                      = $this->input->post('title');
                 $event_rand_id              = $this->input->post('event_rand_id');
               
                $uploadPath = './uploads/event_images/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|PNG|JPEG';
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $res = 0;
                // Upload file to server
                if($this->upload->do_upload('file'))
                {
                   $imageData = $this->upload->data();
                   
                }
                 $res = $this->seoModel->inserts_events($title,$image_input_link,$youtube_input_link,$description,$alt_tg, $imageData['file_name'],$date,$event_rand_id);
            }
              if($res==1){
                 echo json_encode(array('msg' => 'Event allocated successfully'));
              }
              else
              {
                 echo json_encode(array('msg' => 'Event not  allocated successfully'));
              }
     }
              
}

public function view_events(){
    
    $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==7){

          if($this->session->userdata('usersession'))
            {       $data['events'] = $this->seoModel->get_events();
                    $this->load->view('view_events', $data);
            } else {
              redirect('welcome');
            }
     }
   
}

public function delete_events(){
    
    $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==7){
            
          if($this->session->userdata('usersession'))
            {
              $event_rand_id = $this->input->post('event_rand_id');
              $res = $this->seoModel->delete_events($event_rand_id);
              
                if ($res == 1) {
                    $this->session->set_flashdata('msg', 'Delete Events successfully');
                    redirect('/adminseo/view_events');
                  }else {
                       redirect('/adminseo/view_events');
                  }
              }else {
                  redirect('welcome');
          }
      }
} 


public function view_eventimages(){
    
    $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==7){
            
          if($this->session->userdata('usersession'))
            {
              $event_generated_id = $this->uri->segment(3);
              $data['event_images'] = $this->seoModel->get_events_unique($event_generated_id);
              $this->load->view('view_event_images', $data);
              
            }else {
                    redirect('welcome');
            }
      }
   
}

public function create_youtube_review(){
    
    $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==7){
            
          if($this->session->userdata('usersession'))
            {
            
              $this->load->view('youtube_review');
              
            } else {
              redirect('welcome');
            }

     }
   
}

public function insert_youtube_review(){
    
    $usersession = $this->session->userdata('usersession');
 
      if($usersession[0]['adminRole']==7){
            
          if($this->session->userdata('usersession'))
            {
                $this->form_validation->set_rules('image_input_link', 'Image link','trim|required');
                $this->form_validation->set_rules('youtube_input_link','Youtube link','trim|required');
                if($this->form_validation->run() == false){
                    $this->load->view('youtube_review');
                }else{
                    $image_input_link   = $this->input->post('image_input_link');
                    $youtube_input_link = $this->input->post('youtube_input_link');
                    
                    $data = array(
                        'image_input_link'    =>$image_input_link,
                        'youtube_input_link'  =>$youtube_input_link
                        );
                        
                    $res = $this->seoModel->insert_youtube_review($data);
                    if($res == 1){
                        $this->session->set_flashdata('msg','Insert youtube review succesfully');
                        $this->load->view('youtube_review');
                    }else{
                          $this->load->view('youtube_review');
                    }
                    
                }
            } else {
                redirect('welcome');
            }

   }
   
} 

public function view_youtube_review(){
    
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 7){
          
          if($this->session->userdata('usersession')){
              $data['get_reviews'] = $this->seoModel->get_reviews_youtube();
               $this->load->view('view_youtube_review', $data);
          }else{
              redirect('welcome');
          }
      }
}

public function delete_youtube_review(){
    
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 7){
            if($this->session->userdata('usersession')){
                
               $yotube_reviewid = $this->input->post('id');
               $res = $this->seoModel->delete_youtube_reviewss($yotube_reviewid);
               
                 if($res == 1){
                  $this->session->set_flashdata('msg','Youtube Review Deleted Successfully');
                  redirect('adminseo/view_youtube_review');
                 }else{
                     redirect('adminseo/view_youtube_review');
                 }
                 
            }else{
                  redirect('welcome');
            }
      }
}


public function website_banner(){
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 7){
          
            if($this->session->userdata('usersession')){
                $this->load->view('website_banner');
            }else{
                redirect('welcome');
            }
      }
}

public function insert_web_banner(){
    
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 7){
          
            if($this->session->userdata('usersession')){
                $this->form_validation->set_rules('title','Title','trim|required');
                  if($this->form_validation->run() == FALSE){
                      $this->load->view('website_banner');
                  }else{
                      $this->load->library('upload');
                      $title = $this->input->post('title');
                      $filename = $_FILES['file']['name'] = $_FILES['banner']['name'];
        
                      $_FILES['file']['type']      = $_FILES['banner']['type'];
                      $_FILES['file']['tmp_name']  = $_FILES['banner']['tmp_name'];
                      $_FILES['file']['size']      = $_FILES['banner']['size'];
                      $_FILES['file']['error']     = $_FILES['banner']['error'];
                      $config['encrypt_name']      = TRUE;
                      
                      $uploadPath = './uploads/web_banner/';
                      $config['upload_path'] = $uploadPath;
                      $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|pps|ppsx|ppt|pptx|gz|tgz|zip';
                      $this->load->library('upload', $config);
                      $this->upload->initialize($config);
                       // Upload file to server
                      if($this->upload->do_upload('file'))
                      {
                        $imageData = $this->upload->data();
                      }
                      $res = $this->seoModel->insert_web_banner($title,$imageData['file_name']);
                      $this->session->set_flashdata('msg','Inserted Banner Successfully!');
                      return redirect('adminseo/website_banner');
                  }
            }else{
                redirect('welcome');
            }
      }
}

public function view_website_banner(){
      $usersession = $this->session->userdata('usersession');
      
        if($usersession[0]['adminRole'] == 7){
            
           if($this->session->userdata('usersession')){
               $res['banner_details'] = $this->seoModel->get_banner_detail();
               $this->load->view('view_website_banner', $res);
           }else{
               redirect('welcome');
           }   
        }
}

public function delete_banner_details(){
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 7){
          
            if($this->session->userdata('usersession')){
                $bannerId = $this->input->post('bannerId');
                $res      = $this->seoModel->delete_banner_detail($bannerId);
                if($res == 1){
                    $this->session->set_flashdata('msg','Deleted Successfully');
                    return redirect('adminseo/view_website_banner');
                }else{
                    $this->session->set_flashdata('msg','deleted not Successfully');
                    return redirect('adminseo/view_website_banner');
                }
                
            }else{
                redirect('welcome');
            }
      }
}

public function editEvents()
{
    $usersession = $this->session->userdata('usersession');
    
    if($usersession[0]['adminRole'] == 7){
        $geneventId     = $this->input->post('event_rand_id');
        $data['eventedit'] = $this->seoModel->editEvent($geneventId);
        // print_r($data['eventedit']);
         $this->load->view('editEvents', $data);
      
    }else{
        redirect('welcome');
    }
}

public function update_events()
{
    
    $usersession = $this->session->userdata('usersession');
    
    if($usersession[0]['adminRole'] == 7){
         $allocated_file       = $_FILES['allocated_file']['name'];
             $event_rand_id              = $this->input->post('event_rand_id');
             $del_events = $this->seoModel->check_events_delete($event_rand_id);
            
             if($del_events == 1){
            $this->load->library('upload');
            $image = array();
            $ImageCount = count($_FILES['allocated_file']['name']);
            for($i = 0; $i < $ImageCount; $i++){
                $FILENAMES = $_FILES['file']['name'] = $_FILES['allocated_file']['name'][$i];
                $_FILES['file']['type']       = $_FILES['allocated_file']['type'][$i];
                $_FILES['file']['tmp_name']   = $_FILES['allocated_file']['tmp_name'][$i];
                $_FILES['file']['error']      = $_FILES['allocated_file']['error'][$i];
                $_FILES['file']['size']       = $_FILES['allocated_file']['size'][$i];
                $config['encrypt_name'] = TRUE;
                // File upload configuration
                 $usersession                = $this->session->userdata('usersession');
                 $image_input_link           = $this->input->post('image_input_link');
                 $youtube_input_link         = $this->input->post('youtube_input_link');
                 $description                = $this->input->post('description');
                 $date                       = $this->input->post('date');
                 $alt_tg                     = $this->input->post('alt_tg');
                 $title                      = $this->input->post('title');
                 $event_rand_id              = $this->input->post('event_rand_id');
               
                $uploadPath = './uploads/event_images/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|PNG|JPEG';
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $res = 0;
                // Upload file to server
                if($this->upload->do_upload('file'))
                {
                   $imageData = $this->upload->data();
                   
                }
                 $res = $this->seoModel->inserts_events($title,$image_input_link,$youtube_input_link,$description,$alt_tg, $imageData['file_name'],$date,$event_rand_id);
                 
            }
            if($res==1){
                     echo json_encode(array('msg' => 'Event Updated successfully'));
                  }
                  else
                  {
                     echo json_encode(array('msg' => 'Event Updated not  successfully'));
                  }
             
                 
                 
                 
             }
         
    
    }else{
        redirect('welcome');
    }
    
}

public function edit_youtube_review()
{
    $usersession = $this->session->userdata('usersession');
    
    if($usersession[0]['adminRole'] == 7)
    {
        $youtubeId = $this->input->post('id');
        $data['youtubedits'] = $this->seoModel->youtubeEdit($youtubeId);
        $this->load->view('youtube_edit', $data);
    
    }else{
        redirect('welcome');
    }
}
public function update_youtube_review()
{
    $usersession = $this->session->userdata('usersession');
    
    if($usersession[0]['adminRole'] == 7)
    {
        $youtubeId           = $this->input->post('youtubeId');
        $image_input_link    = $this->input->post('image_input_link');
        $youtube_input_link  = $this->input->post('youtube_input_link');
        
        $data = array(
            'image_input_link'   =>$image_input_link,
            'youtube_input_link' =>$youtube_input_link
            );
        $res = $this->seoModel->updateReviews($data,$youtubeId);
         if($res == 1){
          $this->session->set_flashdata('msg','Youtube Review update Successfully');
          redirect('adminseo/edit_youtube_review');
         }else{
             redirect('adminseo/edit_youtube_review');
         }
    }else{
         redirect('welcome');
    }
}


// webinar content 


public function webinar_banner(){
    $usersession = $this->session->userdata('usersession');
    if($usersession[0]['adminRole'] == 7)
    {
        $this->load->view('webinar_banner');
    }else{
        redirect('welcome');
    }
}


public function insert_webinar_banner(){
    
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 7){
          
            if($this->session->userdata('usersession')){
                $this->form_validation->set_rules('title','Title','trim|required');
                  if($this->form_validation->run() == FALSE){
                      $this->load->view('website_banner');
                  }else{
                      $this->load->library('upload');
                      $title = $this->input->post('title');
                      $filename = $_FILES['file']['name'] = $_FILES['banner']['name'];
        
                      $_FILES['file']['type']      = $_FILES['banner']['type'];
                      $_FILES['file']['tmp_name']  = $_FILES['banner']['tmp_name'];
                      $_FILES['file']['size']      = $_FILES['banner']['size'];
                      $_FILES['file']['error']     = $_FILES['banner']['error'];
                      $config['encrypt_name']      = TRUE;
                      
                      $uploadPath = './uploads/webinar_banner/';
                      $config['upload_path'] = $uploadPath;
                      $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|pps|ppsx|ppt|pptx|gz|tgz|zip';
                      $this->load->library('upload', $config);
                      $this->upload->initialize($config);
                       // Upload file to server
                      if($this->upload->do_upload('file'))
                      {
                        $imageData = $this->upload->data();
                      }
                      $res = $this->seoModel->insert_webinar_banners($title,$imageData['file_name']);
                      $this->session->set_flashdata('msg','Inserted Banner Successfully!');
                      return redirect('adminseo/webinar_banner');
                  }
            }else{
                redirect('welcome');
            }
      }
}


public function view_webinar_banner()
{
    
    $usersession = $this->session->userdata('usersession');
    if($usersession[0]['adminRole'] == 7)
    {
        $data['webinar_banners'] = $this->seoModel->view_webinar_banners_list();    
        
        $this->load->view('view_webinar_banner', $data);
        
    }else{
        redirect('welcome');
        
    }
}

public function delete_banner_webinar_details(){
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 7){
          
            if($this->session->userdata('usersession')){
                $bannerId = $this->input->post('bannerId');
                $res      = $this->seoModel->delete_banner_detail_weninar($bannerId);
                if($res == 1){
                    $this->session->set_flashdata('msg','Deleted Successfully');
                    return redirect('adminseo/view_webinar_banner');
                }else{
                    $this->session->set_flashdata('msg','deleted not Successfully');
                    return redirect('adminseo/view_webinar_banner');
                }
                
            }else{
                redirect('welcome');
            }
      }
}

public function webinar_timetbl()
{
    $usersession = $this->session->userdata('usersession');  
    
      if($usersession[0]['adminRole'] == 7){
            $data['webinarTimetbls'] = $this->seoModel->webinar_timetbls();
            $this->load->view('webinar_timetbl', $data);
      }else{
          redirect('welcome');
      }
}

public function update_webinar_timetbl(){
    $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole'] == 7){
          $timetable = $this->input->post('timetable');
          $data = array(
                       'timetable' => $timetable
                      );
        $result = $this->seoModel->update_webinar_timetbls($data);
        if($result == 1 )
        {
             $this->session->set_flashdata('msg','Updated Successfully');
            return redirect('adminseo/webinar_timetbl');
        }
        
      }else{
          redirect('welcome');
      }
}

public function webinar_features_speckers()
{
    $usersession = $this->session->userdata('usersession');
      if($usersession[0]['adminRole'] == 7)
      {
          $this->load->view('webinar_features_speckers');
      }else{
          redirect('welcome');
      }
}

public function insert_features_speckers(){
    
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 7){
          
            if($this->session->userdata('usersession')){
                  if($this->form_validation->run() == TRUE){
                    //ERROR        
                    //   $this->load->view('webinar_features_speckers');
                  }else{
                      $this->load->library('upload');
                      $name_first       = $this->input->post('name_first');
                      $designation      = $this->input->post('designation');
                      $degree           = $this->input->post('degree');
                      $filename = $_FILES['file']['name'] = $_FILES['Banner_profile']['name'];
        
                      $_FILES['file']['type']      = $_FILES['Banner_profile']['type'];
                      $_FILES['file']['tmp_name']  = $_FILES['Banner_profile']['tmp_name'];
                      $_FILES['file']['size']      = $_FILES['Banner_profile']['size'];
                      $_FILES['file']['error']     = $_FILES['Banner_profile']['error'];
                      $config['encrypt_name']      = TRUE;
                      
                      $uploadPath = './uploads/webinar_banner/';
                      $config['upload_path'] = $uploadPath;
                      $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|pps|ppsx|ppt|pptx|gz|tgz|zip';
                      $this->load->library('upload', $config);
                      $this->upload->initialize($config);
                       // Upload file to server
                      if($this->upload->do_upload('file'))
                      {
                        $imageData = $this->upload->data();
                      }
                      $res = $this->seoModel->insert_features_speckers($name_first,$designation,$imageData['file_name'],$degree);
                      $this->session->set_flashdata('msg','features-speckers Inserted Successfully');
                      return redirect('adminseo/webinar_features_speckers');
                  }
            }else{
                redirect('welcome');
            }
      }
}

public function view_feature_speckers()
{
  $usersession = $this->session->userdata('usersession');
  
    if($usersession[0]['adminRole'] == 7)
    {
        $data['get_features'] = $this->seoModel->get_view_features();
        $this->load->view('view_feature_speckers', $data);
    }else{
        redirect("welcome");
    }
}

public function delete_features_spekers(){
    $usersession = $this->session->userdata('usersession');
    
    if($usersession[0]['adminRole'] == 7){
        $features_id = $this->input->post('features_id');
        $result = $this->seoModel->delete_features($features_id);
        if($result == 1){
            $this->session->set_flashdata('msg','Deleted Successfully');
            return redirect('adminseo/view_feature_speckers');
        }
    }else{
        redirect('welcome');
    }
    
    
}


public function get_webinartimetbl()
{
    $usersession = $this->session->userdata('usersession');
    
      if($usersession[0]['adminRole'] == 7){
          $data['get_webinar_timetbl'] = $this->seoModel->get_webinartimetbl_details();
      }else{
          redirect('welcome');
      }
}

public function presipal_sign()
{
    $usersession = $this->session->userdata('usersession');
    
    if($usersession[0]['adminRole'] == 6){
        $data['signatures'] = $this->seoModel->get_presipal_data();
        $this->load->view('presipal_sign', $data);
    }else{
        redirect('welcome');
    }
}

public function insert_presipal_sign()
{
   
    $usersession = $this->session->userdata('usersession');
    
    if($usersession[0]['adminRole'] == 6){
        $usersession = $this->session->userdata('usersession');
            $this->load->library('upload');
            $image = array();
            $FILENAMES =  $_FILES['file']['name']       = $_FILES['signature_file']['name'];
            $_FILES['file']['type']       = $_FILES['signature_file']['type'];
            $_FILES['file']['tmp_name']   = $_FILES['signature_file']['tmp_name'];
            $_FILES['file']['error']      = $_FILES['signature_file']['error'];
            $_FILES['file']['size']       = $_FILES['signature_file']['size'];
             $config['encrypt_name'] = TRUE;
            // File upload configuration
            $usersession               = $this->session->userdata('usersession');
            $uploadPath = './uploads/presipal_sign/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|PNG|JPEG';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $res = 0;
            if($this->upload->do_upload('file')){
                // Uploaded file data
                $imageData = $this->upload->data();
            }
            
            $arraydata = array( 
                               'signature_file'            => $imageData['file_name'],
                              );
            $res = $this->seoModel->inserted_presipal_sigh($arraydata);
            if($res == 1) {
                $this->session->set_flashdata('msg', 'Signature Updated Successfully');
                redirect('/adminseo/presipal_signget_data/');
              }else{
                   redirect('/adminseo/presipal_signget_data/');
              }
        
    }else{
        redirect('welcome');
    }
}


public function presipal_signget_data()
{
    $usersession = $this->session->userdata('usersession');
    
    if($usersession[0]['adminRole'] == 6){
        $data['signatures'] = $this->seoModel->get_presipal_data();
        $this->load->view('view_sign', $data);
    }else{
        redirect('welcome');
    }
}

public function sigh_blogs()
{
    $usersession = $this->session->userdata('usersession');
    
    if($usersession[0]['adminRole'] == 6){
      $presipalId = $this->input->post('presipal_id');
      $res = $this->seoModel->delete_presipal_sign($presipalId);
      
      if($res == 1) {
                $this->session->set_flashdata('msg', 'Signature Deleted Successfully');
                redirect('/adminseo/presipal_signget_data/');
              }else{
                   redirect('/adminseo/presipal_signget_data/');
              }
              
    }else{
        redirect('welcome');
    }
}










































































































































































































}

?>