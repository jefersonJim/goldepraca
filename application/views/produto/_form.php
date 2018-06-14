<div class="page-header">
  <h3><i class="fa fa-briefcase" aria-hidden="true"></i> Produto <small>- <?=(!isset($id) ? "cadastro" : "edição")?></small> 
  	  <small class="bt_header"><a href="<?=base_url("produto")?>"><i class="fa fa-reply" aria-hidden="true"></i> voltar</a></small>
  </h3>
</div>

<form method="post" id="formInsertEdit" action="<?=base_url("produto/salvar")?>">
	<div class="row">
		<div class='col-md-6 '>
			<label>Fornecedor</label>
			<select class="form-control" name="fornecedor" id="fornecedor"> 
				<option value="0">Selecione</option>
				<?php foreach ($fornecedores as $fornecedor){?>
					<option value="<?=$fornecedor->ci_fornecedor?>" <?=(@$produto->cd_fornecedor == $fornecedor->ci_fornecedor ? "selected" : "")?>>
						<?=$fornecedor->nr_cnpj?> - <?=$fornecedor->nm_fornecedor?>
					</option>
				<?php }?>	
			</select>
		</div>
	</div>
	<div class="row">		
		<div class='col-md-2'>
			<label>Código</label>
			<input type="text" name="codigo" id="codigo" value="<?=@$produto->nr_codigo?>" class="form-control">
		</div>
		
		<div class='col-md-4'>
			<label>Nome do produto</label>
			<input type="text" name="nome" id="nome" value="<?=@$produto->nm_produto?>" class="form-control upper">
		</div>
		
		<div class='col-md-2'>
			<label>Preço</label>
			<div class="input-group">
			  <span class="input-group-addon">R$</span>
			  <input type="text" class="form-control money" maxlength="23" value="<?=@mask_money($produto->nr_preco)?>" name="preco" id="preco" aria-label="Amount (to the nearest dollar)">
			</div>
		</div>
		
		<!-- div class='col-md-2'>
			<label>Quantidade</label>
			<input type="text" maxlength="10" name="quantidade" id="quantidade" value="<?=@$produto->nr_quantidade?>" class="form-control just_number">
		</div-->
	</div>

	<?php if(isset($id)){?>
		<input type="hidden" name="id" value="<?=$id?>"/>
	<?php }?>
	<div class='row col-md-12' style="margin-top: 20px;">
		<button class="btn btn-success"><?=(!isset($id) ? "Cadastrar" : "Atualizar")?></button>
	</div>
</form>	
