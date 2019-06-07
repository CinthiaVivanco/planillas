<table id="ttrabajador" class="table table-striped table-striped dt-responsive nowrap listatabla" style='width: 100%;'>

  <thead>
    <tr>
      <th>DNI</th>
      <th>Trabajador</th>  
      <th>Codigo Rubro</th>  
      <th>Rubro</th>          
      <th>Monto</th>            
    </tr>
  </thead>
  <tbody>
    @foreach($listarubros as $item)
      <tr>
        <td>  
            {{$item->trabajador->dni}}
        </td>
        <td>  
            {{$item->trabajador->apellidopaterno}} {{$item->trabajador->apellidomaterno}} {{$item->trabajador->nombres}}
        </td>
        <td>  
            {{$item->rubro->codigo}}
        </td>           
        <td>  
            {{$item->rubro->descripcion}}
        </td>        
        <td>  
            <input  type="text"
                    id="monto" name='monto' data='{{$item->id}}' value="{{$item->monto}}" placeholder="Monto"
                    onkeypress="return filterFloat(event,this);"
                    class="form-control input-sm"/>
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