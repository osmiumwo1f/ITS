<?php
class Satis_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

    public function get_satis_form($eid = false)
    {
        if ($eid === false)
        {
            return 0;
        }
        else
        {

        }
    }

    public function get_si()
    {
        $query = $this->db->select('*')->from('satis_group');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_satis_elements($stid = false)
    {
        if($stid === false)
        {

        }
        else
        {
            $query = $this->db->get_where('satis_topics', array('group_id' => $stid));
            return $query->result_array();
        }
    }

    public function create_satis_form()
    {
        $data = array(
            'event_id' => $this->input->post('event_id'),
            'name' => $this->input->post('name'),
            'descriptions' => $this->input->post('descriptions'),
            'obj' => $this->input->post('obj')
        );

        return $this->db->insert('satis_form', $data);
    }
}
?>