
function Buscar() {
	
	var Entrada = $("#entrada").val();	

	if(Entrada == "")
		$("#salida").val("");

	$.ajax({
	  type: "POST",
	  url: "SopaLetras.php",
	  data: 'valor='+Entrada,
	 
	  success : function(respuesta)
	    {
			var textArea = JSON.parse(respuesta);
	    	var texto = '';
	    	console.log(textArea);
	    	textArea.forEach(function(value, i){
	    		texto += value + '\r';
	    	});
	    	$("#salida").val(texto);
        }
	});
}