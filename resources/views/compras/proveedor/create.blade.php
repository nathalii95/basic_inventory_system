@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Proveedor</h3>
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
			{!!Form::open(array('url'=>'compras/proveedor','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    
	<div class="row">
			<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label for="nombre">Tipo Persona</label>
									<select name="tipo_persona" value="{{old('tipo_persona')}}"  id="idpersona"  class="form-control" >
									<option value="" >Seleccione Tipo Persona </option>
									<option value="Natural" >Natural</option>
									<option value="Jurídico" >Jurídico</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="tipo_documento">Tipo Documento</label>
									<select name="tipo_documento" 	value="{{old('tipo_documento')}}"  required class="form-control" id="document" >
									<option value="" >Seleccione Tipo Documento</option> 
									<option value="Ruc" >Ruc</option>
									<option value="Cédula" >Cédula</option>
									<option value="Pasaporte" >Pasaporte</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="num_documento">N° Documento </label>
									<input type="text" name="num_documento" required 
									value="{{old('num_documento')}}" class="form-control" id="docNumber"   placeholder="Ingrese Identificación ...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label for="nombre">Nombre</label>
									<input type="text" name="nombre" required  id="idnombre" value="{{old('nombre')}}" class="form-control" style="text-transform:uppercase" placeholder="Ingrese Nombre...">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="pais">País</label>
									<select  name="pais"  id="idpais" class="form-control"   value="{{old('pais')}}" onchange="changeProvincia()">
									<option value="" >Seleccione País</option> 
									@foreach ($catalogo as $pais)
									<option value="{{$pais->valor}}">{{$pais->valor}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<input type="hidden" name="provincia" id="idprovincia" value="" class="form-control" >
							<div class="col-md-4">
								<div class="form-group ">
									<label for="ciudad">Ciudad</label>
									<input type="text" name="ciudad" id="idciudad" value="{{old('ciudad')}}" class="form-control" style="text-transform:uppercase" placeholder="Ingrese Ciudad.." >
								</div>
							</div>
			</div>
			<div class="col-md-12">

							<div class="col-md-4">
								<div class="form-group">
									<label for="telefono">Teléfono</label>
									<input type="text" name="telefono" id="idtlf" required value="{{old('telefono')}}" class="form-control" placeholder="Ingrese Telefóno ...">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="email">Email</label>
									<input  type="email" name="email" id="idemail" value="{{old('email')}}"  class="form-control" placeholder="Ingrese email...">
								</div>
							</div>
			</div>
			<div class="col-md-12">
	
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
			<a href="../proveedor"><button class="btn btn-warning btn-block">Regresar</button></a>
            </div>				

@push ('scripts')
 <script>


$(window).on("load", function() {
	
	document.getElementById("idciudad").disabled = true;
	document.getElementById("docNumber").disabled = true;
    document.getElementById("idtlfcli").maxLength = 10;
	});



function changeProvincia(){

	document.getElementById("idciudad").disabled = false;

}

$(document).ready(function(){

	$(document).on('change','#document',function(){
		document.getElementById("docNumber").disabled = false;
		let inputDocument = document.getElementById("document").value;
      document.getElementById("docNumber").focus();
	if (inputDocument == "Cédula") {
		document.getElementById("docNumber").maxLength = 10;
		document.getElementById("docNumber").value = "";
    } else if (inputDocument == "Ruc") {
		document.getElementById("docNumber").maxLength = 13;
		document.getElementById("docNumber").value = "";
    } else if (inputDocument == "Pasaporte") {
		document.getElementById("docNumber").maxLength = 12;
		document.getElementById("docNumber").value = "";
    }

	});
});

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


function changeOtros() {
 var data = 	document.getElementById('checkif_retencion').checked
if (data == true) {
	document.getElementById("idretencion_valor").disabled = false;
	$("#idretencion_valor").val("");

} else {
	document.getElementById("idretencion_valor").disabled = true;
} 
}

/* $('#docNumber').on('change',function(){
		var id = $("#docNumber").val();
		$.ajax({
		type:'GET',
		dataType:'json',
		url:'{{route("change.cedulaval")}}',  
		data:{'id':id},
		success:function(data){

		if (data.length != 0) {
			let autFocus = $("#docNumber").focus();
				toastr.error("documento ya registrado");
				$("#docNumber").val('');
					} 
		}
	});
}); */

$('#docNumber').on('change',function(){
	let cantidadnum = document.getElementById("docNumber").value;
	var id = $("#docNumber").val();
	$.ajax({
	type:'GET',
	dataType:'json',
	url:'{{route("change.cedulaval")}}',  /* change.statusp */
	data:{'id':id},
	success:function(data){
				if (data.length != 0) {
					let autFocus = $("#docNumber").focus();
					toastr.error("documento ya registrado");
					$("#docNumber").val('');
				} else{
				if (cantidadnum.length == 10) {
					return  validaCedula();
				}else if (cantidadnum.length == 13){
					return  validaRuc();
				}
			}
		}
   });
});


//Valida si es cedula o no

function validaCedula() {
     numero = document.getElementById('docNumber').value;
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
         let autFocus = $("#docNumber").focus();
         toastr.error("No puede ingresar caracteres");
		 document.getElementById("docNumber").value = "";
         return false;
     } else if (numero.length !== 10 && numero.length !== 0) {
         let autFocus = $("#docNumber").focus();
         toastr.error("Número de Cedula Incompleto");
		 document.getElementById("docNumber").value = "";
         return false;
     } else if (numero == "") {
         let autFocus = $("#docNumber").focus();
         toastr.error("Ingrese Número de Cedula");
		 document.getElementById("docNumber").value = "";
         return false;
     }

     provincia = numero.substr(0, 2);
     if (provincia < 0 || provincia > numeroProvincias) {
         let autFocus = $("#docNumber").focus();
         toastr.error("El código de la Provincia (dos primeros dígitos) es Inválido");
		 document.getElementById("docNumber").value = "";
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
         let autFocus = $("#docNumber").focus();
         toastr.error("Tercer dígito de cedula ingresado es Inválido");
		 document.getElementById("docNumber").value = "";
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
             let autFocus = $("#docNumber").focus();
             toastr.error("El Número de cédula no es Válido.");
			 document.getElementById("docNumber").value = "";
             return false;
         } else {
             let autFocus = $("#docNumber").focus();
             toastr.success("El número de cédula es Válido.");
             return true;
         }
     }
     return true;
 }

 //Valida Ruc 

 function validaRuc() {
    
	numero = document.getElementById("docNumber").value;
    /* alert(numero); */

      var suma = 0;      
      var residuo = 0;      
      var pri = false;      
      var pub = false;            
      var nat = false;      
      var numeroProvincias = 22;                  
      var modulo = 11;
                  
      /* Verifico que el campo no contenga letras */                  
      var ok=1;
      for (i=0; i<numero.length && ok==1 ; i++){
         var n = parseInt(numero.charAt(i));
         if (isNaN(n)) ok=0;
      }
      if (ok==0){
		toastr.error("No puede ingresar caracteres en el número");    
		document.getElementById("docNumber").value = "";   
		let autFocus = $("#docNumber").focus();   
        return false;
      }
                  
      if (numero.length < 10 ){              
		toastr.error('El número ingresado no es válido');        
		document.getElementById("docNumber").value = "";      
		let autFocus = $("#docNumber").focus();     
         return false;
      }
     
      /* Los primeros dos digitos corresponden al codigo de la provincia */
      provincia = numero.substr(0,2);      
      if (provincia < 1 || provincia > numeroProvincias){           
		toastr.error('El código de la provincia (dos primeros dígitos) es inválido');
		document.getElementById("docNumber").value = "";
		let autFocus = $("#docNumber").focus(); 
        return false;       
      }

      /* Aqui almacenamos los digitos de la cedula en variables. */
      d1  = numero.substr(0,1);         
      d2  = numero.substr(1,1);         
      d3  = numero.substr(2,1);         
      d4  = numero.substr(3,1);         
      d5  = numero.substr(4,1);         
      d6  = numero.substr(5,1);         
      d7  = numero.substr(6,1);         
      d8  = numero.substr(7,1);         
      d9  = numero.substr(8,1);         
      d10 = numero.substr(9,1);                
         
      /* El tercer digito es: */                           
      /* 9 para sociedades privadas y extranjeros   */         
      /* 6 para sociedades publicas */         
      /* menor que 6 (0,1,2,3,4,5) para personas naturales */ 

      if (d3==7 || d3==8){           
		toastr.error('El tercer dígito ingresado es inválido');     
		document.getElementById("docNumber").value = "";        
		let autFocus = $("#docNumber").focus();         
         return false;
      }         
         
      /* Solo para personas naturales (modulo 10) */         
      if (d3 < 6){           
         nat = true;            
         p1 = d1 * 2;  if (p1 >= 10) p1 -= 9;
         p2 = d2 * 1;  if (p2 >= 10) p2 -= 9;
         p3 = d3 * 2;  if (p3 >= 10) p3 -= 9;
         p4 = d4 * 1;  if (p4 >= 10) p4 -= 9;
         p5 = d5 * 2;  if (p5 >= 10) p5 -= 9;
         p6 = d6 * 1;  if (p6 >= 10) p6 -= 9; 
         p7 = d7 * 2;  if (p7 >= 10) p7 -= 9;
         p8 = d8 * 1;  if (p8 >= 10) p8 -= 9;
         p9 = d9 * 2;  if (p9 >= 10) p9 -= 9;             
         modulo = 10;
      }         

      /* Solo para sociedades publicas (modulo 11) */                  
      /* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
      else if(d3 == 6){           
         pub = true;             
         p1 = d1 * 3;
         p2 = d2 * 2;
         p3 = d3 * 7;
         p4 = d4 * 6;
         p5 = d5 * 5;
         p6 = d6 * 4;
         p7 = d7 * 3;
         p8 = d8 * 2;            
         p9 = 0;            
      }         
         
      /* Solo para entidades privadas (modulo 11) */         
      else if(d3 == 9) {           
         pri = true;                                   
         p1 = d1 * 4;
         p2 = d2 * 3;
         p3 = d3 * 2;
         p4 = d4 * 7;
         p5 = d5 * 6;
         p6 = d6 * 5;
         p7 = d7 * 4;
         p8 = d8 * 3;
         p9 = d9 * 2;            
      }
                
      suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;                
      residuo = suma % modulo;                                         

      /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
      digitoVerificador = residuo==0 ? 0: modulo - residuo;                

      /* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/                         
      if (pub==true){           
         if (digitoVerificador != d9){                          
            toastr.error('El ruc de la empresa del sector público es incorrecto.');     
			document.getElementById("docNumber").value = "";      
			let autFocus = $("#docNumber").focus();  
            return false;
         }                  
         /* El ruc de las empresas del sector publico terminan con 0001*/         
         else if ( numero.substr(9,4) != '0001' ){                    
            toastr.error('El ruc de la empresa del sector público debe terminar con 0001');
			document.getElementById("docNumber").value = "";
			let autFocus = $("#docNumber").focus(); 
            return false;
         }
		 else {                    
            toastr.success('El ruc de la empresa del sector público es Válido');
            return true;
         }
      }         
      else if(pri == true){         
         if (digitoVerificador != d10){                          
            toastr.error('El ruc de la empresa del sector privado es incorrecto.');
			document.getElementById("docNumber").value = "";
            return false;
         }         
        else if ( numero.substr(10,3) != '001' ){                    
            toastr.error('El ruc de la empresa del sector privado debe terminar con 001');
			let autFocus = $("#docNumber").focus(); 
			document.getElementById("docNumber").value = "";
            return false;
         }
		 else {                    
            toastr.success('El ruc de la empresa del sector privado es Válido');
            return false;
         }
      }      

      else if(nat == true){         
       
		if (numero.length >10 && numero.substr(10,3) != '001' ){     
			let autFocus = $("#docNumber").focus();               
            toastr.error('El ruc de la persona natural debe terminar con 001');
			document.getElementById("docNumber").value = "";
            return false;
         } else {
             toastr.success("El número de ruc de la persona natural es Válido .");
             return true;
         } 
      }      
      return true;   
 }

</script>
@endpush

@endsection