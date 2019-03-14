<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bonus extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('data_model');	
		$this->load->model('bonus_model');		
		$this->load->model('network_model');			
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
	  
      $d['page_title']="Bonus Summary";

      $d['lst_bonus_sponsor'] = $this->db->query("SELECT * FROM komisi WHERE jenis LIKE 'komsponsor%' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	  
	  $d['lst_bonus_pairing'] = $this->db->query("SELECT * FROM komisi WHERE jenis='kompasangan' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	  
	  $d['lst_bonus_unilevel'] = $this->db->query("SELECT * FROM komisi WHERE jenis LIKE 'komlev%' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	  
	  $d['lst_bonus_roi'] = $this->db->query("SELECT * FROM komisi WHERE jenis='komroi' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	  
	  $d['lst_bonus_leadership'] = $this->db->query("SELECT * FROM komisi WHERE jenis LIKE 'kom_matching%' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	  
	  $d['lst_bonus_monoleg'] = $this->db->query("SELECT * FROM komisi WHERE jenis LIKE 'kom_monoleg%' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	
     $d['content']= $this->load->view('bonus/bonus_summary',$d,true);
	 $this->load->view('include/template',$d);
    }else{
      header('location:'.base_url());
    }
  }
  
  public function sponsor()
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
	  
     

      $d['page_title']="Bonus Sponsor";

      $d['lst_bonus_sponsor'] = $this->db->query("SELECT * FROM komisi WHERE jenis LIKE 'kom_bonustabungan%' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	
     $d['content']= $this->load->view('bonus/bonus_sponsor',$d,true);
	 $this->load->view('include/template',$d);
    }else{
      header('location:'.base_url());
    }
  }
  
  public function development()
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
	  
     

      $d['page_title']="Bonus Development";

      $d['lst_bonus_development'] = $this->db->query("SELECT * FROM komisi WHERE jenis LIKE 'komlev%' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	
     $d['content']= $this->load->view('bonus/bonus_development',$d,true);
	 $this->load->view('include/template',$d);
    }else{
      header('location:'.base_url());
    }
  }
  
  public function personal()
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
	  
     

      $d['page_title']="Bonus Personal";

      $d['lst_bonus_personal'] = $this->db->query("SELECT * FROM komisi WHERE jenis = 'kom_bungatabungan' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	
     $d['content']= $this->load->view('bonus/bonus_personal',$d,true);
	 $this->load->view('include/template',$d);
    }else{
      header('location:'.base_url());
    }
  }
  
  public function pairing()
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
	  
     

      $d['page_title']="Bonus Pasangan";

      $d['lst_bonus_pairing'] = $this->db->query("SELECT * FROM komisi WHERE jenis='kompasangan' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	
     $d['content']= $this->load->view('bonus/bonus_pairing',$d,true);
	 $this->load->view('include/template',$d);
    }else{
      header('location:'.base_url());
    }
  }
  
  public function level()
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
	  
     

      $d['page_title']="Bonus Level";

      $d['lst_bonus_unilvel'] = $this->db->query("SELECT * FROM komisi WHERE jenis LIKE 'komlev%' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	
     $d['content']= $this->load->view('bonus/bonus_level',$d,true);
	 $this->load->view('include/template',$d);
    }else{
      header('location:'.base_url());
    }
  }
 
  public function unilevel()
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
	  
     

      $d['page_title']="Bonus Unilevel";

      $d['lst_bonus_unilvel'] = $this->db->query("SELECT * FROM komisi WHERE jenis LIKE 'komjual%' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	
     $d['content']= $this->load->view('bonus/bonus_unilevel',$d,true);
	 $this->load->view('include/template',$d);
    }else{
      header('location:'.base_url());
    }
  }
 
  public function roi()
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
	  
     

      $d['page_title']="Bonus Sharing Profit";

      $d['lst_bonus_roi'] = $this->db->query("SELECT * FROM komisi WHERE jenis='komroi' AND username='$user_session' AND (tglbayar BETWEEN '$dtfrom' AND '$dtto') ORDER BY tglbayar");
	
     $d['content']= $this->load->view('bonus/bonus_roi',$d,true);
	 $this->load->view('include/template',$d);
    }else{
      header('location:'.base_url());
    }
  }
  
  public function reward()
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

      $d['page_title']="Bonus Reward";
		$mki = $this->network_model->hitung_omzet_reward($user_session, "KIRI", "");
		$mka = $this->network_model->hitung_omzet_reward($user_session, "KANAN", "");
		
		$d['mki'] = $mki;
		$d['mka'] = $mka;
		if($mki<$mka){
			$mk	= $mki;	
		} else {
			$mk	= $mka;
		}
		$rank = explode("|", $this->data_model->config("komreward"));
		$d['st_rwd_1'] = $this->app_model->count_records("tb_redeem","WHERE username='$user_session' AND kode_reward='1'");
		$d['st_rwd_2'] = $this->app_model->count_records("tb_redeem","WHERE username='$user_session' AND kode_reward='2'");
		$d['st_rwd_3'] = $this->app_model->count_records("tb_redeem","WHERE username='$user_session' AND kode_reward='3'");
		$d['st_rwd_4'] = $this->app_model->count_records("tb_redeem","WHERE username='$user_session' AND kode_reward='4'");
		$d['st_rwd_5'] = $this->app_model->count_records("tb_redeem","WHERE username='$user_session' AND kode_reward='5'");
		$d['st_rwd_6'] = $this->app_model->count_records("tb_redeem","WHERE username='$user_session' AND kode_reward='6'");
		$d['st_rwd_7'] = $this->app_model->count_records("tb_redeem","WHERE username='$user_session' AND kode_reward='7'");
		$d['st_rwd_8'] = $this->app_model->count_records("tb_redeem","WHERE username='$user_session' AND kode_reward='8'");
		$d['st_rwd_9'] = $this->app_model->count_records("tb_redeem","WHERE username='$user_session' AND kode_reward='9'");
		$d['st_rwd_10'] = $this->app_model->count_records("tb_redeem","WHERE username='$user_session' AND kode_reward='10'");
		
		$syarat1 = trim($rank[0]);
		$syarat2 = trim($rank[3]);
		$syarat3 = trim($rank[6]);
		$syarat4 = trim($rank[9]);
		$syarat5 = trim($rank[12]);
		$syarat6 = trim($rank[15]);
		$syarat7 = trim($rank[18]);
		$syarat8 = trim($rank[21]);
		$syarat9 = trim($rank[24]);
		$syarat10 = trim($rank[27]);
		
		$d['syarat1'] = $syarat1;
		$d['syarat2'] = $syarat2;
		$d['syarat3'] = $syarat3;
		$d['syarat4'] = $syarat4;
		$d['syarat5'] = $syarat5;
		$d['syarat6'] = $syarat6;
		$d['syarat7'] = $syarat7;
		$d['syarat8'] = $syarat8;
		$d['syarat9'] = $syarat9;
		$d['syarat10'] = $syarat10;
		
		$d['nilai_reward1'] = $rank[1];
		$d['nilai_reward2'] = $rank[4];
		$d['nilai_reward3'] = $rank[7];
		$d['nilai_reward4'] = $rank[10];
		$d['nilai_reward5'] = $rank[13];
		$d['nilai_reward6'] = $rank[16];
		$d['nilai_reward7'] = $rank[19];
		$d['nilai_reward8'] = $rank[22];
		$d['nilai_reward9'] = $rank[25];
		$d['nilai_reward10'] = $rank[28];
		
		$d['nama_reward1'] = $rank[2];
		$d['nama_reward2'] = $rank[5];
		$d['nama_reward3'] = $rank[8];
		$d['nama_reward4'] = $rank[11];
		$d['nama_reward5'] = $rank[14];
		$d['nama_reward6'] = $rank[17];
		$d['nama_reward7'] = $rank[20];
		$d['nama_reward8'] = $rank[23];
		$d['nama_reward9'] = $rank[26];
		$d['nama_reward10'] = $rank[29];
		
		$d['nama_file_reward1'] = "reward1.png";
		$d['nama_file_reward2'] = "reward2.png";
		$d['nama_file_reward3'] = "reward3.png";
		$d['nama_file_reward4'] = "reward4.png";
		$d['nama_file_reward5'] = "reward5.png";
		$d['nama_file_reward6'] = "reward6.png";
		$d['nama_file_reward7'] = "reward7.png";
		$d['nama_file_reward8'] = "reward8.png";
		$d['nama_file_reward9'] = "reward9.png";
		$d['nama_file_reward10'] = "reward10.png";
		
		if($mk >= $syarat1) { 
			$d['status_reward1'] = "Sudah Dicapai";
		} else {
			$d['status_reward1'] = "Belum Dicapai";
		}
		
		if($mk >= $syarat2) { 
			$d['status_reward2'] = "Sudah Dicapai";
		} else {
			$d['status_reward2'] = "Belum Dicapai";
		}
		
		if($mk >= $syarat3) { 
			$d['status_reward3'] = "Sudah Dicapai";
		} else {
			$d['status_reward3'] = "Belum Dicapai";
		}
		
		if($mk >= $syarat4) { 
			$d['status_reward4'] = "Sudah Dicapai";
		} else {
			$d['status_reward4'] = "Belum Dicapai";
		}
		
		if($mk >= $syarat5) { 
			$d['status_reward5'] = "Sudah Dicapai";
		} else {
			$d['status_reward5'] = "Belum Dicapai";
		}
		
		if($mk >= $syarat6) { 
			$d['status_reward6'] = "Sudah Dicapai";
		} else {
			$d['status_reward6'] = "Belum Dicapai";
		}
		
		if($mk >= $syarat7) { 
			$d['status_reward7'] = "Sudah Dicapai";
		} else {
			$d['status_reward7'] = "Belum Dicapai";
		}
		
		if($mk >= $syarat8) { 
			$d['status_reward8'] = "Sudah Dicapai";
		} else {
			$d['status_reward8'] = "Belum Dicapai";
		}
		
		if($mk >= $syarat9) { 
			$d['status_reward9'] = "Sudah Dicapai";
		} else {
			$d['status_reward9'] = "Belum Dicapai";
		}
		
		if($mk >= $syarat10) { 
			$d['status_reward10'] = "Sudah Dicapai";
		} else {
			$d['status_reward10'] = "Belum Dicapai";
		}
	
     $d['content']= $this->load->view('bonus/bonus_reward',$d,true);
	 $this->load->view('include/template',$d);
    }else{
      header('location:'.base_url());
    }
  }
 
  
 
  public function excel()
  {
    $cek = $this->session->userdata('logged_in');
    if(!empty($cek)){
		
		$cari = $this->input->post('txt_cari');
	  $d['cari'] = $cari;
	  if($this->input->post('dc')<>"" OR $this->input->post('dc2')<>""){
		$dtfrom = $this->input->post('dc').' 00:00:00';
		$dtto = $this->input->post('dc2').' 23:59:59';
		$d['dc'] = $this->input->post('dc');
		$d['dc2'] = $this->input->post('dc2');
	  } else {
		 $dtfrom = date('Y-m-d').' 00:00:00';
		 $dtto = date('Y-m-d').' 23:59:59';
		 $d['dc'] = date('Y-m-d');
		$d['dc2'] = date('Y-m-d');
	  }
	  
      if(empty($cari)){
        $where = " WHERE created_date BETWEEN '$dtfrom' AND '$dtto'";
      }else{
        $where = " WHERE created_date BETWEEN '$dtfrom' AND '$dtto' AND (fullname LIKE '%$cari%' OR email LIKE '%$cari%' OR nohp LIKE '%$cari%')";
      }
		
		
		$query = "SELECT fullname, email, nohp, company_name, selling_price, status_win, created_date as tgl FROM booking_transaction $where";
		$header = '';
		$data ='';

		$export = mysql_query ($query ) or die ( "Sql error : " . mysql_error( ) );
		$fields = mysql_num_fields ( $export );

		for ( $i = 0; $i < $fields; $i++ )
		{
			$header .= mysql_field_name( $export , $i ) . "\t";
		}

		while( $row = mysql_fetch_row( $export ) )
		{
			$line = '';
			foreach( $row as $value )
			{                                            
				if ( ( !isset( $value ) ) || ( $value == "" ) )
				{
					$value = "\t";
				}
				else
				{
					$value = str_replace( '"' , '""' , $value );
					$value = '"' . $value . '"' . "\t";
				}
				$line .= $value;
			}
			$data .= trim( $line ) . "\n";
		}
		$data = str_replace( "\r" , "" , $data );

		if ( $data == "" )
		{
			$data = "\nNo Record(s) Found!\n";                        
		}

		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=list_customer_all.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		print "$header\n$data";
    }else{
      header('location:'.base_url());
    }
  }
  
  

  public function tambah()
  {
    $cek = $this->session->userdata('logged_in');
    if(!empty($cek)){
      $d['prg']= $this->config->item('prg');
      $d['web_prg']= $this->config->item('web_prg');

      $d['nama_program']= $this->config->item('nama_program');
      $d['instansi']= $this->config->item('instansi');
      $d['usaha']= $this->config->item('usaha');
      $d['alamat_instansi']= $this->config->item('alamat_instansi');

      $d['judul']="SBC Visitor";



      $d['content'] = $this->load->view('customer/form', $d, true);
      $this->load->view('home',$d);
    }else{
      header('location:'.base_url());
    }
  }
  

  public function edit()
  {
    $cek = $this->session->userdata('logged_in');
    if(!empty($cek)){
      /*
      $d['prg']= $this->config->item('prg');
      $d['web_prg']= $this->config->item('web_prg');

      $d['nama_program']= $this->config->item('nama_program');
      $d['instansi']= $this->config->item('instansi');
      $d['alamat_instansi']= $this->config->item('alamat_instansi');

      $d['judul'] = "Surat Perintah";
      $d['message'] = '';
      */

      $id = $this->input->post('id');  //$this->uri->segment(3);
      $text = "SELECT * FROM member WHERE id='$id'";
      $data = $this->app_model->manualQuery($text);
      //if($data->num_rows() > 0){
        foreach($data->result() as $db){
		  $d['username']	= $db->username;
		  $d['pass']		= $db->pass;
          $d['nama']		= $db->nama;
          $d['sponsor']	= $db->sponsor;
		  $d['upline']	= $db->upline;
		  $d['email']	= $db->email;
          $d['tglahir']	= $db->tglahir;
		  $d['kelamin']	= $db->kelamin;
		  $d['ktp']	= $db->ktp;
		  $d['alamat']	= $db->alamat;
		  $d['kota']	= $db->kota;
		  $d['propinsi']	= $db->propinsi;
		  $d['kodepos']	= $db->kodepos;
		  $d['phone']	= $db->phone;
		  $d['hp']	= $db->hp;
		  $d['bank']	= $db->bank;
		  $d['norek']	= $db->norek;
		  $d['namarek']	= $db->namarek;
		  $d['adminrp']	= $db->adminrp;
		 
          echo json_encode($d);
        }
      //}

      //$d['content'] = $this->load->view('rekening/tambah', $d, true);
      //$this->load->view('home',$d);
    }else{
      header('location:'.base_url());
    }
  }

  public function hapus()
  {
    $cek = $this->session->userdata('logged_in');
    if(!empty($cek)){
      $id = $this->uri->segment(3);
      $this->app_model->manualQuery("DELETE FROM booking_transaction WHERE id_booking='$id'");
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/customer'>";
    }else{
      header('location:'.base_url());
    }
  }

  public function simpan()
  {

    $cek = $this->session->userdata('logged_in');
    if(!empty($cek)){

		
		$up['username']	= $this->input->post('username');
		$up['pass']= $this->input->post('pass');
		$up['nama']= $this->input->post('nama');
		$up['sponsor'] = $this->input->post('sponsor');
		$up['upline'] = $this->input->post('upline');
		$up['email'] = $this->input->post('email');
		$up['tglahir'] = $this->input->post('tglahir');
		$up['kelamin'] = $this->input->post('kelamin');
		$up['ktp'] = $this->input->post('ktp');
		$up['alamat'] = $this->input->post('alamat');
		$up['kota'] = $this->input->post('kota');
		$up['propinsi'] = $this->input->post('propinsi');
		$up['kodepos'] = $this->input->post('kodepos');
		$up['phone'] = $this->input->post('phone');
		$up['hp'] = $this->input->post('hp');
		$up['bank'] = $this->input->post('bank');
		$up['norek'] = $this->input->post('norek');
		$up['namarek'] = $this->input->post('namarek');
		
		$id['id'] = $this->input->post('id');
        ///insert record
		$data = $this->app_model->getSelectedData("member",$id);
        if($data->num_rows()>0){
          $this->app_model->updateData("member",$up,$id);
          echo 'Update data Success';
        }else{
         // $this->app_model->insertData("member",$up);
         // echo 'Simpan data Success';
        }
    }else{
        header('location:'.base_url());
    }

  }

}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
