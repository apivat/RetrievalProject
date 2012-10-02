<?php

class Publication extends Controller {

    function Publication() {
        parent::Controller();
        if (!$this->session->userdata('active')) redirect('/'); // check Login
        $this->table = 'publication';
        $this->title = 'ผลงานตีพิมพ์';
    }

    function index() {
        $data['title'] = $this->title;
        $data['content'] = 'publication/index';
        $data['imgTitle'] = 'book.png'; // img status level 2
        $data['txtTitle'] = $this->title; // text title status level 2
        $data['table'] = $this->table;

        /** Pagination */
        $config['base_url'] = base_url() . '/' . $this->router->class . '/' . $this->router->method;
        if($_POST){
            $config['total_rows'] = $this->db->like('pub_name', $this->input->post('data'))->get($this->table)->num_rows();
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
        $this->db->order_by("pub_name", "asc");
        if($_POST){
            $query = $this->db->like('pub_name', $this->input->post('data'))->get($this->table, $config['per_page'], $this->uri->segment(3));
        }else{
            $query = $this->db->get($this->table, $config['per_page'], $this->uri->segment(3));
        }
        $data['num_rows'] = $config['total_rows'];
        $data['result'] = $query->result();

        $this->load->view('layouts/layout', $data);
    }
    
    function addnew(){
        if ($_POST) {
            if (trim($this->input->post('pub_title')) != '') {
                $this->pub_id = $this->insert_model->insertPublication();
                $this->row_pub = $this->db->get_where('publication',array('pub_id'=>$this->pub_id))->row();
                $this->result_user = $this->db->select('b.user_email')->where('a.lab_id',$this->row_pub->lab_id)->join('users as b','a.user_id = b.user_id','left')->get('interest as a')->result();
                if(!empty($this->result_user)){
                    // Config SendMail PHPMliler // 
                    require("library/PHPMailer/class.phpmailer.php");
                    require("library/PHPMailer/class.smtp.php");
                    $this->mail = new PHPMailer();
                    $this->mail->CharSet = "utf-8";
                    $this->mail->IsSMTP();
                    $this->mail->SMTPDebug = 0;
                    $this->mail->SMTPAuth = true;
                    $this->mail->Host = "ssl://smtp.gmail.com:465"; // SMTP server
                    $this->mail->Username = "robert.kmitnb@gmail.com"; // account SMTP
                    $this->mail->Password = "471710016"; // รหัสผ่าน SMTP
                    // SendMail // 
                    $this->mail->SetFrom("email@yourdomain.com", "Research CRI");
                    $this->mail->AddReplyTo("email@yourdomain.com", "Research CRI");
                    $this->mail->Subject = "News from Office of Research, CRI";
                    $this->body = "Dear All,<br/>
                                   Now, Staffs of office of Research ,Chulabhorn Resesrch Institute have been add new publication from laboratory that you<br/><br/>
                                   If you want to search, you can search publication from <a href='http://localhost/retrieval'>http://localhost/retrieval</a><br/><br/>
                                   <br/>Topic is ".$this->row_pub->pub_title."<br/>
                                   Thank you for you kind attention<br/>
                                   Your Sincerely<br/>
                                   Office of Research, Chulabhorn Research Institute";
                    
                    $this->mail->MsgHTML($this->body);
                    foreach ($this->result_user as $value_email):
                        $this->mail->AddAddress($value_email->user_email); // ผู้รับคนที่หนึ่ง    
                    endforeach;
                    $this->mail->Send();   
                }
                redirect($this->router->class);
            } else {
                $data['error'] = 'ไม่สามารถเพิ่มข้อมูลได้';
            }
        }
        $data['result_journal'] = $this->db->order_by('journal_title','asc')->get('journal')->result();
        $data['result_lab'] = $this->db->order_by('lab_shname','asc')->get('lab')->result();
        $data['result_res'] = $this->db->order_by('res_name','asc')->get('researcher')->result();
        $data['result_pub'] = $this->db->order_by('pub_title','asc')->get('publication')->result();
        $data['txtTitle'] = 'เพิ่ม : ' . $this->title;
        $data['title'] = 'เพิ่ม' . $this->title;
        $data['imgTitle'] = 'add.png';
        $data['content'] = 'publication/addnew';
        $this->load->view('layouts/layout', $data);
        
    }
    
    function edit($id) {
        if ($_POST) {
            if (trim($this->input->post('pub_title')) != '') {
                $this->update_model->updatePublication($id);
                $data['complete'] = 'แก้ไขข้อมูลสำเร็จ';
            } else {
                $data['error'] = 'แก้ไขข้อมูลไม่สเร็จ';
            }
        }
        /** Get Data for Edit */
        $query = $this->db->get_where($this->table, array('pub_id' => $id));
        $data['result'] = $query->row();
        $data['result_journal'] = $this->db->order_by('journal_title','asc')->get('journal')->result();
        $data['result_lab'] = $this->db->order_by('lab_shname','asc')->get('lab')->result();
        $data['result_res'] = $this->db->order_by('res_name','asc')->get('researcher')->result();
        $query_respub = $this->db->select('res_id')->get_where('researcher_publication',array('pub_id'=>$id))->result();
        $respub = array();
        foreach($query_respub as $qrespub):
          $respub[] =  $qrespub->res_id;  
        endforeach;
        $data['result_respub'] = $respub;
        $data['result_pub'] = $this->db->order_by('pub_title','asc')->get('publication')->result();
        $query_refpub = $this->db->select('pub_ref_id')->get_where('reference_publication',array('pub_id'=>$id))->result();
        $refpub = array();
        foreach($query_refpub as $qrefpub):
          $refpub[] =  $qrefpub->pub_ref_id;  
        endforeach;
        $data['result_refpub'] = $refpub;
        $data['txtTitle'] = 'แก้ไข : ' . $this->title . ' ' . $data['result']->pub_name; 
        $data['title'] = $this->title;
        $data['imgTitle'] = 'page_edit.png';
        $data['content'] = 'publication/edit';
        $data['table'] = $this->table;

        $this->load->view('layouts/layout', $data);
    }

}