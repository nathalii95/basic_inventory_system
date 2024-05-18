

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

<div class="container " id="myDiv" hidden="true"  media="print" onload="javascript:window.print()">
        <div class="row">
                <div class="col-12">
                        <div class="invoice p-3 mb-3 titulo">

							<table class="default">

							<tr width="100%"  class="text-center">
							<td  width="20%"> <img src="{{asset('img/logo.png ')}}" alt="" style="width: 160px;"></td>

							<td  width="25%">Papeleria y Suministros<br><strong>"M&E"</strong><br>ERIKA SUARÉZ OLVERA <br>CONTRIBUYENTE NEGOCIO POPULAR - RÉGIME RIMPE<br></td>

							<td  width="30%">Los Esteros y Av. Tena<br>Teléfono:&nbsp;0985070264 
							<br>correo:&nbsp;suministrosm-e@hotmail.com<br>Guayaquil-Ecuador<br></td>
							<td width="25%" class="text-center"><br><h4 class="text-center"><strong>{{$ingreso->tipo_comprobante}} </strong></h4>N°&nbsp;{{$ingreso->serie_comprobante}}-{{$ingreso->numero_comprobante}}<br>Ruc:&nbsp;&nbsp;0915361976001<br>Aut S.R.I 1129349618<br><br></td>
							</tr>

							</table>

							<div class="row invoice-info mb-5">
								<table class="IDtabletwo">
									<tr>
										<td>&nbsp;<strong>CLIENTE:</strong>&nbsp;{{$ingreso->nombre}}</td>
										<td>&nbsp;<strong>FECHA:</strong>{{$ingreso->fecha_dev}}</td>
									</tr>
									<tr>
										<td>&nbsp;<strong>R.U.C/C.I.:</strong>&nbsp;{{$ingreso->num_documento}}</td>
										<td>&nbsp;<strong>TELF:</strong>&nbsp;{{$ingreso->telefono}}</td>
									</tr>
									<tr>
										<td >&nbsp;<strong>DIRECCIÓN:</strong>&nbsp;{{$ingreso->direccion}}</td>
										<td >&nbsp;<strong>COMPROBANTE QUE MODIFICA:</strong>&nbsp;N°&nbsp;{{$ingreso->ven_serie_ant}}-{{$ingreso->ven_num_ant}}</td>
									</tr>
								</table>
							</div>

						  <div class="row invoice-info" style="margin-top:10px;">
							<table class="IDtabletwo" style="margin-top:10px;">
							<thead width="100%" class="text-center">
									<th width="5%" >Id</th>
									<th width="40%">Producto</th>
									<th width="10%">Cantidad</th>
									<th width="15%">Precio</th>
									<th width="15%">Descuento</th>
									<th width="15%">Iva</th>
									<th width="15%">Total</th>
								</thead>
							<tbody>
							@foreach($detalles as $dt)
								<tr>
									<td>{{$cont}}</td>
									<td><input type="text" readonly  value="{{$dt->articulo}}" style="width:100%;height:50%;border: 0 !important;"></td>
									<td><input type="number" readonly value="{{$dt->cant_devuelta}}" style="width:100%;height:50%;border: 0 !important;"></td>
									<td> <input type="number" readonly   value="{{$dt->precio_venta}}" style="width:100%;height:50%;border: 0 !important;"></td>
									<td><input  type="number" readonly  value="{{$dt->descuento}}" style="width:100%;height:50%;border: 0 !important;" ></td> 
									<td><input  type="number" readonly  value="{{$dt->iva}}" style="width:100%;height:50%;border: 0 !important;" ></td> 
									<td><input  type="number" readonly value="{{$dt->total}}" style="width:100%;height:50%;border: 0 !important;"></td>
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
										<td>{{ "$" . number_format($ingreso->subtotal, 2)}}&nbsp;</td> 
									</tr>
									<tr>
										<th>Iva {{intval($ingreso->impuesto_porcentaje) }}%</th>
										<td>{{ "$" . number_format($ingreso->impuesto, 2)}}&nbsp;</td>
									</tr>
									<tr>
                                            <th>Iva 12%</th>
                                            <td>{{ "$" . number_format(0, 2)}}&nbsp;</td>
									</tr>
									<tr>
										<th>Total</th>
										<td><h5 style="color:orange;"><strong >{{"$" . number_format($ingreso->total_dev, 2)}}</strong></h5>&nbsp;</td>
									</tr>
                                  </tbody>
							    </table>
							</div>
							@if($ingreso->motivo_dev  != "")
								<div class="col-6">
								<p><strong>Motivo:</strong></p>
								<p class="text-muted well well-sm no-shadow" style="margin-top: 10px; ">
									{{$ingreso->motivo_dev}}
								</p>
								</div>
								@endif
								@if($ingreso->nota  != "")
								<div class="col-6" style="margin-top:10px;" >
								<p><strong>Nota:</strong></p>
								<p class="text-muted well well-sm no-shadow" style="margin-top: 10px; ">
									{{$ingreso->nota}}
								</p>
								</div>
								@endif
                        </div><br>
                        <!-- /.invoice -->
                </div>
        </div>
		<footer  style="position:absolute; bottom:0;" >
			<span style="color: #404a63;font-weight:bold;text-transform:uppercase;font-size:12px;"><strong>BAQUE PEÑAFIEL WASHINGTON "GRÁFICO BAQUE" CEL:0989250669 R.U.C. 0919931493001 AUT. 14048-1</strong><br>Fecha Autorizacion:17/Enero/2022&nbsp;Fecha Caducidad:$ingreso->fecha_caducidad</span>
        </footer>
</div>

<script type="text/javascript">   

window.print(); 
</script>

@endsection



