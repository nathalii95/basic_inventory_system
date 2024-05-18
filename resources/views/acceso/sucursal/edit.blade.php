@extends ('layouts.admin')
@section ('contenido')
			<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Sucursal: {{ $sucursales->nombre}}</h3>
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
			{!!Form::model($sucursales,['method'=>'PATCH','route'=>['acceso.sucursal.update',$sucursales->id_sucursal]])!!}
            {{Form::token()}}

			<div class="row">
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
								<label for="nombre">Sucursal</label>
								<input type="text" name="nombre" required 
									value="{{$sucursales->nombre}}" class="form-control" style="text-transform:uppercase" id="idsucursal"  >

							     </div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
							<label for="id_empresa">Empresa</label><br>
									<select name="id_empresa" required  class="form-control" >
										@foreach ($empresas as $cat)
											@if($cat->id_empresa==$sucursales->id_empresa)
											<option value="{{$cat->id_empresa}}" selected>{{$cat->nombre_empresa}}</option>
											@else
											<option value="{{$cat->id_empresa}}">{{$cat->nombre_empresa}}</option>
											@endif
										@endforeach
									</select>
	                    </div>
	           </div>
			</div>
			<div class="col-md-12">
						
						<div class="col-md-3">
							<div class="form-group">
								<label for="telefono">Telefono</label>
								<input  type="number" name="telefono" id="idtelefono"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"  value="{{$sucursales->telefono}}" class="form-control">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="ciudad">Ciudad</label>
								<input  type="text" name="ciudad" id="idciudad" value="{{$sucursales->ciudad}}" class="form-control" style="text-transform:uppercase">
							</div>
						</div>
						<div class="col-md-6">			

							<div class="form-group">
								<label for="direccion">Direccion</label>
								<input type="text" name="direccion" id="idireccion" required value="{{$sucursales->direccion}}" class="form-control" style="text-transform:uppercase" placeholder="Ingrese Dirección ...">
							</div>
						</div>
		</div>
		<div class="col-md-12">
						<div class="col-md-6">
						<div class="form-group">
								<label for="email">Correo Electrónico</label>
								<input type="email" name="email" id="idemail" required value="{{$sucursales->email}}" class="form-control" placeholder="Ingrese Correo Electrónico ...">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="encargado">Encargado</label>
								<input type="text" name="encargado" id="idencargado" required value="{{$sucursales->encargado}}" class="form-control" style="text-transform:uppercase" placeholder="Ingrese Nombre del Encargado ...">
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
		<a href="{{URL::action('SucursalController@index')}}"><button class="btn btn-warning btn-block">Regresar</button></a>
		</div>				
@endsection