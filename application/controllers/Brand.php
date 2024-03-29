<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('brand_model', 'brand');
		$this->load->model('product_model', 'product');
	}

	public function detail($slug)
	{   
		$row = $this->brand->show_by($slug);

		if (!$row) show_404();
		
		$this->db->where([
			'brand_id' => $row->id
		]);

        $data['products'] = $this->product->show_all();
		$data['title'] = $row->title;
		$this->load->view('brand/detail', $data);
		
	}
}
