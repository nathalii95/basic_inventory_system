@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Usuario</h3>
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
			{!!Form::open(array('url'=>'acceso/usuario','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
    
	<div class="row">
	        <div class="col-md-12">

							<div class="col-md-6">
								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="name">Nombre </label>

										<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

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

                                <input id="email" type="email" required class="form-control" name="email" value="{{ old('email') }}">

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
								<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
									<label for="password">Contraseña</label>
									    <input id="pass" type="hidden"  name="pass">
										<input id="password" type="text"  onkeyup="passData()" class="form-control" name="password">

										@if ($errors->has('password'))
											<span class="help-block">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
										@endif
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
									<label for="password-confirm" >Repita Contraseña</label>

									    <input id="vistapassconfirm" type="hidden"  name="passconfir">
										<input id="password-confirm" type="text"  onkeyup="passDataConf()"  class="form-control" name="password_confirmation">

										@if ($errors->has('password_confirmation'))
											<span class="help-block">
												<strong>{{ $errors->first('password_confirmation') }}</strong>
											</span>
										@endif
								</div>
                            </div>
			</div>
			<div class="col-md-12">

							<div class="col-md-4">
								<div class="form-group">
									<label for="id_empresa">Empresa</label>

									<select name="id_empresa" id="idEmpresa" required value="{{old('id_empresa')}}"  class="form-control" >
									<option value="" >Seleccione Empresa</option>	
									@foreach ($empresa as $emp)
						            <option value="{{$emp->id_empresa}}" >{{$emp->nombre_empresa}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="id_sucursal">Sucursal</label><br>
									<select name="id_sucursal" id="idSucursal" required value="{{old('id_sucursal')}}"  class="form-control" >
									<option value="">Selecione Sucursal</option>
								    </select>
								</div>
							</div>
							<div class="col-md-4">
							    <div class="form-group">
									<label for="cedula">Cédula</label>
									<input type="text" name="cedula" required value="{{old('cedula')}}" id="idcedula" class="form-control" placeholder="Ingrese cedula...">
								</div>
							</div>
<!-- 							<div class="col-md-3">
								<div class="form-group">
									<label for="telefono">Teléfono</label>
									<input type="text" name="telefono" id="idtlfcli" required value="{{old('telefono')}}" class="form-control" placeholder="Ingrese Telefóno ...">
								</div>
							</div> -->
			</div>
			<div class="col-md-12">
			                
							<div class="col-md-4">
								<div class="form-group">
									<label for="id_cargo">Cargo</label>
									<select name="id_cargo" required value="{{old('id_cargo')}}"  class="form-control" >
									<option value="" >Seleccione Cargo</option>	
									@foreach ($cargo as $car)
										<option value="{{$car->id_cargo}}" >{{$car->nombre}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
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
			<a href="../usuario"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>		
			
						
@push ('scripts')
 <script>
	$(window).on("load", function() {
		document.getElementById("idSucursal").disabled = true;
		jQuery("#idcedula").on('input', function (evt) {
		jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
		document.getElementById("idcedula").maxLength = 10;
	});
});

/* 
$(window).on("keypress", function() {
	document.getElementById("idcedula").maxLength = 10;
});
 */

$(function(){
$('#idEmpresa').on('change', onCambio);

});

function onCambio(){
	document.getElementById("idSucursal").disabled = false;
	var	empresa = $("#idEmpresa").val();

if(! empresa )
$('#idSucursal').html('<option value="">Selecione Sucursal</option>');


	$.get('/acceso/'+empresa+'/sucursal', function (data) {
		var html_select = '<option value="">Selecione Sucursal</option>';
		for(var i=0; i<data.length; ++i)
		html_select += '<option value="'+data[i].id_sucursal+'">'+data[i].nombre+'</option>';
		$('#idSucursal').html(html_select);
	/* 	console.log(data[i]);  */

	});

}

$(function(){
$('#idcedula').on('change', validaCedula);

});
//Valida si es cedula o no

function validaCedula() {
     numero = document.getElementById('idcedula').value;
     var residuo = 0;
     var nat = false;
     var numeroProvincias = 24;
     var modulo = 10;

     var ok = 1;
     for (i = 0; i < numero.length && ok == 1; i++) {
         var n = parseInt(numero.charAt(i));
         if (isNaN(n)) ok = 0;
     }
     if (ok == 0) {
         let autFocus = $("#idcedula").focus();
         toastr.error("No puede ingresar caracteres");
		 document.getElementById("idcedula").value = "";
         return false;
     } else if (numero.length !== 10 && numero.length !== 0) {
         let autFocus = $("#idcedula").focus();
         toastr.error("Número de Cedula Incompleto");
		 document.getElementById("idcedula").value = "";
         return false;
     } else if (numero == "") {
         let autFocus = $("#idcedula").focus();
         toastr.error("Ingrese Número de Cedula");
		 document.getElementById("idcedula").value = "";
         return false;
     }

     provincia = numero.substr(0, 2);
     if (provincia < 0 || provincia > numeroProvincias) {
         let autFocus = $("#idcedula").focus();
         toastr.error("El código de la Provincia (dos primeros dígitos) es Inválido");
		 document.getElementById("idcedula").value = "";
         return false;
     }

     d1 = numero.substr(0, 1);
     d2 = numero.substr(1, 1);
     d3 = numero.substr(2, 1);
     d4 = numero.substr(3, 1);
     d5 = numero.substr(4, 1);
     d6 = numero.substr(5, 1);
     d7 = numero.substr(6, 1);
     d8 = numero.substr(7, 1);
     d9 = numero.substr(8, 1);
     d10 = numero.substr(9, 1);

     if (d3 == 7 || d3 == 8 || d3 == 9 || d3 == 6) {
         let autFocus = $("#idcedula").focus();
         toastr.error("Tercer dígito de cedula ingresado es Inválido");
		 document.getElementById("idcedula").value = "";
         return false;
     } else if (d3 < 6) {
         nat = true;
         p1 = d1 * 2;
         if (p1 >= 10) p1 -= 9;
         p2 = d2 * 1;
         if (p2 >= 10) p2 -= 9;
         p3 = d3 * 2;
         if (p3 >= 10) p3 -= 9;
         p4 = d4 * 1;
         if (p4 >= 10) p4 -= 9;
         p5 = d5 * 2;
         if (p5 >= 10) p5 -= 9;
         p6 = d6 * 1;
         if (p6 >= 10) p6 -= 9;
         p7 = d7 * 2;
         if (p7 >= 10) p7 -= 9;
         p8 = d8 * 1;
         if (p8 >= 10) p8 -= 9;
         p9 = d9 * 2;
         if (p9 >= 10) p9 -= 9;
         modulo = 10;
     }

     suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
     residuo = suma % modulo;

     /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
     digitoVerificador = residuo == 0 ? 0 : modulo - residuo;

     if (nat == true) {
         if (digitoVerificador != d10) {
             let autFocus = $("#idcedula").focus();
             toastr.error("El Número de cédula no es Válido.");
			 document.getElementById("idcedula").value = "";
             return false;
         } else {
             let autFocus = $("#idcedula").focus();
             toastr.success("El número de cédula es Válido.");
             return true;
         }
     }
     return true;
 }


 $('#idtlfcli').on('change',function(){
	document.getElementById("idtlfcli").value = "";
	document.getElementById("idtlfcli").maxLength = 10;
});

 function passData(){
  var password =	$("#password").val();
  $("#pass").val(password);

 }

 function passDataConf(){
  var passwordc =	$("#password-confirm").val();
  $("#vistapassconfirm").val(passwordc);
 }

 </script>
@endpush
@endsection