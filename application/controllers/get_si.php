<?php
class News extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('satis_model');
    }

    public function get_si()
    {

    }

}
?>