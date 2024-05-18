@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente: {{ $cliente->nombre}}</h3>
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
			{!!Form::model($cliente,['method'=>'PATCH','route'=>['ventas.cliente.update',$cliente->id_cliente]])!!}
            {{Form::token()}}

			<div class="row">
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="tipo_documento">Tipo Documento</label>
									<select name="tipo_documento" required class="form-control" id="document" >


									@if($cliente->tipo_documento == "")
									<option value="" selected>Seleccione Tipo Documento</option> 
									<option value="Ruc" >Ruc</option>
									<option value="Cédula" >Cédula</option>
									<option value="Pasaporte" >Pasaporte</option>
											@elseif($cliente->tipo_documento == "Ruc")
									<option value="" >Seleccione Tipo Documento</option> 
									<option value="Ruc" selected>Ruc</option>
									<option value="Cédula" >Cédula</option>
									<option value="Pasaporte" >Pasaporte</option>
									@elseif($cliente->tipo_documento == "Cédula")
									<option value="" >Seleccione Tipo Documento</option> 
									<option value="Ruc" >Ruc</option>
									<option value="Cédula" selected>Cédula</option>
									<option value="Pasaporte" >Pasaporte</option>
											@else
									<option value="" >Seleccione Tipo Documento</option> 
									<option value="Ruc" >Ruc</option>
									<option value="Cédula" >Cédula</option>
									<option value="Pasaporte" selected>Pasaporte</option>
											@endif
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="num_documento">N° Documento </label>
									<input type="text" name="num_documento" required 
									value="{{$cliente->num_documento}}" class="form-control" id="docNumber"   placeholder="Ingrese Identificación ...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label for="nombre">Nombre</label>
									<input type="text" name="nombre" required  id="idnombre" value="{{$cliente->nombre}}" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Nombre...">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="telefono">Teléfono</label>
									<input type="number" name="telefono" id="idtlf" required value="{{$cliente->telefono}}" class="form-control" placeholder="Ingrese Telefóno ...">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="email">Email</label>
									<input  type="email" name="email" id="idemail" required value="{{$cliente->email}}" onchange="validarEmail(idemail.value)"  class="form-control" placeholder="Ingrese email...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label for="pais">País</label>
									<select name="pais"   id="idpais" class="form-control"  onchange="changeProvincia()">

										@if($cliente->pais == "")
										@foreach ($catalogo as $pais)
										<option value="{{$pais->valor}}">{{$pais->valor}}</option>
										@endforeach
										@else
										<option value="{{$cliente->pais}}" selected >{{$cliente->pais}}</option>
										@foreach ($catalogo as $pais)
										<option value="{{$pais->valor}}">{{$pais->valor}}</option>
										@endforeach
										@endif
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="provincia">Provincia</label><br>
									<select name="provincia" id="idprovincia"  value="{{old('provincia')}}" class="form-control"   onchange="changeCiudad()"  >
									<option value="{{$cliente->provincia}}">{{$cliente->provincia}}</option>
								    </select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group ">
									<label for="ciudad">Ciudad</label>
									<select name="ciudad" id="idciudad"  value="{{old('ciudad')}}" class="form-control">
									<option value="{{$cliente->ciudad}}">{{$cliente->ciudad}}</option>
                                    </select>
								</div>
							</div>
			</div>
			<div class="col-md-12">
			                <div class="col-md-4">
								<div class="form-group">
									<label for="is_retencion">Tiene Retención</label><br>
									 @if($cliente->is_retencion == "1")
									 <input class="form-check-input" type="checkbox"  id="checkif_retencion" 	onchange="changeOtros()"  name="is_retencion" checked>
											@else
											<input class="form-check-input" type="checkbox" id="checkif_retencion" 	onchange="changeOtros()"  name="is_retencion" >
											@endif
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group ">
									<label for="retencion_valor">Valor Retencion</label>
					<!-- 				<input type="text" name="retencion_valor"  style=" top:15px;" id="idretencion_valor"  
									value="{{  intval($cliente->retencion_valor) }}" class="form-control" placeholder="Ingrese Valor Impuesto...">
 -->

                                     @if($cliente->is_retencion == "0")
									<select name="retencion_valor" disabled  id="idretencion_valor" style=" top:15px;" class="form-control" onchange="changeOtros()" >									
											<option value="{{  intval($cliente->retencion_valor) }}"  >{{   intval($cliente->retencion_valor) }}</option>
											@foreach ($impuesto as $imp)
											<option value="{{$imp->valor}}" >{{$imp->valor}}{{$imp->simbolo}}</option>
											@endforeach
											</select>

											@else
											<select name="retencion_valor"  id="idretencion_valor" style=" top:15px;" class="form-control" onchange="changeOtros()" >									
											<option value="{{  intval($cliente->retencion_valor) }}" >{{   intval($cliente->retencion_valor) }}</option>
											@foreach ($impuesto as $imp)
											<option value="{{$imp->valor}}" >{{$imp->valor}}{{$imp->simbolo}}</option>
											@endforeach
											</select>

									@endif
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="direccion">Dirección</label>
									<input type="text" name="direccion" id="iddireccion" value="{{$cliente->direccion}}" style="text-transform:uppercase"  class="form-control" placeholder="Ingrese...">
								</div>
							</div>
			</div>

			<div class="col-md-12">
			                <div class="col-md-4" >
							  <h5 style="color:#e9873e;font-weight:bold;border: 1px solid #e9873e;">Tablita de Retención</h5>
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
							
			</div>
			<div class="col-md-12" style="margin-top:15px;" >
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
			<a href="{{URL::action('ClienteController@index')}}"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>
@push ('scripts')
 <script>
$(window).on("load", function() {
	
let inputDocument = document.getElementById("document").value;

if (inputDocument == "Cédula") {

	document.getElementById("docNumber").maxLength = 10;
	

} else if (inputDocument == "Ruc") {

	document.getElementById("docNumber").maxLength = 13;

} else if (inputDocument == "Pasaporte") {

    document.getElementById("docNumber").maxLength = 12;
}

document.getElementById("idprovincia").disabled = true;

document.getElementById("idciudad").disabled = true;
});

function changeProvincia(){

var	pais = $("#idpais").val();
document.getElementById("idprovincia").disabled = false;
$('#idprovincia').find('option').remove();
setTimeout(function() {
$.get('/acceso/'+pais+'/provincia', function (data) {
	$('#idprovincia').append('<option value="">Selecione Provincia</option>');
	for(var i=0; i<data.length; ++i)
	$('#idprovincia').append('<option value="'+data[i].valor+'">'+data[i].valor+'</option>');
});
}, 10);
}

function changeCiudad(){

var	provincia = $("#idprovincia").val();

document.getElementById("idciudad").disabled = false;
$('#idciudad').find('option').remove();
setTimeout(function() {
$.get('/acceso/'+provincia+'/ciudad', function (data) {
	$('#idciudad').append('<option value="">Selecione Ciudad</option>');
	for(var i=0; i<data.length; ++i)
	$('#idciudad').append('<option value="'+data[i].valor+'">'+data[i].valor+'</option>');
});
}, 10);
}

$(document).ready(function(){

$(document).on('change','#idpais',function(){


	var pais = document.getElementById("idpais").value;

if (pais == "Ecuador") {
	document.getElementById("idtlf").value = "";
	document.getElementById("idtlf").maxLength = 10;

} else if (pais !== "Ecuador")  {
	document.getElementById("idtlf").value = "";
	document.getElementById("idtlf").maxLength = 13;

} 

});
});



function changeOtros() {
 var data = 	document.getElementById('checkif_retencion').checked
if (data == true) {
	document.getElementById("idretencion_valor").disabled = false;
	$("#idretencion_valor").val("");
} else {
	document.getElementById("idretencion_valor").disabled = true;
	$("#idretencion_valor").val("");
} 
}


function validarEmail(valor) {

re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
  if(!re.exec(valor)){
	  toastr.error('Email no valido');
	  document.getElementById("idemail").value = "";
	   document.getElementById("idemail").focus();
  }else {
	  toastr.success('Email valido');
  } 
}


jQuery(document).ready(function(){
	// Listen for the input event.
	jQuery("#docNumber").on('input', function (evt) {
		// Allow only numbers.
		jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
	});
});

jQuery(document).ready(function(){
	// Listen for the input event.
	jQuery("#idtlf").on('input', function (evt) {
		// Allow only numbers.
		jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
	});
});


</script>
@endpush
@endsection