<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jump extends CI_Controller {

    var $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view("jump/post");
    }
public function test()
{
    echo '<form enctype="multipart/form-data" action="saveImage/flip-grass-banner.jpg" method="POST">
  
  Invia questo file: <input name="userfile" type="file"></br>
  <input type="submit" value="Invia File">
</form>"';
}
    public function saveImage($name) {
        $config['upload_path'] = './application/upload/jump';
        $config['allowed_types'] = 'gif|jpg|png';
       $config['max_size'] = '2000';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = FALSE;
        $config['remove_spaces'] = TRUE;

        $response = array('success' => TRUE);
        if (!is_dir($config['upload_path'])) {
            $response["message"] = "THE UPLOAD DIRECTORY DOES NOT EXIST";
            $response["success"] = FALSE;
        } else {

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $response["messages"] = array('error' => $this->upload->display_errors());
                $response["success"] = FALSE;
                
                $response["aa"] = $_FILES;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function getImage($name) {
        $path = './application/upload/jump/'. $name .'.jpg';
        $this->output->set_content_type('jpeg')->set_output(file_get_contents($path));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
