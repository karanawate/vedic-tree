<?php

class teacherModel extends CI_Model
{
   
   public function check_login_data_teacher($data)
   {
   
       $this->db->where('teacherMobile', $data['teacherMobile'] );
       $this->db->where('teacherPass', $data['teacherPass'] );
       $this->db->where('teacherClass', $data['teacherClass'] );
       $this->db->where('teacherStatus', 1 );
       $res = $this->db->get('tbl_teacher')->result_array();
           if(!empty($res)){
               $dataarray = array('logstatus'=>1);
               $this->db->where('teacherMobile',$data['teacherMobile']);
               $this->db->update('tbl_teacher',$dataarray);
               $this->session->set_userdata('usersession',$res);
               return "1";
           }else{
               return "0";
           }
   }
   
   public function get_liveiddeleted($live_id)
   {
       $this->db->where('id', $live_id);
       $result = $this->db->get('tbl_notification_live_class')->result_array();
       return $result;
   }
       
   public function liveiddeleted($meetingId)
   {
       $this->db->where('meeting_id', $meetingId);
       $res = $this->db->delete(' tbl_notification_live_class');
       return $res;
   }
       
   public function edit_teacher($live_id)
   {
       
       $this->db->where('id', $live_id);
       $this->db->join('tbl_class', 'tbl_class.classId = tbl_notification_live_class.fkclassId');
       $this->db->join('tbl_batch', ' tbl_batch.batchId  = tbl_notification_live_class.fk_batchId');
       $this->db->join('tab_add_fees_data', 'tab_add_fees_data.feesId  =  tbl_notification_live_class.fk_planId');
       $res = $this->db->get('tbl_notification_live_class')->result_array();
       return $res;
       
   }
   public function update_teacher($data, $live_id)
   {
       $this->db->where('id', $live_id);
       $result = $this->db->update('tbl_notification_live_class', $data);
           if ($result == 1) {
               return "1";
           } else {
               return "0";
           }
       return $result;
   }
   
   public function view_studentlist($teacher_session,$batch_id)
   {
       $this->db->where('fk_teachId', $teacher_session);
       $this->db->where('fk_batchId', $batch_id);
       $this->db->join('tbl_class', 'tbl_class.classId = tbl_allocate_teacher_to_student.fk_classId');
       $this->db->join('tab_add_fees_data', 'tab_add_fees_data.feesId  = tbl_allocate_teacher_to_student.fk_feesId');
       $this->db->join('studentreg', 'studentreg.studId   = tbl_allocate_teacher_to_student.fk_studId');
       $this->db->join('tbl_batch', ' tbl_batch.batchId  = tbl_allocate_teacher_to_student.fk_batchId');
       $result = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
       if (!empty($result)) {
           return $result;
       } else {
           return $result;
       }
       
   }
       
   public function selectedClass()
   {
       
       $res = $this->db->get('tbl_class')->result_array();
       if (!empty($res)) {
           return $res;
       } else {
           return $res;
       }
       
   }
       
       
   public function selectedBatch()
   {
       $res = $this->db->get('tbl_batch')->result_array();
       if (!empty($res)) {
           return $res;
       } else {
           return $res;
       }
   }

   public function selectedpackage($fkclassId)
   {
       $this->db->where('fk_classId', $fkclassId);
       $res = $this->db->get('tab_add_fees_data')->result_array();
       if (!empty($res)) {
           return $res;
       } else {
           return $res;
       }
   }
   
   
  public function selectedsubject()
   {
       $res = $this->db->get('tbl_session_type')->result_array();
       if (!empty($res)) {
           return $res;
       } else {
           return $res;
       }
   }
   
   public function selectedmonth()
   {
       $res = $this->db->get('tbl_month')->result_array();
       if (!empty($res)) {
           return $res;
       } else {
           return $res;
       }
   }
   
   public function selectedday()
   {
       $res = $this->db->get('tbl_days')->result_array();
       if (!empty($res)) {
           return $res;
       } else {
           return $res;
       }
   }
       
   public function session_teacher_id($teacher_session)
   {

       $this->db->where('teacher_id', $teacher_session);
       $this->db->group_by('meeting_id');
       $this->db->join('tbl_class', 'tbl_class.classId = tbl_notification_live_class.fkclassId');
       $this->db->join('tbl_batch', ' tbl_batch.batchId  = tbl_notification_live_class.fk_batchId');
       $this->db->join('tab_add_fees_data', 'tab_add_fees_data.feesId  = tbl_notification_live_class.fk_planId');
       $query = $this->db->get('tbl_notification_live_class')->result_array();
       if (!empty($query)) {
           return $query;
       } else {
           return $query;
       }
      
      
   }
   
   public function session_teacher_id_api($fkclassId,$subjectid,$start_date)
   {
       
       $this->db->where('fkclassId', $fkclassId);
       $this->db->where('subjectid', $subjectid);
       $this->db->where('start_date', $start_date);
       $query = $this->db->get('tbl_notification_live_class')->result();
      
       if (!empty($query)) {
           return $query;
       } else {
           return $query;
       }
       
       
   }
       
   public function allcated_count_student($usersession_id)
   {
       $this->db->where('fk_teachId', $usersession_id);
       $this->db->join('tbl_class', 'tbl_class.classId = tbl_allocate_teacher_to_student.fk_classId');
       $this->db->join('tab_add_fees_data', 'tab_add_fees_data.feesId  = tbl_allocate_teacher_to_student.fk_feesId');
       $this->db->join('studentreg', 'studentreg.studId   = tbl_allocate_teacher_to_student.fk_studId');
       $query =  $this->db->get('tbl_allocate_teacher_to_student')->num_rows();
       if (!empty($query)) {
           return $query;
       } else {
           return $query;
       }
   }
       
   public function teacherform_inserted($fktbl_notification_live_class_id)
   {
       $res = $this->db->insert('tbl_liveteacher_attedence', $fktbl_notification_live_class_id);

       if (!empty($res)) {
           return $res;
       } else {
           return $res;
       }
       
   }
       
   public function attedence_update($data, $fk_batchId, $fkclassId, $teacher_id)
   {
       $this->db->where('teacher_id', $teacher_id);
       $this->db->where('fkclassId', $fkclassId);
       $this->db->where('fk_batchId', $fk_batchId);
       $result = $this->db->update('tbl_liveteacher_attedence', $data);
       if ($this->db->affected_rows() > 0) {
           return TRUE;
       } else {
           return FALSE;
       }
       
   }
       
   public function update_att($date)
   {
       $this->db->where('date', $date);
       $result = $this->db->get('student_attendances')->row();
       
       if ($this->db->affected_rows()) {
           return TRUE;
       } else {
           return FALSE;
       }
       
   }
   
   public function present_studence($present_id)
   {
       $this->db->where('student_id', $present_id);
        $query = $this->db->get('student_attendances')->result_array();
       if (!empty($query)) {
           return $query;
       } else {
           return $query;
       }
       
   }
   
   
   
  public function final_student_abb_present($teacher_session, $fees_id)
   {
        $this->db->where('teacher_id',$teacher_session);
        $this->db->where('fk_feesId',$fees_id);
        $query = $this->db->get('student_attendances')->result_array(); 
        if (!empty($query)) {
           return $query;
       } else {
           return $query;
       }
       
   }
   public function registion($data)
   {
       $result = $this->db->insert('tbl_teacher', $data);
           if($result == 1)
           {
               return "1";
           }
           else
           {
               return "0";
           }

   }
   
   public function student_present_check($teacher_session, $batch_id,$date_current,$fk_feesId)
   {
       $this->db->where('teacher_id', $teacher_session);
       $this->db->where('fk_batchId',$batch_id);
       $this->db->where('fk_feesId',$fk_feesId);
       $this->db->where('date_current',$date_current);
       $query = $this->db->get('student_attendances')->result_array();
       if (!empty($query)) {
           return $query;
       } else {
           return $query;
       }
        
   }
   
   public function student_attendance_insert($ada){
        $result =  $this->db->insert('student_attendances', $ada);
        if($result ==1)
        {
            return "1";
        }
        else
        {
            return "0";
        }
   }
   
       //start here
   
 public function checkteacher_successful_student_id($teacher_session,$fkclassId,$fk_batchId, $fk_planId)
   {
   	$this->db->where('fk_teachId',$teacher_session);
   	$this->db->where('fk_classId',$fkclassId);
   	$this->db->where('fk_batchId',$fk_batchId);
   	$this->db->where('fk_feesId',$fk_planId);
   	$res = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
   	if (!empty($res)) {
           return $res;
       } else {
           return $res;
       }
   
   }
   
   public function cheackpresentclass($teacher_session,$fkclassId,$fk_batchId,$fk_planId){
   
   	$this->db->where('teacher_id',$teacher_session);
   	$this->db->where('fkclassId',$fkclassId);
   	$this->db->where('fk_batchId',$fk_batchId);
   	$this->db->where('fk_planId',$fk_planId);
   	$query =  $this->db->get('tbl_notification_live_class')->result_array();
   	if (!empty($query)) {
           return $query;
       } else {
           return $query;
       }
   }
   public function cheacklink_present_or_not($microsoft_link){
   
   	$this->db->where('microsoft_link',$microsoft_link);
    $query =  $this->db->get('tbl_notification_live_class')->result_array();
      if (!empty($query)) {
           return $query;
       } else {
           return $query;
       }
      
   }
   
   public function notice($data)
   {
   	$result = $this->db->insert('tbl_notification_live_class',$data);
   	if($result==1){
   		return "1";
   	}else{
   		return "0";
   	}
   }
   
   public function final_notifications($fktbl_notification_live_class_id)
   {
       $this->db->where('id', $fktbl_notification_live_class_id);
       $result = $this->db->get('tbl_notification_live_class')->result_array();
       if (!empty($result)) {
           return $result;
       } else {
           return $result;
       }
   }
   public function final_notifications_liveteacher_check($fktbl_notification_live_class_id)
   {
        $this->db->where('fk_notification_live', $fktbl_notification_live_class_id);
          $result = $this->db->get('tbl_liveteacher_attedence')->result_array();
          if (!empty($result)) {
               return $result;
           } else {
               return $result;
           }
           
   }
       
   
   public function view_studentlist_batch($teacher_session,$teacher_class)
   {
           $this->db->where('fk_teachId', $teacher_session);
           $this->db->where('tbl_allocate_teacher_to_student.fk_classId', $teacher_class);
           $this->db->group_by('fk_feesId');
          
           $this->db->join('tab_add_fees_data', ' tab_add_fees_data.feesId  = tbl_allocate_teacher_to_student.fk_feesId');
            $this->db->join('tbl_batch', ' tbl_batch.batchId  = tbl_allocate_teacher_to_student.fk_batchId');
           $result = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
            if (!empty($result)) {
               return $result;
           } else {
               return $result;
           }
            
   }
   //recap session model start here
   public function listvideouploading($fk_classId)
   {
   	$this->db->select('*,count(tbl_videouploadingdata.fk_dayId) as fk_count_dayId');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
   	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
   	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
   	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
   	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
   	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
   	$this->db->where('tbl_videouploadingdata.coursePeriod',0);
   	$this->db->group_by('fk_monthId');
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$res = $this->db->get()->result_array();
   		if(!empty($res)){
   			return $res;
   		}else {
   			return $res;
   		}
   }
   
   
   public function get_month_data_of_value_based_eductaion($vidcreateDT,$param,$endvidcreateDT,$fk_classId)
   {
   	
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
   	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
   	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
   	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
   	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
   	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
   	$this->db->where('tbl_videouploadingdata.param',$param);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.vidcreateDT>=',$vidcreateDT);
   	$this->db->where('tbl_videouploadingdata.vidcreateDT<=',$endvidcreateDT);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.coursePeriod',0);
   	$this->db->order_by('tbl_videouploadingdata.fk_dayId','asc');
   	$res = $this->db->get()->result_array();
   	// echo $this->db->last_query();
   	if(!empty($res)){
   		return $res;
   	}else {
   		return $res;
   	}
   }
   
   public function get_day_sessions_vid_recap_vidId($dayId,$monthId,$fk_classId,$vidId,$studId)
   {
   	
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
   	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
   	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
   	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
   	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
   	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
   	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.vidId',$vidId);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',3);
   	$this->db->where('tbl_videouploadingdata.coursePeriod',0);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   		if(!empty($res)){
   			return $res;
   		}else {
   			return $res;
   		}
   	
   }
   
   public function get_day_sessions_vid_by_default_recap($dayId,$monthId,$fk_classId,$studId)
   {
       	$this->db->select('*');
       	$this->db->from('tbl_videouploadingdata');
       	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
       	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
       	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
       	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
       	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
       	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
       	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
       	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
       	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
       	$this->db->where('tbl_videouploadingdata.status',1);
       	$this->db->where('tbl_videouploadingdata.fk_upload_key',3);
       	$this->db->where('tbl_videouploadingdata.coursePeriod',0);
       	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
       	$res = $this->db->get()->result_array();
       	
       	  

       	if(!empty($res)){
       		return $res;
       	}else {
       		return $res;
       	}
   }
   
   public function last_session_running_value_based($studId,$fk_classId)
   {
       	$this->db->where('fk_user_id',$studId);
       	$this->db->where('fk_classId',$fk_classId);
       	$this->db->order_by('trackId','desc');
       	$this->db->limit(1);
       	$res = $this->db->get('tbl_tracking_watch_video')->result_array();
       	if(!empty($res)){
       		return $res;
       	} else {
       		return $res;
       	}
   }
   
   public function get_day_sessions_vid_recap($dayId,$monthId,$fk_classId,$studId)
   {
       
       	$this->db->select('*');
       	$this->db->from('tbl_videouploadingdata');
       	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
       	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
       	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
       	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
       	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
       	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
       	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
       	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
       	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
       	$this->db->where('tbl_videouploadingdata.status',1);
       	$this->db->where('tbl_videouploadingdata.fk_upload_key',3);
       	$this->db->where('tbl_videouploadingdata.coursePeriod',0);
       	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
       	$res = $this->db->get()->result_array();
       	if(!empty($res)){
       		return $res;
       	}else {
       		return $res;
       	}
   	
   }
   
   public function last_session_running($studId,$fk_classId)
   {
       	$this->db->where('fk_user_id',$studId);
       	$this->db->where('fk_classId',$fk_classId);
       	$this->db->order_by('trackId','desc');
       	$this->db->limit(1);
       	$res = $this->db->get('tbl_tracking_watch_video')->result_array();
       	if(!empty($res)){
       		return $res;
       	} else {
       		return $res;
       	}
   }
   
   public function  studentsession_api($studId,$studentClass,$currentDate)
   {
       $this->db->where('fk_studId',$studId);
       $results = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
       if(!empty($results)){
       $this->db->where('status',1);
       $this->db->where('fk_planId',$results[0]['fk_feesId']);
       $this->db->where('start_date',$currentDate);
       $this->db->where('fkclassId',$studentClass);
       return $results = $this->db->get('tbl_notification_live_class')->result_array();
        
       }else{
         return  $results;
       }  
   
   }
   
   // learning  page 
   
   public function get_day_sessions($dayId,$monthId,$fk_classId,$studId)
   {
   
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
   	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
   	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
   	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
   	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
   	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
   	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.coursePeriod',0);
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',2);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   
   		if(!empty($res)){
   			return $res;
   		}else {
   			return $res;
   		}
   }
   
   
   public function get_day_sessions_three($dayId,$monthId,$fk_classId,$studId)
   {
   
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
   	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
   	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
   	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
   	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
   	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
   	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.coursePeriod',3);
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',2);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   
   		if(!empty($res)){
   			return $res;
   		}else {
   			return $res;
   		}
   }
   
   public function get_day_sessions_seven($dayId,$monthId,$fk_classId,$studId)
   {
   
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
   	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
   	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
   	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
   	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
   	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
   	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.coursePeriod',7);
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',2);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   
   		if(!empty($res)){
   			return $res;
   		}else {
   			return $res;
   		}
   }
   
   
   public function get_day_sessions_vid($dayId,$monthId,$fk_classId,$vidId,$studId)
   {
   
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
   	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
   	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
   	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
   	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
   	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
   	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.vidId',$vidId);
   	$this->db->where_not_in('coursePeriod',['7','3']);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',2);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   	  
   	if(!empty($res)){
   		return $res;
   	}else {
   		return $res;
   	}
   	
   }
   
   
   public function get_day_sessions_vid_three($dayId,$monthId,$fk_classId,$vidId,$studId)
   {
   
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
   	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
   	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
   	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
   	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
   	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
   	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.vidId',$vidId);
   	$this->db->where('coursePeriod',3);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',2);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   	  
   	if(!empty($res)){
   		return $res;
   	}else {
   		return $res;
   	}
   	
   }
   
   
   public function get_day_sessions_vid_seven($dayId,$monthId,$fk_classId,$vidId,$studId)
   {
   
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
   	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
   	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
   	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
   	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
   	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
   	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.vidId',$vidId);
   	$this->db->where('coursePeriod',7);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',2);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   	  
   	if(!empty($res)){
   		return $res;
   	}else {
   		return $res;
   	}
   	
   }
   
   
   
   
   
   public function get_day_sessions_vid_by_default($dayId,$monthId,$fk_classId,$studId)
   {
       $open_monthdata = $this->db->get('log_payment_data')->result_array();
       if(!empty($open_monthdata)){
       	$fk_upload_key = 2;
       }else{
       	$fk_upload_key = 1;
       }
   
   
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
   	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
   	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
   	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
   	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
   	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
   	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.coursePeriod',0);
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',$fk_upload_key);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   	
   	 	
   	 	
   	 	
   	if(!empty($res)){
   		return $res;
   	}else {
   		return $res;
   	}
   	
   }
   
   
   public function get_day_sessions_vid_by_default_three($dayId,$monthId,$fk_classId,$studId)
   {
       $open_monthdata = $this->db->get('log_payment_data')->result_array();
       if(!empty($open_monthdata)){
       	$fk_upload_key = 2;
       }else{
       	$fk_upload_key = 1;
       }
   
   
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
   	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
   	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
   	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
   	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
   	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
   	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.coursePeriod',3);
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',$fk_upload_key);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   	
   	 	
   	 	
   	 	
   	if(!empty($res)){
   		return $res;
   	}else {
   		return $res;
   	}
   	
   }
   
   
   public function get_day_sessions_vid_by_default_seven($dayId,$monthId,$fk_classId,$studId)
   {
       $open_monthdata = $this->db->get('log_payment_data')->result_array();
       if(!empty($open_monthdata)){
       	$fk_upload_key = 2;
       }else{
       	$fk_upload_key = 1;
       }
   
   
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
   	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
   	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
   	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
   	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
   	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
   	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.coursePeriod',7);
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',$fk_upload_key);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   	
   	 	
   	 	
   	 	
   	if(!empty($res)){
   		return $res;
   	}else {
   		return $res;
   	}
   	
   }
   
   
   
   public function view_studentlistt($teacher_session,$fees_id)
   {
       $this->db->where('fk_teachId', $teacher_session);
       $this->db->where('fk_feesId', $fees_id);
       $this->db->join('tbl_class', 'tbl_class.classId = tbl_allocate_teacher_to_student.fk_classId');
       $this->db->join('tab_add_fees_data', 'tab_add_fees_data.feesId  = tbl_allocate_teacher_to_student.fk_feesId');
       $this->db->join('studentreg', 'studentreg.studId   = tbl_allocate_teacher_to_student.fk_studId');
       $this->db->join('tbl_batch', ' tbl_batch.batchId  = tbl_allocate_teacher_to_student.fk_batchId');
       $result = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
       if (!empty($result)) {
           return $result;
       } else {
           return $result;
       }
       
   }
   
   
   public function attedence_updatenot_insert($data)
   {
       $res = $this->db->insert('tbl_liveteacher_attedence', $data);
      if(!empty($res)) {
           return $res;
        } else {
           return $res;
        }
     
      
   }
   
   public function teacher_logs($usersession_id)
   {
        $this->db->where('teacher_id', $usersession_id);
        $res = $this->db->get('tbl_liveteacher_attedence')->result_array();
        if(!empty($res)) {
           return $res;
        } else {
           return $res;
        }
        
        
   }
   
   public function plan_idwisestudent($fk_planId,$fkclassId)
   {
            $this->db->where('fk_feesId',$fk_planId);
            $this->db->where('fk_classId',$fkclassId);
            $res = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
            if(!empty($res)) {
               return $res;
            } else {
               return $res;
            }
           
   }
       
     public function update_student_month($fk_studId,$mId,$dId){
       
       date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
       $lock_update_date =  date('Y-m-d h:i:s');
       $dataarray = array('unlock_monthId'=>$mId,'unlockdayId'=>$dId,'lock_update_date' =>$lock_update_date);
        $this->db->where('studId',$fk_studId);
       $results = $this->db->update('studentreg',$dataarray);
       
    //   echo $this->db->last_query();
      
       if($results==1){
           return 1;
       }else{
           return 0;
       }
            
    }
   
   public function student_locking_days($teacher_session, $teacher_class)
   {
       $this->db->where('fk_teachId', $teacher_session);
       $this->db->where('tbl_allocate_teacher_to_student.fk_classId', $teacher_class);
       $this->db->group_by('fk_feesId'); 
       $this->db->join('tab_add_fees_data', ' tab_add_fees_data.feesId  = tbl_allocate_teacher_to_student.fk_feesId');
       $this->db->join('tbl_batch', ' tbl_batch.batchId  = tbl_allocate_teacher_to_student.fk_batchId');
       $res = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
       if(!empty($res)) {
           return $res;
        } else {
           return $res;
        }
       
   }
   
   public function student_locking_days_attedence($teacher_session,$fees_id)
   {
       $this->db->where('fk_teachId', $teacher_session);
       $this->db->where('fk_feesId', $fees_id);
       $this->db->join('tbl_class', 'tbl_class.classId = tbl_allocate_teacher_to_student.fk_classId');
       $this->db->join('tab_add_fees_data', 'tab_add_fees_data.feesId  = tbl_allocate_teacher_to_student.fk_feesId');
       $this->db->join('studentreg', 'studentreg.studId   = tbl_allocate_teacher_to_student.fk_studId');
       $this->db->join('tbl_batch', ' tbl_batch.batchId  = tbl_allocate_teacher_to_student.fk_batchId');
       $result = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
       if (!empty($result)) {
           return $result;
       } else {
           return $result;
       }
       
   }
   
   public function list_zoom_meeting()
   {
         date_default_timezone_set('Asia/Kolkata');
         $date =  date('Y-m-d');
         $this->db->group_by('zoom_occurance_records.meeting_id');
         $this->db->like('zoom_occurance_records.start_time', $date);
         $this->db->join('tbl_notification_live_class', 'tbl_notification_live_class.meeting_id = zoom_occurance_records.meeting_id');
         $this->db->join('tab_add_fees_data', 'tab_add_fees_data.feesId = zoom_occurance_records.fk_plan_id');
         $res =  $this->db->select('*')->from('zoom_occurance_records')->get()->result_array();
         if(!empty($res)) {
           return $res;
        } else {
           return $res;
        }
         
       
   }
   public function get_zoom_details($zoom_id)
   {
       $this->db->where('meeting_id', $zoom_id);
       $res = $this->db->get('tbl_notification_live_class')->result_array();
       if(!empty($res)) {
           return $res;
        } else {
           return $res;
        }
         
   }
       
   public function check_report_dateandstatuswise($start_time,$end_time)
   {
        date_default_timezone_set('Asia/Kolkata');
        $date =  date('Y-m-d');
        $this->db->where('created_date', $date);
        $this->db->where('fk_start_time', $start_time);
        $this->db->where('fk_end_time', $end_time);
        $res = $this->db->get('zoom_occurance_reports')->result_array();
        if(!empty($res)) {
           return $res;
        } else {
           return $res;
        }
        
   }
   
   public function occurance_report($data)
   {
       $result = $this->db->insert('zoom_occurance_reports',$data);
       // echo $this->db->last_query();
       	if($result==1){
       		return "1";
       	}else{
       		return "0";
       	}
   }
   
   public function get_particular_report($meetingId)
   {
       $this->db->where('zoom_occurance_reports.meetingId', $meetingId);
       $this->db->group_by('zoom_occurance_reports.user_email');
       $this->db->select('*');
       $this->db->select_sum('zoom_occurance_reports.duration');
       $this->db->join('studentreg', 'studentreg.alternate_email   =  zoom_occurance_reports.user_email','left');
       $res = $this->db->get('zoom_occurance_reports')->result_array();
       if(!empty($res)) {
           return $res;
        } else {
           return $res;
        }
       
   
   }
   
   public function teacher_profile_update($teacher_id,$data)
   {
   
       $this->db->where('teacherId',$teacher_id);
       $result = $this->db->update('tbl_teacher', $data);
       if ($result == 1) {
           return "1";
       } else {
           return "0";
       }
       
      // echo $this->db->last_query(); 
       return $result;
   
   }
       
   public function teacher_full_info($teacher_session)
   {
       $this->db->where('teacherId',$teacher_session);
       $res = $this->db->get('tbl_teacher')->result_array();
       if(!empty($res)) {
           return $res;
        } else {
           return $res;
        }
   }
   
   
   //COMMON VIDEO 
   
   public function get_day_sessions_vid_com($dayId,$monthId,$fk_classId,$vidId,$studId)
   {
   
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.vidId',$vidId);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',4);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   	if(!empty($res)){
   		return $res;
   	}else {
   		return $res;
   	}
   	
   }
   
   public function get_day_sessions_vid_by_default_com($dayId,$monthId,$fk_classId,$studId)
   {
    $open_monthdata = $this->db->get('log_payment_data')->result_array();
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',4);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   	if(!empty($res)){
   		return $res;
   	}else {
   		return $res;
   	}
   	
   }
   
   
   public function get_day_sessions_com($dayId,$monthId,$fk_classId,$studId)
   {
   	$this->db->select('*');
   	$this->db->from('tbl_videouploadingdata');
   	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
   	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
   	$this->db->where('tbl_videouploadingdata.status',1);
   	
   	$this->db->where('tbl_videouploadingdata.fk_upload_key',4);
   	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
   	$res = $this->db->get()->result_array();
   	if(!empty($res)){
   		return $res;
   	}else {
   		return $res;
   	}
   	
   }
   
   //chat model start from here
   
   public function chat_studentlist_package($teacher_session,$teacher_class)
   {
            $this->db->where('fk_teachId', $teacher_session);
             $this->db->where('tbl_allocate_teacher_to_student.fk_classId', $teacher_class);
            $this->db->group_by('fk_feesId');
            $this->db->join('tab_add_fees_data', ' tab_add_fees_data.feesId  = tbl_allocate_teacher_to_student.fk_feesId');
            $this->db->join('tbl_batch', ' tbl_batch.batchId  = tbl_allocate_teacher_to_student.fk_batchId');
            $res = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
            if(!empty($res)) {
               return $res;
            } else {
               return $res;
            }
   }
   
   
   public function chat_studentListsub_attdence($teacher_session,$fees_id)
   {
       $this->db->where('fk_teachId', $teacher_session);
       $this->db->where('fk_feesId', $fees_id);
       $this->db->join('tbl_class', 'tbl_class.classId = tbl_allocate_teacher_to_student.fk_classId');
       $this->db->join('tab_add_fees_data', 'tab_add_fees_data.feesId  = tbl_allocate_teacher_to_student.fk_feesId');
       $this->db->join('studentreg', 'studentreg.studId   = tbl_allocate_teacher_to_student.fk_studId');
       $this->db->join('tbl_batch', ' tbl_batch.batchId  = tbl_allocate_teacher_to_student.fk_batchId');
       $result = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
       if (!empty($result)) {
           return $result;
       } else {
           return $result;
       }
       
       
   }
   
   public function group_chat_get_info($fees_id)
   {
            $this->db->where('feesId', $fees_id);
            $res = $this->db->get('tab_add_fees_data')->result_array();
            if(!empty($res)) {
               return $res;
            } else {
               return $res;
            }
   }
   
  public function chat_to_student($student_id,$teacher_session,$fees_id)
   {
           
        $this->db->where('fk_studId', $student_id);
        $this->db->where('fk_teachId', $teacher_session);
        $this->db->where('fk_feesId', $fees_id);
        $this->db->join('studentreg', 'studentreg.studId   = tbl_allocate_teacher_to_student.fk_studId');
        $res = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
        if(!empty($res)) {
           return $res;
        } else {
           return $res;
        }
   }
   
       public function get_chat_Particular_student_allchat($student_id,$teacher_session)
   {
             $sql_query ="SELECT *
                   FROM teacher_chat_window
                   WHERE
                   fk_teachId = $student_id AND  fk_studId = $teacher_session
                   OR
                   fk_studId = $student_id AND fk_teachId = $teacher_session";
                   $query = $this->db->query($sql_query);
                   return  $query->result_array();
   }
   
   
  public function readMessage($student_id,$readMsg)
  {
    //   $dataarray = array('readMsg'=>$readMsg);
    //   $this->db->where('fk_studId',$student_id);
    //   $this->db->or_where('fk_teachId',$student_id);
    //   $res = $this->db->update('teacher_chat_window',$dataarray);
    //   if($res==1){
    //   return 1;
    //   }else{
    //   return 0;
    //   }
  }
   
   public function start_chat_to_student($fk_teachId,$studId,$msg,$currentDate,$fees_id)
   {
   		$data  = array(	
   						'fk_teachId' 	=> $studId,
   						'fk_studId'		=> $fk_teachId,
   						'chatMsg'		=> $msg,
   						'group_plan_id'	=> $fees_id,
   						'currentDate'	=> $currentDate);
   		$res  = $this->db->insert('teacher_chat_window',$data);
   		if($res==1)
   		{
   				$this->db->from('teacher_chat_window'); 
   				$this->db->where('fk_teachId',$studId);
   				$this->db->where('fk_studId',$fk_teachId);
   				$this->db->where('group_plan_id', $fees_id);
   				$res = $this->db->get()->result_array();
   				return $res;
   		}else{
   		    	return $res = array();
   		}
   
   		
   }
   
   public function start_chat_with_img_student($teacherId,$studId,$msg,$currentDate,$chatimgup)
   {
   	$data  = array(	
   						'fk_teachId' 	=> $studId,
   						'fk_studId'		=> $teacherId,
   						'chatMsg'		=> $msg,
   						'chatimgup'		=> $chatimgup,
   						'currentDate'	=> $currentDate);
   		$res  = $this->db->insert('teacher_chat_window',$data);
   		if($res==1)
   		{
   				$this->db->from('teacher_chat_window'); 
   				$this->db->where('fk_teachId',$studId);
   				$this->db->where('fk_studId',$teacherId);
   				$res = $this->db->get()->result_array();
   				return $res;
   				
   		}else{
   		        
   		    	return $res = array();
   		}
   
   		
   		
   }
   
   //notice student api here
   
   public function student_common_notice($class_id)
   {
   	 $this->db->where('class_id',$class_id);
     $this->db->from('notice'); 
   	 $res = $this->db->get()->result_array();
   	 return $res;
   }
   
   // student privosu api here
   public function student_previous_month($student_id)
   {
       
       $this->db->where('fk_studId', $student_id);
       $this->db->from('log_payment_data'); 
   	   $res = $this->db->get()->result_array();
       return $res;
   }
   
   public function student_previous_month_table($monthdate)
   {
       $this->db->like('tbl_batchDT',$monthdate);
       $this->db->from('tbl_batch_month'); 
       $result = $this->db->get()->result_array();
       return $result;
   }
   
   public function updateinfo_month_daywise_calender($datas,$studId)
   {     $this->db->where('studId',$studId );
         $result = $this->db->update('studentreg', $datas);
         return $result;
   }
   
   //homework model start from here
   
   public function view_studentlist_batch_homework($teacher_session)
{
        $this->db->where('fk_teachId', $teacher_session);
        $this->db->group_by('fk_feesId');
       
        $this->db->join('tab_add_fees_data', ' tab_add_fees_data.feesId  = tbl_allocate_teacher_to_student.fk_feesId');
         $this->db->join('tbl_batch', ' tbl_batch.batchId  = tbl_allocate_teacher_to_student.fk_batchId');
        $query = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
        // echo $this->db->last_query();
         return $query;

    
}

public function homework_allocated_test($home_title,$description,$start_time,$end_time,$FILENAMES,$fk_feesId, $class_id,$studentId)
{
    $data  = array(	
						'home_title' 	    => $home_title,
						'description'		=> $description,
						'start_time'		=> $start_time,
						'end_time'		    => $end_time,
						'allocated_file'    => $FILENAMES,
						'fk_feesId'         => $fk_feesId,
						'class_id'          => $class_id,
						'fk_studentId'      => $studentId
						);
						
		$res  = $this->db->insert('homework_allocated',$data);
	
		if($res ==1){
		    return 1;
		}
		else
		{
		    return 0;
		}
}


  public function get_course_infomation_t($studId)
    {
        $this->db->where('fk_studId', $studId);
        $res = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
        return $res;
    }

    public function get_student_homeworks_t($class_id,$plan_id,$fk_studId)
    {
        $this->db->where('fk_class_id',$class_id);
        $this->db->where('fk_feesId',$plan_id);
        $this->db->where('fk_studentId',$fk_studId);
        $this->db->group_by('start_time'); 
        $this->db->order_by('start_time', 'desc'); 
        $res = $this->db->get('student_back_response_homework')->result_array();
         return $res;
    }
    
    public function student_homework_particular(){
    
    $fk_studId =     $this->uri->segment(3);
    $usersession    = $this->session->userdata('usersession');
  if(!empty($usersession)) {
       $get_course_info = $this->teacherModel->get_course_infomation_t($fk_studId);
       $class_id = $get_course_info[0]['fk_classId'];
       $plan_id  = $get_course_info[0]['fk_feesId'];
       $data['student_homeworks'] = $this->teacherModel->get_student_homeworks_t($class_id,$plan_id,$fk_studId);
       $this->load->view('student_response_homework', $data);
  } else {
    redirect('teacher-login');
 }

    
   
  
}

    public function get_download_homework_t($start_time)
    {
         $this->db->where('start_time',$start_time);
         $res = $this->db->get('student_back_response_homework')->result_array();
         
          return $res;
        
    }
    
     public function update_remark_homework_on_student($student_id,$data)
    {
        
      $this->db->where('fk_studentId',$student_id);
      $result = $this->db->update('student_back_response_homework', $data);
        if ($result == 1) {
            return "1";
        } else {
            return "0";
        }
       return $result;
        
    }
    
    
    
public function add_live_stream($data){
        
    $result = $this->db->insert('tbl_notification_live_class', $data);
    if ($result == 1) {
            return "1";
    } else {
        return "0";
    }
        
}



    
public function get_live_stream(){
        
    $result = $this->db->get('tbl_notification_live_class')->result_array();
    if ($result) {
            return $result;
    } else {
        return $result;
    }
        
}
  
  

public function deleteliveStream($id)
{
	$this->db->trans_start();

	$this->db->where('id',$id);
	$res = $this->db->delete('tbl_notification_live_class');
	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

      return $res;
   }
}  
  
  
  public function view_homeworkfor_student_api($class_id,$package_id,$approvel_status)
  {
      	$this->db->where('class_id',$class_id);
      	$this->db->where('fk_feesId',$package_id);
      	$this->db->where('admin_approv_status',$approvel_status);
      	$res = $this->db->get('homework_allocated')->result_array();
        return $res;
  }
  
      public function back_reposense_homeworkapi($start_time,$homework_id,$fk_feesId,$class_id,$FILENAMES,$home_title,$studId)
    {
        
         $data  = array(	
                        'fk_studentId'      =>$studId,
						'start_time' 	    => $start_time,
						'fk_homework_id'    => $homework_id,
						'fk_feesId'		    => $fk_feesId,
						'fk_class_id'		=> $class_id,
						'allocated_file'    => $FILENAMES,
						'home_title'        =>$home_title
						);
						
					
					
						
		$res  = $this->db->insert('student_back_response_homework',$data);
	
		if($res ==1){
		    return 1;
		}
		else
		{
		    return 0;
		}
        
        
    }
    
    
public function homework_allocated_nofile_uploaded($home_title,$description,$start_time,$end_time,$fk_feesId, $class_id)
{
    $data  = array(	
						'home_title' 	    => $home_title,
						'description'		=> $description,
						'start_time'		=> $start_time,
						'end_time'		    => $end_time,
						'fk_feesId'         => $fk_feesId,
						'class_id'          => $class_id,
						);
						
		$res  = $this->db->insert('homework_allocated',$data);
	
		if($res ==1){
		    return 1;
		}
		else
		{
		    return 0;
		}
}
    
    
    // report card model //
    
    
      public function view_studentlist_batch_report($teacher_session)
{
        $this->db->where('fk_teachId', $teacher_session);
        $this->db->group_by('fk_feesId');
        $this->db->join('tab_add_fees_data', ' tab_add_fees_data.feesId  = tbl_allocate_teacher_to_student.fk_feesId');
         $this->db->join('tbl_batch', ' tbl_batch.batchId  = tbl_allocate_teacher_to_student.fk_batchId');
        $query = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
        // echo $this->db->last_query();
         return $query;
}


      public function view_studentlistt_report($teacher_session,$fees_id)
    {
        $this->db->select('*,studentreg.studentName as pnamae,studentreg.studId as pstud_id');
        $this->db->where('fk_teachId', $teacher_session);
        $this->db->where('fk_feesId', $fees_id);
        $this->db->join('tbl_class', 'tbl_class.classId = tbl_allocate_teacher_to_student.fk_classId','left');
        $this->db->join('tab_add_fees_data', 'tab_add_fees_data.feesId  = tbl_allocate_teacher_to_student.fk_feesId','left');
        $this->db->join('studentreg', 'studentreg.studId   = tbl_allocate_teacher_to_student.fk_studId','left');
        $this->db->join('tbl_batch', ' tbl_batch.batchId  = tbl_allocate_teacher_to_student.fk_batchId','left');
        $this->db->join('report_first_term', 'report_first_term.fk_studId   = tbl_allocate_teacher_to_student.fk_studId','left');
        $this->db->join('report_second_term', 'report_second_term.fk_student_id   = tbl_allocate_teacher_to_student.fk_studId','left');
        $result = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
    
                       
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return $result = array(
                'error' => 'Transaction Failed Because you try to hacking systeam'
            );
        } else {
            
            if (!empty($result)) {
                return $result;
            } else {
                return $result;
            }
        }
        
    }

    public function report_student_data($studId)
   {
         $this->db->where('fk_studId', $studId);
         $this->db->join('report_details_student_second', 'report_details_student_second.fk_studId_id = report_details_student.fk_studId');
         $this->db->join('sign_uploads', 'sign_uploads.fk_teacher_id = report_details_student.teacher_id');
         $res = $this->db->get('report_details_student')->result_array();
         return $res;
   }

      public function report_student_data_delete($studId)
   {
         $this->db->where('fk_studId', $studId);
         $res = $this->db->delete('report_first_term');
         return $res;
   }
   
   
   // report card 

     public function get_gradecards()
    {
        $res = $this->db->get('report_cards')->result_array();
        return $res;
    }
    
      public function inserted_reportcard($data)
   {
       $res = $this->db->insert('report_first_term', $data);
       return $res;
   }
   public function inserted_reportcard_second($data)
   {
       $res = $this->db->insert('report_second_term', $data);
       return $res;
   }

 
   
    public function inserts_teachersign($arraydata)
   {
       $res = $this->db->insert('sign_uploads', $arraydata);
      
       return $res;
   } 
   
   
   public function check_student_package($fk_feesId, $class_id)
{
    $this->db->where('fk_feesId', $fk_feesId);
    $this->db->where('fk_classId', $class_id);
    $res = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
    return $res;
    
}

public function get_report_first($studId)
{
    $this->db->where('studId', $studId);
    $res = $this->db->get('studentreg')->result_array();
    return $res;
}

public function get_report_second($studId)
{
    $this->db->where('fk_student_id	', $studId);
    $res = $this->db->get('report_second_term')->result_array();
    return $res;
}


public function get_reportcardDetail($studId)
{
         $this->db->where('fk_studId', $studId);
          $this->db->join('sign_uploads', 'sign_uploads.fk_teacher_id = report_first_term.fk_teacherId');
          $res = $this->db->get('report_first_term')->result_array();
         return $res;
}

public function get_reportcardDetail_second($studId)
{
          $this->db->where('fk_studId', $studId);
          $this->db->join('sign_uploads', 'sign_uploads.fk_teacher_id = report_first_term.fk_teacherId');
          $this->db->join('report_second_term', 'report_second_term.fk_student_id = report_first_term.fk_studId');
          $res = $this->db->get('report_first_term')->result_array();
          return $res; 
}


public function delete_reportcardDetail_first($studId)
{
    $this->db->where('fk_studId',$studId);
	$res = $this->db->delete('report_first_term');
	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

      return $res;
   }
}

public function delete_reportcardDetail_two($studId)
{
    
    $this->db->where('fk_student_id',$studId);
	$res = $this->db->delete('report_second_term');
	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

      return $res;
   }
    
}
    
    public function getPresipalData(){
    
    $this->db->trans_start();
    $res = $this->db->get('principal_sig')->result_array();
    $this->db->trans_complete();
    if($this->db->trans_status() == FALSE)
    {
        return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
    }else{
        return $res;
    }
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
   
   
  
       
   }
   ?>