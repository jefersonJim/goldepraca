<nav class="navbar navbar-default navbar-fixed-top" >
    <div class="container-fluid" >
    	<!--  Marca e  alternância se agrupado para melhor visualização móvel -->
		<div class="navbar-header">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" style="<?=(isset($this->session->user) ?"margin-top: -10px;" : "margin-top: -19px;")?>" href="<?=base_url("home")?>"><small style="font-size: 12px; color: #5fb5b2;"> <?=(isset($this->session->user) ? "Olá (".$this->session->user->nm_usuario.")" : "")?></small><br><?=$this->config->item('title');?></a>
	    </div>	
		 <?php if(isset($this->session->user)){?>
			<div class="collapse navbar-collapse" id="navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        <li ><a href="<?=base_url("palpite")?>"><i class="fa fa-futbol-o" aria-hidden="true"></i> Meu palpite <span class="sr-only">(current)</span></a></li>
			        <li ><a href="<?=base_url("rank")?>"><i class="fa fa-line-chart" aria-hidden="true"></i> Rank <span class="sr-only">(current)</span></a></li>
			      </ul>
			      <ul class="nav navbar-nav navbar-right">
			      	<li><a href="<?=base_url("login/sair")?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Sair<span class="sr-only"></span></a></li>
			      </ul>
			      <!-- <form class="navbar-form navbar-right" role="search">
			        <div class="input-group">
					  <input type="text" class="form-control" aria-label="" placeholder="Pesquise nossos produtos">
					  <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
					</div>
			      </form> -->
			</div><!-- /.navbar-collapse -->
		<?php }?>
	</div><!-- /.container-fluid -->
</nav>