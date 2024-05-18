@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Empresa</h3>
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
			{!!Form::open(array('url'=>'acceso/empresa','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    
	<div class="row">
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre_empresa">Nombre Empresa</label>
									<input type="text" name="nombre_empresa" required  id="idnombre" value="{{old('nombre_empresa')}}" class="form-control" style="text-transform:uppercase" placeholder="Ingrese Nombre Empresa...">
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
									<label for="r_legal">Representante Legal</label>
									<input type="text" name="r_legal" required  id="idrepresentante" value="{{old('r_legal')}}" class="form-control" style="text-transform:uppercase" placeholder="Ingrese al Representante...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-3">
								<div class="form-group">
									<label for="ruc">Ruc </label>
									<input type="number" name="ruc" required 
									value="{{old('num_documento')}}" class="form-control" id="idruc"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13"  placeholder="Ingrese Ruc ...">
								</div>
							</div>
						
							<div class="col-md-3">
								<div class="form-group">
									<label for="telefono">Telefono</label>
									<input  type="number" name="telefono" id="idtelefono"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" value="{{old('telefono')}}" class="form-control" placeholder="Ingrese telefono...">
								</div>
							</div>
							<div class="col-md-6">
							
							<div class="form-group">
									<label for="email">Email</label>
									<input  type="email" required name="email" id="idemail" value="{{old('email')}}" onchange="validarEmail(idemail.value)"  class="form-control" placeholder="Ingrese Email...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="contacto">Contacto</label><br>
									<input type="text" name="contacto" id="idcontacto"  value="{{old('contacto')}}" class="form-control" style="text-transform:uppercase" placeholder="Ingrese Nombre Contacto de la empresa...">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="direccion">Direccion</label>
									<input type="text" name="direccion" id="iddireccion" required value="{{old('direccion')}}" class="form-control"  style="text-transform:uppercase" placeholder="Ingrese Dirección ...">
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
			<a href="../empresa"><button class="btn btn-warning btn-block">Regresar</button></a>
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