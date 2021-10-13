<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Zoomsetting_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $this->db->select('*');
        $this->db->from('zoom_settings');
        $this->db->order_by('zoom_settings.id');
        $query = $this->db->get();
        return $query->row();
    }

    public function add($data)
    {

        $this->db->trans_begin();

        $q = $this->db->get('zoom_settings');

        if ($q->num_rows() > 0) {
            $results = $q->row();
            $this->db->where('id', $results->id);
            $this->db->update('zoom_settings', $data);
        } else {

            $this->db->insert('zoom_settings', $data);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    
    
    public function recieptno()
{
 
   $year =  date("Y");
   $year = substr( $year, -2);
   $nextyear =  date('Y', strtotime('+2 year'));
   $nextyear = substr( $nextyear, -2);

   $autogenrate = 100;

   $savelastdigit = $this->uodatenumber($autogenrate);
   print_r($savelastdigit);
   $diff = $nextyear - $year;
   if($diff==1){
     echo "no update";
   }else{
    echo "update from beginning";  
   $savelastdigit = $this->uodatenumber($autogenrate);
   print_r($savelastdigit);
   }
}


public function uodatenumber($autogenrate)
{

    return $savelastdigit = $autogenrate + 1;
   
}

}
