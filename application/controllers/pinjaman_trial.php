<?php

if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class Pinjaman_trial extends CI_Controller {

 public function __construct() {
  parent::__construct();
  $this->load->model('data_model');
  $this->load->model('bonus_model');
  $this->load->model('config_model');
 }

 public function history_pinjaman() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $cari      = $this->input->post('txt_cari');
   $d['cari'] = $cari;
   if ($this->input->post('dc') <> "" OR $this->input->post('dc2') <> "") {
    $dtfrom   = $this->input->post('dc') . ' 00:00:00';
    $dtto     = $this->input->post('dc2') . ' 23:59:59';
    $d['dc']  = $this->input->post('dc');
    $d['dc2'] = $this->input->post('dc2');
    $dc       = $this->input->post('dc');
    $dc2      = $this->input->post('dc2');
   } else {
    if ($this->input->get('dc') <> "" OR $this->input->get('dc2') <> "") {
     $dtfrom   = $this->input->get('dc') . ' 00:00:00';
     $dtto     = $this->input->get('dc2') . ' 23:59:59';
     $d['dc']  = $this->input->get('dc');
     $d['dc2'] = $this->input->get('dc2');
     $dc       = $this->input->get('dc');
     $dc2      = $this->input->get('dc2');
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

   $d['page_title'] = "History Pinjaman Anggota";

//   $d['lst_pinjaman'] = $this->db->query("SELECT * FROM pinjaman_header WHERE user_id='$user_session' AND status = 'DITERIMA' ORDER BY id_pinjam ASC");

  $d['content'] = $this->load->view('pinjaman/history_pinjaman', $d, true);
  $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url());
  }
 }

 public function history_pinjamanvr() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $cari      = $this->input->post('txt_cari');
   $d['cari'] = $cari;
   if ($this->input->post('dc') <> "" OR $this->input->post('dc2') <> "") {
    $dtfrom   = $this->input->post('dc') . ' 00:00:00';
    $dtto     = $this->input->post('dc2') . ' 23:59:59';
    $d['dc']  = $this->input->post('dc');
    $d['dc2'] = $this->input->post('dc2');
    $dc       = $this->input->post('dc');
    $dc2      = $this->input->post('dc2');
   } else {
    if ($this->input->get('dc') <> "" OR $this->input->get('dc2') <> "") {
     $dtfrom   = $this->input->get('dc') . ' 00:00:00';
     $dtto     = $this->input->get('dc2') . ' 23:59:59';
     $d['dc']  = $this->input->get('dc');
     $d['dc2'] = $this->input->get('dc2');
     $dc       = $this->input->get('dc');
     $dc2      = $this->input->get('dc2');
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

   $d['page_title'] = "History Pinjaman Anggota";

   $d['lst_pinjaman'] = $this->db->query("SELECT * FROM pinjaman_header WHERE user_id='$user_session' AND status = 'DITERIMA' ORDER BY id_pinjam ASC");

   $d['content'] = $this->load->view('pinjaman/history_pinjaman_vr', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url());
  }
 }

 public function history_pinjaman_oktober() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $cari      = $this->input->post('txt_cari');
   $d['cari'] = $cari;
   if ($this->input->post('dc') <> "" OR $this->input->post('dc2') <> "") {
    $dtfrom   = $this->input->post('dc') . ' 00:00:00';
    $dtto     = $this->input->post('dc2') . ' 23:59:59';
    $d['dc']  = $this->input->post('dc');
    $d['dc2'] = $this->input->post('dc2');
    $dc       = $this->input->post('dc');
    $dc2      = $this->input->post('dc2');
   } else {
    if ($this->input->get('dc') <> "" OR $this->input->get('dc2') <> "") {
     $dtfrom   = $this->input->get('dc') . ' 00:00:00';
     $dtto     = $this->input->get('dc2') . ' 23:59:59';
     $d['dc']  = $this->input->get('dc');
     $d['dc2'] = $this->input->get('dc2');
     $dc       = $this->input->get('dc');
     $dc2      = $this->input->get('dc2');
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

   $d['page_title'] = "History Pinjaman Anggota";

   $d['lst_pinjaman'] = $this->db->query("SELECT * FROM pinjaman_header WHERE user_id='$user_session' AND status = 'DITERIMA' ORDER BY id_pinjam ASC");


   $d['content'] = $this->load->view('pinjaman/history_pinjaman_oktober', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url());
  }
 }

 public function history_pinjaman_november() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $cari      = $this->input->post('txt_cari');
   $d['cari'] = $cari;
   if ($this->input->post('dc') <> "" OR $this->input->post('dc2') <> "") {
    $dtfrom   = $this->input->post('dc') . ' 00:00:00';
    $dtto     = $this->input->post('dc2') . ' 23:59:59';
    $d['dc']  = $this->input->post('dc');
    $d['dc2'] = $this->input->post('dc2');
    $dc       = $this->input->post('dc');
    $dc2      = $this->input->post('dc2');
   } else {
    if ($this->input->get('dc') <> "" OR $this->input->get('dc2') <> "") {
     $dtfrom   = $this->input->get('dc') . ' 00:00:00';
     $dtto     = $this->input->get('dc2') . ' 23:59:59';
     $d['dc']  = $this->input->get('dc');
     $d['dc2'] = $this->input->get('dc2');
     $dc       = $this->input->get('dc');
     $dc2      = $this->input->get('dc2');
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

   $d['page_title'] = "History Pinjaman Anggota";

   $d['lst_pinjaman'] = $this->db->query("SELECT * FROM pinjaman_header WHERE user_id='$user_session' AND status = 'DITERIMA' ORDER BY id_pinjam ASC");


   $d['content'] = $this->load->view('pinjaman/history_pinjaman_november', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url());
  }
 }

 public function history_pinjaman_desember() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $cari      = $this->input->post('txt_cari');
   $d['cari'] = $cari;
   if ($this->input->post('dc') <> "" OR $this->input->post('dc2') <> "") {
    $dtfrom   = $this->input->post('dc') . ' 00:00:00';
    $dtto     = $this->input->post('dc2') . ' 23:59:59';
    $d['dc']  = $this->input->post('dc');
    $d['dc2'] = $this->input->post('dc2');
    $dc       = $this->input->post('dc');
    $dc2      = $this->input->post('dc2');
   } else {
    if ($this->input->get('dc') <> "" OR $this->input->get('dc2') <> "") {
     $dtfrom   = $this->input->get('dc') . ' 00:00:00';
     $dtto     = $this->input->get('dc2') . ' 23:59:59';
     $d['dc']  = $this->input->get('dc');
     $d['dc2'] = $this->input->get('dc2');
     $dc       = $this->input->get('dc');
     $dc2      = $this->input->get('dc2');
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

   $d['page_title'] = "History Pinjaman Anggota";

   $d['lst_pinjaman'] = $this->db->query("SELECT * FROM pinjaman_header WHERE user_id='$user_session' AND status = 'DITERIMA' ORDER BY id_pinjam ASC");


   $d['content'] = $this->load->view('pinjaman/history_pinjaman_november', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url());
  }
 }

 public function status_pinjaman() {
  $user_session      = $this->session->userdata('username');
//  debug($user_session);
//  $getPinjaman  = $this->db->query("SELECT * FROM pinjaman_header WHERE username ='$user_session'");
//  if ($getPinjaman->num_rows() > 0) {
//   $tP = $getPinjaman->result_array();
//  } else {
//   $tP = "0";
//  }
//  debug($tP);
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $cari      = $this->input->post('txt_cari');
   $d['cari'] = $cari;
   if ($this->input->post('dc') <> "" OR $this->input->post('dc2') <> "") {
    $dtfrom   = $this->input->post('dc') . ' 00:00:00';
    $dtto     = $this->input->post('dc2') . ' 23:59:59';
    $d['dc']  = $this->input->post('dc');
    $d['dc2'] = $this->input->post('dc2');
    $dc       = $this->input->post('dc');
    $dc2      = $this->input->post('dc2');
   } else {
    if ($this->input->get('dc') <> "" OR $this->input->get('dc2') <> "") {
     $dtfrom   = $this->input->get('dc') . ' 00:00:00';
     $dtto     = $this->input->get('dc2') . ' 23:59:59';
     $d['dc']  = $this->input->get('dc');
     $d['dc2'] = $this->input->get('dc2');
     $dc       = $this->input->get('dc');
     $dc2      = $this->input->get('dc2');
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

   $d['page_title'] = "Status Pemgajuan Pinjaman Anggota";

   $d['lst_pinjaman']        = $this->db->query("SELECT * FROM pinjaman_header WHERE user_id='$user_session' ORDER BY id_pinjam ASC");
   $d['lst_pinjaman_header'] = $this->db->query("SELECT * FROM pinjaman_header WHERE user_id='$user_session' AND status_confirm = '1' ORDER BY id_pinjam ASC");

   $d['content'] = $this->load->view('pinjaman/status_pinjaman', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url());
  }
 }

 public function ajukan() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $cari      = $this->input->post('txt_cari');
   $d['cari'] = $cari;
   if ($this->input->post('dc') <> "" OR $this->input->post('dc2') <> "") {
    $dtfrom   = $this->input->post('dc') . ' 00:00:00';
    $dtto     = $this->input->post('dc2') . ' 23:59:59';
    $d['dc']  = $this->input->post('dc');
    $d['dc2'] = $this->input->post('dc2');
    $dc       = $this->input->post('dc');
    $dc2      = $this->input->post('dc2');
   } else {
    if ($this->input->get('dc') <> "" OR $this->input->get('dc2') <> "") {
     $dtfrom   = $this->input->get('dc') . ' 00:00:00';
     $dtto     = $this->input->get('dc2') . ' 23:59:59';
     $d['dc']  = $this->input->get('dc');
     $d['dc2'] = $this->input->get('dc2');
     $dc       = $this->input->get('dc');
     $dc2      = $this->input->get('dc2');
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

   $d['page_title']     = "Form Pengajuan Pinjaman";
   $d['nomor_pinjaman'] = $this->app_model->getMaxKodePinjaman();

   $d['content'] = $this->load->view('pinjaman/form_pengajuan_pinjaman', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url());
  }
 }

 public function verify() {
  $inputan              = $this->input->post();
//  debug($inputan);
  $user_session         = $this->session->userdata('username');
  $d['user_session']    = $user_session;
  $d['page_title']      = "Konfirmasi Pengajuan Pinjaman";
  $username             = $this->input->post('username');
  $d['username']        = $username;
  $nomor_pinjaman       = $this->app_model->getMaxKodePinjaman();
  $d['nomor_pinjaman']  = $nomor_pinjaman;
  $jumlah_pinjaman      = $this->input->post('jumlah_pinjaman');
  $d['jumlah_pinjaman'] = $jumlah_pinjaman;
  //baru
  $tglPengajuan         = $this->input->post('tglPengajuan');
  $d['tglPengajuan']    = $tglPengajuan;
  //end baru
  $jangka_waktu         = $this->input->post('jangka_waktu');
  $d['jangka_waktu']    = $jangka_waktu;
  $bunga_pinjaman       = $this->input->post('bunga_pinjaman');
  $d['bunga_pinjaman']  = $bunga_pinjaman;
  $biaya_adm            = 5 / 100 * $jumlah_pinjaman;
  $d['biaya_adm']       = $biaya_adm;
//  debug($d);
  if ($username) {


   if ($jumlah_pinjaman < 100000) {
    $this->session->set_flashdata('result_upgrade', 'Pengajuan pinjaman gagal. Minimal pinjaman Rp 100.000');
    redirect(base_url() . 'pinjaman/ajukan');
   }

   $d['jumlah_rp'] = $biaya;
   $d['content']   = $this->load->view('pinjaman/form_konfirmasi_pinjaman', $d, true);

   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url());
  }
 }

 public function process_pinjaman() {
  $datass               = $this->input->post();
//  debug($datass);
  $user_session         = $this->session->userdata('username');
  $d['user_session']    = $user_session;
  $d['page_title']      = "Konfirmasi Pengajuan Pinjaman";
  $username             = $this->input->post('username');
  $d['username']        = $username;
  $nomor_pinjaman       = $this->app_model->getMaxKodePinjaman();
  $d['nomor_pinjaman']  = $nomor_pinjaman;
  $jumlah_pinjaman      = $this->input->post('jumlah_pinjaman');
  $d['jumlah_pinjaman'] = $jumlah_pinjaman;
  //baru
  $tglPengajuan         = $this->input->post('tglPengajuan');
  $d['tgl_pengajuan']   = $tglPengajuan;
  //end baru
  $jangka_waktu         = $this->input->post('jangka_waktu');
  $d['jangka_waktu']    = $jangka_waktu;
  $bunga_pinjaman       = $this->input->post('bunga_pinjaman');
  $d['bunga_pinjaman']  = $bunga_pinjaman;
  $biaya_adm            = 5 / 100 * $jumlah_pinjaman;
  $d['biaya_adm']       = $biaya_adm;
  $nama_member          = $this->data_model->dataku("nama", $username);
  if ($user_session) {

   ///masukkan ke tabel history pinjaman header
   $data['id_pinjam']        = $this->app_model->getMaxKodePinjaman();
   $data['tgl']              = date('Y-m-d H:i:s');
   $data['username']         = $user_session;
   $data['jumlah']           = $jumlah_pinjaman;
   $data['jumlah_disetujui'] = '';
   //baru
   $data['tgl_pengajuan']    = $tglPengajuan;
   //end baru
   $data['lama']             = $jangka_waktu;
   $data['lama_disetujui']   = '';
   $data['biaya_adm']        = $biaya_adm;
   $data['bunga']            = $bunga_pinjaman;
   $data['user_id']          = $user_session;
   $data['approved_id']      = '';
//   debug($data);
   $result                   = $this->db->insert('pinjaman_header', $data);
   //$this->data_model->calculate_bonus_upgrade($user_session, $paket_new, $bv);
   //KIRIM SMS

   $datasms['out_starttime'] = date('Y-m-d H:i:s');
   $datasms['out_hpnumber']  = $user_session;
   $datasms['provider']      = 'XL';
   $datasms['out_message']   = "Pengajuan pinjaman a/n. $nama_member ($user_session) sejumlah Rp $jumlah_pinjaman telah kami terima. Kami akan melakukan validasi pengajuan pinjaman anda maksimal 1 minggu. Trims";
   $datasms['tipe']          = 'SMS';
   $this->app_model->insertData("outbox", $datasms);

   //END OF SMS

   $this->session->set_flashdata('result_upgradee', 'Proses Pengajuan Pinjaman success');
   redirect(base_url() . 'pinjaman/ajukan');
  } else {
   header('location:' . base_url());
  }
 }

 public function bayar() {
  $user_session = $this->session->userdata('username');

  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $cari      = $this->input->post('txt_cari');
   $d['cari'] = $cari;
   if ($this->input->post('dc') <> "" OR $this->input->post('dc2') <> "") {
    $dtfrom   = $this->input->post('dc') . ' 00:00:00';
    $dtto     = $this->input->post('dc2') . ' 23:59:59';
    $d['dc']  = $this->input->post('dc');
    $d['dc2'] = $this->input->post('dc2');
    $dc       = $this->input->post('dc');
    $dc2      = $this->input->post('dc2');
   } else {
    if ($this->input->get('dc') <> "" OR $this->input->get('dc2') <> "") {
     $dtfrom   = $this->input->get('dc') . ' 00:00:00';
     $dtto     = $this->input->get('dc2') . ' 23:59:59';
     $d['dc']  = $this->input->get('dc');
     $d['dc2'] = $this->input->get('dc2');
     $dc       = $this->input->get('dc');
     $dc2      = $this->input->get('dc2');
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

   $d['page_title'] = "Bayar Pinjaman";
//   debug($d);

   $d['content'] = $this->load->view('pinjaman/form_bayar_pinjaman', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url());
  }
 }

 public function verify_bayar() {
  $user_session       = $this->session->userdata('username');
  $d['user_session']  = $user_session;
  $d['page_title']    = "Form Bayar Pinjaman";
  $username           = $this->input->post('username');
  $d['username']      = $username;
  $no_pembayaran      = $this->input->post('no_pembayaran');
  $d['no_pembayaran'] = $no_pembayaran;
  $nomor_pinjaman     = $this->input->post('id_tujuan');
  $d['id_pinjam']     = $nomor_pinjaman;
  $jumlah_bayar       = $this->input->post('jumlah_bayar_pokok');
  $d['angsuran']      = $jumlah_bayar;
  //baru
  $jumlah_bunga       = $this->input->post('jumlah_bayar_bunga');
  $d['bunga']         = $jumlah_bunga;
  //end baru
  $total_bayar        = $this->input->post('total_jml_bayar');
  $d['jumlah_bayar']  = $total_bayar;
// 		$bunga_pinjaman = $this->input->post('bunga_pinjaman');
// 		$d['bunga_pinjaman'] = $bunga_pinjaman;
// 		$biaya_adm = 5/100 * $jumlah_pinjaman;
// 		$d['biaya_adm'] = $biaya_adm;
//  $query            = $this->db->query("select * from pinjaman_header where id_pinjam = '" . $nomor_pinjaman . "'")->row();
//  $query_cek_detail = $this->db->query("select date_format(tgl_bayar,'%Y-%m') as tgl_jatuh_tempo from pinjaman_detail where id_pinjam = '" . $nomor_pinjaman . "' order by id desc")->row();
//  if (date('Y-m', strtotime($query->tgl_pengajuan)) == date('Y-m')) {
//
//   $date      = strtotime(date("Y-m-d", strtotime($query->tgl_pengajuan)) . " +1 month");
//   $bulan_con = date("m-Y", $date);
//   $this->session->set_flashdata('error', 'Silahkan bayar pada tanggal jatuh tempo yaitu 01-' . $bulan_con . '');
//   redirect(base_url() . 'pinjaman/bayar');
//  }
//
//  $query = $this->db->query("select * from pinjaman_detail where id_pinjam = '" . $nomor_pinjaman . "'");
//  if ($query->num_rows() > 1) {
//   $this->session->set_flashdata('error', 'Maaf, pemabayaran bulan 01-' . date('m-Y') . ' sudah terbayar');
//   redirect(base_url() . 'pinjaman/bayar');
//  }
//
//  $query  = $this->db->query("select * from pinjaman_detail where id_pinjam = '" . $nomor_pinjaman . "' AND date_format(tgl_bayar,'%Y-%m') = '" . date('Y-m') . "'");
//  $result = $query->row();
//  if ($query->num_rows() > 0) {
//   if (isset($result->angsuran) && $result->angsuran != 0) {
//    $this->session->set_flashdata('error', 'Maaf, pemabayaran angsuran pokok bulan 01-' . date('m-Y') . ' sudah terbayar');
//    redirect(base_url() . 'pinjaman/bayar');
//   }
//
//   if (isset($result->bunga) && $result->bunga != 0) {
//    $this->session->set_flashdata('error', 'Maaf, pemabayaran bunga bulan 01-' . date('m-Y') . ' sudah terbayar');
//    redirect(base_url() . 'pinjaman/bayar');
//   }
//  }
//
//
//  $query    = $this->db->query("select * from pinjaman_detail where id_pinjam = '" . $nomor_pinjaman . "' and date_format(tgl_bayar,'%Y-%m') = '" . date('Y-m') . "'")->result();
//  $bunga    = "";
//  $angsuran = "";
//  foreach ($query as $key => $value) {
//   if ($value->angsuran != 0) {
//    $angsuran = $value->angsuran;
//   }
//
//   if ($value->bunga != 0) {
//    $bunga = $value->bunga;
//   }
//  }
//
//  if ($bunga != "" && $angsuran != "") {
//   $this->session->set_flashdata('success', 'Maaf, pemabayaran bulan 01-' . date('m-Y') . ' sudah terbayar');
//   redirect(base_url() . 'pinjaman/bayar');
//  }

  if ($username) {


// 			if($jumlah_pinjaman<100000){
// 			    $this->session->set_flashdata('result_upgrade', 'Pengajuan pinjaman gagal. Minimal pinjaman Rp 100.000');
// 				redirect(base_url().'pinjaman/ajukan');
// 			}
// 			$d['jumlah_rp'] = $biaya;
   $d['content'] = $this->load->view('pinjaman/form_konfirmasi_bayar_angsuran', $d, true);

   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url());
  }
 }

 //function baru
 public function statusmemberterima() {
  $cekToken  = $this->session->userdata['ctoken'];
  $postToken = $this->input->post('ptoken');
//  $dump      = array(
//      'cekToken'  => $cekToken,
//      'postToken' => $postToken,
//  );
//  debug($dump);
  if ($cekToken !== $postToken) {
   redirect(site_url() . '/pinjaman/status_pinjaman');
  } else {
   $id['id_pinjam'] = $this->input->post('id1');
   $d['id_pinjam']  = $id;
   $status          = $this->input->post('sts1');
   //$d['status']    = $status;



   $data['status_approve'] = '1';
   $data['status']         = $status;

   $id_pinjam = $this->db->escape($this->input->post('id1'));


   $query = $this->db->query("select * from pinjaman_header where id_pinjam = " . $id_pinjam . "")->row();

   $jumlah = $query->jumlah_disetujui - $query->biaya_adm;
   $time   = date('Y-m-d H:i:s');
   $insert = [
       "username" => $query->username,
       "jumlah"   => $jumlah,
       "uraian"   => "Terima pencairan pinjaman dari KSU DANA MANDIRI",
       "tgl"      => $time,
       "status"   => 1,
       "jenis"    => "kredit"
   ];
   // print_r($insert);
   // die;
   $res    = $this->db->insert("dataewalet", $insert);

   $result = $this->app_model->updateData('pinjaman_header', $data, $id);

//   echo json_encode(["result" => $result]);
//   die;
   $this->session->set_flashdata('result_upgradee', 'Proses Perubahan status diterima berhasil');
   redirect(base_url() . 'pinjaman/status_pinjaman');
  }
 }

 public function statusmembertolak() {
  $id['id_pinjam'] = $this->input->post('id2');
  $d['id_pinjam']  = $id;
  $status          = $this->input->post('sts2');
  // $d['status']    = $status;

  $data['status_approve'] = '1';
  $data['status']         = $status;

  $result = $this->app_model->updateData('pinjaman_header', $data, $id);

  $this->session->set_flashdata('result_upgradee', 'Proses Perubahan status ditolak berhasil');
  redirect(base_url() . 'pinjaman/status_pinjaman');
 }

 public function bayar_pinjaman() {
  $input             = $this->input->post();
//  debug($input);
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  $d['page_title']   = "Form Bayar Pinjaman";
  $username          = $this->input->post('username');
  $d['username']     = $username;
  $nomor_pinjaman    = $this->input->post('id_tujuan');
  $d['id_pinjam']    = $nomor_pinjaman;
  $jml_bayar         = $this->input->post('jumlah_bayar_pokok');
  $d['angsuran']     = $jml_bayar;
  $jml_bunga         = $this->input->post('jumlah_bayar_bunga');
  $d['bunga']        = $jml_bunga;
  $d['tgl_bayar']    = date("Y-m-d");

  $query = $this->db->query("select * from pinjaman_header where id_pinjam = '" . $nomor_pinjaman . "'")->row();
  if (date('Y-m', strtotime($query->tgl_pengajuan)) == date('Y-m')) {

   $date      = strtotime(date("Y-m-d", strtotime($query->tgl_pengajuan)) . " +1 month");
   $bulan_con = date("m-Y", $date);
   $this->session->set_flashdata('success', 'Silahkan bayar pada tanggal jatuh tempo yaitu 01-' . $bulan_con . '');
   redirect(base_url() . 'pinjaman/bayar');
  }

  if ($user_session) {

   ///masukkan ke tabel history pinjaman detail
   $data['no_pembayaran'] = $input['no_pembayaran'];
   $data['id_pinjam']     = $nomor_pinjaman;
   $data['tgl_bayar']     = date('Y-m-d H:i:s');
   $data['username']      = $user_session;
   $data['angsuran']      = $jml_bayar;
   $data['bunga']         = $jml_bunga;
   $data['jumlah_bayar']  = $input['total_jml_bayar'];
//   $data['tgl_bayar']     = date("Y-m-d");
   $data['cicilan']       = '';

   //   START HITUNG DISINI
   $persenBunga  = 2.5 / 100;
   $cekAngs      = $this->db->query("SELECT * FROM pinjaman_detail WHERE username = '$username' AND id_pinjam = '$nomor_pinjaman'");
   $getPjmHeader = $this->db->query("SELECT * FROM pinjaman_header WHERE username = '$username' AND id_pinjam = '$nomor_pinjaman' AND status = 'DITERIMA'")->row();
   if ($cekAngs->num_rows() > 0) {
    $selLastAngs = $this->db->query("SELECT * FROM pinjaman_detail WHERE id_pinjam = '$nomor_pinjaman' ORDER BY id DESC LIMIT 1")->row();
    $sisaPjm     = $selLastAngs->sisa_pinjaman - $jml_bayar;
    if ($jml_bayar !== "" && $jml_bunga !== "") {
     $skrip      = "a";
     $wajibBunga = $persenBunga * ($selLastAngs->sisa_pinjaman - $jml_bayar);
     $tgkBunga   = $selLastAngs->tunggakan_bunga + $selLastAngs->wajib_bunga - $jml_bunga;
    } elseif ($jml_bayar !== "" && $jml_bunga == "") {
     $skrip      = "b";
     $wajibBunga = $persenBunga * ($selLastAngs->sisa_pinjaman - $jml_bayar);
//     $tgkBunga   = $selLastAngs->tunggakan_bunga + ($persenBunga * $selLastAngs->sisa_pinjaman);
     $tgkBunga   = $selLastAngs->tunggakan_bunga;
    } elseif ($jml_bayar == "" && $jml_bunga !== "") {
      //var_dump($jml_bunga); die();
     $skrip      = "c";
     $wajibBunga = $persenBunga * $selLastAngs->sisa_pinjaman;
     $tgkBunga   = $selLastAngs->tunggakan_bunga - $jml_bunga;
    } else {
     $skrip = "d";
     $this->session->set_flashdata('error', 'Pembayaran tidak boleh kosong');
     redirect(base_url() . 'pinjaman/bayar');
    }
   } else {
    $skrip          = "e";
    $tgkBungaSebFeb = getTunggakan($username, $nomor_pinjaman);
    $wajibBunga     = $persenBunga * $getPjmHeader->jumlah_disetujui;
    $tgkBunga       = $tgkBungaSebFeb == 0 ? $wajibBunga - $jml_bunga : ($tgkBungaSebFeb + $wajibBunga) - $jml_bunga;
    $sisaPjm        = $getPjmHeader->jumlah_disetujui - $jml_bayar;
   }
//   $data['tgl_jatuh_tempo'] = date('Y-m', strtotime("+1 month", strtotime(date('Y-m-d H:i:s')))) . "-01";
   $data['tgl_jatuh_tempo'] = date('Y-m', strtotime("+1 month", strtotime(date('Y-m-d H:i:s')))) . "-01";
   $data['tunggakan_bunga'] = $tgkBunga;
   $data['wajib_bunga']     = $wajibBunga;
   $data['sisa_pinjaman']   = $sisaPjm;
//   $data['skrip']           = $skrip;
//   var_dump($jml_bayar);
//   debug($data);
//END HITUNG

   $jmlAng = $this->db->query("SELECT SUM( angsuran ) as totalAngs
   FROM pinjaman_detail
   WHERE username = '$user_session' AND status_pinjaman = '0'")->row()->totalAngs;
   if ($jmlAng == NULL || empty($jmlAng) || $jmlAng == '') {
    $totalAngs = "0";
   } else {
    $totalAngs = $jmlAng;
   }
   $jmlPjm = $this->db->query("SELECT SUM( jumlah_disetujui ) AS total
    FROM pinjaman_header
    WHERE username = '$user_session' AND `status` = 'DITERIMA' ")->row()->total;
   if ($jmlPjm - $totalAngs > 0) {
    $statusPjm = "0";
   } else {
    $statusPjm = "1";
   }
   $data['status_pinjaman'] = $statusPjm;
//   debug($data);

   $result = $this->db->insert('pinjaman_detail', $data);

   $insert = [
       "username" => $username,
       "jumlah"   => $input['total_jml_bayar'],
       "uraian"   => "Pembayaran pinjaman dengan nomor pembyaran ID " . $nomor_pinjaman . " dan ID Transaksi " . $input['no_pembayaran'] . "",
       "tgl"      => date('Y-m-d H:i:s'),
       "status"   => 1,
       "jenis"    => "debit"
   ];

   $result = $this->db->insert('dataewalet', $insert);

   //tabel header
   if ($result) :
    $kp['status_bayar'] = '1';
    $kp['status_bunga'] = '0';
    //slide
    $pk['status_bayar'] = '0';
    $pk['status_bunga'] = '1';
    //slide akhir
    $pn['status_bayar'] = '1';
    $pn['status_bunga'] = '1';


//    if ($jml_bayar = '1' || $jml_bunga == "" || $jml_bunga = '0') :
//     $vbr = $this->app_model->updateData('pinjaman_header', $kp, $nomor_pinjaman);
//    elseif ($jml_bunga = '0' || $jml_bunga == "" || $jml_bunga = '1') :
//     $vbr = $this->app_model->updateData('pinjaman_header', $pk, $nomor_pinjaman);
//    else :
//     $vbr = $this->app_model->updateData('pinjaman_header', $np, $nomor_pinjaman);
//    endif;
   endif;

   $this->session->set_flashdata('success', 'Proses bayar Pinjaman success');
   redirect(base_url() . 'pinjaman/bayar');
  } else {
   header('location:' . base_url());
  }
 }

}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
