<div class="page-header">
  <h3><i class="fa fa-briefcase" aria-hidden="true"></i>  Produto <small>- consulta</small>
  	  <small class="bt_header"> <a href="<?=base_url("produto/cadastro")?>"><i class="fa fa-plus-square" aria-hidden="true"></i> novo</a></small>
  </h3>
</div>

<form method="post">
	<div class="row">
		<div class='col-md-6 '>
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
	</div>
	<div class='row col-md-12' style="margin-top: 20px;">
		<button class="btn btn-success">Consultar</button>
	</div>
	
	<div class="table-responsive row col-md-12" style="margin-top: 20px;">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="text-align: center;">Código</th>
					<th style="text-align: center;">Produto</th>
					<th style="text-align: center;">Preço</th>
					<th width="4%"></th>
				</tr>
			</thead>
		  	<tbody>
		  		<?php if(count($produtos) != 0){
		  				foreach ($produtos as $prod){?>
		  					<tr>
					  			<td><?=$prod->nr_codigo?></td>
					  			<td><?=$prod->nm_produto?></td>
					  			<td style="text-align: center;"><?="R$ ".mask_money($prod->nr_preco)?></td>
					  			<td style="text-align: center;"><a title="Editar" href="<?=base_url("produto/editar/".$prod->ci_produto)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
					  		</tr>	  						
		  				<?php }?>
			  	<?php }else{?>		  		
			  		<tr>
			  			<td colspan="4" style="text-align: center;">Nenhum resultado</td>
			  		</tr>
		  		<?php }?>
		  	</tbody>
		</table>
	</div>
</form>