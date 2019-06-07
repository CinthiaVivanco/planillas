  <div class="form-group">
    <label class="col-sm-3 control-label">Nombre: <span class="required">*</span></label>
    <div class="col-sm-5">

      <input  type="text"
              id="nombre" name='nombre' value="@if(isset($afp)){{old('nombre',$afp->nombre)}}@else{{old('nombre')}}@endif" placeholder="Nombre"
              required = "" autocomplete="off" class="form-control input-sm" data-aw="1"/>  

    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Dirección: <span class="required">*</span></label>
    <div class="col-sm-5">

      <input  type="text"
              id="direccion" name='direccion' value="@if(isset($afp)){{old('direccion',$afp->direccion)}}@else{{old('direccion')}}@endif" placeholder="Direccción"
              required = "" autocomplete="off" class="form-control input-sm" data-aw="2"/>

    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Contacto: <span class="required">*</span></label>
    <div class="col-sm-5">

      <input  type="text"
              id="contacto" name='contacto' value="@if(isset($afp)){{old('contacto',$afp->contacto)}}@else{{old('contacto')}}@endif" placeholder="Contacto"
              required = "" autocomplete="off" class="form-control input-sm" data-aw="2"/>

    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Teléfono:</label>
    <div class="col-sm-5">

      <input  type="text"
              id="telefono1" name='telefono1' value="@if(isset($afp)){{old('telefono1',$afp->telefono1)}}@else{{old('telefono1')}}@endif" placeholder="Primer Teléfono"
              autocomplete="off" class="form-control input-sm" data-aw="2"/>

    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Teléfono:</label>
    <div class="col-sm-5">

      <input  type="text"
              id="telefono2" name='telefono2' value="@if(isset($afp)){{old('telefono2',$afp->telefono2)}}@else{{old('telefono2')}}@endif" placeholder="Segundo Teléfono"
              autocomplete="off" class="form-control input-sm" data-aw="2"/>

    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Fondo Pens: (%)</label>
    <div class="col-sm-5">

      <input  type="text"
              id="fondo" name='fondo' value="@if(isset($afp)){{old('fondo',$afp->fondo)}}@else{{old('fondo',0.00)}}@endif" placeholder="Fondo de Pensiones" autocomplete="off" data-parsley-type="number" class="form-control input-sm" data-aw="4"/>

    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Comisión(%):</label>
    <div class="col-sm-5">

      <input  type="text"
              id="comision" name='comision' value="@if(isset($afp)){{old('comision',$afp->comision)}}@else{{old('comision',0.00)}}@endif" placeholder="Comisión"data-parsley-mayoracero='comision' autocomplete="off" data-parsley-type="number" class="form-control input-sm" data-aw="5"/>

    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Seguro(%)</label>
    <div class="col-sm-5">

      <input  type="text"
              id="seguro" name='seguro' value="@if(isset($afp)){{old('seguro',$afp->seguro)}}@else{{old('seguro',0.00)}}@endif" placeholder="Seguro" data-parsley-mayoracero='seguro' autocomplete="off" data-parsley-type="number" class="form-control input-sm" data-aw="5"/>


    </div>
  </div>

  @if(isset($afp))
  <div class="form-group">
    <label class="col-sm-3 control-label">Activo</label>
    <div class="col-sm-5">
      <div class="be-radio has-success inline">
        <input type="radio" value='1' @if($afp->activo == 1) checked @endif name="activo" id="rad6">
        <label for="rad6">Activado</label>
      </div>
      <div class="be-radio has-danger inline">
        <input type="radio" value='0' @if($afp->activo == 0) checked @endif name="activo" id="rad8">
        <label for="rad8">Desactivado</label>
      </div>
    </div>
  </div> 
  @endif

  <div class="row xs-pt-15">
    <div class="col-xs-6">
        <div class="be-checkbox">

        </div>
    </div>
    <div class="col-xs-6">
      <p class="text-right">
        <button type="submit" class="btn btn-space btn-primary">Guardar</button>
      </p>
    </div>
  </div>
