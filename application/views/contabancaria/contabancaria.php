<div class="page-header">
  <h3><i class="fa fa-money" aria-hidden="true"></i> Conta bancária <small>- consulta</small>
  	  <small class="bt_header"> <a href="<?=base_url("contaBancaria/cadastro")?>"><i class="fa fa-plus-square" aria-hidden="true"></i> novo</a></small>
  </h3>
</div>

<form method="post">
	<div class="row">
		<div class='col-md-6 '>
			<label>Empresa</label>
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
	<div class='row col-md-12' style="margin-top: 20px;">
		<button class="btn btn-success">Consultar</button>
	</div>
	
	<div class="table-responsive row col-md-12" style="margin-top: 20px;">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="text-align: center;">Banco</th>
					<th style="text-align: center;">Tipo</th>
					<th style="text-align: center;">Agencia</th>
					<th style="text-align: center;">Conta</th>
					<th style="text-align: center;">Saldo</th>
					<th width="4%"></th>
					<th width="4%"></th>
				</tr>
			</thead>
		  	<tbody>
		  		<?php if(count($contas) != 0){
		  				foreach ($contas as $conta){?>
		  					<tr>
					  			<td><?=$conta->nm_banco?></td>
					  			<td style="text-align: center;"><?=$conta->ds_tpconta?></td>
					  			<td style="text-align: center;"><?=$conta->nr_agencia?> - <?=$conta->nr_dig_agencia?> </td>
					  			<td style="text-align: center;"><?=$conta->nr_conta?> - <?=$conta->nr_dig_conta?> </td>					  			
					  			<td style="text-align: center;"><?="R$ ".mask_money($conta->nr_saldo)?></td>
					  			<td style="text-align: center;"><a title="Movimentação" href="<?=base_url("contaBancaria/movimento/".$conta->ci_conta)?>"><i class="fa fa-list" aria-hidden="true"></i></a></td>
					  			<td style="text-align: center;"><a title="Editar" href="<?=base_url("contaBancaria/editar/".$conta->ci_conta)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
					  		</tr>	  						
		  				<?php }?>
			  	<?php }else{?>		  		
			  		<tr>
			  			<td colspan="7" style="text-align: center;">Nenhum resultado</td>
			  		</tr>
		  		<?php }?>
		  	</tbody>
		</table>
	</div>
</form>