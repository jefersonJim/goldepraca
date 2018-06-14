<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	public $auth = false;
	public function __construct(){
		parent::__construct();
		if($this->auth && !isset($this->session->user)){
			redirect(base_url("login"));
		}
		
	}
	
	function load_view($view, $data = ""){	
		$data['view'] = $view;
		$template = $this->config->item('html_template');
		$this->load->view($template, $data);	
	}
	
}