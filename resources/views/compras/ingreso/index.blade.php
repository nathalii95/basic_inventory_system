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
		<h3>Listado de Ingresos <br><a href="ingreso/create"><button class="btn btn-success">Nuevo</button></a></h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="vistaIngreso" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
				    <th >#</th>
					<th>Fecha</th>
					<th>Proveedor</th>
					<th>Tipo Comprobante</th>
					<th>Comprobante</th>
					<th>Total Compra</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ingresos as $ing)
				<tr>
					<td>{{ $cont}}</td>
					<td>{{ $ing->fecha}}</td>
					<td>{{ $ing->nombre}}</td>
					<td>{{ $ing->tipo_comprobante}}</td>

					@if($ing->tipo_comprobante == "FACTURA")
					<td>FAC-{{ $ing->serie_comprobante}}-{{ $ing->numero_comprobante}}</td>
					@elseif($ing->tipo_comprobante  == "NOTA DE VENTA")
					<td>NV-{{ $ing->serie_comprobante}}-{{ $ing->numero_comprobante}}</td>
					@endif
					<td>{{'$' . number_format($ing->totalCompra, 2) }}</td>
						
					@if(Auth::user()->id_cargo== "1")
					<td><input type="checkbox" data-onstyle="warning" class="toggle-class" data-id="{{$ing->id_compra}}" data-toggle="toggle"
					data-on="Activo" data-off="Anulado" {{$ing->estado == 1 ? 'checked':''}}> </td>	
					@else
					<td><input type="checkbox"  disabled data-onstyle="warning" class="toggle-class" data-id="{{$ing->id_compra}}" data-toggle="toggle"
					data-on="Activo" data-off="Anulado" {{$ing->estado == 1 ? 'checked':''}}> </td>	
					@endif

					<td>
						<a href="{{URL::action('IngresoController@show',$ing->id_compra)}}"><button class="btn btn-info">Detalle</button></a>
						<a href="{{route('dtprinti',$ing->id_compra)}}" title="Imprimir/Descargar" target="_blank"  ><button class="btn btn-primary"><i class="fa fa-file-o"></i></button></a>
						<a href="{{URL::action('DevolucionComController@show',$ing->id_compra)}}" title="Realizar Devolución" ><button class="btn btn-danger" title="Realizar Devolución" ><i class="fa fa-reply" aria-hidden="true"></i></button></a>
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
$('#vistaIngreso').DataTable({
     
		responsive: "true",
		dom: 'flBrtip',  
		paging: true,
		pageLength: 10,
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
				title: "Lista de Ingresos",
				filename: "ingresos",
				text: 'EXCEL <i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 15px;margin-right: 10px; margin-top: 4px; margin:6px;color:green;"> </i>',
				exportOptions: {
					columns: [0,1, 2,3,4,5],
				} 
			},
			{
				extend: "print",
				footer: true,
				title: "Listas de Ingresos",
				filename: "ingresos",
				text: 'IMPRIMIR<i class="fa fa-print" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:blue;" ></i>',

				exportOptions: {
					columns: [0,1, 2,3,4,5],
				}

			},
			{
				extend: "pdf",
				footer: true,
				title: "Lista de Ingresos",
				filename: "ingresos",
				pageSize: 'A4',
                alignment: "center",
				pageMargins: [ 90, 0, 0, 0 ],
				text: 'PDF <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 15px; margin-right: 10px; margin-top: 4px; margin:6px;color:red;"></i>',
				exportOptions: {
					columns: [0,1, 2,3,4,5],
				}
			},

		],
		
                 
     });
 

}


$(function() {
    $('#toggle-two').bootstrapToggle({
      on: 'Activo',
      off: 'Anulado'
    });
  })

  $('.toggle-class').on('change',function(){
	var status = $(this).prop('checked') == true ? 1 : 0;
	var id = $(this).data('id');
	$.ajax({
    type:'GET',
	dataType:'json',
	url:'{{route("change.statusi")}}',
	data:{'status':status, 'id':id},
	success:function(data){
	}
	});

  });
 </script>
@endpush
@endsection