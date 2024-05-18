<div class="modal fade bd-example-modal-lg" aria-hidden="true"role="dialog" tabindex="-1" id="modal-addproducto"  >
	    <div class="modal-dialog modal-lg">
			<form id="form" > 
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onClick="close1()"
					aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Nuevo Producto</h4>
				</div>
			    <div class="modal-body">
						<div class="row">
							<div class="col-md-12">
											<div class="col-md-6">
												<div class="form-group">
													<label for="nombre">Nombre Producto</label>
													<input type="text" name="nombre" id="nombreid" required style="text-transform:uppercase"  class="form-control" placeholder="Ingrese Nombre Producto...">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="codigo">Codigo Producto</label>
													<input type="text" name="codigo" required  id="codigoid" onKeyPress="return SoloLetrasAndNumeros(event)" class="form-control" placeholder="Ingrese código del producto...">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="codigoexterno">Codigo Interno</label>
													<input type="text" name="codigoexterno"  id="codigoexternoid" onKeyPress="return SoloLetrasAndNumeros(event)" class="form-control" placeholder="Ingrese código externo del producto...">
												</div>
											</div>
							</div>
							<div class="col-md-12">
											<div class="col-md-2">
												<div class="form-group">
													<label for="marca">Marca</label>
													<input type="text" name="marca" id="marcaid" style="text-transform:lowercase;" required  class="form-control" placeholder="Ingrese Marca Producto...">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label for="color">Color</label>
													<input type="text" name="color" onKeyPress="return soloLetras(event)" style="text-transform:lowercase;" required id="colorid" class="form-control" placeholder="Ingrese Color del producto...">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label for="modelo">Modelo</label>
													<input type="text" name="modelo" id="modeloid" style="text-transform:lowercase;"  class="form-control" placeholder="Ingrese Modelo del producto...">
												</div>
											</div>
											<!-- <div class="col-md-3">
												<div class="form-group">
													<label for="id_categoria">Categoría</label>
													<select name="categoria" id="categoriaid" required  class="form-control" >
													<option value="" >Seleccione Categoría</option>
														@foreach ($categorias as $cat)
														<option value="{{$cat->id_categoria}}" >{{$cat->nombre}}</option>
														@endforeach
													</select>
												</div>
											</div> -->

											<div class="col-md-3">
												<label for="id_producto">Categoría</label>
												<div class="input-group">
											    	<select name="categoria" id="categoriaid" required  class="form-control" >
														<option value="" >Seleccione Categoría</option>
														@foreach ($categorias as $cat)
														<option value="{{$cat->id_categoria}}" >{{$cat->nombre}}</option>
														@endforeach
													</select>
													<span class="input-group-btn">
													<a href="" data-target="#modal-addcategoria" data-toggle="modal" >  <button type="button"  class="btn btn-success" id="btnaddCategoria" title="Agregar Categoria" > <i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
													</span>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="stock">Stock</label>
													<input type="number" name="stock" id="stockid" required value="0" min="0" onKeyPress="return SoloNumeros(event)" 
													class="form-control" placeholder="Ingrese stock del producto...">
												</div>
											</div>
							</div>
							<div class="col-md-12">
											<div class="col-md-3">
												<div class="form-group">
													<label for="is_impuesto">Lleva Iva</label><br>
													<input type="checkbox" name="is_impuesto"  class="switch-input" id="checkif_iva" 
													onchange="changeOtros()" >
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group ">
													<label for="impuesto_valor">Valor Iva (%)</label>
													<select name="impuesto_valor"   id="idimpuesto_valor" style=" top:15px;"  class="form-control" >
														<option value="" >Seleccione Iva</option>
														@foreach ($impuesto as $imp)
															<option value="{{$imp->valor}}" >{{$imp->valor}}{{$imp->simbolo}}</option>
														@endforeach
															
													</select>

												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group ">
													<label for="descuento">Descuento (%)</label>
													<input type="number" name="descuento" id="descuentoid"  min="0" onKeyPress="return SoloNumeros(event)"  oninput="javascript: if (this.value.length > this.maxLength  ) this.value = this.value.slice(0, this.maxLength );" maxlength="3"  
													style=" top:15px;"  class="form-control" placeholder="Ingrese Descuento...">
												</div>
											</div>
										
							</div>

							<div class="col-md-12">
											<div class="col-md-6" >
											<h5 style="color:#e9873e;font-weight:bold;border: 1px solid #e9873e;">Tablita de Iva</h5>
												<div class="table-responsive"  style="border: 1px solid #e9873e;" >
													<table class="table table-bordered table-hover">
														<thead class="bg-warning text-center "  >
															<th>Nombre</th>
															<th>Tipo</th>
															<th>Valor</th>
														</thead>
														@foreach ($impuesto as $cat)
														<tr>
															<td>{{ $cat->nombre_impuesto}}</td>
															<td>{{ $cat->tipo}}-{{ $cat->tipo_impuesto}}</td>
															<td class="text-right" >{{ $cat->valor}} {{ $cat->simbolo}}</td>
														</tr>
														@endforeach
													</table>
												</div>
											</div>	
											<div class="col-md-6">
												<div class="form-group">
													<label for="imagen">Imagen</label>
													<input type="file" name="imagen" id="imagenid"  class="form-control">
												</div>
												<div class="form-group">
													<label for="descripcion">Descripción</label>
													<textarea put type="text" name="descripcion" id="descripcionid" class="form-control" placeholder="Ingrese descripción del producto..."></textarea>
												</div>
											</div>				
						    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" onClick="close1()">Cerrar</button>
				<button class="btn btn-primary" id="guardarpro" type="submit">Guardar</button>
			</div>
</form>
		</div>
	</div>

	<div class="modal fade bd-example-modal-lg" aria-hidden="true" role="dialog" tabindex="-1" id="modal-addcategoria"  >
	    <div class="modal-dialog modal-lg modal-dialog-centered">
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onClick="close2()"
					aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Nuevo Categoría</h4>
				</div>
			    <div class="modal-body">
						<div class="row">
							<div class="col-md-12">
											<div class="col-md-6">
												<div class="form-group">
													<label for="categoria">Nombre Categoría</label>
													<input type="text" name="categoria" id="idcategoria" style="text-transform:uppercase"  required class="form-control" placeholder="Ingrese Nombre Categoria...">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="descripcion">Descripción</label>
													<textarea type="number" name="descripcion" id="iddescripcion" 
                                                     class="form-control" placeholder="Ingrese Descripción..."></textarea>
												</div>
											</div>		
							</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" onClick="close2()">Cerrar</button>
				<button class="btn btn-primary" id="guardarcate" >Guardar</button>
			</div>
		</div>
	</div>
	
@push ('scripts')
 <script>

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toString();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ"; //Se define todo el abecedario que se quiere que se muestre.
    especiales = [8, 37, 39, 46, 6]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

    tecla_especial = false;
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        /*    alert('Tecla numerica no aceptada'); */
        return false;
    }
}

function close1(){
	$('#modal-addproducto').modal('hide');
}

function limpiar(){
     	$("#nombreid").val("");
		$("#codigoid").val("");
		$("#codigoexternoid").val("");
		$("#marcaid").val("");
		$("#colorid").val("");
		$("#modeloid").val("");
		$("#categoriaid").val("");
		$("#stockid").val("");
		$("#descuentoid").val("");
		$("#idimpuesto_valor").val("");
		$("#imagenid").val("");
		$("#descripcionid").val("");
		document.getElementById('checkif_iva').checked =false;
}

$('#btnaddProduct').click(function(){
	document.getElementById("idimpuesto_valor").disabled = true;
	document.getElementById('checkif_iva').checked =false;
	limpiar();
});

var nameImagen;
const fileSelector = document.getElementById('imagenid');
  fileSelector.addEventListener('change', (event) => {
    const fileList = event.target.files;
	nameImagen = fileList[0].name; 	 
  });

  $(document).ready(function (){
$("#form").on('submit',(function(e){
        e.preventDefault();
		var formElement = document.getElementById("form");
		var formData = new FormData(formElement);
		var formElement = document.getElementById("imagenid");
		formData.append("imagen", formElement.files[0]);
		
        $.ajax({
			headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
			url: "/saveNewProduct",
            type: "POST",
            data:formData,
            contentType: false,
            cache: false,
            processData:false,
			success:function(data){
			if(data.length > 0){
				setTimeout(function() {
					toastr.success("Guardado Exitoso");
					$('#modal-addproducto').modal('hide');

					var tipoId = $("#pid_producto");
					tipoId.find('option').remove();
					tipoId.append('<option value="0">Seleccione Producto</option>');
					$(data).each(function(i, v) {
						tipoId.append('<option id="pid_producto"  value="' + v.id_producto + '_' + v.descuento + '_' + v.impuesto_valor + '_' + v.stock + '">' + v.codigo + " " + v.nombre + '</option>');
					});

					$('#pid_producto').selectpicker('refresh'); 
			    }, 500);

			}else if (data == false){
				toastr.error("Error al guardar");
				limpiar();
			}
		},
		error: function(data, status, error) {
			toastr.error(data + " - " + status + " - " + error);
		}
        });
    }));});


function changeOtros() {
 var data = document.getElementById('checkif_iva').checked;
	if (data == true) {
		document.getElementById("idimpuesto_valor").disabled = false;
		$("#idimpuesto_valor").val("");

	} else {
		document.getElementById("idimpuesto_valor").disabled = true;
	} 
}


function SoloLetrasAndNumeros(letranum) {
tecla = (document.all) ? letranum.keyCode : letranum.which;
//Tecla de retroceso para borrar, y espacio siempre la permite
if (tecla == 8 || tecla == 32) {
    return true;
}
// Patrón de entrada
patron = /[A-Za-z0-9]/;
tecla_final = String.fromCharCode(tecla);
return patron.test(tecla_final);

}

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

$('#codigoid').on('change',function(){
	
	var id = $("#codigoid").val();
		$.ajax({
		type:'GET',
		dataType:'json',
		url:'{{route("change.codigovalart")}}',  /* change.statusp */
		data:{'id':id},
		success:function(data){

		if (data.length != 0) {
			let autFocus = $("#codigoid").focus();
				toastr.error("Codigo ya registrado");
				$("#codigoid").val('');
					} 
		}
		
	});
});

$('#codigoexternoid').on('change',function(){
	
	var id = $("#codigoexternoid").val();
		$.ajax({
		type:'GET',
		dataType:'json',
		url:'{{route("change.codigoextvalart")}}', /* change.statusp */
		data:{'id':id},
		success:function(data){
		if (data.length != 0) {
			let autFocus = $("#codigoexternoid").focus();
				toastr.error("Codigo externo ya registrado");
				$("#codigoexternoid").val("");
					} 
		}
	});
});


///MODAL TWO
function close2(){
	$('#modal-addcategoria').modal('hide');
}

function limpiar2(){
     	$("#idcategoria").val("");
		$("#iddescripcion").val("");
}

$('#btnaddCategoria').click(function(){
	limpiar2();
});


$('#guardarcate').click(function(){

var categoria   = $("#idcategoria").val(); 
var descripcion  = $("#iddescripcion").val(); 

if(categoria == "" || categoria == null){
	toastr.error("Campo Obligatorio, Ingrese Nombre Categoría");
}else{
	guardaDato();
}

});

function guardaDato(){
	var categoria   = $("#idcategoria").val(); 
    var descripcion  = $("#iddescripcion").val(); 

	data = {
		categoria: categoria ,
		descripcion: descripcion == "" ? null : descripcion ,
      
    };
	$.ajax({
		type:'GET',
			dataType:'json',
			url:'{{route("save.saveNewCategoria")}}', 
			data:data,
			success:function(data){
			if(data.length > 0){
				setTimeout(function() {
					toastr.success("Guardado Exitoso");
					$('#modal-addcategoria').modal('hide');

					var tipoId = $("#categoriaid");
					tipoId.find('option').remove();
					tipoId.append('<option value="0">Seleccione Categoria</option>');
					$(data).each(function(i, v) {
						tipoId.append('<option id="categoriaid"  value="' + v.id_categoria + '">'+ v.nombre + '</option>');
					});



					$('#categoriaid').selectpicker('refresh'); 
			    }, 500);

			}else if (data == false){
				toastr.error("Error al guardar");
				limpiar2();
			}
		},
		error: function(data, status, error) {
			toastr.error(data + " - " + status + " - " + error);
		} 
        });
}

</script>
@endpush
</div>