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
  <a href="<?php echo base_url(); ?>withdrawal" class="btn btn-warning">Withdraw E-Bonus</a>
  <a href="<?php echo base_url(); ?>history" class="btn btn-warning">History E-Bonus</a>
  <a href="<?php echo base_url(); ?>withdrawal/eregister" class="btn btn-warning">Withdraw E-Register</a>
  <a href="<?php echo base_url(); ?>history/eregister" class="btn btn-warning">History E-Register</a>
</div> 


<br />
<div class="bd-example">
<h4>Form Withdrawal E-Walet Register</h4>
<?php
if($this->session->flashdata('result_withdrawal')){
?>
<div class="alert alert-danger">
   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
   </button>
	<p class="text-small"><?php echo validation_errors(); ?>
	<?php echo $this->session->flashdata('result_withdrawal'); ?></p>
	
</div>
<?php
}
?>

<?php
if($this->session->flashdata('result_withdrawale')){
?>
<div class="alert alert-success">
   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
   </button>
	<p class="text-small"><
	<?php echo $this->session->flashdata('result_withdrawale'); ?></p>
	
</div>
<?php
}
?>
<form method="post" action="<?php echo base_url(); ?>withdrawal/eregister_confirm">
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-3 col-form-label">Saldo E-Walet Register (Rp)</label>
    <div class="col-sm-9">
      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo number_format($this->ewalet_model->myeregisterdone($user_session, ""),2); ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Jumlah Withdrawal</label>
    <div class="col-sm-9">
      <input name="jumlah" type="number" required class="form-control" placeholder="Masukkan jumlah" value="<?= $jumlah; ?>">
    </div>
  </div>
  
  <div class="form-group row">
    <label for="exampleFormControlSelect1" class="col-sm-3 col-form-label">Tujuan Withdrawal</label>
    <div class="col-sm-9">
    <select class="form-control" name="tujuan">
      <option value="">-- Pilih Tujuan --</option>
      <?php
	  if($tujuan == "Cash"){
	  ?>
      <option value="Cash" selected>Cash</option>
      <option value="Deposit">PPOB</option>
      <?php
	  } else if($tujuan == "Deposit"){
	  ?>
      <option value="Cash">Cash</option>
      <option value="Deposit" selected>PPOB</option>
      <?php
	  } else {
	  ?>
      <option value="Cash">Cash</option>
      <option value="Deposit">PPOB</option>
      <?php
	  }
	  ?>
    </select>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="passw" placeholder="Password" autocomplete="off" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">&nbsp;</label>
    <div class="col-sm-9">
      <button class="btn btn-warning" type="submit">Submit</button>
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
