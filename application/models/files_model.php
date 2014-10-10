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

    public function set_files($fn)
    {
        $data = array(
            'event_id' => 0,
            'descriptions' => $this->input->post('des'),
            'name' => $this->input->post('name'),
            'path' => $fn['file_name'],
        );
        return $this->db->insert('files', $data);
    }
}