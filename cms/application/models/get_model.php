<?php

class Get_model extends Model {

    function Get_model() {
        parent::Model();
    }

    function getProvinceList() {
        $this->db->order_by('province_name', 'asc');
        $query = $this->db->get('province');

        return $query->result();
    }

    function getTypeTourismList() {
        $this->db->order_by('type_name', 'asc');
        $query = $this->db->get('type_of_tourism');

        return $query->result();
    }

    function getTouristAttractionList($provice_id=null) {
        $this->db->join('province as b','a.province_id = b.province_id','left');
        if($provice_id):
        $this->db->where('a.province_id !=', $provice_id);    
        endif;
        $this->db->order_by('b.province_name', 'asc');
        $query = $this->db->get('tourist_attraction as a');

        return $query->result();
    }
    
   function getChart1() {
       
        $this->db->select('pub_year, count( * ) AS count_pub');
        $this->db->from('publication');
        $this->db->group_by('pub_year');
        
        $dataResult = $this->db->get();
        return $dataResult;
    }
    
    function getChart2() {
        
        $this->db->select("a.lab_shname as lab_shname, count( b.pub_id ) as count_pub");
        $this->db->from("lab a");
        $this->db->join("publication b","a.lab_id = b.lab_id","left");
        $this->db->group_by("b.lab_id");
                        
        $dataResult = $this->db->get();
        return $dataResult;
    }

}

?>