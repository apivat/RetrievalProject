<?php

class Insert_model extends Model {

    function Insert_model() {
        parent::Model();
    }
    
    function randomstr($length)
    {
        $possible = "abcdefghijklmnopqrstuvwxyz9876543210";
        $str = "";
        while(strlen($str) < $length)
        {
                $str = 	$str. substr($possible,(rand()%strlen($possible)),1);
        }
        
        return $str;
    }
    
    function insertNewUsers() {
        $data_post = array(
            'user_name' => $this->input->post('user_name'),
            'user_tel' => $this->input->post('user_tel'),
            'user_postion' => $this->input->post('user_postion'),
            'user_username' => $this->input->post('user_email'),
            'user_password' => $this->randomstr(8),
            'user_email' => $this->input->post('user_email'),
            'user_status' => "1",
            'isdownload' => "0",
            'dep_id' => $this->input->post('dep_id'),
            'update_at' => date('Y-m-d H:i:s'),
            'create_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('users', $data_post);
        $user_id = $this->db->insert_id();
        
        if($this->input->post('lab_id')):
           foreach($this->input->post('lab_id') as $lab_id):
                $data_lab_user = array(
                    'lab_id' => $lab_id,
                    'user_id' => $user_id,
                );   
                $this->db->insert('interest', $data_lab_user);
            endforeach;   
        endif;
        
        return $user_id;
    }

}

?>