/************************** VALIDACION DEL FORMULARIO DE LOGIN ***********************************/
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $('.login').validate({
                rules: {
                    usuario: {
                        required: true
                    },
					pass: {
                        required: true
                    }
                },
				
                messages: {
                        pass: "*",				
						usuario: "*"
				},

            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);