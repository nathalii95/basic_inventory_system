@extends ('layouts.admin')
@section ('contenido')

<div class="row">
    <div class="col-md-12 ">
				<div class="col-md-6">
					<h3>Vista Detalle  <br> {{$venta->tipo_comprobante}} {{$venta->num_comprobante}} </h3>
				</div>
		</div>
	</div>

    <div class="row mt-5" >
			<div class="col-md-12 ">
							<div class="col-md-6">
								<div class="form-group sect-one ">
									<label for="id_cliente">Cliente</label>
									<input type="text" name="id_cliente" id="idcliente" readonly 
									 value="{{$venta->nombre}}" class="form-control">

								</div>
							</div>
                            <div class="col-md-6">
								<div class="form-group">
									<label for="tipo_comprobante">Tipo Comprobante</label>
									<input type="text" name="tipo_comprobante" id="idtipo"  
									 value="{{$venta->tipo_comprobante}}" class="form-control" readonly >
								</div>
							</div>
			</div>
			<div class="col-md-12">
				
			                <div class="col-md-3">
								<div class="form-group">
									<label for="serie_comprobante">N° Serie</label>
									<input type="text" name="serie_comprobante" id="idserie_comprobante" readonly  
                                      value="{{$venta->serie_comprobante}}" class="form-control">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="numero_comprobante">N° Comprobante</label>
									<input type="text" name="numero_comprobante" id="idnumero" readonly  value="{{$venta->num_comprobante}}" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="forma_pago">Forma Pago</label>
									<input type="text" name="numero_comprobante" id="idnumero" readonly value="{{$venta->forma_pago}}" 
									class="form-control" >
								</div>
							</div>
			                <div class="col-md-3">
								<div class="form-group">
									<label for="fecha">Fecha Venta</label>
									<input  type="text" name="fecha" id="idfecha" readonly value="{{$venta->fecha}}" class="form-control" >
								</div>
							</div>
							
			</div>
            <div class="col-md-12">
							<div class="col-md-3">
								<div class="form-group">
									<label for="fecha_caducidad">Fecha Caducidad</label>
									<input  type="text" name="fecha_caducidad" readonly value="{{$venta->fecha_caducidad}}" id="idfecha_caducidad"  class="form-control" >
								</div>
							</div>
							
						<!-- 	<div class="col-md-3">
								<div class="form-group">
									<label for="iva_general">IVA %</label>
									<input  type="number" name="iva_general" readonly id="idiva_general" value="{{$venta->impuesto_porcentaje}}" class="form-control"   >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="descuento_general">DESCUENTO %</label>
									<input  type="number" name="descuento_general" id="iddescuento_general" value="{{$venta->descuento_porcentaje}}" class="form-control"  readonly>
								</div>
							</div> -->
			</div>
			<div class="col-md-12">

				<div class="col-md-6">
											<div class="form-group">
											<label>Total Valor a Pagar</label>
											<h1 style="color:orange;margin-top:10px;" id="idTotaldolar"  >{{'$' . number_format($venta->total_venta, 2) }} </h1>
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
							 <th width="15%">Precio Venta</th>
                             <th width="15%">Descuento</th>
                             <th width="15%">Total</th>
							
                         </thead>

						 <tfoot>
						 <th style="font-weight:bold;color:orange;font-size:24px;">SUBTOTAL<br>
<!--                          DESCUENTO<br> 
                         IVA<br> -->
						 TOTAL
						</th>
						
						 <th></th>
						 <th></th>
						 <th></th>
						 <th style="font-weight:bold;color:orange;font-size:20px;">
                             <input  name="subtotal"  readonly style="font-weight:bold;color:green;font-size:20px;background-color: white !important;border: 0 !important;" value="$ {{$venta->subtotal}}" ><br>
							<input name="totalCompra"  readonly style="font-weight:bold;color:orange;font-size:20px;background-color: white !important;border: 0 !important;" value="$ {{$venta->total_venta}}" >
							<input name="descuento"  type="hidden"readonly style="font-weight:bold;color:blue;font-size:20px;background-color: white !important;border: 0 !important;" value="$ {{$venta->descuento}}" ><br>
                             <input name="impuesto"  type="hidden" readonly style="font-weight:bold;color:red;font-size:20px;background-color: white !important;" value="$ {{$venta->impuesto}}" ><br>

					    </th>
                         </tfoot>
						 <tbody>
                         @foreach($detalles as $dt)
						 <tr>
							<td>{{$dt->articulo}}</td>
							<td>{{$dt->cantidad}}</td>
							<td>{{$dt->precio_venta}}</td>
                            <td>{{$dt->descuento}}</td>
							<td>{{($dt->cantidad*$dt->precio_venta)-($dt->descuento)}}</td>
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
			<a href="../ventas"><button class="btn btn-warning btn-block">Regresar</button></a>
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
/* 
$(document).ready(function(){

$(document).on('click','#idBtn',function(){
	myDiv 


});
}); */

/* function imprimirDIV() {
    $("#myDiv").show();
    $("#myDiv").print();
	$("#myDiv").hide();
    } */
 </script>
@endpush			
@endsection
