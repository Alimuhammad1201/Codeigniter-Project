<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model', 'member');
	}

	public function index()
	{
		$data['title'] = "Login";
		$this->load->view('admin/member/login', $data);
	}

	public function validate()
	{
		$where = [
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
		];

		$query = $this->member->validate_credentials($where);
		if ($query) {

			$data = [
				'fullname' => $query->fullname,
				'email' => $query->email,
				'member_id' => $query->id,
				'is_logged_in' => true
			];
			
			$this->session->set_userdata( $data );
			redirect('/admin/brand','refresh');
		}
		else
		{
			redirect('/admin','refresh');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/admin','refresh');
	}

	public function forgot_password()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
		{
			$email = $this->input->post('email');
			$row = $this->member->validate_credentials(['email' => $email]);
			if ($row) 
			{
				$hashKey = random_string('alnum', 50);
				$html = $this->load->view('admin/member/email_template', ['token' => $hashKey], TRUE);
				
				$config = Array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'sandbox.smtp.mailtrap.io',
				  'smtp_port' => 2525,
				  'smtp_user' => 'd1d15a46dccad0',
				  'smtp_pass' => 'd781a246a3ed23',
				  'crlf' => "\r\n",
				  'newline' => "\r\n"
				);

				

				$this->load->library('email', $config);
				
				$this->email->from('info@titanlaptops.com', 'Titan Laptops');
				$this->email->to($email);
				$this->email->message($html);
				$this->email->send();

				$this->member->update(['hash_key' => $hashKey], ['email' => $email]);
				$data['message'] = "Your password request has been sent to your email address.";
			}
		}
		$data['title'] = "Forgot Password";
		$this->load->view('admin/member/forgot_password', $data);
	}

	public function reset($token)
	{
		$where = ['hash_key' => $token];
		$row = $this->member->validate_credentials($where);
		
		if ( !$row)
			show_error("TOKEN HAS BEEN EXPIRED!");

		if ($this->input->server('REQUEST_METHOD') == 'POST') 
		{
			$affected = $this->member->update([
				'password' => $this->input->post('retype_password'),
				'hash_key' => NULL
			], [
				'id' => $row->id
			]);

			if ($affected > 0)
				return redirect('/admin','refresh');
		}

		$data['title'] = "Reset Password";
		$this->load->view('admin/member/reset_password', $data);
	}





}
				
