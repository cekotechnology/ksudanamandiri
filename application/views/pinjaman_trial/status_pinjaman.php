

<div class="bd-example">

 <h4>Status Pengajuan Pinjaman</h4>
 <div class="responsive">
  <table class="table table-striped" id="example" style="width: 100%">

   <tr>
    <th>No</th>
    <th>Tanggal</th>
    <td>Jumlah Pengajuan (Rp)</td>
    <!--<th>Lama Pinjaman</th>-->
    <td>Jangka Waktu</td>
    <th>Bunga</th>
    <th>Jumlah Disetujui</th>
    <th>Biaya Admin</th>
    <th>Jumlah Diterima</th>
    <th>Terima</th>
    <th>Tolak</th>
    <th>Status</th>
    <!--BARU-->
   </tr>

   <?php
   $nom   = 1;
   $total = 0;
//   debug($lst_pinjaman->result_array());
//   foreach ($lst_pinjaman_header->result_array() as $db) {
   foreach ($lst_pinjaman->result_array() as $db) {
    ?>
    <tr>
     <td class="booking-history-type"><?= $nom; ?></td>
     <td class="booking-history-title"><?= $this->app_model->formatgl($db['tgl_pengajuan']); ?></td>
     <td align="left"><?= number_format($db['jumlah'], 0); ?></td>
     <td align="left"><?= $db['lama']; ?> tahun</td>
     <td><?= $db['bunga']; ?>%</td>
     <td>Rp. <?= number_format($db['jumlah_disetujui'], 2); ?></td>
     <td>Rp. <?php
      $adm = 0.05 * $db['jumlah_disetujui'];
      echo number_format($adm, 2);
      ?></td>
     <td>Rp. <?php
      $jml = $db['jumlah_disetujui'] - $adm;
      echo number_format($jml, 2);
      ?></td>
     <td>
      <?php if ($db['status_confirm'] != '1') { ?>
       <button class="btn btn-default btn-sm" disabled>TERIMA</button>
       <?php
      } else {
       if ($db['status_approve'] != '1') {
        ?>
        <form method="post" id="terima_swl" action="<?php echo base_url(); ?>pinjaman/statusmemberterima">
         <input type="hidden" name="id1" value="<?= $db["id_pinjam"]; ?>" id="id1">
         <input type="hidden" name="sts1" value="DITERIMA" id="sts1">
         <button type="button" class="btn btn-primary btn-sm" onclick="terima('<?= $db["id_pinjam"]; ?>', 'DITERIMA')">TERIMA</button>
        </form>
       <?php } else { ?>
        <!--<button class="btn btn-success btn-sm" disabled>TERIMA</button>-->
        <button class="btn btn-sm" disabled style="background-color: grey; color: #fff;">TERIMA</button>
       <?php } ?>
      <?php } ?>
     </td>
     <td>
      <?php if ($db['status_confirm'] != '1') { ?>
       <button class="btn btn-default btn-sm" disabled>TOLAK</button>
       <?php
      } else {
       if ($db['status_approve'] != '1') {
        ?>
        <form method="post" id="tolak_formswal" action="<?php echo base_url(); ?>pinjaman/statusmembertolak">
         <input type="hidden" name="id2" value="<?= $db["id_pinjam"]; ?>">
         <input type="hidden" name="sts2" value="DITOLAK">
         <button type="submit" class="btn btn-danger btn-sm">TOLAK</button>
        </form>
       <?php } else { ?>
        <!--<button class="btn btn-success btn-sm" disabled>TERIMA</button>-->
        <button class="btn btn-sm" disabled style="background-color: grey; color: #fff;">TOLAK</button>
       <?php } ?>
      <?php } ?>
     </td>
     <td align="left"><?= $db['status']; ?></td>
     <!--BARU-->
    </tr>

    <?php
    $nom++;
    //perhitungan jumlah
    $jmlSetuju[]    = $db['jumlah_disetujui'];
    $jmlAdm[]       = $adm;
    $jmlDisetujui[] = $jml;
    //proses perhitungan array
    $j1             = array_sum($jmlSetuju);
    $j2             = array_sum($jmlAdm);
    $j3             = array_sum($jmlDisetujui);
    //hasil output
    $totalSetuju    = $total + $j1;
    $totalAdm       = $total + $j2;
    $totalDisetuju  = $total + $j3;
    ?>
   <?php } ?>
   <tr>
    <td colspan="3" class="booking-history-type" style="text-align:right; font-weight:bold">Total</td>
    <td class="booking-history-type" style="text-align:right; font-weight:bold">&nbsp;</td>
    <td class="booking-history-type" style="text-align:right; font-weight:bold">&nbsp;</td>
    <td class="booking-history-type" style="text-align:right; font-weight:bold">Rp. <?= number_format($totalSetuju, 2); ?></td>
    <td class="booking-history-type" style="text-align:right; font-weight:bold">Rp. <?= number_format($totalAdm, 2); ?></td>
    <td class="booking-history-type" style="text-align:right; font-weight:bold">Rp. <?= number_format($totalDisetuju, 2); ?></td>
    <td class="booking-history-type" style="text-align:right; font-weight:bold">&nbsp;</td>
    <td class="booking-history-type" style="text-align:right; font-weight:bold">&nbsp;</td>
    <td class="booking-history-type" style="text-align:right; font-weight:bold">&nbsp;</td>
   </tr>
  </table>
 </div>
</div>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
  function terima(id, status){
    swal({
   title: "Apakah Anda yakin untuk terima pinjaman ini?",
   text: "Jumlah pinjaman yang diterima akan otomatis masuk ke saldo E-Wallet Anda",
   type: "warning",
   showCancelButton: true,
   confirmButtonColor: '#337ab7',
   confirmButtonText: 'YA, Terima',
   cancelButtonText: "BATAL",
   closeOnConfirm: false,
   closeOnCancel: false
  },
          function (isConfirm) {
           if (isConfirm) {
            $.ajax({
              url : "<?= base_url('pinjaman/statusmemberterima'); ?>",
              type : "POST",
              dataType : "json",
              data : {id1 : id, sts1 : status},
              success : function(response){
                location.reload();
              }
            })
           } else {
            swal("Batal", "Anda membatalkan Konfirmasi :(", "error");
           }
          });
  }
 document.querySelector('#terima_swl').addEventListener('submit', function (e) {
  var form = this;
  e.preventDefault();
  swal({
   title: "Apakah Anda yakin untuk terima pinjaman ini?",
   text: "Jumlah pinjaman yang diterima akan otomatis masuk ke saldo E-Wallet Anda",
   type: "warning",
   showCancelButton: true,
   confirmButtonColor: '#337ab7',
   confirmButtonText: 'YA, Terima',
   cancelButtonText: "BATAL",
   closeOnConfirm: false,
   closeOnCancel: false
  },
          function (isConfirm) {
           if (isConfirm) {
            swal({
             title: 'Jumlah yang disetujui berhasil dikonfirmasi',
             text: 'Konfirmasi Sukses :)',
             type: 'success'
            }, function () {
             form.submit();
            });
           } else {
            swal("Batal", "Anda membatalkan Konfirmasi :(", "error");
           }
          });
 });
</script>
<script>
 document.querySelector('#tolak_formswal').addEventListener('submit', function (a) {
  var form = this;
  a.preventDefault();
  swal({
   title: "Apakah Anda yakin untuk menolak jumlah yang diterima?",
   text: "Anda menolak jumlah yang diterima dari koperasi",
   type: "warning",
   showCancelButton: true,
   confirmButtonColor: '#337ab7',
   confirmButtonText: 'YA, Tolak',
   cancelButtonText: "BATAL",
   closeOnConfirm: false,
   closeOnCancel: false
  },
          function (isConfirm) {
           if (isConfirm) {
            swal({
             title: 'Anda berhasil menolak pengajuan pinjaman',
             text: 'Konfirmasi Sukses :)',
             type: 'success'
            }, function () {
             form.submit();
            });
           } else {
            swal("Tolak", "Anda menolak pinjaman :(", "error");
           }
          });
 });
</script>