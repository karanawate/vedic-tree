<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Updatemonth extends REST_Controller 
{
    
    public function index_post()
    {
        $studId                 = $this->input->post('studId');
        $unlockdayId            = $this->input->post('unlockdayId');
        $unlock_monthId         = $this->input->post('unlock_monthId');
        
      if($studId=="" ){
        $data['error'] = array('error' => "Student Id is required !",'code'=>404);
      }elseif ($unlockdayId==""){
         $data['error'] = array('error' => "day Required",'code'=>404);
      }elseif ($unlock_monthId=="") {
         $data['error'] = array('error' => "month   Required ",'code'=>404);
      }else{
          
                    $datas =  array(
                          'studId'           => $studId,
                          'unlockdayId'      => $unlockdayId,
                          'unlock_monthId'   => $unlock_monthId
                        );
                        
                        
                $res = $this->teacherModel->updateinfo_month_daywise_calender($datas,$studId);
                if($res==1){
                    $data['error'] = array('success' => "Month Updated Successfully !");
        
                }else{
                    $data['error'] = array('error' => " Month is Not Updated Successfully !");
                    
                } 
                        
                        
      }
        $this->response($data, REST_Controller::HTTP_OK);
        
        
        
        
        
        
    }
    
   

}

?>
