<?php

class Jump_User_model extends MY_Model {

    var $phone;
    var $regid;
    var $pingdate;

    public function __construct() {
        parent::__construct();
    }

    public function create_user() {
         return $this->db->insert('jump_users', $this);
    }

    public function update_user() {
        $this->db->where('phone', $this->phone);
        return $this->db->update('jump_users', array(
                    'regid' => $this->regid,
                    'pingdate' => $this->pingdate
        ));
    }

    public function update_user_ping() {
        $this->db->where('phone', $this->phone);
        return $this->db->update('jump_users', array(
                    'pingdate' => date('Y-m-d')
        ));
    }
 
    public function delete_user($phone) {
        $query = $this->db->delete('jump_users ', array('phone' => $phone));
    }

    public function get_user($phone) {
        $query = $this->db->get_where('jump_users ', array('phone' => $phone));
        if (!$query)
            return FALSE;
        if ($query->num_rows() === 1) {
            $this->assign($query->row());
            return TRUE;
        }
        return FALSE;
    }

    public function get_inactive_users($days) {
        $today = date('Y-m-d');
        $time = strtotime($today . '-' . $days.' day'); 
        $limit =  date('Y-m-d', $time);
        return $this->db->get_where('jump_users ', array('pingdate <' => $limit))->result();
        
    }
}
