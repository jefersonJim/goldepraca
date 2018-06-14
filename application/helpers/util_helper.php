<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$GLOBALS['scripts'] = [];
$GLOBALS['styles'] = [];
$GLOBALS['alerts'] = [];

if ( ! function_exists('trace')) {
	function trace($value) {
		echo '<pre>';
		print_r($value);
		echo '</pre>';
	}
}

if ( ! function_exists('addJS')) {
	function addJS($param)
	{
		if(is_array($param)){
			foreach ($param as $file){
				if (!in_array($file,  $GLOBALS['scripts'])) {
					array_push($GLOBALS['scripts'], $file);
				}
			}
		}else{
			if (!in_array($param,  $GLOBALS['scripts'])) {
				array_push($GLOBALS['scripts'], $param);
			}
		}
	}
}


if ( ! function_exists('addCSS')) {
	function addCSS($param)
	{
		if(is_array($param)){
			foreach ($param as $file){
				if (!in_array($file,  $GLOBALS['styles'])) {
					array_push($GLOBALS['styles'], $file);
				}
			}
		}else{
			if (!in_array($param,  $GLOBALS['styles'])) {
				array_push($GLOBALS['styles'], $param);
			}
		}
	}
}

if ( ! function_exists('writeJS')) {
	function writeJS()
	{
		foreach ($GLOBALS['scripts'] as $js) {
			echo '<script src="' . base_url("/assets/js/" . $js . ".js") . '" type="text/javascript" charset="utf-8"></script>';
		}
	}
}

if ( ! function_exists('writeCSS')) {
	function writeCSS()
	{
		foreach ($GLOBALS['styles'] as $css) {
			echo '<link rel="stylesheet" type="text/css" href="' . base_url("/assets/css/" . $css . ".css") . '" charset="utf-8">';
		}
	}
}


if(! function_exists('send_alert')){
	function send_alert($msg, $tipo = "warning"){
		$data["msg"] = $msg;
		$data["tipo"] = $tipo;
		$_SESSION["alert"] = $data;
	}
}

if(! function_exists('show_alert')){
	function show_alert(){
		if(isset($_SESSION['alert'])){
			$alert = (Object) $_SESSION['alert'];
			$div = '<div class="alert alert-'.$alert->tipo.'" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						 '.$alert->msg.'
					</div>';
			echo $div;
			unset($_SESSION['alert']);			
		}
	}
}

if(! function_exists('mask_money')){
	function mask_money($valor){
		$valor = preg_replace("/\D/","", $valor);
		$valor = preg_replace("/(\d{1})(\d{17})$/","$1.$2", $valor);
		$valor = preg_replace("/(\d{1})(\d{14})$/","$1.$2", $valor);
		$valor = preg_replace("/(\d{1})(\d{11})$/","$1.$2", $valor);
		$valor = preg_replace("/(\d{1})(\d{8})$/","$1.$2", $valor);
		$valor = preg_replace("/(\d{1})(\d{5})$/","$1.$2", $valor);
		$valor = preg_replace("/(\d{1})(\d{1,2})$/","$1,$2", $valor);
		return $valor; 
	}
}