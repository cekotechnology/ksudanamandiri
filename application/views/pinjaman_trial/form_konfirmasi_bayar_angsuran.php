
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
<h4>Konfirmasi Bayar Angsuran</h4>
<div class="btn-group btn-group-justified">
 <hr  />
</div>


<div class="bd-example">
 <h4></h4>
 <form method="post" action="<?php echo base_url(); ?>pinjaman_trial/bayar_pinjaman">
  <div class="form-group row">
   <label for="staticEmail" class="col-sm-3 col-form-label">ID Transaksi</label>
   <div class="col-sm-9">
    <code><?= $no_pembayaran ?></code>
    <input type="hidden" name="no_pembayaran" readonly class="form-control" value="<?= $no_pembayaran; ?>">
   </div>
  </div>
  <div class="form-group row">
   <label for="staticEmail" class="col-sm-3 col-form-label">No Pembayaran</label>
   <div class="col-sm-9">
    <code><?= $id_pinjam ?></code>
    <input type="hidden" name="id_tujuan" readonly class="form-control" value="<?= $id_pinjam; ?>">
   </div>
  </div>

  <div class="form-group row">
   <label for="staticEmail" class="col-sm-3 col-form-label">Nama Anggota</label>
   <div class="col-sm-9">
    <?= strtoupper($this->data_model->dataku("nama", $user_session)); ?>
    <input type="hidden" readonly name="username" class="form-control" value="<?= $user_session; ?>">
   </div>
  </div>

  <div class="form-group row">
   <label for="inputPassword" class="col-sm-3 col-form-label">Jumlah Bayar Pokok</label>
   <div class="col-sm-9">
    Rp <?= number_format($angsuran, 0); ?>
    <input name="jumlah_bayar_pokok" type="hidden" required class="form-control" placeholder="Masukkan jumlah" value="<?= $angsuran; ?>" readonly>
   </div>
  </div>

  <div class="form-group row">
   <label for="inputPassword" class="col-sm-3 col-form-label">Jumlah Bayar Bunga</label>
   <div class="col-sm-9">
    Rp <?= number_format($bunga, 0); ?>
    <input name="jumlah_bayar_bunga" type="hidden" required class="form-control" placeholder="Masukkan jumlah" value="<?= $bunga; ?>" readonly>
   </div>
  </div>

  <div class="form-group row">
   <label for="inputPassword" class="col-sm-3 col-form-label">Total Bayar</label>
   <div class="col-sm-9">
    Rp <?= number_format($jumlah_bayar, 0); ?>
    <input name="total_jml_bayar" type="hidden" required class="form-control" placeholder="Masukkan jumlah" value="<?= $jumlah_bayar; ?>" readonly>
   </div>
  </div>

  <!--<div class="form-group row">-->
  <!--  <label for="inputPassword" class="col-sm-3 col-form-label">Jangka Waktu</label>-->
  <!--  <div class="col-sm-9">-->
  <!--    <?= $jangka_waktu; ?> tahun (<?= $jangka_waktu * 12; ?> bulan) <input name="jangka_waktu" type="hidden" required class="form-control" placeholder="Masukkan jangka waktu" value="<?= $jangka_waktu; ?>" readonly>-->
  <!--  </div>-->
  <!--</div>-->

  <!--<div class="form-group row">-->
  <!--  <label for="inputPassword" class="col-sm-3 col-form-label">Bunga Pinjaman</label>-->
  <!--  <div class="col-sm-9">-->
  <!--    <?= $bunga_pinjaman; ?>% / bulan menurun<input name="bunga_pinjaman" type="hidden" required class="form-control" placeholder="Bunga Pinjaman" value="<?= $bunga_pinjaman; ?>" readonly>-->
  <!--  </div>-->
  <!--</div>-->

  <!--<div class="form-group row">-->
  <!--  <label for="inputPassword" class="col-sm-3 col-form-label">Biaya Administrasi</label>-->
  <!--  <div class="col-sm-9">-->
  <!--   Rp <?= number_format($biaya_adm, 0); ?> <input name="biaya_admin" type="hidden" required class="form-control" placeholder="Masukkan jumlah" value="<?= $biaya_adm; ?>" readonly>-->
  <!--  </div>-->
  <!--</div>-->


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
    Dengan mencentang kolom ini berarti anda telah menyetujui untuk membayar angsuran pinjaman
   </div>
  </div>

  <div class="form-group row">
   <label for="inputPassword" class="col-sm-3 col-form-label">&nbsp;</label>
   <div class="col-sm-9">
    <button class="btn btn-info" type="submit">BAYAR</button> <a href="<?php echo base_url(); ?>withdrawal"><button class="btn btn-warning" type="button">KEMBALI / BATAL</button></a>
   </div>
  </div>

 </form>
</div>
<div class="hightlight">
 <div class="hightlight">
  <pre><strong>Informasi:</strong>
&bull;  Ketika anda mencentang kolom diatas, berarti kami menganggap anda setuju dan tunduk pada kebijakan kami.
&bull;  Setiap pembayaran anggota akan tercatat dan tersimpan disystem kami.
&bull;  Pastikan anda menyimpan nomor pinjaman atau nomor transaksi pinjaman.
  </pre>
 </div>
