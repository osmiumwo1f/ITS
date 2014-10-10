<?php
class Users_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

    public function get_usr($uid = FALSE)
    {
        if ($uid === FALSE)
    	{
    		$query = $this->db->select('*')->from('users')->where('id !=', '0')->where('delete_mark', '0');
            $query = $this->db->get();
    		return $query->result_array();
    	}
        else
        {
            $query = $this->db->get_where('users', array('id' => $uid));
            return $query->row_array();
        }
    }

    public function set_usr()
    {
        $data = array
        (
    	    'usr' => $this->input->post('usr'),
            'pwd' => $this->input->post('pwd'),
            'f_name' => $this->input->post('f_name'),
            'l_name' => $this->input->post('l_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'rank' => $this->input->post('rank'),
            'create' => $this->input->post('create'),
            'edit' => $this->input->post('edit'),
            'delete' => $this->input->post('delete'),
            'usr_create' => $this->input->post('usr_create'),
            'usr_edit' => $this->input->post('usr_edit'),
            'usr_delete' => $this->input->post('usr_delete'),
    	);

    	return $this->db->insert('users', $data);
    }

    public function edit_usr($uid)
    {
        $data = array
        (
    	    'usr' => $this->input->post('usr'),
            'pwd' => $this->input->post('pwd'),
            'f_name' => $this->input->post('f_name'),
            'l_name' => $this->input->post('l_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'rank' => $this->input->post('rank'),
            'create' => $this->input->post('create'),
            'edit' => $this->input->post('edit'),
            'delete' => $this->input->post('delete'),
            'usr_create' => $this->input->post('usr_create'),
            'usr_edit' => $this->input->post('usr_edit'),
            'usr_delete' => $this->input->post('usr_delete'),
    	);
        $this->db->where('id', $uid);
        return $this->db->update('users', $data);
    }

    public function delete_usr($uid)
    {
        $data = array
        (
            'delete_mark' => '1',
        );
        $this->db->where('id', $uid);
        return $this->db->update('users', $data);
    }
}
?>