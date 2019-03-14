<?php
if($this->data_model->dataku("foto",$user_session) == ""){
    $myfoto = "noimage.jpg";
} else {
    $myfoto = $this->data_model->dataku("foto",$user_session);
}
    if($this->session->userdata('rank_code')==1){
        $harga_paket = 1000;
    } else if($this->session->userdata('rank_code')==2){
        $harga_paket = 500;
    } else if($this->session->userdata('rank_code')==3){
        $harga_paket = 100;
    }
?>

<div class="col-md-3">
	<aside class="user-profile-sidebar">
		<div class="user-profile-avatar text-center">
			<img src="<?php echo base_url();?>asset/foto_profil/<?= $myfoto; ?>" alt="img_foto" style="width:120px;" title="foto Avatar" />
			<h5>Paket <?= $this->data_model->mypaket($user_session); ?></h5>
			<p style="font-size:13px;">Tgl Join - <?= $this->data_model->formatgl($this->data_model->dataku("tgl",$user_session)); ?><br />
			 Saldo tabungan :<br /><?php echo number_format($this->ewalet_model->myewaletdone($user_session,''),0); ?>
			</p>
		</div>
		<ul class="list user-profile-nav">
			<li><a href="#"><i class="fa fa-home"></i><small style='color:#ffffff;'><?php echo $user_session; ?></small></a>
			</li>
			<li><a href="#"><i class="fa fa-user"></i><small style='color:#ffffff;'><?= strtoupper($this->data_model->dataku("nama",$user_session)); ?></small></a>
			</li>
			
			
			
			<li><a href="#"><i class="fa fa-users"></i><small style='color:#ffffff;'><?= strtoupper($this->data_model->dataku("sponsor",$user_session)); ?></small></small></a>
			</li>
			
			
			<li><a href="<?php echo base_url();?>login/logout" onclick="return confirm ('Apakah Anda Yakin Akan Logout?')"><i class="fa fa-sign-out"></i><small style='color:#ffffff;'>SIGN OUT</small></a>
			</li>
		</ul>
	</aside>
</div>