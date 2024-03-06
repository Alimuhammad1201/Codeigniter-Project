<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model', 'product');
		$this->load->model('brand_model', 'brand');
		

		if ( !$this->session->userdata('is_logged_in'))
			redirect('/admin/','refresh');
	}


	public function index()
	{
		$this->load->model('product_specification_model');
		
		
		
		

		


		if ($this->input->get('q')) {
            $this->db->like('title', $this->input->get('q'), 'BOTH');
		}

		$config['base_url'] =  base_url() . 'admin/product/index';
		$config['total_rows'] = $this->product->count_all();
		$config['per_page'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 15;
		$config['uri_segment'] = 4;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

        
		if ($this->input->get('q')) {
            $this->db->like('title', $this->input->get('q'), 'BOTH');
		}












       


         
		$data['products'] = $this->product->get_all($config['per_page'], $this->uri->segment(4));
		$data['brand_array'] = $this->brand->brand_array();
		$data['title'] = 'Manage Product';
		$data['main_content'] = 'admin/product/index';
		$this->load->view('admin/layout/master', $data);
	}

	public function create()
	{
		
		$this->load->model('brand');

		if ($this->input->server('REQUEST_METHOD') == 'POST')

			$this->form_validation->set_rules('create_date', 'DATE', 'required');
			$this->form_validation->set_rules('title', 'TITLE', 'required');
			$this->form_validation->set_rules('slug', 'Slug', 'required');

			if ($this->form_validation->run() == TRUE) 
		{
            $fileUpload = [];
            $hasFileUploaded = FALSE;

            $filepreferences = [
                  'upload_path' => './uploads/',
                  'allowed_types' => 'gif|jpeg|png|jpg',
                  'encrypt_name' => TRUE
            ];	

            $this->upload->initialize($filepreferences);

            if( ! $this->upload->do_upload('product_img')) {
            	$data['error'] = $this->upload->display_errors();	
            }
            else {
            	$fileUpload = $this->upload->data();
            	$hasFileUploaded = TRUE;
            }

            if ($hasFileUploaded) 
            {
	           $options = [
                'create_date' => $this->input->post('create_date'),
                'brand_id' => $this->input->post('brand_id'),
                'title' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'code' => $this->input->post('code'),
                'product_condition' => $this->input->post('product_condition'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
                'product_img' => $fileUpload['file_name'],
                'status' => 'DEACTIVE',
                'views' => $this->input->post('views'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keyword' => $this->input->post('meta_keyword')
				];
				$this->product->create($options);
				redirect('/admin/product', 'refresh');					
			}  
	     }
		
				$data['title'] = 'Create Product';
				$data['brands'] = $this->brand->get_all();
				$data['main_content'] = 'admin/product/create';
				$this->load->view('admin/layout/master', $data);
			}

			public function edit($product_id)
			{
				
				$this->load->model('brand');

				if ($this->input->server('REQUEST_METHOD') == 'POST')
					$this->form_validation->set_rules('create_date', 'DATE', 'required');
					$this->form_validation->set_rules('title', 'TITLE', 'required');
					$this->form_validation->set_rules('slug', 'Slug', 'required');

						if ($this->form_validation->run() == TRUE) 
					{
			            $fileUpload = [];
			            $hasFileUploaded = FALSE;

			            $filepreferences = [
			                  'upload_path' => './uploads/',
			                  'allowed_types' => 'gif|jpeg|png|jpg',
			                  'encrypt_name' => TRUE
			            ];	

			            $this->upload->initialize($filepreferences);

			            if( ! $this->upload->do_upload('product_img')) {
			            	$data['error'] = $this->upload->display_errors();	
			            }
			            else {
			            	$fileUpload = $this->upload->data();
			            	$hasFileUploaded = TRUE;
				}
					$options = [
		                'create_date' => $this->input->post('create_date'),
		                'brand_id' => $this->input->post('brand_id'),
		                'title' => $this->input->post('title'),
		                'slug' => $this->input->post('slug'),
		                'code' => $this->input->post('code'),
		                'product_condition' => $this->input->post('product_condition'),
		                'price' => $this->input->post('price'),
		                'description' => $this->input->post('description'),
					    'product_img' => ($hasFileUploaded) ? $fileUpload['file_name'] : $this->input->post('img_url'),
		     
		                'status' => 'DEACTIVE',
		                'views' => $this->input->post('views'),
		                'meta_description' => $this->input->post('meta_description'),
		                'meta_keyword' => $this->input->post('meta_keyword')
					];
					$affected = $this->product->update($product_id, $options);
					if ($affected) {
						if ($hasFileUploaded)
							if (file_exists('./uploads/'. $this->input->post('img_url')))
								unlink('./uploads/' . $this->input->post('img_url'));
				            	redirect('admin/product/', 'refresh');

					
                 }
			}
				$data['product'] = $this->product->get_by($product_id);
				$data['title'] = 'Edit Product';
				$data['brands'] = $this->brand->get_all();
				$data['main_content'] = 'admin/product/edit';
				$this->load->view('admin/layout/master', $data);
			}

			public function status($product_id)
			{
				sleep(1);
				
				$row = $this->product->get_by($product_id);
				
				$newStatus = ($row->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';

				$options = [ 'status' => $newStatus];
				$this->product->update($product_id, $options);
				echo $newStatus;
			}	

			public function delete($product_id)
			{
				
                $row = $this->product->get_by($product_id);
				$currentImage = $row->product_img;
					
				$affected = $this->product->destroy($product_id);
				if ($affected) {
					//unlink('./uploads/' . $currentImage);
					echo true;
					
				}
				
			}

			public function active_all_status()
			{
				$product_ids = $this->input->post('product_id');
				$options = [
                       'status' => 'ACTIVE'
				];
				foreach ($product_ids as $id) {
					echo $this->product->update($id, $options);
					
					
				}
			}
			public function Product_seed() {
				
				$this->db->truncate('afa110_product');

				$faker = Faker\Factory::create();
				for ($i = 0; $i < 50; $i++) {
					$title = $faker->name;
					$options = [
				      'create_date' => $faker->date($format = 'Y-m-d', $max = 'now'),	
		              'brand_id' => $faker->numberBetween($min = 1, $max = 50),
		              'title' => $title,
				      'slug' => url_title($title, '_', TRUE),
		              'code' => $faker->text($maxNbChars = 50),
		              'product_condition' => $faker->text($maxNbChars = 100),
		              'price' => $faker->text($maxNbChars = 100),
		              'description' => $faker->text($maxNbChars = 100),
		              'product_img' => 'No Image Found',
			          'status' => $faker->randomElement(['DEACTIVE', 'ACTIVE']),
		              'views' => $faker->text($maxNbChars = 100),
		              'meta_description' => $faker->text($maxNbChars = 500),
				      'meta_keyword' => $faker->randomElement(['KEYWORD-1', 'KEYWORD-2', 'KEYWORD-3', 'KEYWORD-4'])
					];
				    $this->product->create($options);
				    
					 
					}
						redirect('/admin/product', 'refresh');					
		
				
			}
		}
        