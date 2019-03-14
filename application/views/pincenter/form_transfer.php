
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
<h4>Transfer Pin</h4>



<div class="bd-example">

<form method="post" action="<?php echo base_url(); ?>pincenter/transfer/proceed">
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-3 col-form-label">Serial/Pin</label>
    <div class="col-sm-9">
      <input type="text" readonly class="form-control-plaintext" id="serial" value="<?php echo $serial; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">ID Tujuan</label>
    <div class="col-sm-9">
      <input name="id_tujuan" type="text" required class="form-control" placeholder="Masukkan id tujuan" >
    </div>
  </div>
  
  
  <div class="form-group row">
    <label for="exampleFormControlSelect1" class="col-sm-3 col-form-label">Jenis Paket</label>
    <div class="col-sm-9">
    <select class="form-control" name="tujuan">
 	  <option value="" selected>-- Pilih Paket --</option>
      <option value="1" selected>Free</option>
      <option value="2" selected>Silver</option>
      <option value="3" selected>Gold</option>
      <option value="4" selected>Platinum</option>
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
<pre>&bull; Pastikan Jenis paket dan ID tujuan sudah benar. 
&bull; Transaksi tidak dapat di batalkan. 

</pre>
</div>
