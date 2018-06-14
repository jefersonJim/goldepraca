<?php
class Produto_model extends CI_Model{
	public function salvar($dados){
		$dados = (Object) $dados;
	
		//montando objeto
		$produto["nm_produto"] = trim($dados->nome);
		$produto["nr_codigo"] = $dados->codigo;
		$preco = preg_replace("/\./","", $dados->preco);
		$preco = preg_replace("/\,/",".", $preco);
		$produto["nr_preco"] = $preco;
		//$produto["nr_quantidade"] = $dados->quantidade;
		$produto["cd_fornecedor"] = trim($dados->fornecedor);
		
		if(!isset($dados->id)){
			$valid = $this->findProdutoByCodigo($dados->codigo);
			if(count($valid) > 0){
				send_alert("<strong>Erro no cadastro</strong>: Já existe um Produto cadastrado com o Código <strong>".$dados->codigo."</strong>.","danger");
				return false;
			}
			$rs = $this->db->insert("tb_produto", $produto);
			send_alert("Cadastro realizado com sucesso.","success");
			return $rs;
		}else{
			$valid = $this->findProdutoByCodigoNotIn($dados->codigo, array($dados->id));
			if(count($valid) > 0){
				send_alert("<strong>Erro ao atualizar os dados</strong>: Já existe um Produto cadastrado com o Código <strong>".$dados->codigo."</strong>.","danger");
				return false;
			}
			$this->db->where('ci_produto', $dados->id);
			$rs = $this->db->update("tb_produto", $produto);
			send_alert("Dados atualizado com sucesso.","success");
			return $rs;
		}
	}
	
	public function findProdutoById($id){
		$db = $this->db;
		$db->from("tb_produto");
		$db->where("ci_produto", $id);
		return $db->get()->row();
	}
	
	public function findProdutoByFornecedor($obj){
		$fornecedor = (isset($obj["fornecedor"]) ? $obj["fornecedor"] : 0);
		$db = $this->db;
		$db->from("tb_produto");
		$db->where("cd_fornecedor", $fornecedor);
		return $db->get()->result();
	}
	
	private function findProdutoByCodigo($codigo){
		$user= $this->session->userdata("user");
		$db = $this->db;
		$db->from("tb_produto p");
		$db->join("tb_fornecedor f","f.ci_fornecedor = p.cd_fornecedor");
		$db->where("nr_codigo", $codigo);
		$db->where("f.cd_usuario", $user->ci_usuario);
		
		return $db->get()->row();
	}
	
	private function findProdutoByCodigoNotIn($codigo, $notIn){
		$user= $this->session->userdata("user");
		$db = $this->db;
		$db->from("tb_produto p");
		$db->join("tb_fornecedor f","f.ci_fornecedor = p.cd_fornecedor");
		$db->where("nr_codigo", $codigo);
		$db->where("f.cd_usuario", $user->ci_usuario);
		$db->where_not_in("ci_produto", $notIn);
		return $db->get()->row();
	}
}