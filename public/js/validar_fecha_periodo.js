	 //FUNCION QUE VALIDA QUE UNA FECHA SEA POSTERIOR QUE LA OTRA
	 
	 
	 
	 function muestra(id){
	 
        var span = document.getElementById(id);
         span.style.display=''; //damos un atributo display:'' que muestra el div     
      
	  }  
	 
	 function validar_fecha_periodo(){
			 //Formato MES/DIA/AÑO
		var primera = Date.parse(document.getElementById('fecha_inicio').value); 
		var segunda = Date.parse(document.getElementById('fecha_final').value); 		 
		
		if (primera == segunda){
			//alert("La fecha de inicio no puede coincidir con la fecha de finalizacion");
		
		
			muestra('error1');
			return false;

		} else if (primera > segunda) {
			//alert("La fecha de inicio no puede ser posterior a la fecha de finalizacion");
			
			muestra('error2');
			return false;
		} else {
			return true;
		}
	}