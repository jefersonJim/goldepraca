<?php
class ContaBancaria_model extends CI_Model{
	public function salvar($dados){
		$dados = (Object) $dados;
		//montando objeto
		$conta["cd_empresa"] = $dados->empresa;
		$conta["cd_banco"] = $dados->banco;
		$conta["nr_agencia"] = $dados->agencia;
		$conta["nr_dig_agencia"] = $dados->dig_agencia;
		$conta["nr_conta"] = $dados->conta;
		$conta["nr_dig_conta"] = $dados->dig_conta;
		$conta["cd_tpconta"] = $dados->tipo;
		
		if(!isset($dados->id)){
			
			$conta["nr_saldo"] = 0;
			$rs = $this->db->insert("tb_conta", $conta);
			send_alert("Cadastro realizado com sucesso.","success");
			return $rs;
		}else{
			
			$this->db->where('ci_conta', $dados->id);
			$rs = $this->db->update("tb_conta", $conta);
			send_alert("Dados atualizado com sucesso.","success");
			return $rs;
		}
	}
	
	
	public function salvarMovimento($dados){
		date_default_timezone_set('America/Sao_Paulo');
		$dados = (Object) $dados;
		
		//montando objeto
		$mov["cd_conta"] = $dados->id_conta;
		$valor = preg_replace("/\./","", $dados->valor);
		$valor = preg_replace("/\,/",".", $valor);
		$mov["nr_valor"] = $valor;
		$mov["ds_movimento"] = $dados->descricao;
		
		$mov["cd_tpmovimento"] = $dados->tipo;
		$mov["dt_movimento_ref"] = date_format(new DateTime(strtotime($dados->data)),"Y/m/d");
		$saldo = ($dados->tipo == 1 ? $dados->saldo + $valor  :  $dados->saldo - $valor);
		$mov["nr_saldo"] = $saldo;
		$rs = $this->db->insert("tb_movimento", $mov);
		
		
		$conta["nr_saldo"] =  $saldo;
		$this->db->where('ci_conta', $dados->id_conta);
		$rs = $this->db->update("tb_conta", $conta);
		send_alert("Cadastro realizado com sucesso.","success");
		return $rs;
	}
	
	public function findContaById($id){
		$db = $this->db;
		$db->from("tb_conta c");
		$db->where("ci_conta", $id);
		return $db->get()->row();
	}
	
	public function findContaByIdDetail($id){
		$db = $this->db;
		$db->from("tb_conta c");
		$db->join("tb_banco b","b.ci_banco = c.cd_banco");
		$db->join("tb_empresa e","e.ci_empresa = c.cd_empresa");
		$db->where("ci_conta", $id);
		return $db->get()->row();
	}
	
	public function findMovimentoByConta($id){
		$db = $this->db;
		$db->from("tb_movimento m");
		$db->join("tb_tpmovimento tp","tp.ci_tpmovimento = m.cd_tpmovimento");
		$db->where("cd_conta", $id);
		$order = (isset($_POST['order']) ? $_POST['order'] : "asc");
		$db->order_by("dt_criacao", $order);
		return $db->get()->result();
	}
	
	public function findContasByFilter($dados){
		$dados = (Object) $dados;
		$db = $this->db;
		$db->from("tb_conta c");
		$db->join("tb_banco b","b.ci_banco = c.cd_banco");
		$db->join("tb_tpconta tp","tp.ci_tpconta = c.cd_tpconta");		
		$empresa = (isset($dados->empresa) ? $dados->empresa : 0);
		$db->where("cd_empresa", $empresa);
		$db->order_by("nm_banco");
		return $db->get()->result();
	}
}