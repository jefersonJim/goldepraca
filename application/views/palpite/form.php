

<?php foreach ($jogos as $key => $jogo) { ?>
	<div class="row" id="jogo<?=$jogo->id_jogo?>">
		<div class="col-md-12">
			<div class="jumbotron">
				<div class="col-md-5 col-xs-5">
					<div class="panel panel-default">
					  <div class="panel-body" style="text-align: center;">
					    <?=$jogo->nm_selecao1?>
					  </div>
					  <div class="panel-footer" style="text-align: center;">
					  		<form method="post" action="<?=base_url("palpite/plus")?>">
					  			<input type="hidden" name="selecao" value="1">
					  			<input type="hidden" name="jogo" value="<?=$jogo->id_jogo?>">
					  			<?php if($jogo->fl_palpite == 't'){?>
					  			<button>
					  				<i class="fa fa-plus-circle" aria-hidden="true"></i>
					  			</button>
					  			<?php } ?>
					  		</form>
					  		<span id="placar" style="font-size: 30px;"><?=($jogo->palpite_nr_gols_s1 == null ? "-" : $jogo->palpite_nr_gols_s1)?></span>	
					  		<form method="post" action="<?=base_url("palpite/minus")?>">
					  			<input type="hidden" name="selecao" value="1">
					  			<input type="hidden" name="jogo" value="<?=$jogo->id_jogo?>">
					  			<?php if($jogo->palpite_nr_gols_s1 != null && $jogo->palpite_nr_gols_s1 > 0 && $jogo->fl_palpite == 't'){?>
					  			<button>
					  			 	<i class="fa fa-minus-circle" aria-hidden="true"></i>
					  			</button>
					  			<?php } ?>
					  		</form>
					  </div>
					</div>
				</div>

				<div class="col-md-2 col-xs-2" style="text-align: center;"><span style=" font-size: 30px"><?=$jogo->nr_gols_s1?> X <?=$jogo->nr_gols_s2?></span> <br> <?=$jogo->dt_jogo?></div>

				<div class="col-md-5 col-xs-5">
					<div class="panel panel-default">
					  <div class="panel-body" style="text-align: center;">
					    <?=$jogo->nm_selecao2?>
					  </div>
					  <div class="panel-footer" style="text-align: center;">
					  		<form method="post" action="<?=base_url("palpite/plus")?>">
					  			<input type="hidden" name="selecao" value="2">
					  			<input type="hidden" name="jogo" value="<?=$jogo->id_jogo?>">
					  			<?php if($jogo->fl_palpite == 't'){?>
					  			<button>
					  				<i class="fa fa-plus-circle" aria-hidden="true"></i>
					  			</button>
					  			<?php } ?>
					  		</form>
					  		<span id="placar" style="font-size: 30px;"><?=($jogo->palpite_nr_gols_s2 == null ? "-" : $jogo->palpite_nr_gols_s2 )?></span>	
					  		<form method="post" action="<?=base_url("palpite/minus")?>">
					  			<input type="hidden" name="selecao" value="2">
					  			<input type="hidden" name="jogo" value="<?=$jogo->id_jogo?>">
					  			<?php if($jogo->palpite_nr_gols_s2 != null && $jogo->palpite_nr_gols_s2 > 0 && $jogo->fl_palpite == 't'){?>
					  			<button>
					  			 	<i class="fa fa-minus-circle" aria-hidden="true"></i>
					  			</button>
					  			<?php } ?>
					  		</form>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }?>