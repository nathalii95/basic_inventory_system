
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

							<td  width="25%"><!-- {{$ingreso->nombre_empresa}} -->Papeleria y Suministros<br><strong>"M&E"</strong><br>ERIKA SUARÉZ OLVERA <br>CONTRIBUYENTE NEGOCIO POPULAR - RÉGIME RIMPE<br></td>

							<td  width="30%">Dirección:<!-- {{$ingreso->empdirec}} --><br><!-- Teléfono:&nbsp;{{$ingreso->emptele}}  -->Los Esteros y Av. Tena<br>Teléfono:&nbsp;0985070264 
							<br>correo:&nbsp;<!-- {{$ingreso->empemail}} -->suministrosm-e@hotmail.com<br>Guayaquil-Ecuador<br></td>
							<td  width="25%" class="text-center"><strong>{{$ingreso->tipo_comprobante}} </strong><strong><br>Serie-{{$ingreso->serie_comprobante}}-{{$ingreso->numero_comprobante}}</strong><br>R.U.C.&nbsp;&nbsp;{{$ingreso->rucempresa}}<!-- 0915361976001 --><br>Aut S.R.I. 1129349618<br><br></td>
							</tr>

							</table>
                          <br>
                          <div class="row invoice-info mb-5" >
                            <div class="col-sm-6 invoice-col mb-5" >
                              
							<div style="margin-top:5px;">
                                <strong>Proveedor</strong><br>
								{{$ingreso->nombre}}
                              </div>
							  <div style="margin-top:5px;">
                                <strong>Direccion</strong><br>
								{{$ingreso->pais}}-{{$ingreso->direccion}}
                              </div>
                            </div>
                            <div class="col-sm-6 invoice-col">
							  <div style="margin-top:5px;">
                                <strong>{{$ingreso->tipo_documento}}</strong><br>
								{{$ingreso->num_documento}}
                              </div>
							  <div style="margin-top:5px;">
                                <strong>Telefono</strong><br>
								{{$ingreso->telefono}}
                              </div>

                            </div>
							<div class="col-sm-6 invoice-col">
							  <div style="margin-top:5px;">
                                <strong>Fecha Devolución</strong><br>
								{{$ingreso->fecha_dev}}
                              </div>
							  <div style="margin-top:5px;">
                                <strong>COMPROBANTE QUE MODIFICA:</strong><br>
								{{ingreso->tipo_comprobante}} N°&nbsp;&nbsp;{{$ingreso->comp_serie_ant}}-{{$ingreso->comp_num_ant}}
                              </div>
                            </div>
                          </div>


                          <!-- Table row -->
                          <div class="row" style="margin-top:6px;">
                            <div class="col-12 table-responsive" id="tableCant">
								<br><br>
                              <table class="table  table-striped"   >
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
									<td> <input type="number" readonly   value="{{$dt->precio_unitario}}" style="width:100%;height:50%;border: 0 !important;"></td>
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
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
							<!-- 	<p><strong>Motivo Devolución:</strong></p>
                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; ">
								{{$ingreso->motivo_dev}}
                              </p> -->

                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                              <div class="table-responsive">
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
										<td><h5 style="color:orange;"><strong >{{'$' . number_format($ingreso->subtotal-$ingreso->descuento, 2) }}</strong></h5></td>
									</tr>
                                  </tbody>
							    </table>
                              </div>
                            </div>
							
							@if($ingreso->motivo_dev  != "")
							<div class="col-6">
							   <p><strong>Motivo:</strong></p>
                               <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; ">
								{{$ingreso->motivo_dev }}
                               </p>
                            </div>
					        @endif
							
							@if($ingreso->nota != "")
							<div class="col-6">
							   <p><strong>Nota:</strong></p>
                               <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; ">
								{{$ingreso->nota}}
                               </p>
                            </div>
					        @endif
                            <!-- /.col -->
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



