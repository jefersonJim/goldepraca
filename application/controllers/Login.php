<?php

class Login extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		if(isset($_SESSION['user'])){
			redirect(base_url("home"));
		}
		$this->load_view('login');
	}
	
	public function logar(){
		$this->load->model("usuario_model");
		$user = $this->usuario_model->findUser($_POST["login"], $_POST["senha"]);
		if($user != null){
			unset($user->nm_senha);
			$this->session->set_userdata("user", $user);
			redirect(base_url("home"));
		}else{
			send_alert("Usuário ou senha incorretos","danger");
			redirect(base_url("login"));
		}
	}
	
	public function sair(){
		unset($_SESSION["user"]);
		redirect(base_url("login"));
	}
}