@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Producto</h3>
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
	
			{!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}

	<div class="row">
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre">Nombre Producto</label>
									<input type="text" name="nombre" required value="{{old('nombre')}}" style="text-transform:uppercase"  class="form-control" placeholder="Ingrese Nombre Producto...">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="codigo">Codigo Producto</label>
									<input type="text" name="codigo" required value="{{old('codigo')}}" id="codigoid" onKeyPress="return SoloLetrasAndNumeros(event)" class="form-control" placeholder="Ingrese código del producto...">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="codigoexterno">Codigo Interno</label>
									<input type="text" name="codigoexterno"  value="{{old('codigoexterno')}}" id="codigoexternoid" onKeyPress="return SoloLetrasAndNumeros(event)" class="form-control" placeholder="Ingrese código externo del producto...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-2">
								<div class="form-group">
									<label for="marca">Marca</label>
									<input type="text" name="marca" style="text-transform:lowercase;"  required value="{{old('marca')}}" class="form-control" placeholder="Ingrese Marca Producto...">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="color">Color</label>
									<input type="text" name="color" style="text-transform:lowercase;" required value="{{old('color')}}" class="form-control" placeholder="Ingrese Color del producto...">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="modelo">Modelo</label>
									<input type="text" name="modelo" style="text-transform:lowercase" value="{{old('modelo')}}" class="form-control" placeholder="Ingrese Modelo del producto...">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="id_categoria">Categoría</label>
									<select name="id_categoria" required value="{{old('id_categoria')}}" style="text-transform:lowercase" class="form-control" >
									<option value="" >Seleccione Categoría</option>
									    @foreach ($categorias as $cat)
										<option value="{{$cat->id_categoria}}" >{{$cat->nombre}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="stock">Stock</label>
									<input type="number" name="stock" required value="0" min="0" onKeyPress="return SoloNumeros(event)" class="form-control" placeholder="Ingrese stock del producto...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
			                <div class="col-md-3">
								<div class="form-group">
									<label for="is_impuesto">Lleva Iva</label><br>
								<!-- 	<input class="form-check-input" type="checkbox" name="is_impuesto" id="checkif_iva"     > -->
									<input type="checkbox" name="is_impuesto" class="switch-input" id="checkif_iva" 	onchange="changeOtros()" value="1" {{ old('is_impuesto') ? 'checked="checked"' : '' }}>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group ">
									<label for="impuesto_valor">Valor Iva (%)</label>
									 <select name="impuesto_valor"  id="idimpuesto_valor" style=" top:15px;"  value="{{old('impuesto_valor')}}"  class="form-control" >
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
									<input type="number" name="descuento" id="idescuento"  min="0" onKeyPress="return SoloNumeros(event)"  oninput="javascript: if (this.value.length > this.maxLength  ) this.value = this.value.slice(0, this.maxLength );" maxlength="3"    style="top:15px;" value="{{old('descuento')}}" class="form-control" placeholder="Ingrese Descuento...">
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
									<input type="file" name="imagen"  class="form-control">
								</div>
								<div class="form-group">
									<label for="descripcion">Descripción</label>
									<textarea put type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" style="text-transform:uppercase" placeholder="Ingrese descripción del producto..."></textarea>
								</div>
							</div>				
			</div>
			<div class="col-md-12" style="margin-top:15px;"   >
							<div class="col-md-6">
										<div class="form-group">
												<button class="btn btn-primary" type="submit">Guardar</button>
												<button class="btn btn-danger" type="reset">Limpiar</button>
										</div>
							</div>
			</div>
</div>
		{!!Form::close()!!}	
			<div class="form-group col-md-3">
			<a href="../articulo"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>
			
@push ('scripts')
 <script>
	$(window).on("load", function() {
		document.getElementById("idimpuesto_valor").disabled = true;


});

function changeOtros() {
 var data = document.getElementById('checkif_iva').checked
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
/* 	$('.message').html('<p class="alert alert-danger" >'+data.success+'</p>'); */

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
	url:'{{route("change.codigoextvalart")}}',  /* change.statusp */
	data:{'id':id},
	success:function(data){
/* 	$('.message').html('<p class="alert alert-danger" >'+data.success+'</p>'); */
	if (data.length != 0) {
		let autFocus = $("#codigoexternoid").focus();
			toastr.error("Codigo externo ya registrado");
			$("#codigoexternoid").val('');
				} 
	}
});
});


</script>
@endpush  
@endsection