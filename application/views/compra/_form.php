<div class="page-header">
  <h3><i class="fa fa-briefcase" aria-hidden="true"></i> Compra <small>- <?=(!isset($id) ? "cadastro" : "edição")?></small> 
  	  <small class="bt_header"><a href="<?=base_url("compra")?>"><i class="fa fa-reply" aria-hidden="true"></i> voltar</a></small>
  </h3>
</div>

<form action="<?=base_url("compra/salva")?>" method="post">
	<div class="row">
		<div class='col-md-6 '>
			<label>Empresa (Comprador)</label>
			<select class="form-control" name="empresa" id="empresa"> 
				<option value="0">Selecione</option>
				<?php foreach ($empresas as $empresa){?>
					<option value="<?=$empresa->ci_empresa?>" <?=(@$_POST["empresa"] == $empresa->ci_empresa ? "selected" : "")?>>
						<?=$empresa->nr_cnpj?> - <?=$empresa->nm_empresa?>
					</option>
				<?php }?>	
			</select>
		</div>
	</div>
	<div class="row" style="margin-top: 30px;">
		<div class='col-md-4 '>
			<label>Fornecedor</label>
			<select class="form-control" name="fornecedor" id="fornecedor"> 
				<option value="0">Selecione</option>
				<?php foreach ($fornecedores as $fornecedor){?>
					<option value="<?=$fornecedor->ci_fornecedor?>" <?=(@$_POST["fornecedor"] == $fornecedor->ci_fornecedor ? "selected" : "")?>>
						<?=$fornecedor->nr_cnpj?> - <?=$fornecedor->nm_fornecedor?>
					</option>
				<?php }?>	
			</select>
		</div>
		<div class='col-md-4 '>
			<label>Produto</label>
			<select class="form-control" name="produto" id="produto"> 
				<option value="0">Selecione</option>
			</select>
		</div>
		<div class='col-md-2'>
			<label>Quantidade:</label>
      	    <input type="text" class="form-control just_number" maxlength="10" value="<?=@$compra->nr_quantidade?>" name="quantidade" id="quantidade">
		</div>
	</div>
	
	<fieldset style="margin-top: 20px;">
		<legend>Pagamento</legend>
		
		<div class="row">
			<div class='col-md-4 '>
				<label>Conta Bancária</label>
				<select class="form-control" name="conta" id="conta"> 
					<option value="0">Selecione</option>
				</select>
			</div>
		
			<div class='col-md-2'>
				<label>Valor de entrada:</label>
				<div class="input-group">
				  <span class="input-group-addon">R$</span>
				  <input type="text" class="form-control money" maxlength="23" value="<?=@mask_money($compra->nr_valor_entrada)?>" name="entrada" id="entrada" aria-label="Amount (to the nearest dollar)">
				</div>
			</div>
		</div>
	</fieldset>
</form>