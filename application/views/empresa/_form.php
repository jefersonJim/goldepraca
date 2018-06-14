<div class="page-header">
  <h3><i class="fa fa-building-o" aria-hidden="true"></i> Empresa <small>- <?=(!isset($id) ? "cadastro" : "edição")?></small> 
  	  <small class="bt_header"><a href="<?=base_url("empresa")?>"><i class="fa fa-reply" aria-hidden="true"></i> voltar</a></small>
  </h3>
</div>

<form method="post" id="formInsertEdit" action="<?=base_url("empresa/salvar")?>">
	<div class='col-md-6' style="margin-top: 10px;">
		<label>Nome</label>
		<input type="text" id="nome" name="nome" class="form-control upper" placeholder="digite o nome da empresa" value="<?=@$empresa->nm_empresa?>">
	</div>
	
	<div class='col-md-6' style="margin-top: 10px;">
		<label>CNPJ</label>
		<input type="text" id="cnpj" name="cnpj" class="form-control cnpj" maxlength="18" placeholder="digite o  CNPJ" value="<?=@$empresa->nr_cnpj?>">
	</div>
	
	<div class='col-md-12' style="margin-top: 10px;">
		<label>Descrição</label>
		<textarea id="descricao" name="descricao" placeholder="Descreva com poucas palavras a empresa..." maxlength="1000" class="form-control"><?=@$empresa->ds_empresa?></textarea>
	</div>
	
	<?php if(isset($id)){?>
		<input type="hidden" name="id" value="<?=$id?>"/>
	<?php }?>
	<div class='col-md-12' style="margin-top: 20px;">
		<button class="btn btn-success"><?=(!isset($id) ? "Cadastrar" : "Atualizar")?></button>
	</div>
</form>



