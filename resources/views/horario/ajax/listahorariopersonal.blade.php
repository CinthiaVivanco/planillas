<table id="thorario" class="table table-striped table-striped dt-responsive nowrap listatabla" style='width: 100%;'>

  <thead>
    <tr>
      <th>Trabajador</th>
      <th class='text-center'>Lunes</th>
      <th class='text-center'>Martes</th>
      <th class='text-center'>Miercoles</th>
      <th class='text-center'>Jueves</th>
      <th class='text-center'>Viernes</th>
      <th class='text-center'>Sabado</th>
      <th class='text-center'>Domingo</th>     
    </tr>
  </thead>
  <tbody>

    @foreach($listahorario as $item)
      <tr>
        <td>  
            {{$item->trabajador->nombres}} {{$item->trabajador->apellidopaterno}} {{$item->trabajador->apellidomaterno}}
        </td>
        <td class="cell-detail">

          <div class="text-center be-checkbox be-checkbox-sm">
            <input  type="checkbox"
                    class="{{Hashids::encode(substr($item->id, -12))}}"
                    id="lu{{Hashids::encode(substr($item->id, -12))}}"
                    @if ($item->luh == 1) checked @endif >
            <label  for="lu{{Hashids::encode(substr($item->id, -12))}}"
                    data-atr = "luh"
                    data-dia = "lu"
                    class = "checkbox"                    
                    name="{{Hashids::encode(substr($item->id, -12))}}"
              ></label>
          </div>

          {!! 
            Form::select( 'horario_id', 
                          $combohorario, 
                          $item->hlu,
                          [
                            'class'       => 'comboh form-control control input-fr' ,
                            'id'          => 'horario_id',
                            'required'    => '',
                            'data-aw'     => '1',
                            'data-attr'   => 'lu',
                            'data-id'     => Hashids::encode(substr($item->id, -12))
                          ]) 
          !!}

          <span class="text-center cell-detail-description cell-detail-descriptionfr">
            {{date_format(date_create($item->lud), 'd/m/Y')}}
          </span>
          <span class="text-center cell-detail-description cell-detail-descriptionfr labelhora">
            {{$item->rhlu}}
          </span>
        </td>
        <td class="cell-detail">

          <div class="text-center be-checkbox be-checkbox-sm">
            <input  type="checkbox"
                    class="{{Hashids::encode(substr($item->id, -12))}}"
                    id="ma{{Hashids::encode(substr($item->id, -12))}}"
                    @if ($item->mah == 1) checked @endif >
            <label  for="ma{{Hashids::encode(substr($item->id, -12))}}"
                    data-atr = "mah"
                    data-dia = "ma"
                    class = "checkbox"                    
                    name="{{Hashids::encode(substr($item->id, -12))}}"
              ></label>
          </div>



          {!! 
            Form::select( 'horario_id', 
                          $combohorario, 
                          $item->hma,
                          [
                            'class'       => 'comboh form-control control input-fr' ,
                            'id'          => 'horario_id',
                            'required'    => '',
                            'data-attr'   => 'ma',
                            'data-aw'     => '1',
                            'data-id'     => Hashids::encode(substr($item->id, -12))
                          ]) 
          !!}

          <span class="text-center cell-detail-description cell-detail-descriptionfr">
            {{date_format(date_create($item->mad), 'd/m/Y')}}
          </span>
          <span class="text-center cell-detail-description cell-detail-descriptionfr labelhora">
            {{$item->rhma}}
          </span>          
        </td>
        <td class="cell-detail">

          <div class="text-center be-checkbox be-checkbox-sm">
            <input  type="checkbox"
                    class="{{Hashids::encode(substr($item->id, -12))}}"
                    id="mi{{Hashids::encode(substr($item->id, -12))}}"
                    @if ($item->mih == 1) checked @endif >
            <label  for="mi{{Hashids::encode(substr($item->id, -12))}}"
                    data-atr = "mih"
                    data-dia = "mi"
                    class = "checkbox"                    
                    name="{{Hashids::encode(substr($item->id, -12))}}"
              ></label>
          </div>

          {!! 
            Form::select( 'horario_id', 
                          $combohorario, 
                          $item->hmi,
                          [
                            'class'       => 'comboh form-control control input-fr' ,
                            'id'          => 'horario_id',
                            'required'    => '',
                            'data-attr'   => 'mi',
                            'data-aw'     => '1',
                            'data-id'     => Hashids::encode(substr($item->id, -12))
                          ]) 
          !!}

          <span class="text-center cell-detail-description cell-detail-descriptionfr">
            {{date_format(date_create($item->mid), 'd/m/Y')}}
          </span>
          <span class="text-center cell-detail-description cell-detail-descriptionfr labelhora">
            {{$item->rhmi}}
          </span> 
        </td>
        <td class="cell-detail">

          <div class="text-center be-checkbox be-checkbox-sm">
            <input  type="checkbox"
                    class="{{Hashids::encode(substr($item->id, -12))}}"
                    id="ju{{Hashids::encode(substr($item->id, -12))}}"
                    @if ($item->juh == 1) checked @endif >
            <label  for="ju{{Hashids::encode(substr($item->id, -12))}}"
                    data-atr = "juh"
                    data-dia = "ju"
                    class = "checkbox"                    
                    name="{{Hashids::encode(substr($item->id, -12))}}"
              ></label>
          </div>

          {!! 
            Form::select( 'horario_id', 
                          $combohorario, 
                          $item->hju,
                          [
                            'class'       => 'comboh form-control control input-fr' ,
                            'id'          => 'horario_id',
                            'required'    => '',
                            'data-attr'   => 'ju',
                            'data-aw'     => '1',
                            'data-id'     => Hashids::encode(substr($item->id, -12))
                          ]) 
          !!}

          <span class="text-center cell-detail-description cell-detail-descriptionfr">
            {{date_format(date_create($item->jud), 'd/m/Y')}}
          </span>
          <span class="text-center cell-detail-description cell-detail-descriptionfr labelhora">
            {{$item->rhju}}
          </span> 
        </td>
        <td class="cell-detail">

          <div class="text-center be-checkbox be-checkbox-sm">
            <input  type="checkbox"
                    class="{{Hashids::encode(substr($item->id, -12))}}"
                    id="vi{{Hashids::encode(substr($item->id, -12))}}"
                    @if ($item->vih == 1) checked @endif >
            <label  for="vi{{Hashids::encode(substr($item->id, -12))}}"
                    data-atr = "vih"
                    data-dia = "vi"
                    class = "checkbox"                    
                    name="{{Hashids::encode(substr($item->id, -12))}}"
              ></label>
          </div>

          {!! 
            Form::select( 'horario_id', 
                          $combohorario, 
                          $item->hvi,
                          [
                            'class'       => 'comboh form-control control input-fr' ,
                            'id'          => 'horario_id',
                            'required'    => '',
                            'data-attr'   => 'vi',
                            'data-aw'     => '1',
                            'data-id'     => Hashids::encode(substr($item->id, -12))
                          ]) 
          !!}

          <span class="text-center cell-detail-description cell-detail-descriptionfr">
            {{date_format(date_create($item->vid), 'd/m/Y')}}
          </span>
          <span class="text-center cell-detail-description cell-detail-descriptionfr labelhora">
            {{$item->rhvi}}
          </span> 
        </td>
        <td class="cell-detail">

          <div class="text-center be-checkbox be-checkbox-sm">
            <input  type="checkbox"
                    class="{{Hashids::encode(substr($item->id, -12))}}"
                    id="sa{{Hashids::encode(substr($item->id, -12))}}"
                    @if ($item->sah == 1) checked @endif >
            <label  for="sa{{Hashids::encode(substr($item->id, -12))}}"
                    data-atr = "sah"
                    data-dia = "sa"
                    class = "checkbox"                    
                    name="{{Hashids::encode(substr($item->id, -12))}}"
              ></label>
          </div>

          {!! 
            Form::select( 'horario_id', 
                          $combohorario, 
                          $item->hsa,
                          [
                            'class'       => 'comboh form-control control input-fr' ,
                            'id'          => 'horario_id',
                            'required'    => '',
                            'data-attr'   => 'sa',
                            'data-aw'     => '1',
                            'data-id'     => Hashids::encode(substr($item->id, -12))
                          ]) 
          !!}

          <span class="text-center cell-detail-description cell-detail-descriptionfr">
            {{date_format(date_create($item->sad), 'd/m/Y')}}
          </span>
          <span class="text-center cell-detail-description cell-detail-descriptionfr labelhora">
            {{$item->rhsa}}
          </span> 
        </td>
        <td class="cell-detail">

          <div class="text-center be-checkbox be-checkbox-sm">
            <input  type="checkbox"
                    class="{{Hashids::encode(substr($item->id, -12))}}"
                    id="do{{Hashids::encode(substr($item->id, -12))}}"
                    @if ($item->doh == 1) checked @endif >
            <label  for="do{{Hashids::encode(substr($item->id, -12))}}"
                    data-atr = "doh"
                    data-dia = "do"
                    class = "checkbox"                    
                    name="{{Hashids::encode(substr($item->id, -12))}}"
              ></label>
          </div>

          {!! 
            Form::select( 'horario_id', 
                          $combohorario, 
                          $item->hdo,
                          [
                            'class'       => 'comboh form-control control input-fr' ,
                            'id'          => 'horario_id',
                            'required'    => '',
                            'data-attr'   => 'do',
                            'data-aw'     => '1',
                            'data-id'     => Hashids::encode(substr($item->id, -12))
                          ]) 
          !!}

          <span class="text-center cell-detail-description cell-detail-descriptionfr">
            {{date_format(date_create($item->dod), 'd/m/Y')}}
          </span>
          <span class="text-center cell-detail-description cell-detail-descriptionfr labelhora">
            {{$item->rhdo}}
          </span> 
        </td>

      </tr>                    
    @endforeach

  </tbody>
</table>

    <script type="text/javascript">
      $(document).ready(function(){
         App.dataTables();

      });
    </script> 