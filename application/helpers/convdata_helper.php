<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended date helper */
function res_data($pubId=null)
{
    $CI =& get_instance();
    $CI->load->database();
    $res = $CI->db->where('a.pub_id',$pubId)->join('researcher as b','a.res_id = b.res_id')->get('researcher_publication as a')->result();
    return $res;
}

function journal_data($journalId=null)
{
    $CI =& get_instance();
    $CI->load->database();
    $journal = $CI->db->where('a.journal_id',$journalId)->get('journal as a')->row();
    return $journal->journal_title;
}

function pub_ref_data($pubId=null)
{
    $CI =& get_instance();
    $CI->load->database();
    $refpub = $CI->db->where('a.pub_id',$pubId)->join('publication as b','a.pub_ref_id = b.pub_id')->get('reference_publication as a')->result();
    return $refpub;
}

function ref_data($pubId=null)
{
    $CI =& get_instance();
    $CI->load->database();
    $refpub = $CI->db->where('a.pub_id',$pubId)->join('publication as b','a.pub_id = b.pub_id')->get('reference_publication as a')->result();
    return $refpub;
}
/* End of file DA_date_helper.php */
/* Location: ./system/helpers/DA_date_helper.php */