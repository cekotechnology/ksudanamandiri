
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
<h4>Menu Withdrawal</h4>
<div class="btn-group btn-group-justified">
  <a href="#" class="btn btn-warning">Withdraw E-Bonus</a>
  <a href="#" class="btn btn-warning">History E-Bonus</a>
  <a href="#" class="btn btn-warning">Withdraw E-Register</a>
  <a href="#" class="btn btn-warning">History E-Register</a>
</div> 


<div class="bd-example">
<h4>Konfirmasi Withdrawal E-Walet Register</h4>
<form method="post" action="<?php echo base_url(); ?>withdrawal/process_withdrawal_eregister">
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-3 col-form-label">Saldo E-Walet Bonus (BV)</label>
    <div class="col-sm-9">
      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo number_format($this->ewalet_model->myeregisterdone($user_session, ""),0); ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Jumlah Withdrawal</label>
    <div class="col-sm-9">
      <input name="jumlah" type="number" required class="form-control" placeholder="Masukkan jumlah" value="<?= $jumlah; ?>" readonly>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Sisa Saldo E-Bonus Setelah Penarikan</label>
    <div class="col-sm-9">
      <input name="sisa" type="number" required class="form-control" placeholder="Sisa saldo" value="<?= $this->ewalet_model->myeregisterdone($user_session, "")-$jumlah; ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-3 col-form-label">Jumlah Withdrawal (Rp)</label>
    <div class="col-sm-9">
      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo number_format($jumlah*1); ?>">
      
      <input type="hidden" readonly class="form-control-plaintext" name="jumlah_rp" value="<?php echo $jumlah*1; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="exampleFormControlSelect1" class="col-sm-3 col-form-label">Tujuan Withdrawal</label>
    <div class="col-sm-9">
    <select class="form-control" name="tujuan">
    
       <?php
	  if($tujuan == "Cash"){
	  ?>
      <option value="Cash" selected>Cash</option>
     
      <?php
	  } else if($tujuan == "Deposit"){
	  ?>
     
      <option value="Deposit" selected>PPOB</option>
      <?php
	  } else {
	  ?>
      
      <?php
	  }
	  ?>
      
    </select>
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
      <button class="btn btn-info" type="submit">Proses</button> <a href="<?php echo base_url(); ?>withdrawal"><button class="btn btn-warning" type="button">Kembali</button></a>
    </div>
  </div>
  
</form>
</div>
<div class="hightlight">
<pre>&bull; Pengisian form penarikan dapat dilakukan setiap hari, pembayaran dilakukan setiap senin - kamis setiap minggunya. 
&bull; Setiap penarikan ke rekening akan dikenakan biaya transfer. 
&bull; Untuk jumlah penarikan dibawah Rp 50.000,- akan di transfer berupa deposit saldo PPOB (Aplikasi Android). 
&bull; Minimal Withdrawal Request <?php echo number_format(50000,0); ?></pre>
</div>
