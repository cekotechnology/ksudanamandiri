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
<h4>Menu Request Deposit</h4>



<br />
<?php
if($this->session->flashdata('result_deposit')){
?>
<div class="alert alert-danger">
   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
   </button>
	<p class="text-small"><?php echo validation_errors(); ?>
	<?php echo $this->session->flashdata('result_deposit'); ?></p>
	
</div>
<?php
}
?>

<?php
if($this->session->flashdata('result_deposite')){
?>
<div class="alert alert-success">
   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
   </button>
	<p class="text-small"><?php echo $this->session->flashdata('result_deposite'); ?></p>
	
</div>
<?php
}
?>

<?php
if($this->session->flashdata('result_depositee')){
?>
<div class="alert alert-info">
   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
   </button>
	<p class="text-small"><?php echo $this->session->flashdata('result_depositee'); ?></p>
	
</div>
<?php
}
?>
<div class="bd-example">
<h4></h4>

<form method="post" action="<?php echo base_url(); ?>deposit">
  
  <div class="form-group row">
    <label for="exampleFormControlSelect1" class="col-sm-3 col-form-label">Pilh Nominal Deposit</label>
    <div class="col-sm-9">
    <select class="form-control" name="nominal" required>
      <option value="">-- Pilih Nominal --</option>
      <?php
	  foreach($lst_pkg->result_array() as $db){
		   if($db['biaya'] == $nominal){
			$selec = 'selected="selected"';  
		  } else {
			 $selec = '';
		  }
	  ?>
      <option value="<?= $db['biaya']; ?>" <?= $selec; ?>>Rp <?= number_format($db['biaya'],0); ?> (<?= $db['paket']; ?>)</option>
      <?php
	  }
	  ?>
      
    </select>
    </div>
  </div>
  
  
  <div class="form-group row">
    <label for="exampleFormControlSelect1" class="col-sm-3 col-form-label">Via Bank</label>
    <div class="col-sm-9">
    <select class="form-control" name="bank" required>
      <option value="">-- Pilih Tujuan --</option>
      <?php
	  foreach($lst_rekening->result_array() as $db){
		  if($db['id'] == $bank){
			$selece = 'selected="selected"';  
		  } else {
			 $selece = '';
		  }
	  ?>
      <option value="<?= $db['id']; ?>" <?= $selece; ?>><?= $db['bank']." No Rek. ".$db['norek']." a/n.".$db['namarek']; ?></option>
      <?php
	  }
	  ?>
    </select>
    </div>
  </div>
  
  
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">&nbsp;</label>
    <div class="col-sm-9">
   
      <button class="btn btn-info" type="submit">Submit</button>
      
    </div>
  </div>
  
</form>
</div>
<div class="hightlight">
<pre>&bull; Data Nomer Rekening dan Jumlah Transfer akan dikirim melalui SMS.
&bull; Untuk memudahkan pengecekan maka jumlah transfer akan ditambahkan nomor unik. Misal Rp. 500.018 </pre>
</div>

<br />
<h4>History Request Deposit</h4>
<div class="hightlight">

<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Tgl </th>
        <th>Nominal Transfer</th>
        <th>Rek Tujuan Transfer</th>
        <th>Kode Transfer</th>
        <th>Status</th>
      </tr>
      </thead>
    <tbody>
      <?php
	  foreach($lst_request->result_array() as $db){
		  if($db['status'] == 0){
				$status = "pending";  
		  } else {
			 	$status = "done";
		  }
	  ?>
      <tr>
        <td align="center"><?= date('Y-m-d',strtotime($db['tgl_request'])); ?></td>
        <td><?= number_format($db['nominal_unik'],0); ?></td>
        <td><?= $db['tujuan_bank']; ?> No Rek.<?= $db['tujuan_norek']; ?> a/n.<?= $db['tujuan_namarek']; ?></td>
        <td align="center"><?= $db['kode_transfer']; ?></td>
        <td align="center"><?= $status; ?></td>
      </tr>
      <?php
	  }
	  ?>
    
   
    </tbody>
  </table>

</div>
