<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forget extends CI_Controller {

	function __construct(){
 		parent::__construct();
	 	$this->load->library('MyPHPMailer'); // load library
  	}
	
	public function index()
	{
		$this->load->view('forget_password');
	}
	
	public function request()
	{
		$d['title'] = 'Forget Password';
		$username = $this->input->post('username',TRUE);
		$this->form_validation->set_rules('username', 'Username', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('forget_password',$d);	
		}else{
			$u = $this->input->post('username');
			
			$query =  $this->db->query("SELECT * from member where username = '".$username."' LIMIT 1");
		
			if ($query->num_rows() > 0) {
			
				foreach($query->result_array() as $row){
					$nama = $row['nama'];
					$email = $row['email'];
					$password = $row['pin'];
				}
				
				//KIRIM SMS
				$message = "Hi $nama, password anda: $password. Simpan baik-baik password anda.";
				$destination = $username;
				$this->app_model->send_sms($message,$destination);
				
				//END OF SMS
			}
			
			$this->app_model->resetPassword($u);
		}
	}
	
	public function send_sms()
	{
		$destination = '6281337700418';
		$message = 'Testing SMS ya';
		$this->app_model->send_sms($message,$destination);
	}
}
