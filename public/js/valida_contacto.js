/*EXTENSION QUE HICE A MANO PARA QUE VALIDE QUE SEAN SOLO LETRAS Y ESPACIOS, YA QUE EL PLUGIN NO LO TRAE DE FABRICA */

jQuery.validator.addMethod("letras_y_simbolos", function(value, element) {
  return this.optional(element) || /^([a-z ñáéíóú]{2,60})$/i.test(value);
}, "No se permiten numeros ni signos especiales."); 


/************************** VALIDACION DEL FORMULARIO DE LOGIN ***********************************/
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $('#form_contacto').validate({
                rules: {
                    nombre: {
                        required: true,
						letras_y_simbolos: true
                    },
					email: {
                        required: true,
						email: true

                    },
					telefono: {
                        required: true,
						number:true,
						minlength : 6,
						maxlength : 12
                    },
					mensaje: {
                        required: true,
						minlength: 10,
						maxlength: 400
                    }
                },
				
                messages: {
                       nombre:{
							required: "*Ingrese un nombre",
							letras_y_simbolos: "*Nombre incorrecto (solo letras)"
							},
						email:{
							required: "*Ingrese un email",
							email: "*Email incorrecto(mail@mail.com)"
							},
						telefono:{
							required: "*Ingrese un telefono",
							number: "*Telefono incorrecto (Solo numeros)",
							minlength:"*Telefono demasiado corto",
							maxlength:"*Telefono demasiado largo",
							},
						mensaje:{
							required: "*Ingrese un mensaje",
							minlength: "*Mensaje demasiado corto",
							maxlength: "*Mensaje demasiado largo"
							},
				
					   
					   
				},
				
				
					   
				errorContainer: $("#divErrores_contacto"),
				errorLabelContainer: "#divErrores_contacto ul",
				wrapper: "li"
				
				
				
				
				
				

            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);