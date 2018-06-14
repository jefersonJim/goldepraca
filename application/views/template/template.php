<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$this->config->item('title_site');?></title>
		<link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/bootstrap.min.css")?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/bootstrap-theme.min.css")?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/font-awesome.min.css")?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/base.css")?>"> 
		<script type="text/javascript" src="<?=base_url("assets/js/jquery-2.2.3.min.js")?>"></script>
		<script type="text/javascript" src="<?=base_url("assets/js/bootstrap.min.js")?>"></script>
		<script type="text/javascript" src="<?=base_url("assets/js/base.js")?>"></script>
	</head>
	<body>
		<?php include_once "menu.php";?>
		<div class="container" id="conteudo">
			<div id="alert-container"><?php show_alert();?></div>
			<?php $this->load->view($view);?>
		</div>
		<?php writeCSS();?>
        <?php writeJS(); ?>
	</body>
</html>