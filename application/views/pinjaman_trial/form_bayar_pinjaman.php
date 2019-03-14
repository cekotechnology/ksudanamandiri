<?php
$dataPjm = $this->db->query("
 SELECT *
 FROM pinjaman_header
 WHERE username = '$user_session'
  AND `status` = 'DITERIMA'")->row();

$getLastId  = $this->db->query("SELECT MAX( id ) as maxId FROM pinjaman_detail_trial ")->row()->maxId + 1;
$noTrx_show = "TR" . sprintf("%'.07d\n", $getLastId);
//   $noTrx_show = "TR" . time();
//   CEK TUNGGAKAN SEBELUM FEB 2019
$tglPjm     = date('Y-m-d', strtotime($dataPjm->tgl_pengajuan));
$limitPjm   = date('Y-m-d', strtotime("2019-02-01"));

if ($this->session->flashdata('error') <> '') {
 ?>
 <div class="alert alert-warning">
  <strong>Warning!</strong><?php echo $this->session->flashdata('error'); ?>
 </div>
 <?php
}
?>

<?php
if ($this->session->flashdata('success') <> '') {
 ?>
 <div class="alert alert-success">
  <strong>Success!</strong><?php echo $this->session->flashdata('success'); ?>
 </div>
 <?php
}
$periodeBayar = date('Y-m');
$cA           = $this->db->query("SELECT * FROM `pinjaman_detail_trial`
   WHERE id_pinjam = '$dataPjm->id_pinjam'
	AND angsuran != 0
	AND DATE_FORMAT(tgl_bayar,'%Y-%m') = '$periodeBayar'")->num_rows();

$cB = $this->db->query("SELECT * FROM `pinjaman_detail_trial`
   WHERE id_pinjam = '$dataPjm->id_pinjam'
	AND bunga != 0
	AND DATE_FORMAT(tgl_bayar,'%Y-%m') = '$periodeBayar'")->num_rows();
if ($cA !== 0 && $cB !== 0) {
 $txtAngsuran = "disabled";
 $txtBunga    = "disabled";
 $plcAngsuran = "placeholder='Anda sudah melakukan pembayaran Angsuran bulan ini'";
 $plcBunga    = "placeholder='Anda sudah melakukan pembayaran Bunga bulan ini'";
} elseif ($cA === 0 && $cB !== 0) {
 $txtAngsuran = "";
 $txtBunga    = "disabled";
 $plcAngsuran = "";
 $plcBunga    = "placeholder='Anda sudah melakukan pembayaran Bunga bulan ini'";
} elseif ($cA !== 0 && $cB === 0) {
 $txtAngsuran = "disabled";
 $txtBunga    = "";
 $plcAngsuran = "placeholder='Anda sudah melakukan pembayaran Angsuran bulan ini'";
 $plcBunga    = "";
} else {
 $txtAngsuran = "";
 $txtBunga    = "";
 $plcAngsuran = "";
 $plcBunga    = "";
}
?>

<h4>FORM BAYAR ANGSURAN</h4>
<form id="transfer" name="transfer" method="post" action="<?php echo base_url(); ?>pinjaman_trial/verify_bayar/<?= $periode; ?>">
 <table class="table table-striped table-bordered">

  <tr>
   <td>Saldo Tabungan Anda saat ini : </td>
   <td>Rp <?php echo number_format($this->ewalet_model->myewaletdone($user_session, ""), 0); ?></td>
  </tr>
  <tr>
   <td>ID. Transaksi</td>
   <td><input name="no_pembayaran" type="text" value="<?= $noTrx_show ?>" class="form-control" id="no_pembayaran" required readonly /></td>
  </tr>
  <tr>
   <td>No. Pembayaran</td>
   <td><input name="id_tujuan" type="text" value="<?= $dataPjm->id_pinjam ?>" class="form-control" id="id_tujuan" required readonly /></td>
   <!--<td>...</td>-->
  </tr>
  <tr>
   <td>No Anggota </td>
   <td><?= $user_session; ?> / <?= strtoupper($this->data_model->dataku("nama", $user_session)); ?><input name="username" type="hidden" id="username" value="<?= $user_session; ?>" maxlength="8" required  /></td>
  </tr>
  <tr>
   <td>Jumlah Pembayaran Pokok</td>
   <td><input <?= $txtAngsuran . " " . $plcAngsuran ?> name="jumlah_bayar_pokok" class="form-control uang" onkeyup="sum();" type="number" id="jumlah_bayar_pokok" maxlength="8"   /></td>
  </tr>
  <tr>
   <td>Jumlah Pembayaran Bunga</td>
   <td><input <?= $txtBunga . " " . $plcBunga ?> name="jumlah_bayar_bunga" class="form-control uang" onkeyup="sum();" onBlur="stopCalc();" type="number" id="jumlah_bayar_bunga" maxlength="8"   /></td>
  </tr>
  <!--total pembayaran ini otomatis di jumlahkan dari jml pembayaran pokok dan bunga namun gabisa diklik-->
  <tr>
   <td><strong>Total Pembayaran</strong></td>
   <td>
    <input readonly class="form-control" onchange="tryNumberFormat(this.form.thirdBox);" type="number" id="total_jml_bayar" maxlength="8"  />
    <input name="total_jml_bayar" type="hidden" value="" id="total_jml_bayar1"/>
   </td>
  </tr>
  <tr>
   <td>&nbsp;</td>
   <td><input type="submit" class="btn btn-info" name="submit" value="SUBMIT" ></td>
  </tr>


 </table>
</form>

<script type="text/javascript" language="Javascript">

 function sum() {
  var txtFirstNumberValue = document.getElementById('jumlah_bayar_pokok').value;
  var txtSecondNumberValue = document.getElementById('jumlah_bayar_bunga').value;


  var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);

  if (!isNaN(result)) {
   document.getElementById('total_jml_bayar').value = result;
   document.getElementById('total_jml_bayar1').value = result;
  } else {
   if (txtFirstNumberValue == "" || txtFirstNumberValue == null) {
    txtFirstNumberValue = 0;
   }

   if (txtSecondNumberValue == "" || txtSecondNumberValue == null) {
    txtSecondNumberValue = 0;
   }

   result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);

   document.getElementById('total_jml_bayar').value = result;
   document.getElementById('total_jml_bayar1').value = result;
  }
 }

 function stopCalc() {
  clearInterval(interval);
 }

 // $("#jumlah_bayar_pokok").on('keyup keydown keypress', function(){
 //   console.log($(this).val())
 // })
</script>
