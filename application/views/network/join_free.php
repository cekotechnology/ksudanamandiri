<script>
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    } else {
        return true;
    }      
}

function myFunction() {
    var x = document.getElementById("username").value;
    document.getElementById("hp").value = x;
}
</script>

<?php
if(empty($sponsor) OR empty($upline) OR empty($posisi)){
	redirect(base_url().'network/genealogy_free');
} else {
?>

<div class="bd-example">
<form method="post" action="<?php echo base_url(); ?>network/join_free">
              
                                <h4><?= $page_title; ?></h4>
                                <?php
                                if($message){
                                ?>
                                <div class="alert alert-info">
									   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
									   </button>
										<p class="text-small">
								<?php echo validation_errors(); ?>
								<?php echo $message; ?></p>
								</div>
								<?php
                                }
								?>
  
    
    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
    <label>Sponsor</label>
      <input name="sponsor" class="form-control" value="<?= $sponsor; ?>" type="text" readonly required />
    </div>
    
    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
    <label>Upline</label>
      <input name="upline" class="form-control" value="<?= $upline; ?>" type="text" readonly  required />
    </div>
    
    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
    <label>Position</label>
      <input name="posisi" class="form-control" value="<?= $posisi; ?>" type="text" readonly required />
    </div>
  <hr />
  <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
    <label>Username (*HP number)</label>
      <input name="username" id="username" class="form-control" value="<?= $username; ?>" type="text" required onKeyPress="return isNumberKey(event)" onkeyup="myFunction()" minlength="10" maxlength="15" />
    </div>
    
  <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
    <label>Password</label>
    <input name="pass" class="form-control" value="<?= $pass; ?>" type="password" maxlength="6" required />
    </div>
    
  <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
    <label>Confirm Pasword</label>
    <input name="pass2" class="form-control" value="<?= $pass2; ?>" type="password" maxlength="6" required />
    </div>
  <hr />
   <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
    <label>Choose Package <?= $jenis_paket;?></label>
      <select name="jenis_paket" class="form-control" required>
       <option value="">-- Choose Package --</option>
      <?php
	  
	  for($i=0;$i<1;$i++)
	  	{
			$j = $i+1;
			if($j == $jenis_paket){
				$sele = 'selected="selected"';	
			} else {
				$sele = '';
			}
	  ?>
      <option value="<?= $j; ?>" <?= $sele; ?>>Paket <?= $pkt[$i]; ?> (Rp 0) Free</option>
      <?php
	 	}
	  ?> 
      </select>
    </div>               
  <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
    <label>Nama Lengkap</label>
      <input name="nama" type="text" class="form-control" value="<?= $nama; ?>" required />
    </div>
  
  <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
    <label>Date of Birth <i>(format : yyyy-mm-dd)</i></label>
      <input name="tglahir" type="text" class="form-control" value="<?= $tglahir; ?>" />
    </div>
    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
    <label>No KTP</label>
      <input name="ktp" type="text" class="form-control" value="<?= $ktp; ?>" required />
    </div>
  <div class="form-group">
    <label>Alamat</label>
                                    <input name="alamat"  type="text" class="form-control" value="<?= $alamat; ?>" />
                                </div>
  <div class="form-group">
    <label>Kota</label>
      <input name="kota" type="text" class="form-control" value="<?= $kota; ?>" required />
    </div>
                                <div class="form-group">
                                    <label>Propinsi</label>
                                    <input name="propinsi" type="text" class="form-control" value="<?= $propinsi; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    <input name="kodepos" type="text" class="form-control" value="<?= $kodepos; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Negara</label>
                                    <input name="negara" type="text" class="form-control" value="<?= $negara; ?>" required />
                                </div>
    
   <div class="form-group form-group-icon-left"><i class="fa fa-phone input-icon"></i>
    <label>No Hp</label>
      <input name="hp" id="hp" type="text" class="form-control" value="<?= $hp; ?>" readonly="readonly" required  />
    </div> 
   
  <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon"></i>
    <label>E-mail</label>
      <input name="email" type="text" class="form-control" value="<?= $email; ?>" required />
    </div>
                                
                                <div class="gap gap-small"></div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-plane input-icon"></i>
                                    <label>Nama Bank</label>
                                    <input name="bank" class="form-control" value="<?= $bank; ?>" />
                                </div>
                                
                                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                                    <label>Nama Rekening</label>
                                    <input name="namarek" type="text" class="form-control" value="<?= $namarek; ?>" />
                                </div>
                                
                                <div class="form-group form-group-icon-left"><i class="fa fa-plane input-icon"></i>
                                    <label>No. Rekening.</label>
                                    <input name="norek" type="text" class="form-control" value="<?= $norek; ?>" />
                                </div>
                                
                                
                                
                                <hr>
                                <input name="verified" type="submit" class="btn btn-info" value="Verified Data">
                            </form>
</div>
<?php
}
?>