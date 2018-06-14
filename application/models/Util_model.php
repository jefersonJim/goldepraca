<?php
class Util_model extends CI_Model{
	public function findAllBancos(){
		$db = $this->db;
		$db->from("tb_banco");
		$db->order_by("nm_banco");
		return $db->get()->result();
	}
	
	public function findAllTpconta(){
		$db = $this->db;
		$db->from("tb_tpconta");
		$db->order_by("ds_tpconta");
		return $db->get()->result();
	}
	
	public function findAllTpMovimento(){
		$db = $this->db;
		$db->from("tb_tpmovimento");
		$db->order_by("ds_tpmovimento");
		return $db->get()->result();
	}
}