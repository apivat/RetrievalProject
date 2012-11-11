<?php

class Report extends Controller {

    function Report() {
        parent::Controller();
        if (!$this->session->userdata('active')) redirect('/'); // check Login
        $this->title = 'รายงาน';
    }

    function one() {
        $data['title'] = $this->title;
        $data['content'] = 'report/one';
        $data['imgTitle'] = 'application_cascade.png'; // img status level 2
        $data['txtTitle'] = $this->title."ข้อมูลนักวิจัย"; // text title status level 2
        $is_internal = @$this->input->post("is_internal");
        $data['is_internal'] = $is_internal;
        
        if($is_internal==null or $is_internal=="2"){ 
           $config['total_rows'] = $this->db->get("researcher")->num_rows();
        }else{
           $config['total_rows'] = $this->db->get_where("researcher",array("is_internal"=>$is_internal))->num_rows(); 
        }
        
        if($is_internal==null or $is_internal=="2"){
            $this->db->order_by("res_name", "asc");
        }else{
            $this->db->where("is_internal", $is_internal);
            $this->db->order_by("res_name", "asc");
        }
        $query = $this->db->get("researcher");

        $data['num_rows'] = $config['total_rows'];
        $data['result'] = $query->result();

        $this->load->view('layouts/layout', $data);
    }
    
    function oneprint($print=null) {
        $data['title'] = $this->title;
        $data['content'] = 'report/oneprint';
        $data['imgTitle'] = 'application_cascade.png'; // img status level 2
        $data['txtTitle'] = $this->title."ข้อมูลนักวิจัย"; // text title status level 2
        
        if($print==null or $print=="2"){ 
           $config['total_rows'] = $this->db->get("researcher")->num_rows();
        }else if($print=="1" or $print=="0"){
           $config['total_rows'] = $this->db->get_where("researcher",array("is_internal"=>$is_internal))->num_rows(); 
        }else{
            redirect('/');
        }
        
        if($print==null or $print=="2"){
            $this->db->order_by("res_name", "asc");
        }else if($print=="1" or $print=="0"){
            $this->db->where("is_internal", $print);
            $this->db->order_by("res_name", "asc");
        }else{
            redirect('/');
        }
        $query = $this->db->get("researcher");

        $data['num_rows'] = $config['total_rows'];
        $data['result'] = $query->result();
        
        $this->load->view('layouts/print', $data);
    }
    
    function two() {
        $data['title'] = $this->title;
        $data['content'] = 'report/two';
        $data['imgTitle'] = 'application_cascade.png'; // img status level 2
        $data['txtTitle'] = $this->title."ข้อมูลผลงานตีพิมพ์"; // text title status level 2
        $data['result_pub_year'] = $this->db->select('publication.pub_year')->group_by('publication.pub_year')->join('journal','publication.journal_id=journal.journal_id')->get("publication")->result();
        $pub_year = @$this->input->post("pub_year");
        $data['pub_year'] = $pub_year;
        
        if($pub_year==null or $pub_year=="0"){ 
           $config['total_rows'] = $this->db->join('journal','publication.journal_id=journal.journal_id')->get("publication")->num_rows();
        }else{
           $config['total_rows'] = $this->db->join('journal','publication.journal_id=journal.journal_id')->get_where("publication",array("pub_year"=>$pub_year))->num_rows(); 
        }
        
        if($pub_year==null or $pub_year=="0"){
            $this->db->order_by("pub_name", "asc");
        }else{
            $this->db->where("pub_year", $pub_year);
            $this->db->order_by("pub_name", "asc");
        }
        $query = $this->db->join('journal','publication.journal_id=journal.journal_id')->get("publication");

        $data['num_rows'] = $config['total_rows'];
        $data['result'] = $query->result();

        $this->load->view('layouts/layout', $data);
    }

    function twoprint($print=null) {
        $data['title'] = $this->title;
        $data['content'] = 'report/twoprint';
        $data['imgTitle'] = 'application_cascade.png'; // img status level 2
        $data['txtTitle'] = $this->title."ข้อมูลผลงานตีพิมพ์"; // text title status level 2
        
        if($print==null or $print=="0"){ 
          $config['total_rows'] = $this->db->join('journal','publication.journal_id=journal.journal_id')->get("publication")->num_rows();
        }else{
          $config['total_rows'] = $this->db->join('journal','publication.journal_id=journal.journal_id')->get_where("publication",array("pub_year"=>$print))->num_rows(); 
        }
        
        if($print==null or $print=="0"){
            $this->db->order_by("pub_name", "asc");
        }else{
            $this->db->where("pub_year", $print);
            $this->db->order_by("pub_name", "asc");
        }
        
        $query = $this->db->join('journal','publication.journal_id=journal.journal_id')->get("publication");

        $data['num_rows'] = $config['total_rows'];
        $data['result'] = $query->result();
        
        $this->load->view('layouts/print', $data);
    }
}