<?php
class Produto extends MY_Controller{
	public function __construct(){
		$this->auth = true;
		parent::__construct();
		setlocale(LC_MONETARY,"pt_BR", "ptb");
		addJS("view/produto");
	}
	
	public function index(){
		$this->load->model("fornecedor_model");
		$this->load->model("produto_model");
		
		$data["fornecedores"] = $this->fornecedor_model->findFornecedores();
		$data["produtos"] = $this->produto_model->findProdutoByFornecedor($_POST);
		if(isset($_POST["fornecedor"]) && count($data["produtos"]) == 0){
			send_alert("Nenhum registro encontrado.");
		}
		
		$this->load_view("produto/produto", $data);
	}
	
	public function cadastro(){
		$this->load->model("fornecedor_model");
		$data["fornecedores"] = $this->fornecedor_model->findFornecedores();
		$this->load_view("produto/_form", $data);
	}
	
	public function editar($id){
		$this->load->model("fornecedor_model");
		$this->load->model("produto_model");
		$data["fornecedores"] = $this->fornecedor_model->findFornecedores();
		$data["id"] = $id;
		$data["produto"] = $this->produto_model->findProdutoById($id);
		$this->load_view("produto/_form", $data);
	}
	
	public function salvar(){
		$this->load->model("produto_model");
		$this->produto_model->salvar($_POST);
		redirect(base_url("produto"));
	}
}