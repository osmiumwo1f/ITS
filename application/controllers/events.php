<?php
class Events extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('events_model');
	}

	public function index()
	{
		$data['event'] = $this->events_model->get_event();
    	$data['title'] = 'ประกาศกิจกรรม';
        $data['script'] ='';

    	$this->load->view('templates/header', $data);
    	$this->load->view('events/index', $data);
    	$this->load->view('templates/footer');
	}

	public function view($e_id)
	{
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

	    $data['e_item'] = $this->events_model->get_event($e_id);
        $data['f_item'] = $this->events_model->get_files($e_id);

    	if (empty($data['e_item']))
    	{
    		show_404();
        }

    	$data['title'] = $data['e_item'][0]['name'];

    	$this->load->view('templates/header', $data);
    	$this->load->view('events/view_event', $data);
    	$this->load->view('templates/footer');
	}

    public function create()
    {
    	$this->load->helper('form');
    	$this->load->library('form_validation');

    	$data['title'] = 'เพิ่มหัวข้อการอบรม/กำหนดการ ';

        $data['e_item'] = array(
            'name' => $this->input->post('name'),
            'descriptions' => $this->input->post('des'),
            'requirements' => $this->input->post('req'),
            'fee' => $this->input->post('fee'),
            'date' => $this->input->post('date'),
            'place' => $this->input->post('place'),
            'amount' => $this->input->post('amount'),
            'note' => $this->input->post('note'),

        );

    	$this->form_validation->set_rules('name', 'หัวข้อการอบรม/กำหนดการ', 'required');
        $this->form_validation->set_rules('des', 'des/กำหนดการ', 'required');

    	if ($this->form_validation->run() === FALSE)
    	{
    		$this->load->view('templates/header', $data);
    		$this->load->view('events/create_edit_form');
    		$this->load->view('templates/footer');

    	}
    	else
    	{
    		$this->events_model->set_event();
    		redirect('events', 'refresh');
    	}
    }
}
?>