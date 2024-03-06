<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('media_model', 'media');
		if ( !$this->session->userdata('is_logged_in'))
			redirect('/admin/','refresh');
	}

	public function index()
	{
	    $this->load->model('media');

	    	if ($this->input->get('q')) {
			$this->db->like('title', $this->input->get('q'), 'BOTH');
		}

	    $config['base_url'] = base_url() . '/admin/media/index/';
		$config['total_rows'] = $this->media->count_all();
		$config['per_page'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 15;
		$config['uri_segment'] = 4;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		if ($this->input->get('q')) {
			$this->db->like('title', $this->input->get('q'), 'BOTH');
		}

		$data['medias'] = $this->media->get_all($config['per_page'], $this->uri->segment(4));
		$data['title'] = 'Manage Media';
		$data['main_content'] = 'admin/media/index';
		$this->load->view('admin/layout/master', $data);
	}

	public function create()
	{
		$this->load->model('media');

		if ($this->input->server('REQUEST_METHOD') == 'POST') 
		{
			$this->form_validation->set_rules('create_date', 'Date', 'required');
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

                 if ( ! $this->upload->do_upload('media_img')) {
                 	$data['error'] = $this->upload->display_errors();
                 }
                 else {
                 	$fileUpload = $this->upload->data();
                 	$hasFileUploaded = TRUE;
                 }

                 if ($hasFileUploaded) {
					$options = [
		             'create_date' => $this->input->post('create_date'),
		             'media_type' => $this->input->post('media_type'),
		             'title' => $this->input->post('title'),
		             'slug' => $this->input->post('slug'),
		             'description' => $this->input->post('description'),
		             'media_img' => $fileUpload['file_name'],
		             'meta_description' => $this->input->post('meta_description'),
		             'meta_keyword' => $this->input->post('meta_keyword')
				  ];
				  $this->media->create($options);
				  redirect('/admin/media', 'refresh');

				}
				 
			}		 
		}
					$data['title'] = 'Create Media';
					$data['main_content'] = 'admin/media/create';
					$this->load->view('admin/layout/master', $data);
				}

				public function edit($media_id)
				{
					$this->load->model('media');
					if ($this->input->server('REQUEST_METHOD') == 'POST')
					{
						$this->form_validation->set_rules('create_date', 'Date', 'required');
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

		                 if ( ! $this->upload->do_upload('media_img')) {
		                 	$data['error'] = $this->upload->display_errors();
		                 }
		                 else {
		                 	$fileUpload = $this->upload->data();
		                 	$hasFileUploaded = TRUE;
		                 }
							$options = [
				             'create_date' => $this->input->post('create_date'),
				             'media_type' => $this->input->post('media_type'),
				             'title' => $this->input->post('title'),
				             'slug' => $this->input->post('slug'),
				             'description' => $this->input->post('description'),
				             'media_img' => ($hasFileUploaded) ? $fileUpload['file_name'] : $this->input->post('img_url'), 
				             'status' => 'DEACTIVE',
				             'meta_description' => $this->input->post('meta_description'),
				             'meta_keyword' => $this->input->post('meta_keyword')
						  ];
						  $afffected = $this->media->update($media_id, $options);
						  if ($afffected) {
						  	if ($hasFileUploaded)
						  		if (file_exists('./uploads/' . $this->input->post('img_url')))
						  			unlink('./uploads/' . $this->input->post('img_url'));
						            redirect('/admin/media', 'refresh');

						  }
						}
					}

						
						$data['media'] = $this->media->get_by($media_id);
						$data['title'] = 'Edit Media';
						$data['main_content'] = 'admin/media/edit';
						$this->load->view('admin/layout/master', $data);
					}

				public function status($media_id)
				{
					sleep(1);
					$this->load->model('media');
					$row = $this->media->get_by($media_id);

					$newStatus = ($row->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';

					$options = [ 'status' => $newStatus ]; 
					$this->media->update($media_id, $options);
					echo $newStatus;
				}

				public function delete($media_id)
				{
					$this->load->model('media');
					$row = $this->media->get_by($media_id);
					$currentImage = $row->
					media_img;
					$afffected = $this->media->destory($media_id);
					if ($afffected) {
					  // unlink('./uploads/' . $currentImage);
					   echo true;
                       
					}
				}

					public function active_all_status()
					{
						$media_ids = $this->input->post('media_id');
						$options = [
							'status' => 'ACTIVE'
						];
						foreach ($media_ids as $id) {
							echo $this->media->update($id, $options);
						}
					}


	public function deactive_all_status()
	{
		$media_ids = $this->input->post('media_id');
		$options = [
			'status' => 'DEACTIVE'
		];
		foreach ($media_ids as $id) {
			echo $this->media->update($id, $options);
		}
	}

	public function delete_all()
	{
		$media_ids = $this->input->post('media_id');
		foreach ($media_ids as $id) {
			echo $this->delete($id);
		}
	}

				public function media_seed() {
					$this->load->model('media');

					$this->db->truncate('afa110_media');
					$faker = Faker\factory::create();

	            	for ($i = 0; $i < 50; $i++) {
	            		$title = $faker->name;
	            		$options = [
			                'create_date' => $faker->date($format = 'Y-m-d', $max = 'now'),	
				            'media_type' => $faker->randomElement(['Slideshow', 'video']),
				            'title' => $title,
				            'slug' => url_title($title, '_', TRUE), 
		                    'description' => $faker->text($maxNbChars = 100),
				            'embed_code' => 1,
				            'media_img' => 'No image found',
			                'status' => $faker->randomElement(['DEACTIVE', 'ACTIVE']),
				            'meta_description' => $faker->text($maxNbChars = 500),
				            'meta_keyword' => $faker->randomElement(['KEYWORD-1', 'KEYWORD-2', 'KEYWORD-3', 'KEYWORD-4'])
					  ];
					  $this->media->create($options);

	            	}
					  redirect('/admin/media', 'refresh');
                  
				}
			}
