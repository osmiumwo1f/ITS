<?php
class Files_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

    public function get_files($e_id)
    {
        if (isset($e_id))
        {
            $query = $this->db->get_where('files', array('event_id' => $e_id, 'delete_mark' => 0));
        	return $query->row_array();
        }
    }

    public function set_files($fn, $e_id)
    {
        $upload = array(
            'event_id' => $this->input->post('e_id'),
            'descriptions' => $this->input->post('des'),
            'name' => $fn['orig_name'],
            'path' => $fn['file_name'],
        );
        return $this->db->insert('files', $upload);
    }
}