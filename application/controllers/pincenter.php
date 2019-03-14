<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pincenter extends CI_Controller {

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
	  
      $d['page_title']="Stock Pin";

      $d['lst_pin_upgrade'] = $this->db->query("SELECT * FROM carde WHERE belong='$user_session' AND (created_date BETWEEN '$dtfrom' AND '$dtto') ORDER BY id");
	  
	  $d['lst_pin_register'] = $this->db->query("SELECT * FROM card WHERE belong='$user_session' AND (created_date BETWEEN '$dtfrom' AND '$dtto') ORDER BY id");
	  
	  
	
     $d['content']= $this->load->view('pincenter/list_pin',$d,true);
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
	  
      $d['page_title']="Stock Pin";

      $d['lst_pin_upgrade'] = $this->db->query("SELECT * FROM carde WHERE belong='$user_session' AND (created_date BETWEEN '$dtfrom' AND '$dtto') ORDER BY id");
	  
	  $d['lst_pin_register'] = $this->db->query("SELECT * FROM card WHERE belong='$user_session' AND (created_date BETWEEN '$dtfrom' AND '$dtto') ORDER BY id");
	  
	  
	
     $d['content']= $this->load->view('pincenter/list_pin_upgrade',$d,true);
	 $this->load->view('include/template',$d);
    }else{
      header('location:'.base_url());
    }
  }
  
  public function transfer()
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
	  
	  $serial = $this->input->get('serial', true);
	  
	  $d['dtfrom'] = $dtfrom;
	  $d['dtto'] = $dtto;
	  $d['serial'] = $serial;
	  
      $d['page_title']="Pin Transfer";
        
      
	
     $d['content']= $this->load->view('pincenter/form_transfer',$d,true);
	 $this->load->view('include/template',$d);
    }else{
      header('location:'.base_url());
    }
  }
  
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
