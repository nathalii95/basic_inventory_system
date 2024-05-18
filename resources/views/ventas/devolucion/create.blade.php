@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Ingreso</h3>
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
			{!!Form::open(array('url'=>'compras/ingreso','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    
	<div class="row">
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="id_proveedor">Proveedor</label>
									<select name="id_proveedor"  id="idproveedor" value="{{old('id_proveedor')}}" required class="form-control selectpicker" data-live-search="true" >
									<option value="" >Seleccione Proveedor</option>
									@foreach ($proveedores as $pro)
										<option value="{{$pro->id_proveedor}}" >{{$pro->nombre}}</option>
									@endforeach
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="tipo_comprobante">Tipo Comprobante</label>
									<select name="tipo_comprobante" required class="form-control" id="idtipo"  value="{{old('tipo_comprobante')}}" >
									<option value="" >Seleccione Comprobante</option>
									<option value="FACTURA" >Factura</option>
									<option value="NOTA DE VENTA" >Nota de Venta</option>
									</select>
								</div>
							</div>

			</div>
			<div class="col-md-12">
				
			                <div class="col-md-3">
								<div class="form-group">
									<label for="serie_comprobante">N° Serie</label>
									<input type="text" name="serie_comprobante" id="idserie_comprobante" required   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="7" value="{{old('serie_comprabante')}}" class="form-control" placeholder="000-000">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="numero_comprobante">N° Comprobante</label>
									<input type="text" name="numero_comprobante" id="idnumero" required   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" value="{{old('numero_comprabante')}}" class="form-control" placeholder="000000000">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="forma_pago">Forma Pago</label>
									<select name="forma_pago"  class="form-control" id="idforma" >
									<option value="" >Seleccione Forma Pago</option>
									<option value="Efectivo" >Efectivo</option>
									<option value="Ch/ posfechado" >Ch/ posfechado</option>
									</select>
								</div>
							</div>
			                <div class="col-md-3">
								<div class="form-group">
									<label for="fecha">Fecha Emisión</label>
									<input  type="text" name="fecha" id="idfecha" readonly value="{{$f_emsion}}" class="form-control" >
								</div>
							</div>
							
			</div>

			
			<div class="col-md-12">
							<div class="col-md-3">
								<div class="form-group">
									<label for="fecha_caducidad">Fecha Caducidad</label>
									<input  type="text" name="fecha_caducidad" readonly value="{{$f_caducidad}}" id="idfecha_caducidad" value="" class="form-control" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="fecha_ingreso">Fecha Ingreso</label>
									<input  type="date" name="fecha_ingreso" id="idfecha_ingreso" value="{{old('tipo_comprobante')}}"  class="form-control" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="iva_general">IVA %</label>
									<input  type="number" name="iva_general" id="idiva_general" value="{{old('iva_general')}}"  class="form-control"  onkeypress="return validateNumber(event) " >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="descuento_general">DESCUENTO %</label>
									<input  type="number" name="descuento_general" id="iddescuento_general" value="{{old('descuento_general')}}"  class="form-control"  onkeypress="return validateNumber(event) " >
								</div>
							</div>
			</div>

			
			<div class="col-md-12">

                <div class="col-md-6">
											<div class="form-group">
											<label for="observacion">Observación</label>
											<textarea  type="text" name="observacion" value="{{old('observacion')}}" class="form-control" placeholder="Ingrese observación..."></textarea>
											</div>
				</div>
				<div class="col-md-6">
											<div class="form-group">
											<label>Total Valor a Pagar</label>
											<h1 style="color:orange;margin-top:10px;" id="idTotaldolar"  ></h1>
											</div>
				</div>
			</div>
</div>


<div class="row">
        <div class="col-md-12">			
			<div class="panel panel-primary">
				<div class="panel-body">
				    <div class="col-md-12">
											<div class="form-group">
											<button type="button" id="btn_add" class="btn btn-success" > <i class="fa fa-plus-circle" aria-hidden="true"></i> AGREGAR</button >
											</div>
					</div>
					<div class="col-md-3">
											<div class="form-group">
											<label for="id_producto">Producto</label>
											<select name="pid_producto"  id="pid_producto" requiered
											class="form-control selectpicker" data-live-search="true" >
											<option value="" >Seleccione Producto</option>
											@foreach ($articulos as $articulo)
												<option value="{{$articulo->id_producto}}_
												{{$articulo->descuento}}" >{{$articulo->articulo}}</option>
											@endforeach
											</select>
											</div>
					</div>

					<div class="col-md-3">
											<div class="form-group">
											<label for="cantidad">Cantidad</label>
											<input  type="number" name="pcantidad" id="pcantidad" value="{{old('pcantidad')}}"  onkeyup="calPrecioTotal()" class="form-control" >
											</div>
					</div>
					<div class="col-md-3">
											<div class="form-group">
											<label for="pprecio_unitario">Precio Unitario</label>
											<input  type="number" name="pprecio_unitario" id="pprecio_unitario" value="{{old('pprecio_unitario')}}"  onkeyup="calPrecioTotal()"  class="form-control" >
											</div>
					</div>
					<div class="col-md-3">
											<div class="form-group">
											<label for="descuento">Descuento</label>
											<input  type="number" name="pdescuento" id="pdescuento"  onkeypress="return validateNumber(event)" value="{{old('pdescuento')}}" onkeyup="calPrecioTotal()"  class="form-control"  >
											</div>
					</div>

					<div class="col-md-3">
									
					</div>
					<div class="col-md-3">
										<div class="form-group">
											<label for="precio_compra">Precio Compra</label>
											<input  type="number" name="pprecio_compra" id="pprecio_compra" value="{{old('pprecio_compra')}}"   class="form-control" >
											</div>
					</div>

					
					<div class="col-md-3">
											<div class="form-group">
											<label for="precio_venta">Precio Venta</label>
											<input  type="number" name="pprecio_venta" id="pprecio_venta"  class="form-control" value="{{old('pprecio_venta')}}">
											</div>
					</div>





					<div class="col-md-12">
						<table id="detalles" style="overflow-x:scroll; display:block" class="table table-responsive table-warning table-striped table-bordered table-condensed table-hover">
						 <thead width="100%" style="background-color:#F59B20;color:white;" class="text-center">
							 <th width="15%" >Opciones</th>
							 <th width="25%">Producto</th>
							 <th width="15%">Cantidad</th>
							 <th width="15%">P. Unitario</th>
							 <th width="15%">Descuento</th>
<!-- 						 <th width="15%">Precio Compra</th>
							 <th width="15%">Precio Venta</th> -->
							 <th width="15%">Total</th>
                         </thead>

						 <tfoot>
						 <th style="font-weight:bold;color:orange;font-size:24px;">SUBTOTAL<br>
						 DESCUENTO<br>
						 IVA<br>
						 TOTAL
						</th>
						 <th></th>
						 <th></th>
						 <th></th>
						 <th></th>
						 <th style="font-weight:bold;color:orange;font-size:20px;">
							 <input id="total" name="subtotal"  readonly style="font-weight:bold;color:green;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00"><br>
							 <input id="pdescuentog" name="descuentop" readonly  style="font-weight:bold;color:blue;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00"><br>
							 <input id="pdescuentoporc" name="descuento_porcentajep" type="hidden"  style="font-weight:bold;color:blue;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00">				
							<input id="pimpuesto" name="impuesto" readonly style="font-weight:bold;color:red;font-size:20px;background-color: white !important;" placeholder="$0.00">
							 <input id="pimpuestoporc" name="impuesto_porcentaje" type="hidden" style="font-weight:bold;color:red;font-size:20px;background-color: white !important;" placeholder="$0.00"><br>
							 <input id="ptotal" name="totalCompra"  readonly style="font-weight:bold;color:orange;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00">
                        </th>
                         </tfoot>

						</table>
		  	        </div> 

				</div>
			</div>
		</div>
		<div class="col-md-12" id="guardar" >
							<div class="col-md-6">
										<div class="form-group">
										<input  type="hidden" name="_token" value="{{ csrf_token() }}"  >
										<button class="btn btn-primary" type="submit">Guardar</button>
										<button class="btn btn-danger" type="reset">Limpiar</button>
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

$(window).on("load", function() {
	document.getElementById('pcantidad').disabled = true;
	document.getElementById('pdescuento').disabled = true;
	document.getElementById('pprecio_unitario').disabled = true;
	document.getElementById('pprecio_compra').disabled = true;
	document.getElementById('pprecio_venta').disabled = true;
	var datadesc = $("#pdescuento").val();
	var envioDatadesc =  parseFloat(datadesc);
	$("#pdescuento").val(envioDatadesc);
		$("#iddescuento_general").val(0);
	$("#idiva_general").val(0);
	document.getElementById("idTotaldolar").innerHTML = "$0.00"; 
	});


	function validateNumber(e) {
            const pattern = /^[0-9]$/;
            return pattern.test(e.key)
        }


$(document).ready(function(){
$('#btn_add').click(function(){
   agregar();
  });
});

jQuery(document).ready(function(){
	jQuery("#idnumero").on('input', function (evt) {
		jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
	});
});

var cont=0;
total=0;

subtotal=[];

$("#guardar").hide();


$("#pid_producto").change(mostrarValores);

function mostrarValores(){

	document.getElementById('pcantidad').disabled = false;
	/* document.getElementById('pdescuento').disabled = false; */
	document.getElementById('pprecio_unitario').disabled = false;
/* 	document.getElementById('pprecio_compra').disabled = false; */
	document.getElementById('pprecio_venta').disabled = false;
	$("#pcantidad").val('');
	$("#pdescuento").val('');
	$("#pprecio_unitario").val('');
	$("#pprecio_compra").val('');
	$("#pprecio_venta").val('');

	producto = $("#pid_producto").val();
	if(producto == ""){
		$("#pid_producto").val('');
		$("#pcantidad").val('');
		$("#pdescuento").val('');
		$("#pprecio_unitario").val('');
		$("#pprecio_compra").val('');
		$("#pprecio_venta").val('');
	}else{
	datosArticulo=document.getElementById('pid_producto').value.split('_');
	$("#pdescuento").val(parseFloat(datosArticulo[1].replace(/\t|\n/g, '')));
	}

}

function calPrecioTotal(){
	cantidad = $("#pcantidad").val();
    dscoporct = $("#pdescuento").val();
	descuentoValor = dscoporct/100;
	pUnitario = $("#pprecio_unitario").val();
	totalCal = cantidad * pUnitario;
	descuento = totalCal * descuentoValor;
	totalCompr = totalCal - descuento;
	$("#pprecio_compra").val(totalCompr);
}

$("#idiva_general").keyup(dataE);
$("#iddescuento_general").keyup(dataE);

function dataE(){

var ingresoIva = $("#idiva_general").val();
var descuentoporc = $("#iddescuento_general").val();
var total = $("#total").val();
////CALCULO SUBTOTAL DESCUENTO IVA TOTAL
    descdata = descuentoporc/100;
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


}

function agregar(){
	
var iva;
var ivaCalculo;
var totalCompra;
var descuentoporc;
var descuentoCalculo;

var	id_articulo = $("#pid_producto").val();
var	articulo = $("#pid_producto option:selected").text();
var	cantidad = $("#pcantidad").val();
var precio_unitario = $("#pprecio_unitario").val();
var descuento = $("#pdescuento").val();
var	precio_compra = $("#pprecio_compra").val();
var	precio_venta = $("#pprecio_venta").val();

var ingresoIva = $("#idiva_general").val();
var ingresoDescuento = $("#iddescuento_general").val();

	if (id_articulo!="" && cantidad!="" && cantidad>0 && pUnitario!="" &&  precio_compra!="" && pUnitario!=""  && precio_venta!=""){
   
	var descEnvio = descuento/100; //porcentaje Iva /100
    var compra = pUnitario * cantidad; // valor de compra
	var desc = compra * descEnvio;
     
	subtotal[cont]=(cantidad*pUnitario) - desc;
	total=total+subtotal[cont];
	


	////CALCULO SUBTOTAL DESCUENTO IVA TOTAL
	descuentoporc = ingresoDescuento/100;
	descuentoCalculo = descuentoporc * total ;

	ivaCalculo = ingresoIva/100;
	iva = ivaCalculo * total ;
	totalCompra = (parseFloat(total) - descuentoCalculo + iva); 



	
	$("#total").val(total);
	$("#pdescuentog").val(descuentoCalculo);
	$("#pdescuentoporc").val(ingresoDescuento);
	$("#pimpuestoporc").val(ingresoIva);
	$("#pimpuesto").val(iva);
	$("#ptotal").val(totalCompra);               

	var totalDol = new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'}).format(totalCompra);

	document.getElementById("idTotaldolar").innerHTML = totalDol;                                                                                                                                                                                                                                                                                                                                                                            
 
	var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger" onclick="eliminar('+cont+');" >X</button></td><td><input type="hidden" name="id_producto[]" value="'+id_articulo+'">'+articulo+'</td><td><input type="number" readonly name="cantidad[]" value="'+cantidad+'"></td> <td><input type="number" readonly name="precio_unitario[]" value="'+precio_unitario+'"></td><td><input type="hidden" readonly name="descuento_porcentaje[]" value="'+descuento+'"><input type="number" readonly name="descuento[]" value="'+desc+'"></td><td>'+subtotal[cont]+' </td><input type="hidden"  name="precio_compra[]" value="'+subtotal[cont]+'" ><input type="hidden"  name="precio_venta[]" value="'+precio_venta+'" > </tr>';

	cont++;
    limpiar();
	
	evaluar();
	$("#detalles").append(fila);
  }else{
	  alert("Error al ingresar el detalle, revise los datos de los productos");

  }
}

total=0;

   function limpiar(){
 $("#pcantidad").val("");
 $("#pdescuento").val("");
 $("#pprecio_unitario").val("");
 $("#pprecio_compra").val("");
 $("#pprecio_venta").val("");
	 }

	 function evaluar(){
		if(total>0){
			$("#guardar").show();
		}
		else{
			$("#guardar").hide();
		}
	 }

	 function eliminar(index){;


		var ingresoIva = $("#idiva_general").val();
        var ingresoDescuento = $("#iddescuento_general").val();

       total=total-subtotal[index];
	   $("#total").val(total);
       
	   var dataIva = ingresoIva/100;
       var descuentoCalculo = ingresoDescuento/100;

	   $("#pimpuesto").val((total * dataIva));
	   $("#pdescuentog").val(total * descuentoCalculo);

	   var data = total;
       var im = total * dataIva;
	   var desc = total * descuentoCalculo;
	   var dataFin =  data - desc + im ;
	   $("#ptotal").val(dataFin);	  
	   $("#pdescuentoporc").val(ingresoIva);
	   $("#pimpuestoporc").val(ingresoDescuento);       
      
	   var totalDol = new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'}).format(dataFin);
	   document.getElementById("idTotaldolar").innerHTML = totalDol;   

	   $("#fila" + index).remove();
	   $("#idiva_general").val(0);
	   $("#iddescuento_general").val(0);
	   evaluar();
	 }


 </script>
@endpush			
@endsection

