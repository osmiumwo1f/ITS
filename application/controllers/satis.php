<?php
class Satis extends CI_Controller {
	public function __construct() {
		parent :: __construct();
		$this->load->model('satis_model');
	}
	public function get_form($eid) {
	}
	public function create() {
		$data['burl'] = base_url();
		$data['title'] = '...';
		$data['modal_script'] = '<script type="text/javascript" src="'.$data['burl'].'assets/satis_jq.js"></script>';
        $data['json'] = '<script type="text/javascript" src="'.$data['burl'].'assets/jquery.json2html.js"></script>';
		$this->load->view('templates/header', $data);
		$this->load->view('satis/create_edit_form', $data);
		$this->load->view('templates/footer');
	}
	public function get_si_list() {
		$type = $this->input->post('type');
		$list = $this->input->post('list');
		$group = $this->input->post('group');
		$p = $this->input->post('p');
		$data['ajax'] = $this->satis_model->ajax($p, $type, $group, $list);
		$this->load->view('satis/sil', $data);
	}
	public function get_si(){
		$type = $this->input->post('type');
		$list = $this->input->post('list');
		$p = $this->input->post('p');
		$data['ajax'] = $this->satis_model->ajax($p, $type, null, $list);
		$this->load->view('satis/si', $data);
	}
}
?>