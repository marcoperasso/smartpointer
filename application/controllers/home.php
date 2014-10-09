<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
	$this->load_view('home_not_logged', "Benvenuto in SmartPointer");
	/*
        if ($this->user == NULL)
            $this->load_view('home_not_logged', "Benvenuto in ECOmmuters");
        else {
            $this->load->model('Post_model');
            $data = array(
                'posts' => $this->Post_model->get_posts($this->user->id, 0),
                'count' => $this->Post_model->get_post_count($this->user->id)
            );
            $this->load_view('home_logged', "Benvenuto in ECOmmuters", $data);
        }*/
    }

    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */