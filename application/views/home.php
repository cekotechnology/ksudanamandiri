<?php
// error_reporting(E_ALL);

/*
  $qwe     = mysql_query("select sum(rp) FROM transfer where userid='$user_session' GROUP BY userid");
  $rowes   = mysql_fetch_row($qwe);
  $sal_his = $rowes[0];

  //echo "select jumlah FROM komisi where username='$user_session' AND jenis='komsales'";
  $qae          = mysql_query("select bayar FROM komisi where username='$user_session' AND jenis='komsales'");
  $rowe         = mysql_fetch_row($qae);
  $sal_personal = $rowe[0];

  $qa         = mysql_query("select jumlah FROM vkomisi where username='$user_session'");
  $rowx       = mysql_fetch_row($qa);
  $sal_komisi = $rowx[0] - $sal_personal;

  $qw  = mysql_query("select sisa FROM vsaldo_komisi where username='$user_session'");
  $row = mysql_fetch_row($qw);
  $sal = $row[0] - $sal_personal;

  $qb        = mysql_query("select bayar FROM vkomisi_transfer where userid='$user_session'");
  $rowb      = mysql_fetch_row($qb);
  $sal_bayar = $rowb[0];

  //$sql          = mysql_query("select sum( jumlah_disetujui ) FROM pinjaman_header where userid='$user_session'");
  //$rowc         = mysql_fetch_row($sql);
  //$sal_pinjaman = $rowc[0];
 */
$ja = 0;
for ($i = 0; $i < 9; $i++) {
 $ja = $ja + $this->network_model->jmlmember($user_session, "AND b.upline$i='$user_session'");
}
?>

<!--
<div class="alert alert-info">
   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
   </button>
    <p>
<b>Info UPGRADE PAKET</b>
<ol>
<li>Upgrade paket di sediakan untuk semua member yg sudah teregister untuk meningkatkan bonus pasangan atau Flush Out.
Atau Untuk Member baru yang ingin bergabung di tambang hijau mulai Paket Basic Counter - Platinum</li>



<li>Menu UPGRADE  tersedia didalam WEB DI MEMBER AREA.
Upgrade dapat dilakukan setelah sebelumnya melakukan pembelian/request SALDO E-REGISTER.</li>

</ol>
</p>

</div>

-->
<h4>Account Summary. &raquo; <?= $this->data_model->dataku("nama", $user_session); ?></h4>
<ul class="list list-inline user-profile-statictics mb30">

 <li><i class="fa fa-users user-profile-statictics-icon animate-icon-flash"></i>
  <h5 style="font-size:18px;"><?php echo $this->app_model->count_records("member", "WHERE sponsor='$user_session'"); ?></h5>
  <p><br />Direct Sponsor</p>
 </li>
 <li><i class="fa fa-users user-profile-statictics-icon animate-icon-flash"></i>
  <h5 style="font-size:18px;">
   <?= number_format($ja); ?></h5>
  <p><br />Downline</p>
 </li>
 <li><i class="fa fa-money user-profile-statictics-icon animate-icon-flash"></i>
  <h5 style="font-size:18px;"><?= number_format($sal_komisi, 0); ?></h5>
  <p><br />Total Komisi</p>
 </li>
 <li>
  <i class="fa fa-money user-profile-statictics-icon animate-icon-flash"></i>
  <?php
  $idc    = 0;
//  var_dump($user_session);
  $cekPjm = $this->db->query("SELECT * FROM pinjaman_header
   WHERE username='$user_session' AND `status` = 'DITERIMA' ORDER BY tgl_pengajuan DESC LIMIT 1");
//  var_dump($cekPjm->num_rows());

  if ($cekPjm->num_rows() > 0) {
   $tgkSebFeb = getTunggakan($user_session, $cekPjm->row()->id_pinjam);
   $dPjm      = $cekPjm->row();
//   var_dump($tgkSebFeb);
   $cekAngs   = $this->db->query("SELECT * FROM pinjaman_detail WHERE username='$user_session' AND id_pinjam ='$dPjm->id_pinjam'
    ORDER BY tgl_bayar DESC LIMIT 1");

   $tglSkr = date("Y-m-d");

   if ($cekAngs->num_rows() > 0) {
     
    $dAngs = $cekAngs->row();
    if ($tglSkr <= $dAngs->tgl_jatuh_tempo) {
     
//     $tgkBunga = $dAngs->tunggakan_bunga + ((2.5 / 100) * $dAngs->sisa_pinjaman);

     if ($tgkSebFeb > 0) {
      $idc           = 1;
      $jmlBayarBunga = $this->db->query("SELECT SUM( bunga ) as total FROM pinjaman_detail WHERE username='$user_session' AND id_pinjam ='$dPjm->id_pinjam'")->row()->total;
//     $tgkBunga      = $dAngs->tunggakan_bunga + ($tgkSebFeb - $jmlBayarBunga);
      $tgkBunga      = $dAngs->tunggakan_bunga + ((2.5 / 100) * $dAngs->sisa_pinjaman);
     
     //$tgkBunga=$dAngs->tunggakan_bunga;
     } else {
      $idc = 2;
      $tgkBunga = $dAngs->tunggakan_bunga  ;
     }
    } else {
      $idc      = 2;
      $tgkBunga = $dAngs->tunggakan_bunga+$dAngs->wajib_bunga;
    }
   } else { //JIKA TIDAK ADA ANGSURAN
   
	if(isset($dPjm) && isset($dPjm->tanggal_pengajuan))
		$tglJtNull = date('Y-m-d', strtotime("+1 month", strtotime(date('Y-m-d'), $tanggal_pengajuan)));
	else
		$tglJtNull = date('Y-m-d');
   
    
    if ($tglSkr <= $tglJtNull) {
     $idc      = 3;
     $tgkBunga = ((2.5 / 100) * $dPjm->jumlah_disetujui) + $tgkSebFeb;
    } else {
     $idc      = 4;
     $tgkBunga = 0;
    }
   }

//   echo "Ada pinjaman";
  } else {
   $idc      = 5;
   $tgkBunga = 0;
  }
  ?>
  
 <?php
	$tunggakan = getTotalTunggakanBunga($user_session, $this->db);
	
	if(strpos($tunggakan, ",") === FALSE){
		$tunggakan = number_format($tunggakan);
	}
	
	if($tunggakan == "") $tunggakan = "0";
 ?>
  
  <h5 style="font-size:18px;"><?=$tunggakan; ?></h5>
  <p><br />Tunggakan Bunga<?php // var_dump($idc)   ?></p>
 </li>
 <li>
  <i class="fa fa-money user-profile-statictics-icon animate-icon-flash"></i>
  <?php
  if ($cekPjm->num_rows() > 0) {
   $dPjm    = $cekPjm->row();
   $cekAngs = $this->db->query("SELECT * FROM pinjaman_detail WHERE username='$user_session' AND id_pinjam ='$dPjm->id_pinjam'
    ORDER BY tgl_bayar DESC LIMIT 1");
   $tglSkr  = date("Y-m-d");
   if ($cekAngs->num_rows() > 0) {
    $dAngs = $cekAngs->row();
    if ($tglSkr <= $dAngs->tgl_jatuh_tempo) {
     $idx      = 1;
     $sisaPjmx = $dAngs->sisa_pinjaman;
    } else {
     $idx      = 2;
     $sisaPjmx = $dAngs->sisa_pinjaman;
    }
   } else {
		if(isset($dPjm) && isset($dPjm->tanggal_pengajuan))
			$tglJtNull = date('Y-m-d', strtotime("+1 month", strtotime(date('Y-m-d'), strtotime($dPjm->tanggal_pengajuan))));
		else
			$tglJtNull = date('Y-m-d');
    if ($tglSkr <= $tglJtNull) {
     $idx      = 3;
     $sisaPjmx = $dPjm->jumlah_disetujui;
    } else {
     $idx      = 4;
     $sisaPjmx = $dPjm->jumlah_disetujui;
    }
   }
  } else {
   $idx      = 5;
   $sisaPjmx = 0;
  }
  ?>
  <!--<h5 style="font-size:18px;"><?php //echo number_format($sal_pinjaman, 0);                     ?></h5>-->
  <h5 style="font-size:18px;"><?= number_format($sisaPjmx, 0); ?></h5>
  <p><br />Saldo Pinjaman<?php // var_dump($idx)                   ?></p>
 </li>
 <?php /*
   <!--<li><i class="fa fa-money user-profile-statictics-icon animate-icon-flash"></i>-->
   <!--    <h5 style="font-size:16px;"><?= number_format($sal, 0); ?></h5>-->
   <!--    <p><br />Komisi Berjalan</p>-->
   <!--</li>-->
  */ ?>
</ul>




<div class="post-inner" style="border:1px solid #e6e6e6; border-radius:5px; padding:8px; text-align:center">


        <h4 class="post-title" style="display:block; background:#8c8c8c; color:#FFF; border-radius:5px; font-size:18px; padding:2px;"><!--<a target="_blank" style="color:#FFFFFF;" href="http://tambanghijau.com/register/?id=<?= $user_session; ?>">Link Referal Anda http://tambanghijau.com/register/?id=<?= $user_session; ?></a>-->&nbsp;</h4>

 <p class="post-desciption"><?= $main_content; ?></p>