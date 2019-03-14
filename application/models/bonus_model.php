<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bonus_model extends CI_Model {
	public function rupiah($rp)
	{	
		if($rp<=0){
			$rpe = 0;
		} else {
			$rpe = $rp;
		}
		$rupiah = "";
		$rupiah = "Rp. ".number_format($rpe, 0, '.', ','). ",-";
		return $rupiah;
	}

	//-rupiah------------
	public function rupiah2($rp)
	{
		if($rp<=0){
			$rpe = 0;
		} else {
			$rpe = $rp;
		}
		$rupiah2 = "";
		$rupiah2 = number_format($rpe, 2, '.', ',')." BV";
		return $rupiah2;
	}

}