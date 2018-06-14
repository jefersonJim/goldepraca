<?php
class Fornecedor extends MY_Controller{
	
	public function __construct(){
		$this->auth = true;
		parent::__construct();
		addJS("view/fornecedor");
	}
	
	public function index(){
		$this->load->model("fornecedor_model");
		$data["fornecedores"] = $this->fornecedor_model->findFornecedores();
		$this->load_view("fornecedor/fornecedor", $data);
	}
	
	public function cadastro(){
		$this->load_view("fornecedor/_form");
	}
	
	public function editar($id){
		$this->load->model("fornecedor_model");
		$data["id"] = $id;
		$data["fornecedor"] = $this->fornecedor_model->findFornecedor($id);
		$this->load_view("fornecedor/_form", $data);
	}
	
	public function salvar(){
		$this->load->model("fornecedor_model");
		$this->fornecedor_model->salvar($_POST);
		redirect(base_url("fornecedor"));
	}
}