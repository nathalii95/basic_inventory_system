@extends ('layouts.admin')
@section ('contenido')
@php $cont = 1;
                         @endphp
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Detalle Devolución </h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
<div class="row">
        <div class="col-md-12">		  	
			<div class="panel panel-danger">
				<div class="panel-body">

				        <div class="col-md-12">
								<div class="col-md-6">
									<div class="form-group">
										<label for="id_proveedor">Proveedor</label>
										<input type="text"  readonly value="{{$ingreso->nombre}}" class="form-control">
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<label for="tipo_comprobante">Comprobante</label>
										<input type="text" value="{{$ingreso->tipo_comprobante}}" class="form-control" readonly >
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="serie_comprobante">N° Serie</label>
										<input type="text"  readonly  value="{{$ingreso->serie_comprobante}}" class="form-control">			
									</div>
							    </div>

								<div class="col-md-2">
									<div class="form-group">
										<label for="numero_comprobante">N° Comprobante</label>
										<input type="text" value="{{$ingreso->numero_comprobante}}" class="form-control" readonly>
									</div>
								</div>
						</div>
						<div class="col-md-12">

									<div class="col-md-2">
										<div class="form-group">
											<label for="fecha">Fecha Devolución Compra</label>
											<input  type="text" value="{{$ingreso->fecha_dev}}" readonly class="form-control" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="fecha_caducidad">Fecha Caducidad</label>
											<input  type="text" readonly value="{{$ingreso->fecha_caducidad}}" class="form-control" >
										</div>
									</div>
									
								<!-- 	<div class="col-md-2">
										<div class="form-group">
											<label for="iva_general">IVA %</label>
											<input  type="number" readonly value="{{$ingreso->impuesto_porcentaje}}" class="form-control">
										</div>
									</div> -->
									<div class="col-md-2">
										<div class="form-group">
											<label for="descuento_general">DESCUENTO %</label>
											<input  type="number"  value="{{$ingreso->descuento_porcentaje}}" class="form-control"  readonly>
										</div>
									</div>
									<div class="col-md-2">
											<div class="form-group">
											<label>Total Valor a Pagar</label>
											<h1 style="color:orange;margin-top:10px;" id="idTotaldolar"  >{{'$' . number_format($ingreso->total_dev, 2) }} </h1>
											</div>
				                    </div>
						</div>
						<div class="col-md-12">
						            <div class="col-md-6">
										<div class="form-group">
											<label for="observacion">Motivo Devolución</label>
											<textarea  type="text" readonly class="form-control">{{$ingreso->motivo_dev}}</textarea>
										</div>
						            </div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="nota">Nota</label>
											<textarea  type="text"  readonly class="form-control" >{{$ingreso->nota}}</textarea>
										</div>
						            </div>
						</div>

				</div>
			</div>
		</div>
</div>	

<div class="row">
        <div class="col-md-12">			
			<div class="panel panel-primary">
				<div class="panel-body">
			
					<div class="col-md-12">
						<table id="detalles" style="overflow-x:scroll; display:block" class="table table-responsive table-warning table-striped table-bordered table-condensed table-hover">
						 <thead width="100%" style="background-color:#F59B20;color:white;" class="text-center">
						
							 <th width="5%" >Id</th>
							 <th width="40%">Producto</th>
							 <th width="10%">Cantidad</th>
							 <th width="15%">Precio Unitario</th>
							 <th width="15%">Descuento</th>
							 <th width="15%">Iva</th>
							 <th width="15%">Total</th>
                         </thead>
						 <tbody>

                         @foreach($detalles as $dt)
						 <tr >
							<td>{{$cont}}</td>
							<td><input type="text" readonly  value="{{$dt->articulo}}" style="width:100%;height:50%;border: 0 !important;"></td>
							<td><input type="number" readonly value="{{$dt->cant_devuelta}}" style="width:100%;height:50%;border: 0 !important;"></td>
							<td> <input type="number" readonly   value="{{$dt->precio_unitario}}" style="width:100%;height:50%;border: 0 !important;"></td>
							<td><input  type="number" readonly  value="{{$dt->descuento}}" style="width:100%;height:50%;border: 0 !important;" ></td> 
							<td><input  type="number" readonly  value="{{$dt->iva}}" style="width:100%;height:50%;border: 0 !important;" ></td> 
                            <td><input  type="number" readonly value="{{$dt->cant_devuelta*$dt->precio_unitario-$dt->descuento+$dt->iva}}" style="width:100%;height:50%;border: 0 !important;"></td>
						 </tr>
						 @php
                         $cont++;
                         @endphp
						 @endforeach
						 </tbody>
						</table>
		  	        </div> 
				</div>
			</div>
		</div>
		
       <!--  <div class="col-md-12">			
			<div class="panel panel-primary">
				<div class="panel-body">
				<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="subtotal"  style="font-weight:bold;color:orange;">Subtotal</label><br>
											<span style="font-weight:bold;color:green;font-size:16px;">$</span><input  name="subtotal"  readonly style="font-weight:bold;color:green;font-size:16px;background-color: white !important;border: 0 !important;" value="{{$ingreso->subtotal}}" >
										</div>
						            </div>	
									<div class="col-md-3">
										<div class="form-group">
											<label for="descuento"  style="font-weight:bold;color:orange;">Descuento</label><br>
											<span style="font-weight:bold;color:red;font-size:16px;">$</span><input name="descuento" readonly style="font-weight:bold;color:red;font-size:16px;background-color: white !important;border: 0 !important;" value="{{$ingreso->descuento}}" >
                        		     	</div>
						            </div>	
									<div class="col-md-3">
										<div class="form-group">
											<label for="impuesto"  style="font-weight:bold;color:orange;">Iva</label><br>
											<span style="font-weight:bold;color:red;font-size:16px;">$</span><input name="impuesto" readonly style="font-weight:bold;color:red;font-size:16px;background-color: white !important;border: 0 !important;" value="{{$ingreso->impuesto}}" >
						             	</div>
						            </div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="totalCompra"  style="font-weight:bold;color:orange;">Total</label><br>
											<span style="font-weight:bold;color:orange;font-size:16px;">$</span><input name="totalCompra"  readonly style="font-weight:bold;color:orange;font-size:16px;background-color: white !important;border: 0 !important;" value="{{$ingreso->total_dev}}" >
						             	</div>
						            </div>			
						</div>	       
            
				</div>
			</div>
		</div> -->

</div>	
			<div class="form-group col-md-3">
			<a href="../compras/devolucioncom"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>	
			
@endsection

