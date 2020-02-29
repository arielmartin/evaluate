/************************** VALIDACION DEL FORMULARIO DE ALTA DE PERFIL ***********************************/
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $('#alta_perfil').validate({
                rules: {
                    nombre_perfil: {
                        required: true
                    },
					descripcion_perfil: {
                        required: false
                    }
                },
				
                messages: {
                    nombre_perfil: "Ingrese un nombre para el perfil",
                    descripcion_perfil: "Ingrese una descripcion para el perfil"					
				},
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


/************************** VALIDACION DEL FORMULARIO DE ALTA DE OBJETIVO ***********************************/
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $('#alta_objetivo').validate({
                rules: {
					nombre_objetivo: {
                        required: true
                    },
					descripcion_objetivo: {
                        required: true
                    }
                },
				
                messages: {
					nombre_objetivo: "Ingrese un nombre para el objetivo",
                    descripcion_objetivo: "Ingrese una descripcion para el objetivo"						
				},
				
                submitHandler: function(form) {
				//alert('Objetivo guardado!');
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


/************************** VALIDACION DEL FORMULARIO DE ALTA DE COMPETENCIAS ***********************************/
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $('#alta_competencia').validate({
                rules: {
					nombre_competencia: {
                        required: true
                    },
					descripcion_competencia: {
                        required: false
                    }
                },
				
                messages: {
					nombre_competencia: "Ingrese un nombre para la competencia",
                    descripcion_competencia: "Ingrese una descripcion para la competencia"						
				},
				
                submitHandler: function(form) {
				alert('Competencia guardada!');
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