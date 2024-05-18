@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Venta</h3>
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
			{!!Form::open(array('url'=>'ventas/ventas','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    
	<div class="row">
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="id_cliente">Cliente</label>
									<select name="id_cliente"  id="idcliente" value="{{old('id_cliente')}}" required
									 class="form-control selectpicker" data-live-search="true" >
									<option value="" >Seleccione Cliente</option>
									@foreach ($clientes as $cli)
										<option value="{{$cli->id_cliente}}" >{{$cli->nombre}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="tipo_comprobante">Tipo Comprobante</label>
									<select name="tipo_comprobante" required onchange="changeComprobante()"	 class="form-control" id="idtipo"  value="{{old('tipo_comprobante')}}" >
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
									<label for="num_comprobante">N° Comprobante</label>
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
									<label for="num_comprobante">N° Comprobante</label>
									<input type="text" name="num_comprobante" id="idnumero"    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" value="{{$countVenta}}" readonly class="form-control" placeholder="000000000">
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
									<label for="num_comprobante">N° Comprobante</label>
									<input type="text" name="num_comprobante" id="idnumeronv"    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" value="{{$countCompranv}}" readonly class="form-control" placeholder="000000000">
								</div>
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
									<label for="fecha">Fecha Venta</label>
									<input  type="date" name="fecha" id="idfecha"  value="<?php echo date('Y-m-d', strtotime($f_emsion)) ?>"  class="form-control" >
								</div>
							</div>		
			</div>
			<div class="col-md-12">
			                <div class="col-md-3">
							</div>
							<div class="col-md-3">
							<input  type="hidden" name="fecha_caducidad"  id="idfecha_caducidad" value="<?php echo date('Y-m-d', strtotime($f_caducidad)) ?>" class="form-control" >
							</div>
							<input  type="hidden" name="iva_general" id="idiva_general" value="0"  class="form-control"   >
							<input  type="hidden" name="descuento_general" id="iddescuento_general" value="0"  class="form-control" >
							<div class="col-md-6">
											<div class="form-group">
											<label>Total Valor</label>
											<h1 style="color:orange;margin-top:10px;" id="idTotaldolar"  ></h1>
											</div>
				            </div>
							<!-- <div class="col-md-3">
								<div class="form-group">
									<label for="iva_general">IVA %</label>
									<input  type="number" name="iva_general" id="idiva_general"  value="{{old('iva_general')}}" class="form-control"  onkeypress="return validateNumber(event) " >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="descuento_general">DESCUENTO %</label>
									<input  type="number" name="descuento_general" id="iddescuento_general"  value="{{old('descuento_general')}}"class="form-control"  onkeypress="return validateNumber(event) " >
								</div>
							</div>   -->
			</div>

			
			<!-- <div class="col-md-12">

                
				<div class="col-md-6">
											<div class="form-group">
											<label>Total Valor</label>
											<h1 style="color:orange;margin-top:10px;" id="idTotaldolar"  ></h1>
											</div>
				</div>
			</div> -->
</div>


<div class="row">
        <div class="col-md-12">			
			<div class="panel panel-primary">
				<div class="panel-body">
				    <div class="col-md-12">
											<div class="form-group">
											<button type="button" id="btn_add" class="btn btn-success" > <i class="fa fa-plus-circle" aria-hidden="true"></i>  AGREGAR</button >
											</div>
					</div>
					<div class="col-md-4">
					                        <label for="id_producto">Producto</label>
											<!-- <div class="input-group">
												<select name="pid_producto"  id="pid_producto" requiered
												class="form-control selectpicker selectProduct" data-live-search="true" >
												<option value="" >Seleccione Producto</option>
												@foreach ($articulos as $articulo)
													<option value="{{$articulo->id_producto}}_
													{{$articulo->stock}}_ {{$articulo->precio_promedio}}_{{$articulo->descuento}}_{{$articulo->impuesto_valor}}" >{{$articulo->articulo}}</option>
												@endforeach
												</select>
				                                 <span class="input-group-btn">
				                                 <a href="" data-target="#modal-addproductov" data-toggle="modal" >  <button type="button"  class="btn btn-success" id="btnaddProductv" title="Agregar Producto" > <i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
												</span>
			                              	</div> -->
											  <div class="form-group">
											  <select name="pid_producto"  id="pid_producto" requiered
												class="form-control selectpicker selectProduct" data-live-search="true" >
												<option value="" >Seleccione Producto</option>
												@foreach ($articulos as $articulo)
													<option value="{{$articulo->id_producto}}_{{$articulo->stock}}_{{$articulo->precio_v}}_{{$articulo->descuento}}_{{$articulo->impuesto_valor}}" >{{$articulo->articulo}}</option>
												@endforeach
												</select>											
											     </div>
					</div>

					<div class="col-md-2">
											<div class="form-group">
											<label for="cantidad">Cantidad</label>
											<input  type="number" name="pcantidad" id="pcantidad" value="{{old('pcantidad')}}" onkeyup="calPrecioTotal()" onKeyPress="return SoloNumeros(event)" class="form-control" >
											</div>
					</div>

					<div class="col-md-2">
											<div class="form-group">
											<label for="stock">Stock</label>
											<input  type="number" readonly name="ptock" id="pstock" value="{{old('pstock')}}"   class="form-control"   >
											</div>
					</div>
					<div class="col-md-2">
											<div class="form-group">
											<label for="pdescuento">Descuento (%)</label>
											<input  type="number" readonly name="pdescuento" id="pdescuento"  class="form-control" onkeyup="calPrecioTotal()" value="{{old('pdescuento')}}">
											</div>
					</div>
					<div class="col-md-2">
											<div class="form-group">
											<label for="piva">Iva (%)</label>
											<input  type="number" readonly name="piva" id="piva"  class="form-control" onkeyup="calPrecioTotal()" value="{{old('piva')}}">
											</div>
					</div>
					<div class="col-md-6">
					</div>
					<div class="col-md-2">
											<div class="form-group">
											<label for="precio_venta">Precio Venta ($)</label>
											<input  type="number"  readonly name="pprecio_venta" id="pprecio_venta" class="form-control" value="{{old('pprecio_venta')}}">
											</div>
					</div>
					<div class="col-md-2">
															<div class="form-group">
															<label for="totalDescuento">Total Descuento ($)</label>
															<input  type="number" readonly name="ptotalDescuento" id="ptotalDescuento"   class="form-control" value="{{old('ptotalDescuento')}}">
															</div>
					</div>	
					<div class="col-md-2">
															<div class="form-group">
															<label for="totalIva">Total Iva ($)</label>
															<input  type="number" readonly name="ptotalIva" id="ptotalIva"  class="form-control" value="{{old('ptotalIva')}}">
															</div>
					</div>	


					<div class="col-md-12">
						<table id="detalles" style="overflow-x:scroll; display:block" class="table table-responsive table-warning table-striped table-bordered table-condensed table-hover">
						 <thead width="100%" style="background-color:#F59B20;color:white;" class="text-center">
							 <th width="15%" >Opciones</th>
							 <th width="25%">Producto</th>
							 <th width="15%">Cantidad</th>
							 <th width="15%">Precio Venta</th>
							 <th width="15%">Descuento</th>
							 <th width="15%">Iva</th>
							 <th width="15%">Total</th>
							 <!-- <th width="15%"></th> -->
                         </thead>

						 <tfoot>

						 <th style="font-weight:bold;color:orange;font-size:24px;">SUBTOTAL<br>
<!-- 						 DESCUENTO<br> 
						 IVA<br> -->
						 TOTAL
						</th>
						 <th></th>
						 <th></th>
						 <th></th>
						 <th></th>
						 <th></th>
						 <th style="font-weight:bold;color:orange;font-size:20px;">
						 <input id="total" name="subtotal"  readonly style="font-weight:bold;color:green;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00"><br>
							 <input id="total_venta" name="total_venta"  readonly style="font-weight:bold;color:orange;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00">
							 <input id="pdescuentog" name="descuentop" type="hidden" readonly style="font-weight:bold;color:blue;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00"><br>
						 <input id="pdescuentoporc" name="descuento_porcentajep" type="hidden"  style="font-weight:bold;color:blue;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00">				
						 <input id="pimpuesto" name="impuesto" type="hidden" readonly style="font-weight:bold;color:red;font-size:20px;background-color: white !important;" placeholder="$0.00">
						 <input id="pimpuestoporc" name="impuesto_porcentaje" type="hidden" style="font-weight:bold;color:red;font-size:20px;background-color: white !important;" placeholder="$0.00"><br>
						<!-- <input id="ptotal" name="totalCompra"  readonly style="font-weight:bold;color:orange;font-size:20px;background-color: white !important;border: 0 !important;" placeholder="$0.00">-->
							</th>
                         </tfoot>

						</table>
		  	        </div> 

				</div>
			</div>
		</div>
		<div class="col-md-12" id="gua rdar" >
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
			<a href="../ventas"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>	

			
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
	var datadesc = $("#pdescuento").val();
	var envioDatadesc =  parseFloat(datadesc);
	$("#pdescuento").val(envioDatadesc);
	var dataivapro = $("#piva").val();
	var envioDataivapro =  parseFloat(dataivapro);
	$("#piva").val(envioDataivapro);
	$("#iddescuento_general").val(0);
	$("#idiva_general").val(0);
	document.getElementById("idTotaldolar").innerHTML = "$0.00"; 
	$("#iddescripcomp").show();
	$("#idfacturadatos").hide();
    $("#idnotaventadatos").hide();
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
	producto = $("#pid_producto").val();
	$("#pcantidad").val('');
	$("#pdescuento").val('');
	$("#pprecio_unitario").val('');
	$("#pprecio_compra").val('');
	$("#pprecio_venta").val('');
	$("#ptotalDescuento").val('');
	$("#ptotalIva").val('');
	$("#piva").val('');

	if(producto == ""){
		$("#pid_producto").val('');
		$("#pcantidad").val('');
		$("#pstock").val('');
		$("#pprecio_venta").val('');
		$("#pdescuento").val('');
		$("#ptotalDescuento").val('');
		$("#ptotalIva").val('');
		$("#piva").val('');
	}else{
	datosArticulo=document.getElementById('pid_producto').value.split('_');
console.log(datosArticulo)
	$("#pstock").val(datosArticulo[1].replace(/\t|\n/g, ''));
	$("#pprecio_venta").val(parseFloat(datosArticulo[2]).toFixed(2));
	$("#pdescuento").val(parseFloat(datosArticulo[3].replace(/\t|\n/g, '')));
	$("#piva").val(parseFloat(datosArticulo[4].replace(/\t|\n/g, '')));
	}
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
	totalCompra = (total + iva - descuentoCalculo ); 

	$("#pdescuentog").val(descuentoCalculo);
	$("#pdescuentoporc").val(descuentoporc);
	$("#pimpuestoporc").val(ingresoIva);
	$("#pimpuesto").val(iva);
	$("#total_venta").val(totalCompra);    
	var totalDol = new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'}).format(totalCompra);
	document.getElementById("idTotaldolar").innerHTML = totalDol;      


 
}

function calPrecioTotal(){

	
	cantidad = $("#pcantidad").val();
	ivaporct = $("#piva").val();
    dscoporct = $("#pdescuento").val();

	descuentoValor = dscoporct/100;
	ivaproValor = ivaporct/100;
		precio_venta = $("#pprecio_venta").val();
	totalCal = cantidad * precio_venta;
	descuento = totalCal * descuentoValor;
    ivaspro = totalCal * ivaproValor;


	$("#ptotalDescuento").val(descuento);
	$("#ptotalIva").val(ivaspro);


}

function agregar(){

	datosArticulo=document.getElementById('pid_producto').value.split('_');

var iva;
var ivaCalculo;
var totalCompra;
var descuentoporc;
var descuentoCalculo;

var	id_articulo = 	datosArticulo[0];
var	articulo = $("#pid_producto option:selected").text();
var	cantidad = $("#pcantidad").val();
var descuento = $("#pdescuento").val();

var	precio_venta = $("#pprecio_venta").val();
var	stock = $("#pstock").val();
var piva = $("#piva").val();

var ingresoIva = $("#idiva_general").val();
var ingresoDescuento = $("#iddescuento_general").val();

	if (id_articulo!="" && cantidad!="" && cantidad >0  && precio_venta!=""){


		if((Number(stock))>=(Number(cantidad))){

	var descEnvio = descuento/100; //porcentaje desc /100
	var ivaEnvio = piva/100;  //porcentaje iva /100
    var venta = cantidad * precio_venta; // valor de ven
	var desc = venta * descEnvio;
	var contiva = venta * ivaEnvio;

	subtotal[cont]=(cantidad*precio_venta + contiva - desc)  //-descuento iva
	total=total+subtotal[cont];



	////CALCULO SUBTOTAL DESCUENTO IVA TOTAL
	descuentoporc = ingresoDescuento/100;
	descuentoCalculo = descuentoporc * total ;

	ivaCalculo = ingresoIva/100;
	iva = ivaCalculo * total ;
	totalCompra = (parseFloat(total) + iva - descuentoCalculo); 

	$("#total").val(total);
	$("#pdescuentog").val(descuentoCalculo);
	$("#pdescuentoporc").val(ingresoDescuento);
	$("#pimpuestoporc").val(ingresoIva); 
	$("#pimpuesto").val(iva);
	$("#total_venta").val(totalCompra);


 
	var totalDol = new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'}).format(totalCompra);
    document.getElementById("idTotaldolar").innerHTML = totalDol;                                                                                                                                                                                                                                                                                                                                                                            


	var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger" onclick="eliminar('+cont+');" >X</button></td><td><input type="hidden" name="id_producto_cab[]" value="'+id_articulo+'">'+articulo+'</td><td><input type="number" readonly name="cantidad[]" value="'+cantidad+'"></td><td><input type="number"  name="precio_venta[]" value="'+precio_venta+'" readonly></td> <td><input type="hidden"  name="descuento_porcentaje[]" value="'+descuento+'" readonly><input type="number"  name="descuento[]" value="'+desc+'" readonly></td><td><input type="hidden" readonly name="iva_porcentajepro[]" value="'+piva+'"><input type="number" readonly name="ivapro[]" value="'+contiva+'"></td><td>'+subtotal[cont]+' </td> <input type="hidden"  name="total[]" value="'+subtotal[cont]+'" readonly></td> </tr>';
	cont++;
    limpiar();
	/* $("#total").val(total); */
	/* $("#total_venta").val(total); */
	evaluar();
	$("#detalles").append(fila);
		}else{
			alert("Cantidad a vender supera al stock");
		}

  
  }else{
	  alert("Error al ingresar el detalle, revise los datos de los productos");

  }
}

total=0;

function limpiar(){
 $("#pcantidad").val("");
 $("#pdescuento").val("");
 $("#pprecio_venta").val("");
 $("#pstock").val("");
 $("#piva").val("");
		$("#ptotalDescuento").val("");
		$("#ptotalIva").val("");
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
	  /*  $("#total_venta").val(total); */
	  var dataIva = ingresoIva/100;
      var descuentoCalculo = ingresoDescuento/100;

	   $("#pimpuesto").val(total * dataIva);
	   $("#pdescuentog").val(total * descuentoCalculo);

	   var data = total;
       var im = total * dataIva;
	   var desc = total * descuentoCalculo;
	   var dataFin =  data + im - desc;
	   $("#total_venta").val(dataFin);	  
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

