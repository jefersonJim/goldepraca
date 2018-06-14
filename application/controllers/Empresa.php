<?php
class Empresa extends MY_Controller{
	public function __construct(){
		$this->auth = true;
		parent::__construct();
		addJS("view/empresa");
	}
	
	public function index(){
		$this->load->model("empresa_model");
		$data["empresas"] = $this->empresa_model->findEmpresas();
		$this->load_view("empresa/empresa", $data);
	}
	
	public function cadastro(){
		$this->load_view("empresa/_form");
	}
	
	public function editar($id){
		$this->load->model("empresa_model");
		$data["id"] = $id;
		$data["empresa"] = $this->empresa_model->findEmpresa($id);  
		$this->load_view("empresa/_form", $data);
	}
	
	public function salvar(){
		$this->load->model("empresa_model");
		$this->empresa_model->salvar($_POST);	
		redirect(base_url("empresa"));
	}
}