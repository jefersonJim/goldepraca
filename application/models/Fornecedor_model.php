<?php
class Fornecedor_model extends CI_Model{

	public function salvar($dados){
		$dados = (Object) $dados;

		//montando objeto
		$fornecedor["nm_fornecedor"] = trim($dados->nome);
		$fornecedor["nr_cnpj"] = $dados->cnpj;
		$fornecedor["ds_fornecedor"] = trim($dados->descricao);
		if(!isset($dados->id)){
			$valid = $this->findFornecedorByCNPJ($dados->cnpj);
			if(count($valid) > 0){
				send_alert("<strong>Erro no cadastro</strong>: Já existe um Fornecedor cadastrado com o CNPJ <strong>".$dados->cnpj."</strong>.","danger");
				return false;
			}
			$user= $this->session->userdata("user");
			$fornecedor["cd_usuario"] = $user->ci_usuario;
			$rs = $this->db->insert("tb_fornecedor", $fornecedor);
			send_alert("Cadastro realizado com sucesso.","success");
			return $rs;
		}else{
			$valid = $this->findFornecedorByCNPJNotIn($dados->cnpj, array($dados->id));
			if(count($valid) > 0){
				send_alert("<strong>Erro ao atualizar os dados</strong>: Já existe um Fornecedor cadastrado com o CNPJ <strong>".$dados->cnpj."</strong>.","danger");
				return false;
			}
			$this->db->where('ci_fornecedor', $dados->id);
			$rs = $this->db->update("tb_fornecedor", $fornecedor);
			send_alert("Dados atualizado com sucesso.","success");
			return $rs;
		}
	}

	public function findFornecedores(){
		$user= $this->session->userdata("user");
		$db = $this->db;
		$db->from("tb_fornecedor");
		$db->where("cd_usuario", $user->ci_usuario);
		$db->order_by("nm_fornecedor");
		return $db->get()->result();
	}

	public function findFornecedor($id){
		$db = $this->db;
		$db->from("tb_fornecedor");
		$db->where("ci_fornecedor", $id);
		return $db->get()->row();
	}

	private function findFornecedorByCNPJ($cnpj){
		$user= $this->session->userdata("user");
		$db = $this->db;
		$db->from("tb_fornecedor");
		$db->where("nr_cnpj", $cnpj);
		$db->where("cd_usuario", $user->ci_usuario);
		return $db->get()->row();
	}

	private function findFornecedorByCNPJNotIn($cnpj, $notIn){
		$user= $this->session->userdata("user");
		$db = $this->db;
		$db->from("tb_fornecedor");
		$db->where("nr_cnpj", $cnpj);
		$db->where("cd_usuario", $user->ci_usuario);
		$db->where_not_in("ci_fornecedor", $notIn);
		return $db->get()->row();
	}

}