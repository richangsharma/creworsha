<?php
class Request extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function reciever($id){
        $this->db->where('idea_id',$id);
        $que = $this->db->get('ideas');
        if($que->num_rows() > 0){
            return $que->result();
        }else{
            return FALSE;
        }
    }
    public function ongoing(){
        //generate key pair value for users
        $que = $this->db->get('ongoing');
        if($que->num_rows() > 0){
            $users_arr = array();
            $users_id = array();
            $pure_list = array();
            foreach($que->result() as $item){
                   $userids = explode(',',$item->users);
                   $timeline = $item->timeline;
                   $ideaid = $item->idea;
                   foreach($userids as $user){
                       $this->db->where('userid',$user);
                       $que = $this->db->get('users');
                       if($que->num_rows() > 0){
                           foreach($que->result() as $usr){
                               array_push($users_arr,$usr->firstname);
                               array_push($users_id,$usr->userid);
                           }
                       }
                   }
                   $users_list = implode(',',$users_arr);
                   $users_ids = implode(',',$users_id);
                   $couple = array(
                     'ideaid'   => $item->idea,
                     'users' => $users_list,
                     'userids' => $users_ids,
                     'timeline' => $timeline
                   );
                   array_push($pure_list,$couple);
            }
            
            return $pure_list;
        }
        
    }
    public function message($id){
        $this->db->where('sentto',$id);
        $this->db->where('seen',0);
        $que= $this->db->get('messages');
        if($que->num_rows() > 0){
            return $que->result();
        }else{
            return FALSE;
        }
    }
}