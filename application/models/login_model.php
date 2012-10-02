<?php

class Login_model extends Model {

    function Login_model() {
        parent::Model();
    }

    function checkLogin($username,$password) {
        $this->db->where('user_username', $username);
        $this->db->where('user_password', $password);
        $this->db->where('user_status', "1");
        $query = $this->db->get('users');
        $item = $query->row();
        if ($query->num_rows() > 0) {
            $data_member = array(
                'LoginActive' => TRUE,
                'Name' => $item->user_name,
                'Username' => $item->user_username,
                'Email' => $item->user_email,
                'IsDownload' => $item->isdownload
            );

            $this->session->set_userdata($data_member);
            return true;
        } else {
            return false;
        }
    }

}

?>
