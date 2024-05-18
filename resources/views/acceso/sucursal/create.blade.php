@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Sucursal</h3>
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
			{!!Form::open(array('url'=>'acceso/sucursal','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    
	<div class="row">
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre">Nombre Sucursal</label>
									<input type="text" name="nombre" required  id="idnombre" value="{{old('nombre')}}" class="form-control" style="text-transform:uppercase" placeholder="Ingrese Nombre Sucursal...">
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
									<label for="id_empresa">Empresa</label>
									 <select name="id_empresa" required value="{{old('id_empresa')}}"  class="form-control" >
									<option value="" >Seleccione Empresa</option>
									    @foreach ($empresas as $emp)
										<option value="{{$emp->id_empresa}}" >{{$emp->nombre_empresa}}</option>
										@endforeach
									</select>
								</div>
							</div>
			</div>
			<div class="col-md-12">
						
							<div class="col-md-3">
								<div class="form-group">
									<label for="telefono">Telefono</label>
									<input  type="number" name="telefono" id="idtelefono"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"  value="{{old('telefono')}}" class="form-control" placeholder="Ingrese telefono...">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="ciudad">Ciudad</label> 
									<input  type="text" name="ciudad" id="idciudad" value="{{old('ciudad')}}" class="form-control" style="text-transform:uppercase" placeholder="Ingrese Ciudad...">
								</div>
							</div>
							<div class="col-md-6">			

								<div class="form-group">
									<label for="direccion">Direccion</label>
									<input type="text" name="direccion" id="idireccion" required value="{{old('direccion')}}" style="text-transform:uppercase" class="form-control" placeholder="Ingrese Dirección ...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-6">
							<div class="form-group">
									<label for="email">Correo Electrónico</label>
									<input type="email" name="email" id="idemail" onchange="validarEmail(idemail.value)" required value="{{old('email')}}" class="form-control" placeholder="Ingrese Correo Electrónico ...">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="encargado">Encargado</label>
									<input type="text" name="encargado" id="idencargado" required value="{{old('encargado')}}" class="form-control" style="text-transform:uppercase" placeholder="Ingrese Nombre del Encargado ...">
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
			<a href="../sucursal"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>		
@push ('scripts')
 <script>


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

</script>
@endpush			
@endsection