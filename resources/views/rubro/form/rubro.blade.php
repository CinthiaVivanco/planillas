<div class="form-group">
  <label class="col-sm-3 control-label">Codigo <span class="required">*</span></label>
  <div class="col-sm-5">

    <input  type="text"
            id="codigo" name='codigo' value="@if(isset($rubro)){{old('codigo',$rubro->codigo)}}@else{{old('codigo')}}@endif" placeholder="Codigo"
            required = "" data-parsley-maxlength="5"
            autocomplete="off" class="form-control input-sm" data-aw="1"/>


    @include('error.erroresvalidate', [ 'id' => $errors->has('codigo')  , 
                                                          'error' => $errors->first('codigo', ':message') , 
                                                          'data' => '1'])      

  </div>
</div>


<div class="form-group">
  <label class="col-sm-3 control-label">Descripcion <span class="required">*</span></label>
  <div class="col-sm-5">

    <input  type="text"
            id="descripcion" name='descripcion' value="@if(isset($rubro)){{old('descripcion',$rubro->descripcion)}}@else{{old('descripcion')}}@endif" placeholder="Descripcion"
            required = "" data-parsley-maxlength="200"
            autocomplete="off" class="form-control input-sm" data-aw="2"/>

  </div>
</div>


<div class="form-group">

  <label class="col-sm-3 control-label">Rubro <span class="required">*</span></label>
  <div class="col-sm-5">
    {!! Form::select( 'rubro_id', $combotiporubro, array(),
    [
      'class'       => 'form-control control input-sm' ,
      'id'          => 'rubro_id',
      'required'    => '',
      'data-aw'     => '3'
    ]) !!}
  </div>
</div>



<div class="form-group">
  <label class="col-sm-3 control-label">Monto <span class="required">*</span></label>
  <div class="col-sm-5">

    <input  type="text"
            id="monto" name='monto' value="@if(isset($rubro)){{old('monto',$rubro->monto)}}@else{{old('monto',0.00)}}@endif" placeholder="Monto"
            required = ""
            autocomplete="off" data-parsley-type="number" class="form-control input-sm" data-aw="4"/>

  </div>
</div>

<div class="form-group">
  <label class="col-sm-3 control-label">Porcentaje (%) <span class="required">*</span></label>
  <div class="col-sm-5">

    <input  type="text"
            id="porcentaje" name='porcentaje' value="@if(isset($rubro)){{old('porcentaje',$rubro->porcentaje)}}@else{{old('porcentaje',0.00)}}@endif" placeholder="Porcentaje"
            required = "" data-parsley-mayoracero='monto'
            autocomplete="off" data-parsley-type="number" class="form-control input-sm" data-aw="5"/>

  </div>
</div>


<div class="form-group">
  <label class="col-sm-3 control-label">Codigo RTPS <span class="required">*</span></label>
  <div class="col-sm-5">

    <input  type="text"
            id="codigortps" name='codigortps' value="@if(isset($rubro)){{old('codigortps',$rubro->codigortps)}}@else{{old('codigortps')}}@endif" placeholder="Codigo RTPS " data-parsley-maxlength="10"
            autocomplete="off" class="form-control input-sm" data-aw="6"/>

  </div>
</div>
@if(isset($rubro))
<div class="form-group">
  <label class="col-sm-3 control-label">Activo</label>
  <div class="col-sm-6">
    <div class="be-radio has-success inline">
      <input type="radio" value='1' @if($rubro->activo == 1) checked @endif name="activo" id="rad6">
      <label for="rad6">Activado</label>
    </div>
    <div class="be-radio has-danger inline">
      <input type="radio" value='0' @if($rubro->activo == 0) checked @endif name="activo" id="rad8">
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