$(function(){
	$("#order").change(function(){
		$("#formOrder").submit();
	});
	
	$("#formInsertEdit").submit(function(){
		if($("#empresa").val().trim() == "0"){
			show_alert({text:"O campo <strong>Empresa</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		if($("#banco").val().trim() == "0"){
			show_alert({text:"O campo <strong>Banco</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		if($("#agencia").val().trim() == ""){
			show_alert({text:"O campo <strong>Agência</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		if($("#dig_agencia").val().trim() == ""){
			show_alert({text:"O campo <strong>Díg. agência</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		
		if($("#conta").val().trim() == ""){
			show_alert({text:"O campo <strong>Conta</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		if($("#dig_conta").val().trim() == ""){
			show_alert({text:"O campo <strong>Díg. conta</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		if($("#tipo").val().trim() == "0"){
			show_alert({text:"O campo <strong>Tipo da conta</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		return true;
	});
});