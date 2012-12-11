<?php

class Home extends Controller {

    function Home() {
        parent::Controller();
        if (!$this->session->userdata('active'))
            redirect('/'); // check Login
    }

    function index() {
        $data['title'] = 'หน้าแรก';
        $data['content'] = 'home/index';
        $data['imgTitle'] = 'application_cascade.png'; // img status level 2
        $data['txtTitle'] = 'Home'; // text title status level 2

        $this->load->view('layouts/layout', $data);
    }
    
    function Chart1JSON()
    {
        $getData = $this->get_model->getChart1()->result();
        echo json_encode($getData);
    }
   
    
    function Chart2JSON()
    {
        $getData = $this->get_model->getChart2()->result();
        echo json_encode($getData);
    }
    

}