
/************************** VALIDACION DEL FORMULARIO DE ALTA DE PERIODO ***********************************/
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $('#crear_periodo').validate({
                rules: {
					nombre_periodo: {
                        required: true
                    },
					cantidad: {
                        required: true,
						digits: true
                    },
				theDate1: {
                        required: true
                    },
				theDate2: {
                        required: true
                    }
                },
				
                messages: {
					nombre_periodo: "* Ingrese un nombre para el periodo",
                    
					cantidad:{
								required: "* Ingrese una cantidad de evaluaciones",				
								digits: "* Ingrese solo numeros en la cantidad de evaluaciones"
					}, 
					
					
                    theDate1: "* Ingrese una fecha de inicio",				
                    theDate2: "* Ingrese una fecha de finalizacion"				
				},
				
				errorContainer: $("#divErrores"),
				errorLabelContainer: "#divErrores ul",
				wrapper: "li",
							
                submitHandler: function(form) {
					form.submit();

                }
				
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);




