<?php

function getTunggakan($user, $idp) {
	$ci        = & get_instance();
	$dPj       = $ci->db->query("
		SELECT *
		FROM pinjaman_header
		WHERE 
			username = ?
			AND `status` = 'DITERIMA'
			AND id_pinjam = ?
	", array($user, $idp))->row();

	$tglPj     = date('Y-m-d', strtotime($dPj->tgl_pengajuan));
	$tglBatas  = "2019-02-01";
	$periodePj = substr($tglPj, 0, 7);
	if ($tglPj < $tglBatas && $periodePj == "2018-10") {
		//  $tunggakan = 500000 - $byrBunga;
		$tunggakan = 500000;
	} elseif ($tglPj < $tglBatas && $periodePj == "2018-11") {
		//  $tunggakan = 375000 - $byrBunga;
		$tunggakan = 375000;
	} elseif ($tglPj < $tglBatas && $periodePj == "2018-12") {
		//  $tunggakan = 250000 - $byrBunga;
		$tunggakan = 250000;
	} elseif ($tglPj < $tglBatas && $periodePj == "2019-01") {
		//  $tunggakan = 125000 - $byrBunga;
		$tunggakan = 125000;
	} else {
		$tunggakan = 0;
	}
	return $tunggakan;
}

function getSisaPinjaman($user, $idp) {
	$ci    = & get_instance();
	$dPj   = $ci->db->query("
		SELECT 
			jumlah_disetujui
		FROM pinjaman_header
		WHERE 
			username = ?
			AND `status` = 'DITERIMA'
			AND id_pinjam = ?
	", array($user, $idp))->row()->jumlah_disetujui;
	
	$dAngs = $ci->db->query("
		SELECT 
			SUM( angsuran ) as jmlAngs
		FROM pinjaman_detail
		WHERE 
			username = ?
			AND id_pinjam = ?
	", array($user, $idp))->row()->jmlAngs;
	
	return $dPj - $dAngs;
}

function getMonthYear($beforeMonth = '') {
	if($beforeMonth !="" && $beforeMonth >= 1) {
		$date = date('Y')."-".date('m')."-15";
		$timestamp_before = strtotime( $date . ' -'.$beforeMonth.' month' );
		return $timestamp_before;
	} else {
		$time= time();
		return $time;
	}
}

function getTotalTunggakanBunga($user_session, $db_conn){
	$dataPinjaman = $db_conn->query("
		SELECT
			* 
		FROM pinjaman_header 
		WHERE 
			username = ? 
			AND `status` = 'DITERIMA'
	", array($user_session));

	// file_put_contents("log.txt", "1#".$db_conn->last_query().PHP_EOL, FILE_APPEND);	
	
	$persenBunga  = 2.5 / 100;
	
	$totalTunggakanBunga = 0;
	$totalbayarBunga =0;
	if ($dataPinjaman->num_rows() > 0) {
		$dPj          = $dataPinjaman->row();

		$totalTunggakanBunga = 0;

		$adaTunggakan = getTunggakan($user_session, $dPj->id_pinjam);

		// var_dump($dPj->id_pinjam);
		$jumBayar =  $db_conn->query("SELECT sum(bunga) bayar_bunga,id_pinjam,username from pinjaman_detail where id_pinjam='{$dPj->id_pinjam}' 
		GROUP BY  id_pinjam,username");
		$totalbayarBunga          = $jumBayar->row();

		//HEADER HISTORY
// var_dump($adaTunggakan);
		$lSisaPjm = 0;
		if ($adaTunggakan > 0) { //Ada Tunggakan sebelum Februari 2019
			$lSisaPjm = $dPj->jumlah_disetujui;
			$t_2_last_obj = new stdClass();
			$t_2_last_obj->tgl_bayar = '01-02-2019';
			$t_2_last_obj->wajib_bunga = number_format($persenBunga * $dPj->jumlah_disetujui);
			$t_2_last_obj->sisapjm = number_format($dPj->jumlah_disetujui);			
			
			$totalTunggakanBunga = $adaTunggakan;
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
		
		$t_7_last_obj = new stdClass();

		foreach($month_year_arr as $a_month_year){			
			
			$a_month_year_arr = explode("-",$a_month_year);
			$cursor_month = intval($a_month_year_arr[1]);
			$cursor_year = intval($a_month_year_arr[0]);
			
			if($a_month_year != '2019-02'){				
				//angsuran bulan ini
				if($lSisaPjm != 0) {
					$kewajibanBunga = $lSisaPjm * $persenBunga;
					$lTunggakan = $lTunggakan+$kewajibanBunga-0;
					
					$t_5_current_obj = new stdClass();
					$t_5_current_obj->tgl_bayar = '01-03-2019';
					$t_5_current_obj->wajib_bunga = number_format($kewajibanBunga);
					$t_5_current_obj->sisapjm = number_format($lSisaPjm);						
					// var_dump($t_7_last_obj,'<br>',$t_5_current_obj);
					if($t_5_current_obj === $t_7_last_obj){					
						$totalTunggakanBunga = $lTunggakan;
					}
				}				
			}
			
			$dataAngsuran = $db_conn->query("
				SELECT * FROM pinjaman_detail 
				WHERE username = '{$user_session}'
					AND id_pinjam = '{$dPj->id_pinjam}'
					and month(tgl_bayar) = {$cursor_month}
					and year(tgl_bayar) = {$cursor_year}
				GROUP BY DATE_FORMAT(tgl_bayar, '%Y-%m')
			");
			$no           = 3;

			// file_put_contents("log.txt", "1#".$db_conn->last_query().PHP_EOL, FILE_APPEND);

			if ($dataAngsuran->num_rows() > 0) { //Ada Angsuran
				$last_key = end(array_keys($dataAngsuran->result_array()));

				$display_arr = array();

				// file_put_contents("log.txt", "2#".json_encode($dataAngsuran->result_array()).PHP_EOL, FILE_APPEND);

				foreach ($dataAngsuran->result_array() as $key => $a) {
					$periodeBayar   = substr($a['tgl_bayar'], 0, 7);
					$getAngsPeriode = $db_conn->query("
						SELECT * FROM pinjaman_detail
						WHERE username ='$user_session' 
							AND id_pinjam = '$dPj->id_pinjam'
							AND DATE_FORMAT(tgl_bayar,'%Y-%m') = '$periodeBayar' 
						ORDER BY tgl_bayar
					");
					
					// file_put_contents("log.txt", "3#".$db_conn->last_query().PHP_EOL, FILE_APPEND);
					
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

						$totalTunggakanBunga = $lTunggakan;
						
					}

					if ($lSisaPjm == "0") {
						$totalTunggakanBunga = 0;
					}
				}
				
				// file_put_contents("log.txt", "1#".json_encode($display_arr).PHP_EOL, FILE_APPEND);
			} else { //Tidak Ada Angsuran

				$wajibBungaJt = $persenBunga * $dPj->jumlah_disetujui;
				$tglJt        = $dPj->tgl_pengajuan;
				$tunggakanJt  = getTunggakan($user_session, $dPj->id_pinjam);
				$getLastAngs  = $db_conn->query("
					SELECT tgl_jatuh_tempo 
					FROM pinjaman_detail
					WHERE username = ?
						AND id_pinjam = ? 
					ORDER BY tgl_bayar DESC LIMIT 1
				", array($user_session, $dPj->id_pinjam));
				
				// file_put_contents("log.txt", "1#".$db_conn->last_query().PHP_EOL, FILE_APPEND);
				
				$tglSkr       = date('Y-m-d');
				if ($tglSkr <= $tglJt) {
				} else {
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

							$t_7_last_obj = new stdClass();
							$t_7_last_obj->tgl_bayar = $current_date_display_t7_obj->tgl_bayar;
							$t_7_last_obj->wajib_bunga = $current_date_display_t7_obj->wajib_bunga;
							$t_7_last_obj->sisapjm = $current_date_display_t7_obj->sisapjm;							
							$t_2_last_obj = new stdClass();
							if(
								$newest_date_display_t7_obj != $current_date_display_t7_obj
								&& $t_7_last_obj != $t_2_last_obj
							)
							{
								
								$lTunggakan = intval(str_replace(",","",$current_date_display_t7_obj->tunggakan));
								
								$totalTunggakanBunga = $current_date_display_t7_obj->tunggakan;
								
								$newest_date_display_t7_obj = $current_date_display_t7_obj;
							}
						}
					}
				}
			}
		}
	}
	$terbayarBunga =$totalbayarBunga->bayar_bunga;
	if($totalbayarBunga->bayar_bunga ===NULL){
		$terbayarBunga=0;
	}
	$total = intval(str_replace(",","",$totalTunggakanBunga));
	return number_format($total-$terbayarBunga);
}
