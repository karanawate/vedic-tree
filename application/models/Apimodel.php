<?php
class apiModel extends CI_Model
{

	public function getdata($studentMobile,$studentPass)
	{
	    
		$stdentAttendancelog = array('logRandomId'=>rand(111111,999999));
    	$this->db->where('studentMobile',$studentMobile);
    	$this->db->or_where('studentAltMobile',$studentMobile);
    	$this->db->update('studentreg',$stdentAttendancelog);
    	
		$this->db->where('studentMobile',$studentMobile);
		$this->db->where('studentPass',sha1($studentPass));
		$this->db->where('studentStatus',1);
		$res = $this->db->get('studentreg')->result();
		
		
    		
		if(empty($res)){
            
			$this->db->where('studentAltMobile',$studentMobile);
			$this->db->where('studentPass',sha1($studentPass));
			$this->db->where('studentStatus',1);
			return $res = $this->db->get('studentreg')->result();
			
		}else{
        
		    return $res;
		}

	}


public function deniedmobileaccess($studentMobile){


    $this->db->where('studentMobile',$studentMobile);
	$this->db->where('createDT',date("Y-m-d"));
	$this->db->where('mobStatus',1);
	$res = $this->db->get('tbl_denied_mobile_access')->result_array();
	if(!empty($res))
	{
		return 1;
	}else{

		$data = array('studentMobile'=>$studentMobile,'createDT'=>date('Y-m-d'),'mobStatus'=>1);
		$res = $this->db->insert('tbl_denied_mobile_access',$data);
		if($res==1){
		   return 2;
		}else{
		   return 0;
		}
	}




   }



   public function change_mobile_status($studentMobile){
       
       $this->db->where('studentMobile',$studentMobile);
       $result = $this->db->delete('tbl_denied_mobile_access');
		if($result==1){
		   return 1;
		}else{
		   return 0;
		}
		
       
   }
   
  public function updateData($studId){
       
       $this->db->where('studId',$studId);
       $result = $this->db->get('studentreg')->result_array();
		if($result){
		   return $result;
		}else{
		   return $result;
		}
		
       
   }
   
	
	
	
}


?>