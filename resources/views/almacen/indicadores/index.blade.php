@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Indicadores de Productos </h3>
	</div>
</div>
<br>
<div class="row" style="margin-top:-20px;" >
			<div class="col-md-12">
			                <div class="col-md-4">
								<div class="form-group">
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
									@foreach ($producto as $articulo)
									<option value="{{$articulo->id_producto}}">{{$articulo->articulo}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="idproducto">Codigo Producto</label>
									<select name="idproducto" class="form-control selectpicker" data-live-search="true" id="idcodigo"   >
									<option value="" >Seleccione Codigo</option> 
									@foreach ($producto as $articulo)
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
							
			</div>
			<div class="col-md-12">
<!-- 			                 <div class="col-md-2">
								<div class="form-group">
									<label for="num_documento">Más Vendido</label>
									<select name="indica1" class="form-control" id="idindica1" >
									<option value="" >Seleccione Item</option> 
									<option value="1" >Producto más Vendido</option> 
									<option value="5" >5 Productos más Vendidos</option> 
									<option value="3" >3 Productos más Vendidos</option> 
									<option value="10" >10 Productos más Vendidos</option> 
									<option value="20" >20 Productos más Vendidos</option> 

									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="indica2">Menos Vendido</label>
									<select name="indica2" class="form-control" id="idindica2" >
									<option value="" >Seleccione Item</option> 
									<option value="1" >Producto menos Vendido</option> 
									<option value="5" >5 Producto menos Vendido</option> 
									<option value="3" >3 Producto menos Vendido</option> 
									<option value="10" >10 Producto menos Vendido</option> 
									<option value="20" >20 Producto menos Vendido</option> 
									</select>
								</div>
							</div> -->
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
							<div class="col-md-2">
								<div class="form-group">
									<label for="iva">Lleva Iva</label>
									<select name="idiva" class="form-control"  id="idiva"  onchange="changeIva()"  >
									<option value="" >Seleccione Item</option> 
									<option value="1" >Si</option> 
									<option value="0" >No</option> 
									
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="fecha">Total de Productos</label>
									<input  type="text" readonly name="sumPro" id="idsumPro"   class="form-control" >
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


@push ('scripts') 
 <script>



$(window).on("load", function() {
$("#idproducto").val('default').selectpicker("refresh");
$("#idcodigo").val('default').selectpicker("refresh");
$("#idcategoria").val('default').selectpicker("refresh");
$("#idmodelo").val('default').selectpicker("refresh");
$("#idmarca").val('default').selectpicker("refresh");

	$("#idDesde").val(''); 
	$("#idHasta").val(''); 
	$("#idanual").val(''); 
	$("#idmensual").val(''); 
	$("#idiva").val(''); 

	$('#output2').hide(); 

	validarProduct();


});


function clickLimpiar(){

setTimeout(function() {

	$("#idproducto").val('default').selectpicker("refresh");
$("#idcodigo").val('default').selectpicker("refresh");
$("#idcategoria").val('default').selectpicker("refresh");
$("#idmodelo").val('default').selectpicker("refresh");
$("#idmarca").val('default').selectpicker("refresh");
$("#idDesde").val(''); 
$("#idHasta").val(''); 
$("#idanual").val(''); 
$("#idmensual").val(''); 
$("#idiva").val(''); 
validarProduct(); 
}, 5);

}

function validarProduct(){
	var dataArray = [];
	var idproducto =   $("#idproducto").val(); 
	var idDesde    = $("#idDesde").val(); 
	var idHasta    = $("#idHasta").val(); 
	var idanual    = $("#idanual").val(); 
	var idmensual  = $("#idmensual").val(); 
	var idcodigo   = $("#idcodigo").val(); 
	var idcategoria = $("#idcategoria").val(); 
	var idmarca     = $("#idmarca").val(); 
	var idmodelo    = $("#idmodelo").val(); 
	var idiva       = $("#idiva").val(); 

	data = {
      nombre: idproducto == "" ? null : idproducto,
      desde:  idDesde == "" ? null : idDesde ,
	  hasta:  idHasta == "" ? null : idHasta ,
	  mensual:  idmensual == "" ? null : idmensual ,
	  anual:  idanual == "" ? null : idanual ,
	  codigo:  idcodigo == "" ? null : idcodigo ,
	  categoria:  idcategoria == "" ? null : idcategoria ,
	  marca:  idmarca == "" ? null : idmarca ,
	  modelo:  idmodelo == "" ? null : idmodelo ,
	  iva:  idiva == "" ? null : idiva ,
    };
	$.ajax({
	type:'GET',
	dataType:'json',
	url:'{{route("load.producto")}}', 
	data:data,
	success:function(data){
  var output = document.getElementById('output');
	var total = parseFloat('0');
	var n = 0;
    var table = `<table id="indicadorProduct" style="width:100%" class="table text-center table-striped table-bordered table-condensed table-hover" >
	            <thead>
				    <th>#</th>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Categoria</th>
					<th>Modelo</th>
					<th>Marca</th>
					<th>Stock</th>
					<th>LLeva Iva</th>
					<th>Iva</th>
					<th>Mes Creado</th>
					<th>Fecha</th>
				</thead>`;

    data.forEach(function(d, index) {
	var llevaiva =	d.is_impuesto == '1' ? "SI" : "NO";
	var iva =	d.impuesto_valor === null ? "" : d.impuesto_valor ;
		 
        table += `<tr> 
		<td  >${n+=1}</td> 
        <td  >${d.codigo}</td> 
        <td style="text-align:left" >${d.nombre}</td> 
		<td>${d.categoria}</td> 
		<td>${d.modelo}</td> 
		<td>${d.marca}</td> 
        <td>${d.stock}</td>
		
		<td>${llevaiva }</td>
		<td>${iva}</td>
		<td>${d.Mes}</td> 
		<td>${d.fecha}</td> 
      </tr>`;

      total = n;
       
    });
	dataArray.push(data);
    output.innerHTML = table;
	$("#idsumPro").val(total); 
	cargarDataTable(); 
		}
		
   });
}


$('#idproducto').on('change',function(){

$("#idcodigo").val('default').selectpicker("refresh");
	setTimeout(function() {
	validarProduct();
}, 5);
});

$('#idcodigo').on('change',function(){
	$("#idproducto").val('default').selectpicker("refresh");
	setTimeout(function() {
	validarProduct();
}, 5);
});




function changeFecha(){
	$("#idproducto").val('default').selectpicker("refresh");
$("#idcodigo").val('default').selectpicker("refresh");
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
	$("#idproducto").val('default').selectpicker("refresh");
$("#idcodigo").val('default').selectpicker("refresh");

    $("#idanual").val(''); 
	$("#idDesde").val(''); 
	$("#idHasta").val('');

	setTimeout(function() {
	validarProduct();  
}, 5);
}

function changeAnual(){
	$("#idproducto").val('default').selectpicker("refresh");
$("#idcodigo").val('default').selectpicker("refresh");

  	$("#idmensual").val(''); 
	  $("#idDesde").val(''); 
	$("#idHasta").val('');
	setTimeout(function() {
	validarProduct();  
}, 5);
}

function changeIva(){
	$("#idproducto").val('default').selectpicker("refresh");
$("#idcodigo").val('default').selectpicker("refresh");

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
				title: "Lista de Producto",
				filename: "categorias",
				text: 'EXCEL <i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 15px;margin-right: 10px; margin-top: 4px; margin:6px;color:green;"> </i>',
			},
			{
				extend: "print",
				footer: true,
				title: "Lista de Producto",
				filename: "categorias",
				text: 'IMPRIMIR<i class="fa fa-print" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:blue;" ></i>',
			},
			{
				extend: "pdf",
				footer: true,
				title: "Lista de Producto",
				filename: "categorias",
				pageSize: 'A4',
                alignment: "center",
				pageMargins: [ 90, 0, 0, 0 ],
				text: 'PDF <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:red;"></i>',
				customize: function (doc) {
                doc.defaultStyle.fontSize = 7,
                doc.defaultStyle.alignment = 'center',
                doc.styles.title = {
                color: '#E9873E',
                fontSize: '14',
                alignment: 'center',
                bold: true,
                },
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
			    }
          },


			},

		],
		
                 
     });
 

}

 </script>
@endpush
@endsection