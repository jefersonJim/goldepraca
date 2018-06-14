<div class="panel panel-default">
  <!-- Default panel contents -->
  

  
  <table class="table table-striped table-bordered table-hover">
  	<head>
  		<tr>
  			<th style="text-align: center;" >#</th>
  			<th style="text-align: center;" >Usuário</th>
  			<th style="text-align: center;" >Pontos</th>
  			<th style="text-align: center;" >Qtd. 20 pts</th>
  			<th style="text-align: center;" >Qtd. 16 pts</th>
  			<th style="text-align: center;" >Qtd. 15 pts</th>
  			<th style="text-align: center;" >Qtd. 12 pts</th>
  			<th style="text-align: center;" >Qtd. 10 pts</th>
  			<th style="text-align: center;" >Qtd. 5 pts</th>
  			<th style="text-align: center;" >Qtd. 3 pts</th>
  		</tr>
  	</head>
  	<body>
  		<?php foreach ($listas as $key => $item) { ?>
  			<tr class="<?=( $item->id_usuario == $this->session->user->id_usuario ? "active" : "")?>">
  				<td style="text-align: center;" ><?=++$rank?>º</td>
  				<td><?=$item->nm_usuario?></td>
  				<td style="text-align: center;"><?=$item->pontos?></td>
  				<td style="text-align: center;"><?=$item->qtd_20?></td>
  				<td style="text-align: center;"><?=$item->qtd_16?></td>
  				<td style="text-align: center;"><?=$item->qtd_15?></td>
  				<td style="text-align: center;"><?=$item->qtd_12?></td>
  				<td style="text-align: center;"><?=$item->qtd_10?></td>
  				<td style="text-align: center;"><?=$item->qtd_5?></td>
  				<td style="text-align: center;"><?=$item->qtd_3?></td>

  			</tr>
  		<?php }?>
  	</body>
  </table>
</div>