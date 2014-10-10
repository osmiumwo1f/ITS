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

        $this->db->select('events.*')->select('files.name AS fn, files.descriptions AS fd, files.path')->from('events, files')->where('events.id', $e_id);
        $query = $this->db->get();
    	return $query->result_array();
    }

    public function set_event()
    {
    	$data = array(
    	    'name' => $this->input->post('name'),
            'descriptions' => $this->input->post('des'),
            'requirements' => $this->input->post('req'),
            'fee' => $this->input->post('fee'),
            'date' => $this->input->post('date'),
            'place' => $this->input->post('place'),
            'amount' => $this->input->post('amount'),
            'note' => $this->input->post('note'),

    	);

    	return $this->db->insert('events', $data);
    }
}
?>