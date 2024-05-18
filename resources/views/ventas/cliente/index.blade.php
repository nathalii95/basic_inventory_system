@extends ('layouts.admin')
@section ('contenido')
@php $cont = 1;
@endphp
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong> {{ session()->get('message') }}</strong> 
</div>
@endif
@if(session()->has('messagerr'))
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong> {{ session()->get('messagerr') }}</strong> 
</div>
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Cliente <br><a href="cliente/create"><button class="btn btn-success">Nuevo</button></a></h3>
	
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="idClienteN" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Tipo Documento</th>
					<th>N° Documento</th>
					<th>Dirección</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Estado</th>
				    <th>Opciones</th>
					
				</thead>
               @foreach ($clientes as $pro)
				<tr>
				    <td>{{ $cont}}</td>
					<td>{{ $pro->nombre}}</td>
					<td>{{ $pro->tipo_documento}}</td>
					<td>{{ $pro->num_documento}}</td>
					<td>{{ $pro->direccion}}</td>
					<td>{{ $pro->telefono}}</td>
					<td>{{ $pro->email}}</td>
					
					@if(Auth::user()->id_cargo== "1")
					<td><input type="checkbox" data-onstyle="warning" class="toggle-class" data-id="{{$pro->id_cliente}}" data-toggle="toggle"
					data-on="Activo" data-off="Inactivo" {{$pro->estado == 1 ? 'checked':''}}> </td>
					@else
					<td><input type="checkbox" disabled data-onstyle="warning" class="toggle-class" data-id="{{$pro->id_cliente}}" data-toggle="toggle"
					data-on="Activo" data-off="Inactivo" {{$pro->estado == 1 ? 'checked':''}}> </td>
					@endif	
					
					<td>
						<a href="{{URL::action('ClienteController@edit',$pro->id_cliente)}}"><button class="btn btn-info">Editar</button></a>
					</td>
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
$('#idClienteN').DataTable({
     
	responsive: "true",
		dom: 'flBrtip',  
		paging: true,
		pageLength: 5,
		pagingType: 'full_numbers',
        /* orderCellsTop: false, */
		"order": [[ 0, 'asc' ]],
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
				title: "Lista de Clientes",
				filename: "clientes",
				text: 'EXCEL <i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 15px;margin-right: 10px; margin-top: 4px; margin:6px;color:green;"> </i>',
				exportOptions: {
					columns: [0,1, 2, 3,4,5,6],
					stripHtml: false
				} 
			},
			{
				extend: "print",
				footer: true,
				title: "Lista de Clientes",
				filename: "clientes",
				text: 'IMPRIMIR<i class="fa fa-print" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:blue;" ></i>',
				exportOptions: {
					columns: [0,1, 2, 3,4,5,6],
				} 

			},
			{
				extend: "pdf",
				footer: true,
				title: "Lista de Clientes",
				filename: "clientes",
				pageSize: 'A4',
                alignment: "center",
				pageMargins: [ 90, 0, 0, 0 ],
				text: 'PDF <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:red;"></i>',
				exportOptions: {
					columns: [0,1, 2, 3,4,5,6],
				} 


			},

		]
                 
     });
}


$(function() {
    $('#toggle-two').bootstrapToggle({
      on: 'Activo',
      off: 'Inactivo'
    });
  })

  $('.toggle-class').on('change',function(){
	var status = $(this).prop('checked') == true ? 1 : 0;
	var id = $(this).data('id');
	$.ajax({
    type:'GET',
	dataType:'json',
	url:'{{route("change.statusc")}}',
	data:{'status':status, 'id':id},
	success:function(data){
	}
	});

  });
 </script>
@endpush
@endsection