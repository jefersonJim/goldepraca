<?php
class Compra extends MY_Controller{
	public function __construct(){
		$this->auth = true;
		parent::__construct();
	}
	
	public function index(){
		$this->load_view("compra/compra");
	}
	
	public function cadastro(){
		$this->load->model("fornecedor_model");
		$this->load->model("empresa_model");
		$data["empresas"] = $this->empresa_model->findEmpresas();
		$data["fornecedores"] = $this->fornecedor_model->findFornecedores();
		$this->load_view("compra/_form", $data);
	}
}