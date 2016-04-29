<?php 
session_start();
class Ongoing extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('ideasmodel');
        $this->load->model('request');
        
    }
    public function index(){
        $data['title'] = 'Ongoing | Creworsha-Create what you think.Work on what you like.Share what you have built.';
        $data['ideas'] = $this->ideasmodel->fetchongoing();
        $data['ongoing'] = $this->request->ongoing();
        $this->load->view('header' , $data);
        $this->load->view('ongoing-browser' , $data);
        $this->load->view('footer' , $data);
    }
    public function deploy(){
        $id = $_GET['id'];
        $data['title'] = 'Deploy | Creworsha-Create what you think.Work on what you like.Share what you have built.';
        $data['ideas'] = $this->ideasmodel->fetchongoing();
        $data['ongoing'] = $this->request->ongoing();
        $this->db->where('idea_id',$id);
        $upd = array(
          'scope' => 'work'
        );
        $this->db->update('ideas',$upd);
        $this->load->view('header' , $data);
        $this->load->view('deploy' , $data);
        $this->load->view('footer' , $data);
    }
    public function add(){
        $data['title'] = 'Home|Creworsha-Create what you think.Work on what you like.Share what you have built.';
        
        if(isset($_SESSION['token'])){
        if(($_SESSION['token'] == '') || ($_SESSION['token'] == NULL))
        {
            $_SESSION['token'] = md5(time(). uniqid());
            /*echo 'session was not set.It is now !11';
            die();*/
        }else{
            //nothing 
            /*echo 'session is set'.$_SESSION['token'];
            die();*/
        }
        }else{
            $_SESSION['token'] = md5(time(). uniqid());
            /*echo 'session was not set.It is now !';*/
        }
        $this->load->view('header' , $data);
        $this->load->view('idea-wizard' , $data);
        $this->load->view('footer' , $data);
        
    }
    
    /**
        * Copy a whole Directory
        *
        * Copy a directory recrusively ( all file and directories inside it )
        *
        * @access    public
        * @param    string    path to source dir
        * @param    string    path to destination dir
        * @return    array
        */    
        
        public function directory_copy($srcdir, $dstdir)
        {
            umask(0);
         //preparing the paths
         $srcdir=rtrim($srcdir,'/');
         $dstdir=rtrim($dstdir,'/');

         //creating the destination directory
         if(!is_dir($dstdir))mkdir($dstdir, 0777, true);

         //Mapping the directory
         $dir_map=directory_map($srcdir);

         foreach($dir_map as $object_key=>$object_value)
         {
             if(is_numeric($object_key))
                 copy($srcdir.'/'.$object_value,$dstdir.'/'.$object_value);//This is a File not a directory
             
             else
                 $this->directory_copy($srcdir.'/'.$object_key,$dstdir.'/'.$object_key);//this is a directory
         }
        }
public function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}        
   public function add_do(){
        
       $title = $_POST['title'];
       $desc = $_POST['desc'];
       $id = $_SESSION['token'];
       $name = $this->session->userdata('name');
       //Read files from dir 
       $dirpath = FCPATH.'assets/upload/server/php/'.$_SESSION['token'];
       $ideabox = FCPATH.'ideabox/'.$_SESSION['token'];
       //check if user uploaded anything ?
       if (count(glob($dirpath."/*")) === 0 ) {
           //nope
       $ideapush = array(
         'idea_title'   => $title,
         'idea_desc' => $desc,
         'idea_id' => $id,
           'name' => $name,
           'user_id' => $this->session->userdata('id')
       );     
       }else{
           $images = array();
           $files = array();
           //yup
           $this->directory_copy($dirpath, $ideabox);
           exec('chmod 777 "'.$ideabox.'"/*');
           $this->deleteDir($dirpath);
           $dirtree = directory_map($ideabox);
       foreach($dirtree as $folder){
           if(!is_array($folder)){
           array_push($files,$folder);
           }else{
               foreach($folder as $thumbs){
                   array_push($images, $thumbs);
               }
           }
       }
       //prepare ideapush array using the uploaded files 
       $images = implode(',' , $images);
       $files = implode(',',$files);
       $ideapush = array(
         'idea_title'   => $title,
         'idea_desc' => $desc,
         'idea_id' => $id,
           'name' => $name,
         'user_id' => $this->session->userdata('id'),
         'idea_thumbs' => $images,
          'idea_files' => $files
       );
       }
       //push idea to database
       $response = $this->ideasmodel->add($ideapush);
       if($response){
           //destroy token from session
           $_SESSION['token'] = NULL;
           echo 1;
       }else{
           echo 0;
       }
   }
   public function view(){
        $data['title'] = 'Ongoing|Creworsha-Create what you think.Work on what you like.Share what you have built.';
        $ideaid = $_GET['id'];
        $data['idea'] = $this->ideasmodel->fetchidea($ideaid);
        $data['ongoing'] = $this->request->ongoing();
        $this->load->view('header' , $data);
        $this->load->view('ongoing' , $data);
        $this->load->view('footer' , $data);
   }
   public function connect(){
       $message = $_POST['message'];
       $idea = $_POST['idea'];
       $reciever = $_POST['reciever'];
       $sender = $this->session->userdata('id');
       $pushmsg = array(
         'senderid'  => $sender,
           'recieverid' => $reciever,
           'message' => $message,
           'idea' => $idea
       );
       $response = $this->ideasmodel->conncet($pushmsg);
   }
}