@extends ('layouts.admin')
@section ('contenido')
@php $cont = 1;
@endphp
@if($evio_nota != 0)
<div class="alert alert-danger alert-dismissible">
  <strong>EXISTEN PRODUCTOS BAJO EN STOCK, REVISE LA TABLA PRESENTE EN DASHBOARD</strong> 
  <button type="button" class="close" data-dismiss="alert" style="font-weight:bold;" >&times;</button>
</div>
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	<h3>DASHBOARD</h3>
	</div>		
</div>

@if(Auth::user()->id_cargo== "1")	
										
<div class="row">
			<div class="col-md-12">
			<strong style="color:#E9873E; "  >INFORMACIÓN GENERAL SISTEMA</strong><br><br>
							<div class="col-md-3">
								<div class="alert alert-success" role="alert">
								<h4 class="alert-heading text-uppercase text-white">Productos</h4>
								<p class="text-white" style="font-size:28px;" >{{ $productos}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-shopping-basket text-white"></i><br>
							    </div>
							</div>

							
							<div class="col-md-2">
								<div class="alert alert-warning " role="alert">
								<h4 class="alert-heading text-uppercase text-white">Proveedores</h4>
								<p class="text-white"  style="font-size:28px;">{{ $proveedor}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-users text-white"></i><br>
							    </div>
							</div>
							<div class="col-md-2">
								<div class="alert alert" style="background-color:#146EB4; color:white; " role="alert">
								<h4 class="alert-heading text-uppercase">Clientes</h4>
								<p  style="font-size:28px;" >{{ $cliente}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-handshake-o text-white"></i><br>
							    </div>
							</div>
							<div class="col-md-2">
								<div class="alert alert" style="background-color:#6914C4; color:white; " role="alert">
								<h4 class="alert-heading text-uppercase">Usuarios</h4>  
								<p  style="font-size:28px;" >{{ $usuarios}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-user-circle text-white"></i><br>
							    </div>
							</div>
							<div class="col-md-3">
								<div class="alert alert" style="background-color:#D411D1; color:white; " role="alert">
								<h4 class="alert-heading text-uppercase">Sucursales</h4>
								<p  style="font-size:28px;" >{{ $sucursal}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-suitcase text-white"></i><br>
							    </div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-3">
								<div class="alert alert-danger" role="alert">
								<h4 class="alert-heading text-uppercase text-white">Compras</h4>
								<p class="text-white"  style="font-size:28px;">{{ $compra}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-th text-white"></i><br>
							    </div>
							</div>

							<div class="col-md-3">
								<div class="alert alert-info" role="alert">
								<h4 class="alert-heading text-uppercase text-white">Ventas</h4>
								<p class="text-white"  style="font-size:28px;">{{ $venta}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-shopping-cart text-white"></i><br>
							    </div>
							</div>
							<div class="col-md-3">
								<div class="alert alert"  style="background-color:#11D461; color:white; " role="alert">
								<h4 class="alert-heading text-uppercase">Devolución Compra</h4>
								<p class="text-white"  style="font-size:28px;">{{ $devCompra}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-th text-white"></i><br>
							    </div>
							</div>

							<div class="col-md-3">
								<div class="alert alert " style="background-color:#A4D50B; color:white; " role="alert">
								<h4 class="alert-heading text-uppercase ">Devolución Venta</h4>
								<p class="text-white"  style="font-size:28px;">{{ $devVenta}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-shopping-cart text-white"></i><br>
							    </div>
							</div>
							
			</div>
        </div>

		@else
		<div class="row">
			<div class="col-md-12">
			<strong style="color:#E9873E; "  >INFORMACIÓN GENERAL</strong><br><br>
							<div class="col-md-4">
								<div class="alert alert-success" role="alert">
								<h4 class="alert-heading text-uppercase text-white">Productos</h4>
								<p class="text-white" style="font-size:28px;" >{{ $productos}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-shopping-basket text-white"></i><br>
							    </div>
							</div>

							
							<div class="col-md-4">
								<div class="alert alert-warning " role="alert">
								<h4 class="alert-heading text-uppercase text-white">Proveedores</h4>
								<p class="text-white"  style="font-size:28px;">{{ $proveedor}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-users text-white"></i><br>
							    </div>
							</div>
							<div class="col-md-4">
								<div class="alert alert" style="background-color:#146EB4; color:white; " role="alert">
								<h4 class="alert-heading text-uppercase">Clientes</h4>
								<p  style="font-size:28px;" >{{ $cliente}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-handshake-o text-white"></i><br>
							    </div>
							</div>
			</div>
			<div class="col-md-12">
							<div class="col-md-6">
								<div class="alert alert-danger" role="alert">
								<h4 class="alert-heading text-uppercase text-white">Facturas Compras</h4>
								<p class="text-white"  style="font-size:28px;">{{ $comprausr}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-th text-white"></i><br>
							    </div>
							</div>

							<div class="col-md-6">
								<div class="alert alert-info" role="alert">
								<h4 class="alert-heading text-uppercase text-white">Facturas Ventas</h4>
								<p class="text-white"  style="font-size:28px;">{{ $ventausr}}</p>
								<i style="float:right;font-size:20px;" class="fa fa-shopping-cart text-white"></i><br>
							    </div>
							</div>
			</div>
        </div>
			
	    @endif

		<div class="row">
			<div class="col-md-12">
			<strong style="color:red;">PRODUCTOS BAJO EN STOCK </strong><br><br>
				<table id="vistaStock" class="table table-striped table-bordered table-condensed table-hover mt-5">
				<thead style="background-color:#E9873E;color:white; "  >
					<tr>
					<th>#</th>
					<th>Producto</th>
					<th>Codigo</th>
					<th>Baja en Stock</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($bajostock as $pro)
				<tr>
				    <td>{{ $cont}}</td>
					<td>{{ $pro->nombre}}</td>
					<td>{{ $pro->codigo}}</td>
					<td style="background-color:red;color:white;font-weight:bold; ">{{ $pro->stock}}</td>					
				</tr>
				@php
                $cont++;
                @endphp		
				@endforeach
				</tbody>
				</table>		
			</div>
			
        </div>


		@push ('scripts') 
 <script>
	$(window).on("load", function() {
		setTimeout(() => {
			cargarDataTable();
      }, 10);
	});
function cargarDataTable() {
$('#vistaStock').DataTable({
     
		responsive: "true",
		dom: 'flBrtip',  
		paging: true,
		pageLength: 6,
		pagingType: 'full_numbers',
        /* orderCellsTop: false, */
		/* "order": [[  ]], */
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
				title: "Lista de bajo en Stock",
				filename: "ventas",
				text: 'EXCEL <i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 15px;margin-right: 10px; margin-top: 4px; margin:6px;color:green;"> </i>',
				exportOptions: {
					columns: [0,1, 2,3],
				} 
			},
			{
				extend: "print",
				footer: true,
				title: "Lista de bajo en Stock",
				filename: "ventas",
				text: 'IMPRIMIR<i class="fa fa-print" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:blue;" ></i>',

				exportOptions: {
					columns: [0,1, 2,3],
				}

			},
			{
				extend: "pdf",
				footer: true,
				title: "Lista de bajo en Stock",
				filename: "ventas",
				pageSize: 'A4',
                alignment: "center",
				pageMargins: [ 90, 0, 0, 0 ],
				text: 'PDF <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:red;"></i>',
				exportOptions: {
					columns: [0,1, 2,3],
				}


			},

		],
		
                 
     });
}

 </script>
@endpush
@endsection