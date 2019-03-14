
<form method="post" action="<?php echo base_url(); ?>index.php/profile/index">
              <div style="color:#F00">
								<?php echo validation_errors(); ?>
								<?php echo $message; ?></div>
                                <h4>Personal Infomation</h4>
                  
  <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
    <label>Full Name</label>
      <input name="nama" class="form-control" value="<?= $this->data_model->dataku("nama",$user_session); ?>" type="text" />
    </div>
    
  <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
    <label>Date of Birth</label>
      <input name="tglahir" class="form-control" value="<?= $this->data_model->dataku("tglahir",$user_session); ?>" type="text" />
    </div>
    
 <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
    <label>ID Card / No. KTP</label>
      <input name="ktp" class="form-control" value="<?= $this->data_model->dataku("ktp",$user_session); ?>" type="number" />
    </div>
    
  <div class="form-group">
    <label>Street Address</label>
                                    <input name="alamat" class="form-control" value="<?= $this->data_model->dataku("alamat",$user_session); ?>" type="text" />
                                </div>
  <div class="form-group">
    <label>City</label>
      <input name="kota" class="form-control" value="<?= $this->data_model->dataku("kota",$user_session); ?>" type="text" />
    </div>
                                <div class="form-group">
                                    <label>State/Province/Region</label>
                                    <input name="propinsi" class="form-control" value="<?= $this->data_model->dataku("propinsi",$user_session); ?>" type="text" />
                                </div>
                                <div class="form-group">
                                    <label>ZIP code/Postal code</label>
                                    <input name="kodepos" class="form-control" value="<?= $this->data_model->dataku("kodepos",$user_session); ?>" type="number" />
                                </div>
                                <div class="form-group">
                                    <label>Country</label>
                                    <input name="negara" class="form-control" value="<?= $this->data_model->dataku("negara",$user_session); ?>" type="text" />
                                </div>
    
   <div class="form-group form-group-icon-left"><i class="fa fa-phone input-icon"></i>
    <label>Mobile Phone</label>
      <input name="hp" class="form-control" value="<?= $this->data_model->dataku("hp",$user_session); ?>" type="text" />
    </div> 
   
  <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon"></i>
    <label>E-mail</label>
      <input name="email" class="form-control" value="<?= $this->data_model->dataku("email",$user_session); ?>" type="text" />
    </div>
                                <!--<div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                                    <label>Account Type</label>
                                    <input name="acc_type" class="form-control" value="<?= $this->data_model->dataku("acc_type",$user_session); ?>" type="text" />
                                </div>-->
        <div class="gap gap-small"></div>
        
        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
            <label>Account Name</label>
            <input name="namarek" class="form-control" value="<?= $this->data_model->dataku("namarek",$user_session); ?>" type="text" />
        </div>
        
        <div class="form-group form-group-icon-left"><i class="fa fa-plane input-icon"></i>
            <label>Account No</label>
            <input name="norek" class="form-control" value="<?= $this->data_model->dataku("norek",$user_session); ?>" type="number" />
        </div>
        
        <div class="form-group form-group-icon-left"><i class="fa fa-plane input-icon"></i>
            <label>Bank Name</label>
            <input name="bank" class="form-control" value="<?= $this->data_model->dataku("bank",$user_session); ?>" type="text" />
        </div>
        
        <div class="form-group form-group-icon-left">
        <input type="submit" class="btn btn-primary" value="Save Changes">
        </div>
    </form>
