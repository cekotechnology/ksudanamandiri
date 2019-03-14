<?php
	error_reporting(E_ALL);

	$notifikasi = "";

	$dataPjm = $this->db->query("
		SELECT 
			*
		FROM pinjaman_header
		WHERE 
			username = ?
			AND `status` = 'DITERIMA'
	", array($user_session));
	
	$dPj = $dataPjm->row();
	
	//cari nilai total tunggakan bunga, mulai ==========================================================================	
	$tunggakan = getTotalTunggakanBunga($user_session, $this->db);
	
	$tunggakan = intval(str_replace(",","",$tunggakan));
	
	// echo "total tunggakan: {$tunggakan}";
	//cari nilai total tunggakan bunga, selesai ==========================================================================

	$getLastId  = $this->db->query(
				"
					SELECT 
						MAX( id ) as maxId 
					FROM pinjaman_detail
				")
			->row()->maxId + 1;
			
	$noTrx_show = "TR" . sprintf("%'.07d\n", $getLastId);
	//   $noTrx_show = "TR" . time();
	//   CEK TUNGGAKAN SEBELUM FEB 2019
	
	if(isset($dataPjm) && $dataPjm->num_rows() > 0)
		$tglPjm     = date('Y-m-d', strtotime($dataPjm->row()->tgl_pengajuan));
	else
		$tglPjm     = date('Y-m-d');
	
	$limitPjm   = date('Y-m-d', strtotime("2019-02-01"));

	if ($this->session->flashdata('error') <> '') {
?>
	<div class="alert alert-warning">
		<strong>Warning!</strong><?php echo $this->session->flashdata('error'); ?>
	</div>
<?php
	}
?>

<?php
	if ($this->session->flashdata('success') <> '') {
 ?>
	<div class="alert alert-success">
		<strong>Success!</strong><?php echo $this->session->flashdata('success'); ?>
	</div>
 <?php
	}
	
	if ($dataPjm->num_rows() > 0) {
		$id_pinjam    = $dataPjm->row()->id_pinjam;
		$periodeBayar = date('Y-m');
		$cA           = $this->db->query("
			SELECT * FROM `pinjaman_detail`
			WHERE id_pinjam = ?
			AND angsuran != 0
			AND DATE_FORMAT(tgl_bayar,'%Y-%m') = ?
		", array($id_pinjam, $periodeBayar))
		->num_rows();

		$cB = $this->db->query("
			SELECT * FROM `pinjaman_detail`
			WHERE 
				id_pinjam = ?
				AND bunga != 0
				AND DATE_FORMAT(tgl_bayar,'%Y-%m') = ?
		", array($id_pinjam, $periodeBayar))->num_rows();
		if ($cA !== 0 && $cB !== 0) {
			$txtAngsuran = "disabled";
			$txtBunga    = "disabled";
			$plcAngsuran = "placeholder='Anda sudah melakukan pembayaran Angsuran bulan ini'";
			$plcBunga    = "placeholder='Anda sudah melakukan pembayaran Bunga bulan ini'";
		} elseif ($cA === 0 && $cB !== 0) {
			$txtAngsuran = "";
			$txtBunga    = "disabled";
			$plcAngsuran = "";
			$plcBunga    = "placeholder='Anda sudah melakukan pembayaran Bunga bulan ini'";
		} elseif ($cA !== 0 && $cB === 0) {
			$txtAngsuran = "disabled";
			$txtBunga    = "";
			$plcAngsuran = "placeholder='Anda sudah melakukan pembayaran Angsuran bulan ini'";
			$plcBunga    = "";
		} else {
			$txtAngsuran = "";
			$txtBunga    = "";
			$plcAngsuran = "";
			$plcBunga    = "";
		}
	} else {
		$notifikasi  = "
			<div class='alert alert-warning'>
			<strong>Perhatian!</strong> Anda tidak mempunyai pinjaman yang aktif saat ini.
			<a href='" . site_url() . "pinjaman/ajukan'>Klik di sini</a> untuk mengajukan pinjaman sekarang.
			</div>
		";
		$txtAngsuran = "disabled";
		$txtBunga    = "disabled";
		$plcAngsuran = "placeholder='Anda tidak punya pinjaman saat ini'";
		$plcBunga    = "placeholder='Anda tidak punya pinjaman saat ini'";
	}
?>

<h4>FORM BAYAR ANGSURAN</h4>
<?= $notifikasi ?>

<?php
	if(!isset($periodeBayar)){
		$periodeBayar = "";
	}

	$action = base_url()."pinjaman/verify_bayar/{$periodeBayar}"; 
	// $action = "javascript:void(0);";	
?>

<form id="transfer" name="transfer" method="post" action="<?php echo $action; ?>" >
	<table class="table table-striped table-bordered">
		<tr>
			<td>Saldo Tabungan Anda saat ini : </td>
			<td>Rp <?php echo number_format($this->ewalet_model->myewaletdone($user_session, ""), 0); ?></td>
		</tr>
		<tr>
			<td>ID. Transaksi</td>
			<td><input name="no_pembayaran" type="text" value="<?= $noTrx_show ?>" class="form-control" id="no_pembayaran" required readonly /></td>
		</tr>
		<tr>
			<td>No. Pembayaran</td>
			
<?php
	if(!isset($id_pinjam)){
		$id_pinjam = 0;
	}
?>			
			
			<td><input name="id_tujuan" type="text" value="<?= $id_pinjam ?>" class="form-control" id="id_tujuan" required readonly /></td>
			<!--<td>...</td>-->
		</tr>
		<tr>
			<td>No Anggota </td>
			<td><?= $user_session; ?> / <?= strtoupper($this->data_model->dataku("nama", $user_session)); ?><input name="username" type="hidden" id="username" value="<?= $user_session; ?>" maxlength="8" required  /></td>
		</tr>
		<tr>
		<td>Jumlah Pembayaran Pokok</td>
			<td><input <?= $txtAngsuran . " " . $plcAngsuran ?> name="jumlah_bayar_pokok" class="form-control uang" onkeyup="sum();" type="number" id="jumlah_bayar_pokok" maxlength="8"   /></td>
		</tr>
		<tr>
			<td>Jumlah Pembayaran Bunga</td>
			<td><input <?= $txtBunga . " " . $plcBunga ?> name="jumlah_bayar_bunga" class="form-control uang" onkeyup="sum();" onBlur="stopCalc();" type="number" id="jumlah_bayar_bunga" maxlength="8"   /></td>
		</tr>
		<!--total pembayaran ini otomatis di jumlahkan dari jml pembayaran pokok dan bunga namun gabisa diklik-->
		<tr>
			<td><strong>Total Pembayaran</strong></td>
			<td>
				<input readonly class="form-control" onchange="tryNumberFormat(this.form.thirdBox);" type="number" id="total_jml_bayar" maxlength="8"  />
				<input name="total_jml_bayar" type="hidden" value="" id="total_jml_bayar1"/>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" class="btn btn-info" name="submit" value="SUBMIT" onclick="return validateForm()"></td>
		</tr>
	</table>
</form>

<script type="text/javascript" language="Javascript">
	function validateForm(){
		var txtFirstNumberValue = document.getElementById('jumlah_bayar_pokok').value;
		var txtSecondNumberValue = document.getElementById('jumlah_bayar_bunga').value;
		if(txtSecondNumberValue > <?php echo $tunggakan; ?>){
			alert("Jumlah kewajiban bunga Anda (Rp <?php echo number_format($tunggakan);?>)");
			
			document.getElementById('jumlah_bayar_bunga').focus();
			document.getElementById('jumlah_bayar_bunga').select();
			return false;
		}

		if(<?php echo $tunggakan; ?> > 0){
			if(txtFirstNumberValue != ""){
				alert("Mohon lunasi dulu tunggakan bunga (Rp <?php echo number_format($tunggakan);?>), sebelum melakukan Pembayaran Pokok");
				document.getElementById('jumlah_bayar_pokok').value = "";				
				sum();
				return false;
			}
		}
	}
	
	function sum() {
		console.log("--1");
		var txtFirstNumberValue = document.getElementById('jumlah_bayar_pokok').value;
		var txtSecondNumberValue = document.getElementById('jumlah_bayar_bunga').value;

		var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);

		if (!isNaN(result)) {
			document.getElementById('total_jml_bayar').value = result;
			document.getElementById('total_jml_bayar1').value = result;
		} else {
			if (txtFirstNumberValue == "" || txtFirstNumberValue == null) {
				txtFirstNumberValue = 0;
			}

			if (txtSecondNumberValue == "" || txtSecondNumberValue == null) {
				txtSecondNumberValue = 0;
			}

			result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);

			document.getElementById('total_jml_bayar').value = result;
			document.getElementById('total_jml_bayar1').value = result;
		}
	}

	function stopCalc() {
		console.log("--2");
		// clearInterval(interval);
	}
</script>
