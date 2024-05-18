
@extends ('layouts.admin')
@section ('contenido')
@php $cont = 1;
@endphp
<style>
.IDtabletwo {
	width:95%;
	margin: 0 auto;
    border-collapse: collapse;
  border-spacing: 5;
  border-radius: 5px;
  border: 2px solid #E9873E;
}
.IDtabletwo td{
	border-spacing: 5;
	border: 2px solid #E9873E;
	text-align:left;
	text-transform:uppercase
}

.IDtablethree {
	width:95%;
	margin: 0 auto;
    border-collapse: collapse;
  border-spacing: 5;
  border-radius: 5px;
  text-align:right;
  border: 2px solid #E9873E;
}

.IDtablethree td{
	border-spacing: 5;
	border: 2px solid #E9873E;
	text-align:right;
	text-transform:uppercase
}
@media print {
  .divFooter {
    position: fixed;
    bottom: 0;
  }
}
</style>

<div class="container" id="myDiv" hidden="true"  media="print" onload="javascript:window.print()">
        <div class="row">
                <div class="col-12">
                        <div class="invoice p-3 mb-3">
							<table class="default">
							<tr width="100%"  class="text-center">
							<td  width="20%"> <img src="{{asset('img/logo.png ')}}" alt="" style="width: 160px;"></td>
							<td  width="25%">Papeleria y Suministros<br><strong>"M&E"</strong><br>ERIKA SUARÉZ OLVERA<br>CONTRIBUYENTE NEGOCIO POPULAR - RÉGIME RIMPE<br></td>
							<td  width="30%">Los Esteros y Av. Tena<br>Teléfono:&nbsp;0985070264 
							<br>correo:&nbsp;suministrosm-e@hotmail.com<br>Guayaquil-Ecuador<br></td>
							<td  width="25%" class="text-center"><br><h4 class="text-center"><strong>{{$venta->tipo_comprobante}} </strong></h4>N°&nbsp;{{$venta->serie_comprobante}}-{{$venta->num_comprobante}}<br>R.U.C.&nbsp;&nbsp;0915361976001<br>Aut S.R.I 1129349618<br><br></td>
							</tr>
							</table>

							<div class="row invoice-info mb-5">
							<table class="IDtabletwo">
								<tr>
									<td>&nbsp;<strong>CLIENTE:</strong>&nbsp;{{$venta->nombre}}</td>
									<td>&nbsp;<strong>FECHA:</strong>{{$venta->fecha}}</td>
								</tr>
								<tr>
									<td>&nbsp;<strong>R.U.C/C.I.:</strong>&nbsp;{{$venta->num_documento}}</td>
									<td>&nbsp;<strong>TELF:</strong>&nbsp;{{$venta->telefono}}</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;<strong>DIRECCIÓN:</strong>&nbsp;{{$venta->direccion}}</td>
								</tr>
							</table>
							</div>


							<div class="row invoice-info" style="margin-top:10px;">
							<table class="IDtabletwo" style="margin-top:10px;">
							<thead width="100%" class="text-center" >
									<th width="5%" ></th>
									<th width="40%">Producto</th>
									<th width="10%">Cantidad</th>
									<th width="15%">Precio</th>
									<th width="15%">Descuento</th>
									<th width="15%">Total</th>
							</thead>
							<tbody>
                                @foreach($detalles as $dt)
								<tr>
									<td>{{$cont}}</td>
									<td><input type="text" readonly  value="{{$dt->articulo}}" style="width:100%;height:50%;border: 0 !important;"></td>
									<td><input type="number" readonly value="{{$dt->cantidad}}" style="width:100%;height:50%;border: 0 !important;"></td>
									<td> <input type="number" readonly   value="{{$dt->precio_venta}}" style="width:100%;height:50%;border: 0 !important;"></td>
									<td><input  type="number"  readonly  value="{{$dt->descuento}}" style="width:100%;height:50%;border: 0 !important;" ></td> 
									<td><input  type="number" readonly value="{{$dt->cantidad*$dt->precio_venta+$dt->iva-$dt->descuento}}" style="width:100%;height:50%;border: 0 !important;"></td>
								</tr>
								@php
								$cont++;
								@endphp
								@endforeach
                                </tbody>
							</table>
							</div>
							<div class="row invoice-info" style="margin-top:10px;">
							<table class="IDtablethree"  style="text-align:center;" >
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
										<td><h5 style="color:orange;"><strong >{{"$" . number_format($venta->total_venta, 2)}}</strong></h5>&nbsp;</td>
									</tr>
                                  </tbody>
							    </table>
							</div>
                        </div>

                </div>
        </div>
			<div class="row divFooter">
				<div  style="position: fixed;  bottom: 0px; ">
				<span style="color: #404a63;font-weight:bold;text-transform:uppercase;font-size:12px;"><strong>BAQUE PEÑAFIEL WASHINGTON "GRÁFICO BAQUE" CEL:0989250669 R.U.C. 0919931493001 AUT. 14048-1</strong><br>Fecha Autorizacion:17/Enero/2022&nbsp;Fecha Caducidad:{{$venta->fecha_caducidad}}</span>
				</div>
			</div>
</div>

<script type="text/javascript">   

window.print(); 
</script>


@endsection



