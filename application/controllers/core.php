<?php
class Core extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $data['title'] = 'Home|Creworsha-Create what you think.Work on what you like.Share what you have built.';
        $this->load->view('header' , $data);
        $this->load->view('home' , $data);
        $this->load->view('footer' , $data);
    }
    
}