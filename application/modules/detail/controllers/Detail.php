<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends MY_Controller {

	public function index() {
		$data['main_content'] = 'detail_view';
		$data['product_name'] = $_GET["open"];
		$crumbs = explode("/",$_SERVER["REQUEST_URI"]);
		$breadcrumb = array();
		foreach($crumbs as $crumb){
			array_push($breadcrumb, ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . ' '));
		}
		$data['breadcrumb'] = $breadcrumb;
		$this->load->view('theme/main_content', $data);
	}
}