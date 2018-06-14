<?php
class Usuario_model extends CI_Model{

	public function findUser($login, $senha){
		$db = $this->db;
		$user = null;

		$db->from("gol.usuario");
		$db->where("nm_login",$login);
		$db->where("ds_senha",md5($senha));
		$user = $db->get()->row();
		if($user == null ){
			$db->from("gol.usuario");
			$db->where("nm_login",strtoupper($login));
			$db->where("ds_senha",md5($senha));
			$user = $db->get()->row();

			if($user == null){
				$db->from("gol.usuario");
				$db->where("nm_login",strtoupper($login));
				$db->where("ds_senha",md5(strtoupper($senha)));
				$user = $db->get()->row();				
			}
		}

		return $user;
	}
}