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

			{!!Form::open(array('url'=>'compras/ingreso','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
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
									<select name="tipo_comprobante" required class="form-control" id="idtipo" onchange="changeComprobante()"   value="{{old('tipo_comprobante')}}" >
									<option value="" >Seleccione Comprobante</option>
									<option value="FACTURA" >Factura</option>
									<option value="NOTA DE VENTA" >Nota de Venta</option>
									</select>
								</div>
							</div>

			</div>
			<div class="col-md-12">
			<div id="iddescripcomp" >
			                <div class="col-md-3">
								<div class="form-group">
									<label for="serie_comprobante">N° Serie</label>
								</div>
							</div>			
							<div class="col-md-3">
								<div class="form-group">
									<label for="numero_comprobante">N° Comprobante</label>
								</div>
							</div>
				</div>	
				<div id="idfacturadatos" >
			                <div class="col-md-3">
								<div class="form-group">
									<label for="serie_comprobante">N° Serie</label>
									<input type="text" name="serie_comprobante" id="idserie_comprobante"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="7" value="002-001" readonly class="form-control" placeholder="000-000">
								</div>
							</div>
						
							<div class="col-md-3">
								<div class="form-group">
									<label for="numero_comprobante">N° Comprobante</label>
									<input type="text" name="numero_comprobante" id="idnumero"    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" value="{{$countCompra}}" readonly class="form-control" placeholder="000000000">
								</div>
							</div>
				</div>	
				<div id="idnotaventadatos" >
			                <div class="col-md-3">
								<div class="form-group">
									<label for="serie_comprobante">N° Serie</label>
									<input type="text" name="serie_comprobante" id="idserie_comprobantenv"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="7" value="002-001" readonly class="form-control" placeholder="000-000">
								</div>
							</div>
						
							<div class="col-md-3">
								<div class="form-group">
									<label for="numero_comprobante">N° Comprobante</label>
									<input type="text" name="numero_comprobante" id="idnumeronv"    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" value="{{$countCompranv}}" readonly class="form-control" placeholder="000000000">
								</div>
							</div>
				</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="forma_pago">Forma Pago</label>
									<select name="forma_pago"  class="form-control" id="idforma" >
									<option value="" >Seleccione Forma Pago</option>
									<option value="Efectivo" >Efectivo</option>
									<option value="Ch/ posfechado" >Ch/ posfechado</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="imagen">Documento (Opcional)</label>
									<input type="file" name="imagen"  class="form-control">
								</div>
							</div>
							
			</div>

			
			<div class="col-md-12">
			                <div class="col-md-3">
								<div class="form-group">
									<label for="fecha">Fecha Compra</label>
									<input  type="date" name="fecha" id="idfecha" value="<?php echo date('Y-m-d', strtotime($f_emsion)) ?>" class="form-control" >
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="descuento_general">DESCUENTO %</label>
									<input  type="number" name="descuento_general" id="iddescuento_general" value="{{old('descuento_general')}}"  class="form-control"  onkeypress="return validateNumber(event)" min="0"  oninput="javascript: if (this.value.length > this.maxLength  ) this.value = this.value.slice(0, this.maxLength );" maxlength="2"  >
								</div>
							</div> 
							<input  type="hidden" name="fecha_caducidad"  id="idfecha_caducidad" value="<?php echo date('Y-m-d', strtotime($f_caducidad)) ?>"  class="form-control" >
							<input  type="hidden" name="iva_general" id="idiva_general" value="0"  class="form-control"   >
							<!-- <input  type="hidden" name="descuento_general" id="iddescuento_general" value="0"  class="form-control" > -->
							<!-- <div class="col-md-3">
								<div class="form-group">
									<label for="iva_general">IVA %</label>
									<input  type="number" name="iva_general" id="idiva_general" value="{{old('iva_general')}}"  class="form-control"  onkeypress="return validateNumber(event) " >
								</div>
							</div>-->
							
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


				    <div class="col-md-12">
								
					<div class="col-md-4">
					                        <label for="id_producto">Producto</label>
											<div class="input-group">
					                           <select name="pid_producto"  id="pid_producto" requiered class="form-control selectpicker selectProduct" data-live-search="true" >
																<option value="" >Seleccione Producto</option>
																@foreach ($articulos as $articulo)
																	<option value="{{$articulo->id_producto}}_
																	0_{{$articulo->impuesto_valor}}_{{$articulo->stock}}" >{{$articulo->articulo}}</option>
																@endforeach
												</select>
				                                 <span class="input-group-btn">
				                                 <a href="" data-target="#modal-addproducto" data-toggle="modal" >  <button type="button"  class="btn btn-success" id="btnaddProduct" title="Agregar Producto" > <i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
												</span>
			                              	</div>
					</div>

					<div class="col-md-2">
											<div class="form-group">
											<label for="cantidad">Cantidad</label>
											<input  type="number" name="pcantidad" id="pcantidad" value="{{old('pcantidad')}}"  onkeyup="calPrecioTotal()" onKeyPress="return SoloNumeros(event)"  class="form-control" >
											</div>
					</div>
					<div class="col-md-2">
											<div class="form-group">
											<label for="pprecio_unitario">Precio Unitario ($)</label>
											<input  type="number" name="pprecio_unitario" id="pprecio_unitario" value="{{old('pprecio_unitario')}}"    onkeyup="calPrecioTotal()"  class="form-control" >
											</div>
					</div>
					<div class="col-md-2">
											<div class="form-group">
											<label for="descuento">Descuento (%)</label>
											<input  type="number" name="pdescuento" id="pdescuento" value="{{old('pdescuento')}}" onkeyup="calPrecioTotal()" onkeypress="return validateNumber(event)" min="0"  oninput="javascript: if (this.value.length > this.maxLength  ) this.value = this.value.slice(0, this.maxLength );" maxlength="2"  class="form-control"  >
											</div>
					</div>
					<div class="col-md-2">
											<div class="form-group">
											<label for="descuento">Iva (%)</label>
											<input  type="number" name="piva" id="piva"   value="{{old('piva')}}" onkeyup="calPrecioTotal()"  onkeypress="return validateNumber(event)" min="0"  oninput="javascript: if (this.value.length > this.maxLength  ) this.value = this.value.slice(0, this.maxLength );" maxlength="2"  class="form-control"  >
											</div>
					</div>			
					</div>





					<div class="col-md-12">
					<div class="col-md-2">
					</div>
									<div class="col-md-2">

														<div class="form-group">
															<label for="stock">Stock</label>
															<input  type="number" name="stock" id="pstock" value="{{old('stock')}}"   class="form-control" >
															</div>		
									</div>
									<div class="col-md-2">
														<div class="form-group">
															<label for="precio_compra">Precio Compra ($)</label>
															<input  type="number" name="pprecio_compra" id="pprecio_compra" value="{{old('pprecio_compra')}}"   class="form-control" >
															</div>
									</div>
									<div class="col-md-2">
															<div class="form-group">
															<label for="precio_venta">Precio Venta ($)</label>
															<input  type="number" name="pprecio_venta" id="pprecio_venta"  class="form-control" value="{{old('pprecio_venta')}}">
															</div>
									</div>	
									<div class="col-md-2">
															<div class="form-group">
															<label for="totalDescuento">Total Descuento ($)</label>
															<input  type="number" name="ptotalDescuento" id="ptotalDescuento"  class="form-control" value="{{old('ptotalDescuento')}}">
															</div>
									</div>	
									<div class="col-md-2">
															<div class="form-group">
															<label for="totalIva">Total Iva ($)</label>
															<input  type="number" name="ptotalIva" id="ptotalIva"  class="form-control" value="{{old('ptotalIva')}}">
															</div>
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
							 <th width="15%">Iva</th>
							 <th width="15%">Total</th>
                         </thead>

						 <tfoot>
						 <th style="font-weight:bold;color:orange;font-size:24px;">SUBTOTAL<br>
						 DESCUENTO<br>
						<!--  IVA -->
						 TOTAL
						</th>
						 <th></th>
						 <th></th>
						 <th></th>
						 <th></th>
						 <th></th>
						 <th style="font-weight:bold;color:orange;font-size:20px;">
							 <input id="total" name="subtotal"  readonly style="font-weight:bold;color:green;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00"><br>
							 <input id="pdescuentog" name="descuentop" readonly  style="font-weight:bold;color:blue;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00"><br>
							 <input id="pdescuentoporc" name="descuento_porcentajep" type="hidden"  style="font-weight:bold;color:blue;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00">				
							 <input id="ptotal" name="totalCompra"  readonly style="font-weight:bold;color:orange;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00">
							 <input id="pimpuesto" type="hidden" name="impuesto" readonly style="font-weight:bold;color:red;font-size:20px;background-color: white !important;" placeholder="$0.00">
							 <input id="pimpuestoporc"  name="impuesto_porcentaje" type="hidden" style="font-weight:bold;color:red;font-size:20px;background-color: white !important;" placeholder="$0.00">
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
@include('compras.ingreso.modal')
@push ('scripts')
 <script>
	 
function SoloNumeros(e) {

var key;

if (window.event) 
{
    key = e.keyCode;
}
else if (e.which) // Netscape/Firefox/Opera
{
    key = e.which;
}

if (key < 48 || key > 57 ) {
    return false;
}

return true;
}

$(window).on("load", function() {
	document.getElementById('pcantidad').disabled = true;
	document.getElementById('pdescuento').disabled = true;
	document.getElementById('pprecio_unitario').disabled = true;
	document.getElementById('piva').disabled = true;
	document.getElementById('pprecio_compra').disabled = true;
	document.getElementById('pprecio_venta').disabled = true;
	document.getElementById('pstock').disabled = true;
	document.getElementById('ptotalDescuento').disabled = true;
	document.getElementById('ptotalIva').disabled = true;
	$("#iddescripcomp").show();
	$("#idfacturadatos").hide();
    $("#idnotaventadatos").hide();
	
	var datadesc = $("#pdescuento").val();
	var dataivapro = $("#piva").val();
	var envioDataivapro =  parseFloat(dataivapro);
	var envioDatadesc =  parseFloat(datadesc);
	$("#pdescuento").val(envioDatadesc);
	$("#piva").val(envioDataivapro);
		$("#iddescuento_general").val(0); //inicio principal descuento
	$("#idiva_general").val(0);
	document.getElementById("idTotaldolar").innerHTML = "$0.00"; 
	});

	function changeComprobante(){
	var tipo = $("#idtipo").val();
	 console.log(tipo);
	 
		if(tipo == "NOTA DE VENTA"){
			$("#idnotaventadatos").show();
			$("#idfacturadatos").hide();
			$("#iddescripcomp").hide();
		}else if(tipo == "FACTURA") {
			$("#idfacturadatos").show();
			$("#idnotaventadatos").hide();
			$("#iddescripcomp").hide();
		}else if(tipo == ""){ 
		$("#idfacturadatos").hide();
			$("#idnotaventadatos").hide();
			$("#iddescripcomp").show();

		}
    }

/* 	function validateNumber(e) {
            const pattern = /^[0-9]$/;
            return pattern.test(e.key)
        } */

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
	document.getElementById('pdescuento').disabled = false;
	document.getElementById('piva').disabled = false;
	$("#pcantidad").val('');
	$("#pdescuento").val('');
	$("#piva").val('');
	$("#pprecio_unitario").val('');
	$("#pprecio_compra").val('');
	$("#pprecio_venta").val('');
	$("#ptotalDescuento").val('');
	$("#ptotalIva").val('');
	$("#pstock").val('');

	producto = $("#pid_producto").val();
	if(producto == ""){
		$("#pid_producto").val('');
		$("#pcantidad").val('');
		$("#pdescuento").val('');
		$("#pprecio_unitario").val('');
		$("#pprecio_compra").val('');
		$("#pprecio_venta").val('');
		$("#piva").val('');
		$("#ptotalDescuento").val('');
		$("#ptotalIva").val('');
		$("#pstock").val('');
	}else{
	datosArticulo=document.getElementById('pid_producto').value.split('_');
/* 	console.log(datosArticulo[2]) */

    $("#pdescuento").val(parseFloat(datosArticulo[1].replace(/\t|\n/g, '')));
	$("#piva").val(parseFloat(datosArticulo[2].replace(/\t|\n/g, '')));
	$("#pstock").val(parseFloat(datosArticulo[3].replace(/\t|\n/g, '')));
	}

}



function calPrecioTotal(){

	ivaporct = $("#piva").val();
	cantidad = $("#pcantidad").val();
    dscoporct = $("#pdescuento").val();

	descuentoValor = dscoporct/100;
	ivaproValor = ivaporct/100;
	pUnitario = $("#pprecio_unitario").val();
	totalCal = cantidad * pUnitario;
	descuento = totalCal * descuentoValor;
    ivaspro = totalCal * ivaproValor;
	totalCompr = totalCal + ivaspro - descuento;

	$("#ptotalDescuento").val(descuento);
	$("#ptotalIva").val(ivaspro);
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
	totalCompra = (total + iva - descuentoCalculo); 

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

var	dataconv = $("#pid_producto").val();
datosArticulo=dataconv.split('_');
var id_articulo = parseFloat(datosArticulo[0].replace(/\t|\n/g, ''));


var	articulo = $("#pid_producto option:selected").text();
var	cantidad = $("#pcantidad").val();
var precio_unitario = $("#pprecio_unitario").val();
var descuento = $("#pdescuento").val();
var	precio_compra = $("#pprecio_compra").val();
var	precio_venta = $("#pprecio_venta").val();
var piva = $("#piva").val();

var ingresoIva =  $("#idiva_general").val();  ///se incluira iva cero x ahora cambios
var ingresoDescuento = $("#iddescuento_general").val(); //se incluira iva cero x ahora cambios

	if (id_articulo!="" && cantidad!="" && cantidad>0 && pUnitario!="" &&  precio_compra!="" && pUnitario!=""  && precio_venta!=""){
   
	var descEnvio = descuento/100; //porcentaje desc /100
	var ivaEnvio = piva/100;  //porcentaje iva /100
    var compra = pUnitario * cantidad; // valor de compra
	var desc = compra * descEnvio;
    var contiva = compra * ivaEnvio;

     
	subtotal[cont]=(cantidad*pUnitario) + contiva - desc ;
	total=total+subtotal[cont];
	

	////CALCULO SUBTOTAL DESCUENTO IVA TOTAL
	descuentoporc = ingresoDescuento/100;
	descuentoCalculo = descuentoporc * total ;

	ivaCalculo = ingresoIva/100;
	iva = ivaCalculo * total ;
	totalCompra = (parseFloat(total) + iva - descuentoCalculo ); 


	$("#total").val(total);
	$("#pdescuentog").val(descuentoCalculo);
	$("#pdescuentoporc").val(ingresoDescuento);
	$("#pimpuestoporc").val(ingresoIva);
	$("#pimpuesto").val(iva);
	$("#ptotal").val(totalCompra);               

	var totalDol = new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'}).format(totalCompra);

	document.getElementById("idTotaldolar").innerHTML = totalDol;                                                                                                                                                                                                                                                                                                                                                                            
 
	var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger" onclick="eliminar('+cont+');" >X</button></td><td><input type="hidden" name="id_producto[]" value="'+id_articulo+'">'+articulo+'</td><td><input type="number" readonly name="cantidad[]" value="'+cantidad+'"></td> <td><input type="number" readonly name="precio_unitario[]" value="'+precio_unitario+'"></td><td><input type="hidden" readonly name="descuento_porcentaje[]" value="'+descuento+'"><input type="number" readonly name="descuento[]" value="'+desc+'"></td><td><input type="hidden" readonly name="iva_porcentajepro[]" value="'+piva+'"><input type="number" readonly name="ivapro[]" value="'+contiva+'"></td><td>'+subtotal[cont]+' </td><input type="hidden"  name="precio_compra[]" value="'+subtotal[cont]+'" ><input type="hidden"  name="precio_venta[]" value="'+precio_venta+'" > </tr>';

	cont++;
	$("#pid_producto").val("");
		$("#pcantidad").val("");
		$("#pdescuento").val("");
		$("#pprecio_unitario").val("");
		$("#pprecio_compra").val("");
		$("#pprecio_venta").val("");
		$("#piva").val("");
		$("#ptotalDescuento").val("");
		$("#ptotalIva").val("");
		$("#pstock").val("");
	
	evaluar();
	$("#detalles").append(fila);
  }else{
	  alert("Error al ingresar el detalle, revise los datos de los productos");

  }
}

total=0;

   function limpiar(){
	$("#pid_producto").val("");
		$("#pcantidad").val("");
		$("#pdescuento").val("");
		$("#pprecio_unitario").val("");
		$("#pprecio_compra").val("");
		$("#pprecio_venta").val("");
		$("#piva").val("");
		$("#ptotalDescuento").val("");
		$("#ptotalIva").val("");
		$("#pstock").val("");
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
	   var dataFin =  data + im - desc ;
	   $("#ptotal").val(dataFin);	  
	   $("#pdescuentoporc").val(ingresoIva);
	   $("#pimpuestoporc").val(ingresoDescuento);       
      
	   var totalDol = new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'}).format(dataFin);
	   document.getElementById("idTotaldolar").innerHTML = totalDol;   

	   $("#fila" + index).remove();
	   $("#idiva_general").val(0);
	   $("#iddescuento_general").val(0);
	   evaluar();
	   $("#pid_producto").val("");
		$("#pcantidad").val("");
		$("#pdescuento").val("");
		$("#pprecio_unitario").val("");
		$("#pprecio_compra").val("");
		$("#pprecio_venta").val("");
		$("#piva").val("");
		$("#ptotalDescuento").val("");
		$("#ptotalIva").val("");
		$("#pstock").val("");
	 }


 </script>
@endpush			
@endsection

