<div class="page-header">
  <h3><i class="fa fa-user-secret" aria-hidden="true"></i> Fornecedor <small>- <?=(!isset($id) ? "cadastro" : "edição")?></small> 
  	  <small class="bt_header"><a href="<?=base_url("fornecedor")?>"><i class="fa fa-reply" aria-hidden="true"></i> voltar</a></small>
  </h3>
</div>

<form method="post" id="formInsertEdit" action="<?=base_url("fornecedor/salvar")?>">
	<div class='col-md-6' style="margin-top: 10px;">
		<label>Nome</label>
		<input type="text" id="nome" name="nome" class="form-control upper" placeholder="digite o nome do fornecedor" value="<?=@$fornecedor->nm_fornecedor?>">
	</div>
	
	<div class='col-md-6' style="margin-top: 10px;">
		<label>CNPJ</label>
		<input type="text" id="cnpj" name="cnpj" class="form-control cnpj" maxlength="18" placeholder="digite o  CNPJ" value="<?=@$fornecedor->nr_cnpj?>">
	</div>
	
	<div class='col-md-12' style="margin-top: 10px;">
		<label>Descrição</label>
		<textarea id="descricao" name="descricao" placeholder="Descreva com poucas palavras a empresa..." maxlength="1000" class="form-control"><?=@$fornecedor->ds_fornecedor?></textarea>
	</div>
	
	<?php if(isset($id)){?>
		<input type="hidden" name="id" value="<?=$id?>"/>
	<?php }?>
	<div class='col-md-12' style="margin-top: 20px;">
		<button class="btn btn-success"><?=(!isset($id) ? "Cadastrar" : "Atualizar")?></button>
	</div>
</form>