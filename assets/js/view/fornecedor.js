$(function(){
	$("#formInsertEdit").submit(function(){
		if($("#nome").val().trim() == ""){
			show_alert({text:"O campo <strong>Nome</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		if($("#cnpj").val().trim() == ""){
			show_alert({text:"O campo <strong>CNPJ</strong> é de preenchimento obrigatório.", timer:5000});
			return false;
		}
		return true;
	});
});