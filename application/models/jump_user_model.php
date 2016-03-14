<?php

class Jump_User_model extends MY_Model {

    var $mail;
    var $name;
    var $id;
    var $regid;
    var $pingdate;

    public function __construct() {
        parent::__construct();
    }

    public function create_user() {
        return $this->db->insert('jump_users', $this);
    }

    public function update_user() {
        $this->db->where('id', $this->id);
        return $this->db->update('jump_users', array(
                    'regid' => $this->regid,
                    'name' => $this->name,
                    'mail' => $this->mail,
                    'pingdate' => $this->pingdate
        ));
    }

    public function update_user_ping() {
        $this->db->where('id', $this->id);
        return $this->db->update('jump_users', array(
                    'pingdate' => date('Y-m-d')
        ));
    }

    public function delete_user($id) {
        $query = $this->db->delete('jump_users ', array('id' => $id));
    }

    public function get_user($id) {
        $query = $this->db->get_where('jump_users ', array('id' => $id));
        if (!$query)
            return FALSE;
        if ($query->num_rows() === 1) {
            $this->assign($query->row());
            return TRUE;
        }
        return FALSE;
    }

    public function get_users($search) {
        $this->db->select('id, name, mail');
        $this->db->limit(20, 0);
        $this->db->like('name', $search);
        $this->db->or_like('mail', $search);
        $query = $this->db->get('jump_users');
        $response = array();
        foreach ($query->result() as $row) {
            array_push($response, $row);
        }
        return $response;
    }

    public function get_inactive_users($days) {
        $today = date('Y-m-d');
        $time = strtotime($today . '-' . $days . ' day');
        $limit = date('Y-m-d', $time);
        return $this->db->get_where('jump_users ', array('pingdate <' => $limit))->result();
    }

}
