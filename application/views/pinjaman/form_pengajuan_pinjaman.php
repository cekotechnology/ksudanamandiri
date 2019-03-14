<?php
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
?>
<h4>FORM PENGAJUAN PINJAMAN</h4>
<?php
if ($this->session->flashdata('result_upgrade')) {
 ?>
 <div class="alert alert-danger">
  <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
  </button>
  <p class="text-small"><?php echo validation_errors(); ?>
   <?php echo $this->session->flashdata('result_upgrade'); ?></p>

 </div>
 <?php
}
?>

<?php
if ($this->session->flashdata('result_upgradee')) {
 ?>
 <div class="alert alert-success">
  <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
  </button>
  <p class="text-small">
   <?php echo $this->session->flashdata('result_upgradee'); ?></p>

 </div>
 <?php
}
?>
<form id="transfer" name="transfer" method="post" action="<?php echo base_url(); ?>pinjaman/verify">
 <table class="table table-striped table-bordered">

  <tr>
   <td>Maksimal Plafond Anda saat ini : </td>
   <td>-</td>
  </tr>
  <tr>
   <td>No Pinjaman</td>
   <td><input name="no_pinjaman" class="form-control" type="text" id="no_pinjaman" readonly maxlength="16" value="<?= $nomor_pinjaman; ?>" required /></td>
  </tr>
  <tr>
   <td>Tanggal Pengajuan Pinjaman</td>
   <td><div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
     <input class="form-control" name="tglPengajuan" type="text"/>
     <span class="input-group-addon"><i class="fa fa-date"></i></span>
    </div>
   </td>
  </tr>
  <tr>
   <td>ID. Permohonan </td>
   <!--Nama Anggota-->
   <td><?= $user_session; ?> / <?= strtoupper($this->data_model->dataku("nama", $user_session)); ?><input name="username" type="hidden" id="username" value="<?= $user_session; ?>" maxlength="8" required  /></td>
  </tr>
  <tr>
   <td>Jumlah Pinjaman</td>
   <td><input name="jumlah_pinjaman" class="form-control" type="number" id="jumlah_pinjaman" maxlength="8" required  /></td>
  </tr>
  <tr>
   <td>Jangka Waktu</td>
   <td><label>
     <select class="form-control" name="jangka_waktu" id="jangka_waktu" required>
      <option>-- Pilih Jangka Waktu Pinjaman --</option>
      <option value="1">1 Tahun</option>
      <option value="2">2 Tahun</option>
      <option value="3">3 Tahun</option>
      <option value="4">4 Tahun</option>
      <option value="5">5 Tahun</option>
     </select>
    </label></td>
  </tr>
  <tr>
   <td>Bunga Saat ini</td>
   <td>
    <?php
    $txtBungaP = $this->db->query("SELECT bunga_pinjaman FROM configuration WHERE id='1'")->row()->bunga_pinjaman;
//    $txtBungaP = 2.5;
    echo $txtBungaP;
    ?>%
    <input name="bunga_pinjaman" type="hidden" id="bunga_pinjaman" value="<?= $txtBungaP ?>"/>
    <!--2.5%-->
   </td>
   <!--<td>
   <?php echo $this->config_model->index("bunga_pinjaman"); ?>
   %</td>-->
  </tr>
  <tr>
   <td>&nbsp;</td>
   <td><input class="btn btn-info" type="submit" name="submit" value="AJUKAN PINJAMAN" ></td>
  </tr>


 </table>
 <div class="hightlight">
  <pre>&bull;  Catt: Setiap pinjaman yang diajukan member, akan divalidasi oleh admin dan menunggu proses approval.
&bull;  Proses validasi pengajuan pinjaman maksimal 1 minggu dari tanggal pengajuan.
&bull;  Biaya administrasi sebesar 5% dari pokok pinjaman.
  </pre>
 </div>
</form>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
