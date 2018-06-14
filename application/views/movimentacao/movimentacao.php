<div class="page-header">
  <h3><i class="fa fa-money" aria-hidden="true"></i> Movimento bancário <small>- consulta</small>
  	  <small class="bt_header"> <a href="<?=base_url("contaBancaria")?>"><i class="fa fa-reply" aria-hidden="true"></i> volta</a></small>
  </h3>
</div>
<div class="row">
	<div class="col-md-5">
		<label>Empresa: </label> <?=@$conta->nm_empresa?>
	</div>
	<div class="col-md-6">
		<label>CNPJ: </label> <?=@$conta->nr_cnpj?>
	</div>
</div>
<div class="row" style="margin-top: 15px;">
	<div class="col-md-12">
		<label>Banco: </label> <?=@$conta->nm_banco?>
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<label>Agência: </label> <?=@$conta->nr_agencia?> - <?=@$conta->nr_dig_agencia?>
	</div>
	<div class="col-md-2">
		<label>Conta: </label> <?=@$conta->nr_conta?> - <?=@$conta->nr_dig_conta?>
	</div>
	<div class='col-md-4'>
		<label>Saldo atual: </label> R$ <?=mask_money(@$conta->nr_saldo)?>
	</div>
</div>

<div class=' row col-md-12' style="margin-top: 15px;">
		<button class="btn btn-success" data-toggle="modal" data-target="#modal_mov"><i class="fa fa-plus-square" aria-hidden="true"></i> Incluir</button>
</div>
<div class="row col-md-2 col-md-push-10">
    <label>Ordenar por:</label>
	<form method="post" id="formOrder">    
	    <select name="order" id="order" class="form-control">
	    	<option value="asc" <?=(@$_POST["order"] == "asc" ? "selected":"")?>>Mais antigo</option>
	    	<option value="desc" <?=(@$_POST["order"] == "desc" ? "selected":"")?>>Mais Recente</option>
		</select> 
	</form>
</div>

<div class="table-responsive row col-md-12" style="margin-top: 20px;">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th style="text-align: center;">Descrição</th>
				<th style="text-align: center;">Tipo</th>
				<th style="text-align: center;">Valor</th>
				<th style="text-align: center;">Saldo</th>
				<th style="text-align: center;">Data</th>
			</tr>
		</thead>
	  	<tbody>
	  		<?php if(count(@$movimentos) != 0){
	  				foreach ($movimentos as $mov){?>
	  					<tr>
							<td style=""><?=$mov->ds_movimento?> </td>					  			
							<td style="text-align: center;"><?=$mov->ds_tpmovimento?></td>
							<td style="text-align: center;<?=($mov->ci_tpmovimento == 1 ? "color:green;" : "color:red;")?>"><?=($mov->ci_tpmovimento == 1 ? "+" : "-")?><?="R$ ".mask_money($mov->nr_valor)?> </td>
							<td style="text-align: center;"><?="R$ ".mask_money($mov->nr_saldo)?></td>
							<td style="text-align: center;"><?=date_format(date_create($mov->dt_movimento_ref),"d/m/Y");?></td>
						</tr>	  						
	  				<?php }?>
		  	<?php }else{?>		  		
		  		<tr>
		  			<td colspan="6" style="text-align: center;">Nenhum resultado</td>
		  		</tr>
	  		<?php }?>
	  	</tbody>
	</table>
</div>


<div class="modal fade" id="modal_mov" tabindex="-1" role="dialog" aria-labelledby="modal_mov" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form action="<?=base_url("contaBancaria/salvarMovimento")?>" method="post">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money" aria-hidden="true"></i> Movimento bancário</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="row">
		      		<div class="col-md-4">
		      			<label>Tipo</label>
		      			<select name="tipo" class="form-control">
		      				<option value="0">Selecione</option>
		      				<?php foreach ($tipos as $tp){?>
								<option value="<?=$tp->ci_tpmovimento?>">
									<?=$tp->ds_tpmovimento?>
								</option>
							<?php }?>
		      			</select> 
		      		</div>
		      		<div class="col-md-4">
		      			<label>Valor</label>
		      			<div class="input-group">
						  <span class="input-group-addon">R$</span>
						  <input type="text" class="form-control money" maxlength="23" name="valor" id="valor" aria-label="Amount (to the nearest dollar)">
						</div>
		      		</div>
		      		<div class="col-md-4">
		      			<label>Data</label>
		      			<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
						  <input type="text" class="form-control date_mask" maxlength="25" name="data" id="data" aria-label="Amount (to the nearest dollar)">
						</div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-md-12">
		      			<label>Descrição</label>
		      			<textarea class="form-control" name="descricao" id="descricao"></textarea>
		      		</div>
		      	</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
		        <button  class="btn btn-success">Salvar</button>
		      </div>
		      <input type="hidden" name="id_conta" value="<?=$conta->ci_conta?>">
		      <input type="hidden" name="saldo" value="<?=$conta->nr_saldo?>">
		  </form>
    </div>
  </div>
</div>