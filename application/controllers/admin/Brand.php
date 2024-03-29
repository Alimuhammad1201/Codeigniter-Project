<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('brand_model', 'brand');
		if ( !$this->session->userdata('is_logged_in'))
			redirect('/admin/','refresh');
	}
	

	public function index()
	{ 
		
		if ($this->input->get('q')) {
			$this->db->like('title', $this->input->get('q'), 'BOTH');
		}
        $config['base_url'] = base_url() . '/admin/brand/index/';
		$config['total_rows'] = $this->brand->count_all();
		$config['per_page'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 15;
		$config['uri_segment'] = 4;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		if ($this->input->get('q')) {
			$this->db->like('title', $this->input->get('q'), 'BOTH');
		}
		
		$data['brands'] = $this->brand->get_all($config['per_page'], $this->uri->segment(4));
		$data['title'] = 'Manage Brand';
		$data['main_content'] = 'admin/brand/index';
		$this->load->view('admin/layout/master', $data);
	}

	public function create()
	{
		
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
		{
			$this->form_validation->set_rules('create_date', 'DATE', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('slug', 'Slug', 'required');

			if ($this->form_validation->run() == TRUE)
			{
				$fileUpload = [];
				$hasFileUploaded = FALSE;

				$filepreferences = [
                         'upload_path' => './uploads/',
                         'allowed_types' => 'gif|jpg|png|jpeg',
                         'max_size' => '2048',
                         'encrypt_name' => TRUE
                 ];

                 $this->upload->initialize($filepreferences);

                 if ( ! $this->upload->do_upload('brand_img')) {
					$data['error'] = $this->upload->display_errors();
				}
                 else {
                 	$fileUpload = $this->upload->data();
                 	$hasFileUploaded = TRUE;
                 }

                 if ($hasFileUploaded) {
                 	$options = [
						'create_date' => $this->input->post('create_date'),
						'title' => $this->input->post('title'),
						'slug' => $this->input->post('slug'),
						'brand_img' => $fileUpload['file_name'],
						'status' => 'DEACTIVE',
						'meta_description' => $this->input->post('meta_description'),
						'meta_keyword' => $this->input->post('meta_keyword')
					];
					$this->brand->create($options);
					redirect('/admin/brand/','refresh');
                 }
			}
		}

		$data['title'] = 'Create Brand';
		$data['main_content'] = 'admin/brand/create';
		$this->load->view('admin/layout/master', $data);
	}

	public function edit($brand_id)
	{
		
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{ 
			$this->form_validation->set_rules('create_date', 'DATE', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('slug', 'Slug', 'required');

			if ($this->form_validation->run() == TRUE)
			{
				$fileUpload = [];
				$hasFileUploaded = FALSE;

				$filepreferences = [
                         'upload_path' => './uploads/',
                         'allowed_types' => 'gif|jpg|png|jpeg',
                         'max_size' => '2048',
                         'encrypt_name' => TRUE
                 ];

                 $this->upload->initialize($filepreferences);

                 if ( ! $this->upload->do_upload('brand_img')) {
					$data['error'] = $this->upload->display_errors();
				}
                 else {
                 	$fileUpload = $this->upload->data();
                 	$hasFileUploaded = TRUE;
                 }

					$options = [
						'create_date' => $this->input->post('create_date'),
						'title' => $this->input->post('title'),
						'slug' => $this->input->post('slug'),
						'brand_img' => ($hasFileUploaded) ? $fileUpload['file_name'] : $this->input->post('img_url'),
						'status' => 'DEACTIVE',
						'meta_description' => $this->input->post('meta_description'),
						'meta_keyword' => $this->input->post('meta_keyword')
					];
					$affected = $this->brand->update($brand_id, $options);
					if ($affected) {
						if ($hasFileUploaded)
							if (file_exists('./uploads/'. $this->input->post('img_url')))
								unlink('./uploads/'. $this->input->post('img_url'));
					            redirect('/admin/brand/', 'refresh');

					}
				
				}
			}


							$data['brand'] = $this->brand->get_by($brand_id);
							$data['title'] = 'Edit Brand';
							$data['main_content'] = 'admin/brand/edit';
							$this->load->view('admin/layout/master', $data);
					    }

					    public function status($brand_id)
					{
						sleep(1);
						$row = $this->brand->get_by($brand_id);

						$newStatus = ($row->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';

						$options = [ 'status' => $newStatus ];
						$this->brand->update($brand_id, $options);
						echo $newStatus;
						
					}
					
					public function delete($brand_id)
					{
						
						$row = $this->brand->get_by($brand_id);
						$currentImage = $row->brand_img;

						$affected = $this->brand->destroy($brand_id);
						if ($affected) {
							//unlink('./uploads/' . $currentImage);
							echo true;
						}
						
					}

					public function active_all_status()
					{
						$brand_ids = $this->input->post('brand_id');
						$options = [
							'status' => 'ACTIVE'
						];
						foreach ($brand_ids as $id) {
							echo $this->brand->update($id, $options);
						}
					}


	public function deactive_all_status()
	{
		$brand_ids = $this->input->post('brand_id');
		$options = [
			'status' => 'DEACTIVE'
		];
		foreach ($brand_ids as $id) {
			echo $this->brand->update($id, $options);
		}
	}

	public function delete_all()
	{
		$brand_ids = $this->input->post('brand_id');
		foreach ($brand_ids as $id) {
			echo $this->delete($id);
		}
	}


					public function brand_seed()
					{
						

						$this->db->truncate('afa110_brand');

						$faker = Faker\Factory::create();

						for ($i = 0; $i < 50; $i++) {
							$title = $faker->name;
							$options = [
								'create_date' => $faker->date($format = 'Y-m-d', $max = 'now'),	
								'title' => $title,
								'slug' => url_title($title, '_', TRUE),
								'brand_img' => 'NO image found',
								'status' => $faker->randomElement(['DEACTIVE', 'ACTIVE']),
								'meta_description' => $faker->text($maxNbChars = 500),
								'meta_keyword' => $faker->randomElement(['KEYWORD-1', 'KEYWORD-2', 'KEYWORD-3', 'KEYWORD-4'])
								
								];
								$this->brand->create($options);
						} 
									redirect('/admin/brand/','refresh');
				       
					}
				}
