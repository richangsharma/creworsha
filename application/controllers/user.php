<?php 
class User extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('usermodel');
        $this->load->model('request');
    }
    public function index(){
        //show user join motivation here
    }
    
    public function login(){
            $data['title'] = 'Home|Creworsha-Create what you think.Work on what you like.Share what you have built.';
            $this->load->view('header' , $data);
            $this->load->view('login' , $data);
            $this->load->view('footer' , $data);
        }
   public function login_do(){
       //sleep(2);
       $usrn = $this->input->post('username');
       $pass = md5($this->input->post('password'));
       $response = $this->usermodel->login($usrn,$pass);
       if($response){
           foreach($response as $item){
               $name = $item->firstname;
               $fullname= $item->firstname.' '.$item->lastname;
               $email = $item->email;
               $username = $item->username;
               $id = $item->userid;
               $sess_push = array(
                 'name'  => $name,
                 'fullname' =>$fullname,
                 'email' => $email,
                 'username' => $username,
                 'id' => $id
               );
                $this->session->set_userdata($sess_push);
                echo 1;
                break;
           }
       }else{
           echo 0;
       }
   }
   public function register_do(){
       /*
        * Prepare variables to be send to usermodel
        */
       $config = array(
               array(
              'field' => 'username',
              'label' => 'Username',
              'rules' => 'required|min_length[6]|alpha_dash|is_unique[users.username]'  //check for unique username with db
          ),      array(
              'field' => 'first-name',
              'label' => 'First Name',
              'rules' => 'required|max_length[15]|alpha' 
          ),      array(
              'field' => 'last-name',
              'label' => 'Last Name',
              'rules' => 'required|max_length[30]|alpha' 
          ),      array(
              'field' => 'email',
              'label' => 'Email',
              'rules' => 'required|is_unique[users.email]|valid_email' 
          ),      array(
              'field' => 'password',
              'label' => 'Password',
              'rules' => 'required|min_length[6]' 
          ),      array(
              'field' => 'confirm-password',
              'label' => 'Confirm Password',
              'rules' => 'required|min_length[6]|matches[password]' 
          ),
       );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<p>', '</p>');
        //$this->form_validation->set_message('is_unique', 'Sorry !This username is already taken.');
        if ($this->form_validation->run() == FALSE)
		{//Action if form validation fails
			//echo validation_errors();
                 $error_push = array();
                        if(form_error('username')){
                            array_push($error_push, 'un');
                        }
                        if(form_error('first-name')){
                            array_push($error_push, 'fm');
                        }
                        if(form_error('last-name')){
                            array_push($error_push, 'lm');
                        }
                        if(form_error('email')){
                            array_push($error_push, 'em');
                        }
                        if(form_error('password')){
                            array_push($error_push, 'pwd');
                        }
                        if(form_error('confirm-password')){
                            array_push($error_push, 'cpwd');
                        }
                        echo json_encode($error_push);
		}
		else
		{//Action if form validation passes
                    $username = $this->input->post('username');
                    $firstname = $this->input->post('first-name');
                    $lastname = $this->input->post('last-name');
                    $email =  $this->input->post('email');
                    $password = md5($this->input->post('password'));
                    $response = $this->usermodel->register($username,$firstname,$lastname,$email,$password);
                    if($response){
                    echo 1;}else{
                        echo 500;
                    }
                }
   }
   public function success(){
       $name = $_GET['name'];
       $email =$_GET['email'];
       $data['title'] = 'Successfully Registered | Creworsha';
       $this->load->view('header' , $data);
       $this->load->view('registration-success',$data);
       $this->load->view('footer' , $data);
   }
   public function logout(){
       $this->session->sess_destroy();
       echo '<META http-equiv="refresh" content="2;URL='.SITEURL.'">';
   }
  public function quickstart(){
      $data['title'] = 'Quick Start | Creworsha';
       $this->load->view('header' , $data);
       $this->load->view('quickstart',$data);
       $this->load->view('footer' , $data);
  }
  public function get_message(){
      $response = $this->request->message($this->session->userdata('id'));
      if($response){
          echo json_encode($response);
      }else{
          echo 0;
      }
  }
  public function connect(){
      if(isset($_GET['userid']) && isset($_GET['msgid'])){
          //Do all operations here only 
            //List other users who are having value 0 and are requesting to work on this idea
                $this->db->where('msg_id',$_GET['msgid']);
                $que = $this->db->get('messages');
                if($que->num_rows() > 0 ){
                    foreach($que->result() as $item){
                        $ideaid = $item->id;
                        $message = $que->result();
                        //now search for all users who are requesting for this idea, and have okown = 0
                        $this->db->where('id',$ideaid);
                        $this->db->where('okown',0);
                        $que = $this->db->get('messages');
                        if($que->num_rows() > 0){
                            $users_arr = array();
                            foreach($que->result() as $users){
                                if($_GET['userid'] != $users->sentfrom){
                                $us = array(
                                    'id' => $users->sentfrom,
                                    'name' => $users->sendername
                                );
                                array_push($users_arr, $us);
                            }else{
                            }
                            }
                        }
                    }
                    //echo json_encode($users_arr);
                        $data['title'] = 'Begin | Creworsha';
                        $data['users'] = $users_arr;
                        $data['idea'] = $message;   
                        $this->load->view('header' , $data);
                        $this->load->view('toongoing',$data);
                        $this->load->view('footer' , $data);
                }else{
          redirect('./');
      }
      }else{
          redirect('./');
      }
  }
  public function toongoing(){
      $allowed = implode(',',$_REQUEST['allowed']);
      //Push this to database 
      //change this idea to ongoing
          $upd = array(
            'scope'   => 'ongoing'
          );
          $this->db->where('idea_id',$_REQUEST['ideaid']);
          $this->db->update('ideas',$upd);
          foreach($_REQUEST['allowed'] as $item){
              $this->db->where('id',$_REQUEST['ideaid']);
              $this->db->where('sentfrom',$item);
              $this->db->delete('messages');
          }
      $push_arr = array(
          'users' => $allowed,
          'idea' => $_REQUEST['ideaid'],
          'timeline' => $_REQUEST['timeline']
      );
          $this->db->insert('ongoing',$push_arr);
          echo 1;
  }
}
