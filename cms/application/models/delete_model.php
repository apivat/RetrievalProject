<?php
class Delete_model extends Model {

    function Delete_model() {
        parent::Model();
    }
    
    function deleteData($id,$table)
    {
        if($table=="admin")
        {
            $this->db->where('admin_id', $id);
            $this->db->delete($table); 
        }
        if($table=="researcher")
        {
            $this->db->where('res_id', $id);
            $this->db->delete($table); 
        }
        else if($table=="publication")
        {
            $this->db->where('pub_id', $id);
            $this->db->delete(array($table,'researcher_publication','keyword_publication','reference_publication')); 
        }
        else if($table=="journal"){
            $this->db->where('journal_id', $id);
            $this->db->delete($table); 
        }
    }

}

?>