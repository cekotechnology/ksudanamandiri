<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="col col-lg-6">
<h2>Formulir Pembuatan User Alias</h2>
<?php
if($this->session->flashdata('result_alias')){
?>
<div class="alert alert-danger">
   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
   </button>
	<p class="text-small"><?php echo validation_errors(); ?>
	<?php echo $this->session->flashdata('result_alias'); ?></p>
	
</div>
<?php
}
?>

<?php
if($this->session->flashdata('result_aliase')){
?>
<div class="alert alert-success">
   <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
   </button>
	<p class="text-small"><
	<?php echo $this->session->flashdata('result_aliase'); ?></p>
	
</div>
<?php
}
?>
<form method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">Username Saat ini</label>
    <input type="number" class="form-control" name="username" placeholder="username" value="<?= $username; ?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Nama</label>
    <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?= $nama; ?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Alamat</label>
    <input type="text" class="form-control" name="alamat" placeholder="alamat" value="<?= $alamat; ?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Password</label>
    <input type="text" class="form-control" name="pass" placeholder="pin" value="<?= $pass; ?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Masukkan User Alias</label>
    <input type="number" class="form-control" name="userid" placeholder="userid" value="<?= $userid; ?>">
  </div>
 
  
  <div class="form-group">
    
      <button type="submit" class="btn btn-primary">Submit</button>
    
  </div>
</form>
</div>


</body>
</html>