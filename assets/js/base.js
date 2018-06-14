$(document).ready(function(){
	//add hash 
	String.prototype.hashCode = function() {
	  var hash = 0, i, chr, len;
	  if (this.length === 0) return hash;
	  for (i = 0, len = this.length; i < len; i++) {
	    chr   = this.charCodeAt(i);
	    hash  = ((hash << 5) - hash) + chr;
	    hash |= 0; // Convert to 32bit integer
	  }
	  return hash;
	};
	
	
	// adicionar mask de cnpj
	$(".cnpj").on("keyup", function(e)	{
	    $(this).val(
	        $(this).val()
	        .replace(/\D/g, '')
	        .replace(/^(\d{2})(\d{3})?(\d{3})?(\d{4})?(\d{2})?/, "$1 $2 $3/$4-$5"));
	});
	
	$(".money").on("keyup",function(){ 
		maskMoney(this);
	});
	
	$('.date_mask').on('keyup', function(){
		 var v = this.value;
	     if (v.match(/^\d{2}$/) !== null) {
	         this.value = v + '/';
	     } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
	         this.value = v + '/';
	     }
	});
	
	$('.just_number').on('keypress', function(evt){
		chars = "0123456789";
		var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
		if(chars.indexOf(String.fromCharCode(charCode)) == -1 && charCode != 8 && charCode != 9 && charCode != 32 && charCode != 46 && charCode != 39) {
			return false;
		}
		return true;
	});
	
	$('.upper').keyup(function(){
	      var posInicial = this.selectionStart;
	      $(this).val($(this).val().toUpperCase());
	      this.selectionStart = posInicial;
	      this.selectionEnd = posInicial;
	})
    $('.upper').css( "text-transform", "uppercase" );
})

function maskMoney(obj){
	v = obj.value; 
	v=v.replace(/\D/g,"") // permite digitar apenas numero
	v=v.replace(/(\d{1})(\d{17})$/,"$1.$2") // coloca ponto antes dos ultimos digitos
	v=v.replace(/(\d{1})(\d{14})$/,"$1.$2") // coloca ponto antes dos ultimos digitos 
	v=v.replace(/(\d{1})(\d{11})$/,"$1.$2") // coloca ponto antes dos ultimos 13 digitos 
	v=v.replace(/(\d{1})(\d{8})$/,"$1.$2") // coloca ponto antes dos ultimos 10 digitos 
	v=v.replace(/(\d{1})(\d{5})$/,"$1.$2") // coloca ponto antes dos ultimos 7 digitos 
	v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2") // coloca virgula antes dos ultimos 4 digitos 
	obj.value = v;
}


function show_alert($params){
	var paramsDefault = {
        text: '',
        type: 'warning',
        timer: null,
        classContainer: 'alert-container'
	};
	$.extend(paramsDefault, $params);
	
	var hash = paramsDefault.text.hashCode();
	var alert = $("#"+hash);
	if(alert.length == 0){
		var div = `<div id="`+hash+`" class="alert alert-`+paramsDefault.type+`" role="alert" style="display:none;">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						`+paramsDefault.text+`
					</div>`;
		$("#"+paramsDefault.classContainer).append(div);
		alert = $("#"+hash);
		alert.hide().slideDown();
		
		if(paramsDefault.timer != null){		
			setTimeout(function(){
				alert.slideUp('slow', function(){
					alert.remove();
				});
			}, paramsDefault.timer);
		}
		$(document).find("html, body").animate({ scrollTop: 0 }, "slow");
	}
}