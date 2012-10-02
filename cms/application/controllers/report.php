<?php

class Report extends Controller {

    function Report() {
        parent::Controller();
        if (!$this->session->userdata('active')) redirect('/'); // check Login
//        $this->table = 'publication';
        $this->title = 'รายงาน';
    }

    function index() {
        $data['title'] = $this->title;
        $data['content'] = 'report/index';
        $data['imgTitle'] = 'application_cascade.png'; // img status level 2
        $data['txtTitle'] = $this->title; // text title status level 2
//        $data['table'] = $this->table;

        /** Pagination */
//        $config['base_url'] = base_url() . '/' . $this->router->class . '/' . $this->router->method;
//        $config['total_rows'] = $this->db->get($this->table)->num_rows();
//        $config['per_page'] = 16;
//        $config['num_links'] = 5;
//        $config['uri_segment'] = 3;
//        $config['full_tag_open'] = '<div id="pagination">';
//        $config['full_tag_close'] = '</div>';
//
//        $this->pagination->initialize($config);
//        $this->db->order_by("pub_name", "asc");
//        $query = $this->db->get($this->table, $config['per_page'], $this->uri->segment(3));
//
//        $data['num_rows'] = $config['total_rows'];
//        $data['result'] = $query->result();

        $this->load->view('layouts/layout', $data);
    }

}