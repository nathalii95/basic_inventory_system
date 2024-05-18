@extends ('layouts.admin')
@section ('contenido')
			<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Empresa: {{ $empresa->nombre}}</h3>
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
			{!!Form::model($empresa,['method'=>'PATCH','route'=>['acceso.empresa.update',$empresa->id_empresa]])!!}
            {{Form::token()}}

			<div class="row">
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre_empresa">Nombre Empresa</label>
									<input type="text" name="nombre_empresa" required  id="idnombre" value="{{$empresa->nombre_empresa}}" class="form-control" placeholder="Ingrese Nombre Empresa...">
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
									<label for="r_legal">Representante Legal</label>
									<input type="text" name="r_legal" required  id="idrepresentante" value="{{$empresa->r_legal}}" class="form-control" placeholder="Ingrese al Representante...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-3">
								<div class="form-group">
									<label for="ruc">Ruc </label>
									<input type="text" name="ruc" required value="{{$empresa->telefono}}" class="form-control" id="idruc"   placeholder="Ingrese Ruc ...">
								</div>
							</div>
						
							<div class="col-md-3">
								<div class="form-group">
									<label for="telefono">Telefono</label>
									<input  type="text" name="telefono" id="idtelefono" value="{{$empresa->telefono}}" required class="form-control" placeholder="Ingrese telefono...">
								</div>
							</div>
							<div class="col-md-6">
							
							<div class="form-group">
									<label for="email">Email</label>
									<input  type="email" name="email" id="idemail" value="{{$empresa->email}}" required class="form-control" placeholder="Ingrese Email...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="contacto">Contacto</label><br>
									<input type="text" name="contacto" id="idcontacto"  value="{{$empresa->contacto}}" class="form-control" placeholder="Ingrese Nombre Contacto de la empresa...">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="direccion">Direccion</label>
									<input type="text" name="direccion" id="idireccion" required value="{{$empresa->direccion}}" class="form-control" placeholder="Ingrese Dirección ...">
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
			<a href="{{URL::action('EmpresaController@index')}}"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>	

@push ('scripts')
 <script>
	$(window).on("load", function() {
		document.getElementById("idruc").maxLength = 13;
		document.getElementById("idtelefono").maxLength = 10;
		jQuery("#idruc").on('input', function (evt) {
		jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
	});

	jQuery("#idtelefono").on('input', function (evt) {
		jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
	});
	
});



</script>
@endpush				
@endsection