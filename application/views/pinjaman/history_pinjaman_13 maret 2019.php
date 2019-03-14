<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
 .rowBayar{
  background:#dbffdb !important;
 }
 .setrong{
  font-weight: bold;
 }
 .nomor{
  text-align: center;
 }
 .abuabu{
  background: #EAEAEA !important;
 }
</style>
<h4>History Pinjaman Anggota</h4>
<p>&nbsp;</p>
<form action="" method="post" name="form1" id="form1">
 <label>Period from <input name="dc" id="dc" type="text" class="form-controle" style="width:100px;" value="<?= $dc; ?>" size="12" />
  to <input name="dc2" id="dc2" type="text" class="form-controle" style="width:100px;" value="<?= $dc2; ?>" size="12" />
  <input class="btn btn-primary" type="submit" value="Go" /></label>
</form>
<?php
//echo $user_session;
error_reporting(E_ALL);
?>
<table class="table table-bordered table-booking-history">
 <thead style="background:#666; color:#FFF;">
  <tr>
   <th>No</th>
   <th>Tanggal</th>
   <th>Kewajiban Bunga</th>
   <th>Bayar Bunga</th>
   <th>Tunggakan Bunga</th>
   <th>Bayar Pokok</th>
   <th>Sisa Pinjaman</th>
  </tr>
 </thead>
 <tbody>
<?php

	$dataPinjaman = $this->db->query("
		SELECT
			* 
		FROM pinjaman_header 
		WHERE 
			username = ? 
			AND `status` = 'DITERIMA'
	", array($user_session));
	
	// file_put_contents("log.txt", "1#".$this->db->last_query().PHP_EOL, FILE_APPEND);	
	
	$persenBunga  = 2.5 / 100;

	$table_counter = 1;

	if ($dataPinjaman->num_rows() > 0) {
		$idc          = 1;
		$dPj          = $dataPinjaman->row();

		echo "
			<tr class='text-right abuabu t-1'>
				<td class='nomor'>{$table_counter}.</td>
				<td class='tgl_byr'>" . date('d-m-Y', strtotime($dPj->tgl_pengajuan)) . "</td>
				<td class='wajib_bunga'> - </td>
				<td class='byr_bunga'> - </td>
				<td class='tunggakan'> - </td>
				<td class='pokok'> - </td>
				<td class='sisapjm'>" . number_format($dPj->jumlah_disetujui) . "</td>
			</tr>
		 ";
		 $table_counter++; //setiap kali echo $table_counter, $table_counter++;
		$adaTunggakan = getTunggakan($user_session, $dPj->id_pinjam);
		//HEADER HISTORY

		$lSisaPjm = 0;

		if ($adaTunggakan > 0) { //Ada Tunggakan sebelum Februari 2019
		
			$lSisaPjm = $dPj->jumlah_disetujui;
		
			$idc = 3;
			echo "
				<tr class='text-right t-2'>
				<td class='nomor'>{$table_counter}.</td>
				<td class='tgl_byr'>01-02-2019</td>
				<td class='wajib_bunga'>" . number_format($persenBunga * $dPj->jumlah_disetujui) . "</td>
				<td class='byr_bunga'> - </td>
				<td class='tunggakan'>" . number_format($adaTunggakan) . "</td>
				<td class='pokok'> - </td>
				<td class='sisapjm'>" . number_format($dPj->jumlah_disetujui) . "</td>
				</tr>
			 ";
			 $table_counter++; //setiap kali echo $table_counter, $table_counter++;
		} else {
			
		}
	//END HEADER HISTORY
	
		//array month_year mulai ===========================================================================
		$month_year = '';

		$count = 0;
		$month_year_arr = array();
		while($month_year != strval('2019-02')){
			$month_year = date("Y-m",getMonthYear($count));// last month before  current month
			array_push($month_year_arr, $month_year);
			$count++;
		}

		$month_year_arr = array_reverse($month_year_arr);
				
		//array month_year selesai =========================================================================

		$newest_date_display_t7_obj = new stdClass();

		$lTunggakan = $adaTunggakan;

		foreach($month_year_arr as $a_month_year){			
			
			$a_month_year_arr = explode("-",$a_month_year);
			$cursor_month = intval($a_month_year_arr[1]);
			$cursor_year = intval($a_month_year_arr[0]);
			
			if($a_month_year != '2019-02'){				
				//angsuran bulan ini
				if($lSisaPjm != 0) {
					$kewajibanBunga = $lSisaPjm * $persenBunga;
					$lTunggakan = $lTunggakan+$kewajibanBunga-0;
					echo "
						<tr class='text-right t-5'>
						<td class='nomor'>{$table_counter}.</td>
						<td class='tgl_byr'>01-03-2019</td>
						<td class='wajib_bunga'>" . number_format($kewajibanBunga) . "</td>
						<td class='byr_bunga'>-</td>
						<td class='tunggakan'>" . number_format($lTunggakan) . "</td>
						<td class='pokok'>-</td>
						<td class='sisapjm'>" . number_format($lSisaPjm) . "</td>
						</tr>
					";
					
					$table_counter++; //setiap kali echo $table_counter, $table_counter++;
				}				
			}
			
			$dataAngsuran = $this->db->query("
				SELECT * FROM pinjaman_detail 
				WHERE username = '{$user_session}'
					AND id_pinjam = '{$dPj->id_pinjam}'
					and month(tgl_bayar) = {$cursor_month}
					and year(tgl_bayar) = {$cursor_year}
				GROUP BY DATE_FORMAT(tgl_bayar, '%Y-%m')
			");
			
			
			$no           = 3;

			// file_put_contents("log.txt", "1#".$this->db->last_query().PHP_EOL, FILE_APPEND);

			if ($dataAngsuran->num_rows() > 0) { //Ada Angsuran
				$idc      = 6;
				$last_key = end(array_keys($dataAngsuran->result_array()));

				$display_arr = array();

				// file_put_contents("log.txt", "2#".json_encode($dataAngsuran->result_array()).PHP_EOL, FILE_APPEND);

				foreach ($dataAngsuran->result_array() as $key => $a) {
					$periodeBayar   = substr($a['tgl_bayar'], 0, 7);
					$getAngsPeriode = $this->db->query("
						SELECT * FROM pinjaman_detail
						WHERE username ='$user_session' 
							AND id_pinjam = '$dPj->id_pinjam'
							AND DATE_FORMAT(tgl_bayar,'%Y-%m') = '$periodeBayar' 
						ORDER BY tgl_bayar
					");
					
					// file_put_contents("log.txt", "3#".$this->db->last_query().PHP_EOL, FILE_APPEND);
					
					if ($key == $last_key) {
						$kSisaPjm    = $a['sisa_pinjaman'];
						$kTunggakan  = $a['tunggakan_bunga'];
						$kJatuhTempo = $a['tgl_jatuh_tempo'];
					}
					
					$wajibBungaJt = $persenBunga * $a['sisa_pinjaman'];
					$tglJt        = date('d-m-Y', strtotime($a['tgl_jatuh_tempo']));
					$tunggakanJt  = $a['tunggakan_bunga'];

					$last_keys = end(array_keys($getAngsPeriode->result_array()));

					foreach ($getAngsPeriode->result_array() as $keys => $b) {
						$byrBunga    = $b['bunga'] > 0 ? number_format($b['bunga']) : "";
						$byrAngsuran = $b['angsuran'] > 0 ? number_format($b['angsuran']) : "";

						if($byrBunga !== '' && $b['bunga'] > 0 && $b['tunggakan_bunga'] > 0){
						 $b['tunggakan_bunga'] = $b['tunggakan_bunga'] - $b['bunga'];
						};
						if ($keys == $last_keys) {
							$lSisaPjm    = $b['sisa_pinjaman'];
							$lBayarBunga = $b['bunga'];
							$lJatuhTempo = $b['tgl_jatuh_tempo'];
							$lastData = $b;
						}
						
						$lTunggakan = $lTunggakan + 0 - intval(str_replace(",","",$byrBunga));

						echo "
							<tr class='text-right rowBayar setrong t-3'>
							<td class='nomor'>{$table_counter}.</td>
							<td class='tgl_byr'>" . date('d-m-Y', strtotime($b['tgl_bayar'])) . "</td>
							<td class='wajib_bunga'></td>
							<td class='byr_bunga'>" . $byrBunga . "</td>
							<td class='tunggakan'>" . number_format($lTunggakan) . "</td>
							<td class='pokok'>" . $byrAngsuran . "</td>
							<td class='sisapjm'>" . number_format($b['sisa_pinjaman']) 
							. "</td>
							</tr>
						";
						$table_counter++; //setiap kali echo $table_counter, $table_counter++;
					}

					if ($lSisaPjm == "0") {
						$idc = 8;
						echo "
							<tr class='text-center abuabu t-4'>
							<td colspan='7'>L U N A S</td>
							</tr>
						";
					}
				}
				
				// file_put_contents("log.txt", "1#".json_encode($display_arr).PHP_EOL, FILE_APPEND);
			} else { //Tidak Ada Angsuran

				$wajibBungaJt = $persenBunga * $dPj->jumlah_disetujui;
				$tglJt        = $dPj->tgl_pengajuan;
				$tunggakanJt  = getTunggakan($user_session, $dPj->id_pinjam);
				$getLastAngs  = $this->db->query("
					SELECT tgl_jatuh_tempo 
					FROM pinjaman_detail
					WHERE username = ?
						AND id_pinjam = ? 
					ORDER BY tgl_bayar DESC LIMIT 1
				", array($user_session, $dPj->id_pinjam));
				
				// file_put_contents("log.txt", "1#".$this->db->last_query().PHP_EOL, FILE_APPEND);
				
				$tglSkr       = date('Y-m-d');
				if ($tglSkr <= $tglJt) {
					$idc = 13;
					echo "
					<tr class='text-center t-6'>
					<td colspan='7'>Belum Ada Angsuran</td>
					</tr>
					";
				} else {
					$idc = 14;
					$tglTempo = date('Y-m', strtotime("+1 month", strtotime($tglJt))).'-01';
					if($tglTempo <= $tglSkr) {
						
						$a_month_year_pure = str_replace("-","",$a_month_year);
						$to_be_displayed = strval(date('Ym', strtotime("+1 month", strtotime($tglJt))));
						
						if(intval($to_be_displayed) >= intval($a_month_year_pure)){
							$current_date_display_t7_obj = new stdClass();
							$current_date_display_t7_obj->tgl_bayar = "01-".strval(date('m-Y', strtotime("+1 month", strtotime($tglJt))));
							$current_date_display_t7_obj->wajib_bunga = number_format($persenBunga * $dPj->jumlah_disetujui);
							$current_date_display_t7_obj->tunggakan = number_format($tunggakanJt + ($dPj->jumlah_disetujui * $persenBunga));
							$current_date_display_t7_obj->sisapjm = number_format($dPj->jumlah_disetujui);					
							
				// 			if($newest_date_display_t7_obj != $current_date_display_t7_obj) {
								
				// 				$lTunggakan = intval(str_replace(",","",$current_date_display_t7_obj->tunggakan));
								
				// 				echo "
				// 					<tr class='text-right t-7'>
				// 					<td class='nomor'>{$table_counter}.</td>
				// 					<td class='tgl_byr'>{$current_date_display_t7_obj->tgl_bayar}</td>
				// 					<td class='wajib_bunga'>" . $current_date_display_t7_obj->wajib_bunga . "</td>
				// 					<td class='byr_bunga'>-</td>
				// 					<td class='tunggakan'>" . $current_date_display_t7_obj->tunggakan . "</td>
				// 					<td class='pokok'>-</td>
				// 					<td class='sisapjm'>" . $current_date_display_t7_obj->sisapjm . "</td>
				// 					</tr>
				// 				";
								
				// 				$table_counter++; //setiap kali echo $table_counter, $table_counter++;
								
				// 				$newest_date_display_t7_obj = $current_date_display_t7_obj;
				// 			}
						}
					}
				}
			}
		}
	} else {
		$idc = 2;
		echo "
			<tr class='text-center t-8'>
			<td colspan='7'> Tidak ada pembayaran angsuran</td>
			</tr>
		";
	}
  ?>
 </tbody>
</table>
