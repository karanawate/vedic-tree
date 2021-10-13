<?php

class webinarModel extends CI_Model
{

    public function insertweb($data)
    {
        
        $this->db->trans_start();
        $res = 	$this->db->insert('tbl_webinar',$data);
      	$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
    	{
    	   $this->db->trans_rollback();
    	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
    
    	}else{
    	    
          if($res==1){
        		return 1;
        	}else{
        	    return 0;
        	}
	   }
        
        
    }
    

function checkexist($studentMobile,$studentEmail){
    
    $this->db->trans_start();
    $this->db->where('studentMobile',$studentMobile);
    $this->db->or_where('studentEmail',$studentEmail);
    $res = 	$this->db->get('tbl_webinar')->result_array();
      	$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
    	{
    	   $this->db->trans_rollback();
    	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
    
    	}else{
    	    
          if(!empty($res)){
        		return 1;
        	}else{
        	    return 0;
        	}
	   }
    
    
} 


function getwebinardata(){
    
    $this->db->trans_start();
    $res = 	$this->db->get('tbl_webinar')->result_array();
  	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');

	}else{
	    
      if(!empty($res)){
    		return $res;
    	}else{
    	    return $res;
    	}
   }
    
    
} 



    
}
?>