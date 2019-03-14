<?php

if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class Ewalet extends CI_Controller {

 public function __construct() {
  parent::__construct();
  $this->load->model('data_model');
  $this->load->model('bonus_model');
  $this->load->model('network_model');
  $this->load->model('ewalet_model');
 }

 public function index() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $cari      = $this->input->post('txt_cari', TRUE);
   $d['cari'] = $cari;
   if ($this->input->post('dc', TRUE) <> "" OR $this->input->post('dc2', TRUE) <> "") {
    $dtfrom   = $this->input->post('dc', TRUE) . ' 00:00:00';
    $dtto     = $this->input->post('dc2', TRUE) . ' 23:59:59';
    $d['dc']  = $this->input->post('dc', TRUE);
    $d['dc2'] = $this->input->post('dc2', TRUE);
    $dc       = $this->input->post('dc', TRUE);
    $dc2      = $this->input->post('dc2', TRUE);
   } else {
    if ($this->input->get('dc', TRUE) <> "" OR $this->input->get('dc2', TRUE) <> "") {
     $dtfrom   = $this->input->get('dc', TRUE) . ' 00:00:00';
     $dtto     = $this->input->get('dc2', TRUE) . ' 23:59:59';
     $d['dc']  = $this->input->get('dc', TRUE);
     $d['dc2'] = $this->input->get('dc2', TRUE);
     $dc       = $this->input->get('dc', TRUE);
     $dc2      = $this->input->get('dc2', TRUE);
    } else {
     /*
       $dtfrom = date('Y-m').'-01 00:00:00';
       $dtto = date('Y-m-t').' 23:59:59';
       $d['dc'] = date('Y-m').'-01';
       $d['dc2'] = date('Y-m-t');
       $dc = date('Y-m').'-01';
       $dc2 = date('Y-m-t');
      */
     $dtfrom   = '2018-10-01 00:00:00';
     $dtto     = date('Y-m-t') . ' 23:59:59';
     $d['dc']  = '2018-10-01';
     $d['dc2'] = date('Y-m-t');
     $dc       = '2018-10-01';
     $dc2      = date('Y-m-t');
    }
   }

   $d['dtfrom'] = $dtfrom;
   $d['dtto']   = $dtto;

   $d['page_title'] = "Ewalet Transaction History";

   $d['lst_ewalet'] = $this->db->query("SELECT *
    FROM dataewalet
    WHERE username='$user_session'
     AND (tgl BETWEEN '$dtfrom' AND '$dtto') ORDER BY id asc");



   $d['content'] = $this->load->view('ewalet/history_ewalet', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url());
  }
 }

 public function register() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $cari      = $this->input->post('txt_cari', TRUE);
   $d['cari'] = $cari;
   if ($this->input->post('dc', TRUE) <> "" OR $this->input->post('dc2', TRUE) <> "") {
    $dtfrom   = $this->input->post('dc', TRUE) . ' 00:00:00';
    $dtto     = $this->input->post('dc2', TRUE) . ' 23:59:59';
    $d['dc']  = $this->input->post('dc', TRUE);
    $d['dc2'] = $this->input->post('dc2', TRUE);
    $dc       = $this->input->post('dc', TRUE);
    $dc2      = $this->input->post('dc2', TRUE);
   } else {
    if ($this->input->get('dc', TRUE) <> "" OR $this->input->get('dc2', TRUE) <> "") {
     $dtfrom   = $this->input->get('dc', TRUE) . ' 00:00:00';
     $dtto     = $this->input->get('dc2', TRUE) . ' 23:59:59';
     $d['dc']  = $this->input->get('dc', TRUE);
     $d['dc2'] = $this->input->get('dc2', TRUE);
     $dc       = $this->input->get('dc', TRUE);
     $dc2      = $this->input->get('dc2', TRUE);
    } else {
     $dtfrom   = date('Y-m') . '-01 00:00:00';
     $dtto     = date('Y-m-t') . ' 23:59:59';
     $d['dc']  = date('Y-m') . '-01';
     $d['dc2'] = date('Y-m-t');
     $dc       = date('Y-m') . '-01';
     $dc2      = date('Y-m-t');
    }
   }

   $d['dtfrom'] = $dtfrom;
   $d['dtto']   = $dtto;

   $d['page_title'] = "Ewalet Transaction History";

   $d['lst_eregister'] = $this->db->query("SELECT * FROM dataeregister WHERE username='$user_session' AND (tgl BETWEEN '$dtfrom' AND '$dtto') ORDER BY id");



   $d['content'] = $this->load->view('ewalet/history_eregister', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url());
  }
 }

 public function transfer_saldo() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  $jumlah            = $this->input->post('jumlah', TRUE);
  if ($user_session) {

   if ($this->ewalet_model->myewaletdone($user_session, "") >= $jumlah) {

    $d['page_title'] = "Transfer Saldo E-Wallet";

    $this->form_validation->set_rules('id_tujuan', 'Id Tujuan', 'trim|required|xss_clean');
    $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|xss_clean');
    $this->form_validation->set_rules('passw', 'Password', 'trim|required|xss_clean');

    if ($this->form_validation->run() == FALSE) {
     $d['id_tujuan'] = $this->input->post('id_tujuan', TRUE);
     $d['jumlah']    = $this->input->post('jumlah', TRUE);
     $d['passw']     = $this->input->post('passw', TRUE);
     $d['content']   = $this->load->view('ewalet-register/request', $d, true);
     $this->load->view('include/template', $d);
    } else {
     $id_tujuan = $this->input->post('id_tujuan', TRUE);
     $sq_tujuan = $this->db->query("SELECT * FROM member WHERE username='$id_tujuan'");
     if ($sq_tujuan->num_rows() == 0) {
      echo "Id tujuan tidak ditemukan";
      $this->session->set_flashdata('error', 'Id tujuan tidak ditemukan');
      redirect(base_url() . 'ewalet/transfer_saldo');
     } else {
      $passw   = md5($this->input->post('passw', TRUE));
      $sq_pass = $this->db->query("SELECT * FROM member WHERE username='$user_session' AND pass='$passw'");
      if ($sq_pass->num_rows() == 0) {
       //echo "Passwo";
       $this->session->set_flashdata('error', 'Invalid password');
       redirect(base_url() . 'ewalet/transfer_saldo');
      } else {
       $id_tujuan        = $this->input->post('id_tujuan', TRUE);
       $d['id_tujuan']   = $id_tujuan;
       $d['nama_tujuan'] = $this->data_model->dataku("nama", $id_tujuan);
       $d['jumlah']      = $this->input->post('jumlah', TRUE);
       $d['passw']       = $this->input->post('passw', TRUE);
       $d['content']     = $this->load->view('ewalet-register/confirmation', $d, true);
       $this->load->view('include/template', $d);
      }
     }
    }
   } else {

    $this->session->set_flashdata('error', 'Saldo anda tidak cukup untuk melakukan transaksi ini');
    redirect(base_url() . 'ewalet/transfer_saldo');
   }
  } else {
   header('location:' . base_url());
  }
 }

 public function transfer_saldo_save() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if ($user_session) {
   $passw   = md5($this->input->post('passw'));
   $sq_pass = $this->db->query("SELECT * FROM member WHERE username='$user_session' AND pass='$passw'");
   if ($sq_pass->num_rows() > 0) {
    $jumlah = $this->input->post('jumlah', TRUE);

    if ($this->ewalet_model->myewaletdone($user_session, "") >= $jumlah) {
     $id_tujuan         = $this->input->post('id_tujuan');
     $get_member_tujuan = $this->db->query("SELECT * FROM member WHERE username='$id_tujuan' limit 1")->row();


     $dari['username'] = $user_session;
     $dari['jumlah']   = $jumlah;
     $dari['uraian']   = 'Transfer saldo ke id: ' . $id_tujuan . ' (' . $get_member_tujuan->nama . ')';
     $dari['tgl']      = date('Y-m-d H:i:s');
     $dari['status']   = 1;
     $dari['jenis']    = 'debit';
     $this->db->insert('dataewalet', $dari);

     $get_member         = $this->db->query("SELECT * FROM member WHERE username='$user_session' limit 1")->row();
     $kepada['username'] = $this->input->post('id_tujuan');
     $kepada['jumlah']   = $this->input->post('jumlah');
     $kepada['uraian']   = 'Terima saldo e-walet dari id:' . $user_session . ' (' . $get_member->nama . ')';
     $kepada['tgl']      = date('Y-m-d H:i:s');
     $kepada['status']   = 1;
     $kepada['jenis']    = 'kredit';
     $this->db->insert('dataewalet', $kepada);
     $this->session->set_flashdata('success', 'Pengiriman saldo e-register berhasil');
     redirect(base_url() . 'ewalet/index');
    } else {
     $this->session->set_flashdata('error', 'Saldo anda tidak cukup untuk melakukan transaksi ini');
     redirect(base_url() . 'ewalet/transfer_saldo');
    }
   } else {
    $this->session->set_flashdata('error', 'Invalid password');
    redirect(base_url() . 'ewalet/transfer_saldo');
   }
  } else {
   header('location:' . base_url());
  }
 }

}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
