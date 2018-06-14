<?php
class ContaBancaria extends MY_Controller{
	public function __construct(){
		$this->auth = true;
		parent::__construct();
		addJS("view/contabancaria");
	}
	
	public function index(){
		$this->load->model("empresa_model");
		$this->load->model("contabancaria_model");
		$data["empresas"] = $this->empresa_model->findEmpresas();
		$data["contas"] = $this->contabancaria_model->findContasByFilter($_POST);
		$this->load_view("contabancaria/contabancaria", $data);
	}
	
	public function cadastro(){
		$this->load->model("util_model");
		$this->load->model("empresa_model");
		
		$data["empresas"] = $this->empresa_model->findEmpresas();
		$data["bancos"] = $this->util_model->findAllBancos();
		$data["tpcontas"] = $this->util_model->findAllTpconta();
		$this->load_view("contabancaria/_form", $data);
	}
	
	public function editar($id){
		$this->load->model("contabancaria_model");
		$this->load->model("util_model");
		$this->load->model("empresa_model");
		
		$data["empresas"] = $this->empresa_model->findEmpresas();
		$data["bancos"] = $this->util_model->findAllBancos();
		$data["tpcontas"] = $this->util_model->findAllTpconta();
		$data["id"] = $id;
		$data["conta"] = $this->contabancaria_model->findContaById($id);
		$this->load_view("contabancaria/_form", $data);
	}
	
	public function salvar(){
		$this->load->model("contabancaria_model");
		$this->contabancaria_model->salvar($_POST);
		redirect(base_url("contabancaria"));
	}
	
	public function movimento(){
		$id = $this->uri->segment(3);
		$this->load->model("contabancaria_model");
		$this->load->model("util_model");
		
		$data["tipos"] = $this->util_model->findAllTpMovimento();
		$data["conta"]= $this->contabancaria_model->findContaByIdDetail($id);
		$data["movimentos"] = $this->contabancaria_model->findMovimentoByConta($id);
		$this->load_view("movimentacao/movimentacao",$data);
	}
	
	public function salvarMovimento(){
		$this->load->model("contabancaria_model");
		$this->contabancaria_model->salvarMovimento($_POST);
		redirect(base_url("contabancaria/movimento/".$_POST['id_conta']));
	}
}