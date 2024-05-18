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
        border:1px solid orange;
        text-align:center;
    }

    .table tr{
      border:1px solid orange;
      height:80px;
    }

    .table1{
        width:100%;
        border:1px solid orange;
        text-align:right;
    }

    .table1 tr{
      border:1px solid orange;
      height:80px;
    }

    .IDtabletwo {
	width:100%;
	margin: 0 auto;
    border-collapse: collapse;
  border-spacing: 5;
  border-radius: 5px;
}
.IDtabletwo td{
	border-spacing: 5;
	border: 2px solid #E9873E;
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
                                <br>N°&nbsp;{{$venta->serie_comprobante}}-{{$venta->num_comprobante}}<br>R.U.C.:&nbsp;0915361976001<br>Aut S.R.I. 1129349618
                                </td>
                                </tr>
                                </table>
      <!--                           <table style="margin-top:30px;margin-left: auto;margin-right: auto;" width="100%"  >
                                <tr width="100%"  >
                                <td  width="35%" style="font-size:13px;text-align:left;"><strong>Cliente:&nbsp;</strong>{{$venta->nombre}}<br><strong>{{$venta->tipo_documento}}&nbsp;</strong>{{$venta->num_comprobante}}<br><strong>Ubicación:&nbsp;</strong>{{$venta->pais}}-{{$venta->provincia}}-{{$venta->ciudad}}</td>
               
                                <td  width="35%" style="font-size:13px;text-align:left;"><strong>Fecha Emisión&nbsp;</strong>{{$venta->fecha}}<br><strong>Teléfono&nbsp;</strong>{{$venta->telefono}}<br><strong>Dirección:&nbsp;</strong>{{$venta->direccion}}</td>

                                <td  width="30%" style="font-size:13px;text-align:left;"><strong>Forma Pago&nbsp;</strong>{{$venta->forma_pago}}<br><strong>Correo&nbsp;</strong>{{$venta->email}}<br><strong>Dirección:&nbsp;</strong>{{$venta->direccion}}</td>
                                </tr>
                                </table>
                                 <table style="margin-top:30px;" width="100%">
				                </table> -->


                                <div class="row invoice-info " style="margin-top:15px;">
                                <table class="IDtabletwo" style="margin-top:5px;">
                                    <tr>
                                        <td>&nbsp;<strong>CLIENTE:</strong>&nbsp;{{$venta->nombre}}</td>
                                        <td>&nbsp;<strong>FECHA:</strong>{{$venta->fecha}}</td>
                                        <td>&nbsp;<strong>FORMA PAGO:</strong>{{$venta->forma_pago}}</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;<strong>R.U.C/C.I.:</strong>&nbsp;{{$venta->num_comprobante}}</td>
                                        <td>&nbsp;<strong>TELF:</strong>&nbsp;{{$venta->telefono}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">&nbsp;<strong>DIRECCIÓN:</strong>&nbsp;{{$venta->direccion}}</td>
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
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalles as $value)
                        <tr>
                            <td>{{$cont}}</td>
                            <td>{{$value->codigo}}</td>
                            <td>{{$value->articulo}}</td>
                            <td>{{$value->cantidad}}</td>
                            <td>{{$value->precio_venta}}</td>
                            <td>{{$value->descuento}}</td>
                            </tr>
                        </tr>
                    @php
					$cont++;
					@endphp
                    @endforeach
                </tbody>
            </table>
        </div>


        <div  style="margin-top:10px;">
                                        <table class="table1">
                                        <tbody>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td>{{ "$" . number_format($venta->subtotal, 2)}}&nbsp;</td> 
                                        </tr>
                                        <tr>
                                            <th>Iva {{intval($venta->impuesto_porcentaje) }}%</th>
                                            <td>{{ "$" . number_format($venta->impuesto, 2)}}&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Iva 12%</th>
                                            <td>{{ "$" . number_format(0, 2)}}&nbsp;</td>
									    </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td><h5 style="color:orange;font-size:20px;"><strong >{{"$" . number_format($venta->total_venta, 2)}}</strong></h5>&nbsp;</td>
                                        </tr>
                                        </tbody>
										</table>
        </div>
        <footer  style="position:absolute; bottom:0;" >
            <p style="text-align:right;">Informe Generado {{date("Y-m-d")}}</p>
            <span style="color: #404a63;font-weight:bold;text-transform:uppercase;font-size:12px;"><strong>BAQUE PEÑAFIEL WASHINGTON "GRÁFICO BAQUE" CEL:0989250669 R.U.C. 0919931493001 AUT. 14048-1</strong><br>Fecha Autorizacion:17/Enero/2022&nbsp;Fecha Caducidad:{{$venta->fecha_caducidad}}</span>
        </footer>
  </body>
</html>