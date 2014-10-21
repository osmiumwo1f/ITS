<?php
class Satis extends CI_Controller {
	public function __construct() {
		parent :: __construct();
		$this->load->model('satis_model');
	}
	public function get_form($eid) {
	}
	public function create() {
		$data['title'] = '...';
		$data['modal_script'] = '<script type="text/javascript" src="../../../assets/satis_jq.js"></script>';
		$this->load->view('templates/header', $data);
		$this->load->view('satis/create_edit_form', $data);
		$this->load->view('templates/footer');
	}
	public function get_satis_groups() {
		$data = $this->satis_model->get_satis_groups();
	}
	public function ajax() {
		$type = $this->input->post('type');
		$list = $this->input->post('list');
		$id = $this->input->post('id');
		$data['ajax'] = $this->satis_model->ajax($type, $list, $id);
		$this->load->view('satis/si', $data);
	}
}
?>