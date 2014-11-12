<?php
class Events_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

    public function get_event($e_id = FALSE)
    {
    	if ($e_id === FALSE)
    	{
    		$query = $this->db->get_where('events', array('delete_mark' => 0));
    		return $query->result_array();
    	}

        $this->db->select('*')->from('events')->where('events.id', $e_id);
        $query = $this->db->get();
    	return $query->result_array();
    }

    public function set_event()
    {
    	return $this->db->insert('events', $data);
    }

    public function get_files($e_id){
        $this->db->select('*')->from('files')->where('event_id', $e_id);
        $query = $this->db->get();
        return $query->result_array();
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
?>