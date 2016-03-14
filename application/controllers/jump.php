<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
        const SUCCESS = 0;
        const CUSTOM_ERROR = 1;
        const NO_RECEIVER_IDS = 2;
        const MSG_MESSAGE = 0;

class Jump extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Jump_User_model');
    }

    public function index() {
        $this->load->view("jump/post");
    }

    public function test() {
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
        $path = './application/upload/jump/' . $name . '.jpg';
        for ($i = 0; $i < 10; $i++) {
            if (file_exists($path)) {
                $this->output->set_content_type('jpeg')->set_output(file_get_contents($path));
                return;
            }
            sleep(1);
        }
    }

    public function get_user($id) {
        $response = array('success' => FALSE);
        if ($this->Jump_User_model->get_user($id)) {
            $response['success'] = TRUE;
            $response['user'] = $this->Jump_User_model;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function get_users($search) {
        $response = $this->Jump_User_model->get_users($search);
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function save_user() {
        $id = $this->input->post('id');
        $mail = $this->input->post('mail');
        $name = $this->input->post('name');
        $existing = $this->Jump_User_model->get_user($id);
        $response = array('success' => TRUE);
        $this->Jump_User_model->id = $id;
        $this->Jump_User_model->mail = $mail;
        $this->Jump_User_model->name = $name;
        $this->Jump_User_model->pingdate = date('Y-m-d H:i:s');
        $this->Jump_User_model->regid = $this->input->post('regid');

        if ($existing) {
            $this->Jump_User_model->update_user();
        } else {
            $response["success"] = $this->Jump_User_model->create_user();
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function message_to_user() {
        $message = $this->input->post('message');
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $time = $this->input->post('time');

        $this->internal_message_to_user(
                $from, $to, MSG_MESSAGE, TRUE, array("message" => $message, "time" => $time));
    }

    private function internal_message_to_user($from, $to, $response_code, $do_output = TRUE, $args = array()) {
        $ids = "";
        if ($this->Jump_User_model->get_user($to))
            $ids = $this->Jump_User_model->regid;
        if ($ids == "") {
            $response->result = NO_RECEIVER_IDS;
        } else {
            $regids = array();
            array_push($regids, $ids);
            $ar = array(
                'msgtype' => $response_code,
                'to' => $to,
                'from' => $from
            );
            $ar = array_merge($ar, $args);
            $result = $this->send_message($regids, $ar);
            $response = array('result' => SUCCESS, "gcmresponse" => json_decode($result));
        }

        if ($do_output) {
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
        }
    }

    private function send_message($registrationIDs, $data, $collapse_key = NULL) {
        $apiKey = "AIzaSyDDAXQI2FJrICPuWXRbBlJVBGQNZJaxoF4";

        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $registrationIDs,
            'data' => $data
        );
        if ($collapse_key != NULL) {
            $fields['collapse_key'] = $collapse_key;
        }
        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);

        // Close connection
        curl_close($ch);

        return $result;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
