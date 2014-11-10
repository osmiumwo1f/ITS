<?php
class Satis_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function create_satis_form() {
		$data = array(
            'event_id' => $this->input->post('event_id'),
            'name' => $this->input->post('name'),
            'descriptions' => $this->input->post('descriptions'),
            'obj' => $this->input->post('obj')
        );
		return $this->db->insert('satis_form', $data);
	}
	public function ajax($p, $type, $group = null, $list = null) {
		if($p == 'unused'){
			if($type == 'satis_topics'){
				$query = $this->db->where('group_id', $group);
			}
			if(sizeof($list) > 0){
				$query = $this->db->where_not_in('id', $list);
			}
		}	
        else{
        	if(sizeof($list) > 0){
				$query = $this->db->where_in('id', $list);
			}
        }
        	
		/*if ($type == 'satis_topics') {
		    $query = $this->db->where('group_id', $group);
        }
        if($list !== null && sizeof($list) > 0){
        	if($p == 'unused')
        		$query = $this->db->where_not_in('id', $list);
        	else
        		$query = $this->db->where_in('id', $list);
        }*/
		$query = $this->db->select('*')->from($type);
		$query = $this->db->get();
		//return $list;
		//return $this->db->last_query();
		return $query->result_array();
	}
}
?>