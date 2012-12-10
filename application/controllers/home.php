<?php

class Home extends Controller {

    function Home() {
        parent::Controller();
        $this->title = 'HOME';
        $this->mTitle = 'HOME';
        $this->mDesc = 'HOME';
        $this->mKey = 'HOME';
        $this->url_prefix = 'content';
    }

    function SelectionSort(&$arr, $sortby = "asc") {
        $countMem = count($arr);
        $min = 0;

        if ($sortby == "desc") {
            for ($i = 0; $i < $countMem - 1; $i++) {
                $min = $i;
                for ($j = $i + 1; $j < $countMem; $j++) {
                    if ($arr[$j] > $arr[$min])
                        $min = $j;
                }
                $temp = $arr[$i];
                $arr[$i] = $arr[$min];
                $arr[$min] = $temp;
            }
        } else {
            for ($i = 0; $i < $countMem - 1; $i++) {
                $min = $i;
                for ($j = $i + 1; $j < $countMem; $j++) {
                    if ($arr[$j] < $arr[$min])
                        $min = $j;
                }
                $temp = $arr[$i];
                $arr[$i] = $arr[$min];
                $arr[$min] = $temp;
            }
        }
    }

    private function slug($str){
        $str = preg_replace('/[^A-Za-z]/', '-', $str);
        $str = preg_replace('/-+/', " ", $str);
        return $str;
    }
    
    private function get_result_search($text_word,$year_word){
        // run array stop word
        $stop_word = array();
        $result_word = $this->db->select('word')->get('stop_word')->result();
        foreach ($result_word as $words):
            $stop_word[] = $words->word;
        endforeach;
        // end run array stop word

        // ตัดคำในประโยคที่กรอกมาโดยการเว้นวรรคและปรับให้เป็นตัวเล็กกับตัว tag HTML ออก
        $keyword_input_id = array();
        $pub_abstract = $this->slug(strtolower(strip_tags($text_word)));
        $indexs = explode(" ", $pub_abstract);
        foreach ($indexs as $index) : // loop ของคำที่เว้นวรรค
            if (!in_array($index, $stop_word)): // check stop word
                $result_keyword = $this->db->get_where('keyword',array('key_name'=>$index))->row();
                if($result_keyword):
                    $keyword_input_id[] = $result_keyword->key_id;
                endif;
            endif;
        endforeach;
        // จบการตัดคำในประโยคที่กรอกมาโดยการเว้นวรรคและปรับให้เป็นตัวเล็กกับตัว tag HTML ออก

        if($keyword_input_id):
            if($year_word!=null):
                $this->db->where('a.pub_year',$year_word);
            endif;
            // หา keyword ว่าอยู่ใน publicstion ตัวไหนบ้าง
            $publication_id = array();
            foreach ($keyword_input_id as $keyword_id):
                $publication_by_keyword = $this->db->where('b.key_id',$keyword_id)->join('keyword_publication as b','a.pub_id = b.pub_id','left')->get('publication as a');
                foreach ($publication_by_keyword->result() as $publication):
                        $publication_id[] = $publication->pub_id;
                endforeach;
            endforeach;

            if(count($publication_id)!=0):
                // หาค่าความเหมือน
                $sc = array();
                $result_sim = array();
                $num_keyword = count($keyword_input_id);
                $result_publication = $this->db->group_by('a.pub_id')->where_in('b.pub_id',$publication_id)->join('keyword_publication as b','a.pub_id = b.pub_id','left')->get('publication as a')->result();
                foreach ($result_publication as $document):
                    $sc = 0;
                    $publication_by_keyword2 = $this->db->where('b.pub_id',$document->pub_id)->where_in('b.key_id',$keyword_input_id)->join('keyword_publication as b','a.pub_id = b.pub_id','left')->get('publication as a');
                    foreach ($publication_by_keyword2->result() as $document2):
                        $publication_by_keyword = $this->db->where('b.key_id',$document2->key_id)->join('keyword_publication as b','a.pub_id = b.pub_id','left')->get('publication as a');
                        $log10 = number_format(log10($num_keyword/$publication_by_keyword->num_rows()),3);
                        $log_count = number_format($log10*$document2->key_doc,3);
                        $sc = $sc+number_format($log_count*$log10,3);
                    endforeach;       
                    $result_sim[] = array($sc,$document->pub_id);
                endforeach;

                $this->SelectionSort($result_sim,"desc");
                return $result_sim;
            else:    
                return false;
            endif;
        else:
            return false;
        endif;
    }

    private function get_condition_search($text_word,$type_word,$year_word){
        // run array stop word
        $stop_word = array();
        $result_word = $this->db->select('word')->get('stop_word')->result();
        foreach ($result_word as $words):
            $stop_word[] = $words->word;
        endforeach;
        // end run array stop word
        
        // ตัดคำในประโยคที่กรอกมาโดยการเว้นวรรคและปรับให้เป็นตัวเล็กกับตัว tag HTML ออก
        $keyword_input_id = array();
        $pub_abstract = $this->slug(strtolower(strip_tags($text_word)));
        $indexs = explode(" ", $pub_abstract);
        foreach ($indexs as $index) : // loop ของคำที่เว้นวรรค
            if (!in_array($index, $stop_word)): // check stop word
                $result_keyword = $this->db->get_where('keyword',array('key_name'=>$index))->row();
                if($result_keyword):
                    $keyword_input_id[] = $result_keyword->key_id;
                endif;
            endif;
        endforeach;
        // จบการตัดคำในประโยคที่กรอกมาโดยการเว้นวรรคและปรับให้เป็นตัวเล็กกับตัว tag HTML ออก
        if($type_word==1):
            $table = "keyword_title";
        elseif($type_word==2):
            $table = "keyword_researcher";
        elseif($type_word==3):    
            $table = "keyword_journal";
        endif;
 
        if($keyword_input_id):
            if($year_word!=""):
                $this->db->where('a.pub_year',$year_word);
            endif;
            // หา keyword ว่าอยู่ใน publicstion ตัวไหนบ้าง
            $publication_id = array();
            foreach ($keyword_input_id as $keyword_id):
                $publication_by_keyword = $this->db->where('b.key_id',$keyword_id)->join($table.' as b','a.pub_id = b.pub_id','left')->get('publication as a');
                foreach ($publication_by_keyword->result() as $publication):
                        $publication_id[] = $publication->pub_id;
                endforeach;
            endforeach;

            if(count($publication_id)!=0):
                // หาค่าความเหมือน
                $sc = array();
                $result_sim = array();
                $num_keyword = count($keyword_input_id);
                $result_publication = $this->db->group_by('a.pub_id')->where_in('b.pub_id',$publication_id)->join($table.' as b','a.pub_id = b.pub_id','left')->get('publication as a')->result();
                foreach ($result_publication as $document):
                    $sc = 0;
                    $publication_by_keyword2 = $this->db->where('b.pub_id',$document->pub_id)->where_in('b.key_id',$keyword_input_id)->join($table.' as b','a.pub_id = b.pub_id','left')->get('publication as a');
                    foreach ($publication_by_keyword2->result() as $document2):
                        $publication_by_keyword = $this->db->where('b.key_id',$document2->key_id)->join($table.' as b','a.pub_id = b.pub_id','left')->get('publication as a');
                        $log10 = number_format(log10($num_keyword/$publication_by_keyword->num_rows()),3);
                        $log_count = number_format($log10*$document2->key_doc,3);
                        $sc = $sc+number_format($log_count*$log10,3);
                    endforeach;       
                    $result_sim[] = array($sc,$document->pub_id);
                endforeach;

                $this->SelectionSort($result_sim,"desc");
                return $result_sim;                
            else:    
                return false;
            endif;
        else:
            return false;
        endif;

    }
    
    function index() {
        //if ($this->session->userdata('LoginActive')) redirect('/search'); // check Login
        $data['mTitle'] = $this->mTitle;
        $data['mDesc'] = $this->mDesc;
        $data['mKey'] = $this->mKey;
        $data['title'] = $this->title;
        $data['content'] = $this->url_prefix . '/home';

        $this->load->view('layouts/layout', $data);
    }
  
    function register() {
        if ($this->session->userdata('LoginActive')) redirect('/'); // check Login
        if($_POST){
            if (trim($this->input->post('confirm')) != '') {
                $this->user_id = $this->insert_model->insertNewUsers();
                $this->row_user = $this->db->get_where('users',array('user_id'=>$this->user_id))->row();
                // Config SendMail PHPMliler // 
                require("library/PHPMailer/class.phpmailer.php");
                require("library/PHPMailer/class.smtp.php");
                $this->mail = new PHPMailer();
                $this->mail->CharSet = "utf-8";
                $this->mail->IsSMTP();
                $this->mail->SMTPDebug = 0;
                $this->mail->SMTPAuth = true;
                $this->mail->Host = "ssl://smtp.gmail.com:465"; // SMTP server
                $this->mail->Username = "robert.kmitnb@gmail.com"; // account SMTP
                $this->mail->Password = "471710016"; // รหัสผ่าน SMTP
                // SendMail // 
                $this->mail->SetFrom("email@yourdomain.com", "Research CRI");
                $this->mail->AddReplyTo("email@yourdomain.com", "Research CRI");
                $this->mail->Subject = "Welcome News Member of Research System, CRI";
                $this->body = "Dear ".$this->row_user->user_name.",<br/><br/>
                                Username: ".$this->row_user->user_username."<br/>
                                Password: ".$this->row_user->user_password."<br/><br/><br/>
                                Thank you for you kind attention<br/>
                                Your Sincerely<br/>
                                Office of Research, Chulabhorn Research Institute";
                $this->mail->MsgHTML($this->body);
                $this->mail->AddAddress($this->input->post('user_email')); // ผู้รับคนที่หนึ่ง    
                $this->mail->Send(); 
                redirect($this->router->class);
            }
        }
        $data['mTitle'] = $this->mTitle;
        $data['mDesc'] = $this->mDesc;
        $data['mKey'] = $this->mKey;
        $data['title'] = $this->title;
        $data['result_lab'] = $this->db->order_by('lab_shname','asc')->get('lab')->result();
        $data['result_dep'] = $this->db->order_by('dep_name','asc')->get('department')->result();
        $data['content'] = $this->url_prefix . '/register';
        
        $this->load->view('layouts/layout', $data);
    }
    
    function login() {
        header("Content-type: text/html; charset=TIS-620");
        if ($_POST) {
            $this->session->sess_destroy();
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($this->login_model->checkLogin($username,$password)) {
                echo "200";
            } else {
                echo "404";
            }
        }
    }
    
    function logout() {
        
        $this->session->sess_destroy();
	redirect('/');
    }
    
    function resultdata() {
        if (!$this->session->userdata('LoginActive')) redirect('/'); // check Login
        if($_POST){
            if($this->input->post('word')){
                $data['result_ans'] =  $this->get_result_search($this->input->post('word'),null);                   
            }else{
                redirect('/');
            }            
        }else{
            redirect('/');
        }
        
            $data['mTitle'] = $this->mTitle;
            $data['mDesc'] = $this->mDesc;
            $data['mKey'] = $this->mKey;
            $data['title'] = $this->title;
            $data['content'] = $this->url_prefix . '/resultdata';
            $this->load->view('layouts/layout_result', $data);
    }    
    
    function searchcondition(){
        if (!$this->session->userdata('LoginActive')) redirect('/'); // check Login
                
        if($_POST){
            if($this->input->post('word')){
                if(!$this->input->post('type_word')&&!$this->input->post('year_word')){
                    $data['result_ans'] =  $this->get_result_search($this->input->post('word'),null);    
                }else if(!$this->input->post('type_word')&&$this->input->post('year_word')){
                    $data['result_ans'] =  $this->get_result_search($this->input->post('word'),$this->input->post('year_word'));  
                }else{
                    $data['result_ans'] =  $this->get_condition_search($this->input->post('word'),$this->input->post('type_word'),$this->input->post('year_word'));
                }             
            }else{
                redirect('/searchcondition');
            }            
        }
        
        $data['result_year'] = $this->db->order_by('pub_year','asc')->group_by('pub_year')->get('publication')->result();
        $data['mTitle'] = $this->mTitle;
        $data['mDesc'] = $this->mDesc;
        $data['mKey'] = $this->mKey;
        $data['title'] = $this->title;
        $data['content'] = $this->url_prefix . '/searchcondition';
        $this->load->view('layouts/layout_result', $data);
        
    }
    
    function detail($id) {
        if (!$this->session->userdata('LoginActive')) redirect('/'); // check Login        
        $data['mTitle'] = $this->mTitle;
        $data['mDesc'] = $this->mDesc;
        $data['mKey'] = $this->mKey;
        $data['title'] = $this->title;
        $data['content'] = $this->url_prefix . '/detail';
        $data['result_pub'] = $this->db->get_where('publication',array('pub_id'=>$id))->row();
        
        $this->load->view('layouts/layout', $data);
    }    
    
    function download($pub_id) {    
        $url = $this->insert_model->updateDownload($pub_id);
        redirect(base_url()."public/upload/".$url);
    }    
    
}