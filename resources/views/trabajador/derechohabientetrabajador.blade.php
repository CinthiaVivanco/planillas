@extends('template')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/personal/derechohabiente.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootsnipp.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/dataTables.bootstrap.min.css') }} "/>

@stop
@section('section')

<div class="be-content ajaxpersonal">
  <div class="main-content container-fluid">

    <h2 class="panel-heading">Derecho Habiente del Trabajador:  {{$trabajador->apellidopaterno}} {{$trabajador->apellidomaterno}} {{$trabajador->nombres}}</h2>
  </div>
  <div class="main-content container-fluid editdh">
    <div class="row">

      @foreach($listaderechohabiente as $item)

        <div class="col-sm-4">  
          <div class="cont_principal">
            <div class="cont_centrar">
              <div class="cont_princ_lists">
                <ul>
                  <li class="list_shopping li_num_0_1">
                    <div class="row">

                      <div class="col-sm-4 detdni">  

                          <p>{{$item->dnihabiente}}</p>
                      
                      </div>
                      <div class="col-sm-6 detnombres"> 

                          <p class='detnombre'>{{$item->nmbres}}</p>
                          <p class='detapellido'>{{$item->apellidopaterno}} {{$item->apellidomaterno}}</p>

                      </div>
                      <div class="col-sm-2 detmodificar"> 

                          <div class="icon"><span 
                                          class="mdi mdi-edit" 
                                          id='btnmodificar'
                                          name='{{$item->id}}' 
                                          data_opcion='{{$idopcion}}'
                                          data_trabajador='{{Hashids::encode(substr($trabajador->id, -12))}}'
                                          ></span></div>
                      </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
                 
    @endforeach

    </div>
  </div>


  <div class="main-content container-fluid">
    <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading panel-heading-divider" >Derecho Habiente<span class="panel-subtitle">Crear la Ficha del DerechoHabiente</span></div>
              
              <div class="panel-body">

                <div class="main-content container-fluid ajaxformdh">
                  <form method="POST" action="{{ url('/derecho-habiente-trabajador/'.$idopcion.'/'.Hashids::encode(substr($trabajador->id, -12))) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed"> 
                                    {{ csrf_field() }}
                        @include('trabajador.form.derechohabiente')
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
    <script src="{{ asset('public/js/app-tables-datatables.js') }}" type="text/javascript"></script>
    
    
    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.formElements();
        $('form').parsley();

        $(".ajaxpersonal").on('click','#guardarderechohabiente', function() {

            var $form = $('form');
            $form.parsley().validate()

            $(".tab-content .tab-pane").each(function(index){


                var error = $(this).find('.filled').html();
                var menu  = $(this).attr('id');

                if (error === undefined || error === null || error === '') {
                    $(".tab"+menu+' .errortabdh').css("display", "none");
                    $(".tab"+menu+' .bientabdh').css("display", "block");
                }else{
                    $(".tab"+menu+' .errortabdh').css("display", "block");
                    $(".tab"+menu+' .bientabdh').css("display", "none");
                }



            });


        });


      });
    </script> 
    <script src="{{ asset('public/js/personal/personal.js') }}" type="text/javascript"></script>
    
@stop