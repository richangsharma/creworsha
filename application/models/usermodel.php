<?php
class Usermodel extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function register($username,$firstname,$lastname,$email,$password){
        $push = array(
          'firstname'   => $firstname,
          'lastname' =>$lastname,
            'username' =>$username,
            'email' => $email,
            'password' =>$password
        );
        if($this->db->insert('users',$push)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function login($usrn,$pass){
        if(strpos($usrn, '@') == FALSE){
        $this->db->where('username' , $usrn);
        }else{
        $this->db->where('email' , $usrn);    
        }
        $this->db->where('password' , $pass);
        $que = $this->db->get('users');
        if($que->num_rows() > 0){
            //means user exists
            return $que->result();
        }else{
            return FALSE;
        }
    }
}