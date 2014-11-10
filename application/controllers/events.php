<?php
class Events extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('events_model');
	}

	public function index()
	{
        $data['burl'] = base_url();
		$data['event'] = $this->events_model->get_event();
    	$data['title'] = 'ประกาศกิจกรรม';
        $data['script'] ='';

    	$this->load->view('templates/header', $data);
    	$this->load->view('events/index', $data);
    	$this->load->view('templates/footer');
	}

	public function view($e_id)
	{
        $data['burl'] = base_url();
	    $data['e_item'] = $this->events_model->get_event($e_id);

    	if (empty($data['e_item']))
    	{
    		show_404();
        }

    	$data['title'] = $data['e_item'][1]['name'];

    	$this->load->view('templates/header', $data);
    	$this->load->view('events/view_event', $data);
    	$this->load->view('templates/footer');
	}

    public function create()
    {
        $data['burl'] = base_url();
    	$this->load->helper('form');
    	$this->load->library('form_validation');

    	$data['title'] = 'เพิ่มหัวข้อการอบรม/กำหนดการ ';

    	$this->form_validation->set_rules('name', 'หัวข้อการอบรม/กำหนดการ', 'required');

    	if ($this->form_validation->run() === FALSE)
    	{
    		$this->load->view('templates/header', $data);
    		$this->load->view('events/create_edit_form');
    		$this->load->view('templates/footer');

    	}
    	else
    	{
    		$this->events_model->set_event();
    		$this->load->view('templates/header', $data);
    		$this->load->view('events/index');
    		$this->load->view('templates/footer');
    	}
    }
}
?>