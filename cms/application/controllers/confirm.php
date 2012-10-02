<?php

class Confirm extends Controller {

    function Confirm()
    {
        parent::Controller();
    }
    
    function delete($id=null, $table=null)
    {
        if($id!='' && $table!=''):
           $this->delete_model->deleteData($id, $table);
        endif;
    }

}