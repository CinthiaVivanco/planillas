<div class="form-group">
  <label class="col-sm-3 control-label">Nombre: <span class="required">*</span></label>
  <div class="col-sm-5">

    <input  type="text"
            id="nombre" name='nombre' value="@if(isset($banco)){{old('nombre',$banco->nombre)}}@else{{old('nombre')}}@endif" placeholder="Nombre del Banco"
            required = "" data-parsley-maxlength="200"
            autocomplete="off" class="form-control input-sm" data-aw="2"/>

  </div>
</div>

<div class="form-group">
  <label class="col-sm-3 control-label">Contacto: <span class="required">*</span></label>
  <div class="col-sm-5">

    <input  type="text"
            id="contacto" name='contacto' value="@if(isset($banco)){{old('contacto',$banco->contacto)}}@else{{old('contacto')}}@endif" placeholder="Contacto"
            required = "" data-parsley-maxlength="200"
            autocomplete="off" class="form-control input-sm" data-aw="2"/>

  </div>
</div>

<div class="form-group">
  <label class="col-sm-3 control-label">Cuenta Corriente: <span class="required">*</span></label>
  <div class="col-sm-5">

    <input  type="text"
            id="cuentacorriente" name='cuentacorriente' value="@if(isset($banco)){{old('cuentacorriente',$banco->cuentacorriente)}}@else{{old('cuentacorriente')}}@endif" placeholder="Cuenta Corriente"
            required = "" data-parsley-maxlength="200"
            autocomplete="off" class="form-control input-sm" data-aw="2"/>

  </div>
</div>


@if(isset($banco))
<div class="form-group">
  <label class="col-sm-3 control-label">Activo</label>
  <div class="col-sm-6">
    <div class="be-radio has-success inline">
      <input type="radio" value='1' @if($banco->activo == 1) checked @endif name="activo" id="rad6">
      <label for="rad6">Activado</label>
    </div>
    <div class="be-radio has-danger inline">
      <input type="radio" value='0' @if($banco->activo == 0) checked @endif name="activo" id="rad8">
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