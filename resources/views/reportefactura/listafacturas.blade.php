@extends('template')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/dataTables.bootstrap.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/responsive.dataTables.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>
@stop
@section('section')


	<div class="be-content">
		<div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">


                <div class="panel-heading">Lista de Facturas
                  <div class="tools tooltiptop">

                    <a href="#" class="tooltipcss" id='buscarreportefactura' >
                      <span class="tooltiptext">Buscar Facturas</span>
                      <span class="icon mdi mdi-search"></span>
                    </a>

                  </div>
                </div>
                <div class="panel-body">

                  <div class='filtrotabla row'>
                    <div class="col-xs-12">
                      <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                          <div class="form-group">
                            <label class="col-sm-12 control-label">
                              Fecha Inicio
                            </label>
                            <div class="col-sm-12">
                              <div data-min-view="2" data-date-format="dd-mm-yyyy" class="input-group date datetimepicker">
                                        <input size="16" type="text" value="{{$inicio}}" id='finicio' name='finicio' class="form-control input-sm">
                                        <span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
                              </div>
                            </div>
                          </div>
                      </div>

                      <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                          <div class="form-group">
                            <label class="col-sm-12 control-label">
                              Fecha Fin
                            </label>
                            <div class="col-sm-12">
                              <div data-min-view="2" data-date-format="dd-mm-yyyy"  class="input-group date datetimepicker">
                                        <input size="16" type="text" value="{{$fin}}" id='ffin' name='ffin' class="form-control input-sm">
                                        <span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                  </div>



                  <div class='listatablafactura listajax'>
                    <table id="rfactura" class="table table-striped table-striped dt-responsive nowrap listatabla" style='width: 100%;'>

                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Tipo Documento</th>
                          <th>Serie-Correlativo</th>
                          <th>Fecha Venta</th>
                          <th>DNI/RUC</th>
                          <th>Moneda</th>
                          <th>Importe</th>
                          <th>Estado</th>
                          <th>Cliente</th>                          
                          <th>Opcion</th>
                          <th></th> 
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($listadocumento as $item)
                          <tr>
                            <td>{{$item->id_documento}}</td>
                            <td>{{$item->tipodocumento->nombre}} - {{$item->estado->nombre}}</td>
                            <td>{{$item->serie}}-{{$item->correlativo}}</td>
                            <td>{{date_format(date_create($item->fecha_venta), 'd/m/Y')}}</td>
                            <td>{{$item->cliente->dniruc}}</td> 
                            <td>{{$item->moneda}}</td>
                            <td>{{$item->total_original}}</td>
                            <td>{{$item->estado->nombre}}</td>
                            <td>{{$item->cliente->nombre}}</td>
                            <td class="text-right">
                              <div class="btn-group btn-hspace">
                                <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Opcion <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                <ul role="menu" class="dropdown-menu pull-right">
                                  <li><a href="{{ url('/pdf-factura/'.Hashids::encode($item->id)) }}" target="_blank">PDF</a></li>
                                  <li><a href="{{ url('/ticket-factura/'.Hashids::encode($item->id)) }}">Ticket</a></li>
                                </ul>
                              </div>
                            </td>

                            <td></td>
                          </tr>                    
                        @endforeach

                      </tbody>
                    </table>


                  </div>


                </div>
              </div>
            </div>
          </div>
		</div>
	</div>

@stop

@section('script')


	<script src="{{ asset('public/lib/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/lib/datatables/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/lib/datatables/plugins/buttons/js/dataTables.buttons.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/js/responsive.bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/js/app-tables-datatables.js') }}" type="text/javascript"></script>


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
        App.dataTables();

      });
    </script> 

 
  <script src="{{ asset('public/js/factura/reportefactura.js') }}" type="text/javascript"></script>     
@stop