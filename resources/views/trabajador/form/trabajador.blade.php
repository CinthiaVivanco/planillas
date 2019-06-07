<div class="containertab">
 <div class="row">
  <div class="process">
   <div class="process-row nav nav-tabs">

    <div class="process-step tabmenu1">
     <button type="button" class="btn btn-info btn-circle" data-toggle="tab" href="#menu1"><i class="fa fa-file-text fa-2x"></i></button>
     <p><small>Datos <br />Personales</small></p>
     <div class='errortab'>
       <i class="fa fa-exclamation" aria-hidden="true"></i> 
     </div>
     <div class='bientab'>
       <i class="fa fa-check" aria-hidden="true"></i> 
     </div>
    </div>

    <div class="process-step tabmenu2">
     <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu2"><i class="fa fa-briefcase fa-2x"></i></button>
     <p><small>Datos<br />Laborales</small></p>
     <div class='errortab'>
       <i class="fa fa-exclamation" aria-hidden="true"></i>
     </div>
     <div class='bientab'>
       <i class="fa fa-check" aria-hidden="true"></i> 
     </div>
    </div>

    <div class="process-step  tabmenu3">
     <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu3"><i class="fa fa-graduation-cap fa-2x"></i></button>
     <p><small>Grado<br />Académico</small></p>
     <div class='errortab'>
       <i class="fa fa-exclamation" aria-hidden="true"></i>
     </div>
     <div class='bientab'>
       <i class="fa fa-check" aria-hidden="true"></i> 
     </div>
    </div>

    <div class="process-step tabmenu4">
     <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu4"><i class="fa fa-home fa-2x"></i></button>
     <p><small>Datos<br />Domicilio</small></p>
     <div class='errortab'>
       <i class="fa fa-exclamation" aria-hidden="true"></i>
     </div>
     <div class='bientab'>
       <i class="fa fa-check" aria-hidden="true"></i> 
     </div>
    </div>

    <div class="process-step tabmenu5">
     <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu5"><i class="fa fa-user-md fa-2x"></i></button>
     <p><small>Seguridad <br />Social</small></p>
     <div class='errortab'>
       <i class="fa fa-exclamation" aria-hidden="true"></i>
     </div>
     <div class='bientab'>
       <i class="fa fa-check" aria-hidden="true"></i> 
     </div>
    </div>

    <div class="process-step tabmenu6">
     <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu6"><i class="fa fa-check fa-2x"></i></button>
     <p><small>Guardar<br />Ficha</small></p>
     <div class='errortab'>
       <i class="fa fa-exclamation" aria-hidden="true"></i>
     </div>
    </div>

   </div>
  </div>
  <div class="tab-content">
    <div id="menu1" class="tab-pane fade active in">
         <h3></h3>

        <div class="row">
          <div class="col-sm-6">        
                <div class="panel-body">
                  <div class="form-group ">

                    <label class="col-sm-12 control-label labelleft" >Tipo Documento  <span class="required">*</span> </label>
                    <div class="col-sm-6 abajocaja" >
                      {!! Form::select( 'tipodocumento_id', $combotipodocumento, array(),
                                        [
                                          'class'       => 'form-control control input-sm dnipais dnivalidar' ,
                                          'id'          => 'tipodocumentos_id',
                                          'required'    => '',
                                          'data-aw'     => '1',
                                        ]) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-12 control-label labelleft">DNI <span class="required">*</span></label>
                    <div class="col-sm-7 abajocaja">

                      <input  type="text"
                              id="dni" name='dni' value="@if(isset($trabajador)){{old('dni' ,$trabajador->dni)}}@else{{old('dni')}}@endif" placeholder="DNI"
                              required = "" class="form-control input-sm validarnumero dnivalida" data-parsley-type="number"
                              autocomplete="off" data-aw="2"/>

                        @include('error.erroresvalidate', [ 'id' => $errors->has('dni')  , 
                                                            'error' => $errors->first('dni', ':message') , 
                                                            'data' => '2'])

                    </div>
                  </div>

                  <div class="form-group paisemisordocumento">

                    <label class="col-sm-12 control-label labelleft" >Pais Emisor</label>
                    <div class="col-sm-7 abajocaja" >
                      {!! Form::select( 'paisemisordocumento_id', $combopaisemisordocumento, array(),
                                        [
                                          'class'       => 'form-control control input-sm paisemisor' ,
                                          'id'          => 'paisemisordocumento_id',
                                          'data-aw'     => '1'
                                        ]) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-12 control-label labelleft">Apellido Paterno <span class="required">*</span></label>
                    <div class="col-sm-7 abajocaja">

                      <input  type="text" onkeypress="return onlyNumbers(event);"
                              id="apellidopaterno" name='apellidopaterno' value="@if(isset($trabajador)){{old('apellidopaterno',$trabajador->apellidopaterno)}}@else{{old('apellidopaterno')}}@endif" placeholder="Apellido Paterno"
                              required = "" maxlength="40"
                              autocomplete="off" class="form-control input-sm validarletras" data-aw="3"/>

                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-12 control-label labelleft">Apellido Materno <span class="required">*</span></label>
                    <div class="col-sm-7 abajocaja">

                      <input  type="text"
                              id="apellidomaterno" name='apellidomaterno' value="@if(isset($trabajador)){{old('apellidomaterno',$trabajador->apellidomaterno)}}@else{{old('apellidomaterno')}}@endif" placeholder="Apellido Materno"
                              required = "" maxlength="40" 
                              autocomplete="off" class="form-control input-sm validarletras" data-aw="4"/>

                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-12 control-label labelleft">Nombres <span class="required">*</span></label>
                      <div class="col-sm-7 abajocaja">

                        <input  type="text"
                                id="nombre" name='nombre' value="@if(isset($trabajador)){{old('nombre',$trabajador->nombres)}}@else{{old('nombre')}}@endif" placeholder="Nombres" required = "" maxlength="40"
                                autocomplete="off" class="form-control input-sm validarletras" data-aw="5"/>

                      </div>
                  </div> 
                </div>
          </div>

            <div class="col-sm-6">

              <div class="panel-body">
                <div class="form-group nacionalidadt">

                    <label class="col-sm-12 control-label labelleft">Nacionalidad</label>
                    <div class="col-sm-7 abajocaja">
                      {!! Form::select( 'nacionalidad_id', $combonacionalidad, array(),
                                        [
                                          'class'       => 'form-control control input-sm' ,
                                          'id'          => 'nacionalidades_id',
                                          'data-aw'     => '9'
                                        ]) !!}
                    </div>
                  </div>


                <div class="form-group">
                    <label class="col-sm-12 control-label labelleft">
                      Fec Nacimiento <span class="required">*</span>
                    </label> 
                    <div class="col-sm-7 abajocaja"> 
                      <div data-min-view="2" data-date-format="dd-mm-yyyy"  class="input-group date datetimepicker">
                                <input size="16" type="text" value="@if(isset($trabajador)){{old('fechanacimiento',date_format(date_create($trabajador->fechanacimiento),'d-m-Y'))}}@else{{old('fechanacimiento')}}@endif" placeholder="Fecha Nacimiento"
                                id='fechanacimiento' name='fechanacimiento' 
                                required = ""
                                class="form-control input-sm">
                                <span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
                      </div>
                    </div>
                  </div>

                 <div class="form-group">
                    <label class="col-sm-12 control-label labelleft">Sexo <span class="required">*</span></label>
                    <div class="col-sm-7 abajocaja">
                      <div class="be-radio has-success inline">
                        <input type="radio" class="radiosexo radio" value='1' @if(isset($trabajador)) @if($trabajador->sexo == 1) checked  @endif @else  @endif name="sexo" id="rad1">
                        <label for="rad1">Masculino</label>
                      </div>
                      <div class="be-radio has-danger inline radio2">
                        <input type="radio" class="radiosexo radio" required = "" value='2' @if(isset($trabajador)) @if($trabajador->sexo == 2) checked  @endif @endif name="sexo" id="rad2">
                        <label for="rad2">Femenino</label>
                      </div>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="col-sm-12 control-label labelleft">Email<span class="required">*</span></label>
                    <div class="col-sm-7 abajocaja">

                      <input  type="email"
                              id="email" name='email' value="@if(isset($trabajador)){{old('email',$trabajador->email)}}@else{{old('email')}}@endif" placeholder="Correo Electronico" required="" 
                              parsley-type="email" maxlength="50" 
                              autocomplete="off" class="form-control input-sm" data-aw="7"/>

                        @include('error.erroresvalidate', [ 'id' => $errors->has('email')  , 
                                                            'error' => $errors->first('email', ':message') , 
                                                            'required'    => '',
                                                            'data' => '7'])
                    </div>
                  </div> 

                  
                  <div class="form-group">

                    <label class="col-sm-12 control-label labelleft">Estado Civil <span class="required">*</span></label>
                    <div class="col-sm-7 abajocaja">
                      {!! Form::select( 'estadocivil_id', $comboestadocivil, array(),
                                        [
                                          'class'       => 'form-control control input-sm' ,
                                          'id'          => 'estadocivils_id',
                                          'required'    => '',
                                          'data-aw'     => '8'
                                        ]) !!}
                    </div>
                  </div>


                  <div class="form-group ">

                    <label class="col-sm-12 control-label labelleft" >Codigo Teléfono</label>
                    <div class="col-sm-5 abajocaja" >
                      {!! Form::select( 'codigotelefono_id', $combocodigotelefono, array(),
                                        [
                                          'class'       => 'form-control control input-sm codigotelefono' ,
                                          'id'          => 'codigotelefono_id',
                                          'data-aw'     => '1',
                                        ]) !!}
                    </div>
                  </div>


                  <div class="form-group numerotelefono">
                    <label class="col-sm-12 control-label labelleft">Telefono<span class="required">*</span></label>
                    <div class="col-sm-5 abajocaja">

                      <input  type="text"
                              id="telefono" name='telefono' value="@if(isset($trabajador)){{old('telefono',$trabajador->telefono)}}@else{{old('telefono')}}@endif"placeholder="Telefono"
                              data-parsley-type="number" required = "" 
                              autocomplete="off" class="form-control input-sm validarnumero telefonocorto" data-aw="6"/>

                    </div>
                  </div>

              </div>

            </div>
        </div>

        <ul class="list-unstyled list-inline pull-right">
         <li><button type="button" class="btn btn-info next-step">Siguiente <i class="fa fa-chevron-right"></i></button></li>
        </ul>
     </div>

     <div id="menu2" class="tab-pane fade">
        <h3></h3>

        <div class="row">

          <div class="col-sm-6">
            <div class="panel-body">


                <div class="form-group">
                     <label class="col-sm-12 control-label labelleft">Tipo Trabajador <span class="required">*</span></label>
                      <div class="col-sm-7 abajocaja">
                        {!! Form::select( 'tipotrabajador_id', $combotipotrabajador, array(),
                                          [
                                            'class'       => 'form-control control input-sm tipotrabajador' ,
                                            'id'          => 'tipotrabajador_id',
                                            'required'    => '',
                                            'data-aw'     => '19'
                                          ]) !!}
                      </div>
                </div>


                <div class="form-group">
                     <label class="col-sm-12 control-label labelleft">Regimen Laboral <span class="required">*</span></label>
                      <div class="col-sm-7 abajocaja">
                        {!! Form::select( 'regimenlaboral_id', $comboregimenlaboral, array(),
                                          [
                                            'class'       => 'form-control control input-sm' ,
                                            'id'          => 'regimenlaboral_id',
                                            'required'    => '',
                                            'data-aw'     => '19'
                                          ]) !!}
                      </div>
                </div>


                <div class="form-group">
                     <label class="col-sm-12 control-label labelleft">Categoria Ocupacional <span class="required">*</span></label>
                      <div class="col-sm-7 abajocaja">
                        {!! Form::select( 'categoriaocupacional_id', $combocategoriaocupacional, array(),
                                          [
                                            'class'       => 'form-control control input-sm' ,
                                            'id'          => 'categoriaocupacional_id',
                                            'required'    => '',
                                            'data-aw'     => '19'
                                          ]) !!}
                      </div>
                </div>


                <div class="form-group">
                     <label class="col-sm-12 control-label labelleft">Ocupacion <span class="required">*</span></label>
                      <div class="col-sm-7 abajocaja">
                        {!! Form::select( 'ocupacion_id', $comboocupacion, array(),
                                          [
                                            'class'       => 'form-control control input-sm' ,
                                            'id'          => 'ocupacion_id',
                                            'required'    => '',
                                            'data-aw'     => '19'
                                          ]) !!}
                      </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-12 control-label labelleft">¿Discapacitado? <span class="required">*</span></label>
                    <div class="col-sm-7 abajocaja">
                      <div class="be-radio has-success inline">
                          <input type="radio" class="radio" value='1' @if(isset($trabajador)) @if($trabajador->discapacidad == 1) checked  @endif @else  @endif name="discapacidad" id="rad3">
                          <label for="rad3">Sí</label>
                      </div>
                      <div class="be-radio has-danger inline radio2">
                          <input type="radio" value='0' class="radio" required = ""  @if(isset($trabajador)) @if($trabajador->discapacidad == 0) checked  @endif @endif name="discapacidad" id="rad4">
                          <label for="rad4">No</label>
                      </div>
                    </div>
                </div>

              
          
            </div>
      
          </div>

          <div class="col-sm-6">

                <div class="panel-body">

                   <div class="form-group">

                              <label class="col-sm-12 control-label labelleft">Situación Especial <span class="required">*</span></label>
                              <div class="col-sm-7 abajocaja">
                                {!! Form::select( 'situacionespecial_id', $combosituacionespecial, array(),
                                                  [
                                                    'class'       => 'form-control control input-sm' ,
                                                    'id'          => 'situacionespecial_id',
                                                    'required'    => '',
                                                    'data-aw'     => '21'
                                                  ]) !!}
                              </div>
                    </div>

                    
                    <div class="form-group">

                          <label class="col-sm-12 control-label labelleft">Entidad Financiera <span class="required">*</span></label>
                          <div class="col-sm-7 abajocaja">
                            {!! Form::select( 'entidadfinanciera_id', $comboentidadfinanciera, array(),
                                              [
                                                'class'       => 'form-control control input-sm' ,
                                                'id'          => 'entidadfinanciera_id',
                                                'required'    => '',
                                                'data-aw'     => '27'
                                              ]) !!}
                          </div>
                    </div>

                    <div class="form-group">

                      <label class="col-sm-12 control-label labelleft">Horario <span class="required">*</span></label>
                      <div class="col-sm-7 abajocaja">
                        {!! Form::select( 'horario_id', $combohorario, array(),
                                          [
                                            'class'       => 'form-control control input-sm' ,
                                            'id'          => 'horario_id',
                                            'required'    => '',
                                            'data-aw'     => '26'
                                          ]) !!}
                      </div>
                    </div>

                   <div class="form-group abajocaja">
                      <label class="col-sm-12 control-label labelleft">¿Sindicalizado? <span class="required">*</span></label>
                      <div class="col-sm-7 abajocaja">
                        <div class="be-radio has-success inline">
                          <input type="radio" value='1' class="radio" @if(isset($trabajador)) @if($trabajador->sindicalizado == 1) checked  @endif @else  @endif name="sindicalizado" id="rad5">
                          <label for="rad5">Sí</label>
                        </div>
                        <div class="be-radio has-danger inline radio2">
                          <input type="radio" value='0' class="radio" required = "" @if(isset($trabajador)) @if($trabajador->sindicalizado == 0) checked  @endif @endif name="sindicalizado" id="rad6">
                          <label for="rad6">No</label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">

                      <label class="col-sm-12 control-label labelleft">Convenio para evitar la doble tributación <span class="required">*</span></label>
                      <div class="col-sm-7 abajocaja">
                        {!! Form::select( 'convenio_id', $comboconvenio, array(),
                                          [
                                            'class'       => 'form-control control input-sm' ,
                                            'id'          => 'convenio_id',
                                            'required'    => '',
                                            'data-aw'     => '26'
                                          ]) !!}
                      </div>
                    </div>

               </div>

          </div>

        </div>

        
        <ul class="list-unstyled list-inline pull-right">
         <li><button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Atrás</button></li>
         <li><button type="button" class="btn btn-info next-step">Siguiente <i class="fa fa-chevron-right"></i></button></li>
        </ul>
     </div>

<div id="menu3" class="tab-pane fade">
      <h3></h3>
      <div class="row">
              <div class="col-sm-6 col-md-offset-3">
                <div class="panel-body">
                   <div class="form-group niveleducativo">
                          <label class="col-sm-12 control-label labelleft">Nivel Educativo</label>
                          <div class="col-sm-5 abajocaja nivel" >
                            {!! Form::select( 'situacioneducativa_id', $combosituacioneducativa, array(),
                                          [
                                      'class'       => 'form-control control input-sm' ,
                                      'id'          => 'situacioneducativa_id',
                                      'data-aw'     => '28'

                                    ]) !!}
                          </div>

                   </div>
                </div>
              </div>

              <div class="col-sm-6 ">
                  <input type="hidden" value="0" id='swga'/>
              </div>
      </div>


      <div class="contentestudios @if(isset($trabajador)) 
                    @if(isset($trabajador->regimeninstitucion))
                      mostrar
                    @else
                      ocultar 
                    @endif
                  @else
                    ocultar 
                  @endif" id="contentestudiosid">
          <div class="panelestudios panel-defaultestudios">
              <div class="panel-headingestudios">
                Detalle de estudios concluidos
              </div>
              <div class="panel-bodyestudios">
                
                <div class="row">

                      <div class="col-sm-6 "> 
                        <div class="panel-body">

                              <div class="form-group radioe">

                                  <label class="col-sm-12 control-label labelleft">¿Estudios en Perú? <span class="required">*</span></label>
                                  <div class="col-sm-5 abajocaja">
                                    <div class="be-radio has-success inline">
                                      <input type="radio" value='1' class="radio radioestudios" @if(isset($trabajador)) @if($trabajador->estudiosperu == 1) checked  @endif @else  @endif name="estudiosperu" id="rad20">
                                      <label for="rad20">Sí</label>
                                    </div>
                                    <div class="be-radio has-danger inline radio2">
                                      <input type="radio" value='0' class="radio radioestudios" required = ""  
                                      @if(isset($trabajador)) 
                                          @if($trabajador->estudiosperu == 0) 
                                              checked
                                          @endif 
                                      @endif 
                                      name="estudiosperu" id="rad21">
                                      <label for="rad21">No</label>
                                    </div>
                                  </div>
                              </div>

                              <div class="form-group">

                                    <label class="col-sm-12 control-label labelleft">Regimen Institucion <span class="required">*</span></label>
                                    <div class="col-sm-5 abajocaja">
                                        {!! Form::select( 'regimeninstitucion_id', $comboregimeninstitucion, array(),
                                                          [
                                                            'class'       => 'form-control control input-sm' ,
                                                            'id'          => 'regimeninstitucion_id',
                                                            'required'    => '',
                                                            'data-aw'     => '10'
                                                          ]) !!}
                                    </div>
                              </div>


                              <div class="form-group ajaxtipoinstitucion">

                                  <label class="col-sm-12 control-label labelleft">Tipo Institucion <span class="required">*</span></label>
                                  <div class="col-sm-5 abajocaja">
                                    {!! Form::select( 'tipoinstitucion_id', $combotipoinstitucion, array(),
                                                      [
                                                        'class'       => 'form-control control input-sm' ,
                                                        'id'          => 'tipoinstitucion_id',
                                                        'required'    => '',
                                                        'data-aw'     => '11'
                                                      ]) !!}
                                  </div>
                              </div>

                        </div>
                      </div>

                      <div class="col-sm-6 ">

                          <div class="panel-body">

                                <div class="form-group ajaxinstitucion">
                                      <label class="col-sm-12 control-label labelleft">Institucion<span class="required">*</span></label>
                                      <div class="col-sm-5 abajocaja">
                                        {!! Form::select( 'institucion_id', $comboinstitucion, array(),
                                                          [
                                                            'class'       => 'form-control control input-sm' ,
                                                            'id'          => 'institucion_id',
                                                            'required'    => '',
                                                            'data-aw'     => '12'
                                                          ]) !!}
                                      </div>
                                </div>

                                <div class="form-group ajaxcarrera">
                                      <label class="col-sm-12 control-label labelleft">Carrera <span class="required">*</span></label>
                                      <div class="col-sm-5 abajocaja">
                                        {!! Form::select( 'carrera_id', $combocarrera, array(),
                                                          [
                                                            'class'       => 'form-control control input-sm' ,
                                                            'id'          => 'carrera_id',
                                                            'required'    => '',
                                                            'data-aw'     => '12'
                                                          ]) !!}
                                      </div>
                                </div>

                                <div class="form-group">
                                      <label class="col-sm-12 control-label labelleft">Año Egreso  <span class="required">*</span></label>
                                      <div class="col-sm-5 abajocaja">

                                        <input  type="text"
                                                id="anioegreso" name='anioegreso' value="@if(isset($trabajador)){{old('anioegreso',$trabajador->anioegreso)}}@else{{old('anioegreso')}}@endif" placeholder="Año Egreso"
                                                required = "" data-parsley-minlength="4" data-parsley-maxlength="4"  data-parsley-type="number"
                                                autocomplete="off" class="form-control input-sm validarnumero" data-aw="6"/>

                                      </div>
                                </div>

                          </div>
                      </div>

                </div>


              </div>
          </div>
      </div>

      

      <ul class="list-unstyled list-inline pull-right">
       <li><button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i>Atrás</button></li>
       <li><button type="button" class="btn btn-info next-step">Siguiente <i class="fa fa-chevron-right"></i></button></li>
      </ul>

</div>

     <div id="menu4" class="tab-pane fade">
        <h3></h3>


            <div class="row">

              <div class="col-sm-6">
                <div class="panel-body">

                    <div class="form-group">

                        <label class="col-sm-12 control-label labelleft">País <span class="required">*</span></label>
                        <div class="col-sm-7 abajocaja">
                          {!! Form::select( 'pais_id', $combopais, array(),
                                            [
                                              'class'       => 'form-control control input-sm' ,
                                              'id'          => 'paises_id',
                                              'required'    => '',
                                              'data-aw'     => '9'
                                            ]) !!}
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-sm-12 control-label labelleft">Departamento <span class="required">*</span></label>
                        <div class="col-sm-7 abajocaja">
                          {!! Form::select( 'departamento_id', $combodepartamento, array(),
                                            [
                                              'class'       => 'form-control control input-sm' ,
                                              'id'          => 'departamentos_id',
                                              'required'    => '',
                                              'data-aw'     => '10'
                                            ]) !!}
                        </div>
                    </div>
                    



                    <div class="form-group ajaxprovincia">

                       @include('general.ajax.comboprovincia', ['comboprovincia' => $comboprovincia])

                    </div>

                  <div class="form-group ajaxdistrito">

                        @include('general.ajax.combodistrito', ['combodistrito' => $combodistrito])
                  </div>


                  <div class="form-group">

                        <label class="col-sm-12 control-label labelleft">Tipo Vía <span class="required">*</span></label>
                        <div class="col-sm-7 abajocaja">
                          {!! Form::select( 'tipovia_id', $combotipovia, array(),
                                            [
                                              'class'       => 'form-control control input-sm' ,
                                              'id'          => 'tipovias_id',
                                              'required'    => '',
                                              'data-aw'     => '11'
                                            ]) !!}
                        </div>
                  </div>

                  <div class="form-group">
                        <label class="col-sm-12 control-label labelleft" >Nombre Vía <span class="required">*</span></label>
                        <div class="col-sm-7 abajocaja">

                          <input  type="text"
                                  id="nombrevia" name='nombrevia' value="@if(isset($trabajador)){{old('nombrevia',$trabajador->nombrevia)}}@else{{old('nombrevia')}}@endif" placeholder="Nombre Vía"
                                  required = "" maxlength="20" 
                                  autocomplete="off" class="form-control input-sm validarletras" data-aw="12"/>

                        </div>
                  </div>

              
                </div>
          
              </div>

              <div class="col-sm-6">

                    <div class="panel-body">

                      <div class="form-group">
                        <label class="col-sm-12 control-label labelleft">Número Vía</label>
                        <div class="col-sm-7 abajocaja">

                          <input  type="text"
                                  id="numerovia" name='numerovia' value="@if(isset($trabajador)){{old('numerovia',$trabajador->numerovia)}}@else{{old('numerovia')}}@endif" placeholder="Número Vía" maxlength="4" 
                                  autocomplete="off" class="form-control input-sm" data-aw="13"/>

                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-12 control-label labelleft">Interior</label>
                        <div class="col-sm-7 abajocaja">

                          <input  type="text" maxlength="4" 
                                  id="interior" name='interior' value="@if(isset($trabajador)){{old('interior',$trabajador->interior)}}@else{{old('interior')}}@endif" placeholder="Interior"
                                  autocomplete="off" class="form-control input-sm" data-aw="14"/>

                        </div>
                      </div>

                      <div class="form-group">

                        <label class="col-sm-12 control-label labelleft">Tipo Zona <span class="required">*</span></label>
                        <div class="col-sm-7 abajocaja">
                          {!! Form::select( 'tipozona_id', $combotipozona, array(),
                                            [
                                              'class'       => 'form-control control input-sm' ,
                                              'id'          => 'tipozonas_id',
                                              'required'    => '',
                                              'data-aw'     => '15'
                                            ]) !!}
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-12 control-label labelleft">Nombre Zona</label>
                        <div class="col-sm-7 abajocaja">

                          <input  type="text"
                                  id="nombrezona" name='nombrezona' value="@if(isset($trabajador)){{old('nombrezona',$trabajador->nombrezona)}}@else{{old('nombrezona')}}@endif" placeholder="Nombre Zona" maxlength="20"
                                  autocomplete="off" class="form-control input-sm validarletras" data-aw="16"/>

                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-12 control-label labelleft">Referencia</label>
                        <div class="col-sm-7 abajocaja">

                          <input  type="text"
                                  id="referencia" name='referencia' value="@if(isset($trabajador)){{old('referencia',$trabajador->referencia)}}@else{{old('referencia')}}@endif" placeholder="Referencia
"                                  autocomplete="off" class="form-control input-sm" maxlength="40" data-aw="17"/>

                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-12 control-label labelleft">Domiciliado <span class="required">*</span></label>
                        <div class="col-sm-7 abajocaja">
                          <div class="be-radio has-success inline">
                              <input type="radio" value='1' class="radio" @if(isset($trabajador)) @if($trabajador->domiciliado == 1) checked  @endif @else  @endif name="domiciliado" id="rad17">
                              <label for="rad17">Sí</label>
                          </div>
                          <div class="be-radio has-danger inline radio2">
                              <input type="radio" value='0' class="radio" required = ""  @if(isset($trabajador)) @if($trabajador->domiciliado == 0) checked  @endif @endif name="domiciliado" id="rad18">
                              <label for="rad18">No</label>
                          </div>
                        </div>
                      </div> 

                    </div>

              </div>
              
            </div>
        <ul class="list-unstyled list-inline pull-right">
         <li><button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i>Atrás</button></li>
         <li><button type="button" class="btn btn-info next-step">Siguiente<i class="fa fa-chevron-right"></i></button></li>
        </ul>
       </div>

     <div id="menu5" class="tab-pane fade">
        <h3></h3>
        <div class="row">

              <div class="col-sm-6">
                <div class="panel-body">

                     <div class="form-group">

                          <label class="col-sm-12 control-label labelleft">Regimen Salud <span class="required">*</span></label>
                          <div class="col-sm-7 abajocaja">
                            {!! Form::select( 'regimensalud_id', $comboregimensalud, array(),
                                              [
                                                'class'       => 'form-control control input-sm' ,
                                                'id'          => 'regimensalud_id',
                                                'required'    => '',
                                                'data-aw'     => '29'
                                              ]) !!}
                          </div>
                     </div>

                     <div class="form-group">

                          <label class="col-sm-12 control-label labelleft">Regimen Pensionario <span class="required">*</span> </label>
                          <div class="col-sm-7 abajocaja">
                            {!! Form::select( 'regimenpensionario_id', $comboregimenpensionario, array(),
                                              [
                                                'class'       => 'form-control control input-sm',
                                                'id'          => 'regimenpensionario_id',
                                                'required'    => '',
                                                'data-aw'     => '30'
                                              ]) !!}
                          </div>
                      </div>


                      <div class="form-group">
                          <label class="col-sm-12 control-label labelleft">CUSSP</label>
                          <div class="col-sm-7 abajocaja">
                            <input  type="text"
                                    id="cussp" name='cussp' value="@if(isset($trabajador)){{old('cussp',$trabajador->cussp)}}@else{{old('cussp')}}@endif" placeholder="Cussp" minlength="12" maxlength="12"

                                    @if(isset($trabajador)) @if(isset($trabajador->cussp)) minlength="12" maxlength="12" @endif @endif autocomplete="off" class="form-control input-sm numerocussp validarnumero" data-aw="6"/>

                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-12 control-label labelleft">ESSALUD <span class="required">*</span></label>
                          <div class="col-sm-7 abajocaja">
                            <div class="be-radio has-success inline">
                              <input type="radio" value='1' class="radio" @if(isset($trabajador)) @if($trabajador->essaludvida == 1) checked  @endif @else  @endif name="essaludvida" id="rad9">
                              <label for="rad9">Sì</label>
                            </div>
                            <div class="be-radio has-danger inline radio2">
                              <input type="radio" value='0' class="radio" required = ""  @if(isset($trabajador)) @if($trabajador->essaludvida == 0) checked  @endif @endif name="essaludvida" id="rad10">
                              <label for="rad10">No</label>
                            </div>
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-12 control-label labelleft">SENATI <span class="required">*</span></label>
                        <div class="col-sm-7 abajocaja">
                          <div class="be-radio has-success inline">
                            <input type="radio" value='1' class="radio" @if(isset($trabajador)) @if($trabajador->senati == 1) checked  @endif @else  @endif name="senati" id="rad11">
                            <label for="rad11">Sí</label>
                          </div>
                          <div class="be-radio has-danger inline radio2">
                            <input type="radio" value='0' class="radio" required = ""  @if(isset($trabajador)) @if($trabajador->senati == 0) checked  @endif @endif name="senati" id="rad12">
                            <label for="rad12">No </label>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-12 control-label labelleft">SCTR Salud</label>
                        <div class="col-sm-7 abajocaja">
                          <div class="be-radio has-success inline">
                            <input type="radio" value='1' class="radio" @if(isset($trabajador)) @if($trabajador->sctrsalud == 1) checked  @endif @else  @endif name="sctrsalud" id="rad13">
                            <label for="rad13">Essalud</label>
                          </div>
                          <div class="be-radio has-danger inline radio2">
                            <input type="radio" value='0' class="radio"  @if(isset($trabajador)) @if($trabajador->sctrsalud == 0) checked  @endif @endif name="sctrsalud" id="rad14">
                            <label for="rad14">Eps</label>
                          </div>
                        </div>
                      </div>

                      

              
                </div>
          
              </div>

              <div class="col-sm-6">

                  <div class="panel-body">

                          <div class="form-group">
                            <label class="col-sm-12 control-label labelleft">SCTR Pensiones</label>
                            <div class="col-sm-7 abajocaja">
                              <div class="be-radio has-success inline">
                                <input type="radio" value='1' class="radio" @if(isset($trabajador)) @if($trabajador->sctrpensiones == 1) checked  @endif @else  @endif name="sctrpensiones" id="rad15">
                                <label for="rad15">Onp</label>
                              </div>
                              <div class="be-radio has-danger inline radio2">
                                <input type="radio" value='2' class="radio" @if(isset($trabajador)) @if($trabajador->sctrpensiones == 0) checked  @endif @endif name="sctrpensiones" id="rad16">
                                <label for="rad16">Seguro Privado</label>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                                <label class="col-sm-12 control-label labelleft">¿Afiliado a EPS? <span class="required">*</span></label>
                                <div class="col-sm-7 abajocaja">
                                  <div class="be-radio has-success inline">
                                    <input type="radio" value='1' class="radio" @if(isset($trabajador)) @if($trabajador->afiliadoeps == 1) checked  @endif @else  @endif name="afiliadoeps" id="rad7">
                                    <label for="rad7">Sí</label>
                                  </div>
                                  <div class="be-radio has-danger inline radio2">
                                    <input type="radio" value='0' class="radio" required = ""  @if(isset($trabajador)) @if($trabajador->afiliadoeps == 0) checked  @endif @endif name="afiliadoeps" id="rad8">
                                    <label for="rad8">No</label>
                                  </div>
                                </div>
                          </div>

                          <div class="form-group">

                                <label class="col-sm-12 control-label labelleft">EPS</label>
                                <div class="col-sm-7 abajocaja">
                                  {!! Form::select( 'codigoeps_id', $combocodigoeps, array(),
                                                    [
                                                      'class'       => 'form-control control input-sm' ,
                                                      'id'          => 'codigoeps_id',
                                                      'data-aw'     => '28'
                                                    ]) !!}
                                </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-12 control-label grande labelleft" >¿Tiene otros ingresos afectos a la Renta de Quinta?</label>

                              <div class="col-sm-7 abajocaja otrarenta">
                                <div class="be-radio has-success inline">
                                  <input 
                                  type="radio" 
                                  value='1' 
                                  class="radio"
                                  @if(isset($trabajador)) 
                                    @if($trabajador->rentaquinta == 1)
                                     checked  
                                    @endif 
                                  @else  
                                  @endif 
                                  name="rentaquinta" 
                                  id="rad22">
                                  <label for="rad22">Sí</label>
                                </div>

                                <div class="be-radio has-danger inline radio2">
                                  <input type="radio" value='0' class="radio" required = ""  @if(isset($trabajador)) @if($trabajador->rentaquinta == 0) checked  @endif @endif name="rentaquinta" id="rad23">
                                  <label for="rad23">No</label>
                                </div>
                              </div>
                          </div>

                          <div class="col-sm-7 otrarentaquinta">
                            <input  type="text" 
                                    id="otrarentaquinta" 
                                    name="otrarentaquinta"    
                                    placeholder="Ingrese importe"
                                    class="form-control input-sm
                                        @if(isset($trabajador))
                                          @if(count($trabajador)>0)
                                            @if($trabajador->otrarentaquinta == '')
                                              hide  
                                            @endif
                                          @else 
                                            hide  
                                          @endif
                                        @else 
                                            hide 
                                        @endif""
                                        data-aw='1'
                                        @if(isset($trabajador)) 
                                          @if($trabajador->otrarentaquinta <> '')     
                                            value='{{$trabajador->otrarentaquinta}}'  required   
                                          @endif 
                                        @endif"

                            />

                          </div> 
                    
                          <div class="form-group">
                            <label class="col-sm-12 control-label labelleft">¿Percibe Rentas de Quinta Exonerada?</label>
                            <div class="col-sm-7 abajocaja">
                              <div class="be-radio has-success inline">
                                <input type="radio" value='1' class="radio" @if(isset($trabajador)) @if($trabajador->quintaexonerada == 1) checked  @endif @else  @endif name="quintaexonerada" id="rad24">
                                <label for="rad24">Sí</label>
                              </div>
                              <div class="be-radio has-danger inline radio2">
                                <input type="radio" value='0' class="radio" required = ""  @if(isset($trabajador)) @if($trabajador->quintaexonerada == 0) checked  @endif @endif name="quintaexonerada" id="rad25">
                                <label for="rad25">No</label>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-12 control-label labelleft">¿Asignación Familiar? <span class="required">*</span></label>
                            <div class="col-sm-7 abajocaja hijos">
                              <div class="be-radio has-success inline">
                                <input 
                                type="radio" 
                                value='1' 
                                class="radio" 
                                @if(isset($trabajador))
                                   @if($trabajador->asignacionfamiliar == 1) 
                                      checked  
                                   @endif 
                                @else  
                                @endif 
                                name="asignacionfamiliar" 
                                id="rad26">
                                <label for="rad26">Sí</label>
                              </div>

                              <div class="be-radio has-danger inline radio2">
                                <input type="radio" value='0' class="radio" required = ""  @if(isset($trabajador)) @if($trabajador->asignacionfamiliar == 0) checked  @endif @endif name="asignacionfamiliar" id="rad27">
                                <label for="rad27">No</label>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-7 nrohijos">
                            <input  type="text" 
                                    id="nrohijos" 
                                    name="nrohijos"    
                                    placeholder="Ingrese Nro Hijos"
                                    class="form-control input-sm
                                        @if(isset($trabajador))
                                          @if(count($trabajador)>0)
                                            @if($trabajador->nrohijos == '')
                                              hide  
                                            @endif
                                          @else 
                                            hide  
                                          @endif
                                        @else 
                                            hide 
                                        @endif""
                                        data-aw='1'
                                        @if(isset($trabajador)) 
                                          @if($trabajador->nrohijos <> '')     
                                            value='{{$trabajador->nrohijos}}'  required   
                                          @endif 
                                        @endif"

                            />

                          </div> 


                  </div>
              </div>

        </div>

          <ul class="list-unstyled list-inline pull-right">
           <li><button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Atrás</button></li>
           <li><button type="button" class="btn btn-info next-step">Siguiente <i class="fa fa-chevron-right"></i></button></li>
          </ul>
     </div>

     <div id="menu6" class="tab-pane fade">
          <h3></h3>
          <center><p>¿Seguro que desea guardar esta ficha?</p></center>

          <ul class="list-unstyled list-inline pull-right">
            <p class="text-center">
                 <li><button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Atrás</button></li>
                 <li><button type="submit" id='guardartrabajador' class="btn btn-space btn-primary btn btn-success "><i class="fa fa-check"></i>Guardar</button></li>             
            </p>           
          </ul>
     </div>

  </div>
  </div>
 </div>
</div>