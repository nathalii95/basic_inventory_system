@php $cont = 1;
@endphp
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>Document</title>
    <style>
    body{
        padding:0;
        margin:0;
    }
    .page-break {
        page-break-after: always;
    }
    .titulo{
        border: 2px solid orange;
        /* border-radius:15px; */
    }

    .titulo p{
     text-align:left:
    }

    .table{
        width:100%;
        border:2px solid orange;
        text-align:center;
    }

    .table tr{
      border:2px solid orange;
      height:80px;
    }

    .table1{
        width:100%;
        border:2px solid orange;
        text-align:right;
    }

    .table1 tr{
      border:2px solid orange;
      height:80px;
    }
    
    .IDtabletwo {
	width:100%;
    font-size: 12px;

	margin: 0 auto;
    border-collapse: collapse;
  border-spacing: 5;
  border-radius: 5px;
}
.IDtabletwo td{
	border-spacing: 5;
	text-align:left;
	text-transform:uppercase
}
    </style>
  </head>
  
  <body>
      <header class="titulo">
                            <div>
                                <table width="100%" >
                                <tr width="100%"  style="text-align:center;">
                                <td  width="20%"> <img src="{{public_path('img/logo.png')}}" alt="" style="width: 160px;"></td>
                                <td  width="25%" style="font-size:13px;text-align:center;">Papeleria y Suministros<br><strong>"M&E"</strong><br>ERIKA SUARÉZ OLVERA <br>CONTRIBUYENTE NEGOCIO POPULAR - RÉGIME RIMPE<br></td>
                                <td  width="30%" style="font-size:13px;text-align:center;">Los Esteros y Av. Tena<br>Teléfono:&nbsp;0985070264 
                                <br>correo:&nbsp;suministrosm-e@hotmail.com<br>Guayaquil-Ecuador<br></td>
                                <td width="25%" style="font-size:13px;text-align:right;">
                                <strong>{{$venta->tipo_comprobante}}</strong>
                                <br>N°&nbsp;{{$venta->serie_comprobante}}-{{$venta->numero_comprobante}}<br>R.U.C.&nbsp;0915361976001<br>Aut S.R.I. 1129349618
                                </td>
                                </tr>
                                </table>

                                <div class="row invoice-info " style="margin-top:15px;">
                                <table class="IDtabletwo" style="margin-top:5px;">
                                    <tr>
                                        <td>&nbsp;<strong>CLIENTE:</strong>&nbsp;{{$venta->nombre}}</td>
                                        <td>&nbsp;<strong>FECHA:</strong>{{$venta->fecha_dev}}</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;<strong>R.U.C/C.I.:</strong>&nbsp;{{$venta->documento}}</td>
                                        <td>&nbsp;<strong>TELF:</strong>&nbsp;{{$venta->telefono}}</td>
                                    </tr>
                                    <tr>
                                        <td >&nbsp;<strong>DIRECCIÓN:</strong>&nbsp;{{$venta->direccion}}</td>
                                        <td >&nbsp;<strong>COMPROBANTE QUE MODIFICA:</strong>&nbsp;N°&nbsp;{{$venta->ven_serie_ant}}-{{$venta->ven_num_ant}}</td>
                                    </tr>
                                </table>
                                </div>
                            </div>
      </header>
      <!-- <div class="page-break"></div> -->
        <div style="margin-top:10px;" >
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Descuento</th>
                        <th>Iva</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalles as $value)
                        <tr>
                            <td>{{$cont}}</td>
                            <td>{{$value->codigo}}</td>
                            <td>{{$value->articulo}}</td>
                            <td>{{$value->cant_devuelta}}</td>
                            <td>{{$value->precio_venta}}</td>
                            <td>{{$value->descuento}}</td>
                            <td>{{$value->iva}}</td>
                            <td>{{$value->cant_devuelta*$value->precio_venta-$value->descuento+$value->iva}}</td>
                        </tr>
                    @php
					$cont++;
					@endphp
                    @endforeach
                </tbody>
            </table>
        </div>



        <div  style="margin-top:10px;">
                                        <table class="table1" style="text-align:center;">
										                                        <tbody>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td>{{ "$" . number_format($venta->subtotal, 2)}}</td> 
                                        </tr>
                                        <tr>
                                            <th>Iva {{intval($venta->impuesto_porcentaje) }}%</th>
                                            <td>{{ "$" . number_format($venta->impuesto, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <th>Iva 12%</th>
                                            <td>{{ "$" . number_format(0, 2)}}&nbsp;</td>
									    </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td><h5 style="color:orange;font-size:15px;"><strong >{{"$" . number_format($venta->total_dev, 2)}}</strong></h5></td>
                                        </tr>
                                        </tbody>
										</table>

                    <div  class="titulo" style="margin-top:10px;">
                    <p><strong>Motivo de Devolución:</strong></p>
                    <p style="margin-top: 10px;">{{$venta->motivo_dev}}</p>
                    </div>
                    @if($venta->nota != "")
					<div  class="titulo" style="margin-top:10px;">
                    <p><strong>Nota:</strong></p>
                    <p style="margin-top: 10px;">{{$venta->nota}}</p>
                    </div>
                    @endif


        </div>
        <footer  style="position:absolute; bottom:0;" >
            <p style="text-align:right;">Informe Generado {{date("Y-m-d")}}</p>
            <span style="color: #404a63;font-weight:bold;text-transform:uppercase;font-size:12px;"><strong>BAQUE PEÑAFIEL WASHINGTON "GRÁFICO BAQUE" CEL:0989250669 R.U.C. 0919931493001 AUT. 14048-1</strong><br>Fecha Autorizacion:17/Enero/2022&nbsp;Fecha Caducidad:{{$venta->fecha_caducidad}}</span>
        </footer>
  </body>
</html>