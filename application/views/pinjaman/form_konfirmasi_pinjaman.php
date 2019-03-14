
<style type="text/css">
 .form-control-plaintext {
  display: block;
  width: 100%;
  padding-top: $input-padding-y;
  padding-bottom: $input-padding-y;
  margin-bottom: 0; // match inputs if this class comes on inputs with default margins
  line-height: $input-line-height;
  background-color: transparent;
  border: solid transparent;
  border-width: $input-border-width 0;

  &.form-control-sm,
  &.form-control-lg {
   padding-right: 0;
   padding-left: 0;
  }
 }

 .highlight {
  padding: 1rem;
  margin-top: 1rem;
  margin-bottom: 1rem;
  background-color: #f7f7f9;
  -ms-overflow-style: -ms-autohiding-scrollbar;

  @include media-breakpoint-up(sm) {
   padding: 1.5rem;
  }
 }

 .highlight {
  pre {
   padding: 0;
   margin-top: 0;
   margin-bottom: 0;
   background-color: transparent;
   border: 0;
  }
  pre code {
   font-size: inherit;
   color: $gray-900; // Effectively the base text color
  }
 }

</style>
<h4>Konfirmasi Pengajuan Pinjaman</h4>
<div class="btn-group btn-group-justified">
 <hr  />
</div>

<div class="bd-example">
 <h4></h4>
 <form method="post" action="<?php echo base_url(); ?>pinjaman/process_pinjaman">
  <div class="form-group row">
   <label for="staticEmail" class="col-sm-3 col-form-label">Nomor Pinjaman</label>
   <div class="col-sm-9">
    <input type="text" readonly class="form-control" id="staticEmail" value="<?= $nomor_pinjaman; ?>">
   </div>
  </div>

  <div class="form-group row">
   <label for="staticEmail" class="col-sm-3 col-form-label">Nama Anggota</label>
   <div class="col-sm-9">
    <input type="text" readonly class="form-control" id="staticEmail" value="<?= strtoupper($this->data_model->dataku("nama", $user_session)); ?> (<?= $user_session; ?>)">
   </div>
  </div>

  <div class="form-group row">
   <label for="inputPassword" class="col-sm-3 col-form-label">Jumlah Pinjaman</label>
   <div class="col-sm-9">
    Rp <?= number_format($jumlah_pinjaman, 0); ?>
    <input name="jumlah_pinjaman" type="hidden" required class="form-control" placeholder="Masukkan jumlah" value="<?= $jumlah_pinjaman; ?>" readonly>
   </div>
  </div>

  <div class="form-group row">
   <label for="tglPengajuan" class="col-sm-3 col-form-label">Tanggal Pengajuan</label>
   <div class="col-sm-9">
    <?= $tglPengajuan ?>
    <input name="tglPengajuan" type="hidden" required class="form-control" value="<?= $tglPengajuan; ?>">
   </div>
  </div>

  <div class="form-group row">
   <label for="inputPassword" class="col-sm-3 col-form-label">Jangka Waktu</label>
   <div class="col-sm-9">
    <?= $jangka_waktu; ?> tahun (<?= $jangka_waktu * 12; ?> bulan)
    <input name="jangka_waktu" type="hidden" required class="form-control" placeholder="Masukkan jangka waktu" value="<?= $jangka_waktu; ?>" readonly>
   </div>
  </div>

  <div class="form-group row">
   <label for="inputPassword" class="col-sm-3 col-form-label">Bunga Pinjaman</label>
   <div class="col-sm-9">
    <?= $bunga_pinjaman; ?>% / bulan menurun
    <input name="bunga_pinjaman" type="hidden" required class="form-control" value="<?= $bunga_pinjaman; ?>">
   </div>
  </div>

  <div class="form-group row">
   <label for="inputPassword" class="col-sm-3 col-form-label">Biaya Administrasi</label>
   <div class="col-sm-9">
    Rp <?= number_format($biaya_adm, 0); ?> <input name="biaya_admin" type="hidden" required class="form-control" placeholder="Masukkan jumlah" value="<?= $biaya_adm; ?>" readonly>
   </div>
  </div>


  <div class="form-group row">
   <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
   <div class="col-sm-9">
    <input type="password" class="form-control" name="passw" placeholder="Password" required>
   </div>
  </div>

  <div class="form-group row">
   <label for="inputPassword" class="col-sm-3 col-form-label">&nbsp;</label>
   <div class="col-sm-9">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required="required">
    Dengan mencentang kolom ini berarti anda telah menyetujui untuk pengajuan pinjaman
   </div>
  </div>

  <div class="form-group row">
   <label for="inputPassword" class="col-sm-3 col-form-label">&nbsp;</label>
   <div class="col-sm-9">

    <button class="btn btn-info" type="submit">Proses</button> <a href="<?php echo base_url(); ?>withdrawal"><button class="btn btn-warning" type="button">Kembali</button></a>
   </div>
  </div>

 </form>
</div>
<div class="hightlight">
 <div class="hightlight">
  <pre>&bull;  Catt: Setiap pinjaman yang diajukan member, akan divalidasi oleh admin dan menunggu proses approval.
&bull;  Proses validasi pengajuan pinjaman maksimal 1 minggu dari tanggal pengajuan.
&bull;  Biaya administrasi sebesar 5% dari pokok pinjaman.
  </pre>
 </div>
