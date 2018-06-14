$(function(){
	
	$("#formInsertEdit").submit(function(){
		if($("#fornecedor").val().trim() == "0"){
			show_alert({text:"O campo <strong>Fornecedor</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		
		if($("#codigo").val().trim() == ""){
			show_alert({text:"O campo <strong>Código</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		
		if($("#nome").val().trim() == ""){
			show_alert({text:"O campo <strong>Nome</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		
		if($("#preco").val().trim() == ""){
			show_alert({text:"O campo <strong>Preço</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		
//		if($("#quantidade").val().trim() == ""){
//			show_alert({text:"O campo <strong>Quantidade</strong> é de preenchimento obrigatório.", timer:5000});
//			return false;
//		}
		return true;
	});
});