<?php
class Palpite_model extends CI_Model{

	public function findPalpites($id_usuario){
		$db = $this->db;
		$db->select("
			 j.id_jogo
			,to_char(dt_jogo, 'DD/MM/YYYY HH24:MI:SS') as dt_jogo
			,(dt_jogo >= (now() - interval '10 minutes')) fl_palpite
			,j.nr_gols_s1
			,j.nr_gols_s2
			,s1.id_selecao as id_selecao1
			,s1.nm_selecao as nm_selecao1
			,s1.nm_grupo as nm_grupo1
			,s2.id_selecao as id_selecao2
			,s2.nm_selecao as nm_selecao2 
			,s2.nm_grupo as nm_grupo2
			,p.id_palpite
			,p.nr_gols_s1 as palpite_nr_gols_s1
			,p.nr_gols_s2 as palpite_nr_gols_s2
			,p.fk_usuario");
		$db->from("gol.jogo j");
		$db->join("gol.selecao s1", "fk_selecao1 = s1.id_selecao");
		$db->join("gol.selecao s2", "fk_selecao2 = s2.id_selecao");
		$db->join("gol.palpite p", "p.fk_jogo = j.id_jogo and p.fk_usuario = ".$id_usuario, "left");
		$db->order_by("dt_jogo");
		return $db->get()->result();
	}


	public function findPalpiteByJogo($jogo, $id_usuario){
		$db = $this->db;
		$db->from("gol.palpite p");
		$db->where("fk_jogo", $jogo);
		$db->where("fk_usuario", $id_usuario);
		return $db->get()->row();
	}

	public function getRankPalpites(){
		$sql = "   select u.id_usuario,
			       u.nm_usuario,
			       coalesce(sum(case
			                      when p.nr_gols_s1 = j.nr_gols_s1 and p.nr_gols_s2 = j.nr_gols_s2 then
			                       20
			                      when ((j.fk_resultado = 1 and p.nr_gols_s1 > p.nr_gols_s2) and
			                           (j.nr_gols_s1 - j.nr_gols_s2) = (p.nr_gols_s1 - p.nr_gols_s2)) or
			                           ((j.fk_resultado = 2 and p.nr_gols_s2 > p.nr_gols_s1) and
			                           (j.nr_gols_s2 - j.nr_gols_s1) = (p.nr_gols_s2 - p.nr_gols_s1)) then
			                       16
			                      when ((j.fk_resultado = 1 and p.nr_gols_s1 > p.nr_gols_s2) and
			                           j.nr_gols_s1 = p.nr_gols_s1) or
			                           ((j.fk_resultado = 2 and p.nr_gols_s2 > p.nr_gols_s1) and
			                           j.nr_gols_s2 = p.nr_gols_s2) then
			                       15
			                      when ((j.fk_resultado = 1 and p.nr_gols_s1 > p.nr_gols_s2) and
			                           j.nr_gols_s2 = p.nr_gols_s2) or
			                           ((j.fk_resultado = 2 and p.nr_gols_s2 > p.nr_gols_s1) and
			                           j.nr_gols_s1 = p.nr_gols_s1) then
			                       12
			                      when (j.fk_resultado = 1 and p.nr_gols_s1 > p.nr_gols_s2) or
			                           (j.fk_resultado = 2 and p.nr_gols_s2 > p.nr_gols_s1) or
			                           (j.fk_resultado = 3 and p.nr_gols_s1 = p.nr_gols_s2) then
			                       10
			                      when (j.nr_gols_s2 = p.nr_gols_s2) or (j.nr_gols_s1 = p.nr_gols_s1) then
			                       5
			                      when (j.nr_gols_s1 - j.nr_gols_s2) = (p.nr_gols_s1 - p.nr_gols_s2) or
			                           (j.nr_gols_s1 - j.nr_gols_s2) = (p.nr_gols_s2 - p.nr_gols_s1) then
			                       3
			                    end),
			                0) as pontos,
			       (select count(*)
			          from gol.palpite p2
			         inner join gol.usuario u2 on u2.id_usuario = p2.fk_usuario
			         inner join gol.jogo j2 on j2.id_jogo = p2.fk_jogo
			         where (case when p2.nr_gols_s1 = j2.nr_gols_s1 and
			                p2.nr_gols_s2 = j2.nr_gols_s2 then 20
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                     (p2.nr_gols_s1 - p2.nr_gols_s2)) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                (j2.nr_gols_s2 - j2.nr_gols_s1) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1)) then 16
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s1 = p2.nr_gols_s1) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s2 = p2.nr_gols_s2) then 15
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s2 = p2.nr_gols_s2) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s1 = p2.nr_gols_s1) then 12
			                when(j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) or
			                (j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) or
			                (j2.fk_resultado = 3 and p2.nr_gols_s1 = p2.nr_gols_s2) then 10
			                when(j2.nr_gols_s2 = p2.nr_gols_s2) or
			                (j2.nr_gols_s1 = p2.nr_gols_s1) then 5
			                when(j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s1 - p2.nr_gols_s2) or
			                (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1) then 3 end) = 20
			           and u2.id_usuario = u.id_usuario) qtd_20,
			       (select count(*)
			          from gol.palpite p2
			         inner join gol.usuario u2 on u2.id_usuario = p2.fk_usuario
			         inner join gol.jogo j2 on j2.id_jogo = p2.fk_jogo
			         where (case when p2.nr_gols_s1 = j2.nr_gols_s1 and
			                p2.nr_gols_s2 = j2.nr_gols_s2 then 20
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                     (p2.nr_gols_s1 - p2.nr_gols_s2)) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                (j2.nr_gols_s2 - j2.nr_gols_s1) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1)) then 16
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s1 = p2.nr_gols_s1) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s2 = p2.nr_gols_s2) then 15
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s2 = p2.nr_gols_s2) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s1 = p2.nr_gols_s1) then 12
			                when(j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) or
			                (j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) or
			                (j2.fk_resultado = 3 and p2.nr_gols_s1 = p2.nr_gols_s2) then 10
			                when(j2.nr_gols_s2 = p2.nr_gols_s2) or
			                (j2.nr_gols_s1 = p2.nr_gols_s1) then 5
			                when(j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s1 - p2.nr_gols_s2) or
			                (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1) then 3 end) = 16
			           and u2.id_usuario = u.id_usuario) qtd_16,
			       (select count(*)
			          from gol.palpite p2
			         inner join gol.usuario u2 on u2.id_usuario = p2.fk_usuario
			         inner join gol.jogo j2 on j2.id_jogo = p2.fk_jogo
			         where (case when p2.nr_gols_s1 = j2.nr_gols_s1 and
			                p2.nr_gols_s2 = j2.nr_gols_s2 then 20
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                     (p2.nr_gols_s1 - p2.nr_gols_s2)) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                (j2.nr_gols_s2 - j2.nr_gols_s1) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1)) then 16
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s1 = p2.nr_gols_s1) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s2 = p2.nr_gols_s2) then 15
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s2 = p2.nr_gols_s2) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s1 = p2.nr_gols_s1) then 12
			                when(j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) or
			                (j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) or
			                (j2.fk_resultado = 3 and p2.nr_gols_s1 = p2.nr_gols_s2) then 10
			                when(j2.nr_gols_s2 = p2.nr_gols_s2) or
			                (j2.nr_gols_s1 = p2.nr_gols_s1) then 5
			                when(j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s1 - p2.nr_gols_s2) or
			                (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1) then 3 end) = 15
			           and u2.id_usuario = u.id_usuario) qtd_15,
			       (select count(*)
			          from gol.palpite p2
			         inner join gol.usuario u2 on u2.id_usuario = p2.fk_usuario
			         inner join gol.jogo j2 on j2.id_jogo = p2.fk_jogo
			         where (case when p2.nr_gols_s1 = j2.nr_gols_s1 and
			                p2.nr_gols_s2 = j2.nr_gols_s2 then 20
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                     (p2.nr_gols_s1 - p2.nr_gols_s2)) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                (j2.nr_gols_s2 - j2.nr_gols_s1) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1)) then 16
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s1 = p2.nr_gols_s1) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s2 = p2.nr_gols_s2) then 15
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s2 = p2.nr_gols_s2) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s1 = p2.nr_gols_s1) then 12
			                when(j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) or
			                (j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) or
			                (j2.fk_resultado = 3 and p2.nr_gols_s1 = p2.nr_gols_s2) then 10
			                when(j2.nr_gols_s2 = p2.nr_gols_s2) or
			                (j2.nr_gols_s1 = p2.nr_gols_s1) then 5
			                when(j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s1 - p2.nr_gols_s2) or
			                (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1) then 3 end) = 12
			           and u2.id_usuario = u.id_usuario) qtd_12,
			       (select count(*)
			          from gol.palpite p2
			         inner join gol.usuario u2 on u2.id_usuario = p2.fk_usuario
			         inner join gol.jogo j2 on j2.id_jogo = p2.fk_jogo
			         where (case when p2.nr_gols_s1 = j2.nr_gols_s1 and
			                p2.nr_gols_s2 = j2.nr_gols_s2 then 20
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                     (p2.nr_gols_s1 - p2.nr_gols_s2)) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                (j2.nr_gols_s2 - j2.nr_gols_s1) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1)) then 16
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s1 = p2.nr_gols_s1) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s2 = p2.nr_gols_s2) then 15
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s2 = p2.nr_gols_s2) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s1 = p2.nr_gols_s1) then 12
			                when(j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) or
			                (j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) or
			                (j2.fk_resultado = 3 and p2.nr_gols_s1 = p2.nr_gols_s2) then 10
			                when(j2.nr_gols_s2 = p2.nr_gols_s2) or
			                (j2.nr_gols_s1 = p2.nr_gols_s1) then 5
			                when(j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s1 - p2.nr_gols_s2) or
			                (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1) then 3 end) = 10 
			           and u2.id_usuario = u.id_usuario) qtd_10,
			       (select count(*)
			          from gol.palpite p2
			         inner join gol.usuario u2 on u2.id_usuario = p2.fk_usuario
			         inner join gol.jogo j2 on j2.id_jogo = p2.fk_jogo
			         where (case when p2.nr_gols_s1 = j2.nr_gols_s1 and
			                p2.nr_gols_s2 = j2.nr_gols_s2 then 20
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                     (p2.nr_gols_s1 - p2.nr_gols_s2)) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                (j2.nr_gols_s2 - j2.nr_gols_s1) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1)) then 16
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s1 = p2.nr_gols_s1) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s2 = p2.nr_gols_s2) then 15
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s2 = p2.nr_gols_s2) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s1 = p2.nr_gols_s1) then 12
			                when(j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) or
			                (j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) or
			                (j2.fk_resultado = 3 and p2.nr_gols_s1 = p2.nr_gols_s2) then 10
			                when(j2.nr_gols_s2 = p2.nr_gols_s2) or
			                (j2.nr_gols_s1 = p2.nr_gols_s1) then 5
			                when(j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s1 - p2.nr_gols_s2) or
			                (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1) then 3 end) = 5
			           and u2.id_usuario = u.id_usuario) qtd_5,
			       (select count(*)
			          from gol.palpite p2
			         inner join gol.usuario u2 on u2.id_usuario = p2.fk_usuario
			         inner join gol.jogo j2 on j2.id_jogo = p2.fk_jogo
			         where (case when p2.nr_gols_s1 = j2.nr_gols_s1 and
			                p2.nr_gols_s2 = j2.nr_gols_s2 then 20
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                     (p2.nr_gols_s1 - p2.nr_gols_s2)) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                (j2.nr_gols_s2 - j2.nr_gols_s1) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1)) then 16
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s1 = p2.nr_gols_s1) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s2 = p2.nr_gols_s2) then 15
			                when((j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) and
			                     j2.nr_gols_s2 = p2.nr_gols_s2) or
			                ((j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) and
			                j2.nr_gols_s1 = p2.nr_gols_s1) then 12
			                when(j2.fk_resultado = 1 and p2.nr_gols_s1 > p2.nr_gols_s2) or
			                (j2.fk_resultado = 2 and p2.nr_gols_s2 > p2.nr_gols_s1) or
			                (j2.fk_resultado = 3 and p2.nr_gols_s1 = p2.nr_gols_s2) then 10
			                when(j2.nr_gols_s2 = p2.nr_gols_s2) or
			                (j2.nr_gols_s1 = p2.nr_gols_s1) then 5
			                when(j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s1 - p2.nr_gols_s2) or
			                (j2.nr_gols_s1 - j2.nr_gols_s2) =
			                (p2.nr_gols_s2 - p2.nr_gols_s1) then 3 end) = 3
			           and u2.id_usuario = u.id_usuario) qtd_3,
			           sum(j.dt_jogo - p.dt_criacao)

			  from gol.palpite p
			 inner join gol.usuario u on u.id_usuario = p.fk_usuario
			 inner join gol.jogo j on j.id_jogo = p.fk_jogo
			where fk_resultado is not null
			 group by u.nm_usuario, u.id_usuario
			 order by 3 desc, 4 desc, 5 desc, 6 desc, 7 desc, 8 desc, 9 desc, 10 desc, 11 desc;";
		return $this->db->query($sql)->result();
	}

	public function salvarPalpitePlus($jogo, $selecao, $id_usuario){
		$palpite = $this->palpite_model->findPalpiteByJogo($jogo,$id_usuario);
		if($palpite == null){

			$palpite["fk_jogo"] = $jogo;
			if($selecao == 1){
				$palpite["nr_gols_s1"] = 1;	
				$palpite["nr_gols_s2"] = 0;	
			}else{
				$palpite["nr_gols_s1"] = 0;	
				$palpite["nr_gols_s2"] = 1;	
			}
			$palpite["fk_usuario"] = $id_usuario;
			$rs = $this->db->insert("gol.palpite", $palpite);

		}else{
			if($selecao == 1){
				$palpite->nr_gols_s1 = $palpite->nr_gols_s1 + 1;	
			}else{
				$palpite->nr_gols_s2 = $palpite->nr_gols_s2 + 1;	
			}
			unset($palpite->dt_criacao);
			$this->db->set('dt_criacao', 'NOW()', FALSE);
			$this->db->where("id_palpite", $palpite->id_palpite);
			$this->db->update("gol.palpite", $palpite);
		}
	}

	public function salvarPalpiteMinus($jogo, $selecao, $id_usuario){

		$palpite = $this->palpite_model->findPalpiteByJogo($jogo,$id_usuario);

		if($palpite != null){
			if($selecao == 1){
				if(($palpite->nr_gols_s1 - 1) <= 0){
					$palpite->nr_gols_s1 = 0;	
				}else{
					$palpite->nr_gols_s1 = $palpite->nr_gols_s1 - 1;	
				}
			}else{
				if(($palpite->nr_gols_s2 - 1) <= 0){
					$palpite->nr_gols_s2 = 0;	
				}else{
					$palpite->nr_gols_s2 = $palpite->nr_gols_s2 - 1;	
				}
			}
			unset($palpite->dt_criacao);
			$this->db->set('dt_criacao', 'NOW()', FALSE);
			$this->db->where("id_palpite", $palpite->id_palpite);
			$this->db->update("gol.palpite", $palpite);
		}
	}

}