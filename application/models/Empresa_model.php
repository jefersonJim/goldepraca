<?php
class Empresa_model extends CI_Model{
	
	public function salvar($dados){
		$dados = (Object) $dados;
		
		//montando objeto
		$empresa["nm_empresa"] = trim($dados->nome);
		$empresa["nr_cnpj"] = $dados->cnpj;
		$empresa["ds_empresa"] = trim($dados->descricao);
		if(!isset($dados->id)){
			$valid = $this->findEmpresaByCNPJ($dados->cnpj);
			if(count($valid) > 0){
				send_alert("<strong>Erro no cadastro</strong>: Já existe uma empresa cadastrada com o CNPJ <strong>".$dados->cnpj."</strong>.","danger");
				return false;
			}
			$user= $this->session->userdata("user");
			$empresa["cd_usuario"] = $user->ci_usuario;
			$rs = $this->db->insert("tb_empresa", $empresa);
			send_alert("Cadastro realizado com sucesso.","success");
			return $rs;
		}else{
			$valid = $this->findEmpresaByCNPJNotIn($dados->cnpj, array($dados->id));
			if(count($valid) > 0){
				send_alert("<strong>Erro ao atualizar os dados</strong>: Já existe uma empresa cadastrada com o CNPJ <strong>".$dados->cnpj."</strong>.","danger");
				return false;
			}
			$this->db->where('ci_empresa', $dados->id);
			$rs = $this->db->update("tb_empresa", $empresa);
			send_alert("Dados atualizado com sucesso.","success");
			return $rs;
		}	
	}
	
	public function findEmpresas(){
		$user= $this->session->userdata("user");
		$db = $this->db;
		$db->from("tb_empresa");
		$db->where("cd_usuario", $user->ci_usuario);
		$db->order_by("nm_empresa");
		return $db->get()->result();
	}
	
	public function findEmpresa($id){
		$db = $this->db;
		$db->from("tb_empresa");
		$db->where("ci_empresa", $id);
		return $db->get()->row();
	}
	
	private function findEmpresaByCNPJ($cnpj){
		$user= $this->session->userdata("user");
		$db = $this->db;
		$db->from("tb_empresa");
		$db->where("nr_cnpj", $cnpj);
		$db->where("cd_usuario", $user->ci_usuario);
		return $db->get()->row();
	}
	
	private function findEmpresaByCNPJNotIn($cnpj, $notIn){
		$db = $this->db;
		$db->from("tb_empresa");
		$db->where("nr_cnpj", $cnpj);
		$db->where("cd_usuario", $user->ci_usuario);
		$db->where_not_in("ci_empresa", $notIn);
		return $db->get()->row();
	}
	
}