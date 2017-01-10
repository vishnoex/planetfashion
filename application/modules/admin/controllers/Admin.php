<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		$data['main_content'] = 'admin_view';
		$this->load->view('theme/main_content', $data);
		// $this->load->view('admin/admin_view');
	}
}