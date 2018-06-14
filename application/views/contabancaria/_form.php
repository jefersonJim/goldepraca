<div class="page-header">
  <h3><i class="fa fa-money" aria-hidden="true"></i> Conta bancária <small>- <?=(!isset($id) ? "cadastro" : "edição")?></small> 
  	  <small class="bt_header"><a href="<?=base_url("contaBancaria")?>"><i class="fa fa-reply" aria-hidden="true"></i> voltar</a></small>
  </h3>
</div>

<form method="post" id="formInsertEdit" action="<?=base_url("contaBancaria/salvar")?>">
	<div class="row">
		<div class='col-md-6 '>
			<label>Empresa</label>
			<select class="form-control" name="empresa" id="empresa"> 
				<option value="0">Selecione</option>
				<?php foreach ($empresas as $empresa){?>
					<option value="<?=$empresa->ci_empresa?>" <?=(@$conta->cd_empresa == $empresa->ci_empresa ? "selected" : "")?>>
						<?=$empresa->nr_cnpj?> - <?=$empresa->nm_empresa?>
					</option>
				<?php }?>	
			</select>
		</div>
		
		<div class='col-md-6 '>
			<label>Banco</label>
			<select class="form-control" name="banco" id="banco"> 
				<option value="0">Selecione</option>
				<?php foreach ($bancos as $banco){?>
					<option value="<?=$banco->ci_banco?>" <?=(@$conta->cd_banco == $banco->ci_banco ? "selected" : "")?>>
						<?=$banco->nm_banco?>
					</option>
				<?php }?>	
			</select>
		</div>
	</div>
	<div class="row" style="margin-top: 10px;">		
		<div class='col-md-2'>
			<label>Agência</label>
			<input type="text" name="agencia" id="agencia" maxlength="10" value="<?=@$conta->nr_agencia?>" class="form-control">
		</div>
		
		<div class='col-md-2'>
			<label>Díg. agência</label>
			<input type="text" maxlength="1" name="dig_agencia" id="dig_agencia" value="<?=@$conta->nr_dig_agencia?>" class="form-control">
		</div>
		
		<div class='col-md-2'>
			<label>Conta</label>
			<input type="text" name="conta" maxlength="10" id="conta" value="<?=@$conta->nr_conta?>" class="form-control">
		</div>
		
		<div class='col-md-2'>
			<label>Díg. conta</label>
			<input type="text" maxlength="1" name="dig_conta" id="dig_conta" value="<?=@$conta->nr_dig_conta?>" class="form-control">
		</div>
		
		<div class='col-md-2'>
			<label>Tipo da conta</label>
			<select class="form-control" name="tipo" id="tipo">
				<option value="0">Selecione</option>
				<?php foreach ($tpcontas as $tp){?>
					<option value="<?=$tp->ci_tpconta?>" <?=(@$conta->cd_tpconta == $tp->ci_tpconta ? "selected" : "")?>>
						<?=$tp->ds_tpconta?>
					</option>
				<?php }?>	
			</select>
		</div>
	</div>
	<?php if(isset($id)){?>
		<input type="hidden" name="id" value="<?=$id?>"/>
	<?php }?>
	<div class='row col-md-12' style="margin-top: 20px;">
		<button class="btn btn-success"><?=(!isset($id) ? "Cadastrar" : "Atualizar")?></button>
	</div>

</form>