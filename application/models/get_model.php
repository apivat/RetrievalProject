<?php

class Get_model extends Model {

    function Get_model() {
        parent::Model();
    }

    function getTravelBy($province_start,$tourist_id,$price,$time,$type_by,$limit=null) {
       
        $this->db->from('travel_by as tb');
        $this->db->join('match_fuzzy as mf','tb.travel_by_id = mf.travel_by_id','left');
        $this->db->where(array('tb.province_strat' => $province_start,'tb.type_travel_by' => $type_by,'tb.tourist_id'=>$tourist_id));
        $this->db->where('(tb.price < '.intval($price).' or tb.price = '.intval($price).')');
        $this->db->where('(tb.amt_time < '.intval($time).' or tb.amt_time = '.intval($time).')');
        $this->db->order_by('mf.COG','desc');
        $this->db->limit($limit);
        
        $dataResult = $this->db->get();
        
        return $dataResult;
    }

}

?>