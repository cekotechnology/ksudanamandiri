<?php
	if($this->session->flashdata('error')<>'')
	{
?>
<div class="alert alert-warning">
  <strong>Warning!</strong><?php echo $this->session->flashdata('error'); ?>
</div>
<?php
	}
?>

<?php
	if($this->session->flashdata('success')<>'')
	{
?>
<div class="alert alert-success">
  <strong>Success!</strong><?php echo $this->session->flashdata('success'); ?>
</div>
<?php
	}
?>
<h4>TRANSFER SALDO E-WALLET</h4>
<form id="transfer" name="transfer" method="post" action="<?php echo base_url(); ?>ewalet/transfer_saldo">
        <table class="table table-striped table-bordered">
         
          <tr>
            <td>Saldo e-register : </td>
            <td>Rp <?php echo number_format($this->ewalet_model->myewaletdone($user_session, ""),2); ?></td>
          </tr>
          <tr>
            <td>Id tujuan pengiriman : </td>
            <td>
         
            <input name="id_tujuan" class="form-control" type="number" id="id_tujuan" maxlength="16" required /></td>
          </tr>
          <tr>
            <td>Jumlah : </td>
            <td><input name="jumlah" class="form-control" type="number" id="jumlah" maxlength="8" required  /></td>
          </tr>
          <tr>
            <td>Password</td>
            <td><input name="passw" class="form-control" type="password" id="passw" maxlength="25" required /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input class="btn btn-info" type="submit" name="submit" value="NEXT" ></td>
          </tr>
        </table>
       

</form>
