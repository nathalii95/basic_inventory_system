@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Producto: {{ $articulo->nombre}}</h3>
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
			{!!Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->id_producto],'files'=>'true'])!!}
            {{Form::token()}}

			@if(session()->has('message'))
			<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong> {{ session()->get('message') }}</strong> 
			</div>
			@endif

			<div class="row">
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre">Nombre Producto</label>
									<input type="text" name="nombre" required value="{{$articulo->nombre}}" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Nombre Producto...">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="codigo">Codigo Producto</label>
									<input type="text" name="codigo"  id="idcodigo" readonly value="{{$articulo->codigo}}" class="form-control" placeholder="Ingrese código del producto...">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="codigoexterno">Codigo Interno</label>
									<input type="text" name="codigoexterno"  value="{{$articulo->codigo_externo}}" id="codigoexternoid" onKeyPress="return SoloLetrasAndNumeros(event)" class="form-control" placeholder="Ingrese código externo del producto...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-2">
								<div class="form-group">
									<label for="marca">Marca</label>
									<input type="text" name="marca" style="text-transform:lowercase" value="{{$articulo->marca}}" class="form-control" placeholder="Ingrese Marca Producto...">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="color">Color</label>
									<input type="text" name="color" style="text-transform:lowercase"  value="{{$articulo->color}}" class="form-control" placeholder="Ingrese Color del producto...">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="modelo">Modelo</label>
									<input type="text" name="modelo" style="text-transform:lowercase"  value="{{$articulo->modelo}}" class="form-control" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="id_categoria">Categoría</label>
									<select name="id_categoria" required  class="form-control" style="text-transform:lowercase" >
										@foreach ($categorias as $cat)
											@if($cat->id_categoria==$articulo->id_categoria)
											<option value="{{$cat->id_categoria}}" selected>{{$cat->nombre}}</option>
											@else
											<option value="{{$cat->id_categoria}}">{{$cat->nombre}}</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="stock">Stock</label>
									<input type="text" name="stock" readonly value="{{$articulo->stock}}" class="form-control" placeholder="Ingrese stock del producto...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-3">
								<div class="form-group">
									<label for="is_impuesto">LLeva Iva</label><br>
									 @if($articulo->is_impuesto == "1")
									 <input class="form-check-input" type="checkbox"  id="checkif_iva" 	onchange="changeOtros()"  name="is_impuesto" checked>
											@else
											<input class="form-check-input" type="checkbox" id="checkif_iva" 	onchange="changeOtros()"  name="is_impuesto" >
											@endif

								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group ">
									<label for="impuesto_valor">Valor Iva</label>
									@if($articulo->is_impuesto == "0")
											<select name="impuesto_valor" disabled id="idimpuesto_valor" style=" top:15px;" class="form-control" onchange="changeOtros()" >									
											<!-- <option value="{{  intval($articulo->impuesto_valor) }}" >{{  intval($articulo->impuesto_valor) }}</option> -->
											@foreach ($impuesto as $imp)
											<option value="{{$imp->valor}}" >{{$imp->valor}}{{$imp->simbolo}}</option>
											@endforeach
											</select>
											
											@else
											<select name="impuesto_valor"  id="idimpuesto_valor" style=" top:15px;" class="form-control" onchange="changeOtros()" >									
											<!-- <option value="{{  intval($articulo->impuesto_valor) }}" >{{  intval($articulo->impuesto_valor) }}</option> -->
											@foreach ($impuesto as $imp)
											<option value="{{$imp->valor}}" >{{$imp->valor}}{{$imp->simbolo}}</option>
											@endforeach
											</select>
											@endif

								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group ">
									<label for="descuento">Descuento (%)</label>
									<input type="number" name="descuento"  id="idescuento"  style="top:15px;" value="{{intval($articulo->descuento)}}" onKeyPress="return SoloNumeros(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)" maxlength="3" class="form-control" placeholder="Ingrese Descuento...">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group ">
									<label for="precioC">Precio Compra ($)</label>
									@if($extra->precio_u != 0)
									<input type="text"  id="idprecioC"  style=" top:15px;" value="{{$extra->precio_u}}" readonly  class="form-control" placeholder="Precio">
									@else 
									<input type="text"  id="idprecioC"  style=" top:15px;" value="" readonly  class="form-control" placeholder="Precio">
									@endif
								
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group ">
									<label for="precioC">Precio Venta ($)</label>
									@if($extra->precio_v != 0)
									<input type="text"  id="idprecioV"  style=" top:15px;" value="{{$extra->precio_v}}" readonly  class="form-control" placeholder="Precio">
									@else 
									<input type="text"  id="idprecioV"  style=" top:15px;" value="" readonly  class="form-control" placeholder="Precio">
									@endif
								
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
								<div class="form-group ">
									<label for="proveedor">Proveedor</label>
									<input type="text"  id="idproveedor"  value="{{$extra->ultimo_prov}}" style="text-transform:uppercase" class="form-control" readonly class="form-control" placeholder="Proveedor" >
								</div>
								<div class="form-group">
									<label for="descripcion">Descripción</label>
									<textarea type="text" name="descripcion"  style="text-transform:uppercase" class="form-control" placeholder="Ingrese descripción del producto...">{{$articulo->descripcion}}</textarea>
								</div>
						</div> 
							
			</div>
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="imagen">Imagen</label>
									<input type="file" name="imagen"  class="form-control">
									@if(($articulo->imagen)!="")
                                      <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" height="300px" width="300px">
									@endif
								</div>
							</div>				
			</div>
			<div class="col-md-12">
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
			<a href="{{URL::action('ArticuloController@index')}}"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>
						
@push ('scripts')
 <script>

/* $(window).on("load", function() {
		document.getElementById("idimpuesto_valor").disabled = true;


});
 */
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


function changeOtros() {
 var data = document.getElementById('checkif_iva').checked
if (data == true) {
	document.getElementById("idimpuesto_valor").disabled = false;
} else {
	document.getElementById("idimpuesto_valor").disabled = true;
	$("#idimpuesto_valor").val("");
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

</script>
@endpush
@endsection