<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('review_model', 'rev');
		if ( !$this->session->userdata('is_logged_in'))
			redirect('/admin/','refresh');
	}

	public function index()
	{
		
		if ($this->input->get('q')) {
			$this->db->like('name', $this->input->get('q'), 'BOTH');
		}
		

		$config['base_url'] = base_url(). '/admin/review/index/';
		$config['total_rows'] = $this->rev->count_all();
		$config['per_page'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 15;
		$config['uri_segment'] = 4;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);
        
        if ($this->input->get('q')) {
			$this->db->like('name', $this->input->get('q'), 'BOTH');
		}
		



		$data['reviews'] = $this->rev->get_all($config['per_page'], $this->uri->segment(4));
		$data['title'] = 'Manage Review';
		$data['main_content'] = 'admin/review/index';
		$this->load->view('admin/layout/master', $data);
	}

	public function create()
	{
		
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$this->form_validation->set_rules('create_date', 'create_date', 'required');
			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required');
			 
			 if ($this->form_validation->run() == TRUE) {
			 $options = [
               'create_date' => $this->input->post('create_date'),
               'fullname' => $this->input->post('fullname'),
               
               'review' => $this->input->post('review'),
               
			];
			$this->rev->create($review_id, $options);
			redirect('/admin/review/', 'refresh');
		
			 	
		}
	}
			
		
		$data['title'] = 'Create Review';
		$data['main_content'] = 'admin/review/create';
		$this->load->view('admin/layout/master', $data);
	}

	public function edit($review_id)
	{
				if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$options = [
               'create_date' => $this->input->post('create_date'),
               'fullname' => $this->input->post('fullname'),
               
               'review' => $this->input->post('review'),
               
			];
			$this->rev->update($review_id, $options);
			redirect('/admin/review/', 'refresh');
		}
		$data['review'] = $this->rev->get_by($review_id);
		$data['title'] = 'Edit Review';
		$data['main_content'] = 'admin/review/edit';
		$this->load->view('admin/layout/master', $data);
	}

	public function status($review_id)
	{
				$row = $this->rev->get_by($review_id);

		$newStatus = ($row->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';

		$options = [ 'status' => $newStatus];
		$this->rev->update($review_id, $options);
		echo $newStatus;
	}

	public function delete($review_id)
	{
				$this->rev->destroy($review_id);
		echo true;
	}

				public function ac()
					{
						$review_ids = $this->input->post('review_id');
						$options = [
							'status' => 'ACTIVE'
						];
						foreach ($review_ids as $id) {
							echo $this->review_model->update($id, $options);
						}
					}


	
	public function review_seed() {

		
		$this->db->truncate('afa110_review');
		$faker = Faker\factory::create();

		for ($i = 0; $i < 50; $i++) {
			$options = [
			   'create_date' => $faker->date($format = 'Y-m-d', $max = 'now'),	
               'name' => $faker->name,
               'website' => $faker->text($maxNbChars = 50),
               'comment' => $faker->text($maxNbChars = 100),
               'email' => $faker->text($maxNbChars = 50),
			   'status' => $faker->randomElement(['DEACTIVE', 'ACTIVE']),
			];
		$this->rev->create($options);
	 }
	 redirect('/admin/review', 'refresh');
  }
}
