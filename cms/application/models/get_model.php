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

}

?>