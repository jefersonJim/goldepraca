<div class="page-header">
  <h3><i class="fa fa-building-o" aria-hidden="true"></i>  Empresa <small>- consulta</small>
  	  <small class="bt_header"> <a href="<?=base_url("empresa/cadastro")?>"><i class="fa fa-plus-square" aria-hidden="true"></i> novo</a></small>
  </h3>
</div>


<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th style="text-align: center;">Empresa</th>
				<th style="text-align: center;">CNPJ</th>
				<th width="4%"></th>
			</tr>
		</thead>
	  	<tbody>
	  		<?php if(count($empresas) != 0){
	  				foreach ($empresas as $emp){?>
	  					<tr>
				  			<td><?=$emp->nm_empresa?></td>
				  			<td style="text-align: center;"><?=$emp->nr_cnpj?></td>
				  			<td style="text-align: center;"><a title="Editar" href="<?=base_url("empresa/editar/".$emp->ci_empresa)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
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
