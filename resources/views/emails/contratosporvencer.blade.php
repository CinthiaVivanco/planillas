<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />

        <style>
            table, td, th {    
                border: 1px solid #ddd;
                text-align: left;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }
            th{
                background: #3B4D93;
                color: #fff;
                font-weight: bold;
                text-align: center;
            }
            th, td {
                padding: 15px;
            }
            .fecha{
                font-weight: bold;
                font-size: 1.2em;
            }
        </style>


    </head>


    <body>
    	<section>
                <h2>Contratos por vencer</h2>

                <table  class="table demo" >
                    <tr>
                        <th>Trabajador</th>
                        <th>Fecha a vencer</th> 
                        <th>Dias faltantes </th>                                       
                    </tr>
                        @foreach($array as $contrato)
                            <tr>
                                <td>{{$contrato['nombres']}} {{$contrato['apellidopaterno']}} {{$contrato['apellidomaterno']}}</td>
                                <td class='fecha'>{{date_format(date_create($contrato['fechafin']),'d-m-Y')}} </td>
                                <td class='dias'>{{$contrato['dias']}} dias</td>                                
                            </tr>
                        @endforeach
                </table>
		</section>
    </body>

</html>


