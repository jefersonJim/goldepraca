<?php
class Rank extends MY_Controller{
	public function __construct(){
		$this->auth = true;
		parent::__construct();
		$this->load->model("palpite_model");
	}
	
	public function index(){
		$user = $this->session->user;
		$data["listas"] = $this->palpite_model->getRankPalpites();
		$data["rank"] = 0;
		$this->load_view("rank/list", $data);
	}
}