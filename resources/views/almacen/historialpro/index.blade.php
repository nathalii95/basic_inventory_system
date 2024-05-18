@extends ('layouts.admin')
@section ('contenido')
@php $cont = 1;
@endphp
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Historial de Productos
	</div>
</div>
<br>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table  id="productohist" class="table table-striped table-bordered table-condensed table-hover table-responsive text-center "  >
			<thead>
			        <th >#</th>
					<th  style="width: 5%;">Fecha</th>
					<th style="width: 5%;">Tipo</th>
					<th style="width: 20%;">Detalle</th>
					<th style="width: 18%;">Producto</th>
					<th style="width: 11%;">Codigo</th>
					<th style="width: 8%;">Cantidad</th>
					<!-- <th>Precio</th> -->
					<th style="width: 8%;">Total</th>
					<th style="width: 10%;">Stock</th>
					<th style="width: 10%;">Cliente/Proveedor</th>
					<th style="width: 15%;">Usuario</th>
				</thead>
               @foreach ($ingresohist as $cat)
				<tr>
				<td >{{$cont}}</td>
					<td style="width: 5%;">{{ $cat->fecha}}</td>
					<td style="width: 5%;">{{ $cat->tipo_mov}}</td>
					<td style="width: 20%;text-align: left; ">{{ $cat->detalle}}</td>
					<td style="width: 18%;text-align: left; ">{{ $cat->nombre}}</td>
					<td style="width: 11%;text-align: left; ">{{ $cat->codigo}}</td>
					<td style="width: 8%;">{{ $cat->cantidad}}</td>
				<!-- 	<td>{{ $cat->precio}}</td> -->
					<td style="width: 8%;">${{ $cat->costo_total}}</td>
					<td style="width: 10%;">{{ $cat->stock}}</td>
					<td style="width: 10%;">{{ $cat->persona}}</td>
					<td style="width: 15%;text-align: left; ">{{ $cat->name}}</td>
				</tr>
				@php
                         $cont++;
                         @endphp
				@endforeach
			</table>
		</div>
	</div>
</div>
@push ('scripts') 
 <script>
	$(window).on("load", function() {
		cargarDataTable()
	});
function cargarDataTable() {

var table = $('#productohist').DataTable({
     
		responsive: "true",
		dom: 'flBrtip',  
		paging: true,
		pageLength: 25,
		pagingType: 'full_numbers',
        /* orderCellsTop: false, */
		"order": ['0','asc'],
		/* search: false,
		scrollY: "300px",
        scrollCollapse: true, */
		language: {
        url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
      },

		buttons: [
			{
				extend: "excel",
				footer: true,
				title: "Listado Historial de Productos",
				filename: "historial_productos",
				text: 'EXCEL <i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 15px;margin-right: 10px; margin-top: 4px; margin:6px;color:green;"> </i>',
/* 				exportOptions: {
					columns: [0,1, 2],
				}  */
			},
			{
				extend: "print",
				footer: true,
				title: "Listado Historial de Productos ",
				filename: "historial_productos",
				text: 'IMPRIMIR<i class="fa fa-print" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:blue;" ></i>',

/* 				exportOptions: {
					columns: [0,1,2],
				}
 */
			},
			{
				extend: "pdf",
				footer: true,
				title: "Listado Historial de Productos",
				filename: "historial_productos",
				pageSize: 'A4',
                alignment: "center",
				pageMargins: [ 90, 0, 0, 0 ],
				text: 'PDF <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:red;"></i>',
/* 				exportOptions: {
					columns: [0,1, 2],
				} */


			},

		],
		
                 
     });
 
	     //Creamos una fila en el head de la tabla y lo clonamos para cada columna
/* 		 $('#productohist thead tr').clone(true).appendTo('#productohist thead');

		$('#productohist thead tr:eq(1) th').each(function(i) {
			var title = $(this).text(); 
			$(this).html('<input type="text" placeholder="Buscar...' + title + '" />');

			$('input', this).on('keyup change', function() {
				if (table.column(i).search() !== this.value) {
					table
						.order([1, 'asc'], [2, 'asc'])
						.column(i)
						.search(this.value)
						.draw();
				}
			});
		}); */

}

 </script>
@endpush
@endsection