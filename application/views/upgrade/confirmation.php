
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
<h4>Konfirmasi Upgrade Paket</h4>
<div class="btn-group btn-group-justified">
 <hr  />
</div> 


<div class="bd-example">
<h4></h4>
<form method="post" action="<?php echo base_url(); ?>upgrade/process_upgrade">
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-3 col-form-label">Paket Anda Saat ini</label>
    <div class="col-sm-9">
      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $this->data_model->mypaket($user_session); ?>">
    </div>
  </div>
  
  <div class="form-group row">
    <label for="exampleFormControlSelect1" class="col-sm-3 col-form-label">Upgrade ke Paket</label>
    <div class="col-sm-9">
    <select class="form-control" name="new_paket">
    
     <?php
	 foreach($lst_paket->result_array() as $db){
	 ?>
      <option value="<?= $db['code']; ?>"><?= $db['paket']; ?> (Rp <?= number_format($db['biaya'],0); ?>)</option>
      <?php
	  }
	  ?>
    </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Saldo E-Register saat ini</label>
    <div class="col-sm-9">
      <input name="saldo_eregister" type="number" required class="form-control" placeholder="Masukkan jumlah" value="<?= $this->ewalet_model->myeregisterdone($user_session, ""); ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Biaya Upgrade Paket</label>
    <div class="col-sm-9">
      <input name="biaya_upgrade" type="number" required class="form-control" placeholder="Masukkan jumlah" value="<?= $biaya; ?>" readonly>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Sisa Saldo E-Register Setelah Penarikan</label>
    <div class="col-sm-9">
      <input name="sisa_eregister" type="number" required class="form-control" placeholder="Sisa saldo" value="<?= $this->ewalet_model->myeregisterdone($user_session, "")-$biaya; ?>" readonly>
    </div>
  </div>
  
  
  
  
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="passw" placeholder="Password">
    </div>
  </div>
  
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">&nbsp;</label>
    <div class="col-sm-9">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required="required">
    Dengan mencentang kolom ini berarti anda telah menyetujui pembelian paket upgrade sesuai dengan paket yang telah anda pilih
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
<pre>&bull; Mohon pastikan bahwa paket upgrade yang anda pilih adalah benar. 
&bull; Paket yang anda beli dapat dibatalkan sesuai dengan ketentuan yang berlaku. 
&bull; Upgrade paket akan membuka kesempatan peluang penghasilan yang lebih besar
</pre>
</div>
