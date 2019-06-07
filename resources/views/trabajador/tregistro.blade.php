@extends('template')
@section('style')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/selectlist/fastselect.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootsnipp.css') }} "/>

@stop
@section('section')

<div class="be-content ajaxpersonal">
  <div class="main-content container-fluid">

    <!--Basic forms-->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider" >Trabajador<span class="panel-subtitle">Exportar T-Registro</span></div>
          <div class="panel-body">
                <form method="POST"  
                    action="{{ url('/exportar-tregistro/'.$idopcion) }}" 
                    data-parsley-validate=""
                    style="border-radius: 0px;"
                    class="form-horizontal group-border-dashed">
                    {{ csrf_field() }}


                    <div class="col-sm-12 selectlist">
                        <select class="multipleSelect" multiple name="trabajadores[]" required="">
                            @foreach($listatrabajadores as $item)
                                <option value="{{$item->id}}">{{$item->nombres}} {{$item->apellidopaterno}}</option>
                            @endforeach                            
                        </select>                    
                    </div>    

                    <div class="form-group">
                        <label class="col-sm-3 control-label">T-Registro</label>
                        <div class="col-sm-5 plame">                                     

                            <div class="be-checkbox inline">

                                <input 
                                    id="e4" 
                                    value="e4" 
                                    name="plame[]" 
                                    type="checkbox"
                                    data-parsley-multiple="groups-plame"                   
                                    data-parsley-errors-container="#error-plame"
                                    data-parsley-mincheck="1" 
                                >

                                <label for="e4">
                                  <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;"><strong>E-4 : Datos personales</strong> del trabajador.</font>
                                  </font>
                                </label>
                            </div>

                            <br>
                            <div class="be-checkbox inline">

                                <input 
                                    id="e5" 
                                    value="e5" 
                                    name="plame[]" 
                                    type="checkbox"
                                    data-parsley-multiple="groups-plame"                   
                                    data-parsley-errors-container="#error-plame"
                                    data-parsley-mincheck="1" 
                                >

                                <label for="e5">
                                  <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;"><strong>E-5 : Datos del trabajador</strong>, como tipo de contrato, seguro, etc.</font>
                                  </font>
                                </label>
                            </div>

                            <br>
                            <div class="be-checkbox inline">

                                <input 
                                    id="e11" 
                                    value="e11" 
                                    name="plame[]" 
                                    type="checkbox"
                                    data-parsley-multiple="groups-plame"                   
                                    data-parsley-errors-container="#error-plame"
                                    data-parsley-mincheck="1" 
                                >

                                <label for="e11">
                                  <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;"><strong>E-11 : Periodos laborados.</strong></font>
                                  </font>
                                </label>
                            </div>


                            <br>
                            <div class="be-checkbox inline">

                                <input 
                                    id="e17" 
                                    value="e17" 
                                    name="plame[]" 
                                    type="checkbox"
                                    data-parsley-multiple="groups-plame"                   
                                    data-parsley-errors-container="#error-plame"
                                    data-parsley-mincheck="1" 
                                >

                                <label for="e17">
                                  <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;"><strong>E-17 : Establecimiento</strong> donde va a laborar el trabajador.</font>
                                  </font>
                                </label>
                            </div>

                            <br>
                            <div class="be-checkbox inline">

                                <input 
                                    id="e29" 
                                    value="e29" 
                                    name="plame[]" 
                                    type="checkbox"
                                    data-parsley-multiple="groups-plame"                   
                                    data-parsley-errors-container="#error-plame"
                                    data-parsley-mincheck="1" 
                                    required=""
                                >

                                <label for="e29">
                                  <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;"><strong>E-29 : Estudios concluidos</strong> del trabajador (si el trabajador los tiene).</font>
                                  </font>
                                </label>
                            </div>

                            <br>
                            <div class="be-checkbox inline">

                                <input 
                                    id="e30" 
                                    value="e30" 
                                    name="plame[]" 
                                    type="checkbox"
                                    data-parsley-multiple="groups-plame"                   
                                    data-parsley-errors-container="#error-plame"
                                    data-parsley-mincheck="1" 
                                >

                                <label for="e30">
                                  <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;"><strong>E-30 : Datos de Cuenta de abono</strong>, de remuneraciones</font>
                                  </font>
                                </label>
                            </div>

                            <br>
                            <div class="be-checkbox inline">

                                <input 
                                    id="e13" 
                                    value="e13" 
                                    name="plame[]" 
                                    type="checkbox"
                                    data-parsley-multiple="groups-plame"                   
                                    data-parsley-errors-container="#error-plame"
                                    data-parsley-mincheck="1" 
                                    required=""
                                >
                                
                            </div>
                            <div id="error-plame"></div>
                      </div>
                    </div>

                    <div class="row xs-pt-15">
                        <div class="col-xs-6">
                            <div class="be-checkbox">

                            </div>
                        </div>
                        <div class="col-xs-6">
                          <p class="text-right">
                            <button type="submit" class="btn btn-space btn-primary">Exportar</button>
                          </p>
                        </div>
                    </div>
                </form>
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
    <script src="{{ asset('public/lib/selectlist/fastselect.standalone.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.formElements();
        $('form').parsley();
        $('.multipleSelect').fastselect();
      });  
    </script> 

    <script src="{{ asset('public/js/personal/personal.js') }}" type="text/javascript"></script>

@stop