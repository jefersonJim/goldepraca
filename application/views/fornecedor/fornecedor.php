<div class="page-header">
  <h3><i class="fa fa-user-secret" aria-hidden="true"></i> Fornecedor <small>- consulta</small>
  	  <small class="bt_header"> <a href="<?=base_url("fornecedor/cadastro")?>"><i class="fa fa-plus-square" aria-hidden="true"></i> novo</a></small>
  </h3>
</div>

<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th style="text-align: center;">FORNECEDOR</th>
				<th style="text-align: center;">CNPJ</th>
				<th width="4%"></th>
			</tr>
		</thead>
	  	<tbody>
	  		<?php if(count($fornecedores) != 0){
	  				foreach ($fornecedores as $fornecedor){?>
	  					<tr>
				  			<td><?=$fornecedor->nm_fornecedor?></td>
				  			<td style="text-align: center;"><?=$fornecedor->nr_cnpj?></td>
				  			<td style="text-align: center;"><a title="Editar" href="<?=base_url("fornecedor/editar/".$fornecedor->ci_fornecedor)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
				  		</tr>	  						
	  				<?php }?>
		  	<?php }else{?>		  		
		  		<tr>
		  			<td colspan="3" style="text-align: center;">Nenhum resultado</td>
		  		</tr>
	  		<?php }?>
	  	</tbody>
	</table>
</div>