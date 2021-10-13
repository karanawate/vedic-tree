<?php
class apiModel extends CI_Model
{

	public function getdata($studentMobile,$studentPass)
	{
		
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


	
	
	
}


?>