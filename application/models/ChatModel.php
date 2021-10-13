<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class ChatModel extends CI_Model
{


public function start_chat($fk_teachId,$studId,$planId,$msg,$currentDate)
{
    
    $this->db->where('fk_studId',$studId);
    $result = $this->db->get('tbl_allocate_teacher_to_student')->result_array();   
    if(!empty($result)){
		$data  = array(	
						'fk_teachId' 	=> $fk_teachId,
						'fk_studId'		=> $studId,
						'stud_planid'	=> $planId,
						'chatMsg'		=> $msg,
						'readMsg'       => 1,
						'currentDate'	=> $currentDate
					);
		$res  = $this->db->insert('teacher_chat_window',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
	   		return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	   		
		}else{

			if($res==1)
			{
					$this->db->from('teacher_chat_window'); 
					$this->db->where('fk_teachId',$fk_teachId);
					$this->db->where('fk_studId',$studId);
					$res = $this->db->get()->result_array();
					return $res;
			}else{
			    	return $res = array();
			}

		}
    }else{
     return $res = array();   
    }
}


public function checkstudentallocatedteacher($studId){
     $this->db->where('fk_studId',$studId);
     $results = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
     return $results;
}


public function start_chat_with_img($fk_teachId,$studId,$msg,$planId,$currentDate,$chatimgup)
{
	

	$data  = array(	
						'fk_teachId' 	=> $fk_teachId,
						'fk_studId'		=> $studId,
						'stud_planid'	=> $planId,
						'chatMsg'		=> $msg,
						'chatimgup'		=> $chatimgup,
						'readMsg'       => 1,
						'currentDate'	=> $currentDate );
		$res  = $this->db->insert('teacher_chat_window',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
	   		return $res = array('error'=>'Transaction Failed Because you try to hacking system');
		} else {

			if($res==1)
			{
					$this->db->from('teacher_chat_window'); 
					$this->db->where('fk_teachId',$fk_teachId);
					$this->db->where('fk_studId',$studId);
					$res = $this->db->get()->result_array();
					return $res;
			}else{
			    	return $res = array();
			}
   }
		
}


public function Clearchat($studId)
{
    $this->db->where('fk_studId',$studId);
    return $res = $this->db->delete('teacher_chat_window');
}


public function ajax_get_chat_messages($fk_teachId,$studId,$currentDate){
    $curr     = date('Y-m-d H:i:s');
    $last_min = date('Y-m-d H:i:s', strtotime(' minutes'));
    $this->db->from('teacher_chat_window'); 
	$this->db->where('fk_studId',$fk_teachId);
	$this->db->where('fk_teachId',$studId);
 	$this->db->where('currentDate',$currentDate);
	$this->db->order_by('techcId','asc');
	$res = $this->db->get()->result_array();
	
	if($res){
	    
	    return $res;
	}else{
	    
	    return $res;    
	}
    
}



public function readMessage($studId,$readMsg)
{
	
	$dataarray = array('readMsg'=>$readMsg);
	$this->db->where('fk_studId',$studId);
	$this->db->or_where('fk_teachId',$studId);
	$res = $this->db->update('teacher_chat_window',$dataarray);
	if($res==1){
		return 1;
	} else {
		return 0;
	}

}


public function chathistory($studId){
    
    $this->db->where('fk_studId',$studId);
    $this->db->or_where('fk_teachId',$studId);
    // $this->db->join('studentreg','studentreg.studId = teacher_chat_window.fk_studId');
    return $results = $this->db->get('teacher_chat_window')->result_array();
    
}


function Checkteacherassign($studId)
{
    $this->db->select("*, tbl_teacher.logstatus as teacherStatusonline");
     $this->db->where('fk_studId',$studId);
     $this->db->join('studentreg','studentreg.studId = tbl_allocate_teacher_to_student.fk_studId');
     $this->db->join('tbl_teacher','tbl_teacher.teacherId = tbl_allocate_teacher_to_student.fk_teachId');
    $results = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
    return $results;
}












}

?>