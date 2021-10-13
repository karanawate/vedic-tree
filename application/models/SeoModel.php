<?php

class seoModel extends CI_Model
{

     public function inserts_blogs($insert_array)
     {
         $res= $this->db->insert('blog_content',$insert_array);
      
            if($res==1){
                return 1;
            }else{
                return 0;
            }
     }
     
     public function get_blogs()
     {
        $this->db->trans_start();
        $res= $this->db->get('blog_content')->result_array();
        $this->db->trans_complete();
          if($this->db->trans_status() == FALSE){
              $res = array('error' =>'Transaction Failed Because you try to hacking system');
          }else{
            return $res;
          }
     }
    
     public function delete_blogs($blog_id)
     {
        
       $this->db->trans_start();
    
       $this->db->where('id',$blog_id);
       $res = $this->db->delete('blog_content');
       $this->db->trans_complete();
    
	   if ($this->db->trans_status() === FALSE)
	   {
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	   }else{
        return $res;
       }
   
    }
    
   public function edit_blogss($blog_id)
    {
    $this->db->trans_start();

	$this->db->where('id',$blog_id);
	$res = $this->db->get('blog_content')->result_array();;
	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

      return $res;
   }
   
  
    }
    
public function updates_blogs($arraydata,$home_id)
    {
    $this->db->trans_start();

	$this->db->where('id',$home_id);
	 $res = $this->db->update('blog_content',$arraydata);
	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

      return $res;
  }
   
   
   
    }
    
    // karan events 
    
   public function inserts_events($title,$image_input_link,$youtube_input_link,$description,$alt_tg,$FILENAMES,$date,$event_rand_id){
        
     $arraydata = array( 
                          'title'                 =>$title,
                         'image_input_link'       =>$image_input_link,
                         'youtube_input_link'     =>$youtube_input_link,
                          'description'           =>$description,
                          'date'                  =>$date,
                          'alt_tg'                =>$alt_tg,
                          'allocated_file'        =>$FILENAMES,
                          'event_rand_id'         =>$event_rand_id
                      );
                                  
         $res= $this->db->insert('event_content',$arraydata);
            if($res==1){
                return 1;
            }else{
                return 0;
            }
     }
     
    public function get_events()
    {
        $this->db->trans_start();
        $this->db->group_by('event_rand_id');  
        $res= $this->db->get('event_content')->result_array();
        $this->db->trans_complete();
        
        if($this->db->trans_status() == FALSE)
        {
          return $res = array('error' =>'Transaction Failed Because you try to hacking systeam');  
        }else{
          return $res;
        }
    }
    
 public function delete_events($event_rand_id)
    {
         $this->db->trans_start();
    	 $this->db->where('event_rand_id',$event_rand_id);
    	 $res = $this->db->delete('event_content');
    	 $this->db->trans_complete();
    	 
    	 if ($this->db->trans_status() == FALSE)
    	 {
    	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
    	 }else{
          return $res;
    	 }
    }
    
 public function get_events_unique($event_generated_id)
    {
        $this->db->trans_start();
    	$this->db->where('event_rand_id',$event_generated_id);
    	$res = $this->db->get('event_content')->result_array();
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
    	{
    	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
    	}else{
    
          return $res;
       }
   
    }
    
 public function get_events_info($event_generated_id)
    {
        $this->db->trans_start();
    	$this->db->where('event_rand_id',$event_generated_id);
    	$res = $this->db->get('event_content')->result_array();
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
    	{
    	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
    	}else{
          return $res;
       }
   
    }
    
 public function insert_youtube_review($data)
    {
      $this->db->trans_start();
	  $result = $this->db->insert('insert_youtube_review', $data);
      $this->db->trans_complete();
       if ($this->db->trans_status() === FALSE)
    	{
    	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
    	}else{
    	       if($result==1){
    			return "1";
    		   }else{
    			return "0";
    		   }
    	}
    }
    
    public function get_reviews_youtube()
    {
        $this->db->trans_start();
        $res = $this->db->get('insert_youtube_review')->result_array();
        $this->db->trans_complete();
        
        if($this->db->trans_status()== FALSE)
        {
            return $res = array('error' =>'Transaction Failed Because you try to hacking system');
        }else{
            return $res;
        }
    }
    
    public function delete_youtube_reviewss($yotube_reviewid)
    {
        $this->db->trans_start();
        $this->db->where('id',$yotube_reviewid);
        $res = $this->db->delete('insert_youtube_review');
        
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE){
            return $res = array('error'=>'Transaction Failed Because you try to hacking system');
        }
        else{
            return $res;
        }
    }

    public function insert_web_banner($title,$imagedata)
    {
          $this->db->trans_start();
          $data = array(
                        'title' =>$title,
                        'banner'=>$imagedata
                      );
         $res = $this->db->insert('web_banners', $data);  
         $this->db->trans_complete();
         
         if($this->db->trans_status() == FALSE)
         {
             return $res = array('error'=>'Transaction Failed Because you try to hacking system');
         }else{
             return $res;
         }
    }
    
    public function get_banner_detail()
    {
        $this->db->trans_start();
        $res = $this->db->get('web_banners')->result_array();
        $this->db->trans_complete();
        
        if($this->db->trans_status() == FALSE){
            return $res = array('error' =>'Transaction Failed Because you try to hacking System');
        }else
        {
            return $res;
        }
    }
    
    public function delete_banner_detail($bannerId)
    {
        $this->db->trans_start();
        $this->db->where('bannerId',$bannerId);
        $res = $this->db->delete('web_banners');
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE){
            return $res = array('error' =>'Transaction Failed Because you try to hacking System');
        }else{
            return $res;
        }
    }
    
    public function count_blog()
    {
        $this->db->trans_start();
        $res = $this->db->from('blog_content')->count_all_results();
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE){
         return $res = array('error' =>'Transaction Failed Because you try to hacking system');
        }else{
          return $res;
        }
    }
    
    public function count_event()
    {
        $this->db->trans_start();
        $res = $this->db->from('event_content')->count_all_results();
        $this->db->trans_complete();
        if($this->db->trans_status() ==FALSE){
          return $res = array('error' =>'Transaction Failed Because you try to hacking system');
        }else{
          return $res;
        }
    }
    
    public function count_youtube()
    {
        $this->db->trans_start();
        $res= $this->db->from('insert_youtube_review')->count_all_results();
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE){
          return $res = array('error' =>'Transaction Failed Because you try to hacking system');
        }else{
          return $res;
        }
    }
    
    public function editEvent($geneventId)
    {
        $this->db->trans_start();
        $this->db->where('event_rand_id', $geneventId);
        $res= $this->db->get('event_content')->result_array();
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE){
          return $res = array('error' =>'Transaction Failed Because you try to hacking system');
        }else{
          return $res;
        }
    }
    
public function update_events($title,$image_input_link,$youtube_input_link,$description,$alt_tg,$FILENAMES,$date,$event_rand_id,$eventId){
        
     $arraydata = array( 
                          'title'                 =>$title,
                         'image_input_link'       =>$image_input_link,
                         'youtube_input_link'     =>$youtube_input_link,
                          'description'           =>$description,
                          'date'                  =>$date,
                          'alt_tg'                =>$alt_tg,
                          'allocated_file'        =>$FILENAMES,
                          'event_rand_id'        =>$event_rand_id
                      );
         $this->db->where('event_id', $eventId);                 
         $res= $this->db->update('event_content',$arraydata);
            if($res==1){
                return 1;
            }else{
                return 0;
            }
     }
     
     public function update_events_content($title,$image_input_link,$youtube_input_link,$description,$alt_tg,$date,$event_rand_id,$eventId,$allocated_file_edit)
     {
        $arraydata = array( 
                          'title'                 =>$title,
                         'image_input_link'       =>$image_input_link,
                         'youtube_input_link'     =>$youtube_input_link,
                          'description'           =>$description,
                          'date'                  =>$date,
                          'alt_tg'                =>$alt_tg,
                          'allocated_file'        =>$allocated_file_edit,
                          'event_rand_id'        =>$event_rand_id
                      );
         $this->db->where('event_id', $eventId);
         echo $this->db->last_query();
        //  $res= $this->db->update('event_content',$arraydata);
        // if($res==1){
        //     return 1;
        // }else{
        //     return 0;
        // }    
     }
     
     public function youtubeEdit($youtubeId)
     {
         $this->db->trans_start();
         $res = $this->db->get('insert_youtube_review')->result_array();
         $this->db->trans_complete();
         
         if($this->db->trans_status() == FALSE)
         {
             $this->trans_rollback();
             return $res = array('error' =>'Transaction Failed Because you try to hacking system');
         }else{
             return $res;
         }
     }
     
    public function updateReviews($data,$youtubeId)
    {
        $this->db->trans_start();
        $this->db->where('id',$youtubeId);
        $res = $this->db->update('insert_youtube_review', $data);
        $this->db->trans_complete();
    
        if($this->db->trans_status() == FALSE)
        {
            $this->db->trans_rollback();
            return $res = array('error' => 'Transaction Failed Because you try to hacking system');
        }else{
            return $res;
        }
        
        
    }
    
    public function check_events($event_rand_id)
    {
        $this->db->trans_start();
        $this->db->where('event_rand_id',$event_rand_id);
        $res = $this->db->get('event_content')->result_array();
        $this->db->trans_complete();
    
        if($this->db->trans_status() == FALSE)
        {
            $this->db->trans_rollback();
            return $res = array('error' => 'Transaction Failed Because you try to hacking system');
        }else{
            return $res;
        }
        
        
    }
    public function check_events_delete($event_rand_id)
    {
        $this->db->trans_start();
        $this->db->where('event_rand_id',$event_rand_id);
        $res = $this->db->delete('event_content');
        $this->db->trans_complete();
    
        if($this->db->trans_status() == FALSE)
        {
            $this->db->trans_rollback();
            return $res = array('error' => 'Transaction Failed Because you try to hacking system');
        }else{
            return $res;
        }
        
        
    }
    
    
    public function insert_webinar_banners($title,$imagedata)
    {
          $this->db->trans_start();
          $data = array(
                        'title' =>$title,
                        'banner'=>$imagedata
                      );
         $res = $this->db->insert('webinar_banners', $data);  
         $this->db->trans_complete();
         
         if($this->db->trans_status() == FALSE)
         {
             return $res = array('error'=>'Transaction Failed Because you try to hacking system');
         }else{
             return $res;
         }
    }
    
    
    public function view_webinar_banners_list()
    {
        $this->db->trans_start();
        $res = $this->db->get('webinar_banners')->result_array();
        $this->db->trans_complete();
        if($this->db->trans_status() == false)
        {
             $this->db->trans_rollback();
            return $res = array('error'=>'Transaction Failed Because you try to hacking system');
        }else{
            return $res;
        }
    }
    
    public function delete_banner_detail_weninar($bannerId)
    {
        $this->db->trans_start();
        $this->db->where('webinar_banner_id',$bannerId);
        $res = $this->db->delete('webinar_banners');
        $this->db->trans_complete();
        if($this->db->trans_status() == false){
            $this->db->trans_rollback();
            return $res = array('error'=>'Transaction Failed Because you try to hacking system');
        }else{
            return $res;
        }
    }
    
    
    public function webinar_timetbls()
    {
        $this->db->trans_start();
        $res = $this->db->get('webinar_timetable')->result_array();
        $this->db->trans_complete();
        
        if($this->db->trans_status() == false){
            $this->db->trans_rollback();
        }else{
            return $res;
        }
    }
    
    public function update_webinar_timetbls($data)
    {
        $this->db->trans_start();
        $res = $this->db->update('webinar_timetable', $data);
        $this->db->trans_complete();
        
        if($this->db->trans_status() == false){
            $this->db->trans_rollback();
            $res = array('error' =>'Transaction Failed Because you try to hacking system');
        }else{
            return $res;
        }
        
        
    }
    
    public function insert_features_speckers($name_first,$designation,$banner_profile,$degree)
    {
         $insert_specker = array(
                                    'name'            =>$name_first,
                                    'designation'     =>$designation,
                                     'banner_profile' =>$banner_profile,
                                     'degree'        =>$degree
                                );
        $this->db->trans_start();
        $res = $this->db->insert('webinar_features_speckers',$insert_specker);
        $this->db->trans_complete();
    
        if($this->db->trans_status() == false)
        {
            $this->db->trans_rollback();
            $res = array('error' =>'Transaction Failed Because you try to hacking system');
        }else{
            return $res;
        }
    }
    
    public function get_view_features()
    {
        $this->db->trans_start();
        $res = $this->db->get('webinar_features_speckers')->result_array();
        $this->db->trans_complete();
        
        if($this->db->trans_status() == false)
        {
            $this->db->trans_rollback();
            $res = array('error' =>'Transaction Failed Because you try to hacking system');
        }else
        {
            return $res;
        }
    }
    
  public function delete_features($features_id)
  {
      $this->db->trans_start();
      $this->db->where('features_id',$features_id);
      $res = $this->db->delete('webinar_features_speckers');
      $this->db->trans_complete();
      
      if($this->db->trans_status() == false){
          $this->db->trans_rollback();
          $res = array('error' =>'Transaction Failed Because you try to hacking system');
      }else{
          return $res;
      }
  }
    
 public function get_webinartimetbl_details()
 {
     $this->db->trans_start();
     $res = $this->db->get('webinar_timetable')->result_array();
     $this->db->trans_complete();
     
     if($this->db->trans_status() == false){
         $this->db->trans_rollback();
         $res = array('error' =>'Transaction Failed Because you try to hacking system');
     }else{
         return $res;
     }
 }
 
 
 public function get_presipal_data()
 {
     $this->db->trans_start();
     $res = $this->db->get('principal_sig')->result_array();
     $this->db->trans_complete();
     
     if($this->db->trans_status() == false){
         $this->db->trans_rollback();
         $res = array('error' =>'Transaction Failed Because you try to hacking system');
     }else{
         return $res;
     }
 }
    
    
  public function inserted_presipal_sigh($arraydata)
    {
    $this->db->trans_start();
	 $res = $this->db->insert('principal_sig',$arraydata);
	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

      return $res;
  }
   
   
   
    }
    
    
     public function delete_presipal_sign($presipalId)
  {
      $this->db->trans_start();
      $this->db->where('presipal_id',$presipalId);
      $res = $this->db->delete('principal_sig');
      $this->db->trans_complete();
      
      if($this->db->trans_status() == false){
          $this->db->trans_rollback();
          $res = array('error' =>'Transaction Failed Because you try to hacking system');
      }else{
          return $res;
      }
  }
    
    













































































































}
?>