<?php

class Update_model extends Model {

    function Update_model() {
        parent::Model();
    }

    function updateResearcher($id) {
        $data_post = array(
            'res_name' => $this->input->post('res_name'),
            'res_tel' => $this->input->post('res_tel'),
            'res_email' => $this->input->post('res_email'),
            'admin_id' => $this->session->userdata('id'),
            'is_internal' => $this->input->post('is_internal'),
            'update_at' => date('Y-m-d H:i:s'),
        );
        $this->db->where('res_id', $id);
        $this->db->update('researcher', $data_post);
    }
    
    function updateJournal($id) {
        $data_post = array(
            'journal_title' => $this->input->post('journal_title'),
            'update_at' => date('Y-m-d H:i:s'),
        );
        $this->db->where('journal_id', $id);
        $this->db->update('journal', $data_post);
    }

    private function indexCreate($word,$queryCate,$pub_id) {
        $vowels = array(",", ".","&nbsp;","?","!");
        $pub_index_word = str_replace($vowels, "",strtolower(strip_tags($word)));
        $indexs = explode(" ", $pub_index_word);
        foreach ($indexs as $index) :
            // ถ้ามี Index
            if($index!=""):
                $num_word = $this->db->get_where('stop_word', array('word' => $index))->num_rows();
                // ถ้า Index ไม่ใช่ Stop Word
                if ($num_word==0):
                    $row_keyword = $this->db->get_where('keyword', array('key_name' => $index))->row();
                     // ถ้ายังไม่เคยมี keyword อยู่เลย
                    if(empty($row_keyword)):
                        // Insert Keyword
                        $data_keyword = array(
                            'key_name' => $index
                        );     
                        $this->db->insert('keyword', $data_keyword);
                        $key_id = $this->db->insert_id();
                        // Insert Link Keyword IF All
                        if($queryCate=="all"):
                            $data_keypub = array(
                                'key_id' => $key_id,
                                'pub_id' => $pub_id,
                                'key_doc' => 1
                            );   
                            $this->db->insert('keyword_publication', $data_keypub);
                        // Insert Link Keyword IF Title    
                        elseif($queryCate=="title"):
                            $data_keypub = array(
                                'key_id' => $key_id,
                                'pub_id' => $pub_id,
                                'key_doc' => 1
                            );   
                            $this->db->insert('keyword_title', $data_keypub);
                        // Insert Link Keyword IF Journal  
                        elseif($queryCate=="journal"):
                            $data_keypub = array(
                                'key_id' => $key_id,
                                'pub_id' => $pub_id,
                                'key_doc' => 1
                            );   
                            $this->db->insert('keyword_journal', $data_keypub);
                        // Insert Link Keyword IF Researcher     
                        elseif($queryCate=="researcher"):    
                            $data_keypub = array(
                                'key_id' => $key_id,
                                'pub_id' => $pub_id,
                                'key_doc' => 1
                            );   
                            $this->db->insert('keyword_researcher', $data_keypub);
                        endif;
                    // ถ้ามี keyword อยู่  
                    else:
                        // Insert Link Keyword IF All
                        if($queryCate=="all"):
                            $keywordpub = $this->db->get_where('keyword_publication', array('pub_id' => $pub_id,'key_id'=>$row_keyword->key_id));
                            // ถ้ายังไม่เคยมี keyword ใน keyword_publication อยู่
                            if($keywordpub->num_rows()==0):
                                $data_keypub = array(
                                    'key_id' => $row_keyword->key_id,
                                    'pub_id' => $pub_id,
                                    'key_doc' => 1
                                );   
                                $this->db->insert('keyword_publication', $data_keypub);  
                            // ถ้าเคยมี keyword ใน keyword_publication อยู่แล้ว
                            else:
                                $row_keywordpub = $keywordpub->row();
                                $data_keypubdoc = array(
                                    'key_doc' => ($row_keywordpub->key_doc+1)
                                );   
                                $this->db->where('keypub_id', $row_keywordpub->keypub_id);        
                                $this->db->update('keyword_publication', $data_keypubdoc);
                            endif;
                        // Insert Link Keyword IF Title
                        elseif($queryCate=="title"):
                            $keywordtitle = $this->db->get_where('keyword_title', array('pub_id' => $pub_id,'key_id'=>$row_keyword->key_id));
                            // ถ้ายังไม่เคยมี keyword ใน keyword_title อยู่
                            if($keywordtitle->num_rows()==0):
                                $data_keytitle = array(
                                    'key_id' => $row_keyword->key_id,
                                    'pub_id' => $pub_id,
                                    'key_doc' => 1
                                );   
                                $this->db->insert('keyword_title', $data_keytitle);  
                            // ถ้าเคยมี keyword ใน keyword_title อยู่แล้ว
                            else:
                                $row_keywordtitle = $keywordtitle->row();
                                $data_keywordtitle = array(
                                    'key_doc' => ($row_keywordtitle->key_doc+1)
                                );   
                                $this->db->where('keypub_id', $row_keywordtitle->keypub_id);        
                                $this->db->update('keyword_title', $data_keywordtitle);
                            endif;
                        // Insert Link Keyword IF Journal
                        elseif($queryCate=="journal"):
                            $keywordjournal = $this->db->get_where('keyword_journal', array('pub_id' => $pub_id,'key_id'=>$row_keyword->key_id));
                            // ถ้ายังไม่เคยมี keyword ใน keyword_journal อยู่
                            if($keywordjournal->num_rows()==0):
                                $data_keyjournal = array(
                                    'key_id' => $row_keyword->key_id,
                                    'pub_id' => $pub_id,
                                    'key_doc' => 1
                                );   
                                $this->db->insert('keyword_journal', $data_keyjournal);  
                            // ถ้าเคยมี keyword ใน keyword_journal อยู่แล้ว
                            else:
                                $row_keywordjournal = $keywordjournal->row();
                                $data_keywordjournal = array(
                                    'key_doc' => ($row_keywordjournal->key_doc+1)
                                );   
                                $this->db->where('keypub_id', $row_keywordjournal->keypub_id);        
                                $this->db->update('keyword_journal', $data_keywordjournal);
                            endif;
                         // Insert Link Keyword IF Researcher   
                         elseif($queryCate=="researcher"):   
                             $keywordresearcher = $this->db->get_where('keyword_researcher', array('pub_id' => $pub_id,'key_id'=>$row_keyword->key_id));
                            // ถ้ายังไม่เคยมี keyword ใน keyword_researcher อยู่
                            if($keywordresearcher->num_rows()==0):
                                $data_keyresearcher = array(
                                    'key_id' => $row_keyword->key_id,
                                    'pub_id' => $pub_id,
                                    'key_doc' => 1
                                );   
                                $this->db->insert('keyword_researcher', $data_keyresearcher);  
                            // ถ้าเคยมี keyword ใน keyword_researcher อยู่แล้ว
                            else:
                                $row_keywordresearcher = $keywordresearcher->row();
                                $data_keywordresearcher = array(
                                    'key_doc' => ($row_keywordresearcher->key_doc+1)
                                );   
                                $this->db->where('keypub_id', $row_keywordresearcher->keypub_id);        
                                $this->db->update('keyword_researcher', $data_keywordresearcher);
                            endif;
                         endif;                   
                    endif;                    
                endif;                
            endif;
        endforeach;
        
        return TRUE;
    }
    
    function updatePublication($pub_id) {
        $this->db->where('pub_id', $pub_id);        
        $this->db->delete(array('researcher_publication','keyword_publication','reference_publication')); 
        
        $data_post = array(
            'pub_year' => $this->input->post('pub_year'),
            'pub_name' => $this->input->post('pub_title'),
            'pub_abstract' => $this->input->post('pub_abstract'),
            'pub_paper' => $this->input->post('pub_paper'),
            'pub_title' => $this->input->post('pub_title'),
            'lab_id' => $this->input->post('lab_id'),
            'admin_id' => $this->session->userdata('id'),
            'update_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('pub_id', $pub_id);        
        $this->db->update('publication', $data_post);
        
        $res_name = "";
        
        foreach($this->input->post('res_id') as $res_id):
              $data_res = array(
                  'pub_id' => $pub_id,
                  'res_id' => $res_id,
              );   
              $this->db->insert('researcher_publication', $data_res);
              
              $res = $this->db->get_where('researcher', array('res_id' => $res_id))->row();
              $res_name = $res_name." ".$res->res_name;
        endforeach;
        
        if($this->input->post('pub_ref_id')){
            foreach($this->input->post('pub_ref_id') as $pub_ref_id):
                $data_ref_pub = array(
                    'pub_id' => $pub_id,
                    'pub_ref_id' => $pub_ref_id,
                );   
                $this->db->insert('reference_publication', $data_ref_pub);
            endforeach;   
        }
        
        $journal_title = $this->db->get_where('journal', array('journal_id' => $this->input->post('journal_id')))->row();
        
        // Index Title
        $this->indexCreate($this->input->post('pub_title'),"title",$pub_id);
        // Index Journal
        $this->indexCreate($journal_title->journal_title,"journal",$pub_id);
        // Index Researcher
        $this->indexCreate($res_name,"researcher",$pub_id);
        // Index All
        $this->indexCreate($res_name." ".$journal_title->journal_title." ".$this->input->post('pub_title')." ".$this->input->post('pub_abstract'),"all",$pub_id);

    }
    
    function updateStatus($id, $value) {
        $data_post = array(
            'user_status' => $value,
            'update_at' => date('Y-m-d H:i:s'),
        );
        $this->db->where('user_id', $id);
        $this->db->update('users', $data_post);
    }
    
    function updateDownload($id, $value) {
        $data_post = array(
            'isdownload' => $value,
            'update_at' => date('Y-m-d H:i:s'),
        );
        $this->db->where('user_id', $id);
        $this->db->update('users', $data_post);
    }
    
}

?>