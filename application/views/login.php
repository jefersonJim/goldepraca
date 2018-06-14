<div class="col-md-4 col-md-offset-4" style="margin-top: 8%;">	
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title"><i class="fa fa-lock" aria-hidden="true"></i> Área restrita</h3>
	  </div>
	  <div class="panel-body">
	  		<form action="<?=base_url("login/logar")?>" method="post" >
		  		<div class="row">
			    	<div class="col-md-12" style="vertical-align: middle; ">
			    		<label><i class="fa fa-user" aria-hidden="true"></i> Login</label>
			    		<input class="form-control" type="text" name="login"/>
			    	</div>
			    </div>
			    <div class="row" style="margin-top: 15px; ">
			    	<div class="col-md-12" style="">
			    		<label><i class="fa fa-key" aria-hidden="true"></i> Senha</label>
			    		<input class="form-control" type="password" name="senha"/>
			    	</div>
			    </div>
			    <div class="row col-md-12"  style="margin-top: 15px; text-align: center;">
			    	<button class="btn btn-success">Acessar</button>
			    </div>
			</form>
	  </div>
	</div>
</div>