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
<h4>Menu Upgrade Paket</h4>
<div class="btn-group btn-group-justified">
  <hr />
</div> 


<br />
<div class="bd-example">

<?php
if($this->session->flashdata('result_upgrade')){
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
if($this->session->flashdata('result_upgradee')){
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
<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>upgrade/confirm">
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
    <label for="staticEmail" class="col-sm-3 col-form-label">Masukkan Pin Upgrade</label>
    <div class="col-sm-9">
      <input type="text" required maxlength="14" class="form-control" name="serial" value="">
    </div>
  </div>
  
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">&nbsp;</label>
    <div class="col-sm-9">
      <button class="btn btn-info" type="submit">Next</button>
    </div>
  </div>
  
</form>
</div>
<br />
<h4>Keterangan Paket</h4>
<div class="hightlight">

<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nama Paket</th>
        <th>Biaya Upgrade</th>
        <th>Unit</th>
        <th>Bonus Sponsor</th>
        <th>Bonus Pasangan/Unit</th>
        <th>Pairing</th>
      </tr>
    </thead>
    <tbody>
    <?php
	 foreach($lst_paket->result_array() as $db){
	 ?>
      <tr>
        <td>Paket <?= $db['paket']; ?></td>
        <td>Rp <?= number_format($db['biaya'],0); ?></td>
        <td>RP <?= number_format($db['bv'],0); ?></td>
        <td>Rp <?= number_format($db['ppob'],0); ?></td>
        <td>RP <?= number_format($db['roi'],0); ?></td>
        <td>Rp <?= number_format($db['flushout'],0); ?> pasang/hari</td>
      </tr>
     <?php
	 }
	 ?> 
    </tbody>
  </table>

</div>
