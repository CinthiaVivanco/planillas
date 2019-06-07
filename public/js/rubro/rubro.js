$(document).ready(function(){
	var carpeta = $("#carpeta").val();

    $(".listadotrabajadores").on('keypress','#monto', function(e) {
         if(e.which === 13){
            var _token              = $('#token').val();
            var idrubrotrabajador = $(this).attr('data');
            var monto             = $(this).val();


            if(monto != ''){ 

                monto       = parseFloat(monto);
                $.ajax({
                    type    :   "POST",
                    url     :   carpeta+"/ajax-monto-del-trabajadores-x-rubro",
                    data    :   {
                                    _token              : _token,
                                    monto               :  monto,
                                    idrubrotrabajador   :  idrubrotrabajador                                    
                                },
                    success: function (data) {
                        JSONdata     = JSON.parse(data);
                        error        = JSONdata[0].error;
                        cerrarcargando();

                        if(error==true){
                            alertajax("Actualización exitosa");
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

            }else{
                alerterrorajax("El valor del monto es requerido");
            }


         }
    });



    $('#agregartodotrabajador').on('click', function(event){

        event.preventDefault();
        var _token  = $('#token').val();        
        abrircargando();
        idrubro = $(this).attr('data');

        $.ajax({
            type    :   "POST",
            url     :   carpeta+"/ajax-actualizar-rubro-trabajador",
            data    :   {
                            _token   : _token,
                            idrubro  : idrubro
                        },
            success: function (data) {

                JSONdata     = JSON.parse(data);
                error        = JSONdata[0].error;
                cerrarcargando();

                if(error==true){
                    alertajax("Actualización exitosa");
                }
                
            },
            error: function (data) {
                cerrarcargando();
                console.log('Error:', data);
            }
        });



    }); 



    window.Parsley.addValidator('mayoracero', {
      validateString: function(value, requirement) {

        var monto = $('#'+requirement).val();

        if(parseInt(monto)>0 && parseInt(value)>0){
          return false;
        }

        return true;

      },
      messages: {
        es: 'Solo uno debe ser mayor a cero (porcentaje ó %s)'
      }
    });



    $('.selecttrabajador').fastselect({
        onItemSelect: function($item, itemModel) {

            var _token              = $('#token').val();
            var idtrabajador        = itemModel.value;
            $(".listadotrabajadores").html("");

            $.ajax({
                type    :   "POST",
                url     :   carpeta+"/ajax-listado-de-rubros-x-trabajador",
                data    :   {
                                _token   : _token,
                                idtrabajador  :  idtrabajador
                            },
                success: function (data) {
                    $(".listadotrabajadores").html(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });


    $('.selectrubro').fastselect({
        onItemSelect: function($item, itemModel) {

            var _token              = $('#token').val();
            var idrubro             = itemModel.value;
            $(".listadotrabajadores").html("");

            $.ajax({
                type    :   "POST",
                url     :   carpeta+"/ajax-listado-de-trabajadores-x-rubro",
                data    :   {
                                _token   : _token,
                                idrubro  :  idrubro
                            },
                success: function (data) {
                    $(".listadotrabajadores").html(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });


        }
    });

});