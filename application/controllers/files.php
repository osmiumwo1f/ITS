<?php
class Files extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('files_model');
	}

    public function view_files($e_id)
    {
        $data['files'] = $this->files_model->get_files($e_id);
    	$data['title'] = 'ไฟล์สำหรับใช้ประกอบการอบรม';

        $this->load->view('templates/header', $data);
    	$this->load->view('events/view_files', $data);
    	$this->load->view('templates/footer');
    }

	public function upload_file($e_id)
	{
		if($this->session->userdata('id')){
		    $this->load->helper(array('form'));
	        $this->load->library('form_validation');

			$config['upload_path'] = './uploads/';
	        $config['allowed_types'] = '*';
			$config['max_size'] = 1024 * 16;
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
	            $this->files_model->set_files($this->upload->data(), $e_id);
	            $url = base_url().'events/'.$this->input->post('e_id');
	            redirect($url, 'refresh');
			}
		}
		else{
            redirect('users/login', 'refresh');
        }
	}

	public function delete_file($efn){
		if($this->session->userdata('id')){

		}
		else{
            redirect('users/login', 'refresh');
        }
	}
}