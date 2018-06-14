<?php
class Home extends MY_Controller{
	public function __construct(){
		$this->auth = true;
		parent::__construct();
	}
	public function index(){
		$this->load_view("home");
	}
}