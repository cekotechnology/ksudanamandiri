<?php
$cur_menu = $this->uri->segment(1);
$class8 = "";
if($cur_menu == "home"){
	$class1 = 'class="active"';
	$class2 = '';
	$class3 = '';
	$class4 = '';
	$class5 = '';
	$class6 = '';
	$class7 = '';
} else if($cur_menu == "profile"){
	$class2 = 'class="active"';
	$class1 = '';
	$class3 = '';
	$class4 = '';
	$class5 = '';
	$class6 = '';
	$class7 = '';
} else if($cur_menu == "network"){
	$class3 = 'class="active"';
	$class2 = '';
	$class1 = '';
	$class4 = '';
	$class5 = '';
	$class6 = '';
	$class7 = '';
} else if($cur_menu == "bonus"){
	$class4 = 'class="active"';
	$class1 = '';
	$class3 = '';
	$class2 = '';
	$class5 = '';
	$class6 = '';
	$class7 = '';
} else if($cur_menu == "history"){
	$class5 = 'class="active"';
	$class2 = '';
	$class3 = '';
	$class4 = '';
	$class1 = '';
	$class6 = '';
	$class7 = '';
} else if($cur_menu == "ewalet"){
	$class6 = 'class="active"';
	$class2 = '';
	$class3 = '';
	$class4 = '';
	$class5 = '';
	$class1 = '';
	$class7 = '';
} else if($cur_menu == "pinjaman"){
	$class7 = 'class="active"';
	$class2 = '';
	$class3 = '';
	$class4 = '';
	$class5 = '';
	$class1 = '';
	$class6 = '';
} else if($cur_menu == "ppob"){
	$class8 = 'class="active"';
	$class2 = '';
	$class3 = '';
	$class4 = '';
	$class5 = '';
	$class1 = '';
	$class6 = '';
} else {
	$class2 = '';
	$class1 = '';
	$class3 = '';
	$class4 = '';
	$class5 = '';
	$class6 = '';
	$class7 = '';
}
?>

<div class="container">
                <div class="nav">
                    <ul class="slimmenu" id="slimmenu">
                        <li <?= $class1; ?>><a href="<?php echo base_url();?>home">Dashboard</a>
                        </li>
                        <li <?= $class2; ?>><a href="#">Profile</a>
                            <ul>
                                <li><a href="<?php echo base_url();?>profile"><small style='color:#ffffff;'>Update Profile</small></a>
                                </li>
                                <li><a href="<?php echo base_url();?>profile/changepassword"><small style='color:#ffffff;'>Change Password</small></a>
                                </li>
                                <li><a href="<?php echo base_url();?>profile/changepin"><small style='color:#ffffff;'>Change Pin</small></a>
                                </li>
                                <li><a href="<?php echo base_url();?>profile/upload"><small style='color:#ffffff;'>Upload Photo Profile</small></a>
                                </li>
                            </ul>
                        </li>
                        <li <?= $class3; ?>><a href="#">Network</a>
                            <ul>
                                <li><a href="<?php echo base_url();?>network/sponsor"><small style='color:#ffffff;'>Sponsor Network</small></a>
                                </li>
                                <!--<li><a href="<?php echo base_url();?>network/genealogy"><small>Genealogy</small></a>
                                </li>-->
                                
                                <li><a href="<?php echo base_url();?>network/tree"><small style='color:#ffffff;'>Downline List</small></a>
                                </li>
                                
                               
                            </ul>
                        </li>
                        <li <?= $class4; ?>><a href="#">Bonus</a>
                            <ul>
                                <li><a href="<?php echo base_url();?>bonus/personal"><small style='color:#ffffff;'>Bunga Tabungan</small></a>
                                </li>
                                <li><a href="<?php echo base_url();?>bonus/sponsor"><small style='color:#ffffff;'>Bonus Tabungan</small></a>
                                </li>
                                
                                
                                
                                
                            </ul>
                        </li>
                        
                        <li <?= $class5; ?>><a href="#">History</a>
                            <ul>
                                <li><a href="<?php echo base_url();?>history/index"><small style='color:#ffffff;'>Pembayaran Bonus</small></a>
                                </li>
                               
                                
                                
                            </ul>
                        </li>
						
						 <li><a href="https://ksudanamandiri.com/register/?id=<?= $user_session; ?>" target="_blank">Register</a></li>
                       
                        <li <?= $class6; ?>><a href="#">E-Walet</a>
                            <ul>
                                
                                <li><a href="<?php echo base_url();?>ewalet/index"><small style='color:#ffffff;'>Ewalet History</small></a></li>
								<li><a href="<?php echo base_url();?>ewalet/transfer_saldo"><small style='color:#ffffff;'>Transfer Saldo</small></a></li>
								
								<li><a href="<?php echo base_url();?>withdrawal/index"><small style='color:#ffffff;'>Withdrawal E-Walet</small></a></li>
								<li><a href="<?php echo base_url();?>history_toko/get_list_orders"><small style='color:#ffffff;'>Konfirmasi Pembelian</small></a></li>
                            </ul>
                        </li>
                        
                        <li <?= $class7; ?>><a href="#">Pinjaman</a>
                            <ul>
                                
                                <li><a href="<?php echo base_url(); ?>pinjaman/ajukan"><small style='color:#ffffff;'>Pengajuan Pinjaman</small></a></li>
								<li><a href="<?php echo base_url(); ?>pinjaman/bayar"><small style='color:#ffffff;'>Bayar Angsuran</small></a></li>
								
								<li><a href="<?php echo base_url(); ?>pinjaman/history_pinjaman"><small style='color:#ffffff;'>Buku Pinjaman</small></a></li>
								<li><a href="<?php echo base_url(); ?>pinjaman/status_pinjaman"><small style='color:#ffffff;'>Status Pinjaman</small></a></li>
                            </ul>
                        </li>

                        <li <?= $class8; ?>><a href="<?=base_url('ppob_c/pembelian'); ?>">PPOB</a>
        <!--                    <ul>-->
                                
        <!--                        <li><a href="<?php echo base_url(); ?>ppob_c"><small style='color:#ffffff;'>Pembelian</small></a></li>-->
								<!--<li><a href="<?php echo base_url(); ?>ppob_c/pembayaran"><small style='color:#ffffff;'>Pembayaran</small></a></li>-->
								
        <!--                    </ul>-->
                        </li>
                       
                    </ul>
                </div>
            </div>