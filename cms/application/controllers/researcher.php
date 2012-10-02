<?php

class Researcher extends Controller {

    function Researcher() {
        parent::Controller();
        if (!$this->session->userdata('active')) redirect('/'); // check Login
        $this->table = 'researcher';
        $this->title = 'ข้อมูลนักวิจัย';
    }

    function index() {       
        $data['title'] = $this->title;
        $data['content'] = 'researcher/index';
        $data['imgTitle'] = 'group.png'; // img status level 2
        $data['txtTitle'] = $this->title; // text title status level 2
        $data['table'] = $this->table;

        /** Pagination */
        $config['base_url'] = base_url() . '/' . $this->router->class . '/' . $this->router->method;
        if($_POST){
            $config['total_rows'] = $this->db->select('a.res_id,a.res_name,a.update_at,a.create_at,a.is_internal')->like('a.res_name', $this->input->post('data'))->get('researcher as a')->num_rows();  
        }else{
            $config['total_rows'] = $this->db->select('a.res_id,a.res_name,a.update_at,a.create_at,a.is_internal')->get('researcher as a')->num_rows();   
        }
        $config['per_page'] = 16;
        $config['num_links'] = 5;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);
        $this->db->order_by("a.update_at", "desc");
        if($_POST){
            $query = $this->db->select('a.res_id,a.res_name,a.update_at,a.create_at,a.is_internal')->like('a.res_name', $this->input->post('data'))->get('researcher as a', $config['per_page'], $this->uri->segment(3)); 
        }else{
            $query = $this->db->select('a.res_id,a.res_name,a.update_at,a.create_at,a.is_internal')->get('researcher as a', $config['per_page'], $this->uri->segment(3));
        }
       
        $data['num_rows'] = $config['total_rows'];
        $data['result'] = $query->result();

        $this->load->view('layouts/layout', $data);
    }
    
    function addnew() {
        if ($_POST) {
            if (trim($this->input->post('res_name')) != '') {
                $this->insert_model->insertResearcher();
                redirect($this->router->class);
            } else {
                $data['error'] = 'ไม่สามารถเพิ่มข้อมูลได้';
            }
        }
        $data['result_lab'] = $this->db->order_by('lab_shname','asc')->get('lab')->result();
        $data['txtTitle'] = 'เพิ่ม : ' . $this->title;
        $data['title'] = 'เพิ่ม' . $this->title;
        $data['imgTitle'] = 'add.png';
        $data['content'] = 'researcher/addnew';
        $this->load->view('layouts/layout', $data);
    }

    function edit($id) {
        if ($_POST) {
            if (trim($this->input->post('res_name')) != '') {
                $this->update_model->updateResearcher($id);
                $data['complete'] = 'แก้ไขข้อมูลสำเร็จ';
            } else {
                $data['error'] = 'แก้ไขข้อมูลไม่สเร็จ';
            }
        }

        /** Get Data for Edit */
        $query = $this->db->get_where($this->table, array('res_id' => $id));
        $data['result'] = $query->row();
        $data['result_lab'] = $this->db->order_by('lab_shname','asc')->get('lab')->result();
        $data['txtTitle'] = 'แก้ไข : ' . $this->title . ' ' . $data['result']->res_name; 
        $data['title'] = $this->title;
        $data['imgTitle'] = 'page_edit.png';
        $data['content'] = 'researcher/edit';
        $data['table'] = $this->table;

        $this->load->view('layouts/layout', $data);
    }
}