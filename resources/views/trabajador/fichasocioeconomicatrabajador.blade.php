@extends('template')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/personal/fichasocioeconomica.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootsnipp.css') }} "/>

@stop
@section('section')

<div class="be-content ajaxpersonal">
  <div class="main-content container-fluid">

    <h2 class="panel-heading">Ficha Socioeconómica del Trabajador :  {{$trabajador->apellidopaterno}} {{$trabajador->apellidomaterno}} {{$trabajador->nombres}}</h2>
  </div>




  <div class="main-content container-fluid">
    <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading panel-heading-divider" >Ficha Socioeconómica<span class="panel-subtitle">Crear la Ficha Socioeconómica</span></div>              
              <div class="panel-body">

                <div class="main-content container-fluid ajaxformfs">
                  <form method="POST" 
                  action="@if(count($fichasocioeconomica)>0)
                          {{ url('/modificar-ficha-socioeconomica-trabajador/'.$fichasocioeconomica->id.'/'.$idopcion.'/'.Hashids::encode(substr($trabajador->id, -12))) }}
                          @else
                          {{ url('/ficha-socioeconomica-trabajador/'.$idopcion.'/'.Hashids::encode(substr($trabajador->id, -12))) }}
                          @endif"
                  style="border-radius: 0px;" class="form-horizontal group-border-dashed"> 
                        {{ csrf_field() }}
                        @include('trabajador.form.fichasocioeconomica')
                  </form>               
                </div>
              </div>
            </div>
          </div>
    </div>
  </div>
</div>

@stop

@section('script')



    <script src="{{ asset('public/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/jquery.nestable/jquery.nestable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>        
    <script src="{{ asset('public/lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/app-form-elements.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/parsley/parsley.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.formElements();
        $('form').parsley();

        $(".ajaxpersonal").on('click','#guardarfichasocioeconomica', function() {

            var $form = $('form');
            $form.parsley().validate()

            $(".tab-content .tab-pane").each(function(index){


                var error = $(this).find('.filled').html();
                var menu  = $(this).attr('id');

                if (error === undefined || error === null || error === '') {
                    $(".tab"+menu+' .errortab').css("display", "none");
                    $(".tab"+menu+' .bientab').css("display", "block");
                }else{
                    $(".tab"+menu+' .errortab').css("display", "block");
                    $(".tab"+menu+' .bientab').css("display", "none");
                }



            });


        });


      });
    </script> 
    <script src="{{ asset('public/js/personal/personal.js') }}" type="text/javascript"></script>
    
@stop