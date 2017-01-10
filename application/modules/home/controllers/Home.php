<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index() {
		// $this->load->view('home');
		$data['main_content'] = 'home';
		// print_r('home');die();
		// load_view($data);
		$this->load->view('theme/template', $data);
		// $this->load->view('theme/main_content', $data);
		// $this->template->load('template', 'home', null);
	}
}
