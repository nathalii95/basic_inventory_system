
@extends ('layouts.admin')
@section ('contenido')
@php $cont = 1;
@endphp
<style>

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

							<td  width="25%">Papeleria y Suministros<br><strong>"M&E"</strong><br>ERIKA SUARÉZ OLVERA <br>CONTRIBUYENTE NEGOCIO POPULAR - RÉGIME RIMPE<br></td>

							<td  width="30%">Los Esteros y Av. Tena<br>Teléfono:&nbsp;0985070264 
							<br>correo:&nbsp;suministrosm-e@hotmail.com<br>Guayaquil-Ecuador<br></td>
							<td  width="25%" class="text-center"><strong>COMPRA<br></td>
							</tr>

							</table>

						<br>
                          <div class="row invoice-info mb-5 ">
                            <div class="col-sm-6 invoice-col mb-5">
							  <div>
                                <strong>{{$ingreso->tipo_comprobante}}</strong><br>
								N°:&nbsp;{{$ingreso->serie_comprobante}}-{{$ingreso->numero_comprobante}}
                              </div>
                              <div>
                                <strong>Proveedor</strong><br>
								{{$ingreso->nombre}}
                              </div>
							  <div>
                                <strong>{{$ingreso->tipo_documento}}</strong><br>
								{{$ingreso->num_documento}}
                              </div>
                            <!-- <div>
								<strong>Ubicación</strong><br>
								{{$ingreso->pais}}-{{$ingreso->provincia}}-{{$ingreso->ciudad}}
                              </div> -->
							  <div>
							  <strong>Dirección</strong><br>
								{{$ingreso->direccion}}
                              </div>
                            </div>
                            <div class="col-sm-6 invoice-col">
							  <div>
                                <strong>Ruc</strong><br>
								0915361976001
                              </div>
							  <div>
                                <strong>Fecha Emisión</strong><br>
								{{$ingreso->fecha}}
                              </div>
							  <div>
                                <strong>Teléfono</strong><br>
								{{$ingreso->telefono}}
                              </div>
							 
                            </div>
							<div class="col-sm-6 invoice-col">
							 <div>
							  <strong>Aut S.R.I</strong><br>
							    1129349618
                              </div>
							  <div>
                                <strong>Forma Pago</strong><br>
								{{$ingreso->forma_pago}}
                              </div>
							<div>
							    <strong>Correo</strong><br>
								{{$ingreso->email}}
                              </div>
                            </div>
                          </div>

						  <br>
                          <!-- Table row -->
                          <div class="row" stle="margin-to:10px;">
                            <div class="col-12 table-responsive" id="tableCant"  stle="margin-to:10px;">
                              <table class="table  table-striped"  stle="margin-to:10px;" >
							    <thead width="100%" class="text-center">
									<th width="5%" >Id</th>
									<th width="25%">Producto</th>
									<th width="10%">Cantidad</th>
									<th width="15%">Precio Unitario</th>
									<th width="15%">Descuento</th>
									<th width="15%">Iva</th>
									<th width="15%">Total</th>
								</thead>
                                <tbody>
                                @foreach($detalles as $dt)
								<tr>
									<td>{{$cont}}</td>
									<td><input type="text" readonly  value="{{$dt->articulo}}" style="width:100%;height:50%;border: 0 !important;"></td>
									<td><input type="number" readonly value="{{$dt->cantidad}}" style="width:100%;height:50%;border: 0 !important;"></td>
									<td> <input type="number" readonly   value="{{$dt->precio_unitario}}" style="width:100%;height:50%;border: 0 !important;"></td>
									<td><input  type="number" readonly  value="{{$dt->descuento}}" style="width:100%;height:50%;border: 0 !important;" ></td> 
									<td><input  type="number" readonly  value="{{$dt->iva}}" style="width:100%;height:50%;border: 0 !important;" ></td> 
									<td><input  type="number" readonly value="{{$dt->cantidad*$dt->precio_unitario}}" style="width:100%;height:50%;border: 0 !important;"></td>
								</tr>
								@php
								$cont++;
								@endphp
								@endforeach
                                </tbody>
                              </table>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <div class="row">
                            <!-- accepted payments column -->
                            <!-- /.col -->
                            <div class="col-6">
                              <div class="table-responsive" >
                                <table class="table " style="text-align:center;" >
                                  <tbody>
									<tr>
										<th>Subtotal:</th>
										<td>$ {{$ingreso->subtotal}}</td>
									</tr>
									<tr>
										<th>Descuento <span> {{floatval($ingreso->descuento_porcentaje)}}%</span>:</th>
										<td>$ {{$ingreso->descuento}}</td>
									</tr>
									<tr>
										<th>Iva <span> {{floatval($ingreso->impuesto_porcentaje)}}%</span>:</th>
										<td>$ {{$ingreso->impuesto}}</td>
									</tr>
									<tr>
                                            <th>Iva 12%</th>
                                            <td>{{ "$" . number_format(0, 2)}}&nbsp;</td>
									</tr>
									<tr>
										<th>Total:</th>
										<td><h5 style="color:orange;"><strong >$ {{$ingreso->totalCompra}}</strong></h5></td>
									</tr>
                                  </tbody>
							    </table>
                              </div>
                            </div>
                            <!-- /.col -->
							@if($ingreso->observacion != "")
							<div class="col-6">
							   <p><strong>Observación:</strong></p>
                               <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; ">
							   {{$ingreso->observacion}}
                               </p>
                            </div>
					        @endif
                          </div>
                          <!-- /.row -->

                          <!-- this row will not appear when printing -->


                        </div>
                        <!-- /.invoice -->
                      </div>


        </div>
		<div class="row divFooter">
				<div  style="position: fixed;  bottom: 0px; ">
				<span style="color: #404a63;font-weight:bold;text-transform:uppercase;font-size:12px;"><strong>BAQUE PEÑAFIEL WASHINGTON "GRÁFICO BAQUE" CEL:0989250669 R.U.C. 0919931493001 AUT. 14048-1</strong><br>Fecha Autorizacion:17/Enero/2022&nbsp;Fecha Caducidad:{{$ingreso->fecha_caducidad}}</span>
				</div>
		</div>
		
    </div>

<script type="text/javascript">   

window.print(); 
</script>

@endsection



