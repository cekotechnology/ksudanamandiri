<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deposit extends CI_Controller {

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
		$nama = $this->data_model->dataku("nama",$user_session);
		$d['user_session'] = $user_session;
		$d['page_title'] = "Request Saldo E-Register";	
		
		$text = "SELECT * FROM paket WHERE status=1 AND code>=1 ORDER BY urutan";
		$d['lst_pkg'] = $this->db->query($text);
			
		$text = "SELECT * FROM deposit_rekening WHERE status=1 ORDER BY urutan";
		$d['lst_rekening'] = $this->db->query($text);
		
		$text = "SELECT * FROM deposit_request WHERE username='$user_session'";
		$d['lst_request'] = $this->db->query($text);
		
		if(!empty($user_session)){	
			$this->form_validation->set_rules('nominal', 'Nominal', 'required');
			$this->form_validation->set_rules('bank', 'Bank', 'required');
		
			$nominal = $this->input->post('nominal',TRUE);
			$id_bank_tujuan = $this->input->post('bank',TRUE);
			$d['nominal'] = $nominal;
			$d['bank'] = $id_bank_tujuan;
			
			if($this->form_validation->run() == FALSE){
				
				$this->session->set_flashdata('result_deposit', 'Silakan lengkapi formulir');
				$d['content']= $this->load->view('deposit/request',$d,true);			
				$this->load->view('include/template',$d);
			}else{	
				$tgl = date('Y-m-d');
				//cek nominal deposit sama
				$text = "SELECT * FROM  deposit_request WHERE username='$user_session' AND nominal_request='$nominal' AND tgl_request LIKE '$tgl%' AND status=0";
				$cek_dep = $this->db->query($text);
				if($cek_dep->num_rows > 0){
					$this->session->set_flashdata('result_deposit', 'Request deposit gagal. Anda masih memiliki request deposit pending dengan nominal yang sama');
					$d['content']= $this->load->view('deposit/request',$d,true);	
					$this->load->view('include/template',$d);					
				} else {
					$angka_unik = $this->data_model->dataku("id",$user_session);
					$text = "SELECT * FROM deposit_rekening WHERE id='$id_bank_tujuan'";
					$sql = $this->db->query($text);
					foreach($sql->result_array() as $db){
						$tujuan_bank = $db['bank'];
						$tujuan_norek = $db['norek'];
						$tujuan_namarek = $db['namarek'];
					}
					//cek
					
					$kode_trx = $this->app_model->randomPassword(5);
					$nominal_unik = $nominal+$angka_unik;
					$data['username'] = $user_session;
					$data['nominal_request'] = $nominal;
					$data['nominal_unik'] = $nominal+$angka_unik;
					$data['tujuan_bank'] = $tujuan_bank;
					$data['tujuan_norek'] = $tujuan_norek;
					$data['tujuan_namarek'] = $tujuan_namarek;
					$data['tgl_request'] = date('Y-m-d H:i:s');
					$data['status'] = 0;
					$data['kode_transfer'] = $kode_trx;
					$result = $this->db->insert('deposit_request',$data);
					
					//Message
					$message_web = "Order saldo E-Register Rp $nominal. Silakan transfer Rp $nominal_unik ke:<br />
					Bank $tujuan_bank <br />
					No Rek. $tujuan_norek <br />
					a/n $tujuan_namarek, 
					kode trx $kode_trx, berlaku 1 hari.";
					//
					
					//Message SMS
					$message_sms = "Order saldo E-Register Rp $nominal. Silakan transfer Rp $nominal_unik via 
					Bank $tujuan_bank No Rek. $tujuan_norek a/n $tujuan_namarek, kode trx $kode_trx, berlaku 1 hari.";
					//
					
					//KIRIM SMS
				
					$datasms['out_starttime'] = date('Y-m-d H:i:s');
					$datasms['out_hpnumber'] = $user_session;
					$datasms['provider'] = 'XL';
					$datasms['out_message'] = $message_sms;
					$datasms['tipe'] = 'SMS';
					$this->app_model->insertData("outbox",$datasms);
					
					//Message SMS
					$message_smse = "Permintaan request saldo E-Register  Rp $nominal_unik dari id:$user_session via 
					Bank $tujuan_bank No Rek. $tujuan_norek a/n $tujuan_namarek, kode trx $kode_trx, berlaku 1 hari.";
					//
					
					//KIRIM KE PAK RIO SMS
				
					$datasmse['out_starttime'] = date('Y-m-d H:i:s');
					$datasmse['out_hpnumber'] = '6281282787878';
					$datasmse['provider'] = 'XL';
					$datasmse['out_message'] = $message_smse;
					$datasmse['tipe'] = 'SMS';
					$this->app_model->insertData("outbox",$datasmse);
					
					//END OF SMS
					
					$this->session->set_flashdata('result_deposite', 'Request Deposit berhasil!!');
					$this->session->set_flashdata('result_depositee', $message_web);
					redirect(base_url().'deposit');	
				}
			}
		 
			
		}else{
		  header('location:'.base_url());
		}
	}
  
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
