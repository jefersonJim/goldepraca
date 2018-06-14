<?php
class Palpite extends MY_Controller{
	public function __construct(){
		$this->auth = true;
		parent::__construct();
		$this->load->model("palpite_model");
	}
	
	public function index(){
		$user = $this->session->user;
		$data["jogos"] = $this->palpite_model->findPalpites($user->id_usuario);
		$this->load_view("palpite/form", $data);
	}


	public function plus(){
		$user = $this->session->user;
		$this->palpite_model->salvarPalpitePlus($this->input->post("jogo"), $this->input->post("selecao"), $user->id_usuario);
		redirect(base_url("palpite")."#jogo".$this->input->post("jogo"));
	}

	public function minus(){
		$user = $this->session->user;
		$this->palpite_model->salvarPalpiteMinus($this->input->post("jogo"), $this->input->post("selecao"), $user->id_usuario);
		redirect(base_url("palpite")."#jogo".$this->input->post("jogo"));
	}
}