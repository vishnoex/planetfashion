<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index() {
		$data['main_content'] = 'home';
		$data['rfy_price'] = array(
						array("product_name" => "Kaos Polos", "product_price" => 35000,
									"product_description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat aliquid placeat nobis veritatis neque earum possimus tempora sunt.",
									"product_image_link" => "https://pbs.twimg.com/profile_images/464097596366020609/inEmqAmp.jpeg"),
						array("product_name" => "Kemeja Merah", "product_price" => 115000,
									"product_description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat aliquid placeat nobis veritatis neque earum possimus tempora sunt.",
									"product_image_link" => "https://s0.bukalapak.com/img/074038931/large/1004520_10204031833034515_5278476728316459033_n.jpg"),
						array("product_name" => "Kemeja Merah Lengan Panjang", "product_price" => 125000,
									"product_description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat aliquid placeat nobis veritatis neque earum possimus tempora sunt.",
									"product_image_link" => "https://ecs7.tokopedia.net/img/product-1/2015/5/4/234978/234978_06558b44-f242-11e4-aa4e-bedb64efb121.jpg"),
						array("product_name" => "Kaos Gambar 1", "product_price" => 70000,
									"product_description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat aliquid placeat nobis veritatis neque earum possimus tempora sunt.",
									"product_image_link" => "http://www.kaos3dmurah.com/wp-content/uploads/2015/02/IMG-20150206-WA0024.jpg"),
						array("product_name" => "Kaos Oblong", "product_price" => 36000,
									"product_description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat aliquid placeat nobis veritatis neque earum possimus tempora sunt.",
									"product_image_link" => "http://www.pusatkonveksi.com/wp-content/uploads/2015/11/Jenis-Kaos-Oblong.jpg"),
						array("product_name" => "Jaket Kulit Ori", "product_price" => 350000,
									"product_description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat aliquid placeat nobis veritatis neque earum possimus tempora sunt.",
									"product_image_link" => "http://jaketkulitasgar.com/image/cache/catalog/Jaket+Kulit+Asli-700x700.jpg"),
						array("product_name" => "Jaket Hodie (Grade Ori)", "product_price" => 150000,
									"product_description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat aliquid placeat nobis veritatis neque earum possimus tempora sunt.",
									"product_image_link" => "https://media.brandoutlet.co.id/media/catalog/product/cache/1/image/570x750/0401109eae9e35e0e655ba1747026f94/H/L/HLPLS_HOODIE_NINJA-HX-0.jpg"),
						array("product_name" => "Kemeja Batik", "product_price" => 98000,
									"product_description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat aliquid placeat nobis veritatis neque earum possimus tempora sunt.",
									"product_image_link" => "http://bajumodelbaru.biz/wp-content/uploads/2016/07/Kemeja-batik-tulis-pria.jpg"),
						array("product_name" => "Kaos Gambar 2", "product_price" => 72000,
									"product_description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat aliquid placeat nobis veritatis neque earum possimus tempora sunt.",
									"product_image_link" => "http://kaospremium.com/images/big/kaos-clark-kent-superman-2-1072591.jpg"),
						array("product_name" => "Kaos Gambar 3", "product_price" => 76000,
									"product_description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat aliquid placeat nobis veritatis neque earum possimus tempora sunt.",
									"product_image_link" => "http://www.pulangkerja.com/wp-content/uploads/Desain-Kaos-Super-Keren-2.jpg"));
		$this->load->view('theme/template', $data);
	}
}
