@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Indicadores de Compras </h3>
	</div>
</div>
<br>
<div class="row" style="margin-top:-20px;" >
			<div class="col-md-12">
			                <div class="col-md-4">
								<div class="form-group">
									<!-- <label for="idproducto">Actualizar Proceso</label> -->
									<br><button class="btn btn-success" title="Actualizar Procesos" onclick="clickLimpiar()" ><i class="fa fa-refresh" aria-hidden="true" title="Actualizar Procesos"></i>
                                    </button>
								</div>
							</div>
		    </div>
</div>
<div class="row" style="margin-top:10px;">
			<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label for="idproducto">Producto</label>
									<select name="idproducto" class="form-control selectpicker" data-live-search="true" id="idproducto" >
									<option value="" >Seleccione Producto</option> 
									@foreach ($items6 as $articulo)
									<option value="{{$articulo->id_producto}}">{{$articulo->articulo}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="idproducto">Proveedor</label>
									<select name="idproveedor" class="form-control selectpicker" data-live-search="true" id="idproveedor" onchange="changegeneral()"  >
									<option value="" >Seleccione Proveedor</option> 
									@foreach ($items3 as $proveedor)
									<option value="{{$proveedor->id_proveedor}}">{{$proveedor->nombre}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="idproducto">Usuario</label>
									<select name="idvusuario" class="form-control selectpicker" data-live-search="true" id="idusuario" onchange="changegeneral()" >
									<option value="" >Seleccione Usuario</option> 
									@foreach ($items4 as $usuario)
									<option value="{{$usuario->id}}">{{$usuario->name}}</option>
									@endforeach
									</select>
								</div>
							</div>
							
			</div>
			<div class="col-md-12">
							<div class="col-md-2">
								<div class="form-group">
									<label for="idproducto">Codigo Producto</label>
									<select name="idproducto" class="form-control selectpicker" data-live-search="true" id="idcodigo"  onchange="changeFecha()"  >
									<option value="" >Seleccione Codigo</option> 
									@foreach ($items5 as $articulo)
									<option value="{{$articulo->codigo}}">{{$articulo->codigo}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
                                    <label for="idproducto">Categoria</label>
									<select name="idproducto" class="form-control selectpicker" data-live-search="true" id="idcategoria"  onchange="changeFecha()"  >
									<option value="" >Seleccione Producto</option> 
									@foreach ($categoria as $categorias)
									<option value="{{$categorias->id_categoria}}">{{$categorias->nombre}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="idproducto">Marca</label>
									<select name="idproducto" class="form-control selectpicker" data-live-search="true" id="idmarca"  onchange="changeFecha()"  >
									<option value="" >Seleccione Marca</option> 
									@foreach ($items2 as $articulo)
									<option value="{{$articulo->marca}}">{{$articulo->marca}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="idproducto">Modelo</label>
									<select name="idproducto" class="form-control selectpicker" data-live-search="true" id="idmodelo"  onchange="changeFecha()"  >
									<option value="" >Seleccione Modelo</option> 
									@foreach ($items as $articulo)
									<option value="{{$articulo->modelo}}">{{$articulo->modelo}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="fecha">Fecha Desde</label>
									<input  type="date" name="fecha" id="idDesde"  onchange="changeFecha()"   class="form-control" >
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="fecha">Fecha Hasta</label>
									<input  type="date" name="fecha" id="idHasta" onchange="changeFecha()"     class="form-control" >
									</select>
								</div>
							</div>
			</div>
			<div class="col-md-12">
			        <div class="col-md-2">
								<div class="form-group">
									<label for="num_documento">Más Comprado</label><!-- DESC-->
									<select name="indica1" class="form-control" id="idindica1" >
									<option value="" >Seleccione Item</option> 
									<option value="1" >Producto más Comprado</option> 
									<option value="5" >5 Productos más Comprado</option> 
									<option value="3" >3 Productos más Comprado</option> 
									<option value="10" >10 Productos más Comprado</option> 
									<option value="20" >20 Productos más Comprado</option> 

									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group"> <!-- ASC-->
									<label for="indica2">Menos Comprado</label>
									<select name="indica2" class="form-control" id="idindica2" >
									<option value="" >Seleccione Item</option> 
									<option value="1" >Producto menos Comprado</option> 
									<option value="5" >5 Producto menos Comprado</option> 
									<option value="3" >3 Producto menos Comprado</option> 
									<option value="10" >10 Producto menos Comprado</option> 
									<option value="20" >20 Producto menos Comprado</option> 
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="fecha">MESUAL</label>
									<select name="idmensual" required class="form-control" id="idmensual" onchange="changeMensual()"  >
									<option value="" >Seleccione Item</option> 
									<option value="Enero" >Enero</option> 
									<option value="Febrero" >Febrero</option> 
									<option value="Marzo" >Marzo</option> 
									<option value="Abril" >Abril</option> 
									<option value="Mayo" >Mayo</option> 
									<option value="Junio" >Junio</option> 
									<option value="Julio" >Julio</option> 
									<option value="Agosto" >Agosto</option> 
									<option value="Septiembre" >Septiembre</option> 
									<option value="Octubre" >Octubre</option> 
									<option value="Noviembre" >Noviembre</option> 
									<option value="Diciembre" >Diciembre</option> 
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="fecha">Anual</label>
									<select name="idanual"  class="form-control" id="idanual" onchange="changeAnual()"  >
									<option value=""  >Seleccione Item</option> 
								<?php
									$cont = date('Y');
									
									while ($cont >= 2018) {;?>
										 
                                           <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
										   <?php $cont = ($cont-1); } ?>
									</select>

								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="forma_pago">Forma Pago</label>
									<select name="forma_pago"  class="form-control" id="idforma" onchange="changegeneral()" >
									<option value="" >Seleccione Forma Pago</option>
									<option value="Efectivo" >Efectivo</option>
									<option value="Ch/ posfechado" >Ch/ posfechado</option>
									</select>
								</div>
							</div>

			</div>
</div>
<br>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<div id="output"></div>
        </div>
    </div>
</div>
<hr>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<div id="output1"></div>
        </div>
    </div>
</div>


@push ('scripts') 
 <script>



$(window).on("load", function() {
	$("#idproducto").val(''); 
	$("#idindica1").val(''); 
	$("#idindica2").val(''); 
	$("#idDesde").val(''); 
	$("#idHasta").val(''); 
	$("#idanual").val(''); 
	$("#idmensual").val(''); 
	$("#idcodigo").val(''); 
	$("#idcategoria").val(''); 
	$("#idmarca").val(''); 
	$("#idmodelo").val(''); 
	$("#idproveedor").val(''); 
	$("#idusuario").val(''); 
	$("#idforma").val(''); 
	$('#output2').hide(); 

	validarProduct();


});

function clickLimpiar(){
	$("#idproducto").val(''); 
	$("#idindica1").val(''); 
	$("#idindica2").val(''); 
	$("#idDesde").val(''); 
	$("#idHasta").val(''); 
	$("#idanual").val(''); 
	$("#idmensual").val(''); 
	$("#idcodigo").val(''); 
	$("#idcategoria").val(''); 
	$("#idmarca").val(''); 
	$("#idmodelo").val(''); 
	$("#idproveedor").val(''); 
	$("#idusuario").val(''); 
	$("#idforma").val(''); 
	setTimeout(function() {
	validarProduct();  
}, 50);

}

function validarProduct(){
	var dataArray = [];
	var idproducto =   $("#idproducto").val(); 
	var idindica1  = $("#idindica1").val(); 
	var idindica2  = $("#idindica2").val(); 
	var idDesde    = $("#idDesde").val(); 
	var idHasta    = $("#idHasta").val(); 
	var idanual    = $("#idanual").val(); 
	var idmensual  = $("#idmensual").val(); 
	var idcodigo   = $("#idcodigo").val(); 
	var idcategoria = $("#idcategoria").val(); 
	var idmarca     = $("#idmarca").val(); 
	var idmodelo    = $("#idmodelo").val(); 
	var idproveedor   = $("#idproveedor").val(); 
    var idusuario  = $("#idusuario").val(); {
	var idforma	= $("#idforma").val(); 
	}

	data = {
      nombre: idproducto == "" ? null : idproducto ,
      masVendido: idindica1 == "" ? null : idindica1 ,
      menosVendido:  idindica2 == "" ? null : idindica2 ,
      desde:  idDesde == "" ? null : idDesde ,
	  hasta:  idHasta == "" ? null : idHasta ,
	  mensual:  idmensual == "" ? null : idmensual ,
	  anual:  idanual == "" ? null : idanual ,
	  codigo:  idcodigo == "" ? null : idcodigo ,
	  categoria:  idcategoria == "" ? null : idcategoria ,
	  marca:  idmarca == "" ? null : idmarca ,
	  modelo:  idmodelo == "" ? null : idmodelo ,
	  proveedor:  idproveedor == "" ? null : idproveedor ,
	  usuario:  idusuario == "" ? null : idusuario ,
	  forma_pago:  idforma == "" ? null : idforma ,
    };
	$.ajax({
	type:'GET',
	dataType:'json',
	url:'{{route("load.loadCompra")}}', 
	data:data,
	success:function(data){
  var output = document.getElementById('output');
  var output1 = document.getElementById('output1');
    var total = parseFloat('0.00');
	var totalv = parseFloat('0.00');
	var totalv1 = parseFloat('0.00');
	var n=0;
    var table = `<table id="indicadorProduct" style="width:100%" class="table text-center table-striped table-bordered table-condensed table-hover" >
	            <thead>
				    <th>#</th>
				    <th>Codigo</th>
					<th>Nombre</th>
					<th>Proveedor</th>
					<th>Categoria</th>
					<th>Modelo</th>
					<th>Marca</th>
					<th>Forma Pago</th>
					<th>Cantidad Comprada</th>
					<th>Precio Compra</th>
					<th>Precio Venta</th>
					<th>Cantidad Devolución</th>
					<th>Mes Comprado</th>
					<th>Fecha</th>
				</thead>`;

    data.forEach(function(d, index) {

        table += `<tr> 
        <td>${n+=1}</td> 
		<td>${d.codigo}</td> 
        <td style="text-align:left">${(d.nombre).toUpperCase() }</td> 
		<td style="text-align:left">${(d.proveedor).toUpperCase() }</td> 
		<td>${ (d.categoria).toUpperCase() }</td> 
		<td>${ (d.modelo).toUpperCase()}</td> 
		<td>${ (d.marca).toUpperCase()}</td> 
		<td>${ (d.forma_pago).toUpperCase()}</td> 
        <td>${ d.cantidad}</td> 
		<td>${d.precio_unitario}</td> 
		<td>${d.precio_venta}</td> 
		<td>${d.cant_dev }</td> 
		<td>${d.Mes}</td> 
		<td>${d.fecha}</td> 
      </tr>`;

	 total += parseFloat(d.cantidad);
	 totalv += parseFloat(d.precio_unitario);

	 totalv1  += parseFloat(d.precio_venta); 
    });
	dataArray.push(data);
    table += `<tfoot>
        <td></td> 
        <td></td> 
		<td></td> 
        <td ></td>
		<td></td> 
        <td ></td>
        <td ></td>
		<td ></td>
        <td class="text-danger text-left" style="font-weight :bold;font-size:16px;" >${total}</td> 
        <td class="text-danger text-right" style="font-weight :bold;font-size:16px;"> ${new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'}).format(totalv)}</td> 
		<td class="text-danger text-right" style="font-weight :bold;font-size:16px;"> ${new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'}).format(totalv1)}</td> 
		<td ></td> 
		<td ></td> 
		<td ></td> 
        </tfoot></table>`;
    output.innerHTML = table;
	cargarDataTable();

		}
		
   });
}

function FirstLetter(word){
    return word.charAt(0).toUpperCase() + word.slice(1)
}



$('#idproducto').on('change',function(){
	$("#idindica1").val(''); 
	$("#idindica2").val(''); 
	setTimeout(function() {
	validarProduct();
}, 5);
});

$('#idcodigo').on('change',function(){
	$("#idproducto").val(''); 
	$("#idindica1").val(''); 
	$("#idindica2").val(''); 
	setTimeout(function() {
	validarProduct();
}, 5);
});


$('#idindica1').on('change',function(){
	$("#idproducto").val(''); 
/* 	$("#idDesde").val(''); 
	$("#idHasta").val('');  */
	$("#idindica2").val(''); 
	setTimeout(function() {
	validarProduct();
}, 5);
});


$('#idindica2').on('change',function(){
	$("#idproducto").val(''); 
/* 	$("#idDesde").val(''); 
	$("#idHasta").val(''); */
	$("#idindica1").val('');  
	setTimeout(function() {
	validarProduct();
}, 5);
});


function changeFecha(){
	$("#idproducto").val(''); 
	$("#idanual").val(''); 
	$("#idmensual").val(''); 
	setTimeout(function() {
	validarProduct();  
}, 5);
}

function changegeneral(){
	setTimeout(function() {
	validarProduct();  
}, 5);
}

function changeMensual(){
	$("#idproducto").val(''); 
    $("#idanual").val(''); 
	$("#idDesde").val(''); 
	$("#idHasta").val('');

	setTimeout(function() {
	validarProduct();  
}, 5);
}

function changeAnual(){
	$("#idproducto").val(''); 
  	$("#idmensual").val(''); 
	  $("#idDesde").val(''); 
	$("#idHasta").val('');
	setTimeout(function() {
	validarProduct();  
}, 5);
}

$("#idanual option:eq(0)").attr("selected","selected");

function cargarDataTable() {
$('#indicadorProduct').DataTable({
     
	responsive: "true",
		dom: 'flBrtip',  
		paging: true,
		pageLength: 100,
		pagingType: 'full_numbers',
      /*   orderCellsTop: false,*/
		"order": [[ 0, "asc" ]], 
		/* search: false, */
		/* scrollY: "200px", */
        /* scrollCollapse: true, */
		language: {
        url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
      },

		buttons: [
			{
				extend: "excel",
				footer: true,
				title: "Lista de Categoria",
				filename: "categorias",
				text: 'EXCEL <i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 15px;margin-right: 10px; margin-top: 4px; margin:6px;color:green;"> </i>',
/* 				exportOptions: {
					columns: [0,1, 2],
				}  */
			},
			{
				extend: "print",
				footer: true,
				title: "Listas Categoria",
				filename: "categorias",
				text: 'IMPRIMIR<i class="fa fa-print" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:blue;" ></i>',

/* 				exportOptions: {
					columns: [0,1,2],
				} */

			},
			{
				extend: "pdf",
				footer: true,
				title: "Lista de Categorías",
				filename: "categorias",
				pageSize: 'A4',
                alignment: "center",
				pageMargins: [ 90, 0, 0, 0 ],
				text: 'PDF <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:red;"></i>',
/* 				exportOptions: {
					columns: [0,1, 2],
				} */
				customize: function (doc) {
            doc.defaultStyle.fontSize = 7,
              doc.defaultStyle.alignment = 'center',
              doc.styles.title = {
                color: '#E9873E',
                fontSize: '14',
                alignment: 'center',
                bold: true,
              },//title
              doc.styles.tableHeader = {
                fillColor: '#E9873E',
                color: 'white',
                fontSize: '7',
                alignment: 'center',
                bold: true,
              },
			    doc.styles.tableFooter = {
				fillColor: '#E9873E',
				color: 'white',
				alignment: 'center',
				fontSize: '8',
				bold: true,
			  }//para cambiar el background del escabezado
          },


			},

		],
		
                 
     });
 

}

 </script>
@endpush
@endsection