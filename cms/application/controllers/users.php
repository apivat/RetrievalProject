<?php

class Users extends Controller {

    function Users() {
        parent::Controller();
        if (!$this->session->userdata('active')) redirect('/'); // check Login
        $this->table = 'users';
        $this->title = 'สิทธิ์ผู้ใช้';
    }

    function index() { 
        $data['title'] = $this->title;
        $data['content'] = 'users/index';
        $data['imgTitle'] = 'eye.png'; // img status level 2
        $data['txtTitle'] = $this->title; // text title status level 2
        $data['table'] = $this->table;

        /** Pagination */
        $config['base_url'] = base_url() . '/' . $this->router->class . '/' . $this->router->method;
        if($_POST){
            $config['total_rows'] = $this->db->like('user_name', $this->input->post('data'))->get($this->table)->num_rows();  
        }else{
            $config['total_rows'] = $this->db->get($this->table)->num_rows();   
        }
        $config['total_rows'] = $this->db->get($this->table)->num_rows();
        $config['per_page'] = 16;
        $config['num_links'] = 5;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);
        $this->db->order_by("user_name", "asc");
        if($_POST){
            $query = $this->db->like('user_name', $this->input->post('data'))->get($this->table, $config['per_page'], $this->uri->segment(3));  
        }else{
            $query = $this->db->get($this->table, $config['per_page'], $this->uri->segment(3));   
        }
       
        $data['num_rows'] = $config['total_rows'];
        $data['result'] = $query->result();

        $this->load->view('layouts/layout', $data);
    }

    function addnew() {
        if ($_POST) {
            if (trim($this->input->post('user_email')) != '') {
                $this->user_id = $this->insert_model->insertUsers();
                $this->row_user = $this->db->get_where('users',array('user_id'=>$this->user_id))->row();
                // Config SendMail PHPMliler // 
                require("library/PHPMailer/class.phpmailer.php");
                $this->mail = new PHPMailer();
                $this->mail->CharSet = "utf-8";
                $this->mail->IsSMTP();
                $this->mail->SMTPDebug = 0;
                $this->mail->SMTPAuth = true;
                $this->mail->Host = "ssl://smtp.gmail.com:465"; // SMTP server
                $this->mail->Username = "robert.kmitnb@$thisgmail.com"; // account SMTP
                $this->mail->Password = "471710016"; // รหัสผ่าน SMTP
                // SendMail // 
                $this->mail->SetFrom("email@yourdomain.com", "yourname");
                $this->mail->AddReplyTo("email@yourdomain.com", "yourname");
                $this->mail->Subject = "ทดสอบ PHPMailer.";
                $this->body = "Username: ".$this->row_user->user_username."<br/>Password: ".$this->row_user->user_password;
                $this->mail->Subject = "ระบบตอบรับ Username&Password";
                $this->mail->MsgHTML($this->body);
                $this->mail->AddAddress($this->row_user->user_email, $this->row_user->user_name); // ผู้รับคนที่หนึ่ง
                $this->mail->Send();
                redirect($this->router->class);
            } else {
                $data['error'] = 'ไม่สามารถเพิ่มข้อมูลได้';
            }
        }
        $data['result_dep'] = $this->db->order_by('dep_name','asc')->get('department')->result();
        $data['txtTitle'] = 'เพิ่ม : ' . $this->title;
        $data['title'] = 'เพิ่ม' . $this->title;
        $data['imgTitle'] = 'add.png';
        $data['content'] = 'users/addnew';
        $this->load->view('layouts/layout', $data);
    }
    
    function status(){
        if ($this->input->post("id") != '' && $this->input->post("value") != ''):
           $this->update_model->updateStatus($this->input->post("id"), $this->input->post("value"));
        endif;
    }
    
    function download() {
        if ($this->input->post("id") != '' && $this->input->post("value") != ''):
            $this->update_model->updateDownload($this->input->post("id"), $this->input->post("value"));
        endif;
    }
    
}
