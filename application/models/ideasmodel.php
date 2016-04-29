<?php 
class Ideasmodel extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function add($ideapush){
        if($this->db->insert('ideas',$ideapush)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function fetchideas(){
        $this->db->where('scope','idea');
        $que = $this->db->get('ideas');
        if($que->num_rows() >0 ){
            return $que->result();
        }else{
            return FALSE;
        }
    }
    public function fetchongoing(){
    $this->db->where('scope','ongoing');
    $que = $this->db->get('ideas');
    if($que->num_rows() >0 ){
        return $que->result();
    }else{
        return FALSE;
    }
}

public function fetchwork(){
    $this->db->where('scope','work');
    $que = $this->db->get('ideas');
    if($que->num_rows() >0 ){
        return $que->result();
    }else{
        return FALSE;
    }
}
    public function fetchidea($id){
        $this->db->where('idea_id' , $id);
        $que = $this->db->get('ideas');
        if($que->num_rows() >0 ){
            return $que->result();
        }else{
            return FALSE;
        }
    }
    public function reqres($id){
        $this->db->where('id',$id);
        $this->db->where('sentfrom',$this->session->userdata('id'));
        $que = $this->db->get('messages');
        if($que->num_rows() > 0){
            //Means it exists in database
            foreach($que->result() as $msg){
                switch($msg->okown){
                    case 0://Waiting
                        return 0;
                        break;
                    case 1: //Accepted
                        return 1;
                        break;
                    case 2://Denied
                        return 2;
                        break;
                }
            }
        }else{
            return -1;
        }
    }
    public function connect($pushmsg){
        $this->db->where('id',$pushmsg['id']);
        $this->db->where('sentfrom',$pushmsg['sentfrom']);
        $this->db->where('sentto',$pushmsg['sentto']);
        $que = $this->db->get('messages');
        if($que->num_rows() > 0){
            //means the request already exists in db
            $this->db->where('id',$pushmsg['id']);
            $this->db->where('sentfrom',$pushmsg['sentfrom']);
            $this->db->where('sentto',$pushmsg['sentto']);
            $updmsg = array(
              'message'   => $pushmsg['message'],
              'okown' => 0,
              'okreq' => 0
            );
            if($this->db->update('messages',$updmsg))
       {
           return 1;
       }
    else{
        return 0;
    }
        }else{
            //means the request is new
            if($this->db->insert('messages',$pushmsg))
       {
           return 1;
       }
    else{
        return 0;
    }
        }
       }
}
