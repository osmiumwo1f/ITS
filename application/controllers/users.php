<?php
class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}

    public function index()
	{
        $data['burl'] = base_url();
		$data['usr'] = $this->users_model->get_usr();
    	$data['title'] = 'รายชื่อผู้ใช้งาน';
        $data['script'] ='';

    	$this->load->view('templates/header', $data);
    	$this->load->view('users/index', $data);
    	$this->load->view('templates/footer');
	}

    public function create()
    {
        $data['burl'] = base_url();
    	$this->load->helper('form');
    	$this->load->library('form_validation');

    	$data['title'] = 'เพิ่มผู้ใช้งาน';
        $data['users'] = $this->users_model->get_usr('0');
        $data['script'] = '<script src="../../../assets/users.js" type="text/javascript"></script>';
        $data['state'] = 'create';

    	$this->form_validation->set_rules('usr', 'ชื่อผู้ใช้งาน', 'trim|required|alpha_dash|min_length[6]|max_length[32]|xss_clean|is_unique[users.usr]');
        $this->form_validation->set_rules('pwd', 'รหัสผ่าน', 'trim|required|alpha_dash|md5');
        $this->form_validation->set_rules('cpwd', 'ยืนยันรหัสผ่าน', 'trim|required');
        $this->form_validation->set_rules('f_name', 'ชื่อ', 'required');
        $this->form_validation->set_rules('l_name', 'สกุล', 'required');
        $this->form_validation->set_rules('rank', 'ตำแหน่ง', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone', 'เบอร์โทรศัพท์', 'trim|required|numeric');

    	if ($this->form_validation->run() === FALSE)
    	{
    		$this->load->view('templates/header', $data);
    		$this->load->view('users/create_edit_form');
    		$this->load->view('templates/footer');
    	}
    	else
    	{
    	    
    		$this->users_model->set_usr();
    		$this->load->view('templates/header', $data);
    		$this->load->view('users/success');
    		$this->load->view('templates/footer');
    	}
    }

    public function edit($uid)
    {
        $data['burl'] = base_url();
        $this->load->helper('form');
    	$this->load->library('form_validation');

        $data['users'] = $this->users_model->get_usr($uid);
        $data['title'] = 'แก้ไขผู้ใช้งาน '.$data['users']['usr'];
        $data['script'] = '<script src="../../../assets/users.js" type="text/javascript"></script>';
        $data['state'] = 'edit';

    	$this->form_validation->set_rules('usr', 'ชื่อผู้ใช้งาน', 'trim|required|alpha_dash|min_length[5]|max_length[32]|xss_clean');
        $this->form_validation->set_rules('pwd', 'รหัสผ่าน', 'trim|required|alpha_dash|md5');
        $this->form_validation->set_rules('cpwd', 'ยืนยันรหัสผ่าน', 'trim|required');
        $this->form_validation->set_rules('f_name', 'ชื่อ', 'required');
        $this->form_validation->set_rules('l_name', 'สกุล', 'required');
        $this->form_validation->set_rules('rank', 'ตำแหน่ง', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'เบอร์โทรศัพท์', 'trim|required|numeric');

    	if ($this->form_validation->run() === FALSE)
    	{
    		$this->load->view('templates/header', $data);
    		$this->load->view('users/create_edit_form');
    		$this->load->view('templates/footer');
    	}
    	else
    	{
    	    
    		$this->users_model->edit_usr($uid);
    		$this->load->view('templates/header', $data);
    		$this->load->view('users/success');
    		$this->load->view('templates/footer');
    	}
    }

    public function delete($uid)
    {
        $data['burl'] = base_url();
        $this->users_model->delete_usr($uid);
        $this->load->view('templates/header', $data);
    	$this->load->view('users/success');
    	$this->load->view('templates/footer');
    }
}
?>