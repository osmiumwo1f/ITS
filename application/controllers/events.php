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

    public function upload_file()
    {
        $status = "";
        $msg = "";
        $file_element_name = 'file';
         
        if (empty($_POST['title']))
        {
            $status = "error";
            $msg = "Please enter a title";
        }
         
        if ($status != "error")
        {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;
     
            $this->load->library('upload', $config);
     
            if (!$this->upload->do_upload($file_element_name))
            {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
            else
            {
                $data = $this->upload->data();
                $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
                if($file_id)
                {
                    $status = "success";
                    $msg = "File successfully uploaded";
                }
                else
                {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));

        /*$this->load->helper(array('form'));
        $this->load->library('form_validation');

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $data['title'] = 'เพิ่มไฟล์';

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('events/upload_file', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $this->events_model->set_files($this->upload->data('file_name'));
            $this->load->view('events/upload_file');
        }*/
    }
}
?>