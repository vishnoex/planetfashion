<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

	public function __construct() {
		parent::__construct();
	}
}

class Admin_Controller extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}
}

class Public_Controller extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}
}