<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_gallery extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if ( !$this->session->userdata('is_logged_in'))
			redirect('/admin/','refresh');
	}

	public function create($product_id)
	{
		$this->load->model('product_gallery_model');

		if ($this->input->server('REQUEST_METHOD') == 'POST') 
		{
			$data = [
				'upload_path' => './uploads/',
				'allowed_types' => 'gif|jpg|jpeg|png',
				'encrypt_name' => TRUE
			];

			$this->upload->initialize($data);
			
			if ( $this->upload->do_upload('file')){
				$file = $this->upload->data();
				
				
				$this->product_gallery_model->create();
				redirect('/admin/product', 'refresh');
			}
		}
		$data['title'] = 'Add Gallery';
		$data['main_content'] = '/admin/product_gallery/create';
		$this->load->view('/admin/layout/master', $data);
	}
}
