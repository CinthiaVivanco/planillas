@extends('template')
@section('style')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/alfasweb.css')}}"/>

@stop
@section('section')


<div class="be-content">
  <div class="main-content container-fluid">

    <!--Basic forms-->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider" >TRABAJADOR<span class="panel-subtitle">Baja a un Trabajador</span></div>
          <div class="panel-body">
            <form method="POST" action="{{ url('/gestion-baja-trabajador/'.$idopcion) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
                  {{ csrf_field() }}
    
                  <div class="form-group">
                    <label class="col-sm-3 control-label labeldni">Dni</label><br>
                    <div class="col-sm-5 input-group dnibaja">
                          <input  type="text"
                            id="dni" name='dni' placeholder="Ingrese Dni del Trabajador" required = ""
                            autocomplete="off" class="form-control input-sm validarnumero" data-aw="1"/>

                             <span class="input-group-btn">
                             <button id='buscartrabajadorbaja' type="button" class="btn btn-primary bajatrabajador"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Buscar</font></font></button></span>
                      
                    </div>
                  </div>
            <div class="contentestudiosbaja">
              <div class="panelestudios panel-defaultestudios">
                  <div class="panel-headingestudios">
                    Detalle del Trabajador
                  </div>
                  <div class="panel-bodyestudios trabajadorencontradobaja">
                    
                        <div class="row">

                              <div class="col-sm-6 "> 
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label labelleft">Nombre</label>
                                        <div class="col-sm-5 abajocaja">
                                          <input  type="text"
                                                  id="nombre" name='nombre'  placeholder="Nombre del Trabajador"
                                                  required = ""
                                                  autocomplete="off" class="form-control input-sm validarletras" data-aw="1"/>
                                        </div>
                                      
                                        <input  type="hidden" id="trabajador_id" name='trabajador_id'/>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label labelleft">Apellido Paterno</label>
                                        <div class="col-sm-5 abajocaja">
                                          <input  type="text"
                                                  id="apellidopaterno" name='apellidopaterno'  placeholder="Apellido del Trabajador"
                                                  required = ""
                                                  autocomplete="off" class="form-control input-sm validarletras" data-aw="1"/>
                                        </div>                                        
                                        <input  type="hidden" id="trabajador_id" name='trabajador_id'/>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 -label labelleft">Apellido Materno</label>
                                        <div class="col-sm-5 abajocaja">
                                          <input  type="text"
                                                  id="apellidomaterno" name='apellidomaterno'  placeholder="Apellido del Trabajador"
                                                  required = ""
                                                  autocomplete="off" class="form-control input-sm validarletras" data-aw="1"/>
                                        </div>                                        
                                        <input  type="hidden" id="trabajador_id" name='trabajador_id'/>
                                    </div>


                                </div>
                              </div>

                         

                              <div class="col-sm-6 ">
                                  <div class="panel-body">

                                     <div class="form-group">

                                          <label class="col-sm-3 control-label labelleft">Situación</label>
                                          <div class="col-sm-5 abajocaja">
                                            {!! Form::select( 'situacion_id', $combosituacion, array(),
                                                              [
                                                                'class'       => 'form-control control input-sm' ,
                                                                'id'          => 'situacion_id',
                                                                'required'    => '',
                                                                'data-aw'     => '28'
                                                              ]) !!}
                                          </div>
                                      </div>

                                      <div class="form-group">

                                        <label class="col-sm-3 control-label labelleft">Motivo Baja</label>
                                        <div class="col-sm-5 abajocaja">
                                          {!! Form::select( 'motivobaja_id', $combomotivobaja, array(),
                                                            [
                                                              'class'       => 'form-control control input-sm' ,
                                                              'id'          => 'motivobaja_id',
                                                              'required'    => '',
                                                              'data-aw'     => '26'
                                                            ]) !!}
                                        </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                        


                  </div>
              </div>
            </div>

            <ul class="list-unstyled list-inline pull-right">
              <p class="text-center">
                   <li><button type="submit" id='guardartrabajador' class="btn btn-space btn-primary btn btn-success "><i class="fa fa-check"></i>Guardar</button></li>             
              </p>           
            </ul>

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

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.formElements();
        $('form').parsley();
      });
    </script> 

    <script src="{{ asset('public/js/personal/personal.js') }}" type="text/javascript"></script>


@stop
