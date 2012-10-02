<?php

class Journal extends Controller {

    function Journal() {
        parent::Controller();
        if (!$this->session->userdata('active')) redirect('/'); // check Login
        $this->table = 'journal';
        $this->title = 'วารสาร';
    }

    function index() {
        $data['title'] = $this->title;
        $data['content'] = 'journal/index';
        $data['imgTitle'] = 'book.png'; // img status level 2
        $data['txtTitle'] = $this->title; // text title status level 2
        $data['table'] = $this->table;

        /** Pagination */
        $config['base_url'] = base_url() . '/' . $this->router->class . '/' . $this->router->method;
        if($_POST){
            $config['total_rows'] = $this->db->like('journal_title', $this->input->post('data'))->get($this->table)->num_rows();
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
        $this->db->order_by("journal_title", "asc");
        if($_POST){
            $query = $this->db->like('journal_title', $this->input->post('data'))->get($this->table, $config['per_page'], $this->uri->segment(3));
        }else{
            $query = $this->db->get($this->table, $config['per_page'], $this->uri->segment(3));
        }
        $data['num_rows'] = $config['total_rows'];
        $data['result'] = $query->result();

        $this->load->view('layouts/layout', $data);
    }
    
    function addnew(){
        if ($_POST) {
            if (trim($this->input->post('journal_title')) != '') {
                $this->insert_model->insertJournal();
                redirect($this->router->class);
            } else {
                $data['error'] = 'ไม่สามารถเพิ่มข้อมูลได้';
            }
        }
        $data['txtTitle'] = 'เพิ่ม : ' . $this->title;
        $data['title'] = 'เพิ่ม' . $this->title;
        $data['imgTitle'] = 'add.png';
        $data['content'] = 'journal/addnew';
        $this->load->view('layouts/layout', $data);
        
    }
    
    function edit($id) {
        if ($_POST) {
            if (trim($this->input->post('journal_title')) != '') {
                $this->update_model->updateJournal($id);
                $data['complete'] = 'แก้ไขข้อมูลสำเร็จ';
            } else {
                $data['error'] = 'แก้ไขข้อมูลไม่สเร็จ';
            }
        }
        /** Get Data for Edit */
        $query = $this->db->get_where($this->table, array('journal_id' => $id));
        $data['result'] = $query->row();
        $data['txtTitle'] = 'แก้ไข : ' . $this->title . ' ' . $data['result']->journal_title;
        $data['title'] = $this->title;
        $data['imgTitle'] = 'page_edit.png';
        $data['content'] = 'journal/edit';
        $data['table'] = $this->table;

        $this->load->view('layouts/layout', $data);
    }

}