<?php
class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}

    public function index()
	{
        if($this->session->userdata('id')){
    		$data['usr'] = $this->users_model->get_usr();
        	$data['title'] = 'รายชื่อผู้ใช้งาน';

        	$this->load->view('templates/header', $data);
        	$this->load->view('users/index', $data);
        	$this->load->view('templates/footer');
        }
        else{
            redirect('users/login', 'refresh');
        }
	}

    public function create()
    {
        if($this->session->userdata('id')){
        	$this->load->helper('form');
        	$this->load->library('form_validation');

        	$data['title'] = 'เพิ่มผู้ใช้งาน';
            $data['users'] = $this->users_model->get_usr('0');
            $data['script'] = '<script src="'.base_url().'assets/users.js" type="text/javascript"></script>';
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
        else{
            redirect('users/login', 'refresh');
        }
    }

    public function edit($uid)
    {
        if($this->session->userdata('id')){
            $this->load->helper('form');
        	$this->load->library('form_validation');

            $data['users'] = $this->users_model->get_usr($uid);
            $data['title'] = 'แก้ไขผู้ใช้งาน '.$data['users']['usr'];
            $data['script'] = '<script src="'.base_url().'assets/users.js" type="text/javascript"></script>';
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
        else{
            redirect('users/login', 'refresh');
        }
    }

    public function delete($uid)
    {
        if($this->session->userdata('id')){
            $this->users_model->delete_usr($uid);
            $this->load->view('templates/header', $data);
        	$this->load->view('users/success');
        	$this->load->view('templates/footer');
        }
        else{
            redirect('users/login', 'refresh');
        }
    }

    public function login(){
        if(!$this->session->userdata('id')){
            $data['title'] = 'ลงชื่อเข้าใช้งาน';
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('usr', 'ชื่อผู้ใช้งาน', 'trim|required|alpha_dash|xss_clean');
            $this->form_validation->set_rules('pwd', 'รหัสผ่าน', 'trim|required|alpha_dash|md5');

            if ($this->form_validation->run() === FALSE){
                $this->load->view('templates/header', $data);
                $this->load->view('users/login');
                $this->load->view('templates/footer');
            }
            else{
                $usr = $this->input->post('usr');
                $pwd = $this->input->post('pwd');
                $result = $this->users_model->login($usr, $pwd);
                if($result == false){
                    $this->load->view('templates/header', $data);
                    $this->load->view('users/login');
                    $this->load->view('templates/footer');
                }
                else{
                    $this->session->set_userdata($result);
                    redirect('users', 'refresh');
                }
            }
        }
        else{
            $data['result'] = $this->session->all_userdata();
            $this->load->view('users/test_cookie', $data);
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('events', 'refresh');
    }

    public function cookie(){
        $data['result'] = $this->session->all_userdata();
        $this->load->view('users/test_cookie', $data);
    }
}
?>