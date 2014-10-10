<?php
class Satis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('satis_model');
	}

    public function get_form($eid)
    {

    }

    public function create()
    {
        $data['satis_groups'] = $this->satis_model->get_si();
    	$data['title'] = '...';
        $data['modal_script'] ='<script type="text/javascript" src="../../assets/satis_jq.js"></script>';
        //$this->satis_model->create_satis_form();
        $this->load->view('templates/header', $data);
		$this->load->view('satis/create_edit_form', $data);
		$this->load->view('templates/footer');
    }

    public function get_satis_groups()
    {
        $data = $this->satis_model->get_satis_groups();
    }
}
?>