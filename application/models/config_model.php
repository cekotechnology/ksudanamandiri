<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends CI_Model {

	function index($field) {

			//$this->select($field, "configuration", "id=1");

			//$kat = $this->result(0, $field);

			$sql=mysql_query("select $field from configuration where id=1");

			$row=mysql_fetch_row($sql);

			$kat = $row[0];

			return $kat;

	}
	
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */