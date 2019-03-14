<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('data_model');	
		$this->load->model('bonus_model');			
    }
  
	public function index()
	{
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		if(!empty($user_session)){	
		  $cari = $this->input->post('txt_cari');
		  $d['cari'] = $cari;
		  if($this->input->post('dc')<>"" OR $this->input->post('dc2')<>""){
			$dtfrom = $this->input->post('dc').' 00:00:00';
			$dtto = $this->input->post('dc2').' 23:59:59';
			$d['dc'] = $this->input->post('dc');
			$d['dc2'] = $this->input->post('dc2');
			$dc = $this->input->post('dc');
			$dc2 = $this->input->post('dc2');
		  } else {
			if($this->input->get('dc')<>"" OR $this->input->get('dc2')<>""){
				$dtfrom = $this->input->get('dc').' 00:00:00';
				 $dtto = $this->input->get('dc2').' 23:59:59';
				 $d['dc'] = $this->input->get('dc');
				 $d['dc2'] = $this->input->get('dc2');
				 $dc = $this->input->get('dc');
				$dc2 = $this->input->get('dc2');
			} else {
				 $dtfrom = date('Y-m').'-01 00:00:00';
				 $dtto = date('Y-m-t').' 23:59:59';
				 $d['dc'] = date('Y-m').'-01';
				 $d['dc2'] = date('Y-m-t');
				 $dc = date('Y-m').'-01';
				 $dc2 = date('Y-m-t');
			}
		  }
		  
		  $d['dtfrom'] = $dtfrom;
		  $d['dtto'] = $dtto;
		  
		  $d['page_title']="History Transfer Komisi";

		  $d['lst_transfer'] = $this->db->query("SELECT * FROM tb_withdrawal WHERE username='$user_session' ORDER BY id ASC");
		  

		 $d['content']= $this->load->view('history/transfer_komisi',$d,true);
		 $this->load->view('include/template',$d);
		}else{
		  header('location:'.base_url());
		}
	}
  
	public function eregister()
	{
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		if(!empty($user_session)){	
		  $cari = $this->input->post('txt_cari');
		  $d['cari'] = $cari;
		  if($this->input->post('dc')<>"" OR $this->input->post('dc2')<>""){
			$dtfrom = $this->input->post('dc').' 00:00:00';
			$dtto = $this->input->post('dc2').' 23:59:59';
			$d['dc'] = $this->input->post('dc');
			$d['dc2'] = $this->input->post('dc2');
			$dc = $this->input->post('dc');
			$dc2 = $this->input->post('dc2');
		  } else {
			if($this->input->get('dc')<>"" OR $this->input->get('dc2')<>""){
				$dtfrom = $this->input->get('dc').' 00:00:00';
				 $dtto = $this->input->get('dc2').' 23:59:59';
				 $d['dc'] = $this->input->get('dc');
				 $d['dc2'] = $this->input->get('dc2');
				 $dc = $this->input->get('dc');
				$dc2 = $this->input->get('dc2');
			} else {
				 $dtfrom = date('Y-m').'-01 00:00:00';
				 $dtto = date('Y-m-t').' 23:59:59';
				 $d['dc'] = date('Y-m').'-01';
				 $d['dc2'] = date('Y-m-t');
				 $dc = date('Y-m').'-01';
				 $dc2 = date('Y-m-t');
			}
		  }
		  
		  $d['dtfrom'] = $dtfrom;
		  $d['dtto'] = $dtto;
		  
		  $d['page_title']="History Transfer E-Register";

		  $d['lst_transfer'] = $this->db->query("SELECT * FROM tb_withdrawal WHERE username='$user_session' AND jenis='eregister' ORDER BY id ASC");
		  

		 $d['content']= $this->load->view('history/transfer_eregister',$d,true);
		 $this->load->view('include/template',$d);
		}else{
		  header('location:'.base_url());
		}
	}
	
	public function upgrade()
	{
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		if(!empty($user_session)){	
		  $cari = $this->input->post('txt_cari');
		  $d['cari'] = $cari;
		  if($this->input->post('dc')<>"" OR $this->input->post('dc2')<>""){
			$dtfrom = $this->input->post('dc').' 00:00:00';
			$dtto = $this->input->post('dc2').' 23:59:59';
			$d['dc'] = $this->input->post('dc');
			$d['dc2'] = $this->input->post('dc2');
			$dc = $this->input->post('dc');
			$dc2 = $this->input->post('dc2');
		  } else {
			if($this->input->get('dc')<>"" OR $this->input->get('dc2')<>""){
				$dtfrom = $this->input->get('dc').' 00:00:00';
				 $dtto = $this->input->get('dc2').' 23:59:59';
				 $d['dc'] = $this->input->get('dc');
				 $d['dc2'] = $this->input->get('dc2');
				 $dc = $this->input->get('dc');
				$dc2 = $this->input->get('dc2');
			} else {
				 $dtfrom = date('Y-m').'-01 00:00:00';
				 $dtto = date('Y-m-t').' 23:59:59';
				 $d['dc'] = date('Y-m').'-01';
				 $d['dc2'] = date('Y-m-t');
				 $dc = date('Y-m').'-01';
				 $dc2 = date('Y-m-t');
			}
		  }
		  
		  $d['dtfrom'] = $dtfrom;
		  $d['dtto'] = $dtto;
		  
		  $d['page_title']="Data Upgrade Paket";

		  $d['lst_upgrade'] = $this->db->query("SELECT * FROM tb_roi WHERE username='$user_session' AND jenis='paid' ORDER BY id ASC");
		  

		 $d['content']= $this->load->view('history/upgrade_paket',$d,true);
		 $this->load->view('include/template',$d);
		}else{
		  header('location:'.base_url());
		}
	}

}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
