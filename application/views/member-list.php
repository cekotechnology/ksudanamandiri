<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
if($this->session->flashdata('result_calculate')){
?>
<div class="alert alert-success">
  <strong>Success!</strong> Bonus berhasil di calculate. Trims
</div>
<?php
}
?>
<div class="container">

    <div class="col col-lg-6">
		<form class="form-inline" method="post" action="<?php echo base_url(); ?>member_list/index">
			<div class="form-group mb-2">
			<label>Masukkan kata kunci</label>

			</div>
			<div class="form-group mx-sm-3 mb-2">
			<label for="inputPassword2" class="sr-only">Password</label>
			</div>
			<button type="submit" class="btn btn-primary mb-2">Cari</button>
			<span class="form-group mx-sm-3 mb-2">
			<input type="text" class="form-control" name="txt_cari" value="<?= $cari; ?>" placeholder="Nama or Username">
			</span>
		</form>
		
    </div>
	<div class="col col-lg-6">
		Total Member: <?= $tot_hal; ?>
    
    </div>
</div>   
<br />

<div class="container">
    <table  class="table table-striped">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama</th>
            
            <th>Pin</th>
            <th>Alias</th>
            <th>Sponsor</th>
            <th>BV</th>
            <th>Status</th>
            
            <th>Action</th>
            
        </tr>
        <?php
        $nom=$hal+1;
        foreach($lst_member->result_array() as $db){
            $username = $db['username'];
			$userid = $db['userid'];
            $pass = $db['pin'];
            //$status = check_status($username, $pass);
            if($db['alamat'] == ""){
                $alamat = "-";
            } else {
                $alamat = $db['alamat'];
                
            }
           
            $nama_sponsor = $this->data_model->dataku("nama",$db['sponsor']);
            if($db['blokir'] <> 1){
                
                $status='Aktif';
            } else {
              
                $status='Suspend';
                
            }
        ?>
        <tr>
            <td style="text-align:center"><?= $nom; ?></td>
            <td><?= $db['username']; ?></td>
            <td><?= $db['nama']; ?></td>
            
            <td><?= $db['pin']; ?></td>
            <td><?= $db['userid']; ?></td>
            <td><?= $db['sponsor']; ?><br /><?= $nama_sponsor; ?></td>
            <td><?= $db['bv']; ?></td>
            <td><?= $status; ?></td>
            
            <td><div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="<?php echo base_url(); ?>member_list/register_ppob?username=<?= $db['username']; ?>&alamat=<?= $alamat; ?>&pass=<?= $db['pin']; ?>&nama=<?= $db['nama']; ?>">Reg PPOB</a></li>
     
      <li><a href="<?php echo base_url(); ?>member_list/reset_password?username=<?= $db['username']; ?>&pass=<?= $db['pin']; ?>">Reset Password</a></li>
      <?php
         if($db['blokir'] <> 1){
      ?>
      <li><a href="<?php echo base_url(); ?>member_list/blokir?username=<?= $username; ?>&keywrd=<?= $cari; ?>&per_page=<?= $page; ?>">Blokir Member</a></li>
      <?php
		 } else {
	  ?>
      <li><a href="<?php echo base_url(); ?>member_list/unblokir?username=<?= $username; ?>&keywrd=<?= $cari; ?>&per_page=<?= $page; ?>">unBlokir Member</a></li>
      <?php
		 }
	  ?>
      <li><a href="<?php echo base_url(); ?>member_list/create_alias?username=<?= $username; ?>&userid=<?= $userid; ?>&alamat=<?= $alamat; ?>&pass=<?= $db['pin']; ?>&nama=<?= $db['nama']; ?>&keywrd=<?= $cari; ?>&per_page=<?= $page; ?>">Register Alias</a></li>
      
      <li><a href="<?php echo base_url(); ?>member_list/register_ppob?username=<?= $db['userid']; ?>&alamat=<?= $alamat; ?>&pass=<?= $db['pin']; ?>&nama=<?= $db['nama']; ?>">Reg Alias ke PPOB</a></li>
      
      <li><a href="<?php echo base_url(); ?>member_list/calculate_pairing?username=<?= $db['username']; ?>&keywrd=<?= $cari; ?>&per_page=<?= $page; ?>">Calculate Pairing</a></li>
    </ul>
  </div></td>
        </tr>
        <?php
        $nom++;
        }
        ?>
    </table>
	<center>Total Member: <?= $tot_hal; ?></center>
    <div class="pagination"><?php echo $paginator; ?></div>

</div>

</body>
</html>