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
	public function ajax($type, $list, $id) {
		if ($type == 'satis_topics') {
		    $query = $this->db->where('group_id', $id);
        }
		$query = $this->db->select('*')->from($type);
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>