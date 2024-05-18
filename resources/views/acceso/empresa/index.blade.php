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
		<h3>Listado de Empresas <br><a href="empresa/create"><button class="btn btn-success">Nuevo</button></a></h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="margin-top:15px;">
		<div class="table-responsive ">
			<table id="empresa" style="width:100%" class="table text-center table-striped table-bordered table-condensed table-hover">
				<thead>
				    <th >#</th>
					<th>Ruc</th>
					<th>Nombre</th>
					<th>Representante</th>
					<th>Dirección</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($empresas as $empr)
				<tr>
					<td>{{ $cont}}</td>
					<td >{{ $empr->ruc}}</td>
					<td style="text-align: left;" >{{ $empr->nombre_empresa}}</td>
					<td style="text-align: left;" >{{ $empr->r_legal}}</td>
					<td>{{ $empr->direccion}}</td>
					<td>{{ $empr->telefono}}</td>
					<td >{{ $empr->email}}</td>
	
					@if(Auth::user()->id_cargo== "1")
					<td><input type="checkbox" data-onstyle="warning" class="toggle-class" data-id="{{$empr->id_empresa}}" data-toggle="toggle"
					data-on="Activo" data-off="Inactivo" {{$empr->estado == 1 ? 'checked':''}}> </td>			
					@else
					<td><input type="checkbox" disabled data-onstyle="warning" class="toggle-class" data-id="{{$empr->id_empresa}}" data-toggle="toggle"
					data-on="Activo" data-off="Inactivo" {{$empr->estado == 1 ? 'checked':''}}> </td>
					@endif
				
					<td class="text-center">
						<a href="{{URL::action('EmpresaController@edit',$empr->id_empresa)}}"><button class="btn btn-info">Editar</button></a>
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
		cargarDataTable();

	});
function cargarDataTable() {
$('#empresa').DataTable({
     
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
				title: "Lista de Empresas",
				filename: "empresas",
				text: 'EXCEL <i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 15px;margin-right: 10px; margin-top: 4px; margin:6px;color:green;"> </i>',
				exportOptions: {
					columns: [0,1, 2,3,4,5,6],
				} 
			},
			{
				extend: "print",
				footer: true,
				title: "Listas Empresas",
				filename: "empresas",
				text: 'IMPRIMIR<i class="fa fa-print" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:blue;" ></i>',

				exportOptions: {
					columns: [0,1, 2,3,4,5,6],
				}

			},
			{
				extend: "pdf",
				footer: true,
				title: "Lista de Empresas",
				filename: "empresas",
				pageSize: 'A4',
                alignment: "center",
				pageMargins: [ 90, 0, 0, 0 ],
				text: 'PDF <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:red;"></i>',
				exportOptions: {
					columns: [0,1, 2,3,4,5,6],
				}


			},

		],               
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
	url:'{{route("change.statuse")}}',
	data:{'status':status, 'id':id},
	success:function(data){
/* 	$('.message').html('<p class="alert alert-danger" >'+data.success+'</p>'); */
	}
	});

  });


 </script>
@endpush
@endsection