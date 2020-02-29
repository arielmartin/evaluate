/*EXTENSION QUE HICE A MANO PARA QUE VALIDE QUE SEAN SOLO LETRAS SIN ESPACIOS NI SIMBOLOS, YA QUE EL PLUGIN NO LO TRAE DE FABRICA */

jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Solo se permiten letras"); 

/*EXTENSION QUE HICE A MANO PARA QUE VALIDE QUE SEAN SOLO LETRAS Y ESPACIOS, YA QUE EL PLUGIN NO LO TRAE DE FABRICA */

jQuery.validator.addMethod("letras_y_simbolos", function(value, element) {
  return this.optional(element) || /^([a-z ñáéíóú]{2,60})$/i.test(value);
}, "No se permiten numeros ni signos especiales."); 






/* VALIDACION DE TODO EL RESTO DEL FORMULARIO */
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#abm_empleados").validate({
                rules: {
                    nombre: {
                        required: true,
						letras_y_simbolos: true
                    },
					apellido: {
                        required: true,
						letras_y_simbolos: true
                    },
					dni: {
                        required: true,
						number : true
                    },
                    email: {
                        required: true,
						email: true
                    },
					puesto: {
                        required: true
                    },					
					password:{
						required:true
					},
					password_again:{
						equalTo:"#password"
					}				
					
                },
				
                messages: {
                    nombre:{
							required: "Ingrese un nombre",
							},
					apellido:{
							required: "Ingrese un apellido",
							},
                    dni: {
							required: "Ingrese su dni",
							number: "Ingrese solo numeros"
						},
                    email: {
							required: "Ingrese su email",
							email: "Formato incorrecto"
						},
                    puesto: "Ingrese un puesto",
					password:{
						required:"Ingrese una contrasena"
					},
					password_again:{
						equalTo:"Las contrasenas no coinciden"
					}
					
					
				
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