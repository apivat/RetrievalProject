<?php
class Login_model extends Model {

    function Login_model() {
        parent::Model();
    }

    function checkLogin() {
        $this->db->where('admin_username', trim($this->input->post('username')));
        $this->db->where('admin_password', trim($this->input->post('password')));
        $query	= $this->db->get('admin');
        $item	= $query->row();	

        if($query->num_rows() >0) {
                $data_login = array(
                        'active'	=> true,
                        'id'		=> $item->admin_id,
                        'fullname'	=> $item->admin_name,
                );
                $this->session->set_userdata($data_login);
                return true;
        } else {
                return false;				
        }

    }

}

?>