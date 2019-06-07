$(document).ready(function(){
	var carpeta = $("#carpeta").val();
    var numero = $('.clockactivo').attr("data");

    jQuery('.scrollbar-inner').scrollbar();
    jQuery('.scrollbar-inner').scrollTop(numero*32.2);

    $('#descargarhorario').on('click', function(event){

        var _token              = $('#token').val();
        var objeto = $('.listasemana').find('.active');

        if(objeto.length>0){

            idsemana = $(objeto).find('.selectsemana').attr('id');
            href = $(this).attr('href')+'/'+idsemana;
            $(this).prop('href', href);
            return true;

        }else{
            alerterrorajax("Seleccione una semana para el reporte");
            return false;
        }

    });

    $('#copiarhorarioclonar').on('click', function(event){
        event.preventDefault();
        var _token              = $('#token').val();
        var objeto = $('.listasemana').find('.active');

        if(objeto.length>0){

            abrircargando();
                
            idsemana = $(objeto).find('.selectsemana').attr('id');
            $(".listadohorario").html("");

            $.ajax({
                type    :   "POST",
                url     :   carpeta+"/ajax--copiar-horario-clonado",
                data    :   {
                                _token   : _token,
                                idsemana : idsemana
                            },
                success: function (data) {

                    cerrarcargando();
                    $(".listadohorario").html(data);
                    alertajax("Clonación exitosa");
                    
                },
                error: function (data) {
                    cerrarcargando();
                    console.log('Error:', data);
                }
            });


        }else{
            alerterrorajax("Seleccione una semana para traspase de clonación");
        }
    }); 




    $('#clonarhorario').on('click', function(event){
        event.preventDefault();
        var _token              = $('#token').val();
        var objeto = $('.listasemana').find('.active');

        if(objeto.length>0){

            abrircargando();
                
            idsemana = $(objeto).find('.selectsemana').attr('id');


            $.ajax({
                type    :   "POST",
                url     :   carpeta+"/ajax-clonar-horario",
                data    :   {
                                _token   : _token,
                                idsemana : idsemana
                            },
                success: function (data) {

                    JSONdata     = JSON.parse(data);
                    error        = JSONdata[0].error;
                    cerrarcargando();

                    if(error==true){
                        alertajax("Clonación exitosa");
                    }
                    
                },
                error: function (data) {
                    cerrarcargando();
                    console.log('Error:', data);
                }
            });


        }else{
            alerterrorajax("Seleccione una semana para clonarla");
        }
    }); 


    $('.selectsemana').on('click', function(event){

    	event.preventDefault();
    	var idsemana 			= $(this).attr("id");
    	var _token 				= $('#token').val();
		$(".listadohorario").html("");
		$(".menu-roles li").removeClass( "active" )
		$(this).parents('li').addClass("active");

        $.ajax({
            type	: 	"POST",
            url		: 	carpeta+"/ajax-listado-de-horario",
            data	: 	{
            				_token	 : _token,
            				idsemana : idsemana
            	 		},
            success: function (data) {
            	//console.log(data);
            	$(".listadohorario").html(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });	


    $(".listadohorario").on('click','label', function() {

        var input   = $(this).siblings('input');
        var accion  = $(this).attr('data-atr');
        var dia     = $(this).attr('data-dia');        
        
        var name    = $(this).attr('name');
        var _token  = $('#token').val()
        var check   = -1;
        var estado  = -1;
        var estado_original  = -1;
        

        if($(input).is(':checked')){ 
            check   = 0;
            estado  = false;
            estado_original  = true;
        }else{
            check = 1;
            estado  = true;
            estado_original  = false;
        }

        $.ajax({
            type    :   "POST",
            url     :   carpeta+"/ajax-activar-horario-trabajador",
            data    :   {
                            _token  : _token,
                            name    : name,
                            check   : check,
                            accion  : accion,
                            dia     : dia,
                            
                        },
            success: function (data) {

                JSONdata     = JSON.parse(data);
                error        = JSONdata[0].error;
                mensaje      = JSONdata[0].mensaje;

                if(error==false){
                    alertajax(mensaje);

                }else{
                    alerterrorajax(mensaje);
                    $(input).prop('checked', estado_original);
                }
                
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

        
    });    


    var previousValue = "";
    $(".listadohorario").on('focus','#horario_id', function() {
        previousValue = $(this).val();
    });


    $(".listadohorario").on('change','#horario_id', function() {


        var puntero                 = $(this);
        var horario_id              = $(this).val();
        var idhorariotrabajador     = $(this).attr('data-id');
        var atributo                = $(this).attr('data-attr');
        
        var _token                  = $('#token').val();


        $.ajax({
            type    :   "POST",
            url     :   carpeta+"/ajax-select-horario-trabajador",
            data    :   {
                            _token              : _token,
                            idhorariotrabajador : idhorariotrabajador,
                            atributo            : atributo,
                            horario_id          : horario_id
                        },
            success: function (data) {


                JSONdata     = JSON.parse(data);
                error        = JSONdata[0].error;
                mensaje      = JSONdata[0].mensaje;

                if(error==false){
                    hora         = JSONdata[0].hora;
                    $(puntero).parent('.cell-detail').find('.labelhora').html(hora);
                    alertajax(mensaje);                   

                }else{

                    alerterrorajax(mensaje);
                    // select anterior
                    $(puntero).val(previousValue);

                }




            },
            error: function (data) {

                console.log('Error:', data);
            }
        });

    });




});