@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Usuario: {{ $usuario->name}}</h3>
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
			{!!Form::model($usuario,['method'=>'PATCH','route'=>['acceso.usuario.update',$usuario->id]])!!}
            {{Form::token()}}

<div class="row">
<div class="col-md-12">

<div class="col-md-6">
	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<label for="name">Nombre </label>

			<input id="name" type="text" class="form-control" name="name" value="{{$usuario->name}}">

			@if ($errors->has('name'))
				<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
			@endif
	</div>
</div>
<div class="col-md-6">
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
<label for="email">Correo Electrónico</label>

	<input id="email" type="email" requiered class="form-control" name="email"  value="{{$usuario->email}}">

	@if ($errors->has('email'))
		<span class="help-block">
			<strong>{{ $errors->first('email') }}</strong>
		</span>
	@endif
</div>

</div>
</div>
<div class="col-md-12">
	
<div class="col-md-6">
	                                        <label for="password">Contraseña</label>
	                                        <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
											     <input id="password" type="password" class="form-control" name="password"  onkeyup="passData()"  value="{{($usuario->password)}}">

												 @if ($errors->has('password'))
													<span class="help-block">
														<strong>{{ $errors->first('password') }}</strong>
													</span>
												@endif
				                                 <span class="input-group-btn">
				                                 <button type="button"  class="btn btn-primary" onclick="mostrarContrasena()" id="btnaddEye" title="Ver Contraseña" ><i class="fa fa-eye" aria-hidden="true"></i></button>
												</span>
			                              	</div>
											<div id="vista" class="text-primary" style="font-size:17px;font-weight:bold;display:none;">Vista Contraseña:&nbsp;&nbsp;<input id="vistapass" type="hidden" class="form-control" name="pass" style="font-size:17px;font-weight:bold;border: 0;color:#3c8dbc;" value="{{($data)}}"></div>


</div>
<div class="col-md-6">

	                                        <label for="password-confirm" >Repita Contraseña</label>
	                                        <div class="input-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
											<input id="password-confirm" type="password" class="form-control"  onkeyup="passDataConf()" name="password_confirmation" value="{{($usuario->password)}}">
											@if ($errors->has('password_confirmation'))
												<span class="help-block">
													<strong>{{ $errors->first('password_confirmation') }}</strong>
												</span>
											@endif
				                                 <span class="input-group-btn">
				                                 <button type="button"  class="btn btn-primary" onclick="mostrarContrasenaconfirm()" id="btnaddEyeconf" title="Ver Contraseña" ><i class="fa fa-eye" aria-hidden="true"></i></button>
												</span>
			                              	</div>
											  <div id="vistaconfirm" class="text-primary" style="font-size:17px;font-weight:bold;display:none;">Vista Contraseña:&nbsp;&nbsp;<input id="vistapassconfirm" type="hidden" class="form-control" name="passconfir"  style="font-size:17px;font-weight:bold;border: 0;color:#3c8dbc;" value="{{($dataconf)}}"></div>
</div>
</div>
<div class="col-md-12">

<div class="col-md-6">
	<div class="form-group">
		<label for="id_empresa">Empresa</label>

		<select name="id_empresa" id="idEmpresa" required   class="form-control" >	
		@foreach ($empresa as $emp)
											@if($emp->id_empresa=="")
											<option value="" >Seleccione Empresa</option>	
											@elseif($emp->id_empresa==$usuario->id_empresa)	
											<option value="{{$emp->id_empresa}}" selected>{{$emp->nombre_empresa}}</option>
											@else
											<option value="{{$emp->id_empresa}}">{{$emp->nombre_empresa}}</option>
											@endif
		@endforeach
		</select>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label for="id_sucursal">Sucursal</label><br>
		<select name="id_sucursal" id="idSucursal" required class="form-control" >
		@foreach ($sucursal as $emp)
											@if($emp->id_sucursal=="")
											<option value="" >Seleccione Sucursal</option>	
											@elseif($emp->id_sucursal==$usuario->id_sucursal)	
											<option value="{{$emp->id_sucursal}}" selected>{{$emp->nombre}}</option>
											@else
											<option value="{{$emp->id_sucursal}}">{{$emp->nombre}}</option>
											@endif
		@endforeach
	    </select>
	</div>
</div>
</div>
<div class="col-md-12">
<div class="col-md-3">
	<div class="form-group">
		<label for="cedula">Cedula</label>
		<input type="number" name="cedula" required value="{{$usuario->cedula}}" id="idcedula" class="form-control" placeholder="Ingrese cedula...">
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
		<label for="id_cargo">Cargo</label>
		<select name="id_cargo" required value="{{old('id_cargo')}}"  class="form-control" >
		<option value="" >Seleccione Cargo</option>	
		@foreach ($cargo as $car)


			@if($car->id_cargo=="")
											<option value="" >Seleccione Cargo</option>	
											@elseif($car->id_cargo==$usuario->id_cargo)	
											<option value="{{$car->id_cargo}}" selected>{{$car->nombre}}</option>
											@else
											<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
											@endif
			@endforeach
		</select>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label for="imagen">Imagen</label>
		<input type="file" name="imagen"  class="form-control">
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
			<a href="{{URL::action('UsuarioController@index')}}"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>
			<div class="col-md-6 " style="float:right;top:-40px;">
			<div class="form-group">
			@if(($usuario->imagen)!="")
        <img src="{{asset('imagenes/usuarios/'.$usuario->imagen)}}" height="160px" width="240px">
		@endif
			</div>
         </div>

									
@push ('scripts')
 <script>
	$(window).on("load", function() {
/* 	var	empresa = $("#idEmpresa").val();
	$.get('/acceso/'+empresa+'/sucursal', function (data) {
		var html_select = '<option value="'+empresa+'" >'+data[empresa].nombre+'</option>';
		for(var i=0; i<data.length; ++i)
		html_select += '<option value="'+data[i].id_sucursal+'">'+data[i].nombre+'</option>';
		$('#idSucursal').html(html_select);

	}); */
});


$(function(){
$('#idEmpresa').on('change', onCambio);

});

function onCambio(){
	var	empresa = $("#idEmpresa").val();

if(! empresa )
/* $('#idSucursal').html('<option value="'+empresa+'" >'+data[empresa].nombre+'</option>'); */

      empresa.find('option').remove();
	  setTimeout(() => {
		$.get('/acceso/'+empresa+'/sucursal', function (data) {
		var html_select = '<option value="">Selecione Sucursal</option>';
		for(var i=0; i<data.length; ++i)
		html_select += '<option value="'+data[i].id_sucursal+'">'+data[i].nombre+'</option>';
		$('#idSucursal').html(html_select);
	/* 	console.log(data[i]);  */

	});
      }, 50);
	  
	

}

function mostrarContrasena(){
      var tipo = document.getElementById("vistapass");

      if(tipo.type == "hidden"){
		document.getElementById("vista").style.display = "block";
        $('#vistapass').show();
          tipo.type = "text";
      }else{
		document.getElementById("vista").style.display = "none";
		$('#vistapass').hide();
          tipo.type = "hidden";
      }
  }

  function passData(){
  var password =	$("#password").val();
  $("#vistapass").val(password);
  var tipo = document.getElementById("vistapass");
  document.getElementById("vista").style.display = "block";
  $('#vistapass').show();
  tipo.type = "text";
  document.getElementById("btnaddEye").disabled = true;
 }

  function mostrarContrasenaconfirm(){
	var tipo = document.getElementById("vistapassconfirm");
      if(tipo.type == "hidden"){
		document.getElementById("vistaconfirm").style.display = "block";
        $('#vistapassconfirm').show();
          tipo.type = "text";
      }else{
		document.getElementById("vistaconfirm").style.display = "none";
		$('#vistapassconfirm').hide();
          tipo.type = "hidden";
      }
  }

  function passDataConf(){
	document.getElementById("btnaddEyeconf").disabled = true;
	var password =	$("#password-confirm").val();
	$("#vistapassconfirm").val(password);
	var tipo = document.getElementById("vistapassconfirm");
	document.getElementById("vistaconfirm").style.display = "block";
	$('#vistapassconfirm').show();
	tipo.type = "text";
 }
  
 </script>
@endpush
@endsection