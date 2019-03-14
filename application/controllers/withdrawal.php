<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Withdrawal extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('data_model');	
		$this->load->model('bonus_model');		
		$this->load->model('network_model');
		$this->load->model('ewalet_model');
		$this->load->library('MyPHPMailer'); // load library
    }
  
	public function index()
	{
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		$d['page_title'] = "Withdrawal E-Bonus";
		if(!empty($user_session)){	
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
			$this->form_validation->set_rules('tujuan', 'Tujuan', 'required');
			$this->form_validation->set_rules('passw', 'Password', 'required');
		
			$d['jumlah'] = $this->input->post('jumlah',TRUE);
			$d['tujuan'] = $this->input->post('tujuan',TRUE);
			if ($this->form_validation->run() == FALSE){
				$d['content']= $this->load->view('withdrawal/request',$d,true);			
				
			}else{				
				$d['content']= $this->load->view('withdrawal/request',$d,true);	
			}
		 
			$this->load->view('include/template',$d);
		}else{
		  header('location:'.base_url());
		}
	}
  
	public function confirm()
	{
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		$d['page_title'] = "Withdrawal E-Walet";
		if($user_session){	

			$jumlah = $this->input->post('jumlah');
			$tujuan = $this->input->post('tujuan');
			$passw = $this->input->post('passw');
			
			$d['jumlah'] = $jumlah;
			$d['tujuan'] = $tujuan;
			
			if(($this->ewalet_model->myewaletdone($user_session, "")-$jumlah)>=5000000){
			
    			if($this->ewalet_model->myewaletdone($user_session, "")<$jumlah){
    				$this->session->set_flashdata('result_withdrawal', 'Saldo E-Walet anda tidak cukup');
    				$d['content']= $this->load->view('withdrawal/request',$d,true);	
    			} else {
    				
    				$d['conversi'] = 1;
    				$d['jumlah_rp'] = $this->input->post('jumlah') * 1;
    				$d['content']= $this->load->view('withdrawal/confirmation',$d,true);
    				
    			}
			} else {
			    $this->session->set_flashdata('result_withdrawal', 'Withdrawal Failed. Sisa Saldo setelah penarikan minimal Rp 5.000.000,-');
    				$d['content']= $this->load->view('withdrawal/request',$d,true);
			}
			$this->load->view('include/template',$d);
			
		}else{
		  header('location:'.base_url());
		}
	}
  
	public function process_withdrawal_ebonus()
	{
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		$d['page_title'] = "Withdrawal E-Bonus";
		if($user_session){	

			$jumlah = $this->input->post('jumlah',TRUE);
			$jumlah_rp = $this->input->post('jumlah_rp',TRUE);
			$tujuan = $this->input->post('tujuan',TRUE);
			
			$d['jumlah'] = $jumlah;
			$d['tujuan'] = $tujuan;
			
			if($this->ewalet_model->myewaletdone($user_session, "")<$jumlah){
				$this->session->set_flashdata('result_withdrawal', 'Saldo E-Walet anda tidak cukup');
				$d['content']= $this->load->view('withdrawal/request',$d,true);	
			} else {
				$kode = date('ymdHis').rand(1,9);
				
				$data['username'] = $user_session;
				$data['kurs'] = 1;
				$data['jumlah'] = $jumlah;
				$data['jumlah_rp'] = $this->input->post('jumlah') * 1;
				$data['adm'] = 0;
				$data['bank'] = $this->data_model->dataku("bank",$user_session);
				$data['norek'] = $this->data_model->dataku("norek",$user_session);
				$data['namarek'] = $this->data_model->dataku("namarek",$user_session);
				$data['tgl_req'] = date('Y-m-d H:i:s');
				$data['user_admin'] = 'system';
				$data['status'] = 0;
				$data['no_invoice'] = $kode;
				$data['tujuan'] = $tujuan;
				$data['jenis'] = "ebonus";
				$result = $this->db->insert('tb_withdrawal',$data);
				
				$ereg['username'] = $user_session;
				$ereg['kode'] = $kode;
				$ereg['jumlah'] = $jumlah;
				$ereg['uraian'] = 'Withdrawal e-walet via web';
				$ereg['tgl'] = date('Y-m-d H:i:s');
				$ereg['status'] = 1;
				$ereg['jenis'] = 'debit';

				$result = $this->db->insert('dataewalet',$ereg);
				
				//KIRIM SMS
			
				$datasms['out_starttime'] = date('Y-m-d H:i:s');
				$datasms['out_hpnumber'] = $user_session;
				$datasms['provider'] = 'XL';
				$datasms['out_message'] = "Permintaan withdrawal e-walet sejumlah $jumlah (Rp $jumlah_rp) akan diproses pada setiap hari Senin-Kamis";
				$datasms['tipe'] = 'SMS';
				$this->app_model->insertData("outbox",$datasms);
				
				//END OF SMS
				
				///////////////////email registration/////////////////////////////////////////////////////////
				$fromEmail = "suyasa.dps@gmail.com";
				$passWord = "buals1979@";
						
				$mail = new PHPMailer();
				$mail->IsHTML(true);    // set email format to HTML
				$mail->IsSMTP();   // we are going to use SMTP
				//Enable SMTP debugging
				// 0 = off (for production use)
				// 1 = client messages
				// 2 = client and server messages
				$mail->SMTPDebug = 0;
				
				$mail->SMTPAuth   = true; // enabled SMTP authentication
				$mail->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
				$mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
				$mail->Port       = 587;                   // SMTP port to connect to GMail
				$mail->Username   = $fromEmail;  // alamat email kamu
				$mail->Password   = $passWord; // password GMail
				$mail->SetFrom('suyasa.dps@gmail.com', 'KSU Dana Mandiri');  //Siapa yg mengirim email
				$mail->addReplyTo('suyasa.dps@gmail.com', 'KSU Dana Mandiri');
				$mail->Subject    = "KSU Dana Mandiri  - Password Recovery";
				//$mail->Body       = $isiEmail;
				$toEmail = $email; // siapa yg menerima email ini
				$mail->AddAddress($toEmail);
						
				///isi email		

				$email_body = "
				Hi $nama,<br />
				<br />
				Permintaan withdrawal ewalet sejumlah Rp $jumlah_rp telah kami terima
				Dan akan kami proses pada setiap hari Senin-Kamis.
				<br />
				<br />
				Regards,
				KSU Dana Mandiri
				";
					
				$mail->msgHTML($email_body);			
				//$mail->Send();			
				/////END of email ////////////////////////////////////////////////////////	
				
				$this->session->set_flashdata('result_withdrawale', 'Withdrawal success');
				redirect(base_url().'withdrawal');
			
				
			}
			$this->load->view('include/template',$d);
			
		}else{
		  header('location:'.base_url());
		}
	}
  
	public function eregister()
	{
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		$d['page_title'] = "Withdrawal E-Register";
		if(!empty($user_session)){	
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
			$this->form_validation->set_rules('tujuan', 'Tujuan', 'required');
			$this->form_validation->set_rules('passw', 'Password', 'required');
		
			$d['jumlah'] = $this->input->post('jumlah',TRUE);
			$d['tujuan'] = $this->input->post('tujuan',TRUE);
			if ($this->form_validation->run() == FALSE){
				$d['content']= $this->load->view('withdrawal/request_eregister',$d,true);			
				
			}else{				
				$d['content']= $this->load->view('withdrawal/request_eregister',$d,true);	
			}
		 
			$this->load->view('include/template',$d);
		}else{
		  header('location:'.base_url());
		}
	}
	
	public function eregister_confirm()
	{
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		$d['page_title'] = "Withdrawal E-Walet";
		if($user_session){	

			$jumlah = $this->input->post('jumlah');
			$tujuan = $this->input->post('tujuan');
			$passw = $this->input->post('passw');
			
			$d['jumlah'] = $jumlah;
			$d['tujuan'] = $tujuan;
			
			if($this->ewalet_model->myeregisterdone($user_session, "")<$jumlah){
				$this->session->set_flashdata('result_withdrawal', 'Saldo E-Walet anda tidak cukup');
				$d['content']= $this->load->view('withdrawal/request_eregister',$d,true);	
			} else {
				
				$d['conversi'] = 1;
				$d['jumlah_rp'] = $this->input->post('jumlah') * 1;
				$d['content']= $this->load->view('withdrawal/confirmation_eregister',$d,true);
				
			}
			$this->load->view('include/template',$d);
			
		}else{
		  header('location:'.base_url());
		}
	}
	
	public function process_withdrawal_eregister()
	{
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		$d['page_title'] = "Withdrawal E-Walet";
		if($user_session){	

			$jumlah = $this->input->post('jumlah',TRUE);
			$jumlah_rp = $this->input->post('jumlah_rp',TRUE);
			$tujuan = $this->input->post('tujuan',TRUE);
			
			$d['jumlah'] = $jumlah;
			$d['tujuan'] = $tujuan;
			
			if($this->ewalet_model->myeregisterdone($user_session, "")<$jumlah){
				$this->session->set_flashdata('result_withdrawal', 'Saldo E-Walet anda tidak cukup');
				$d['content']= $this->load->view('withdrawal/request_eregister',$d,true);	
			} else {
				$kode = 'E'.date('ymdHis').rand(1,9);
				
				$data['username'] = $user_session;
				$data['kurs'] = 1;
				$data['jumlah'] = $jumlah;
				$data['jumlah_rp'] = $this->input->post('jumlah') * 1;
				$data['adm'] = 0;
				$data['bank'] = $this->data_model->dataku("nama",$user_session);
				$data['norek'] = $this->data_model->dataku("norek",$user_session);
				$data['namarek'] = $this->data_model->dataku("namarek",$user_session);
				$data['tgl_req'] = date('Y-m-d H:i:s');
				$data['user_admin'] = 'system';
				$data['status'] = 0;
				$data['no_invoice'] = $kode;
				$data['tujuan'] = $tujuan;
				$data['jenis'] = "eregister";
				$result = $this->db->insert('tb_withdrawal',$data);
				
				$ereg['username'] = $user_session;
				$ereg['kode'] = $kode;
				$ereg['jumlah'] = $jumlah;
				$ereg['uraian'] = 'Withdrawal via web';
				$ereg['tgl'] = date('Y-m-d H:i:s');
				$ereg['status'] = 1;
				$ereg['jenis'] = 'debit';

				$result = $this->db->insert('dataeregister',$ereg);
				
				//KIRIM SMS
			
				$datasms['out_starttime'] = date('Y-m-d H:i:s');
				$datasms['out_hpnumber'] = $user_session;
				$datasms['provider'] = 'XL';
				$datasms['out_message'] = "Permintaan withdrawal sejumlah $jumlah (Rp $jumlah_rp) akan diproses pada setiap hari Senin-Kamis";
				$datasms['tipe'] = 'SMS';
				$this->app_model->insertData("outbox",$datasms);
				
				//END OF SMS
				
				///////////////////email registration/////////////////////////////////////////////////////////
				$fromEmail = "suyasa.dps@gmail.com";
				$passWord = "buals1979@";
						
				$mail = new PHPMailer();
				$mail->IsHTML(true);    // set email format to HTML
				$mail->IsSMTP();   // we are going to use SMTP
				//Enable SMTP debugging
				// 0 = off (for production use)
				// 1 = client messages
				// 2 = client and server messages
				$mail->SMTPDebug = 0;
				
				$mail->SMTPAuth   = true; // enabled SMTP authentication
				$mail->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
				$mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
				$mail->Port       = 587;                   // SMTP port to connect to GMail
				$mail->Username   = $fromEmail;  // alamat email kamu
				$mail->Password   = $passWord; // password GMail
				$mail->SetFrom('suyasa.dps@gmail.com', 'KSU Dana Mandiri');  //Siapa yg mengirim email
				$mail->addReplyTo('suyasa.dps@gmail.com', 'KSU Dana Mandiri');
				$mail->Subject    = "KSU Dana Mandiri  - Password Recovery";
				//$mail->Body       = $isiEmail;
				$toEmail = $email; // siapa yg menerima email ini
				$mail->AddAddress($toEmail);
						
				///isi email		

				$email_body = "
				Hi $nama,<br />
				<br />
				Permintaan withdrawal ewalet register sejumlah Rp $jumlah_rp telah kami terima
				Dan akan kami proses pada setiap hari Senin-Kamis.
				<br />
				<br />
				Regards,
				Tambang Hijau
				";
					
				$mail->msgHTML($email_body);			
				//$mail->Send();			
				/////END of email ////////////////////////////////////////////////////////	
				
				$this->session->set_flashdata('result_withdrawale', 'Withdrawal success');
				redirect(base_url().'withdrawal/eregister');
			
				
			}
			$this->load->view('include/template',$d);
			
		}else{
		  header('location:'.base_url());
		}
	}
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
