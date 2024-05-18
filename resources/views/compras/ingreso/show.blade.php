@extends ('layouts.admin')
@section ('contenido')

<div class="row">
        <div class="col-md-12 ">
				<div class="col-md-6">
					<h3>Vista Detalle <br> {{$ingreso->tipo_comprobante}} {{$ingreso->numero_comprobante}} </h3>
				</div>
		</div>
	</div>
    
	<div class="row">
			<div class="col-md-12">
                            <div class="col-md-6">
								<div class="form-group sect-one ">
									<label for="id_proveedor">Proveedor</label>
									<input type="text" name="id_proveedor" id="idproveedor" readonly 
									 value="{{$ingreso->nombre}}" class="form-control">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="tipo_comprobante">Tipo Comprobante</label>
									<input type="text" name="tipo_comprobante" id="idtipo"  
									 value="{{$ingreso->tipo_comprobante}}" class="form-control" readonly >
								</div>
							</div>

			</div>
			<div class="col-md-12">
				
			                <div class="col-md-3">
								<div class="form-group">
									<label for="serie_comprobante">N° Serie</label>
									<input type="text" name="serie_comprobante" readonly id="idserie_comprobante"   
                                      value="{{$ingreso->serie_comprobante}}" class="form-control">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="numero_comprobante">N° Comprobante</label>
									<input type="text" name="numero_comprobante" id="idnumero"  readonly value="{{$ingreso->numero_comprobante}}" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="forma_pago">Forma Pago</label>
									<input type="text" name="numero_comprobante" id="idnumero" readonly value="{{$ingreso->forma_pago}}" 
									class="form-control" >
								</div>
							</div>
			                <div class="col-md-3">
								<div class="form-group">
									<label for="fecha">Fecha Compra</label>
									<input  type="text" name="fecha" id="idfecha" readonly value="{{$ingreso->fecha}}" class="form-control" >
								</div>
							</div>
							
			</div>

			
			<div class="col-md-12">
							<div class="col-md-3">
								<div class="form-group">
									<label for="fecha_caducidad">Fecha Caducidad</label>
									<input  type="text" name="fecha_caducidad" readonly value="{{$ingreso->fecha_caducidad}}" id="idfecha_caducidad"  class="form-control" >
								</div>
							</div>
							<!-- <div class="col-md-3">
								<div class="form-group">
									<label for="iva_general">IVA %</label>
									<input  type="number" name="iva_general" id="idiva_general" readonly value="{{$ingreso->impuesto_porcentaje}}" class="form-control"   >
								</div>
							</div> -->
							<div class="col-md-3">
								<div class="form-group">
									<label for="descuento_general">DESCUENTO %</label>
									<input  type="number" name="descuento_general"  readonly id="iddescuento_general" value="{{$ingreso->descuento_porcentaje}}" class="form-control"  onkeypress="return validateNumber(event) " >
								</div>
							</div>
			</div>

			
			<div class="col-md-12">

                     <div class="col-md-6">
											<div class="form-group">
											<label for="observacion">Observación</label>
											<textarea  type="text" name="observacion" readonly value="{{$ingreso->observacion}}" class="form-control" placeholder="Ingrese observación..."></textarea>
											</div>
				            </div>
				<div class="col-md-6">
											<div class="form-group">
											<label>Total Valor a Pagar</label>
											<h1 style="color:orange;margin-top:10px;" id="idTotaldolar"  >{{'$' . number_format($ingreso->totalCompra, 2) }} </h1>
											</div>
				</div>
			</div>
</div>

    <div class="row">
        <div class="col-md-12">			
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="col-md-12 prt-comprobante ">
						<table id="dtTabla" style="overflow-x:scroll; display:block" class="table table-responsive table-warning table-striped table-bordered table-condensed table-hover">
						 <thead width="100%" style="background-color:#F59B20;color:white;" class="text-center">
							 <th width="25%">Producto</th>
							 <th width="15%">Cantidad</th>
                             <th width="15%">Precio Unitario</th>
							 <th width="15%">Descuento</th>
							 <th width="15%">Iva</th>
							 <th width="15%">Total</th>		
                         </thead>

						 <tfoot>
						 <th style="font-weight:bold;color:orange;font-size:24px;">SUBTOTAL<br>
						 DESCUENTO<br>
						 TOTAL
						</th>
						
						 <th></th>
						 <th></th>
						 <th></th>
						 <th></th>
						 <th style="font-weight:bold;color:orange;font-size:20px;">
							 <input  name="subtotal"  readonly style="font-weight:bold;color:green;font-size:20px;background-color: white !important;border: 0 !important;" value="$ {{$ingreso->subtotal}}" ><br>
							 <input name="descuento" readonly style="font-weight:bold;color:red;font-size:20px;background-color: white !important;" value="$ {{$ingreso->descuento}}" ><br>
                             <!-- <input name="impuesto" readonly style="font-weight:bold;color:red;font-size:20px;background-color: white !important;" value="$ {{$ingreso->impuesto}}" ><br> -->
							 <input name="totalCompra"  readonly style="font-weight:bold;color:orange;font-size:20px;background-color: white !important;border: 0 !important;" value="$ {{$ingreso->totalCompra}}" >
					    </th>
                         </tfoot>
						 <tbody>
                         @foreach($detalles as $dt)
						 <tr>
							<td>{{$dt->articulo}}</td>
							<td>{{$dt->cantidad}}</td>
							<td>{{$dt->precio_unitario}}</td>
							<td>{{$dt->descuento}}</td>
							<td>{{$dt->iva}}</td>
							<td><!-- {{$dt->cantidad*$dt->precio_compra}} -->{{$dt->cantidad*$dt->precio_unitario}}</td> 
						 </tr>
						 @endforeach
						 </tbody>

						</table>
		  	        </div> 

				</div>
			</div>
		</div>
    </div>	
			<div class="form-group col-md-3">
			<a href="../ingreso"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>	




@push ('scripts')
 <script>

$(window).on("load", function() {
    var dataiva = $("#idiva_general").val();
	var datadesc = $("#iddescuento_general").val();
	var unsoloValor1 =  parseFloat(dataiva);  
    var unsoloValor2 =  parseFloat(datadesc);  

    $("#idiva_general").val(unsoloValor1);
    $("#iddescuento_general").val(unsoloValor2);
	});

 </script>
@endpush			
@endsection
