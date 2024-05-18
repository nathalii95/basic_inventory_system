@extends ('layouts.admin')
@section ('contenido')
@php $cont = 1;
                         @endphp
						 @if(session()->has('message'))
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong> {{ session()->get('message') }}</strong> 
</div>
@endif
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Devolución </h3>
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
	
	{!!Form::model($ingreso,['method'=>'PATCH','route'=>['compras.devolucioncom.update',$ingreso->id_compra]])!!}
    {{Form::token()}}
    <input type="hidden"  value="{{$ingreso->id_compra}}"  name="id_compra" id="id_compra"  >


<div class="row">
        <div class="col-md-12">		  	
			<div class="panel panel-danger">
				<div class="panel-body">
				<h4>Datos Factura Anterior -- {{$ingreso->tipo_comprobante}} {{$ingreso->numero_comprobante}}  </h4>	
				        <div class="col-md-12">
								<div class="col-md-6">
									<div class="form-group">
										<label for="id_proveedor">Proveedor</label>
										<input type="text" name="" id="" readonly 
										value="{{$ingreso->nombre}}" class="form-control">
										<input type="hidden" name="id_proveedor" id="idproveedor"  
										value="{{$ingreso->id_proveedor}}" class="form-control">
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<label for="tipo_comprobante">Comprobante</label>
										<input type="text" name="tipo_comprobante" id="idtipo"  
										value="{{$ingreso->tipo_comprobante}}" class="form-control" readonly >
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="serie_comprobante">N° Serie</label>
										<input type="text" name="serie_comprobante" id="idserie_comprobante" readonly  
										value="{{$ingreso->serie_comprobante}}" class="form-control">			
									</div>
							    </div>

								<div class="col-md-2">
									<div class="form-group">
										<label for="numero_comprobante">N° Comprobante</label>
										<input type="text" name="numero_comprobante" id="idnumero"   value="{{$ingreso->numero_comprobante}}" class="form-control" readonly>
									</div>
								</div>
						</div>
						<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="forma_pago">Forma Pago</label>
											<input type="text" name="forma_pago" id="idnumero" readonly value="{{$ingreso->forma_pago}}" 
											class="form-control" >
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											<label for="fecha">Fecha Compra</label>
											<input  type="text" name="fecha" id="idfecha" readonly value="{{$ingreso->fecha}}" class="form-control" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="fecha_caducidad">Fecha Caducidad</label>
											<input  type="text" name="fecha_caducidad" readonly value="{{$ingreso->fecha_caducidad}}" id="idfecha_caducidad"  class="form-control" >
										</div>
									</div>
<!-- 									<div class="col-md-2">
										<div class="form-group">
											<label for="iva_general">IVA %</label>
											<input  type="number" name="iva_general" id="idiva_general" readonly value="{{$ingreso->impuesto_porcentaje}}" class="form-control"   >
										</div>
									</div> -->
									<input  type="hidden" name="iva_general" id="idiva_general" readonly value="{{$ingreso->impuesto_porcentaje}}" class="form-control"   >
									<div class="col-md-2">
										<div class="form-group">
											<label for="descuento_general">DESCUENTO %</label>
											<input  type="number" name="descuento_general" id="iddescuento_general" value="{{$ingreso->descuento_porcentaje}}" class="form-control"  readonly onkeypress="return validateNumber(event) " >
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
						</div>

				</div>
			</div>
		</div>
</div>	

<div class="row">
        <div class="col-md-12">			
			<div class="panel panel-success">
				<div class="panel-body">
				<h4>Datos Devolución</h4>
				        <div class="col-md-12">


								@if($ingreso->tipo_comprobante == "FACTURA")

								<div class="col-md-3">
									<div class="form-group">
										<label for="serie_comprobanten">N° Serie</label>
										<input type="text" name="serie_comprobanten" id="idserie_comprobanten" required readonly  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
										 value="002-001" class="form-control" placeholder="000-000">		
									</div>
							    </div>

								<div class="col-md-3">
									<div class="form-group">
										<label for="numero_comprobanten">N° Comprobante</label>
										<input type="text" name="numero_comprobanten" id="idnumeron" required  readonly
										 oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9"
										 value="{{$countCompra}}" class="form-control" placeholder="000000000">
									</div>
								</div>

								@else

								<div class="col-md-3">
									<div class="form-group">
										<label for="serie_comprobanten">N° Serie</label>
										<input type="text" name="serie_comprobanten" required readonly   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
										value="002-001" class="form-control" placeholder="000-000">		
									</div>
							    </div>

								<div class="col-md-3">
									<div class="form-group">
										<label for="numero_comprobanten">N° Comprobante</label>
										<input type="text" name="numero_comprobanten"  required  readonly
										 oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9"
										 value="{{$countCompranv}}" class="form-control" placeholder="000000000">
									</div>
								</div>


								@endif


								<div class="col-md-2">
									<div class="form-group">
										<label for="fechan">Fecha Devolución Compra</label>
									
										<input  type="date" name="fechan" id="idfechan"  required
										value="<?php echo date('Y-m-d', strtotime($f_emsion)) ?>"
										 class="form-control" >
									</div>
							    </div>
								<input  type="hidden" name="fecha_caducidadn" required value="<?php echo date('Y-m-d', strtotime($f_caducidad)) ?>" id="idfecha_caducidadn"  class="form-control" >
						</div>
						<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="observacionn">Motivo Devolución</label>
											<select name="observacionn"  class="form-control" value="{{old('observacionn')}}"  required >
											<option value="" >Seleccione Motivo</option>
											<option value="Dañado" >Dañado</option>
											<option value="Mojado" >Mojado</option>
											<option value="Robo" >Robo</option>
											<option value="Perdido" >Perdido</option>
											<option value="Caducado" >Caducado</option>
											<option value="Faltante" >Faltante</option>
											</select>
										
										</div>
						            </div>	
									<div class="col-md-9">
										<div class="form-group">
											<label for="nota">Nota</label>
											<textarea  type="text" name="nota"  value="{{old('nota')}}" class="form-control" placeholder="Ingrese nota..."></textarea>
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
						
						<th  width="5%" >Devolver</th>
							 <th width="5%" >Id</th>
							 <th width="40%">Producto</th>
							 <th width="10%">Cantidad</th>
							 <th width="10%">Precio Unitario ($)</th>
							 <th width="10%">Descuento  ($)</th>
							 <th width="10%">Iva  ($)</th>
							 <th width="10%">Cant. a Devolver</th>
							 <!-- <th width="10%">Total</th> -->
                         </thead>
						 <tbody>

                         @foreach($detalles as $dt) 

						 <tr>
						 @if($dt->cantidad == $dt->cant_dev)
						    <td><input disabled type="checkbox" name="is_selec[]" class="switch-input"  id="is_selec" value="{{$dt->id_dt_compra}}"   ></td>		<!-- onchange="setProducto({{json_encode($dt)}}, {{$cont}})"  -->
							<td>{{$cont}}<input type="hidden" disabled name="id_dt_compra[]" class="id_dt_compra"  value="{{$dt->id_dt_compra}}"></td>
							<td><input  type="hidden" disabled name="id_producto[]" class="id_producto"  value="{{$dt->id_producto}}">
							<input type="text" disabled  value="{{$dt->articulo}}" style="width:100%;height:50%;border: 0 !important;"></td>

							@if($dt->cant_dev == "0")					
							<td><input type="text" disabled name="cantidad[]" min="0" class="cantidad" id="idcantidad" value="{{$dt->cantidad}}" style="width:100%;height:50%;border: 0 !important;"></td>
							@elseif($dt->cant_dev > "0")
							<td><input type="text" disabled name="cantidad[]" min="0"  class="cantidad" id="idcantidad" value="{{($dt->cantidad-$dt->cant_dev)}}" style="width:100%;height:50%;border: 0 !important;"></td>			
							@endif				
						
							<td> <input type="number" disabled name="precio_unitario[]" class="precio_unitario" id="idpreciou"   value="{{$dt->precio_unitario}}" style="width:100%;height:50%;border: 0 !important;"></td>
							<td>
							  <input type="hidden" disabled name="descuento_porcentaje[]"  class="descuento_porcentaje" value="{{$dt->descuento_porcentaje}}">
							  <input  type="number" disabled name="descuento[]" class="descuento" id="iddescuento" value="{{$dt->descuento}}" style="width:100%;height:50%;border: 0 !important;" >
							  
							  
							  <input type="hidden" disabled name="precio_compra[]" class="precio_compra" value="{{$dt->precio_compra}}">
							  <input type="hidden" disabled name="precio_venta[]" class="precio_venta"  value="{{$dt->precio_venta}}">
							</td> 
						    <td><input  type="hidden" disabled name="iva_porcentaje[]" value="{{$dt->iva_porcentaje}}">  <input  type="number" disabled name="iva[]" class="iva" id="idiva" value="{{$dt->iva}}" style="width:100%;height:50%;border: 0 !important;" ></td>
						    	@if($dt->cantidad == $dt->cant_dev)
								<td><input type="number" disabled  name="cant_devuelta[]" class="cant_devuelta" value="{{$dt->cantidad}}"    style="width:100%;height:50%;"></td>
								@else
								<td><input type="number" disabled  name="cant_devuelta[]" class="cant_devuelta" value="0"  style="width:100%;height:50%;" ></td>			
								@endif



						 @else

						    <td><input  type="checkbox" name="is_selec[]" class="switch-input"  id="is_selec" value="{{$dt->id_dt_compra}}"   ></td>		<!-- onchange="setProducto({{json_encode($dt)}}, {{$cont}})"  -->
							<td>{{$cont}}<input type="hidden" name="id_dt_compra[]" class="id_dt_compra"  value="{{$dt->id_dt_compra}}"></td>
							<td><input type="hidden" name="id_producto[]" class="id_producto"  value="{{$dt->id_producto}}">
							<input type="text" readonly  value="{{$dt->articulo}}" style="width:100%;height:50%;border: 0 !important;"></td>

							@if($dt->cant_dev == "0")					
							<td><input type="text" readonly name="cantidad[]" min="0" class="cantidad" id="idcantidad" value="{{$dt->cantidad}}" style="width:100%;height:50%;border: 0 !important;"></td>
							@elseif($dt->cant_dev > "0")
							<td><input type="text" readonly name="cantidad[]" min="0"  class="cantidad" id="idcantidad" value="{{($dt->cantidad-$dt->cant_dev)}}" style="width:100%;height:50%;border: 0 !important;"></td>			
							@endif				
						
							<td> <input type="number" readonly name="precio_unitario[]" class="precio_unitario" id="idpreciou"   value="{{$dt->precio_unitario}}" style="width:100%;height:50%;border: 0 !important;"></td>
							<td>
							  <input type="hidden" readonly name="descuento_porcentaje[]"  class="descuento_porcentaje" value="{{$dt->descuento_porcentaje}}">
							  <input  type="number" readonly name="descuento[]" class="descuento" id="iddescuento" value="{{$dt->descuento}}" style="width:100%;height:50%;border: 0 !important;" >
							  
							  
							  <input type="hidden" readonly name="precio_compra[]" class="precio_compra" value="{{$dt->precio_compra}}">
							  <input type="hidden" readonly name="precio_venta[]" class="precio_venta"  value="{{$dt->precio_venta}}">
							</td> 
						    <td><input  type="hidden"  name="iva_porcentaje[]" value="{{$dt->iva_porcentaje}}">  <input  type="number" readonly name="iva[]" class="iva" id="idiva" value="{{$dt->iva}}" style="width:100%;height:50%;border: 0 !important;" ></td>
						    	@if($dt->cantidad == $dt->cant_dev)
								<td><input type="number"  name="cant_devuelta[]" class="cant_devuelta" value="{{$dt->cantidad}}" readonly   style="width:100%;height:50%;"></td>
								@else
								<td><input type="number"  name="cant_devuelta[]" class="cant_devuelta" value="0"  style="width:100%;height:50%;" ></td>			
								@endif

						@endif


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
		
<!--         <div class="col-md-12">			
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
											<span style="font-weight:bold;color:orange;font-size:16px;">$</span><input name="totalCompra"  readonly style="font-weight:bold;color:orange;font-size:16px;background-color: white !important;border: 0 !important;" value="{{$ingreso->totalCompra}}" >
						             	</div>
						            </div>			
						</div>	       
            
				</div>
			</div>
		</div> -->
      
		<input type="hidden" name="totalCompra"  readonly style="font-weight:bold;color:orange;font-size:16px;background-color: white !important;border: 0 !important;" value="{{$ingreso->totalCompra}}" >
		<div class="col-md-12" id="guardar" >
							<div class="col-md-6">
										<div class="form-group">
										<input  type="hidden" name="_token" value="{{ csrf_token() }}"  >
										<button class="btn btn-primary "   type="submit"  id="save_btn" >Guardar</button>
										<button class="btn btn-danger"  type="reset">Limpiar</button>
									
									
									</div>
							</div>
		</div>

	
</div>


		{!!Form::close()!!}	
			<div class="form-group col-md-3">
			<a href="../ingreso"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>	
			
@push ('scripts')
 <script>
/* 	$(window).on("load", function() {
	
	var cells = document.getElementsByClassName("cant_devuelta"); 
    for (var i = 0; i < cells.length; i++) { 
        cells[i].disabled = true;
    }
	}); */

	function validateNumber(e) {
            const pattern = /^[0-9]$/;
            return pattern.test(e.key)
        }



jQuery(document).ready(function(){
	jQuery("#idnumero").on('input', function (evt) {
		jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
	});
});

/* var cont=0; */
/* total=0;
subtotal=[];
 */

/*$("#is_selec").change(dataE);

function dataE(){
	
var ingresoIva = $("#idiva_general").val();
var descuentoporc = $("#iddescuento_general").val();
var totaln = $("#totaln").val();
console.log(totaln);
console.log("hola");


 var total = $("#total").val(); */
////CALCULO SUBTOTAL DESCUENTO IVA TOTAL
/*     descdata = descuentoporc/100;
	descuentoCalculo = descdata * total;

	ivaCalculo = ingresoIva/100;
	iva = ivaCalculo * total;
	totalCompra = (total - descuentoCalculo + iva); 

	$("#pdescuentog").val(descuentoCalculo);
	$("#pdescuentoporc").val(descuentoporc);
	$("#pimpuestoporc").val(ingresoIva);
	$("#pimpuesto").val(iva);
	$("#ptotal").val(totalCompra);    
	var totalDol = new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'}).format(totalCompra);
	document.getElementById("idTotaldolar").innerHTML = totalDol;      
 

}*/

var cont=0;
 total=0;
subtotal=[];

/* function changeOtros() {
 var data = document.getElementById('is_selec').checked;
var totaln =  $("#totaln").val();
var	cantidad = $("#idcantidad").val();   
var precio_unitario = $("#idpreciou").val();
var descuento = $("#iddescuento").val();
	if (data == true) {
	console.log("correcto");

    subtotal[cont]=(cantidad*precio_unitario) - descuento;
	total=total+subtotal[cont];
	console.log(subtotal[cont]);

	} 
}  */


/* $(document).ready(function(){
	$(document).on('click','#save_btn',function(){
		// idcantidad idcantidaddev
		   
		console.log("hola");
		
	var cantDev = $("#idcantidaddev").val();

        if (cantDev == 0) {
            let autFocus = $("#idcantidaddev").focus();
           //  toastr.error("Ingrese Cedula"); 
			alert("Texto a mostrar");
            return false;
        }// else{

	//	} 

	});
});
 */


/* function setProducto(p, index) {
	console.log(p,index);
	console.log("hola"); */

	/* var data = 	document.getElementById('is_selec').checked
		document.getElementById("idcantidaddev").disabled = true;
if (data == true) {
	document.getElementById("idretencion_valor").disabled = false;
	$("#idretencion_valor").val("");
}  */

/* } */



 </script>
@endpush			
@endsection

