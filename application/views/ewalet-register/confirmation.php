<h4>KONFIRMASI PENGIRIMAN SALDO E-REGISTER</h4>
<form id="form2" name="form2" method="post" action="<?php echo base_url(); ?>ewalet/transfer_saldo_save">
 
  
  <table class="table table-striped table-bordered">
    
    <tr>
      <td><strong>Saldo E-Wallet :</strong></td>
     
      <td>Rp <?php echo number_format($this->ewalet_model->myewaletdone($user_session, ""),2); ?></td>
    </tr>
    <tr>
      <td>Id Tujuan</td>
      <td><?php echo $id_tujuan; ?> / <?= $nama_tujuan; ?><input name="id_tujuan" type="hidden" id="id_tujuan" value="<?php echo $id_tujuan; ?>" size="15" /></td>
    </tr>
    <tr>
      <td>Jumlah Transfer :</td>
      
      <td><?php echo number_format($jumlah,0); ?><input name="jumlah" type="hidden" id="jumlah" value="<?php echo $jumlah; ?>" size="15" /></td>
    </tr>
    <tr>
      <td><strong>Sisa saldo setelah penarikan :</strong></td>
     
      <td><?php echo number_format($this->ewalet_model->myewaletdone($user_session, "")-$jumlah); ?></td>
    </tr>
    
    <?php 
    if(($this->ewalet_model->myewaletdone($user_session, "")-$jumlah)>=5000000){ ?>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="2">Please enter your password again</td>
      </tr>
    <tr>
      <td><strong>Password :</strong></td>
     
      <td><input name="passw" type="password" id="passw" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" value="PROCESS" ></td>
    </tr>
    <?php
    } else {
    ?>
   
    <tr>
      <td colspan="2" align="center"><div class="alert alert-warning">
  <strong>Warning!</strong>Saldo tidak boleh dibawah Rp 5 Juta
</div></td>
    </tr>
    <?php
    }
    ?>
    
    
  </table>
 
</form>