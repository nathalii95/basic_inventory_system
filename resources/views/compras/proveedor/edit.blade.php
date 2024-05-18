@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Proveedor: {{ $proveedor->nombre}}</h3>
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
			{!!Form::model($proveedor,['method'=>'PATCH','route'=>['compras.proveedor.update',$proveedor->id_proveedor]])!!}
            {{Form::token()}}

			<div class="row">
			<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label for="nombre">Tipo Persona</label>
									<select name="tipo_persona"  id="idpersona"  class="form-control" >									
									@if($proveedor->tipo_persona == "")
									<option value="" selected >Seleccione Tipo Persona </option>
									<option value="Natural" >Natural</option>
									<option value="Jurídico" >Jurídico</option>
											@elseif($proveedor->tipo_persona == "Natural")
									<option value=""  >Seleccione Tipo Persona </option>
									<option value="Natural" selected>Natural</option>
									<option value="Jurídico" >Jurídico</option>
											
											@else
											<option value=""  >Seleccione Tipo Persona </option>
									<option value="Natural" >Natural</option>
									<option value="Jurídico" selected >Jurídico</option>
											@endif
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="tipo_documento">Tipo Documento</label>
									<select name="tipo_documento" required class="form-control" id="document" >


									@if($proveedor->tipo_documento == "")
									<option value="" selected>Seleccione Tipo Documento</option> 
									<option value="Ruc" >Ruc</option>
									<option value="Cédula" >Cédula</option>
									<option value="Pasaporte" >Pasaporte</option>
											@elseif($proveedor->tipo_documento == "Ruc")
									<option value="" >Seleccione Tipo Documento</option> 
									<option value="Ruc" selected>Ruc</option>
									<option value="Cédula" >Cédula</option>
									<option value="Pasaporte" >Pasaporte</option>
									@elseif($proveedor->tipo_documento == "Cédula")
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
							<div class="col-md-4">
								<div class="form-group">
									<label for="num_documento">N° Documento </label>
									<input type="text" name="num_documento" required 
									value="{{$proveedor->num_documento}}" class="form-control" id="docNumber"   placeholder="Ingrese Identificación ...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label for="nombre">Nombre</label>
									<input type="text" name="nombre" required  id="idnombre" value="{{$proveedor->nombre}}" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Nombre...">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="telefono">Teléfono</label>
									<input type="number" name="telefono" id="idtlf" required value="{{$proveedor->telefono}}" class="form-control" placeholder="Ingrese Telefóno ...">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="email">Email</label>
									<input  type="email" name="email" id="idemail" value="{{$proveedor->email}}" class="form-control" placeholder="Ingrese email...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label for="pais">País</label>
									<select name="pais"   id="idpais" class="form-control"  onchange="changeProvincia()">

									 @if($proveedor->pais == "")
									 @foreach ($catalogo as $pais)
									<option value="{{$pais->valor}}">{{$pais->valor}}</option>
									@endforeach
									@else
									 <option value="{{$proveedor->pais}}" selected >{{$proveedor->pais}}</option>
									 @foreach ($catalogo as $pais)
									<option value="{{$pais->valor}}">{{$pais->valor}}</option>
									@endforeach
									@endif
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group ">
									<label for="ciudad">Ciudad</label>
									<select name="ciudad" id="idciudad"  value="{{old('ciudad')}}" class="form-control">
									<option value="{{$proveedor->ciudad}}">{{$proveedor->ciudad}}</option>
                                    </select>

									<input type="text" name="ciudad" id="idciudad"  value="{{$proveedor->ciudad}}" style="text-transform:uppercase" class="form-control" placeholder="Ingrese...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-8">
								<div class="form-group">
									<label for="direccion">Dirección</label>
									<input type="text" name="direccion" id="iddireccion" value="{{$proveedor->direccion}}" style="text-transform:uppercase" class="form-control" placeholder="Ingrese...">
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
			<a href="{{URL::action('ProveedorController@index')}}"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>
@push ('scripts')
 <script>

$(window).on("load", function() {
	
	document.getElementById("idciudad").disabled = true;
	});

	
function changeProvincia(){
document.getElementById("idciudad").disabled = false;
}


</script>
@endpush
@endsection